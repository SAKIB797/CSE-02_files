<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $batch = $_POST['batch'];
    $id = $_POST['id'];

    // Email information
    $to = "pro.iftekhar@gmail.com";
    $subject = "New Form Submission";
    $message = "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Batch: $batch\n";
    $message .= "ID: $id\n";

    // Send email
    mail($to, $subject, $message);

    // Reply to the submitter
    $reply_subject = "Thank you for your submission";
    $reply_message = "Dear $name,\n\nThank you for submitting the form. Here is the Digital Library link: https://padlet.com/proiftekhar/notice-board-cse-02-ccwz9pyati4lzcqd\n\nLibrary password: hello_cstu";
    $reply_headers = "From: pro.iftekhar@gmail.com\r\n";
    $reply_headers .= "Reply-To: pro.iftekhar@gmail.com\r\n";
    mail($email, $reply_subject, $reply_message, $reply_headers);

    // Redirect to a thank you page
    header('Location: thank-you.html');
    exit;
}
?>
