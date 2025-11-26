<?php
require('../../inc/connect.php');
require('../essentials.php');


if(isset($_POST['room_id'])){
    $room_id = $_POST['room_id'];

    $sql = "SELECT * FROM `room_images` WHERE `room_id` = $room_id";
    $data = mysqli_query($conn, $sql);
    $path = ROOMS_IMG_PATH;

    foreach($data as $key){
        if($key['thumb'] == 1){
            $thumb = '<i class="bi bi-check-lg text-light bg-success px-2 py-1 rounded-pill fs-5 mx-5"></i>';
        }else{
            $thumb = '<i onclick="thumbnail('.$key['id'].', \''.$key['image'].'\', \''.$room_id.'\')" class="bi bi-check-lg text-light bg-secondary px-2 py-1 rounded-pill fs-5 mx-5"></i>';
        }
        
        echo  '<tr class="align-middle">
                    <td><img class="img-fluid" src="'.$path.$key['image'].'" alt=""></td>
                    <td>'.$thumb.'</td>
                    <td><button type="button" onclick="remove_room_img('.$key['id'].', \''.$key['image'].'\', \''.$room_id.'\')" class="btn btn-danger shadow-none rounded-pill"><i class="bi bi-trash"></i></button></td>
                </tr> ';
    }

   
}
else{
    echo "<h5>No Data</h5>";
}

?>