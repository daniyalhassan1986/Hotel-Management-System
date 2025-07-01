<?php 

require('../connect.php');
require('../../admin/essentials.php');

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


if(isset($_POST['filter'])){

    $adult  = $_POST['adult'];
    $child  = $_POST['child'];

    $sql = "SELECT * FROM `rooms` 
            WHERE `status` = 1 
            AND `adult` >= '$adult' 
            and `children` >= '$child'";

    $rooms = mysqli_query($conn, $sql);

    while ($room = mysqli_fetch_assoc($rooms)) { ?>
<div id="filteration" class="col-lg-12">

    <?php
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

            if (mysqli_num_rows($sql) > 0) {
                $thumbnail = mysqli_fetch_assoc($sql);
            }else{
                $thumbnail['image'] = 'thumbnail.jpg';
            }



        // echo $facilites_all;
        ?>

        <?php
        $book_now = '';
        if($settings['shutdown'] != 0){ 
            $login = 0;
            if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                $login = 1;
            }
            $book_now = '<a href="javascript:void(0)" onclick="checkLoginToBook('.$login.','.$room['id'].')" class="btn btn-sm text-white custom-bg shadow-none w-100 mb-2">BooK Now</a>';
        }
        ?>
    <div class="card mb-3 shadow">
        <div class="row g-0">
            <div class="col-lg-5 p-3">
                <img src="images/rooms/<?=$thumbnail['image']?>" class="img-fluid rounded-start">
            </div>
            <div class="col-lg-4 px-3">
                <div class="features my-3">
                    <h5 class="card-title"><?=$room['name']?></h5>
                    <span class="badge rounded-pill bg-light text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </span>

                    <h6 class="mb-1">Features</h6>
                    <?=$features_all;?>

                </div>
                <div class="facilties mb-3">
                    <h6 class="mb-1">Facilties</h6>
                    <?=$facilities_all?>
                </div>
                <div class="facilties mb-3">
                    <h6 class="mb-1">Guests</h6>
                    <span class="badge rounded-pill text-dark bg-light text-wrap"><?=$adult?> Adults</span>
                    <span class="badge rounded-pill text-dark bg-light text-wrap"><?=$children?>
                        Childs</span>
                </div>
            </div>
            <div class="col-lg-3 text-center m-auto p-3">
                <h6 class="card-title mb-4 "><i><b>Pkr <?=$room['price']?>/- Per Night</b></i></h6>
                <?=$book_now?>
                <a href="room_details.php?id=<?=$room['id']?>"
                    class="btn btn-sm btn-outline-dark shadow-none w-100 ">More Details</a>
            </div>
        </div>
    </div>

    <?php } ?>

</div>
<?php }?>


<?php
if(isset($_POST['no_filter'])){ ?>
<div id="filteration" class="col-lg-12">

    <?php
    while($room = mysqli_fetch_assoc($rooms)){

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

        if (mysqli_num_rows($sql) > 0) {
            $thumbnail = mysqli_fetch_assoc($sql);
        }else{
            $thumbnail['image'] = 'thumbnail.jpg';
        }



    // echo $facilites_all;
    ?>

    <?php
    $book_now = '';
    if($settings['shutdown'] != 0){ 
        $login = 0;
        if(isset($_SESSION['login']) && $_SESSION['login'] == true){
            $login = 1;
        }
        $book_now = '<a href="javascript:void(0)" onclick="checkLoginToBook('.$login.','.$room['id'].')" class="btn btn-sm text-white custom-bg shadow-none w-100 mb-2">BooK Now</a>';
    }
    ?>
    <div class="card mb-3 shadow">
        <div class="row g-0">
            <div class="col-lg-5 p-3">
                <img src="images/rooms/<?=$thumbnail['image']?>" class="img-fluid rounded-start">
            </div>
            <div class="col-lg-4 px-3">
                <div class="features my-3">
                    <h5 class="card-title"><?=$room['name']?></h5>
                    <span class="badge rounded-pill bg-light text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </span>

                    <h6 class="mb-1">Features</h6>
                    <?=$features_all;?>

                </div>
                <div class="facilties mb-3">
                    <h6 class="mb-1">Facilties</h6>
                    <?=$facilities_all?>
                </div>
                <div class="facilties mb-3">
                    <h6 class="mb-1">Guests</h6>
                    <span class="badge rounded-pill text-dark bg-light text-wrap"><?=$adult?> Adults</span>
                    <span class="badge rounded-pill text-dark bg-light text-wrap"><?=$children?>
                        Childs</span>
                </div>
            </div>
            <div class="col-lg-3 text-center m-auto p-3">
                <h6 class="card-title mb-4 "><i><b>Pkr <?=$room['price']?>/- Per Night</b></i></h6>
                <?=$book_now?>
                <a href="room_details.php?id=<?=$room['id']?>"
                    class="btn btn-sm btn-outline-dark shadow-none w-100 ">More Details</a>
            </div>
        </div>
    </div>

    <?php } ?>

</div>
<?php }?>