<?php
include './config/db_connect.php';

class ModelDetailTransaction {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addDetailTransaksi($transaksi_id, $id_barang, $quantity, $price_barang) {
        $sql = "INSERT INTO tb_detailtransaksi (transaksi_id, id_barang, quantity, price_barang) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiii", $transaksi_id, $id_barang, $quantity, $price_barang);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function getDetailByTransaksiId($transaksi_id) {
        $sql = "SELECT dt.id_detailtransaksi, dt.transaksi_id, dt.id_barang, dt.quantity, dt.price_barang, b.nama_barang
                FROM tb_detail_transaksi dt
                LEFT JOIN tb_barang b ON dt.id_barang = b.id_barang
                WHERE dt.transaksi_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $transaksi_id);
        $stmt->execute();
        $result = $stmt->get_result();
    }
}
