<?php
/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /index.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$conn = mysqli_connect("localhost", "root", "", "levelup_app_upkeepify");
// $conn = mysqli_connect("localhost", "levelupdb", "2650", "levelupapp");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
?>