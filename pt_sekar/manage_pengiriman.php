<?php
session_start();
require 'config.php';

if (!isset($_SESSION['id_karyawan']) || $_SESSION['posisi'] !== 'Admin') {
    header("Location: dashboard.php");
    exit();
}

// Ambil data dari tabel pengiriman
$result = $conn->query("SELECT * FROM pengiriman");

// Cek error jika query gagal
if (!$result) {
    die("Error SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pengiriman</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data Pengiriman</h2>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Tujuan</th>
            <th>Tanggal Kirim</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php 
        if ($result->num_rows > 0): // Cek apakah ada data
            while ($row = $result->fetch_assoc()): 
        ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_pengiriman']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                <td><?php echo htmlspecialchars($row['tujuan']); ?></td>
                <td><?php echo htmlspecialchars($row['tanggal_kirim']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td>
                    <a href="edit_pengiriman.php?id=<?php echo $row['id_pengiriman']; ?>">Edit</a>
                    <a href="delete_pengiriman.php?id=<?php echo $row['id_pengiriman']; ?>" onclick="return confirm('Hapus pengiriman?')">Hapus</a>
                </td>
            </tr>
        <?php 
            endwhile; 
        else: 
        ?>
            <tr>
                <td colspan="6">Tidak ada data pengiriman</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
