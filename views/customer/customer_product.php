<?php
require_once 'models/model_barang.php';

function formatRupiah($number) {
    return 'Rp ' . number_format($number, 0, ',', '.');
}

$modelBarang = new ModelBarang($conn);
$availableBarangs = $modelBarang->getAvailableBarangs();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['barang_id'])) {
    $barang_id = $_POST['barang_id'];
    $barang_name = $_POST['barang_name'];
    $barang_price = $_POST['barang_price'];

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['barang_id'] === $barang_id) {
            $item['barang_quantity'] += 1;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $item = [
            'barang_id' => $barang_id,
            'barang_name' => $barang_name,
            'barang_price' => $barang_price,
            'barang_quantity' => 1
        ];
        $_SESSION['cart'][] = $item;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Explore Products - Warehouse Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    .add-to-cart-btn {
      position: relative;
      overflow: hidden;
    }
    .add-to-cart-btn::after {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 128, 0, 0.4);
      transform: skewX(-45deg);
      transition: left 0.3s;
    }
    .add-to-cart-btn:hover::after {
      left: 100%;
    }
    .add-to-cart-btn:active {
      transform: scale(0.95);
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

  <!-- Wrapper -->
  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-green-700 text-white py-5 shadow-md">
      <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold flex items-center">
          <span class="material-icons mr-2">search</span>
          Explore Products
        </h1>
        <!-- Navigation -->
        <nav class="flex items-center space-x-6 hidden md:flex">
          <a href="index.php?modul=customer_dashboard&fitur=home" class="hover:underline">Home</a>
          <a href="#" class="hover:underline">My Orders</a>
          <a href="#" class="hover:underline">Products</a>
          <a href="#" class="hover:underline">Order Status</a>
          <a href="#" class="hover:underline">Profile</a>
          <a href="#" class="hover:underline">Logout</a>
        </nav>
        <!-- Cart Icon -->
        <a href="index.php?modul=customer_dashboard&fitur=cart" class="text-white relative">
          <span class="material-icons">shopping_cart</span>
          <span class="absolute top-0 right-0 bg-red-600 text-white rounded-full text-xs px-1"><?= count($_SESSION['cart']); ?></span>
        </a>
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
        <a href="#" class="text-white hover:underline">Products</a>
        <a href="#" class="text-white hover:underline">Order Status</a>
        <a href="#" class="text-white hover:underline">Profile</a>
        <a href="#" class="text-white hover:underline">Logout</a>
      </nav>
    </div>

    <!-- Explore Products Section -->
    <section class="bg-gray-50 py-12">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Explore Our Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-8">
          <?php foreach ($availableBarangs as $barang) { ?>
          <!-- Product Card -->
          <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <?php if (!empty($barang['product_picture'])) : ?>
              <img src="./uploads/product_pictures/<?= htmlspecialchars($barang['product_picture']); ?>" alt="<?= htmlspecialchars($barang['barang_name']); ?>" class="w-full h-48 object-cover">
            <?php else : ?>
              <img src="https://via.placeholder.com/400x300" alt="<?= htmlspecialchars($barang['barang_name']); ?>" class="w-full h-48 object-cover">
            <?php endif; ?>
            <div class="p-6">
              <h3 class="text-lg font-semibold text-gray-800 mb-2"><?= htmlspecialchars($barang['barang_name']); ?></h3>
              <p class="text-gray-600 text-sm mb-4">Quantity: <?= htmlspecialchars($barang['barang_quantity']); ?></p>
              <p class="text-gray-800 font-medium">Price: <?= formatRupiah($barang['barang_price']); ?></p>
              <form method="POST" class="mt-4">
                <input type="hidden" name="barang_id" value="<?= htmlspecialchars($barang['barang_id']); ?>">
                <input type="hidden" name="barang_name" value="<?= htmlspecialchars($barang['barang_name']); ?>">
                <input type="hidden" name="barang_price" value="<?= htmlspecialchars($barang['barang_price']); ?>">
                <button type="submit" class="add-to-cart-btn bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center">
                  <span class="material-icons mr-2">shopping_cart</span> Add to Cart
                </button>
              </form>
            </div>
          </div>
          <?php } ?>
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

  <script>
    // Toggle mobile menu
    document.getElementById('menuButton').addEventListener('click', function() {
      const menu = document.getElementById('mobileMenu');
      menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    });
  </script>
</body>
</html>
