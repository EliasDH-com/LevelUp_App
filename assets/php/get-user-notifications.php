<?php
/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

include '../../assets/php/database.php';
 
$user_id = $_GET['user_id'];
 
// Connect to the database (assuming this is done in database.php)
// ...
 
// Calculate the timestamp of 10 hours ago
$currentTimestamp = time();
$tenHoursAgo = $currentTimestamp - 36000;
 
// Query to fetch items within the last 10 hours
$query = "SELECT name, status, deadline FROM item WHERE $user_id = assigned AND deadline > FROM_UNIXTIME($tenHoursAgo)";
$result = $conn->query($query);
 
$items = array(); // Array to store the items
 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add each item to the items array
        $items[] = $row;
    }
}
 
header('Content-Type: application/json');
echo json_encode($items); // Send the items back to the JavaScript function as JSON
 
$conn->close();
?>