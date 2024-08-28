
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proj";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname); // mysqli is a class in PHP representing connection to MYSQL db

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
