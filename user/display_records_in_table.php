<?php
include_once 'check_session.php';
$id = $_SESSION['id'];
$username = $_SESSION['USERNAME'];

if (isset($_GET['table'])) {
    $tb_name = $_GET['table'];
} else {
//    exit();
    //$tb_name ="mlm_service";
}
?>

<div class="col-md-12 text-center">
    <h1><?php // echo "name: "+$tb_name;        ?></h1>
</div>
<div class="col-md-12 tableFixHead" style=" ">
    <?php
    $tb_column = array();
    $sql = "SHOW COLUMNS FROM " . $tb_name;
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        array_push($tb_column, $row['Field']);
    }
    ?>
    <table class="table table-striped display_tb table-sm table-bordered">
        <thead>
            <tr class="bg-danger text-white">
                <th>SL</th>
                <th>DELETE</th>
                <?php
                foreach ($tb_column as $value) {
                    if($value == 'id'){  continue;   } //skip id
                    if($value == 'auto_date'){  continue;   } //skip auto_date
                    if(strtolower($value) == 'password'){  continue;   } //skip password
                    if($value == 'POST_ID'){  continue;   } //skip POST_ID
                    ?>                    
                    <th nowrap="nowrap"><?php echo $value; ?></th>
                    <?php
                }
                ?>   
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            $sql = "SELECT * FROM " . $tb_name." WHERE AUTHOR = '$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="delete_universal(<?php echo $row['id']; ?>, '<?php echo $tb_name; ?>');" ><span><i class='far fa-trash-alt' style='font-size:16px;color:white'></i></span> </button></td>
                        <?php
                        foreach ($tb_column as $value) {
                        if ($value === 'id') {   continue;     } //skip id
                        if ($value === 'auto_date') {   continue;     } //skip auto_date
                        if(strtolower($value) == 'password'){  continue;   } //skip password
                        if($value == 'POST_ID'){  continue;   } //skip password
                        ?>
                        <td nowrap="nowrap">
                            <?php                                                                 
                            $temp = str_replace("_", " ", $row[$value]);
                            if(strlen($temp)>20){                                
                               echo substr($temp,0,20) . "..."; 
                            }else{
                                echo $temp;
                            }                            
                            ?>
                        </td>
                        <?php
                        }
                    }
                } else {
                    ?>
                    <td colspan="5">No Record Found</td>
                    <?php
                   // echo '<br>' . $sql;
                }
                ?>
            </tr>
        </tbody>
    </table>
</div>