<?php
include 'models/model_barang.php';
include 'models/model_supplier.php';

class ControllerBarang {
    private $modelBarang;
    private $modelSupplier;

    public function __construct($conn) {
        $this->modelBarang = new ModelBarang($conn);
        $this->modelSupplier = new ModelSupplier($conn);
    }

    public function handleRequestBarang($fitur) {
        $barang_id = $_GET['id'] ?? null;

        switch ($fitur) {
            case 'create':
                $this->createBarang();
                break;

            case 'detail':
                $barang_id = $_GET['id'] ?? null;
                if ($barang_id) {
                    $this->viewDetailInventory($barang_id);
                } else {
                    echo "Inventory ID not found.";
                }
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
                $this->listBarangs();
                break;
        }
    }

    public function listBarangs() {
        $searchTerm = $_GET['search'] ?? null;
        if ($searchTerm) {
            $barangs = $this->modelBarang->searchBarangByName($searchTerm);
        } else {
            $barangs = $this->modelBarang->getBarangs();
        }
        include './views/inventory_list.php';
    }

    public function viewDetailInventory($barang_id) {
        $barang = $this->modelBarang->getBarangById($barang_id);
        if (!$barang) {
            echo "Inventory data not found.";
            return;
        }
        include './views/inventory_detail.php';
    }

    public function createBarang() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $barang_name = htmlspecialchars(trim($_POST['barang_name'] ?? ''));
            $supplier_id = intval($_POST['supplier_id'] ?? 0);
            $supplier_phone = htmlspecialchars(trim($_POST['supplier_phone'] ?? ''));
            $supplier_email = htmlspecialchars(trim($_POST['supplier_email'] ?? ''));
            $barang_price = floatval($_POST['barang_price'] ?? 0);
            $barang_quantity = intval($_POST['barang_quantity'] ?? 0);
            $barang_penerima = htmlspecialchars(trim($_POST['barang_penerima'] ?? ''));
            $barang_status = intval($_POST['barang_status'] ?? 0);
            $invoice_id = htmlspecialchars(trim($_POST['invoice_id'] ?? ''));

            if ($supplier_id <= 0) {
                echo "Supplier belum dipilih.";
                include './views/inventory_add.php';
                return;
            }

            $result = $this->modelBarang->addBarang($invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima, $barang_status);
            
            if ($result) {
                $this->redirectToListWithMessage('Barang berhasil ditambahkan.');
            } else {
                echo "Gagal menambahkan barang.";
            }
        }

        $suppliers = $this->modelSupplier->getAllSuppliers();

        include './views/inventory_add.php';
    }

    public function updateBarang($barang_id) {
        $barang = $this->modelBarang->getBarangById($barang_id);
        if (!$barang) {
            $this->redirectToListWithMessage('Barang tidak ditemukan.');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $barang_name = htmlspecialchars(trim($_POST['barang_name'] ?? ''));
            $supplier_id = intval($_POST['supplier_id'] ?? 0);
            $supplier_phone = htmlspecialchars(trim($_POST['supplier_phone'] ?? ''));
            $supplier_email = htmlspecialchars(trim($_POST['supplier_email'] ?? ''));
            $barang_price = floatval($_POST['barang_price'] ?? 0);
            $barang_quantity = intval($_POST['barang_quantity'] ?? 0);
            $barang_penerima = htmlspecialchars(trim($_POST['barang_penerima'] ?? ''));
            $barang_status = intval($_POST['barang_status'] ?? 0);
            $invoice_id = htmlspecialchars(trim($_POST['invoice_id'] ?? ''));

            if (empty($barang_name)) {
                $errorMessage = "Nama barang wajib diisi.";
            } elseif ($supplier_id <= 0) {
                $errorMessage = "Supplier tidak valid.";
            } else {
                if ($this->modelBarang->updateBarang($barang_id, $invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima, $barang_status)) {
                    $this->redirectToListWithMessage('Barang berhasil diperbarui.');
                } else {
                    $errorMessage = "Gagal memperbarui barang.";
                }
            }
        }

        $suppliers = $this->modelSupplier->getAllSuppliers();

        include './views/inventory_update.php';
    }

    public function deleteBarang($barang_id) {
        if ($this->modelBarang->deleteBarang($barang_id)) {
            $this->redirectToListWithMessage('Barang berhasil dihapus.');
        } else {
            $this->redirectToListWithMessage('Gagal menghapus barang.');
        }
    }

    public function searchBarang() {
        $keyword = htmlspecialchars(trim($_GET['keyword'] ?? ''));
        $barangs = $this->modelBarang->searchBarangByName($keyword);
        include './views/inventory_search.php';
    }

    private function redirectToList() {
        header('Location: index.php?modul=inventory&fitur=list');
        exit();
    }

    private function redirectToListWithMessage($message) {
        header('Location: index.php?modul=inventory&fitur=list&message=' . urlencode($message));
        exit();
    }

    public function sortInventory($criteria, $order) {
        if ($criteria == 'name') {
            $barangs = $this->modelBarang->sortInventoryByName($order);
        } elseif ($criteria === 'id') {
            $barangs = $this->modelBarang->sortInventoryById($order);
        } else {
            $barangs = $this->modelBarang->getBarangs();
        }
        include './views/inventory_list.php';
    }
}
