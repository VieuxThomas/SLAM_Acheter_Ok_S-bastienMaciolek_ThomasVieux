<?
include("haut.php");
session_start();

//Connexion à la base de données

require "./connect.php";
$maBase=connexion();

?>

<div id="inscription">
	<form method="POST" action="traitement.php">
		<fieldset>
			<legend>Utilisateur</legend>
				<p>
					<label>Pseudo : </label><input type="text" name="utilPseudo" id="pseudo" placeHolder=" ex : pdupond">
				</p>
				<p>	
					<label>Nom : </label><input type="text" name="utilNom" id="nom" placeHolder=" ex : Dupond">
				</p>
				<p>
					<label>Prénom : </label><input type="text" name="utilPrenom" id="prenom" placeHolder=" ex : Pierre">
				</p>
				<p>
					<label>Date de Naissance : </label><input type="date" name="utilDateNaiss" id="date" placeHolder="  ex : 1991-01-07">
				</p>
				<p>
					<label>Type : </label>
					Client : <input type='radio' name='utilType' id='utilType' checked="checked" value="Client">
					Producteur : <input type='radio' name='utilType' id='utiltype' value="Producteur">
				</p>
		</fieldset>
		<fieldset>
			<legend>Coordonnées</legend>
				<p>
					<label>Adresse : </label><input type="text" name="utilRue" id="adresse" placeHolder=" ex : 3 Rue des Champs">
				</p>
				<p>
				<label>Localité : </label><input type="text" name="utilLocalite" id="Localite" placeHolder=" ex : 78140" list="listeDesCommunes" oninput="remplirListeDesCommunes()">
				</p>
					                               <datalist id="listeDesCommunes">
</datalist>
<script>
//cette fonction se lance quand la commune change
//elle met à jour la liste des communes commençant par ce qui a été saisi par l'utilisateur
function remplirListeDesCommunes()
{
  //recup du debut du code postal de la commune
  var debutCodeCommune=document.getElementById('Localite').value;
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
	  var debutCodeCommune=document.getElementById('Localite').value;
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
					<label>Téléphone : </label><input type="tel" name="utilTelephone" id="telehpone" maxlength="15" placeHolder=" ex : 0645788956">
				</p>
				<p>
					<label>Adresse éléctronique : </label><input type="email" name="utilMail" id="mail" placeHolder=" ex : pdupond@exemple.com">
				</p>
		</fieldset>
		<fieldset>
			<legend>Mot de passe</legend>
			<p>
				<label>Mot de passe : </label><input type="password" name="utilMdp" id="mdp1" placeHolder="  8 caractères minimum">
			</p>
			<p>
				<label>Mot de passe (confirmation) : </label><input type="password" name="utilMdp2" id="mdp2" placeHolder="  Confirmation">
			</p>
		</fieldset>
			<p>
			<input type="submit" value="Valider" name="btValiderUtilisateur">
		</p>
	</form>
</div>
<img id="jardinier" src="image/jardinier.jpg">
<img id="boucher" src="image/boucher.jpg">

<?
include("bas.php");
?>
