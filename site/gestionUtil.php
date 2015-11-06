<?
session_start();
require"./connect.php";
$maBase=connexion();

$utilisateur=$_POST['utilPseudo'];
$MDP=$_POST['utilMdp'];
$MDPCrypte=$MDP;
$reqUtil="select utilPrenom,utilNom from utilisateur where utilMdp=password('$MDP') and utilPseudo='$utilisateur'";

$reqResultat=mysqli_query($maBase,$reqUtil);
$nbLigne=mysqli_num_rows($reqResultat);


if ($nbLigne==1)
{
	$resultatReq=mysqli_fetch_row($reqResultat);
	$prenom=$resultatReq[0];
	$nom=$resultatReq[1];
	$_SESSION['prenom']=$prenom;
	$_SESSION['nom']=$nom;
	$_SESSION['actif']=1;

	include("haut.php");
?>
	<p id='message'><font color=white>Votre connexion a bien etait réaliser vous pouvez dorénavant parcourir notre site en toute liberter. </br>Bonne visite. </br></p>
<a href="accueil.php"><font color=white>Retour sur la page d'acceuil</a>
<?
include("bas.php");
}
?>




