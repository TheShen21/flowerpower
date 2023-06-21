<?php
include "incl_admin.php";
require_once "../backend/config.php";
if(isset($_POST["send"])) {
    $voornaam = $_POST["voornaam"];
    $tussenvoegsel = $_POST["tussenvoegsel"];
    $achternaam = $_POST["achternaam"];

    $sql = "INSERT INTO medewerker (voornaam, tussenvoegsel, achternaam)
        VALUE ('$voornaam', '$tussenvoegsel', '$achternaam')";
    if ($link->query($sql) === true) {
        echo "medewerker toegevoegd";
    } else {
        echo "Error:" . $sql . "<br>" . $link->error;
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="adminstyle/medewerker.css">
</head>
<body>
<header>
    <h1>Medewerker</h1>
</header>
<div class="container">
<form method="post" class="medewerker">
    <label for="voornaam">Naam</label>
    <input type="text" id="voornaam" name="voornaam" required>

    <label for="tussenvoegsel">tussenvoegsel</label>
    <input type="text" id="tussenvoegsel" name="tussenvoegsel">

    <label for="achternaam">achternaam</label>
    <input type="text" id="achternaam" name="achternaam" required>

    <button type="submit" name="send">Toevoegen</button>
</form>
</div>
<a href="medewerkerlijst.php">Terug</a>
<script>


</script>
</body>
</html>