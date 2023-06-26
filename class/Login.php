<?php

class Login
    {
        // Properties
        public $username;
        public $email;
        public $password;
        
        public function __construct() {
            $db = new DatabaseConnection;
            $this->conn = $db->conn;
            
            $mail = new Mail;
            $this->mail = $mail;
        }
        
        function uniqueUsername($username) {
            $query = mysqli_query($this->conn, "SELECT * FROM customers WHERE username='$username'");
            if(mysqli_num_rows($query) == 0) {
                return true;
            } else {
                return false;
            }
        }
        
        public function isActivated($username) {
            $query = mysqli_query($this->conn, "SELECT * FROM customers WHERE username='$username'");
            if(mysqli_num_rows($query) > 0) {
                while($row = mysqli_fetch_assoc($query)) {
                    if($row['verified'] == 1){
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
        
        private function verifyPassword($password, $hashed) {
            return password_verify($password, $hashed);
        }
        
        private function generateToken($username) {
            return md5($username.time().rand());
        }
        
        function logIn($username, $password) {
            if($this->uniqueUsername($username)){
                return false;
            }
            
            if(empty($password)) {
                return false;
            }
            
            $query = mysqli_query($this->conn, "SELECT * FROM customers WHERE username='$username'");
            $row = mysqli_fetch_assoc($query);
            $hashed = $row['password'];
                        
            if($this->verifyPassword($password, $hashed)) {
                $act = new Activity;
                if($act->recordActivity($username, 'Logged in')) {
                    return true;
                } else {
                    return true;   
                }
            } else {
                return false;
            }
            
        }
        
        public function verifyMail($username, $token) {
            $check = "SELECT * FROM customers WHERE username='$username'";
            $go = mysqli_query($this->conn, $check);
            if(mysqli_num_rows($go) > 0){
                while($row = mysqli_fetch_assoc($go)) {
                    $senttoken = $row['refcode'];
                    
                    if($token == $senttoken) {
                        mysqli_query($this->conn, "UPDATE customers SET verified=1, code_sent=0, refcode=NULL WHERE username='$username'");
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        }
        
        public function sendVerificationMail($username) {
            $code = rand(1000000, 9999999);
            $token = $this->generateToken($username);
            
            $check = "SELECT * FROM customers WHERE username='$username'";
            $go = mysqli_query($this->conn, $check);
            if(mysqli_num_rows($go) > 0){
                while($row = mysqli_fetch_assoc($go)) {
                    $email = $row['email'];
                    
                    if($this->mail->registrationMail('Registration', $email, $code, $username)) {
                        $sent = 1;
                    } else {
                        $sent = 0;
                    }
                    
                    
                    $query = mysqli_query($this->conn, "UPDATE customers SET verified=0, code_sent='$sent', refcode='$code', activation_token='$token' WHERE username='$username' ");
                    if($query) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
    }

?>