<style type="text/css">
	page{
		max-width: 100%;
	}

  table {
		width: 100%;
		color: #717375;
		font-family: helvetica;
		line-height: 5mm;
		border-collapse: collapse;
	}

</style>
<page>
    <page_header>
      <table>
     <tr>
      <td style="width: 40%;">
 				<b>De :</b><br />
        <h3>Micro-Entreprise Anouchka MINKOUE OBAME</h3><br />
Rue Rétimare, Imm. Adolph. Adam, N°42, 76190 Yvetot, France<br />
Immatriculation au RCS : 794 069 997 00029 R.C.S Rouen<br />
Code APE : 6311Z
 			</td>
      <td style="width: 20%;">------------------ </td>
 			<td style="width: 40%;">
 				<h3>Facturé à :</h3><br />
 				$nomDuClient<br />
 				$adresseDuClient<br/>
        Date de facturation : $date<br />
        Numéro de facture : $numeroDeFacture
 			</td>
 		</tr>
 	</table>
    </page_header>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <table>
    	<thead>
    		<tr>
    			<th style="width: 40%;">
    				PRESTATION
    			</th>
    			<th style="width: 20%;">
    				NOMBRE DE JOURS
    			</th>
    			<th style="width: 20%;">
    				TARIF JOURNALIER
    			</th>
    			<th style="width: 20%;">
    				TOTAL HT
    			</th>
    		</tr>
    	</thead>
    	<tbody>
    		<!-- ici on boucle sur les lignes de notre facture -->
    		<tr>
    			<td style="width: 40%;">
    				$nomDeLaPrestation
    			</td>
    			<td style="width: 20%;">
    				$prixUnitaire €
    			</td>
    			<td style="width: 20%;">
    				$prixUnitaireFacture €
    			</td style="width: 20%;">
    			<td style="width: 20%;">
    				$prixUnitaireFacture * $quantite €
    			</td>
    		</tr>
    		<!-- fin de la boucle -->
    	</tbody>
    </table>

    <page_footer>
        <p>
          Micro-Entreprise Anouchka MINKOUE OBAME - Rue Rétimare, Imm. Adolph. Adam, N°42, 76190
 Yvetot, France - Immatriculation au RCS : 794 069 997 00029 R.C.S Rouen - APE : 6311Z
        </p>
    </page_footer>
    ...
</page>
