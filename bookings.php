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
    if($settings['shutdown'] != true){
        redirect('rooms.php');
    }
    // $id = $_GET['id'];
    // $room_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `rooms` WHERE `id` = $id"));

    // $_SESSION['room_data']=[
    //     'id' => $room_data['id'],
    //     'name' => $room_data['name'],
    //     'price' => $room_data['price'],
    //     'payment' => null,
    //     'available' => false,
    // ];
    
    $user_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `user_cred` WHERE `id` = $_SESSION[u_id]"));
    $user_id = isset($_SESSION['u_id']) ? intval($_SESSION['u_id']) : 0;



    ?>

    <div class="container-fluid">
        <div class="row mt-3">
            <div id="user_alert" style="position: fixed; top: 80px; right: 25px;"></div>
            <div class="col-lg-12 my-3 px-4">
                <div class="row">

                    <div class="col-lg-12 px-4 mb-5">
                        <h3 class="fw-bold text-center">All Bookings</h3>
                        <hr>
                    </div>
                    <?php 
                     $sql = mysqli_query($conn, "SELECT bo.*, bd.* FROM `booking_order` bo 
                                                 INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
                                                 WHERE ((bo.booking_status='active')
                                                 OR (bo.booking_status='cancelled'))
                                                 AND (bo.user_id=$user_id) 
                                                 ORDER BY bo.booking_id DESC");
                    
                                                 
                    ?>
                    <?php 
                        while($data = mysqli_fetch_assoc($sql)){
                            $date_time  = date('d-m-Y', strtotime($data['date_time']));
                            $check_in   = date('d-m-Y', strtotime($data['check_in']));
                            $check_out  = date('d-m-Y', strtotime($data['check_out']));
                            
                            if($data['booking_status'] == 'active'){
                                $status_bg = "bg-success";
                                if($data['arrival'] == 1){
                                    $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn bg-dark text-white mb-2'><i class='bi bi-check-lg'></i> PDF</a>";
                                    if($data['rate_review'] == 1){
                                        $btn .= " <button type='button' onclick='review_rate($data[booking_id], $data[user_id], $data[room_id])' class='btn bg-dark text-white mb-2' data-bs-toggle='modal' data-bs-target='#review_modal'>
                                            <i class='bi bi-star-fill'></i> Rate & Review
                                        </button>";                                        
                                    }
                                }
                                else{
                                    $btn = "<button type='button' class='btn btn-danger mb-2' onclick='cancel_booking($data[booking_id])''>
                                        Cancel
                                    </button>";      
                                }
                            }

                            else if($data['booking_status'] == 'cancelled'){
                                $status_bg = "bg-danger";
                                
                                if($data['refund'] == 0){
                                    $btn = "<span class='badge bg-primary'>Refund in process</span> ";
                                }else{
                                    $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn bg-dark text-white mb-2'><i class='bi bi-check-lg'></i> PDF</a>";
                                }
                            }

                            else{
                                $status_bg = "bg-warning";
                                $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn bg-dark text-white mb-2'><i class='bi bi-check-lg'></i> PDF</a>";
                            } 
                    ?>
                    <div class="col-md-4 px-4 mb-4">
                        <div class="card mb-4 shadow border-0 rounded-3">
                            <div class="bg-white p-5 rounded shadow-sm">
                                <h5 class="fw-bold"><?=$data['room_name']?></h5>
                                <p>Pkr <?=$data['price']?></p>
                                <p>
                                    <b>Check In: </b><?=$check_in?> <br>
                                    <b>Check Out: </b><?=$check_out?><br>
                                </p>
                                <b>Amount: </b>Pkr <?=$data['price']?><br>
                                <b>Order ID: </b><?=$data['order_id']?><br>
                                <b>Date: </b><?=$date_time?><br>
                                </p>

                                <p>
                                    <span class="badge <?=$status_bg?>"><?=$data['booking_status']?></span>
                                </p>
                                <?=$btn?>

                            </div>
                        </div>
                    </div>

                    <?php } ?>

                </div>


                <!-- REVIEWS MODAL -->
                <div class="modal fade" id="review_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form onsubmit="submit_rating()" id="ratings_reviews">
                                <div class="modal-header d-flex align-items-center">
                                    <i class="bi bi-person-circle fs-3 me-2"></i>
                                    <h1 class="modal-title fs-5">Ratings</h1>
                                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="rating" class="form-label">Ratings</label>
                                        <select class="form-select" aria-label="Default select example" name="ratings">
                                            <option value="1">★☆☆☆☆ (1 Star)</option>
                                            <option value="2">★★☆☆☆ (2 Stars)</option>
                                            <option value="3">★★★☆☆ (3 Stars)</option>
                                            <option value="4">★★★★☆ (4 Stars)</option>
                                            <option selected value="5">★★★★★ (5 Stars)</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <div class="col-md-12 mb-3 ps-0 ">
                                            <label for="review" class="form-label">Reviews</label>
                                            <textarea required="" class="form-control" row="4" name="review"
                                                id="review"></textarea>
                                        </div>
                                    </div>

                                    <input type="hidden" id="booking_id" name="booking_id">
                                    <input type="hidden" id="user_id" name="user_id">
                                    <input type="hidden" id="room_id" name="room_id">

                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-outline-dark btn-dark shadow-none me-2 me-lg-3 text-light"
                                            data-bs-dismiss="modal">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

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
            success: function(response) {
                // console.log(response);
                $('#user_alert').html(response);
                setTimeout(() => {
                    $('#alert_custom').fadeOut();
                    if (confirm('Are you sure about booking ?')) {
                        window.location.href = 'receipt.php';

                    }
                }, 2000);
            },
            error: function(error) {
                console.log("error : " + error);
            }
        })


    }


    // FOR FILLING TH EINPUT FIELDS OF THE FORM
    function review_rate(booking_id, user_id, room_id) {
        $('#booking_id').val(booking_id);
        $('#user_id').val(user_id);
        $('#room_id').val(room_id);
    }

    // FOR SUBMITING THE RATING 
    function submit_rating() {
        event.preventDefault();
        ratings = new FormData($('#ratings_reviews')[0]);
        ratings.append('rating', '');

        $.ajax({
            url: 'inc/ajax/ratings.php',
            type: 'POST',
            data: ratings,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                $('#user_alert').html(response);
                $('#review').val('');
                // redirect('booking.php');

                setTimeout(() => {
                    $('#alert_custom').fadeOut();
                }, 2000);
            },
            error: function(error) {
                console.log("error : " + error);
            }
        })


    }

    function cancel_booking(id) {
        formData = new FormData();
        formData.append('id', id);
        formData.append('del', '');
        if (confirm('Are you sure about cancelling booking ?')) {
            $.ajax({
                url: 'inc/ajax/confirmbooking.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#user_alert').html(response);
                    setTimeout(() => {
                        $('#alert_custom').fadeOut();
                        window.location.href = 'bookings.php';
                    }, 2000);
                },
                error: function(error) {
                    console.log("error : " + error);
                }
            })
        }
    }

    </script>

</body>

</html>