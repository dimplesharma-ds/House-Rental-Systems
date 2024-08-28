<?php
// Start the session
session_start(); //session is php variable that starts a new session

// Unset all of the session variables
$_SESSION = array();  //superglobal array that stores sesion variables, array() replaces the existing contents with an empty array

// Destroy the session
session_destroy(); //buil-in function that destroys all data of the session, completely terminates the current session
 
// Redirect to the login page after logout
header("Location:login.php");
exit();
?>
