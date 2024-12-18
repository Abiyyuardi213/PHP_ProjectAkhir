<?php
include './config/db_connect.php';

interface InterfaceBarang {
    public function getBarangs();
    public function getBarangById($barang_id);
    public function addBarang($barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status);
    public function updateBarang($barang_id, $barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status);
    public function deleteBarang($barang_id);
    public function searchBarangByName($keyword);
    public function getAllBarangs();
}

class ModelBarang implements InterfaceBarang {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getBarangs() {
        $sql = "SELECT barang_id, barang_name, barang_quantity, barang_price, barang_supplier, barang_status, create_at FROM tb_inventory";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Error: " . $this->conn->error);
        }
    
        $barangs = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $barangs[] = $row;
            }
        }
        return $barangs;
    }

    public function getBarangById($barang_id) {
        $sql = "SELECT * FROM tb_inventory WHERE barang_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $barang_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addBarang($barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status) {
        $sql = "INSERT INTO tb_inventory (barang_name, barang_quantity, barang_price, barang_supplier, barang_status) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sissi", $barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status);
        return $stmt->execute();
    }

    public function updateBarang($barang_id, $barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status) {
        $sql = "UPDATE tb_inventory 
                SET barang_name = ?, barang_quantity = ?, barang_price = ?, barang_supplier = ?, barang_status = ? 
                WHERE barang_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sissii", $barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status, $barang_id);
        return $stmt->execute();
    }

    public function deleteBarang($barang_id) {
        $sql = "DELETE FROM tb_inventory WHERE barang_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $barang_id);
        return $stmt->execute();
    }

    public function searchBarangByName($searchTerm) {
        global $conn;
        $sql = "SELECT * FROM tb_inventory WHERE barang_name LIKE ?";
        $stmt = $conn->prepare($sql);
        $likeTerm = "%$searchTerm%";
        $stmt->bind_param("s", $likeTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        $barangs = [];
        while ($row = $result->fetch_assoc()) {
            $barangs[] = $row;
        }
        return $barangs;
    }

    public function getAllBarangs() {
        return $this->getBarangs();
    }
}