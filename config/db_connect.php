<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "projectakhir";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// echo "Koneksi berhasil!";