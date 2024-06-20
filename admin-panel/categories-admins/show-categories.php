<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php


$select = $conn->query("SELECT * FROM categories");
$select->execute();

$categories = $select->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Κατηγορίες</h5>
        <a href="<?php echo ADMINURL; ?>/categories-admins/create-category.php" class="btn btn-primary mb-4 text-center float-right">Δημιουργία Προϊόντων</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Όνομα</th>
              <th scope="col">Ενημέρωση</th>
              <th scope="col">Διαγραφή</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categories as $category) : ?>
              <tr>
                <th scope="row"><?php echo $category->id; ?></th>
                <td><?php echo $category->name; ?></td>
                <td><a href="<?php echo ADMINURL; ?>/categories-admins/update-category.php?id=<?php echo $category->id; ?>" class="btn btn-warning text-white text-center ">Ενημέρωση </a></td>
                <td><a href="<?php echo ADMINURL; ?>/categories-admins/delete-categories.php?id=<?php echo $category->id; ?>" class="btn btn-danger  text-center ">Διαγραφή </a></td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<?php require "../layouts/footer.php"; ?>