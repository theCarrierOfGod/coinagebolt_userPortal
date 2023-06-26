<?php
    require('./config.php');
    require('./class/DatabaseConnection.php');
    require('./class/Activity.php');
    require('./class/Mail.php');
    require('./class/User.php');
    require('./class/Payouts.php');
    require('./class/Referral.php');
    
    session_start(); 
    
    $act = new Activity;
    $user = new User;
    $ref = new Referral;
    $pay = new Payouts;
    
    if(isset($_SESSION['user'])) {
        $userOnline = $_SESSION['user'];
    } else {
        header('Location: /login');
        exit();
    }
    
    if(empty($user->getWalletAddress($userOnline))) {
        header('Location: /withdraw_earning?no_address');
        exit();
    }
    
    if(isset($_POST['withdraw'])) {
        $amount = $_POST['amount'];
        $status = 'completed';
        if($amount != $user->getBalance($userOnline)) {
            header("Location: /withdraw_earning?wf");
            exit();
        } else {
            if($user->changeBalance($userOnline, 'reduceBalance', $amount)) {
                $act->recordActivity($userOnline, 'Withdraw $' . $amount);
                $pay->newPayout($userOnline, $amount, $status);
                header("Location: /withdraw_earning?ws");
                exit();
            } else {
                header("Location: /withdraw_earning?wf");
                exit();
            }
        }
    }