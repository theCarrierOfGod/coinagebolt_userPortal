<?php

class User
    {
        
        public function __construct() {
            $db = new DatabaseConnection;
            $this->conn = $db->conn;
            
            $mail = new Mail;
            $this->mail = $mail;
        }
        
        public function userDetails($user) {
            $get = "SELECT * FROM customers WHERE username='$user'";
            $rows = mysqli_query($this->conn, $get);
            
            $response;
            
            while($row = mysqli_fetch_assoc($rows)) {
                $response[] = $row;
            }
            
            return $response;
        }
        
        public function getWalletAddress($username) {
            $get = "SELECT * FROM customers WHERE username='$username'";
            $rows = mysqli_query($this->conn, $get);
            
            if(mysqli_num_rows($rows) > 0) {
                while($row = mysqli_fetch_assoc($rows)) {
                    return $row['wallet_address'];
                }
            } else {
                return false;
            }
        }
        
        public function getBalance($username) {
            $get = "SELECT * FROM customers WHERE username='$username'";
            $rows = mysqli_query($this->conn, $get);
            
            if(mysqli_num_rows($rows) > 0) {
                while($row = mysqli_fetch_assoc($rows)) {
                    return $row['balance'];
                }
            } else {
                return false;
            }
        }
        
        public function getDP($username) {
            $get = "SELECT * FROM customers WHERE username='$username'";
            $rows = mysqli_query($this->conn, $get);
            
            if(mysqli_num_rows($rows) > 0) {
                while($row = mysqli_fetch_assoc($rows)) {
                    return $row['display_picture'];
                }
            } else {
                return false;
            }
        }
        
        public function getLevel($username) {
            $get = "SELECT * FROM customers WHERE username='$username'";
            $rows = mysqli_query($this->conn, $get);
            
            if(mysqli_num_rows($rows) > 0) {
                while($row = mysqli_fetch_assoc($rows)) {
                    return $row['level'];
                }
            } else {
                return false;
            }
        }
        
        public function toNextLevel($username) {
            $level = $this->getLevel($username);
            $newLevel = $level + 1;
            if(mysqli_query($this->conn, "UPDATE customers SET level='$newLevel' WHERE username='$username'")) {
                return true;
            } else {
                return false;
            }
        }
        
        public function getNextLevel($username) {
            $get = "SELECT * FROM customers WHERE username='$username'";
            $rows = mysqli_query($this->conn, $get);
            
            if(mysqli_num_rows($rows) > 0) {
                while($row = mysqli_fetch_assoc($rows)) {
                    return $row['level'] + 1;
                }
            } else {
                return false;
            }
        }
        
        public function getNextPrice($username) {
            $level = $this->getNextLevel($username);
            if($level == 2) {
                return 20;
            } else if ($level == 3) {
                return 40;
            } else if ($level == 4) {
                return 80;
            } else if ($level == 5) {
                return 160;
            } else if ($level == 6) {
                return 320;
            } else if ($level == 7) {
                return 640;
            }else if ($level == 8) {
                return 1280;
            }
        }
        
        public function checkActive($username) {
            $get = "SELECT * FROM customers WHERE username='$username'";
            $rows = mysqli_query($this->conn, $get);
            
            if(mysqli_num_rows($rows) > 0) {
                while($row = mysqli_fetch_assoc($rows)) {
                    $active = $row['activated'];
                    if($active == 1) 
                        return true;
                    else 
                        return false;
                }
            } else {
                return false;
            }
        }
        
        public function upgrade($username) {
            $level = $this->getLevel($username);
            $juquery = mysqli_query($this->conn, "SELECT * FROM customers WHERE referral_id='$username' AND level='$level'");
            if(mysqli_num_rows($juquery) === 2) {
                if($this->getBalance($username) >= $this->getNextPrice($username)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        public function closeMatrix($user) {
            $level = $this->getLevel($user);
            
            if(($level == 8) && $this->upgrade($user)) {
                return true;
            } else {
                return false;
            }
        }
        
        public function getParent($username) {
            $get = "SELECT * FROM level_one WHERE username='$username'";
            
            $rows = mysqli_query($this->conn, $get);
            if(mysqli_num_rows($rows) > 0) {
                while($row = mysqli_fetch_assoc($rows)) {
                    return $row['parent'];
                }
            } else {
                return false;
            }
        }
        
        public function increaseBalance($username, $amount, $balance) {
            return $newBalance = $amount + $balance;
        }
        
        public function reduceBalance($username, $amount, $balance) {
            return $newBalance = $balance - $amount;
        }
        
        public function totalIncome($username) {
            $juquery = mysqli_query($this->conn, "SELECT * FROM customers WHERE username='$username'");
            if(mysqli_num_rows($juquery) > 0) {
                while($row = mysqli_fetch_assoc($juquery)) {
                    return $row['income'];
                }
            } else {
                return 0;
            }
        }
        
        public function rightIncome($level) {
            if($level == 1) {
                return 20;
            } else if ($level == 2) {
                return 80;
            } else if ($level == 3) {
                return 320;
            }  else if ($level == 4) {
                return 1280;
            }  else if ($level == 5) {
                return 5120;
            }  else if ($level == 6) {
                return 20480;
            }   else if ($level == 7) {
                return 81920;
            }  else if ($level == 8) {
                return 327680;
            }
        }
        
        public function changeIncome($level, $username) {
            $income = $this->rightIncome($level);
            
            if(mysqli_query($this->conn, "UPDATE customers SET income='$income' WHERE username='$username'")) {
                return true;
            } else {
                return false;
            }
        }
        
        public function changeBalance($username, $type, $amount) {
            $newBalance = $this->$type($username, $amount, $this->getBalance($username));
            
            $update = mysqli_query($this->conn, "UPDATE customers SET balance='$newBalance' WHERE username='$username'");
            if($update) {
                return true;
            } else {
                return false;
            }
        }
        
        public function updateWallet($wallet, $user) {
            if(empty($wallet)) {
                return false;
            }
            $update = mysqli_query($this->conn, "UPDATE customers SET wallet_address='$wallet' WHERE username='$user'");
            if($update) {
                return true;
            } else {
                return false;
            }
        }
        
        public function updateDP($dp, $user) {
            if(empty($dp)) {
                return false;
            }
            $update = mysqli_query($this->conn, "UPDATE customers SET display_picture='$dp' WHERE username='$user'");
            if($update) {
                return true;
            } else {
                return false;
            }
        }
    
        // public function 
    }

?>