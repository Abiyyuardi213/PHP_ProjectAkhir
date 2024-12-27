<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-xl overflow-hidden p-8">
        <h1 class="text-3xl font-bold text-blue-700 text-center mb-6">Create New User</h1>

        <!-- Display Error Message -->
        <?php if (!empty($errorMessage)) : ?>
            <div class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                <span class="material-icons-outlined mr-2">error</span>
                <span><?= htmlspecialchars($errorMessage) ?></span>
            </div>
        <?php endif; ?>

        <form action="index.php?modul=user&fitur=create" method="POST" enctype="multipart/form-data" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kiri -->
                <div>
                    <!-- Nama Pengguna -->
                    <div class="mb-4">
                        <label for="user_name" class="block text-lg font-medium text-gray-700">Nama Pengguna</label>
                        <div class="relative">
                            <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">person</span>
                            <input type="text" id="user_name" name="user_name"
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                   placeholder="Enter full name" required>
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="mb-4">
                        <label for="username" class="block text-lg font-medium text-gray-700">Username</label>
                        <div class="relative">
                            <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">account_circle</span>
                            <input type="text" id="username" name="username"
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                   placeholder="Enter username" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-lg font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">lock</span>
                            <input type="password" id="password" name="password"
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                   placeholder="Enter password" required>
                        </div>
                    </div>
                </div>

                <!-- Kanan -->
                <div>
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="user_email" class="block text-lg font-medium text-gray-700">Email</label>
                        <div class="relative">
                            <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">email</span>
                            <input type="email" id="user_email" name="user_email"
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                   placeholder="Enter email address" required>
                        </div>
                    </div>

                    <!-- Telepon -->
                    <div class="mb-4">
                        <label for="user_phone" class="block text-lg font-medium text-gray-700">Telepon</label>
                        <div class="relative">
                            <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">phone</span>
                            <input type="text" id="user_phone" name="user_phone"
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                   placeholder="Enter phone number" required>
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="mb-4">
                        <label for="role_id" class="block text-lg font-medium text-gray-700">Role</label>
                        <div class="relative">
                            <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">supervisor_account</span>
                            <select id="role_id" name="role_id"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
                                <option value="">Pilih Role</option>
                                <?php foreach ($roles as $role) : ?>
                                    <option value="<?= htmlspecialchars($role['role_id']) ?>"><?= htmlspecialchars($role['role_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Profile Picture -->
                    <div>
                        <label for="profile_picture" class="block text-lg font-medium text-gray-700">Profile Picture</label>
                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                            class="w-full px-4 py-2 border rounded-md">
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center mt-6">
                <a href="index.php?modul=user&fitur=list"
                   class="flex items-center px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition">
                    <span class="material-icons-outlined mr-2">arrow_back</span>
                    Cancel
                </a>
                <button type="submit"
                        class="flex items-center px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                    <span class="material-icons-outlined mr-2">save</span>
                    Save User
                </button>
            </div>
        </form>
    </div>
</body>
</html>
