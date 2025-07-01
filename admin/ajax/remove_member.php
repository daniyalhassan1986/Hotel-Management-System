<?php
require('../../inc/connect.php');
require('../essentials.php');

$id     = $_POST['id'];
$img    = $_POST['img'];

if(delete_image($img, UPLOAD_IMAGE_PATH.ABOUT_FOLDER)){
    $sql = "DELETE FROM `team_details` WHERE `sr_no` = $id";
    if(mysqli_query($conn, $sql)){
        return alert('deleted successfully', 'danger');
    }else{
        return alert('not deleted', 'danger');
    }
}
else{
    return alert('not deleted', 'danger');
}


?>