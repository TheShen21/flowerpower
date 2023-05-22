<?php

require_once "../backend/config.php";
if(isset($_POST["submit"])) {
    $name = $_POST["name"];
    $opmerking = $_POST["opmerking"];
    $prijs = $_POST["prijs"];
    $opslag = $_POST["opslag"];

//upload foto
    $image_dir = "../image/";
    $image_file = $image_dir . basename($_FILES["upload"]["name"]);
    $product_image = $image_dir . $_FILES["upload"]["name"];
    $image_dir . $_FILES["upload"]["name"];
    $imageType = strtolower(pathinfo($image_file, PATHINFO_EXTENSION));
    $check = $_FILES["upload"]["size"];
    $image_ok = 0;

    if (file_exists($image_file)) {
        echo "<script>alert('the file already exist')</script>";
        $upload_ok = 0;
    } else {
        $upload_ok = 1;
        if ($check !== false) {
            $upload_ok = 1;
            if ($imageType == 'jpg' || $imageType == 'png' || $imageType == 'jpeg' || $imageType == 'gif') {
                $upload_ok = 1;
            } else {
                echo '<script>alert("please change the image format")</script>';
                $upload_ok = 0;
            }
        } else {
            echo '<script>alert("Photo size is zero, please change the photo")</script>';
            $upload_ok = 0;
        }
    }
    if ($upload_ok == 0) {
        echo '<script>alert("error. please try later again")</script>';
    } else {
        if ($upload_ok == 1) {
            move_uploaded_file($_FILES["upload"]["tmp_name"], $image_file);
            $sql = "INSERT INTO artikel (naam, omschrijving, prijs, opslag, image)
        VALUE ('$name', '$opmerking', $prijs, $opslag, '$product_image')";
            if ($link->query($sql) === true) {
                echo "Artikel toegevoegd";

            } else {
                echo "Error:" . $sql . "<br>" . $link->error;
            }
        }
    }
}





?>