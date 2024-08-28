<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .header h1 {
            margin: 0;
        }
        .nav {
            display: flex;
            justify-content: center;
            background-color: #444;
            margin-bottom: 20px;
        }
        .nav a {
            color: #fff;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }
        .nav a:hover {
            background-color: #ddd;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
    </div>
    <div class="nav">
        <a href="admin_home.php">Home</a>
        <a href="admin_agents_propeties.php">Agents</a>
        <a href="admin_listings.php">Listings</a>
        <a href="admin_logout.php">Logout</a>
    </div>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</h2>
        <p>This is your dashboard.</p>
    </div>
</body>
</html>
