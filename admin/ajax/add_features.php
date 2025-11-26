<?php
require('../../inc/connect.php');
require('../essentials.php');

if(isset($_POST)){
    $response = 'no date';
    $name  = $_POST['feature_name'];

    $sql    = "INSERT INTO `features` (`name`) VALUES ('$name')";
    $rest   = mysqli_query($conn, $sql);
    if($rest){
        $response = 'DATA INSERTED SUCCESSFULLY';
    }else{
        $response = 'DATA NOT INSERTED TRY AGAIN AFTER A WHILE';
    }

    echo $response;
}

?>