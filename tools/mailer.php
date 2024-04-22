<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once '../vendor/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require_once '../vendor/PHPMailer-master/PHPMailer-master/src/Exception.php';
require_once '../vendor/PHPMailer-master/PHPMailer-master/src//SMTP.php';

//Load Composer's autoloader
require_once('../vendor/autoload.php');

//Create an instance; passing `true` enables exceptions


function send_code($email, $name, $code)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'crimson.avenue.soltec@gmail.com';                     //SMTP username
        $mail->Password   = 'cbym ajil plzp tbob';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('crimson.avenue.soltec@gmail.com', 'Crimson Avenue');
        $mail->addAddress($email, $name);     //Add a recipient
        $mail->addReplyTo('crimson.avenue.soltec@gmail.com', 'Crimson Avenue');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Verify Your Crimson Avenue Account';
        $mail->Body    = '<p> Hi ' . ucwords($name) . ',<br><br>Welcome to Crimson Avenue! Please verify your email to complete your sign-up.<br><br>Verification Code: <strong>' . $code . '</strong><br><a href="http://crimsonavenue.se.local/user/verify.php">http://crimsonavenue.se.local/user/verify.php</a><br><br>If you have any questions, contact us at [your support email/phone]. </p>';
        $mail->AltBody = '<p> Hi ' . ucwords($name) . ',<br><br>Welcome to Crimson Avenue! Please verify your email to complete your sign-up.<br><br>Verification Code: <strong>' . $code . '</strong><br><a href="http://crimsonavenue.se.local/user/verify.php">http://crimsonavenue.se.local/user/verify.php</a><br><br>If you have any questions, contact us at [your support email/phone]. </p>';

        if ($mail->send()) {
            //echo 'Message has been sent';
        };
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
