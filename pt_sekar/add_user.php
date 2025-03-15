<?php
session_start();
require 'config.php';

// Cek apakah user sudah login dan memiliki hak akses admin
if (!isset($_SESSION['id_karyawan']) || $_SESSION['posisi'] !== 'Admin') {
    echo "<script>alert('Akses ditolak!'); window.location='dashboard.php';</script>";
    exit();
}

// Proses tambah user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $posisi = $_POST['posisi'];

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO karyawan (nama, email, password, posisi) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $password, $posisi);

    if ($stmt->execute()) {
        echo "<script>alert('User berhasil ditambahkan!'); window.location='manage_karyawan.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan user!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>
<body>
    <h2>Tambah User</h2>
    <form method="POST">
        <label>Nama:</label>
        <input type="text" name="nama" required><br>
        
        <label>Email:</label>
        <input type="email" name="email" required><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br>
        
        <label>Posisi:</label>
        <select name="posisi">
            <option value="Admin">Admin</option>
            <option value="Eksekutif">Eksekutif</option>
            <option value="Staf">Staf</option>
        </select><br>

        <button type="submit">Tambah User</button>
        <a href="manage_karyawan.php">Batal</a>
    </form>
</body>
</html>
