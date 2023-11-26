<?php
/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

include '../../assets/php/database.php';
 
$user_id = $_GET['user_id'];
$currentTimestamp = time();
$tenHoursAgo = $currentTimestamp - 36000;
 
$query = "SELECT name, status, deadline FROM item WHERE $user_id = assigned AND status = 0"; // AND deadline > FROM_UNIXTIME($tenHoursAgo)
$result = $conn->query($query);
 
$items = array();
 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}
 
header('Content-Type: application/json');
echo json_encode($items);
 
$conn->close();
?>