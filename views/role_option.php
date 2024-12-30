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
    <header class="bg-green-700 text-white py-5 shadow-md">
      <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Choose Your Role</h1>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center py-12">
      <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Login As</h2>
        <div class="flex flex-col space-y-6">
          <?php foreach ($roles as $role): ?>
          <a href="<?= $role['link'] ?>" class="flex items-center justify-between bg-<?= $role['color'] ?>-600 text-white px-6 py-4 rounded-lg shadow hover:bg-<?= $role['color'] ?>-700 transition duration-300">
            <div class="flex items-center space-x-4">
              <span class="material-icons text-4xl">person</span>
              <div>
                <h3 class="text-xl font-semibold"><?= $role['title'] ?></h3>
                <p class="text-sm"><?= $role['description'] ?></p>
              </div>
            </div>
            <span class="material-icons">arrow_forward</span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6">
      <div class="container mx-auto px-6 text-center">
        <p class="text-sm">&copy; 2024 MyWarehouse. All rights reserved.</p>
      </div>
    </footer>
  </div>

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</body>
</html>
