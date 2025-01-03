<?php
include './config/db_connect.php';

class ModelBarang {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getBarangs() {
        $sql = "SELECT 
                    i.barang_id,
                    i.barang_name,
                    s.supplier_name,
                    i.product_picture,
                    i.created_at
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
        $query = "SELECT tb_inventory.*, tb_supplier.supplier_name 
                  FROM tb_inventory 
                  JOIN tb_supplier ON tb_supplier.supplier_id = tb_inventory.supplier_id 
                  WHERE tb_inventory.barang_id = ?";
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

    public function addBarang($invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima, $product_picture = null) {
        $sql = "INSERT INTO tb_inventory (invoice_id, supplier_id, supplier_phone, supplier_email, barang_name, barang_price, barang_quantity, barang_penerima, product_picture, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare statement failed: " . $this->conn->error);
        }
        $stmt->bind_param("sissssiss", $invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima, $product_picture);
        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        }
        return true;
    }

    public function addMultipleBarangs($barangs) {
        $sql = "INSERT INTO tb_inventory (invoice_id, supplier_id, supplier_phone, supplier_email, barang_name, barang_price, barang_quantity, barang_penerima, product_picture, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->conn->error);
        }
    
        foreach ($barangs as $barang) {
            if (
                !isset($barang['invoice_id'], $barang['supplier_id'], $barang['supplier_phone'], $barang['supplier_email'],
                    $barang['barang_name'], $barang['barang_price'], $barang['barang_quantity'], $barang['barang_penerima'], $barang['product_picture'])
            ) {
                throw new Exception("Invalid barang data: missing required fields");
            }
    
            $stmt->bind_param(
                "sisssdiss", 
                $barang['invoice_id'], 
                $barang['supplier_id'], 
                $barang['supplier_phone'], 
                $barang['supplier_email'], 
                $barang['barang_name'], 
                $barang['barang_price'], 
                $barang['barang_quantity'], 
                $barang['barang_penerima'],
                $barang['product_picture']
            );
    
            if (!$stmt->execute()) {
                throw new Exception("Error executing statement for barang: " . $stmt->error);
            }
        }
    
        return true;
    }

    public function updateBarang($barang_id, $invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima, $product_picture = null) {
        $setFields = "invoice_id = ?, supplier_id = ?, supplier_phone = ?, supplier_email = ?, barang_name = ?, barang_price = ?, barang_quantity = ?, barang_penerima = ?";
        $params = [$invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima];

        if (!empty($product_picture)) {
            $setFields .= ", product_picture = ?";
            $params[] = $product_picture;
        }

        $params[] = $barang_id;

        $sql = "UPDATE tb_inventory SET $setFields WHERE barang_id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->conn->error);
        }

        $stmt->bind_param(str_repeat('s', count($params) - 1) . 'i', ...$params);

        if (!$stmt->execute()) {
            throw new Exception("Error executing statement: " . $stmt->error);
        }

        return $stmt->affected_rows > 0;
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
        $sql = "SELECT barang_id, barang_name, barang_price FROM tb_inventory";
        $result = $this->conn->query($sql);
    
        $barangs = [];
        while ($row = $result->fetch_assoc()) {
            $barangs[] = $row;
        }
        return $barangs;
    }

    public function sortInventoryByName($order = 'ASC') {
        global $conn;
        $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';
        $sql = "SELECT * FROM tb_inventory ORDER BY barang_name $order";
        $result = $conn->query($sql);

        $barangs = [];
        while ($row = $result->fetch_assoc()) {
            $barangs[] = $row;
        }
        return $barangs;
    }

    public function sortInventoryById($order = 'ASC') {
        global $conn;
        $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';
        $sql = "SELECT * FROM tb_inventory ORDER BY barang_id $order";
        $result = $conn->query($sql);

        $barangs = [];
        while ($row = $result->fetch_assoc()) {
            $barangs[] = $row;
        }
        return $barangs;
    }

    public function getAvailableItems() {
        $query = "SELECT barang_id, barang_name, barang_price, barang_quantity FROM tb_inventory WHERE barang_quantity > 0";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAvailableBarangs() {
        $query = "SELECT barang_id, barang_name, barang_price, barang_quantity FROM tb_inventory WHERE barang_quantity > 0";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}