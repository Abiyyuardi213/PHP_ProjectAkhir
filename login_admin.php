<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php?modul=user&fitur=login");
    exit();
}

$message = $_GET['error'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

  <!-- Wrapper -->
  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-green-700 text-white py-5 shadow-md">
      <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Admin Login</h1>
        <a href="choose_role.php" class="text-sm hover:underline">Back</a>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center py-12">
      <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Login to Admin Dashboard</h2>
        <form action="index.php?modul=user&fitur=login" method="POST" class="space-y-6">
            <!-- Username Input -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="Enter your username">
            </div>
            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="Enter your password">
            </div>
            <!-- Login Button -->
            <div>
                <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">Login</button>
            </div>
        </form>
        <!-- Forgot Password -->
        <p class="text-center text-sm text-gray-600 mt-6">
          <a href="#" class="text-green-600 hover:underline">Forgot your password?</a>
        </p>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6">
      <div class="container mx-auto px-6 text-center">
        <p class="text-sm">&copy; 2024 MyWarehouse. All rights reserved.</p>
      </div>
    </footer>
  </div>
</body>
</html>
