<?php
include './config/db_connect.php';

interface InterfaceBarang {
    public function getBarangs();
    public function getBarangById($barang_id);
    public function addBarang($invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima, $barang_status);
    public function updateBarang($barang_id, $invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima, $barang_status);
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
        $sql = "SELECT 
                    i.barang_id,
                    i.barang_name,
                    s.supplier_name,
                    i.barang_status
                FROM tb_inventory i
                LEFT JOIN tb_supplier s ON i.supplier_id = s.supplier_id";
        $result = $this->conn->query($sql);
    
        $barangs = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $barangs[] = $row;
            }
        }
        return $barangs;
    }

    public function getBarangById($barang_id) {
        $query = "SELECT * FROM tb_inventory JOIN tb_supplier ON tb_supplier.supplier_id = tb_inventory.supplier_id WHERE barang_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $barang_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $barang = $result->fetch_assoc();
            
            $query_detail = "SELECT * FROM tb_inventory WHERE barang_id = ?";
            $stmt_detail = $this->conn->prepare($query_detail);
            $stmt_detail->bind_param("i", $barang_id);
            $stmt_detail->execute();
            $result_detail = $stmt_detail->get_result();
            
            $details = [];
            while ($detail = $result_detail->fetch_assoc()) {
                $details[] = $detail;
            }
            
            $barang['detail'] = $details;
            return $barang;
        }
    
        return null;
    }

    public function addBarang($invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima, $barang_status) {
        $sql = "INSERT INTO tb_inventory (invoice_id, supplier_id, supplier_phone, supplier_email, barang_name, barang_price, barang_quantity, barang_penerima, barang_status, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare statement failed: " . $this->conn->error);
        }
        $stmt->bind_param("sissssiss", $invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima, $barang_status);
        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        }
        return true;
    }

    public function updateBarang($barang_id, $invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima, $barang_status) {
        $sql = "UPDATE tb_inventory 
                SET invoice_id = ?, supplier_id = ?, supplier_phone = ?, supplier_email = ?, barang_name = ?, barang_price = ?, barang_quantity = ?, barang_penerima = ?, barang_status = ?
                WHERE barang_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sissssissi", $invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima, $barang_status, $barang_id);
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
        // $sql = "SELECT
        //             barang_id,
        //             invoice_id,
        //             supplier_id,
        //             supplier_phone,
        //             supplier_email,
        //             barang_name,
        //             barang_price,
        //             barang_quantity,
        //             barang_penerima,
        //             barang_status,
        //             created_at
        //         FROM tb_inventory
        //         WHERE barang_name LIKE ?";
        // $stmt = $this->conn->prepare($sql);
        // $likeTerm = "%$searchTerm%";
        // $stmt->bind_param("s", $likeTerm);
        // $stmt->execute();
        // $result = $stmt->get_result();

        // $barangs = [];
        // while ($row = $result->fetch_assoc()) {
        //     $barangs[] = $row;
        // }
        // return $barangs;
    }

    public function getAllBarangs() {
        return $this->getBarangs();
    }
}
