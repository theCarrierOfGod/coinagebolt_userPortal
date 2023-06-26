<?php
    session_start();
    require('./class/DatabaseConnection.php');
    require('./class/Login.php');
    require('./class/Activity.php');
    require('./class/Mail.php');
    
    if (isset($_POST['login'])) {
        header('Content-Type: application/json');
        
        $log = new Login();
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if(empty($username) || empty($password)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'all fields are required'
            ]);
            exit();
        }
        
        if($log->uniqueUsername($username)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'username unknown'
            ]);
            exit();
            return false;
        }
        
        if(!$log->isActivated($username)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'confirm email address'
            ]);
            exit();
            return false;
        }
        
        if($log->logIn($username, $password)) {
            $_SESSION['user'] = $username;
            echo json_encode([
                'status'  => 'success',
                'message' => 'login success'
            ]);
            exit();
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'incorrect password'
            ]);
            exit();
        }
        
    } else {
        ?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Login | Coinagebolt</title>
                    <meta name="theme-color" content="#1d69fb" />
                    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#1d69fb" />
                    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="black" />

                    <!-- Latest compiled and minified CSS -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


                    <!-- jQuery library -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

                    <!-- Latest compiled JavaScript -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

                    <!-- Latest bootbox cdn -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.js"></script>

                    <link href="http://user.coinagebolt.com/register.css" rel="stylesheet" />
                    <link href="/img/icon_a.png" rel="icon" />
                    <style>
                        .close {
                            border: 2px solid white;
                            padding: 0;
                            margin: 0;
                            width: 30px;
                            height: 30px;
                            background: orangered;
                            color: white;
                            font-weight: bolder;
                            border-radius: 7px;
                        }
                    </style>
                </head>
                <body style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
                    <section style="position: relative;">
                        <div class="container-fluid">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-md-9 col-lg-6 col-xl-5">
                                    <img src="/img/logo_b.png" class="img-fluid w-100 p-5" alt="Coinagebolt">
                                    <h3 class="card-header text-center" style="font-family: monospace; background: transparent; border: none;">
                                        WELCOME BACK
                                    </h3>
                                </div>
                                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                                    <?php
                                        if(isset($_GET['err'])) {
                                            ?>
                                                <div class="alert alert-danger text-center mb-4" role="alert">
                                                    <?php echo $_GET['err']; ?>
                                                </div>
                                            <?php
                                        }
                                        if(isset($_GET['go'])) {
                                            ?>
                                                <div class="alert alert-success text-center mb-4" role="alert">
                                                    <?php echo $_GET['go']; ?>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                    <form id="registerForm">

                                        <!-- Username input -->
                                        <div class="form-outline mb-4 mt-4">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" id="username" class="form-control form-control" required />
                                            <small id="usernameError"></small>
                                        </div>

                                        <!-- Password input -->
                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" class="form-control form-control" /required>
                                            <small id="passwordError"></small>
                                        </div>

                                        <div class="text-center text-lg-start mt-4 pt-2">
                                            <button type="submit" class="btn btn-primary btn-lg" id="loginButton" style="padding-left: 2.5rem; padding-right: 2.5rem;">Log in</button>
                                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="/register" class="link-danger">Register</a></p>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="d-none flex-column flex-md-row text-center text-md-start justify-content-between bg-primary footer">
                        <!-- Copyright -->
                        <div class="text-white mb-3 mb-md-0">
                            Copyright © <?php echo date('Y'); ?>. All rights reserved.
                        </div>
                        <!-- Copyright -->

                        <!-- Right -->
                        <div>
                            <a href="#!" class="text-white me-4">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#!" class="text-white me-4">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#!" class="text-white me-4">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#!" class="text-white">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                        <!-- Right -->
                    </div>
                    <script>
                        $(document).ready(function() {
                            $("#registerForm").submit(function(e) {
                                $("#usernameError").html('')
                                $("#passwordError").html('')
                                
                                e.preventDefault();
                                
                                let go = 1;
                                let username = $("#username").val();
                                let password = $("#password").val();
                                
                                let formData = {
                                    username: username,
                                    password: password,
                                    login: 'login'
                                }
                                
                                if(go == 1) {
                                    console.log(formData);
                                    $.ajax({
                                        url: '/login',
                                        data: formData,
                                        type: 'post',
                                        beforeSend: function() {
                                            $("#loginButton").html('loging in...')
                                        }, 
                                        success: function (data) {
                                            if(data.status == 'error') {
                                                bootbox.alert(data.message)
                                            } else {
                                                bootbox.alert(data.message);
                                                window.location.href = '/';
                                            }
                                            $("#loginButton").html('Log in');
                                        }
                                    })
                                } else {
                                    bootbox.alert('an error occured');
                                }
                            })
                        })
                    </script>
                </body>
            </html>
        <?php
    }
?>