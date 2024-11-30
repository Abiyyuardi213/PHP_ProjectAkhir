<?php
$user_id = $_GET['id'] ?? null;
if ($user_id) {
    $user = $this->userModel->getUserById($user_id);
    if (!$user) {
        $error = "Pengguna tidak ditemukan.";
    }
} else {
    header('Location: index.php?modul=user&fitur=list');
    exit();
}

$roles = $this->roleModel->getAllRoles();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-6 ml-64">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Update User</h1>

            <?php
            if (isset($error)) : ?>
                <div class="bg-red-500 text-white p-4 mb-4 rounded-md">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="index.php?modul=user&fitur=update&id=<?= $user_id ?>" method="POST" class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
                <div class="mb-4">
                    <label for="user_name" class="block text-gray-700">Nama Pengguna</label>
                    <input type="text" id="user_name" name="user_name" value="<?= htmlspecialchars($user['user_name']) ?>" required class="w-full p-3 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username</label>
                    <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required class="w-full p-3 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password (kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" id="password" name="password" class="w-full p-3 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="user_email" class="block text-gray-700">Email</label>
                    <input type="email" id="user_email" name="user_email" value="<?= htmlspecialchars($user['user_email']) ?>" required class="w-full p-3 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="user_phone" class="block text-gray-700">Telepon</label>
                    <input type="text" id="user_phone" name="user_phone" value="<?= htmlspecialchars($user['user_phone']) ?>" required class="w-full p-3 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="role_id" class="block text-gray-700">Role</label>
                    <select id="role_id" name="role_id" required class="w-full p-3 border border-gray-300 rounded-md">
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?= $role['role_id'] ?>" <?= $role['role_id'] == $user['role_id'] ? 'selected' : '' ?>><?= htmlspecialchars($role['role_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">Perbarui Pengguna</button>
                    <a href="index.php?modul=user&fitur=list" class="bg-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-400">
                        Back to User List
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
