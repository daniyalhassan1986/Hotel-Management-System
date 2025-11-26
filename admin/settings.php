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
            <h5>Settings</h5>

            <!-- GENERAL SETTINGS SECTION -->
            <div class="card">
                <?php 
                $sql = "SELECT * FROM settings WHERE id = 1";
                $rest = mysqli_query($conn, $sql);
                $result = mysqli_fetch_assoc($rest);
                ?>
                <div class="card-body shadow">
                    <div class="mb-3 d-flex justify-content-between">
                        <h5 class="card-title">General Settings</h5>
                        <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal"
                            data-bs-target="#general_setting"> EDIT <i class="ms-1 bi bi-pencil-square"></i> </button>

                    </div>
                    <h6 class="card-subtitle mb-2 fw-bold">Site Title</h6>
                    <p class="card-text"><?php echo $result['site_name'] ?></p>
                    <h6 class="card-subtitle mb-2 fw-bold">Site About</h6>
                    <p class="card-text"><?php echo $result['site_about'] ?></p>
                </div>
            </div>

            <!-- GENERAL SETTINGS MODAL -->
            <div class="modal fade" id="general_setting" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT HOTEL INFO</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" onclick="event.preventDefault()" id="general_settings">
                            <?php  
                            $sql_form = "SELECT * FROM settings";
                            $rest_form = mysqli_query($conn, $sql_form);
                            $result = mysqli_fetch_assoc($rest_form);
                            ?>
                            <div class="modal-body">
                                <input type="hidden" class="form-control" id="site_id" name="site_id"
                                    value="<?php echo $result['id'] ?>">
                                <div class="mb-3 ps-0">
                                    <label for="name" class="form-label fw-bold">Name</label>
                                    <input type="text" class="form-control" id="site_title" name="site_title"
                                        value="<?php echo $result['site_name']?>">
                                </div>
                                <div class="mb-3 ps-0 mb-3">
                                    <label for="address" class="form-label fw-bold">Address</label>
                                    <textarea class="form-control" row="3" id="site_about" name="site_about"
                                        style="resize: none; height: 7rem;"><?php echo $result['site_about'] ?></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn text-white custom-bg shadow-none"
                                    id="sub_general_settings" name="sub_general_settings">SUBMIT</button>
                                <button type="button" id="cancel_general" class="btn btn-danger text-white"
                                    data-bs-dismiss="modal">CANCEL</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- SHUTDOWN WEBSITE SECTION -->
            <div class="card mt-4">
                <div class="card-body shadow">
                    <?php
                    $shutdown = "";
                    if($result['shutdown'] == 0){
                        $shutdown = "checked";
                    }else{
                        $shutdown = " ";
                    }
                    ?>
                    <div class="mb-3 d-flex justify-content-between">
                        <h5 class="card-title">Shutdown Website</h5>
                        <form method="POST" onclick="">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="switch_mode"
                                    value="<?php echo $result['shutdown'] ?>" name="switch_mode"
                                    <?php echo $shutdown ?>>
                                <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                            </div>
                        </form>
                    </div>
                    <p class="card-text">No customers would be allowed to book the hotel rooms when shutdown mode is on
                    </p>
                </div>
            </div>

            <!-- CONTACT SECTION -->
            <div class="card mt-4">
                <div class="card-body shadow">
                    <?php
                    $sql_contact        = "SELECT * FROM `contact_details` WHERE id = '1'";
                    $rest_contact       = mysqli_query($conn, $sql_contact);
                    $result_contact     = mysqli_fetch_assoc($rest_contact);
                    ?>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between my-2">
                            <h5 class="card-title">Contact Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal"
                                data-bs-target="#contact_setting">
                                EDIT
                                <i class="ms-1 bi bi-pencil-square"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <h6 class="my-3">Address</h6>
                                <div class="mb-4">
                                    <p class="border rounded p-2 shadow-none text-start" id="site_address"
                                        name="site_address">
                                        <?php echo $result_contact['address'] ?>
                                    </p>

                                </div>
                                <!-- PHONE -->
                                <h6>Phone Numbers</h6>
                                <div class="mb-2">
                                    <i class="bi bi-telephone-fill"></i>
                                    <input type="number" class="border-0" id="p1" name="p1"
                                        value="<?php echo $result_contact['pn1'] ?>">
                                </div>
                                <div class="mb-4">
                                    <i class="bi bi-telephone-fill"></i>
                                    <input readonly type="number" class="border-0" id="p2" name="p2"
                                        value="<?php echo $result_contact['pn2'] ?>">
                                </div>
                                <!-- EMAIL -->
                                <div class="mb-3">
                                    <h6>Email</h6>
                                    <input readonly type="email" class="border-0" id="email" name="email"
                                        value="<?php echo $result_contact['email'] ?>">
                                </div>

                            </div>

                            <div class="col-lg-6 col-12">
                                <h6>Social Links</h6>
                                <a class="text-decoration-none text-dark" href="<?php echo $result_contact['tw'] ?>"
                                    target="_blank">
                                    <i class="bi bi-twitter p-2"></i>
                                    <span>twitter</span>
                                </a>
                                <br>
                                <a class="text-decoration-none text-dark" href="<?php echo $result_contact['fb'] ?>"
                                    target="_blank">
                                    <i class="bi bi-facebook p-2"></i>
                                    <span>facebook</span>
                                </a>
                                <br>
                                <a class="text-decoration-none text-dark" href="<?php echo $result_contact['insta'] ?>"
                                    target="_blank">
                                    <i class="bi bi-instagram p-2"></i>
                                    <span>instagram</span>
                                </a>
                                <br>
                                <a class="text-decoration-none text-dark" href="<?php echo $result_contact['tiktok'] ?>"
                                    target="_blank">
                                    <i class="bi bi-tiktok p-2"></i>
                                    <span>tiktok</span>
                                </a>
                                <br>

                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3319.384039017896!2d73.06227717479744!3d33.69901023630111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfbf0030d552ed%3A0xdcaeb37156ebcb1e!2sHotel%20The%20Oriel%20Islamabad!5e0!3m2!1sen!2s!4v1729786316255!5m2!1sen!2s"
                                    class="w-100 rounded border-4 bg-white mt-3" height="230px" style="border:0;"
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTACT SECTION EDIT MODAL -->
            <div class="modal fade" id="contact_setting" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT CONTACT DETAILS</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form method="POST" onclick="event.preventDefault()" id="contact_settings">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Address</label>
                                            <input type="text" class="form-control" name="contact_address"
                                                id="contact_address" value="<?php echo $result_contact['address'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Phone Number 1</label>
                                            <input type="text" class="form-control mb-3" id="pn1" name="pn1"
                                                value="<?php echo $result_contact['pn1'] ?>">
                                            <label for="" class="form-label">Phone Number 2</label>
                                            <input type="text" class="form-control mb-3" id="pn2" name="pn2"
                                                value="<?php echo $result_contact['pn2'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Email</label>
                                            <input type="email" class="form-control mb-2" id="contact_email"
                                                name="contact_email" value="<?php echo $result_contact['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Twitter</label>
                                            <input type="email" class="form-control mb-2" id="contact_twitter"
                                                name="contact_twitter" value="<?php echo $result_contact['tw'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Facebook</label>
                                            <input type="email" class="form-control mb-2" id="contact_fb"
                                                name="contact_fb" value="<?php echo $result_contact['fb'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Instagram</label>
                                            <input type="email" class="form-control mb-2" id="contact_insta"
                                                name="contact_insta" value="<?php echo $result_contact['insta'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">TikTok</label>
                                            <input type="email" class="form-control mb-2" id="contact_tiktok"
                                                name="contact_tiktok" value="<?php echo $result_contact['tiktok'] ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">iframe Link</label>
                                            <textarea class="form-control" row="3" id="site_iframe" name="site_iframe"
                                                style="resize: none; height: 7rem;">
                                                <?php echo $result_contact['iframe'] ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn text-white custom-bg shadow-none"
                                    id="sub_contact_settings" name="sub_contact_settings">SUBMIT</button>
                                <button type="button" class="btn btn-danger text-white" id="cancel_contact"
                                    data-bs-dismiss="modal">CANCEL</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- MANAGEMENT TEAM SECTION -->
            <div class="card mt-4">
                <div class="card-body shadow">
                    <div class="mb-3 d-flex justify-content-between">
                        <h5 class="card-title mt-3">Management Team</h5>
                        <div id="test"></div>
                        <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal"
                            data-bs-target="#team_add"> ADD <i class="ms-1 bi bi-plus-square"></i>
                        </button>
                    </div>

                </div>
            </div>

            <div class="row" id="team-data">
                <!-- <div class="col-md-2 mb-3 my-3" id="team-data-data">
                    <div class="card text-bg-dark">
                        <img src="../images/about/about.jpg" class="card-img">
                        <div class="card-img-overlay text-end">
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </div>
                        <p class="card-text text-center px-3 py-2">Name</p>
                    </div>
                </div> -->
            </div>


            <!-- MANAGEMENT TEAM MODAL -->
            <div class="modal fade" id="team_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">ADD TEAM MEMBER</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form method="POST" onsubmit="event.preventDefault();" id="member_add"
                            enctype="multipart/form-data">

                            <div class="modal-body">
                                <div class="mb-3 ps-0">
                                    <label for="member_name" class="form-label fw-bold">Name</label>
                                    <input type="text" class="form-control" id="member_name" name="member_name">
                                </div>
                                <div class="mb-3 ps-0">
                                    <label for="member_img" class="form-label fw-bold">Picture</label>
                                    <input type="file" class="form-control" id="member_img" name="member_img"
                                        accept=".jpg, .png, .jpeg">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn text-white custom-bg shadow-none" id="sub_member_add"
                                    name="sub_member_add" data-bs-dismiss="modal">SUBMIT</button>
                                <button type="button" id="cancel_member_add" class="btn btn-danger text-white"
                                    data-bs-dismiss="modal">CANCEL</button>
                            </div>
                        </form>
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
    <script src="inc/settings.js"></script>
</body>

</html>