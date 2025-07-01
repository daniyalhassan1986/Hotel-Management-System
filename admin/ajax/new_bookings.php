<?php 
require('../../inc/connect.php');
require('../essentials.php');


if(isset($_POST['booking'])){
    
    $sql = mysqli_query($conn, "SELECT * FROM `booking_order` 
                                INNER JOIN `booking_details` ON booking_order.booking_id = booking_details.booking_id
                                WHERE booking_order.booking_status = 'active' AND booking_order.arrival = 0 
                                ORDER BY booking_order.booking_id");
    $i = 1;
    $table_data = "";
    while($data = mysqli_fetch_assoc($sql)){
        $date_time  = date('d-m-Y', strtotime($data['date_time']));
        $check_in   = date('d-m-Y', strtotime($data['check_in']));
        $check_out  = date('d-m-Y', strtotime($data['check_out']));

        $table_data .= "
            <tr> 
                <td>$i</td>
                <td>
                    <span class='badge bg-primary'>
                        Order ID : $data[order_id]
                    </span> 
                    <br>
                    <b>Name: </b>$data[user_name]
                    <br>
                    <b>Contact: </b>$data[contact]
                </td>
                <td>
                    <b>Room: </b> $data[room_name]
                    </br>
                    <b>Price: </b>Pkr $data[total]/-
                </td>
                <td>
                    <b>Check in: </b>$check_in
                    <br>
                    <b>Check out: </b>$check_out
                    <br>
                    <b>Paid: </b>$data[trans_amount]/-
                    <br> 
                    <b>Date: </b>$date_time
                    <br>
                </td>
                <td>
                    <button type='button' onclick='add_booking_id($data[booking_id])' class='btn btn-success mb-2' data-bs-toggle='modal' data-bs-target='#assign_room'>
                        <i class='bi bi-check-lg'></i> Assign Room
                    </button>
                    <br>
                    <button type='button' onclick='cancel_booking($data[booking_id])' class='btn btn-danger'>
                        <i class='bi bi-trash3'></i> Cancel Booking
                    </button>
                <td>
            </tr>
            
        ";
        $i++;
    }

    echo $table_data;
}


if(isset($_POST['assign_room'])){
    $sql = mysqli_query($conn, "UPDATE `booking_order` bo INNER JOIN `booking_details` bd 
                                ON bo.booking_id = bd.booking_id
                                SET bo.arrival = 1, bd.room_no = '$_POST[room_number]', bo.rate_review = 1
                                WHERE bo.booking_id = $_POST[booking_id]");
    if($sql){
        echo alert('Alloted Successfully', 'success');
    }else{
        echo alert('Allotion Failed', 'danger');
    }
}


if(isset($_POST['cancel_booking'])){
    $sql = mysqli_query($conn, "UPDATE `booking_order` SET booking_status = 'cancelled', refund = 0
                                WHERE booking_id = $_POST[booking_id]");
    if($sql){
        echo alert('Booking has been cancelled', 'success');
    }else{
        echo alert('SERVER DOWN', 'danger');
    }
}


if(isset($_POST['username'])){
    $search = $_POST['username'];
    $sql = mysqli_query($conn, "SELECT bo.*, bd.* FROM `booking_order` bo 
                                INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
                                WHERE (bo.order_id LIKE '%$search%' OR bd.contact LIKE '%$search%' OR bd.user_name LIKE '%$search%' OR bd.room_name LIKE '%$search%')
                                AND bo.booking_status = 'active' AND bo.arrival = 0 ORDER BY bo.booking_id");
    
    $i = 1;
    $table_data = "";
    while($data = mysqli_fetch_assoc($sql)){
        $date_time  = date('d-m-Y', strtotime($data['date_time']));
        $check_in   = date('d-m-Y', strtotime($data['check_in']));
        $check_out  = date('d-m-Y', strtotime($data['check_out']));

        $table_data .= "
            <tr> 
                <td>$i</td>
                <td>
                    <span class='badge bg-primary'>
                        Order ID : $data[order_id]
                    </span> 
                    <br>
                    <b>Name: </b>$data[user_name]
                    <br>
                    <b>Contact: </b>$data[contact]
                </td>
                <td>
                    <b>Room: </b> $data[room_name]
                    </br>
                    <b>Price: </b>Pkr $data[total]/-
                </td>
                <td>
                    <b>Check in: </b>$check_in
                    <br>
                    <b>Check out: </b>$check_out
                    <br>
                    <b>Paid: </b>$data[trans_amount]/-
                    <br> 
                    <b>Date: </b>$date_time
                    <br>
                </td>
                <td>
                    <button type='button' onclick='add_booking_id($data[booking_id])' class='btn btn-success mb-2' data-bs-toggle='modal' data-bs-target='#assign_room'>
                        <i class='bi bi-check-lg'></i> Assign Room
                    </button>
                    <br>
                    <button type='button' onclick='cancel_booking($data[booking_id])' class='btn btn-danger'>
                        <i class='bi bi-trash3'></i> Cancel Booking
                    </button>
                <td>
            </tr>
            
        ";
        $i++;
    }

    echo $table_data;


}