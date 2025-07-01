<?php 

require('../connect.php');
require('../../admin/essentials.php');

if(isset($_POST['query'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES ('$name', '$email', '$subject', '$message')";

    $rest   = mysqli_query($conn, $sql);
    if($rest){
        echo alert('DATA SENT', 'success');
    }else{
        echo alert('TRY AGAIN', 'danger');
    }
}
else{
    echo "No data sent";
}
