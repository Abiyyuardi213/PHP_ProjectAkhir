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

            <!-- Transaction Info -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Transaction Information</h2>
                <p><strong>Transaction ID:</strong> <?= htmlspecialchars($transaction['transaksi_id']) ?></p>
                <p><strong>Date:</strong> <?= htmlspecialchars($transaction['transaksi_date']) ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($transaction['transaksi_status']) ?></p>
                <p><strong>User:</strong> <?= htmlspecialchars($transaction['user_name']) ?></p>
            </div>

            <!-- Item Details -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Item Details</h2>
                <?php if (!empty($transaction['item_detail'])): ?>
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead class="bg-blue-700">
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Item</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Quantity</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Price</th>
                                <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transaction['item_detail'] as $item): ?>
                                <tr class="even:bg-gray-50 hover:bg-blue-100">
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800"><?= htmlspecialchars($item['barang_name']) ?></td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800"><?= htmlspecialchars($item['quantity']) ?></td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">Rp <?= number_format($item['price_barang'], 0, ',', '.') ?></td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">Rp <?= number_format($item['total_amount'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center text-gray-500">No item details available for this transaction.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
  </div>
</body>
</html>
