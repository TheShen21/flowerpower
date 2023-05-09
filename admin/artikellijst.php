<?php

    require_once "../backend/config.php";

    $select = "select * from artikel";
    $query = mysqli_query($link, $select);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $delete = mysqli_query($link,"DELETE FROM `artikel` WHERE `idartikel`='$id'");
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
<table border="1" cellpadding="0">
    <tr>
        <th>id</th>
        <th>naam</th>
        <th>prijs</th>
        <th>opslag</th>
        <th>delete</th>
    </tr>
    <?php
        $num = mysqli_num_rows($query);
        if ($num > 0){
            while ($result = mysqli_fetch_assoc($query)){
                echo "
                <tr>
                    <td>".$result['idartikel']."</td>
                    <td>".$result['naam']."</td>
                    <td>".$result['prijs']."</td>
                    <td>".$result['opslag']."</td>
                    <td> 
                        <a href='artikellijst.php?id=".$result['idartikel']."' ><button>Delete</button></a>
                    </td>
                </tr>
                
                ";
            }
        }

    ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

</table>
</body>
</html>