<?php
include 'include/database.php';
include 'include/header.php';
if(isset($_POST['go_order'])){
    $_SESSION['factuurid'] = $_POST['factuurid'];
    header("location: factuur.php");
}



?>
<br>

<div class="container">
    <h3>Bestellingen</h3>
</div>
<div class="container">
    <table class="table my-3">
        <thead>
        <tr class="text-center">
            <th>Bestelling nummer</th>
            <th>bestelt op</th>
            <th>meer info</th>
        </tr>
        </thead>
        <?php
        $select = "select * from factuur INNER JOIN klant ON factuur.idklant = klant.idklant WHERE klant.idklant ='$id'";

        $query = mysqli_query($link, $select);
        $num = mysqli_num_rows($query);
        if ($num > 0) {
            while ($result = mysqli_fetch_assoc($query)) {
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
                    <input type='submit' value='Meer info' name='go_order'>
                    </td>
                    </form>
                </tr>
                
                ";
            }

        }
        ?>
    </table>
</div>
<div class="terug">
<a href="profielmenu.php" class="terug">Terug</a>
</div>
<?php
include "include/footer.php";
?>


