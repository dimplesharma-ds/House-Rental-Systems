<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $agent_name = $_POST['agent_name'];
    $password = $_POST['password'];

    // Check if agent_name already exists
    $check_sql = "SELECT agent_id FROM agents WHERE agent_name = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $agent_name);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $error_message = "Agent name already exists.";
    } else {
        // Insert new agent
        $sql = "INSERT INTO agents (agent_name, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $agent_name, $password);
        
        if ($stmt->execute()) {
            $_SESSION['agent_id'] = $stmt->insert_id;
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Registration failed. Please try again.";
        }
        $stmt->close();
    }
    $check_stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <?php
    if (isset($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>
    <form action="register.php" method="post">
        <label for="agent_name">Agent Name:</label>
        <input type="text" id="agent_name" name="agent_name" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html>
