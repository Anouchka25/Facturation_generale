<?php
require_once dirname(__FILE__).'/../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

ob_start();
?>
// Contenu HTML qui sera converti en PDF
<page>
    <table cellspacing="10" border="1" style="width: 100%; text-align: left;font-size: 14px;">
    <tr>
        <td style="width:20%; text-align:center; color:blue"><b>Id</b></td>
        <td style="width:50%; text-align:center; color:red"><b>Nom et prénom</b></td>
        <td style="width:10%; text-align:center; color:green"><b>Date de naissance</b></td>
        <td style="width:20%; text-align:center; color:purple"><b>Lieu</b></td>
    </tr>

    <tr>
        <td>1</td>
        <td>Dupont Nicolas</td>
        <td>16/06/1989</td>
        <td>France</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Lemaitre Jacques</td>
        <td>25/12/1990</td>
        <td>France</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Rodriguez Marc</td>
        <td>01/05/1991</td>
        <td>Espagne</td>
    </tr>
    </table>
</page>

<?php
$content = ob_get_clean();

// Inclure le fichier Html2pdf
require_once('vendor/spipu/html2pdf/src/Html2Pdf.php');

// Initialisation de la classe HTML2PDF()
$html2pdf = new HTML2PDF('P', 'A4', 'fr');

// Insérer le contenu HTML
$html2pdf->WriteHTML($content);

// Retour du format PDF ayant comme nom de fichier : 'exemple.pdf'
$html2pdf->Output('exemple.pdf');

?>
