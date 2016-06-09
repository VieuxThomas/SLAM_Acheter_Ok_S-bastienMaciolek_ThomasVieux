<?
$tabPDV=array();
require"./connect.php";
$maBase=connexion();
$debutPDV2=$_GET['debutPDV'];
$debutPDV=substr($debutPDV2,0,5);
//echo $debutPDV;
$requete = "select ptventeLibelle, ptventeRue from pointDeVente where ptventeCP='$debutPDV' ";
//echo $requete;

$curseur=mysqli_query($maBase,$requete);
while($tab=mysqli_fetch_assoc($curseur))
{
	$tabPDV[]=$tab;
}
echo json_encode($tabPDV);
?>
