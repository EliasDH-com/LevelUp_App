<?php
/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */
$conn = mysqli_connect("localhost", "root", "", "levelup_app_upkeepify");


if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);


if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $query = "SELECT username, email FROM users WHERE user_id = $user_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($user);
    }
}

$conn->close();
?>