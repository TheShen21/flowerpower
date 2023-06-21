<?php
include 'include/database.php';
include 'include/header.php';

if(isset($_POST['factuur_pdf'])){
    header("location:factuur/pdf.php");
}

$factuurid = $_SESSION['factuurid'];
$grand_total = 0;
$select_user = mysqli_query($link, "SELECT * FROM klant INNER JOIN factuur ON klant.idklant = factuur.idklant WHERE factuurid = '$factuurid'");
$fetch_user = mysqli_fetch_assoc($select_user);

if(isset($_POST['update_status'])){
    $afgehaald = isset($_POST['afgehaald']) ? $_POST['afgehaald'] : 0;
    $insert_afgehaald = mysqli_query($link, "UPDATE factuur SET afgehaald ='$afgehaald' WHERE factuurid = '$factuurid'");

}
?>
<div class="container">
<h2>Bestellingnummer: <?php echo $factuurid?></h2>
</div>
<div class="container">
<table class="table my-3">
    <thead>
<tr class="text-center">
    <th>id</th>
    <th>image</th>
    <th>naam</th>
    <th>aantal</th>
    <th>prijs</th>
    <th>Totaal prijs</th>
    </thead>
</tr>
<?php

$select_product = "SELECT * from artikel_has_factuur INNER JOIN artikel ON artikel_has_factuur.artikel_idartikel = artikel.idartikel WHERE factuur_factuurid = '$factuurid'";
//$select = "select * from factuur";
$query = mysqli_query($link, $select_product);
$num = mysqli_num_rows($query);
if ($num > 0) {
    while ($result = mysqli_fetch_assoc($query)) {



        echo "
                <tr>
                    <td>
                    " . $result['idartikel'] . "
                    </td>
                    <td>
                    <img src='admin/".$result['image']."' height='100' width='100'>
                    </td>
                    <td>
                    ".$result['naam']."
                    </td>
                    <td>
                    ".$result['qty']."
                    </td>
                    <td>
                    ".$result['prijs']."
                    </td>
                    <td>
                    ".$sub_total = $result['prijs'] * $result['qty']."
                    </td>
                    

                </tr>
                
                ";
        $grand_total += $sub_total;
    }

}

?>
    <form method="post">
<tr class="table-bottom">
    <td></td>
    <td colspan="3"><input type="submit" value="factuur downloaden(pdf)" name="factuur_pdf"> </td>
    <td>Grand total:</td>
    <td>€<?php echo $grand_total; ?>/-</td>
</tr>
    </form>
</table>
</div>
<div class="terug">
<a href="factuurlijst.php" class="terug">Terug</a>
</div>
<?php
include "include/footer.php";
?>