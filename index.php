<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM account WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result !== false) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $row['name'];  // Menyimpan nilai kolom name ke dalam session
            $_SESSION['role'] = $row['role'];  // Menyimpan nilai kolom role ke dalam session

            header('Location: home.php');
        } else {
            echo "Username atau password salah!";
        }
    } else {
        echo "Error: " . $conn->error;  // Cetak pesan kesalahan MySQL
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
<h1>Silakan Login Terlebih Dahulu</h1>
<h2>Login</h2>

<form method="post" action="">
    <label>Username</label>
    <input type="text" name="username" required><br><br>

    <label>Password</label>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>
<h3>Jika Belum Memiliki Akun, Silakan Hubungi Admin!</h3>
</body>
</html>
