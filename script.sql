CREATE TABLE utilisateur(
   nomUser VARCHAR(100),
   adresseMail VARCHAR(100) NOT NULL,
   motDePasse VARCHAR(50) NOT NULL,
   Nom VARCHAR(50),
   Prenom VARCHAR(50),
   Pays VARCHAR(50),
   Age int,
   Description VARCHAR(1000),
   PRIMARY KEY(nomUser),
   UNIQUE(adresseMail)
);

CREATE TABLE canal(
   nomCanal VARCHAR(50),
   PRIMARY KEY(nomCanal)
);

CREATE TABLE post(
   Id_post INT AUTO_INCREMENT,
   nom VARCHAR(50) NOT NULL,
   description VARCHAR(500),
   imagePath VARCHAR(1000),
   datePost DATE NOT NULL,
   nomUser VARCHAR(100) NOT NULL,
   nomCanal VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_post),
   FOREIGN KEY(nomUser) REFERENCES utilisateur(nomUser),
   FOREIGN KEY(nomCanal) REFERENCES canal(nomCanal)
);

CREATE TABLE appartient(
   nomUser VARCHAR(100),
   nomCanal VARCHAR(50),
   isAdmin VARCHAR(50),
   PRIMARY KEY(nomUser, nomCanal),
   FOREIGN KEY(nomUser) REFERENCES utilisateur(nomUser),
   FOREIGN KEY(nomCanal) REFERENCES canal(nomCanal)
);
