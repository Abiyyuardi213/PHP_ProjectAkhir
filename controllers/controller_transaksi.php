<?php
include './models/model_transaksi.php';
include './models/model_user.php';
include './models/model_barang.php';
include './models/model_detailTransaksi.php';

class ControllerTransaksi {
    private $transaksiModel;
    private $userModel;
    private $barangModel;
    private $detailModel;

    public function __construct($conn) {
        $this->transaksiModel = new TransactionModel($conn);
        $this->userModel = new UserModel();
        $this->barangModel = new ModelBarang($conn);
        $this->detailModel = new DetailTransaksiModel($conn);
    }

    public function handleRequestTransaksi($fitur) {
        switch ($fitur) {
            case 'list':
                include 'views/transaksi_list.php';
                break;
            
            case 'add':
                $this->createTransaksi();
                break;
            
            case 'detail':
                $transaksi_id = $_GET['id'] ?? null;
                if ($transaksi_id) {
                    $this->viewDetails($transaksi_id);
                } else {
                    echo "Transaction ID not found.";
                }
                break;
            
            default:
                echo "Fitur tidak ditemukan";
                break;
        }
    }

    public function listTransaksi() {
        $transactions = $this->transaksiModel->getTransactions();
        var_dump($transactions);
        include './views/transaksi_list.php';
    }

    public function viewDetails($transaksi_id) {
        $transaction = $this->transaksiModel->getTransactionById($transaksi_id);
    
        if (!$transaction) {
            echo "Data transaksi tidak ditemukan.";
            return;
        }
    
        $details = $this->detailModel->getDetailByTransaksiId($transaksi_id);
    
        if (!$details) {
            echo "Detail transaksi tidak ditemukan.";
            return;
        }
    
        $transaction['item_detail'] = $details;
        include './views/transaksi_detail.php';
    }

    public function createTransaksi() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
            $transaksi_status = isset($_POST['transaksi_status']) ? intval($_POST['transaksi_status']) : null;
            $item_detail_json = isset($_POST['item_detail']) ? trim($_POST['item_detail']) : null;

            if (!$user_id || !$transaksi_status || !$item_detail_json) {
                echo "Semua data wajib diisi.";
                include './views/transaksi_add.php';
                return;
            }
    
            $item_detail = json_decode($item_detail_json, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo "Format item_detail tidak valid.";
                include './views/transaksi_add.php';
                return;
            }
    
            if (!is_array($item_detail)) {
                echo "Item detail harus berupa array yang valid.";
                include './views/transaksi_add.php';
                return;
            }
    
            foreach ($item_detail as $detail) {
                if (!isset($detail['id_barang']) || !is_numeric($detail['id_barang'])) {
                    echo "ID Barang tidak valid.";
                    include './views/transaksi_add.php';
                    return;
                }
                if (!isset($detail['quantity']) || !is_numeric($detail['quantity']) || $detail['quantity'] <= 0) {
                    echo "Jumlah barang harus valid dan lebih dari 0.";
                    include './views/transaksi_add.php';
                    return;
                }
                if (!isset($detail['price_barang']) || !is_numeric($detail['price_barang']) || $detail['price_barang'] <= 0) {
                    echo "Harga barang harus valid dan lebih dari 0.";
                    include './views/transaksi_add.php';
                    return;
                }
            }
    
            $transaksi_id = $this->transaksiModel->addTransaksi($user_id, $transaksi_status, $item_detail);
            
            if ($transaksi_id) {
                foreach ($item_detail as $detail) {
                    $this->detailModel->addDetailTransaksi($transaksi_id, $detail['id_barang'], $detail['quantity'], $detail['price_barang']);
                }
                header('Location: index.php?modul=transaksi&fitur=list');
                exit();
            } else {
                echo "Gagal menambah transaksi.";
                include './views/transaksi_add.php';
            }
        } else {
            include './views/transaksi_add.php';
        }
    }

    public function getTransactionDetails($transaksi_id) {
        return $this->transaksiModel->getTransactionById($transaksi_id);
    }
}
