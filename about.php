<?php
session_start();
include 'header.php'; // Assuming you have a header file to include common HTML head elements
include 'db.php'; // If you need to connect to the database for any information

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h1, h2, h3 {
            color: #333;
        }
        p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to our website. We are committed to providing the best service to our customers.</p>
        
        <h2>Our Mission</h2>
        <p>Our mission is to deliver high-quality products and services that meet the needs of our customers and exceed their expectations.</p>

        <h2>Our History</h2>
        <p>Founded in [Year], our company has grown from a small startup to a leading player in the industry. Our journey has been marked by innovation, dedication, and a relentless pursuit of excellence.</p>

        <h2>Our Team</h2>
        <p>We are proud of our diverse and talented team. Each member brings unique skills and expertise, contributing to our collective success.</p>

        <h2>Contact Us</h2>
        <p>If you have any questions or would like to learn more about us, please feel free to <a href="contact.php">contact us</a>.</p>
    </div>
</body>
</html>


