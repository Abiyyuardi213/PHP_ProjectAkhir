<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Supplier</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-3xl bg-white shadow-lg rounded-xl overflow-hidden p-8">
    <h1 class="text-3xl font-bold text-blue-700 text-center mb-6">Update Supplier</h1>

    <!-- Display Error Message -->
    <?php if (!empty($errorMessage)) : ?>
      <div class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
        <span class="material-icons-outlined mr-2">error</span>
        <span><?= htmlspecialchars($errorMessage) ?></span>
      </div>
    <?php endif; ?>

    <?php if (isset($supplier) && !empty($supplier)) : ?>
      <form action="index.php?modul=supplier&fitur=update&id=<?php echo $supplier['supplier_id']; ?>" method="POST" class="space-y-6">
        <!-- Supplier Name -->
        <div>
          <label for="supplier_name" class="block text-lg font-medium text-gray-700">Supplier Name</label>
          <div class="relative">
            <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">business</span>
            <input type="text" id="supplier_name" name="supplier_name"
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                   placeholder="Enter supplier name"
                   value="<?= htmlspecialchars($supplier['supplier_name']); ?>" required>
          </div>
        </div>

        <!-- Supplier Address -->
        <div>
          <label for="supplier_address" class="block text-lg font-medium text-gray-700">Address</label>
          <textarea id="supplier_address" name="supplier_address" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter supplier address" required><?= htmlspecialchars($supplier['supplier_address']); ?></textarea>
        </div>

        <!-- Supplier Contact -->
        <div>
          <label for="supplier_phone" class="block text-lg font-medium text-gray-700">Contact Number</label>
          <div class="relative">
            <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">phone</span>
            <input type="text" id="supplier_phone" name="supplier_phone"
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                   placeholder="Enter contact number"
                   value="<?= htmlspecialchars($supplier['supplier_phone']); ?>" required>
          </div>
        </div>

        <!-- Supplier Email -->
        <div>
          <label for="supplier_email" class="block text-lg font-medium text-gray-700">Email</label>
          <div class="relative">
            <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">email</span>
            <input type="email" id="supplier_email" name="supplier_email"
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                   placeholder="Enter supplier email"
                   value="<?= htmlspecialchars($supplier['supplier_email']); ?>" required>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center">
          <a href="index.php?modul=supplier&fitur=list"
             class="flex items-center px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition">
            <span class="material-icons-outlined mr-2">arrow_back</span>
            Cancel
          </a>
          <button type="submit"
                  class="flex items-center px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
            <span class="material-icons-outlined mr-2">save</span>
            Update Supplier
          </button>
        </div>
      </form>
    <?php else : ?>
      <p class="text-center text-gray-500">Supplier not found.</p>
      <div class="text-center mt-4">
        <a href="index.php?modul=supplier&fitur=list"
           class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
           Back to Supplier List
        </a>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
