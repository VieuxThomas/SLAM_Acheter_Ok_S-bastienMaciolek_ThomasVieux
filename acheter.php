<?
include("haut.php");
if ($_SESSION['actif']==0)
{
?>
<div id='message'>
<p> Désolée, mais vous ne pouvez pas accéder a cette page si vous n'avez pas été connecter.
</div>
<?
}
else
{
?>
<div id='message'>
	<p>Bienvenue dans acheter, ici vous trouverer tous les types de fruits et legumes de la région</p>
</div>
<p><a href="acheterLegume.php"><img id="Legume" src="image/8.png" style="widht:400px; height:400px;"></a>
<a href="acheterFruit.php"><img id="fruit" src="image/corbeille-fruits-detouree.gif" style="widht:500px; height:500px;"></a></p>
</br>
</br>
</br>
<a href="acheterViande.php"><img id="Viande" src="image/meat-3.png"></a>
<a href="acheterFromage.php"><img id="Fromage" src="image/fromage.png" style="widht:500 px; height:500px"></a>
	<script language="javascript">
	$("#Legume").mouseover (
		var Legume = document.getElementById('Legume');
	Legume.style.widht=500px;
<?

}
include("bas.php");
?>
