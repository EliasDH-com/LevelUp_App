<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP; // Import the SMTP class
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


$conn = mysqli_connect("localhost", "root", "", "levelup_app_upkeepify");
// $conn = mysqli_connect("localhost", "levelupdb", "2650", "levelupapp");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Provide all necessary item and user data of items that are not yet ready (status = 0)?
$queryGetAllItemsAndUser = "SELECT username, email, name, deadline FROM item JOIN users ON assigned = user_id WHERE status = 0";

$result = mysqli_query($conn, $queryGetAllItemsAndUser);

echo mysqli_error($conn);

$usernames = array();
$emailaddresses = array();
$names = array();
$deadlines = array();

while ($row = mysqli_fetch_assoc($result)) {
    $usernames[] = $row['username'];
    $emailaddresses[] = $row['email'];
    $names[] = $row['name'];
    $deadlines[] = $row['deadline'];
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'exchange.jfk.be';
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@levelup.be';
    $mail->Password = '2X7tbq1x';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->isHTML(true);
    $mail->Subject = 'Level Up App - Upcoming deadlines';

    for ($i = 0; $i < count($emailaddresses); $i++) {
        $emailBody = 'Dearest ' . $usernames[$i] . ',<br><br>';
        $emailBody .= 'The following items are not yet ready:<br>';
        $emailBody .= 'Username: ' . $usernames[$i] . '<br>';
        $emailBody .= 'Email: ' . $emailaddresses[$i] . '<br>';
        $emailBody .= 'Item Name: ' . $names[$i] . '<br>';
        $emailBody .= 'Deadline: ' . $deadlines[$i] . '<br><br>';
        $emailBody .= 'Kind regards,<br>Level Up App';

        $mail->Body = $emailBody;
        $mail->addAddress($emailaddresses[$i]);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output (for testing)
        $mail->send();
        $mail->clearAddresses();
    }

    echo 'E-mails zijn succesvol verstuurd';
} catch (Exception $e) {
    echo 'Er is een fout opgetreden bij het versturen van e-mails: ', $mail->ErrorInfo;
}
?>