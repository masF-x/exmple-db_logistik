<?php
session_start();
require 'config.php';

// Cek apakah user sudah login dan memiliki hak akses admin
if (!isset($_SESSION['id_karyawan']) || $_SESSION['posisi'] !== 'Admin') {
    echo "<script>alert('Akses ditolak!'); window.location='dashboard.php';</script>";
    exit();
}

// Pastikan ada ID user yang dikirim untuk dihapus
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus user dari database
    $stmt = $conn->prepare("DELETE FROM karyawan WHERE id_karyawan = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('User berhasil dihapus!'); window.location='manage_karyawan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus user!'); window.location='manage_karyawan.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location='manage_karyawan.php';</script>";
}
?>
