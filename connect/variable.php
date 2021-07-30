<?php
    include_once "connect.php";

    $timezone = "Asia/Kolkata";
    date_default_timezone_set($timezone);
//    date_default_timezone_set('America/Los_Angeles');


    $company_title  ="REVOLT";
    $state_table  = "state_table";       //State Table name
    
    $admin_session  = "admin";
    $user_session   = "user";

    $a_users        = 'a_users';         //table name
/**********************************fields  name****************************************/
    $NAME	= "NAME";       //1
//    $FATHER	= "FATHER";     //2
    $USERNAME	= "USERNAME";   //3
    $USER_TYPE	= "USER_TYPE";  //4
    $EMAIL	= "EMAIL";      //5
    $PASSWORD	= "PASSWORD";   //6
    $GENDER	= "GENDER";     //7
    $DOB	= "DOB";        //8
    $MOBILE	= "MOBILE";     //9    
    $ADDRESS	= "ADDRESS";    //10
    $DISTRICT	= "DISTRICT";   //11
    $STATE	= "STATE";      //12    
    $PHOTO	= "PHOTO";      //13
    $DATE	= "DATE";       //14
    $ACCOUNT_STATUS	= "ACCOUNT_STATUS";     //15
    $ACCOUNT_TYPE	= "ACCOUNT_TYPE";     //16
    $PAY_DATE           = "PAY_DATE";     //17
    $PAID_AMOUNT        = "PAID_AMOUNT";     //18
    
    $fields = array($NAME,$USERNAME,$USER_TYPE,$EMAIL,$PASSWORD,$GENDER,$DOB,$MOBILE,
    $ADDRESS,$DISTRICT,$STATE,$PHOTO,$DATE,$ACCOUNT_STATUS,$ACCOUNT_TYPE,$PAY_DATE,$PAID_AMOUNT);

// 01 function serial no this is also table serial no and both name is same
a_users();
function a_users(){
    global $conn, $a_users, $fields;
    
    $v1  = "Test Name 1";
//    $v2  = "Test Father1";
    $v2  = "pass";
    $v3  = "admin";
    $v4  = "admin@mail.com";
    $v5  = "pass";
    $v6  = "MALE";
    $v7  = "12-12-2020";
    $v8  = "1234567890";    
    $v9 = "TEST ADDRESS";    
    $v10 = "DHANBAD";
    $v11 = "JHARKHAND";    
    $v12 = "PHOTO PATH";
    $v13 = "12-07-2021";
    $v14 = "active";  //deactive
    $v15 = "FREE";
    $v16 = "";
    $v17 = "";
    
    $array_col_val = array($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17);
    
    $tb_name = $a_users;
    
    CREATE_TABLE($tb_name, $fields);    
   
    $sql = "SELECT * FROM $tb_name";    
    $result = mysqli_query($conn,$sql) or die("File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ );
    if(mysqli_num_rows($result)>=1){
        //echo 'Working';
    }
    else{
        INSERT_INTO_TABLE($fields, $array_col_val, $tb_name);
        echo "<br><b>$tb_name</b> Table data inserted successfully";
    }    
}

// table 2
a_notification();
function a_notification(){
    global $conn;
    
    $tb_name =  "a_notification";
    $fields = array("TITLE", "NOTIFICATION", "UPDATED_BY", "DATE_TIME");   

    CREATE_TABLE($tb_name, $fields); 
    
}

a_category();
function a_category(){
    global $conn;
    
    $tb_name =  "a_category";
    $fields = array("CATEGORY_ID", "CATEGORY_NAME", "POST");   

    CREATE_TABLE($tb_name, $fields); 
    
}

a_post();
function a_post(){
    global $conn;
    
    $tb_name =  "a_post";
    $fields = array("POST_ID","TITLE","DESCRIPTION","CATEGORY","POST_DATE","AUTHOR","POST_VIDEO","POST_AUDIO","POST_TYPE");   

    CREATE_TABLE($tb_name, $fields);     
}

?>
