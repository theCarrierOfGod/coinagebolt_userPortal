<?php include_once('./header.php'); ?>
<title> Dashboard | Coinagebolt </title>

    
    
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
                                    <h4 class="mb-0">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-primary alert-dismissible" role="alert">
                                    Welcome back!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div> <!-- end col-->
                            <?php
                                if (isset($_GET['completed'])) {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                Hurray! &nbsp; You have reached the end of your matrix
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                                if (isset($_GET['upgraded'])) {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                Hurray! &nbsp; Account upgraded
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                                if (isset($_GET['activated'])) {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                Hurray! &nbsp; Account activated
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                                if (isset($_GET['not_eligible'])) {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                Sorry! &nbsp; You cannot upgrade your account at the moment
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                            <?php
                                if ($myDetails[0]['activated'] == 0) {
                                    ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                Account not activated
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div> <!-- end col-->
                                    <?php
                                }
                            ?>
                        </div>
                        
                        <div class="row justify-space-between">
                            <div class="col-xl-4 <?php if(!$levelOne->checkUpgrade($userOnline)) { echo 'd-none'; } ?> <?php if($user->getLevel($userOnline) == 8) { echo ' d-none'; } ?>">
                                <div class="card bg-primary">
                                    <div class="card-body" style="height: 100%; margin-bottom: 10px">
                                        <div class="row align-items-center">
                                            <div class="col-sm-8">
                                                <p class="text-white font-size-18">Upgrade level <i class=" uil-angle-double-up "></i></p>
                                                <div class="mt-4">
                                                    <a href="/upgrade_two" class="btn btn-success waves-effect waves-light">Upgrade Account</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <img src="fonts/setup-analytics-amico.svg" class="img-fluid" alt>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end Col -->
                            
                            <div class="col-xl-4 <?php if(!$levelOne->checkUpgrade($userOnline)) { echo 'd-none'; } ?>  <?php if($user->getLevel($userOnline) == 8) { echo ' d-none'; } ?>">
                                <div class="card bg-primary">
                                    <div class="card-body" style="height: 100%; margin-bottom: 10px">
                                        <div class="row align-items-center">
                                            <div class="col-sm-8">
                                                <p class="text-white font-size-18">Withdraw your earning! <i class="uil-money"></i></p>
                                                <div class="mt-4">
                                                    <a href="/withdraw_earning" class="btn btn-success waves-effect waves-light">Withdraw</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <img src="/img/withdraw.png" class="img-fluid" alt>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end Col -->
                            
                            <div class="col-xl-4 <?php if(!$user->closeMatrix($userOnline)) { echo ' d-none'; } ?>">
                                <div class="card bg-primary">
                                    <div class="card-body" style="height: 100%; margin-bottom: 10px">
                                        <div class="row align-items-center">
                                            <div class="col-sm-8">
                                                <p class="text-white font-size-18">Withdraw your final earning! <i class=" uil-money "></i></p>
                                                <div class="mt-4">
                                                    <a href="/withdraw_earning" class="btn btn-success waves-effect waves-light">Withdraw</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <img src="/img/withdraw.png" class="img-fluid" alt>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end Col -->
                            
                            <div class="col-xl-4 <?php if($myDetails[0]['activated'] == 1) { echo 'd-none'; } ?>">
                                <div class="card bg-primary">
                                    <div class="card-body" style="height: 100%; margin-bottom: 10px">
                                        <div class="row align-items-center">
                                            <div class="col-sm-8">
                                                <p class="text-white font-size-18">Start earning <i class="mdi mdi-arrow-right"></i></p>
                                                <div class="mt-4">
                                                    <a href="/initialize" class="btn btn-success waves-effect waves-light">Activate Account</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4 mt-sm-0">
                                                    <img src="fonts/setup-analytics-amico.svg" class="img-fluid" alt>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end Col -->
                             
                        </div> <!-- end row-->
                        
                        <div class="row">
                            <div class="col-xl-12 <?php if($levelOne->checkUpgrade($userOnline)) { echo 'd-none'; } ?>">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Referral Link</h4>

                                        <div class="mt-1">
                                            <ul class="list-inline main-chart mb-0">
                                                <li class="list-inline-item me-0 w-100" id="tooltip-container">
                                                    <h3>
                                                        <input id="refLink" class="text-muted d-inline-block font-size-15 ms-3 border-0  w-100" readonly style="font-family: monospace;"
                                                            value="https://user.coinagebolt.com/register?ref=<?php echo $userOnline; ?>"
                                                        />
                                                        <span class="float-end bg-info rounded mt-1" onclick="copyText()" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Copy referral link">
                                                            <i class=" uil-copy "></i>
                                                        </span>
                                                        <script>
                                                            function copyText() {
                                                                // Get the text field
                                                                var copyText = document.getElementById("refLink");
                                                                
                                                                // Select the text field
                                                                copyText.select();
                                                                copyText.setSelectionRange(0, 99999); // For mobile devices
                                                                
                                                                // Copy the text inside the text field
                                                                navigator.clipboard.writeText(copyText.value);
                                                                
                                                                // Alert the copied text
                                                                // alert("Copied the text: " + copyText.value);
                                                                Swal.fire({
                                                                    title: "Referral Link Copied",
                                                                    confirmButtonColor: "#5b73e8"
                                                                 })
                                                            } 
                                                        </script>
                                                    </h3>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-3">
                                            <div id="sales-analytics-chart" data-colors="["--bs-primary", "#dfe2e6", "--bs-warning"]" class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-6 col-sm-6 col-md-3 col-xl-2">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart" data-colors="["--bs-success"]"> </div>
                                        </div>
                                        <div>
                                            <div class="avatar-xs mx-auto mb-3">
                                                <span class="avatar-title rounded-circle bg-pink font-size-16">
                                                    <i class="uil-wallet text-white" style="font-size: 25px;"></i>
                                                </span>
                                            </div>
                                            <h4 class="mb-1 mt-1">
                                                <i class="uil-dollar-sign-alt"></i>
                                                <span data-plugin="counterup">
                                                    <?php echo $myDetails[0]['balance']; ?>
                                                </span>
                                            </h4>
                                            <p class="text-muted mb-0">Balance</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                            <div class="col-6 col-sm-6 col-md-3 col-xl-2">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart" data-colors="["--bs-success"]"> </div>
                                        </div>
                                        <div>
                                            <div class="avatar-xs mx-auto mb-3">
                                                <span class="avatar-title rounded-circle bg-info font-size-16">
                                                    <i class="uil-user-plus text-white" style="font-size: 25px;"></i>
                                                </span>
                                            </div>
                                            <h4 class="mb-1 mt-1">
                                                <span data-plugin="counterup">
                                                    <?php echo $myDetails[0]['level']; ?>
                                                </span>
                                            </h4>
                                            <p class="text-muted mb-0">Level</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                            <div class="col-6 col-sm-6 col-md-3 col-xl-2">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart" data-colors="["--bs-success"]"> </div>
                                        </div>
                                        <div>
                                            <div class="avatar-xs mx-auto mb-3">
                                                <span class="avatar-title rounded-circle bg-primary font-size-16">
                                                    <i class="uil-chart-down text-white" style="font-size: 25px;"></i>
                                                </span>
                                            </div>
                                            <h4 class="mb-1 mt-1">
                                                <span data-plugin="counterup">
                                                    <?php
                                                        echo $ref->myRefs($userOnline);
                                                    ?>
                                                </span>
                                            </h4>
                                            <p class="text-muted mb-0">Downline count</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                            <div class="col-6 col-sm-6 col-md-3 col-xl-2">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart" data-colors="["--bs-success"]"> </div>
                                        </div>
                                        <div>
                                            <div class="avatar-xs mx-auto mb-3">
                                                <span class="avatar-title rounded-circle bg-warning font-size-16">
                                                    <i class="uil-top-arrow-to-top text-white" style="font-size: 25px;"></i>
                                                </span>
                                            </div>
                                            <h4 class="mb-1 mt-1">
                                                <i class="uil-dollar-sign-alt"></i>
                                                <span data-plugin="counterup">
                                                    <?php echo $user->totalIncome($userOnline); ?>
                                                </span>
                                            </h4>
                                            <p class="text-muted mb-0">Level Income</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                            <div class="col-6 col-sm-6 col-md-3 col-xl-2">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart" data-colors="["--bs-success"]"> </div>
                                        </div>
                                        <div>
                                            <div class="avatar-xs mx-auto mb-3">
                                                <span class="avatar-title rounded-circle bg-success font-size-16">
                                                    <i class="uil-coins text-white" style="font-size: 25px;"></i>
                                                </span>
                                            </div>
                                            <h4 class="mb-1 mt-1">
                                                <i class="uil-dollar-sign-alt"></i>
                                                <span data-plugin="counterup">
                                                    <?php echo $pay->totalPayouts($userOnline); ?>
                                                </span>
                                            </h4>
                                            <p class="text-muted mb-0">Total Payouts</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                        </div> <!-- end row-->
                        
                        <div class="row justify-content-around mb-5">
                            <div class="col-xl-4 mt-3">
                                <div class="card" style="height: 100%; margin-bottom: 20px">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Downlines</h4>
                                        <div data-simplebar style="max-height: 339px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
                                                        <?php
                                                            if(!empty($recentDown)) {
                                                                foreach($recentDown as $rec) {
                                                                    if($user->getDP($rec['username'])) {
                                                                        $dp = $user->getDP($rec['username']);
                                                                    } else {
                                                                        $dp = "images/user.png";
                                                                    }
                                                                    
                                                                    ?>
                                                                        <tr>
                                                                            <td style="width: 20px;">
                                                                                <img src="<?php echo $dp; ?>" class="avatar-xs rounded-circle " alt="..."> <br/>
                                                                                <?php echo $rec['username']; ?>
                                                                            </td>
                                                                            <td>
                                                                                <h6 class="font-size-15 mb-1 fw-normal" style="font-family: monospace;">
                                                                                    <?php 
                                                                                        
                                                                                        echo "<small style='font-family: monospace;'>LEVEL: ".$user->getLevel($rec['username'])."</small>";
                                                                                    ?> <br />
                                                                                    <?php 
                                                                                        if($user->checkActive($rec['username'])) {
                                                                                            echo '<span class="badge bg-info-subtle text-info font-size-12">Active</span>';
                                                                                        } else {
                                                                                            echo '<span class="badge bg-danger-subtle text-danger font-size-12">Inactive</span>';
                                                                                        }
                                                                                         
                                                                                    ?>
                                                                                </h6>
                                                                            </td>
                                                                            <td class="text-muted fw-semibold text-end">
                                                                                <?php
                                                                                    $date = new DateTime($rec['created_at']);
                                                                                    $stamp = $date->getTimestamp();
                                                                                    
                                                                                    echo date("D M j \, Y", $stamp); 
                                                                                    echo '<p>'.date("h:i:s A ", $stamp).'</p>';
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div> <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->
                                    </div><!-- end card-body-->
                                </div> <!-- end card-->
                            </div><!-- end col -->

                            <div class="col-xl-4 mt-3">
                                <div class="card" style="height: 100%; margin-bottom: 20px">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Recent Activity</h4>

                                        <ol class="activity-feed mb-0 ps-2" data-simplebar style="max-height: 345px;">
                                            <?php
                                                if(!empty($recentActivities)) {
                                                    foreach($recentActivities as $rec) {
                                                        $date = new DateTime($rec['created_at']);
                                                        $stamp = $date->getTimestamp();
                                                        ?>
                                                            <li class="feed-item">
                                                                <div class="feed-item-list">
                                                                    <p class="text-muted mb-1 font-size-13">
                                                                        <?php
                                                                            echo date("D M j \, Y g:i a", $stamp);
                                                                        ?>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <?php echo $rec['detail']; ?>
                                                                    </p>
                                                                </div>
                                                            </li>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </ol>

                                    </div>
                                </div>
                            </div>

                            <!--My Profile card-->
                            <div class="col-xl-4 mt-3">
                                <div class="card" style="height: 100%; margin-bottom: 20px">
                                    <div class="card-body">
                                        <h4 class="card-title">My Profile card</h4>

                                        <div class="text-center">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-primary-subtle font-size-24">
                                                        <img src="<?php echo $myDetails[0]['display_picture']; ?>" alt="" class="w-100" />
                                                    </span>
                                            </div>
                                            <p class="font-16 text-muted mb-2"></p>
                                            <h5>
                                                <span class="text-dark" style="font-family: monospace;">
                                                    <?php echo strtoupper($myDetails[0]['username']); ?>
                                                </span>
                                            </h5>
                                            <p class="text-muted">
                                                LEVEL <?php echo strtoupper($myDetails[0]['level']); ?>
                                            </p>
                                            <a href="/my_account" class="text-reset font-16">Edit Profile <i class="mdi mdi-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!--Recent Payouts-->
                            <div class="col-xl-4 mt-3">
                                <div class="card" style="height: 100%; margin-bottom: 20px">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Recent Payouts</h4>

                                        <ol class="activity-feed mb-0 ps-2" data-simplebar style="max-height: 345px;">
                                            <?php
                                                if(!empty($payouts)) {
                                                    foreach($payouts as $rec) {
                                                        $date = new DateTime($rec['created_at']);
                                                        $stamp = $date->getTimestamp();
                                                        ?>
                                                            <li class="feed-item">
                                                                <div class="feed-item-list">
                                                                    <p class="text-muted mb-1 font-size-13">
                                                                        <?php
                                                                            echo date("D M j \, Y g:i a", $stamp);
                                                                        ?>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <?php echo '$' . $rec['amount'] . ' ' . $rec['status']; ?>
                                                                    </p>
                                                                </div>
                                                            </li>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

        <?php include('./footer.php'); ?>

