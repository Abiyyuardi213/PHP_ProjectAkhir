<?php
include './config/db_connect.php';

class ModelBarang {
    public function getBarangs() {
        global $conn;
        $sql = "SELECT * FROM tb_inventory";
        $result = $conn->query($sql);

        $barangs = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $barangs[] = $row;
            }
        }
        return $barangs;
    }

    public function getBarangById($barang_id) {
        global $conn;
        $sql = "SELECT * FROM tb_inventory WHERE barang_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $barang_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addBarang($barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status) {
        global $conn;
        $sql = "INSERT INTO tb_inventory (barang_name, barang_quantity, barang_price, barang_supplier, barang_status) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissi", $barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status);
        return $stmt->execute();
    }

    public function updateBarang($barang_id, $barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status) {
        global $conn;
        $sql = "UPDATE tb_inventory 
                SET barang_name = ?, barang_quantity = ?, barang_price = ?, barang_supplier = ?, barang_status = ? 
                WHERE barang_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissi", $barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status, $barang_id);
        return $stmt->execute();
    }

    public function deleteBarang($barang_id) {
        global $conn;
        $sql = "DELETE FROM tb_inventory WHERE barang_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $barang_id);
        return $stmt->execute();
    }

    public function getAllBarangs() {
        return $this->getBarangs();
    }
}