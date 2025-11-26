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
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_users">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ROOM ADD AND EDIT MODAL -->
            <div class="modal fade" id="rooms_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">ADD ROOM</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" onsubmit="add_rooms();" id="add_room_form" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 ps-0">
                                            <label for="name" class="form-label fw-bold">Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                            <input type="hidden" class="form-control" id="id" name="id">
                                        </div>
                                        <div class="mb-3 ps-0">
                                            <label for="price" class="form-label fw-bold">Price</label>
                                            <input type="number" min="1" class="form-control" id="price" name="price">
                                        </div>
                                        <div class="mb-3 ps-0">
                                            <label for="adult" class="form-label fw-bold">Adult(Max.)</label>
                                            <input type="number" min="1" class="form-control" id="adult" name="adult">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3 ps-0">
                                            <label for="area" class="form-label fw-bold">area(Max.)</label>
                                            <input type="number" min="1" class="form-control" id="area" name="area">
                                        </div>
                                        <div class="mb-3 ps-0">
                                            <label for="quantity" class="form-label fw-bold">Quantity</label>
                                            <input type="number" min="1" class="form-control" id="quantity"
                                                name="quantity">
                                        </div>
                                        <div class="mb-3 ps-0">
                                            <label for="children" class="form-label fw-bold">Children(Max.)</label>
                                            <input type="number" min="1" class="form-control" id="children"
                                                name="children">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3 ps-0">
                                            <label for="descp" class="form-label fw-bold">Room Details</label>
                                            <textarea class="form-control" row="3" id="descp" name="descp"
                                                style="resize: none; height: 7rem;"></textarea>
                                        </div>
                                    </div>

                                    <!-- Features -->
                                    <div class="col-md-12">
                                        <div class="mb-3 ps-0">
                                            <label for="features" class="form-label fw-bold">Features</label>
                                            <div class="row">
                                                <?php while($feature = mysqli_fetch_assoc($features)){?>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <label>
                                                            <input class="form-check-input feature-checkbox"
                                                                type="checkbox" name="features"
                                                                value="<?=$feature['id']?>">
                                                            <?=$feature['name']?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Facilities -->
                                    <div class="col-md-12">
                                        <div class="mb-3 ps-0">
                                            <label for="facilities" class="form-label fw-bold">Facilities</label>
                                            <div class="row">
                                                <?php while($facilty = mysqli_fetch_assoc($facilities)){?>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <label>
                                                            <input class="form-check-input facility-checkbox"
                                                                type="checkbox" name="facility"
                                                                value="<?=$facilty['id']?>">
                                                            <?=$facilty['name']?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn text-white custom-bg shadow-none"
                                        id="sub_member_add" name="sub_member_add"
                                        data-bs-dismiss="modal">SUBMIT</button>
                                    <button type="reset" id="cancel_member_add" class="btn btn-danger text-white"
                                        data-bs-dismiss="modal">CANCEL</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


            <!-- ROOMS IMAGE MODAL -->
            <div class="modal fade modal-lg" id="room_images" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" onsubmit="add_rooms_images()" id="add_room_images"
                        enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Room Image</h1>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div id="alert-room-img"></div>
                                <div class="mb-1 p-2">
                                    <input type="file" class="form-control" id="room_img" name="room_img"
                                        accept=".jpg, .png, .jpeg">
                                    <input type="hidden" name="room_id" id="room_id">
                                </div>
                                <div class="p-2">
                                    <button type="submit" class="btn text-white custom-bg shadow-none"
                                        name="add_room_image">
                                        SUBMIT
                                    </button>
                                </div>

                                <div class="mb-3 p-2">
                                    <div id="table-responsive-md" style="height: 400px; overflow-y: scroll;">
                                        <table class="table table-hover">
                                            <thead class="sticky-top">
                                                <tr class="table-dark">
                                                    <th scope="col" width="60%" class="text-center">Image</th>
                                                    <th scope="col" class="text-center">Thumbnail</th>
                                                    <th scope="col" class="text-center">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="room_images_show">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- FEATURES TEAM MODAL -->
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

    <script src="inc/new_bookings.js"></script>
</body>

</html>