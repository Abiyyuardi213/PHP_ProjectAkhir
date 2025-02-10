<?php

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$message = $_GET['error'] ?? "";
$logoutSuccess = isset($_SESSION['logout_success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-700 via-blue-800 to-blue-900 text-white py-5 shadow-md">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center space-x-3">
            <i class="fas fa-tools text-3xl"></i>
                <h1 class="text-2xl font-bold">Admin Panel</h1>
            </div>
            <a href="index.php" class="text-white hover:text-gray-200 flex items-center space-x-2 transition">
                <i class="fas fa-home text-xl"></i>
                <span class="font-semibold">Home</span>
            </a>
        </div>
    </header>
    <!-- Main Content -->
    <div class="flex-grow flex items-center justify-center px-4 sm:px-0">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-3xl font-bold text-center text-indigo-600 mb-6">
                <span class="inline-block mr-2">
                    <svg class="w-6 h-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c3.866 0 7-3.134 7-7S15.866 0 12 0 5 3.134 5 7s3.134 7 7 7zm0 2c-4.418 0-8 3.582-8 8v1h16v-1c0-4.418-3.582-8-8-8z" />
                    </svg>
                </span>
                Login User
            </h2>
            <?php if ($message) { ?>
                <div class="bg-red-100 text-red-700 border-l-4 border-red-500 p-4 mb-6">
                    <p><?php echo htmlspecialchars($message); ?></p>
                </div>
            <?php } ?>
            <form method="POST" action="index.php?modul=user&fitur=login" class="space-y-4" onsubmit="showLoading()">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? bin2hex(random_bytes(32))); ?>">
                <div>
                    <label for="username" class="block text-gray-700 font-semibold">Username</label>
                    <input type="text" name="username" id="username" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter your username">
                </div>
                <div class="relative">
                    <label for="password" class="block text-gray-700 font-semibold">Password</label>
                    <div class="flex items-center">
                        <input type="password" name="password" id="password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter your password">
                        <button type="button" onclick="togglePasswordVisibility()" class="ml-2 text-gray-600">
                            <i id="eye-icon" class="fas fa-eye w-5 h-5"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" id="loginButton" class="w-full py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition flex justify-center items-center">
                    <span id="buttonText">Login</span>
                    <svg id="loadingSpinner" class="hidden w-5 h-5 ml-2 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291l-2.146 2.146c-.63.63-.184 1.707.707 1.707H6a8.1 8.1 0 01-2-.291z"></path>
                    </svg>
                </button>
            </form>
            <a href="index.php" class="block text-center mt-4 text-indigo-600 hover:underline">Back to Role Selection</a>
        </div>
    </div>

    <!-- Logout Modal -->
    <?php if ($logoutSuccess) { ?>
        <div id="logoutSuccessModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 px-4 sm:px-0">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Logout Berhasil</h2>
                    <button onclick="closeLogoutModal()" class="text-gray-500 hover:text-gray-700">
                        <span class="material-icons-outlined">close</span>
                    </button>
                </div>
                <p class="text-gray-700">Anda telah berhasil logout.</p>
                <button onclick="closeLogoutModal()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">OK</button>
            </div>
        </div>
        <?php unset($_SESSION['logout_success']); ?>
    <?php } ?>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto px-6 text-center">
            <p class="text-sm">&copy; 2024 MyWarehouse. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }

        function showLoading() {
            const buttonText = document.getElementById("buttonText");
            const loadingSpinner = document.getElementById("loadingSpinner");

            buttonText.classList.add("hidden");
            loadingSpinner.classList.remove("hidden");
            document.getElementById("loginButton").disabled = true;
        }

        function closeLogoutModal() {
            document.getElementById('logoutSuccessModal').style.display = 'none';
        }
    </script>
</body>
</html>
