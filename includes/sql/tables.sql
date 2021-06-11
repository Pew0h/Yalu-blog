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
   parent_id INT NULL,
   FOREIGN KEY(id_menu) REFERENCES Menu(id_menu)
);

CREATE TABLE Utilisateur(
   id_utilisateur INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   pseudo VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL,
   mot_de_passe VARCHAR(255) NOT NULL,
   nom VARCHAR(255) NOT NULL,
   prenom VARCHAR(255) NOT NULL,
   date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
   id_role INT NOT NULL,
   UNIQUE(pseudo),
   UNIQUE(email),
   FOREIGN KEY(id_role) REFERENCES Role(id_role)
);

CREATE TABLE Article(
   id_article INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   titre VARCHAR(255) NOT NULL,
   image VARCHAR(255) NOT NULL,
   contenu LONGTEXT NOT NULL,
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
   date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
   FOREIGN KEY(id_article) REFERENCES Article(id_article),
   FOREIGN KEY(id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

--
-- Structure de la table `role`
--

INSERT INTO `role` (`id_role`, `nom`) VALUES
(1, 'Administrateur'),
(2, 'Éditeur'),
(3, 'Abonné');
COMMIT;

INSERT INTO `Categorie` (`id_categorie`, `nom`) VALUES
(1, 'Lifestyle'),
(2, 'Dancefloor'),
(3, 'Monde');
COMMIT;

INSERT INTO `Menu` (`id_menu`, `nom`) VALUES
(1, 'navbar');
COMMIT;

INSERT INTO `menu_items` (`id_menu_items`, `nom`, `lien`, `ordre`, `id_menu`, `parent_id`) VALUES
(1, 'Lifestyle', '#', 1, 1, NULL),
(2, 'Mode', '#', 2, 1, NULL),
(3, 'Catégorie', '#', 3, 1, NULL),
(4, 'Catégorie 1', '#', 1, 1, 3),
(5, 'Catégorie 2', '#', 1, 1, 3);
COMMIT;



