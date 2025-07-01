<?php require('inc/connect.php') ?>
<?php

session_start();
$booking_id = $_SESSION['booking_id'];
$transid = 'TRNS-'.mt_rand(111, 999);
$trans_amount = $_SESSION['room_data']['total'];
$sql = mysqli_query($conn, "UPDATE `booking_order` SET `booking_status`='active', `trans_id`='$transid',`trans_amount`='$trans_amount',`trans_status`='done',`trans_resp_msg`='payment done' 
                            WHERE `booking_id`='$booking_id'");


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HBS - Home </title>
    <!-- LINKS -->
    <?php require('inc/links.php') ?>
    <style>
    .availability-form {
        margin-top: -50px !important;
        z-index: 2;
        position: relative;
    }

    @media screen and (max-width: 575px) {
        .availability-form {
            margin-top: 0px !important;
        }
    }
    </style>
</head>

<body>
    <!-- HEADER -->
    <?php require('inc/header.php'); ?>

    <div class="container my-5">
        <h3>Payment Status</h3>
        <?php if($sql){ ?>
        <div class="alert alert-success my-5" role="alert">
            <h4 class="alert-heading"><i class="bi bi-check-circle-fill m-2"></i> Well done!</h4>
            <p>Your booking has been done successfully</p>
            <hr>
            <p class="mb-0"><a href="bookings.php">Go to your bookings</a></p>
        </div>
        <?php }else{?>
        <div class="alert alert-danger my-5" role="alert">
            <h4 class="alert-heading"><i class="bi bi-check-circle-fill m-2"></i> SERVER DOWN!</h4>
            <p>Your booking cannot be done please check after a while</p>
            <hr>
            <p class="mb-0"><a href="bookings.php">Go to your bookings</a></p>
        </div>
        <?php }?>
    </div>
    <!-- FOOTER -->
    <?php require('inc/footer.php'); ?>

</body>

</html>