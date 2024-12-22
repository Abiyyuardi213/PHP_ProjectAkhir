<?php
// Ensure variables are initialized before use
$barang_name = isset($barang_name) ? $barang_name : '';
$barang_quantity = isset($barang_quantity) ? $barang_quantity : '';
$barang_price = isset($barang_price) ? $barang_price : '';
$invoice_id = isset($invoice_id) ? $invoice_id : '';
$barang_penerima = isset($barang_penerima) ? $barang_penerima : '';
$supplier_phone = isset($supplier_phone) ? $supplier_phone : '';
$supplier_email = isset($supplier_email) ? $supplier_email : '';
$barang_status = isset($barang_status) ? $barang_status : '1'; // Default to "Available"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Inventory</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-3xl bg-white shadow-lg rounded-xl overflow-hidden p-8">
    <h1 class="text-3xl font-bold text-blue-700 text-center mb-6">Add Inventory</h1>

    <!-- Display Error Message -->
    <?php if (!empty($errorMessage)) : ?>
      <div class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
        <span class="material-icons-outlined mr-2">error</span>
        <span><?= htmlspecialchars($errorMessage) ?></span>
      </div>
    <?php endif; ?>

    <form action="index.php?modul=inventory&fitur=create" method="POST" class="space-y-6">
      <!-- Supplier Select (Moved to the beginning) -->
      <div>
        <label for="supplier_id" class="block text-lg font-medium text-gray-700">Supplier</label>
        <select id="supplier_id" name="supplier_id" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                required>
          <option value="" disabled selected>Select Supplier</option>
          <?php foreach ($suppliers as $supplier): ?>
            <option value="<?= htmlspecialchars($supplier['supplier_id']) ?>">
              <?= htmlspecialchars($supplier['supplier_name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Inventory Name -->
        <div>
          <label for="barang_name" class="block text-lg font-medium text-gray-700">Inventory Name</label>
          <div class="relative">
            <span class="material-icons-outlined absolute left-3 top-2.5 text-gray-400">inventory</span>
            <input type="text" id="barang_name" name="barang_name" 
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                   placeholder="Enter inventory name" value="<?= htmlspecialchars($barang_name) ?>" required>
          </div>
        </div>

        <!-- Price -->
        <div>
          <label for="barang_price" class="block text-lg font-medium text-gray-700">Price</label>
          <input type="number" id="barang_price" name="barang_price" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter price" min="0" value="<?= htmlspecialchars($barang_price) ?>" required>
        </div>

        <!-- Quantity -->
        <div>
          <label for="barang_quantity" class="block text-lg font-medium text-gray-700">Quantity</label>
          <input type="number" id="barang_quantity" name="barang_quantity" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter quantity" min="0" value="<?= htmlspecialchars($barang_quantity) ?>" required>
        </div>

        <!-- Invoice ID -->
        <div>
          <label for="invoice_id" class="block text-lg font-medium text-gray-700">Invoice ID</label>
          <input type="text" id="invoice_id" name="invoice_id" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter invoice ID" value="<?= htmlspecialchars($invoice_id) ?>" required>
        </div>

        <!-- Recipient -->
        <div>
          <label for="barang_penerima" class="block text-lg font-medium text-gray-700">Recipient</label>
          <input type="text" id="barang_penerima" name="barang_penerima" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter recipient name" value="<?= htmlspecialchars($barang_penerima) ?>" required>
        </div>

        <!-- Supplier Phone -->
        <div>
          <label for="supplier_phone" class="block text-lg font-medium text-gray-700">Supplier Phone</label>
          <input type="text" id="supplier_phone" name="supplier_phone" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter supplier phone" value="<?= htmlspecialchars($supplier_phone) ?>" required>
        </div>

        <!-- Supplier Email -->
        <div>
          <label for="supplier_email" class="block text-lg font-medium text-gray-700">Supplier Email</label>
          <input type="email" id="supplier_email" name="supplier_email" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter supplier email" value="<?= htmlspecialchars($supplier_email) ?>" required>
        </div>
      </div>

      <!-- Status Select -->
      <div>
        <label for="barang_status" class="block text-lg font-medium text-gray-700">Status</label>
        <select id="barang_status" name="barang_status" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
          <option value="1" <?= ($barang_status == '1') ? 'selected' : '' ?>>Available</option>
          <option value="0" <?= ($barang_status == '0') ? 'selected' : '' ?>>Out of Stock</option>
        </select>
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-between items-center mt-6">
        <a href="index.php?modul=inventory" 
           class="flex items-center px-6 py-3 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition">
          <span class="material-icons-outlined mr-2">arrow_back</span>
          Cancel
        </a>
        <button type="submit" 
                class="flex items-center px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
          <span class="material-icons-outlined mr-2">save</span>
          Save Inventory
        </button>
      </div>
    </form>
  </div>
</body>
<script>
  // JavaScript untuk menangani perubahan pada dropdown supplier
  document.getElementById('supplier_id').addEventListener('change', function() {
    var supplierId = this.value;

    if (supplierId) {
        fetch('ajax/get_supplier_data.php?supplier_id=' + supplierId)
            .then(response => response.json())
            .then(data => {
                console.log(data);

                if (data && data.supplier_phone && data.supplier_email) {
                    document.getElementById('supplier_phone').value = data.supplier_phone;
                    document.getElementById('supplier_email').value = data.supplier_email;
                } else {
                    console.log('Data supplier tidak ditemukan');
                }
            })
            .catch(error => console.error('Error fetching supplier data:', error));
    }
  });
</script>
</html>
