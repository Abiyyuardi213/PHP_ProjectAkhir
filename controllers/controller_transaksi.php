<?php
include './models/model_transaksi.php';
include './models/model_user.php';
include './models/model_barang.php';

class ControllerTransaksi {
    private $transaksiModel;
    private $userModel;
    private $barangModel;

    public function __construct($conn) {
        $this->transaksiModel = new TransactionModel($conn);
        $this->userModel = new UserModel();
        $this->barangModel = new ModelBarang($conn);
    }

    public function handleRequestTransaksi($fitur) {
        switch ($fitur) {
            case 'list':
                $this->listTransaksi();
                break;
            
            case 'create':
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

        $transactionsList = array_map(function($transaction) {
            return [
                'transaksi_id' => $transaction['transaksi_id'],
                'user_name' => $transaction['user_name'],
                'total_amount' => $transaction['total_amount'],
                'transaksi_status' => $transaction['transaksi_status'] == 1 ? 'Success' : 'Pending',
                'transaksi_date' => $transaction['transaksi_date'],
            ];
        }, $transactions);

        include './views/transaksi_list.php';
    }

    public function viewDetails($transaksi_id) {
        $transaction = $this->transaksiModel->getTransactionById($transaksi_id);
    
        if (!$transaction) {
            echo "Data transaksi tidak ditemukan.";
            return;
        }
        include './views/transaksi_detail.php';
    }

    public function createTransaksi() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
            $barang_ids = $_POST['barang_id'] ?? [];
            $barang_quantities = $_POST['quantity'] ?? [];
    
            if (!$user_id) {
                echo "User belum dipilih.";
                include './views/transaksi_add.php';
                return;
            }
    
            if (empty($barang_ids) || count($barang_ids) === 0) {
                echo "Tidak ada barang yang dipilih.";
                include './views/transaksi_add.php';
                return;
            }
    
            foreach ($barang_ids as $index => $barang_id) {
                if (!isset($barang_quantities[$index]) || intval($barang_quantities[$index]) <= 0) {
                    echo "Kuantitas barang tidak valid untuk barang ID: $barang_id.";
                    include './views/transaksi_add.php';
                    return;
                }
            }
    
            $items = [];
            foreach ($barang_ids as $index => $barang_id) {
                $quantity = intval($barang_quantities[$index]);
                $barang = $this->barangModel->getBarangById($barang_id);
    
                if (!$barang) {
                    echo "Barang dengan ID $barang_id tidak ditemukan.";
                    include './views/transaksi_add.php';
                    return;
                }
    
                $items[] = [
                    'id_barang' => intval($barang_id),
                    'quantity' => $quantity,
                ];
            }
    
            try {
                $this->transaksiModel->createTransaksi($user_id, $items, 1);
                header('Location: index.php?modul=transactions&fitur=list');
                exit();
            } catch (Exception $e) {
                echo "Terjadi kesalahan: " . $e->getMessage();
                include './views/transaksi_add.php';
            }
        } else {
            $users = $this->userModel->getAllUsers();
            $barangs = $this->barangModel->getAllBarangs();
            include './views/transaksi_add.php';
        }
    }
}
