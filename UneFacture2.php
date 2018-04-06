<?php
require_once 'connexion.php';

$resFC1=$base->prepare("SELECT * FROM infosfacture WHERE id= ?");
$resFC1->bindValue(1, $id, PDO::PARAM_INT);
$resFC1->execute(array($_GET['id']));

$resFC=$base->prepare("SELECT infosfacture.num, infosfacture.client, infosfacture.datefacture, infosfacture.facturede, infosfacture.conditions, facturation.designation, facturation.quantite, facturation.prixht
FROM infosfacture
INNER JOIN facturation
ON infosfacture.id=? AND facturation.fk_facturation_id=infosfacture.id");
$resFC->bindValue(1, $id, PDO::PARAM_INT);
$resFC->execute(array($_GET['id']));


//$resultat= $resFC->fetchAll();
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
      <div class="to"><h2>De:</h2> <?php echo $uneFacture1['facturede'] ?></div>
      </div>

    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to"><h2>Facture à:</h2> <?= $uneFacture1['client'] ?></div>
        </div>
        <div id="invoice">
          <h1>FACTURE N° <?= $uneFacture1['num'] ?></h1>
          <div class="date">Date: <?= $uneFacture1['datefacture'] ?></div>
        </div>
      </div>
      <?php $tva= $uneFacture1['tva']; ?>
      <?php $identifiant = $uneFacture1['id']; ?>
      <?php endforeach; ?>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="desc">DESIGNATION</th>
            <th class="qty">QUANTITÉ</th>
            <th class="unit">PRIX HT</th>
            <th class="total">TOTAL HT</th>
          </tr>
        </thead>
        <tbody>
          <?php $somme = 0;?>
          <?php foreach ($resFC as $uneFacture): ?>
          <tr>

            <td class="desc"><?= $uneFacture['designation'] ?></td>
            <td class="qty"><?= $uneFacture['quantite'] ?></td>
            <td class="unit"><?= $uneFacture['prixht'] ?></td>
            <td class="total"><?= $uneFacture['prixht'] * $uneFacture['quantite'] ?></td>
          </tr>
          <?php $somme += $uneFacture['prixht'] * $uneFacture['quantite']; ?>
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

      <div id="notices">
        <div><h2>Conditions et moyens de paiement:</h2></div>
        <div class="notice"> <?php echo $uneFacture['conditions'] ?> </div>
      </div>
      <?= '<a href="imprimerpdf.php?num='.$uneFacture['num'].'" target="_blank">Imprimer</a>' ?>

      <?= '<a href="modifierFacture.php?id='.$identifiant.'">Modifier</a>' ?>
    </main>
    <?php require_once('includes/footer.php') ?>
  </body>
</html>
