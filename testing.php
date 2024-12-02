<?php
include './models/model_detailTransaksi.php';
include './config/db_connect.php';

$model = new DetailTransaksiModel($conn);

$transaksi_id = 1;
$id_barang = 2;
$quantity = 3;
$price_barang = 13450000.00;

$newDetailId = $model->addDetailTransaksi($transaksi_id, $id_barang, $quantity, $price_barang);
if ($newDetailId == 0) {
    echo "Failed to add detail transaksi!";
} else {
    echo "Detail transaksi berhasil ditambahkan dengan ID: " . $newDetailId;
}

$details = $model->getDetailByTransaksiId($transaksi_id);
echo "<pre>";
print_r($details);
echo "</pre>";
?>
