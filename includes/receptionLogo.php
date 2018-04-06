<?php
$maxsize=50;
$maxwidth=100;
$maxheight=100;
$logo = isset($_POST['logo']) ? $_POST['logo'] : NULL;

$_FILES['logo']['name'];     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_logo.png).
$_FILES['logo']['type'];     //Le type du fichier. Par exemple, cela peut être « image/png ».
if ($_FILES['logo']['size'] > $maxsize) $erreur = "Le fichier est trop gros";     //La taille du fichier en octets.
$_FILES['logo']['tmp_name']; //L'adresse vers le fichier uploadé dans le répertoire temporaire.
if ($_FILES['logo']['error'] > 0) $erreur = "Erreur lors du transfert";//Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.

$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
//1. strrchr renvoie l'extension avec le point (« . »).
//2. substr(chaine,1) ignore le premier caractère de chaine.
//3. strtolower met l'extension en minuscules.
$extension_upload = strtolower(  substr(  strrchr($_FILES['logo']['name'], '.')  ,1)  );
if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";

$image_sizes = getimagesize($_FILES['logo']['tmp_name']);
if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) $erreur = "Image trop grande";

//Créer un dossier 'logos'
//$dossierlogos= mkdir('logos', 0777, true);

//Créer un identifiant difficile à deviner
$nom = md5(uniqid(rand(), true));

$nomlogo = "{$nom}.{$extension_upload}";
$resultat = move_uploaded_file($_FILES['logo']['tmp_name'],$nomlogo);
if ($resultat) echo "Transfert réussi";
?>
