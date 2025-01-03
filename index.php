<?php
session_start();

$modul = $_GET['modul'] ?? 'home';
$fitur = $_GET['fitur'] ?? 'list';

switch ($modul) {
    case 'home':
        include 'views/role_option.php';
        break;

    case 'dashboard':
        include 'views/dashboard.php';
        break;

    case 'customer_dashboard':
        require_once './controllers/controller_pembelian.php';
        $controllerPembelian = new ControllerPembelian($conn);
        $controllerPembelian->handleRequestPembelian($fitur);
        // include 'views/customer/customer_dashboard.php';
        break;

    case 'client':
        require_once './controllers/controller_client.php';
        $controllerClient = new ControllerClient();
        $controllerClient->handleRequestClient($fitur);
        break;

    case 'role':
        require_once './controllers/controller_role.php';
        $controllerRole = new controllerRole();
        $controllerRole->handleRequestRole($fitur);
        break;

    case 'user':
        require_once './controllers/controller_user.php';
        $controllerUser = new controllerUser();
        $controllerUser->handleRequestUser($fitur);
        break;

    case 'inventory':
        require_once './controllers/controller_barang.php';
        $controllerBarang = new controllerBarang($conn);
        $controllerBarang->handleRequestBarang($fitur);
        break;

    case 'transactions':
        require_once './controllers/controller_transaksi.php';
        $controllerTransaction = new ControllerTransaksi($conn);
        $controllerTransaction->handleRequestTransaksi($fitur);
        break;

    case 'customer':
        require_once './controllers/controller_customer.php';
        $controllerCustomer = new ControllerCustomer($conn);
        $controllerCustomer->handleRequestCustomer($fitur);
        break;

    case 'supplier':
        require_once './controllers/controller_supplier.php';
        $controllerSupplier = new ControllerSupplier($conn);
        $controllerSupplier->handleRequestSupplier($fitur);
        break;

    default:
        echo "<h1>404 - Modul Tidak Ditemukan</h1>";
        include 'views/dashboard_home.php';
        break;
}
