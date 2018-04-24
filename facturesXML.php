<?php require_once 'connexion.php'; ?>
<?php
$xml = '<?xml version="1.0" encoding="iso-8859-1" standalone="yes"?>';
$xml .= '<rss version="0.91">';

session_start();
$id_membre= $_SESSION['id_membre'];
if(isset($_SESSION['id_membre']) AND isset($_SESSION['pseudo'])) {

// $req=$base->prepare("SELECT infosfacture.num, infosfacture.client, infosfacture.datefacture, infosfacture.facturede, infosfacture.conditions, facturation.designation, facturation.quantite, facturation.prixht, facturation.taxe
// FROM infosfacture
// INNER JOIN facturation
// ON id_membre='.$id_membre.' AND facturation.fk_facturation_id=infosfacture.id");
// //$resFC->bindValue(1, $id, PDO::PARAM_INT);
// $req->execute();
$req1 = $base->query('SELECT * FROM infosfacture WHERE id_membre='.$id_membre.' ORDER BY id DESC');
?>
<?php
foreach ($req1 as $re):
  $xml.="<table name="infosfacture">";
  $xml.="<column name="id">".$re['id']."</column>";
  $xml.="<column name="num">".$re['num']."</column>";
  $xml.="<column name="numtva">".$re['numtva']."</numtva>";
  $xml.="<column name="client">".$re['client']."</column>";
  $xml.="<column name="datefacture">".$re['datefacture']."</column>";
  $xml.="<column name="facturede">".$re['facturede']."</column>";
  $xml.="<column name="conditions">".$re['conditions']."</column>";
  $xml.="<column name="id_membre">".$re['conditions']."</column>";
  $xml.="</table>";

  // $xml.="<designation>".$re['designation']."</column>";
  // $xml.="<quantite>".$re['quantite']."</column>";
  // $xml.="<prixht>".$re['prixht']."</column>";
  // $xml.="<taxe>".$re['taxe']."</column>";
  // $xml.="</facture></toutesfactures></rss>";

  endforeach;
  file_put_contents("xmlfactures.xml",$xml);
  echo '<a href="xmlfactures.xml">Liste des factures en XML</a>';
}
else {
include('seconnecter.php');
 }
 ?>
