<?php
require('../../inc/connect.php');
require('../essentials.php');

if(isset($_POST)){
    $response = 'no date';
    $name  = $_POST['member_name'];
    $img_r = uploadImage($_FILES['member_img'], ABOUT_FOLDER);

    if($img_r == 'inv_type'){
        $response = "Please make sure that the type is png, jpg, jpeg";
    }elseif ($img_r == 'inv_size'){
        $response = "Please make sure that the size is less than 2mb";
    }
    elseif ($img_r == 'inv_upload'){
        $response = "Please try again later your file is not uploaded";
    }
    else{
        $sql    = "INSERT INTO `team_details` (`name`, `picture`) VALUES ('$name', '$img_r')";
        $rest   = mysqli_query($conn, $sql);
        if($rest){
            $response = 'DATA INSERTED SUCCESSFULLY';
        }else{
            $response = 'DATA NOT INSERTED TRY AGAIN AFTER A WHILE';
        }
    }
    echo $response;
}

?>