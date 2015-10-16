<?php
function connexion ()
{
	//Déclaration des variables
	$serveur="localhost";
	$basededonnee="dbsmaciolekNewWorld";
	$user="smaciolek";
	$motdepasse="pheG45sp8";

	//Connexion à la base de données
	return mysqli_connect($serveur, $user, $motdepasse, $basededonnee);
}

?>
