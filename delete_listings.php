<?php
include "header.php";
//session_start();
include 'db.php'; // Adjust the path if necessary

// Check if the user is logged in
if (!isset($_SESSION['agent_id'])) {
    header("Location: login.php"); // Redirect to your login page
    exit();
}

// Function to sanitize input
function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
}

// Handle form submission for deleting listings
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Sanitize agent ID
    $agent_id = sanitize($conn, $_SESSION['agent_id']);
    
    // Sanitize listing ID
    $listing_id = sanitize($conn, $_POST['listing_id']);
    
    // Prepare and execute the delete statement
    $sql = "DELETE FROM listings WHERE id = ? AND agent_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $listing_id, $agent_id);
    if ($stmt->execute()) {
        // Redirect back to the page showing the remaining listings
        header("Location: agent_listings.php");
        exit();
    } else {
        echo "Error deleting listing: " . $conn->error; // Print any errors
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Listing</title>
</head>
<body>
    <h2>Delete Listing</h2>
    <!-- Form for deleting listing -->
    <form method="post" action="">
        <label for="listing_id">Listing ID:</label>
        <input type="text" id="listing_id" name="listing_id" required> <!-- Input field for listing ID -->
        <input type="submit" name="delete" value="Delete Listing">
    </form>
    <a href="dashboard.php">Go back to dashboard</a>
</body>
</html>
