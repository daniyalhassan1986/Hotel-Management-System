<?php
require('../../inc/connect.php');
require('../essentials.php');

$id     = $_POST['id'];
$img    = $_POST['image'];

if(delete_image($img, UPLOAD_IMAGE_PATH.FACILITIES_FOLDER)){
    $sql = "DELETE FROM `facilities` WHERE `id` = $id";
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