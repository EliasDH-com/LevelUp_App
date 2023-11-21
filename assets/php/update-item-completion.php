<?php
/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

include '../php/database.php';

if (isset($_POST['completed'])) {
    $completedItemId = $_POST['completed'];
    // Voer de query uit om de status van het item bij te werken
    $updateQuery = "UPDATE item SET status = 1, completion = CURDATE() WHERE item_id = $completedItemId";
    
    $conn->query($updateQuery) === TRUE;
}
$conn->close();
?>
