<?php

    define('DB_SERVER','localhost');
    define('DB_USER','urban_user2');
    define('DB_PASS' ,'xXFZp4^b5ylL');
    define('DB_NAME', 'coinage');
    date_default_timezone_set('Africa/Lagos');
        
    class DatabaseConnection
    {
        public function __construct()
        {
            $conn = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    
            if($conn->connect_error)
            {
                die ("<h1>Database Connection Failed</h1>");
            }
            
            return $this->conn = $conn;
        }
    }

?>