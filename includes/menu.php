<?php
session_start();

/*
si la variable de session pseudo n'existe pas cela siginifie que le visiteur
n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
acceder à l'espace membres
*/
if(isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo'])) {

?>
<ul>
 <li><a href="index.php">Accueil</a></li>
 <li><a href="index.php">Créer une facture</a></li>
 <!-- <li><a href="inscription.php">Inscription</a></li> -->
 <!-- <li><a href="listeFactures.php">Liste des factures</a></li> -->
 <li><a href="moncompte.php">Mon compte</a></li>
 <li><a href="contact.php">Contact</a></li>
</ul>
<em><?php echo 'Bonjour ' . $_SESSION['pseudo'];?> <a href="deconnexion.php"> - Déconnexion</a></em>


<?php
}
else {
?>
<ul>
 <li><a href="index.php">Accueil</a></li>
 <li><a href="index.php">Créer une facture</a></li>
 <li><a href="inscription.php">Inscription</a></li>
 <li><a href="contact.php">Contact</a></li>
</ul>
<?php } ?>
