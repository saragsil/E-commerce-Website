<?php
require "includes/header.php";
require "config/config.php";
require 'email_helper.php'; // Include the email helper file

// Redirect if the script is accessed directly
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location: index.php');
    exit;
}

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit;
}

// Fetch all products from the cart for the logged-in user
$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$allProducts = $stmt->fetchAll(PDO::FETCH_OBJ);

// Prepare attachments
$attachments = [];
$path  = 'admin-panel/products-admins/books';
foreach ($allProducts as $product) {
    $attachments[] = $path . "/" . $product->pro_file;
}

// Email details
$subject = 'Motoroda';
$body = 'Bikes ' . $_SESSION['price'] . '$ <b>thanks for buying Motoroda</b>';
$to = $_SESSION['email']; // Assuming you have stored the user's email in the session

// Send email using sendEmail function
$result = sendEmail($to, $subject, $body, $attachments);

if ($result === true) {
    // Delete cart items after sending products
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();

    header("location: success.php");
} else {
    echo "Message could not be sent. $result";
}
