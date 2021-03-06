<?php

/**
 * Handling database connection
 *
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class DbConnect {

    private $conn;

    function __construct() {  
		if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
			echo 'We don\'t have mysqli!!!';
		} else {
			//echo 'Phew we have it!';
		}
    }

    /**
     * Establishing database connection
     * @return database connection handler
     */
    function connect() {
        include_once dirname(__FILE__) . '/config.php';
		
		

        // Connecting to mysql database
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        // returing connection resource
        return $this->conn;
    }

}

?>
