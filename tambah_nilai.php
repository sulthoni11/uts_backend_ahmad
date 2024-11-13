<?php
// tambah_nilai.php
include 'koneksi.php';  // Include koneksi.php untuk mendapatkan koneksi MySQLi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $nilai = $_POST['nilai'];

    // Query untuk memasukkan data nilai
    $sql = "INSERT INTO mahasiswa (nama, nim, nilai) VALUES ('$nama', '$nim', '$nilai')";

    // Menjalankan query
    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
           alert('Data berhasil ditambahkan!');
           document.location.href = 'dashboard.php';
       </script>
       ";

    } else {
        echo "Gagal menambahkan nilai: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Mahasiswa</title>
</head>
<style>
    /* tambah_nilai.css */

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f5;
}

.container {
    width: 360px;
    background-color: #f8f9fa;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    padding: 40px;
}

h2 {
    text-align: center;
    color: #344e41;
    font-weight: 600;
    margin-bottom: 20px;
}

form label {
    display: block;
    font-size: 14px;
    color: #344e41;
    margin-bottom: 5px;
}

form input[type="text"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #cbd3d4;
    border-radius: 12px;
    font-size: 14px;
    color: #495057;
    background-color: #ffffff;
    margin-bottom: 15px;
    transition: border-color 0.3s ease;
}

form input[type="text"]::placeholder {
    color: #adb5bd;
}

form input[type="text"]:focus {
    outline: none;
    border-color: #344e41;
    background-color: #f9fafb;
}

button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #344e41; /* Warna hijau lumut */
    color: white;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 15px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #546c5d;
}

</style>
<body>
    <div class="container">
        <h2>Tambah Data Mahasiswa</h2>
        <form action="" method="post">
            <label>Nama:</label>
            <input type="text" name="nama" placeholder="Masukkan nama" required>

            <label>NIM:</label>
            <input type="text" name="nim" placeholder="Masukkan NIM" required>

            <label>Nilai:</label>
            <input type="text" name="nilai" placeholder="Masukkan nilai" required>

            <button type="submit">Tambah</button>
        </form>
    </div>
</body>
</html>
