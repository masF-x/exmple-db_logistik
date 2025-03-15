<?php
session_start();
require 'config.php';

// Hanya Admin yang bisa menambah user baru
if (!isset($_SESSION['id_karyawan']) || $_SESSION['posisi'] !== 'Admin') {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
    $posisi = $_POST['posisi'];

    $stmt = $conn->prepare("INSERT INTO karyawan (nama, email, password, posisi) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $password, $posisi);
    $stmt->execute();

    echo "<script>alert('User berhasil ditambahkan!'); window.location='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Tambah User Baru</h2>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="posisi" required>
            <option value="Admin">Admin</option>
            <option value="Eksekutif">Eksekutif</option>
            <option value="Staf">Staf</option>
        </select>
        <button type="submit">Tambah User</button>
    </form>
</body>
</html>
