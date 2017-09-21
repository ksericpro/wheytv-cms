<?php
/**
 * Mongo DB functions
 * Author : Eric See
 * 6/11/2016
 */
 
namespace wheytv\mongodb;
 
require_once("mongodb_init.php");
require_once("mongodb_utils_class.php");

// User
function getUser($email)
{
	$mongo =  MongoDB_Utils::instantiate();
	$collection = $mongo->get_collection('User');
	$query = array('email' => $email);
	$cursor = $collection->find($query);
	if($cursor->count()==0)
	{
		if (MONGO_PRINT) echo "$email Not found.".PHP_EOL;
	}
	else 
	{
		foreach ( $cursor as $doc)
		{
			//var_dump( $doc );
			return $doc;
		}
	}
	return null;
}

//check user password
function checkUserPassword($email, $password)
{
	$user = getUser($email);
	if($user){ 
		//echo $user['password'].' '.$user['last-name'].PHP_EOL;
		if (MONGO_PRINT) echo "comparing ".$user['password'].' vs '.$password.PHP_EOL;
		if ($user['password']==$password)
		{
			if (MONGO_PRINT) echo "password is correct.".PHP_EOL;
			return $user;
		}
	}
	return null;
}

function insertUser($document)
{
	$mongo =  MongoDB_Utils::instantiate();
	$collection = $mongo->get_collection('User');
	$collection->insert($document);
	if (MONGO_PRINT) echo "Document inserted successfully".PHP_EOL;
}

function deleteUser($email)
{
	$mongo =  MongoDB_Utils::instantiate();
	$collection = $mongo->get_collection('User');
	$query = array('email' => $email);	
	$collection->remove($query, array("justOne" => true));
	if (MONGO_PRINT) echo "$email deleted successfully".PHP_EOL;
}

function updateUser($email, $change)
{
	$mongo =  MongoDB_Utils::instantiate();
	$collection = $mongo->get_collection('User');
	$query = array('email' => $email);	
	$collection->update($query, array('$set'=>$change));
	if (MONGO_PRINT) echo "Document updated successfully".PHP_EOL;
}

//All tables
function deleteAllDocuments($collectionname)
{
	$mongo =  MongoDB_Utils::instantiate();
	$collection = $mongo->get_collection($collectionname);
	$collection->remove(array(),array('safe' => true));
	if (MONGO_PRINT) echo "$collectionname documents deleted successfully".PHP_EOL;
}

?>
