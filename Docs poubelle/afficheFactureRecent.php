<?php
require_once 'connexion.php';
//On vérifie si la variable existe et sinon elle vaut NULL
$num = isset($_POST['num']) ? $_POST['num'] : NULL;
$client = isset($_POST['client']) ? $_POST['client'] : NULL;
$designation = isset($_POST['designation']) ? $_POST['designation'] : NULL;
$quantite = isset($_POST['quantite']) ? $_POST['quantite'] : NULL;
$prixht = isset($_POST['prixht']) ? $_POST['prixht'] : NULL;
$datefacture = isset($_POST['datefacture']) ? $_POST['datefacture'] : NULL;
$facturede = isset($_POST['facturede']) ? $_POST['facturede'] : NULL;
$conditions = isset($_POST['conditions']) ? $_POST['conditions'] : NULL;
$tva = isset($_POST['tva']) ? $_POST['tva'] : NULL;

$req1 = $base->prepare('INSERT INTO infosfacture (num, client, datefacture, facturede, conditions, tva)
VALUES (:num, :client, :datefacture, :facturede, :conditions, :tva)');

// $req2 = $base->prepare('INSERT INTO facturation (designation, quantite, prixht, fk_facturation_id)
// VALUES (:designation, :quantite, :prixht, :fk_facturation_id)');


$param = array();
$params[':num']    = $_POST['num'];
$params[':client']    = $_POST['client'];
$params[':datefacture'] = $_POST['datefacture'];
$params[':facturede'] = $_POST['facturede'];
$params[':conditions'] = $_POST['conditions'];
$params[':tva'] = $_POST['tva'];

$req1->execute($params);
$fk_facturation_id = $base->lastInsertId();


$params = array();
$params[':fk_facturation_id'] = $fk_facturation_id;
$values = '';
$facturation = [];
foreach ($_POST['designation'] as $key => $designation) {
      $params[':designation'] = $designation;
      $params[':quantite']    = $_POST['quantite'][$key];
      $params[':prixht']  = $_POST['prixht'][$key];

      $values .= '(:designation' . $key . ', :quantite' . $key . ', :prixht' . $key . ', :fk_facturation_id)';

      $facturation[] = [
        'designation' => $designation,
        'quantite'    => $_POST['quantite'][$key],
        'prixht'  => $_POST['prixht'][$key],
      ];
}
//var_dump($facturation);

// remove trailing ","
$values = rtrim($values, ',');
$req2 = $base->prepare('INSERT INTO facturation (designation, quantite, prixht, fk_facturation_id) VALUES '. $values);
$req2->execute($params);
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Afficher une Facture</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <div id="company">
      <div class="to"><h2>De:</h2> <?php echo $facturede ?></div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to"><h2>Facture à:</h2><?php echo $client ?></div>

        </div>
        <div id="invoice">
          <h1>FACTURE N° <?php echo $num ?></h1>
          <div class="date">Date: <?php echo $datefacture ?></div>
        </div>
      </div>
      <?php
//       echo '<pre>';
// print_r($_POST['num'][$key]);
// echo '</pre>';
       ?>
<table>
  <thead>
    <tr>
      <th class="desc">DESIGNATION</th>
      <th class="qty">QUANTITÉ</th>
      <th class="unit">PRIX HT</th>
      <th class="total">Total HT</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($facturation as $presta) : ?>
    <tr>
        <td class="desc"><?= $presta['designation'] ?></td>
        <td class="qty"><?= $presta['quantite'] ?></td>
        <td class="unit"><?= $presta['prixht'] ?></td>
        <td class="total"><?= $presta['prixht'] * $presta['quantite'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<div id="notices">
        <div><h2>Conditions et moyens de paiement:</h2></div>
        <div class="notice"> <?php echo $conditions ?> </div>
      </div>
      <?= '<a href="facturesPDF/imprimer.php?num='.$num.'" target="_blank">Imprimer</a>' ?>
    </main>
    <?php require_once('includes/footer.php') ?>
  </body>
</html>
