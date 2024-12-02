<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-6 ml-64">
            <!-- Konten utama, termasuk form -->
            <h1 class="text-2xl text-gray-800 font-semibold mb-6">Create User</h1>

            <!-- Form Tambah Pengguna -->
            <form action="index.php?modul=user&fitur=create" method="POST" class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
                <div class="mb-4">
                    <label for="user_name" class="block text-gray-700 font-bold mb-2">Nama Pengguna</label>
                    <input type="text" id="user_name" name="user_name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="user_email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" id="user_email" name="user_email" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="user_phone" class="block text-gray-700 font-bold mb-2">Telepon</label>
                    <input type="text" id="user_phone" name="user_phone" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="role_id" class="block text-gray-700 font-bold mb-2">Role</label>
                    <select id="role_id" name="role_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Role</option>
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?= htmlspecialchars($role['role_id']) ?>"><?= htmlspecialchars($role['role_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                        Simpan
                    </button>
                    <a href="index.php?modul=user&fitur=list" class="bg-gray-300 text-black px-6 py-2 rounded-lg hover:bg-gray-400">
                        Back to User List
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
