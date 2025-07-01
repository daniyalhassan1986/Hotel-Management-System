<?php
require('../../inc/connect.php');
require('../essentials.php');

$id     = $_POST['id'];


if(isset($_POST['remove_single'])){
    $img    = $_POST['img'];

    if(delete_image($img, UPLOAD_IMAGE_PATH.ROOMS_FOLDER)){
        $sql = "DELETE FROM `room_images` WHERE `id` = $id";
        if(mysqli_query($conn, $sql)){
            return alert('deleted successfully', 'success');
        }else{
            return alert('not deleted', 'danger');
        }
    }
    else{
        return alert('not deleted', 'danger');
    }
}

else{

    $id     = $_POST['id'];

    $sql = "SELECT * FROM `room_images` WHERE `room_id`='$id'";
    $result = mysqli_query($conn, $sql);
    $flag = false;

    // DELETING THE IMAGES
    if(mysqli_num_rows($result) > 0){
        while($img = mysqli_fetch_assoc($result)){
            if(delete_image($img['image'], UPLOAD_IMAGE_PATH.ROOMS_FOLDER)){
                $flag = true;
            }
            else{
                $flag = false;
            }
        }
    }
    else{
        $flag = true;
    }

    // DELETING THE OTHER DATA (ROOMS, FACILITIES, FEATURES) 
    if($flag){
        
        $sql = "DELETE FROM `room_images` WHERE `room_id` = $id";
        if(mysqli_query($conn, $sql)){

            $sql = "DELETE FROM `room_features` WHERE `room_id`=$id";
            $result = mysqli_query($conn, $sql);
            if($result){
                $sql = "DELETE FROM `room_facilities` WHERE `room_id`=$id";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $sql = "DELETE FROM `rooms` WHERE `id`=$id";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        return alert('Deleted successfully', 'success');
                    }
                    else{
                        return alert('ROOM ALLOTED AND <br> CANT BE DELETD', 'danger');
                    }
                }
                else{
                    return alert('ROOM ALLOTED AND <br> CANT BE DELETD', 'danger');
                }
            }
            else{
                return alert('ROOM ALLOTED AND <br> CANT BE DELETD', 'danger');
            }
        }else{
            return alert('not deleted', 'danger');
        }
    }
    else{
        return alert('ROOM ALLOTED AND <br> CANT BE DELETD', 'danger');
    }
}

?>