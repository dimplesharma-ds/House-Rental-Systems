<?php include 'header.php'?>
<?php
// Include configuration and session handling
include 'db.php';


// Check if the user is logged in
if (!isset($_SESSION['agent_id'])) {
    echo "You must be logged in to access this page.";
    exit;
}

// Retrieve the listings for the logged-in agent
$agent_id = $_SESSION['agent_id'];
$stmt = $conn->prepare("SELECT id, title FROM listings WHERE agent_id = ?");
$stmt->bind_param("i", $agent_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Listing to Modify</title>
</head>
<body>
    <h2>Select Listing to Modify</h2>
    <form action="modify.php" method="POST">
        <label for="listing_id">Select Listing:</label>
        <select id="listing_id" name="listing_id" required>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></option>
            <?php endwhile; ?>
        </select>
        <input type="submit" value="Modify Listing">
    </form>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
