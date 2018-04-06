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

$req1 = $base->prepare('UPDATE infosfacture
  SET num = :num,
  client = :client,
  datefacture = :datefacture,
  facturede = :facturede,
  conditions = :conditions
  tva = :tva
  WHERE id= ?');
  $req1->execute(array('num' => $num,
                          'client' => $client,
                          'datefacture'=> $datefacture,
                          'facturede'=> $facturede,
                          'conditions'=> $conditions,
                          ':id'=> $id));

  $req2 = $base->prepare('UPDATE facturation
          SET  designation = :designation,
                          quantite = :quantite,
                          prixht = :prixht
                          WHERE fk_facturation_id= ?');

  $req2->execute(array('designation'=> $designation,
                      'quantite'=> $quantite,
                      'prixht'=> $prixht))
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Mise à jour Facture</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  </head>
  <body>
    <?php
  session_start();
  if (isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo']))
{ ?>
    <header class="clearfix">

    </header>
    <?php require_once('includes/menu.php') ?>
    <br/> <br/>
    <main>
    <?php
    echo"<script language=\"javascript\">"
    echo"alert('La facture n° .$num. a bien été mise à jour ')";
    echo"</script>";?>
      <!-- <br/> <br/>
      <p> Les données ont bien été mise à jour</p> -->
    </main>
    <?php require_once('includes/footer.php') ?>
    <?
    }
    else {
    echo 'Vous n\'êtes pas connecté.';
    ?>
  </body>
</html>
