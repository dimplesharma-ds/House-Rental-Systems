<?php
session_start();
session_destroy();
header("Location: login.php"); // built in function to send raw http header to client, location tells browser to redirect to different URL
exit(); // built in function terminates the execution of script immediately
?>
