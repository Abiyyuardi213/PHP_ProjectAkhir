<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Role</title>
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
        <div class="mt-4 p-6 flex-1 mt-16"> <!-- Menambahkan mt-16 untuk memberi ruang atas -->
            <h1 class="text-3xl font-semibold text-gray-900 mb-8">Manage Role</h1>

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
                <input type="hidden" name="modul" value="role">
                <input type="hidden" name="fitur" value="list">
                <div class="flex items-center px-4">
                    <span class="material-icons-outlined text-gray-400">search</span>
                </div>
                <input type="text" name="search" placeholder="Search role..." value="<?= htmlspecialchars($searchTerm ?? '') ?>"
                    class="flex-grow py-2 px-4 border-0 focus:ring-0 focus:outline-none text-gray-700 placeholder-gray-400">
                <button type="submit" class="bg-blue-500 px-4 py-2 text-white rounded-full hover:bg-blue-600 transition duration-300 ease-in-out">
                    Search
                </button>
            </form>

            <!-- Tombol Create Role -->
            <div class="flex justify-between items-center mb-6">
                <!-- Dropdown Sort -->
                <div class="relative inline-block text-left">
                    <button id="sortButton" class="flex items-center bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow hover:from-gray-300 hover:to-gray-400 transition">
                        <span class="material-icons-outlined mr-2">sort</span>
                        <span>Sort</span>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="sortMenu" class="hidden absolute mt-2 w-48 rounded-lg bg-white shadow-lg z-10">
                        <a href="index.php?modul=role&fitur=sortByName&order=ASC" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Sort by Name (ASC)
                        </a>
                        <a href="index.php?modul=role&fitur=sortByName&order=DESC" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Sort by Name (DESC)
                        </a>
                        <a href="index.php?modul=role&fitur=sortById&order=ASC" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Sort by ID (ASC)
                        </a>
                        <a href="index.php?modul=role&fitur=sortById&order=DESC" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Sort by ID (DESC)
                        </a>
                    </div>
                </div>

                <!-- Tombol Create Role -->
                <a href="index.php?modul=role&fitur=create" 
                    class="flex items-center bg-gradient-to-r from-blue-500 to-blue-600 text-white px-5 py-3 rounded-lg shadow hover:from-blue-600 hover:to-blue-700 transition">
                    <span class="material-icons-outlined mr-2">add</span>
                    <span>Create Role</span>
                </a>
            </div>

            <!-- Tabel Role -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-blue-700">
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Role ID</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Role Name</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Description</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Salary</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Status</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php if (!empty($roles)) : ?>
                        <?php foreach ($roles as $role) : ?>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= htmlspecialchars($role['role_id']) ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= htmlspecialchars($role['role_name']) ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= htmlspecialchars($role['role_description']) ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    Rp <?= number_format((int)$role['role_salary'], 0, ',', '.') ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center 
                                    <?= $role['role_status'] ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' ?>">
                                    <?= $role['role_status'] ? 'Active' : 'Inactive' ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center">
                                    <a href="index.php?modul=role&fitur=update&id=<?= $role['role_id'] ?>" 
                                    class="inline-flex items-center px-2 py-1 text-sm text-yellow-500 bg-yellow-100 rounded hover:bg-yellow-200 transition">
                                        <span class="material-icons-outlined mr-1">edit</span>
                                    </a>
                                    <a href="index.php?modul=role&fitur=delete&id=<?= $role['role_id'] ?>" 
                                    class="inline-flex items-center px-2 py-1 text-sm text-red-500 bg-red-100 rounded hover:bg-red-200 transition ml-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                        <span class="material-icons-outlined mr-1">delete</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                    <tr>
                        <td colspan="6" class="py-4 px-4 text-center text-gray-500">
                            <?php if (!empty($searchTerm)) : ?>
                                No roles found matching "<?= htmlspecialchars($searchTerm) ?>".
                            <?php else : ?>
                                No roles available.
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

    document.getElementById('sortButton').addEventListener('click', function() {
        const menu = document.getElementById('sortMenu');
        menu.classList.toggle('hidden');
    });

    // Menutup dropdown jika klik di luar
    window.addEventListener('click', function(e) {
        const menu = document.getElementById('sortMenu');
        const button = document.getElementById('sortButton');
        if (!button.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
  </script>
</body>
</html>
