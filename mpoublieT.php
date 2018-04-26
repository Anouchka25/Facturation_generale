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

    <header class="clearfix">
      <?php require_once('includes/menu.php') ?>

    </header>
    <main>
<center>
  <?
  require_once 'connexion.php';

  $email = isset($_POST['email']) ? $_POST['email'] : NULL;

  $req=$base->prepare("SELECT * FROM membres WHERE email= ?");
  $req->bindValue(1, $email, PDO::PARAM_STR);
  //$req->bindValue(2, $pseudo, PDO::PARAM_STR);
  $req->execute(array($_POST['email']));
 ?>
  <form action="passwordT.php" method="post">
    <? if($req){
      foreach ($req as $result):
        echo "Pseudo :".$result['pseudo'];
        ?>
        <br/><br/>
        <input type="hidden" name="pseudo" value="<?= $result['pseudo'] ?>" >
        <input type="hidden" name="email" value="<?= $result['email'] ?>" >
      <? endforeach; ?>
    <label>Nouveau mot de passe *</label><br/>
    <input type="text" name="password1" ><br/><br/>
    <label>Confirmez votre nouveau mot de passe *</label><br/>
    <input type="text" name="password2" ><br/><br/>
  <center><input type="submit" value ="Valider" class="bouton" /></center>
  </form>
  </center>
  <?
}
else {
  echo '<a href="inscription.php">Vous n\'êtes pas inscrit, Veuillez vous inscrire !</a>';
}
  ?>
</main>
    <footer>
      <?php require_once('includes/footer.php') ?>
    </footer>
  </body>
</html>
