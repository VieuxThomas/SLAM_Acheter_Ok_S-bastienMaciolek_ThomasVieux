<?
include("haut.php");
//Si l'utilisateur n'est pas connecté
if ($_SESSION['actif']==0)
{
?>
<div id='message'>
<p>Veuillez vous connecter pour pouvoir accéder à la page d'achat</p>
</div>
<?
}
else
{
?>
<div id='messageConnexion'>
	<p>Bienvenue dans acheter</p>
</div>

<table id="tbType" align="center">
	<tr>
		<td>Légumes</td>
		<td id="tdVide"></td>
		<td>Fruits</td>
	</tr>
	<tr>
		<td><a href="acheterLegume.php"><img id="legume" src="image/legumes.png"></a></td>
		<td id="tdVide"></td>
		<td><a href="acheterFruit.php"><img id="fruit" src="image/fruits.png"></a></td>
	</tr>
	<tr>
		<td>Charcuterie</td>
		<td id="tdVide"></td>
		<td>Laitier</td>
	</tr>
	<tr>
		<td><a href="acheterViande.php"><img id="charcuterie" src="image/charcuterie.png"></a></td>
		<td id="tdVide"></td>
		<td><a href="acheterLaitier.php"><img id="fromage" src="image/fromage.png"></a></p></td>
	</tr>
	<tr>
		<td>Cereales</td>
		<td id='tdVide'></td>
		<td>Epiceries</td>
	</tr>
	<tr>
		<td><a href='acheterCereales.php'><img id="cereales" src='image/cereales.png'></a></td>
		<td id='tdVide'></td>
		<td><a href='acheterEpicerie.php'><img id='epicerie' src='image/epicerie.png'></a></td>
	</tr>
</table>

	<script language="javascript">
	$("#Legume").mouseover (
		var Legume = document.getElementById('Legume');
	Legume.style.widht=500px;
	</script>
<?
}
include("bas.php");

?>
