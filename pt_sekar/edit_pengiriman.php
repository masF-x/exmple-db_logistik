<?php
session_start();
require 'config.php';

if (!isset($_SESSION['id_karyawan']) || $_SESSION['posisi'] !== 'Admin') {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM pengiriman WHERE id_pengiriman = $id");
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $tujuan = $_POST['tujuan'];
    $tanggal_kirim = $_POST['tanggal_kirim'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE pengiriman SET nama_barang=?, tujuan=?, tanggal_kirim=?, status=? WHERE id_pengiriman=?");
    $stmt->bind_param("ssssi", $nama_barang, $tujuan, $tanggal_kirim, $status, $id);
    $stmt->execute();

    header("Location: manage_pengiriman.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengiriman</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Pengiriman</h2>
    <form method="POST">
        <input type="text" name="nama_barang" value="<?php echo $data['nama_barang']; ?>" required>
        <input type="text" name="tujuan" value="<?php echo $data['tujuan']; ?>" required>
        <input type="date" name="tanggal_kirim" value="<?php echo $data['tanggal_kirim']; ?>" required>
        <select name="status">
            <option value="Menunggu" <?php if ($data['status'] == 'Menunggu') echo 'selected'; ?>>Menunggu</option>
            <option value="Dikirim" <?php if ($data['status'] == 'Dikirim') echo 'selected'; ?>>Dikirim</option>
            <option value="Selesai" <?php if ($data['status'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
        </select>
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
