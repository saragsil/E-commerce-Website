<?php require "layouts/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php


$products = $conn->query("SELECT COUNT(*) as products_num FROM products");
$products->execute();
$allProducts = $products->fetch(PDO::FETCH_OBJ);



$categories = $conn->query("SELECT COUNT(*) as categories_num FROM categories");
$categories->execute();
$allCategories = $categories->fetch(PDO::FETCH_OBJ);


$admins = $conn->query("SELECT COUNT(*) as admins_num FROM admins");
$admins->execute();
$allAdmins = $admins->fetch(PDO::FETCH_OBJ);



?>

<div class="container main-content">
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Προϊόντα</h5>
          <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
          <p class="card-text">Αριθμός Προϊόντων: <?php echo $allProducts->products_num; ?></p>

        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Κατηγορίες</h5>

          <p class="card-text">Αριθμός Κατηγοριών: <?php echo $allCategories->categories_num; ?></p>

        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Διαχειριστές</h5>

          <p class="card-text">Αριθμός Διαχειριστών: <?php echo $allAdmins->admins_num; ?></p>

        </div>
      </div>
    </div>
  </div>
</div>

<?php require "layouts/footer.php"; ?>