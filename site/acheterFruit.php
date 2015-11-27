<?
require"./connect.php";
$maBase=connexion();
include ("haut.php");
$_SESSION['produit']="FRUIT";
?>

<?
	$reqType="select typeproduitLibelle,typeproduitId from typeProduit natural join surtypeProduit where surtypeproduitId=1";
	$curseurType=mysqli_query($maBase,$reqType);
	$cptType=0;
	while($leType=mysqli_fetch_row($curseurType))
	{
		$type=$leType[0];
		$idType=$leType[1];
?>
	<div id="typeProduit"><p><? echo $type ?></p></div>
<?
		$reqProduit="select prodId,prodLibelle,prodPhoto from produit natural join typeProduit where typeproduitId=$idType";
		$curseurProduit=mysqli_query($maBase,$reqProduit);

		$cptProduit=0;
		while($leProduit=mysqli_fetch_row($curseurProduit))
		{	
			$produitId=$leProduit[0];
			$produit=$leProduit[1];
			$produitPhoto=$leProduit[2];
			$cptProduit++;
			$reqLot="select lotPrix,lotQuantite, lotMasseMin from lot inner join produit on produit.prodId=lot.prodId where lot.prodId=$produitId";
			$curseurLot=mysqli_query($maBase,$reqLot);
			$leLot=mysqli_fetch_row($curseurLot);
			$lotPrix=$leLot[0];
			$lotQte=$leLot[1];
			$lotMin=$leLot[2];
?>
	<div id="produit">
		<img id="photoProduit" src="image/<? echo $produitPhoto ?>">
		<p id="produitNom"><? echo $produit ?></p>
		<p id="prixProduit"><label>Prix unitaire : </label><? echo $lotPrix ?> €</p>
		<p id="qteProduit"><label>Quantité restante : </label><? echo $lotQte; ?></p>
		<input id="compteurQte" type="number" max="<? echo $lotQte ?>" min="<? echo $lotMin ?>" value="<? echo $lotMin ?>">

	</div>
<?
			
		}
	}

?>
<?
include ("bas.php");
?>
