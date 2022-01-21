<?php
require '../vendor/autoload.php';
include '../functions.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$html =
'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table border="1" cellpadding="10" cellspacing="0">
<thead>
  <tr>
    <th>Number</th>
    <th>Name</th>
    <th>Buys Date</th>
 
    <th>Status </th>
    <th> Total Purchase </th>
    <th>Description</th>
  </tr>
</thead>';
        $num = 1;
        $total = 0;
        $result = queryitem("SELECT * FROM pembelian beli JOIN login logs ON beli.iduser = logs.iduser");
        $cekbuktifoto = query("SELECT * FROM pembayaran");
        // var_dump($cekbuktifoto);
    foreach($result as $fetchcostumer)  {

      
  $html .='<tr>
    <td>'.$num.'</td>
    <td>'.$fetchcostumer['nama'].'</td>
    <td>'.$fetchcostumer['tanggal_pembelian'].'</td>
   
 
    <td>'.$fetchcostumer['status'].'</td>
    <td>Rp. '.number_format($fetchcostumer['total_pembelian'],2,",",".") .'</td>';
    $total = $total + $fetchcostumer['total_pembelian'];

    $html .= '<td> Detail Invoice
    &nbsp;';
        if ($fetchcostumer['status'] == 'Already paid' or $fetchcostumer['status'] == 'Product is on the way' or $fetchcostumer['status'] == 'Product has been shipped'  ) { 
            $html .= 'Info Purchase </td>'; 
        }
        elseif ($fetchcostumer['status'] == 'Product has arrived' and $cekbuktifoto[0]['buktifoto'] != "" ) { 
           $html .= 'Product has arrived </a> &nbsp;
          Evidence Photo </a> </td> ';
         } 

        $num++;
    }
   
  $html .= '</tr>

</table>
</body>
</html>';
$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream();

?>