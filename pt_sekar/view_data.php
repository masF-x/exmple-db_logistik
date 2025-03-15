<?php
session_start();
require 'config.php';

if (!isset($_SESSION['id_karyawan']) || $_SESSION['posisi'] !== 'Staf') {
    header("Location: dashboard.php");
    exit();
}

$result = $conn->query("SELECT * FROM pengiriman WHERE status='Dikirim'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pengiriman</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data Pengiriman yang Sedang Berjalan</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Tujuan</th>
            <th>Tanggal Kirim</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_pengiriman']; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td><?php echo $row['tujuan']; ?></td>
                <td><?php echo $row['tanggal_kirim']; ?></td>
                <td><?php echo $row['status']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
