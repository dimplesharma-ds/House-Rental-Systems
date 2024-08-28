<?php
include 'db.php';
include 'header.php';


$agent_id = $_SESSION['agent_id'];

// Retrieve the listings for the logged-in agent
$sql = "SELECT id, title, description, price FROM listings WHERE agent_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $agent_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        .listing {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
        .listing h2 {
            margin: 0;
        }
    </style>
</head>
<body>
    <h1>Agent Dashboard</h1>
    <h1>Your Listings</h1>
    
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='listing'>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
            echo "<p>Price: $" . number_format($row['price'], 2) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>You have no listings.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
