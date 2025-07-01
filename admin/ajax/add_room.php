<?php
require('../../inc/connect.php');
require('../essentials.php');

if(isset($_POST['add_room'])){

    $id         = $_POST['id'];
    $name       = $_POST['name'];
    $area       = $_POST['area'];
    $price      = $_POST['price'];
    $quantity   = $_POST['quantity'];
    $adult      = $_POST['adult'];
    $children   = $_POST['children'];
    $descp      = $_POST['descp'];
    $facilities = json_decode($_POST['facilities']);
    $features   = json_decode($_POST['features']);
    
    if($id > 0){
        
        // $sql = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `descp`) 
        //         VALUES ('$name', '$area', '$price', '$quantity', '$adult','$children', '$descp')";
        $sql = "UPDATE `rooms` SET `name`='$name',`area`='$area',`price`='$price',`quantity`='$quantity',`adult`='$adult',`children`='$children',`descp`='$descp' WHERE `id`='$id'";

        $result = mysqli_query($conn, $sql);
        $room_id = $id;

        $flag = 0;
        $q2 = "DELETE FROM `room_features` WHERE `room_id` ='$room_id'";
        $result2 = mysqli_query($conn, $q2);
        if($result2){
            // echo "ok";
        }else{
            echo mysqli_error($conn);
        }
        $q1 = "DELETE FROM `room_facilities` WHERE `room_id`='$room_id'";
        $result1 = mysqli_query($conn, $q1);
        if($result1){
            // echo "ok";
        }else{
            echo mysqli_error($conn);
        }

        
        foreach($features as $feature){
            
            $q2 = "INSERT INTO `room_features`(`room_id`, `room_features`) VALUES ('$room_id','$feature')";
            $result2 = mysqli_query($conn, $q2);
            if($result2){
            foreach($facilities as $facility){
                $q1 = "INSERT INTO `room_facilities`(`room_id`, `room_facilities`) VALUES ('$room_id','$facility')";
                $result1 = mysqli_query($conn, $q1);
                if($result1){
                    $flag = 1;
                }
            }
        }
        }

        if($flag == 1){
        echo alert('DATA INSERTED', 'success');
        }
        else{
        echo alert('SERVER DOWN'.mysqli_error($conn), 'danger');
        }

    }
    else{

        $sql = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `descp`) 
                VALUES ('$name', '$area', '$price', '$quantity', '$adult','$children', '$descp')";

        $result = mysqli_query($conn, $sql);
        $room_id = mysqli_insert_id($conn);

        $flag = 0;
        foreach($features as $feature){
            $q2 = "INSERT INTO `room_features`(`room_id`, `room_features`) VALUES ('$room_id','$feature')";
            $result2 = mysqli_query($conn, $q2);
            if($result2){
                foreach($facilities as $facility){
                    $q1 = "INSERT INTO `room_facilities`(`room_id`, `room_facilities`) VALUES ('$room_id','$facility')";
                    $result1 = mysqli_query($conn, $q1);
                    if($result1){
                        $flag = 1;
                    }
                }
            }
        }

        if($flag == 1){
            echo alert('DATA INSERTED', 'success');
        }
        else{
            echo alert('SERVER DOWN CANNOT ADD', 'danger');
        }

    }

    
}

?>