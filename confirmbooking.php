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
    // echo $settings['shutdown'];
    // die;
    if(!isset($_GET['id']) || $settings['shutdown'] != true){
        redirect('rooms.php');
    }
    $id = $_GET['id'];
    $room_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `rooms` WHERE `id` = $id"));

    $_SESSION['room_data']=[
        'id' => $room_data['id'],
        'name' => $room_data['name'],
        'price' => $room_data['price'],
        'payment' => null,
        'available' => false,
    ];
    
    $user_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `user_cred` WHERE `id` = $_SESSION[u_id]"));


    ?>

    <div class="container-fluid">
        <div class="row mt-3">
            <div id="user_alert" style="position: fixed; top: 80px; right: 25px;"></div>
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
                        <h3 class="fw-bold">Confirm Booking</h3>
                    </div>

                    <div class="col-lg-7 col-md-12 px-4">
                        <div class="card mb-4 shadow-sm border-0 rounded-3">
                            <div class="card-body">
                                <div class="carousel-item active">
                                    <img src="images/rooms/<?=$thumbnail['image']?>" class="d-block w-100 rounded"
                                        alt="...">
                                </div>
                            </div>

                            <div class="my-3 me-4 container">
                                <h4 class="card-title mb-2 ms-auto"><?=$room['name']?></h4>
                                <h4 class="card-title mb-2 ms-auto">Pkr <?=$room['price']?>/- Per Night</h4>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-5 col-md-12 px-4">
                        <div class="card mb-4 shadow-sm border-0 rounded-3">
                            <div class="card-body">
                                <form action="" id="booking_form" onsubmit="order()">
                                    <h5 class="mb-3">Booking Details</h5>
                                    <div class="row container-fluid">
                                        <div class="col-md-6 mb-3 ps-0">
                                            <label for="confirm_name" class="form-label">Name</label>
                                            <input required type="text" class="form-control" name="confirm_name"
                                                id="confirm_name" value="<?=$user_data['name']?>">
                                        </div>

                                        <div class="col-md-6 mb-3 p-0 mb-3">
                                            <label for="confirm_email" class="form-label">Email address</label>
                                            <input required type="email" class="form-control" name="confirm_email"
                                                id="confirm_email" value="<?=$user_data['email']?>">
                                        </div>

                                        <div class="col-md-12 mb-3 p-0 mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea required class="form-control" row="1" name="confirm_address"
                                                id="confirm_address"><?=$user_data['address']?></textarea>
                                        </div>

                                        <div class="col-md-6 mb-3 p-0 mb-3">
                                            <label for="checkin" class="form-label">Check In</label>
                                            <input required onchange="check_availability()" type="date"
                                                class="form-control" name="checkin" id="checkin"
                                                value="<?=date('Y-m-d')?>">
                                        </div>

                                        <div class="col-md-6 mb-3 p-0 mb-3">
                                            <label for="checkout" class="form-label">Check Out</label>
                                            <input required onchange="check_availability()" type="date"
                                                class="form-control" name="checkout" id="checkout"
                                                value="<?=date('Y-m-d')?>">
                                        </div>

                                        <div class=" col-md-6 mb-3 p-0">
                                            <div class="spinner-border text-success d-none" id="info_loader"
                                                role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12 p-0 text-danger mb-3">
                                            <h6 id="pay_info" class="">Provide valid check in and check out data! </h6>
                                            <h6 id="availability" class="text-success d-none">Room is available!
                                            </h6>
                                        </div>

                                        <button name="paynow" id="paynow"
                                            class="w-100 shadow-none btn custom-bg text-white d-none">
                                            Pay Now
                                        </button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 px-4 mt-5">
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

    let booking_form = $('#booking_form');
    let info_loader = $('#info_loader');
    let pay_info = $('#pay_info');
    let paynow = $('#paynow');
    let availability = $('#availability');

    // FOR CHECKING THE AVAILABILITY OF ROOMS (JS)
    function check_availability() {

        let check_in = $('#checkin').val();
        let check_out = $('#checkout').val();


        if (check_in != '' && check_out != '') {

            $.ajax({
                url: 'inc/ajax/confirmbooking.php',
                type: 'POST',
                data: {
                    check_in,
                    check_out
                },
                success: function(response) {

                    data = JSON.parse(response);
                    try {
                        info_loader.removeClass('d-none');


                        if (data.status != '') {
                            if (data.status && data.status > 0) {
                                console.log(data.payment);
                                console.log(data.status);

                                setTimeout(() => {
                                    info_loader.addClass('d-none');
                                    pay_info.addClass('d-none');
                                    availability.removeClass('d-none');
                                    paynow.removeClass('d-none');
                                    availability.html('No of days: ' + data.count_days +
                                        '<br>Total amount to pay: ' + data.payment);
                                }, 200);


                            } else {
                                console.log('Room not available');
                                $('#paynow').attr('disabled', true);
                                info_loader.addClass('d-none');
                                pay_info.html('Room not available');

                            }
                        } else {
                            console.log(data);
                            availability.addClass('d-none');
                            pay_info.removeClass('d-none');

                            setTimeout(() => {
                                info_loader.addClass('d-none');
                                pay_info.html(data.alert);
                                paynow.addClass('d-none');
                            }, 200);


                        }
                    } catch (error) {
                        console.error("Error parsing JSON:", error, response);
                    }

                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

    }


    function order() {
        event.preventDefault();
        orderData = new FormData($('#booking_form')[0]);
        orderData.append('pay_now', '');

        $.ajax({
            url: 'inc/ajax/payment.php',
            type: 'POST',
            data: orderData,
            contentType: false, 
            processData: false,
            success: function(response){
                // console.log(response);
                $('#user_alert').html(response);
                setTimeout(() => {
                    $('#alert_custom').fadeOut();
                    if(confirm('Are you sure about booking ?')){
                        window.location.href = 'receipt.php';                

                    }
                }, 2000);
            },
            error: function(error){
                console.log("error : "+error);
            }
        })
        

    }
    </script>

</body>

</html>