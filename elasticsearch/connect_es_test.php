<?php

namespace wheytv\elasticsearch;

require 'vendor/autoload.php';

use Elasticsearch;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Connections\Connection;

echo "Connecting to Elasticsearch on Port 9200".PHP_EOL;
//$client = Elasticsearch\ClientBuilder::create()->build();
//$client = Elasticsearch\ClientBuilder::create()->setHosts(["localhost:9200"])->build();

$client = Elasticsearch\ClientBuilder::create()
            ->setHosts(["localhost:9200"])
            ->setRetries(2)
            ->build();

       
//echo "Indexing".PHP_EOL;
//$params = array();
/*$params['body']  = array(
  'name' => 'Ash Ketchum',
  'age' => 10,
  'badges' => 8 
);

$params['index'] = 'pokemon';
$params['type']  = 'pokemon_trainer';

$result = $client->index($params);
print_r($result);*/

echo "Inserting #1 One level Array".PHP_EOL;
$params = array();
$params['body']  = array(
  'name' => 'Brock',
  'age' => 15,
  'badges' => 0 
);

$params['index'] = 'pokemon';
$params['type']  = 'pokemon_trainer';
$params['id'] = '1A-000';

$result = $client->index($params);
print_r($result);

echo "inserting #2 Nested Array".PHP_EOL;
$params = array();
$params['body']  = array(
  'name' => 'Misty',
  'age' => 13,
  'badges' => 0,
  'pokemon' => array(
    'psyduck' => array(
      'type' => 'water',
      'moves' => array(
        'Water Gun' => array(
          'pp' => 25,
          'power' => 40
        )
      ) 
    )
  ) 
);

$params['index'] = 'pokemon';
$params['type']  = 'pokemon_trainer';
$params['id'] = '1A-002';

$result = $client->index($params);
print_r($result);

echo "Searching #1 Age 10~15".PHP_EOL;
$params = array();
$params['index'] = 'pokemon';
$params['type']  = 'pokemon_trainer';

$params['body']['query']['bool']['must']['terms']['age'] = array(10, 15);

$result = $client->search($params);
print_r($result);

echo "Searching #2 Name = Brock".PHP_EOL;
$params = array();
$params['index'] = 'pokemon';
$params['type'] = 'pokemon_trainer';
$params['body']['query']['match']['name'] = 'brock';
$result = $client->search($params);
print_r($result);

echo "Searching #3 Pokemon Psyduck Type Boolean".PHP_EOL;
$params = array();
$params['index'] = 'pokemon';
$params['type']  = 'pokemon_trainer';
$params['body']['query']['bool']['must'][]['match']['pokemon.psyduck.type'] = 'water';

$result = $client->search($params);
print_r($result);

echo "Searching #3 try n catch".PHP_EOL;
try {
    $result = $client->search($params);
    print_r($result);
} catch (Elasticsearch\Common\Exceptions\Curl\CouldNotConnectToHost $e) {
    // All good
      $previous = $e->getPrevious();
     $this->assertInstanceOf('Elasticsearch\Common\Exceptions\MaxRetriesException', $previous);
} catch (\Exception $e) {
      throw $e;
}

echo "Update #1 Document".PHP_EOL;
$params = array();
$params['index'] = 'pokemon';
$params['type'] = 'pokemon_trainer';
$params['id'] = '1A-002';
try {
	$result = $client->get($params);
	$result['_source']['age'] = 21; //update existing field with new value

	//add new field
	$result['_source']['pokemon'] = array(
	'Onix' => array(
		'type' => 'rock',
		'moves' => array(
		'Rock Slide' => array(
			'power' => 100,
			'pp' => 40
		),
		'Earthquake' => array(
			'power' => 200,
			'pp' => 100
		)
		)
	)
	);

	$params['body']['doc'] = $result['_source'];
	
	$result = $client->update($params);
	print_r($result);
	
} catch (Elasticsearch\Common\Exceptions\Missing404Exception $e) {
	echo 'Caught exception: ',  $e->getMessage(), "\n";
} 

echo "Deleting a Document".PHP_EOL;
try {
    $client->delete([
            'index' => 'pokemon',
            'type' => 'test',
            'id' => '1A-001'
        ]);
} catch (Elasticsearch\Common\Exceptions\InvalidArgumentException $e) {
	echo 'Caught exception: ',  $e->getMessage(), "\n";	
} catch (Elasticsearch\Common\Exceptions\Missing404Exception $e) {
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>