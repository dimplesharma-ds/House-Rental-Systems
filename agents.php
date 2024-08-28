<!DOCTYPE html>
<html>
<head>
    <title>Display Data for Multiple Agents</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Display Data for Multiple Agents</h1>
    <?php
    // Assuming you have a database connection established
    //  'your_hostname', 'your_username', 'your_password', and 'your_database' with your actual database credentials
    $conn = new mysqli('localhost', 'root', '', 'proj'); //mysqli is the constructor which establishes connection
    // Check connection
    if ($conn->connect_error) { // $conn is variable that represents db connection object   
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to select all agents
    $agent_sql = "SELECT * FROM agents";
    $agent_result = $conn->query($agent_sql);

    // Loop through each agent
    while ($agent_row = $agent_result->fetch_assoc()) {
        echo "<div>";
        echo "<textarea rows='6' cols='50'>";
        echo "Agent ID: " . $agent_row["agent_id"] . "\n";
        echo "Agent Name: " . $agent_row["agent_name"] . "\n";
        echo "Phone Number: " . $agent_row["phone_number"] . "\n";
        echo "Bio: " . $agent_row["bio"] . "\n";
        echo "</textarea>";

        // Query to select property names for this agent
        $property_sql = "SELECT property_name FROM agents WHERE agent_id = " . $agent_row["agent_id"];
        $property_result = $conn->query($property_sql);

        if ($property_result->num_rows > 0) {
            echo "<textarea rows='5' cols='50'>";
            // Output data of each property name
            while($property_row = $property_result->fetch_assoc()) {
                echo "Property Name: " . $property_row["property_name"] . "\n";
            }
            echo "</textarea>";
        } else {
            echo "No properties found for this agent.";
        }

        echo "</div>";
    }

    $conn->close();
    ?>
</body>
</html>
