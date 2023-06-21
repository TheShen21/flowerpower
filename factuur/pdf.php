<?php
include '../backend/config.php';
session_start();
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;
$factuurid = $_SESSION['factuurid'];

$select_user = mysqli_query($link, "SELECT * FROM klant INNER JOIN factuur ON klant.idklant = factuur.idklant WHERE factuurid = '$factuurid'");
$fetch_user = mysqli_fetch_assoc($select_user);
$select_factuur = mysqli_query($link, "SELECT * FROM factuur WHERE factuurid = '$factuurid'");
$fetch_factuur = mysqli_fetch_assoc($select_factuur);
$grand_total = 0;

$html = '<html>
<link rel="stylesheet" href="factuur.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>factuur</title>
</head>

    

<body>
    <img src="img/flower.jpg" width="100" height="100" >
        <h3> '.$fetch_user["voornaam"].$fetch_user["tussenvoegsel"].$fetch_user["achternaam"].'</h3>
        <h3> '.$fetch_factuur["datum"].'</h3>
    <div>
    <h2>factuur</h2>
    <h3>#'.$fetch_factuur["factuurid"].'</h3>
    </div>
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>product naam</th>
            <th>prijs</th>
            <th>aantal</th>
            <th>totaal</th>
        </tr>
        </thead>
        <tbody>';
$select_product = "SELECT * from artikel_has_factuur INNER JOIN artikel ON artikel_has_factuur.artikel_idartikel = artikel.idartikel WHERE factuur_factuurid = '$factuurid'";

$query = mysqli_query($link, $select_product);
$num = mysqli_num_rows($query);
if ($num > 0) {
    while ($result = mysqli_fetch_assoc($query)) {

                $html .= '<tr>
                    <td>
                    ' . $result['idartikel'] . '
                    </td>
                    <td>
                    '.$result['naam'].'
                    </td>
                    <td>
                    €'.$result['prijs'].'
                    </td>
                    <td>
                    '.$result['qty'].'
                    </td>
                    <td>
                    €'.$sub_total = $result['prijs'] * $result['qty'].'
                    </td>
                </tr>';

    }

}
$grand_total += $sub_total;
$delen = 100;
$keer = 21;


$html .= '</tbody>
        <tr>
            <th colspan="4" class="my-table">btw (21%)</th>
            <th>€'.number_format((float)$grand_total / $delen * $keer,2).'</th>
        </tr>
        <tr>
            <th colspan="4" class="my-table">Totaal bedrag</th>
            <th>€'.$grand_total.' </th>
        </tr>
    </table>
</body>
</html>';

$dompdf = new Dompdf;
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$dompdf->stream('factuur.pdf');
?>