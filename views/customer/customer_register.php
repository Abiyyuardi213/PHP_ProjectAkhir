<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-gradient-to-r from-green-700 via-green-800 to-green-900 text-white py-5 shadow-md">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <i class="fas fa-user-plus text-3xl"></i>
                <h1 class="text-2xl font-bold">Customer Registration</h1>
            </div>
            <a href="index.php" class="flex items-center space-x-2 text-white hover:text-gray-200 transition">
                <i class="fas fa-home text-xl"></i>
                <span class="font-semibold">Home</span>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl w-full">
            <h2 class="text-3xl font-bold text-center text-green-700 mb-6">
                <span class="inline-block mr-2">
                    <i class="fas fa-user-plus text-green-700"></i>
                </span>
                Register Customer
            </h2>
            <form action="index.php?modul=customer&fitur=register" method="POST" class="grid grid-cols-2 gap-4">
                <div>
                    <label for="username" class="block text-gray-700 font-semibold">Username</label>
                    <input type="text" name="username" id="username" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter username">
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-semibold">Password</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter password">
                </div>
                <div>
                    <label for="email" class="block text-gray-700 font-semibold">Email</label>
                    <input type="email" name="email" id="email" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter email">
                </div>
                <div>
                    <label for="full_name" class="block text-gray-700 font-semibold">Full Name</label>
                    <input type="text" name="full_name" id="full_name" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter full name">
                </div>
                <div>
                    <label for="phone_number" class="block text-gray-700 font-semibold">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter phone number">
                </div>
                <div>
                    <label for="address" class="block text-gray-700 font-semibold">Address</label>
                    <textarea name="address" id="address" rows="3" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter address"></textarea>
                </div>
                <div class="col-span-2 flex justify-center mt-4">
                    <button type="submit" class="w-full py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition flex justify-center items-center">
                        <span>Register</span>
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto px-6 text-center">
            <p class="text-sm">&copy; 2024 MyWarehouse. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
