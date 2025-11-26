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
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php require('../inc/links.php'); ?>
</head>

<body>
    <?php require('../inc/admin_header.php') ?>
    <div class="row">
        <div class="col-lg-10 col-md-12 col-sm-12 ms-auto overflow-hidden p-4" id="maincontent">
            <h3 class="ms-2">CAROUSEL</h3>
            <!-- CAROUSEL TEAM SECTION -->
            <div class="card mt-4">
                <div class="card-body shadow">
                    <div class="mb-3 d-flex justify-content-between">
                        <h5 class="card-title mt-3">Carousel Team</h5>
                        <div id="test_carousel"></div>
                        <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal"
                            data-bs-target="#carousel_s"> ADD <i class="ms-1 bi bi-plus-square"></i>
                        </button>
                    </div>

                </div>
            </div>

            <div class="row" id="carousel-data">
                
            </div>


            <!-- CAROUSEL TEAM MODAL -->
            <div class="modal fade" id="carousel_s" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">ADD TEAM MEMBER</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form method="POST" onsubmit="event.preventDefault();" id="carousel_add"
                            enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" value="1" id="testing">
                                <div class="mb-3 ps-0">
                                    <label for="carousel_img" class="form-label fw-bold">Picture</label>
                                    <input type="file" class="form-control" id="carousel_img" name="carousel_img"
                                        accept=".jpg, .png, .jpeg">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn text-white custom-bg shadow-none" id="sub_carousel_add"
                                    name="sub_carousel_add" data-bs-dismiss="modal">SUBMIT</button>
                                <button type="button" id="cancel_carousel_add" class="btn btn-danger text-white"
                                    data-bs-dismiss="modal">CANCEL</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="inc/carousel.js"></script>
</body>

</html>