<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Role</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-3xl bg-white shadow-lg rounded-xl overflow-hidden p-8">
    <h1 class="text-3xl font-bold text-blue-700 text-center mb-6">Update Role</h1>

    <!-- Display Error Message -->
    <?php if (!empty($errorMessage)) : ?>
      <div class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
        <span class="material-icons-outlined mr-2">error</span>
        <span><?= htmlspecialchars($errorMessage) ?></span>
      </div>
    <?php endif; ?>

    <?php if (isset($role) && !empty($role)) : ?>
      <form action="index.php?modul=role&fitur=update&id=<?php echo $role['role_id']; ?>" method="POST" class="space-y-6">
        <!-- Role Name -->
        <div>
          <label for="role_name" class="block text-lg font-medium text-gray-700">Role Name</label>
          <div class="relative">
            <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">badge</span>
            <input type="text" id="role_name" name="role_name"
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                   placeholder="Enter role name"
                   value="<?= htmlspecialchars($role['role_name']); ?>" required>
          </div>
        </div>

        <!-- Role Description -->
        <div>
          <label for="role_description" class="block text-lg font-medium text-gray-700">Description</label>
          <textarea id="role_description" name="role_description" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Describe the role" required><?= htmlspecialchars($role['role_description']); ?></textarea>
        </div>

        <!-- Role Salary -->
        <div>
          <label for="role_salary" class="block text-lg font-medium text-gray-700">Salary</label>
          <div class="relative">
            <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">attach_money</span>
            <input type="number" id="role_salary" name="role_salary"
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                   placeholder="Enter salary"
                   min="0" value="<?= htmlspecialchars($role['role_salary']); ?>" required>
          </div>
        </div>

        <!-- Role Status -->
        <div>
          <label for="role_status" class="block text-lg font-medium text-gray-700">Status</label>
          <select id="role_status" name="role_status"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="1" <?= $role['role_status'] == 1 ? 'selected' : ''; ?>>Active</option>
            <option value="0" <?= $role['role_status'] == 0 ? 'selected' : ''; ?>>Inactive</option>
          </select>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center">
          <a href="index.php?modul=role&fitur=list"
             class="flex items-center px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition">
            <span class="material-icons-outlined mr-2">arrow_back</span>
            Cancel
          </a>
          <button type="submit"
                  class="flex items-center px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
            <span class="material-icons-outlined mr-2">save</span>
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
</body>
</html>
