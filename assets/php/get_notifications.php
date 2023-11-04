<?php
/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

$conn = mysqli_connect("localhost", "root", "", "levelup_app_upkeepify");

if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);



$conn->close();
?>