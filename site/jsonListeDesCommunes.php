<?
session_start();

//Connexion � la base de donn�es

require "./connect.php";
$maBase=connexion();

$tabRes=array();
$debutCommune=$_GET['debutCommune'];
$requete="select locId,locCP,locLibelle from localite where locCP like '$debutCommune%'";
$curseur=mysqli_query($maBase,$requete);
while($tab=mysqli_fetch_assoc($curseur))
{
        $tabRes[]=$tab;
}
echo json_encode($tabRes);
?>
