<?php
    require('./config.php');
    require('./class/DatabaseConnection.php');
    require('./class/Activity.php');
    require('./class/Mail.php');
    require('./class/User.php');
    require('./class/Payouts.php');
    require('./class/Referral.php');
    
    $act = new Activity;
    $userC = new User;
    $ref = new Referral;
    $pay = new Payouts;
    
    session_start();
    
    if(isset($_POST['verify_hash'])) {
        $post = $_POST; 
        $verifyHash = $post['verify_hash'];
        unset($post['verify_hash']);
        ksort($post);
        if (isset($post['expire_utc'])){
            $post['expire_utc'] = (string)$post['expire_utc'];
        }
        if (isset($post['tx_urls'])){
            $post['tx_urls'] = html_entity_decode($post['tx_urls']);
        }
        $postString = serialize($post);
        $checkKey = hash_hmac('sha1', $postString, 'MJ-K-5qagP4Vp07rf_ljiH-zLa_2HwyTRkl-fDtuI2thfqN6fb4oOjnv499gOW4C');
        if ($checkKey != $verifyHash) {
            return false;
        }
        return true;
    } else {
        if(isset($_SESSION['user'])) {
            $username = $_SESSION['user'];
            $user = mysqli_query($conn, "SELECT * FROM customers WHERE username='$username'");
            if(mysqli_num_rows($user) > 0) {
                if(mysqli_query($conn, "UPDATE customers SET activated=1 WHERE username='$username'")) {
                    if($userC->getParent($username)) {
                        $pay->directIncome($userC->getParent($username));
                        $userC->changeBalance($userC->getParent($username), 'increaseBalance', 10);
                        $act->recordActivity($userC->getParent($username), 'Earned &#36; 10');
                    }
                    $userC->changeIncome(1, $username);
                    $userC->toNextLevel($username);
                    $act->recordActivity($username, 'Activated account');
                    header("Location: /");
                    exit();
                }
            }
        }
    }
    
  
?>