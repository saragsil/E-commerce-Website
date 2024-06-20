<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<?php
$rows = $conn->query("SELECT * FROM products WHERE status = 1");
$rows->execute();

$allRows = $rows->fetchAll(PDO::FETCH_OBJ);
?>

<body>

    <div class="container main-content">
        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <?php $active = true; ?>
                <?php foreach ($allRows as $product) : ?>
                    <div class="carousel-item <?php if ($active) {
                                                    echo 'active';
                                                    $active = false;
                                                } ?>">
                        <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 mx-auto">
                            <div class="card">
                                <img height="213px" class="card-img-top" src="<?php echo IMGURL; ?>/<?php echo $product->image; ?>">
                                <div class="card-body">
                                    <h5 class="d-inline"><b><?php echo $product->name; ?></b></h5>
                                    <h5 class="d-inline">
                                        <div class="text-muted d-inline">($<?php echo $product->price; ?>/item)</div>
                                    </h5>
                                    <p><?php echo substr($product->description, 0, 120); ?>...</p>
                                    <a href="<?php echo APPURL; ?>/shopping/single.php?id=<?php echo $product->id; ?>" class="btn btn-primary w-100 rounded my-2">More <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <?php require "includes/footer.php"; ?>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMF94kAXGm1opmjW53eU4aMO9i+LSJmpz49ScrJT1nG6FBDx4B8BOhpupT2" crossorigin="anonymous"></script>
</body>

</html>