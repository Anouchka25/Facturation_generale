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
<form action="mpoublieT.php" method="post">
  <label>E-mail *</label><br/>
  <input type="email" name="email" ><br/><br/>
<center><input type="submit" value ="Valider" class="bouton" /></center>
</form>
</center>
</main>
    <footer>
      <?php require_once('includes/footer.php') ?>
    </footer>
  </body>
</html>
