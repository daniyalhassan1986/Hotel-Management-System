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
    <title>Features</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php require('../inc/links.php'); ?>
</head>

<body>
    <?php require('../inc/admin_header.php') ?>
    <div class="row">
        <div class="col-lg-10 col-md-12 col-sm-12 ms-auto overflow-hidden p-4" id="maincontent">
            <h3 class="ms-2">USERS</h3>
            <!-- USER SECTION -->
            <div class="card mt-4">
                <div class="card-body shadow">
                    <div class="mb-3 d-flex justify-content-between">
                        <h5 class="card-title mt-3">Features</h5>
                        <div id="alert"></div>
                        <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal"
                            data-bs-target="#features_add"> ADD <i class="ms-1 bi bi-plus-square"></i>
                        </button>
                    </div>

                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body shadow">
                    <div id="table-responsive-md" style="height: 400px; overflow-y: scroll;">
                        <table class="table table-hover">
                            <thead class="sticky-top">
                                <tr class="table-dark">
                                    <th scope="col" width="30%">S.No</th>
                                    <th scope="col" width="50%">Name</th>
                                    <th scope="col" width="10%">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- FEATURES TEAM MODAL -->
            <div class="modal fade" id="features_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">ADD FEATURE</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form method="POST" onsubmit="add_features();" id="member_add"
                            enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3 ps-0">
                                    <label for="feature_name" class="form-label fw-bold">Name</label>
                                    <input type="text" class="form-control" id="feature_name" name="feature_name">
                                </div>
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

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="inc/carousel.js"></script>

    <script src="inc/features_facilities.js"></script>
</body>

</html>