<?php
include('include/header.php');
include('include/database.php');


// Check if product is coming or not
if (isset($_GET['pro_id'])) {
    $proid = $_GET['pro_id'];



    // If session cart is not empty
    if (!empty($_SESSION['cart'])) {

        // Using "array_column() function" we get the product id existing in session cart array
        $acol = array_column($_SESSION['cart'], 'pro_id');

        // now we compare whther id already exist with "in_array() function"
        if (in_array($proid, $acol)) {

            // Updating quantity if item already exist
            $_SESSION['cart'][$proid]['qty'] += 1;

        } else {

            // If item doesn't exist in session cart array, we add a new item
            $item = [
                'pro_id' => $_GET['pro_id'],
                'qty' => 1
            ];
            $_SESSION['cart'][$proid] = $item;
        }
    } else {

        // If cart is completely empty, then store item in session cart
        $item = [
            'pro_id' => $_GET['pro_id'],
            'qty' => 1
        ];
        $_SESSION['cart'][$proid] = $item;
    }
}

?>




<?php
if(isset($message)){
    foreach ($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
    }
}
?>



    <main class="container">

            <form action="" method="post">
                    <?php
                    $select_products = mysqli_query($link, "SELECT * FROM artikel");
                    if(mysqli_num_rows($select_products) > 0){
                    while ($fetch_product = mysqli_fetch_assoc($select_products)){
                    ?>
                    <form action="" method="post">
                        <div class="product">
                            <img class="product-image" src="admin/<?php echo $fetch_product['image']?>" height="175" width="175" alt = "">
                            <h3 class="product-title" ><?php echo $fetch_product['naam']; ?></h3>
                            <div class="product-description">Beschrijving:<br> <?php echo $fetch_product['omschrijving'];?></div>
                            <div class="product-price">€<?php echo $fetch_product['prijs']; ?></div>
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['naam']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['prijs']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                            <a href="artikelpage.php?pro_id=<?php echo $fetch_product['idartikel']; ?>" class="btn btn-success">Add to cart</a>
                        </div>
                    </form>

                    <?php 
                        }
                    }
                    ?>
            </form>

    </main>
    <?php include('include/footer.php'); ?>

