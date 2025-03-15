<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $tujuan = $_POST['tujuan'];
    $tanggal_kirim = $_POST['tanggal_kirim'];
    $status = "Menunggu"; // Status default

    // Gunakan Prepared Statement
    $stmt = $conn->prepare("INSERT INTO pengiriman (nama_barang, tujuan, tanggal_kirim, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama_barang, $tujuan, $tanggal_kirim, $status);

    if ($stmt->execute()) {
        echo "Pengiriman berhasil disimpan!";
    } else {
        echo "Gagal menyimpan data: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Request Pengiriman</title>
</head>
<body>
    <h2>Form Request Pengiriman</h2>
    <form action="" method="POST">
        Nama Barang: <input type="text" name="nama_barang" required><br>
        Tujuan: <input type="text" name="tujuan" required><br>
        Tanggal Kirim: <input type="date" name="tanggal_kirim" required><br>
        <button type="submit">Kirim</button>
    </form>
</body>
</html>
