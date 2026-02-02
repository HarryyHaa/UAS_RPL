<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Hapus data berdasarkan ID
    $query = "DELETE FROM sortir WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($koneksi);
            header("Location: index.php?status=deleted");
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