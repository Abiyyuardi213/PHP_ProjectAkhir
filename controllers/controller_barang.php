<?php
include 'models/model_barang.php';

class controllerBarang {
    private $model;

    public function __construct() {
        $this->model = new ModelBarang();
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
                    header('Location: index.php?modul=barang&fitur=list');
                }
                break;
            case 'delete':
                if ($barang_id) {
                    $this->deleteBarang($barang_id);
                } else {
                    header('Location: index.php?modul=barang&fitur=list');
                }
                break;
            default:
                $this->listBarang();
                break;
        }
    }

    public function listBarang() {
        $barangs = $this->model->getBarangs();
        //include barang list
    }

    public function createBarang() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $barang_name = $_POST['barang_name'];
            $barang_quantity = $_POST['barang_quantity'];
            $barang_price = $_POST['barang_price'];
            $barang_supplier = $_POST['barang_supplier'];
            $barang_status = $_POST['barang_status'];

            if ($this->model->addBarang($barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status)) {
                header('Location: index.php?modul=barang');
                exit;
            } else {
                echo "Gagal menambahkan barang.";
            }
        }

        //include barang add
    }

    public function updateBarang($barang_id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $barang_name = $_POST['barang_name'];
            $barang_quantity = $_POST['barang_quantity'];
            $barang_price = $_POST['barang_price'];
            $barang_supplier = $_POST['barang_supplier'];
            $barang_status = $_POST['barang_status'];

            if ($this->model->updateBarang($barang_id, $barang_name, $barang_quantity, $barang_price, $barang_supplier, $barang_status)) {
                header('Location: index.php?modul=barang'); // Redirect ke daftar barang
                exit;
            } else {
                echo "Gagal memperbarui barang.";
            }
        }

        $barang = $this->model->getBarangById($barang_id);
        //include barang update php
    }

    public function deleteBarang($barang_id) {
        if ($this->model->deleteBarang($barang_id)) {
            header('Location: index.php?modul=barang'); // Redirect ke daftar barang
            exit;
        } else {
            echo "Gagal menghapus barang.";
        }
    }
}