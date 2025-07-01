<?php 
require('admin/essentials.php');
require('inc/connect.php');
date_default_timezone_set('Asia/Karachi');

session_start();


$sql            = "SELECT * FROM `contact_details` WHERE id = 1";
$contact        = mysqli_fetch_assoc(mysqli_query($conn, $sql));

$sql            = "SELECT * FROM `settings` WHERE id = 1";
$settings       = mysqli_fetch_assoc(mysqli_query($conn, $sql));

$sql            = "SELECT * FROM `team_details`";
$team_details   = mysqli_query($conn, $sql);

$sql            = "SELECT * FROM `carousel`";
$carousel       = mysqli_query($conn, $sql);

$sql            = "SELECT * FROM `facilities`";
$facilities     = mysqli_query($conn, $sql);

$sql            = "SELECT * FROM `rooms` WHERE `status` = 1";
$rooms          = mysqli_query($conn, $sql);


$sql            = "SELECT reviews.id, reviews.rating, reviews.review, reviews.date_time, 
                    user_cred.name AS user_name, user_cred.email AS user_email, 
                    rooms.name AS room_name, reviews.id AS ratings_id, 
                    user_cred.image AS user_image, user_cred.is_verified
                    FROM reviews 
                    INNER JOIN user_cred ON reviews.user_id = user_cred.id 
                    INNER JOIN rooms ON reviews.room_id = rooms.id 
                    ORDER BY reviews.id DESC";

$testimonials   = mysqli_query($conn, $sql);


// $sql            = "";
// $facilities_join= mysqli_query($conn, $sql);


if($settings['shutdown'] != 1){ ?>
<div class="text-center bg-danger text-light p-2">
    <i class="bi bi-exclamation-triangle-fill"> <b>BOOKINGS ARE UNAVAIBALE AT THE TIME</b></i>
</div>
<!-- <div class="login_form bg-white rounded">
    <form method="POST">
        <h1 class="text-center bg-dark text-white p-3 rounded"><i><?=$settings['site_name']?></i></h2>
            <div class="p-3 rounded">
                <h4 class="text-center">Website closed due</h4>
                <h4 class="text-center">to some issues</h4>
                <div class="d-flex justify-content-center ">
                </div>
            </div>
    </form>
</div> -->
<?php 
// die;
}
?>


<!-- NAVBAR -->
<nav class="navbar navbar-light bg-white navbar-expand-lg bg-body-light px-lg-3 py-lg-2 shadow-sm sticky-top"
    id="nav-bar">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?=$settings['site_name']?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link me-2" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="rooms.php">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="facilities.php">Facilties</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="contact.php">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="about.php">About Us</a>
                </li>
            </ul>


            <?php 
            if(isset($_SESSION['login']) && $_SESSION['login'] == true){ ?>
            <div class="btn-group">
                <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown"
                    data-bs-display="static" aria-expanded="false">
                    <img src="<?=USER_IMG_PATH.$_SESSION['u_image']?>" alt="" width="50px">
                    <?=$_SESSION['u_name']?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                    <li><a class="dropdown-item" href="profiles.php">Profiles</a></li>
                    <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
            <?php }else{ ?>

            <div class="d-flex">
                <!-- Button trigger LOGIN modal -->
                <button type="button" class="btn btn-outline-dark shadow-none me-2 me-lg-3" data-bs-toggle="modal"
                    data-bs-target="#login">
                    LOGIN
                </button>

                <!-- Button trigger REGISTER modal -->
                <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal"
                    data-bs-target="#register" onclick="reset_register()">
                    REGISTER
                </button>
            </div>
            <?php }?>

            <div id="user_alert" style="position: fixed; top: 80px; right: 25px;"></div>
        </div>
    </div>
</nav>

<!-- LOGIN MODAL -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="login_user" onsubmit="loginUser()">
                <div class="modal-header d-flex align-items-center">
                    <i class="bi bi-person-circle fs-3 me-2"></i>
                    <h1 class="modal-title fs-5">User Login</h1>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Email / Mobile</label>
                        <input type="email" name="emailmob" class="form-control" id="emailmob">
                    </div>

                    <div class="mb-3">
                        <label for="logpass" class="form-label">Password</label>
                        <input type="password" name="loginpass" class="form-control" id="loginpass">
                        <input type="hidden" name="login" id="login">
                    </div>

                    <div class="text-end">
                        <button class="btn btn-dark shadow-none me-2 me-lg-3" data-bs-dismiss="modal">LOGIN</button>
                        <button type="button" class="btn btn-outline-dark shadow-none me-2 me-lg-3"
                            data-bs-toggle="modal" data-bs-target="#forgot_user" data-bs-dismiss="modal">Forgot Password
                            ?</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- FORGOT MODAL -->
<div class="modal fade" id="forgot_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="forgot_user" onsubmit="forgotPassword()">
                <div class="modal-header d-flex align-items-center">
                    <i class="bi bi-person-circle fs-3 me-2"></i>
                    <h1 class="modal-title fs-5">User Login</h1>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <span class="badge rounded-pill text-bg-secondary text-wrap lh-base mb-3">Note: A LINK WILL BE
                            SENT TO YOUR EMAIL FOR PASSWORD RESET.</span>
                    </div>
                    <div class="mb-3">
                        <label for="forgotemail" class="form-label">Email</label>
                        <input type="email" name="forgotemail" class="form-control" id="forgotemail">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-dark btn-dark shadow-none me-2 me-lg-3 text-light"
                            data-bs-dismiss="modal">SEND LINK</button>

                        <button type="button" class="btn btn-outline-dark shadow-none me-2 me-lg-3"
                            data-bs-toggle="modal" data-bs-target="#login" data-bs-dismiss="modal">CANCEL</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- REGISTER MODAL -->
<div class="modal fade" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form enctype='multipart/form-data' onsubmit="registerUser()" id="register_form">
                <div class="modal-header d-flex align-items-center">
                    <i class="bi bi-person-lines-fill fs-3 me-2"></i>
                    <h1 class="modal-title fs-5">User Registeration</h1>
                    <div id="alert"></div>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <span class="badge rounded-pill text-bg-danger text-wrap lh-base mb-3">Note: All your details
                        such as CNIC, Name, Address, Contact, Email etc must be accurate and must match at check
                        in.</span>

                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-6 mb-3 ps-0">
                                <label for="name" class="form-label">Name</label>
                                <input required type="text" class="form-control" name="name" id="name">
                            </div>

                            <div class="col-md-6 mb-3 p-0 mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input required type="email" class="form-control" name="email" id="email">
                            </div>

                            <div class="col-md-6 mb-3 ps-0 mb-3">
                                <label for="contact" class="form-label">Contact No.</label>
                                <input required type="number" class="form-control" name="contact" id="contact">
                            </div>

                            <div class="col-md-6 mb-3 ps-0 mb-3">
                                <label for="picture" class="form-label">Picture</label>
                                <input required type="file" class="form-control" name="image" id="image"
                                    accept=".jpg, .png, .jpeg">
                            </div>

                            <div class="col-md-6 mb-3 ps-0 mb-3">
                                <label for="pincode" class="form-label">Pin Code</label>
                                <input required type="number" class="form-control" name="pincode" id="pincode">
                            </div>

                            <div class="col-md-6 mb-3 ps-0 mb-3">
                                <label for="dob" class="form-label">Date Of Birth</label>
                                <input required type="date" class="form-control" name="dob" id="dob">
                            </div>

                            <div class="col-md-6 mb-3 ps-0 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input required type="password" class="form-control" name="password" id="password">
                            </div>

                            <div class="col-md-6 mb-3 ps-0 mb-3">
                                <label for="cpassword" class="form-label">Confirm Password</label>
                                <input required type="password" class="form-control" name="cpassword" id="cpassword">
                            </div>

                            <div class="col-md-12 mb-3 ps-0 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea required class="form-control" row="1" name="address" id="address"></textarea>
                            </div>
                            <input type="hidden" name="register" id="register" value="">
                        </div>
                        <div class="text-center">
                            <button class="btn btn-dark shadow-none">REGISTER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- FORGOT MODAL -->
<div class="modal fade" id="newpass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="newpass" onsubmit="newpassword()">
                <div class="modal-header d-flex align-items-center">
                    <i class="bi bi-person-circle fs-3 me-2"></i>
                    <h1 class="modal-title fs-5">User Login</h1>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <span class="badge rounded-pill text-bg-secondary text-wrap lh-base mb-3">Note: This will be
                            your new password.</span>
                    </div>
                    <div class="mb-3">
                        <label for="newpassenter" class="form-label">Password</label>
                        <input type="password" name="newpassenter" class="form-control" id="newpassenter">
                        <input type="hidden" name="resetemail" class="form-control" id="resetemail" 
                        <?php if(isset($_GET)){ echo "value='$_GET[email]'"; } ?>>
                        
                    </div>

                    <div class="mb-3">
                        <label for="cnewpassenter" class="form-label">Confirm Password</label>
                        <input type="password" name="cnewpassenter" class="form-control" id="cnewpassenter">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-dark btn-dark shadow-none me-2 me-lg-3 text-light"
                            data-bs-dismiss="modal">CONFIRM</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>