DROP TABLE if exists proposerA;
DROP TABLE if exists lot;
DROP TABLE if exists pointDeVente;
DROP TABLE if exists choisir;
DROP TABLE if exists question;
DROP TABLE if exists utilisateur;
DROP TABLE if exists localite;
DROP TABLE if exists produit;
DROP TABLE if exists typeProduit;
DROP TABLE if exists surtypeProduit;

CREATE TABLE utilisateur(
	utilId int,
	utilNom varchar (20),
	utilPrenom varchar (20),
	utilPseudo varchar (20),
	utilDateNaiss date,
	utilRue varchar (30),
	utilCP varchar (5),
	utilVille varchar (30),
	utilTelephone varchar (15),
	utilMdp varchar (15),
	utilMail varchar (20),
	utilType varchar (20),
	utilCle varchar (50),
	utilActif tinyint (1),
	PRIMARY KEY (utilId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE produit(
	prodId int,
	prodLibelle varchar (50),
	typeproduitId int NOT NULL,
	PRIMARY KEY (prodId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE lot(
	lotId int,
	lotPrix float,
	lotProducteur varchar (20),
	lotQuantite int,
	lotModeProduction bool,
	lotDateRecolte date,
	lotOrigine varchar (20),
	lotParcelle int,
	lotNbJourConsommation smallint,
	lotMasseMin smallint,
	utilId int NOT NULL,
	prodId int NOT NULL,
	PRIMARY KEY (lotId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE pointDeVente(
	ptventeId int,
	ptventeLibelle varchar (20),
	ptventeActivite varchar (20),
	ptventeNom varchar (20),
	ptventePrenom varchar (20),
	ptventeTelephone varchar (15),
	ptventeRue varchar (20),
	ptventeCP varchar (5),
	ptventeVille varchar (30), 
	PRIMARY KEY (ptventeId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE typeProduit(
	typeproduitId int,
	typeproduitLibelle varchar (20),
	surtypeproduitId int NOT NULL,
	PRIMARY KEY (typeproduitId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE surtypeProduit(
	surtypeproduitId int,
	surtypeproduitLibelle varchar (20),
	PRIMARY KEY (surtypeproduitId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE localite(
	locId int NOT NULL,
	locLibelle varchar (30) NOT NULL,
	locCP varchar (5) NOT NULL,
	locAcheminement varchar (30),
	PRIMARY KEY (locId,locLibelle,locCP)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE choisir(
	questionId tinyint NOT NULL,
	utilReponse int NOT NULL,
	choReponse varchar (150),
	PRIMARY KEY (questionId,utilReponse)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE question(
	utilQuestionId tinyint,
	questionLibelle varchar (100),
	PRIMARY KEY (utilQuestionId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE proposerA(
	ptventeId int NOT NULL,
	lotId int NOT NULL,
	PRIMARY KEY (ptventeId,lotId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create index idxCPLocalite on localite(locCP);
create index idxLibelleLocalite on localite(locLibelle);

Alter table lot
	add foreign key (prodId) references produit (prodId),
	add foreign key (utilId) references utilisateur (utilId);

Alter table produit
	add foreign key (typeproduitId) references typeProduit (typeproduitId);

Alter table typeProduit
	add foreign key (surtypeproduitId) references surtypeProduit (surtypeproduitId);

Alter table utilisateur
	add foreign key (utilCP) references localite (locCP),
	add foreign key (utilVille) references localite (locLibelle);

Alter table pointDeVente
	add foreign key (ptventeCP) references localite (locCP),
	add foreign key (ptventeVille) references localite (locLibelle);

Alter table proposerA
	add foreign key (ptventeId) references pointDeVente (ptventeId),
	add foreign key (lotId) references lot (lotId);

Alter table choisir
	add foreign key (questionId) references question (utilQuestionId),
	add foreign key (utilReponse) references utilisateur (utilId);
