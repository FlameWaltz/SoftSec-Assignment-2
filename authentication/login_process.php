<?php
// login_process.php

session_start();
include("db.php");

// get input
$email = $_POST['email'];
$password = $_POST['password'];

// get user from DB
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// check if user exists
if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    // verify hashed password
    if (password_verify($password, $user['password'])) {

        // store session (VERY IMPORTANT for homepage later)
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];

        echo "Login success! Welcome " . $user['name'];

        // later redirect homepage
        // header("Location: homepage.php");

    } else {
        echo "Wrong password!";
    }

} else {
    echo "User not found!";
}
?>