<?php 
require('../../inc/connect.php');
require('../essentials.php');


$sql    = 'SELECT * FROM `features` ORDER BY id DESC';
$features  = mysqli_query($conn, $sql);


$i=1; 
while($feature = mysqli_fetch_assoc($features)){
    $seen = '<a href="javascript:void(0)" onclick="remove_feature('.$feature['id'].')" class="btn btn-sm btn-danger rounded-pill shadow-none my-2">Delete</a>';

    $name    = $feature['name'];
?>
<?= '<tr>
        <th scope="row">'.$i++.'</th>
        <td>'.$name.'</td>
        <td>'.$seen.'</td>
    </tr>' ?>
<?php }?>
