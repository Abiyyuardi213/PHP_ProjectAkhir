<!-- Sidebar -->
<nav class="w-64 bg-[#343a40] text-white h-screen fixed overflow-y-auto">
    <div class="flex flex-col items-center py-6">
        <h5 class="text-xl font-semibold mb-4 text-center">Warehouse Management System</h5>
        <img src="https://via.placeholder.com/80" alt="User" class="rounded-full mb-3">
        <!-- <div class="flex items-center mb-6 space-x-2">
            <p class="font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
            <span class="text-sm text-gray-300">| Role: <?php echo htmlspecialchars($_SESSION['role_id']); ?></span>
        </div> -->
        <ul class="w-full">
            <li class="mb-2">
                <a href="index.php?modul=dashboard" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">home</span>
                    <span class="ml-2">Dashboard</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="index.php?modul=role&fitur=list" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">badge</span>
                    <span class="ml-2">Manage Role</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="index.php?modul=user&fitur=list" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">group</span>
                    <span class="ml-2">Manage Users</span>
                </a>
            </li>
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
            <li class="mb-2">
                <a href="index.php?modul=supplier&fitur=list" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">business</span>
                    <span class="ml-2">Manage Supplier</span>
                </a>
            </li>
            <!-- <li class="mb-2">
                <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">settings</span>
                    <span class="ml-2">Settings</span>
                </a>
            </li> -->
            <li class="mb-2">
                <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <span class="material-icons-outlined">person</span>
                    <span class="ml-2">Profile</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="index.php?modul=user&fitur=logout" class="flex items-center py-2 px-4 text-red-400 hover:bg-gray-700">
                    <span class="material-icons-outlined">logout</span>
                    <span class="ml-2">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
