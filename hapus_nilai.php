<?php
// hapus_nilai.php
include 'koneksi.php';  // Pastikan koneksi.php sudah di-include

// Cek apakah 'id' ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Pastikan 'id' adalah angka untuk mencegah SQL Injection
    $id = (int)$id;  // Convert ke tipe integer

    // Query untuk menghapus data mahasiswa berdasarkan ID
    $sql = "DELETE FROM mahasiswa WHERE id = $id";

    // Eksekusi query menggunakan MySQLi
    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
           alert('Data mahasiswa berhasil dihapus!');
           document.location.href = 'dashboard.php';
       </script>
       ";
    } else {
        echo "Gagal menghapus data mahasiswa: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak ditemukan di URL.";
    exit;
}
?>
