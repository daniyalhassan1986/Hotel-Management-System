<?php 

require('../connect.php');
require('../../admin/essentials.php');

date_default_timezone_set('Asia/Karachi');

session_start();

if(isset($_POST['rating'])){
    // print_r($_POST);
    // die;
    $sql = mysqli_query($conn, "UPDATE `booking_order` SET `rate_review`= 2 
                                WHERE `booking_id`=$_POST[booking_id] AND `user_id`=$_POST[user_id]");

    if($sql){
        $sql = mysqli_query($conn, "INSERT INTO `reviews`(`booking_id`, `room_id`, `user_id`, `rating`, `review`)                   VALUES ($_POST[booking_id], $_POST[room_id], $_POST[user_id], '$_POST[ratings]','$_POST[review]')");

        if($sql){
            echo alert('Thank you for your feedback', 'warning');
        }else{
            echo alert('Please try again', 'danger');
        }
    }else{
        echo alert('Please try again', 'danger');
    }
}