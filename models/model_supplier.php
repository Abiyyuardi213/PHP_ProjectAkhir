<?php
include './config/db_connect.php';

class ModelSupplier {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getSuppliers() {
        $sql = "SELECT supplier_id, supplier_name, supplier_addres, supplier_phone, supplier_email, created_at FROM tb_supplier";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Error: " . $this->conn->error);
        }

        $suppliers = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $suppliers[] = $row;
            }
        }
        return $suppliers;
    }

    public function getSupplierById($supplier_id) {
        $sql = "SELECT * FROM tb_supplier WHERE supplier_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $supplier_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}