<?php
require('../../inc/connect.php');
require('../essentials.php');

if(isset($_POST)){
    $id     = $_POST['id'];
    $status = $_POST['status'];

    $sql    = "UPDATE `rooms` SET `status`='$status' WHERE `id`='$id'";
    // UPDATE `rooms` SET `id`='[value-1]'`status`='[value-9]' WHERE 1
    $rest   = mysqli_query($conn, $sql);
    if($rest){
        $return = alert('Record Updated Successfully', 'success');
    }
    else{
        $return = alert('SERVER DOWN', 'danger');
    }

    return $return;
}
