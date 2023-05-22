<?php
require_once "backend/config.php";
$sql = "SELECT * FROM artikel";
$all_product = $link->query($sql);
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
    <main class="container">
        <?php
        while ($row = mysqli_fetch_assoc($all_product)){
        ?>
        <div class="product">
            <div class="product-image">
                <img src="<?php echo $row["image"]; ?>" alt="">
            </div>
            <div class="caption">
                <p class="product-title"><?php echo $row["naam"]; ?></p>
                <b class="product-price"><b></b><?php echo $row["prijs"]; ?> </b></p>
                <p class="product-description"><b><?php echo $row["omschrijving"]; ?> </b></p>
            </div>
            <button class="product-button">add to cart</button>
        </div>
        <?php
        }
        ?>
    </main>


</body>
</html>
