<?php require_once 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Créer une facture</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  </head>
  <body>
    <?
    session_start();

    /*
    si la variable de session pseudo n'existe pas cela siginifie que le visiteur
    n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
    acceder à l'espace membres
    */
    $id_membre= $_SESSION['id_membre'];
    if(isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo'])) {

    ?>

    <header class="clearfix">
      <?php require_once('includes/menu.php') ?>

    </header>
    <main>
<center>
<a href="listeFactures.php">Liste de mes factures</a><br/><br/><br/>
<a href="monprofil.php">Mon profil</a>
</center>
<br/><br/><br/>
<?php require_once('includes/footer.php') ?>
</main>
<?php
}
else {
include('seconnecter.php');
 }
 ?>
</body>
</html>
