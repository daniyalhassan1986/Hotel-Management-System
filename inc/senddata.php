<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name           = $_POST['name'];
    $email          = $_POST['email'];
    $subject        = $_POST['subject'];
    $message        = $_POST['message'];
    $toSend         = 'dktimes1976@gmail.com';

    $mailData       = 'Name :' . $name . '<br>Email :' . $email . '<br>Subject :' . $subject . '<br>Message :' . $message;
    echo "ok";
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    
    try{
    $mail   = new PHPMailer(true);
    
    $mail -> isSMTP();
    $mail -> Host       = 'smtp.gmail.com';
    $mail -> SMTPAuth   = true;
    $mail -> Username   = 'championarenaofficial@gmail.com';    // SENDER
    $mail -> Password   = 'vfcx xtra gdrn jiyb';
    $mail -> SMTPSecure = 'ssl';
    $mail -> Port = 465;
    $mail -> setFrom('championarenaofficial@gmail.com');        // SENDER
    $mail -> addAddress($toSend);                               // TO SEND (RECIEVER)
    $mail -> isHTML(true);
    $mail -> Subject    = 'Contact Form Data';
    $mail -> Body       = $mailData;
    $mail -> send();
    
    echo "
    <script>
        alert('Sent successfully');
    </script>
    ";}
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
else{
    echo "Error occured while sending ";
}
?>


<!-- PASSWORD:   mexy atao ptrb raew -->
