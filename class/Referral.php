<?php

class Referral
    {
        public function __construct() {
            $db = new DatabaseConnection;
            $this->conn = $db->conn;
        }
        
        public function myRefs($username) {
            $getP = mysqli_query($this->conn, " SELECT * FROM level_one WHERE parent='$username'");
            $getGP = mysqli_query($this->conn, " SELECT * FROM level_two WHERE grandparent='$username'");
            
            return mysqli_num_rows($getP) + mysqli_num_rows($getGP);
        }
        
        public function directRefs($username) {
            $getRefs = mysqli_query($this->conn, " SELECT * FROM level_one WHERE parent='$username'");
            
            return mysqli_num_rows($getRefs);
        }
        
        private function getUser($user) {
            $getUser = mysqli_query($this->conn, "SELECT * FROM customers WHERE username='$user'");
            if(mysqli_num_rows($getUser) > 0) {
                while($row = mysqli_fetch_assoc($getUser)) {
                    if($row['activated'] == 1) {
                        return 0;
                    } else {
                        return 10;
                    }
                }
            } else {
                return 0;
            }
        }
        
        public function pendingIncome($username) {
            $getRefs = mysqli_query($this->conn, "SELECT * FROM level_one WHERE parent='$username'");
            if(mysqli_num_rows($getRefs) > 0) {
                $pending = 0;
                while($row = mysqli_fetch_assoc($getRefs)) {
                    $child = $row['username'];
                    $pending = $pending + $this->getUser($child);
                }
            } else {
                $pending = 0;
            }
            return $pending;
        }
        
    
        
    }
?>