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
        <h2 class="text-center fw-bold h-font">OUR FACILITIES</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            <br>
            Est nemo aut corrupti odio possimus voluptas assumenda
        </p>
    </div>

    <div class="container">
        <div class="row">
            <?php while($facilty = mysqli_fetch_assoc($facilities)){?>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="rounded pt-3 pb-1 shadow border-top border-4 border-dark bg-white py-4 px-4 pop mx-3">
                    <div class="d-flex align-items-center mb-3">
                        <img src="images/facilities/<?=$facilty['image']?>" class="m-0 fw-light" alt="" width="50px">
                        <h5 class="m-0 ms-3"><?=$facilty['name']?></h5>
                    </div>
                    <p>
                        <?=$facilty['descp']?>
                    </p>
                </div>
            </div>
            <?php }?>
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