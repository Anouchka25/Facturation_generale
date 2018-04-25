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

<?php
$req = $base->query('SELECT * FROM membres WHERE id_membre='.$id_membre.'');
$req->execute();
$result = $req->fetch(PDO::FETCH_ASSOC);
//$pass_hache = password_hash($result['password'], PASSWORD_DEFAULT);
?>
<center>
Email: <?= $result['Email'] ?><br/>
Pseudo: <?= $result['pseudo'] ?><br/>
Mot de passe: **********<br/>
<a href="password.php">Renouveler le mot de passe</a>
</center>
</main>
    <footer>
      <?php require_once('includes/footer.php') ?>
    </footer>
    <?php
    }
    else {
    include('seconnecter.php');
     }
     ?>
  </body>
</html>
