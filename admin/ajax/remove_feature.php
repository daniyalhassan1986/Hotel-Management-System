<?php
require('../../inc/connect.php');
require('../essentials.php');

$id     = $_POST['id'];


$sql = "DELETE FROM `features` WHERE `id` = $id";
if(mysqli_query($conn, $sql)){
    echo alert('deleted successfully', 'danger');
}else{
    echo alert('not deleted', 'danger');
}



?>