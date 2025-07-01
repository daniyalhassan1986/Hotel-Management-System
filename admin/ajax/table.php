<?php 
require('../../inc/connect.php');
require('../essentials.php');


$sql    = 'SELECT * FROM `user_queries` ORDER BY id DESC';
$users  = mysqli_query($conn, $sql);


$i=1; 
while($user = mysqli_fetch_assoc($users)){
    $seen = '';
    if($user['seen'] != 1){
        $seen = '<a href="javascript:void(0)" onclick="seen('.$user['id'].')" class="btn btn-sm btn-success rounded-pill shadow-none">Mark as Read</a>';
    }
    $seen .= '<a href="javascript:void(0)" onclick="delete_single('.$user['id'].')" class="btn btn-sm btn-danger rounded-pill shadow-none my-2 mx-4">Delete</a>';

    $name    = $user['name'];
    $email   = $user['email'];
    $subject = $user['subject'];
    $message = $user['message'];
    $date    = $user['date'];
?>
<?= '<tr>
        <th scope="row">'.$i++.'</th>
        <td>'.$name.'</td>
        <td>'.$email.'</td>
        <td>'.$subject.'</td>
        <td>'.$message.'</td>
        <td>'.$date.'</td>
        <td>'.$seen.'</td>
    </tr>' ?>
<?php }?>
