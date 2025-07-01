<?php

require('../../inc/connect.php');
require('../essentials.php');

$site_title = $_POST['site_title']; 
$site_about = $_POST['site_about']; 
$site_id = $_POST['site_id']; 

$sql = "UPDATE `settings` SET site_name = '$site_title', site_about = '$site_about'";
$result = mysqli_query($conn, $sql);
if($result){
    alert("Your Data Updated", "success");
}
else{
    echo "false";
}
?>