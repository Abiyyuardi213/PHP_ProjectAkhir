<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <?php include './views/includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="ml-64 flex flex-col flex-grow">
        <!-- Header -->
        <header class="bg-blue-700 text-white py-4 px-6 shadow-md">
            <h1 class="text-2xl font-bold flex items-center">
                <span class="material-icons-outlined mr-2">inventory</span>
                Management Inventory
            </h1>
        </header>

        <!-- Content -->
        <div class="mt-4 p-6 flex-1 mt-16">
            <!-- Display Success or Error Message -->
            <?php if (isset($_GET['message'])) : ?>
                <div id="notification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-4 transform transition duration-500 ease-in-out translate-x-full" style="z-index: 9999;">
                    <span class="material-icons-outlined text-xl">check_circle</span>
                    <span><?= htmlspecialchars($_GET['message']) ?></span>
                    <button onclick="document.getElementById('notification').style.display='none'" class="ml-4 text-white hover:text-gray-200">
                        <span class="material-icons-outlined">close</span>
                    </button>
                </div>
            <?php elseif (isset($_GET['error'])) : ?>
                <div id="notification" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-4 transform transition duration-500 ease-in-out translate-x-full" style="z-index: 9999;">
                    <span class="material-icons-outlined text-xl">error</span>
                    <span><?= htmlspecialchars($_GET['error']) ?></span>
                    <button onclick="document.getElementById('notification').style.display='none'" class="ml-4 text-white hover:text-gray-200">
                        <span class="material-icons-outlined">close</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Form Filter -->
            <form action="index.php?modul=inventory&fitur=filter" method="post" class="space-y-6 bg-white shadow-lg rounded-lg p-6 mb-6 w-full max-w-4xl mx-auto">
                <input type="hidden" name="modul" value="inventory">
                <input type="hidden" name="fitur" value="list">

                <!-- Name Filter -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <div class="flex flex-col">
                        <label for="barang_name" class="text-sm text-gray-600 mb-2">Name</label>
                        <input type="text" name="barang_name" id="barang_name" placeholder="Barang Name" value="<?= htmlspecialchars($filters['barang_name'] ?? '') ?>" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300">
                    </div>

                    <!-- Min Price Filter -->
                    <div class="flex flex-col">
                        <label for="min_price" class="text-sm text-gray-600 mb-2">Min Price</label>
                        <input type="number" name="min_price" id="min_price" placeholder="Min Price" value="<?= htmlspecialchars($filters['min_price'] ?? '') ?>" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300">
                    </div>

                    <!-- Max Price Filter -->
                    <div class="flex flex-col">
                        <label for="max_price" class="text-sm text-gray-600 mb-2">Max Price</label>
                        <input type="number" name="max_price" id="max_price" placeholder="Max Price" value="<?= htmlspecialchars($filters['max_price'] ?? '') ?>" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300">
                    </div>
                </div>

                <!-- Quantity Filter and Supplier -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <!-- Min Quantity Filter -->
                    <div class="flex flex-col">
                        <label for="min_quantity" class="text-sm text-gray-600 mb-2">Min Quantity</label>
                        <input type="number" name="min_quantity" id="min_quantity" placeholder="Min Quantity" value="<?= htmlspecialchars($filters['min_quantity'] ?? '') ?>" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300">
                    </div>

                    <!-- Supplier Filter -->
                    <div class="flex flex-col">
                        <label for="supplier_id" class="text-sm text-gray-600 mb-2">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300 select2">
                            <option value="">Select Supplier</option>
                            <?php foreach ($suppliers as $supplier) : ?>
                                <option value="<?= htmlspecialchars($supplier['supplier_id']) ?>" <?= (isset($filters['supplier_id']) && $filters['supplier_id'] == $supplier['supplier_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($supplier['supplier_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Start Date Filter -->
                    <div class="flex flex-col">
                        <label for="start_date" class="text-sm text-gray-600 mb-2">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="<?= htmlspecialchars($filters['start_date'] ?? '') ?>" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300">
                    </div>
                </div>

                <!-- End Date Filter -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label for="end_date" class="text-sm text-gray-600 mb-2 sm:mb-0">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="<?= htmlspecialchars($filters['end_date'] ?? '') ?>" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300">
                    </div>

                    <!-- Apply Filter Button -->
                    <div class="flex justify-start sm:justify-center">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                            Apply Filter
                        </button>
                    </div>

                    <!-- Add Inventory Button -->
                    <div class="flex justify-start sm:justify-center">
                        <a href="index.php?modul=inventory&fitur=create" 
                        class="flex items-center bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition duration-300">
                            <span class="material-icons-outlined mr-2">add</span> Add Inventory
                        </a>
                    </div>

                    <!-- Export PDF Button -->
                    <div class="flex justify-start sm:justify-center">
                        <a href="index.php?modul=inventory&fitur=export_pdf" 
                        class="flex items-center bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600 transition duration-300">
                            <span class="material-icons-outlined mr-2">picture_as_pdf</span> Export to PDF
                        </a>
                    </div>
                </div>
            </form>

            <!-- Tabel Inventory -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead class="bg-blue-700">
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Inventory ID</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Inventory Name</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Supplier Name</th>
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
                                        <?= htmlspecialchars($barang['supplier_name'] ?? 'N/A') ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= !empty($barang['created_at']) ? htmlspecialchars(date('d M Y, H:i', strtotime($barang['created_at']))) : 'N/A' ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                        <a href="index.php?modul=inventory&fitur=detail&id=<?= htmlspecialchars($barang['barang_id'] ?? '') ?>" 
                                            class="inline-flex items-center px-2 py-1 text-sm text-blue-500 bg-blue-100 rounded hover:bg-blue-200 transition"
                                            aria-label="Show Details">
                                            <span class="material-icons-outlined mr-1">visibility</span> Details
                                        </a>
                                        <?php if (in_array($_SESSION['role_name'], ['Super Admin', 'Admin'])) : ?>
                                            <a href="index.php?modul=inventory&fitur=update&id=<?= htmlspecialchars($barang['barang_id'] ?? '') ?>" 
                                            class="inline-flex items-center px-2 py-1 text-sm text-yellow-500 bg-yellow-100 rounded hover:bg-yellow-200 transition ml-2"
                                            aria-label="Edit Inventory">
                                                <span class="material-icons-outlined mr-1">edit</span>
                                            </a>
                                            <a href="index.php?modul=inventory&fitur=delete&id=<?= htmlspecialchars($barang['barang_id'] ?? '') ?>" 
                                            class="inline-flex items-center px-2 py-1 text-sm text-red-500 bg-red-100 rounded hover:bg-red-200 transition ml-2"
                                            onclick="return confirm('Are you sure you want to delete this inventory?')"
                                            aria-label="Delete Inventory">
                                                <span class="material-icons-outlined mr-1">delete</span>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="py-4 px-4 text-center text-gray-500">
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.select2').select2();
    });

    setTimeout(() => {
        const notification = document.getElementById('notification');
        if (notification) {
            notification.classList.remove('translate-x-full');
            notification.classList.add('translate-x-0');
        }
    }, 10);

    setTimeout(() => {
      const notification = document.getElementById('notification');
    }, 3000);
  </script>
</body>
</html>
