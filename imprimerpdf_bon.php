<?php
require_once 'connexion.php';
date_default_timezone_set('Europe/Berlin');
require_once dirname(__FILE__).'/vendor/autoload.php';
//require_once 'connexion.php';

use Spipu\Html2Pdf\Html2Pdf;
ob_start();
$str = '
    <page backtop="0mm" backright="10mm" backbottom="20mm" backleft="10mm">
    <style type="text/css">
    <!--
    table{width: 100%; border-collapse:collapse; font-size:12px}
    .header td{width: 50%; vertical-align: top}
    .text-left{text-align: left}
    .text-right{text-align: right}
    .text-center{text-align: center}
    .separator{height: 20px; width: 100%}
    .content td{border:solid 1px #CFD1D2; padding: 5px;}
    .content th{border:solid 1px #000000; padding: 5px; background-color: #000000; color: #FFFFFF}
    .ligne1Content{background-color:#57B223}
    .couleurgris{background-color:#DDDDDD; height:auto;}
    .tht, .taxe, .ttc{font-size: 1.2em;}
    .ttc{color:#57B223; font-weight:bold;}
    .couleurverte{background-color: #57B223}
    .couleurmoinsgris{background: #EEEEEE;}
    .taille1{width:40%;}
    .taille2{width:15%;}
    .taille3{width:15%; }
    .taille4{width:20%;}
    .taille5{width:10%;}
    .header1{width:50%}
    .header2{width:50%}
    .tailleligne{height:auto;}
    .taille1, taille2, taille3, taille4, taille5{height:auto;}
	span{font-size:14px; font-weight:bold; color:#57B223;}
	h1, h2, h3{color:#57B223;}
    -->
    </style>
';

$resFC1=$base->prepare("SELECT * FROM infosfacture WHERE num= ?");
$resFC1->bindValue(1, $id, PDO::PARAM_INT);
$resFC1->execute(array($_GET['num']));

$resultat1= $resFC1->fetch(PDO::FETCH_ASSOC);


    $str .= '
        <table class="header">
		    <tr>
                <td class="text-lef"><h1>Facture</h1><br></td>
            </tr>

            <tr>
                <td class="text-left"><span>De</span><br/><br/>'.$resultat1['facturede'].'<br></td>
				<td class="text-right"><span>N° de facture:</span> '.$resultat1['num'].'<br/><br/><span>Date: </span>'.$resultat1['datefacture'].'<br/><br/><span>N° TVA:</span> '.$resultat1['numtva'].'</td>
            </tr>

			<tr>
                <td class="text-left"><br/><br/><br/><span>FACTURÉ À</span><br/><br/>'.$resultat1['client'].'<br></td>
                <td class="text-right"></td>
            </tr>
        </table>

    ';
//}

$str .= '
    <br/><br/>
    <table class="content">
    <thead>
    <tr class="ligne1Content">
        <td class="text-left couleurgris taille1"><b>DESIGNATION</b></td>
        <td class="text-center couleurmoinsgris taille2"><b>QUANTITE</b></td>
        <td class="text-center couleurgris taille3"><b>PRIX HT</b></td>
        <td class="text-center couleurgris taille5"><b>TAXE</b></td>
        <td class="text-center couleurverte taille4"><b>TOTAL HT</b></td>
    </tr>
    </thead>
    <tbody>
';

$resFC = $base->prepare('SELECT infosfacture.num, infosfacture.client, infosfacture.datefacture, infosfacture.facturede, infosfacture.conditions, facturation.designation, facturation.quantite, facturation.prixht, facturation.taxe
    FROM infosfacture
    INNER JOIN facturation
    ON infosfacture.num=? AND facturation.fk_facturation_id=infosfacture.id');
$resFC->execute(array($_GET['num']));

$resultat= $resFC->fetchAll(PDO::FETCH_ASSOC);

$somme = 0;
foreach ($resultat as $req):
    $str .= '
        <tr class="couleurgris">
          <td class="text-left couleurgris taille1">'.$req['designation'].'</td>
          <td class="text-center couleurmoinsgris taille2">'.$req['quantite'].'</td>
          <td class="text-center taille3">'.$req['prixht'].'€</td>
          <td class="text-center taille5">'.$req['taxe'].'</td>
          <td class="text-center couleurverte taille4">'.($req['quantite'] * $req['prixht']).'€</td>
        </tr>
    ';
$sommeht += $req['prixht'] * $req['quantite'];
endforeach;

$str .= '
    </tbody>
    <tfoot>
        <tr>
        <td colspan="4" class="text-right tht">TOTAL HT</td>
        <td class="tht text-center">'.$sommeht.'€</td>
        </tr>';
        $sommetaxe = 0;
        foreach ($resultat as $req):
          $prixtotalht=$req['prixht'] * $req['quantite'];
          $prixtaxe=$prixtotalht * $req['taxe']/100;
      $str .= '
      <tr>
          <td colspan="4" class="text-right tht">TAXE à '.$req['taxe'].' % </td>
          <td class="text-center">'.$prixtaxe.'€ </td>
      </tr>
      ';

        $sommetaxe += $prixtaxe ;
        endforeach;

        $str .= '
        <tr>
          <td colspan="4" class="text-right"><h3>TOTAL TTC A PAYER</h3></td>
          <td class="text-center"><h3>'.($sommeht + $sommetaxe).'€</h3></td>
        </tr>

        <tr>
        <td colspan="5"><h3>Conditions et moyens de paiement:</h3><br/>'.$resultat1['conditions'].'</td>
        </tr>
    </tfoot>
    </table>
    ';
    //}
    $str .= ' </page> ';

/*
 * On instancie notre constructeur
 * On affiche le contenu
 * On génére notre PDF
 */

echo $str;
$html = ob_get_clean();

$pdf = new HTML2PDF('P','A4','fr','true','UTF-8');
$pdf->writeHTML($html);
$pdf->output('facture.pdf');
?>
