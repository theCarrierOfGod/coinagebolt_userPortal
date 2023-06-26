<?php
    require('./class/DatabaseConnection.php');
    require('./class/Login.php');
    require('./class/Register.php');
    require('./class/Activity.php');
    require('./class/LevelOne.php');
    require('./class/LevelTwo.php');
    require('./class/Mail.php');
    require('./class/User.php');
    
    $log = new Login;
    $act = new Activity;
    
    if(isset($_GET['username'])) {
        $username = $_GET['username'];
        $token = $_GET['token'];
        
        if($log->uniqueUsername($username)) {
            header("Location: /verify_account?err=Account doesn't exist");
            exit();
        }
        
        if($log->isActivated($username)) {
            header("Location: /verify_account?err=Account already verified");
            exit();
        }
        
        if($log->verifyMail($username, $token)) {
            $act->recordActivity($username, 'Verified Mail');
            header("Location: /login?go=Account verified");
            exit();
        } else {
            header("Location: /verify_account?err=Account not verified");
            exit();
        }
        
    } else {
        header("Location: /request_verification");
        exit();
    }
