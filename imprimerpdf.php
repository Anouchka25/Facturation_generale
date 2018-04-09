<?php
require_once 'connexion.php';
date_default_timezone_set('Europe/Berlin');
require_once dirname(__FILE__).'/vendor/autoload.php';
require_once 'connexion.php';

use Spipu\Html2Pdf\Html2Pdf;

$str = '
    <page backtop="20mm" backright="10mm" backbottom="20mm" backleft="10mm">
    <style type="text/css">
    <!--
    table{width: 100%; border-collapse:collapse; font-size:18px}
    .header td{width: 50%; vertical-align: top}
    .text-left{text-align: left}
    .text-right{text-align: right}
    .text-center{text-align: center}
    .separator{height: 50px; width: 100%}
    .content td{border:solid 1px #CFD1D2; padding: 5px;}
    .content th{border:solid 1px #000000; padding: 5px; background-color: #000000; color: #FFFFFF}
    .ligne1Content{background-color:#57B223}
    .couleurgris{background-color:#DDDDDD; height:auto;}
    .tht, .taxe, .ttc{font-size: 1.2em;}
    .ttc{color:#57B223}
    .couleurverte{background-color: #57B223}
    .couleurmoinsgris{background: #EEEEEE;}
    .taille1{width:30%;}
    .taille2{width:15%;}
    .taille3{width:25%; }
    .taille4{width:20%;}
    .taille5{width:10%;}
    .header1{width:50%}
    .header2{width:50%}
    .tailleligne{height:200px}
    .taille1, taille2, taille3, taille4, taille5{height:auto;}
    -->
    </style>
';

$resFC1=$base->prepare("SELECT * FROM infosfacture WHERE num= ?");
$resFC1->bindValue(1, $id, PDO::PARAM_INT);
$resFC1->execute(array($_GET['num']));

$resultat1= $resFC1->fetch();

foreach ($resultat1 as $req){
    //$conditions = $req['conditions'];

    $str .= '
        <table class="header">
            <tr>
                <td class="text-left"></td>
                <td class="text-right"><b>'.$req['facturede'].'</b><br></td>
            </tr>
        </table>
        <div class="separator"></div>
        <table class="header">
            <tr>
                <td class="text-left"><b>'.$req['client'].'</b><br></td>
                <td class="text-right"></td>
            </tr>
        </table>
        <div class="separator"></div>
        <table>
            <tr>
                <td class="text-left header1">N° de facture: <b>'.$req['num'].'</b>  </td>
                <td class="text-right header2">Date: <b>'.$req['datefacture'].'</b></td>
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

$resultat= $resFC->fetchAll();

$somme = 0;
foreach ($resultat as $req):
    $str .= '
        <tr class="couleurgris">
          <td class="text-left couleurgris taille1">'.$req['designation'].'</td>
          <td class="text-center couleurmoinsgris taille2">'.$req['quantite'].'</td>
          <td class="text-center taille3">'.$req['prixht'].'</td>
          <td class="text-center taille5">'.$req['taxe'].'</td>
          <td class="text-center couleurverte taille4">'.($req['quantite'] * $req['prixht']).'</td>
        </tr>
    ';
$sommeht += $req['prixht'] * $req['quantite'];
endforeach;

$str .= '
    </tbody>
    <tfoot>
        <tr>
        <td colspan="4" class="text-right tht">TOTAL HT</td>
        <td class="tht text-center">'.$sommeht.'</td>
        </tr>';
        $sommetaxe = 0;
        foreach ($resultat as $req):
          $prixtotalht=$req['prixht'] * $req['quantite'];
          $prixtaxe=$prixtotalht * $req['taxe']/100;
      $str .= '
      <tr>
          <td colspan="4" class="text-right tht">TAXE à '.$req['taxe'].' % </td>
          <td class="text-center">'.$prixtaxe.' </td>
      </tr>
      ';

        $sommetaxe += $prixtaxe ;
        endforeach;

        $str .= '
        <tr>
          <td colspan="4" class="text-right tht">TOTAL TTC</td>
          <td class="text-center">'.($sommeht + $sommetaxe).'</td>
        </tr>

        <tr>
        <td colspan="5"><h3>Conditions et moyens de paiement:</h3><br/>'.$req['conditions'].'</td>
        </tr>
    </tfoot>
    </table>
    ';
    }
    $str .= ' </page> ';

/*
 * On instancie notre constructeur
 * On affiche le contenu
 * On génére notre PDF
 */

$pdf = new HTML2PDF('P','A4','fr','true','UTF-8');
$pdf->writeHTML($str);
$pdf->Output('facture.pdf');
?>
