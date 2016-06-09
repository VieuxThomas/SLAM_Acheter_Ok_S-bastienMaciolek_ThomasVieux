<?
require"./connect.php";
$maBase=connexion();
include("haut.php");

//print_r($_SESSION);

$idUser = $_SESSION['id'];

$reqPayer="select max(panierId) from panier where utilId=$idUser";
$curseurPayer=mysqli_query($maBase,$reqPayer);
$payer=mysqli_fetch_row($curseurPayer);

$reqModif="update panier set boolPanier=1 where panierId=$payer[0]";
$modif=mysqli_query($maBase,$reqModif);

header('Location:http://localhost/~smaciolek/SLAM_Acheter_Ok_S-bastienMaciolek_ThomasVieux/site/validationPayement.php');


