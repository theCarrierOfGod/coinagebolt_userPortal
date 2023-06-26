<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Start Email Verification | Coinagebolt</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Cryptocurrency MLM" name="description">
        <meta content="JCWORLD SOFTWARE" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="/img/icon_a.png">

        <!-- Bootstrap Css -->
        <link href="/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg">
        <div class="account-pages my-5  pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div>
                            
                            <a href="/" class="mb-5 d-block auth-logo">
                                <img src="/images/logo-dark.png" alt="" height="22" class="logo logo-dark">
                                <img src="/images/logo-light.png" alt="" height="22" class="logo logo-light">
                            </a>
                            <div class="card">
                               
                                <div class="card-body p-4"> 
    
                                    <div class="text-center mt-2">
                                        <h5 class="text-primary">Request Email verification</h5>
                                        <p class="text-muted">Verify your account's email account</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <div class="alert alert-success text-center mb-4" role="alert">
                                            Verification link will be sent to your mail
                                        </div>
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
                                        <form action="/request" method="post">
            
                                            <div class="mb-3">
                                                <label class="form-label" for="useremail">Username</label>
                                                <input type="text" class="form-control" id="Username" name="Username" required placeholder="Enter Username">
                                            </div>
                                            
                                            <div class="mt-3 text-end">
                                                <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Request</button>
                                            </div>
                
    
                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Don't need it ? <a href="/login" class="fw-medium text-primary"> Signin </a></p>
                                            </div>
                                        </form>
                                    </div>
                
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <p>© <script>document.write(new Date().getFullYear())</script> Coinagebolt</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

        <!-- JAVASCRIPT -->
        <script src="/jquery/jquery.min.js"></script>
        <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/metismenu/metisMenu.min.js"></script>
        <script src="/simplebar/simplebar.min.js"></script>
        <script src="/node-waves/waves.min.js"></script>
        <script src="/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="/jquery.counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="/js/app.js"></script>

    </body>
</html>
