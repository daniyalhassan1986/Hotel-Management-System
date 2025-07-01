<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HBS - Rooms</title>
    <!-- LINKS -->
    <?php require('inc/links.php') ?>
</head>

<body>
    <!-- HEADER -->
    <?php require('inc/header.php'); ?>

    <!-- <div class="my-5 px-4">
        <h2 class="text-center fw-bold h-font">ROOMS</h2>
        <div class="h-line bg-dark"></div>
    </div> -->

    <div class="container-fluid">
        <div class="row mt-3">
            <!-- ROOMS FILTER -->
            <div class="col-lg-3">
                <nav class="navbar navbar-expand-lg bg-white rounded shadow mb-5 " id="filter-nav">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h5 class="my-3">FILTERS</h5>
                        <button class="navbar-toggler shadow-none mb-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterdropdown" aria-controls="filterdropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse flex-column align-items-stretch navbar-collapse" id="filterdropdown">

                            <!-- NOT USING FILTER OF CHECK IN AND CHECK OUT FOR AVAILABILITY -->

                            <!--
                            <div class="rounded bg-light p-3 border mb-3">
                                <h6 class="fw-semibold mt-2 mb-3">CHECK AVAILABILTY</h6>
                                <label for="chkin" class="form-label">Check In</label>
                                <input type="date" class="form-control" id="checkin">
                                <label for="chkout" class="form-label mt-2">Check Out</label>
                                <input type="date" class="form-control" id="checkout">
                            </div> 
                            -->
                     
                            <div class="rounded bg-light p-3 border mb-3">
                                <h6 class="fw-semibold mt-2 mb-3">GUESTS</h6>
                                <div class="d-flex mb-2">
                                    <div class="me-3">
                                        <label for="adult" class="form-label">Adults</label>
                                        <input type="number" class="form-control shadow-none me-1" oninput="filter()"
                                            id="adult">
                                    </div>
                                    <div class="">
                                        <label for="child" class="form-label">Childrens</label>
                                        <input type="number" class="form-control shadow-none me-1" oninput="filter()"
                                            id="child">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="filteration" class="col-lg-9">

                <?php
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
                    while($facilities = mysqli_fetch_assoc($facilities_data)){
                        $facilities_all .= '<span class="badge rounded-pill text-dark bg-light text-wrap">'.$facilities['name'].'</span>';                                
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
                    $book_now = '<a href="javascript:void(0)" onclick="checkLoginToBook('.$login.','.$room['id'].')" class="btn btn-sm text-white custom-bg shadow-none w-100 mb-2">BooK Now</a>';
                }
                ?>
                <div class="card mb-3 shadow">
                    <div class="row g-0">
                        <div class="col-lg-5 p-3">
                            <img src="images/rooms/<?=$thumbnail['image']?>" class="img-fluid rounded-start">
                        </div>
                        <div class="col-lg-4 px-3">
                            <div class="features my-3">
                                <h5 class="card-title"><?=$room['name']?></h5>
                                <span class="badge rounded-pill bg-light text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </span>

                                <h6 class="mb-1">Features</h6>
                                <?=$features_all;?>

                            </div>
                            <div class="facilties mb-3">
                                <h6 class="mb-1">Facilties</h6>
                                <?=$facilities_all?>
                            </div>
                            <div class="facilties mb-3">
                                <h6 class="mb-1">Guests</h6>
                                <span class="badge rounded-pill text-dark bg-light text-wrap"><?=$adult?> Adults</span>
                                <span class="badge rounded-pill text-dark bg-light text-wrap"><?=$children?>
                                    Childs</span>
                            </div>
                        </div>
                        <div class="col-lg-3 text-center m-auto p-3">
                            <h6 class="card-title mb-4 "><i><b>Pkr <?=$room['price']?>/- Per Night</b></i></h6>
                            <?=$book_now?>
                            <a href="room_details.php?id=<?=$room['id']?>"
                                class="btn btn-sm btn-outline-dark shadow-none w-100 ">More Details</a>
                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>
        </div>
    </div>


    <!-- FOOTER -->
    <?php require('inc/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="inc/rooms.js"></script>
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