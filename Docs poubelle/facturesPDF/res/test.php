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
  require_once '../connexion.php';

  $resFC = $base->prepare('SELECT * FROM facturation WHERE id= ?');
  $resFC->execute(array($_GET['id']));
  ?>
  <table class="header">
    <tr>
      <td class="text-left">
        <b>Prénom Nom</b>
        <br>Adresse
        <br>Code postal
        <br>Pays
      </td>
      <td class="text-right">
        <b>Prénom Nom</b>
        <br>Adresse
        <br>Code postal
        <br>Pays
      </td>
    </tr>
  </table>
  <div class="separator"></div>
  <table>
  <tr>
  <td class="text-left">N° de facture: <?php echo $req['num'] ?>  </td>
  <td class="text-right">Date: <?php echo $req['dateFacture'] ?></td>
  </tr>
</table>
<br/><br/>
  <table class="content">
    <thead>
    <tr class="ligne1Content">
      <td class="text-left">PRESTATION</td>
      <td class="text-center">NOMBRE DE JOURS</td>
      <td class="text-center">TARIF JOURNALIER</td>
      <td class="text-right">TOTAL HT</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($resFC as $req): ?>
  <tr class="couleurgris">
      <td class="text-left"><?php echo $req['prestation'] ?></td>
      <td class="text-center"><?php echo $req['nbjours'] ?></td>
      <td class="text-center"><?php echo $req['tarifjour'] ?></td>
      <td class="text-right"><?php echo $req['nbjours'] * $req['tarifjour'] ?></td>
  </tr>
  <?php endforeach; ?>
 </tbody>
  </table>
</page>
