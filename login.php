<?php
// Include db.php for database connection
include 'db.php';

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $agent_name = $_POST['agent_name'];
    $password = $_POST['password'];

    // Query to check agent credentials
    $sql = "SELECT * FROM agents WHERE agent_name = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $agent_name, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if agent exists and credentials are correct
    if ($result->num_rows == 1) {
        // Agent exists and credentials are correct
        $row = $result->fetch_assoc();

        // Set agent session variables
        $_SESSION['agent_id'] = $row['agent_id'];
        $_SESSION['agent_name'] = $row['agent_name'];

        // Redirect to agent dashboard or another appropriate page
        header("Location: dashboard.php");
        exit();
    } else {
        // Agent doesn't exist or credentials are incorrect
        $error = "Invalid agent name or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agent Login</title>
    <!-- Include CSS/JS libraries -->
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
                
                <a href="register.php">Register</a>
            </div>
        </div>
    </div>

    <h2>Agent Login</h2>
    <?php if (isset($error)): ?>
        <div><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Agent Name:</label>
        <input type="text" name="agent_name" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
