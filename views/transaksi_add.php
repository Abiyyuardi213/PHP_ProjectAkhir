<?php
// Menghubungkan dengan file controller
require_once 'controller_transaksi.php';

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $user_id = $_POST['user_id'];
    $transaksi_status = $_POST['transaksi_status'];
    $item_detail = json_encode($_POST['item_detail']); // Encode item detail sebagai JSON

    // Menambahkan transaksi baru melalui controller
    $controllerTransaksi = new ControllerTransaksi($conn);
    $controllerTransaksi->createTransaksi();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0-beta.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold text-center mb-6">Form Tambah Transaksi</h1>

    <form action="transaksi_add.php" method="POST" class="bg-white p-6 rounded shadow-lg">
        <!-- ID Pengguna -->
        <div class="mb-4">
            <label for="user_id" class="block text-sm font-medium text-gray-700">ID Pengguna</label>
            <input type="number" name="user_id" id="user_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <!-- Status Transaksi -->
        <div class="mb-4">
            <label for="transaksi_status" class="block text-sm font-medium text-gray-700">Status Transaksi</label>
            <select name="transaksi_status" id="transaksi_status" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                <option value="0">Pending</option>
                <option value="1">Success</option>
            </select>
        </div>

        <!-- Rincian Barang -->
        <div class="mb-4">
            <label for="item_detail" class="block text-sm font-medium text-gray-700">Rincian Barang</label>
            <div class="space-y-4">
                <div class="item-entry">
                    <div class="flex space-x-4">
                        <input type="number" name="item_detail[][id_barang]" placeholder="ID Barang" class="border border-gray-300 rounded-md p-2 w-1/4" required>
                        <input type="number" name="item_detail[][quantity]" placeholder="Jumlah" class="border border-gray-300 rounded-md p-2 w-1/4" required>
                        <input type="number" name="item_detail[][price_barang]" placeholder="Harga Barang" class="border border-gray-300 rounded-md p-2 w-1/4" required>
                    </div>
                </div>
            </div>
            <button type="button" onclick="addItemField()" class="mt-2 text-blue-600">Tambah Item</button>
        </div>

        <!-- Tombol Submit -->
        <div class="mb-4">
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md">Tambah Transaksi</button>
        </div>
    </form>
</div>

<script>
    // Menambahkan input field baru untuk rincian barang
    function addItemField() {
        const itemEntry = document.querySelector('.item-entry');
        const newItem = itemEntry.cloneNode(true);
        const fields = newItem.querySelectorAll('input');
        
        // Resetkan nilai input
        fields.forEach(field => field.value = '');
        
        document.querySelector('.space-y-4').appendChild(newItem);
    }
</script>

</body>
</html>