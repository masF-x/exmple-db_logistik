<?php
session_start();
require 'config.php';

if (!isset($_SESSION['id_karyawan']) || $_SESSION['posisi'] !== 'Admin') {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM penjualan WHERE id_penjualan = $id");
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];

    $stmt = $conn->prepare("UPDATE penjualan SET nama_produk=?, jumlah=?, harga=? WHERE id_penjualan=?");
    $stmt->bind_param("siii", $nama_produk, $jumlah, $harga, $id);
    $stmt->execute();

    header("Location: manage_penjualan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Penjualan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Penjualan</h2>
    <form method="POST">
        <input type="text" name="nama_produk" value="<?php echo $data['nama_produk']; ?>" required>
        <input type="number" name="jumlah" value="<?php echo $data['jumlah']; ?>" required>
        <input type="number" name="harga" value="<?php echo $data['harga']; ?>" required>
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
