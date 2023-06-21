<?php

    require_once "../backend/config.php";
    include "incl_admin.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $delete = mysqli_query($link,"DELETE FROM `artikel` WHERE `idartikel`='$id'");
    }
    $select = "select * from artikel";
    $query = mysqli_query($link, $select);
    if(isset($_POST['update_item'])) {
        $artikel_id = $_POST['idartikel'];
        $artikel_naam = $_POST['naam'];
        $artikel_prijs = $_POST['prijs'];
        $artikel_omschrijving = $_POST['omschrijving'];
        $artikel_opslag = $_POST['opslag'];

        $sql = "UPDATE artikel SET naam = '$artikel_naam', omschrijving = '$artikel_omschrijving', prijs = '$artikel_prijs', opslag = '$artikel_opslag' WHERE idartikel = $artikel_id";

        if ($link->query($sql) === TRUE) {

            header("Refresh: 0");

        } else {
            echo "Error updating record: " . $link->error;
        }

    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="adminstyle/artikel.css">
</head>
<header>
    <h1>Artikel lijst</h1>
</header>
<body>
<table border="2" cellpadding="0">

    <tr>
        <th>id</th>
        <th>image</th>
        <th>naam</th>
        <th>prijs</th>
        <th>opslag</th>
        <th>omschrijving</th>
        <th>Update</th>
        <th>delete</th>
    </tr>
    <?php
        $num = mysqli_num_rows($query);
        if ($num > 0){
            while ($result = mysqli_fetch_assoc($query)){
                echo "
                <tr>
                <form method='post'>
                    <td>".$result['idartikel']."</td>
                    <input hidden name='idartikel' value='".$result['idartikel']."'>
                    <td>
                    <img src='".$result['image']."' width='100' height='100'>
                    </td>
                    <td>
                    <input type='text' name='naam' value='".$result['naam']."'>
                    </td>
                    <td>
                    <input type='text' name='prijs' value='".$result['prijs']."'>
                    </td>
                    <td>
                    <input type='text' name='opslag' value='".$result['opslag']."'>
                    </td>
                    <td>
                    <textarea name='omschrijving'>".$result['omschrijving']."</textarea>
                    </td>
                    
                    <td> 
                        <input type='submit' class='product-button' value='Update item' name='update_item'>
                    </td>
                    </form>
                    <td> 
                        <a href='artikellijst.php?id=".$result['idartikel']."' ><button>Delete</button></a>
                    </td>
                </tr>
                
                ";
            }
        }

    ?>




</table>
<a href="adminmenu.php">Terug</a>
<a href="artikel.html">Artikel toevoegen</a>
</body>
</html>