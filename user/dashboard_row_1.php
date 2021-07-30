<?php
//$user_name = $_SESSION["USERNAME"];
include_once '../connect/connect.php';
$user = $_SESSION['USERNAME'];
?>
<div class="col-lg-3">
    <div class="card  bg bg-info">
        <div class="card-body ">
            <h4 class="card-title mb-4 text-white fw-bolder">Total Audio Posted</h4>
            <h1 class="text-center text-white">
                <?php
                $sql = "SELECT * FROM a_post WHERE POST_TYPE ='AUDIO'";
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
    <div class="card bg bg-info">
        <div class="card-body">
            <h4 class="card-title mb-4 text-white fw-bolder">Total Vedio Posted</h4>
            <h1 class="text-center text-white">
                <?php
                $sql = "SELECT * FROM a_post WHERE POST_TYPE ='VIDEO'";
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
    <div class="card bg bg-info">
        <div class="card-body">
            <h4 class="card-title mb-4 text-white fw-bolder">My Total Audio Posted</h4>
            <h1 class="text-center text-white">
                <?php
                $sql = "SELECT * FROM a_post WHERE POST_TYPE ='AUDIO' AND AUTHOR = '$user'";
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
    <div class="card bg bg-info">
        <div class="card-body">
            <h4 class="card-title mb-4 text-white fw-bolder">My Total Vedio Posted</h4>
            <h1 class="text-center text-white">
                <?php
                $sql = "SELECT * FROM a_post WHERE POST_TYPE ='VIDEO' AND AUTHOR = '$user'";
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