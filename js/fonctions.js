function ajout(element){
        var container = document.getElementById('ID_container');

        var str ='<br/><span><textarea name="designation[]" rows="4" type="text" placeholder="Designation"></textarea>    </span><span><input name="quantite[]" type="number" placeholder="Quantité">    </span><span><input name="prixht[]" type="number" step="0.01" placeholder="Prix HT">    </span><span><input name="taxe[]" type="text" step="0.01" placeholder="Taxe en %">    </span><span><button type="button" class="supprimer" onclick="suppression(this)">x</button></span><br/>';
        var divNewExp = document.createElement("div");
		divNewExp.innerHTML = str ;
		container.appendChild(divNewExp);

      }

function suppression(element){
        var container = document.getElementById('ID_container');
        container.removeChild(element.parentNode.parentNode);
      }
