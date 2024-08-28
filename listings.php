<?php include "header.php"?>
<?php
session_start();
require 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch all agents
$agentsSql = "SELECT DISTINCT agent_name FROM listings";
$agentsResult = $conn->query($agentsSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Property Listings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .property, .agent {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        .property img {
            max-width: 100px;
            display: block;
            margin-bottom: 10px;
        }
        .actions {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Property Listings</h1>
    
    <a href="home.php">Back to Home</a>
    <hr>
    
    
    <h2>Properties</h2>
    <?php
    // Fetch and display properties based on the selected agent
    if (isset($_GET['agent_name'])) {
        $agentId = $_GET['agent_name'];
        $stmt = $conn->prepare("SELECT id, title, description, price, image_url, location, rating, agent_id FROM listings WHERE agent_name = :agent_name ORDER BY title");
        $stmt->bindParam(':agent_name', $agentId);
        $stmt->execute();
        $result = $stmt;
    } else {
        $sql = "SELECT id, title, description, price, image_url, location, rating, agent_id FROM listings ORDER BY title";
        $result = $conn->query($sql);
    }

    // Display the listings
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='property'>";
            echo "<h2>Title: " . htmlspecialchars($row["title"]) . "</h2>";
            echo "<p>Description: " . htmlspecialchars($row["description"]) . "</p>";
            echo "<p>Price: $" . htmlspecialchars($row["price"]) . "</p>";
            echo "<p><img src='" . htmlspecialchars($row["image_url"]) . "' alt='Listing Image'></p>";
            echo "<p>Location: " . htmlspecialchars($row["location"]) . "</p>";
            echo "<p>Rating: " . htmlspecialchars($row["rating"]) . "</p>";
            echo "<p>Agent ID: " . htmlspecialchars($row["agent_id"]) . "</p>";
            echo "<div class='actions'>";
                        echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No results found</p>";
    }

    $conn = null; // Close the connection
    ?>
</body>
</html>
