<?php
include 'includes/db.php';
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Test Coding PT Lumut Karya Sejahtera</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

<header>
    <h1>Test Coding PT Lumut Karya Sejahtera</h1>
    <nav>
        <a href="home.php">Beranda</a>
        <a href="post.php">Kelola Post</a>
        <a href="account.php">Kelola Akun</a>
        <a href="login.php">Login / Logout</a>
    </nav>
</header>

<main>
    <h2>Hai <?php echo $_SESSION['name']; ?></h2>
    <h2>Selamat datang di Blog Kami, !</h2>
    <!-- Tambahkan konten berita atau post terbaru di sini -->
</main>

<footer>
    <p>&copy; 2024 Blog</p>
</footer>

</body>
</html>
