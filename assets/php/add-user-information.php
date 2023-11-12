<?php
/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

include '../php/database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect user input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
}
?>