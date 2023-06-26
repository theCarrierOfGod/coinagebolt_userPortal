<?php
    session_start();
    require('./class/DatabaseConnection.php');
    require('./class/Activity.php');
    
    $act = new Activity;

    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $act->recordActivity($user, 'Logged out');
        
    }
    
    session_unset();
    session_destroy();
    header("Location: /login");
    exit();
?>

