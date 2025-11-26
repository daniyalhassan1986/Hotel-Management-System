<?php 
require('../../inc/connect.php');
require('../essentials.php');


$sql    = 'SELECT * FROM `facilities` ORDER BY id DESC';
$facilities  = mysqli_query($conn, $sql);


$i=1; 
while($facility = mysqli_fetch_assoc($facilities)){
    $seen = '<a href="javascript:void(0)" onclick="remove_facilities('.$facility['id'].',\''.$facility['image'].'\')" class="btn btn-sm btn-danger rounded-pill shadow-none my-2"><i class="bi bi-trash"></i>Delete</a>';

    $name     = $facility['name'];
    $descp    = $facility['descp'];
    $image    = $facility['image'];
?>
<?= '<tr>
        <th scope="row">'.$i++.'</th>
        <td>'.$name.'</td>
        <td><img src="'.FACILITIES_IMG_PATH.$image.'" alt="" width="50px"></td>
        <td>'.$descp.'</td>
        <td>'.$seen.'</td>
    </tr>' ?>
<?php }?>


