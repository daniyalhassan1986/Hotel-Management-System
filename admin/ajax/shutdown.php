<?php
require('../../inc/connect.php');
require('../essentials.php');


$switch_mode = $_POST['switch_mode'];
echo $switch_mode;
if($switch_mode == 0){
    $sql = "UPDATE `settings` SET shutdown = '1'";
    $result = mysqli_query($conn, $sql);
}
else{
    $sql = "UPDATE `settings` SET shutdown = '0'";
    $result = mysqli_query($conn, $sql);
}

?>