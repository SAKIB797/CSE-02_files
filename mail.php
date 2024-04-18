<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

// Form data
$name = $_POST['name'];
$email = $_POST['email'];
$batch = $_POST['batch'];
$id = $_POST['id'];

// PHPMailer configuration
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pro.iftekhar@gmail.com';
    $mail->Password = 'nrtrjtrsxbkkyjja'; // Your Gmail password here
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //Recipient (Send customized message to submitted email)
    $mail->setFrom('pro.iftekhar@gmail.com', 'CSE_02 Digital Library');
    $mail->addAddress($email, $name); // Send to submitted email
    $mail->isHTML(true);
    $mail->Subject = 'Digital library Link & Password';
    $mail->Body = "Thank you for submitting the form.<br><br>" .
        "Here is the Digital Library link: <a href='https://padlet.com/proiftekhar/notice-board-cse-02-ccwz9pyati4lzcqd'>https://padlet.com/proiftekhar/notice-board-cse-02-ccwz9pyati4lzcqd</a><br>" .
        "Library password: hello_cstu<br><br>";

    $mail->send();

    //Recipient (Send form data to pro.iftekhar@gmail.com)
    $mail->clearAddresses(); // Clear previous recipients
    $mail->setFrom('pro.iftekhar@gmail.com', 'CSTU CSE_02 Digital Library');
    $mail->addAddress('pro.iftekhar@gmail.com', ''); // Send to pro.iftekhar@gmail.com
    $mail->Subject = 'CSTU CSE_02 Form Submission';
    $mail->Body = "Submitted Form Data:<br>" .
        "Name: $name<br>" .
        "Email: $email<br>" .
        "Batch: $batch<br>" .
        "ID: $id";

    $mail->send();

    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>