<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
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
        <div class="p-6 flex-1 mt-16"> <!-- Menambahkan mt-16 untuk memberi ruang atas -->
            <h1 class="text-3xl font-semibold text-gray-900 mb-8">Manage Role</h1>

            <!-- Tombol Create Role -->
            <div class="flex justify-end mb-4">
                <a href="index.php?modul=role&fitur=create" 
                class="flex items-center bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 shadow-lg transition duration-300">
                    <span class="material-icons-outlined mr-2">add</span>
                    Create Role
                </a>
            </div>

            <!-- Tabel Role -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-blue-700">
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Role ID</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Role Name</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Description</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Salary</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Status</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center text-white font-semibold">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php if (!empty($roles)) : ?>
                        <?php foreach ($roles as $role) : ?>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= htmlspecialchars($role['role_id']) ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= htmlspecialchars($role['role_name']) ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= htmlspecialchars($role['role_description']) ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    Rp <?= number_format((int)$role['role_salary'], 0, ',', '.') ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center text-gray-800">
                                    <?= $role['role_status'] ? 'Active' : 'Inactive' ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center">
                                    <a href="index.php?modul=role&fitur=update&id=<?= $role['role_id'] ?>" 
                                    class="inline-flex items-center px-2 py-1 text-sm text-yellow-500 bg-yellow-100 rounded hover:bg-yellow-200 transition">
                                        <span class="material-icons-outlined mr-1">edit</span>
                                    </a>
                                    <a href="index.php?modul=role&fitur=delete&id=<?= $role['role_id'] ?>" 
                                    class="inline-flex items-center px-2 py-1 text-sm text-red-500 bg-red-100 rounded hover:bg-red-200 transition ml-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                        <span class="material-icons-outlined mr-1">delete</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-gray-500">
                                No roles available.
                            </td>
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
