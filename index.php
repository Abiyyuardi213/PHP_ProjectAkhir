<?php
session_start();

$modul = $_GET['modul'] ?? 'dashboard';
$fitur = $_GET['fitur'] ?? 'list';

// Redirect to login if user is not authenticated and not already on the login page
if (!isset($_SESSION['user_id']) && !($modul === 'user' && $fitur === 'login')) {
    header("Location: index.php?modul=user&fitur=login");
    exit();
}

switch ($modul) {
    case 'dashboard':
        include 'views/dashboard.php';
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
