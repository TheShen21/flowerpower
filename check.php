<?php
include "backend/config.php";
session_start();

if(isset($_SESSION["loggedin"])){

    $id = $_SESSION["id"];

    $sql = "INSERT INTO factuur(datum, idklant, idwinkel, afgehaald, idmedewerker) VALUE (CURRENT_DATE, '$id', '1', false, '0')";
    if ($link->query($sql) === true) {

        $rowsql = mysqli_query($link, "SELECT MAX(factuurid) AS max FROM factuur") ;
        $row = mysqli_fetch_array($rowsql);
        $factuurid = $row['max'];


    } else {
        echo "Error:" . $sql . "<br>" . $link->error;
    }
   if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $cart) {
           $artikelid = $cart['pro_id'];
           $qty = $cart['qty'];

            $sql = "INSERT INTO `artikel_has_factuur` (artikel_idartikel, factuur_factuurid, qty) VALUE ($artikelid, $factuurid, $qty)";
            if ($link->query($sql) === true) {

                unset($_SESSION['cart']);

            } else {
                echo "Error:" . $sql . "<br>" . $link->error;
            }
        }
    }

}

?>
<a href="index.php" type="button">Terug</a>

<?php

?>
