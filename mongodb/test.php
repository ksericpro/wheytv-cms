<?php
   require_once("mongodb_init.php");
   
   // connect to mongodb
  // $m = new MongoClient(MONGO_CONNECTION_STRING);
	
   //echo "Connection to database successfully".PHP_EOL;
   // select a database
  // $db = $m->wheytv;
	
  // echo "Database wheytv detected".PHP_EOL;
   
   //close db
  // $m->close();
   
  

$manager = new MongoDB\Driver\Manager(MONGO_CONNECTION_STRING);
var_dump($manager);


?>