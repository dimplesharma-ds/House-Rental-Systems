<?php include 'header.php'; ?>

<?php
include 'db.php';  // Adjust the path to 'db.php' as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($pdo)) {
        $username = $_POST['username'];
        $email = isset($_POST['email']) ? $_POST['email'] : ''; // Check if email is set
        $password = $_POST['password']; // No password hashing as per your requirement

        // Insert user into the database
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);

        echo "Registration successful!";
    } else {
        die('Database connection not established.');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <form method="POST" action="register.php">
        Username: <input type="text" name="username" required><br>
        Email: <input type="email" name="email"><br> <!-- Use type="email" for email input -->
        Password: <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
