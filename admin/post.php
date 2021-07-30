
<!doctype html>
<html lang="en">
<head>        
    <?php include_once 'head_tag.php'; ?>
</head>

    <body data-sidebar="dark">

        <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            <?php include_once 'head.php'; ?>

            <!-- ========== Left Sidebar Start ========== -->

            <!-- Left Sidebar End -->
            
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Post</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <!-- end row -->
<!--table setting start-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                       <div id="show_table"></div>    <!--show table here--> 
                                    </div>
                                </div>
                            </div>
                        </div>
        <?php
            // get id from url and pass to js methos
            if (isset($_GET['id'])) {     $page = $_GET['id'];    } else {     $page = 1;     } 
            if (isset($_GET['limit'])) {     $limit = $_GET['limit'];    } else {     $limit = 10;     }  
            $sql = "SELECT id,TITLE,DESCRIPTION,CATEGORY,POST_TYPE,POST_DATE FROM a_post";
            $file = $_SERVER['PHP_SELF'];
            $search = "";        
        ?>
        <script>
            $(document).ready(function () 
            {                
                show_table_with_query('<?php echo $sql; ?>', '<?php echo $file; ?>','<?php echo $search; ?>','<?php echo $page; ?>','<?php echo $limit; ?>');
            })
        </script>
        <script src="../action/calc.js"></script> 
<!--table setting end-->        
                        <!-- end row -->
                        <!-- end row -->                        
                        <!-- end row -->

                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <!-- end modal -->

                <?php
                include_once '../footer_company/footer_company.php';
                ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">

                    <h5 class="m-0 me-2">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css">
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
                </div>
            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- apexcharts -->
<!--        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>-->

        <!-- dashboard init -->
<!--        <script src="assets/js/pages/dashboard.init.js"></script>-->

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>
</html>