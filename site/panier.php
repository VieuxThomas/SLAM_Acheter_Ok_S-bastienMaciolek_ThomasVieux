<?
require"./connect.php";
$maBase=connexion();
include("haut.php");

//print_r($_SESSION);

$idUser = $_SESSION['id'];

$prixTotal = 0;
$reqPanier = "SELECT lignePanier.lotId, quantite from panier NATURAL JOIN lignePanier WHERE panier.utilId = $idUser and boolPanier=0" ;
$curseurPanier = mysqli_query($maBase,$reqPanier);
if(mysqli_num_rows($curseurPanier) == 0)
{
	echo "<div id='message'>
	<p>Panier vide</p>
</div>
<img id='jardinier' src='image/jardinier.jpg'>
<img id='boucher' src='image/boucher.jpg'>";
}
else
{
?>	<p id="typeProduit">Panier</p>
<?
	while($tabLeLot = mysqli_fetch_row($curseurPanier))
	{
		$reqInfoLot = "SELECT lotPrix, prodPhoto, prodLibelle, lotOrigine from lot NATURAL JOIN produit WHERE lot.lotId = ".$tabLeLot[0];
		$curseurLot = mysqli_query($maBase,$reqInfoLot);
		$tabInfoLot = mysqli_fetch_row($curseurLot);

		$reqPointDeVente="SELECT ptventeLibelle, ptventeTelephone, ptventeRue, ptventeCP, ptventeVille from pointDeVente natural join proposerA where lotId= $tabLeLot[0]";
		$curseurPDV= mysqli_query($maBase,$reqPointDeVente);
		$tabPDV = mysqli_fetch_row($curseurPDV);
		$titlePDV = "Libellé : $tabPDV[0]\nTéléphone : ".$tabPDV[1]."\nAdresse : ".$tabPDV[2]." ".$tabPDV[3]." ".$tabPDV[4];
		print_r($tabPDV[0]);
?>
	<div id="produit">
		<form method="POST" action="gestionLotPanier.php">
		<p id="produitNom"><? echo $tabInfoLot[2]; ?><img src="image/pointInterrogation.png" title="<? echo $titlePDV ?>"></p>
		<img id="photoProduitPanier" src="image/<? echo $tabInfoLot[1]; ?>">
		<p id="qteProduit"><label>Quantité : </label><? echo $tabLeLot[1]; ?></p>
		<p id="prixProduit"><label>Prix unitaire : </label><? echo $tabInfoLot[0] ?> €</p>
		<p id="prixProduit"><label>Origine : </label><?echo $tabInfoLot[3]; ?></p>
		<input type="hidden" id="idLotCache" value="id<? $tabLeLot[0] ?>"</input>
		<p id="prixProduit"><label>Prix totale du lot : </label><?echo $tabLeLot[1]*$tabInfoLot[0]?> €</p> 
		<input type="submit" id="supprimerPanier" name="id<? echo $tabLeLot[0] ?>" value="Supprimer" style:"margin-left:35px">
		</form>	
	</div>
<?
		$prixTotal +=  $tabLeLot[1] * $tabInfoLot[0];
	}
?>
	<div id="typeProduit">
<form method="POST" action="payer.php">
		<p><label>Prix total : </label><? echo $prixTotal ?> €</p>
		<input type="submit" id="payer" value="Payer" style="font-size:120px">
</form>
	</div>
<?
}
	

?>
<?
include("bas.php");
?>
