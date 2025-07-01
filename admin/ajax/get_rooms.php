<?php 
require('../../inc/connect.php');
require('../essentials.php');


$sql    = 'SELECT * FROM `rooms` ORDER BY id DESC';
$rooms  = mysqli_query($conn, $sql);


$i=1; 
while($room = mysqli_fetch_assoc($rooms)){

    $name       = $room['name'];
    $area       = $room['area'];
    $price      = $room['price'];
    $quantity   = $room['quantity'];
    $adult      = $room['adult'];
    $children   = $room['children'];
    $descp      = $room['descp'];

    if($room['status']!=1){
        $status = '<button type="button" class="btn btn-warning rounded-pill" onclick="set_active('.$room['id'].','.$room['status'].')">Inactive</button>';
    }
    else{
        $status = '<button type="button" class="btn btn-success rounded-pill" onclick="set_active('.$room['id'].','.$room['status'].')">Active</button>';
    }
     

echo  '<tr class="align-middle">
        <th scope="row">'.$i++.'</th>
        <td>'.$name.'</td>
        <td>
            <span class="badge text-bg-dark rounded-pill">Adult:'.$adult.'</span>
            <br>
            <span class="badge text-bg-dark rounded-pill">Children:'.$children.'</span>
        </td>
        <td>'.$area.' sq.ft</td>
        <td>Pkr '.$price.'</td>
        <td>'.$quantity.'</td>
        <td>'.$status.'</td>
        <td>
            <button type="button" onclick="edit_room('.$room['id'].')" class="btn btn-primary shadow-none rounded-pill" data-bs-toggle="modal" data-bs-target="#rooms_add"><i class="bi bi-pencil-square"></i>
            </button>
            <button type="button" onclick="room_img('.$room['id'].')" class="btn btn-warning shadow-none rounded-pill" data-bs-toggle="modal" data-bs-target="#room_images"><i class="bi bi-image"></i></button>
            <button type="button" onclick="remove_room('.$room['id'].')" class="btn btn-danger shadow-none rounded-pill"><i class="bi bi-trash"></i></button>
        </td>
    </tr>' ?>
<?php }?>