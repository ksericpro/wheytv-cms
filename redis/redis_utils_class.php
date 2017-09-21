<?php
/**
 * Redis Classes
 * Author : Eric See
 * 11/11/2016
 */
namespace wheytv\redis;

require "predis/autoload.php";
\Predis\Autoloader::register();

require_once("redis_init.php");

class Redis_Utils {
 
	private static $instance;
	public $redis;
	private $connected = false;
 
	private function __construct() {
		$this->connected = $this->connect();
	}
 
	static public function instantiate(){
		if(!isset(self::$instance)){
			$class = __CLASS__;
			self::$instance = new $class;
		}
		return self::$instance;
	}
	
	function __destruct() {
       if (REDIS_PRINT) print "Destroying Connection".PHP_EOL;
	   $this->disconnect();
    }
	
	//connect
	private function connect()
	{	
		if (REDIS_PRINT) echo 'Connect to '.REDIS_PROTOCOL.':'.REDIS_SERVER.':'.REDIS_PORT.PHP_EOL;
		try {
			 $this->redis = new \Predis\Client(array(
				"scheme" => REDIS_PROTOCOL,
				"host" => REDIS_SERVER,
				"port" => REDIS_PORT
			));
	
			if ($this->redis) {
				if (REDIS_PRINT) echo "Redis connected.".PHP_EOL;
			}
		} catch (Exception $e) {
			if (REDIS_PRINT) echo "Fail to conect to Redis.".$e->getMessage().PHP_EOL;
			throw $e;
			return false;
		}
		
		return true;
	}
	
	//Disconnect
	function disconnect()
	{
		// Close the link 
		if($this->redis)
			$this->redis->disconnect();
	}
	
	//Connected status
	function isConnected()
	{
		return $this->connected;
	}
	
	//delete all message of Key
	function deleteInList($key)
	{
		if (REDIS_PRINT) echo "Remove all list of $key".PHP_EOL;
		//$this->redis->del($key, '');
		$this->redis->ltrim($key, -1, -2);		
	}
	
	//Delete Key
	function deleteKey($key)
	{
		if (REDIS_PRINT) echo "Delete $key".PHP_EOL;
		$this->redis->del($key, '');
	}
	
	//get the number of messages of key
	function getTotalInList($key)
	{
		$length = $this->redis->llen($key); 
		//echo "List of chat-eric = ".$length.PHP_EOL;
		return $length;
	}
	
	//insert message to key
	function insertIntoRearOfList($key, $array)	
	{
		if (REDIS_PRINT) echo "insert messages into $key".PHP_EOL;
		$this->redis->rpush($key, json_encode($array));
	}
	
	//Pop from Rear
	function popLastFromList($key)
	{
		if (REDIS_PRINT) echo "retrieving last message of $key".PHP_EOL;
		return $this->redis->rpop("chat-eric"); 
	}
	
	//Get All messages 
	function getAllOfList($key)
	{
		if (REDIS_PRINT) echo "Getting all messages of $key".PHP_EOL;
		return $this->redis->lrange($key, 0, -1);
	}
	
	//add value to key
	function addValToKey($key, $val)
	{
		if (REDIS_PRINT) echo "Add $val to $key".PHP_EOL;
		$this->redis->sadd($key, $val);
	}
	
	//remove value from key
	function removeValFromKey($key, $val)
	{
		if (REDIS_PRINT) echo "Remove $val to $key".PHP_EOL;
		$this->redis->srem($key, [$val]);
	}

	//Get all value of key
    function getAllValOfKey($key)
	{
		if (REDIS_PRINT) echo "Get all values of $key".PHP_EOL;
		return $this->redis->smembers($key);
	}
	
	//Check if value exists in key
	function isValExistsInKey($key, $val)
	{
		return $this->redis->sismember($key, $val); // false
	}
	
	//Set Expiry
	function setExpiryToKey($key, $val)
	{
		if (REDIS_PRINT) echo "Set expiry of $key to $val".PHP_EOL;
		$this->redis->expireat($key, time() + $val);
	}
	
	//Publish to channel
	function publish($channel, $message)
	{
		if (REDIS_PRINT) echo "Publish $message to ".$channel.PHP_EOL;
		$this->redis->publish($channel, $message);
	}
	
	//Check key Exists
	function isKeyExists($key)
	{
		return $this->redis->exists($key);
	}
	
	//flush all
	function flushAll()
	{
		$this->redis->flushall();
	}
}

?>