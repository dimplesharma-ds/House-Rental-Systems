
<?php

include 'db.php';
include 'header.php';  // Adjust the path to 'db.php' as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($pdo)) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) { // Simple password check
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: dashboard.php');  // Redirect to dashboard
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        die('Database connection not established.');
    }
}
?>

<div class="container">
    <form method="POST" action="login.php">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required></br>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required></br>
        </div>
        <button type="submit">Login</button>
    </form>
</div>
