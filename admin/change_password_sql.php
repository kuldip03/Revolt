<?php
include_once 'check_session.php';

//echo "i am here";
if(isset($_GET['str1']))
{  
    $id        = $_SESSION['id'];
    $old_pass    = mysqli_real_escape_string($conn, $_GET['str1']);
    $pass1       = mysqli_real_escape_string($conn, $_GET['str2']);
    $pass2       = mysqli_real_escape_string($conn, $_GET['str3']);

    $sql = "SELECT * FROM a_users WHERE id = '{$id}' AND PASSWORD = '{$old_pass}' LIMIT 1";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0)
    {        
        $str = "UPDATE a_users SET PASSWORD = '{$pass1}' WHERE id = '{$id}' AND PASSWORD = '{$old_pass}'";
        $result2 = mysqli_query($conn,$str);
        if($result2){
            echo 1;//Old password matched so passing blank
        }
        if(!$result2){
            echo "Password not changed. Please try again";
        }
    }else{
        echo "Old password not matched. Please try again";
    }  
}
       