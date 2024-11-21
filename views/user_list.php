<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 flex flex-col">
    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <div class="flex flex-grow">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Konten Utama -->
        <div class="p-6 flex-1">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Pengguna</h1>

            <!-- Tombol Create User -->
            <div class="flex justify-end mb-4">
                <a href="index.php?modul=user&fitur=create" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    + Tambah Pengguna
                </a>
            </div>

            <!-- Tabel Daftar Pengguna -->
            <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">User ID</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">Nama Pengguna</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">Username</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">Email</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">Telepon</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">Role</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)) : ?>
                            <?php foreach ($users as $user) : ?>
                                <tr class="border-b">
                                    <td class="px-4 py-2 text-center"><?= htmlspecialchars($user['user_id']) ?></td>
                                    <td class="px-4 py-2 text-center"><?= htmlspecialchars($user['user_name']) ?></td>
                                    <td class="px-4 py-2 text-center"><?= htmlspecialchars($user['username']) ?></td>
                                    <td class="px-4 py-2 text-center"><?= htmlspecialchars($user['user_email']) ?></td>
                                    <td class="px-4 py-2 text-center"><?= htmlspecialchars($user['user_phone']) ?></td>
                                    <td class="px-4 py-2 text-center"><?= htmlspecialchars($user['role_name'] ?? '') ?></td>
                                    <td class="px-4 py-2 text-center">
                                        <a href="index.php?modul=user&fitur=update&id=<?= $user['user_id'] ?>" class="text-yellow-500 hover:text-yellow-700">Edit</a> |
                                        <a href="index.php?modul=user&fitur=delete&id=<?= $user['user_id'] ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7" class="py-4 px-4 text-center text-gray-500">
                                    Tidak ada pengguna yang tersedia.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<!-- #region -->