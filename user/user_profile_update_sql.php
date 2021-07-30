<?php
include_once 'check_session.php';

$id = $_SESSION['id'];
$table_name = $a_users;

if (isset($_GET['obj'])) {
    $obj = $_GET['obj'];
    if ($obj == 1) {
        get_district();         //calls 01 function
    }if ($obj == 2) {
        user_profile_update();     //calls 02 function
    }
}


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

function get_district() {   //kuldip
    global $conn, $state_table, $id;
    $state_name = mysqli_real_escape_string($conn, $_GET['str1']);
    
       
    $sql = "SELECT * FROM $state_table WHERE state_name_cap = '{$state_name}'";
    
    $result = read($sql);
    ?>
    <option value=""><?php echo "Select District"; ?></option>
    <?php
    foreach ($result as $row) {
        ?>
<!--        if($column_name == $val->name){   $selected = 'selected'; }
        else{   $selected = '';     }-->
        <option  value="<?php echo $row[6]; ?>"><?php echo $row[6]; ?></option>
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
