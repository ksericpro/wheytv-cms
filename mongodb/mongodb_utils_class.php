<?php
/**
 * Mongo DB Classes
 * Author : Eric See
 * 6/11/2016
 */
namespace wheytv\mongodb;
use Mongo;

require_once("mongodb_init.php");

class MongoDB_Utils {
 
	private static $instance;
	public $connection;
	public $databse;
	private $connected = false;
 
	private function __construct() {
		//$connection_string = sprintf('mongodb://%s:%s@%s:%d/%s', DB::DBUSER, DB::DBPWD, DB::DBHOST, DB::DBPORT, DB::DBNAME);
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
       if (MONGO_PRINT) print "Destroying Connection".PHP_EOL;
	   $this->disconnect();
    }
	
	//connect
	function connect()
	{
		if (MONGO_PRINT) echo 'Connect '.MONGO_CONNECTION_STRING.PHP_EOL;
		$connection_string = MONGO_CONNECTION_STRING;
		try {
			$this->connection = new Mongo($connection_string);
			if (MONGO_PRINT) echo 'Database '.MONGO_SELECTED_DB.' Selected'.PHP_EOL;
			$this->databse = $this->connection->selectDB(MONGO_SELECTED_DB);
		} catch (MongoConnectionException $e) {
			throw $e;
			return false;
		}
		
		return true;
	}
	
	//Disconnect
	function disconnect()
	{
		// Close the link 
		if($this->connection)
			$this->connection->close();
	}
	
	//Connected status
	function isConnected()
	{
		return $this->connected;
	}
 
	public function get_collection($name){
		if (MONGO_PRINT) echo "Getting Collection ".$name.PHP_EOL;
		return $this->databse->selectCollection($name);
	}
 
}

?>