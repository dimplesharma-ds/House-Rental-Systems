<?php
// Check if a session is not already started
if (session_status() == PHP_SESSION_NONE) {
  session_start(); 
}

// Check if the user is logged in
if (!isset($_SESSION['agent_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agent Portal</title>
    <style>
        /* Basic styling for the header and navigation menu */
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #008000;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .header .container {
            width: 80%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .header .nav {
            display: flex;
            gap: 15px;
        }
        .header .nav a {
            text-decoration: none;
            color: #333;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .header .nav a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="logo">
                Agent Portal
            </div>
            <div class="nav">
                <a href="dashboard.php">Home</a>
                <a href="agent_listings.php">Listings</a>
                <a href="inquiries.php">Inquiries</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
