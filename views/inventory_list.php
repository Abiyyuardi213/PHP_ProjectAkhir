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
                    </but>
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

            <!-- Form Pencarian -->
            <form action="index.php" method="get" class="flex items-center bg-white shadow-lg rounded-full overflow-hidden mb-6 w-full max-w-lg mx-auto">
                <input type="hidden" name="modul" value="inventory">
                <input type="hidden" name="fitur" value="list">
                <div class="flex items-center px-4">
                    <span class="material-icons-outlined text-gray-400">search</span>
                </div>
                <input type="text" name="search" placeholder="Search inventory..." value="<?= htmlspecialchars($searchTerm ?? '') ?>"
                    class="flex-grow py-2 px-4 border-0 focus:ring-0 focus:outline-none text-gray-700 placeholder-gray-400">
                <button type="submit" class="bg-blue-500 px-4 py-2 text-white rounded-full hover:bg-blue-600 transition duration-300 ease-in-out">
                    Search
                </button>
            </form>

            <!-- Tombol Add Inventory -->
            <div class="flex justify-between items-center mb-6">
                <a href="index.php?modul=inventory&fitur=create" 
                   class="flex items-center bg-gradient-to-r from-blue-500 to-blue-600 text-white px-5 py-3 rounded-lg shadow hover:from-blue-600 hover:to-blue-700 transition"
                   aria-label="Add Inventory">
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
    setTimeout(() => {
        const notification = document.getElementById('notification');
        if (notification) {
            notification.classList.remove('translate-x-full');
            notification.classList.add('translate-x-0');
        }
    }, 10);

    setTimeout(() => {
      const notification = document.getElementById('notification');
      if (notification) {
        notification.style.display = 'none';
      }
    }, 3000);
  </script>
</body>
</html>
