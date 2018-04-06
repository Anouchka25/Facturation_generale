<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Créer une facture</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>
    <br/><br/>
    <main>
<?php require_once('includes/menu.php') ?>
<br/><br/><br/>
<form action="afficheFactureCours.php" method="post">
  <fieldset>
    <legend>Infos de votre entreprise</legend>
    <textarea id="facturede" name="facturede" rows="4" cols="45"
      placeholder="Votre entreprise: Raison sociale, adresse.." required></textarea><br/><br/>
    <input type="text" placeholder="URL du Logo" name="urlLogo" required><br/><br/>
    <label for="file">Sélectionner votre logo</label>
    <input name="logo" type="file" size=50>
    <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
  </fieldset><br/>

  <fieldset>
    <legend>Infos de base</legend>
    <input type="text" placeholder="Numéro de la facture" name="num" value="MOA58961"><br/><br/>
    <label>Date de la facture </label>
    <input type="date" name="dateFacture"><br/><br/>
    <textarea name="client" rows="4" cols="45"
        placeholder="Facturé à: Raison sociale, adresse.." required>
    </textarea>
    <br/><br/>
    <textarea name="conditions" rows="10" cols="45"
        placeholder="Conditions et paiements" required></textarea>
  </fieldset><br/>

            <fieldset>
            <legend>Contenu de la facture formation</legend>
            <textarea name="prestation" rows="4"
              placeholder="Prestation" required></textarea><br/><br/>
            <input type="number" placeholder="Nombre de jours" name="nbjours" required><br/><br/>
            <input type="number" placeholder="Tarif journalier" name="tarifjour" required><br/><br/>
            <!-- <input type="number" placeholder="Taxe" name="taxe"><br/><br/> -->
            <!-- <input type="number" placeholder="Total du montant HT" name="montantHT"><br/><br/> -->
            </fieldset>

<!-- <p>Veuillez choisir la taxe applicable :</p>
  <div>
    <input type="radio" id="tax19"
     name="taxe" value="Taxe à 19%">
     <label for="tax19">Taxe à 19%</label>

     <input type="radio" id="tax20"
      name="taxe" value="Taxe à 20%">
      <label for="tax20">Taxe à 20%</label>

      <input type="radio" id="tax25"
       name="taxe" value="Taxe à 25%">
       <label for="tax25">Taxe à 25%</label>
  </div> -->
<br/>
    <input type="submit" value ="Créer une facture" />
      </form>
      <br/>
    </main>
      <?php require_once('includes/footer.php') ?>
  </body>
</html>
