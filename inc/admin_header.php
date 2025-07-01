<?php
require('connect.php');

$sql = 'SELECT * FROM `features`';
$features = mysqli_query($conn, $sql);

$sql = 'SELECT * FROM `facilities`';
$facilities = mysqli_query($conn, $sql);

$sql = 'SELECT * FROM `rooms`';
$rooms = mysqli_query($conn, $sql);




?>
<div class="container-fluid d-flex bg-dark text-white justify-content-between p-3 sticky-top">
    <h3 class="mb-0 h-font">HBS Admin</h3>
    <a class="btn btn-light btn-sm" href="logout.php">Logout</a>
</div>
<div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard-menu">
    <nav class="navbar navbar-expand-lg bg-dark text-white mb-5" id="nav-bar">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h5 class="my-3">FILTERS</h5>
            <button class="navbar-toggler shadow-none mb-2 ms-3 bg-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#admindropdown" aria-controls="admindropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse flex-column align-items-stretch navbar-collapse" id="admindropdown">
                <ul class="nav nav-pills nav-fill flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-start text-white" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link text-start text-white d-flex align-items-center"
                            data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            <span>Bookings</span>
                            <span><i class="bi bi-caret-down-fill"></i></span>
                        </button>

                        <div class="collapse" id="collapseExample">
                            <ul class="nav nav-pills nav-fill flex-column border border-3 rounded ms-3">
                                <li class="nav-item">
                                    <a class="nav-link text-start text-white" href="new_bookings.php">New Bookings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-start text-white" href="refund_bookings.php">Refund Bookings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-start text-white" href="booking_records.php">Booking Records</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-start text-white" href="all_users.php">All Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-start text-white" href="users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-start text-white" href="reviews.php">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-start text-white" href="features.php">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-start text-white" href="facilities.php">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-start text-white" href="rooms.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-start text-white" href="carousel.php">Carousel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-start text-white" href="settings.php">Settings </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>