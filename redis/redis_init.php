<?php
/**
 * Init Redis Client
 * Author : Eric See
 * 11/11/2016
 */
define('REDIS_PRINT', false);
define('REDIS_SERVER','127.0.0.1');
define('REDIS_PORT',6379);
define('REDIS_PROTOCOL', 'tcp');
define('REDIS_PUB_SUB_CHANNEL','chat_channel'); //for PUB/SUB advertising
define('REDIS_LIVESTREAM_KEY','live-streams');
define('REDIS_CHAT_MESSAGE_PREFIX','chat-');

$ADVERTISEMENT = array(
	"TXT"=>"txt", 
	"URL"=>"url"
);
?>