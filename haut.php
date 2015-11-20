<?
session_start();
if (!isset($_SESSION['actif']))
{
	$_SESSION['actif']=0;
}

?>
<!DOCTYPE HTML>
<?
if (isset($_POST['btDeco']))
{
	$_SESSION['actif']=0;

}
?>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link type='text/css' rel="stylesheet" href="style.css">
		<link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Cedarville+Cursive' rel='stylesheet' type='text/css'>	
		<title>New World</title>
	</head>
	<body>
		<div id='statut'> 
			<span>
				
				<a href="" style="text-decoration:none;font-size:small" class="lien">&nbsp;&nbsp;| France</a>
<?
if ($_SESSION['actif']==0)
{


?>
				<a href="inscription.php" style="text-decoration:none;font-size:small" class="lien">&nbsp;&nbsp;| Inscription</a>
				
				<a href="connexion.php" style="text-decoration:none;font-size:small" class="lien">&nbsp;&nbsp;| Connexion</a>
<?
}
else 
{
echo $_SESSION['nom']," ", $_SESSION['prenom'];
?>
				<form method="POST" action="">
				<input type="submit" value="déconnexion" name="btDeco"> 
				</form>
<?
}

?>
			</span>
		</div>
		<div id='barreMenu'>
			<p>
				<a href="accueil.php" style="text-decoration:none" class="lien">NW</a>
				<a href="acheter.php" style="text-decoration:none" class="lien">Acheter</a>
				<a href="produire.php" style="text-decoration:none" class="lien">Produire</a>
				<a href="accueil.php" style="text-decoration:none" class="lien">Distribuer</a>
				<input id="barreRecherche" type="text" placeHolder="  Rechercher"/>
				<a href="panier.php" style="text-decoration:none;font-size:20px;color:yellow;"><img src="image/panier.png" style="width:50px"></a>

			</p>
		</div>

