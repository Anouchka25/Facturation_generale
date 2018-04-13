<?php
require_once 'connexion.php';
date_default_timezone_set('Europe/Berlin');

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
        <a href="index.php">
      <figure>
        <img src="logo.png" title="Imprimer votre facture" width="70px">
            <figcaption class="slogan">Facturation simple et gratuite</figcaption>
      </figure>
      </a>
      </div>
      <div id="company">
      <div class="to"> <?php echo $uneFacture1['facturede'] ?></div>
      </div>

    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to"><?= $uneFacture1['client'] ?></div>&nbsp
        </div>
        <div id="invoice">
          <span>FACTURE N°:</span>  <?= $uneFacture1['num'] ?>&nbsp<br/>
		  <span> DATE: </span><?php echo date('d/m/Y',strtotime($uneFacture1['datefacture']));  ?> &nbsp
		  <br/><span> N° TVA:&nbsp </span><?= $uneFacture1['numtva'] ?>&nbsp
        </div>
      </div>
      <?php $identifiant = $uneFacture1['id']; ?>
      <?php endforeach; ?>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="desc"><b>DESIGNATION</b></th>
            <th class="qty"><b>QUANTITÉ</b></th>
            <th class="unit"><b>PRIX HT</b></th>
            <th class="qty"><b>TAXE</b></th>
            <th class="total"><b>TOTAL HT</b></th>
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
            <td class="unit"><?= $uneFacture['prixht'] ?>€</td>
            <td class="qty"><?= $uneFacture['taxe'] ?>%</td>
            <td class="total"><?= $uneFacture['prixht'] * $uneFacture['quantite'] ?>€</td>
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
            $prixtotalht=$uneFacture['prixht'] * $uneFacture['quantite']; //Prix HT d'une designation
            $valeurtaxe= $uneFacture['taxe']/100; //Valeur decimale de la taxe ex:20% ==> 0,2
            $prixtaxe=$prixtotalht * $valeurtaxe; //Valeur de la taxe à payer
            ?>
          <tr>
            <td colspan="4">TAXE À <?= $uneFacture['taxe'] ?> % </td>
            <td><?= $prixtaxe  ?>€</td>
          </tr>
          <?php $sommetaxe += $prixtaxe ; ?>
          <?php endforeach; ?>
          <tr>
            <td colspan="4">TOTAL TTC À PAYER</td>
            <td><?= $sommeht + $sommetaxe ; ?>€</td>
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
