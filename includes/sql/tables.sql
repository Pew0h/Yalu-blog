CREATE TABLE Role(
   id_role INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   nom VARCHAR(50) NOT NULL
);

CREATE TABLE Categorie(
   id_categorie INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   nom VARCHAR(50) NOT NULL
);

CREATE TABLE Menu(
   id_menu INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   nom VARCHAR(255) NOT NULL
);

CREATE TABLE Menu_items(
   id_menu_items INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   nom VARCHAR(255) NOT NULL,
   lien VARCHAR(255) NOT NULL,
   ordre INT NOT NULL,
   id_menu INT NOT NULL,
   FOREIGN KEY(id_menu) REFERENCES Menu(id_menu)
);

CREATE TABLE Utilisateur(
   id_utilisateur INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   pseudo VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL,
   mot_de_passe VARCHAR(255) NOT NULL,
   nom VARCHAR(255) NOT NULL,
   prenom VARCHAR(255) NOT NULL,
   date_inscription DATE NOT NULL,
   id_role INT NOT NULL,
   UNIQUE(pseudo),
   UNIQUE(email),
   FOREIGN KEY(id_role) REFERENCES Role(id_role)
);

CREATE TABLE Article(
   id_article INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   titre VARCHAR(255) NOT NULL,
   image VARCHAR(255) NOT NULL,
   contenu VARCHAR(255) NOT NULL,
   date_creation DATE NOT NULL,
   id_categorie INT NOT NULL,
   id_utilisateur INT NOT NULL,
   date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
   FOREIGN KEY(id_categorie) REFERENCES Categorie(id_categorie),
   FOREIGN KEY(id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

CREATE TABLE Commentaire(
   id_commentaire INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   commentaire VARCHAR(50),
   id_article INT NOT NULL,
   id_utilisateur INT NOT NULL,
   FOREIGN KEY(id_article) REFERENCES Article(id_article),
   FOREIGN KEY(id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

]
--
-- Structure de la table `role`
--

INSERT INTO `role` (`id_role`, `nom`) VALUES
(1, 'Administrateur'),
(2, 'Éditeur'),
(3, 'Abonné');
COMMIT;


