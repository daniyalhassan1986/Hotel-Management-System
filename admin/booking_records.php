<?php
require('essentials.php');
require('../inc/connect.php');
login();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php require('../inc/links.php'); ?>
</head>

<body>
    <?php require('../inc/admin_header.php') ?>
    <div class="row">
        <div class="col-lg-10 col-md-12 col-sm-12 ms-auto overflow-hidden p-4" id="maincontent">

            <div class="card mt-4">
                <div class="card-body shadow">
                    <div class="text-end mb-4">
                        <div class="mb-3 d-flex justify-content-end">
                            <div class="user_alert" id="user_alert"></div>
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                            <h5 class="card-title mt-3">All Bookings</h5>
                            <input type="text" oninput="search_bookings(this.value)"
                                class="form-control shadow-none ms-auto w-25" placeholder="Search" id="search"
                                name="search" autocomplete="off">

                        </div>
                    </div>
                    <div id="table-responsive-md"
                        style="height: 500px; overflow-y: scroll; overflow-x: scroll; min-width:1300px">
                        <table class="table table-hover">
                            <thead class="sticky-top">
                                <tr class="table-dark">
                                    <th scope="col">S.No</th>
                                    <th scope="col">User Details</th>
                                    <th scope="col">Room Details</th>
                                    <th scope="col">Bookings</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_users">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ROOM ASSIGN MODAL -->
    <div class="modal fade" id="assign_room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ASSIN ROOM NUMBER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" onsubmit="assign_room();" id="assign_room_form" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3 ps-0">
                            <label for="room_number" class="form-label fw-bold">Room Number</label>
                            <input type="text" class="form-control" id="room_number" name="room_number">
                        </div>
                        <span class="badge rounded-pill text-bg-danger text-wrap lh-base mb-3">Note: Assign Room number when user has been arrived.</span>

                        <input type="hidden" name="booking_id" id="booking_id" value="">


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn text-white custom-bg shadow-none" id="sub_member_add"
                            name="sub_member_add" data-bs-dismiss="modal">SUBMIT</button>
                        <button type="reset" id="cancel_member_add" class="btn btn-danger text-white"
                            data-bs-dismiss="modal">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="inc/carousel.js"></script>

    <script src="inc/booking_records.js"></script>
</body>

</html>