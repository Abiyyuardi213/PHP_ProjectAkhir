<?php
include 'models/model_customer.php';

class ControllerCustomer {
    private $model;

    public function __construct($conn) {
        $this->model = new CustomerService($conn);
    }

    public function handleRequestCustomer($fitur) {
        $customer_id = $_GET['id'] ?? null;

        switch ($fitur) {
            case 'create':
                $this->createCustomer();
                break;

            case 'register':
                $this->registerCustomer();
                break;

            case 'login':
                $this->loginCustomer();
                break;

            case 'update':
                if ($customer_id) {
                    $this->updateCustomer($customer_id);
                } else {
                    $this->redirectToList();
                }
                break;

            case 'delete':
                if ($customer_id) {
                    $this->deleteCustomer($customer_id);
                } else {
                    $this->redirectToList();
                }
                break;

            case 'search':
                $this->searchCustomer();
                break;

            case 'order':
                $this->listOrders();
                break;

            default:
                $this->listCustomers();
                break;
        }
    }

    public function listCustomers() {
        $customers = $this->model->getAllCustomers();
        include './views/customer/customer_list.php';
    }

    public function createCustomer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $email = $_POST['email'] ?? '';
            $full_name = $_POST['full_name'] ?? '';
            $phone_number = $_POST['phone_number'] ?? null;
            $address = $_POST['address'] ?? null;

            if (empty($username) || empty($password) || empty($email) || empty($full_name)) {
                $errorMessage = "All fields are required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMessage = "Invalid email format.";
            } else {
                if ($this->model->createCustomer($username, $password, $email, $full_name, $phone_number, $address)) {
                    $this->redirectToList();
                } else {
                    $errorMessage = "Failed to add customer.";
                }
            }
        }
        include './views/customer/customer_add.php';
    }

    public function registerCustomer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $email = $_POST['email'] ?? '';
            $full_name = $_POST['full_name'] ?? '';
            $phone_number = $_POST['phone_number'] ?? null;
            $address = $_POST['address'] ?? null;
    
            if (empty($username) || empty($password) || empty($email) || empty($full_name)) {
                $errorMessage = "All fields are required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMessage = "Invalid email format.";
            } else {
                $result = $this->model->registerCustomer($username, $password, $email, $full_name, $phone_number, $address);
                if (is_numeric($result)) {
                    header('Location: index.php?modul=customer&fitur=register_success');
                    exit();
                } elseif ($result === "Email atau Username sudah digunakan") {
                    $errorMessage = $result;
                } else {
                    $errorMessage = "Failed to register customer.";
                }
            }
        }
    
        include './views/customer/customer_register.php';
    }

    public function loginCustomer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $errorMessage = "Username and password are required.";
            } else {
                $customer_id = $this->model->loginCustomer($username, $password);
                if ($customer_id) {
                    session_start();
                    $_SESSION['customer_id'] = $customer_id;
                    $_SESSION['username'] = $username;

                    header('Location: index.php?modul=customer_dashboard&fitur=home');
                    exit();
                } else {
                    $errorMessage = "Invalid username or password.";
                }
            }
        }

        include './views/customer/customer_login.php';
    }

    public function updateCustomer($customer_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $full_name = $_POST['full_name'] ?? '';
            $phone_number = $_POST['phone_number'] ?? null;
            $address = $_POST['address'] ?? null;
    
            if ($this->model->updateCustomer($customer_id, $username, $email, $full_name, $phone_number, $address)) {
                header('Location: index.php?modul=customer&fitur=list&message=update_success');
                exit();
            } else {
                echo "<div class='error'>Failed to update customer. Please try again.</div>";
            }
        }
        $customer = $this->model->getCustomerById($customer_id);
        if (!$customer) {
            echo "<div class='error'>Customer not found.</div>";
            $this->redirectToList();
        }
        include './views/customer/customer_update.php';
    }

    public function deleteCustomer($customer_id) {
        if ($this->model->deleteCustomer($customer_id)) {
            $this->redirectToList();
        } else {
            echo "Failed to delete customer.";
        }
    }

    public function searchCustomer() {
        $keyword = $_GET['keyword'] ?? '';
        $customers = $this->model->getAllCustomers();
        // include customer search
    }

    public function listOrders() {
        // Contoh mock data pesanan (Bisa diubah dengan query ke database jika ada sistem penyimpanan order)
        $orders = [
            ['order_id' => 1, 'order_date' => '2024-12-30', 'status' => 'Completed', 'total' => 120000],
            ['order_id' => 2, 'order_date' => '2024-12-29', 'status' => 'Pending', 'total' => 85000],
            ['order_id' => 3, 'order_date' => '2024-12-28', 'status' => 'Processing', 'total' => 97000],
        ];

        include './views/customer/customer_order.php';
    }

    private function redirectToList() {
        header('Location: index.php?modul=customer&fitur=list');
        exit;
    }
}