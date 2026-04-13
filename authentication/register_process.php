<?php
// register_process.php

include("db.php");

// get data from form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

// hash password (IMPORTANT)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// insert into database
$sql = "INSERT INTO users (name, email, phone, password)
        VALUES (?, ?, ?, ?)";

// prepared statement (secure)
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

if ($stmt->execute()) {
    echo "Register successful!";
} else {
    echo "Error: " . $conn->error;
}
?>