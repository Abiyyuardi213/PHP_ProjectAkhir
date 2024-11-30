<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Role</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex flex-grow">
        <!-- Konten Utama -->
        <div class="p-6 flex-1">
            <h1 class="text-2xl text-gray-800 mb-6">Create Role</h1>

            <!-- Form Create Role -->
            <div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
                <!-- Area untuk menampilkan pesan error -->
                <?php if (!empty($errorMessage)) : ?>
                    <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
                        <?= htmlspecialchars($errorMessage) ?>
                    </div>
                <?php endif; ?>

                <form action="index.php?modul=role&fitur=create" method="POST" class="space-y-4">
                    <!-- Nama Role -->
                    <div>
                        <label for="role_name" class="block text-gray-700 font-medium">Role Name</label>
                        <input type="text" id="role_name" name="role_name" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="Enter role name" 
                               value="<?= !empty($role_name) ? htmlspecialchars($role_name) : '' ?>" required>
                    </div>

                    <!-- Deskripsi Role -->
                    <div>
                        <label for="role_description" class="block text-gray-700 font-medium">Description</label>
                        <textarea id="role_description" name="role_description" rows="3" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                  placeholder="Enter role description" required><?= !empty($role_description) ? htmlspecialchars($role_description) : '' ?></textarea>
                    </div>

                    <!-- Gaji Role -->
                    <div>
                        <label for="role_salary" class="block text-gray-700 font-medium">Salary</label>
                        <input type="number" id="role_salary" name="role_salary" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="Enter role salary" min="0" 
                               value="<?= !empty($role_salary) ? htmlspecialchars($role_salary) : '' ?>" required>
                    </div>

                    <!-- Status Role -->
                    <div>
                        <label for="role_status" class="block text-gray-700 font-medium">Status</label>
                        <select id="role_status" name="role_status" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="1" <?= isset($role_status) && $role_status == 1 ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= isset($role_status) && $role_status == 0 ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>

                    <!-- Tombol Submit dan Cancel -->
                    <div class="flex justify-end space-x-4">
                        <a href="index.php?modul=role&fitur=index" 
                           class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                           Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Save Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</body>
</html>
