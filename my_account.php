<?php include_once('./header.php'); ?>

<title> My Account | Coinagebolt </title>

    
    
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">My Account</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                            <li class="breadcrumb-item active">My Account</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row mb-3">
                            <?php
                                if (isset($_GET['wf'])) {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                Sorry! &nbsp; Wallet address not updated
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                                if (isset($_GET['ws'])) {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                Hurray! &nbsp; Wallet address updated
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                                
                                if (isset($_GET['df'])) {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                Sorry! &nbsp; <?php echo $_GET['df']; ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                                if (isset($_GET['ds'])) {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                Hurray! &nbsp; Display Picture updated
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="row mb-3">
                            <div class="col-xl-4 mt-3">
                                <div class="card" style="height: 100%; margin-bottom: 20px">
                                    <div class="card-body">
                                        <h4 class="card-title">DETAILS</h4>

                                        <div class="text-center">
                                            <p class="font-16 text-muted mb-2"></p>
                                            <h5>
                                                <span class="text-dark" style="font-family: monospace;">
                                                    <?php echo strtoupper($myDetails[0]['username']); ?>
                                                </span>
                                            </h5>
                                            <p class="text-muted">
                                                <?php echo strtoupper($myDetails[0]['email']); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 mt-3">
                                <div class="card" style="height: 100%; margin-bottom: 20px">
                                    <div class="card-body">
                                        <h4 class="card-title">WALLET ADDRESS</h4>

                                        <div class="text-center">
                                            <p class="font-16 text-muted mb-2"></p>
                                            <h5>
                                                <span class="text-dark" style="font-family: monospace;">
                                                    <?php echo strtoupper($myDetails[0]['wallet_address']); ?>
                                                </span>
                                            </h5>
                                            <form class="m-4" action="/account" method="post">
                                                <div class="form-group mt-2 mb-2">
                                                    <input class="form-control" type="text" name="wallet_address" placeholder="Wallet Address" id="wallet_address" required />
                                                </div>
                                                <div class="form-group mt-2 mb-2">
                                                    <input class="btn btn-primary" type="submit" value="Update Wallet Address" name="saveWallet" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                        <div class="row mb-3">
                            <div class="col-xl-4 mt-3">
                                <div class="card" style="height: 100%; margin-bottom: 20px">
                                    <div class="card-body">
                                        <h4 class="card-title">DISPLAY PICTURE</h4>

                                        <div class="text-center">
                                            <p class="font-16 text-muted mb-2"></p>
                                            <h5>
                                                <img src="<?php echo $user->getDP($userOnline); ?>" alt="<?php echo $userOnline; ?>" style="width: 75%" />
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 mt-3">
                                <div class="card" style="height: 100%; margin-bottom: 20px">
                                    <div class="card-body">
                                        <h4 class="card-title">CHANGE DISPLAY PICTURE</h4>

                                        <div class="text-center">
                                            <p class="font-16 text-muted mb-2"></p>
                                            <form class="m-4" action="/account" method="post" enctype="multipart/form-data">
                                                <div class="form-group mt-2 mb-2">
                                                    <input class="form-control" type="file" accept="image/*" name="display_image" placeholder="display image" id="display_image" required />
                                                </div>
                                                <div class="form-group mt-2 mb-2">
                                                    <input class="btn btn-primary" type="submit" value="Change Display Picture" name="saveDP" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

        <?php include('./footer.php'); ?>

