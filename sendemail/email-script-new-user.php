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

function sendVerificationEmail($username, $email, $password) {

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
    $emailtemplate = file_get_contents('../../sendemail/email-template-new-user.html');

    // Capitalize the first letter of the username.
    $username = ucwords($username);

    // Replace the placeholders with the actual values.
    $emailBody = str_replace('[USERNAME]', $username, $emailtemplate);
    $emailBody = str_replace('[EMAILADDRESS]', $email, $emailBody);
    $emailBody = str_replace('[PASSWORD]', $password, $emailBody);

    // Create the message.
    $message = new MessageType();
    $message->Subject = 'Level Up App - New User';
    $message->ToRecipients = new ArrayOfRecipientsType();

    // Set the sender.
    $message->From = new SingleRecipientType();
    $message->From->Mailbox = new EmailAddressType();
    $message->From->Mailbox->EmailAddress = $username;

    // Set the recipient.
    $recipient = new EmailAddressType();
    $recipient->EmailAddress = $email;
    $message->ToRecipients->Mailbox[] = $recipient;

    // Set the message body.
    $message->Body = new BodyType();
    $message->Body->BodyType = BodyTypeType::HTML;
    $message->Body->_ = $emailBody;

    // Add the message to the request.
    $request->Items->Message[] = $message;

    $response = $client->CreateItem($request);
}
?>