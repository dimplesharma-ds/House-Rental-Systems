<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiries</title>
</head>
<body>
    <h1>Inquiries</h1>
    <div>
        <?php
        // Include the database connection file
        include 'db.php'; // Adjust the path as necessary

        // Fetch messages from the inquiries table
        $stmt = $pdo->query('SELECT * FROM inquiries');
        $inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display messages
        foreach ($inquiries as $inquiry) {
            $listing_id = $inquiry['listing_id'];
            $message = $inquiry['message'];
            $created_at = $inquiry['created_at'];

            // Output the message details
            echo "<p><strong>Listing ID:</strong> $listing_id</p>";
            echo "<p><strong>Message:</strong> $message</p>";
            echo "<p><strong>Created At:</strong> $created_at</p>";
            echo "<hr>";
        }
        ?>
    </div>
</body>
</html>
