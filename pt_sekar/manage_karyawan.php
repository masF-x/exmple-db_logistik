<?php
session_start();
require 'config.php';

if (!isset($_SESSION['id_karyawan']) || $_SESSION['posisi'] !== 'Admin') {
    header("Location: dashboard.php");
    exit();
}

$result = $conn->query("SELECT * FROM karyawan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Karyawan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Daftar Karyawan</h2>
    <a href="add_user.php">Tambah User</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Posisi</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_karyawan']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['posisi']; ?></td>
                <td>
                    <a href="edit_karyawan.php?id=<?php echo $row['id_karyawan']; ?>">Edit</a>
                    <a href="delete_karyawan.php?id=<?php echo $row['id_karyawan']; ?>" onclick="return confirm('Hapus karyawan?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
