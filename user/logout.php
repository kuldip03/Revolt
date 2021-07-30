<?php
    include_once 'check_session.php';
?>
<?php

session_unset();
echo '<div style="text-align:center;">';
echo '<h2>Successfully Logout</h2>';
echo '<button style="height:40px; width:300px; padding:10px; border:0px;">Redirecting...</button>';
echo '</div>';
header("Refresh: 1; url=../index");
?>


