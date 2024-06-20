<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php


if (!isset($_SESSION['adminname'])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}


if (isset($_POST['submit'])) {
  if (empty($_POST['name']) or empty($_POST['description'])) {
    echo "<script>alert('one or more inputs are empty');</script>";
  } else {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

    $dir = "images/" . basename($image);


    $insert = $conn->prepare("INSERT INTO categories (name, description, image) VALUES 
      (:name, :description, :image)");
    $insert->execute([
      ":name" => $name,
      ":description" => $description,
      ":image" => $image,
    ]);

    if (move_uploaded_file($_FILES['image']['tmp_name'],  $dir)) {
      header("location: " . ADMINURL . "/categories-admins/show-categories.php");
    }
  }
}

?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Δημιουργία Κατηγορίας</h5>
        <form method="POST" action="create-category.php" enctype="multipart/form-data">
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <label for="exampleFormControlTextarea1">Όνομα</label>

            <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />

          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Περιγραφή</label>
            <textarea name="description" placeholder="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <div class="form-outline mb-4 mt-4">
            <label>Εικόνα</label>

            <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
          </div>


          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Δημιουργία</button>


        </form>

      </div>
    </div>
  </div>
</div>
<?php require "../layouts/footer.php"; ?>