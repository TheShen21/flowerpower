<?php
require_once "../backend/config.php";
include "incl_admin.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = mysqli_query($link,"DELETE FROM `medewerker` WHERE `idmedewerker`='$id'");
}
$select = "select * from medewerker";
$query = mysqli_query($link, $select);
if(isset($_POST['update_item'])) {
    $medew_id = $_POST['idmedewerker'];
    $medew_voornaam = $_POST['voornaam'];
    $medew_tussen = $_POST['tussenvoegsel'];
    $mede_achternaam = $_POST['achternaam'];


    $sql = "UPDATE medewerker SET voornaam = '$medew_voornaam', tussenvoegsel = '$medew_tussen', achternaam = '$mede_achternaam' WHERE idmedewerker = $medew_id";

    if ($link->query($sql) === TRUE) {


    } else {
        echo "Error updating record: " . $link->error;
    }
    header("Refresh: 0");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="adminstyle/medewerker.css">
</head>
<header>
    <h1>Medewerkers</h1>
</header>
<body>
<main class="">
<table border="2" cellpadding="0">

    <tr>
        <th>id</th>
        <th>voornaam</th>
        <th>tussenvoegsel</th>
        <th>achternaam</th>
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
                    <td>".$result['idmedewerker']."</td>
                    <input hidden name='idmedewerker' value='".$result['idmedewerker']."'>
                    <td>
                    <input type='text' name='voornaam' value='".$result['voornaam']."'>
                    </td>
                    <td>
                    <input type='text' name='tussenvoegsel' value='".$result['tussenvoegsel']."'>
                    </td>
                    <td>
                    <input type='text' name='achternaam' value='".$result['achternaam']."'>
                    </td>
                    <td> 
                        <input type='submit' class='product-button' value='Update medewerker' name='update_item'>
                    </td>
                    </form>
                    <td> 
                        <a href='medewerkerlijst.php?id=".$result['idmedewerker']."' ><button>Delete</button></a>
                    </td>
                </tr>
                
                ";
        }
    }

    ?>
</table>
</main>
<a href="adminmenu.php">Terug</a>
<a href="medewerker.php">Medewerker toevoegen</a>
</body>
</html>
