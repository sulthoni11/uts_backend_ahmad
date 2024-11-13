<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Cek apakah password dan confirm password sesuai
    if ($password !== $confirm_password) {  
        echo "Passwords do not match.";
        exit();
    }

    // Hash password menggunakan PASSWORD_BCRYPT untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Query untuk memasukkan email dan password hash ke database
    $query_sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    
    // Menggunakan prepared statement untuk mencegah SQL injection
    $stmt = mysqli_prepare($conn, $query_sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $hashed_password);

    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, arahkan ke halaman login
        header("Location: login.html");
        exit();
    } else {
        // Tampilkan error jika terjadi kesalahan pada eksekusi query
        echo "Error: " . mysqli_error($conn);
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Tutup koneksi
mysqli_close($conn);    
?>
