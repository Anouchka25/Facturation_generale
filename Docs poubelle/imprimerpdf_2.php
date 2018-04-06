<?php
require_once 'connexion.php';
date_default_timezone_set('Europe/Berlin');
/*
 * Générer un PDF à partir d'une base de données
 */


/*
 * Début de la temporisation de sortie
 */
ob_start();
?>
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
-->
</style>

  <?php

  $resFC1=$base->prepare("SELECT * FROM infosfacture WHERE num= ?");
  $resFC1->bindValue(1, $id, PDO::PARAM_INT);
  $resFC1->execute(array($_GET['num']));

  $resFC = $base->prepare('SELECT infosfacture.num, infosfacture.client, infosfacture.datefacture, infosfacture.facturede, infosfacture.conditions, facturation.designation, facturation.quantite, facturation.prixht
  FROM infosfacture
  INNER JOIN facturation
  ON infosfacture.num=? AND facturation.fk_facturation_id=infosfacture.id');
  $resFC->execute(array($_GET['num']));
  ?>
  <?php foreach ($resFC1 as $req): ?>
  <table class="header">
    <tr>
      <td class="text-left">
        Facturé à :<br/> <b><?php echo $req['client'] ?></b>
        <br>
      </td>
      <td class="text-right">
        Facture de :<br/><b> <?php echo $req['facturede'] ?></b>
        <br>
      </td>
    </tr>
  </table>
  <div class="separator"></div>
<table>
  <tr>
  <td class="text-left">N° de facture: <b><?php echo $req['num'] ?></b>  </td>
  <td class="text-right">Date: <b><?php echo $req['datefacture'] ?></b></td>
  </tr>
 </table>
 <?php $tva = $req['tva'] ?>
 <?php $conditions = $req['conditions'] ?>
 <?php endforeach; ?>
<br/><br/>
  <table class="content">
    <thead>
    <tr class="ligne1Content">
      <td class="text-left couleurgris"><b>DESIGNATION</b></td>
      <td class="text-center couleurmoinsgris"><b>QUANTITE</b></td>
      <td class="text-center couleurgris"><b>PRIX HT</b></td>
      <td class="text-right couleurverte"><b>TOTAL HT</b></td>
    </tr>
  </thead>
  <tbody>
    <?php $somme = 0;?>
    <?php foreach ($resFC as $req): ?>
  <tr class="couleurgris">
      <td class="text-left couleurgris"><?= $req['designation'] ?></td>
      <td class="text-center couleurmoinsgris"><?= $req['quantite'] ?></td>
      <td class="text-center"><?= $req['prixht'] ?></td>
      <td class="text-right couleurverte"><?= $req['quantite'] * $req['prixht'] ?></td>
  </tr>
  <?php $somme += $req['prixht'] * $req['quantite']; ?>
  <?php endforeach; ?>
 </tbody>
 <tfoot>
   <tr>
     <td colspan="3" class="text-right tht">TOTAL HT</td>
     <td class="tht"><?= $somme; ?></td>
   </tr>
   <tr>
     <td colspan="3" class="text-right taxe">TAXE à <?php echo $tva; ?>% </td>
     <td class="taxe"><?= $somme * $tva/100; ?></td>
   </tr>
   <tr>
     <td colspan="3" class="text-right ttc">TOTAL TTC</td>
     <td class="ttc"><?= $somme + $somme*$tva/100; ?></td>
   </tr>

   <tr>
     <td colspan="4"><h3>Conditions et moyens de paiement:</h3><br/><?= $conditions ?></td>
   </tr>

 </tfoot>
  </table>
</page>
<?php

/*
 * $content récupére toutes les données mises en mémoire.
 */

$content = ob_get_clean();

file_put_contents ( "content.html" , $content);
?>
