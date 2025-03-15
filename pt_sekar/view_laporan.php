<?php
session_start();
require 'config.php';

if (!isset($_SESSION['id_karyawan']) || $_SESSION['posisi'] !== 'Eksekutif') {
    header("Location: dashboard.php");
    exit();
}

$penjualan = $conn->query("SELECT COUNT(*) AS total FROM penjualan")->fetch_assoc();
$pengiriman = $conn->query("SELECT COUNT(*) AS total FROM pengiriman")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan PT Mekar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Laporan</h2>
    <p>Total Penjualan: <?php echo $penjualan['total']; ?></p>
    <p>Total Pengiriman: <?php echo $pengiriman['total']; ?></p>
</body>
</html>
