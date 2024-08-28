<?php 
include"header.php"
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agents and Properties</title>
    <style>
        .properties {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Agents and Their Properties</h1>
    <?php
    include 'db.php';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Failed to connect to the database: " . $e->getMessage());
    }

    // Fetch agents and their properties
    $stmt = $pdo->query('
        SELECT 
            id,
            agent_name,
            title,
            description,
            price,
            image_url,
            location,
            rating,
            agent_id
        FROM 
            listings
        ORDER BY 
            agent_id
    ');

    $agents = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $agent_id = $row['agent_id'];
        $agent_name = $row['agent_name'];
        // If the agent doesn't exist in the $agents array, create a new entry
        if (!isset($agents[$agent_id])) {
            $agents[$agent_id] = [
                'agent_name' => $agent_name,
                'properties' => [],
            ];
        }
        // Add the property details to the agent's properties array
        $agents[$agent_id]['properties'][] = [
            'listing_id' => $row['id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'price' => $row['price'],
            'image_url' => $row['image_url'],
            'location' => $row['location'],
            'rating' => $row['rating'],
        ];
    }
    ?>

    <?php foreach ($agents as $agent_id => $agent): ?>
        <h2>
            <a href="#" class="agent-link" data-agent="<?= htmlspecialchars($agent_id) ?>">
                <?= htmlspecialchars($agent['agent_name']) ?>
            </a>
        </h2>
        <ul class="properties" id="properties-<?= htmlspecialchars($agent_id) ?>">
            <?php foreach ($agent['properties'] as $property): ?>
                <li>
                    <strong><?= htmlspecialchars($property['title']) ?></strong></br>
                    <?= nl2br(htmlspecialchars($property['description'])) ?></br>
                    Price: $<?= htmlspecialchars($property['price']) ?></br>
                    Location: <?= htmlspecialchars($property['location']) ?></br>
              \      Rating: <?= htmlspecialchars($property['rating']) ?></br>
                    <img src="<?= htmlspecialchars($property['image_url']) ?>" alt="Property Image" style="max-width: 200px;"></br>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>

    <script>
        // Add click event listeners to agent links to toggle visibility of properties
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.agent-link').forEach(function(agentLink) {
                agentLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    var agentId = this.getAttribute('data-agent');
                    var properties = document.getElementById('properties-' + agentId);
                    if (properties.style.display === 'none') {
                        properties.style.display = 'block';
                    } else {
                        properties.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>