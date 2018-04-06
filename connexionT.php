<?php
require_once 'connexion.php';
if(!empty($_POST['pseudo']) && !empty($_POST['password'])) {
    $pseudo = $_POST['pseudo'];
    $req = $base->prepare('SELECT password, id_membre FROM membres WHERE pseudo = :pseudo');
    $req->execute([
        'pseudo' => $pseudo,
    ]);
    $resultat = $req->fetch();
  if ($resultat && password_verify($_POST['password'], $resultat['password'])) {
    session_start();
    $_SESSION['id_membre'] = $resultat['id_membre'];
    $_SESSION['pseudo'] = $pseudo;
    header('Location: listefactures.php');

  }else {echo 'Mauvais identifiant ou mot de passe ! <a href="seconnecter.php">Réessayez !</a> ou <a href="inscription.php">Inscrivez-vous !</a>';

  }
}
