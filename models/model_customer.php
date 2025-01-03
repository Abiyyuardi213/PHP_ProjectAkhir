<?php
include './config/db_connect.php';

class CustomerService {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createCustomer($username, $password, $email, $full_name, $phone_number = null, $address = null) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO tb_customer (username, password, email, full_name, phone_number, address)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $username, $hashedPassword, $email, $full_name, $phone_number, $address);
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        } else {
            return false;
        }
    }

    public function registerCustomer($username, $password, $email, $full_name, $phone_number = null, $address = null) {
        $sqlCheck = "SELECT * FROM tb_customer WHERE email = ? OR username = ?";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->bind_param("ss", $email, $username);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result();
        if ($result->num_rows > 0) {
            return "Email atau Username sudah digunakan";
        }
    
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO tb_customer (username, password, email, full_name, phone_number, address)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $username, $hashedPassword, $email, $full_name, $phone_number, $address);
    
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        } else {
            return false;
        }
    }

    public function getCustomerById($customer_id) {
        $sql = "SELECT * FROM tb_customer WHERE customer_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getAllCustomers() {
        $sql = "SELECT * FROM tb_customer";
        $result = $this->conn->query($sql);

        $customers = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $customers[] = $row;
            }
        }
        return $customers;
    }

    public function updateCustomer($customer_id, $username, $email, $full_name, $phone_number, $address) {
        $phone_number = $phone_number ?? ''; 
        $address = $address ?? '';
    
        $sql = "UPDATE tb_customer 
                SET username = ?, email = ?, full_name = ?, phone_number = ?, address = ? 
                WHERE customer_id = ?";
        $stmt = $this->conn->prepare($sql);
    
        $stmt->bind_param("sssssi", $username, $email, $full_name, $phone_number, $address, $customer_id);
    
        return $stmt->execute();
    }

    public function deleteCustomer($customer_id) {
        $sql = "DELETE FROM tb_customer WHERE customer_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $customer_id);
        return $stmt->execute();
    }

    public function loginCustomer($username, $password) {
        $sql = "SELECT customer_id, password FROM tb_customer WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $customer = $result->fetch_assoc();
            if (password_verify($password, $customer['password'])) {
                return $customer['customer_id'];
            }
        }
        return false;
    }
}