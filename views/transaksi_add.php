<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Transaction</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="ml-64 flex flex-col flex-grow">
            <!-- Navbar -->
            <?php include 'includes/navbar.php'; ?>

            <!-- Content -->
            <div class="p-6 flex-1 mt-16">
                <h1 class="text-3xl font-semibold text-gray-900 mb-8">Add New Transaction</h1>

                <!-- Form Section -->
                <form action="index.php?modul=transactions&fitur=create" method="POST" class="bg-white shadow-md rounded-lg p-6">
                    <!-- User Selection -->
                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700 font-semibold mb-2">User</label>
                        <select id="user_id" name="user_id" class="block w-full border border-gray-300 rounded-md px-3 py-2" required>
                            <option value="" disabled selected>Select a user</option>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= htmlspecialchars($user['user_id']) ?>"><?= htmlspecialchars($user['username']) ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>No users available</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Item Selection -->
                    <div class="mb-4">
                        <label for="id_barang" class="block text-gray-700 font-semibold mb-2">Item</label>
                        <select id="id_barang" class="block w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="" disabled selected>Select an item</option>
                            <?php if (!empty($barangs)): ?>
                                <?php foreach ($barangs as $barang): ?>
                                    <option value="<?= htmlspecialchars($barang['barang_id'] ?? '') ?>" 
                                            data-name="<?= htmlspecialchars($barang['barang_name'] ?? '') ?>" 
                                            data-price="<?= htmlspecialchars($barang['barang_price'] ?? '0') ?>">
                                        <?= htmlspecialchars($barang['barang_name'] ?? '') ?> - 
                                        Rp <?= isset($barang['barang_price']) ? number_format($barang['barang_price'], 0, ',', '.') : '0' ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>No items available</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Selected Products Table -->
                    <div class="mt-8 max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Selected Products</h2>
                        <table class="w-full bg-white border border-gray-300 rounded-lg" id="barangTable">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">Barang Name</th>
                                    <th class="py-2 px-4 border-b">Price</th>
                                    <th class="py-2 px-4 border-b">Quantity</th>
                                    <th class="py-2 px-4 border-b">Total</th>
                                    <th class="py-2 px-4 border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="barangTableBody"></tbody>
                        </table>
                    </div>

                    <!-- Total Price -->
                    <div class="mb-4">
                        <label for="total_amount" class="block text-gray-700 font-semibold mb-2">Total Amount</label>
                        <input type="text" id="total_price_display" class="block w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100" readonly>
                        <input type="hidden" id="total_amount" name="total_amount">
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6 flex justify-between items-center">
                        <a href="index.php?modul=transactions&fitur=list" 
                        class="inline-flex items-center bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 shadow-lg transition">
                            <span class="material-icons-outlined mr-2">arrow_back</span>
                            Back to Transactions
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 shadow-lg transition">
                            <span class="material-icons-outlined mr-2">add_circle</span>
                            Add Transaction
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const CURRENCY_SYMBOL = "Rp";
        const barangSelect = document.getElementById('id_barang');
        const barangTableBody = document.getElementById('barangTableBody');
        const totalPriceDisplay = document.getElementById('total_price_display');
        const totalPriceInput = document.getElementById('total_amount');
        let selectedItems = [];

        barangSelect.addEventListener('change', () => {
            const selectedOption = barangSelect.options[barangSelect.selectedIndex];
            const barangId = selectedOption.value;
            const barangName = selectedOption.getAttribute('data-name');
            const barangPrice = parseFloat(selectedOption.getAttribute('data-price'));
            if (!barangId) return;

            const existingItem = selectedItems.find(item => item.id === barangId);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                selectedItems.push({ id: barangId, name: barangName, price: barangPrice, quantity: 1 });
            }
            renderTable();
        });

        function renderTable() {
            barangTableBody.innerHTML = '';
            let total = 0;

            selectedItems.forEach((item, index) => {
                total += item.price * item.quantity;

                barangTableBody.innerHTML += `
                    <tr>
                        <td class="py-2 px-4 border-b text-center">${item.name}</td>
                        <td class="py-2 px-4 border-b text-center">${CURRENCY_SYMBOL} ${item.price.toLocaleString()}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="number" class="w-16 text-center border rounded" value="${item.quantity}" data-index="${index}" onchange="updateQuantity(${index}, this.value)">
                        </td>
                        <td class="py-2 px-4 border-b text-center">${CURRENCY_SYMBOL} ${(item.price * item.quantity).toLocaleString()}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <button type="button" class="text-red-500" onclick="removeItem(${index})">Remove</button>
                        </td>
                    </tr>
                    <input type="hidden" name="barang_id[]" value="${item.id}">
                    <input type="hidden" name="quantity[]" value="${item.quantity}">
                `;
            });

            totalPriceDisplay.value = `${CURRENCY_SYMBOL} ${total.toLocaleString()}`;
            totalPriceInput.value = total;
        }

        function updateQuantity(index, newQuantity) {
            if (newQuantity < 1) newQuantity = 1; // Pastikan quantity tidak kurang dari 1
            selectedItems[index].quantity = parseInt(newQuantity);
            renderTable();
        }

        function removeItem(index) {
            selectedItems.splice(index, 1);
            renderTable();
        }
    </script>
</body>
</html>
