<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="ml-64 flex flex-col flex-grow">
        <!-- Content -->
        <div class="mt-4 p-6 flex-1 mt-16">
            <h1 class="text-3xl font-semibold text-gray-900 mb-8">Manage Supplier</h1>

            <?php if (isset($_GET['message'])) : ?>
                <div id="notification" class="flex items-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 shadow-lg">
                    <span class="material-icons-outlined mr-2">check_circle</span>
                    <span><?= htmlspecialchars($_GET['message']) ?></span>
                </div>
            <?php elseif (isset($_GET['error'])) : ?>
                <div id="notification" class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 shadow-lg">
                    <span class="material-icons-outlined mr-2">error</span>
                    <span><?= htmlspecialchars($_GET['error']) ?></span>
                </div>
            <?php endif; ?>

            <!-- Form Pencarian -->
            <form action="index.php" method="get" class="flex items-center bg-white shadow-lg rounded-full overflow-hidden mb-6 w-full max-w-lg mx-auto">
                <input type="hidden" name="modul" value="supplier">
                <input type="hidden" name="fitur" value="list">
                <div class="flex items-center px-4">
                    <span class="material-icons-outlined text-gray-400">search</span>
                </div>
                <input type="text" name="search" placeholder="Search supplier..." value="<?= htmlspecialchars($searchTerm ?? '') ?>"
                    class="flex-grow py-2 px-4 border-0 focus:ring-0 focus:outline-none text-gray-700 placeholder-gray-400">
                <button type="submit" class="bg-blue-500 px-4 py-2 text-white rounded-full hover:bg-blue-600 transition duration-300 ease-in-out">
                    Search
                </button>
            </form>

            <!-- Tombol Create Supplier -->
            <div class="flex justify-between items-center mb-6">
                <a href="index.php?modul=supplier&fitur=create" 
                    class="flex items-center bg-gradient-to-r from-blue-500 to-blue-600 text-white px-5 py-3 rounded-lg shadow hover:from-blue-600 hover:to-blue-700 transition">
                    <span class="material-icons-outlined mr-2">add</span>
                    <span>Create Supplier</span>
                </a>
            </div>

            <!-- Tabel Supplier -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-blue-700">
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Supplier ID</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Name</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Address</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Phone</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Email</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php if (!empty($suppliers)) : ?>
                        <?php foreach ($suppliers as $supplier) : ?>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= htmlspecialchars($supplier['supplier_id']) ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= htmlspecialchars($supplier['supplier_name']) ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= htmlspecialchars($supplier['supplier_address']) ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= htmlspecialchars($supplier['supplier_phone']) ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= htmlspecialchars($supplier['supplier_email']) ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center">
                                    <a href="index.php?modul=supplier&fitur=update&id=<?= $supplier['supplier_id'] ?>" 
                                    class="inline-flex items-center px-2 py-1 text-sm text-yellow-500 bg-yellow-100 rounded hover:bg-yellow-200 transition">
                                        <span class="material-icons-outlined mr-1">edit</span>
                                    </a>
                                    <a href="index.php?modul=supplier&fitur=delete&id=<?= $supplier['supplier_id'] ?>" 
                                    class="inline-flex items-center px-2 py-1 text-sm text-red-500 bg-red-100 rounded hover:bg-red-200 transition ml-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')">
                                        <span class="material-icons-outlined mr-1">delete</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                    <tr>
                        <td colspan="6" class="py-4 px-4 text-center text-gray-500">
                            <?php if (!empty($searchTerm)) : ?>
                                No suppliers found matching "<?= htmlspecialchars($searchTerm) ?>".
                            <?php else : ?>
                                No suppliers available.
                            <?php endif; ?>
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
        notification.style.display = 'none';
      }
    }, 3000);
  </script>
</body>
</html>
