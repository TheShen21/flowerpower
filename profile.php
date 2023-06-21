<?php
include "include/database.php";
include "include/header.php";

if(isset($_POST['update_profile'])){

    $pro_naam = $_POST['voornaam'];
    $pro_tussen = $_POST['tussenvoegsel'];
    $pro_achternaam = $_POST['achternaam'];
    $pro_adres = $_POST['adres'];
    $pro_huisnummer = $_POST['huisnummer'];
    $pro_plaats = $_POST['plaats'];
    $pro_postcode = $_POST['postcode'];
    $pro_telefoon = $_POST['telefoonnummer'];
    $pro_gdatum = $_POST['geboortedatum'];

    $sql = "UPDATE klant SET voornaam = '$pro_naam', tussenvoegsel = '$pro_tussen', achternaam = '$pro_achternaam', adres = '$pro_adres', huisnummer = '$pro_huisnummer', plaats = '$pro_plaats', postcode = '$pro_postcode',
        telefoon = '$pro_telefoon', geboortedatum = '$pro_gdatum' WHERE idklant = $id";

    if ($link->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $link->error;
    }


}

$select_klant = mysqli_query($link, "SELECT * FROM klant WHERE idklant = $id");
while ($row = mysqli_fetch_array($select_klant)){
    $name = $row['voornaam'];
    $tussen = $row['tussenvoegsel'];
    $achternaam = $row['achternaam'];
    $adres = $row['adres'];
    $huisnummer = $row['huisnummer'];
    $plaats = $row['plaats'];
    $postcode = $row['postcode'];
    $tel = $row['telefoon'];
    $g_datum = $row['geboortedatum'];
}





?>
<br>
<br>
<br>
<div class="wrapper">
    <a>Profiel bewerken</a>
    <br>
    <br>
    <form method="post">
        <label>Voornaam</label>
        <input type="text" name="voornaam" value="<?php echo $name ?> "><br><br>
        <label>Tussenvoegsel</label>
        <input type="text" name="tussenvoegsel" value="<?php echo $tussen ?> "> <br><br>
        <label>Achternaam</label>
        <input type="text" name="achternaam" value="<?php echo $achternaam ?> "><br><br>
        <label>Adres</label>
        <input type="text" name="adres"  value="<?php echo $adres ?> "><br><br>
        <label>Huisnummer</label>
        <input type="text" name="huisnummer"  value="<?php echo $huisnummer ?> "><br><br>
        <label>Plaats</label>
        <input type="text" name="plaats"  value="<?php echo $plaats ?> "><br><br>
        <label>Postcode</label>
        <input type="text" name="postcode"  value="<?php echo $postcode ?> "><br><br>
        <label>Telefoonnummer</label>
        <input type="tel" name="telefoonnummer"  value="<?php echo $tel ?> "><br><br>
        <label>Geboortedatum</label>
        <input type="date" name="geboortedatum" value="<?php echo $g_datum ?> " required>
        <br>
        <br>
        <input type="submit" class="product-button"  value="Update profile" name="update_profile">
    </form>
</div>
<div class="terug">
<a href="profielmenu.php" class="terug">Terug</a>
</div>
<br>
<br>
<br>



<?php

include "include/footer.php";

?>
