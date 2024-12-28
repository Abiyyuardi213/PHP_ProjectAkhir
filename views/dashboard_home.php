<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome - Warehouse Management</title>
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
          <span class="material-icons mr-2">warehouse</span>
          Warehouse Management
        </h1>
        <!-- Navigation -->
        <nav class="flex items-center space-x-6 hidden md:flex">
          <a href="#" class="hover:underline">Home</a>
          <a href="#features" class="hover:underline">Features</a>
          <a href="#about" class="hover:underline">About</a>
          <a href="#contact" class="hover:underline">Contact</a>
        </nav>
        <!-- Login Button -->
        <a href="./views/role_option.php" class="bg-white text-green-700 px-4 py-2 rounded-full hover:bg-gray-100 shadow-md">
          Login
        </a>
      </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-600 to-green-400 py-12">
      <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl sm:text-5xl font-bold text-white mb-6">Welcome to Warehouse Management</h2>
        <p class="text-gray-200 text-lg sm:text-xl mb-8">Efficiently manage your orders, track deliveries, and streamline operations with our powerful platform.</p>
        <a href="login.php" class="bg-white text-green-600 px-6 py-3 rounded-full hover:bg-gray-100 shadow-md">
          Get Started
        </a>
      </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="bg-gray-50 py-12">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Features</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Feature Card -->
          <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl">
            <span class="material-icons text-green-500 text-5xl mb-4">analytics</span>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Order Management</h3>
            <p class="text-gray-600">Easily track, manage, and update your orders in real-time.</p>
          </div>
          <!-- Feature Card -->
          <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl">
            <span class="material-icons text-yellow-500 text-5xl mb-4">inventory</span>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Product Catalog</h3>
            <p class="text-gray-600">Browse available products and manage inventory effortlessly.</p>
          </div>
          <!-- Feature Card -->
          <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl">
            <span class="material-icons text-blue-500 text-5xl mb-4">support</span>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Customer Support</h3>
            <p class="text-gray-600">Receive 24/7 support for your inquiries and concerns.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="bg-white py-12">
      <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">About Us</h2>
        <p class="text-gray-600 text-lg">Our platform provides businesses with efficient tools to streamline warehouse operations, improve order accuracy, and enhance customer satisfaction. Join us to revolutionize the way you manage your warehouse.</p>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="bg-gray-100 py-12">
      <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Contact Us</h2>
        <p class="text-gray-600 mb-4">Have questions? Feel free to reach out to us for more information.</p>
        <a href="mailto:support@mywarehouse.com" class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700">
          Email Us
        </a>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6">
      <div class="container mx-auto px-6 text-center">
        <p class="text-sm">&copy; 2024 MyWarehouse. All rights reserved.</p>
      </div>
    </footer>
  </div>
</body>
</html>
