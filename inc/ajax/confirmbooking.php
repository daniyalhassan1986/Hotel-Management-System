<?php 

require('../connect.php');
require('../../admin/essentials.php');

date_default_timezone_set('Asia/Karachi');

// echo "Time is ".date('Y-M-d');

if(isset($_POST['check_in'])){
    $status = "";
    $result = "";

    $today_date = new DateTime(date('Y-m-d'));
    $check_in   = new DateTime($_POST['check_in']);
    $check_out  = new DateTime($_POST['check_out']);

    if($check_in == $check_out){
        $result = json_encode(['alert'=> 'Check in and Check out cannot be same', 'status'=>'']);
        echo $result;
        exit;
    }
    elseif($check_in > $check_out){
        $result = json_encode(['alert'=> 'Check in cannot be next days', 'status'=>'']);
        echo $result;

        exit;
    }
    elseif($today_date > $check_out){
        $result = json_encode(['alert'=> 'You cannot check out today', 'status'=>'']);
        echo $result;
        exit;
    }

    else{
        session_start();
        // $_SESSION['room_data'];
        // print_r(); 

        $count_days = date_diff($check_in, $check_out)->days;
        $payment    = $count_days * $_SESSION['room_data']['price'];

        // $avaiable = 1 * $_SESSION['room_data']['available'];
        $avaiable = 2;
        // $_SESSION['room_data']['price']     = $payment;
        $_SESSION['room_data']['total']     = $payment;
        $_SESSION['room_data']['available'] = $avaiable;

        $result = json_encode(['status'=>$avaiable, 'count_days'=>$count_days, 'payment'=>$payment]);
        
        echo $result;

    }
    
}


if(isset($_POST['del'])){
    $sql = mysqli_query($conn, "UPDATE `booking_order` SET `booking_status` = 'cancelled', `refund` = 0 WHERE `booking_id` = $_POST[id]");

    if($sql){
        return true;
    }
    else{
        return true;
    }
}