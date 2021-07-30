<?php
include_once 'check_session.php';

$id=$_GET['id'];
$tb=$_GET['tb'];
//echo $tb_name." / ".$id;


$sql = "DELETE FROM " . $tb . " WHERE id = '$id'";
if (mysqli_query($conn, $sql)) {
    echo '1';
} else {
    //echo '0';
    echo $sql;
}
?>