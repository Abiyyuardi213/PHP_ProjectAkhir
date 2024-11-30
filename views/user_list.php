<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="ml-64 flex flex-col flex-grow">
            <!-- Navbar -->
            <?php include 'includes/navbar.php'; ?>

            <!-- Content -->
            <div class="p-6 flex-1 mt-16">
                <h1 class="text-3xl font-semibold text-gray-900 mb-8">Manage User</h1>

                <!-- Tombol Create User -->
                <div class="flex justify-end mb-4">
                    <a href="index.php?modul=user&fitur=create" 
                       class="flex items-center bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 shadow-md transition duration-300">
                        <span class="material-icons-outlined mr-2">add</span>
                        Create User
                    </a>
                </div>

                <!-- Tabel User -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead class="bg-blue-700">
                            <tr>
                                <th class="py-3 px-4 text-center text-white text-sm font-semibold">User ID</th>
                                <th class="py-3 px-4 text-center text-white text-sm font-semibold">User Name</th>
                                <th class="py-3 px-4 text-center text-white text-sm font-semibold">Username</th>
                                <th class="py-3 px-4 text-center text-white text-sm font-semibold">Email</th>
                                <th class="py-3 px-4 text-center text-white text-sm font-semibold">Phone</th>
                                <th class="py-3 px-4 text-center text-white text-sm font-semibold">Role</th>
                                <th class="py-3 px-4 text-center text-white text-sm font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)) : ?>
                                <?php foreach ($users as $user) : ?>
                                    <tr class="even:bg-gray-50 hover:bg-blue-100">
                                        <td class="py-3 px-4 border-b border-gray-200 text-center text-gray-700"><?= htmlspecialchars($user['user_id']) ?></td>
                                        <td class="py-3 px-4 border-b border-gray-200 text-center text-gray-700"><?= htmlspecialchars($user['user_name']) ?></td>
                                        <td class="py-3 px-4 border-b border-gray-200 text-center text-gray-700"><?= htmlspecialchars($user['username']) ?></td>
                                        <td class="py-3 px-4 border-b border-gray-200 text-center text-gray-700"><?= htmlspecialchars($user['user_email']) ?></td>
                                        <td class="py-3 px-4 border-b border-gray-200 text-center text-gray-700"><?= htmlspecialchars($user['user_phone']) ?></td>
                                        <td class="py-3 px-4 border-b border-gray-200 text-center text-gray-700"><?= htmlspecialchars($user['role_name'] ?? '-') ?></td>
                                        <td class="py-3 px-4 border-b border-gray-200 text-center text-gray-700">
                                            <a href="index.php?modul=user&fitur=update&id=<?= $user['user_id'] ?>" 
                                            class="inline-flex items-center px-2 py-1 text-sm text-yellow-500 bg-yellow-100 rounded hover:bg-yellow-200 transition">
                                                <span class="material-icons-outlined mr-1">edit</span>
                                            </a>
                                            <a href="index.php?modul=user&fitur=delete&id=<?= $user['user_id'] ?>" 
                                            class="inline-flex items-center px-2 py-1 text-sm text-red-500 bg-red-100 rounded hover:bg-red-200 transition ml-2"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                                <span class="material-icons-outlined mr-1">delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="py-4 px-4 text-center text-gray-500">Tidak ada pengguna yang tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
