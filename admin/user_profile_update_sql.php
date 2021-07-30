<?php
include_once 'check_session.php';

$id = $_SESSION['id'];
$table_name = $a_users;  //pass user table name here where state and dist is to be selected

if (isset($_GET['obj'])) {
    $obj = $_GET['obj'];
    if ($obj == 1) {
        get_district();         //calls 01 function
    }if ($obj == 2) {
        user_profile_update();     //calls 02 function
    }
}

/*
function get_district1(){   //amit
    global $conn, $state_table;
    
    $sql = "SELECT * FROM " . $state_table;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data = $row['dist_name_cap'];
            echo '<option value="' . $row['dist_name_cap'] . '" ';
            if ('HOMER' == $data) {
                echo 'selected="selected"';
            }
            echo '>' . $row['dist_name_cap'] . '</option>';
        }
    } else {
        echo "0 results";
    }
}
*/

function get_district() {   //kuldip
    global $conn, $state_table, $id, $table_name;
    
    $state = "";
    $dist = "";
    //$sql1 = "SELECT * FROM $state_table WHERE dist_id = '1'";
    $sql1 = "SELECT * FROM $table_name WHERE id = '$id'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) 
    {
        while ($row1 = mysqli_fetch_assoc($result1)) 
        {
            $state = $row1['STATE'];
            $dist = $row1['DISTRICT'];
        }
    }   
    // as it is code
    $state_name = mysqli_real_escape_string($conn, $_GET['str1']);   
       
    $sql = "SELECT * FROM $state_table WHERE state_name_cap = '{$state_name}'";
    
    $result = mysqli_query($conn,$sql);
    ?>
    <option value=""><?php echo "Select District"; ?></option>
    <?php
    foreach ($result as $row) {
        
        if($dist == $row['dist_name_cap']){   $selected = 'selected'; }
        else{   $selected = '';     }
        ?>
        <option <?php echo $selected; ?> value="<?php echo $row['dist_name_cap']; ?>"><?php echo $row['dist_name_cap']; ?></option>
        <?php
    }
}

function user_profile_update() {
    global $conn, $id, $table_name;
    $full_name = trim(mysqli_real_escape_string($conn, $_GET['full_name']), " ");
    $gender = trim(mysqli_real_escape_string($conn, $_GET['gender']), " ");
    $dob = trim(mysqli_real_escape_string($conn, $_GET['dob']), " ");
    $address = trim(mysqli_real_escape_string($conn, $_GET['address']), " ");
    $state = trim(mysqli_real_escape_string($conn, $_GET['state']), " ");
    $district1 = trim(mysqli_real_escape_string($conn, $_GET['district1']), " ");
    $mobile = trim(mysqli_real_escape_string($conn, $_GET['mobile']), " ");
    $email = trim(mysqli_real_escape_string($conn, $_GET['email']), " ");
    if ($full_name == "" || $gender == "" || $dob == "" || $address == "" || $state == "" || $district1 == "" || $mobile == "" || $email == "") {
        echo " Blank Values are not allowed";
    } else {
        $sql = "UPDATE " . $table_name . " SET NAME ='$full_name'"
                . ", GENDER ='$gender'"
                . ", DOB ='$dob'"
                . ", ADDRESS ='$address'"
                . ", STATE ='$state'"
                . ", DISTRICT ='$district1'"
                . ", MOBILE ='$mobile'"
                . ", EMAIL ='$email'"
                . " WHERE id ='$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
?>
    