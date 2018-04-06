<style type="text/css">
<!--
table
{
    width:  100%;
    border: solid 1px #5544DD;
}


table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
  background: #c4baba;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
  background: #f4efef;
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

#logo {
  float: left;
  margin-top: 8px;
}


#company {
  float: right;
  text-align: right;

}

end_last_page div
{
    border: solid 1mm red;
    height: 27mm;
    margin: 0;
    padding: 0;
    text-align: center;
    font-weight: bold;
}
-->
</style>
<div class="clearfix">
  <div id="logo">
  <div style="font-size: 20px; font-weight: bold; float:left ">Facture à :<br></div>
  <div style="font-size: 20px; font-weight: bold; float:right ">N° de facture :<br></div>
  <div style="font-size: 20px; font-weight: bold; float:right ">Date :<br></div>
  </div>
  <div id="company">
    <h3 class="name">Micro-Entreprise Anouchka MINKOUE OBAME</h3>
    <div>
      <p>RUE RÉTIMARE LOGT 042, IMM. ADOLPHE ADAM
76190 YVETOT,<br/> Inscrite au registre du commerce et des sociétés de Rouen sous le n° 794 069 997 00029<br/> Représentée par Anouchka MINKOUE OBAME agissant en qualité de gérante
</P>
  </div>
  </div>
</div>
<br>
<br>
<table>
    <col style="width: 40%">
    <col style="width: 20%">
    <col style="width: 20%">
    <col style="width: 20%">
    <thead>
        <tr>
            <th class="desc">PRESTATION</th>
            <th class="qty">NOMBRE DE JOURS</th>
            <th class="unit">TARIF JOURNALIER</th>
            <th class="total">TOTAL HT</th>
        </tr>
    </thead>
<?php
for ($k=0; $k<5; $k++) {
?>
<tr>
    <td class="desc">test de texte assez long pour engendrer des retours à la ligne automatique...</td>
    <td class="qty">test de texte assez long pour engendrer des retours à la ligne automatique...</td>
    <td class="unit">test de texte assez long pour engendrer des retours à la ligne automatique...</td>
    <td class="total">test de texte assez long pour engendrer des retours à la ligne automatique...</td>
</tr>
<?php
}
?>
    <tfoot>
        <tr>
            <th colspan="4" style="font-size: 16px;">
                bas du tableau
            </th>
        </tr>
    </tfoot>
</table>
<end_last_page end_height="30mm">
    <div>
    Micro-Entreprise Anouchka MINKOUE OBAME - Rue Rétimare, Imm. Adolph. Adam, N°42, 76190
Yvetot, France - Immatriculation au RCS : 794 069 997 00029 R.C.S Rouen - APE : 6311Z
    </div>
</end_last_page>
