
<?php
ob_start();

?>
<page backtop="5%" backbottom="5%" backleft="5%"backright="5%">
  <table style="width:100%">
    <tr>
      <th>#</th>
      <th>PRESTATION</th>
      <th>NOMBRE DE JOURS</th>
      <th>TARIF JOURNALIER</th>
      <th>TOTAL HT</th>
    </tr>
<?php
// On vérifie si la variable existe et sinon elle vaut NULL
$num = isset($_POST['num']) ? $_POST['num'] : NULL;
$client = isset($_POST['client']) ? $_POST['client'] : NULL;
$prestation = isset($_POST['prestation']) ? $_POST['prestation'] : NULL;
$nbjours = isset($_POST['nbjours']) ? $_POST['nbjours'] : NULL;
$tarifjour = isset($_POST['tarifjour']) ? $_POST['tarifjour'] : NULL;
$taxe = isset($_POST['taxe']) ? $_POST['taxe'] : NULL;
 ?>
    <tr>
      <th>#</th>
      <th><?php echo $prestation ?></th>
      <th><?php echo $nbjours ?></th>
      <th><?php echo $tarifjour ?></th>
      <th><?php echo $tarifjour * $nbjours ?></th>
    </tr>

    </table>
</page>

<?php
    $content = ob_get_clean();
    require("vendor/spipu/html2pdf/src/Html2Pdf.php");

    $html2pdf = new HTML2PDF("P", "A4", "fr", "true", "UTF-8" );

    //$html2pdf->setDefaultFont("Arial");
    $html2pdf->writeHTML($content);
    $html2pdf->Output("votre_pdf.pdf");
?>
