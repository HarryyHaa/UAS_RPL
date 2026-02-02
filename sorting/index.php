<?php
include "koneksi.php";

// Query untuk mengambil semua data dari tabel sortir
$query = "SELECT * FROM sortir ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Sorting Site</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .header {
            background-color: #003d7a;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-left h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }
        .header-left p {
            font-size: 14px;
            opacity: 0.9;
        }
        .header-right {
            text-align: right;
        }
        .header-right .time {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .header-right .user {
            font-size: 16px;
            font-weight: bold;
        }
        .container {
            max-width: 1400px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .btn-tambah {
            display: inline-block;
            background-color: #0066cc;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .btn-tambah:hover {
            background-color: #0052a3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        thead {
            background-color: #0066cc;
            color: white;
        }
        th {
            padding: 15px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }
        tbody tr:hover {
            background-color: #f5f5f5;
        }
        .status-selesai {
            color: green;
            font-weight: bold;
        }
        .status-perjalanan {
            color: orange;
            font-weight: bold;
        }
        .status-diproses {
            color: blue;
            font-weight: bold;
        }       
        .btn-aksi {
            padding: 5px 12px;
            margin: 0 3px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            display: inline-block;
        }
        .btn-edit {
            background-color: #28a745;
            color: white;
        }
        .btn-edit:hover {
            background-color: #218838;
        }
        .btn-hapus {
            background-color: #dc3545;
            color: white;
        }
        .btn-hapus:hover {
            background-color: #c82333;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <h1>Location Sorting</h1>
            <p>Location Sorting Site</p>
        </div>
        <div class="header-right">
            <div class="time">
                <?php
                // Set timezone ke WIB (Jakarta)
                date_default_timezone_set('Asia/Jakarta');
                echo date('l, F j, Y');
                echo '<br>';
                echo date('H:i:s');
                ?>
            </div>
            <div class="user">Hallo Admin</div>
        </div>
    </div>

    <div class="container">
        <h2>Data Lokasi Resi</h2>
        
        <a href="tambah.php" class="btn-tambah">+ Tambah Data</a>
        
        <table>
            <thead>
                <tr>
                    <th>No Resi</th>
                    <th>Lokasi Penerima</th>
                    <th>ID Penerima</th>
                    <th>Gudang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
              <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['status_pengiriman'] == 'Selesai') {
                        $status_class = 'status-selesai';
                    } elseif ($row['status_pengiriman'] == 'Dalam Pengiriman') {
                        $status_class = 'status-perjalanan';
                    } else {
                        $status_class = 'status-diproses';
                    }
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['no_resi']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['lokasi_penerima']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['id_penerima']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['gudang']) . "</td>";
                    echo "<td class='$status_class'>" . htmlspecialchars($row['status_pengiriman']) . "</td>";
                    echo "<td>
                            <a href='edit.php?id=" . $row['id'] . "' class='btn-aksi btn-edit'>Edit</a>
                            <a href='hapus.php?id=" . $row['id'] . "' class='btn-aksi btn-hapus' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='no-data'>Belum ada data. Silakan tambah data baru.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <script>
        // Update waktu setiap detik
        setInterval(function() {
            location.reload();
        }, 60000); // Refresh setiap 1 menit untuk update waktu
    </script>
</body>
</html>
<?php
mysqli_close($koneksi);
?>