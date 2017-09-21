<?php
/**
 * Elasticsearch Server fns
 * Author : Eric See
 * 10/11/2016
 */
 
namespace wheytv\elasticsearch;
require_once("elasticsearch_utils_class.php");

/**
* Streaming Info
*/

//Insert Streaming Info
function insertStreamingInfo($ip, $streamkey, $operation, $starttime)
{
	echo 'insert StreamingInfo'.PHP_EOL;
	$client = ElasticSearch_Utils::instantiate();
	
	$params = [
		'index' => 'streaminginfo_index',
		'type' => 'streaminginfo',
		'body' => [ 
			'ip' => $ip,
			'stream-key'=> $streamkey,
			'operation'=> $operation,
			'start-time' => $starttime
		]
	];
	
	$result = $client->insertDocument($params);
	return $result;
}

//Get all StreamingInfo about stream key
function getStreamKeyStreamingInfo($streamkey)
{
	echo 'get StreamKey StreamingInfo'.$streamkey.PHP_EOL;
	$client = ElasticSearch_Utils::instantiate();
	$params = [
		'index' => 'streaminginfo_index',
		'type' => 'streaminginfo',
		'body' => [
			'query' => [
				'match' => [
					'stream-key' => $streamkey
				]
			]
		]
    ];

	$result = $client->searchDocument($params);
	return $result;
}

//delete streaming info
function deleteStreamingInfo($id)
{
	echo 'delete StreamingInfo '.$id.PHP_EOL;
	$client = ElasticSearch_Utils::instantiate();
	$params = [
		'index' => 'streaminginfo_index',
		'type' => 'streaminginfo',
		'id' => $id
    ];

	$result = $client->deleteDocument($params);
	return $result;
}

//update streaming info
function updateStreamingInfo($id, $ip, $streamkey, $operation, $starttime)
{
    echo 'update StreamingInfo '.$id.PHP_EOL;
	$client = ElasticSearch_Utils::instantiate();
	$params = [
		'index' => 'streaminginfo_index',
		'type' => 'streaminginfo',
		'id' => $id,
		'body' => [ 
		     'doc' => [
				'ip' => $ip,
				'stream-key'=> $streamkey,
				'operation'=> $operation,
				'start-time' => $starttime
				]		
		]
	];
	
	$result = $client->updateDocument($params);
	return $result;
}

/**
* Viewing Info
*/

//Insert Viewing Info
function insertViewingInfo($ip, $streamkey, $operation, $starttime)
{
	echo 'insert ViewingInfo'.PHP_EOL;
	$client = ElasticSearch_Utils::instantiate();
	
	$params = [
		'index' => 'viewinginfo_index',
		'type' => 'viewinginfo',
		'body' => [ 
			'ip' => $ip,
			'stream-key'=> $streamkey,
			'operation'=> $operation,
			'start-time' => $starttime
		]
	];
	
	$result = $client->insertDocument($params);
	return $result;
}

//Get all Viewing Info about stream key
function getStreamKeyViewingInfo($streamkey)
{
	echo 'get StreamKey ViewingInfo'.$streamkey.PHP_EOL;
	$client = ElasticSearch_Utils::instantiate();
	$params = [
		'index' => 'viewinginfo_index',
		'type' => 'viewinginfo',
		'body' => [
			'query' => [
				'match' => [
					'stream-key' => $streamkey
				]
			]
		]
    ];

	$result = $client->searchDocument($params);
	return $result;
}

//delete viewing info
function deleteViewingInfo($id)
{
	echo 'delete ViewingInfo '.$id.PHP_EOL;
	$client = ElasticSearch_Utils::instantiate();
	$params = [
		'index' => 'viewinginfo_index',
		'type' => 'viewinginfo',
		'id' => $id
    ];

	$result = $client->deleteDocument($params);
	return $result;
}

//update viewing info
function updateViewingInfo($id, $ip, $streamkey, $operation, $starttime)
{
    echo 'update ViewingInfo '.$id.PHP_EOL;
	$client = ElasticSearch_Utils::instantiate();
	$params = [
		'index' => 'viewinginfo_index',
		'type' => 'viewinginfo',
		'id' => $id,
		'body' => [ 
		     'doc' => [
				'ip' => $ip,
				'stream-key'=> $streamkey,
				'operation'=> $operation,
				'start-time' => $starttime
				]		
		]
	];
	
	$result = $client->updateDocument($params);
	return $result;
}
?>