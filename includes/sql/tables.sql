CREATE TABLE Role(
   id_role INT,
   nom VARCHAR(50),
   PRIMARY KEY(id_role)
);

CREATE TABLE Categorie(
   id_categorie INT,
   nom VARCHAR(50),
   PRIMARY KEY(id_categorie)
);

CREATE TABLE Menu(
   id_menu INT,
   nom VARCHAR(255),
   PRIMARY KEY(id_menu)
);

CREATE TABLE Menu_items(
   id_menu_items INT,
   nom VARCHAR(255),
   lien VARCHAR(255),
   ordre INT,
   id_menu INT NOT NULL,
   PRIMARY KEY(id_menu_items),
   FOREIGN KEY(id_menu) REFERENCES Menu(id_menu)
);

CREATE TABLE Utilisateur(
   id_utilisateur INT,
   pseudo VARCHAR(255),
   email VARCHAR(255),
   mot_de_passe VARCHAR(255),
   nom VARCHAR(255),
   prenom VARCHAR(255),
   date_inscription DATE,
   id_role INT NOT NULL,
   PRIMARY KEY(id_utilisateur),
   UNIQUE(pseudo),
   UNIQUE(email),
   FOREIGN KEY(id_role) REFERENCES Role(id_role)
);

CREATE TABLE Article(
   id_article INT,
   titre VARCHAR(255),
   image VARCHAR(255),
   contenu VARCHAR(255),
   id_categorie INT NOT NULL,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_article),
   FOREIGN KEY(id_categorie) REFERENCES Categorie(id_categorie),
   FOREIGN KEY(id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

CREATE TABLE Commentaire(
   id_commentaire INT,
   commentaire VARCHAR(50),
   id_article INT NOT NULL,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_commentaire),
   FOREIGN KEY(id_article) REFERENCES Article(id_article),
   FOREIGN KEY(id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);
