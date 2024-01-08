<?php
/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

include '../php/database.php';

require '../../sendemail/email-script-new-user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $addUserQuery = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

    sendVerificationEmail($username, $email, $password);

    $conn->query($addUserQuery) === TRUE;
}
$conn->close();
?>