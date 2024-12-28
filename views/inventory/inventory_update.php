<?php
$barang_id = $_GET['id'] ?? null;

if ($barang_id) {
    $barang = $this->modelBarang->getBarangById($barang_id);
    if (!$barang) {
        $error = "Barang tidak ditemukan.";
    }
    $suppliers = $this->modelSupplier->getAllSuppliers();
} else {
    header('Location: index.php?modul=inventory&fitur=list');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Inventory</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-5xl bg-white shadow-lg rounded-xl overflow-hidden p-8">
    <h1 class="text-3xl font-bold text-blue-700 text-center mb-6">Update Inventory</h1>

    <?php if (isset($error)) : ?>
      <div class="bg-red-500 text-white text-center p-4 mb-4 rounded-md">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <?php if (!isset($error)) : ?>
    <form action="index.php?modul=inventory&fitur=update&id=<?= htmlspecialchars($barang['barang_id']) ?>" method="POST" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Inventory Name -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Inventory Name</label>
          <input type="text" name="barang_name" value="<?= htmlspecialchars($barang['barang_name'] ?? '') ?>" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter inventory name" required>
        </div>

        <!-- Price -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Price</label>
          <input type="number" name="barang_price" value="<?= htmlspecialchars($barang['barang_price'] ?? '') ?>" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter price" min="0" required>
        </div>

        <!-- Quantity -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Quantity</label>
          <input type="number" name="barang_quantity" value="<?= htmlspecialchars($barang['barang_quantity'] ?? '') ?>" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter quantity" min="0" required>
        </div>

        <!-- Invoice ID -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Invoice ID</label>
          <input type="text" name="invoice_id" value="<?= htmlspecialchars($barang['invoice_id'] ?? '') ?>" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter invoice ID" required>
        </div>

        <!-- Recipient -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Recipient</label>
          <input type="text" name="barang_penerima" value="<?= htmlspecialchars($barang['barang_penerima'] ?? '') ?>" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter recipient name" required>
        </div>

        <!-- Supplier Phone -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Supplier Phone</label>
          <input type="text" name="supplier_phone" value="<?= htmlspecialchars($barang['supplier_phone'] ?? '') ?>" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter supplier phone" required>
        </div>

        <!-- Supplier Email -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Supplier Email</label>
          <input type="email" name="supplier_email" value="<?= htmlspecialchars($barang['supplier_email'] ?? '') ?>" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                 placeholder="Enter supplier email" required>
        </div>

        <!-- Supplier -->
        <div>
          <label class="block text-lg font-medium text-gray-700">Supplier</label>
          <select name="supplier_id" 
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                  required>
            <option value="" disabled selected>Select Supplier</option>
            <?php foreach ($suppliers as $supplier): ?>
              <option value="<?= htmlspecialchars($supplier['supplier_id']) ?>" 
                      <?= $supplier['supplier_id'] == $barang['supplier_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($supplier['supplier_name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="flex justify-between items-center mt-6">
        <a href="index.php?modul=inventory&fitur=list" 
           class="flex items-center px-6 py-3 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition">
          <span class="material-icons-outlined mr-2">arrow_back</span>
          Cancel
        </a>
        <button type="submit" 
                class="flex items-center px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
          <span class="material-icons-outlined mr-2">save</span>
          Update Inventory
        </button>
      </div>
    </form>
    <?php endif; ?>
  </div>
</body>
</html>

