<?php
require_once("elasticsearch_fns.php");

//Streaming Info
//wheytv\elasticsearch\insertStreamingInfo('172.21.0.1', 'eric', 'start', strtotime("-1d"));
//print_r($result);
$result = wheytv\elasticsearch\getStreamKeyStreamingInfo('eric');
print_r($result);
$result = wheytv\elasticsearch\deleteStreamingInfo('AVhMsV9HKiYVPLOCcvLb');
print_r($result);
$result = wheytv\elasticsearch\updateStreamingInfo('AVhMsUAzKiYVPLOCcvLa', '172.21.0.1', 'eric', 'stop', strtotime("-1d"));
print_r($result);

//Viewing Info
//$result = wheytv\elasticsearch\insertViewingInfo('172.21.0.1', 'eric', 'start', strtotime("-1d"));
//print_r($result);
$result = wheytv\elasticsearch\getStreamKeyViewingInfo('eric');
print_r($result);
$result = wheytv\elasticsearch\updateViewingInfo('AVhM9Ka3KiYVPLOCcvLh', '172.21.0.1', 'eric', 'stop', strtotime("-1d"));
print_r($result);
?>