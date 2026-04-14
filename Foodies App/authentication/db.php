<?php
// db.php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "auth_systems";

// connect to MySQL
$conn = new mysqli($host, $user, $pass, $db);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>