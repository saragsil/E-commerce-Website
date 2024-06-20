<?php
require "../includes/header.php";
require "../config/config.php";

// Check if a session is already started and if not, start a session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['username'])) {
    header("location: " . APPURL . "");
    exit;
}

// Check for the password reset success message
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']); // Clear the message after displaying it
}

if (isset($_POST['submit'])) {

    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('One or more inputs are empty');</script>";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = $conn->prepare("SELECT * FROM users WHERE email=:email");
        $login->bindParam(':email', $email);
        $login->execute();

        $fetch = $login->fetch(PDO::FETCH_ASSOC);

        if ($login->rowCount() > 0) {

            if (password_verify($password, $fetch['mypassword'])) {

                $_SESSION['username'] = $fetch['username'];
                $_SESSION['user_id'] = $fetch['id'];
                $_SESSION['email'] = $fetch['email'];

                header("location: " . APPURL . "");
                exit;
            } else {
                echo "<script>alert('Password or email is wrong');</script>";
            }
        } else {
            echo "<script>alert('Password or email is wrong');</script>";
        }
    }
}
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <form class="form-control mt-5" method="POST" action="login.php">
            <h4 class="text-center mt-3"> Login </h4>

            <div class="">
                <label for="staticEmail" class="col-sm-2 col-form-label" style="color: black;">Email</label>
                <div class="">
                    <input type="email" name="email" class="form-control">
                </div>
            </div>
            <div class="">
                <label for="inputPassword" class="col-sm-2 col-form-label" style="color: black;">Password</label>
                <div class="">
                    <input type="password" name="password" class="form-control" id="inputPassword">
                </div>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-4 mb-4" name="submit" type="submit">Login</button>
            <p class="text-center"><a href="forgot_password.php">Forgot Password?</a></p>
        </form>
    </div>
</div>

<?php require "../includes/footer.php"; ?>