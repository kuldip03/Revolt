<?php 
    include_once 'check_session.php';
    $user_name = $_SESSION['USERNAME'];
    $target = "../upload/media/audio/";
   
//image upload
if(isset($_FILES['fileToUpload']) || isset($_FILES['fileToUpload2']) )
{
//    $errors = array();
//    $file_name = $_FILES['fileToUpload']['name'];
//    $file_size = $_FILES['fileToUpload']['size'];
//    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
//    $file_type = $_FILES['fileToUpload']['type'];
//    
//    $tmp = explode('.',$file_name);
//    $file_ext = strtolower(end($tmp));
//
//    $extensions = array("jpeg","jpg","png");
//
//    if(in_array($file_ext,$extensions) === false)
//    {
//        $errors[] = "This extension file not allowed, Please choose a JPG, JPEG or PNG file.";
//    }//1024 b x 1024 kb x 2 ==2097152 mb in kb format
//    if($file_size > 2097152){
//        $errors[] = "Image size must be 2mb or lower.";
//    }
//    $new_name = time(). "-".basename($file_name);
//    $target1 = $target."".$new_name;

    
//  video upload process
    $errors2 = array();
    $file_name2 = $_FILES['fileToUpload2']['name'];
    $file_size2 = $_FILES['fileToUpload2']['size'];
    $file_tmp2 = $_FILES['fileToUpload2']['tmp_name'];
    $file_type2 = $_FILES['fileToUpload2']['type'];
    
    $tmp2 = explode('.',$file_name2);
    $file_ext2 = strtolower(end($tmp2));
    
    $extensions2 = array("mp3");

    if(in_array($file_ext2,$extensions2) === false)
    {
        $errors2[] = "Please upload mp3 file only.";
    }//1024 b x 1024 kb x 2 ==2097152 mb in kb format
    if($file_size2 > 10485760){
        $errors2[] = "Audio file size must be 10mb or lower.";
    }
    //$new_name_audio = time(). "-".basename($file_name2);
    $rand= $user_name."_".rand('1111', '9999')."_".time()."-".basename($file_name2);
    $new_name_audio = $rand;
    $target2 = $target."".$new_name_audio;
    
//    if(empty($errors) == true && empty($errors2) == true )
//    {
    if(empty($errors2) == true )
    {       
        //move_uploaded_file($file_tmp,$target1);
        move_uploaded_file($file_tmp2,$target2);
    }else{
//        if(empty($errors) == true){}            
//        else{ echo implode(" ",$errors);}
        if(empty($errors2) == true){
            // blank
        }            
        else{ 
            $show = implode(" ",$errors2);            
            echo '<div style="text-align:center;">';
            echo '<h2>'.$show.'</h2>';
            echo '<h3>You are redirecting</h3>';
            echo '<button style="height:40px; width:300px; padding:10px; border:0px;">Redirecting...</button>';
            echo '</div>';
            header("Refresh: 1; url=add-audio-post");
        }         
        die();
    }
}  
 
//  session_start();// NO NEED TO START SESSION
    $title        = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description  = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category     = mysqli_real_escape_string($conn, $_POST['category']);
    $date         = date("d M, Y");
    $author       = $user_name;

    $sql = "INSERT INTO a_post(TITLE,DESCRIPTION,CATEGORY,POST_DATE,AUTHOR,POST_VIDEO,POST_AUDIO,POST_TYPE)
            VALUES('{$title}','{$description}',{$category},'{$date}','{$author}','NO','{$new_name_audio}','AUDIO');";
    $sql .= "UPDATE a_category SET POST = POST + 1 WHERE id = {$category}";

    if(mysqli_multi_query($conn, $sql))
    {
        echo '<div style="text-align:center;">';
        echo '<h2>Audio Uploaded Successfully</h2>';
        echo '<h3>You are redirecting</h3>';
        echo '<button style="height:40px; width:300px; padding:10px; border:0px;">Redirecting...</button>';
        echo '</div>';
        $query = array(
            'table_name' => 'a_post', 
            'source_col_name' =>  'id',
            'target_col_name' => 'POST_ID',
            'redirect_page' =>  'add-audio-post'
            );
        $query = http_build_query($query);
        
        header("Refresh: 1; url=add-audio-post.php"); 
        
    }else{
      echo "<div class='alert alert-danger'>Query Failed.</div>";
    }
?> 

