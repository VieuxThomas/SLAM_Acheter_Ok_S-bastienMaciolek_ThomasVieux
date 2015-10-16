/**
 * @file main.cpp
 * @author Vieux Thomas
 * @date vendredi 4 septembre
 * @brief ce programme sert a determiner si un nombre entrer par l'utilisateur est premier
 */
#include<iostream>
using namespace std ;
int main ()
{
	//Déclaration des variables
	int faux, compteur, total, nbr;
	//Demande a l'utilisateur un nombre 
	cout<<"choisir un nombre"<<endl;
	//nbr prend la valeur de ce que l'utilisateur a rentrer
	cin>>nbr;
	//Initialisation du compteur
	compteur=1;

	//Debut de la boucle 
	do
	{
		//incrementation de la variable compteur 
		compteur++;
		//total prend pour valeur le reste de la division entre nbr et compteur
		total=nbr%compteur;
		//Determine si le nombre est premier ou pas
		if (total==0 && compteur!=nbr)
		{
			cout<<"le nombre n'est pas premier"<<endl;
			faux=1;
		}
		
	//fin de la boucle 
	}while(!(faux==1 or compteur==nbr));
		//Si le compteur est egal au nombre, le chiffre est premier 
		if (compteur==nbr)
			{
			cout<<"le nombre est premier"<<endl;
			}



	return 0;
}
//Fin du programme


