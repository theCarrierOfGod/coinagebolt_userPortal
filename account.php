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
    
    if(isset($_POST['saveWallet'])) {
        $wallet = $_POST['wallet_address'];
        if($user->updateWallet($wallet, $userOnline)) {
            header("Location: /my_account?ws");
            exit();
        } else {
            header("Location: /my_account?wf");
            exit();
        }
    }
    
    if(isset($_POST['saveDP'])) {
        $target_dir = "uploads/";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["display_image"]["name"],PATHINFO_EXTENSION));
        $target_file = $target_dir . $userOnline . '_' . rand(). '.' . $imageFileType;
        
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["display_image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
                header("Location: /my_account?df=File is not an image");
                exit();
            }
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
            header("Location: /my_account?df=file already exists");
            exit();
        }
        
        // Check file size
        if ($_FILES["display_image"]["size"] > 500000) {
            $uploadOk = 0;
            header("Location: /my_account?df=your file is too large");
            exit();
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp" ) {
            $uploadOk = 0;
            header("Location: /my_account?df=only JPG, JPEG, PNG, WEBP and GIF files are allowed.");
            exit();
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            header("Location: /my_account?df=File was not uploaded");
            exit();
        } else {
            if (move_uploaded_file($_FILES["display_image"]["tmp_name"], $target_file)) {
                if($user->updateDP($target_file, $userOnline)) {
                    header("Location: /my_account?ds");
                    exit(); 
                } else {
                    header("Location: /my_account?df=there was an error uploading your file.");
                    exit();
                }
            } else {
                header("Location: /my_account?df=there was an error uploading your file.");
                exit();
            }
        }
    }