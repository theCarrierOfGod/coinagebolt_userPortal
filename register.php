<?php
    session_start();
    require('./class/DatabaseConnection.php');
    require('./class/Register.php');
    require('./class/Activity.php');
    require('./class/LevelOne.php');
    require('./class/LevelTwo.php');
    require('./class/Mail.php');
    require('./class/User.php');
    
    if (isset($_POST['register'])) {
        header('Content-Type: application/json');
        
        $reg = new Register();
        $levelOne = new LevelOne();
        $levelTwo = new LevelTwo();
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $referralID = $_POST['referralID'];
        
        if(empty($email) || empty($username) || empty($password) || empty($repassword)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'all fields are required'
            ]);
            exit();
        }
        
        if(!$reg->uniqueEmail($email)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'email already exists'
            ]);
            exit();
        }
        
        if(!$reg->uniqueUsername($username)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'username already exists'
            ]);
            exit();
            return false;
        }
        
        if(!empty($referralID)) {
            if($reg->uniqueUsername($referralID)) {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'unknown referree'
                ]);
                exit();
            }
            if(!$reg->eligbleRef($referralID)) {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'referee already reached maximum referrals'
                ]);
                exit();
            }
            if(!$levelOne->worthy($referralID)) {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'referee cannot make referrals at this time'
                ]);
                exit();
            } else {
                $levelOne->newOne($username, $referralID);
            }
        }
        
        if($reg->storeNew($email, $username, $password, $referralID)) {
            echo json_encode([
                'status'  => 'success',
                'message' => 'registration successful'
            ]);
            exit();
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'internal error occured'
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
                    <title>Register | Coinagebolt</title>
                    <meta name="theme-color" content="#1d69fb" />
                    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#1d69fb" />
                    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="black" />
                	<link href="/img/icon_a.png" rel="icon" sizes="32x32" />
                	<link href="/img/icon_a.png" rel="icon" sizes="192x192" />
                	<link href="/img/icon_a.png" rel="apple-touch-icon" /><meta name="msapplication-TileImage" content="https://coinagebolt.com/img/icon_a.png" />

                    <!-- Latest compiled and minified CSS -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


                    <!-- jQuery library -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

                    <!-- Latest compiled JavaScript -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

                    <!-- Latest bootbox cdn -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.js"></script>

                    <link href="http://user.coinagebolt.com/register.css" rel="stylesheet" />
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
                <body>
                    <section  style="position: relative; min-height: 88vh;">
                        <div class="container-fluid h-custom">
                            <div style="min-height: 50px"></div>
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-md-9 col-lg-6 col-xl-5">
                                    <img src="/img/logo_b.png" class="img-fluid w-100 p-5" alt="Coinagebolt">
                                    <h3 class="card-header text-center" style="font-family: monospace; background: transparent; border: none;">
                                        Register Now!!!
                                    </h3>
                                </div>
                                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                                    <form id="registerForm">
                                        <!-- Email input -->
                                        <div class="form-outline mb-4 mt-4">
                                            <label class="form-label" for="email">Email address</label>
                                            <input type="email" id="email" class="form-control form-control" required/>
                                            <small id="emailError"></small>
                                        </div>

                                        <!-- Username input -->
                                        <div class="form-outline mb-4 mt-4">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" id="username" class="form-control form-control" onkeyup={$('#usernameError').html('')} required />
                                            <small id="usernameError"></small>
                                        </div>

                                        <!-- Password input -->
                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" class="form-control form-control" /required>
                                            <small id="passwordError"></small>
                                        </div>

                                        <!-- Repassword input -->
                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="repassword">Re-enter password</label>
                                            <input type="password" id="repassword" class="form-control form-control" required/>
                                            <small id="repasswordError"></small>
                                        </div>
                                        
                                        <!-- Refarral ID input -->
                                        <?php
                                            if(isset($_GET['ref'])) {
                                                $ref = $_GET['ref'];
                                                $readOnly = 'readonly="true"';
                                            } else {
                                                $ref = '';
                                                $readOnly = '';
                                            }
                                        ?>
                                        <div class="form-outline mb-4 mt-4">
                                            <label class="form-label" for="referralID">Referral ID</label>
                                            <input type="text" id="referralID" value='<?php echo $ref; ?>' class="form-control form-control" <?php echo $readOnly; ?> />
                                            <small id="referralIDError"></small>
                                        </div>

                                        <div class="text-center text-lg-start mt-4 pt-2">
                                            <button type="submit" class="btn btn-primary btn-lg" id="regButton" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                                            <p class="small fw-bold mt-2 pt-1 mb-0">Have an account? <a href="/login" class="link-danger">Log in</a></p>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div style="min-height: 100px"></div>
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
                                $("#repasswordError").html('')
                                $("#emailError").html('')
                                $("#referralIDError").html('');
                                
                                e.preventDefault();
                                
                                let go = 1;
                                let username = $("#username").val();
                                let email = $("#email").val();
                                let password = $("#password").val();
                                let repassword = $("#repassword").val();
                                let referralID = $("#referralID").val();
                                
                                if(username.length < 4) {
                                    $("#usernameError").html(`
                                        <div class='alert alert-danger p-2 mt-2'>
                                            minimum username length is 4
                                        </div>
                                    `);
                                    go = 0;
                                }
                                if(password.length < 8) {
                                    $("#passwordError").html(`
                                        <div class='alert alert-danger p-2 mt-2'>
                                            minimum password length is 8
                                        </div>
                                    `);
                                    go = 0;
                                }
                                if(password != repassword) {
                                    $("#repasswordError").html(`
                                        <div class='alert alert-danger p-2 mt-2'>
                                            password mismatch
                                        </div>
                                    `);
                                    go = 0;
                                }
                                
                                let formData = {
                                    email: email,
                                    username: username,
                                    password: password,
                                    repassword: repassword,
                                    referralID: referralID,
                                    register: 'register'
                                }
                                
                                if(go == 1) {
                                    console.log(formData);
                                    $.ajax({
                                        url: '/register',
                                        data: formData,
                                        type: 'post',
                                        beforeSend: function() {
                                            $("#regButton").html('Registering...');
                                        }, 
                                        success: function (data) {
                                            if(data.status == 'error') {
                                                bootbox.alert(data.message)
                                            } else {
                                                bootbox.alert(data.message);
                                                window.location.href = '/verify_account?username=' + username;
                                            }
                                            $("#regButton").html('Register');
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