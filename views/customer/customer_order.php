<?php
// Contoh mock data pesanan (Bisa diubah dengan query ke database jika ada sistem penyimpanan order)
$orders = [
    ['order_id' => 1, 'order_date' => '2024-12-30', 'status' => 'Completed', 'total' => 120000],
    ['order_id' => 2, 'order_date' => '2024-12-29', 'status' => 'Pending', 'total' => 85000],
    ['order_id' => 3, 'order_date' => '2024-12-28', 'status' => 'Processing', 'total' => 97000],
];

// Fungsi untuk format Rupiah
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Orders - Warehouse Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 font-sans flex flex-col min-h-screen">

  <!-- Wrapper -->
  <div class="flex flex-col flex-grow">
    <!-- Header -->
    <header class="bg-green-700 text-white py-5 shadow-md">
      <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold flex items-center">
          <span class="material-icons mr-2">receipt_long</span>
          My Orders
        </h1>
        <a href="index.php?modul=customer_dashboard&fitur=home" class="bg-white text-green-700 px-4 py-2 rounded-full font-semibold shadow-md hover:bg-gray-100 transition">
          Back to Home
        </a>
      </div>
    </header>

    <!-- Order List Section -->
    <section class="bg-gray-50 py-12 flex-grow">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Your Orders</h2>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg p-6">
          <table class="min-w-full">
            <thead>
              <tr class="border-b">
                <th class="py-3 px-6 text-left text-gray-800">Order ID</th>
                <th class="py-3 px-6 text-left text-gray-800">Order Date</th>
                <th class="py-3 px-6 text-left text-gray-800">Status</th>
                <th class="py-3 px-6 text-left text-gray-800">Total</th>
                <th class="py-3 px-6 text-left text-gray-800">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($orders)) { ?>
              <tr class="border-b hover:bg-gray-100">
                <td class="py-3 px-6 text-gray-600" colspan="5">You have no orders.</td>
              </tr>
              <?php } else { ?>
              <?php foreach ($orders as $order) { ?>
              <tr class="border-b hover:bg-gray-100">
                <td class="py-3 px-6 text-gray-600">#<?= htmlspecialchars($order['order_id']); ?></td>
                <td class="py-3 px-6 text-gray-600"><?= htmlspecialchars($order['order_date']); ?></td>
                <td class="py-3 px-6 text-gray-600"><?= htmlspecialchars($order['status']); ?></td>
                <td class="py-3 px-6 text-gray-600"><?= formatRupiah($order['total']); ?></td>
                <td class="py-3 px-6 text-gray-600">
                  <a href="index.php?modul=customer_dashboard&fitur=order_detail&order_id=<?= $order['order_id']; ?>" 
                     class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">View</a>
                </td>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6 mt-auto">
      <div class="container mx-auto px-6 text-center">
        <p class="text-sm">&copy; 2024 MyWarehouse. All rights reserved.</p>
      </div>
    </footer>
  </div>
</body>
</html>
