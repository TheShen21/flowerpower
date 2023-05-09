<?php

require_once "../backend/config.php";

$name = $_POST["name"];
$opmerking = $_POST["opmerking"];
$prijs = $_POST["prijs"];
$opslag = $_POST["opslag"];

$sql = "INSERT INTO artikel (naam, omschrijving, prijs, opslag)
        VALUE ('$name', '$opmerking', $prijs, $opslag)";
if ($link->query($sql) === true) {
    echo "Artikel toegevoegd";

    }
else {
    echo "Error:" .$sql. "<br>" .$link->error;
}



?>