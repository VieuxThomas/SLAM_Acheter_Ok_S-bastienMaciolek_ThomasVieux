<?
include("haut.php");
//Si l'utilisateur n'est pas connecté ou que ce n'est pas un producteur
if ($_SESSION['actif']==0 || $_SESSION['type'] != "Producteur")
{
?>
<div id='message'>
    <p>Veuillez vous connecter avec un compte "Producteur"</p>
</div>
<?
}
else
{
	require"./connect.php";
	$maBase=connexion();
?>
<div id="inscription">
    <form method="POST" action="traitementProduire.php">
	<fieldset>
	    <legend>Produit</legend>
		<p>
		    <label>Produit : </label>
		    <select name="prodNom" id="nomProduit">
<?
	$req = "SELECT prodId, prodLibelle, typeproduitLibelle FROM produit NATURAL JOIN typeProduit";
	$curseur=mysqli_query($maBase,$req);
	while($leProduit=mysqli_fetch_row($curseur))
	{
		$produitId=$leProduit[0];
		$produitLibelle=$leProduit[1];
		$typeLibelle=$leProduit[2];
?>
			<option value="<? echo($produitId) ?>"><? echo($typeLibelle." - ".$produitLibelle) ?></option>
<?
	}
?>
		    </select>
		</p>
		<p>
		    <label>Quantité : </label><input type="number" name="lotQuantite" id="quantite" value="1">
		</p>
		<p>
		    <label>Unité de mesure : </label>
		    <select name="lotUnite" id="UM">
<?
	$req = "SELECT uniteId, uniteLibelle FROM unite";
	$curseur = mysqli_query($maBase,$req);
	while($unite = mysqli_fetch_row($curseur))
	{
		$uniteId = $unite[0];
		$uniteLibelle = $unite[1];
?>
			<option value="<? echo($uniteId) ?>"><? echo $uniteLibelle ?></option>
<?
	}
?>
		    </select>
		</p>
		<p>
		    <label>Votre produit n'apparaît pas dans la liste ? proposez le en nous contactant par mail à support@newworld.fr</label>
		</p>
	    </fieldset>
	    <fieldset>
		<legend>Lieu de production</legend>
		    <p>
			<label>Date de récolte : </label><input type="date" name="lotDateRecolte" id="dateRecolte" placeHolder="  ex : 2015-03-02">
		    </p>
		    <p>
			<label>Mode de production : </label>
					Non Bio : <input type="radio" name="lotModeProduction" id="modeProduction" checked="checked" value="0">
					Bio : <input type="radio" name="lotModeProduction" id="modeProduction" value="1">
		    </p>
			<p>
					<label>Durée de conservation en jour : </label><input type="text" id="dureeConservation" name="lotDureeConservation" required>
				</p>
				<p>
					<label>Producteur : </label><input type="text" id="nomProducteur" name="lotProducteur" required>
				</p>
				<p>
					<label>Origine : </label><input type="text" id="origine" name="lotOrigine" required>
				</p>
				<p>
					<label>Parcelle :</label><input type="text" id="parcelle" name="lotParcelle" required>
				</p>
		</fieldset>
		<fieldset>
			<legend>Ordre</legend>
				<p>
					<label>Prix du lot : </label><input type="number" name="lotPrix" id="prixLot" value="0">
				</p>

				<p>
					<label>Quantité minimale du produit :</label><input type="number" name="lotMasseMin" id="quantite" value="1">
				</p>
		</fieldset>
		<fieldset>
			<legend>Point de vente</legend>
				<p>
					<label>Code postal : </label><input type="text" name="lotPV" id="PV" placeHolder=" Code postal" list="listeDesCommunes" oninput="remplirListeDesCommunes()">
					 <datalist id="listeDesCommunes">
					</datalist>
				</p>
				<p>
					<label>Point de vente : </label><select name="lotPDV" id="PDV" list="listePDV" >
					<datalist id="listePDV">
					</datalist>
				</p>


	<script>
	//cette fonction se lance quand la commune change
	//elle met à jour la liste des communes commençant par ce qui a été saisi par l'utilisateur
	function remplirListeDesCommunes()
	{
		//recup du debut du code postal de la commune
		var debutCodeCommune=document.getElementById('PV').value;
		if(debutCodeCommune.length >2)//à partir de trois caractères
		{
			var dataListeCommunes=document.getElementById('listeDesCommunes');
			//j'efface toutes les options de la datalist
			while(dataListeCommunes.options.length>0)
			{
				dataListeCommunes.removeChild(dataListeCommunes.childNodes[0]);
			}
			//je cree ma requete vers le serveur php
			var request = new XMLHttpRequest();
			// prise en charge des chgts d'état de la requete
			request.onreadystatechange = function(response) 
			{
				if (request.readyState === 4) 
				{
					if (request.status === 200) 
					{
						// j'obtient la reponse au format json et l'analyse on obtient un tableau
						var tabJsonOptions = JSON.parse(request.responseText);
						// pour chaque ligne du tableau reçu.
						var noLigne;
						for(noLigne=0;noLigne<tabJsonOptions.length;noLigne++)
						{ 
							// Cree une nouvelle <option>.
							var nouvelleOption = document.createElement('option');
							// on renseigne la value de l'option avec le numéro du produit.
							nouvelleOption.value = tabJsonOptions[noLigne].locCP+';'+tabJsonOptions[noLigne].locLibelle;
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
			var debutCodeCommune=document.getElementById('PV').value;
			//formation du texte de la requete
			var texteRequeteAjax='jsonListeDesCommunes.php?debutCommune='+debutCodeCommune;
			//je l'ouvre
			request.open('GET', texteRequeteAjax, true);
			//et l'envoie
			request.send();
		}//fin du si + de deux caractères ont été saisi
	}

	//#########

	//recup du debut du code postal de la commune
	var debutCodeCommune=document.getElementById('PV').value;
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
		// pour chaque ligne du tableau reçu.PV'
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
	  var debutCodeCommune=document.getElementById('PV').value;
	  //formation du texte de la requete
	  var texteRequeteAjax='PDVJson.php?debutPDV='+debutCodeCommune;
	  //je l'ouvre
	  request.open('GET', texteRequeteAjax, true);
	  //et l'envoie
	  request.send();
  }//fin du si + de deux

	    </script>

		</fieldset>
<p>
			<input type="submit" value="Valider" name="btValiderLot">
</p>
	</form>
</div>
<?
}
?>
<img id="jardinier" src="image/jardinier.jpg">
<img id="boucher" src="image/boucher.jpg">
<?
include("bas.php");
?>
