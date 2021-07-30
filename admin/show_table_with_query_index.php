<!DOCTYPE html>
<html>    
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src='http://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>-->

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../action/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!--Get your own code at fontawesome.com-->
        <script src='../action/fontawesome.js' crossorigin='anonymous'></script>
        <script src="../action/jquery.js"></script>

        <title>Hello, world!</title>

    </head>
    <style>

    </style>
    <body>

        <div class="container-fluid" >
            <div class="row">
                <div class="col-md-12">
                    <div id="show_table"></div>    <!--show table here-->
                </div>                
            </div>            
        </div>

        <?php
        // get id from url and pass to js methos
        if (isset($_GET['id'])) {     $page = $_GET['id'];    } else {     $page = 1;     } 
        if (isset($_GET['limit'])) {     $limit = $_GET['limit'];    } else {     $limit = 10;     }  
        $sql = "SELECT * FROM a_users";
        $file = $_SERVER['PHP_SELF'];
        $search = "";        
        ?>
        <script>
            $(document).ready(function () 
            {                
                show_table_with_query('<?php echo $sql; ?>', '<?php echo $file; ?>','<?php echo $search; ?>','<?php echo $page; ?>','<?php echo $limit; ?>');
            })
        </script>
        <script src="../action/calc.js"></script>       

    </body>
</html>
