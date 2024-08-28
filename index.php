<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Homepage</title>
    <style>
        /* Basic CSS for navigation */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #333;
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
    <nav>
        <a href="index.php">Home</a>
        <a href="view_listings.php">Listings</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact Us</a>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
    </nav>

    <div class="container">
        <h1>Welcome to User Homepage</h1>
        <p>This is a user homepage with navigation tabs for listings, about, contact us, home, signup, and login.</p>
        <!-- Add more content here -->
    </div>
</body>
</html>
