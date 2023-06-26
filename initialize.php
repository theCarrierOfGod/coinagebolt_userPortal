<?php include_once('./header.php'); ?>

<?php
    if($myDetails[0]['activated'] == 1) {
        // header("Location: /");
        echo "<script>window.location.replace('/');</script>";
    }
?>
<title> Activate Account | Coinagebolt </title>

    
    
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
                                    <h4 class="mb-0">Activate Account</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Activate Account</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row mb-3">
                            <div class="col-xl-8">
                                <div class="card border shadow-none">
                                    <div class="card-body">

                                        <div class="d-flex align-items-start border-bottom pb-3">
                                            <div class="flex-shrink-0 me-4">
                                                <img src="/images/level-1.webp" alt="Level One" class="avatar-lg">
                                            </div>
                                            <div class="flex-grow-1 align-self-center overflow-hidden">
                                                <div>
                                                    <h5 class="text-truncate font-size-16 text-dark">
                                                        Level One 
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
                                                        <p class="mb-2 text-dark">10</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-4">
                                                    <div class="mt-3">
                                                        <p class="mb-2">USDT</p>
                                                        <p class="mb-2 text-dark">10</p>
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

                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td>Sub Total :</td>
                                                            <td class="text-end">$ 10</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Discount : </td>
                                                            <td class="text-end">- $ 0</td>
                                                        </tr>
                                                        <tr class="bg-light">
                                                            <th>Total :</th>
                                                            <td class="text-end">
                                                                <span class="fw-bold">
                                                                    $ 10
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- end table-responsive -->
                                            <a class='payssion-button btn btn-success mt-3 float-end' data-key='live_31311b21e573fcee'>
                                                <i class='fa fa-shopping-cart'></i>&nbsp;Pay Via Payssion
                                            </a>
                                            <script src='https://www.payssion.com/static/checkout/button.js' type='text/javascript'></script> 
                                            <!--<button class="btn btn-success mt-3 float-end" id="activate">-->
                                            <!--    Activate account-->
                                            <!--</button>-->
                                            <!--<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>-->
                                            <!--<script>-->
                                            <!--    $(document).ready(function() {-->
                                            <!--        $("#activate").on("click", function() {-->
                                            <!--            $.ajax({-->
                                            <!--                url: 'https://user.coinagebolt.com/levelCurl?email=<?php echo $email; ?>',-->
                                            <!--                type: 'get',-->
                                            <!--                beforeSend: function() {-->
                                            <!--                    $("#activate").prop('disabled', true);-->
                                            <!--                    $("#activate").html('processing...');-->
                                            <!--                }, -->
                                            <!--                success: function(data) {-->
                                            <!--                    let response = JSON.parse(data);-->
                                            <!--                    if(response.status === 'success') {-->
                                            <!--                        window.location.href = "https://user.coinagebolt.com/level_one";-->
                                                                    // window.open(response.data.invoice_url);
                                            <!--                        $("#activate").prop('disabled', false);-->
                                            <!--                        $("#activate").html('Activate account');-->
                                            <!--                        } else {-->
                                            <!--                            bootbox.alert("Can't process payment, try again later");-->
                                            <!--                            $("#activate").prop('disabled', false);-->
                                            <!--                        $("#activate").html('Activate account');-->
                                            <!--                    }-->
                                            <!--                },-->
                                            <!--                error: function(err) {-->
                                            <!--                    bootbox.alert("Can't process payment, try again later");-->
                                            <!--                    $("#activate").prop('disabled', true);-->
                                            <!--                    $("#activate").html('Activate account');-->
                                            <!--                }-->
                                            <!--            })-->
                                            <!--        });-->
                                            <!--    })-->
                                            <!--</script>-->
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

