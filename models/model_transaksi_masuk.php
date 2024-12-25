<?php
include './config/db_connect.php';

class TransactionInModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getTransactionIn() {
        $sql = "SELECT
                    ti.invoice_id,
                    ti.supplier_id,
                    ti.barang_penerima,
                    ti.cretaed_at,
                    s.supplier_name AS supplier_name
                FROM tb_transaction_in ti
                LEFT JOIN tb_supplier s ON ti.supplier_id = s.supplier_id";
        $result = $this->conn->query($sql);

        $transactionsIn = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['details'] = $this->getTransactionInDetails($row['invoice_id']);
                $transactionsIn[] = $row;
            }
        }
        return $transactionsIn;
    }

    public function getTransactionInDetails($invoice_id) {
        $sql = "SELECT
                    td.barang_id,
                    s.supplier_phone,
                    s.supplier_email,
                    td.barang_name,
                    td.barang_price,
                    td.barang_quantity,
                FROM tb_transaction_in_detail td
                LEFT JOIN tb_supplier s ON td.supplier_id = s.supplier_id
                WHERE td.invoice_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $invoice_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $details = [];
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        return $details;
    }

    public function getTransactionInById($invoice_id) {
        $sql = "SELECT
                    ti.invoice_id,
                    ti.supplier_id,
                    ti.barang_penerima,
                    ti.cretaed_at,
                    s.supplier_name AS supplier_name
                FROM tb_transaction_in ti
                LEFT JOIN tb_supplier s ON ti.supplier_id = s.supplier_id
                WHERE ti.invoice_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $invoice_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $transactionIn = $result->fetch_assoc();
        if ($transactionIn) {
            $transactionIn['details'] = $this->getTransactionInDetails($invoice_id);
        }
        return $transactionIn;
    }

    public function addTransactionIn($invoice_id, $supplier_id, $barang_penerima, $barangs) {
        $sql = "INSERT INTO tb_transaction_in (invoice_id, supplier_id, barang_penerima, created_at)
                VALUES (?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iis", $invoice_id, $supplier_id, $barang_penerima);
        $stmt->execute();

        $sql_detail = "INSERT INTO tb_transaction_in_detail (invoice_id, supplier_id, barang_name, barang_price, barang_quantity)
                       VALUES (?, ?, ?, ?, ?)";
        $stmt_detail = $this->conn->prepare($sql_detail);
        foreach ($barangs as $barang) {
            $barang_name = htmlspecialchars(trim($barang['barang_name'] ?? ''));
            $supplier_id = intval($barang['supplier_id'] ?? 0);
            $supplier_phone = htmlspecialchars(trim($barang['supplier_phone'] ?? ''));
            $supplier_email = htmlspecialchars(trim($barang['supplier_email'] ?? ''));
            $barang_price = floatval($barang['barang_price'] ?? 0);
            $barang_quantity = intval($barang['barang_quantity'] ?? 0);

            $stmt_detail->bind_param("iisdi", $invoice_id, $supplier_id, $barang_name, $barang_price, $barang_quantity);
            $stmt_detail->execute();
        }
    }
}