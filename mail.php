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
    $mail->Password = ''; // Your Gmail password here
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //Recipient (Send customized message to submitted email)
    $mail->setFrom('ihSakib@outlook.com', 'CSE_02 Digital Library');
    $mail->addAddress($email, $name); // Send to submitted email
    $mail->isHTML(true);
    $mail->Subject = 'Digital library Link & Password';

   
    // Read the content of the HTML file
    $emailContent = file_get_contents('./mail_body.html');
    // Assign the content to the email body
    $mail->Body = $emailContent;

    $mail->send();

    //Recipient (Send form data to pro.iftekhar@gmail.com)
    $mail->clearAddresses(); // Clear previous recipients
    $mail->setFrom('pro.iftekhar@gmail.com', 'CSE_02 Digital Library');
    $mail->addAddress('pro.iftekhar@gmail.com', ''); // Send to pro.iftekhar@gmail.com
    $mail->Subject = 'CSE_02 Digital Library Form Submission';
    $mail->Body = "Submitted Form Data:<br><br>" .
        "Name: $name<br>" .
        "Email: $email<br>" .
        "Batch: $batch<br>" .
        "ID: $id";

    $mail->send();

    header('Location: ./thanks.html');
    exit;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>