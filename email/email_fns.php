<?php
/**
 * Init Email Functions
 * Author : Eric See
 * 6/11/2016
 */
namespace wheytv\email;
use PHPMailer;

include_once("email_init.php");
require_once '../libs/PHPMailer/class.phpmailer.php';
require_once '../libs/PHPMailer/PHPMailerAutoload.php';

//Send Email
function sendEmail($message, $subject, $address, $recipent_name, $ishtml = true, $maildata = '', $attachments=''){
	$mail = new PHPMailer(); // create a new object
	
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail tls/ssl
	$mail->Host = SMTP_HOST;
	$mail->Port = SMTP_PORT; // or 587
	$mail->IsHTML($ishtml);
	$mail->Username = SMTP_EMAIL_USERNAME;
	$mail->Password = SMTP_EMAIL_PASSWORD;
	$mail->SetFrom(SMTP_EMAIL_USERNAME);
	$mail->Subject = $subject;
	if ($ishtml)
		$mail->Body = html_entity_decode($message);
	else
		$mail->Body = $message;
	
	$mail->AddAddress($address, $recipent_name);
	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo.PHP_EOL;
		return false;
	} else {
		echo "Message has been sent".PHP_EOL;
		return true;
	}
}

?>