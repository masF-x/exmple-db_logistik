<?php
session_start();
require 'config.php';

// Cek apakah user sudah login dan memiliki hak akses admin
if (!isset($_SESSION['id_karyawan']) || $_SESSION['posisi'] !== 'Admin') {
    echo "<script>alert('Akses ditolak!'); window.location='dashboard.php';</script>";
    exit();
}

// Cek apakah ada ID user yang akan diedit
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM karyawan WHERE id_karyawan = $id");
    $user = $result->fetch_assoc();
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $posisi = $_POST['posisi'];

    $stmt = $conn->prepare("UPDATE karyawan SET nama=?, email=?, posisi=? WHERE id_karyawan=?");
    $stmt->bind_param("sssi", $nama, $email, $posisi, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='manage_karyawan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <label>Nama:</label>
        <input type="text" name="nama" value="<?php echo $user['nama']; ?>" required><br>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>
        
        <label>Posisi:</label>
        <select name="posisi">
            <option value="Admin" <?php if ($user['posisi'] == 'Admin') echo 'selected'; ?>>Admin</option>
            <option value="Eksekutif" <?php if ($user['posisi'] == 'Eksekutif') echo 'selected'; ?>>Eksekutif</option>
            <option value="Staf" <?php if ($user['posisi'] == 'Staf') echo 'selected'; ?>>Staf</option>
        </select><br>

        <button type="submit">Simpan Perubahan</button>
        <a href="manage_karyawan.php">Batal</a>
    </form>
</body>
</html>
