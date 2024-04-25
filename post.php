<?php
include 'includes/db.php';
session_start();
// Create Post
if(isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $username = $_SESSION['username'];
    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO post (title, content, date, username) VALUES ('$title', '$content', '$date', '$username')";
    $conn->query($sql);
}

// Read Post
$sql_read = "SELECT * FROM post";
$result_read = $conn->query($sql_read);

// Update Post
if(isset($_POST['update'])) {
    $idpost = $_POST['idpost'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql_update = "UPDATE post SET title='$title', content='$content' WHERE idpost='$idpost'";
    $conn->query($sql_update);
}

// Delete Post
if(isset($_GET['delete'])) {
    $idpost = $_GET['delete'];

    $sql_delete = "DELETE FROM post WHERE idpost='$idpost'";
    $conn->query($sql_delete);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Post</title>
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
<h2>CRUD Post</h2>

<!-- Create Form -->
<form method="post" action="">
    <label>Title</label>
    <input type="text" name="title" required><br><br>

    <label>Content</label>
    <textarea name="content" required></textarea><br><br>

    <input type="submit" name="create" value="Create">
</form>

<!-- Read, Update, Delete Table -->
<table border="1">
    <tr>
        <th>Title</th>
        <th>Content</th>
        <th>Date</th>
        <th>Username</th>
        <th>Action</th>
    </tr>
    <?php while($row = $result_read->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['content']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td>
                <a href="post_edit.php?idpost=<?php echo $row['idpost']; ?>">Edit</a>
                <a href="post.php?delete=<?php echo $row['idpost']; ?>">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
