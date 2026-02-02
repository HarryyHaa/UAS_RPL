<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sortir_lacation"; 

// Ganti $conn menjadi $koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Tambahkan charset UTF-8
mysqli_set_charset($koneksi, "utf8mb4");
?>