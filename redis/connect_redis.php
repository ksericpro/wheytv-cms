<?php
require_once('redis_init.php');

require "predis/autoload.php";
Predis\Autoloader::register();

try {
	// This connection is for a remote server
    $redis = new Predis\Client(array(
		 "scheme" => REDIS_PROTOCOL,
		 "host" => REDIS_SERVER,
		 "port" => REDIS_PORT
    ));
	
	if ($redis) echo "Redis connected.".PHP_EOL;
	$key=REDIS_CHAT_MESSAGE_PREFIX.'eric';
	
	//remove all in list
	echo "Remove all list of $key".PHP_EOL;
	$redis->del($key, 'to delete');
	$redis->ltrim($key, -1, -2);
	$length = $redis->llen("chat-eric"); 
	echo "List of chat-eric = ".$length.PHP_EOL;
		
	//Object push
	echo "insert messages into $key".PHP_EOL;
	$message_1 = array("name"=>"eric", "message"=>"Hello are you");
	$redis->rpush($key, json_encode($message_1));
	$message_2= array("name"=>"fio", "message"=>"Hello are you");
	$redis->rpush($key, json_encode($message_2));
	$message_3= array("name"=>"eric", "message"=>"Is Zackary at home?");
	$redis->rpush($key, json_encode($message_3));
	$length = $redis->llen($key); 
	echo "List of $key = ".$length.PHP_EOL;
	
	//Object retrieve
	echo "retrieving last message of $key = ";
	$msg = $redis->rpop("chat-eric"); 
	echo $msg.PHP_EOL;
	
	//Get all messages from LIST
	echo "Getting all messages of $key".PHP_EOL;
	$list = $redis->lrange($key, 0, -1);
	print_r($list);
	
	
	//Push message to chanel
	$message = "test";
	echo "Publish $message to ".REDIS_PUB_SUB_CHANNEL.PHP_EOL;
	$redis->publish(REDIS_PUB_SUB_CHANNEL, $message);
	
	//live streams
	$key = REDIS_LIVESTREAM_KEY;
	$redis->del($key, '');
	$redis->sadd($key, 'eric');
	$redis->sadd($key, 'fio'); // this entry is ignored
    
	$redis->srem($key, ['eric']);

	$exist = $redis->sismember($key, 'eric'); // false
	echo "$key eric exists = $exist.".PHP_EOL;
	
	$list = $redis->smembers($key);
	print_r($list);
	
	//Set Expiry
	//$redis->expire($key, 3600); // expires in 1 hour
	$redis->expireat($key, time() + 3600); // expires in 1 hour
	$timeleft = $redis->ttl($key);
	echo $timeleft.'s'.PHP_EOL;
	
	//disconnect
	$redis->disconnect();
	
}
catch (Exception $e) {
	echo "Fail to conect to Redis.".$e->getMessage().PHP_EOL;
	
	
	die($e->getMessage());
}

	
	

?>