<?php
session_start();
require 'config.php';

if (!isset($_SESSION['id_karyawan'])) {
    header("Location: login.php");
    exit();
}

$posisi = $_SESSION['posisi'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard PT Sekar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h2>
        <p>Posisi: <?php echo $posisi; ?></p>
        
        <?php if ($posisi === 'Admin'): ?>
            <a href="manage_karyawan.php">Kelola Karyawan</a>
            <a href="manage_penjualan.php">Kelola Penjualan</a>
            <a href="manage_pengiriman.php">Kelola Pengiriman</a>
        <?php elseif ($posisi === 'Eksekutif'): ?>
            <a href="view_laporan.php">Lihat Laporan</a>
        <?php elseif ($posisi === 'Staf'): ?>
            <a href="view_data.php">Lihat Data</a>
            <a href="request_pengiriman.php">Ajukan Pengiriman</a>
        <?php endif; ?>

        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
