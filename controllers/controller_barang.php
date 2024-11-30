<?php
include 'models/model_barang.php';

class ControllerBarang {
    private $model;

    public function __construct($conn) {
        $this->model = new ModelBarang($conn);
    }

    public function handleRequestBarang($fitur) {
        $barang_id = $_GET['id'] ?? null;

        switch ($fitur) {
            case 'create':
                $this->createBarang();
                break;

            case 'update':
                if ($barang_id) {
                    $this->updateBarang($barang_id);
                } else {
                    $this->redirectToList();
                }
                break;

            case 'delete':
                if ($barang_id) {
                    $this->deleteBarang($barang_id);
                } else {
                    $this->redirectToList();
                }
                break;

            case 'search':
                $this->searchBarang();
                break;

            default:
                $this->listBarang();
                break;
        }
    }

    public function listBarang() {
        $barangs = $this->model->getBarangs();
        include './views/inventory_list.php';
    }

    public function createBarang() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $barang_name = $_POST['barang_name'] ?? '';
            $barang_quantity = intval($_POST['barang_quantity'] ?? 0);
            $barang_price = floatval($_POST['barang_price'] ?? 0);
            $barang_supplier = $_POST['barang_supplier'] ?? 'Unknown';
            $barang_status = intval($_POST['barang_status'] ?? 0);

            if (empty($barang_name)) {
                $errorMessage = "Inventory name is required.";
            } elseif ($barang_quantity < 0 || $barang_price < 0) {
                $errorMessage = "Quantity and price must be non-negative.";
            } else {
                if ($this->model->addBarang($barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status)) {
                    $this->redirectToList();
                } else {
                    $errorMessage = "Failed to add inventory.";
                }
            }
        }
        include './views/inventory_add.php';
    }

    public function updateBarang($barang_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $barang_name = $_POST['barang_name'] ?? '';
            $barang_quantity = intval($_POST['barang_quantity'] ?? 0);
            $barang_price = floatval($_POST['barang_price'] ?? 0);
            $barang_supplier = $_POST['barang_supplier'] ?? 'Unknown';
            $barang_status = intval($_POST['barang_status'] ?? 0);
    
            if ($this->model->updateBarang($barang_id, $barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status)) {
                header('Location: index.php?modul=inventory&fitur=list&message=update_success');
                exit();
            } else {
                echo "<div class='error'>Failed to update inventory. Please try again.</div>";
            }
        }
        $barang = $this->model->getBarangById($barang_id);
        if (!$barang) {
            echo "<div class='error'>Barang tidak ditemukan.</div>";
            header('Location: index.php?modul=inventory&fitur=list');
            exit();
        }
        include './views/inventory_update.php';
    }

    public function deleteBarang($barang_id) {
        if ($this->model->deleteBarang($barang_id)) {
            $this->redirectToList();
        } else {
            echo "Failed to delete inventory.";
        }
    }

    public function searchBarang() {
        $keyword = $_GET['keyword'] ?? '';
        $barangs = $this->model->searchBarangByName($keyword);
        include './views/inventory_search.php';
    }

    private function redirectToList() {
        header('Location: index.php?modul=inventory&fitur=list');
        exit;
    }
}
