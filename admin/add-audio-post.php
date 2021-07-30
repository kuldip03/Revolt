<?php
include_once 'check_session.php';

?>
<!doctype html>
<html lang="en">
<head>        
    <?php include_once 'head_tag.php'; ?>
    <style>
        #box 
        {
         box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
         border-radius: 10px;
         padding: 30px;
        }
    </style>
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
                                
                            </div>
                        </div>
<!-- end page title -->

                        <div class="row"> 
                            <div class="col-md-3"></div>
                            <div class="col-md-6" id="box">
<!-- Form -->
                            <div  class="bg bg-danger" style="margin-top: 5px;"><h4 class="text-white " style="margin-left: 5px;">Post New Audio</h4></div>
                                <form  action="add_audio_post_sql.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group m-1">
                                        <label for="post_title">Title</label>
                                        <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="form-group m-1">
                                        <label for="exampleInputPassword1"> Description</label>
                                        <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                                    </div>
                                    <div class="form-group m-1">
                                        <label for="exampleInputPassword1">Category</label>
                                        <select name="category" class="form-control">
                                            <option disabled selected> Select Category</option>
                                            <?php
                                            
                                            $sql = "SELECT * FROM a_category";

                                            $result = mysqli_query($conn, $sql) or die("File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ );

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='{$row['id']}'>{$row['CATEGORY_NAME']}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group m-1">
                                        <label for="exampleInputPassword1">Post Audio</label>
                                        <input type="file" name="fileToUpload2" class="form-control" required>
                                    </div>
<!--                                    <div class="form-group m-1">
                                        <label for="exampleInputPassword1">Audio Image Icon </label>
                                        <input type="file" name="fileToUpload" class="form-control" required>
                                    </div>-->
                                    <div class="form-group m-1">
                                        <input type="submit" name="submit" class="btn btn-success mt-2" value="Upload" required style="width:100px; " />
                                    </div>
                                </form>
<!--/Form -->
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <!-- end row -->                        
                        <!-- end row -->

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Transaction Modal -->
                
                <!-- end modal -->

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