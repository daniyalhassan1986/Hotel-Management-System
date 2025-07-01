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
        <h2 class="text-center fw-bold h-font">CONTACT US</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container">
        <div class="row">
            <!-- ADDRESS -->
            <div class="col-lg-6 col-md-12 mb-5 px-4 order-lg-1 order-2">
                <div class="rounded shadow border-top border-4 bg-white p-4 mx-3">
                    <iframe src="<?=$contact['iframe']?>" class="w-100 rounded" height="290px" style="border:0;"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <h5 class="mt-3">Address</h5>
                    <a class="d-inline-block m-0 text-dark text-decoration-none mb-3 " href="<?=$contact['address']?>">
                        <i class="bi bi-geo-alt-fill"></i>
                        <?=$contact['address']?>
                    </a>
                    <h5>Call Us:</h5>
                    <?php if($contact['pn1']) {?>
                    <a href="<?=$contact['pn1']?>" class="d-inline-block text-decoration-none text-dark mb-2"><i
                            class="bi bi-telephone-fill"></i> +<?=$contact['pn1']?></a>
                    <?php }?>

                    <?php if($contact['pn2']) {?>
                    <br>
                    <a href="<?=$contact['pn2']?>" class="d-inline-block text-decoration-none text-dark mb-3">
                        <i class="bi bi-telephone-fill"></i> +<?=$contact['pn2']?></a>
                    <?php }?>

                    <h5>Email Us:</h5>
                    <a href="mailto:demo@gmail.com" class="d-inline-block text-decoration-none text-dark mb-3">
                        <i class="bi bi-envelope-fill"></i> Hote Management Team
                    </a>

                    <h5>Follow Us On</h5>
                    <?php if($contact['tw']){?>
                    <a href="<?=$contact['tw']?>" target="_blank"
                        class="d-inline-block badge rounded text-decoration-none fs-5 mb-2 text-dark bg-light">
                        <i class="bi bi-twitter p-2"></i>
                    </a>
                    <?php }?>
                    <?php if($contact['fb']){?>
                    <a href="$contact['fb']" target="_blank"
                        class="d-inline-block badge rounded text-decoration-none fs-5 mb-2 text-dark bg-light">
                        <i class="bi bi-facebook p-2"></i>
                    </a>
                    <?php }?>
                    <?php if($contact['insta']){?>
                    <a href="<?=$contact['insta']?>" target="_blank"
                        class="d-inline-block badge rounded text-decoration-none fs-5 mb-2 text-dark bg-light">
                        <i class="bi bi-instagram p-2"></i>
                    </a>
                    <?php }?>
                    <?php if($contact['tiktok']){?>
                    <a href="<?=$contact['tiktok']?>" target="_blank"
                        class="d-inline-block badge rounded text-decoration-none fs-5 mb-2 text-dark bg-light">
                        <i class="bi bi-tiktok p-2"></i>
                    </a>
                    <?php }?>
                </div>
            </div>
            <!-- CONTACT FORM -->
            <div class="col-lg-6 col-md-12 mb-5 px-4 order-lg-2 order-1">
                <div class="rounded shadow bg-white p-4 mx-3">
                    <h5>Send Message</h5>
                    <div id="alert_id"> </div>
                    <form method="POST" onsubmit="contact_form()" id="contact_form">
                        <div class="mt-3 ps-0">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input required name="name" type="text" class="form-control" id="contact_name">
                        </div>
                        <div class="mt-3 ps-0">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input required name="email" type="text" class="form-control" id="contact_email">
                        </div>
                        <div class="mt-3 ps-0">
                            <label for="subject" class="form-label fw-semibold">Subject</label>
                            <input required name="subject" type="text" class="form-control" id="contact_subject">
                        </div>
                        <div class="mt-3 ps-0 mb-3">
                            <label for="message" class="form-label fw-semibold">Message</label>
                            <textarea class="form-control" row="5" id="contact_message" name="message"
                                style="resize: none;"></textarea>
                        </div>
                        <button name="submit" class="btn shadow-none fw-semibold custom-bg text-white">SEND</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php require('inc/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
    function contact_form() {
        event.preventDefault();
        var formdata = new FormData();
        formdata.append("name", $('#contact_name').val());
        formdata.append("email", $('#contact_email').val());
        formdata.append("subject", $('#contact_subject').val());
        formdata.append("message", $('#contact_message').val());
        formdata.append("query", '');

        $.ajax({
            url: 'inc/ajax/contact.php',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            success: function(e) {
                console.log(e);
                $('#alert_id').html(e);
                setTimeout(() => {
                    $('#alert_custom').fadeOut();
                }, 2000);
                $('#contact_form')[0].reset();
            },
            error: function(e) {
                console.log('error'+e);
            }
        })

    }
    </script>

</body>

</html>