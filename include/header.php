<?php
session_start();
?>
<!
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product_pagina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <div class="header">
        <h2>logo</h2>

        <?php
        $id = "";
        if(isset($_SESSION["loggedin"])){
            $id = $_SESSION["id"];


        }

        $table = "winkelwagen";
        $winkelwagen = $table. $id;
        require_once "backend/config.php";
        $select_rows = mysqli_query($link, "SELECT * FROM $winkelwagen") or die('query failed');
        $row_count = mysqli_num_rows($select_rows);

        ?>
        <ul>
            <li><a href="artikelpage.php">Artikel</a> </li>
            <?php
            if(isset($_SESSION["loggedin"]) > 0){
                echo "<li><a href='profile.php'>Profile page</a></li>";
                echo "<li><a href='logout.php'>logout</a></li>";
            }
            else{
                echo "<li><a href='register.php'>Register</a></li>";
                echo "<li><a href='login.php'>login</a></li>";
            }
            ?>
            <li><a href="cart.php">cart <span><?php echo $row_count; ?></span></a></li>
        </ul>
    </div>
</nav>