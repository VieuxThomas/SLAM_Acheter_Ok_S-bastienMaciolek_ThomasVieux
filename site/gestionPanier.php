<?
session_start();

foreach($_POST as $nomInput=>$valeurInput)
{

	if(substr($nomInput,0,10)=="qteProduit")
	{
		$qte=$valeurInput;
	}

	if(substr($nomInput,0,6)=="nomPro")
	{
		$nom=$valeurInput;
		
	}
}
$idUtil=$_SESSION['id'];

echo $qte;
echo $nom;
echo $idUtil;

?>
