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
      $id=$_GET['id'];

      $req1 = $base->prepare('UPDATE infosfacture
        SET num = :num,
        numtva = :numtva,
        client = :client,
        datefacture = :datefacture,
        facturede = :facturede,
        conditions = :conditions,
        id_membre= :id_membre
        WHERE id= :id');
        $req1->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

        $param = array();
        //$params[':id']    =$id;
        $params[':num']    = $_POST['num'];
        $params[':numtva']    = $_POST['numtva'];
        $params[':client']    = $_POST['client'];
        $params[':datefacture'] = $_POST['datefacture'];
        $params[':facturede'] = $_POST['facturede'];
        $params[':conditions'] = $_POST['conditions'];
        $params[':id_membre'] = $id_membre;
        $req1->execute($params)

        //$fk_facturation_id = $_GET['id'];

        $req2 = $base->prepare('UPDATE facturation
                                SET  designation = :designation,
                                quantite = :quantite,
                                prixht = :prixht
                                WHERE fk_facturation_id= :fk_facturation_id');
        $req2->bindParam(':fk_facturation_id', $_GET['id'], PDO::PARAM_INT);



      $params = array();
      $params[':fk_facturation_id'] = $fk_facturation_id;

      foreach ($_POST['designation'] as $key => $designation) {
            $params[':designation'] = $designation;
            $params[':quantite']    = $_POST['quantite'][$key];
            $params[':prixht']  = $_POST['prixht'][$key];
            $params[':taxe'] = $_POST['taxe'][$key];
            $req2->execute($params);
        }

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
