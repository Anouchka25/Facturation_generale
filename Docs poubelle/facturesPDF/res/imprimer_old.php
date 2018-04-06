<style type="text/css">
table{width: 100%; border-collapse:collapse; font-size:18px}
.header td{width: 50%; vertical-align: top, background-color: #57B223}
.text-left{text-align: left}
.text-right{text-align: right}
.text-center{text-align: center}
.separator{height: 150px; width: 100%}
.content td{border:solid 1px #CFD1D2; padding: 5px;}
.content th{border:solid 1px #000000; padding: 5px; background-color: #000000; color: #FFFFFF}
.ligne1Content{background-color:#57B223}
.couleurgris{background-color:#DDDDDD; height:200px}
</style>
<page backtop="20mm" backright="10mm" backbottom="20mm" backleft="10mm">
  <?php
  require_once 'connexion.php';

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
        <b>Facturé à : <?php echo $req['client'] ?></b>
        <br>
      </td>
      <td class="text-right">
        <b>Facture de : <?php echo $req['$facturede'] ?></b>
        <br>
      </td>
    </tr>
  </table>
  <div class="separator"></div>
<table>
  <tr>
  <td class="text-left">N° de facture: <?php echo $req['num'] ?>  </td>
  <td class="text-right">Date: <?php echo $req['datefacture'] ?></td>
  </tr>
 </table>
 <?php endforeach; ?>
<br/><br/>
  <table class="content">
    <thead>
    <tr class="ligne1Content">
      <td class="text-left">DESIGNATION</td>
      <td class="text-center">QUANTITE</td>
      <td class="text-center">PRIX HT</td>
      <td class="text-right">TOTAL HT</td>
    </tr>
  </thead>
  <tbody>
    <?php $somme = 0;?>
    <?php foreach ($resFC as $req): ?>
  <tr class="couleurgris">
      <td class="text-left"><?php echo $req['designation'] ?></td>
      <td class="text-center"><?php echo $req['$quantite'] ?></td>
      <td class="text-center"><?php echo $req['$prixht'] ?></td>
      <td class="text-right"><?php echo $req['quantite'] * $req['prixht'] ?></td>
  </tr>
  <?php $somme += $presta['prixht'] * $presta['quantite']; ?>
  <?php endforeach; ?>
 </tbody>
 <tfoot>
   <tr>
     <td colspan="3">TOTAL HT</td>
     <td><?= $somme; ?></td>
   </tr>
   <tr>
     <td colspan="3">TAXE à <?php echo $tva; ?>% </td>
     <td><?= $somme * $tva/100; ?></td>
   </tr>
   <tr>
     <td colspan="3">TOTAL TTC</td>
     <td><?= $somme + $somme*$tva/100; ?></td>
   </tr>
 </tfoot>
  </table>
</page>
