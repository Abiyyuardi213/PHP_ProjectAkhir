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
            <!-- Header -->
            <header class="bg-blue-700 text-white py-4 px-6 shadow-md">
                <h1 class="text-2xl font-bold flex items-center">
                    <span class="material-icons-outlined mr-2">group</span>
                    Management User
                </h1>
            </header>

            <!-- Content -->
            <div class="mt-4 p-6 flex-1 mt-16">
                <?php if (isset($_GET['message'])) : ?>
                    <div id="notification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-4 transform transition duration-500 ease-in-out translate-x-full" style="z-index: 9999;">
                        <span class="material-icons-outlined text-xl">check_circle</span>
                        <span><?= htmlspecialchars($_GET['message']) ?></span>
                        <button onclick="document.getElementById('notification').style.display='none'" class="ml-4 text-white hover:text-gray-200">
                            <span class="material-icons-outlined">close</span>
                        </but>
                    </div>
                <?php elseif (isset($_GET['error'])) : ?>
                    <div id="notification" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-4 transform transition duration-500 ease-in-out translate-x-full" style="z-index: 9999;">
                        <span class="material-icons-outlined text-xl">error</span>
                        <span><?= htmlspecialchars($_GET['error']) ?></span>
                        <button onclick="document.getElementById('notification').style.display='none'" class="ml-4 text-white hover:text-gray-200">
                            <span class="material-icons-outlined">close</span>
                        </button>
                    </div>
                <?php endif; ?>

                <!-- Form Pencarian -->
                <form action="index.php" method="get" class="flex items-center bg-white shadow-lg rounded-full overflow-hidden mb-6 w-full max-w-lg mx-auto">
                    <input type="hidden" name="modul" value="user">
                    <input type="hidden" name="fitur" value="list">
                    <div class="flex items-center px-4">
                        <span class="material-icons-outlined text-gray-400">search</span>
                    </div>
                    <input type="text" name="search" placeholder="Search user..." value="<?= htmlspecialchars($searchTerm ?? '') ?>"
                        class="flex-grow py-2 px-4 border-0 focus:ring-0 focus:outline-none text-gray-700 placeholder-gray-400">
                    <button type="submit" class="bg-blue-500 px-4 py-2 text-white rounded-full hover:bg-blue-600 transition duration-300 ease-in-out">
                        Search
                    </button>
                </form>

                <!-- Tombol Create User -->
                <div class="flex justify-between items-center mb-6">
                    <!-- Dropdown Sort -->
                    <div class="relative inline-block text-left">
                        <button id="sortButton" class="flex items-center bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow hover:from-gray-300 hover:to-gray-400 transition">
                            <span class="material-icons-outlined mr-2">sort</span>
                            <span>Sort</span>
                        </button>
                        <!-- Dropdown Menu -->
                        <div id="sortMenu" class="hidden absolute mt-2 w-48 rounded-lg bg-white shadow-lg z-10">
                            <a href="index.php?modul=user&fitur=sortByName&order=ASC" 
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Sort by Name (ASC)
                            </a>
                            <a href="index.php?modul=user&fitur=sortByName&order=DESC" 
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Sort by Name (DESC)
                            </a>
                            <a href="index.php?modul=user&fitur=sortById&order=ASC" 
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Sort by ID (ASC)
                            </a>
                            <a href="index.php?modul=user&fitur=sortById&order=DESC" 
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Sort by ID (DESC)
                            </a>
                        </div>
                    </div>

                    <a href="index.php?modul=user&fitur=create" 
                       class="flex items-center bg-gradient-to-r from-blue-500 to-blue-600 text-white px-5 py-3 rounded-lg shadow hover:from-blue-600 hover:to-blue-700 transition">
                        <span class="material-icons-outlined mr-2">add</span>
                        Create User
                    </a>
                </div>

                <!-- Tabel User -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead class="bg-blue-700">
                            <tr>
                                <th class="py-3 px-4 text-center text-white text-sm font-semibold">Profile Picture</th>
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
                                        <!-- Kolom Gambar Profil -->
                                        <td class="py-3 px-4 border-b border-gray-200 text-center">
                                            <?php if (!empty($user['profile_picture'])): ?>
                                                <!-- Link untuk melihat gambar profil -->
                                                <a href="index.php?modul=user&fitur=viewProfilePicture&id=<?= $user['user_id'] ?>"
                                                target="_blank"
                                                class="inline-flex items-center px-2 py-1 text-sm text-blue-500 bg-blue-100 rounded hover:bg-blue-200 transition">
                                                    <span class="material-icons-outlined mr-1">visibility</span>
                                                    View
                                                </a>
                                            <?php else: ?>
                                                <img id="profilePicturePreview-<?= htmlspecialchars($user['user_id']) ?>"
                                                    src="uploads/profile_pictures/default.jpg"
                                                    alt="Profile Picture"
                                                    class="w-12 h-12 rounded-full object-cover mx-auto">
                                                <!-- Link untuk melihat gambar profil, jika belum ada gambar -->
                                                <a href="javascript:void(0)"
                                                onclick="openModal('uploads/profile_pictures/default.jpg')"
                                                class="inline-flex items-center px-2 py-1 text-sm text-blue-500 bg-blue-100 rounded hover:bg-blue-200 transition">
                                                    <span class="material-icons-outlined mr-1">visibility</span>
                                                    View
                                                </a>
                                            <?php endif; ?>
                                        </td>
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
                                    <td colspan="6" class="py-4 px-4 text-center text-gray-500">
                                        <?php if (!empty($searchTerm)) : ?>
                                            No users found matching "<?= htmlspecialchars($searchTerm) ?>".
                                        <?php else : ?>
                                            No users available.
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="profileModal" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-4 rounded-lg">
            <img id="modalImage" src="" alt="Profile Picture" class="w-full max-w-lg rounded-lg">
            <button onclick="closeModal()" class="mt-4 px-4 py-2 text-white bg-red-500 rounded-lg">Close</button>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.classList.remove('translate-x-full');
                notification.classList.add('translate-x-0');
            }
        }, 10);

        setTimeout(() => {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 3000);

        document.getElementById('sortButton').addEventListener('click', function() {
            const menu = document.getElementById('sortMenu');
            menu.classList.toggle('hidden');
        });

        window.addEventListener('click', function(e) {
            const menu = document.getElementById('sortMenu');
            const button = document.getElementById('sortButton');
            if (!button.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });

        function updateProfilePicturePreview(event, userId) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImg = document.getElementById(`profilePicturePreview-${userId}`);
                    previewImg.src = e.target.result;  // Update gambar preview dengan gambar yang dipilih
                };
                reader.readAsDataURL(file);  // Membaca file gambar sebagai data URL
            }
        }

        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('profileModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('profileModal').classList.add('hidden');
        }
    </script>
</body>
</html>
