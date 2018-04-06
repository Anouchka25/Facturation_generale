<?php
require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
ob_start();
?>
<style type="text/css">
<!--
table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 20px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;
  font-weight: normal;
}

table td {
  text-align: right;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}
-->
</style>
<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
<page_header>
<header class="clearfix">
  <div id="logo">
    <img src="logo.png">
  </div>
  <div id="company">
    <h2 class="name">Micro-Entreprise Anouchka MINKOUE OBAME</h2>
    <div>
      <p>RUE RÉTIMARE LOGT 042, IMM. ADOLPHE ADAM
76190 YVETOT,<br/> Inscrite au registre du commerce et des sociétés de Rouen sous le n° 794 069 997 00029<br/> Représentée par Anouchka MINKOUE OBAME agissant en qualité de gérante
</P>
  </div>
  </div>
</header>
</page_header>

  <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th class="no">#</th>
        <th class="desc">PRESTATION</th>
        <th class="qty">NOMBRE DE JOURS</th>
        <th class="unit">TARIF JOURNALIER</th>
        <th class="total">TOTAL HT</th>
      </tr>

      <tr>
        <td class="no">01</td>
        <td class="desc"></td>
        <td class="qty"></td>
        <td class="unit"></td>
        <td class="total"></td>
      </tr>
  </table>

  <page_footer>
  Page footer
  </page_footer>
</page>

<?php
$content = ob_get_clean();

$html2pdf = new Html2Pdf('P', 'A4', 'fr');
$html2pdf->writeHTML($content);
$html2pdf->output('exemple.pdf');
 ?>
