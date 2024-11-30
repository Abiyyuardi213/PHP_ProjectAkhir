<?php
$barang_id = $_GET['id'] ?? null;

if ($barang_id) {
    $barang = $this->model->getBarangById($barang_id);
    if (!$barang) {
        $error = "Barang tidak ditemukan.";
    }
} else {
    header('Location: index.php?modul=inventory&fitur=list');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-6 ml-64">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Update Inventory</h1>

            <?php if (isset($error)) : ?>
                <div class="bg-red-500 text-white p-4 mb-4 rounded-md">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (!isset($error)) : ?>
            <form action="index.php?modul=inventory&fitur=update&id=<?= htmlspecialchars($barang['barang_id']) ?>" method="POST" class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
                <div class="mb-4">
                    <label for="barang_name" class="block text-gray-700">Nama Barang</label>
                    <input type="text" id="barang_name" name="barang_name" value="<?= htmlspecialchars($barang['barang_name']) ?>" required class="w-full p-3 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700">Kuantitas</label>
                    <input type="number" id="barang_quantity" name="barang_quantity" value="<?= htmlspecialchars($barang['barang_quantity']) ?>" required class="w-full p-3 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700">Harga</label>
                    <input type="number" id="barang_price" name="barang_price" value="<?= htmlspecialchars($barang['barang_price']) ?>" required class="w-full p-3 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="supplier" class="block text-gray-700">Supplier</label>
                    <input type="text" id="barang_supplier" name="barang_supplier" value="<?= htmlspecialchars($barang['barang_supplier']) ?>" required class="w-full p-3 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="barang_status" class="block text-gray-700">Status</label>
                    <select id="barang_status" name="barang_status" required class="w-full p-3 border border-gray-300 rounded-md">
                        <option value="1" <?= $barang['barang_status'] == 1 ? 'selected' : '' ?>>Available</option>
                        <option value="0" <?= $barang['barang_status'] == 0 ? 'selected' : '' ?>>Out of Stock</option>
                    </select>
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">Perbarui Barang</button>
                    <a href="index.php?modul=inventory&fitur=list" class="bg-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-400">
                        Back to Inventory List
                    </a>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
