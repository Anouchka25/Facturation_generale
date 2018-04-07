<?php
require_once 'connexion.php';

$resFC1=$base->prepare("SELECT * FROM infosfacture WHERE id= ?");
$resFC1->bindValue(1, $id, PDO::PARAM_INT);
$resFC1->execute(array($_GET['id']));

$resFC=$base->prepare("SELECT infosfacture.num, infosfacture.client, infosfacture.datefacture, infosfacture.facturede, infosfacture.conditions, facturation.designation, facturation.quantite, facturation.prixht, facturation.taxe
FROM infosfacture
INNER JOIN facturation
ON infosfacture.id=? AND facturation.fk_facturation_id=infosfacture.id");
$resFC->bindValue(1, $id, PDO::PARAM_INT);
$resFC->execute(array($_GET['id']));


$resultat= $resFC->fetchAll();
//var_dump($resultat);
 ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Afficher une Facture</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  </head>
  <body>
    <br/>
    <?php require_once('includes/menu.php') ?>
    <br/><br/>
    <?php foreach ($resFC1 as $uneFacture1): ?>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <div id="company">
      <div class="to"><h2></h2> <?php echo $uneFacture1['facturede'] ?></div>
      </div>

    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to"><h3><?= $uneFacture1['client'] ?></h3></div>
        </div>
        <div id="invoice">
          <h3>FACTURE N°:  <?= $uneFacture1['num'] ?></h3>
          <div class="date"><h3> Date: <?= $uneFacture1['datefacture'] ?></h3></div>
        </div>
      </div>
      <div><h3>N° TVA intracommunautaire:&nbsp<?= $uneFacture1['numtva'] ?></h3> </div>
      <?php $identifiant = $uneFacture1['id']; ?>
      <?php endforeach; ?>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="desc">DESIGNATION</th>
            <th class="qty">QUANTITÉ</th>
            <th class="unit">PRIX HT</th>
            <th class="unit">TAXE</th>
            <th class="total">TOTAL HT</th>
          </tr>
        </thead>
        <tbody>
          <?php $sommeht = 0;?>
          <?php foreach ($resultat as $uneFacture):
            //$prixtotalht=$req['prixht'] * $req['quantite'];
            ?>
          <tr>

            <td class="desc"><?= $uneFacture['designation'] ?></td>
            <td class="qty"><?= $uneFacture['quantite'] ?></td>
            <td class="unit"><?= $uneFacture['prixht'] ?></td>
            <td class="unit"><?= $uneFacture['taxe'] ?></td>
            <td class="total"><?= $uneFacture['prixht'] * $uneFacture['quantite'] ?></td>
          </tr>
          <?php $sommeht += $uneFacture['prixht'] * $uneFacture['quantite']; ?>
          <?php endforeach; ?>

        </tbody>
        <tfoot>
          <tr>
            <td colspan="4">TOTAL HT</td>
            <td><?= $sommeht; ?></td>
          </tr>
          <?php $sommetaxe = 0;?>
          <?php foreach ($resultat as $uneFacture): ?>

            <?php
            $prixtotalht=$uneFacture['prixht'] * $uneFacture['quantite'];
            $valeurtaxe= $uneFacture['taxe']/100;
            $prixtaxe=$prixtotalht * $valeurtaxe;
            ?>
          <tr>
            <td colspan="4">TAXE à <?= $uneFacture['taxe'] ?> % </td>
            <td><?= $uneFacture['prixht'] * $uneFacture['quantite']  ?></td>
          </tr>
          <?php $sommetaxe += $prixtotalht ; ?>
          <?php endforeach; ?>
          <tr>
            <td colspan="4">TOTAL TTC</td>
            <td><?= $sommeht + $sommetaxe ; ?></td>
          </tr>
        </tfoot>
      </table>

      <div id="notices">
        <div><h2>Conditions et moyens de paiement:</h2></div>
        <div class="notice"> <?php echo $uneFacture['conditions'] ?> </div>
      </div><br/>
      <?= '<center>
      <a href=" imprimerpdf.php?num='.$uneFacture['num'].'" target="_blank">
      <figure>
        <img src="printer.png" title="Imprimer votre facture" width="50px">
            <figcaption>Imprimer votre facture</figcaption>
      </figure>
      </a>
      </center>' ?>
      <br/>
    </main>
    <?php require_once('includes/footer.php') ?>
  </body>
</html>
