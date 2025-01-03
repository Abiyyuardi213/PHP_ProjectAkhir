<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Multiple Inventories</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-5xl bg-white shadow-lg rounded-xl overflow-hidden p-8">
    <h1 class="text-3xl font-bold text-blue-700 text-center mb-6">Add Multiple Inventories</h1>

    <form action="index.php?modul=inventory&fitur=create" method="POST" enctype="multipart/form-data" class="space-y-6">
      <div id="barang-container">
        <div class="barang-item border p-4 rounded-lg mb-4 bg-gray-50">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Inventory Name -->
            <div>
              <label class="block text-lg font-medium text-gray-700">Inventory Name</label>
              <input type="text" name="barangs[0][barang_name]" 
                     class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                     placeholder="Enter inventory name" required>
            </div>

            <!-- Price -->
            <div>
              <label class="block text-lg font-medium text-gray-700">Price</label>
              <input type="number" name="barangs[0][barang_price]" 
                     class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                     placeholder="Enter price" min="0" required>
            </div>

            <!-- Quantity -->
            <div>
              <label class="block text-lg font-medium text-gray-700">Quantity</label>
              <input type="number" name="barangs[0][barang_quantity]"
                     class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                     placeholder="Enter quantity" min="0" required>
            </div>

            <!-- Invoice ID -->
            <div>
              <label class="block text-lg font-medium text-gray-700">Invoice ID</label>
              <input type="text" name="barangs[0][invoice_id]" 
                     class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                     placeholder="Enter invoice ID" required>
            </div>

            <!-- Recipient -->
            <div>
              <label class="block text-lg font-medium text-gray-700">Recipient</label>
              <input type="text" name="barangs[0][barang_penerima]" 
                     class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                     placeholder="Enter recipient name" required>
            </div>

            <!-- Supplier Phone -->
            <div>
              <label class="block text-lg font-medium text-gray-700">Supplier Phone</label>
              <input type="text" name="barangs[0][supplier_phone]" 
                     class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                     placeholder="Enter supplier phone" required>
            </div>

            <!-- Supplier Email -->
            <div>
              <label class="block text-lg font-medium text-gray-700">Supplier Email</label>
              <input type="email" name="barangs[0][supplier_email]" 
                     class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                     placeholder="Enter supplier email" required>
            </div>

            <!-- Supplier -->
            <div>
              <label class="block text-lg font-medium text-gray-700">Supplier</label>
              <select name="barangs[0][supplier_id]" 
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

            <!-- Product Picture -->
            <div>
              <label class="block text-lg font-medium text-gray-700">Product Picture</label>
              <input type="file" name="product_picture" 
                     class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
          </div>
        </div>
      </div>

      <button type="button" onclick="addBarang()" 
              class="flex items-center px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
        <span class="material-icons-outlined mr-2">add</span>
        Add Another Inventory
      </button>

      <div class="flex justify-between items-center mt-6">
        <a href="index.php?modul=inventory" 
           class="flex items-center px-6 py-3 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition">
          <span class="material-icons-outlined mr-2">arrow_back</span>
          Cancel
        </a>
        <button type="submit" 
                class="flex items-center px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
          <span class="material-icons-outlined mr-2">save</span>
          Save Inventories
        </button>
      </div>
    </form>
  </div>

  <script>
    function addBarang() {
      const container = document.getElementById('barang-container');
      const index = container.children.length;

      const newItem = document.createElement('div');
      newItem.className = 'barang-item border p-4 rounded-lg mb-4 bg-gray-50';
      newItem.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-lg font-medium text-gray-700">Inventory Name</label>
            <input type="text" name="barangs[${index}][barang_name]" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                   placeholder="Enter inventory name" required>
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Price</label>
            <input type="number" name="barangs[${index}][barang_price]" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                   placeholder="Enter price" min="0" required>
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Quantity</label>
            <input type="number" name="barangs[${index}][barang_quantity]" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                   placeholder="Enter quantity" min="0" required>
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Invoice ID</label>
            <input type="text" name="barangs[${index}][invoice_id]" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                   placeholder="Enter invoice ID" required>
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Recipient</label>
            <input type="text" name="barangs[${index}][barang_penerima]" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                   placeholder="Enter recipient name" required>
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Supplier Phone</label>
            <input type="text" name="barangs[${index}][supplier_phone]" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                   placeholder="Enter supplier phone" required>
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Supplier Email</label>
            <input type="email" name="barangs[${index}][supplier_email]" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                   placeholder="Enter supplier email" required>
          </div>
          <div>
            <label class="block text-lg font-medium text-gray-700">Supplier</label>
            <select name="barangs[${index}][supplier_id]" 
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
          <div>
            <label class="block text-lg font-medium text-gray-700">Product Picture</label>
            <input type="file" name="product_picture" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
          </div>
        </div>`;
      container.appendChild(newItem);
    }
  </script>
</body>
</html>
