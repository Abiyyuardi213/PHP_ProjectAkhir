<?php
include './models/model_barang.php';
include './config/db_connect.php';

$barangs = [
    [
        'invoice_id' => 'INV001',
        'supplier_id' => 1,
        'supplier_phone' => '08123456789',
        'supplier_email' => 'supplier1@example.com',
        'barang_name' => 'Barang A',
        'barang_price' => 10000,
        'barang_quantity' => 5,
        'barang_penerima' => 'John Doe'
    ],
    [
        'invoice_id' => 'INV001',
        'supplier_id' => 1,
        'supplier_phone' => '08123456789',
        'supplier_email' => 'supplier1@example.com',
        'barang_name' => 'Barang B',
        'barang_price' => 20000,
        'barang_quantity' => 10,
        'barang_penerima' => 'John Doe'
    ]
];

try {
    $modelBarang = new ModelBarang($conn);
    $modelBarang->addMultipleBarangs($barangs);
    echo "Barang berhasil ditambahkan.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}