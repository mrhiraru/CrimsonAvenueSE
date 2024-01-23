<?php
session_start();

require_once("./classes/account.class.php");
require_once("./tools/functions.php");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once('../vendor/autoload.php');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// Generate 6 digit code
$verification_code = generate_code();

if (!isset($_SESSION['code'])) {
    $_SESSION['code'] = $verification_code;
} else if (isset($_POST['resend'])) {
    $_SESSION['code'] = $verification_code;
}
echo $_SESSION['code'];

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('crimsonavenue@gmail.com', 'Crimson Avenue');
    $mail->addAddress($_SESSION['email'], $_SESSION['name']);     //Add a recipient
    $mail->addReplyTo('crimsonavenue@gmail.com', 'Crimson Avenue');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Crimson Avenue Verification';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



?>


<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Verify | Crimson Avenue";
require_once('../includes/head.php');
?>

<body>
    <main class="row m-0 vh-100 bg-tertiary d-flex align-items-center justify-content-center">
        <div class="col-10 custom-size px-3 py-3 px-md-5 bg-light shadow-lg rounded d-flex flex-column justify-content-center align-items-center">
            <img src="../images/main/ca-icon-noword.png" alt="" class=" img-thumbnail border border-0 bg-light mb-4">
            <form action="" method="post" class="row d-flex">
                <div class="mb-2 p-0 col-12">
                    <label for="code" class="form-label text-center text-dark fs-7">
                        We've sent you 6-digit code to
                        <span class="text-primary fw-semibold ">example@email.com</span>
                        Enter the code below to verify your account.
                    </label>
                    <input type="text" maxlength="6" pattern="\d{6}" name="code" placeholder="Verification Code" class="form-control text-center" oninput="validateinput(this)" value="<?php if (isset($_POST['contact'])) {
                                                                                                                                                                                            echo $_POST['contact'];
                                                                                                                                                                                        } ?>">
                    <?php
                    if (isset($_POST['code']) && !validate_field($_POST['code']) && isset($_POST['verify'])) {
                    ?>
                        <p class="fs-7 text-primary m-0 ps-2">Verification code is required.</p>
                    <?php
                    }
                    ?>
                </div>
                <div class="mb-2 p-0 col-12">
                    <input type="submit" class="btn btn-primary w-100 fw-semibold" name="verify" value="Verify">
                </div>
                <div class="p-0 col-12 text-center">
                    <p class="fs-7 text-dark m-0">Didn't received verification code? <input type="submit" class="text-primary text-decoration-none fw-semibold border-0 bg-light" name="resend" value="Resend Code"> </p>
                </div>
            </form>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>