<?php
session_start();
require 'config.php';

if (!isset($_SESSION['id_karyawan']) || $_SESSION['posisi'] !== 'Admin') {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];
$conn->query("DELETE FROM pengiriman WHERE id_pengiriman = $id");

header("Location: manage_pengiriman.php");
exit();
?>
