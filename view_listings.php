<?php include 'header.php'; ?>

<?php
include 'db.php';  // Adjust the path to 'db.php' as necessary

// Fetch listings from the database
$stmt = $pdo->query('SELECT * FROM listings');
$listings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Listings</title>
</head>
<body>
    <h1>All Listings</h1>
    <ul>
        <?php foreach ($listings as $listing): ?>
            <li>
                <h2><?php echo htmlspecialchars($listing['title']); ?></h2>
                <p>Description: <?php echo htmlspecialchars($listing['description']); ?></p>
                <p>BHK:<?php echo htmlspecialchars($listing['bhk']); ?></p>
                <p>Price: $<?php echo htmlspecialchars($listing['price']); ?></p>
                <p>Location: <?php echo htmlspecialchars($listing['location']); ?></p>
                <p>Rating: <?php echo htmlspecialchars($listing['rating']); ?></p>
                <p>Status: <?php echo htmlspecialchars($listing['status']);?></p>
                <?php if ($listing['image_url']): ?>
                    <img src="<?php echo htmlspecialchars($listing['image_url']); ?>" alt="<?php echo htmlspecialchars($listing['title']); ?>" style="width:200px;">
                <?php endif; ?>

                
        <?php endforeach; ?>
    </ul>
</body>
</html>
