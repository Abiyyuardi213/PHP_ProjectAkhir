<?php
include './config/db_connect.php';

class TransactionModel {
    public function getTransactions() {
        global $conn;
        $sql = "SELECT t.transaksi_id, t.user_id, t.transaksi_date, t.transaksi_status, t.item_detail 
                FROM tb_transaksi t
                LEFT JOIN tb_user u ON t.user_id = u.user_id";
        $result = $conn->query($sql);

        $transactions = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['item_detail'] = json_decode($row['item_detail'], true);
                $transactions[] = $row;
            }
        }
        return $transactions;
    }

    public function getTransactionById($transaksi_id) {
        global $conn;
        $sql = "SELECT t.transaksi_id, t.user_id, t.transaksi_date, t.transaksi_status, t.item_detail
                FROM tb_transaksi t
                LEFT JOIN tb_user u ON t.user_id = u.user_id
                WHERE t.transaksi_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $transaksi_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $transaction = $result->fetch_assoc();
        $transaction['item_detail'] = json_decode($transaction['item_detail'], true);
        return $transaction;
    }

    public function createTransaksi($user_id, $transaksi_status, $item_details) {
        global $conn;
        $item_detail_json = json_encode($item_details);
        $sql = "INSERT INTO tb_transaksi (user_id, transaksi_status, item_detail) 
                VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $user_id, $transaksi_status, $item_detail_json);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function getAllTransaksi() {
        return $this->getTransactions();
    }
}