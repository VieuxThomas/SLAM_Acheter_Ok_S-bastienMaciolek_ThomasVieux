<script>
function trouverLesPointDeVente()
{
	//recup du debut du code postal de la commune
	var debutCodeCommune=document.getElementById('listePDV');
	//j'efface toutes les options de la datalist
	while(dataListeCommune.option.length>0)
	{
		dataListeCommune.removeChild(sataListeCommune.childNodes[0]);
	}
	//je crre ma requete vers le serveur php
	var request = new XMLHttpRequest();
	// prise en charge des chgts d'etat de la requete 
	request.onreadystatechange = function(response)
	{
		if(request.ready === 4)
		{
			if(request.status === 200)
			{
				// j'obtient la reponse au format json
				var tabJsonOptions = JSON.parse(request.responseText);
		// pour chaque ligne du tableau reçu.
		var noLigne;
		for(noLigne=0;noLigne<tabJsonOptions.length;noLigne++)
		{ 
			// Cree une nouvelle <option>.
			var nouvelleOption = document.createElement('option');
			// on renseigne la value de l'option avec le numéro du produit.
			nouvelleOption.value = tabJsonOptions[noLigne].ptventeLibelle+';'+tabJsonOptions[noLigne].ptventeRue;
			//on affiche aussi le codePostal et la commune
			nouvelleOption.text=nouvelleOption.value;
			// ajout  de l'<option> en tant qu'enfant de la liste de selection des produits.
			dataListeCommunes.appendChild(nouvelleOption);
		}

	       } 
	       else 
	       {
		  // An error occured :(
		  alert("Couldn't load datalist options :(");
	       }
	    }
	  };
	  //recup du debut du code postal de la commune
	  var debutCodeCommune=document.getElementById('PDV').value;
	  //formation du texte de la requete
	  var texteRequeteAjax='PDVJson.php?debutCommune='+debutCodeCommune;
	  //je l'ouvre
	  request.open('GET', texteRequeteAjax, true);
	  //et l'envoie
	  request.send();
  }//fin du si + de deux caractères ont été saisi
}


			</script>

