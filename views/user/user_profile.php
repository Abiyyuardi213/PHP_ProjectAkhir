<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include './views/includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="ml-64 flex flex-col flex-grow">

            <!-- Header -->
            <header class="bg-blue-700 text-white py-4 px-6 shadow-md">
                <h1 class="text-2xl font-bold flex items-center">
                    <span class="material-icons-outlined mr-2">person</span>
                    Profile
                </h1>
            </header>

            <!-- Content -->
            <main class="mt-4 px-6 py-4">
                <h1 class="text-3xl font-semibold mb-6">Your's Personal Information</h1>
            </main>
        </div>
    </div>
</body>
</html>
