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
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-xl overflow-hidden p-8">
        <h1 class="text-3xl font-bold text-blue-700 text-center mb-6">Update User</h1>

        <!-- Display Error Message -->
        <?php if (isset($error)) : ?>
            <div class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                <span class="material-icons-outlined mr-2">error</span>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <form action="index.php?modul=user&fitur=update&id=<?= $user_id ?>" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kiri -->
            <div class="space-y-6">
                <!-- Nama Pengguna -->
                <div>
                    <label for="user_name" class="block text-lg font-medium text-gray-700">Nama Pengguna</label>
                    <div class="relative">
                        <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">person</span>
                        <input type="text" id="user_name" name="user_name" value="<?= htmlspecialchars($user['user_name']) ?>"
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="Enter full name" required>
                    </div>
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-lg font-medium text-gray-700">Username</label>
                    <div class="relative">
                        <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">account_circle</span>
                        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>"
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="Enter username" required>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-lg font-medium text-gray-700">Password (kosongkan jika tidak ingin mengubah)</label>
                    <div class="relative">
                        <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">lock</span>
                        <input type="password" id="password" name="password"
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="Enter new password">
                    </div>
                </div>

                <!-- Role -->
                <div>
                    <label for="role_id" class="block text-lg font-medium text-gray-700">Role</label>
                    <div class="relative">
                        <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">supervisor_account</span>
                        <select id="role_id" name="role_id"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                required>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['role_id'] ?>" <?= $role['role_id'] == $user['role_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($role['role_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Kanan -->
            <div class="space-y-6">
                <!-- Email -->
                <div>
                    <label for="user_email" class="block text-lg font-medium text-gray-700">Email</label>
                    <div class="relative">
                        <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">email</span>
                        <input type="email" id="user_email" name="user_email" value="<?= htmlspecialchars($user['user_email']) ?>"
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="Enter email address" required>
                    </div>
                </div>

                <!-- Telepon -->
                <div>
                    <label for="user_phone" class="block text-lg font-medium text-gray-700">Telepon</label>
                    <div class="relative">
                        <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">phone</span>
                        <input type="text" id="user_phone" name="user_phone" value="<?= htmlspecialchars($user['user_phone']) ?>"
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="Enter phone number" required>
                    </div>
                </div>

                <!-- Profile Picture -->
                <div>
                    <label for="profile_picture" class="block text-lg font-medium text-gray-700">Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                           class="w-full px-4 py-2 border rounded-md">
                    <?php if (!empty($user['profile_picture'])) : ?>
                        <div class="mt-3">
                            <p class="text-gray-500">Current Picture:</p>
                            <img src="uploads/<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture" class="w-20 h-20 rounded-full border">
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="md:col-span-2 flex justify-between items-center">
                <a href="index.php?modul=user&fitur=list"
                   class="flex items-center px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition">
                    <span class="material-icons-outlined mr-2">arrow_back</span>
                    Cancel
                </a>
                <button type="submit"
                        class="flex items-center px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                    <span class="material-icons-outlined mr-2">save</span>
                    Update User
                </button>
            </div>
        </form>
    </div>
</body>
</html>
