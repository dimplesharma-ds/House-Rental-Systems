<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Homepage</title>
    <style>
        /* Basic CSS for navigation */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #008000;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
        }
        nav a:hover {
            background-color: #555;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            
                
                    <!-- Display different options after login -->
                    <a href="home.php">Home</a></li>
                    <a href="view_listings.php">Listings</a>
                    <a href="login.php">Login</a>
                     <a href="register.php">Register</a>
                    
                   
               
            
        </nav>
    </header>
</body>
</html>
