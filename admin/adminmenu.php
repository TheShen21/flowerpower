<?php
include "incl_admin.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="adminstyle/adminmenu.css">
</head>
<body>
<header>
    <h1>Welkom in Adminpanel Flowerpower</h1>
</header>
<main class="container">
<div class="bestelling">
    <a href="bestellinglijst.php">Bestelling lijst</a>
</div>
<div class="medewerker">
    <a href="medewerkerlijst.php">Medewerker lijst</a>
</div>
<div class="artikel">
    <a href="artikellijst.php">Artikellijst</a>
</div>

<div class="logout">
    <a class="logout-btn" href="logoutadmin.php">logout</a>
</div>
</main>
</body>
</html>
