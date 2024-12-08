<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction List</title>
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
        <div class="p-6 flex-1 mt-16">
            <h1 class="text-3xl font-semibold text-gray-900 mb-8">Manage Transactions</h1>

            <div class="flex justify-end mb-4">
                <a href="index.php?modul=transactions&fitur=create" 
                class="flex items-center bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 shadow-lg transition duration-300">
                    <span class="material-icons-outlined mr-2">add</span>
                    Add Transaction
                </a>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead class="bg-blue-700">
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Transaction ID</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">User</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Total Amount</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Status</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Date</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transactions)) : ?>
                            <?php foreach ($transactions as $transaction) : ?>
                                <tr class="even:bg-gray-50 hover:bg-blue-100">
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                        <?= htmlspecialchars($transaction['transaksi_id'] ?? 'N/A') ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                        <?= htmlspecialchars($transaction['user_name'] ?? 'Unknown User') ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                        Rp <?= number_format($transaction['total_amount'] ?? 0, 0, ',', '.') ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                        <?php
                                            // Ubah nilai transaksi_status menjadi teks
                                            $statusText = $transaction['transaksi_status'] == 1 ? 'Success' : 'Pending';
                                        ?>
                                        <span class="px-2 py-1 rounded-full text-sm <?= $transaction['transaksi_status'] == 1 ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' ?>">
                                            <?= htmlspecialchars($statusText) ?>
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                        <?= htmlspecialchars($transaction['transaksi_date'] ?? 'N/A') ?>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                        <a href="index.php?modul=transactions&fitur=detail&id=<?= htmlspecialchars($transaction['transaksi_id']) ?>" 
                                        class="inline-flex items-center px-2 py-1 text-sm text-blue-500 bg-blue-100 rounded hover:bg-blue-200 transition">
                                            <span class="material-icons-outlined mr-1">visibility</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="py-4 px-4 text-center text-gray-500">
                                    No transa ctions available.
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
