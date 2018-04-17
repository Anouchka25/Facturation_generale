<?php
require_once 'connexion.php';
session_start();
if (isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo'])){

$req = $base->prepare('DELETE FROM infosfacture WHERE id= :id');
$req->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
// echo "<script type=\"text/javascript\">
// alert('Vous confirmez supprimer cette facture')
// </script>";
$req->execute();

// $req2 = $base->prepare('DELETE facturation WHERE fk_facturation_id= :fk_facturation_id');
// $req2->bindParam(':fk_facturation_id', $_GET['id'], PDO::PARAM_INT);
// $req2->execute();
header('Location: listefactures.php');
}
else {
echo 'Vous n\'êtes pas connecté.';
}
?>
