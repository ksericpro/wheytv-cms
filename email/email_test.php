<?php
include_once("email_init.php");
require_once("email_fns.php");
$details = $EMAIL_DETAILS['EMAIL_SIGNUP_SUBJECT'];
$data = file_get_contents($details['TEMPLATE']); //read the file
echo $data.PHP_EOL;
$target = 'ksericpro@gmail.com';
$result =  wheytv\email\sendEmail($data, $details['SUBJECT'], $target, 'Eric See'); //Recipient, Subject, Body, Name
//$result =  wheytv\email\sendEmail('dsds', $details['SUBJECT'], $target, 'Eric See', false);

//$result =  test($target,'hi',$data); //Recipient, Subject, Body, Name
if ($result) echo "Email Sent to $target.".PHP_EOL;
?>

