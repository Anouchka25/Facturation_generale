<?session_start();


if(isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo'])) {

 $id_membre= $_SESSION['id_membre'];
?>

<?php
}
else {
$id_membre= 1;
?>
<?php } ?>

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
$taxe = isset($_POST['taxe']) ? $_POST['taxe'] : NULL;
$numtva = isset($_POST['numtva']) ? $_POST['numtva'] : NULL;
$id_membre= $_SESSION['id_membre'];

$req1 = $base->prepare('INSERT INTO infosfacture (num, numtva, client, datefacture, facturede, conditions, id_membre)
VALUES (:num, :numtva, :client, :datefacture, :facturede, :conditions, :id_membre)');

$req2 = $base->prepare('INSERT INTO facturation (designation, quantite, prixht, taxe, fk_facturation_id)
VALUES (:designation, :quantite, :prixht, :taxe, :fk_facturation_id)');


$param = array();
$params[':num']    = $_POST['num'];
$params[':numtva']    = $_POST['numtva'];
$params[':client']    = $_POST['client'];
$params[':datefacture'] = $_POST['datefacture'];
$params[':facturede'] = $_POST['facturede'];
$params[':conditions'] = $_POST['conditions'];
$params[':id_membre'] = $id_membre;

$req1->execute($params);


$fk_facturation_id = $base->lastInsertId();


$params = array();
$params[':fk_facturation_id'] = $fk_facturation_id;

foreach ($_POST['designation'] as $key => $designation) {
    $params[':designation'] = $designation;
    $params[':quantite']    = $_POST['quantite'][$key];
    $params[':prixht']  = $_POST['prixht'][$key];
    $params[':taxe'] = $_POST['taxe'][$key];


    $facturation[] = [
      'designation' => $designation,
      'quantite'    => $_POST['quantite'][$key],
      'prixht'  => $_POST['prixht'][$key],
      'taxe'  => $_POST['taxe'][$key],
    ];
    $req2->execute($params);
}
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
        <a href="index.php">
      <figure>
        <img src="logo.png" title="Imprimer votre facture" width="70px">
            <figcaption class="slogan">Facturation simple et gratuite</figcaption>
      </figure>
      </a>
      </div>
      <div id="company">
      <div class="to"><h2>De:</h2> <?php echo $facturede ?></div>
      </div>
    </header>
    <main>
      <?php require_once('includes/menu.php') ?>
      <br/><br/><br/>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to"><h2>Facture à:</h2><?php echo $client ?></div>
        </div>
        <div id="invoice">
          <h2>FACTURE N° <?php echo $num ?></h2>
          <div class="date">Date: <?php echo $datefacture ?></div>
        </div>
      </div>
      <div><h2>Facture à:</h2><?php echo $numtva ?> </div>
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
      <th class="unit">TAXE</th>
      <th class="total">Total HT</th>
    </tr>
  </thead>
  <tbody>
    <?php $sommeht = 0;?>
    <?php foreach ($facturation as $presta): ?>
    <tr>
        <td class="desc"><?= $presta['designation'] ?></td>
        <td class="qty"><?= $presta['quantite'] ?></td>
        <td class="unit"><?= $presta['prixht'] ?></td>
        <td class="unit"><?= $presta['taxe'] ?></td>
        <td class="total"><?= $presta['prixht'] * $presta['quantite'] ?></td>
      </tr>
      <?php $sommeht += $presta['prixht'] * $presta['quantite']; ?>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="4">TOTAL HT</td>
      <td><?= $sommeht; ?></td>
    </tr>

    <?php $sommetaxe = 0;?>
    <?php foreach ($facturation as $presta): ?>
      <?php
      $prixtotalht=$presta['prixht'] * $presta['quantite']; //Prix HT d'une designation
      $valeurtaxe= $presta['taxe']/100; //Valeur decimale de la taxe ex:20% ==> 0,2
      $prixtaxe=$prixtotalht * $valeurtaxe; //Valeur de la taxe à payer
      ?>
    <tr>
      <td colspan="4">TAXE à <?= $presta['taxe'] ?>% </td>
      <td><?= $prixtaxe ?></td>
    </tr>
    <?php $sommetaxe += $prixtaxe ; ?>
    <?php endforeach; ?>
    <tr>
      <td colspan="4">TOTAL TTC</td>
      <td><?= $sommeht + $sommetaxe ; ?></td>
    </tr>
  </tfoot>
</table>
<div id="notices">
        <div><h2>Conditions et moyens de paiement:</h2></div>
        <div class="notice"> <?php echo $conditions ?> </div>
</div>

      <br/>
      <?= '<center>
      <a href="imprimerpdf.php?num='.$num.'" target="_blank">
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
