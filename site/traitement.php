<?
session_start();

//Connexion à la base de données

require "./connect.php";
$maBase=connexion();

//Récupération des données
$tabErreurs=array();
$ok=true;

$localite=$_POST['utilLocalite'];
$tabLocalite=explode(";",$localite);

$nom=$_POST['utilNom'];
$prenom=$_POST['utilPrenom'];
$pseudo=$_POST['utilPseudo'];
$dateNaiss=$_POST['utilDateNaiss'];
$rue=$_POST['utilRue'];
$CP=$tabLocalite[0];
$ville=$tabLocalite[1];
$telephone=$_POST['utilTelephone'];
$mdpu=$_POST['utilMdp'];
$mail=$_POST['utilMail'];
$type=$_POST['utilType'];

//Vérification du formulaire****************

$mdpOk=($_POST['utilMdp']==$_POST['utilMdp2']);
if (!($mdpOk))
{
	array_push($tabErreurs,"Mot de passe incorrecte\n");
	$ok=false;
}

$nomOk=strlen($_POST['utilNom'])>=2;
if(!($nomOk)) 
{
	array_push($tabErreurs,"Le nom doit faire plus de 2 caractères)\n");
	$ok=false;
}

$prenomOk=strlen($_POST['utilPrenom'])>=2;
if(!($prenomOk)) 
{
	array_push($tabErreurs,"Le prénom doit faire plus de 2 caractères)\n");
	$ok=false;
}

$pseudoOk=strlen($_POST['utilPseudo'])>=5;
if(!($pseudoOk)) 
{
	array_push($tabErreurs,"Le pseudo doit faire plus de 5 caractères)\n");
	$ok=false;
}

$mdpOk=strlen($_POST['utilMdp'])>=8;
if(!($mdpOk))
{
	array_push($tabErreurs,"Le mot de passe doit faire plus de 8 caractères\n");
	$ok=false;
}
//Requete listant les adresses éléctroniques
$reqAdresse="select utilId from utilisateur where utilMail='$mail'";
$resultatAdresse=mysqli_query($maBase,$reqAdresse);
$tabAdresse=mysqli_fetch_row($resultatAdresse);
$num=$tabAdresse[0];

	if($num>0)
	{
		array_push($tabErreurs,"Adresse mail déjà utilisée !\n");
		$ok=false;
	}

//Fin vérification formulaire***********************

//Initialisation des requetes et implémentation des données **************** 
//Requete recherchant le plus grand identifiant existant et l'incrementer
$reqId="select max(utilId)+1 from utilisateur";
//Execution de la requete
$resultatId=mysqli_query($maBase,$reqId);
$tab=mysqli_fetch_row($resultatId);
$numero=$tab[0];
$clef=md5(rand());

if (isset($_POST['btValiderUtilisateur']) && $ok==true)
{
	//Ecriture de la requête
	$requete="insert into utilisateur values ($numero,'$nom','$prenom','$pseudo','$dateNaiss','$rue','$CP','$ville','$telephone',password('$mdpu'),'$mail','$type','$clef',0)";
	//Execution de la requete
	$res=mysqli_query($maBase, $requete);
}
//Fin requetes et implémentation**************************

//Affichage***************
include("haut.php");
?>

<div id="message">
<?	
	if($ok==true)
	{
	$mailDestinataire=$_POST['utilMail'];
?>
		<p>Compte enregistré avec succès !</p>
<?
		if(mail('$mailDestinataire','Sujet','Test'))
		{
?>
			<p>Un mail de confirmation vous à été envoyé a votre adresse éléctronique.</p>
<?
			mail($mailDestinataire,"Email de confirmation - New World","Votre compte a bien été ajouté, pour confirmer votre inscription, cliquez sur le lien qui suit : http://172.16.63.111/~smaciolek/newWorld/site/validation.php?pseudo=$pseudo&cle=$clef");
		}
		else
		{
?>
			<p>Une erreur est survenue lors de l'envoi d'un mail de confirmation, réssayez plus tard.</p>
<?
		}
	}
	else
	{
?>
		<p>Des informations saisies sont manquantes ou fausses :</p>
		</br>
<?
		foreach($tabErreurs as $Erreur)
		{
?>
			<p><?=$Erreur?></p>
<?
		}
	}
?>
</div>
	<img id="jardinier" src="image/jardinier.jpg">
	<img id="boucher" src="image/boucher.jpg">
<?	

include("bas.php");

//Fin affichage********************
?>

