<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Choose Role - Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

  <!-- Wrapper -->
  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-gradient-to-r from-green-700 via-green-800 to-green-900 text-white py-5 shadow-md">
      <div class="container mx-auto px-4 md:px-6 flex flex-col md:flex-row justify-between items-center">
        <div class="flex items-center space-x-3">
          <span class="material-icons text-3xl">groups</span>
          <h1 class="text-xl md:text-2xl font-bold">Role Option As</h1>
        </div>
        <a href="index.php" class="flex items-center space-x-2 text-white hover:text-gray-200 transition mt-4 md:mt-0">
          <span class="material-icons text-xl">home</span>
          <span class="font-semibold">Home</span>
        </a>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center py-8 px-4 md:px-6">
      <div class="bg-white shadow-xl rounded-xl p-6 md:p-10 w-full max-w-md">
        <h2 class="text-xl md:text-2xl font-bold text-gray-800 text-center mb-6">Login As</h2>
        <div class="flex flex-col space-y-4">
          <!-- Admin Button -->
          <a href="index.php?modul=user&fitur=login" class="group flex flex-col sm:flex-row items-center justify-between bg-blue-600 text-white px-6 py-5 rounded-lg shadow-lg hover:bg-blue-700 transform hover:-translate-y-1 hover:shadow-xl transition duration-300" onclick="showLoading(this)">
            <div class="flex items-center space-x-4">
              <span class="material-icons text-4xl group-hover:scale-110 transform transition duration-300">admin_panel_settings</span>
              <div>
                <h3 class="text-lg md:text-xl font-semibold">Admin</h3>
                <p class="text-sm text-blue-200">Manage warehouse operations</p>
              </div>
            </div>
            <span class="material-icons hidden sm:block">arrow_forward</span>
          </a>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-4">
      <div class="container mx-auto px-4 text-center">
        <p class="text-xs md:text-sm">&copy; 2024 MyWarehouse. All rights reserved.</p>
      </div>
    </footer>
  </div>

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <script>
    function showLoading(button) {
      // Disable the button to prevent multiple clicks
      button.disabled = true;

      // Change the innerHTML to show a smooth loading animation
      button.innerHTML = `
        <div class="flex items-center justify-center">
          <svg class="animate-spin h-6 w-6 mr-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291l-2.146 2.146c-.63.63-.184 1.707.707 1.707H6a8.1 8.1 0 01-2-.291z"></path>
          </svg>
          <span class="text-white text-lg font-semibold">Loading...</span>
        </div>
      `;

      // Delay the navigation for a better UX
      setTimeout(() => {
        window.location.href = button.getAttribute('href');
      }, 1500); // Adjust duration here (1500ms = 1.5 seconds)
    }
  </script>
</body>
</html>
