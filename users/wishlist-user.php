<?php require  "../includes/header.php"; ?>
<?php require  "../config/config.php"; ?>        
 <?php 
 
 
    $rows = $conn->query("SELECT * FROM wishlist WHERE user_id='$_SESSION[user_id]'");
    $rows->execute();

    $allRows = $rows->fetchAll(PDO::FETCH_OBJ);
 
 
 ?>      
        <div class="row mt-5">
            <?php if(count($allRows) > 0) : ?>
                <?php foreach($allRows as $product) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1">
                        <div class="card" >
                            <img height="213px" class="card-img-top" src="<?php echo IMGURL; ?>/<?php echo  $product->pro_image; ?>">
                            <div class="card-body" >
                                <h5 class="d-inline"><b><?php echo  $product->pro_name; ?></b> </h5>
                                <h5 class="d-inline"><div class="text-muted d-inline">($<?php echo  $product->pro_price; ?>/item)</div></h5>
                                <p><?php //echo  substr($product->pro_description, 0, 120); ?> </p>
                                <a href="<?php echo APPURL; ?>/shopping/single.php?id=<?php echo  $product->pro_id; ?>"  class="btn btn-primary w-100 rounded my-2"> More <i class="fas fa-arrow-right"></i> </a>      
            
                            </div>
                            
                        </div>
                        <br>
                    </div>              
                    <br>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="alert alert-success text-white bg-success">there are no wishlist products for now</div>
            <?php endif; ?>

         </div>
       

<?php require  "../includes/footer.php"; ?>        