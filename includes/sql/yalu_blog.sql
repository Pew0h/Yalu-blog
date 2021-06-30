-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 30 juin 2021 à 18:44
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `yalu_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL,
  `contenu` longtext NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_article`),
  KEY `id_categorie` (`id_categorie`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `titre`, `image`, `contenu`, `id_categorie`, `id_utilisateur`, `date_creation`) VALUES
(1, 'J''ai vécu 40 jours dans un désert', 'Désert.jpeg', '<h4 class=\"ql-align-justify\">40 jours dans un désert.. Voici mon hisoire</h4><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dignissim pulvinar risus, id hendrerit velit placerat malesuada. Aenean dui mauris, iaculis id lectus eu, placerat bibendum eros. Sed consectetur, metus vitae pulvinar dapibus, sem felis malesuada sapien, id volutpat neque metus ac massa. Nullam nec pellentesque velit. Quisque tincidunt ornare ipsum vel bibendum. Donec ornare blandit consequat. Cras ac accumsan ex, id consectetur metus.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Donec lobortis dui at accumsan ultrices. Nam tempus ornare sapien, eget accumsan purus interdum vel. Duis auctor sagittis urna, in tincidunt sem ullamcorper vitae. Fusce sed justo nisl. Proin sagittis ultricies mi et feugiat. Suspendisse potenti. Ut non arcu metus. Nulla justo mi, imperdiet a placerat et, convallis in neque. Cras quis tortor pellentesque, pretium elit eu, iaculis elit. Pellentesque orci sem, vestibulum at eleifend ut, maximus at est.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer a congue sem, et iaculis ligula. Vivamus a nulla interdum, fermentum odio non, vulputate nunc. In eu imperdiet ex, et hendrerit ex. Nulla facilisis nisl sit amet urna ultrices, quis porttitor erat mattis. Duis dictum ligula est, at tincidunt magna viverra id. Sed pretium nec elit in venenatis. Fusce feugiat viverra lectus, vel vulputate lectus. Etiam vitae quam id massa faucibus euismod.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Aenean faucibus ante ornare lacus sodales sodales. Vestibulum in ligula pretium, finibus tortor a, euismod felis. Nullam finibus hendrerit velit. Nam tincidunt urna ac magna aliquet, vitae lacinia felis imperdiet. Proin vitae aliquet turpis. Maecenas viverra, odio at tempus finibus, massa diam pharetra velit, ac placerat elit ipsum at erat. Donec nec ligula justo.</p><p><br></p>', 3, 1, '2021-06-29 22:01:33'),
(2, 'Une virée dans la savane ! ', 'Savane.jpeg', '<h3 class=\"ql-align-justify\">Parton à la rencontre du roi des animaux !</h3><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dignissim pulvinar risus, id hendrerit velit placerat malesuada. Aenean dui mauris, iaculis id lectus eu, placerat bibendum eros. Sed consectetur, metus vitae pulvinar dapibus, sem felis malesuada sapien, id volutpat neque metus ac massa. Nullam nec pellentesque velit. Quisque tincidunt ornare ipsum vel bibendum. Donec ornare blandit consequat. Cras ac accumsan ex, id consectetur metus.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Donec lobortis dui at accumsan ultrices. Nam tempus ornare sapien, eget accumsan purus interdum vel. Duis auctor sagittis urna, in tincidunt sem ullamcorper vitae. Fusce sed justo nisl. Proin sagittis ultricies mi et feugiat. Suspendisse potenti. Ut non arcu metus. Nulla justo mi, imperdiet a placerat et, convallis in neque. Cras quis tortor pellentesque, pretium elit eu, iaculis elit. Pellentesque orci sem, vestibulum at eleifend ut, maximus at est.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer a congue sem, et iaculis ligula. Vivamus a nulla interdum, fermentum odio non, vulputate nunc. In eu imperdiet ex, et hendrerit ex. Nulla facilisis nisl sit amet urna ultrices, quis porttitor erat mattis. Duis dictum ligula est, at tincidunt magna viverra id. Sed pretium nec elit in venenatis. Fusce feugiat viverra lectus, vel vulputate lectus. Etiam vitae quam id massa faucibus euismod.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Aenean faucibus ante ornare lacus sodales sodales. Vestibulum in ligula pretium, finibus tortor a, euismod felis. Nullam finibus hendrerit velit. Nam tincidunt urna ac magna aliquet, vitae lacinia felis imperdiet. Proin vitae aliquet turpis. Maecenas viverra, odio at tempus finibus, massa diam pharetra velit, ac placerat elit ipsum at erat. Donec nec ligula justo.</p><p><br></p>', 3, 1, '2021-06-29 22:09:54'),
(3, 'Sous l''océan...', 'Ocean.jpeg', '<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dignissim pulvinar risus, id hendrerit velit placerat malesuada. Aenean dui mauris, iaculis id lectus eu, placerat bibendum eros. Sed consectetur, metus vitae pulvinar dapibus, sem felis malesuada sapien, id volutpat neque metus ac massa. Nullam nec pellentesque velit. Quisque tincidunt ornare ipsum vel bibendum. Donec ornare blandit consequat. Cras ac accumsan ex, id consectetur metus.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Donec lobortis dui at accumsan ultrices. Nam tempus ornare sapien, eget accumsan purus interdum vel. Duis auctor sagittis urna, in tincidunt sem ullamcorper vitae. Fusce sed justo nisl. Proin sagittis ultricies mi et feugiat. Suspendisse potenti. Ut non arcu metus. Nulla justo mi, imperdiet a placerat et, convallis in neque. Cras quis tortor pellentesque, pretium elit eu, iaculis elit. Pellentesque orci sem, vestibulum at eleifend ut, maximus at est.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer a congue sem, et iaculis ligula. Vivamus a nulla interdum, fermentum odio non, vulputate nunc. In eu imperdiet ex, et hendrerit ex. Nulla facilisis nisl sit amet urna ultrices, quis porttitor erat mattis. Duis dictum ligula est, at tincidunt magna viverra id. Sed pretium nec elit in venenatis. Fusce feugiat viverra lectus, vel vulputate lectus. Etiam vitae quam id massa faucibus euismod.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Aenean faucibus ante ornare lacus sodales sodales. Vestibulum in ligula pretium, finibus tortor a, euismod felis. Nullam finibus hendrerit velit. Nam tincidunt urna ac magna aliquet, vitae lacinia felis imperdiet. Proin vitae aliquet turpis. Maecenas viverra, odio at tempus finibus, massa diam pharetra velit, ac placerat elit ipsum at erat. Donec nec ligula justo.</p><p><br></p>', 3, 1, '2021-06-29 22:10:13'),
(4, 'Dans la jungle, terrible jungle ! ', 'Jungle.jpeg', '<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dignissim pulvinar risus, id hendrerit velit placerat malesuada. Aenean dui mauris, iaculis id lectus eu, placerat bibendum eros. Sed consectetur, metus vitae pulvinar dapibus, sem felis malesuada sapien, id volutpat neque metus ac massa. Nullam nec pellentesque velit. Quisque tincidunt ornare ipsum vel bibendum. Donec ornare blandit consequat. Cras ac accumsan ex, id consectetur metus.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Donec lobortis dui at accumsan ultrices. Nam tempus ornare sapien, eget accumsan purus interdum vel. Duis auctor sagittis urna, in tincidunt sem ullamcorper vitae. Fusce sed justo nisl. Proin sagittis ultricies mi et feugiat. Suspendisse potenti. Ut non arcu metus. Nulla justo mi, imperdiet a placerat et, convallis in neque. Cras quis tortor pellentesque, pretium elit eu, iaculis elit. Pellentesque orci sem, vestibulum at eleifend ut, maximus at est.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer a congue sem, et iaculis ligula. Vivamus a nulla interdum, fermentum odio non, vulputate nunc. In eu imperdiet ex, et hendrerit ex. Nulla facilisis nisl sit amet urna ultrices, quis porttitor erat mattis. Duis dictum ligula est, at tincidunt magna viverra id. Sed pretium nec elit in venenatis. Fusce feugiat viverra lectus, vel vulputate lectus. Etiam vitae quam id massa faucibus euismod.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Aenean faucibus ante ornare lacus sodales sodales. Vestibulum in ligula pretium, finibus tortor a, euismod felis. Nullam finibus hendrerit velit. Nam tincidunt urna ac magna aliquet, vitae lacinia felis imperdiet. Proin vitae aliquet turpis. Maecenas viverra, odio at tempus finibus, massa diam pharetra velit, ac placerat elit ipsum at erat. Donec nec ligula justo.</p><p><br></p>', 3, 1, '2021-06-29 22:10:53'),
(5, 'Les vacances à la plages ! ', 'Plage.jpeg', '<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dignissim pulvinar risus, id hendrerit velit placerat malesuada. Aenean dui mauris, iaculis id lectus eu, placerat bibendum eros. Sed consectetur, metus vitae pulvinar dapibus, sem felis malesuada sapien, id volutpat neque metus ac massa. Nullam nec pellentesque velit. Quisque tincidunt ornare ipsum vel bibendum. Donec ornare blandit consequat. Cras ac accumsan ex, id consectetur metus.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Donec lobortis dui at accumsan ultrices. Nam tempus ornare sapien, eget accumsan purus interdum vel. Duis auctor sagittis urna, in tincidunt sem ullamcorper vitae. Fusce sed justo nisl. Proin sagittis ultricies mi et feugiat. Suspendisse potenti. Ut non arcu metus. Nulla justo mi, imperdiet a placerat et, convallis in neque. Cras quis tortor pellentesque, pretium elit eu, iaculis elit. Pellentesque orci sem, vestibulum at eleifend ut, maximus at est.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer a congue sem, et iaculis ligula. Vivamus a nulla interdum, fermentum odio non, vulputate nunc. In eu imperdiet ex, et hendrerit ex. Nulla facilisis nisl sit amet urna ultrices, quis porttitor erat mattis. Duis dictum ligula est, at tincidunt magna viverra id. Sed pretium nec elit in venenatis. Fusce feugiat viverra lectus, vel vulputate lectus. Etiam vitae quam id massa faucibus euismod.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Aenean faucibus ante ornare lacus sodales sodales. Vestibulum in ligula pretium, finibus tortor a, euismod felis. Nullam finibus hendrerit velit. Nam tincidunt urna ac magna aliquet, vitae lacinia felis imperdiet. Proin vitae aliquet turpis. Maecenas viverra, odio at tempus finibus, massa diam pharetra velit, ac placerat elit ipsum at erat. Donec nec ligula justo.</p><p><br></p>', 3, 1, '2021-06-29 22:17:42'),
(6, '6 pieds sous terres.. ', 'Grottes.jpeg', '<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dignissim pulvinar risus, id hendrerit velit placerat malesuada. Aenean dui mauris, iaculis id lectus eu, placerat bibendum eros. Sed consectetur, metus vitae pulvinar dapibus, sem felis malesuada sapien, id volutpat neque metus ac massa. Nullam nec pellentesque velit. Quisque tincidunt ornare ipsum vel bibendum. Donec ornare blandit consequat. Cras ac accumsan ex, id consectetur metus.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Donec lobortis dui at accumsan ultrices. Nam tempus ornare sapien, eget accumsan purus interdum vel. Duis auctor sagittis urna, in tincidunt sem ullamcorper vitae. Fusce sed justo nisl. Proin sagittis ultricies mi et feugiat. Suspendisse potenti. Ut non arcu metus. Nulla justo mi, imperdiet a placerat et, convallis in neque. Cras quis tortor pellentesque, pretium elit eu, iaculis elit. Pellentesque orci sem, vestibulum at eleifend ut, maximus at est.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer a congue sem, et iaculis ligula. Vivamus a nulla interdum, fermentum odio non, vulputate nunc. In eu imperdiet ex, et hendrerit ex. Nulla facilisis nisl sit amet urna ultrices, quis porttitor erat mattis. Duis dictum ligula est, at tincidunt magna viverra id. Sed pretium nec elit in venenatis. Fusce feugiat viverra lectus, vel vulputate lectus. Etiam vitae quam id massa faucibus euismod.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Aenean faucibus ante ornare lacus sodales sodales. Vestibulum in ligula pretium, finibus tortor a, euismod felis. Nullam finibus hendrerit velit. Nam tincidunt urna ac magna aliquet, vitae lacinia felis imperdiet. Proin vitae aliquet turpis. Maecenas viverra, odio at tempus finibus, massa diam pharetra velit, ac placerat elit ipsum at erat. Donec nec ligula justo.</p><p><br></p>', 3, 1, '2021-06-29 22:18:47'),
(11, 'Daaaaaaamn les gens !', 'Musculation.jpeg', '<p><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.</span></p><p><br></p><p><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.</span></p><p><br></p><p><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.</span></p>', 5, 2, '2021-06-30 16:02:33'),
(12, 'Objectif : Grand Ecart ! ', 'Yoga2.jpeg', '<p><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.</span></p><p><br></p><p><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.</span></p><p><br></p><p><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.</span></p>', 5, 2, '2021-06-30 16:04:42'),
(13, 'Des astuces pour étudiants ! ', 'AstuceEtudiant.jpeg', '<p><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.</span></p><p><br></p><p><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.</span></p><p><br></p><p><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut hendrerit felis. Cras venenatis efficitur massa. Nulla tellus nulla, fringilla eget augue rhoncus, pretium facilisis lorem. Cras ornare lorem a tincidunt accumsan. Sed quis mauris blandit, volutpat risus ac, efficitur quam. Vestibulum molestie aliquam sollicitudin. Phasellus nec ligula eu odio efficitur tincidunt. In nec elementum tellus, non tincidunt enim. Duis gravida ornare enim, non fermentum augue accumsan eu.</span></p>', 5, 2, '2021-06-30 16:05:52');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom`) VALUES
(3, 'Monde'),
(5, 'Lyfestyle');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(100) DEFAULT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commentaire`),
  KEY `id_article` (`id_article`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `commentaire`, `id_article`, `id_utilisateur`, `date_creation`) VALUES
(1, 'Waaouh ! Incroyable !', 1, 2, '2021-06-30 00:00:00'),
(2, 'C''est Diiiiiingue ! ', 1, 2, '2021-06-30 00:00:00'),
(3, 'Il devait faire super chaud !', 1, 2, '2021-06-30 00:00:00'),
(4, 'Tu as rencontré Ariel ? ', 3, 2, '2021-06-30 00:00:00'),
(5, 'J''espère que tu as pu croiser Timon et Pumba ! ', 2, 2, '2021-06-30 00:00:00'),
(6, 'Bien sûr ! Même Scar ! ', 2, 2, '2021-06-30 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id_menu`, `nom`) VALUES
(4, 'Navbar'),
(7, 'Menu Été'),
(10, 'Désert');

-- --------------------------------------------------------

--
-- Structure de la table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id_menu_items` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `lien` varchar(255) NOT NULL,
  `ordre` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_menu_items`),
  KEY `id_menu` (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `menu_items`
--

INSERT INTO `menu_items` (`id_menu_items`, `nom`, `lien`, `ordre`, `id_menu`, `parent_id`) VALUES
(8, 'Categorie', 'cat', 1, 4, NULL),
(9, 'Monde', 'index.php?id=3', 1, 4, 8),
(10, 'Lyfestyle', 'index.php?id=5', 1, 4, 8),
(11, 'Article du jour', 'article.php?id=16', 1, 4, NULL),
(12, 'Musique', 'index.php?id=2', 1, 4, 8),
(13, 'Catégorie', 'index.php?id=2', 1, 7, NULL),
(14, 'Musique', 'index.php?id=2', 1, 7, 13),
(15, 'Lifestyle', 'index.php?id=5', 1, 7, 13),
(16, 'Monde', 'index.php?id=3', 1, 7, 13),
(17, 'Musique de l''été ! ', 'https://www.youtube.com/watch?v=81--kVsveqQ&t=150s', 1, 7, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `nom`) VALUES
(1, 'Administrateur'),
(2, 'Éditeur'),
(3, 'Abonné');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_inscription` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_role` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`),
  KEY `id_role` (`id_role`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `email`, `mot_de_passe`, `nom`, `prenom`, `date_inscription`, `id_role`) VALUES
(1, 'Yannou', 'yannbataillard@gmail.com', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', 'BATAILLARD', 'Yann', '2021-06-17 00:00:00', 2),
(2, 'Lulu', 'lucasburlot@gmail.com', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', 'BURLOT', 'Lucas', '2021-06-28 00:00:00', 1),
(4, 'BelleDel', 'delphinelacroix@gmail.com', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', 'LACROIX', 'Delphine', '2021-06-29 00:00:00', 3),
(5, 'Martinou', 'martinpaul@gmail.com', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', 'PAUL', 'Martin', '2021-06-30 00:00:00', 3),
(6, 'admin', 'admin@admin.com', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'Admin', 'Admin', '2021-06-30 00:00:00', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
