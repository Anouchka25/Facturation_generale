<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Créer une facture</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="icon" type="image/png" href="favicon.png" />
  </head>
  <body>
    <br/><br/>
    <main>
<?php require_once('includes/menu.php') ?>
<br/><br/><br/>
<form action="afficheFacture.php" method="post">

  <fieldset>
    <legend>Infos de base</legend>
    <label>Numéro de la facture *</label><br/>
    <input type="text" placeholder="Numéro de la facture" name="num" required><br/><br/>
    <label>Date de la facture *</label>
    <input type="text" placeholder="15/03/2018" name="datefacture" required><br/><br/>

    <label>Infos de votre entreprise *</label><br/>
    <textarea id="facturede" name="facturede" rows="4" cols="45"
      placeholder="Votre entreprise: Raison sociale, adresse.." required></textarea><br/><br/>

    <label>Infos de votre client *</label><br/>
    <textarea name="client" rows="4" cols="45"
        placeholder="Facturé à: Raison sociale, adresse.." required>
    </textarea>
    <br/><br/>
    <label>Conditions et moyens de paiement *</label><br/>
    <textarea name="conditions" rows="10" cols="45"
        placeholder="Conditions et paiements" required></textarea>
  </fieldset><br/>

            <fieldset>
            <legend>Contenu de la facture *</legend>
            <div id="ID_container">
            <textarea name="designation[]" rows="4"
              placeholder="Designation" required></textarea>
            <input type="number" placeholder="Quantité" name="quantite[]" required>
            <input type="number" placeholder="Prix HT" name="prixht[]" required>
            </div>
            <button type="button" onclick="ajout(this);">+ Ajouter une designation</button>
            <!-- <input type="number" placeholder="Taxe" name="taxe"><br/><br/> -->
            <!-- <input type="number" placeholder="Total du montant HT" name="montantHT"><br/><br/> -->
            </fieldset>
<br/>
    <input type="submit" value ="Créer une facture" />
      </form>
      <br/>
    </main>
      <?php require_once('includes/footer.php') ?>

<script src="js/fonctions.js"></script>
  </body>
</html>
