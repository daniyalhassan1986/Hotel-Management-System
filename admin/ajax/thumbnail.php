<?php
require('../../inc/connect.php');
require('../essentials.php');

$id         = $_POST['id'];
$img        = $_POST['img'];
$room_id    = $_POST['room_id'];

$sql = "UPDATE `room_images` SET `thumb`='0' WHERE `room_id`='$room_id'";
$result = mysqli_query($conn, $sql);

if($result){
    $sql = "UPDATE `room_images` SET `thumb`='1' WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo mysqli_error($conn);   
    }
    else{
        echo alert('Thumbnail Set', 'success');
    }
}





?>