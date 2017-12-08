-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 08 Décembre 2017 à 14:55
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `getmytest`
--

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE `tasks` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `creation_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tasks`
--

INSERT INTO `tasks` (`ID`, `user_id`, `title`, `description`, `creation_date`, `status`) VALUES
(1, 4, 'Ne pas chanter en public', 'Pour le bien de l\'humanitÃ© et la sauvegarde de la planÃ¨te.', '31/07/1992', 'Interdit'),
(2, 4, 'Jouer au Molkky avec Barack Obama', 'Inviter Barack au Mans pour une dÃ©gustation de rillettes et une partie de molkky.', '08/12/2017', 'Non rÃ©alisÃ©'),
(3, 4, 'Envoyer GetMyAPI', 'Test envoyÃ© Ã  Margaux & Lucie!.', '08/12/2017', 'RÃ©alisÃ©'),
(4, 2, 'Ressusciter', 'Essayer de ne pas passer la barre des 100 morts!', '13/08/1997', 'RÃ©alisÃ© 97 fois'),
(5, 2, 'Changer de blouson', 'Note: Essayer de prendre un blouson avec une capuche qui n\'empÃªche pas de parler.', '01/01/2018', 'Non rÃ©alisÃ©'),
(6, 2, 'Toucher son nez avec son coude', 'Eternel dÃ©fi....', '08/12/2017', 'Non rÃ©alisÃ©'),
(7, 1, 'Faire ses lacets', 'Au bout de 78 Ã©pisodes, il faudrait savoir faire ses lacets.', '11/01/1999', 'Non rÃ©alisÃ©'),
(8, 1, 'Apprendre Ã  compter', 'Plus que les lacets!', '05/05/2005', 'RÃ©alisÃ©'),
(9, 1, 'Jouer au beer pong', 'Pourquoi pas ?', '08/12/2017', 'Non rÃ©alisÃ©'),
(10, 3, 'Piquer un donut\' Ã  Homer', 'OpÃ©ration trÃ¨s risquÃ©e.', '08/12/2017', 'Non rÃ©alisÃ©');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`) VALUES
(1, 'Franklin', 'francky@tortue.fr'),
(2, 'Kenny', 'kenny@southpark.com'),
(3, 'Marge', 'marjorie@simpson.com'),
(4, 'CÃ©sar', 'cesar.gomez@orange.fr');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
