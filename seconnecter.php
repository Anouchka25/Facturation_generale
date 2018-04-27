<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Se connecter</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  </head>
  <body>
    <br/><br/>
    <main>
<?php require_once('includes/menu.php') ?>
<br/><br/><br/>
<h2>Se connecter à votre compte</h2>
  <form method="post" action="connexionT.php">
    <fieldset>
       <legend>Vos coordonnées</legend> <!-- Titre du fieldset -->

       <i class="fas fa-user" style="color:#57B223"></i>&nbsp<label for="pseudo">Pseudo *:</label>
       <input type="text" name="pseudo" id="pseudo" required /><br><br>

       <i class="fas fa-power-off" style="color:#57B223"></i>&nbsp<label for="Mot de passe">Mot de passe *:</label>
       <input type="password" name="password" id="password" required /><br><br>

       <label for="automatique">Connexion automatique </label>
       <input type="checkbox" name="automatique" id="automatique" /><br><br>

       <input type="submit" name="connexion" value="Se connecter" class="bouton" />
       &nbsp&nbsp&nbsp<a href="inscription.php"> Inscription </a>
       &nbsp&nbsp&nbsp<a href="mpoublie.php"> Mot de passe oublié ? </a>
       </form>
    </fieldset>
    <br/><br/><br/>
  </main>
    <?php require_once('includes/footer.php') ?>
  </body>
  </html>
