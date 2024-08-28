<?php
session_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['agent_id'])) {
    header("Location: login.php");
    exit();
}

$agent_id = $_SESSION['agent_id'];

try {
    // Fetch messages from the inquiries table for the listings of the agent
    $sql_inquiries = "SELECT inquiries.listing_id, inquiries.message, inquiries.created_at 
                      FROM inquiries 
                      JOIN listings ON inquiries.listing_id = listings.id 
                      WHERE listings.agent_id = ?";
    $stmt_inquiries = $conn->prepare($sql_inquiries);
    $stmt_inquiries->bind_param("i", $agent_id);
    $stmt_inquiries->execute();
    $result_inquiries = $stmt_inquiries->get_result();
} catch (Exception $e) {
    // Handle database errors
    echo "Error fetching inquiries: " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agent Inquiries</title>
    <style>
        /* Add any additional CSS styles here */
        .inquiry {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Agent Inquiries</h1>

    <!-- Display Inquiries -->
    <?php
    if ($result_inquiries->num_rows > 0) {
        while ($row = $result_inquiries->fetch_assoc()) {
            echo "<div class='inquiry'>";
            echo "<p><strong>Listing ID:</strong> " . htmlspecialchars($row['listing_id']) . "</p>";
            echo "<p><strong>Message:</strong> " . htmlspecialchars($row['message']) . "</p>";
            
            echo "<p><strong>Created At:</strong> " . htmlspecialchars($row['created_at']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "You have no inquiries.";
    }
    ?>
</body>
</html>
