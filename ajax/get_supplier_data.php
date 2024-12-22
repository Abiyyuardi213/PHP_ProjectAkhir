<?php
// Pastikan koneksi ke database sudah ada
include 'config/db_connect.php';

if (!$conn) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

if (isset($_GET['supplier_id'])) {
    $supplier_id = intval($_GET['supplier_id']);

    // Ambil data supplier berdasarkan supplier_id
    $sql = "SELECT supplier_phone, supplier_email FROM tb_supplier WHERE supplier_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $supplier_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika data ditemukan, kirimkan sebagai response JSON
    if ($result && $row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>
