<?php
function connexion ()
{
	//Déclaration des variables
	$serveur="172.16.63.111";
	$basededonnee="dbsmaciolekNewWorld";
	$user="tvieux";
	$motdepasse="OsjH12RRc";

	//Connexion à la base de données
	return mysqli_connect($serveur, $user, $motdepasse, $basededonnee);
}

?>
