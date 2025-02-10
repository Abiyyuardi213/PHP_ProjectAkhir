<?php
include 'models/model_role.php';
include 'models/model_user.php';
include 'models/model_barang.php';
include 'models/model_transaksi.php';
include 'models/model_supplier.php';

$modelRole = new ModelRole();
$roles = $modelRole->getRoles();
$roleCount = count($roles);

$modelUser = new UserModel();
$users = $modelUser->getUsers();
$userCount = count($users);

$modelBarang = new ModelBarang($conn);
$barangs = $modelBarang->getBarangs();
$barangCount = count($barangs);
$availableBarangs = $modelBarang->getAvailableBarangs();

$modelTransaction = new TransactionModel($conn);
$transactions = $modelTransaction->getTransactions();
$transactionCount = count($transactions);
$recentTransactions = $modelTransaction->getRecentTransactions();

$modelSupplier = new ModelSupplier($conn);
$suppliers = $modelSupplier->getSuppliers();
$supplierCount = count($suppliers);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex flex-col flex-grow transition-all duration-300 ml-0 md:ml-64">
            <!-- Header -->
            <header class="bg-blue-700 text-white py-4 px-6 shadow-md flex justify-between items-center">
                <h1 class="text-2xl font-bold flex items-center">
                    <span class="material-icons-outlined mr-2">dashboard</span>
                    Dashboard
                </h1>
                <button id="sidebarToggle" class="md:hidden bg-blue-600 text-white p-2 rounded-full shadow-lg">
                    <span class="material-icons">menu</span>
                </button>
            </header>

            <!-- Content -->
            <main class="mt-4 px-6 py-4">
                <h1 class="text-3xl font-semibold mb-6">Your's Management Information</h1>

                <!-- Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <!-- Card: Total Roles (Visible only to Admin and Super Admin) -->
                    <?php if (in_array($_SESSION['role_name'], ['Super Admin'])) { ?>
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
                    <?php } ?>

                    <!-- Card: Total Users (Visible only to Admin and Super Admin) -->
                    <?php if (in_array($_SESSION['role_name'], ['Admin', 'Super Admin'])) { ?>
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
                    <?php } ?>

                    <!-- Card: Inventories -->
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

                    <!-- Card: Transactions -->
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

                    <!-- Card: Transactions -->
                    <div class="bg-pink-600 text-white p-6 rounded-none shadow-lg hover:scale-105 transform transition duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="material-icons-outlined text-4xl">local_shipping</span>
                                <div class="ml-4">
                                    <h4 class="text-xl font-bold"><?= $supplierCount; ?></h4>
                                    <p>Suppliers</p>
                                </div>
                            </div>
                            <a href="index.php?modul=supplier&fitur=list" class="bg-white text-red-500 px-4 py-2 rounded-full font-semibold shadow-md hover:bg-gray-100 transition">
                                More Info
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
                    <!-- Pie Chart -->
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-bold mb-4">User Distribution</h2>
                        <canvas id="pieChart"></canvas>
                    </div>

                    <!-- Bar Chart -->
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-bold mb-4">Monthly Transactions</h2>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                <!-- Recent Transactions Table -->
                <div class="bg-white p-6 rounded-lg shadow-lg mt-8">
                    <h2 class="text-xl font-bold mb-4">Recent Transactions</h2>
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Transaction ID</th>
                                <th class="border border-gray-300 px-4 py-2">Date</th>
                                <th class="border border-gray-300 px-4 py-2">User</th>
                                <th class="border border-gray-300 px-4 py-2">Total Amount</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentTransactions as $transaction) { ?>
                            <tr>
                                <td class="border border-gray-300 text-center px-4 py-2"><?= $transaction['transaksi_id']; ?></td>
                                <td class="border border-gray-300 text-center px-4 py-2"><?= $transaction['transaksi_date']; ?></td>
                                <td class="border border-gray-300 text-center px-4 py-2"><?= $transaction['user_name']; ?></td>
                                <td class="border border-gray-300 text-center px-4 py-2">Rp<?= number_format($transaction['total_amount'], 2); ?></td>
                                <td class="border border-gray-300 text-center px-4 py-2">
                                    <?= $transaction['transaksi_status'] == 1 ? 'Success' : 'Pending'; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Data for Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Admins', 'User', 'Inventory', 'Transaction', 'Supplier'],
                datasets: [{
                    data: [<?= $roleCount; ?>, <?= $userCount; ?>, <?= $barangCount; ?>, <?= $transactionCount; ?>, <?= $supplierCount; ?>],
                    backgroundColor: ['#2563eb', '#16a34a', '#f59e0b', '#dc2626', '#db2777'],
                }],
            },
        });

        // Data for Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Transactions',
                    data: [12, 19, 3, 5, 2, 3], // Replace with dynamic PHP data if available
                    backgroundColor: '#FF5722',
                }],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>
</html>
