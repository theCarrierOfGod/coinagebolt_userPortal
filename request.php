<?php
    require('./class/DatabaseConnection.php');
    require('./class/Login.php');
    require('./class/Activity.php');
    require('./class/Mail.php');
    
    $act = new Activity;
    $log = new Login;
    
    if(isset($_POST['Username'])) {
        $username = $_POST['Username'];
        
        if($log->uniqueUsername($username)) {
            header("Location: /request_verification?err=Account doesn't exist");
            exit();
        }
        
        if($log->isActivated($username)) {
            header("Location: /request_verification?err=Account already verified");
            exit();
        }
        
        if($log->sendVerificationMail($username)) {
            $act->recordActivity($username, 'Requested verification');
            header("Location: /verify_account");
            exit();
        } else {
            header("Location: /request_verification?err=Verification mail not sent");
            exit();
        }
    } else {
        header("Location: /request_verification");
        exit();
    }

print_r($_GET);