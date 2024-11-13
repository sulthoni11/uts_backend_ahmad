<?php
require 'koneksi.php';

session_start();

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

if (!empty($email) && !empty($password)) {
    // Query untuk mengambil password hash dari database
    $query = "SELECT id, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $id, $hashed_password);
            mysqli_stmt_fetch($stmt);

            // Verifikasi password menggunakan password_verify
            if (password_verify($password, $hashed_password)) {
                $_SESSION['akses'] = true;
                $_SESSION['user_id'] = $id;
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<script>
                        alert('Maaf, password yang Anda masukkan salah');
                        document.location.href = 'login.html';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Email tidak ditemukan');
                    document.location.href = 'login.html';
                  </script>";
        }
        
        mysqli_stmt_close($stmt);
    }
} else {
    header("Location: login.html");
}

mysqli_close($conn);

// session_start();
// include 'koneksi.php';

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     // Query untuk memeriksa apakah email dan password cocok
//     $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'"; 
//     $result = mysqli_query($conn, $sql);

//     if (mysqli_num_rows($result) === 1) {
//         $user = mysqli_fetch_assoc($result);
//         $_SESSION['user_id'] = $user['id'];  // Simpan ID user dalam session
//         header("Location: dashboard.php");
//         exit;
//     } else {
//         echo "<script>alert('Email atau password salah');
//         document.location.href = 'login.html';
//         </script>";
//     }
// }

?>

    