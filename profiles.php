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
    if($settings['shutdown'] != true){
        redirect('rooms.php');
    }
    
    $user_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `user_cred` WHERE `id` = $_SESSION[u_id]"));
    $user_id = isset($_SESSION['u_id']) ? intval($_SESSION['u_id']) : 0;
    // echo $user_id;
    // die;



    ?>

    <div class="container-fluid">
        <div class="row mt-3">
            <div id="user_alert" style="position: fixed; top: 80px; right: 25px;"></div>
            <div class="col-lg-12 my-3 px-4">
                <div class="row">

                    <div class="col-lg-12 px-4 mb-2">
                        <h3 class="fw-bold text-center">Profile</h3>
                        <hr>
                    </div>
                    <?php 
                     $sql = mysqli_query($conn, "SELECT * FROM  `user_cred` WHERE `id`=$user_id LIMIT 1");
                     $data = mysqli_fetch_assoc($sql);

                    ?>
                    <div class="col-md-10 px-4 mb-4 container">
                        <div class="card mb-4 shadow border-0 rounded-3 ">
                            <div class="bg-white p-5 rounded shadow-sm">
                                <form enctype='multipart/form-data' onsubmit="editUser()">
                                    <div class="modal-header d-flex align-items-center mb-3">
                                        <i class="bi bi-person-lines-fill fs-3 me-2"></i>
                                        <h1 class="modal-title fs-5">User Information</h1>
                                        <div id="alert"></div>
                                    </div>


                                    <div class="container-fluid">
                                        <div class="row">

                                            <div class="col-md-6 mb-3 ps-0">
                                                <label for="edit_name" class="form-label">Name</label>
                                                <input required type="text" class="form-control" name="edit_name" id="edit_name"
                                                    value="<?=$data['name']?>">
                                            </div>

                                            <div class="col-md-6 mb-3 p-0 mb-3">
                                                <label for="edit_email" class="form-label">Email address</label>
                                                <input required type="email" class="form-control" name="edit_email"
                                                    id="edit_email" value="<?=$data['email']?>">
                                            </div>

                                            <div class="col-md-6 mb-3 ps-0 mb-3">
                                                <label for="edit_contact" class="form-label">Contact No.</label>
                                                <input required type="number" class="form-control" name="edit_contact"
                                                    id="edit_contact" value="<?=$data['contact']?>">
                                            </div>
                                            <div class="col-md-6 mb-3 ps-0 mb-3">
                                                <label for="edit_pincode" class="form-label">Pincode</label>
                                                <input required type="number" class="form-control" name="edit_pincode"
                                                    id="edit_pincode" value="<?=$data['pincode']?>">
                                            </div>

                                            <div class="col-md-12 mb-3 ps-0 ">
                                                <label for="edit_address" class="form-label">Address</label>
                                                <textarea required class="form-control" row="4" name="edit_address"
                                                    id="edit_address"><?=$data['address']?></textarea>
                                            </div>
                                            <input type="hidden" name="edit_id" id="edit_id" value="<?=$data['id']?>">
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-dark shadow-none">SAVE CHANGES</button>
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


    function editUser(){
        event.preventDefault();
        // console.log('he');
        // return
        formData = new FormData();
        formData.append('id', $('#edit_id').val());
        formData.append('name', $('#edit_name').val());
        formData.append('email', $('#edit_email').val());
        formData.append('contact', $('#edit_contact').val());
        formData.append('pincode', $('#edit_pincode').val());
        formData.append('address', $('#edit_address').val());
        formData.append('update_user', '');


        $.ajax({
            url: 'inc/ajax/login_register.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false, 
            success: function(response){
                $('#user_alert').html(response);
                setTimeout(() => {
                    $('#user_alert').html(' ');
                    window.location.href = 'logout.php'
                }, 2000);
            },
            error: function(error){
                console.log(error);
            }

        })
    }
    

    </script>

</body>

</html>