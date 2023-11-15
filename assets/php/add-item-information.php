<?php
/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

include '../php/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $zone_id = $_POST['zone_id'];
    $assigned_to = $_POST['assigned'];
    $status = $_POST['status'];

    $addItemQuery = "INSERT INTO `item` (`zone_id`, `name`, `assigned`, `status`, `certificate`) 
                    VALUES ('$zone_id', '$name', '$assigned_to', '$status', '')";
    
    $conn->query($addItemQuery) === TRUE;
}
$conn->close();
?>