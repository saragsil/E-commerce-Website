<?php
require "../includes/header.php";
require "../config/config.php";
require '../auth/email_helper.php'; // Include the email helper file

if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        echo "<script>alert('Email is required');</script>";
    } else {
        $email = $_POST['email'];
        $query = $conn->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindParam(':email', $email);
        $query->execute();

        if ($query->rowCount() > 0) {
            $token = bin2hex(random_bytes(50)); // Generate a random token
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $user_id = $user['id'];

            // Store the token in the database with the user's ID and an expiration time
            $conn->query("DELETE FROM password_resets WHERE user_id='$user_id'"); // Delete existing tokens
            $stmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (:user_id, :token, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            // Send an email to the user with the reset link
            $reset_link = APPURL . "/auth/reset_password.php?token=" . $token;
            $subject = 'Password Reset';
            $body = 'Click on this link to reset your password: <a href="' . $reset_link . '">Reset Password</a>';

            $result = sendEmail($email, $subject, $body);

            if ($result === true) {
                echo "<script>alert('Password reset link has been sent to your email');</script>";
            } else {
                echo "<script>alert('Failed to send email. $result');</script>";
            }
        } else {
            echo "<script>alert('Email not found');</script>";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <form class="form-control mt-5" method="POST" action="forgot_password.php">
            <h4 class="text-center mt-3">Forgot Password</h4>
            <div class="">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="">
                    <input type="email" name="email" class="form-control">
                </div>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-4 mb-4" name="submit" type="submit">Send Reset Link</button>
        </form>
    </div>
</div>

<?php require "../includes/footer.php"; ?>