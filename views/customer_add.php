<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-700 text-white py-4 px-6 shadow-md">
        <h1 class="text-2xl font-bold flex items-center">
            <span class="material-icons-outlined mr-2">person</span>
            Management Customer
        </h1>
    </header>

    <!-- Content -->
    <main class="flex-grow flex items-center justify-center p-6">
        <!-- Form Tambah Customer -->
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
            <form action="index.php?modul=customer&fitur=create" method="POST" class="grid grid-cols-2 gap-4">
                <div>
                    <label for="username" class="block text-gray-700 font-medium">Username</label>
                    <input type="text" name="username" id="username" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" placeholder="Enter username" required>
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-medium">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" placeholder="Enter password" required>
                </div>
                <div>
                    <label for="email" class="block text-gray-700 font-medium">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" placeholder="Enter email" required>
                </div>
                <div>
                    <label for="full_name" class="block text-gray-700 font-medium">Full Name</label>
                    <input type="text" name="full_name" id="full_name" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" placeholder="Enter full name" required>
                </div>
                <div>
                    <label for="phone_number" class="block text-gray-700 font-medium">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" placeholder="Enter phone number" required>
                </div>
                <div>
                    <label for="address" class="block text-gray-700 font-medium">Address</label>
                    <textarea name="address" id="address" rows="3" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" placeholder="Enter address" required></textarea>
                </div>
                <!-- Tombol Submit -->
                <div class="col-span-2 flex justify-between mt-4">
                    <a href="index.php?modul=customer&fitur=list" 
                       class="bg-gray-500 text-white px-6 py-2 rounded-md shadow-lg hover:bg-gray-600 transition duration-300">
                        Back to Customer List
                    </a>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow-lg hover:bg-blue-600 transition duration-300">
                        Save Customer
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
