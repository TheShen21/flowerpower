<?php
include "../backend/config.php";
include "incl_admin.php";
if(isset($_POST['go_order'])){
    $_SESSION['factuurid'] = $_POST['factuurid'];
    header("location: bestelling.php");
}

if(isset($_POST['update_medewerker'])){
    $medewerker = $_POST['name'];
    $factuurid = $_POST['factuurid'];
    //$afgehaald = isset($_POST['afgehaald']) ? $_POST['afgehaald'] : 0;
    //$insert_afgehaald = mysqli_query($link, "UPDATE factuur SET afgehaald ='$afgehaald' WHERE factuurid = '$factuurid'");


    $select_mede = "SELECT voornaam FROM medewerker WHERE voornaam = '$medewerker'";
    $resulten = mysqli_query($link, $select_mede);
    if($resulten->num_rows == 0){
        echo "Deze werknemer staat niet geregistreerd!";
    } else {
        $select_id = mysqli_query($link, "SELECT idmedewerker FROM medewerker WHERE voornaam = '$medewerker'");


        if(mysqli_num_rows($select_id) > 0){
            $fetch_id = mysqli_fetch_assoc($select_id);
            $id = $fetch_id['idmedewerker'];

            $add_medewerker = mysqli_query($link, "UPDATE factuur SET idmedewerker = '$id' WHERE factuurid = '$factuurid'");


        }
        echo "werknemer aangepast";
    }

}

?>
<link rel="stylesheet" href="adminstyle/bestelling.css">
<body>
<header>
    <h1>Bestelling lijst</h1>
</header>
<div class="container">
<table border="2" cellpadding="0" class="bestelling">

    <tr class="text-aline">
        <th>id</th>
        <th>datum</th>
        <th>medewerker</th>
        <th>afgehaald</th>
        <th>update</th>
        <th>meer info</th>
    </tr>
    <?php
    $select = "select * from factuur INNER JOIN medewerker ON factuur.idmedewerker = medewerker.idmedewerker ORDER BY factuurid DESC";
    //$select = "select * from factuur";
    $query = mysqli_query($link, $select);
    $num = mysqli_num_rows($query);
    if ($num > 0) {
        while ($result = mysqli_fetch_assoc($query)) {
            if($result['afgehaald'] == 1){
                $check = "ja";
            } else {
                $check = "nee";
            }



            echo "
                <tr>
                <form method='post'>
                    <td>
                    " . $result['factuurid'] . "
                    <input hidden value='" . $result['factuurid'] . "' name='factuurid'>
                    </td>
                    <td>
                    " . $result['datum'] . "
                    </td>
                    
                    <td>
                    <input type='text' name='name' value='".$result['voornaam']."'>
                    
                    </td>
                    <td>
                    ".$check."
                    </td>
                    <td>
                    <input type='submit' value='update medewerker' name='update_medewerker'>
                    </td>
                    <td>
                    <input type='submit' value='More info' name='go_order'>
                    </td>
                    </form>

                </tr>
                
                ";
        }

    }
    ?>
</table>
</div>
<a href="adminmenu.php">Terug</a>
</body>

