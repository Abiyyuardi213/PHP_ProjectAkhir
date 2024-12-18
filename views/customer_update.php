<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="ml-64 flex flex-col flex-grow">
            <!-- Content -->
            <div class="p-6 flex-1 mt-16">
                <h1 class="text-3xl font-semibold text-gray-900 mb-8">Update Customer</h1>

                <!-- Tampilkan pesan error jika ada -->
                <?php if (isset($errorMessage)): ?>
                    <div class="bg-red-500 text-white p-4 rounded mb-4">
                        <?= htmlspecialchars($errorMessage) ?>
                    </div>
                <?php endif; ?>

                <!-- Form Update Customer -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <form action="index.php?modul=customer&fitur=update&id=<?= htmlspecialchars($customer['customer_id']) ?>" method="POST" class="space-y-4">
                        <div>
                            <label for="username" class="block text-gray-700 font-medium">Username</label>
                            <input type="text" name="username" id="username" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($customer['username']) ?>" required>
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 font-medium">Email</label>
                            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($customer['email']) ?>" required>
                        </div>
                        <div>
                            <label for="full_name" class="block text-gray-700 font-medium">Full Name</label>
                            <input type="text" name="full_name" id="full_name" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($customer['full_name']) ?>" required>
                        </div>
                        <div>
                            <label for="phone_number" class="block text-gray-700 font-medium">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($customer['phone_number']) ?>" required>
                        </div>
                        <div>
                            <label for="address" class="block text-gray-700 font-medium">Address</label>
                            <textarea name="address" id="address" rows="3" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required><?= htmlspecialchars($customer['address']) ?></textarea>
                        </div>
                        <!-- Tombol Submit -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow-lg hover:bg-blue-600 transition duration-300">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
