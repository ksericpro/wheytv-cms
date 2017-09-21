<?php
/**
 * API functions
 * Author : Eric See
 * 2/12/2016
 */
 
namespace wheytv\api;

function formatCheckPasswordMessage($email, $result)
{
	return '{"message": "ok", "email":"'.$email.'", "result":"'.$result.'"}';
}

function formatGetUserMessage($user)
{
	echo '{"message": "ok", "user":'.$user.'}';
}
?>