<?php
require_once dirname(__FILE__).'/vendor/autoload.php';


use Spipu\Html2Pdf\Html2Pdf;
$pdf = new HTML2PDF('P','A4','fr','true','UTF-8');
$pdf->writeHTML('<h1>Hello Anouchka25</h1>');
$pdf->output('facture.pdf');
 ?>
