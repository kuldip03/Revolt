<?php
if ($_SERVER['SERVER_NAME'] == 'localhost') 
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db_name = "revoult";
    //echo '<br>Localhost Server';
} else {
    $host = "localhost";
    $user = "id16010045_maithanceramic";
    $pass = "Marutianjani@123";
    $db_name = "id16010045_maithan";
    //echo '<br>Online Server';
}


$server = "https://smartsoftproject.000webhostapp.com/spotify";

$conn = mysqli_connect($host, $user, $pass, $db_name) or die("Connection failed \nFile Name is : " . __FILE__ . "\n Line No is : " . __LINE__ . "" . mysqli_connect_error());

// Check connection
if (!$conn) {    die("Connection failed: " . mysqli_connect_error());   } 

// 01 Create Database Working Fine
function CREATE_DATABASE($db_name) {
    global $conn;
    $sql = "CREATE DATABASE IF NOT EXISTS " . $db_name;
    if (!mysqli_query($conn, $sql)) {
        echo "<br>" . mysqli_error($conn) . "File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . "";
    } else {
        //echo "<br><b><u>" .$db_name. "</u></b> Database created successfully";
    }
}

// 02 Use Database Working Fine
function SELECT_DATABASE($db_name) {
    global $conn;
    $sql = "USE " . $db_name;
    if (!mysqli_query($conn, $sql)) {
        echo "<br>" . mysqli_error($conn) . "File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . "";
    } else {
        //echo "<br><b><u>" .$db_name. "</u></b> Database Selected successfully";
    }
}

// 03 Drop Database Working Fine
function DROP_DATABASE($db_name) {
    global $conn;
    $sql = "DROP DATABASE IF EXISTS " . $db_name;
    if (!mysqli_query($conn, $sql)) {
        echo "<br>" . mysqli_error($conn) . "File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . "";
    } else {
        echo "<br><b><u>" . $db_name . "</u></b> Database Dropped successfully";
    }
}

//DROP_DATABASE("a_mlm");    
// 04 Create Table Function Working Fine
function CREATE_TABLE($table_name, $fields) {
    global $conn;
    $name =  $table_name;
    $str = "CREATE TABLE IF NOT EXISTS $name (id int(50) AUTO_INCREMENT PRIMARY KEY";
    if (sizeof($fields) > 0) {
        foreach ($fields as $col_name) {
            $col_name = str_replace(" ", "_", $col_name); //remove space with second parameter for col_name
            if (strlen($col_name) > 1) {
                $str = $str . "," . $col_name . " TEXT ";
            }
        }
    }
    $sql = $str . ", auto_date TIMESTAMP NOT NULL)";
    //echo $sql;//die();
    $result = mysqli_query($conn, $sql) or die("Query Failed in : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . "");
    if (!$result) {
        echo "<br>" . mysqli_error($conn) . "<br>" . $sql;
    } else {
        //echo "<br><b><u>".$name."</u></b> table created successfully";
    }
    return $conn;
}

// 05 Drop Table Function Working Fine
function DROP_TABLE($table_name) {
    global $conn;
    $name =  $table_name;
    $sql = "DROP TABLE " . $name;
    if (!mysqli_query($conn, $sql)) {
        echo "<br>" . mysqli_error($conn) . "File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . "";
    } else {
        echo "<br><b><u>" . $name . "</u></b> Table Dropped Successfully";
    }
}

// 06 Truncate Table Function Working Fine
function TRUNCATE_TABLE($table_name) {
    global $conn;
    $name =  $table_name;
    $sql = "TRUNCATE TABLE " . $name;
    if (!mysqli_query($conn, $sql)) {
        echo "<br>" . mysqli_error($conn) . "File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . "";
    } else {
        echo "<br><b><u>" . $name . "</u></b> Table Truncated Successfully";
    }
}


// 07 Alter Table Add Column working fine
function ALTER_TABLE_ADD_COL($table_name, $new_col) {
    global $conn;
    $name =  $table_name;
    $sql = "ALTER TABLE " . $name . "  ADD (" . $new_col . " VARCHAR(500) NOT NULL)";
    if (!mysqli_query($conn, $sql)) {
        echo "<br>" . mysqli_error($conn) . "File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . "<br>" . $sql;
    } else {
        echo "<br><b><u>" . $new_col . "</u></b> Column added successfully";
    }
}

// 08 Alter Table Add Column in text format working fine
function ALTER_TABLE_ADD_COL_TEXT($table_name, $new_col) {
    global $conn;
    $name =  $table_name;
    $sql = "ALTER TABLE " . $name . "  ADD (" . $new_col . " TEXT NOT NULL)";
    if (!mysqli_query($conn, $sql)) {
        echo "<br>" . mysqli_error($conn) . ".File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . " " . $sql;
    } else {
        echo "<br><b><u>" . $new_col . "</u></b> Column added successfully";
    }
}

// 09 Alter Table Add Column working fine
function ALTER_TABLE_DELETE_COL($table_name, $new_col) {
    global $conn;
    $name = $table_name;
    $sql = "ALTER TABLE " . $name . "  DROP " . $new_col;
    if (!mysqli_query($conn, $sql)) {
        echo "<br>" . mysqli_error($conn) . "File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . "";
    } else {
        echo "<br><b><u>" . $new_col . "</u></b> Column deleted successfully";
    }
}

// 10 insert into table working fine
function INSERT_INTO_TABLE($array_col, $array_col_val, $table_name) {
    global $conn;
    $name = $table_name;

    $table_col = implode(",", $array_col);
    $array_col_value = implode("' , '", $array_col_val);

    $sql = "INSERT INTO " . $name . " ($table_col) VALUES('$array_col_value')";

    if (mysqli_query($conn, $sql)) {
        //echo "<br>....<b>New Record</b> inserted successfully";
    } else {
        echo "<br>..." . mysqli_error($conn) . "File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . "";
    }
}

// 11 save query working fine
function save($insert_query) {
    global $conn;
    if (mysqli_query($conn, $insert_query)) {
        //echo "<br>....<b>New Record</b> inserted successfully";
        return 1;
    } else {
        echo "<br>..." . mysqli_error($conn) . "File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . "";
    }
}

// 12 read query working fine
function read($read_query) {
    global $conn;
    $result = mysqli_query($conn, $read_query) or die("Query Failed in " . "File Name is : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . "");
    if (mysqli_num_rows($result) > 0) {
        return $row = mysqli_fetch_all($result, MYSQLI_BOTH);
    }else{
        echo $read_query;//.mysqli_error($conn);
    }
}

// 13 read query working fine
function ALTER_TABLE_ADD_UNIQUE_KEY($tb_name, $fields) {
    global $conn;
    //ALTER TABLE contacts ADD CONSTRAINT UNIQUE (last_name, first_name);
    $str = "ALTER TABLE $tb_name ";
    $fields = str_replace(" ", "_", $fields); //remove space with second parameter for col_name
    if (strlen($fields) > 1) {
        $str = $str . " ADD UNIQUE KEY ($fields)";
    }
    $str;
    //die();
    $result = mysqli_query($conn, $str) or die("Query Failed in : " . __FILE__ . "\t Line No is : " . __LINE__ . "\t Function Name is : " . __FUNCTION__ . "");
    //echo "done";        
}

?>