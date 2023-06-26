<?php 
include_once('./header.php'); 
?>

<?php
    if(!$levelOne->checkUpgrade($userOnline)) {
        echo "<script>window.location.href = '/?not_eligible'; </script>";
    }
    if($user->getNextLevel($userOnline) > 8) {
        echo "<script>window.location.href = '/?completed'; </script>";
    }
    $msg = '';
    if(isset($_POST['level'])) {
        $level = $_POST['level'];
        if($levelTwo->upgradeLevel($user->getLevel($userOnline), $level, $userOnline)) {
            echo "<script>window.location.replace('/?upgraded');</script>";
        } else {
            $msg .= "Account not upgraded!";
        }
    }
?>
<title> Upgrade Account | Coinagebolt </title>

    
    
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
                                    <h4 class="mb-0">Upgrade Account</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Upgrade Account</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row mb-3">
                            <?php 
                                if($msg !== '') {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-primary alert-dismissible" role="alert">
                                                <?php echo $msg; ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                            <div class="col-xl-8">
                                <div class="card border shadow-none">
                                    <div class="card-body">

                                        <div class="d-flex align-items-start border-bottom pb-3">
                                            <!--<div class="flex-shrink-0 me-4">-->
                                            <!--    <img src="/images/level-2-icon.png" alt="Level Two" class="avatar-lg">-->
                                            <!--</div>-->
                                            <div class="flex-grow-1 align-self-center overflow-hidden">
                                                <div>
                                                    <h5 class="text-truncate font-size-16 text-dark">
                                                        <b>To Level <?php echo $user->getNextLevel($userOnline); ?></b>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="row">
                                                <div class="col-md-4 col-4">
                                                    <div class="mt-3">
                                                        <p class="text-dark mb-2">Price</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-4">
                                                    <div class="mt-3">
                                                        <p class="mb-2">USD</p>
                                                        <p class="mb-2 text-dark"><?php echo $user->getNextPrice($userOnline); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-4">
                                                    <div class="mt-3">
                                                        <p class="mb-2">USDT</p>
                                                        <p class="mb-2 text-dark"><?php echo $user->getNextPrice($userOnline); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end card -->
                            </div>

                            <div class="col-xl-4">
                                <div class="mt-5 mt-lg-3">
                                    <div class="card border shadow-none">
                                        <div class="card-header bg-transparent border-bottom py-3 px-4">
                                            <h5 class="font-size-16 mb-0">Order Summary <span class="float-end">#<?php echo rand(); ?></span></h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <form method="post">
                                                <input type="hidden" name="level" value='<?php echo $user->getNextLevel($userOnline); ?>' />
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <td>Sub Total :</td>
                                                                <td class="text-end">$<?php echo $user->getNextPrice($userOnline); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discount : </td>
                                                                <td class="text-end">- $ 0</td>
                                                            </tr>
                                                            <tr class="bg-light">
                                                                <th>Total :</th>
                                                                <td class="text-end">
                                                                    <span class="fw-bold">
                                                                        $<?php echo $user->getNextPrice($userOnline); ?>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- end table-responsive -->
                                                <button type="submit" class="btn btn-success mt-3 float-end" id="activate">
                                                    Upgrade account
                                                </button>
                                            </form>
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

