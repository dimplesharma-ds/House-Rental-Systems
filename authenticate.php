<?php
session_start(); // session stores the variables(information) used across multiple pages, start is  keyword indicating start of a session
require 'db.php'; // php keyword to include and evaluate specified file in current script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if adminname and password are set
    if (isset($_POST['adminname']) && isset($_POST['password'])) { 

// isset() php fuction used to determine if a variable is set and not NULL
//$_POST is php super global array that contains data submitted via HTTP POST 'adminname'is the name attribute of an input field in HTML form
   // && -- logical AND operator 


        $adminname = $_POST['adminname'];  
        // $adminname variable declaration in php
        //  you're assigning the value submitted via an HTML form input field with the name 'adminname' to the variable $adminname, making it available for further processing within your PHP script.

        $password = $_POST['password'];
        

        $stmt = $conn->prepare("SELECT * FROM admins WHERE adminname = :adminname");
        $stmt->bindParam(':adminname', $adminname);
        $stmt->execute(); // This is a method used to execute a prepared statement. It's invoked on the prepared statement object.

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password == $user['password']) {
            $_SESSION['admin'] = $user['adminname'];
            header("Location: home.php"); // Redirect to home page
        } else {
            echo "Invalid admin name or password";
        }
    } else {
        echo "Please fill in all fields.";
    }
} else {
    echo "Invalid request method.";
}
?>

//$_server is php super global array containing information about serverand current request.
//REQUEST_METHOD is array key within $_server that holds http request method used by client
// == is comparison operator in PHP compares two values for equality
//POST is a string literal representing HTTP POST request method.
//if ($_SERVER["REQUEST_METHOD"] == "POST"), you're checking if the current HTTP request method is POST
