<?php
session_start();
$modul = $_GET['modul'] ?? 'dashboard';
$fitur = $_GET['fitur'] ?? 'list';

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

    default:
        echo "<h1>404 - Modul Tidak Ditemukan</h1>";
        include 'views/dashboard.php';
        break;
}