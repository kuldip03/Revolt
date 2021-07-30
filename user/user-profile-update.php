<?php
include_once 'check_session.php';
//$table_name = 'a_users';

$target_dir = "../upload/user_profile/";
$id = $_SESSION['id'];

$reference_unique_col_val = $_SESSION['id'];
$reference_unique_col = "id";
$tb_name = "a_users";
?>
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
                                    <h4 class="mb-sm-0 font-size-18"> Update Profile</h4>
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

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!--photo upload start-->


                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <div id="msg"></div> <!-- for display success message-->
                                                    <div  class="bg bg-danger" style="margin-top: 5px;"><h4 class="text-white " style="margin-left: 5px;">Upload Profile photo:</h4></div>
                                                </div>
                                                <div class="col-md-4 mt-2"><input type="file" name="fileToUpload" class="form-control" id="fileToUpload"></div>
                                                <div class="col-md-2 mt-2 text-center" ><button type="submit" name="submit3" class="btn btn-success">Upload</button></div>
                                                <div class="col-md-6 mt-2">
                                                    <?php
                                                    $img_target_col = "PHOTO";

                                                    $sql = "SELECT * FROM " . $tb_name . " WHERE " . $reference_unique_col . " = '$reference_unique_col_val' ";
                                                    $result = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            ?>
                                                            <div><a target="_blank" href="<?php echo $row[$img_target_col] ?>" style="height: 150px; width: auto;">View Image</a></div>                                                                                
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <div><a  href="#" style="height: 150px; width: auto;">Refer Code Not Found</a></div>                                                                                
                                                        <?php
                                                    }
                                                    if (isset($_POST['submit3'])) {
                                                        $img_target_col = "PHOTO";
//                                                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                                                        $temp = explode(".", $_FILES["fileToUpload"]["name"]);
                                                        //$target_file = $target_dir . $reference_unique_col_val . $img_target_col . '.' . end($temp); //amit
                                                        $target_file = $target_dir . $reference_unique_col_val . rand('1111', '9999')."_".time().$img_target_col . '.' . end($temp); //kuldip WORKING
                                                        $uploadOk = 1;
                                                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                                                        if ($check !== false) {
                                                            $uploadOk = 1;
                                                        } else {
                                                            echo "File is not an image.";
                                                            $uploadOk = 0;
                                                        }
                                                        if (file_exists($target_file)) { unlink($target_file);    } // This unlink is working for amit code not after update by me
                                                        //if ($_FILES["fileToUpload"]["size"] > 500000) { // AMIT
                                                        if ($_FILES["fileToUpload"]["size"] > 1048576) { // KULDIP 1 MB
                                                            echo "Sorry, your file is too large.";
                                                            $uploadOk = 0;
                                                        }
                                                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                                            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                                            $uploadOk = 0;
                                                        }
                                                        if ($uploadOk == 0) {
                                                            echo "Sorry, your file was not uploaded.";
                                                        } else {
                                                            $row_found = NULL;
                                                            $member_id = NULL;
                                                            $sql = "SELECT * FROM " . $tb_name . " WHERE " . $reference_unique_col . " = '$reference_unique_col_val' ";
                                                            $result = mysqli_query($conn, $sql);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $row_found = "found";
                                                                    $member_id = $row['id'];
                                                                    if (file_exists($row['PHOTO'])) {// KULDIP WORKING
                                                                        unlink($row['PHOTO']);  }  // KULDIP WORKING this unlink is working for me
                                                                   
                                                                }
                                                            } else {
                                                                echo '<br>Reference Code not Found<br>' . $sql . "<br>";
                                                            }
                                                            if ($uploadOk == "1" && $row_found == "found") {
                                                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                                                    $sql_u = "UPDATE " . $tb_name . " SET " . $img_target_col . " ='$target_file' WHERE " . $reference_unique_col . " ='$reference_unique_col_val'";
                                                                    if (mysqli_query($conn, $sql_u)) {
                                                                        $sql = "SELECT * FROM " . $tb_name . " WHERE " . $reference_unique_col . " = '$reference_unique_col_val' ";
                                                                        $result = mysqli_query($conn, $sql);
                                                                        if (mysqli_num_rows($result) > 0) {
                                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                                ?>
                                                                                <div><img  src="<?php echo $row[$img_target_col] ?>" style="height: 150px; width: 150px;"></div>
                                                                                <script>
                                                                                    function set(){$("#msg").html("<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Image Uploaded successfully..!!</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");}
                                                                                    set();/*this show messge of imge upload*/
                                                                                </script> 
                                                                                <?php
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo "<br>Error on Record Updating<br>";
                                                                    }
                                                                } else {
                                                                    echo "Error on uploading your file to destination.";
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>                                                
                                        </form>


                                        <!--photo upload end-->
                                    </div>
                                </div>
                            </div>
                        </div>                        



                        <!-- end row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body"> 
                                        <div id="msg"></div>
                                        <!--<p id="msg" class="text-success" > </p>  used for test message -->
                                        <!--form start-->                    
                                        <?php //echo $sql;  ?>
                                        <form id="profile" name="profile" method="post"  autocomplete="off" onsubmit="return user_profile_update()"  >
                                            <p id="mcl"></p>
                                            <div class="row">                                                

                                                <?php $result = read("SELECT * FROM $tb_name WHERE id = '{$_SESSION['id']}' LIMIT 1"); ?>

                                                <div class="col-md-12" style="margin-top: 10px; background: #3B5998; "><h4 style="color:white;">User Details</h4></div>

                                                <div class="col-md-4">
                                                    <div style="mt-2"> 
                                                        <div id="">
                                                            <p class="fw-bolder" style="color: black;">Enter Name :</p>
                                                            <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter Your Name" value="<?php echo $result[0]["NAME"]; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>                                                  
                                                <div class="col-md-4">
                                                    <div style="mt-2">                                                            
                                                        <div id="">
                                                            <p class="fw-bolder" style="color: black;">Select Gender:</p>
                                                            <select id="gender" name="gender" class="form-control" required >
                                                                <option value="">Select Gender</option>
                                                                <?php
                                                                if ($result[0]["GENDER"] === "MALE") {
                                                                    echo "<option value='MALE' selected >MALE</option>
                                                                            <option value='FEMALE' >FEMALE</option>";
                                                                } else if ($result[0]["GENDER"] === "FEMALE") {
                                                                    echo "<option value='MALE'>MALE</option>
                                                                            <option value='FEMALE'selected >FEMALE</option>";
                                                                } else {
                                                                    echo "<option value='MALE'>MALE</option>
                                                                            <option value='FEMALE'>FEMALE</option>";
                                                                }
                                                                ?>                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-md-4">
                                                    <div style="mt-2">                                                            
                                                        <div id="">
                                                            <p class="fw-bolder" style="color: black;">Select Date Of Birth :</p>
                                                            <input type="date" id="dob" name="dob" class="form-control" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $result[0]["DOB"]; ?>"  required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12" style="margin-top: 10px; background: #3B5998; "><h4 style="color:white;">Address Details</h4></div>

                                                <div class="col-md-4">
                                                    <div style="mt-2">                                                            
                                                        <div id="">
                                                            <p class="fw-bolder" style="color: black;">Enter Address :</p>
                                                            <input type="text" id="address" name="address" class="form-control" placeholder="Address Line " value="<?php echo $result[0]["ADDRESS"]; ?>" required />
                                                        </div>
                                                    </div>
                                                </div>  
                                                <?php
                                                $state = "";
                                                $sql1 = "SELECT * FROM $tb_name WHERE id = '$id'"; // tb_name get state name selected form user table
                                                $result1 = mysqli_query($conn, $sql1);
                                                if (mysqli_num_rows($result1) > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                                        $state = $row1['STATE'];  // this state name is use match state naem to get selected                                                      
                                                    }
                                                }   
                                                ?>
                                                <div class="col-md-4">
                                                    <div style="mt-2">                                                            
                                                        <div id="">                                                             
                                                            <p class="fw-bolder" style="color: black;">Enter State :</p>
                                                            <select id="state" name="state" class="form-control" onchange="get_district()" required>                                                            
                                                                <option value="" >Select State</option>
                                                                <?php $result = read("SELECT * FROM $state_table WHERE dist_id = 1");  ?>
                                                                <?php  foreach($result as $row){
                                                                    if($state == $row['state_name_cap']){   $selected = 'selected'; }
                                                                    else{   $selected = ''; }
                                                                    ?>
                                                                    <option <?php echo $selected; ?> value="<?php echo $row['state_name_cap']; ?>"><?php echo $row['state_name_cap']; ?></option>  
                                                                <?php  }   ?>                                                                
                                                            </select>
                                                            <script type="text/javascript" src="../action/calc.js"></script> 
                                                            <script>
                                                                $(document).ready(function () {    
                                                                    get_district();
                                                                })
                                                            </script>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div style="mt-2">                                                            
                                                        <div id="">
                                                            <p class="fw-bolder" style="color: black;">Enter District :</p>                                                            
                                                            <select id="district1" name="district" class="form-control" required />
                                                            <option value="" >Select District</option>                                                            
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $result = read("SELECT * FROM $tb_name WHERE id = '{$_SESSION['id']}' LIMIT 1"); ?>

                                                <div class="col-md-12" style="margin-top: 10px; background: #3B5998; "><h4 style="color:white;">Contact Details</h4></div>                                                

                                                <div class="col-md-4">
                                                    <div style="mt-2">                                                            
                                                        <div id="">
                                                            <p class="fw-bolder" style="color: black;">Enter Mobile No :</p>
                                                            <input type="number" id="mobile" name="mobile" class="form-control" placeholder="Enter Mobile"  value="<?php echo $result[0]["MOBILE"]; ?>" required />
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-md-4">
                                                    <div style="mt-2">                                                            
                                                        <div id="">
                                                            <p class="fw-bolder" style="color: black;">Enter e-mail  :</p>
                                                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter e-mail id"  value="<?php echo $result[0]["EMAIL"]; ?>" required />
                                                        </div>
                                                    </div>
                                                </div>                                                 
                                                <div class="col-md-4">
                                                    <div style="mt-2">                                                            
                                                        <div id="">

                                                        </div>
                                                    </div>
                                                </div> 

                                                <div class="row">
                                                    <div class="col-md-5">
                                                    </div>                                           
                                                    <div class="col-md-2 m-1">
                                                        <button type="submit"  class="btn btn-success form-control">Submit</button>
                                                    </div> 
                                                    <div class="col-md-5">
                                                    </div>                                            
                                                </div>                                                    
                                            </div>
                                    </div>    
                                    </form>
                                    <!--form end-->                                        

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">                                
                            <script>
//                                    $("#submit").on("click",function(e){
//                                        user_profile_update();
//                                    });
                            </script>
                        </div>
                    </div>
                    
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <!-- Transaction Modal -->
            <div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="transaction-detailModalLabel">Order Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                            <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <div>
                                                    <img src="assets/images/product/img-7.png" alt="" class="avatar-sm">
                                                </div>
                                            </th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                                    <p class="text-muted mb-0">$ 225 x 1</p>
                                                </div>
                                            </td>
                                            <td>$ 255</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <div>
                                                    <img src="assets/images/product/img-4.png" alt="" class="avatar-sm">
                                                </div>
                                            </th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14">Phone patterned cases</h5>
                                                    <p class="text-muted mb-0">$ 145 x 1</p>
                                                </div>
                                            </td>
                                            <td>$ 145</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h6 class="m-0 text-right">Sub Total:</h6>
                                            </td>
                                            <td>
                                                $ 400
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h6 class="m-0 text-right">Shipping:</h6>
                                            </td>
                                            <td>
                                                Free
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h6 class="m-0 text-right">Total:</h6>
                                            </td>
                                            <td>
                                                $ 400
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="../action/event.js"></script>
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>