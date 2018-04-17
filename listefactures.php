<?php require_once 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Créer une facture</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  </head>
  <body>
    <?
    session_start();

    /*
    si la variable de session pseudo n'existe pas cela siginifie que le visiteur
    n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
    acceder à l'espace membres
    */
    $id_membre= $_SESSION['id_membre'];
    if(isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo'])) {

    ?>

    <header class="clearfix">
      <?php require_once('includes/menu.php') ?>

    </header>
    <main>

<?php
$facturesParPage=5;
$facturesTotalesReq=$base->query('SELECT id FROM facturation');
$facturesTotales=$facturesTotalesReq->rowCount();
$pagesTotales = ceil($facturesTotales/$facturesParPage);

if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page']>0){
  $_GET['page']=intval($_GET['page']); //intval() securise contre les injections
  $pageCourante=$_GET['page'];
}
else {
  $pageCourante=1;
}

$depart=($pageCourante - 1) * $facturesParPage;

$req = $base->query('SELECT * FROM infosfacture WHERE id_membre='.$id_membre.' ORDER BY id DESC LIMIT '.$depart.','.$facturesParPage.'');

for($i=1; $i<=$pagesTotales; $i++)
if($i==$pageCourante){
  echo $i.'--- ';
}
else{
 echo '<a href="listeFactures.php?page='.$i.'">'.$i.'---</a>';
 }
 ?>
<table border="0" cellspacing="0" cellpadding="0">
  <thead>
    <tr>
      <th class="ggg">ID</th>
      <th class="no">N° FACTURE</th>
      <th class="desc">CLIENT</th>
      <th class="qty">DATE DE FACTURE</th>
      <th class="unit">FACTURE DE</th>
      <th class="total">ACTIONS</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($req as $re):
    ?>
    <tr>
      <td class="ggg"><?= $re['id'] ?></td>
      <td class="no"><?= '<FONT color="white">'.$re['num'].'</FONT>' ?></td>

      <td class="desc"><?= $re['client'] ?></td>
      <td class="qty"><?= $re['datefacture'] ?></td>
      <td class="unit"><?= $re['facturede'] ?></td>
      <td class="total"><?= '<i class="fas fa-eye" style="color:white"></i>&nbsp<em><a href="UneFacture.php?id='.$re['id'].'"><FONT color="white">Voir</FONT></a><em>
      <br/><br/>
      <i class="fas fa-pencil-alt" style="color:white"></i>&nbsp<em><a href="modifierFacture.php?id='.$re['id'].'"><FONT color="white">Modif</FONT></a><em>
      <br/><br/>
      <i class="fas fa-trash" style="color:white"></i>&nbsp<em><a href="deleteFacture.php?id='.$re['id'].'"><FONT color="white">Suppr</FONT></a><em>' ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
  </tfoot>
</table>
<?php
for($i=1; $i<=$pagesTotales; $i++)
if($i==$pageCourante){
  echo $i.'--- ';
}
else{
 echo '<a href="listeFactures.php?page='.$i.'">'.$i.'---</a>';
 }
 ?>
    </main>
    <footer>
      <?php require_once('includes/footer.php') ?>
    </footer>
    <?php
    }
    else {
    include('seconnecter.php');
     }
     ?>
  </body>
</html>
