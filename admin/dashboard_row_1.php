<?php
//$user_name = $_SESSION["USERNAME"];
include_once '../connect/connect.php';
?>
<div class="col-lg-3">
    <div class="card  bg bg-success">
        <div class="card-body ">
            <h4 class="card-title mb-4 text-white fw-bolder">Active User</h4>
            <h1 class="text-center text-white">
                <?php
                $sql = "SELECT * FROM a_users WHERE USER_TYPE ='user' AND  ACCOUNT_STATUS ='active' AND ACCOUNT_TYPE ='FREE'";
                if ($result = mysqli_query($conn, $sql)) 
                {
                    $rowcount = mysqli_num_rows($result);
                    echo $rowcount;
                    mysqli_free_result($result);
                }
                ?>
            </h1>
        </div>
    </div>
</div>
<div class="col-lg-3">
    <div class="card bg bg-danger">
        <div class="card-body">
            <h4 class="card-title mb-4 text-white fw-bolder">Inactive User</h4>
            <h1 class="text-center text-white">
                <?php
                $sql = "SELECT * FROM a_users WHERE USER_TYPE ='user' AND ACCOUNT_STATUS ='deactive' AND ACCOUNT_TYPE ='FREE'";
                if ($result = mysqli_query($conn, $sql)) {
                    $rowcount = mysqli_num_rows($result);
                    echo $rowcount;
                    mysqli_free_result($result);
                }
                ?>
            </h1>
        </div>
    </div>
</div>
<div class="col-lg-3">
    <div class="card bg bg-success">
        <div class="card-body">
            <h4 class="card-title mb-4 text-white fw-bolder">Active Premium User</h4>
            <h1 class="text-center text-white">
                <?php
                $sql = "SELECT * FROM a_users WHERE USER_TYPE ='user' AND ACCOUNT_STATUS ='active' AND ACCOUNT_TYPE ='PAID'";
                if ($result = mysqli_query($conn, $sql)) {
                    $rowcount = mysqli_num_rows($result);
                    echo $rowcount;
                    mysqli_free_result($result);
                }
                ?>
            </h1>
        </div>
    </div>
</div>
<div class="col-lg-3" style="border-radius: 50%; ">
    <div class="card bg bg-danger">
        <div class="card-body">
            <h4 class="card-title mb-4 text-white fw-bolder">Inactive Premium User</h4>
            <h1 class="text-center text-white">
                <?php
                $sql = "SELECT * FROM a_users WHERE USER_TYPE ='user' AND ACCOUNT_STATUS ='deactive' AND ACCOUNT_TYPE ='PAID'";
               if ($result = mysqli_query($conn, $sql)) {
                    $rowcount = mysqli_num_rows($result);
                    echo $rowcount;
                    mysqli_free_result($result);
                }
                ?>
            </h1>
        </div>
    </div>
</div>