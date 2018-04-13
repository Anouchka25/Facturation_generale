<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Mise à jour Facture</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  </head>
  <body>

    <header class="clearfix">

    </header>
    <?php require_once('includes/menu.php') ?>
    <br/> <br/>
    <main>
      <?php
      require_once 'connexion.php';
      session_start();
    if (isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo'])){

      //On vérifie si la variable existe et sinon elle vaut NULL
      $num = isset($_POST['num']) ? $_POST['num'] : NULL;
      $client = isset($_POST['client']) ? $_POST['client'] : NULL;
      $designation = isset($_POST['designation']) ? $_POST['designation'] : NULL;
      $quantite = isset($_POST['quantite']) ? $_POST['quantite'] : NULL;
      $prixht = isset($_POST['prixht']) ? $_POST['prixht'] : NULL;
      $datefacture = isset($_POST['datefacture']) ? $_POST['datefacture'] : NULL;
      $facturede = isset($_POST['facturede']) ? $_POST['facturede'] : NULL;
      $conditions = isset($_POST['conditions']) ? $_POST['conditions'] : NULL;
      $numtva = isset($_POST['numtva']) ? $_POST['numtva'] : NULL;
      $id_membre= $_SESSION['id_membre'];

      $req1 = $base->prepare('UPDATE infosfacture
        SET num = :num,
        numtva = :numtva,
        client = :client,
        datefacture = :datefacture,
        facturede = :facturede,
        conditions = :conditions,
        id_membre= :id_membre
        WHERE id= ?');
        $req1->bindParam(':num', $_POST['num'], PDO::PARAM_STR);
        $req1->bindParam(':numtva', $_POST['numtva'], PDO::PARAM_STR);
        $req1->bindParam(':client', $_POST['client'], PDO::PARAM_STR);
        $req1->bindParam(':datefacture', $_POST['datefacture'], PDO::PARAM_STR);
        $req1->bindParam(':facturede', $_POST['facturede'], PDO::PARAM_STR);
        $req1->bindParam(':conditions', $_POST['conditions'], PDO::PARAM_STR);
        $req1->bindParam(':id_membre', $_SESSION['id_membre'], PDO::PARAM_INT);
        $req1->execute();

        $req2 = $base->prepare('UPDATE facturation
                                SET  designation = :designation,
                                quantite = :quantite,
                                prixht = :prixht
                                WHERE fk_facturation_id= ?');
        $req2->bindParam(':designation', $_POST['designation'], PDO::PARAM_STR);
        $req2->bindParam(':quantite', $_POST['quantite'], PDO::PARAM_STR);
        $req2->bindParam(':prixht', $_POST['prixht'], PDO::PARAM_STR);
        $req2->execute();

    echo 'La facture n° '.$num.' a bien été mise à jour ';
    // echo "<script language=\"javascript\">";
    // echo "alert('La facture n° .$num. a bien été mise à jour ')";
    // echo"</script>";?>
      <!-- <br/> <br/>
      <p> Les données ont bien été mise à jour</p> -->
      <?
      }
      else {
        echo 'Vous n\'êtes pas connecté.';
      }
      // echo "<script language=\"javascript\">";
      // echo "alert('Vous n\'êtes pas connecté.')";
      // echo"</script>";
      ?>
    </main>
    <?php require_once('includes/footer.php') ?>
  </body>
</html>
