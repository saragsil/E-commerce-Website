<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendEmail($to, $subject, $body, $attachments = [])
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dimitrislisgaras@gmail.com'; // Your Gmail address
        $mail->Password   = 'rqot buqu jzdp pxiy'; // Your Gmail app password                             
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender info
        $mail->setFrom('dimitrislisgaras@gmail.com', 'Your Name');

        // Recipient
        $mail->addAddress($to);

        // Add attachments if any
        foreach ($attachments as $attachment) {
            $mail->addAttachment($attachment);
        }

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
