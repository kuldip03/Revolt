<?php

include_once '../connect/connect.php';
include_once '../connect/variable.php';

$table_name = "a_users";

if (isset($_GET['status'])) 
{
    $status = $_GET['status'];
    $id = $_GET['id'];  
    
    $sql = "SELECT * FROM " . $table_name . " WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) 
    {
        while ($row = mysqli_fetch_assoc($result)) 
        {
            //check for existing record
            $sql = "UPDATE " . $table_name . " SET ACCOUNT_STATUS ='$status' WHERE id ='$id'";
            if (mysqli_query($conn, $sql)) 
            {
                // after update 
                $sql = "SELECT * FROM " . $table_name . " WHERE id = '$id'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) 
                {
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                        echo $row["ACCOUNT_STATUS"];
                    }
                } 
                else {
                    echo "0 results";
                }
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    } else {
        echo "0 results";
    }
}
//include_once 'set_active_inactive_count.php';
//count_and_update_status();
?>