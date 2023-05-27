<?php

session_start();

require_once "../backend/config.php";



if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($link, "SELECT * FROM winkelwagen WHERE name = '$product_name'");

    if(mysqli_num_rows($select_cart) > 0){
        $message[] = 'product already added to cart';
    } else{
        $insert_product = mysqli_query($link, "INSERT INTO winkelwagen (name, prijs, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
        $message[] = 'product added to cart';

    }


}


?>

<!
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product_pagina</title>
    <link rel="stylesheet" href="product.css">
</head>
<body >

<?php
if(isset($message)){
    foreach ($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
    }
}
?>


<?php include ('../include/header.php'); ?>
    <main class="container">

            <form action="" method="post">
                    <?php
                    $select_products = mysqli_query($link, "SELECT * FROM artikel");
                    if(mysqli_num_rows($select_products) > 0){
                    while ($fetch_product = mysqli_fetch_assoc($select_products)){
                    ?>
                    <form action="" method="post">
                        <div class="product">
                            <img class="product-image" src="<?php echo $fetch_product['image']?>" height="175" width="175" alt = "">
                            <h3 class="product-title" ><?php echo $fetch_product['naam']; ?></h3>
                            <div class="product-description"><?php echo $fetch_product['omschrijving'];?></div>
                            <div class="product-price"><?php echo $fetch_product['prijs']; ?></div>
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['naam']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['prijs']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                            <input type="submit" class="product-button" value="add to cart" name="add_to_cart">
                        </div>
                    </form>

                    <?php 
                        }
                    }
                    ?>
            </form>

    </main>
    <?php include ('../include/footer.php'); ?>

</body>
</html>
