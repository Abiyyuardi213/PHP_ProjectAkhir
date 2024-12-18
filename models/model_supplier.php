<?php
include './config/db_connect.php';

class ModelSupplier {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getSuppliers() {
        $sql = "SELECT supplier_id, supplier_name, supplier_address, supplier_phone, supplier_email, created_at FROM tb_supplier";
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
        if (!$stmt) {
            die("Error: " . $this->conn->error);
        }
        $stmt->bind_param("i", $supplier_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addSupplier($supplier_name, $supplier_address, $supplier_phone, $supplier_email) {
        $sql = "INSERT INTO tb_supplier (supplier_name, supplier_address, supplier_phone, supplier_email)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error: " . $this->conn->error);
        }
        $stmt->bind_param("ssss", $supplier_name, $supplier_address, $supplier_phone, $supplier_email);
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        } else {
            die("Error: " . $stmt->error);
        }
    }

    public function updateSupplier($supplier_id, $supplier_name, $supplier_address, $supplier_phone, $supplier_email) {
        $sql = "UPDATE tb_supplier 
                SET supplier_name = ?, supplier_address = ?, supplier_phone = ?, supplier_email = ?
                WHERE supplier_id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error: " . $this->conn->error);
        }
        $stmt->bind_param("ssssi", $supplier_name, $supplier_address, $supplier_phone, $supplier_email, $supplier_id);
        if ($stmt->execute()) {
            return $stmt->affected_rows;
        } else {
            die("Error: " . $stmt->error);
        }
    }

    public function deleteSupplier($supplier_id) {
        $sql = "DELETE FROM tb_supplier WHERE supplier_id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error: " . $this->conn->error);
        }
        $stmt->bind_param("i", $supplier_id);
        if ($stmt->execute()) {
            return $stmt->affected_rows;
        } else {
            die("Error: " . $stmt->error);
        }
    }

    public function searchSupplierByName($searchTerm) {
        global $conn;
        $sql = "SELECT * FROM tb_supplier WHERE supplier_name LIKE ?";
        $stmt = $conn->prepare($sql);
        $likeTerm = "%$searchTerm%";
        $stmt->bind_param("s", $likeTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        $suppliers = [];
        while ($row = $result->fetch_assoc()) {
            $suppliers[] = $row;
        }
        return $suppliers;
    }

    public function getAllSuppliers() {
        return $this->getSuppliers();
    }
}