<?php
require('admin/essentials.php');
require('inc/connect.php');

if(isset($_GET['email'])){
    $email  = $_GET['email'];
    $token  = $_GET['token'];

    $sql    = mysqli_query($conn,"SELECT * FROM `user_cred` WHERE `email`='$email' AND `token`='$token' LIMIT 1");
    if($sql){
        $result = mysqli_fetch_assoc($sql);
        if($result){
            if($result['is_verified'] == 1){
                echo "<script>alert('EMAIL ALREADY VERIFIED')</script>";
                redirect('index.php');
            }else{
                $verify =  mysqli_query($conn,"UPDATE `user_cred` SET `is_verified`= 1 WHERE `id`= $result[id]"); 
                if($verify){
                    echo "<script>alert('VERIFIED SUCCESSFULLY')</script>";
                    redirect('index.php');
                }else{
                    echo "<script>alert('SERVER DOWN TRY AGAIN LATER')</script>";
                    redirect('index.php');
                }
            }
        }else{
            echo "<script>alert('YOU HAVE TO REGISTER FIRST')</script>";
            redirect('index.php');
        }
    }else{
        echo "<script>alert('YOU HAVE TO REGISTER FIRST')</script>";
        redirect('index.php');
    }
}

