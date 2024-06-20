<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>


<?php


if (!isset($_SESSION['adminname'])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}


if (isset($_POST['submit'])) {

  if (empty($_POST['adminname']) or empty($_POST['email']) or empty($_POST['password'])) {
    echo "<script>alert('one or more inputs are empty');</script>";
  } else {
    $adminname = $_POST['adminname'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $insert = $conn->prepare("INSERT INTO admins (adminname, email, mypassword) 
             VALUES (:adminname, :email, :mypassword)");

    $insert->execute([
      ':adminname'  => $adminname,
      ':email'      => $email,
      ':mypassword' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    header("location: " . ADMINURL . "/admins/admins.php");
  }
}


?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Δημιουργία Διαχειριστή</h5>
        <form method="POST" action="create-admins.php">
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />

          </div>

          <div class="form-outline mb-4">
            <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="username" />
          </div>
          <div class="form-outline mb-4">
            <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
          </div>
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Δημιουργία Διαχειριστή</button>


        </form>

      </div>
    </div>
  </div>
</div>
<?php require "../layouts/footer.php"; ?>