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
//var_dump($_POST);
// generate request params
$params = [];
$values = '';
$facturation = [];
foreach ($_POST['designation'] as $key => $designation) {
    $params[':designation' . $key] = $designation;
    $params[':num' . $key]    = $_POST['num'];
    $params[':client' . $key]    = $_POST['client'];
    $params[':quantite' . $key]    = $_POST['quantite'][$key];
    $params[':prixht' . $key]  = $_POST['prixht'][$key];
    $params[':datefacture' . $key] = $_POST['datefacture'];
    $params[':facturede' . $key] = $_POST['facturede'];
    $params[':conditions' . $key] = $_POST['conditions'];

    $values .= '(:num' . $key . ' , :client' . $key . ', :designation' . $key . ', :quantite' . $key . ', :prixht' . $key . ', :datefacture' . $key . ', :facturede' . $key . ', :conditions' . $key . '),';
      // prepare facturation data
    $facturation[] = [
      'designation' => $designation,
      'num'  => $_POST['num'][$key],
      'client'  => $_POST['client'][$key],
      'quantite'    => $_POST['quantite'][$key],
      'prixht'  => $_POST['prixht'][$key],
      'datefacture'  => $_POST['datefacture'][$key],
      'facturede'  => $_POST['facturede'][$key],
      'conditions'  => $_POST['conditions'][$key]
    ];
}

//var_dump($_POST['num'][$key]);

// remove trailing ","
$values = rtrim($values, ',');
$req = $base->prepare('INSERT INTO facturation (num, client, designation, quantite, prixht, datefacture, facturede, conditions) VALUES '. $values);
$req->execute($params);
$base = null;
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Afficher une Facture</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="icon" type="image/png" href="favicon.png" />
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
