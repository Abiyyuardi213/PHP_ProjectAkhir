<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Role</title>
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
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage Role</h1>

            <!-- Tombol Create Role -->
            <div class="flex justify-end mb-4">
                <a href="index.php?modul=role&fitur=create" 
                   class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                   + Create Role
                </a>
            </div>

            <!-- Tabel Role -->
            <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">Role ID</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">Role Name</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">Description</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">Salary</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">Status</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-center text-gray-600">Action</th>
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
                                           class="text-blue-500 hover:underline mr-2">
                                           Update
                                        </a>
                                        <a href="index.php?modul=role&fitur=delete&id=<?= $role['role_id'] ?>" 
                                           class="text-red-500 hover:underline" 
                                           onclick="return confirm('Are you sure you want to delete this role?')">
                                           Delete
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
</body>
</html>
