<?php
session_start();
include_once '../connect/connect.php';
include_once '../connect/variable.php';

if (!isset($_SESSION['ACCOUNT_STATUS']))
{
    header("Location: ../index.php");
} else {
    if ($_SESSION["USER_TYPE"] == $admin_session) {
        header("Location: ../admin/dashboard.php");
    }
    if ($_SESSION["USER_TYPE"] == $user_session) {
//        header("Location: dashboard.php");
    }
}
// head and head tag not need check session
// include check session in every page
?>