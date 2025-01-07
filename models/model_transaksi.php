<?php
include './config/db_connect.php';

class TransactionModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function getTransactions() {
        $sql = "SELECT 
                    t.transaksi_id, 
                    t.user_id, 
                    t.total_amount, 
                    t.transaksi_date, 
                    t.transaksi_status,
                    u.username AS user_name
                FROM tb_transaction t
                LEFT JOIN tb_user u ON t.user_id = u.user_id";
        $result = $this->conn->query($sql);

        $transactions = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['details'] = $this->getTransactionDetails($row['transaksi_id']);
                $transactions[] = $row;
            }
        }
        return $transactions;
    }

    public function getRecentTransactions($limit = 5) {
        $sql = "SELECT 
                    t.transaksi_id, 
                    t.user_id, 
                    t.total_amount, 
                    t.transaksi_date, 
                    t.transaksi_status,
                    u.username AS user_name
                FROM tb_transaction t
                LEFT JOIN tb_user u ON t.user_id = u.user_id
                ORDER BY t.transaksi_date DESC
                LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $recentTransactions = [];
        while ($row = $result->fetch_assoc()) {
            $recentTransactions[] = $row;
        }
        return $recentTransactions;
    }
    

    private function getTransactionDetails($transaksi_id) {
        $sql = "SELECT 
                    d.id_barang, 
                    d.quantity, 
                    d.price_barang, 
                    d.total_price, 
                    i.barang_name
                FROM tb_transaction_detail d
                LEFT JOIN tb_inventory i ON d.id_barang = i.barang_id
                WHERE d.transaksi_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $transaksi_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $details = [];
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        return $details;
    }

    public function getTransactionById($transaksi_id) {
        $sql = "SELECT 
                    t.transaksi_id, 
                    t.user_id, 
                    t.total_amount, 
                    t.transaksi_date, 
                    t.transaksi_status,
                    u.username AS user_name
                FROM tb_transaction t
                LEFT JOIN tb_user u ON t.user_id = u.user_id
                WHERE t.transaksi_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $transaksi_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $transaction = $result->fetch_assoc();

        if ($transaction) {
            $transaction['details'] = $this->getTransactionDetails($transaksi_id);
        }
        return $transaction;
    }

    public function createTransaksi($user_id, $items, $transaksi_status) {
        $this->conn->begin_transaction();
        try {
            $total_amount = 0;
    
            foreach ($items as $item) {
                $barang_price = $this->getBarangPrice($item['id_barang']);
                if ($barang_price === null) {
                    throw new Exception("Harga barang tidak ditemukan untuk ID: " . $item['id_barang']);
                }
                $total_amount += $item['quantity'] * $barang_price;
            }
    
            $sql = "INSERT INTO tb_transaction (user_id, total_amount, transaksi_date, transaksi_status) 
                    VALUES (?, ?, NOW(), ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("idi", $user_id, $total_amount, $transaksi_status);
            $stmt->execute();
            $transaksi_id = $stmt->insert_id;
    
            $sqlDetail = "INSERT INTO tb_transaction_detail (transaksi_id, id_barang, quantity, price_barang, total_price) 
                          VALUES (?, ?, ?, ?, ?)";
            $stmtDetail = $this->conn->prepare($sqlDetail);
    
            foreach ($items as $item) {
                $barang_price = $this->getBarangPrice($item['id_barang']);
                $total_price = $item['quantity'] * $barang_price;
                $stmtDetail->bind_param("iiidd", $transaksi_id, $item['id_barang'], $item['quantity'], $barang_price, $total_price);
                $stmtDetail->execute();
            }
    
            $this->conn->commit();
            return $transaksi_id;
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Error creating transaction: " . $e->getMessage());
            throw new Exception("Error creating transaction: " . $e->getMessage());
        }
    }

    public function getBarangPrice($id_barang) {
        $sql = "SELECT barang_price FROM tb_inventory WHERE barang_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['barang_price'] : null;
    }
}
