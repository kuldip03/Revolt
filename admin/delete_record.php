<?php
include_once 'check_session.php';

$id = $_REQUEST['id'];
$tb = $_REQUEST['table_name'];

$sql = "DELETE FROM " . $tb . " WHERE id = '$id'";
if(mysqli_query($conn, $sql)) {
    echo '1';
} else {
    echo '0';   
}
?>