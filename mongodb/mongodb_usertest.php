<?php
include_once("mongodb_fns.php");

//check password
$result = (int)wheytv\mongodb\checkUserPassword('ksericpro@gmail.com', '12345');
echo $result.PHP_EOL;

//Query User using email
$user = wheytv\mongodb\getUser('ksericpro@gmail.com');
//echo $user['first-name'].' '.$user['last-name'].PHP_EOL;
//echo json_encode($user).PHP_EOL;
$json = '{"user":'.json_encode($user).'}';
echo $json.PHP_EOL;

//$json_obj = json_decode($json);
//$user = json_decode($json_obj->user);
//echo $user["email"].PHP_EOL;

?>