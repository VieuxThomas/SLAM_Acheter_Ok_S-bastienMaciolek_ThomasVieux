<?
session_start();

//Connexion à la base de données

require "./connect.php";
$maBase=connexion();

//Récupération de la cle et du pseudo
$pseudo=$_GET['pseudo'];
$cleRecue=$_GET['cle'];

//Requete
$reqCle="select utilId from utilisateur where utilPseudo='$pseudo' and utilCle='$cleRecue'";
//Execution de la requete
$resultatCle=mysqli_query($maBase,$reqCle);

$tab=mysqli_fetch_row($resultatCle);
$numero=$tab[0];

include ("haut.php");
	$reqUtil="update utilisateur set utilActif=true where utilId='$numero'";
	$resultatUtil=mysqli_query($maBase,$reqUtil);
	$tab=mysqli_fetch_row($resultatUtil);
?>
	<div id="message">
		<p>Compte activé</p>
	</div>
	<img id="jardinier" src="image/jardinier.jpg">
	<img id="boucher" src="image/boucher.jpg">

<?
include ("bas.php");
?>
