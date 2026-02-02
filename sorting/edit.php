<?php
include "koneksi.php";

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data berdasarkan ID
    $query = "SELECT * FROM sortir WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    
    if (!$data) {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Paket - E-Lang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f8;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #002b5b;
            padding: 15px;
            color: white;
            font-size: 20px;
            font-weight: bold;
        }
        .container {
            width: 60%;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #aaa;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .btn {
            padding: 10px 20px;
            background-color: #0059c9;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
        }
        .btn:hover {
            background-color: #003d85;
        }
        .back {
            margin-top: 15px;
            display: inline-block;
            color: #0059c9;
            text-decoration: none;
            font-weight: bold;
        }
        .back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="navbar">
        E-Lang • Edit Data Paket
    </div>
    <div class="container">
        <h2>Edit Data Paket</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            
            <label>No Resi:</label>
            <input type="text" name="no_resi" value="<?php echo htmlspecialchars($data['no_resi']); ?>" required>
            
            <label>Lokasi Penerima:</label>
            <input type="text" name="lokasi_penerima" value="<?php echo htmlspecialchars($data['lokasi_penerima']); ?>" required>
            
            <label>ID Penerima:</label>
            <input type="text" name="id_penerima" value="<?php echo htmlspecialchars($data['id_penerima']); ?>" required>
            
            <label>Gudang:</label>
            <select name="gudang" required>
                <option value="">Pilih Gudang</option>
                <option value="Gudang A" <?php echo ($data['gudang'] == 'Gudang A') ? 'selected' : ''; ?>>Gudang A</option>
                <option value="Gudang B" <?php echo ($data['gudang'] == 'Gudang B') ? 'selected' : ''; ?>>Gudang B</option>
                <option value="Gudang C" <?php echo ($data['gudang'] == 'Gudang C') ? 'selected' : ''; ?>>Gudang C</option>
                <option value="Gudang D" <?php echo ($data['gudang'] == 'Gudang D') ? 'selected' : ''; ?>>Gudang D</option>
                <option value="Gudang E" <?php echo ($data['gudang'] == 'Gudang E') ? 'selected' : ''; ?>>Gudang E</option>
                <option value="Gudang F" <?php echo ($data['gudang'] == 'Gudang F') ? 'selected' : ''; ?>>Gudang F</option>
            </select>
            
            <label>Status Pengiriman:</label>
            <select name="status_pengiriman" required>
                <option value="">Pilih Status</option>
                <option value="Diproses" <?php echo ($data['status_pengiriman'] == 'Diproses') ? 'selected' : ''; ?>>Diproses</option>
                <option value="Dalam Pengiriman" <?php echo ($data['status_pengiriman'] == 'Dalam Pengiriman') ? 'selected' : ''; ?>>Dalam Pengiriman</option>
                <option value="Selesai" <?php echo ($data['status_pengiriman'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
            </select>
            
            <button type="submit" class="btn">Update</button>
        </form>
        <a href="index.php" class="back">← Kembali ke Halaman Utama</a>
    </div>
</body>
</html>