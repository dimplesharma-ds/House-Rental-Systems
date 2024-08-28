<?php
$dsn = 'mysql:host=localhost;dbname=proj';
$username = 'root';  // Replace with your database username
$password = '';      // Replace with your database password

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>
