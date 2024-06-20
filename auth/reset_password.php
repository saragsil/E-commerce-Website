<?php
require "../includes/header.php";
require "../config/config.php";

// Check if a session is already started and if not, start a session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $query = $conn->prepare("SELECT * FROM password_resets WHERE token=:token AND expires_at > NOW()");
    $query->bindParam(':token', $token);
    $query->execute();

    if ($query->rowCount() > 0) {
        if (isset($_POST['submit'])) {
            if (empty($_POST['password']) || empty($_POST['confirm_password'])) {
                echo "<script>alert('Password fields cannot be empty');</script>";
            } elseif ($_POST['password'] !== $_POST['confirm_password']) {
                echo "<script>alert('Passwords do not match');</script>";
            } else {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $reset = $query->fetch(PDO::FETCH_ASSOC);
                $user_id = $reset['user_id'];

                // Update the user's password
                $stmt = $conn->prepare("UPDATE users SET mypassword=:password WHERE id=:user_id");
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();

                // Delete the token so it can't be reused
                $stmt = $conn->prepare("DELETE FROM password_resets WHERE user_id=:user_id");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();

                $_SESSION['message'] = 'Your password has been reset successfully.';
                header("Location: " . APPURL . "/auth/login.php");
                exit();
            }
        }
    } else {
        echo "<script>alert('Invalid or expired token');</script>";
        header("Location: " . APPURL . "/auth/forgot_password.php");
        exit();
    }
} else {
    header("Location: " . APPURL . "/auth/forgot_password.php");
    exit();
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <form class="form-control mt-5" method="POST" action="reset_password.php?token=<?php echo htmlspecialchars($_GET['token']); ?>">
            <h4 class="text-center mt-3">Reset Password</h4>
            <div class="">
                <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
                <div class="">
                    <input type="password" name="password" class="form-control" id="inputPassword">
                </div>
            </div>
            <div class="">
                <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="">
                    <input type="password" name="confirm_password" class="form-control" id="confirmPassword">
                </div>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-4 mb-4" name="submit" type="submit">Reset Password</button>
        </form>
    </div>
</div>

<?php require "../includes/footer.php"; ?>