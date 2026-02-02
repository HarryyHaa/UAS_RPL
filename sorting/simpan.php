<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Validasi apakah semua field terisi
    if (empty($_POST['no_resi'])) {
        die("<h3 style='color:red;'>Error: No Resi tidak boleh kosong! Silakan pilih No Resi dari dropdown.</h3><a href='tambah.php'>Kembali</a>");
    }
    
    if (empty($_POST['lokasi_penerima'])) {
        die("<h3 style='color:red;'>Error: Lokasi Penerima tidak boleh kosong!</h3><a href='tambah.php'>Kembali</a>");
    }
    
    if (empty($_POST['id_penerima'])) {
        die("<h3 style='color:red;'>Error: ID Penerima tidak terisi! Pastikan Anda memilih No Resi dari dropdown.</h3><a href='tambah.php'>Kembali</a>");
    }
    
    if (empty($_POST['gudang'])) {
        die("<h3 style='color:red;'>Error: Gudang tidak terisi! Pastikan Anda memilih No Resi dari dropdown.</h3><a href='tambah.php'>Kembali</a>");
    }
    
    if (empty($_POST['status_pengiriman'])) {
        die("<h3 style='color:red;'>Error: Status Pengiriman tidak boleh kosong!</h3><a href='tambah.php'>Kembali</a>");
    }
    
    // Ambil data dari form
    $no_resi = trim($_POST['no_resi']);
    $lokasi = trim($_POST['lokasi_penerima']);
    $id_penerima = trim($_POST['id_penerima']);
    $gudang = trim($_POST['gudang']);
    $status = trim($_POST['status_pengiriman']);
    
    // Debug: Tampilkan data yang diterima
    echo "<h3>Data yang diterima:</h3>";
    echo "No Resi: $no_resi<br>";
    echo "Lokasi: $lokasi<br>";
    echo "ID Penerima: $id_penerima<br>";
    echo "Gudang: $gudang<br>";
    echo "Status: $status<br><br>";
    
    // Cek apakah no_resi sudah ada di database
    $check_query = "SELECT * FROM sortir WHERE no_resi = ? AND id_penerima = ?";
    $check_stmt = mysqli_prepare($koneksi, $check_query);
    mysqli_stmt_bind_param($check_stmt, "ss", $no_resi, $id_penerima);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "<h3 style='color:red;'>✗ Data dengan No Resi '$no_resi' dan ID Penerima '$id_penerima' sudah ada!</h3>";
        echo "<a href='tambah.php'>Kembali</a>";
        mysqli_stmt_close($check_stmt);
        mysqli_close($koneksi);
        exit;
    }
    mysqli_stmt_close($check_stmt);
    
    // Insert data menggunakan Prepared Statement
    $query = "INSERT INTO sortir (no_resi, lokasi_penerima, id_penerima, gudang, status_pengiriman) 
              VALUES (?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($koneksi, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $no_resi, $lokasi, $id_penerima, $gudang, $status);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<h3 style='color:green;'>✓ Data berhasil disimpan!</h3>";
            echo "<a href='index.php'>Kembali ke Halaman Utama</a>";
        } else {
            echo "<h3 style='color:red;'>✗ Gagal menyimpan data</h3>";
            echo "Error: " . mysqli_stmt_error($stmt);
            echo "<br><a href='tambah.php'>Kembali</a>";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "<h3 style='color:red;'>✗ Gagal prepare statement</h3>";
        echo "Error: " . mysqli_error($koneksi);
        echo "<br><a href='tambah.php'>Kembali</a>";
    }
    
    mysqli_close($koneksi);
    
} else {
    header("Location: tambah.php");
    exit;
}
?>