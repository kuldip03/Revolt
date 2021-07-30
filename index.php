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

if (isset($_POST['submit'])) {    //1
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    //$select_query = "SELECT * FROM a_users  WHERE ACCOUNT_STATUS = 'active' AND USERNAME = '$user'"; 
    $select_query = "SELECT * FROM a_users  WHERE USERNAME = '$user'";
    $select_query = $select_query . " LIMIT 1";
    $result = mysqli_query($conn, $select_query) or die("Error File : " . __FILE__ . " Line No : " . __LINE__ . "" . mysqli_connect_error());
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row[$ACCOUNT_STATUS] == 'active') {
            if ($row['PASSWORD'] === $pass) {
                $_SESSION["USERNAME"] = $row['USERNAME'];
                $_SESSION["id"] = $row['id'];               
                $_SESSION["ACCOUNT_STATUS"] = $row['ACCOUNT_STATUS']; 
                
                if ($row['USER_TYPE'] === "admin") {
                    $_SESSION["USER_TYPE"] = $admin_session;
                    header("Location: admin/dashboard");
                }
                if ($row['USER_TYPE'] === "user") {
                    $_SESSION["USER_TYPE"] = $user_session;
                    header("Location: user/dashboard");
                }
            } else {
                ?><script>alert("Invalid Password. Please try again..!!");</script> <?php
            }
        } else {
            ?><script>alert("Account is deactive..!!");</script> <?php
        }
    } else {
        ?><script>alert("Invalid inputs. Please try again..!!");</script> <?php
    }
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> testing</title>
        <!--<link href="logn.css" rel="stylesheet" type="text/css" />-->
        <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
    </head>
    <style>
        body
        {
            font-family: Tahoma, Geneva, sans-serif;
            color: #fff;
            background: url(upload/wallpaper/1.jpg);
            background-size: cover;
        }
        .signin
        {
            background: rgba(44,62,80,0.7);
            padding: 40px;
            width: 250px;
            margin: auto;
            margin-top: 90px;
            height: 400px;
            margin-left: 180x;

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
            color: white;

        }
        a
        {
            color: yellow;
            text-decoration: blink;
        }
        a:hover
        {
            color: skyblue;
        }
        .container
        {
            display: flex;
            flex-direction: row;
            width: 100%;
        }
        ::placeholder {
            color:aliceblue;
            opacity: 0.8; /* Firefox */
        }

    </style>
    <body>
        <div class="signin">


            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" autocomplete="off" >
                <h2 style="color:#fff;">Log In</h2>
                <input type="text" name="username" id="username" placeholder="Username" required/><br /><br />
                
                <input type="password" name="password" id="password" placeholder="Password" required/><br /><br />
                
                <input type="submit" name="submit" id="submit" value="Log In" required/><br /><br />
                
                <div id="container">
                    <a href="reset" style=" margin-right:0px; font-size:13px; font-family:Tahoma, Geneva, sans-serif;">Reset password?</a>
                    <a href="forget" style=" margin-left:30px; font-size:13px; font-family:Tahoma, Geneva, sans-serif;">Forget password</a>
                </div><br /><br /><br /><br /><br /><br />
                Don't have account?<a href="sgnup" style="font-family:'Play', sans-serif;">&nbsp;Sign Up</a>

            </form>
        </div>

    </body>
</html>
