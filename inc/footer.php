<div class="text-dark bg-white p-5 border-top border-dark" id="footer">
    <div class="row">
        <div class="col-lg-4 col-sm-4 ">
            <h3 class="h-font"><?=$settings['site_name']?></h3>
            <p><?=$settings['site_about']?></p>
        </div>
        <div class="col-lg-4 col-sm-4">
            <h5>Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-decoration-none text-dark">Home</a>
            <br>
            <a href="rooms.php" class="d-inline-block mb-2 text-decoration-none text-dark">Rooms</a>
            <br>
            <a href="facilities.php" class="d-inline-block mb-2 text-decoration-none text-dark">Facilties</a>
            <br>
            <a href="contact.php" class="d-inline-block mb-2 text-decoration-none text-dark">Contact us</a>
            <br>
            <a href="about.php" class="d-inline-block mb-2 text-decoration-none text-dark">About us</a>
            <br>
        </div>
        <div class="col-lg-4 col-sm-4">
            <h5>Follow us:</h5>
            <?php if($contact['tiktok']) {?>
            <a href="<?=$contact['tiktok']?>" target="_blank"
                class="d-inline-block rounded text-decoration-none fs-6 mb-2 text-dark bg-light"><i
                    class="bi bi-tiktok pe-2"></i>Tiktok</a>
            <?php }?>
            <br>
            <?php if($contact['tw']){?>
            <a href="<?=$contact['tw']?>" target="_blank"
                class="d-inline-block rounded text-decoration-none fs-6 mb-2 text-dark bg-light"><i
                    class="bi bi-twitter pe-2"></i>Twitter</a>
            <?php }?>
            <br>
            <?php if($contact['fb']) {?>
            <a href="<?=$contact['fb']?>" target="_blank"
                class="d-inline-block rounded text-decoration-none fs-6 mb-2 text-dark bg-light"><i
                    class="bi bi-facebook pe-2"></i>Facebook</a>
            <?php }?>
            <br>
            <?php if($contact['insta']) {?>
            <a href="<?=$contact['insta']?>" target="_blank"
                class="d-inline-block rounded text-decoration-none fs-6 mb-2 text-dark bg-light"><i
                    class="bi bi-instagram pe-2"></i>Instagram</a>
            <?php }?>
            <br>
        </div>
    </div>
</div>
<h6 class="text-center bg-dark text-light p-3 m-0">Designed and Developed by Daniyal Hassan</h6>

<script src="script.js"></script>
<script>
function checkLoginToBook(status, room_id){
    if(status){
        $(location).attr('href', 'confirmbooking.php?id=' + room_id);
    }else{
        alert('Please Login For Booking');
    }
}
</script>