<?php
require('../../inc/connect.php');
require('../essentials.php');

if(isset($_POST['period'])){

    // echo $_POST['period'];
    // die;
    if($_POST['period'] == 1){
        $condition = " ";

    }elseif($_POST['period'] == 2){
        $condition = "WHERE date_time BETWEEN NOW() - INTERVAL 7 DAY AND NOW()";
        
    }elseif($_POST['period'] == 3){
        $condition = "WHERE date_time BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";

    }elseif($_POST['period'] == 4){
        $condition = "WHERE date_time BETWEEN NOW() - INTERVAL 90 DAY AND NOW()";

    }elseif($_POST['period'] == 5){
        $condition = "WHERE date_time BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
    }
    
    $q  = "SELECT
            COUNT(CASE WHEN `booking_status` = 'active' AND `arrival` = 0 THEN 1 END) AS new_bookings,
            SUM(CASE WHEN `booking_status` = 'active' AND `arrival` = 0 THEN trans_amount END) AS new_amount,

            COUNT(CASE WHEN `booking_status` = 'active' THEN 1 END) AS active_bookings,
            SUM(CASE WHEN `booking_status` = 'active' THEN trans_amount END) AS active_amount,

            COUNT(CASE WHEN `booking_status` = 'cancelled' AND `refund` = 0 THEN 1 END) AS refunded_bookings, 
            SUM(CASE WHEN `booking_status` = 'cancelled' AND `refund` = 0 THEN trans_amount END) AS refunded_amount,  

            COUNT(CASE WHEN `booking_status` = 'cancelled' AND `refund` IS NULL THEN 1 END) AS cancelled_bookings, 
            SUM(CASE WHEN `booking_status` = 'cancelled' AND `refund` IS NULL THEN trans_amount END) AS cancelled_amount,

            COUNT(user_id) AS all_bookings,
            SUM(trans_amount) AS all_amount FROM `booking_order` $condition";

    $result = mysqli_fetch_assoc(mysqli_query($conn, $q));

    $output = json_encode($result);

    echo $output;


}
