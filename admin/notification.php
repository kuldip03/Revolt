<?php
include_once 'check_session.php';
$id = "admin";
$table_name = "a_notification";
?>
<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
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
                                    <h4 class="mb-sm-0 font-size-18">Add New Notification</h4>
                                    <?php
//                                    echo '<br>' . $_SESSION['target_page'];
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-8">
                            </div>
                        </div>
                        <!-- end row -->                        
                        <!-- end row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12"></div>
                                            <div class="col-md-12 text-success fw-bolder">
                                                <div id="result">
                                                <?php
                                                if (isset($_POST['submit'])) {
                                                    $title          = $_POST['msg_title'];
                                                    $msg            = $_POST['msg1'];
                                                    $updated_by     = $id; //insert session
                                                    $date           = date("Y-m-d");
                                                    $sql = "INSERT INTO ".$table_name." (TITLE, NOTIFICATION, UPDATED_BY ,DATE_TIME)VALUES ('$title','$msg','$updated_by','$date')";
                                                    if (mysqli_query($conn, $sql)) {
                                                        echo "Record Saved Successfully";
                                                    } else {
                                                        echo "Error on Data Inserting" . mysqli_error($conn);
                                                        echo '<br>' . $sql;
                                                    }
                                                }
                                                ?>    
                                                </div>
                                                
                                                <div>
                                                    <form method="post" action="" >
                                                        <!--<form method="post" action="#" onsubmit="1notification_validate(); return false;">-->
                                                        <div class="mt-2"><input type="text" id="msg_title" name="msg_title" class="form-control" placeholder="Title"></div>
                                                        <div class="mt-2"><textarea id="msg1" name="msg1" class="form-control" rows="3" cols="2" ></textarea></div>
                                                        <div class="mt-2 text-center"><button type="submit" name="submit" class="btn btn-success">Submit</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-12"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center" >
                                                <div style="margin:5px; text-align: center;">
                                                    <button class=" " style="background: transparent; border-radius: 8px;"  onclick="display_records_in_table('mlm_notification');"><i class="fa fa-refresh fa-spin" style="font-size:24px"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-md-12 ">
                                                <div id="show_table"></div>    <!--show table here-->
                                            </div>
                                            <div class="col-md-12 " >
                                                <div id="display" style=" ">
                                                    <?PHP
                                                    //include_once 'display_record_in_table.php';
                                                    ?>
                                                </div>
                                            </div>
                                            <div style="margin-top: 10px; "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Transaction Modal -->

                <!-- end modal -->

                <!-- end modal -->
                <script>
                    CKEDITOR.replace('msg1');
                    
                </script>
                <?php
                    // get id from url and pass to js methos
                    if (isset($_GET['id'])) {     $page = $_GET['id'];    } else {     $page = 1;     } 
                    if (isset($_GET['limit'])) {     $limit = $_GET['limit'];    } else {     $limit = 10;     }  
                    $sql = "SELECT * FROM $table_name";
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