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

    <?php
    if(!isset($_GET['id'])){
        redirect('rooms.php');
    }
    ?>

    <div class="container-fluid">
        <div class="row mt-3">

            <div class="col-lg-12 my-3 px-4">
                <?php
                $id = $_GET['id'];
                $result = mysqli_query($conn, "SELECT * FROM `rooms` WHERE `id` = $id");
                while($room = mysqli_fetch_assoc($result)){

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

                    $room_img = mysqli_query($conn, "SELECT * FROM `room_images` WHERE `thumb` = 0 AND `room_id` = " . (int)$room['id']);


                    if (mysqli_num_rows($sql) > 0) {
                        $thumbnail = mysqli_fetch_assoc($sql);
                    }else{
                        $thumbnail['image'] = 'thumbnail.jpg';
                    }
                ?>
                <?php
                $book_now = '';
                if($settings['shutdown'] != 0){ 
                    $login = 0;
                    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                        $login = 1;
                    }
                    $book_now = '<a  href="javascript:void(0)" onclick="checkLoginToBook('.$login.','.$room['id'].')" class="btn btn-sm text-white custom-bg shadow-none w-100 mb-2">Book Now </a>';
                }
                ?>
                <div class="row">

                    <div class="col-lg-12 px-4">
                        <h3 class="fw-bold"><?=$room['name']?></h3>
                    </div>

                    <div class="col-lg-7 col-md-12 px-4">
                        <div id="roomCarousel" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/rooms/<?=$thumbnail['image']?>" class="d-block w-100 rounded"
                                        alt="...">
                                </div>
                                <?php 
                             while($room_imgs = mysqli_fetch_assoc($room_img)){ ?>
                                <div class="carousel-item">
                                    <img src="images/rooms/<?=$room_imgs['image']?>" class="d-block w-100 rounded"
                                        alt="...">
                                </div>

                                <?php }?>

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12 px-4">
                        <div class="card mb-4 shadow-sm border-0 rounded-3">
                            <div class="card-body">
                                <h4 class="card-title mb-2 ">Pkr <?=$room['price']?>/- Per Night</h4>
                                <div class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <div class="features my-3">
                                    <h6 class="mb-1">Area</h6>
                                    <span class="badge rounded-pill text-dark bg-light text-wrap"><?=$room['area']?>
                                        sq.ft</span>
                                </div>
                                <div class="features my-3">
                                    <h6 class="mb-1">Features</h6>
                                    <?=$features_all;?>
                                </div>
                                <div class="facilties mb-3">
                                    <h6 class="mb-1">Facilties</h6>
                                    <?=$facilities_all?>
                                </div>
                                <div class="facilties mb-3">
                                    <h6 class="mb-1">Guests</h6>
                                    <span class="badge rounded-pill text-dark bg-light text-wrap"><?=$adult?>
                                        Adults</span>
                                    <span class="badge rounded-pill text-dark bg-light text-wrap"><?=$children?>
                                        Childs</span>
                                </div>
                                <?=$book_now?>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 px-4">
                        <h4 class="mb-0">Description</h4>
                        <hr>
                        <?=$room['descp']?>
                    </div>

                </div>
                <?php } ?>

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