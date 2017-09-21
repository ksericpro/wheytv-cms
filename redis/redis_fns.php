<?php
/**
 * Redis functions
 * Author : Eric See
 * 11/11/2016
 */
 
namespace wheytv\redis;
 
require_once("redis_init.php");
require_once("redis_utils_class.php");

function clearChat($key)
{
	$redis =  Redis_Utils::instantiate();
	$redis->deleteInList($key);
	//$redis->getTotalInList($key);
}

function insertMessageToChat($key, $name, $message)
{
	$redis =  Redis_Utils::instantiate();
	$message = array("name"=>$name, "message"=>$message);
	$redis->insertIntoRearOfList($key, $message);
	
}

function getLastMessageFromChat($key)
{
	$redis =  Redis_Utils::instantiate();
	return $redis->popLastFromList($key);
}

function getTotalMessages($key)
{
	$redis =  Redis_Utils::instantiate();
	return $redis->getTotalInList($key);
}

function getAllMessagesOfKey($key)
{
	$redis =  Redis_Utils::instantiate();
	return $redis->getAllOfList($key);
}

function insertLiveStream($val)
{
	$redis = Redis_Utils::instantiate();
	$redis->addValToKey(REDIS_LIVESTREAM_KEY, $val);
}

function removeLiveStream($val)
{
	$redis = Redis_Utils::instantiate();
	$redis->removeValFromKey(REDIS_LIVESTREAM_KEY, $val);
}

function getAllLiveStream()
{
	$redis = Redis_Utils::instantiate();
	return $redis->getAllValOfKey(REDIS_LIVESTREAM_KEY);
}

function isLiveStreamExists($val)
{
	$redis = Redis_Utils::instantiate();
	return $redis->isValExistsInKey(REDIS_LIVESTREAM_KEY, $val);
}

function setLiveStreamExpiry($val)
{
	$redis = Redis_Utils::instantiate();
	$redis->setExpiryToKey(REDIS_LIVESTREAM_KEY, $val);
}

function removeLiveStreamKey()
{
	$redis = Redis_Utils::instantiate();
	$redis->deleteKey(REDIS_LIVESTREAM_KEY);
}

function publishAdvertisement($type, $content, $url='')
{
	$redis =  Redis_Utils::instantiate();
	$message = array("type"=>$type, "text"=>$content, "url"=>$url);
	$redis->publish(REDIS_PUB_SUB_CHANNEL, json_encode($message));
}

function insertKeyWithExpiry($key, $expire)
{
	$redis =  Redis_Utils::instantiate();
	$redis->addValToKey($key, "");
	$redis->setExpiryToKey($key, $expire);
}

function isKeyExists($key)
{
	$redis = Redis_Utils::instantiate();
	return $redis->isKeyExists($key);
}

function flushAll()
{
	$redis = Redis_Utils::instantiate();
	$redis->flushAll();
}
?>
