<?
//Connexion à la base de données
include("haut.php");
if(isset($_SESSION['id']))
{
	require "./connect.php";
	$maBase=connexion();

	//Récupération des données
	$localite=$_POST['lotPV'];
	$tabLocalite=explode(";",$localite);

	$produit=$_POST['prodNom'];
	$producteur=$_POST['lotProducteur'];
	$parcelle=$_POST['lotParcelle'];
	$origine=$_POST['lotOrigine'];
	$prix=$_POST['lotPrix'];
	$quantite=$_POST['lotQuantite'];
	$unite=$_POST['lotUnite'];
	$dateRecolte=$_POST['lotDateRecolte'];
	$modeProduction=$_POST['lotModeProduction'];
	$nbJConso=$_POST['lotDureeConservation'];
	$masseMin=$_POST['lotMasseMin'];
	$utilId=$_SESSION['id'];

	//Requete recherchant le plus grand identifiant existant et l'incrementer
	$req="select max(lotId)+1 from lot";

	//Execution de la requete
	$curseur=mysqli_query($maBase,$req);
	$tab=mysqli_fetch_row($curseur);
	$lotId=$tab[0];

	if(isset($_POST['btValiderLot']))
	{
		//Ecriture de la requête
		$req2="insert into lot values ($lotId,$prix,'$producteur',$quantite,'$unite','$modeProduction','$dateRecolte','$origine','$parcelle',$nbJConso,$masseMin,$utilId,$produit)";
		//Execution de la requete
		$curseur2=mysqli_query($maBase, $req2);
?>
<p id='message'>Votre lot a bien été enregistré</p>
<div id='fond'>
	<img id="jardinier" src="image/jardinier.jpg">
	<img id="boucher" src="image/boucher.jpg">
</div>
<?
		include("bas.php");
	}
}
else
{
?>
<div id='message'>
	<p>Veuillez vous connecter avec un compte "Produire" pour pouvoir produire</p>
</div>
<?
}
?>


