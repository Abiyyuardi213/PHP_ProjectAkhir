<!-- Sidebar -->
<nav class="w-64 bg-[#343a40] text-white h-screen fixed overflow-y-auto">
    <div class="flex flex-col items-center py-6">
        <h5 class="text-xl font-semibold mb-4 text-center">Warehouse Management System</h5>
        <?php
        $profilePicture = $_SESSION['profile_picture'] ?? 'https://via.placeholder.com/80';
        if ($profilePicture !== 'https://via.placeholder.com/80') {
            $profilePicture = 'uploads/profile_pictures/' . $profilePicture;
        }
        ?>
        <img src="<?php echo htmlspecialchars($profilePicture); ?>" 
            alt="User" 
            class="rounded-full mb-3" 
            style="width: 80px; height: 80px; object-fit: cover;">
        <div class="flex items-center mb-6 space-x-2">
            <p class="font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
            <span class="text-sm text-gray-300">| <?php echo htmlspecialchars($_SESSION['role_name'] ?? 'Unknown'); ?></span>
        </div>
        <ul class="w-full">
            <li class="mb-2">
                <a href="index.php?modul=dashboard" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">home</span>
                    <span class="ml-2">Dashboard</span>
                </a>
            </li>
            <?php if (in_array($_SESSION['role_name'], ['Admin', 'Super Admin'])) { ?>
            <li class="mb-2">
                <a href="index.php?modul=role&fitur=list" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">badge</span>
                    <span class="ml-2">Manage Role</span>
                </a>
            </li>
            <?php } ?>
            <?php if (in_array($_SESSION['role_name'], ['Admin', 'Super Admin'])) { ?>
            <li class="mb-2">
                <a href="index.php?modul=user&fitur=list" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">group</span>
                    <span class="ml-2">Manage Users</span>
                </a>
            </li>
            <?php } ?>
            <li class="mb-2">
                <a href="index.php?modul=inventory&fitur=list" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">inventory</span>
                    <span class="ml-2">Manage Inventory</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="index.php?modul=transactions&fitur=list" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">shopping_cart</span>
                    <span class="ml-2">Transactions</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="index.php?modul=customer&fitur=list" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">supervisor_account</span>
                    <span class="ml-2">Manage Customers</span>
                </a>
            </li>
            <?php if (in_array($_SESSION['role_name'], ['Admin', 'Super Admin'])) { ?>
            <li class="mb-2">
                <a href="index.php?modul=supplier&fitur=list" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">business</span>
                    <span class="ml-2">Manage Supplier</span>
                </a>
            </li>
            <?php } ?>
            <li class="mb-2">
                <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">person</span>
                    <span class="ml-2">Profile</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="#" onclick="showLogoutModal()" class="flex items-center py-2 px-4 text-red-300 hover:bg-gray-700">
                    <span class="material-icons-outlined">logout</span>
                    <span class="ml-2">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full z-60">
        <h2 class="text-2xl font-bold mb-4">Confirm Logout</h2>
        <p class="text-gray-700 mb-4">Are you sure you want to logout?</p>
        <div class="flex justify-end space-x-4">
            <button onclick="hideLogoutModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Cancel</button>
            <a href="index.php?modul=user&fitur=logout" onclick="setLogoutSuccess()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Logout</a>
        </div>
    </div>
</div>

<script>
    function showLogoutModal() {
        document.getElementById('logoutModal').classList.remove('hidden');
        // Mengubah tampilan sidebar dan card agar lebih gelap
        document.body.style.backgroundColor = "rgba(0, 0, 0, 0.3)"; // Menambahkan efek gelap pada seluruh halaman
    }

    function hideLogoutModal() {
        document.getElementById('logoutModal').classList.add('hidden');
        // Mengembalikan tampilan halaman ke normal
        document.body.style.backgroundColor = ""; // Menghapus efek gelap
    }

    function setLogoutSuccess() {
        <?php $_SESSION['logout_success'] = true; ?>
    }
</script>
