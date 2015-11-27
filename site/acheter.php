<?
include("haut.php");
if ($_SESSION['actif']==0)
{
?>
<div id='messageDesoleConnexion'>
<p> Désolée, mais vous ne pouvez pas accéder a cette page si vous n'avez pas été connecter.
</div>
<?
}
else
{
?>
<div id='messageConnexion'>
	<p>Bienvenue dans acheter, ici vous trouverer tous les types de fruits et legumes de la région</p>
</div>
<p><a href="acheterLegume.php"><img id="legume" src="image/legumes.png"></a>
<a href="acheterFruit.php"><img id="fruit" src="image/fruits.png"></a></p>
</br>
</br>
</br>
<a href="acheterViande.php"><img id="charcuterie" src="image/charcuterie.png"></a>
<a href="acheterFromage.php"><img id="fromage" src="image/fromage.png"></a>
	<script language="javascript">
	$("#Legume").mouseover (
		var Legume = document.getElementById('Legume');
	Legume.style.widht=500px;
<?
}
include("bas.php");
?>
