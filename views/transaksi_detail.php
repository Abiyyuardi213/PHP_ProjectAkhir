<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction Details</title>
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
            <h1 class="text-3xl font-semibold text-gray-900 mb-8">Transaction Details</h1>

            <?php if (!$transaction): ?>
                <div class="text-center text-gray-500 mt-10">
                    <p>Transaction not found. Please check the transaction ID.</p>
                    <a href="index.php?modul=transaksi&fitur=list" 
                       class="mt-4 inline-flex items-center bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 shadow-lg transition">
                        <span class="material-icons-outlined mr-2">arrow_back</span>
                        Back to Transactions
                    </a>
                </div>
                <?php return; ?>
            <?php endif; ?>

            <!-- Transaction Info -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Transaction Information</h2>
                <p><strong>Transaction ID:</strong> <?= htmlspecialchars($transaction['transaksi_id']) ?></p>
                <p><strong>Date:</strong> <?= htmlspecialchars($transaction['transaksi_date']) ?></p>
                <p><strong>Status:</strong> 
                    <span class="<?= $transaction['transaksi_status'] == 1 ? 'text-green-600 font-semibold' : 'text-yellow-600 font-semibold' ?>">
                        <?= $transaction['transaksi_status'] == 1 ? 'Success' : 'Pending' ?>
                    </span>
                </p>
                <p><strong>User:</strong> <?= htmlspecialchars($transaction['user_name']) ?></p>
            </div>

            <!-- Item Details -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Item Details</h2>
                <?php if (!empty($transaction['details']) && is_array($transaction['details'])): ?>
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead class="bg-blue-700">
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Item Name</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Quantity</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Price</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transaction['details'] as $item): ?>
                                <tr class="even:bg-gray-50 hover:bg-blue-100">
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800"><?= htmlspecialchars($item['barang_name']) ?></td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800"><?= htmlspecialchars($item['quantity']) ?></td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">Rp <?= number_format($item['price_barang'], 0, ',', '.') ?></td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">Rp <?= number_format($item['total_price'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="mt-4 text-right">
                        <p class="text-xl font-semibold text-gray-800">
                            Total Transaction: Rp <?= number_format($transaction['total_amount'], 0, ',', '.') ?>
                        </p>
                    </div>
                <?php else: ?>
                    <p class="text-center text-gray-500">No item details available for this transaction.</p>
                <?php endif; ?>
            </div>

            <!-- Back Button -->
            <div class="mt-6">
                <a href="index.php?modul=transactions&fitur=list" 
                   class="inline-flex items-center bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 shadow-lg transition">
                    <span class="material-icons-outlined mr-2">arrow_back</span>
                    Back to Transactions
                </a>
            </div>
        </div>
    </div>
  </div>
</body>
</html>
