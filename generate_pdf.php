<?php
require('inc/connect.php');
require('inc/mpdf/vendor/autoload.php');

ob_start(); 


$sql = "SELECT * FROM `settings` WHERE id = 1";
$settings = mysqli_fetch_assoc(mysqli_query($conn, $sql));
$booking_id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Ensure it's an integer

$sql = mysqli_query($conn, "SELECT * FROM `booking_order` 
                            INNER JOIN `booking_details` 
                            ON booking_order.booking_id = booking_details.booking_id 
                            WHERE booking_order.booking_id = $booking_id 
                            ORDER BY booking_order.booking_id 
                            LIMIT 1");

$data = mysqli_fetch_assoc($sql);


$date_time  = date('d-m-Y', strtotime($data['date_time']));
$check_in   = date('d-m-Y', strtotime($data['check_in']));
$check_out  = date('d-m-Y', strtotime($data['check_out']));

if ($data['booking_status'] == 'active' && $data['arrival'] == 0) {
    $status = "<span style='color:orange;'>ACTIVATED BUT NOT ARRIVED</span>";
} elseif ($data['booking_status'] == 'active' && $data['arrival'] == 1) {
    $status = "<span style='color:green;'>ACTIVATED AND ARRIVED</span>";
} elseif ($data['booking_status'] == 'cancelled' && $data['refund'] == 0) {
    $status = "<span style='color:red;'>CANCELLED BUT NOT REFUNDED</span>";
} elseif ($data['booking_status'] == 'cancelled' && $data['refund'] == 1) {
    $status = "<span style='color:green;'>CANCELLED AND REFUNDED</span>";
}

// Construct PDF content
$pdfContent = "
    <h1 style='text-align:center;'>{$settings['site_name']} Booking Receipt</h1>
    <table border='1' cellpadding='10' cellspacing='0' width='100%'>
        <thead>
            <tr style='color:#fff;'>
                <th>S.No</th>
                <th>User Details</th>
                <th>Room Details</th>
                <th>Bookings</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b>Order ID: </b> {$data['order_id']}<br>
                    <b>Name: </b> {$data['user_name']}<br>
                    <b>Contact: </b> {$data['contact']}
                </td>
                <td>
                    <b>Room: </b> {$data['room_name']}<br>
                    <b>Price: </b> Pkr {$data['total']}/-
                </td>
                <td>
                    <b>Check in: </b> $check_in <br>
                    <b>Check out: </b> $check_out <br>
                    <b>Paid: </b> Pkr {$data['trans_amount']}/- <br>
                    <b>Date: </b> $date_time
                </td>
                <td><span style='color:green;'>Active</span></td>
                <td><h5>$status</h5></td>
            </tr>
        </tbody>
    </table>";

// Initialize MPDF and write content
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($pdfContent);

if($mpdf->Output($data['order_id'] . '.pdf', 'D')){
    echo 1;
}
else{
    echo 0;
}

?>
