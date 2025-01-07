<?php
include 'models/model_pembelian.php';
include 'models/model_barang.php';

class ControllerPembelian {
    private $model;
    private $modelBarang;

    public function __construct($conn) {
        $this->model = new ModelPembelian($conn);
        $this->modelBarang = new ModelBarang($conn);
    }

    public function handleRequestPembelian($fitur) {
        switch ($fitur) {
            case 'home':
                $this->listPembelian();
                break;
            case 'product':
                $this->listProduct();
                break;
            case 'cart':
                $this->viewCart();
                break;
            default:
                echo "Fitur tidak dikenali.";
                break;
        }
    }

    public function listPembelian() {
        try {
            $pembelians = $this->model->getAllAvailableItems();
            include './views/customer/customer_dashboard.php';
        } catch (Exception $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }

    public function listProduct() {
        try {
            $products = $this->modelBarang->getAvailableBarangs();
            include './views/customer/customer_product.php';
        } catch (Exception $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }

    public function viewCart() {
        $total_price = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total_price += $item['barang_price'] * $item['barang_quantity'];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action']) && isset($_POST['barang_id'])) {
                $barang_id = $_POST['barang_id'];
                foreach ($_SESSION['cart'] as $key => &$item) {
                    if ($item['barang_id'] == $barang_id) {
                        if ($_POST['action'] === 'increase') {
                            $item['barang_quantity']++;
                        } elseif ($_POST['action'] === 'decrease' && $item['barang_quantity'] > 1) {
                            $item['barang_quantity']--;
                        } elseif ($_POST['action'] === 'remove') {
                            unset($_SESSION['cart'][$key]);
                        }
                        break;
                    }
                }
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
        }

        $total_price = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total_price += $item['barang_price'] * $item['barang_quantity'];
        }
        include './views/customer/customer_cart.php';
    }
}
