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

            default:
                $this->listCustomers();
                break;
        }
    }

    public function listCustomers() {
        $customers = $this->model->getAllCustomers();
        include './views/customer_list.php';
    }

    public function createCustomer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $email = $_POST['email'] ?? '';
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
        include './views/customer_add.php';
    }

    public function updateCustomer($customer_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $full_name = $_POST['full_name'] ?? '';
            $phone_number = $_POST['phone_number'] ?? null;
            $address = $_POST['address'] ?? null;
            $status = intval($_POST['status'] ?? 0);

            if ($this->model->updateCustomer($customer_id, $username, $email, $full_name, $phone_number, $address, $status)) {
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
        // include customer update
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
        include './views/customer_search.php';
    }

    private function redirectToList() {
        header('Location: index.php?modul=customer&fitur=list');
        exit;
    }
}