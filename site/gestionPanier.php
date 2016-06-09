<?
session_start();

require"./connect.php";
$maBase=connexion();

foreach($_POST as $nomInput=>$valeurInput)
{

	if(substr($nomInput,0,10)=="qteProduit")
	{
		$qte=$valeurInput;
		
	}
	if(substr($nomInput,0,5)=="idLot")
	{
		$lotId = $valeurInput;
		echo $lotId;
	}

}
$idUtil=$_SESSION['id'];

$reqVerif="select panierId from panier where utilId='$idUtil' and boolPanier=0";
print($reqVerif);
$curseur=mysqli_query($maBase,$reqVerif);
$panierIdFetch=mysqli_fetch_row($curseur);
$panierId = $panierIdFetch[0];

//Si auncun panier existe
if(empty($panierId[0]))
{
	$reqIdMax="select ifnull(max(panierId)+1,0) from panier";
	$curseurMax=mysqli_query($maBase,$reqIdMax);
	$maxId=mysqli_fetch_row($curseurMax);
	$reqCreationPanier="insert into panier values ($maxId[0],$idUtil,0)";
	$execReq=mysqli_query($maBase,$reqCreationPanier);
	$panierId=$maxId[0];
}

//Recherche du max
	
$reqMax="select max(id)+1 from lignePanier";
$curseurMax=mysqli_query($maBase,$reqMax);
$Max=mysqli_fetch_row($curseurMax);

//Ajout du lot dans le panier
$reqAjout="insert into lignePanier values ($Max[0],$panierId,$lotId,$qte)";
$execReq = mysqli_query($maBase,$reqAjout);

//Décrémentation de la quantité du lot
$reqDecr = "UPDATE lot SET lotQuantite = lotQuantite-".$qte." WHERE lotId = ".$lotId;
$execDecr = mysqli_query($maBase,$reqDecr);
header('Location:http://localhost/~smaciolek/SLAM_Acheter_Ok_S-bastienMaciolek_ThomasVieux/site/panier.php');
?>

