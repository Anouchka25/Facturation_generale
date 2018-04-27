<?php
   require_once 'connexion.php';

   $resFC1=$base->prepare("SELECT * FROM infosfacture WHERE id= ?");
   $resFC1->bindValue(1, $id, PDO::PARAM_INT);
   $resFC1->execute(array($_GET['id']));

   $resFC = $base->prepare("SELECT infosfacture.num, infosfacture.numtva, infosfacture.client, infosfacture.datefacture, infosfacture.facturede, infosfacture.conditions, infosfacture.id_membre, facturation.designation, facturation.quantite, facturation.prixht,facturation.taxe, facturation.fk_facturation_id
   FROM infosfacture
   INNER JOIN facturation
   ON infosfacture.id=? AND facturation.fk_facturation_id=infosfacture.id");
   $resFC->execute(array($_GET['id']));
   ?>
<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width"/>
      <title>Modifier une facture</title>
      <link rel="stylesheet" href="style.css" media="all" />
      <link rel="icon" type="image/png" href="favicon.png" />
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
   </head>
   <body>
      <br/><br/>
      <main>
         <?php require_once('includes/menu.php') ?>
         <br/><br/><br/>
         <?php
            session_start();
            if (isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo']))
            { ?>
         <?php foreach ($resFC1 as $req): ?>
         <?= '<form action="duplique.php" method="post">' ?>
         <fieldset>
            <legend><i class="fas fa-file-alt" style="color:#57B223">&nbsp</i>Infos de base</legend>
            <i class="fab fa-envira" style="color:#57B223"></i>&nbsp<label>Numéro de la facture *</label><br/>
            <input type="text" placeholder="TOUT100503" name="num" value="<?php echo $req['num'] ?>"><br/><br/>
            <i class="fas fa-key" style="color:#57B223"></i>&nbsp
            <label>Numéro de la TVA </label><br/>
            <input type="text" placeholder="FR39831670831" name="numtva" value="<?php echo $req['numtva'] ?>"><br/><br/>
            <i class="fas fa-clock" style="color:#57B223"></i>&nbsp<label>Date de la facture *</label>
            <input type="date" name="datefacture" value="<?php echo $req['datefacture'] ?>" required><br/><br/>
            <i class="fas fa-user" style="color:#57B223"></i></i>&nbsp<label>Infos de votre entreprise *</label><br/>
            <textarea id="facturede" name="facturede" rows="4" cols="45"
               placeholder="Votre entreprise: Raison sociale, adresse.." required><?php echo $req['facturede'] ?></textarea>
            <br/><br/>
            <i class="fas fa-users" style="color:#57B223"></i>&nbsp<label>Infos de votre client *</label><br/>
            <textarea name="client" rows="4" cols="45"
               placeholder="Facturé à: Raison sociale, adresse.." required><?php echo $req['client'] ?></textarea>
            <br/><br/>
            <i class="fas fa-handshake" style="color:#57B223"></i>&nbsp<label>Conditions et moyens de paiement *</label><br/>
            <textarea name="conditions" rows="10" cols="45"
               placeholder="Conditions et paiements" required><?php echo $req['conditions'] ?></textarea>
         </fieldset>
         <br/>
         <?php $tva= $req['tva']; ?>
         <?php endforeach; ?>
         <br/>
         <fieldset>
            <legend><i class="fas fa-edit" style="color:#57B223"></i>&nbsp Contenu de la facture formation</legend>
            <?php foreach ($resFC as $req): ?>
            <div id="ID_container">
               <textarea name="designation[]" rows="4"
                  placeholder="Designation" required><?php echo $req['designation'] ?></textarea>
               <input type="number" placeholder="Quantité" name="quantite[]" value="<?php echo $req['quantite'] ?>" >
               <input type="number" step="0.01" placeholder="Prix HT" name="prixht[]" value="<?php echo $req['prixht'] ?>" >
               <input name="taxe[]" type="text" step="0.01" placeholder="Taxe en %" value="<?php echo $req['taxe'] ?>" >
               <span><button type="button" class="supprimer" onclick="suppression(this)">x</button></span>
            </div>
            <?php endforeach; ?>
            <br/>
            <button type="button" class="boutonAjout" onclick="ajout(this);">+ Ajouter une designation</button>
         </fieldset>
         <br/><br/>
         <center><input type="submit" value ="Mettre à jour la facture" class="bouton" /></center>
         </form>
         <br/>
         <?php
            }
            else {
            header('Location: seconnecter.php');
             }
             ?>
         <br/><br/><br/>
         <?php require_once('includes/footer.php') ?>
      </main>
      <script src="js/fonctions.js"></script>
   </body>
</html>
