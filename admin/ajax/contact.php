<?php
require('../../inc/connect.php');
require('../essentials.php');

$contact_address    = $_POST['contact_address'];
$contact_pn1        = $_POST['pn1'];
$contact_pn2        = $_POST['pn2'];
$contact_email      = $_POST['contact_email'];
$twitter            = $_POST['contact_twitter'];
$fb                 = $_POST['contact_fb'];
$insta              = $_POST['contact_insta'];
$tiktok             = $_POST['contact_tiktok'];
$iframe             = $_POST['site_iframe'];

$sql_update = "UPDATE `contact_details` SET 
                    `address`   = '$contact_address', 
                    `pn1`       = '$contact_pn1', 
                    `pn2`       = '$contact_pn2', 
                    `email`     = '$contact_email', 
                    `fb`        = '$fb', 
                    `insta`     = '$insta', 
                    `tw`        = '$twitter', 
                    `tiktok`    = '$tiktok', 
                    `iframe`    = '$iframe'
                    WHERE `id` = 1";

$result_update = mysqli_query($conn, $sql_update);
if($result_update){
    echo "Updated successfully";
} 
else{
    echo "Try again after some time";
}


?>