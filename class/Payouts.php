<?php

class Payouts
    {
        public function __construct() {
            $db = new DatabaseConnection;
            $this->conn = $db->conn;
            
            $act = new Activity;
            $this->act = $act;
            
            $user = new User;
            $this->user = $user;
        }
        
        public function totalIncome($username) {
            $getIn = mysqli_query($this->conn, "SELECT * FROM income WHERE username='$username'");
            if(mysqli_num_rows($getIn) > 0) {
                $income = 0;
                while($row = mysqli_fetch_assoc($getIn)) {
                    $amount = $row['amount'];
                    $income = $income + $amount;
                }
            } else {
                $income = 0;
            }
            return $income;
        }
        
        public function totalPayouts($username) {
            $getPays = mysqli_query($this->conn, "SELECT * FROM payouts WHERE username='$username'");
            if(mysqli_num_rows($getPays) > 0) {
                $payouts = 0;
                while($row = mysqli_fetch_assoc($getPays)) {
                    $amount = $row['amount'];
                    $payouts = $payouts + $amount;
                }
            } else {
                $payouts = 0;
            }
            return $payouts;
        }
        
        public function directIncome($username) {
            $add = mysqli_query($this->conn, "INSERT INTO income(`username`, `amount`) VALUES('$username', 10)");
            if($add) {
                return true;
            } else {
                return false;
            }
        }
        
        public function payOuts($username) {
            $get = "SELECT * FROM payouts WHERE username='$username'";
            $rows = mysqli_query($this->conn, $get);
            
            $response = array();
            
            while($row = mysqli_fetch_assoc($rows)) {
                $response[] = $row;
            }
            
            return $response;
        }
        
        public function canWithdraw($username){
            $level = $this->user->getLevel($username);
            if(($this->user->rightIncome($level) == $this->user->totalIncome($username)) && ($this->user->getBalance($username) != 0)) {
                return true;
            } else {
                return false;
            }
            
        }
        
        public function newPayout($username, $amount, $status) {
            if(mysqli_query($this->conn, "INSERT INTO payouts(`username`, `amount`, `status`) VALUES('$username', '$amount', '$status')")) {
                return true;
            } else {
                return false;
            }
        }

    }
?>