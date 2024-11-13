<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ahmadys_5016";

// Buat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else 
?>
