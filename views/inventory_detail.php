<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Details</title>
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
          <span class="material-icons-outlined mr-2">inventory</span>
          Inventory Details
        </h1>
      </header>

      <!-- Content -->
      <div class="p-6 flex-1">
        <?php if (!$barang): ?>
          <div class="text-center text-gray-500 mt-10">
            <p>Inventory not found. Please check the Inventory ID.</p>
            <a href="index.php?modul=inventory&fitur=list" 
               class="mt-4 inline-flex items-center bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 shadow-lg transition">
              <span class="material-icons-outlined mr-2">arrow_back</span>
              Back to Inventory List
            </a>
          </div>
          <?php return; ?>
        <?php endif; ?>

        <!-- Inventory Information -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
          <h2 class="text-xl font-semibold text-gray-800 border-b pb-4 mb-4">Inventory Information</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="flex items-center">
              <span class="material-icons-outlined text-blue-700 mr-3">tag</span>
              <div>
                <p class="text-sm text-gray-500">Inventory ID</p>
                <p class="text-lg font-medium text-gray-900"><?= htmlspecialchars($barang['barang_id']) ?></p>
              </div>
            </div>

            <div class="flex items-center">
              <span class="material-icons-outlined text-blue-700 mr-3">event</span>
              <div>
                <p class="text-sm text-gray-500">Date</p>
                <p class="text-lg font-medium text-gray-900">
                  <?= !empty($barang['created_at']) ? htmlspecialchars(date('d M Y, H:i', strtotime($barang['created_at']))) : 'N/A' ?>
                </p>
              </div>
            </div> 

            <div class="flex items-center">
              <span class="material-icons-outlined text-blue-700 mr-3">local_shipping</span>
              <div>
                <p class="text-sm text-gray-500">Supplier</p>
                <p class="text-lg font-medium text-gray-900"><?= isset($barang['supplier_name']) ? htmlspecialchars($barang['supplier_name']) : 'Supplier Tidak Diketahui' ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Item Details -->
        <div class="bg-white shadow-lg rounded-lg p-6">
          <h2 class="text-xl font-semibold text-gray-800 border-b pb-4 mb-4">Item Details</h2>
          <?php if (!empty($barang['detail']) && is_array($barang['detail'])): ?>
            <div class="overflow-x-auto">
              <table class="min-w-full border-collapse border border-gray-300">
                <thead class="bg-blue-700 text-white">
                  <tr>
                    <th class="py-2 px-4 border-b text-left font-semibold">Inventory Name</th>
                    <th class="py-2 px-4 border-b text-center font-semibold">Quantity</th>
                    <th class="py-2 px-4 border-b text-center font-semibold">Price</th>
                    <th class="py-2 px-4 border-b text-center font-semibold">Reciever</th>
                    <th class="py-2 px-4 border-b text-center font-semibold">Supplier Phone</th>
                    <th class="py-2 px-4 border-b text-center font-semibold">Supplier Email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($barang['detail'] as $item): ?>
                    <tr class="even:bg-gray-50 hover:bg-blue-100">
                      <td class="py-2 px-4 border-b text-gray-800"><?= htmlspecialchars($item['barang_name']) ?></td>
                      <td class="py-2 px-4 border-b text-center text-gray-800"><?= htmlspecialchars($item['barang_quantity']) ?></td>
                      <td class="py-2 px-4 border-b text-center text-gray-800">
                        <?= 'Rp ' . number_format($item['barang_price'] ?? 0, 0, ',', '.') ?>
                      </td>
                      <td class="py-2 px-4 border-b text-center text-gray-800"><?= htmlspecialchars($item['barang_penerima']) ?></td>
                      <td class="py-2 px-4 border-b text-center text-gray-800"><?= htmlspecialchars($item['supplier_phone']) ?></td>
                      <td class="py-2 px-4 border-b text-center text-gray-800"><?= htmlspecialchars($item['supplier_email']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php else: ?>
            <p class="text-center text-gray-500">There are no detailed items associated with this inventory.</p>
          <?php endif; ?>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
          <a href="index.php?modul=inventory&fitur=list" 
             class="inline-flex items-center bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800 shadow-md transition">
            <span class="material-icons-outlined mr-2">arrow_back</span>
            Back to Inventory List
          </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
