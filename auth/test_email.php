<?php

require 'email_helper.php';

// Test email details
$to = 'dimitrislisgaras@gmail.com';
$subject = 'Test Email';
$body = 'This is a test email.';

$result = sendEmail($to, $subject, $body);

if ($result === true) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email: $result";
}
