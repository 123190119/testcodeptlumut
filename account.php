<?php
include 'includes/db.php';
session_start();

// Cek role dari session
if ($_SESSION['role'] != 'admin') {
    echo "<script>alert('Anda tidak memiliki izin untuk mengakses halaman ini!');</script>";
    echo "<script>window.history.back();</script>";
    die();
}

// Create Account
if(isset($_POST['create'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "INSERT INTO account (username, password, name, role) VALUES ('$username', '$password', '$name', '$role')";
    $conn->query($sql);
}

// Read Account
$sql_read = "SELECT * FROM account";
$result_read = $conn->query($sql_read);

// Update Account
if(isset($_POST['update'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql_update = "UPDATE account SET password='$password', name='$name', role='$role' WHERE username='$username'";
    $conn->query($sql_update);
}

// Delete Account
if(isset($_GET['delete'])) {
    $username = $_GET['delete'];

    $sql_delete = "DELETE FROM account WHERE username='$username'";
    $conn->query($sql_delete);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Akun</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
<header>
    <h1>Blog</h1>
    <nav>
        <a href="home.php">Beranda</a>
        <a href="post.php">Post</a>
        <a href="account.php">Akun</a>
        <a href="login.php">Login / Logout</a>
    </nav>
</header>
<h2>CRUD Akun</h2>

<!-- Create Form -->
<form method="post" action="">
    <label>Username</label>
    <input type="text" name="username" required><br><br>

    <label>Password</label>
    <input type="password" name="password" required><br><br>

    <label>Name</label>
    <input type="text" name="name" required><br><br>

    <label>Role</label>
    <input type="text" name="role" required><br><br>

    <input type="submit" name="create" value="Create">
</form>

<!-- Read, Update, Delete Table -->
<table border="1">
    <tr>
        <th>Username</th>
        <th>Password</th>
        <th>Name</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    <?php while($row = $result_read->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td>
                <a href="account_edit.php?username=<?php echo $row['username']; ?>">Edit</a>
                <a href="account.php?delete=<?php echo $row['username']; ?>">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
