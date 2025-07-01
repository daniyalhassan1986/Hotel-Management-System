<?php
require('../../inc/connect.php');
require('../essentials.php');


$sql = 'SELECT * FROM `team_details`';
$data = mysqli_query($conn, $sql);
$path = ABOUT_IMG_PATH;

foreach($data as $key){
    echo '
    <div class="col-md-2 mb-3 my-3" id="team-data-data">
        <div class="card text-bg-dark">
            <img src="'.$path.$key['picture'].'" class="card-img" height="300px">
            <div class="card-img-overlay text-end">
                <button class="btn btn-sm btn-danger" onclick="remove_member('.$key['sr_no'].',\''.$key['picture'].'\')"><i class="bi bi-trash-fill"></i></button>
            </div>
            <p class="card-text text-center px-3 py-2">'.$key['name'].'</p>
        </div>
    </div>';
}


?>