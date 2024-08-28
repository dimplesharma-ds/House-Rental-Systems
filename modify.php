<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modify Listing</title>
</head>
<body>
    <?php
    include 'header.php';
    // Include configuration and session handling
    include 'db.php';

    // Check if the user is logged in
    if (!isset($_SESSION['agent_id'])) {
        echo "You must be logged in to access this page.";
        exit;
    }

    // Initialize variables
    $listing = null;

    // Check if the form is submitted or listing ID is provided
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['listing_id'])) {
            $id = $_POST['listing_id'];
            $agent_id = $_SESSION['agent_id'];

            // Retrieve listing data from the database
            $stmt = $conn->prepare("SELECT * FROM listings WHERE id = ? AND agent_id = ?");
            $stmt->bind_param("ii", $id, $agent_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $listing = $result->fetch_assoc();
            $stmt->close();

            // Check if the listing exists and the agent is authorized to modify it
            if (!$listing) {
                echo "Listing not found or you are not authorized to modify it.";
                exit;
            }
        } elseif (isset($_POST['id'], $_POST['agent_name'], $_POST['title'], $_POST['description'], $_POST['price'], $_POST['image_url'], $_POST['location'], $_POST['rating'], $_POST['status'], $_POST['agent_id'])) {
            $id = $_POST['id'];
            $agent_name = $_POST['agent_name'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $image_url = $_POST['image_url'];
            $location = $_POST['location'];
            $rating = $_POST['rating'];
            $status = $_POST['status']; // New line to retrieve status
            $agent_id = $_POST['agent_id'];

            // Validate agent ownership
            if ($agent_id == $_SESSION['agent_id']) {
                $stmt = $conn->prepare("UPDATE listings SET agent_name = ?, title = ?, description = ?, price = ?, image_url = ?, location = ?, rating = ?, status = ? WHERE id = ? AND agent_id = ?");
                $stmt->bind_param("sssdssdsii", $agent_name, $title, $description, $price, $image_url, $location, $rating, $status, $id, $agent_id);
                $stmt->execute();
                $stmt->close();

                echo "Listing updated successfully.";
            } else {
                echo "Unauthorized action.";
            }
        }
    }

    if ($listing) {
    ?>
    <h2>Modify Listing</h2>
    <form action="modify.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $listing['id']; ?>">
        <input type="hidden" name="agent_id" value="<?php echo $listing['agent_id']; ?>">
        
        <label for="agent_name">Agent Name:</label>
        <input type="text" id="agent_name" name="agent_name" value="<?php echo $listing['agent_name']; ?>" required><br><br>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $listing['title']; ?>" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $listing['description']; ?></textarea><br><br>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?php echo $listing['price']; ?>" required><br><br>

        <label for="image_url">Image URL:</label>
        <input type="text" id="image_url" name="image_url" value="<?php echo $listing['image_url']; ?>" required><br><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $listing['location']; ?>" required><br><br>

        <label for="rating">Rating:</label>
        <input type="text" id="rating" name="rating" value="<?php echo $listing['rating']; ?>" required><br><br>

        <label for="status">Status:</label>
        <select name="status">
            <option value="Available" <?php if ($listing['status'] == 'Available') echo 'selected'; ?>>Available</option>
            <option value="Sold" <?php if ($listing['status'] == 'Sold') echo 'selected'; ?>>Sold</option>
            <option value="On Rent" <?php if ($listing['status'] == 'On Rent') echo 'selected'; ?>>On Rent</option>
        </select><br><br>

        <input type="submit" value="Modify Listing">
    </form>
    <?php
    }
    ?>
</body>
</html>
