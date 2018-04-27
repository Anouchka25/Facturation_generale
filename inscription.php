<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  </head>
  <body>
    <br/><br/>
    <main>
<?php require_once('includes/menu.php') ?>
<br/><br/><br/>
<h2>S'inscrire pour sauvegarder vos factures</h2>
  <form method="post" action="inscriptionT.php">
    <fieldset>
       <legend>Vos coordonnées</legend> <!-- Titre du fieldset -->

       <i class="fas fa-at" style="color:#57B223"></i>&nbsp<label for="email">Email:</label>
       <input type="email" name="email" id="email" /><br><br>

       <i class="fas fa-user" style="color:#57B223"></i>&nbsp<label for="pseudo">Pseudo *:</label>
       <input type="text" name="pseudo" id="pseudo" required /><br><br>

       <i class="fas fa-power-off" style="color:#57B223"></i>&nbsp<label for="password">Mot de passe *:</label>
       <input type="password" name="password" id="password" required /><br><br>

       <input type="submit" name="inscription" value="S'inscrire" class="bouton" />
       &nbsp&nbsp&nbsp<a href="seconnecter.php"> Se connecter </a>
      </form>

    </fieldset>
      <br/><br/><br/>
      <?php require_once('includes/footer.php') ?>
    </main>
  </body>
</html>
