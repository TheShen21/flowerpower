<?php
include 'include/database.php';
include 'include/header.php';
$select_user = mysqli_query($link, "SELECT * FROM klant WHERE idklant = '$id'");
$fetch_user = mysqli_fetch_assoc($select_user);

?>
<br>
<div class="container">
    <h2>Hoi <?php echo $fetch_user['voornaam']?></h2>
</div>
<br>
<br>

<main class="container-profiel">
    <a>Menu:</a>
<div class="knop-factuur">
    <a href="factuurlijst.php" class="menu">Bestellingen</a>
</div>
<div class="knop-profiel">
    <a href="profile.php" class="menu">Profiel bewerken</a>
</div>
</main>
<br>
<br>
<br>
<br><br>
<br><br><br><br>
<br>
<?php
include 'include/footer.php';

?>
