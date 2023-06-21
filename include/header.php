<?php
session_start();
?>

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
        require_once "backend/config.php";



        ?>
        <ul>
            <li class="header-li"><a href="index.php">Home</a> </li>
            <li class="header-li"><a href="artikelpage.php">Artikel</a> </li>
            <li class="header-li"><a href="contact.php">Contact</a></li>
            <?php
            if(isset($_SESSION["loggedin"]) > 0){
                echo "<li class='header-li'><a href='profielmenu.php'>Profile page</a></li>";
                echo "<li class='header-li'><a href='logout.php'>logout</a></li>";
            }
            else{
                echo "<li class='header-li'><a href='register.php'>Register</a></li>";
                echo "<li class='header-li'><a href='login.php'>login</a></li>";
            }
            ?>
            <li class="header-li"><a href="cart.php">Winkelwagen <span><?php if(isset($_SESSION['cart'])) {
                echo count($_SESSION['cart']);
                        } ?></span></a></li>
        </ul>
    </div>
</nav>