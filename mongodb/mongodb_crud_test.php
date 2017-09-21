<?php
require_once('mongodb_utils_class.php');

$mongo =  wheytv\mongodb\MongoDB_Utils::instantiate();

//Find
$collection = $mongo->get_collection('LiveStreamCurrent');
$cursor = $collection->find();
if($cursor->count()==0)
{
	echo "Collection Not found.".PHP_EOL;
}
else 
{
	foreach ( $cursor as $id => $value )
	{
		var_dump( $value );
	}
}

//delete
$collection->remove(array("stream-key"=>"fioteo"),array("justOne" => true));
echo "Document deleted successfully".PHP_EOL;

//Insert
$document = array( 
     "stream-key" => "fioteo", 
     "start-time" => "2016-11-01 12:00", 
     "image" => "/image/livestream/fioteo.jpg"
);

$collection->insert($document);
echo "Document inserted successfully".PHP_EOL;

//find a particular eric
$query = array('stream-key' => 'eric');

$cursor = $collection->find($query);
foreach ($cursor as $doc) {
    var_dump($doc);
}

// now update the document
$collection->update($query, array('$set'=>array("start-time"=>"2014-09-01 00:00")));
echo "Document updated successfully".PHP_EOL;

//Delete all from table
$collection = $mongo->get_collection('ViewingHistory');
$collection->remove(array(),array('safe' => true));

?>