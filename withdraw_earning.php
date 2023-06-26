<?php include_once('./header.php'); ?>

<title> Withdraw Earnings | Coinagebolt </title>

    
    
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
                                    <h4 class="mb-0">Withdraw Earnings</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Withdraw Earnings</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <?php
                                if (isset($_GET['no_address'])) {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                Sorry! &nbsp; You do not have a wallet address!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                                if (isset($_GET['wf'])) {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                Sorry! &nbsp; Transaction error
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                                if (isset($_GET['ws'])) {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                Hurray! &nbsp; Transaction successful
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="row mb-3">
                            <div class="col-xl-4">
                                <div class="mt-5 mt-lg-3">
                                    <div class="card border shadow-none">
                                        <div class="card-header bg-transparent border-bottom py-3 px-4">
                                            <h5 class="font-size-16 mb-0">Transaction ID <span class="float-end">#<?php echo rand(); ?></span></h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td>Amount Withdrawable:</td>
                                                            <td class="text-end">$<?php echo $user->getBalance($userOnline); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <form action="/withdraw" method="POST">
                                                <input type="hidden" value="<?php echo $user->getBalance($userOnline); ?>" name="amount" />
                                                <button 
                                                    class="btn btn-success mt-3 float-end" 
                                                    id="activate"
                                                    type="submit"
                                                    name="withdraw"
                                                    <?php
                                                        if(!$pay->canWithdraw($userOnline)) {
                                                            ?>
                                                                disabled
                                                            <?php
                                                        }
                                                    ?>
                                                >
                                                    Withdraw Earnings
                                                </button>
                                            </form>
                                            <!-- end table-responsive -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

        <?php include('./footer.php'); ?>

