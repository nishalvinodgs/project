<?php
// db_connect.php

$host = "localhost";   // or 127.0.0.1
$user = "root";        // change if you use a different MySQL user
$pass = "";            // change if you set a password
$db   = "thriftin";    // database name

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set charset to utf8mb4 for better Unicode support
$conn->set_charset("utf8mb4");
?>
