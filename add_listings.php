<?php
session_start();
include 'db.php';
include 'header.php';

// Check if agent is logged in
if (!isset($_SESSION['agent_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $agent_name = $_POST['agent_name'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $bhk = $_POST['bhk'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    $location = $_POST['location'];
    $rating = $_POST['rating'];
    $status = $_POST['status']; // New line to retrieve status
    $agent_id = $_SESSION['agent_id'];

    // Check if the status is valid
    if ($status !== 'Available' && $status !== 'Sold' && $status !== 'On Rent') {
        echo "Invalid status!";
        exit();
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO `listings`(`agent_name`, `title`, `description`, `bhk`, `price`, `image_url`, `location`, `rating`, `status`, `agent_id`) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssisdsdsi", $agent_name, $title, $description, $bhk, $price, $image_url, $location, $rating, $status, $agent_id);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "Added a listing successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Listing</title>
    <!-- Include CSS/JS libraries -->
</head>
<body>
    <h2>Add New Listing</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Agent Name:</label>
        <input type="text" name="agent_name" required><br>
        <label>Title:</label>
        <input type="text" name="title" required><br>
        <label>Description:</label>
        <textarea name="description" required></textarea><br>
        <label>BHK:</label>
        <textarea name="bhk" required></textarea><br>
        <label>Price(in dollars): </label>
        <input type="number" name="price" step="0.01" required><br>
        <label>Image URL:</label>
        <input type="text" name="image_url" required><br>
        <label>Location:</label>
        <input type="text" name="location" required><br>
        <label>Rating:</label>
        <input type="number" name="rating" step="0.1" required><br>
        <label>Status:</label>
        <select name="status">
            <option value="Available">Available</option>
            <option value="Sold">Sold</option>
            <option value="On Rent">On Rent</option>
        </select><br>

        <input type="submit" value="Add Listing">
    </form>
</body>
</html>
