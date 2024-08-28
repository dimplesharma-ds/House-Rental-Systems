<?php include "header.php"?>

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
</head>
<body>
    <h2>Welcome to the Home Page</h2>
    <?php if (isset($_SESSION['admin'])): ?>
        <p>Hello, <?php echo $_SESSION['admin']; ?>!</p>
       
    <?php else: ?>
        <p>You are not logged in. <a href="login.php">Login here</a></p>
    <?php endif; ?>
</body>
</html>
