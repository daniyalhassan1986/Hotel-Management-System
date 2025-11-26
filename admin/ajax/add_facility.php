<?php
require('../../inc/connect.php');
require('../essentials.php');

if(isset($_POST)){
    $response = 'no date';

    $name     = $_POST['facilities_name'];
    $descp    = $_POST['facilities_description'];
    $img_r    = uploadSVGImage($_FILES['facilities_img'], FACILITIES_FOLDER);

    if($img_r == 'inv_type'){
        $response = "Please make sure that the type is .svg format";
    }elseif ($img_r == 'inv_size'){
        $response = "Please make sure that the size is less than 2mb";
    }
    elseif ($img_r == 'inv_upload'){
        $response = "Please try again later your file is not uploaded";
    }
    else{
        
        $sql    = "INSERT INTO `facilities` (`name`, `image`, `descp`) VALUES ('$name','$img_r','$descp')";
        $rest   = mysqli_query($conn, $sql);
        if($rest){
            $response = 'DATA INSERTED SUCCESSFULLY';
        }else{
            $response = 'DATA NOT INSERTED TRY AGAIN AFTER A WHILE';
        }
    }
    
    echo alert($response, 'success');
}

?>