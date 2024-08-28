<?php include"header.php"?>
<?php
// Database connection
$host = 'localhost';
$dbname = 'proj';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Failed to connect to the database: " . $e->getMessage());
}

// Fetch top 20 listings
$stmt = $pdo->query('
    SELECT 
        id,
        agent_name,
        title,
        description,
        price,
        image_url,
        location,
        rating
    FROM 
        listings
    ORDER BY 
        rating DESC
    LIMIT 20
');

$listings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Top 20 Listings</title>
</head>
<body>
    <h1>Top 20 Listings</h1>
    <ul>
        <?php foreach ($listings as $listing): ?>
            <li>
                <strong><?= htmlspecialchars($listing['title']) ?></strong><br>
                <?= nl2br(htmlspecialchars($listing['description'])) ?><br>
                Price: $<?= htmlspecialchars($listing['price']) ?><br>
                Location: <?= htmlspecialchars($listing['location']) ?><br>
                Rating: <?= htmlspecialchars($listing['rating']) ?><br>
                Agent: <?= htmlspecialchars($listing['agent_name']) ?><br>
                <img src="<?= htmlspecialchars($listing['image_url']) ?>" alt="Property Image" style="max-width: 200px;"><br>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
