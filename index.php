<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Créer une facture</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  </head>
  <body>

    <br/>
    <!-- <header class="clearfix">
    <center>
      <div id="logo">
        <a href="index.php">
      <figure>
        <img src="logo.png" title="Imprimer votre facture" width="70px">
            <figcaption class="slogan">Facturation simple et gratuite</figcaption>
      </figure>
      </a>
      </div>
    </center>
    </header> -->
    <main>
<?php require_once('includes/menu.php') ?>
<br/><br/><br/>
<h2>Création GRATUITE de vos factures</h2>
<form action="afficheFacture.php" method="post">
  <fieldset>
    <legend><i class="fas fa-file-alt" style="color:#57B223">&nbsp</i>Infos de base</legend><br/>
    <i class="fab fa-envira" style="color:#57B223"></i>&nbsp<label>Numéro de la facture *</label><br/>
    <input type="text" placeholder="TOUT100503" name="num" ><br/><br/>
    <?php
    require_once 'connexion.php';
    session_start();
    //$id_membre: $_SESSION['id_membre'] ? 1;
    $id_membre = isset($_SESSION['id_membre']) ? $_SESSION['id_membre'] : 1;
    $resFC1=$base->prepare("SELECT * FROM infosfacture WHERE id_membre= $id_membre ORDER BY id DESC");
    $resFC1->bindValue(1, $id_membre, PDO::PARAM_INT);
    $resFC1->execute(array($_GET['id_membre']));
    //$resFC1->execute();
    $resultat1= $resFC1->fetch(PDO::FETCH_ASSOC);
     ?>

    <?php
    if(isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo'])) {

      echo '<i class="fas fa-key" style="color:#57B223"></i>&nbsp
      <label>Numéro de la TVA </label><br/>
      <input type="text" placeholder="FR39831670831" name="numtva" value="'.$resultat1['numtva'].'"><br/><br/>';
    }
    else{
      echo '<i class="fas fa-key" style="color:#57B223"></i>&nbsp
      <label>Numéro de la TVA *</label><br/>
      <input type="text" placeholder="FR39831670831" name="numtva" required><br/><br/>';
    }
     ?>


    <i class="fas fa-clock" style="color:#57B223"></i>&nbsp<label>Date de la facture *</label>
    <input type="date" name="datefacture" required><br/><br/>

    <?php
    //$resultat=$resultat1['facturede'];

if(isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo'])) {

  echo '<i class="fas fa-user" style="color:#57B223"></i>&nbsp
  <label>Infos de votre entreprise *</label><br/>
  <textarea id="facturede" name="facturede" rows="4" cols="45" placeholder="Votre entreprise: Raison sociale, adresse, Téléphone.." required>'.$resultat1['facturede'].'</textarea><br/>';
}
else{
  echo '<i class="fas fa-user" style="color:#57B223"></i>&nbsp<label>Infos de votre entreprise *</label><br/><textarea id="facturede" name="facturede" rows="4" cols="45" placeholder="Votre entreprise: Raison sociale, adresse.." required></textarea><br/>';
}
	?>

    <i class="fas fa-users" style="color:#57B223"></i>&nbsp<label>Infos de votre client *</label><br/>
    <textarea name="client" rows="4" cols="45" placeholder="Facturé à: Raison sociale, adresse, Téléphone.." required>
    </textarea>
    <br/><br/>
<?php
if(isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo'])) {

  echo '<i class="fas fa-handshake" style="color:#57B223"></i>&nbsp<label>Conditions et moyens de paiement *</label><br/>
  <textarea name="conditions" rows="10" cols="45"
      placeholder="Conditions et paiements" required>'.$resultat1['conditions'].'</textarea><br/>';
}
else{
  echo '<i class="fas fa-handshake" style="color:#57B223"></i>&nbsp<label>Conditions et moyens de paiement *</label><br/>
  <textarea name="conditions" rows="10" cols="45"
      placeholder="Conditions et paiements" required></textarea><br/>';
}

 ?>


  </fieldset><br/>

            <fieldset>
            <legend><i class="fas fa-edit" style="color:#57B223"></i>&nbsp Contenu de la facture *</legend>
            <!-- <SELECT name="nom" size="1" required>
                 <OPTION>20%
                <OPTION>10%
                <OPTION>5,5%
                <OPTION>2,1%
                <OPTION>0%
          </SELECT><br/><br/> -->
            <div id="ID_container">
            <textarea name="designation[]" rows="4"
              placeholder="Designation" required></textarea>
            <input type="number" placeholder="Quantité" name="quantite[]" required>
            <input type="number" step="0.01" placeholder="Prix HT" name="prixht[]" required>
            <input name="taxe[]" type="text" step="0.01" placeholder="Taxe en %" required>
          </div><br/>
            <button type="button" class="boutonAjout" onclick="ajout(this);">+ Ajouter une designation</button>
            <!-- <input type="number" placeholder="Taxe" name="taxe"><br/><br/> -->
            <!-- <input type="number" placeholder="Total du montant HT" name="montantHT"><br/><br/> -->
            </fieldset>
            <br/><br/>
    <center><input type="submit" value ="Créer une facture" class="bouton" /></center>
      </form>
      <br/>
    </main>
      <?php require_once('includes/footer.php') ?>

<script src="js/fonctions.js"></script>

  </body>
</html>
