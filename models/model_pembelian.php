<?php
include './config/db_connect.php';

class ModelPembelian {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createPembelian($customer_id, $items) {
        $query = "INSERT INTO tb_pembelian (customer_id) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $id_pembelian = $stmt->insert_id;
    
        foreach ($items as $item) {
            $queryDetail = "INSERT INTO tb_pembelian_details (id_pembelian, barang_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmtDetail = $this->conn->prepare($queryDetail);
            $stmtDetail->bind_param("iiid", $id_pembelian, $item['barang_id'], $item['quantity'], $item['price']);
            $stmtDetail->execute();
    
            $queryUpdate = "UPDATE tb_inventory SET barang_quantity = barang_quantity - ? WHERE barang_id = ?";
            $stmtUpdate = $this->conn->prepare($queryUpdate);
            $stmtUpdate->bind_param("ii", $item['quantity'], $item['barang_id']);
            $stmtUpdate->execute();
        }
        return $id_pembelian;
    }

    public function getAllAvailableItems() {
        $query = "SELECT barang_id, barang_name, barang_price, barang_quantity 
                  FROM tb_inventory 
                  WHERE barang_quantity > 0";
        $result = $this->conn->query($query);

        $items = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items;
    }
}
