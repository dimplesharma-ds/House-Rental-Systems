<?php
session_start();
include 'db.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form fields are set
    if (isset($_POST['message']) && isset($_POST['listing_id'])) {
        // Sanitize inputs to prevent SQL injection
        $message = htmlspecialchars($_POST['message']);
        $listing_id = $_POST['listing_id'];

        try {
            // Fetch agent_id from the listings table based on listing_id
            $sql_fetch_agent = "SELECT agent_id FROM listings WHERE id = ?";
            $stmt_fetch_agent = $pdo->prepare($sql_fetch_agent);
            $stmt_fetch_agent->execute([$listing_id]);
            $listing = $stmt_fetch_agent->fetch(PDO::FETCH_ASSOC);
            
            if ($listing) {
                $agent_id = $listing['agent_id'];

                // Insert the inquiry into the database
                $sql_insert_inquiry = "INSERT INTO inquiries (listing_id, agent_id, message) VALUES (?, ?, ?)";
                $stmt_insert_inquiry = $pdo->prepare($sql_insert_inquiry);
                $stmt_insert_inquiry->execute([$listing_id, $agent_id, $message]);

                // Redirect back to the listings page or any other appropriate page
                header('Location: view_listings.php');
                exit();
            } else {
                // Handle case where listing is not found
                echo "Error: Listing not found.";
                exit();
            }
        } catch (Exception $e) {
            // Handle database errors
            echo "Error inserting inquiry: " . $e->getMessage();
            exit();
        }
    } else {
        // Redirect back to the form with an error message if any required fields are missing
        header('Location: view_listings.php?error=1');
        exit();
    }
} else {
    // Redirect back to the form with an error message if the form is not submitted via POST method
    header('Location: view_listings.php?error=2');
    exit();
}
?>