<?php
include './config/db_connect.php';

class ModelBarang {
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

    public function searchBarangByName($keyword) {
        $sql = "SELECT * FROM tb_inventory WHERE barang_name LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $searchKeyword = "%" . $keyword . "%";
        $stmt->bind_param("s", $searchKeyword);
        $stmt->execute();
        $result = $stmt->get_result();

        $barangs = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $barangs[] = $row;
            }
        }
        return $barangs;
    }

    public function getAllBarangs() {
        return $this->getBarangs();
    }
}