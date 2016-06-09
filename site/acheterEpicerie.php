<?
require"./connect.php";
$maBase=connexion();
include ("haut.php");
$_SESSION['produit']="FRUIT";
?>

<script language="javascript">
function calcul(pNum){
	document.all['montant'+pNum].value=document.all['prixProduit'+pNum].value*document.all['qteProduit'+pNum].value 
}
</script>
<?
$reqType="select typeproduitLibelle,typeproduitId from typeProduit natural join surtypeProduit where surtypeproduitId=4";
$curseurType=mysqli_query($maBase,$reqType);
$cptType=0;
$leProduitId="";
while($leType=mysqli_fetch_row($curseurType))
{
	$type=$leType[0];
	$idType=$leType[1];
?>
	<div id="typeProduit"><p><? echo $type ?></p></div>
<?
	$reqProduit="select prodId,prodLibelle,prodPhoto from produit natural join typeProduit natural join lot where typeproduitId=$idType";
	$curseurProduit=mysqli_query($maBase,$reqProduit);

	$cptProduit=0;
	while($leProduit=mysqli_fetch_row($curseurProduit))
	{	
		$produitId=$leProduit[0];
		if (!($produitId==$leProduitId))
		{
		$leProduitId=$produitId;
		$produit=$leProduit[1];
		$produitPhoto=$leProduit[2];
		$cptProduit++;
		$reqLot="select lotPrix,lotQuantite,lotMasseMin, lotId, uniteLibelle from lot inner join produit on produit.prodId=lot.prodId natural join unite where lotQuantite > 0 AND lot.prodId=$produitId";
		$curseurLot=mysqli_query($maBase,$reqLot);
		while($leLot=mysqli_fetch_row($curseurLot))
		{
			$lotPrix=$leLot[0];
			$lotQte=$leLot[1];
			$lotMin=$leLot[2];
			$prixMin=$lotMin*$lotPrix;
			$lotId=$leLot[3];
			$unite=$leLot[4];
?>
	<div id="produit">
		<form method="POST" action="gestionPanier.php"> 
		<img id="photoProduit" src="image/<? echo $produitPhoto ?>">
		<p id="produitNom" name="produitNom<? echo $cptType ?>"><? echo $produit ?></p>
		<input type="text" style="visibility:hidden; float:right"name="nomProduitCache<? echo $cptType ?>" value="<? echo $produit ?>"/>
		<input type="text" style="visibility:hidden" name="idLot<? echo $cptType ?>" value="<? echo $lotId ?>">
		<input type="hidden" name="prixProduit<? echo $cptType ?>" value="<? echo $lotPrix ?>">
		<p id="prixProduit"><label>Prix unitaire : </label><? echo $lotPrix ?> ¿</p>
		<p id="qteProduit"><label>Quantité restante : </label><? echo $lotQte." ".$unite; ?></p>
		<input id="compteurQte" type="number" name="qteProduit<? echo $cptType ?>" onKeyup="calcul(<? echo $cptType ?>)" max="<? echo $lotQte ?>" min="<? echo $lotMin ?>" value="<? echo $lotMin ?>">


		<p id="totalCout"><label>Total : </label><input type="text" name="montant<? echo $cptType ?>"value="<? echo $prixMin ?>"> ¿</p>

		<input id="btAjout" type="submit" name="btAjout-<? echo $cptType ?> " value="Ajouter au panier">
		</form> 

	</div>
<?
			$cptType++;

		}
		}
			}
}

?>
<?
include ("bas.php");
?>

