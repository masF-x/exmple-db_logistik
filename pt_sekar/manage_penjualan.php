<?php
session_start();
require 'config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id_karyawan'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM penjualan");

if (!$result) {
    die("Error pada query: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Penjualan</title>
</head>
<body>
    <h2>Data Penjualan</h2>

    <table border="1">
        <tr>
            <th>ID Penjualan</th>
            <th>Produk</th>
            <th>Jumlah</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id_penjualan']; ?></td>
            <td><?php echo $row['produk']; ?></td>
            <td><?php echo $row['jumlah']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
