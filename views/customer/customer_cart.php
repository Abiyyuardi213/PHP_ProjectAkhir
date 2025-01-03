<?php

// Format harga ke Rupiah
function formatRupiah($angka) {
  return 'Rp ' . number_format($angka, 0, ',', '.');
}

// Calculate total price
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
  $total_price += $item['barang_price'] * $item['barang_quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['barang_id'])) {
        $barang_id = $_POST['barang_id'];
        foreach ($_SESSION['cart'] as $key => &$item) {
            if ($item['barang_id'] == $barang_id) {
                if ($_POST['action'] === 'increase') {
                    $item['barang_quantity']++;
                } elseif ($_POST['action'] === 'decrease' && $item['barang_quantity'] > 1) {
                    $item['barang_quantity']--;
                } elseif ($_POST['action'] === 'remove') {
                    unset($_SESSION['cart'][$key]);
                }
                break;
            }
        }
        // Re-index the cart array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Calculate total price
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['barang_price'] * $item['barang_quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart - Warehouse Management</title>
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
          <span class="material-icons mr-2">shopping_cart</span>
          Your Cart
        </h1>
        <!-- Navigation -->
        <nav class="flex items-center space-x-6 hidden md:flex">
          <a href="index.php?modul=customer_dashboard&fitur=home" class="hover:underline">Home</a>
          <a href="#" class="hover:underline">My Orders</a>
          <a href="index.php?modul=customer_dashboard&fitur=product" class="hover:underline">Products</a>
          <a href="#" class="hover:underline">Order Status</a>
          <a href="#" class="hover:underline">Profile</a>
          <a href="#" class="hover:underline">Logout</a>
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
        <a href="#" class="text-white hover:underline">Logout</a>
      </nav>
    </div>

    <!-- Cart Section -->
    <section class="bg-gray-50 py-12 flex-grow">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Your Cart</h2>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg p-6">
          <table class="min-w-full">
            <thead>
              <tr class="border-b">
                <th class="py-3 px-6 text-left text-gray-800">Product Name</th>
                <th class="py-3 px-6 text-left text-gray-800">Price</th>
                <th class="py-3 px-6 text-left text-gray-800">Quantity</th>
                <th class="py-3 px-6 text-left text-gray-800">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($_SESSION['cart'])) { ?>
              <tr class="border-b hover:bg-gray-100">
                <td class="py-3 px-6 text-gray-600" colspan="4">Your cart is empty.</td>
              </tr>
              <?php } else { ?>
              <?php foreach ($_SESSION['cart'] as $item) { ?>
              <tr class="border-b hover:bg-gray-100">
                <td class="py-3 px-6 text-gray-600"><?= htmlspecialchars($item['barang_name']); ?></td>
                <td class="py-3 px-6 text-gray-600"><?= formatRupiah($item['barang_price']); ?></td>
                <td class="py-3 px-6 text-gray-600"><?= htmlspecialchars($item['barang_quantity']); ?></td>
                <td class="py-3 px-6 text-gray-600">
                  <form method="POST" class="inline">
                    <input type="hidden" name="barang_id" value="<?= htmlspecialchars($item['barang_id']); ?>">
                    <button type="submit" name="action" value="decrease" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">-</button>
                  </form>
                  <form method="POST" class="inline">
                    <input type="hidden" name="barang_id" value="<?= htmlspecialchars($item['barang_id']); ?>">
                    <button type="submit" name="action" value="increase" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">+</button>
                  </form>
                  <form method="POST" class="inline">
                    <input type="hidden" name="barang_id" value="<?= htmlspecialchars($item['barang_id']); ?>">
                    <button type="submit" name="action" value="remove" class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600">Remove</button>
                  </form>
                </td>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>

        <!-- Total Price -->
        <div class="mt-6 text-right">
          <h3 class="text-xl font-bold text-gray-800">Total Price: <?= formatRupiah($total_price); ?></h3>
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

  <script>
    // Toggle mobile menu
    document.getElementById('menuButton').addEventListener('click', function() {
      const menu = document.getElementById('mobileMenu');
      menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    });
  </script>
</body>
</html>
