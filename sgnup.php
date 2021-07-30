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

if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['name']) && !empty($_POST['email'])) {
        $user = trim(mysqli_real_escape_string($conn, $_POST['username']), " ");
        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        $pass2 = mysqli_real_escape_string($conn, $_POST['password2']);
        $name = trim(mysqli_real_escape_string($conn, $_POST['name']), " ");
        $email = trim(mysqli_real_escape_string($conn, $_POST['email']), " ");
        $date = date('Y-m-d');

        $sql = "SELECT USERNAME FROM a_users WHERE USERNAME = '$user'";
        $sql1 = "SELECT EMAIL FROM a_users WHERE EMAIL = '$email'";

        if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
            ?><script>alert("Username already exist..");</script> <?php
        } else if (mysqli_num_rows(mysqli_query($conn, $sql1)) > 0) {
            ?><script>alert("Email already exist..");</script> <?php
        } else {
            $sql = "INSERT INTO a_users( USERNAME, USER_TYPE, NAME, EMAIL, PASSWORD,DATE, ACCOUNT_STATUS, ACCOUNT_TYPE) 
                VALUES ('$user','user','$name','$email','$pass','$date','active','FREE')";
            if (mysqli_query($conn, $sql)) {
                ?><script>alert("Registered Successfully");</script> <?php
            }
        }
    } else {
        ?><script>alert("All fields are mandatory. Please fill-up all fields");</script> <?php
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
        <!--<link href="sgnup.css" rel="stylesheet" type="text/css" />-->
        <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
        <style>
            body
            {
                font-family: Tahoma, Geneva, sans-serif;
                color: #fff;
                background: url(upload/wallpaper/1.jpg );
                background-size: cover;
            }
            .signup
            {
                background:rgba(44, 62, 80, 0.7);
                padding:40px;
                width:250px;
                margin:auto;
                margin-top:80px;
                height:430px;
                margin-left:180px;
                margin:0 auto;
                margin-top:90px;
            }
            form
            {
                width: 240px;
                text-align: center;
            }
            input
            {

                width: 240px;
                text-align: center;
                background: transparent;
                border: none;
                border-bottom: 1px solid #fff;
                font-family: 'Play', sans-serif;
                font-size: 16px;
                font-weight: 200px;
                padding: 10px 0;
                transition: border 0.5s;
                outline: none;
                color: #fff;
            }
            input[type=submit]
            {
                border: none;
                width: 190px;
                background: white;
                color: #000;
                font-size: 16px;
                line-height: 25px;
                padding: 10px 0;
                border-radius: 15px;
                cursor: pointer;
            }
            input[type=submit]:hover
            {
                color: #fff;
                background-color: black;
            }
            h2
            {
                color: #000;

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
                margin-right:30px;
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
        <div class="signup">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off" >
                <h2 style="color: #fff;">Sign Up</h2>
                <input type="text" name="username" placeholder="Username" required><br><br>    
                <input type="password" name="password" placeholder="Password" required><br><br> 
                <input type="password" name="password2" placeholder="Confirm Password" required><br><br> 
                <input type="text" name="name" placeholder="Enter full name here" required ><br><br>      
                <input type="email" name="email" placeholder="Enter email here" required><br><br>  
                <input type="submit" name="submit" value="Sign up" onclick="myFunction()"><br><br>    
                <div id="msg">Congratulations You Sign Up successfully!!</div>
                <script>
                    /*function myFunction() {
                     var x = document.getElementById("msg");
                     x.className = "show";
                     setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                     }*/
                </script>
                Already have account?<a href="index" style="text-decoration: none; font-family: 'Play', sans-serif; color: yellow;">&nbsp;Log In</a>
            </form>

        </div>
    </body>
</html>
