<?php
/**
 * Redis test
 * Author : Eric See
 * 11/11/2016
 */
 
namespace wheytv\redis;
 
require_once("redis_init.php");
require_once("redis_fns.php");

$key = 'chat-eric';
clearChat($key);
insertMessageToChat($key, 'eric', 'how are you');
insertMessageToChat($key, 'fio', 'boring');
insertMessageToChat($key, 'eric', 'what to do?');
$msg = getLastMessageFromChat($key);
print_r($msg);
$total = getTotalMessages($key);
print_r($total);
$list = getAllMessagesOfKey($key);
print_r($list);
insertLiveStream('eric');
insertLiveStream('fio');
insertLiveStream('fio');
removeLiveStream('fio');
$list = getAllLiveStream();
print_r($list);
publishAdvertisement($ADVERTISEMENT['TXT'], "This ia standard advertisement");
publishAdvertisement($ADVERTISEMENT['URL'], "Please visit us", "http://www.wheytv.com");

//Exists
flushAll();
insertKeyWithExpiry("test-Key", 60);
$exist = isKeyExists("test-Key1");
echo "test-Key ".$exist.PHP_EOL;
?>
