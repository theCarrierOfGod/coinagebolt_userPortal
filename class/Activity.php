<?php

class Activity
    {
        public function __construct() {
            $db = new DatabaseConnection;
            $this->conn = $db->conn;
        }
        
        function recordActivity($user, $type) {
            $detail = $type . ': ' . $_SERVER['REMOTE_ADDR'];
            
            $date = date('Y-m-d');
            $insert = "INSERT INTO activity(`username`, `detail`, `view`, `date`) VALUES('$user', '$detail', 0, '$date')";
            if(mysqli_query($this->conn, $insert)) {
                return true;
            } else {
                return false;
            }
        }
        
        function myRecentActivity($user) {
            $get = "SELECT * FROM activity WHERE username='$user' ORDER BY id DESC";
            $rows = mysqli_query($this->conn, $get);
            
            $response;
            
            while($row = mysqli_fetch_assoc($rows)) {
                $response[] = $row;
            }
            
            return $response;
        }
        
        function myActivity($user) {
            $get = "SELECT * FROM activity WHERE username='$user'";
            
            return mysqli_query($this->conn, $get);
        }
    }

?>