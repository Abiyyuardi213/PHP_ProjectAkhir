<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Inventory</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex flex-grow">
        <!-- Konten Utama -->
        <div class="p-6 flex-1">
            <h1 class="text-2xl text-gray-800 mb-6">Add Inventory</h1>

            <!-- Form Add Inventory -->
            <div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
                <!-- Area untuk menampilkan pesan error -->
                <?php if (!empty($errorMessage)) : ?>
                    <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
                        <?= htmlspecialchars($errorMessage) ?>
                    </div>
                <?php endif; ?>

                <form action="index.php?modul=inventory&fitur=create" method="POST" class="space-y-4">
                    <!-- Nama Barang -->
                    <div>
                        <label for="barang_name" class="block text-gray-700 font-medium">Inventory Name</label>
                        <input type="text" id="barang_name" name="barang_name" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Enter inventory name" 
                            value="<?= htmlspecialchars($barang_name ?? '') ?>" required>
                    </div>

                    <!-- Jumlah Barang -->
                    <div>
                        <label for="barang_quantity" class="block text-gray-700 font-medium">Quantity</label>
                        <input type="number" id="barang_quantity" name="barang_quantity" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Enter quantity" min="0" 
                            value="<?= htmlspecialchars($barang_quantity ?? '0') ?>" required>
                    </div>

                    <!-- Harga Barang -->
                    <div>
                        <label for="barang_price" class="block text-gray-700 font-medium">Price</label>
                        <input type="number" id="barang_price" name="barang_price" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Enter price" min="0" 
                            value="<?= htmlspecialchars($barang_price ?? '0.00') ?>" required>
                    </div>

                    <!-- Supplier -->
                    <div>
                        <label for="barang_supplier" class="block text-gray-700 font-medium">Supplier</label>
                        <input type="text" id="barang_supplier" name="barang_supplier" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Enter supplier name" 
                            value="<?= htmlspecialchars($barang_supplier ?? 'Unknown') ?>" required>
                    </div>

                    <!-- Status Barang -->
                    <div>
                        <label for="barang_status" class="block text-gray-700 font-medium">Status</label>
                        <select id="barang_status" name="barang_status" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="1" <?= (isset($barang_status) && $barang_status == 1) ? 'selected' : '' ?>>Available</option>
                            <option value="0" <?= (isset($barang_status) && $barang_status == 0) ? 'selected' : '' ?>>Out of Stock</option>
                        </select>
                    </div>

                    <!-- Tombol Submit dan Cancel -->
                    <div class="flex justify-end space-x-4">
                        <a href="index.php?modul=inventory" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Save Inventory
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</body>
</html>
