<?php require('inc/connect.php') ?>

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


    <!-- SWIPER JS-->
    <div class="container-fluid px-lg-3 mt-3">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <?php foreach($carousel as $carousel){?>
                <div class="swiper-slide">
                    <img src="<?=CAROUSEL_IMG_PATH.$carousel['image']?>" class="w-100 d-block" />
                </div>
                <?php }?>
            </div>
        </div>
    </div>

    <!-- CHECK AVAILABILTY FORM -->
    <div class="container mt-2 shadow p-4 availability-form bg-white rounded border">
        <h5>Check Booking Availabilty</h5>
        <div class="row align-items-end">
            <div class="col-lg-3 mb-3">
                <label for="chkin" class="form-label">Check In</label>
                <input type="date" class="form-control" id="chkin">
            </div>
            <div class="col-lg-3 mb-3">
                <label for="chkout" class="form-label">Check Out</label>
                <input type="date" class="form-control" id="chkout">
            </div>
            <div class="col-lg-3 mb-3">
                <label for="" class="form-label">Adults</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-lg-2 mb-3">
                <label for="" class="form-label">Childrens</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-lg-1 mb-3">
                <button type="submit" class="btn text-white shadow-none custom-bg"
                    onclick="redirection()">Submit</button>
            </div>
        </div>
    </div>

    <!-- OUR ROOMS -->
    <h1 class="text-center pt-4 pb-3 fw-bold mt-5 mb-5 h-font">Our Rooms</h1>
    <div class="container">
        <div class="row">
            <?php
                $rooms = mysqli_query($conn, "SELECT * FROM rooms WHERE `status`=1 ORDER BY id DESC LIMIT 3");
                while($room = mysqli_fetch_assoc($rooms)){

                    $sql = "SELECT name FROM features 
                            INNER JOIN room_features
                            ON features.id = room_features.room_features 
                            WHERE room_features.room_id = '$room[id]'";
                    
                    $features_data     = mysqli_query($conn, $sql);
                    $features_all      = '';
                    while($features = mysqli_fetch_assoc($features_data)){
                        $features_all .= '<span class="badge rounded-pill text-dark bg-light text-wrap">
                        '.$features['name'].'</span>';                                     
                    }

                    $sql = "SELECT name FROM facilities 
                            INNER JOIN room_facilities
                            ON facilities.id = room_facilities.room_facilities 
                            WHERE room_facilities.room_id = '$room[id]'";
                    $facilities_data     = mysqli_query($conn, $sql);
                    $facilities_all = '';
                    while($faciliti = mysqli_fetch_assoc($facilities_data)){
                        $facilities_all .= '<span class="badge rounded-pill text-dark bg-light text-wrap">'.$faciliti['name'].'</span>';                                
                    } 
                    
                    $adult    = $room['adult'];
                    $children = $room['children'];

                    
                    $sql = mysqli_query($conn, "SELECT * FROM `room_images` WHERE `thumb` = 1 AND `room_id` = " . (int)$room['id']);

                    if (mysqli_num_rows($sql) > 0) {
                        $thumbnail = mysqli_fetch_assoc($sql);
                    }else{
                        $thumbnail['image'] = 'thumbnail.jpg';
                    }



                // echo $facilites_all;
            ?>

            <?php
            $book_now = '';
            if($settings['shutdown'] != 0){ 
                $login = 0;
                if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                    $login = 1;
                }
                $book_now = '<a href="javascript:void(0)" onclick="checkLoginToBook('.$login.','.$room['id'].')" class="btn btn-sm text-white custom-bg shadow-none">BooK Now</a>';
            }
            ?>

            <!-- ROOMS -->
            <div class="col-lg-4 col-sm-6">
                <div class="card shadow border-0" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/<?=$thumbnail['image']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?=$room['name']?></h5>
                        <h6 class="card-title mb-4">Pkr <?=$room['price']?>/- Per Night</h6>
                        <div class="features mb-3">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill text-dark bg-light text-wrap"><?=$features_all?></span>
                        </div>
                        <div class="facilties mb-3">
                            <h6 class="mb-1">Facilties</h6>
                            <span class="badge rounded-pill text-dark bg-light text-wrap">no </span>
                        </div>
                        <div class="facilties mb-3">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill text-dark bg-light text-wrap"><?=$room['adult']?>
                                Adults</span>
                            <span class="badge rounded-pill text-dark bg-light text-wrap"><?=$room['children']?>
                                Childs</span>
                        </div>
                        <div class="rating mb-3">
                            <h6 class="mb-1">Ratings</h6>
                            <span class="badge rounded-pill bg-light text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly">
                            <?=$book_now?>
                            <a href="rooms.php" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
        <div class="col-lg-12 text-center">
            <a href="rooms.php" class="btn btn-outline-dark btn-sm my-5 fw-bold shadow-none">More Rooms >>></a>
        </div>
    </div>

    <!-- OUR FACILITIES -->
    <h1 class="text-center pt-4 pb-3 fw-bold mt-5 mb-5 h-font">Our Facilties</h1>
    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-sm-0 px-5">
            <?php
            $facilities = mysqli_query($conn, "SELECT * FROM `facilities` LIMIT 5");
            while($facility = mysqli_fetch_assoc($facilities)){?>
            <div class="col-lg-2 col-sm-2 text-center bg-white rounded shadow py-4 m-3">
                <img src="images/facilities/<?=$facility['image']?>" alt="" width="50px">
                <h5 class="mt-3"><?=$facility['name']?></h5>
            </div>
            <?php }?>
            <div class="col-lg-12 col-sm-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-outline-dark btn-sm my-5 fw-bold shadow-none">More Facilties
                    >>></a>
            </div>
        </div>
    </div>

    <!-- TESTIMONIALS -->
    <h1 class="text-center pt-4 pb-3 fw-bold mt-5 mb-3 h-font">Testimonials</h1>
    <div class="container">
        <div class="swiper swiper-testimonials mb-5 mt-5">
            <div class="swiper-wrapper">
                <?php while($rate = mysqli_fetch_assoc($testimonials)){ ?>
                <div class="swiper-slide bg-white px-3 rounded">
                    <div class="profile d-flex align-items-center py-4">
                        <div class="rounded border border-3">
                            <img src="<?=USER_IMG_PATH.$rate['user_image']?>" width="50px" height="50px" alt="">
                        </div>
                        <h6 class="m-0 ms-2"><?=$rate['user_name']?></h6>
                    </div>
                    <p><?=$rate['review']?></p>
                    <div class="rating text-warning mb-3">
                        <?php
                        for ($i = 0; $i < $rate['rating']; $i++) {
                            echo '<i class="bi bi-star-fill text-warning"></i>';
                        }
                        ?>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
        <div class="col-lg-12 text-center">
            <a href="about.php" class="btn btn-outline-dark btn-sm my-5 fw-bold shadow-none">Read More >>></a>
        </div>
    </div>

    <!-- REACH US -->
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-8 col-sm-8 p-3 mb-lg-0 mb-3 bg-white rounded">
                <h4 class="text-center mb-3 mt-1">Our location</h4>
                <iframe src="<?=$contact['iframe']?>" class="w-100 rounded" height="290px" style="border:0;"
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div class="col-lg-4 col-sm-4 mb-lg-0 mb-3">
                <div class="rounded mb-4 bg-white rounded p-3">
                    <h5>Call Us:</h5>
                    <a href="tel:121212" class="d-inline-block text-decoration-none text-dark mb-2"><i
                            class="bi bi-telephone-fill"></i> +<?=$contact['pn1']?></a>
                    <br>
                    <?php if($contact['pn2'] != ''){ ?>
                    <a href="tel:+<?=$contact['pn2']?>" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-telephone-fill"></i> +<?=$contact['pn2']?>
                    </a>
                    <?php }?>
                </div>
                <div class="rounded mb-4 bg-white rounded p-3">
                    <h5>Follow us:</h5>
                    <?php if($contact['tiktok'] != '') {?>
                    <a href="<?=$contact['tiktok']?>" target="_blank"
                        class="d-inline-block badge rounded text-decoration-none fs-6 mb-2 text-dark bg-light">
                        <i class="bi bi-tiktok pe-2"></i>Tiktok
                    </a>
                    <?php }?>
                    <br>
                    <?php if($contact['tw'] != '') {?>
                    <a href="<?=$contact['tw']?>" target="_blank"
                        class="d-inline-block badge rounded text-decoration-none fs-6 mb-2 text-dark bg-light">
                        <i class="bi bi-twitter pe-2"></i>Twitter
                    </a>
                    <?php }?>
                    <br>
                    <?php if($contact['fb'] != '') {?>
                    <a href="<?=$contact['fb']?>" target="_blank"
                        class="d-inline-block badge rounded text-decoration-none fs-6 mb-2 text-dark bg-light">
                        <i class="bi bi-facebook pe-2"></i>Facebook
                    </a>
                    <?php }?>
                    <br>
                    <?php if($contact['insta'] != '') {?>
                    <a href="<?=$contact['insta']?>" target="_blank"
                        class="d-inline-block badge rounded text-decoration-none fs-6 mb-2 text-dark bg-light">
                        <i class="bi bi-instagram pe-2"></i>Instagram
                    </a>
                    <?php }?>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php require('inc/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
    var swiper = new Swiper(".swiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false
        }
    });

    var swiper = new Swiper(".swiper-testimonials", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "3",
        loop: true,
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            }
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });
    </script>

</body>

</html>