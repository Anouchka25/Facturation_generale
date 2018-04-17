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
        WHERE id= :id');
        $req1->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $req1->bindParam(':num', $_POST['num'], PDO::PARAM_STR);
        $req1->bindParam(':numtva', $_POST['numtva'], PDO::PARAM_STR);
        $req1->bindParam(':client', $_POST['client'], PDO::PARAM_STR);
        $req1->bindParam(':datefacture', $_POST['datefacture'], PDO::PARAM_STR);
        $req1->bindParam(':facturede', $_POST['facturede'], PDO::PARAM_STR);
        $req1->bindParam(':conditions', $_POST['conditions'], PDO::PARAM_STR);
        $req1->bindParam(':id_membre', $_SESSION['id_membre'], PDO::PARAM_INT);
        $req1->execute();

//var_dump($_GET['id']);

        $req2 = $base->prepare('UPDATE facturation
                                SET  designation = :designation,
                                quantite = :quantite,
                                prixht = :prixht,
                                taxe = :taxe
                                WHERE fk_facturation_id= :fk_facturation_id');
        $params = array();
        foreach ($_POST['designation'] as $key => $designation) {
            $params[':designation'] = $designation;
            $params[':quantite']    = $_POST['quantite'][$key];
            $params[':prixht']  = $_POST['prixht'][$key];
            $params[':taxe'] = $_POST['taxe'][$key];
            $params[':fk_facturation_id'] = $_GET['id'];
            $req2->execute($params);
            }
//var_dump($_GET['id']);
        // foreach ($_POST['designation'] as $designation) {
        // $req2->bindParam(':designation', $_POST['designation'], PDO::PARAM_STR);
        // $req2->bindParam(':quantite', $_POST['quantite'], PDO::PARAM_STR);
        // $req2->bindParam(':prixht', $_POST['prixht'], PDO::PARAM_STR);
        // $req2->bindParam(':taxe', $_POST['taxe'], PDO::PARAM_STR);
        // $req2->bindParam(':fk_facturation_id', $_GET['id'], PDO::PARAM_INT);
        // $req2->execute();
        // }

        // $params = array();
        // $params[':fk_facturation_id'] = $_GET['id'];
        //
        // foreach ($_POST['designation'] as $key => $designation) {
        //       $params[':designation'] = $designation;
        //       $params[':quantite']    = $_POST['quantite'][$key];
        //       $params[':prixht']  = $_POST['prixht'][$key];
        //       $params[':taxe'] = $_POST['taxe'][$key];
        //       $req2->execute($params);
        //   }

      //header('Location: listefactures.php');
      require_once('listefactures.php');
      //echo "Ok UPDATE";
      echo "<script language=\"javascript\">";
      echo "alert('La facture n° .$num. a bien été mise à jour ')";
      echo"</script>";
      }
      else {
      echo 'Vous n\'êtes pas connecté.';
      }
      ?>
