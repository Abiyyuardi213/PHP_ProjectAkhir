<nav class="bg-gray-800 shadow-md px-6 py-4 flex items-center justify-between">
    <!-- Search Bar (Tengah) -->
    <div class="relative max-w-md mx-auto w-full">
        <input 
            type="text" 
            placeholder="Search..." 
            class="pl-10 pr-4 py-2 w-full bg-gray-100 rounded-full focus:ring-2 focus:ring-indigo-500 focus:outline-none"
        />
        <svg 
            xmlns="http://www.w3.org/2000/svg" 
            class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor" 
            stroke-width="2">
            <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M8 16l-4 4m0 0l4-4m-4 4h16"/>
        </svg>
    </div>

    <!-- Profile Menu (Kanan) -->
    <div class="relative">
        <button 
            id="profileMenuButton" 
            class="flex items-center focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg">
            <img 
                src="https://via.placeholder.com/40" 
                alt="Profile Picture" 
                class="w-10 h-10 rounded-full"
            />
            <span class="ml-2 text-white font-medium">Amelya Sofia</span>
            <svg 
                xmlns="http://www.w3.org/2000/svg" 
                class="ml-2 h-5 w-5 text-gray-300" 
                viewBox="0 0 20 20" 
                fill="currentColor">
                <path 
                    fill-rule="evenodd" 
                    d="M5.293 9.707a1 1 0 011.414 0L10 13.586l3.293-3.879a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" 
                    clip-rule="evenodd"/>
            </svg>
        </button>
        <div 
            id="profileMenuDropdown" 
            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
            <a href="index.php?modul=profile&fitur=edit" class="block px-4 py-2 text-gray-700 hover:bg-indigo-100">
                Edit Profile
            </a>
            <a href="logout.php" class="block px-4 py-2 text-gray-700 hover:bg-indigo-100">
                Sign Out
            </a>
        </div>
    </div>
</nav>

<script>
    const profileMenuButton = document.getElementById('profileMenuButton');
    const profileMenuDropdown = document.getElementById('profileMenuDropdown');

    profileMenuButton.addEventListener('click', () => {
        profileMenuDropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
        if (!profileMenuButton.contains(e.target)) {
            profileMenuDropdown.classList.add('hidden');
        }
    });
</script>
