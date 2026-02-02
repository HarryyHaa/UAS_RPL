<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Paket - E-Lang</title>
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
        E-Lang • Tambah Data Paket
    </div>
    <div class="container">
        <h2>Tambah Data Paket Baru</h2>
        <form action="simpan.php" method="POST">
            
            <label>No Resi:</label>
            <select name="no_resi" required>
                <option value="">Pilih Gudang</option>
                <option value="Resi20251120001">Resi20251120001</option>
                <option value="Resi20251120002">Resi20251120002</option>
                <option value="Resi20251120003">Resi20251120003</option>
                <option value="Resi20251120004">Resi20251120004</option>
                <option value="Resi20251120005">Resi20251120005</option>
                <option value="Resi20251120006">Resi20251120006</option>
            </select>
            
            <label>Lokasi Penerima:</label>
            <input type="text" name="lokasi_penerima" required>
            
            <label>ID Penerima:</label>
            <input type="text" name="id_penerima" required>
            
            <label>Gudang:</label>
            <select name="gudang" required>
                <option value="">Pilih Gudang</option>
                <option value="Gudang A">Gudang A</option>
                <option value="Gudang B">Gudang B</option>
                <option value="Gudang C">Gudang C</option>
                <option value="Gudang D">Gudang D</option>
                <option value="Gudang E">Gudang E</option>
                <option value="Gudang F">Gudang F</option>
            </select>
            
                <label>Status Pengiriman:</label>
            <select name="status_pengiriman" required>
                <option value="">Pilih Status</option>
                <option value="Diproses">Diproses</option>
                <option value="Dalam Pengiriman">Dalam Pengiriman</option>
                <option value="Selesai">Selesai</option>
            </select>
            
            <button type="submit" class="btn">Simpan</button>
        </form>
        <a href="index.php" class="back">← Kembali ke Halaman Utama</a>
    </div>
</body>
</html>