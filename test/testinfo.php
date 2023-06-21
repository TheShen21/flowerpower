<?php
    include "../backend/config.php";
    session_start();
    $factuurid = $_SESSION['factuurid'];
    $grand_total = 0;
    $select_user = mysqli_query($link, "SELECT * FROM klant INNER JOIN factuur ON klant.idklant = factuur.idklant WHERE factuurid = '$factuurid'");
    $fetch_user = mysqli_fetch_assoc($select_user);

    if(isset($_POST['update_status'])){
        $afgehaald = isset($_POST['afgehaald']) ? $_POST['afgehaald'] : 0;
        $insert_afgehaald = mysqli_query($link, "UPDATE factuur SET afgehaald ='$afgehaald' WHERE factuurid = '$factuurid'");

    }
?>
<body>
<table border="2" cellpadding="0">
    <div>
        <h2><?php echo $fetch_user['voornaam']?></h2>
    </div>

    <tr>
        <th>id</th>
        <th>image</th>
        <th>naam</th>
        <th>aantal</th>
        <th>prijs</th>
        <th>Totaal prijs</th>

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
                    <img src='../admin/".$result['image']."' height='100' width='100'>
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
        }

    }
    $grand_total += $sub_total;
    ?>
    <tr class="table-bottom">

        <td colspan="4"></td>
        <td>Grand total:</td>
        <td>€<?php echo $grand_total; ?>/-</td>
    </tr>
</table>

<a href="test.php">Terug</a>
<form method="post">
    <input type="checkbox" name="afgehaald" value="1">
    <input type="submit" name="update_status" value="update">
</form>
</body>
