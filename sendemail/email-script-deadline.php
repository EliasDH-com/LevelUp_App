<?php
/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

require 'vendor/autoload.php';

use \jamesiarmes\PhpEws\Client;
use \jamesiarmes\PhpEws\Enumeration\MessageDispositionType;
use \jamesiarmes\PhpEws\Request\CreateItemType;
use \jamesiarmes\PhpEws\ArrayType\ArrayOfRecipientsType;
use \jamesiarmes\PhpEws\ArrayType\NonEmptyArrayOfAllItemsType;
use \jamesiarmes\PhpEws\Enumeration\BodyTypeType;
use \jamesiarmes\PhpEws\Type\BodyType;
use \jamesiarmes\PhpEws\Type\EmailAddressType;
use \jamesiarmes\PhpEws\Type\MessageType;
use \jamesiarmes\PhpEws\Type\SingleRecipientType;

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

$host = 'exchange.jfk.be';
$byemail = 'noreply@levelup.be';
$bypassword = '2X7tbq1x';
$version = Client::VERSION_2010_SP2;

$client = new Client($host, $byemail, $bypassword, $version);

// Build the request,
$request = new CreateItemType();
$request->Items = new NonEmptyArrayOfAllItemsType();

// Save the message, but do not send it.
$request->MessageDisposition = MessageDispositionType::SEND_AND_SAVE_COPY;

// Get the email content.
$emailtemplate = file_get_contents('email-template-deadline.html');

for ($i = 0; $i < count($emailaddresses); $i++) {
	$emailContent = $emailtemplate;

	// Replace the placeholders with the actual values.
	$emailBody = str_replace('[USERNAME]', $usernames[$i], $emailContent);
	$emailBody = str_replace('[ITEM_NAME]', $names[$i], $emailBody);
	$emailBody = str_replace('[DEADLINE]', $deadlines[$i], $emailBody);

	// Create the message.
	$message = new MessageType();
	$message->Subject = 'Level Up App - Upcoming deadline';
	$message->ToRecipients = new ArrayOfRecipientsType();

	// Set the sender.
	$message->From = new SingleRecipientType();
	$message->From->Mailbox = new EmailAddressType();
	$message->From->Mailbox->EmailAddress = $username;

	// Set the recipient.
	$recipient = new EmailAddressType();
	$recipient->EmailAddress = $emailaddresses[$i];
	$message->ToRecipients->Mailbox[] = $recipient;

	// Set the message body.
	$message->Body = new BodyType();
	$message->Body->BodyType = BodyTypeType::HTML;
	$message->Body->_ = $emailBody;

	// Add the message to the request.
	$request->Items->Message[] = $message;
}

$response = $client->CreateItem($request);
?>