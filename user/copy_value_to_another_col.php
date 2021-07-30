<?php
    //session_start();
    include_once '../connect/connect.php';

    if(isset($_GET['username']))
    {
        $table_name         = $_GET['table_name'];
        $source_col_name    = $_GET['source_col_name'];
        $target_col_name    = $_GET['target_col_name'];
        $redirect_page      = $_GET['redirect_page'];

        //copy 'id' column value to another column like 'POST_ID' OR 'CATEGORY_ID'

        $sql = "SELECT * FROM $table_name ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        $num = $row[$source_col_name];

        $sql = "UPDATE $table_name SET $target_col_name = '$num' WHERE $source_col_name = '$num'";
        mysqli_query($conn, $sql);
        header("Location: {$redirect_page}");
    }        
?>