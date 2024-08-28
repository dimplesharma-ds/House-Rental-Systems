<?php
session_start(); //php method to start the session and allows us to store and retreive variables 

// Check if admin is not logged in, redirect to login page
if(!isset($_SESSION['admin_id'])) { 
    header("Location: login.php");
    exit;
}

// If admin is logged in, welcome them
$admin_name = $_SESSION['admin_name']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $admin_name; ?>!</h2>
    <p>This is the admin dashboard.</p>
    <p>Add your dashboard content here.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
