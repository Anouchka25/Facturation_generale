<?php
require_once 'connexion.php';

// Vérification de la validité des informations
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$password = isset($_POST['password']) ? $_POST['password'] : NULL;
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;

// Hachage du mot de passe
$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insertion
$req = $base->prepare('INSERT INTO membres(email, pseudo, password) VALUES(:email, :pseudo, :password)');
$req->execute(array(
    'email' => $email,
    'pseudo' => $pseudo,
    'password' => $pass_hache));

  header('Location: listefactures.php');
