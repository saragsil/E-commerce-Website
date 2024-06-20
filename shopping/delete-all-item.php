<?php require  "../includes/header.php"; ?>
<?php require  "../config/config.php"; ?>

<?php 

    if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        /* 
        Up to you which header to send, some prefer 404 even if 
        the files does exist for security
        */
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        /* choose the appropriate page to redirect users */
        die( header( 'location: '.APPURL.'' ));

    }


    if(!isset($_SESSION['username'])) {
        header("location: ".APPURL."");
    }

    if(isset($_POST['delete'])) {
        
        $delete = $conn->prepare("DELETE FROM cart WHERE user_id='$_SESSION[user_id]'");
        
        $delete->execute();
    }

?>


<?php require  "../header/footer.php"; ?>
