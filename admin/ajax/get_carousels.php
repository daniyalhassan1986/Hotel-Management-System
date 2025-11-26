<?php
require('../../inc/connect.php');
require('../essentials.php');


$sql = 'SELECT * FROM `carousel`';
$data = mysqli_query($conn, $sql);
$path = CAROUSEL_IMG_PATH;

foreach($data as $key){
    echo '
    <div class="col-md-2 mb-3 my-3" id="team-data-data">
        <div class="card text-bg-dark">
            <img src="'.$path.$key['image'].'" class="card-img">
            <div class="card-img-overlay text-end">
                <button class="btn btn-sm btn-danger" onclick="remove_carousel('.$key['id'].',\''.$key['image'].'\')"><i class="bi bi-trash-fill"></i></button>
            </div>
        </div>
    </div>';
}


?>