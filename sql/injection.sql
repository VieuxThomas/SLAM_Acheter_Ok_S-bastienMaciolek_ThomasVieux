DELETE FROM proposerA;
DELETE FROM lot;
DELETE FROM pointDeVente;
DELETE FROM choisir;
DELETE FROM question;
DELETE FROM utilisateur;
DELETE FROM localite;
DELETE FROM produit;
DELETE FROM typeProduit;
DELETE FROM surtypeProduit;

LOAD DATA LOCAL INFILE 'codesPostaux.csv' INTO TABLE localite FIELDS TERMINATED BY ";" LINES TERMINATED BY "\n";

LOAD DATA LOCAL INFILE 'typeProduit.csv' INTO TABLE typeProduit FIELDS TERMINATED BY ";" LINES TERMINATED BY "\n";

LOAD DATA LOCAL INFILE 'surtypeProduit.csv' INTO TABLE surtypeProduit FIELDS TERMINATED BY ";" LINES TERMINATED BY "\n";


-- Ajoute un utilisateur fantome qui servira de base à la création des identifiants suivants.  
INSERT INTO utilisateur VALUES (1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NUll,1);
