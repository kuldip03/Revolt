<?php
include_once '../connect/connect.php';
//print_r($conn);
//$conn = mysqli_connect("localhost", "root", "", "mlm");


if (isset($_REQUEST['sql'])) {
    //used to set search string on serch field at the end of line
    $search = stripslashes(mysqli_real_escape_string($conn, $_REQUEST['search']));
    $limit =  stripslashes(mysqli_real_escape_string($conn, $_REQUEST['limit']));   
    $column_name =  stripslashes(mysqli_real_escape_string($conn, $_REQUEST['column_name']));    
    
    if (isset($_GET['id'])) {
        $page = $_GET['id'];
    } else {
        $page = 1;
    }
    $offset = ($page - 1) * $limit;
    $LIMIT = "LIMIT {$offset},{$limit}";    //add this variable to sql query of table
    
    //$LIKE = " LIKE '%$search_str%'";
    $sql = stripslashes(mysqli_real_escape_string($conn, $_REQUEST['sql']));
    
    /*********************** extract string till table name ***************************/
    $test_arr = explode(" ", $sql);
    
    if(in_array("FROM", $test_arr)){
        $i =  array_search("FROM", $test_arr)+1;
    }else{
        echo " Check Your Query";
    }
    $new_str = "";
    for($j = 0; $j<= $i; $j++) {
        $new_str .= $test_arr[$j]." ";
    }//echo  $new_str;  //pass this to search onkeyup function as sql
    /*********************** extract string till table name ***************************/
    
    $sql_table = $sql . " " . $LIMIT;     //use this query for table
    $sql_page = stripslashes(mysqli_real_escape_string($conn, $_REQUEST['sql']));         // use this quwry for pagination

    //process to get php file name from $_REQUEST['file']
    $file = mysqli_real_escape_string($conn, $_REQUEST['file']);
    if (strpos($file,"/")!== false) 
    {
        $file = explode("/", $file);
        $file = $file[sizeof($file) - 1];       // FILE NAME with .php
    }else{
        $file = mysqli_real_escape_string($conn, $_REQUEST['file']);
    }   

    $table_name = "";       // must be empty always       

    //process to get table name from query
    if (strpos(strtolower($sql_table), "select") !== false) {
        if (strpos(strtolower($sql_table), "from")) {
            $arr = explode(" ", $sql_table);
            if (in_array('FROM', $arr)) {
                $table_name = $arr[array_search('FROM', $arr) + 1];
            }
        }
        if (strpos(strtolower($sql_table), "like")) {    
            if(substr_count($sql_table,"%")<2) {
                $arr2 = explode("'", $sql_table);
                //echo "<pre>";print_r($arr2);echo "</pre>";
                $arr2[1] = "'%$search%'";
                $sql_table = implode(" ",$arr2);
            } 
        }
        //echo $sql_table;

        $result = mysqli_query($conn, $sql_table) or die("Query Failed die fundtion 40");
        if(mysqli_num_rows($result) > 0) {

            $head = mysqli_fetch_fields($result);
            //echo "<pre>";print_r($head);echo "</pre>";
            ?> 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-1 mt-1">
<!--Limit start-->                       
                        <select id="limit_id" class="form-control form-control-sm" onchange="hero2()" />
                            <option <?php if($limit == 10){ echo 'selected';} ?> value='10'>10</option>
                            <option <?php if($limit == 20){ echo 'selected';} ?> value='20'>20</option>
                            <option <?php if($limit == 30){ echo 'selected';} ?> value='30'>30</option>
                            <option <?php if($limit == 40){ echo 'selected';} ?> value='40'>40</option>
                            <option <?php if($limit == 50){ echo 'selected';} ?> value='50'>50</option>
                        </select>
<!--Limit end-->
                    </div>
<!--Filter start-->
                <div class="col-md-2 m-1" style="text-align: right; ">Search By : </div>
                    <div class="col-md-2 m-1">
                        <select id="column_name" class="form-control form-control-sm">
                            <option value='Select'>Select</option>
                        <?php    foreach ($head as $val) {
                            if ($val->name == 'id') {  continue;  }     // UNCOMMENT THIS LINE FOR SHOW ID IN FILTER OPTION
                            if ($val->name == 'PASSWORD') {  continue;  }   //UNCOMMENT THIS LINE FOR PASSWORD FILTER OPTION IN SEARCH
                            if($column_name == $val->name){   $selected = 'selected'; }
                            else{   $selected = '';     }
                            echo "<option $selected value='$val->name'>$val->name</option>";
                        }
                        ?>
                      </select>      
                    </div>  
<!--Filter start-->                   
<!--Search start-->
                    <div class="col-md-2 m-1">                       
                        <!--autofocus attribute is not working here so end line scrpt is working-->
                        <input id="new_str" type="hidden" value="<?php echo $new_str; ?>"/>
                        <input id="file_name" type="hidden" value="<?php echo $file; ?>"/>
                        <input type="search" id="search_str" class="form-control form-control-sm" placeholder="Search" onkeyup="hero()" />
                    </div>
<!--Search end-->
                    <div class="col-md-4 mt-1" >
<!--pagination start-->
            <?php
            $result1 = mysqli_query($conn, $sql_page) or die("Query Failed.");
            if (mysqli_num_rows($result1) > 0)
            {
                $total_records = mysqli_num_rows($result1);
                $total_page = ceil($total_records / $limit);

                echo '<ul class="pagination pagination-sm justify-content-center">';
                if ($page > 1) 
                {                    
                //echo '<li class="page-item ml-1"><a class="page-link bg-info text-white" href="'.$file.'?id=10" onclick="return hero('.$i.')" >Prev</a></li>';
                echo '<li class="page-item mr-1 p-0"><a class="page-link bg-info text-white" href="'.$file.'?id='.($page - 1).'&limit='.$limit.'" >Prev</a></li>';
                }
                
                if(!($total_page > 10))
                {
                    for ($i = 1; $i <= $total_page; $i++) 
                    {
                        if ($i == $page) {   $active = "active";     }
                        else {   $active = "";     }
                        //echo '<li class="page-item ml-1"><a class="page-link bg-info text-white" href="'.$file.'?id=11" onclick="return hero('.$i.')" >Prev</a></li>';
                        echo '<li class="page-item mr-1 p-0'.$active.'"><a class="page-link bg-info text-white" href="'.$file.'?id='.$i.'&limit='.$limit.'" >'.$i.'</a></li>';
                    }
                }
                
                if ($total_page > $page) 
                {                                
                //echo '<li class="page-item ml-1"><a class="page-link bg-info text-white" href="'.$file.'?id=12" onclick="return hero('.$i.')" >Prev</a></li>';
                echo '<li class="page-item mr-1 p-0"><a class="page-link bg-info text-white" href="'.$file.'?id='.($page + 1).'&limit='.$limit.'" >Next</a></li>';
                }
                            
                            echo '</ul>';
                        }
                        ?>
<!--pagination end-->
                    </div>
                </div>
            </div> 
<!--Table Start-->
            <div  style="overflow-x:  scroll; overflow-y:  scroll; margin-top: 0px; ">
                <!-- table-light    table_results-->
                <table class="table table-sm table-striped tableFixHead table-hover table-condensed table-bordered table-nowrap" style="border-collapse:collapse; " >
                    <thead class="thead-light">
                        <tr class="bg-info text-white text-center"> 
                            <th style="width:auto;font-size: 12px; padding: 3px; ">SL</th>
                            <!--<th>EDIT</th>-->
                            <th style="width:auto;font-size: 12px; padding: 3px; ">DELETE</th>
                        <?php
                        foreach ($head as $val) {
                            if (strtolower($val->name) == 'id') {     continue;     }   //COMMENT THIS LINE FOR SHOW ID HEADDING
                            //if (strtolower($val->name) == 'password') {  continue;  }  //COMMENT THIS LINE FOR SHOW PASSWORD HEADDING
                            ?><th  style="width:auto;font-size: 12px; padding: 3px; "><?php echo $val->name; ?> </th> <?php
                            }
                            ?>
                        </tr> 
                    </thead>
                    
                    <tbody>        
                            <?php
                            //$count = 1;                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                
                                ?>
                            <tr>
                                <td class="text-center" style="vertical-align: middle; font-size: 14px;"><?php echo ++$offset;//echo $count++; ?></td>  
                                <!--<td><button type="button" class="btn p-1 m-0" onclick="edit_record(<?php //echo $row['id']; ?>, '<?php //echo $table_name; ?>')"><i class='far fa-edit' style='font-size:20px;color:green'></i></button></td>-->
                                <td nowrap="nowrap" class="text-center" style="vertical-align: middle;"><button type="button" class="btn btn-sm p-1 m-0" onclick="delete_record(<?php echo $row['id']; ?>, '<?php echo $table_name; ?>')"><i class='far fa-trash-alt' style='font-size:16px;color:red'></i></button></td>
                            <?php
                            unset($row['id']);
                            foreach ($row as $key => $val) { 
                                
                                //echo $val." and next ".$row['id']." / "; // both have same value so easy to skip
                                //if (strtolower($key) === $row['id']) {   continue;     }    //COMMENT THIS LINE FOR SHOW ID
                                //if ($val === $row['PASSWORD']) {   continue;     } //COMMENT THIS LINE FOR SHOW PASSWORD
                               
                                ?><td nowrap="nowrap" style="width:auto;font-size: 14px; padding: 3px; vertical-align: middle; "><?php echo $val; ?> </td> <?php
                                                               
                            }
                        ?></tr><?php
                            }
                            ?>
                    </tbody>
                    
                    <tfoot>            
                    </tfoot>
                </table>
            </div>
<!--Table End-->
            <?php
        } else {
            echo "0 Record Found";
        }
    } else {
        echo "Only SELECT query is allowed";
    }
} else {
    echo "Wrong or no SQL Query";
}
?>
<script>
    document.getElementById("search_str").focus();
    //$('#search_str').val('<?php echo $search; ?>');
    document.getElementById("search_str").value = '<?php echo $search; ?>'; 
</script>



<?php   /* given by amit no use of it commented it
    $sql = "SELECT * FROM " . $var->village_tb;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data = $row['VILLAGE_NAME'];
            echo '<option value="' . $row['VILLAGE_NAME'] . '" ';
            if ($village == $data) {
                echo 'selected="selected"';
            }
            echo '>' . $row['VILLAGE_NAME'] . '</option>';
        }
    } else {
        echo "0 results";
    } */
?>