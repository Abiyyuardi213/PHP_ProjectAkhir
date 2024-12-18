<?php
include 'models/model_role.php';
include 'models/model_user.php';
include 'models/model_barang.php';
include 'models/model_transaksi.php';

$modelRole = new ModelRole();
$roles = $modelRole->getRoles();
$roleCount = count($roles);

$modelUser = new UserModel();
$users = $modelUser->getUsers();
$userCount = count($users);

$modelBarang = new ModelBarang($conn);
$barangs = $modelBarang->getBarangs();
$barangCount = count($barangs);

$modelTransaction = new TransactionModel($conn);
$transactions = $modelTransaction->getTransactions();
$transactionCount = count($transactions);
?>
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
            <main class="mt-4 px-6 py-4">
                <h1 class="text-3xl font-semibold mb-6">Dashboard</h1>

                <!-- Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <!-- Card: Total Roles -->
                    <div class="bg-blue-600 text-white p-6 rounded-none shadow-lg hover:scale-105 transform transition duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="material-icons-outlined text-4xl">badge</span>
                                <div class="ml-4">
                                    <h4 class="text-xl font-bold"><?= $roleCount; ?></h4>
                                    <p>Total Roles</p>
                                </div>
                            </div>
                            <a href="index.php?modul=role&fitur=list" class="bg-white text-blue-500 px-4 py-2 rounded-full font-semibold shadow-md hover:bg-gray-100 transition">
                                More Info
                            </a>
                        </div>
                    </div>

                    <!-- Card: Total Users -->
                    <div class="bg-green-700 text-white p-6 rounded-none shadow-lg hover:scale-105 transform transition duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="material-icons-outlined text-4xl">people</span>
                                <div class="ml-4">
                                    <h4 class="text-xl font-bold"><?= $userCount; ?></h4>
                                    <p>Total Users</p>
                                </div>
                            </div>
                            <a href="index.php?modul=user&fitur=list" class="bg-white text-green-500 px-4 py-2 rounded-full font-semibold shadow-md hover:bg-gray-100 transition">
                                More Info
                            </a>
                        </div>
                    </div>

                    <div class="bg-yellow-500 text-white p-6 rounded-none shadow-lg hover:scale-105 transform transition duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="material-icons-outlined text-4xl">inventory_2</span>
                                <div class="ml-4">
                                    <h4 class="text-xl font-bold"><?= $barangCount; ?></h4>
                                    <p>Inventories</p>
                                </div>
                            </div>
                            <a href="index.php?modul=inventory&fitur=list" class="bg-white text-yellow-500 px-4 py-2 rounded-full font-semibold shadow-md hover:bg-gray-100 transition">
                                More Info
                            </a>
                        </div>
                    </div>

                    <div class="bg-red-600 text-white p-6 rounded-none shadow-lg hover:scale-105 transform transition duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="material-icons-outlined text-4xl">shopping_cart</span>
                                <div class="ml-4">
                                    <h4 class="text-xl font-bold"><?= $transactionCount; ?></h4>
                                    <p>Transactions</p>
                                </div>
                            </div>
                            <a href="index.php?modul=transactions&fitur=list" class="bg-white text-red-500 px-4 py-2 rounded-full font-semibold shadow-md hover:bg-gray-100 transition">
                                More Info
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
