<?
include("haut.php");
?>

<div id="inscription">
	<form method="POST" action="traitement.php">
		<fieldset>
		<legend>Produit</legend>
			<p>
				<label>Catégorie : </label>
				<select name="categorie" id="categorie">
<?
foreach($tableauSTP as $libelle)
{
?>
<option>
<?
	echo("$libelle");
?>
</option>
<?
}
?>
				</select>
			</p>
			<p>
				<label>Produit : </label>
				<select name="prodNom" id="nomProduit">
					<option value="champsaur">Champsaur</option>
				</select>
			</p>
			<p>
				<label>Quantité : </label><input type="number" name="lotQuantite" id="quantite" value="1">
			</p>
			<p>
				<label>Unité de mesure : </label>
				<select name="lotUM" id="UM">
					<option value="kg">Kg</option>
					<option value="piece">Pièce</option>
					<option value="litre">Litre</option>
				</select>
			</p>
		</fieldset>
		<fieldset>
		<legend>Lieu de production</legend>
				<p>
					<label>Date de récolte : </label><input type="date" name="lotDateRecolte" id="dateRecolte" placeHolder="  ex : 2015-03-02">
				</p>
				<p>
					<label>Mode de production : </label>
					Non Bio : <input type="radio" name="lotModeProduction" id="modeProduction" checked="checked">
					Bio : <input type="radio" name="lotModeProduction" id="modeProduction">
				</p>
				<p>
					<label>Commune : </label><input type="text" name="lotCommune" id="Commune" list="listeDesCommunes" oninput="remplirListeDesCommunes()">
				</p>
					<datalist id="listeDesCommunes">
</datalist>

<script>
//cette fonction se lance quand la commune change
//elle met à jour la liste des communes commençant par ce qui a été saisi par l'utilisateur
function remplirListeDesCommunes()
{
  //recup du debut du code postal de la commune
  var debutCodeCommune=document.getElementById('Commune').value;
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
	  var debutCodeCommune=document.getElementById('Commune').value;
	  //formation du texte de la requete
	  var texteRequeteAjax='jsonListeDesCommunes.php?debutCommune='+debutCodeCommune;
	  //je l'ouvre
	  request.open('GET', texteRequeteAjax, true);
	  //et l'envoie
	  request.send();
  }//fin du si + de deux caractères ont été saisi
}
</script>

				<p>
					<label>Durée de conservation en jour : </label><input type="text" id="dureeConservation" name="lotDureeConservation">
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
					<label>Point de vente : </label><input type="text" name="lotPV" id="PV" placeHolder=" Point de vente" list="listeDesCommunes" oninput="remplirListeDesCommunes()">
				</p>
					 <datalist id="listeDesCommunes">
</datalist>


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
</script>

		</fieldset>
				<p>
					<input type="submit" value="Valider" name="btValiderLot">
				</p>
	</form>
</div>

<img id="jardinier" src="image/jardinier.jpg">
<img id="boucher" src="image/boucher.jpg">

<?
include("bas.php");
?>
