<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="p-6 flex-1">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Update Role</h1>

            <!-- Form Update Role -->
            <div class="bg-white shadow rounded-lg p-6 max-w-xl mx-auto">
                <?php if (isset($role) && !empty($role)) : ?>
                    <form action="index.php?modul=role&fitur=update&id=<?php echo $role['role_id']; ?>" method="POST" class="space-y-4">
                        <div>
                            <label for="role_name" class="block text-gray-700 font-medium">Role Name</label>
                            <input type="text" id="role_name" name="role_name" 
                                   value="<?= htmlspecialchars($role['role_name']); ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   placeholder="Enter role name" required autofocus>
                        </div>
                        <div>
                            <label for="role_description" class="block text-gray-700 font-medium">Description</label>
                            <textarea id="role_description" name="role_description" rows="3" 
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                      placeholder="Enter role description" required><?= htmlspecialchars($role['role_description']); ?></textarea>
                        </div>
                        <div>
                            <label for="role_salary" class="block text-gray-700 font-medium">Salary</label>
                            <input type="number" id="role_salary" name="role_salary" 
                                   value="<?= htmlspecialchars($role['role_salary']); ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   placeholder="Enter role salary" min="0" required>
                        </div>
                        <div>
                            <label for="role_status" class="block text-gray-700 font-medium">Status</label>
                            <select id="role_status" name="role_status" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="1" <?= $role['role_status'] == 1 ? 'selected' : ''; ?>>Active</option>
                                <option value="0" <?= $role['role_status'] == 0 ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <a href="index.php?modul=role&fitur=list" 
                               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition" 
                               role="button">
                               Cancel
                            </a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                                    Update Role
                            </button>
                        </div>
                    </form>
                <?php else : ?>
                    <p class="text-center text-gray-500">Role not found.</p>
                    <div class="text-center mt-4">
                        <a href="index.php?modul=role&fitur=list" 
                           class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                           Back to Role List
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
