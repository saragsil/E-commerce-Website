<?php require  "../includes/header.php"; ?>
<?php require  "../config/config.php"; ?>  

<?php 


    if(isset($_POST['submit'])) {

            

        $pro_id = $_POST['pro_id'];
        $pro_name = $_POST['pro_name'];
        $pro_image = $_POST['pro_image'];
        $pro_price = $_POST['pro_price'];      
        $user_id = $_POST['user_id'];
        
        $insert = $conn->prepare("INSERT INTO wishlist (pro_id, pro_name, pro_image,
        pro_price, user_id) VALUES(:pro_id, :pro_name, :pro_image,
        :pro_price, :user_id)");

        $insert->execute([
            ':pro_id' => $pro_id,
            ':pro_name' => $pro_name,
            ':pro_image' => $pro_image,
            ':pro_price' => $pro_price,
            ':user_id' => $user_id,
        ]);



    }


?>