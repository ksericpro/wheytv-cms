<?php
include_once("mongodb_fns.php");

//Query User using email
$user = wheytv\mongodb\getUser('ksericpro@gmail.com');
echo $user['first-name'].' '.$user['last-name'].PHP_EOL;

$user2 = wheytv\mongodb\checkUserPassword('ksericpro@gmail.com','12345');
echo $user2['first-name'].' '.$user2['last-name'].PHP_EOL;

//delete User
wheytv\mongodb\deleteUser('fioteo@yahoo.com.sg');

//Insert User
$document = array( 
     "first-name" => "Fiona", 
	 "last-name" => "Teo", 
	 "email" => "fioteo@yahoo.com.sg", 
     "password" => "12345", 
	 "display-name" => "FioTeo", 
	 "stream-key" => "fioteo",
	 "promoted-streamer" => "ksericpro@gmail.com",
	 "partner" => false,
	 "game" => array (
		"level"=>100,
        "wings"=>20,
        "experience"=>100
	 ),
     "image" => "/images/fioteo.jpg"
);

wheytv\mongodb\insertUser($document);

//update
$change = array("stream-key"=>"xxx");
wheytv\mongodb\updateUser('ksericpro@gmail.com', $change);

//delete all
wheytv\mongodb\deleteAllDocuments('ViewingHistory');
?>