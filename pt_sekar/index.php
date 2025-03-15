<?php
session_start();
if (isset($_SESSION['id_karyawan'])) {
    header("Location: dashboard.php");
} else {
    header("Location: login.php");
}
exit();
?>
