<?php
session_start();
// Pastikan file koneksi.php sudah di-include
include 'koneksi.php';  // Sesuaikan dengan lokasi file koneksi.php
// Cek apakah pengguna sudah login
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.html");
        exit;
    }

// Query untuk mengambil data mahasiswa
$sql = "SELECT * FROM mahasiswa";  // Ganti sesuai dengan tabel yang ada
$result = mysqli_query($conn, $sql);

// Cek apakah query berhasil dijalankan
if ($result) {
    // Ambil semua data mahasiswa dalam bentuk array asosiatif
    $mahasiswa = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // Jika query gagal
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Nilai Mahasiswa</title>
    <link rel="stylesheet" href="dashboard2.css">
</head>
<body>
    <h2>Daftar Data Mahasiswa</h2>
    <a href="tambah_nilai.php">Tambah Data Mahasiswa</a><br><br>
    <table border="1">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($mahasiswa as $mhs): ?>
            <tr>
                <td><?= $mhs['nim']; ?></td>
                <td><?= $mhs['nama']; ?></td>
                <td><?= $mhs['nilai']; ?></td>
                <td>
                    <a href="edit_nilai.php?id=<?= $mhs['id']; ?>">Edit</a> |
                    <a href="hapus_nilai.php?id=<?= $mhs['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="logout.php" class="logout">Logout</a>
</body>
</html>
