<?php
/**
 * Init Mongo DB Server
 * Author : Eric See
 * 6/11/2016
 */
define('MONGO_PRINT', false);
define('MONGO_SERVER','127.0.0.1');
define('MONGO_PORT','27017');
define('MONGO_USERNAME', 'sa');
define('MONGO_PASSWORD', 'ultraman');
define('MONGO_SELECTED_DB','wheytv');
define('MONGO_CONNECTION_STRING', 'mongodb://'.MONGO_USERNAME.':'.MONGO_PASSWORD.'@'.MONGO_SERVER.':'.MONGO_PORT);
?>
