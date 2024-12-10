<?php
include './models/model_customer.php';
include './config/db_connect.php';

// Menampilkan semua error (untuk debugging)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inisialisasi model
$model = new CustomerService($conn);

try {
    // 1. Tambahkan customer baru
    $newCustomerId = $model->createCustomer(
        'john_doe', 
        'password123', 
        'johndoe@example.com', 
        'John Doe', 
        '081234567890', 
        '123 Main Street', 
    );
    echo "Customer berhasil ditambahkan dengan ID: " . htmlspecialchars($newCustomerId) . "<br>";

    // 2. Ambil semua data customer
    $allCustomers = $model->getAllCustomers();
    echo "<h3>Daftar Customer:</h3><pre>";
    print_r($allCustomers);
    echo "</pre>";

    // 3. Ambil detail customer berdasarkan ID
    $customerDetails = $model->getCustomerById($newCustomerId);
    echo "<h3>Detail Customer:</h3><pre>";
    print_r($customerDetails);
    echo "</pre>";

} catch (Exception $e) {
    // Tampilkan pesan error untuk debugging
    echo "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
}
?>
