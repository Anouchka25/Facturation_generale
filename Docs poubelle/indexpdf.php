<?php
/*
 * Générer un PDF à partir d'une base de données
 */

require('connexion.php');

/*
 * Début de la temporisation de sortie
 */
ob_start();
?>

<page backtop="5%" backbottom="5%" backleft="5%" backright="5%">

    <h1 style="text-align:center">Liste de Livres</h1>

    <table style="width:100%;border:1px dashed">
        <tr>
            <th style="width:50%">Titre</th>
            <th style="width:20%">Auteur</th>
            <th style="width:20%">Maison d'édition</th>
            <th style="width:10%">Prix</th>
        </tr>

        <?php

        /*
         * Requête SQL pour récupérer notre liste de livre.
         */

        $req = "SELECT titre, prix, auteur.nom, prenom, editeur.nom AS maison_edition FROM livre, auteur, editeur
                WHERE auteur.id = livre.id_auteur AND editeur.id = livre.id_editeur";
        $sql = mysql_query($req);
        while($row = mysql_fetch_array($sql)){
        ?>
        <tr>
            <td><?php echo $row['titre'];?></td>
            <td><?php echo $row['prenom']." ".$row['nom'];?></td>
            <td><?php echo $row['maison_edition'];?></td>
            <td><?php echo number_format($row['prix'],2,',','');?>€</td>
        </tr>
        <?php
        }

        /*
         * Fin du traitement
         */

        ?>
    </table>
</page>

<?php

/*
 * $content récupére toutes les données mises en mémoire.
 */

$content = ob_get_clean();

require('html2pdf/html2pdf.class.php');

/*
 * On instancie notre constructeur
 * On affiche le contenu
 * On génére notre PDF
 */

$pdf = new HTML2PDF('P','A4','fr','true','UTF-8');
$pdf->writeHTML($content);
//$pdf->pdf->IncludeJS('print(true)');
$pdf->Output('liste.pdf');

?>
