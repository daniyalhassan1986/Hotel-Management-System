<?php
require('essentials.php');
login();


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php require('../inc/links.php'); ?>
</head>

<body>
    <?php require('../inc/admin_header.php') ?>
    <div class="row">
        <?php 
        $is_shutdown = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `shutdown` FROM `settings`"));
        if($is_shutdown['shutdown'] != 1){
            $is_shutdown    = "Shutdown Mode is Activated";
        }else{
            $is_shutdown    = "";
        }

        $current_bookings   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT
                                COUNT(CASE WHEN `booking_status` = 'active' AND `arrival` = 0 THEN 1 END) 
                                AS new_bookings,
                                COUNT(CASE WHEN `booking_status` = 'active' THEN 1 END) AS active_bookings,
                                COUNT(CASE WHEN `booking_status` = 'cancelled' AND `refund` = 0 THEN 1 END) AS refunded_bookings,  
                                COUNT(CASE WHEN `booking_status` = 'cancelled' AND `refund` IS NULL THEN 1 END) AS cancelled_bookings, 
                                COUNT(user_id) AS all_bookings FROM `booking_order`
                            "));
        
        $reviews = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS total_reviews FROM `reviews`"));  
        $queries = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS total_queries FROM `user_queries`"));  
        $all_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS users FROM `user_cred`"));  
    
        ?>
        <div class="col-lg-10 col-md-12 col-sm-12 ms-auto overflow-hidden p-4 mx-2" id="maincontent">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Dashboard</h3>
                <div class="badge bg-danger p-2"><?=$is_shutdown?></div>
            </div>
            <!-- ALL SETTINGS SHORTCUT -->
            <div class="row mb-4">
                <div class="col-md-3 mb-4" id="card">
                    <a href="booking_records.php" class="text-decoration-none">
                        <div class="text-center card text-info p-4 shadow">
                            <h1><i class="bi bi-hospital-fill"></i></h1>
                            <h6>All Bookings</h6>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 mb-4" id="card">
                    <a href="settings.php" class="text-decoration-none">
                        <div class="text-center card text-danger p-4 shadow">
                            <h1><i class="bi bi-database-fill-gear"></i></h1>
                            <h6>Site Information</h6>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 mb-4" id="card">
                    <a href="users.php" class="text-decoration-none">
                        <div class="text-center card text-success p-4 shadow">
                            <h1><i class="bi bi-people-fill"></i></h1>
                            <h6>User Queries</h6>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 mb-4" id="card">
                    <a href="reviews.php" class="text-decoration-none">
                        <div class="text-center card text-warning p-4 shadow">
                            <h1><i class="bi bi-star-fill"></i></h1>
                            <h6>Ratings & Reviews</h6>
                        </div>
                    </a>
                </div>
            </div>

            <!-- BOOKING ANALYTICS -->
            <div class="row mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Booking Analytics</h4>
                    <select class="form-select w-auto" onchange="booking_analytics(this.value)">
                        <option selected value="1">All Days</option>
                        <option value="2">Last 7 Days</option>
                        <option value="3">Last 30 Days</option>
                        <option value="4">Last 90 Days</option>
                        <option value="5">Last 1 Year</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3" id="card">
                    <a href="booking_records.php" class="text-decoration-none">
                        <div class="text-center card text-info p-4 shadow">
                            <h6>Total Bookings</h6>
                            <h1 id="all_bookings"><?=$current_bookings['all_bookings']?></h1>
                            <h5 id="all_amount">Rs 0</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3" id="card">
                    <a href="refund_bookings.php" class="text-decoration-none">
                        <div class="text-center card text-success p-4 shadow">
                            <h6>Refund Bookings</h6>
                            <h1 id="refund_bookings"><?=$current_bookings['refunded_bookings']?></h1>
                            <h5 id="refund_amount">Rs 0</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3" id="card">
                    <a href="new_bookings.php" class="text-decoration-none">
                        <div class="text-center card text-warning p-4 shadow">
                            <h6>New Bookings</h6>
                            <h1 id="new_bookings"><?=$current_bookings['new_bookings']?></h1>
                            <h5 id="new_amount">Rs 0</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3" id="card">
                    <a href="booking_records.php" class="text-decoration-none">
                        <div class="text-center card text-danger p-4 shadow">
                            <h6>Cancelled Bookings</h6>
                            <h1 id="cancelled_bookings"><?=$current_bookings['cancelled_bookings']?></h1>
                            <h5 id="cancelled_amount">Rs 0</h5>
                        </div>
                    </a>
                </div>
            </div>

            <!-- USER ANALYTICS -->
            <div class="row mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Users, Reviews, Ratings Analytics</h4>
                    <!-- <select class="form-select w-auto">
                        <option value="1">Last 7 Days</option>
                        <option value="2">Last 15 Days</option>
                        <option value="3">Last 30 Days</option>
                        <option selected value="4">All Days</option>
                    </select> -->
                </div>
                <div class="col-md-3 mb-3" id="card">
                    <a href="all_users.php" class="text-decoration-none">
                        <div class="text-center card text-info p-4 shadow">
                            <h1><?=$all_users['users']?></h1>
                            <h6>All Users</h6>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3" id="card">
                    <a href="users.php" class="text-decoration-none">
                        <div class="text-center card text-success p-4 shadow">
                            <h1><?=$queries['total_queries']?></h1>
                            <h6>Queries</h6>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3" id="card">
                    <a href="reviews.php" class="text-decoration-none">
                        <div class="text-center card text-warning p-4 shadow">
                            <h1><?=$reviews['total_reviews']?></h1>
                            <h6>Reviews</h6>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="inc/dashboard.js"></script>
</body>

</html>