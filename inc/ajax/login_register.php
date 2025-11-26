<?php
require('../../admin/essentials.php');
require('../connect.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


function send_email($name, $email_address, $token, $type){
    if($type == 'email_confirm'){
        $file = 'email_confirmation.php';
        $content  = 'email';    
        $subject = 'Verify account';   
    }else{
        $type == 'email_recovery';
        $file = 'index.php';
        $content  = 'reset';    
        $subject = 'Reset account';   
    }

    $mailData = "<strong>
            Click on the link to $subject
            <br>
            <a href='".SITE_URL."$file?$content=true&email=$email_address&token=$token'>$subject</a>
        </strong>";
    try{
        $mail   = new PHPMailer(true);
        
        $mail -> isSMTP();
        $mail -> Host       = 'smtp.gmail.com';
        $mail -> SMTPAuth   = true;
        $mail -> Username   = EMAIL_FROM;    // SENDER
        $mail -> Password   = 'vfcx xtra gdrn jiyb';
        $mail -> SMTPSecure = 'ssl';
        $mail -> Port = 465;
        $mail -> setFrom(EMAIL_FROM);        // SENDER
        $mail -> addAddress($email_address);                        // TO SEND (RECIEVER)
        $mail -> isHTML(true);
        $mail -> Subject    = EMAIL_SUBJECT;
        $mail -> Body       = $mailData;
        $sent = $mail -> send();
        return 1;

        }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


if(isset($_POST['register'])){
    $data = $_POST;
    // CHECKING THE CONFIRM PASSWORD IS CORRECT 
        if($data['password'] != $data['cpassword']){
            echo alert('PASSWORD MISMATCHS', 'danger');
            exit;
        }
    
    // CHECKING IF THE USER ALREADY EXISTS
        $check_user = mysqli_query($conn, 
        "SELECT * FROM `user_cred` WHERE `email` = '{$data['email']}' OR `contact` = '{$data['contact']}' LIMIT 1");

        if(mysqli_num_rows($check_user) > 0){
            $num_check = mysqli_query($conn, 
            "SELECT * FROM `user_cred` WHERE `contact` = '{$data['contact']}' LIMIT 1");

            echo (mysqli_num_rows($num_check) != 0) ?
                    alert('Phone number already exist', 'danger') : 
                    alert('Email already exist', 'danger');
            exit;

        }

    // IMAGE UPLOADING 

        $img_r = uploadUserImage($_FILES['image'], USER_FOLDER);

        if($img_r == 'inv_type'){
            $response = "Please make sure that the type is png, jpg, jpeg";
            exit;
        }
        elseif ($img_r == 'inv_upload'){
            $response = "Please try again later your file is not uploaded";
            exit;
        }


    // FOR CONFIRMATION EMAIL
        $token = bin2hex(random_bytes(8));
        if(!send_email($data['name'], $data['email'], $token, 'email_confirm')){
            echo alert('MAIL NOT SENT TRY AGAIN LATER', 'danger');
            exit;
        }

    // PASSWORD
        $enc_pass = password_hash($data['password'], PASSWORD_BCRYPT);
    
    // INSERTING DATA INTO DB 
        $user_register = "INSERT INTO `user_cred`
                        (`name`, `email`, `password`, `image`, `address`, `contact`, `pincode`, `dob`, `token`) 
                        VALUES ('$data[name]', '$data[email]', '$enc_pass', '$img_r', '$data[address]', '$data[contact]', '$data[pincode]', '$data[dob]', '$token')";
        $insert_user   = mysqli_query($conn, $user_register);
        
        if($insert_user){
            echo alert('PLEASE CHECK YOUR EMAIL AND VERIFY YOUR ACCOUNT', 'success');
        }
        else{
            echo mysqli_error($conn);
        }
    

}

if(isset($_POST['login'])){

    $login_email = $_POST['emailmob'];
    $pass  = $_POST['loginpass'];


    $check_user = mysqli_query($conn, 
        "SELECT * FROM `user_cred` WHERE `email` = '$login_email' OR `contact` = '$login_email' LIMIT 1");
    
    if(mysqli_num_rows($check_user) > 0){
        $login = mysqli_fetch_assoc($check_user);

        if($login['is_verified'] == 0){
            echo alert('Please verify your account first', 'danger');
            exit;
        }elseif($login['status'] == 0){
            echo alert('You have been blocked by the admin please contact support', 'danger');
            exit;
        }else{
            if(!password_verify($pass, $login['password'])){
                echo alert('Incorrect password', 'danger');
            }else{
                session_start();
                $_SESSION['login']      = true;
                $_SESSION['u_id']       = $login['id'];
                $_SESSION['u_name']     = $login['name'];
                $_SESSION['u_image']    = $login['image'];
                $_SESSION['u_contact']  = $login['contact'];
                redirect('index.php');
                return 1;
            }            
        }

    }else{
        echo alert('You have to register first', 'danger');
        die;
    }


}

if(isset($_POST['forgot'])){
    $data = $_POST;

    $check_user = mysqli_query($conn, 
        "SELECT * FROM `user_cred` WHERE `email` = '{$data['forgotPassword']}' LIMIT 1");

        if(mysqli_num_rows($check_user) > 0){
            $user = mysqli_fetch_assoc($check_user);
            $token = bin2hex(random_bytes(8));

            if(!send_email($user['name'], $user['email'], $token, 'email_recovery')){
                echo alert('MAIL NOT SENT TRY AGAIN LATER', 'danger');
                exit;
            }else{
                echo alert('RESET LINK SENT TO YOUR MAIL', 'success');
            }

        }else{
            echo alert('You have to register first', 'danger');
        }
}

if(isset($_POST['new_password'])){
    $data = $_POST;

    $user_id = mysqli_query($conn, "SELECT * FROM `user_cred` WHERE `email` = '$data[reset_email]' LIMIT 1");
    $id = mysqli_fetch_assoc($user_id);

    if($data['new_password'] == $data['confirm_password']){
        $enc_pass = password_hash($data['new_password'], PASSWORD_BCRYPT);

        $sql = mysqli_query($conn, "UPDATE `user_cred` SET `password`='$enc_pass' WHERE `id` = $id[id]");
        if($sql){   
            echo alert('PASSWORD HAS BEEN CHANGED PLEASE LOGIN', 'success');
            // sleep(4);
        }else{
            echo "fuck you ";
        }
    }else{
        echo alert('MAKE SURE THE PASSWORDS MATCH AND RELOAD THE PAGE', 'danger');
        exit;
    }


}

if(isset($_POST['update_user'])){

    $sql = mysqli_query($conn, "UPDATE `user_cred` SET `name`='$_POST[name]',`email`='$_POST[email]',`address`='$_POST[address]',`contact`='$_POST[contact]',`pincode`='$_POST[pincode]' WHERE `id`=$_POST[id]");

    if($sql){
        echo alert('Updated Successfully', 'success');
    }else{
        echo alert('SERVER DOWN', 'danger');
    }
    
}