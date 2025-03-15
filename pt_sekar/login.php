<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Login khusus admin (tanpa database)
    if ($email === "admin@ptsekar.com" && $password === "admin123") {
        $_SESSION['id_karyawan'] = 1;
        $_SESSION['nama'] = "Admin";
        $_SESSION['posisi'] = "Admin";
        
        header("Location: dashboard.php");
        exit();
    }

    // Login biasa dengan database
    $stmt = $conn->prepare("SELECT * FROM karyawan WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id_karyawan'] = $user['id_karyawan'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['posisi'] = $user['posisi'];

        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Login gagal! Periksa email dan password.');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
