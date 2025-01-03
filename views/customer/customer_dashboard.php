<?php
include 'models/model_barang.php';

$modelBarang = new ModelBarang($conn);
$barangs = $modelBarang->getBarangs();
$barangCount = count($barangs);
$availableBarangs = $modelBarang->getAvailableBarangs();

function formatRupiah($number)
{
    return 'Rp' . number_format($number, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Warehouse Management - Customer Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

  <!-- Wrapper -->
  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-green-700 text-white py-5 shadow-md">
      <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold flex items-center">
          <span class="material-icons mr-2">account_circle</span>
          Customer Dashboard
        </h1>
        <!-- Navigation -->
        <nav class="flex items-center space-x-6 hidden md:flex">
          <a href="index.php?modul=customer_dashboard&fitur=home" class="hover:underline">Home</a>
          <a href="#" class="hover:underline">My Orders</a>
          <a href="index.php?modul=customer_dashboard&fitur=product" class="hover:underline">Products</a>
          <a href="#" class="hover:underline">Order Status</a>
          <a href="#" class="hover:underline">Profile</a>
          <a href="#" class="hover:underline" id="logoutLink">Logout</a>
        </nav>
        <!-- Hamburger Menu for Mobile -->
        <button class="md:hidden text-white" id="menuButton">
          <span class="material-icons">menu</span>
        </button>
      </div>
    </header>

    <!-- Mobile Menu -->
    <div class="md:hidden" id="mobileMenu" style="display: none;">
      <nav class="flex flex-col space-y-4 py-4 px-6 bg-green-700">
        <a href="#" class="text-white hover:underline">Home</a>
        <a href="#" class="text-white hover:underline">My Orders</a>
        <a href="index.php?modul=customer_dashboard&fitur=product" class="text-white hover:underline">Products</a>
        <a href="#" class="text-white hover:underline">Order Status</a>
        <a href="#" class="text-white hover:underline">Profile</a>
        <a href="#" class="text-white hover:underline" id="logoutLinkMobile">Logout</a>
      </nav>
    </div>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-600 to-green-400 py-12">
      <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl sm:text-5xl font-bold text-white mb-6">Manage Your Orders Seamlessly</h2>
        <p class="text-gray-200 text-lg sm:text-xl mb-8">Track your orders, view available products, and get real-time delivery updates.</p>
        <a href="index.php?modul=customer_dashboard&fitur=product" class="bg-white text-green-600 px-6 py-3 rounded-full hover:bg-gray-100 shadow-md flex items-center justify-center mx-auto w-max">
          <span class="material-icons mr-2">search</span> Explore Products
        </a>
      </div>
    </section>

    <!-- Dashboard Section -->
    <main class="container mx-auto px-6 py-12">
      <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Dashboard</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Orders Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 relative hover:shadow-xl">
          <span class="material-icons text-green-500 text-5xl absolute top-4 right-4">local_shipping</span>
          <h3 class="text-lg font-semibold text-gray-800">Orders In Progress</h3>
          <p class="text-3xl font-bold mt-4">8</p>
          <p class="text-sm mt-2 text-gray-600">Track your active orders</p>
        </div>

        <!-- Products Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 relative hover:shadow-xl">
          <span class="material-icons text-yellow-500 text-5xl absolute top-4 right-4">store</span>
          <h3 class="text-lg font-semibold text-gray-800">Available Products</h3>
          <p class="text-3xl font-bold mt-4"><?= $barangCount; ?></p>
          <p class="text-sm mt-2 text-gray-600">Browse items in stock</p>
        </div>

        <!-- Delivery Status Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 relative hover:shadow-xl">
          <span class="material-icons text-blue-500 text-5xl absolute top-4 right-4">query_builder</span>
          <h3 class="text-lg font-semibold text-gray-800">Pending Deliveries</h3>
          <p class="text-3xl font-bold mt-4">3</p>
          <p class="text-sm mt-2 text-gray-600">View your delivery timeline</p>
        </div>
      </div>
    </main>

    <!-- Product List Section -->
    <section class="bg-gray-50 py-12">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Available Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <?php foreach ($availableBarangs as $barang) { ?>
          <!-- Product Card -->
          <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl">
            <h3 class="text-lg font-semibold text-gray-800 mb-2"><?= htmlspecialchars($barang['barang_name']); ?></h3>
            <p class="text-gray-600 text-sm mb-4">Quantity: <?= htmlspecialchars($barang['barang_quantity']); ?></p>
            <p class="text-gray-800 font-medium">Price: <?= formatRupiah($barang['barang_price']); ?></p>
            <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center">
              <span class="material-icons mr-2">shopping_cart</span> Add to Cart
            </button>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <!-- Order History Section -->
    <section class="bg-gray-100 py-12">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Order History</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
              <tr class="border-b">
                <th class="py-3 px-6 text-left text-gray-800">Order ID</th>
                <th class="py-3 px-6 text-left text-gray-800">Date</th>
                <th class="py-3 px-6 text-left text-gray-800">Status</th>
                <th class="py-3 px-6 text-left text-gray-800">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b hover:bg-gray-100">
                <td class="py-3 px-6 text-gray-600">#12345</td>
                <td class="py-3 px-6 text-gray-600">Dec 1, 2024</td>
                <td class="py-3 px-6 text-green-600">Shipped</td>
                <td class="py-3 px-6 text-gray-600">$200.00</td>
              </tr>
              <tr class="border-b hover:bg-gray-100">
                <td class="py-3 px-6 text-gray-600">#12346</td>
                <td class="py-3 px-6 text-gray-600">Dec 3, 2024</td>
                <td class="py-3 px-6 text-red-600">Pending</td>
                <td class="py-3 px-6 text-gray-600">$50.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6">
      <div class="container mx-auto px-6 text-center">
        <p class="text-sm">&copy; 2024 MyWarehouse. All rights reserved.</p>
      </div>
    </footer>
  </div>

  <!-- Logout Confirmation Modal -->
  <div id="logoutModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-80">
      <h2 class="text-xl font-bold mb-4">Are you sure you want to log out?</h2>
      <div class="flex justify-end space-x-4">
        <button id="cancelLogout" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">No</button>
        <a href="index.php" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Yes</a>
      </div>
    </div>
  </div>

  <script>
    // Toggle mobile menu
    document.getElementById('menuButton').addEventListener('click', function() {
      const menu = document.getElementById('mobileMenu');
      menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    });

    // Show logout confirmation modal
    document.getElementById('logoutLink').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('logoutModal').classList.remove('hidden');
    });

    document.getElementById('logoutLinkMobile').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('logoutModal').classList.remove('hidden');
    });

    // Hide logout confirmation modal
    document.getElementById('cancelLogout').addEventListener('click', function() {
      document.getElementById('logoutModal').classList.add('hidden');
    });
  </script>
</body>
</html>
