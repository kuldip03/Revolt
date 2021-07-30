<?php
include_once 'check_session.php';

$id = $_REQUEST['id'];
$tb = $_REQUEST['table_name'];

$sql = "SELECT * FROM " . $tb . " WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0)
{
    while($row= mysqli_fetch_assoc($result))
    {
        $file_name ="";
        if($row['POST_TYPE'] == 'AUDIO')
        {
            $file_name = $row['POST_AUDIO'];
            $file_directry="../upload/media/audio/";
        }
        if($row['POST_TYPE'] == 'VIDEO')
        {
            $file_name = $row['POST_VIDEO'];
            $file_directry="../upload/media/video/";
        }        
        unlink($file_directry.$file_name);
    }
}
?>