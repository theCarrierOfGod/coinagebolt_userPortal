<?php

class LevelOne
    {
        public function __construct() {
            $db = new DatabaseConnection;
            $this->conn = $db->conn;
            
            $act = new Activity;
            $this->act = $act;
            
            $user = new User;
            $this->user = $user;
        }
        
        private function checkActive($username) {
            $get = "SELECT * FROM customers WHERE username='$username'";
            $rows = mysqli_query($this->conn, $get);
            
            if(mysqli_num_rows($rows) > 0) {
                while($row = mysqli_fetch_assoc($rows)) {
                    $active = $row['display_picture'];
                    if($active == 1) 
                        return true;
                    else 
                        return false;
                }
            } else {
                return false;
            }
        }
        
        public function worthy($username) {
            $checkWorthiness = mysqli_query($this->conn, "SELECT * FROM customers WHERE username='$username' AND activated=1");
            
            if(mysqli_num_rows($checkWorthiness) == 0) {
                return false;
            } else {
                return true;
            }
        }
        
        public function newOne($username, $parent) {
            if(mysqli_query($this->conn, "INSERT INTO level_one(`username`, `parent`) VALUES('$username', '$parent')")) {
                $this->act->recordActivity($parent, 'Referred ' . $username);
                return true;
            } else {
                return false;
            }
        }
        
        public function myDownlines($username) {
            $get = mysqli_query($this->conn, "SELECT * FROM level_one WHERE parent='$username'");
            $response = [];
            if(mysqli_num_rows($get) > 0) {
                while($row = mysqli_fetch_assoc($get)) {
                    $response[] = $row;
                }
            }
            return $response;
        }
        
        private function getLevel($username) {
            $query = mysqli_query($this->conn, "SELECT * FROM customers WHERE username='$username'");
            while($row = mysqli_fetch_assoc($query)) {
                return $row['level'];
            }
        }
        
        public function checkUpgrade($username) {
            $query = mysqli_query($this->conn, "SELECT * FROM customers WHERE username='$username'");
            $row = mysqli_fetch_assoc($query);
            $level = $row['level'];
            
            $juquery = mysqli_query($this->conn, "SELECT * FROM customers WHERE referral_id='$username' AND level='$level'");
            if(mysqli_num_rows($juquery) === 2) {
                if($this->user->getBalance($username) >= $this->user->getNextPrice($username)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    } 
?>