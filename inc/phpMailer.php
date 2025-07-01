<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
$mail -> addAddress('daniyalhassan1986@gmail.com');         // TO SEND (RECIEVER)
$mail -> isHTML(true);
$mail -> Subject    = 'This is the subject';
$mail -> Body       = 'This is the body';
$mail -> send();
  
echo "
<script>
    alert('Sent successfully');
</script>
";}
catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>


<!-- PASSWORD:   mexy atao ptrb raew -->







