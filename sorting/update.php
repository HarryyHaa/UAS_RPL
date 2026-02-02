<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $no_resi = $_POST['no_resi'];
    $lokasi = $_POST['lokasi_penerima'];
    $id_penerima = $_POST['id_penerima'];
    $gudang = $_POST['gudang'];
    $status = $_POST['status_pengiriman'];
    
    $query = "UPDATE sortir SET 
              no_resi = ?, 
              lokasi_penerima = ?, 
              id_penerima = ?, 
              gudang = ?, 
              status_pengiriman = ? 
              WHERE id = ?";
    
    $stmt = mysqli_prepare($koneksi, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssi", $no_resi, $lokasi, $id_penerima, $gudang, $status, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($koneksi);
            header("Location: index.php?status=updated");
            exit;
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>