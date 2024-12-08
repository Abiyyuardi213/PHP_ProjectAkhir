<?php
include './models/model_transaksi.php';
include './config/db_connect.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$model = new TransactionModel($conn);

// Data untuk pengujian
$user_id = 1;
$transaksi_status = 1; // Contoh: 1 untuk transaksi selesai
$items = [
    ['id_barang' => 3, 'quantity' => 1],
    ['id_barang' => 5, 'quantity' => 2]
];

try {
    // Tambahkan transaksi baru
    $newTransactionId = $model->createTransaksi($user_id, $items, $transaksi_status);
    echo "Transaksi berhasil ditambahkan dengan ID: " . $newTransactionId . "<br>";

    // Ambil detail transaksi
    $details = $model->getTransactionById($newTransactionId);
    echo "<pre>";
    print_r($details);
    echo "</pre>";
} catch (Exception $e) {
    echo "Gagal menambahkan transaksi: " . $e->getMessage(); // Detail untuk debugging
}
?>
