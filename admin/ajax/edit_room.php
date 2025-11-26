<?php
require('../../inc/connect.php');
require('../essentials.php');

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $sql        = mysqli_query($conn, "SELECT * FROM `rooms` WHERE id = $id");
    $room_data  = mysqli_fetch_assoc($sql);
    $sql1       = mysqli_query($conn, "SELECT * FROM `room_facilities` WHERE room_id = $id");
    $sql2       = mysqli_query($conn, "SELECT * FROM `room_features` WHERE room_id = $id");

    $facilites = [];
    $features  = [];

    while($row = mysqli_fetch_assoc($sql1)){
        array_push($facilites, $row['room_facilities']);
    }

    while($row = mysqli_fetch_assoc($sql2)){
        array_push($features, $row['room_features']);
    }

    $response = ["room_data"=>$room_data, "facilites"=>$facilites, "features"=>$features];

    $response = json_encode($response);
    echo $response;
}



?>