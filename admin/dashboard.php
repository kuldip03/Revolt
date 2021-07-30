<?php
include_once 'check_session.php';

$user_name = $_SESSION["USERNAME"];
$primary_key = $_SESSION["id"]
?>
<!doctype html>
<html lang="en">
    <head>        
        <?php include_once 'head_tag.php'; ?>
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            .switch input { 
                opacity: 0;
                width: 0;
                height: 0;
            }

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked + .slider {
                background-color: #2196F3;
            }

            input:focus + .slider {
                box-shadow: 0 0 1px #2196F3;
            }

            input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
            }
        </style>
    </head>
    <body data-sidebar="dark"  >
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
                                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                                    
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
                                <div class="card  bg bg-primary">
                                    <div class="card-body">
                                        <div class="row ">
                                            <?php
                                            $sql = "SELECT * FROM a_users WHERE id='$primary_key'";
                                            $result = mysqli_query($conn, $sql) or  die("Error File : ".__FILE__." Line No : ".__LINE__."". mysqli_connect_error());    
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
//                                                    ?>
                                                    <div class="col-md-12" style="margin-bottom: 20px;">
                                                        <div class="m-3">
                                                            <div class="text-center ">
                                                                <h4 class="text-white"><?php echo $row['NAME']; ?></h4>
                                                                <P class="text-white"><?php echo $row['USER_TYPE']; ?></P>
                                                            </div>                                        
                                                            <div class="row text-white">
                                                                <div class="col-md-2 text-center"><?php echo $row['MOBILE']; ?></div>
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-2 text-center"><?php echo $row['EMAIL']; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
//                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--used to view active inactive user start-->
                        <div class="row" id="dashboard_row_1">
                            <?php include_once 'dashboard_row_1.php'; ?>
                        </div>
<!--used to view active inactive user en-->                        
                        
                        <div class="row">
                            <div class="col-lg-12">
                                
                                            <div class=""><h4 class="bg bg-danger text-white m-0 p-0">User Active / Inactive System</h4></div>
                                            <div class="col-md-12" id="result"></div>
                                            <div class="col-md-12 " style="margin-top: 20px; height: 400px; overflow: scroll;">
                                                <table class="table table-sm table-striped table-hover table-condensed">
                                                    <thead>
                                                        <tr class="bg-info text-white text-center">
                                                            <th>Sl No</th> <!-- 1 -->
                                                            <th>User Name</th>  <!-- 2 -->
                                                            <th>Name</th>  <!-- 3 -->                                                            
                                                            <th>Email</th>  <!-- 4 -->
                                                            <th>User Type</th>  <!-- 5 --> 
                                                            <th>User Details</th>  <!-- 6 -->
                                                            <th>Active/Inactive</th>  <!-- 7 -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $count = 1;    
                                                        $sql = "SELECT * FROM a_users WHERE USER_TYPE ='user' ORDER BY id DESC";
                                                        $result = mysqli_query($conn, $sql);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) 
                                                            {
                                                                if ($row['ACCOUNT_STATUS'] == "active") {
                                                                    ?>
                                                                <tr class="text-center " id="<?php echo $row['id'] . "" . $row['id']; ?>">  <!-- 1 -->
                                                                        <td><?php echo $count++; ?></td> <!-- 1 -->
                                                                        <td><?php echo $row['USERNAME']; ?></td> <!-- 2 -->
                                                                        <td><?php echo $row['NAME']; ?></td>    <!-- 3 -->                                                                         
                                                                        <td><?php echo $row['EMAIL']; ?></td>   <!-- 4 --> 
                                                                        <td><?php echo $row['USER_TYPE']; ?></td>   <!-- 5 --> 
                                                                        <td><a href="profile?id=<?php echo $row['id']; ?>">View</a></td>   <!-- 6 --> 
                                                                        <td>
                                                                            <label class="switch">
                                                                                <input type="checkbox" checked onchange="set_active_inactive(this.checked, this.value)" value="<?php echo $row['id']; ?>"/>
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </td> <!-- 7 --> 
                                                                        <!--<td><input type="checkbox" checked="" onchange="set_active_inactive(this.checked, this.value)" value="<?php //echo $row['id']; ?>"> <span id="<?php// echo $row['id']; ?>"><?php //echo $row['ACCOUNT_STATUS']; ?></span></td>-->
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                if ($row['ACCOUNT_STATUS'] == "deactive") {
                                                                    ?>
                                                                    <tr class="text-center " id="<?php echo $row['id'] . "" . $row['id']; ?>">
                                                                        <td><?php echo $count++; ?></td> <!-- 1 -->
                                                                        <td><?php echo $row['USERNAME']; ?></td> <!-- 2 -->
                                                                        <td><?php echo $row['NAME']; ?></td>   <!-- 3 -->                                                                          
                                                                        <td><?php echo $row['EMAIL']; ?></td>   <!-- 4 --> 
                                                                        <td><?php echo $row['USER_TYPE']; ?></td>   <!-- 5 --> 
                                                                        <td><a href="profile">View</a></td>   <!-- 6 --> 
                                                                        <td>
                                                                            <label class="switch">
                                                                                <input type="checkbox"  onchange="set_active_inactive(this.checked, this.value)" value="<?php echo $row['id']; ?>">
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </td>  <!-- 7 -->
                                                                        <!--<td><input type="checkbox" onchange="set_active_inactive(this.checked, this.value)" value="<?php //echo $row['id']; ?>"> <span id="<?php //echo $row['id']; ?>"><?php //echo $row['ACCOUNT_STATUS']; ?></span></td>-->

                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                        } else {
                                                            echo "0 results";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>


                                            </div>
                                            <div class="col-md-12">
                                                <div id="dd"></div>
                                            </div>
                                        </div>
                                    
                        </div>
                       
                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <?php
                include_once '../footer_company/footer_company.php';
                ?>
            </div>
        </div>
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
        <script src="../action/softondemand.js"></script>
        <script src="../action/event.js"></script>
        <script src="assets/js/app.js"></script>
        
    </body>
</html>