
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login </title>
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
    <h2>Admin Login</h2>
    <form action="authenticate.php" method="post">
        <label for="adminname">Admin Name:</label>
        <input type="text" id="adminname" name="adminname" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
