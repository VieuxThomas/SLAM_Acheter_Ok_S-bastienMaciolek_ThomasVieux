<?
session_start();

require"./connect.php";
$maBase=connexion();

$idUtil=$_SESSION['id'];

foreach ($_POST as $nomImput=>$valeurInput)
{
	echo $nomImput;
	if(substr($nomImput,0,2)=="id")
	{
		$carac=strlen($nomImput);
		
		$id=substr($nomImput,2,$carac);
		echo $id;
	}
}

$reqPanier="select panierId from panier where utilId=$idUtil and boolPanier=0";
$curseurPanier=mysqli_query($maBase,$reqPanier);
$panier=mysqli_fetch_row($curseurPanier);
echo $reqPanier;

$reqLignePanier="select id, quantite from lignePanier where panierId=$panier[0] and lotId=$id";
$curseurLignePanier=mysqli_query($maBase,$reqLignePanier);
$lignePanier=mysqli_fetch_row($curseurLignePanier);
echo $reqLignePanier;

$reqRajout="update lot set quantite=quantite+$lignePanier[1] where lotId=$lignePanier[0]";
$Rajout=mysqli_query($maBase,$reqRajout);
echo $reqRajout;

$reqSupr="delete from lignePanier where id=$lignePanier[0]";
$supr=mysqli_query($maBase,$reqSupr);
echo $reqSupr;

//header('Location:http://localhost/~smaciolek/SLAM_Acheter_Ok_S-bastienMaciolek_ThomasVieux/site/panier.php');

