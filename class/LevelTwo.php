<?php

class LevelTwo
    {
        public function __construct() {
            $db = new DatabaseConnection;
            $this->conn = $db->conn;
            
            $act = new Activity;
            $this->act = $act;
            
            $user = new User;
            $this->user = $user;
        }
        
        public function islevelTwoDown($parent) {
            $check = "select * from level_one where parent='$parent'";
            if(mysqli_num_rows($check) == 0) {
                return false;
            } else {
                return true;
            }
        }
        
        public function levelTwoDown($parent) {
            $check = mysqli_query($this->conn, "select * from level_one where parent='$parent'");
            $response = [];
            if(mysqli_num_rows($check) > 0) {
                while($row = mysqli_fetch_assoc($check)) {
                    $response[] = $row;
                }
            }
            return $response;
        }
        
        public function hasParent($user) {
            $check = mysqli_query($this->conn, "select * from customers where username='$user'");
            if(mysqli_num_rows($check) > 0) {
                while($row = mysqli_fetch_assoc($check)) {
                    if(!empty($row['referral_id'])) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
        
        public function upgradeLevel($current, $new, $user) {
            $check = mysqli_query($this->conn, "select * from customers where username='$user'");
            if(mysqli_num_rows($check) === 0){
                return false;
            } else {
                while($row = mysqli_fetch_assoc($check)) {
                    $now = $row['level'];
                    $done = $row['level_completed'];
                    $amount = $this->user->getNextPrice($user);
                    $balance = $this->user->getBalance($user);
                    if($amount > $balance) {
                        return false;
                    }
                    if($now == $current) {
                        $upgrade = mysqli_query($this->conn, "UPDATE customers SET level='$new', level_completed='$current' WHERE username='$user'");
                        if($this->hasParent($user)) {
                            $parent = $row['referral_id'];
                            if($new = 2) {
                                $upEarning = 40;
                            } else if($new = 3) {
                                $upEarning = 160;
                            } else if($new = 4) {
                                $upEarning = 640;
                            } else if($new = 5) {
                                $upEarning = 2560;
                            } else if($new = 6) {
                                $upEarning = 10240;
                            } else if($new = 7) {
                                $upEarning = 40960;
                            }else if($new = 8) {
                                $upEarning = 163840;
                            }
                            $this->user->changeBalance($parent, 'increaseBalance', $upEarning);
                            $this->act->recordActivity($parent, 'Earned &#36;' . $upEarning);
                        }
                        if($upgrade) {
                            $this->act->recordActivity($user, 'Upgraded');
                            $this->user->changeBalance($user, 'reduceBalance', $amount);
                            $this->user->changeIncome($new, $user);
                            return true;
                        } else {
                            return 'update failed';
                        }
                    } else {
                        return false;
                    }
                }
            }
        }
    }
?>