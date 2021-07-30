<?php
include_once 'check_session.php';
$user_name = $_SESSION['USERNAME'];
$primary_key = "";
if(isset($_GET['id'])){
    $primary_key = $_GET['id'];
}else{
    $primary_key = $_SESSION["id"];
}

?>
<!doctype html>
<html lang="en">
    <head>
        <?php include_once 'head_tag.php'; ?>
    </head>
<style>
        body{
           /* background: -webkit-linear-gradient(left, #3931af, #00c6ff);*/
        }
        .emp-profile{
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            /*background: #fff;*/
        }
        .profile-img{
            text-align: center;
        }
        .profile-img img{
            width: 70%;
            height: 100%;
        }
        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            /*background: #212529b8;*/
        }
        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }
        .profile-head h5{
            color: #333;
        }
        .profile-head h6{
            color: #0062cc;
        }
        .profile-edit-btn{
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;
        }
        .proile-rating{
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }
        .proile-rating span{
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }
        .profile-head .nav-tabs{
            margin-bottom:5%;
        }
        .profile-head .nav-tabs .nav-link{
            font-weight:600;
            border: none;
        }
        .profile-head .nav-tabs .nav-link.active{
            border: none;
            border-bottom:2px solid #0062cc;
        }
        .profile-work{
            padding: 14%;
            margin-top: -15%;
        }
        .profile-work p{
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }
        .profile-work a{
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }
        .profile-work ul{
            list-style: none;
        }
        .profile-tab label{
            font-weight: 600;
        }
        .profile-tab p{
            font-weight: 600;
            color: #0062cc;
        }
    </style>
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
                        
                        <!-- end page title -->

                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        
                                                                   <!--start of profile-->
                                    <?php
                                    $sql = "SELECT * FROM a_users WHERE id = '{$primary_key}'";
                                    $result = mysqli_query($conn, $sql) or die("Error File : ".__FILE__." Line No : ".__LINE__."". mysqli_connect_error());    
                                    $row = mysqli_fetch_assoc($result);
                                    //echo "<pre>";  print_r($result); echo "</pre>";
                                    ?>
                                                                   <div class="container emp-profile" style="border:solid brown; ">
                                        <form method="post">
                                            <div class="row m-3"><div class="col-md-12">
                                                    <div  class="bg bg-danger" style="margin-top: 5px;"><h4 class="text-white " style="margin-left: 5px; text-align: center;">Profile Details</h4></div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    
                                                    <div class="profile-img">
                                                        <!--<div id="image">Profile Photo</div>-->
                                                        <!--<div class="file btn btn-lg btn-primary">Change Photo<input type="file" name="file"/></div>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="profile-head">
                                                        <h3 class="text-danger"> <?php echo $row['NAME']; ?></h3>
                                                        <h6> <?php echo "Role : ". $row['USER_TYPE']; ?></h6>
                                                        <!--<p class="proile-rating">RANKINGS : <span>8/10</span></p>-->
                                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                                            </li>
                        <!--                                <li class="nav-item">
                                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                                        </li>-->
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php if($primary_key == $_SESSION["id"]) {  ?>
                                                    <a href="user-profile-update" class="profile-edit-btn btn btn-success text-white"><b>Edit Profile</b></a>
                                                    <?php } ?>
                                                    <!--<input type="submit" class="profile-edit-btn btn-success" name="btnAddMore" value="Edit Profile"/>-->
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-4"> 
                                                    <div class="profile-img">
                                                        <div id="image">Profile Photo</div>
                                                        <a href="<?php echo $row['PHOTO']; ?>"><img src="<?php echo $row['PHOTO']; ?>" alt="No Image" style="width: 130px; height: 150px; border: 3px solid black; padding: 2px; border-radius: 15px; " /></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="tab-content profile-tab" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<!--                                                            <div class="row">
                                                                <div class="col-md-6"><label>Father's Name</label></div>
                                                                <div class="col-md-6"><p><?php //echo $row['FATHER']; ?></p></div>
                                                            </div>-->
                                                            <div class="row">
                                                                <div class="col-md-6"><label>Date Of Birth</label></div>
                                                                <div class="col-md-6"><p><?php echo $row['DOB']; ?></p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6"><label>Gender</label></div>
                                                                <div class="col-md-6"><p><?php echo $row['GENDER']; ?></p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6"><label>Address </label></div>
                                                                <div class="col-md-6"><p><?php echo $row['ADDRESS'] . " " . $row['DISTRICT'] . " " . $row['STATE']; ?></p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6"><label>Mobile No</label></div>
                                                                <div class="col-md-6"><p><?php echo $row['MOBILE']; ?></p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6"><label>Email</label></div>
                                                                <div class="col-md-6"><p><?php echo $row['EMAIL']; ?></p></div>
                                                            </div> 
                                                            <?php if($primary_key == $_SESSION["id"]) {  ?>
                                                            <div class="row">
                                                                <div class="col-md-6"><label>Change Password</label></div>
                                                                <div class="col-md-6"><a href="change_password" class="btn btn-success text-white">Change Password</a></div>
                                                            </div>
                                                            <?php } ?>
                                                            <?php if($primary_key != $_SESSION["id"]) {  ?>
                                                            <div class="row">
                                                                <div class="col-md-6"><label></label></div>
                                                                <div class="col-md-6"><a href="dashboard" class="btn btn-success text-white">Back</a></div>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Experience</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>Expert</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Hourly Rate</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>10$/hr</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Total Projects</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>230</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>English Level</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>Expert</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Availability</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>6 months</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label>Your Bio</label><br/>
                                                                    <p>Your detail description</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="hr" style="height: 2px; margin: 10px 0 50px 0; background: rgba(0, 255, 255)"></div>-->
<!--                                            <div class="row mt-3">
                                                <div class="profile-img ">
                                                    <div class="container-fluid"> 
                                                        <div class="row mb-3" style="border: 1px dashed red; " ></div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div id="image">Aadhaar Card Image</div>
                                                              <a href="<?php //echo $result[0][$c21_AADHAR_IMG]; ?>"><img src="<?php //echo $result[0][$c21_AADHAR_IMG]; ?>" alt="No Image" style="width: 130px; height: 150px; " /></a> <br>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div id="image">Pan Card Image</div>
                                                                <a href="<?php //echo $result[0][$c22_PAN_IMG]; ?>"><img src="<?php// echo $result[0][$c22_PAN_IMG]; ?>" alt="No Image" style="width: 130px; height: 150px; " /></a><br>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div id="image">Passbook Image</div>
                                                                <a href="<?php //echo $result[0][$c24_PASSBOOK_IMG]; ?>"><img src="<?php //echo $result[0][$c24_PASSBOOK_IMG]; ?>" alt="No Image" style="width: 130px; height: 150px; " />  
                                                            </div>
                                                        </div>
                                                    </div>                                                  
                                                </div>                                                    
                                            </div>                                        -->
                                            
                                            <div class="row mb-3"></div>
                                            
                                        </form>           
                                    </div>

 <!--end of profile-->
                                        

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
        <?php
            include_once '../footer_company/footer_company.php';
        ?>
    </body>
</html>