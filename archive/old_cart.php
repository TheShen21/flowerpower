<?php
include "include/database.php";
include('include/header.php');


if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($link, "UPDATE $winkelwagen SET quantity = '$update_value' WHERE idcart = '$update_id'");
    if($update_quantity_query){
        header('location:cart.php');
    };
};

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($link, "DELETE FROM $winkelwagen WHERE idcart = '$remove_id'");
    header('location:cart.php');
};

if(isset($_GET['delete_all'])){
    mysqli_query($link, "DELETE FROM $winkelwagen");
    header('location:cart.php');
}

?>





    <div class="container">

        <section class="shopping-cart">

            <h1 class="heading">shopping cart</h1>

            <table>

                <thead>
                <th>image</th>
                <th>name</th>
                <th>price</th>
                <th>quantity</th>
                <th>total price</th>
                <th>action</th>
                </thead>

                <tbody>

                <?php


                $select_cart = mysqli_query($link, "SELECT * FROM $winkelwagen ");
                $grand_total = 0;
                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                        ?>

                        <tr>
                            <td><img src="admin/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                            <td><?php echo $fetch_cart['name']; ?></td>
                            <td>€<?php echo $fetch_cart['prijs']; ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['idcart']; ?>" >
                                    <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                                    <input type="submit" value="update" name="update_update_btn">
                                </form>
                            </td>
                            <td>€<?php echo $sub_total = $fetch_cart['prijs'] * $fetch_cart['quantity']; ?></td>
                            <td><a href="cart.php?remove=<?php echo $fetch_cart['idcart']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
                        </tr>
                        <?php
                        $grand_total += $sub_total;
                    };
                };
                ?>
                <tr class="table-bottom">
                    <td><a href="artikelpage.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
                    <td colspan="3" >Grand total:</td>
                    <td>€<?php echo $grand_total; ?>/-</td>
                    <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
                </tr>

                </tbody>

            </table>

            <div class="checkout-btn">
                <a href="invoirce/checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
            </div>

        </section>

    </div>


<?php include('include/footer.php'); ?>
