<?php
include "include/database.php";
include('include/header.php');
$grand_total = 0;

?>





    <div class="container">
        <table class="table my-3">
            <a href="cart%20function/emptycart.php" class="btn btn-sm btn-danger mt-2">Winkelwagen leegmaken</a>
            <thead>
            <tr class="text-center">
                <th>S.no</th>
                <th>Image</th>
                <th>Product Naam</th>
                <th>Aantal</th>
                <th>prijs</th>
                <th>totaal prijs</th>
            </tr>
            </thead>
            <tbody>
            <?php

            if (isset($_SESSION['cart'])) :
                $i = 1;
                foreach ($_SESSION['cart'] as $cart) :
                    ?>
                    <tr class="text-center">
                        <td><?php echo $i; ?> # </td>
                        <?php
                        $imageid = $cart['pro_id'];

                        $sql = mysqli_query($link,"SELECT image FROM artikel WHERE idartikel = '$imageid'");
                        if(mysqli_num_rows($sql) > 0){
                            while ($fetch_image = mysqli_fetch_assoc($sql)){

                        ?>
                        <td><img src="admin/<?php echo $fetch_image['image']; ?>"></td>
                        <?php
                        }
                        }
                        ?>
                        <?php
                        $select_product = mysqli_query($link,"SELECT naam FROM artikel WHERE idartikel = '$imageid'");
                        if(mysqli_num_rows($select_product) > 0){
                        while ($fetch_naam = mysqli_fetch_assoc($select_product)){
                        ?>
                        <td><?php echo $fetch_naam['naam'] ?></td>
                        <?php
                        }
                        }
                            ?>
                        <td>
                            <form action="cart%20function/update.php" method="post">
                                <input type="number" value="<?= $cart['qty']; ?>" name="qty" min="1">
                                <input type="hidden" name="upid" value="<?= $cart['pro_id']; ?>">
                                <input type="submit" name="update" value="Update" class="btn btn-sm btn-warning">
                            </form>
                        </td>

                    <?php
                    $select_price = mysqli_query($link,"SELECT prijs FROM artikel WHERE idartikel = '$imageid'");

                    if(mysqli_num_rows($select_price) > 0){
                        while ($fetch_price = mysqli_fetch_assoc($select_price)){
                            ?>
                        <td>
                            €<?php echo $fetch_price['prijs']?>
                        </td>
                            <td>
                                €<?php echo $sub_total = $fetch_price['prijs'] * $cart['qty'] ; ?>
                            </td>
                            <?php
                            $grand_total += $sub_total;
                        }
                    }
                    ?>

                        <td><a class="btn btn-sm btn-danger" href="cart%20function/removecartitem.php?id=<?= $cart['pro_id']; ?>">Remove</a></td>
                    </tr>

                    <?php
                    $i++;
                endforeach;
            endif;
            ?>
            <tr class="table-bottom">
                <td></td>
                <td colspan="3"></td>
                <td>Totaal bedrag:</td>
                <td>€<?php echo $grand_total; ?>/-</td>

            </tr>
            </tbody>
        </table>
        <div class="continue-btn">
            <a href="artikelpage.php" class="bt" >Veder bestellen</a>
        </div>
        <div class="checkout-btn">
            <a href="check.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Bestelling plaatsen</a>
        </div>
    </div>

<?php include('include/footer.php'); ?>