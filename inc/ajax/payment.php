<?php 

require('../connect.php');
require('../../admin/essentials.php');

date_default_timezone_set('Asia/Karachi');

session_start();

$room_id = $_SESSION['room_data']['id'];
if(isset($_POST['pay_now'])){
    $order_id = 'ORD-'.mt_rand(1111, 9999);
    $sql = mysqli_query($conn, "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`) 
            VALUES ($_SESSION[u_id], 
            $room_id, 
            '$_POST[checkin]', 
            '$_POST[checkout]', 
            '$order_id')");

    if($sql){
        $booking_id = mysqli_insert_id($conn);
        $_SESSION['booking_id'] = $booking_id;
        $room_name  = $_SESSION['room_data']['name'];
        $room_price = $_SESSION['room_data']['price'];
        $room_total = $_SESSION['room_data']['total'];
        $user_name  = $_POST['confirm_name'];
        $contact    = '998989'; // Replace with actual contact input
        $address    = $_POST['confirm_address'];
        
        $sql2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total`, `user_name`, `contact`, `address`) 
                 VALUES ('$booking_id', '$room_name', '$room_price', '$room_total', '$user_name', '$contact', '$address')";
        
        if (mysqli_query($conn, $sql2)) {
            alert('Your Room has been booked <br> Please wait for payment ', 'success');
        } else {
            alert('SERVER DOWN', 'danger');
        }
        
    }else{
        alert("Try again in while", 'danger');
    }


}

?>
