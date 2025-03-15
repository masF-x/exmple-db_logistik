<?php
session_start();
require 'config.php';

if (!isset($_SESSION['id_karyawan']) || $_SESSION['posisi'] !== 'Admin') {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];
$conn->query("DELETE FROM penjualan WHERE id_penjualan = $id");

header("Location: manage_penjualan.php");
exit();
?>
