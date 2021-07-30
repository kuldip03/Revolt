<?php
session_start();
include_once 'connect/connect.php';
include_once 'connect/variable.php';

if (isset($_SESSION["ACCOUNT_STATUS"])) {
    if ($_SESSION["USER_TYPE"] == $admin_session) {
        header("Location: admin/dashboard");
    }
    if ($_SESSION["USER_TYPE"] == "$user_session") {
        header("Location: user/dashboard");
    }
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!--<link href="for.css" rel="stylesheet" type="text/css" />-->
<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
    <style>
	body
{
    font-family: Tahoma, Geneva, sans-serif;
    color: #fff;
    background: url(upload/wallpaper/1.jpg);
    background-size: cover;
}
a
{
    color: yellow;
    text-decoration: blink;
    font-family: Tahoma, Geneva, sans-serif;
    margin-left: 35px;
}
.forget
{
    background: rgba(44,62,80,0.7);
    padding: 40px;
    width: 240px;
    height: 340px;
    margin-left: 180px;
    margin: 0 auto;
    margin-top: 120px;
}
h2
{
    margin-top: 28px;
    margin-left: 10px;
}
input[type=text]
{
    width: 240px;
    background: transparent;
    border: none;
    border-bottom: 1px solid #fff;
    font-family: 'Play', sans-serif;
    font-size: 16px;
    font-weight: 200px;
    padding: 10px 0;
    transition: border 0.5s;
    text-align: center;
    color: white;
}
input[type=button]
{
    border: none;
    background: white;
    color: black;
    font-size: 16px;
    line-height: 25px;
    padding: 10px 0;
    border-radius: 12px;
    cursor: pointer;
    width: 180px;
    margin-left: 30px;
}
input[type=button]:hover
{
    background: black;
    color: white;
}
::placeholder {
    color:aliceblue;
    opacity: 0.8; /* Firefox */
}

#msg {
       visibility: hidden;
    min-width: 250px;
    
    background-color:yellow;
    color: #000;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    right: 30%;
    top: 30px;
    font-size: 17px;
	margin-right:50px;
}

#msg.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
    from {top: 0; opacity: 0;} 
    to {top: 30px; opacity: 1;}
}

@keyframes fadein {
    from {top: 0; opacity: 0;}
    to {top: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {top: 30px; opacity: 1;} 
    to {top: 0; opacity: 0;}
}

@keyframes fadeout {
    from {top: 30px; opacity: 1;}
    to {top: 0; opacity: 0;}
}
</style>
</head>

<body>
<div class="forget">

<form>

<h2 align="center" style="color:#fff;">Forget password</h2>
<h5 style="font-size:14px; color:yellow;">Enter email here that you used on your account.We send link on your email to reset your password.</h5>
<input type="text" name="username" placeholder="Enter your email" /><br /><br />
<input type="button" value="Send" onclick="myFunction()"/><br /><br />
<a href="index" style="text-decoration:none;">Go back to Home page</a><br /><br />

<div id="msg">Link send on your email successfully!!</div>

<script>
function myFunction() {
    var x = document.getElementById("msg");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
</form>
</div>
</body>
</html>
