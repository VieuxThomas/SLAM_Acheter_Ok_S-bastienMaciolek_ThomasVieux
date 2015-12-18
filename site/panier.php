<?
require"./connect.php";
$maBase=connexion();
include("haut.php");

//print_r($_SESSION);

$idUser = $_SESSION['id'];

$reqPanier = "SELECT lignePanier.lotId, quantite, lotPrix, prodPhoto, prodLibelle from panier NATURAL JOIN lignePanier NATURAL JOIN lot NATURAL JOIN produit WHERE panier.utilId = $idUser";
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
?>
	<div id="produit">
		<p id="produitNom"><? echo $tabLeLot[4]; ?></p>
		<img id="photoProduit"src="image/<? echo $tabLeLot[3]; ?>">
		<p id="qteProduit"><label>Quantité : </label><? echo $tabLeLot[1]; ?></p>
		<p id="prixProduit"><label>Prix unitaire : </label><? echo $tabLeLot[2] ?> €</p>
		<input type="submit" id="btSupprimer" value="Supprimer">
	</div>
<?
	}
}
	

?>


<?
include("bas.php");
?>
