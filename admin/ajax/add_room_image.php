<?php
require('../../inc/connect.php');
require('../essentials.php');

if(isset($_FILES['room_img']) && isset( $_POST['room_id'])){
    $room_id = $_POST['room_id'];
    $response = 'no date';


    $img_r = uploadImage($_FILES['room_img'], ROOMS_FOLDER);

    if($img_r == 'inv_type'){
        $response = "Please make sure that the type is png, jpg, jpeg";
    }elseif ($img_r == 'inv_size'){
        $response = "Please make sure that the size is less than 2mb";
    }
    elseif ($img_r == 'inv_upload'){
        $response = "Please try again later your file is not uploaded";
    }
    else{
        $sql    = "INSERT INTO `room_images`(`room_id`, `image`) VALUES ('$room_id', '$img_r')";
        $rest   = mysqli_query($conn, $sql);
        if($rest){
            $response = 'DATA INSERTED SUCCESSFULLY';
        }else{
            $response = 'DATA NOT INSERTED TRY AGAIN AFTER A WHILE';
        }
    }
    return alert($response, 'success');
}
else{
    return alert('Please upload a image', 'danger');
}
