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
            <!-- USER SECTION -->
            <div class="card mt-4">
                <div class="card-body shadow">
                    <div class="mb-3 d-flex justify-content-between">
                        <h5 class="card-title mt-3">Reviews</h5>
                        <?php 
                        if(isset($seen_result)){
                            alert('marked as read', 'success');
                        }if(isset($del_result)){
                            alert('deleted', 'danger');
                        }if(isset($seen_all_result)){
                            alert('ALL MARKED AS READ', 'success');
                        }if(isset($del_all_result)){
                            alert('ALL DELETED', 'danger');
                        }
                        ?>
                        <div id="test_user">
                            <div class="text-end my-2 mx-5">
                                <!-- <a href="javascript:void(0)" onclick="seen_all('2')" class="btn btn-sm btn-success">
                                    READ ALL 
                                </a> -->
                                <a href="javascript:void(0)" onclick="del_all('2')" class="btn btn-sm btn-danger">
                                    DELETE ALL 
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="card mt-4">
                <div class="card-body shadow">
                    <div id="table-responsive-md" style="height: 400px; overflow-y: scroll;">
                        <table class="table table-hover">
                            <thead class="sticky-top">
                                <tr class="table-dark">
                                    <th scope="col">S.No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Room</th>
                                    <th scope="col">Ratings</th>
                                    <th scope="col">Reviews</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table">


                            </tbody>
                        </table>
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

    <script src="inc/reviews.js"></script>
</body>

</html>