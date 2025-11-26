<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HBS - FACILITIES</title>
    <!-- LINKS -->
    <?php require('inc/links.php') ?>
</head>

<body>
    <!-- HEADER -->
    <?php require('inc/header.php'); ?>

    <!-- OUR FACILITIES -->
    <div class="my-5 px-4">
        <h2 class="text-center fw-bold h-font">ABOUT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            <br>
            Est nemo aut corrupti odio possimus voluptas assumenda
        </p>
    </div>

    <div class="container">
        <div class="row mb-5 justify-content-between align-items-center">
            <div class="col-lg-6 col-sm-5 order-lg-1 order-2 mt-5">
                <h3>Lorem ipsum dolor</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit debitis veritatis quos quod. Modi
                    laboriosam adipisci beatae sint dignissimos recusandae delectus a repellat, accusantium nesciunt
                    officiis provident asperiores, doloribus magni.
                </p>
            </div>
            <div class="col-lg-5 col-sm-6 order-lg-2 order-1">
                <img src="images/about/about.jpg" alt="" class="w-100 rounded shadow">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-4 px-4">
                <div class="bg-white border-top border-5 border-dark rounded text-center px-0 py-4 box">
                    <img src="images/about/hotel.svg" alt="" width="70px">
                    <h4 class="mt-4">100+ ROOMS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4 px-4">
                <div class="bg-white border-top border-5 border-dark rounded text-center px-0 py-4 box">
                    <img src="images/about/customers.svg" alt="" width="70px">
                    <h4 class="mt-4">200+ CUSTOMERS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4 px-4">
                <div class="bg-white border-top border-5 border-dark rounded text-center px-0 py-4 box">
                    <img src="images/about/rating.svg" alt="" width="70px">
                    <h4 class="mt-4">150+ REVIEWS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4 px-4">
                <div class="bg-white border-top border-5 border-dark rounded text-center px-0 py-4 box">
                    <img src="images/about/staff.svg" alt="" width="70px">
                    <h4 class="mt-4">200+ STAFF</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div #swiperRef="" class="swiper mySwiper swiper-testimonials mb-5 mt-5">
            <div class="swiper-wrapper">
                <?php while($row = mysqli_fetch_assoc($team_details)){ ?>
                <div class="swiper-slide bg-white p-4 rounded">
                    <div class="profile d-flex align-items-center pt-2 pb-2">
                        <img src="<?=ABOUT_IMG_PATH.$row['picture']?>" alt="" height="100px">
                        <!-- <i class="bi bi-people fs-2"></i> -->
                        <h6 class="m-0 ms-2"><?=$row['name']?></h6>
                    </div>
                    <p></p>
                    <div class="rating text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                </div>
                <?php }?>
            </div>
            <!-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> -->
            <!-- <div class="swiper-pagination"></div> -->
        </div>
    </div>


    <!-- FOOTER -->
    <?php require('inc/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        centeredSlides: true,
        spaceBetween: 30,
        loop: true,
        grabCursor: true,
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        autoplay: {
            delay: 3500,
            disableOnInteraction: false
        }
    });

    var appendNumber = 4;
    var prependNumber = 1;
    document
        .querySelector(".prepend-2-slides")
        .addEventListener("click", function(e) {
            e.preventDefault();
            swiper.prependSlide([
                '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
                '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
            ]);
        });
    document
        .querySelector(".prepend-slide")
        .addEventListener("click", function(e) {
            e.preventDefault();
            swiper.prependSlide(
                '<div class="swiper-slide">Slide ' + --prependNumber + "</div>"
            );
        });
    document
        .querySelector(".append-slide")
        .addEventListener("click", function(e) {
            e.preventDefault();
            swiper.appendSlide(
                '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>"
            );
        });
    document
        .querySelector(".append-2-slides")
        .addEventListener("click", function(e) {
            e.preventDefault();
            swiper.appendSlide([
                '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
                '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
            ]);
        });
    </script>
</body>

</html>