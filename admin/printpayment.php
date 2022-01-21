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
<table border="1" cellpadding="15" cellspacing="0">
<thead>
  <tr>
    <th>Number</th>
    <th>Name </th>
    <th>Buys Date</th>
    <th>Pays Date</th>
    <th>Total Purchase</th>
  </tr>
</thead>
<tbody>'; 
        $num = 1;
        $total = 0;
     $result  = query("SELECT * FROM pembelian JOIN pembayaran ON pembelian.idpembelian = pembayaran.idpembelian WHERE status='Product has arrived'"); 
     foreach ($result as $k) { 
        
  $html .= '<tr>
    <td>'.$num .'</td>

    <td>'.$k['nama'].'</td>
    <td>'. $k['tanggal_pembelian'].'</td>
    <td>'.$k['tanggal'].'</td>
    <td>'.number_format($k['total_pembelian'],2,",",".").'</td>';
        $total = $total + $k['total_pembelian'];
  $html .= '</tr>';
 
  $num++;
   } 
  $html .= '<tr>
    <td colspan="4">Total</td>
    <td><b> '.number_format($total,2,",",".").'</b></td>
    
  </tr>

</tbody>
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