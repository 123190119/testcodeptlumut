<?php
$servername = "localhost";
$username = "root";
$password = "password"; // Ganti dengan password Anda jika ada

try {
    // Membuat koneksi ke server
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Membuat database
    $sql = "CREATE DATABASE IF NOT EXISTS blog_db";
    $conn->exec($sql);
    echo "Database berhasil dibuat\n";

    // Menggunakan database yang telah dibuat
    $conn->exec("USE blog_db");

    // Membuat tabel account
    $sql = "CREATE TABLE IF NOT EXISTS `account` (
              `username` VARCHAR(45) NOT NULL,
              `password` VARCHAR(250) NOT NULL,
              `name` VARCHAR(45) NOT NULL,
              `role` VARCHAR(45) NOT NULL,
              PRIMARY KEY (`username`)
            ) ENGINE = InnoDB;";
    $conn->exec($sql);
    echo "Tabel account berhasil dibuat\n";

    // Membuat tabel post
    $sql = "CREATE TABLE IF NOT EXISTS `post` (
              `idpost` INT NOT NULL AUTO_INCREMENT,
              `title` TEXT NOT NULL,
              `content` TEXT NOT NULL,
              `date` DATETIME NOT NULL,
              `username` VARCHAR(45) NOT NULL,
              PRIMARY KEY (`idpost`),
              INDEX `fk_post_account_idx` (`username` ASC),
              CONSTRAINT `fk_post_account`
                FOREIGN KEY (`username`)
                REFERENCES `account` (`username`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION
            ) ENGINE = InnoDB;";
    $conn->exec($sql);
    echo "Tabel post berhasil dibuat\n";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
