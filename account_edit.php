<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql_update = "UPDATE account SET password='$password', name='$name', role='$role' WHERE username='$username'";
    $conn->query($sql_update);

    header('Location: account.php');
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $sql = "SELECT * FROM account WHERE username='$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Akun</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

<h2>Edit Akun</h2>

<form method="post" action="">
    <input type="hidden" name="username" value="<?php echo $row['username']; ?>">

    <label>Password</label>
    <input type="password" name="password" value="<?php echo $row['password']; ?>" required><br><br>

    <label>Name</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>

    <label>Role</label>
    <input type="text" name="role" value="<?php echo $row['role']; ?>" required><br><br>

    <input type="submit" value="Update">
</form>

</body>
</html>
