<?php
/**
 * Elasticsearch Server Class
 * Author : Eric See
 * 8/11/2016
 */
 
namespace wheytv\elasticsearch;
require_once("elasticsearch_init.php");
require 'vendor/autoload.php';

use Elasticsearch;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Connections\Connection;

 
class ElasticSearch_Utils {
 
	private static $instance;
	public $client;
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
       print "Destroying Connection".PHP_EOL;
    }
	
	//connect
	private function connect()
	{
		echo 'Connecting to Elasticsearch on Port '.ELASTICSEARCH_HOST.':'.ELASTICSEARCH_PORT.PHP_EOL;
		
		$this->client = Elasticsearch\ClientBuilder::create()
            ->setHosts([ELASTICSEARCH_HOST.':'.ELASTICSEARCH_PORT])
            ->setRetries(ELASTICSEARCH_RETRIES)
            ->build();
			
		try {
			$searchParams = array();
            $this->client->search($searchParams);
        } catch (Elasticsearch\Common\Exceptions\TransportException $e) {
            $previous = $e->getPrevious();
			echo 'Caught exception: '.$e->getMessage();
			return false;
        } catch (\Exception $e) {
            throw $e;
        }	
		return true;
	}

	
	//Connected status
	function isConnected()
	{
		return $this->connected;
	}
	
	//Insert
	function insertDocument($params)
	{
		$result = $this->client->index($params);
		return $result;
	}
	
	//Search
	function searchDocument($params)
	{
		try {
			$result = $this->client->search($params);
			return $result;
		} catch (Elasticsearch\Common\Exceptions\InvalidArgumentException $e) {
			echo 'searchDocument::Caught exception: '.$e->getMessage().PHP_EOL;	
		} catch (Elasticsearch\Common\Exceptions\Missing404Exception $e) {
			echo 'searchDocument::Caught exception: '.$e->getMessage().PHP_EOL;	
		}
	}
	
	//Update
	function updateDocument($params)
	{
		try {			
			$result = $this->client->update($params);
			return $result;	
		} catch (Elasticsearch\Common\Exceptions\InvalidArgumentException $e) {
			echo 'updateDocument:Caught exception: '.$e->getMessage().PHP_EOL;	
		} catch (Elasticsearch\Common\Exceptions\Missing404Exception $e) {
			echo 'updateDocument::Caught exception: '.$e->getMessage().PHP_EOL;	
		} catch (Elasticsearch\Common\Exceptions\BadRequest400Exception $e) {
			echo 'updateDocument::Caught exception: '.$e->getMessage().PHP_EOL;	
		}
	}
	
	//Delete
	function deleteDocument($params)
	{
		try {
			$this->client->delete($params);
		} catch (Elasticsearch\Common\Exceptions\InvalidArgumentException $e) {
			echo 'deleteDocument::Caught exception: '.$e->getMessage().PHP_EOL;	
		} catch (Elasticsearch\Common\Exceptions\Missing404Exception $e) {
			echo 'deleteDocument:Caught exception: '.$e->getMessage().PHP_EOL;	
		}
	} 
}
?>