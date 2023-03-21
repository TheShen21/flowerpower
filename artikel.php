<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'flowepower');


$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, 3308);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());


}

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