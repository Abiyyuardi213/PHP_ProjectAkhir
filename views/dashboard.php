<?php
include 'models/model_role.php';
$modelRole = new ModelRole();
$roles = $modelRole->getRoles();
$roleCount = count($roles); // Hitung jumlah role
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@heroicons/react@1.0.6/solid" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 flex flex-col">
    <?php include 'includes/navbar.php'; ?>
    <div class="flex flex-grow">
        <?php include 'includes/sidebar.php'; ?>
        <!-- Konten Utama -->
        <div class="p-6 flex-1">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>
            <!-- Card Jumlah Role -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Terkini</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-6">
                <a href="index.php?modul=role" class="block p-4 bg-purple-500 shadow-md rounded-lg hover:bg-purple-600 transition">
                    <div class="flex items-center space-x-4">
                        <!-- Icon -->
                        <div class="p-2 bg-purple-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 10a6 6 0 100 12h4a6 6 0 100-12H8zm2 6a2 2 0 11-4 0 2 2 0 014 0zm4-6a2 2 0 11-4 0 2 2 0 014 0zm0 2a6 6 0 100 12H8a6 6 0 100-12h4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <!-- Info -->
                        <div>
                            <h2 class="text-lg font-medium text-white">Jumlah Role</h2>
                            <p class="text-sm text-white"><?php echo $roleCount; ?> Role Tersedia</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card Menu -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Kelola Menu</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Card Role -->
                <a href="index.php?modul=role" class="block p-4 bg-green-500 shadow-md rounded-lg hover:bg-green-600 transition">
                    <div class="flex items-center space-x-4">
                        <!-- Icon -->
                        <div class="p-2 bg-blue-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 10a6 6 0 100 12h4a6 6 0 100-12H8zm2 6a2 2 0 11-4 0 2 2 0 014 0zm4-6a2 2 0 11-4 0 2 2 0 014 0zm0 2a6 6 0 100 12H8a6 6 0 100-12h4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <!-- Info -->
                        <div>
                            <h2 class="text-lg font-medium text-white">Manage Role</h2>
                            <p class="text-sm text-white">Kelola peran pengguna</p>
                        </div>
                    </div>
                </a>
                <!-- Tambahkan card lainnya di sini jika diperlukan -->
                <!-- Card User -->
                <a href="index.php?modul=user" class="block p-4 bg-white shadow-md rounded-lg hover:bg-blue-50 transition">
                    <div class="flex items-center space-x-4">
                        <!-- Icon -->
                        <div class="p-2 bg-green-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 12a6 6 0 10-12 0 6 6 0 0012 0zM5 6a3 3 0 116 0 3 3 0 01-6 0zM5 10a6 6 0 100 12 6 6 0 000-12z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <!-- Info -->
                        <div>
                            <h2 class="text-lg font-medium text-gray-700">Manage User</h2>
                            <p class="text-sm text-gray-500">Kelola pengguna sistem</p>
                        </div>
                    </div>
                </a>
                <a href="index.php?modul=barang" class="block p-4 bg-white shadow-md rounded-lg hover:bg-blue-50 transition">
                    <div class="flex items-center space-x-4">
                        <!-- Icon -->
                        <div class="p-2 bg-yellow-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4h12a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V5a1 1 0 011-1zM4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <!-- Info -->
                        <div>
                            <h2 class="text-lg font-medium text-gray-700">Manage Inventory</h2>
                            <p class="text-sm text-gray-500">Kelola produk dan barang</p>
                        </div>
                    </div>
                </a>
                <a href="index.php?modul=transaksi" class="block p-4 bg-white shadow-md rounded-lg hover:bg-blue-50 transition">
                    <div class="flex items-center space-x-4">
                        <!-- Icon -->
                        <div class="p-2 bg-red-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a7 7 0 017 7v5a7 7 0 01-7 7H7a7 7 0 01-7-7V10a7 7 0 017-7h3zM10 4H7a6 6 0 00-6 6v5a6 6 0 006 6h6a6 6 0 006-6V10a6 6 0 00-6-6h-3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <!-- Info -->
                        <div>
                            <h2 class="text-lg font-medium text-gray-700">Manage Transactions</h2>
                            <p class="text-sm text-gray-500">Kelola transaksi</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
