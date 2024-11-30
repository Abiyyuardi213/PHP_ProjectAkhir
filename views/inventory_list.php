<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory List</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="ml-64 flex flex-col flex-grow">
        <!-- Navbar -->
        <?php include 'includes/navbar.php'; ?>

        <!-- Content -->
        <div class="p-6 flex-1 mt-16"> <!-- Menambahkan mt-16 untuk memberi ruang atas -->
            <h1 class="text-3xl font-semibold text-gray-900 mb-8">Manage Inventory</h1>

            <!-- Tombol Add Inventory -->
            <div class="flex justify-end mb-4">
                <a href="index.php?modul=inventory&fitur=create" 
                class="flex items-center bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 shadow-lg transition duration-300">
                    <span class="material-icons-outlined mr-2">add</span>
                    Add Inventory
                </a>
            </div>

            <!-- Tabel Inventory -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead class="bg-blue-700">
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Inventory ID</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Inventory Name</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Quantity</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Price</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Supplier</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Status</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Created At</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($barangs)) : ?>
                            <?php foreach ($barangs as $barang) : ?>
                                <tr class="even:bg-gray-50 hover:bg-blue-100">
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                        <?= htmlspecialchars($barang['barang_id'] ?? 'N/A') ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                        <?= htmlspecialchars($barang['barang_name'] ?? 'N/A') ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                        <?= isset($barang['barang_quantity']) ? (int)$barang['barang_quantity'] : 0 ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                        Rp <?= number_format($barang['barang_price'] ?? 0, 0, ',', '.') ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                        <?= htmlspecialchars($barang['barang_supplier'] ?? 'N/A') ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                        <?php if (isset($barang['barang_status']) && $barang['barang_status']) : ?>
                                            <span class="text-green-500 font-semibold">Available</span>
                                        <?php else : ?>
                                            <span class="text-red-500 font-semibold">Out of Stock</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                        <?= htmlspecialchars($barang['create_at'] ?? 'N/A') ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                        <a href="index.php?modul=inventory&fitur=update&id=<?= htmlspecialchars($barang['barang_id'] ?? '') ?>" 
                                        class="inline-flex items-center px-2 py-1 text-sm text-yellow-500 bg-yellow-100 rounded hover:bg-yellow-200 transition">
                                            <span class="material-icons-outlined mr-1">edit</span>
                                        </a>
                                        <a href="index.php?modul=inventory&fitur=delete&id=<?= htmlspecialchars($barang['barang_id'] ?? '') ?>" 
                                        class="inline-flex items-center px-2 py-1 text-sm text-red-500 bg-red-100 rounded hover:bg-red-200 transition ml-2"
                                        onclick="return confirm('Are you sure you want to delete this inventory?')">
                                            <span class="material-icons-outlined mr-1">delete</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8" class="py-4 px-4 text-center text-gray-500">
                                    No Inventory available.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</body>
</html>
