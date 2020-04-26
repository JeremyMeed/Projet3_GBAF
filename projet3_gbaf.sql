-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  Dim 26 avr. 2020 à 21:03
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet3_gbaf`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteurs`
--

CREATE TABLE `acteurs` (
  `id_acteur` int(11) NOT NULL,
  `acteur` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acteurs`
--

INSERT INTO `acteurs` (`id_acteur`, `acteur`, `description`, `logo`) VALUES
(1, 'Formation&co', 'Formation&co est une association française présente sur tout le territoire.\r\nNous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.<br/><br/>\r\nNotre proposition :<br/>\r\n\r\nun financement jusqu’à 30 000€ ;<br/>\r\nun suivi personnalisé et gratuit ;<br/>\r\nune lutte acharnée contre les freins sociétaux et les stéréotypes.<br/><br/>\r\n\r\nLe financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . <br/>\r\nNous collaborons avec des personnes talentueuses et motivées.<br/>\r\nVous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! \r\nNos financements s’adressent à tous.', 'img/formation_co.png'),
(2, 'Protectpeople', 'Protectpeople finance la solidarité nationale.\r\nNous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.<br/><br/>\r\n\r\nChez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.<br/>\r\nProectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.<br/>\r\nNous garantissons un accès aux soins et une retraite.<br/><br/>\r\nChaque année, nous collectons et répartissons 300 milliards d’euros.<br/><br/>\r\nNotre mission est double :<br/>\r\nsociale : nous garantissons la fiabilité des données sociales ;<br/>\r\néconomique : nous apportons une contribution aux activités économiques.', 'img/protectpeople.png'),
(3, 'DSA France', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.<br/>\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.<br/><br/>\r\nNotre philosophie : s’adapter à chaque entreprise.<br/><br/>\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises.', 'img/Dsa_france.png'),
(4, 'CDE', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation.\r\nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.', 'img/CDE.png');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `acteur_id` int(11) NOT NULL,
  `date_add` date NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id_comment`, `user_id`, `acteur_id`, `date_add`, `comment`) VALUES
(26, 2, 1, '2020-04-26', 'Commentaire test Formation&amp;co'),
(27, 2, 2, '2020-04-26', 'Commentaire test Protectpeople'),
(28, 2, 3, '2020-04-26', 'Commentaire test DSA'),
(29, 2, 4, '2020-04-26', 'Commentaire test CDE');

-- --------------------------------------------------------

--
-- Structure de la table `dislikes`
--

CREATE TABLE `dislikes` (
  `id_dislike` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `acteur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `acteur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `question_secrete` varchar(255) NOT NULL,
  `reponse_secrete` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom`, `prenom`, `username`, `password`, `question_secrete`, `reponse_secrete`) VALUES
(2, 'Medana', 'Jeremy', 'Jerem', '$2y$10$yXdmhRt/er0BB7srqtKTG.T/jhnRu06wNPCyudMIxsSd2QJQ.HzVC', 'choix1', 'Gilot');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acteurs`
--
ALTER TABLE `acteurs`
  ADD PRIMARY KEY (`id_acteur`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `comment_user` (`user_id`);

--
-- Index pour la table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id_dislike`),
  ADD KEY `dislike_acteur` (`acteur_id`),
  ADD KEY `dislike_user` (`user_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `like_acteur` (`acteur_id`),
  ADD KEY `like_user` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acteurs`
--
ALTER TABLE `acteurs`
  MODIFY `id_acteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id_dislike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
