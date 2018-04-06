<?php
require_once 'connexion.php';
$req = $base->prepare('UPDATE facturation
  SET num = :num,
  client = :client,
  prestation = :prestation,
  nbjours = :nbjours,
  tarifjour = :tarifjour,
  dateFacture = :dateFacture,
  facturede = :facturede,
  conditions = :conditions,
  img_nom = :img_nom,
  img_taille = :img_taille,
  img_type = :img_type,
  img_blob = :img_blob,
  urlLogo = :urlLogo
  WHERE id= ?');
  $req->execute(array(  'num' => $num,
                          'client' => $client,
                          'prestation'=> $prestation,
                          'nbjours'=> $nbjours,
                          'tarifjour'=> $tarifjour,
                          'dateFacture'=> $dateFacture,
                          'facturede'=> $facturede,
                          'conditions'=> $conditions,
                          'img_nom'=> $img_nom,
                          'img_taille'=> $img_taille,
                          'img_type'=> $img_type,
                          'img_blob'=> $img_blob,
                          'urlLogo'=> $urlLogo));
      //echo "les données ont bien étés insérées dans la base de données";
      $base = null;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Afficher une Facture</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <div id="company">
      <div class="to"><h2>De:</h2> <?php echo $facturede ?></div>
      </div>

    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to"><h2>Facture à:</h2> <?php echo $client ?></div>

        </div>
        <div id="invoice">
          <h1>FACTURE N° <?php echo $num ?></h1>
          <div class="date">Date: <?php echo $dateFacture ?></div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">N° DE FACTURE</th>
            <th class="desc">PRESTATION</th>
            <th class="qty">NOMBRE DE JOURS</th>
            <th class="unit">TARIF JOURNALIER</th>
            <th class="total">TOTAL HT</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="no"><?php echo $num ?></td>
            <td class="desc"><?php echo $prestation ?></td>
            <td class="qty"><?php echo $nbjours ?></td>
            <td class="unit"><?php echo $tarifjour ?></td>
            <td class="total"><?php echo $tarifjour * $nbjours ?></td>
          </tr>
        </tbody>
        <tfoot>
          <!-- <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>$5,200.00</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TAX 25%</td>
            <td>$1,300.00</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>$6,500.00</td>
          </tr> -->
        </tfoot>
      </table>

      <div id="notices">
        <div><h2>Conditions et moyens de paiement:</h2></div>
        <div class="notice"> <?php echo $conditions ?> </div>
      </div>
      <?= '<a href="facturesPDF/imprimer.php?num='.$num.'" target="_blank">Imprimer</a>' ?>
    </main>
    <?php require_once('includes/footer.php') ?>
  </body>
</html>
