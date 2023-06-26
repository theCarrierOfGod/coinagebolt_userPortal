<?php

class Register
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
            
            $act = new Activity;
            $this->act = $act;
        }
         
        function uniqueEmail($email) {
            $query = mysqli_query($this->conn, "SELECT * FROM customers WHERE email='$email'");
            if(mysqli_num_rows($query) == 0) {
                return true;
            } else {
                return false;
            }
        }
        
        function uniqueUsername($username) {
            $query = mysqli_query($this->conn, "SELECT * FROM customers WHERE username='$username'");
            if(mysqli_num_rows($query) == 0) {
                return true;
            } else {
                return false;
            }
        }
        
        function eligbleRef($username) {
            $query = mysqli_query($this->conn, "SELECT * FROM level_one WHERE parent='$username'");
            if(mysqli_num_rows($query) >= 2) {
                return false;
            } else {
                return true;
            }
        }
        
        function validate($email, $username, $password, $repassword, $referralID) {
            
        }
        
        private function encryptPassword($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        }
        
        private function generateToken($username) {
            return md5($username.time().rand());
        }
        
        function storeNew($email, $username, $password, $referralID) {
            if(!$this->uniqueEmail($email)){
                return false;
            }
            
            if(!$this->uniqueUsername($username)){
                return false;
            }
            
            if(empty($password)) {
                return false;
            }
            
            $code = rand(1000000, 9999999);
            
            $hashedPassword = $this->encryptPassword($password);
            $token = $this->generateToken($code);
            
            if($this->mail->registrationMail('Registration', $email, $code, $username)) {
                $sent = 1;
            } else {
                $sent = 0;
            }
            
            $insert = "INSERT INTO customers( `username`, `email`, `password`, `code_sent`, `activation_token`, `refcode`, `referral_id`, `level`) 
                        VALUES('$username', '$email', '$hashedPassword', '$sent', '$token', '$code', '$referralID', 0) ";
                        
            if(mysqli_query($this->conn, $insert)) {
                if($this->act->recordActivity($username, 'Joined')) {
                    return true;
                } else {
                    return true;   
                }
            } else {
                return false;
            }
            
        }
    }

?>