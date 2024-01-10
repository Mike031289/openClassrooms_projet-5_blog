-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 10 jan. 2024 à 11:24
-- Version du serveur : 5.7.36
-- Version de PHP : 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `monblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Science'),
(2, 'Travel'),
(3, 'Technology');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `authorName` text,
  `postId` int(11) NOT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `postId` (`postId`)
) ENGINE=MyISAM AUTO_INCREMENT=459 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `authorName`, `postId`, `createdAt`) VALUES
(317, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:01:27'),
(303, 'Ok Ã§a marche ', 'AGBE', 103, '2023-12-07 00:45:35'),
(302, 'Welcome man', 'AGBE', 103, '2023-12-07 00:45:09'),
(403, 'dddd', 'AGBE', 117, '2023-12-12 18:25:56'),
(404, 'xxxx', 'AGBE', 117, '2023-12-12 18:26:01'),
(405, 'fffff', 'AGBE', 117, '2023-12-12 18:26:11'),
(290, 'par finalitÃ© en cliquant sur â€œPersonnalise', 'AGBE', 103, '2023-12-04 22:59:44'),
(297, 'Welcome', 'AGBE', 104, '2023-12-06 21:41:24'),
(298, 'Welcome', 'AGBE', 104, '2023-12-06 21:41:56'),
(406, 'fffff', 'AGBE', 117, '2023-12-12 18:26:28'),
(278, 'd&#039;audience en lien avec cette publicitÃ© et dÃ©velopper et a', 'AGBE', 107, '2023-12-04 22:37:30'),
(299, 'Welcome', 'AGBE', 104, '2023-12-06 21:47:46'),
(300, 'Welcome man', 'AGBE', 103, '2023-12-07 00:43:28'),
(301, 'Welcome man', 'AGBE', 103, '2023-12-07 00:44:53'),
(381, 'Samething', 'AGBE', 111, '2023-12-12 14:21:51'),
(304, 'Ok Ã§a marche ', 'AGBE', 103, '2023-12-07 00:49:20'),
(305, 'Ok Ã§a marche ', 'AGBE', 103, '2023-12-07 00:49:58'),
(306, 'Ben vient demain', 'AGBE', 106, '2023-12-07 00:58:43'),
(307, 'Ben vient demain', 'AGBE', 106, '2023-12-07 00:59:11'),
(308, 'Ben vient demain', 'AGBE', 106, '2023-12-07 00:59:35'),
(309, 'Ben vient demain', 'AGBE', 106, '2023-12-07 00:59:46'),
(310, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:00:02'),
(311, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:00:13'),
(312, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:00:20'),
(313, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:00:30'),
(314, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:00:43'),
(315, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:00:56'),
(316, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:01:10'),
(318, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:01:42'),
(319, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:01:50'),
(320, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:01:58'),
(321, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:02:13'),
(322, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:02:48'),
(323, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:02:55'),
(324, 'Ben vient demain', 'AGBE', 106, '2023-12-07 01:03:05'),
(353, 'Test', 'AGBE', 108, '2023-12-08 00:14:01'),
(354, 'Test', 'AGBE', 108, '2023-12-08 00:14:34'),
(355, 'Test2', 'AGBE', 108, '2023-12-08 00:16:16'),
(356, 'Hello', 'AGBE', 100, '2023-12-08 02:33:35'),
(357, 'Test comme', 'AGBE', 95, '2023-12-12 13:36:08'),
(358, 'Test comme', 'AGBE', 115, '2023-12-12 13:44:21'),
(359, 'Test comme', 'AGBE', 115, '2023-12-12 13:44:39'),
(360, 'Test comme', 'AGBE', 115, '2023-12-12 13:44:56'),
(361, 'Hy', 'AGBE', 111, '2023-12-12 13:55:35'),
(362, 'Ok\r\n', 'AGBE', 111, '2023-12-12 13:56:32'),
(363, 'Ok\r\n', 'AGBE', 111, '2023-12-12 13:57:25'),
(364, 'Ok\r\n', 'AGBE', 111, '2023-12-12 13:57:37'),
(365, 'Ok\r\n', 'AGBE', 111, '2023-12-12 13:57:52'),
(366, 'Ok\r\n', 'AGBE', 111, '2023-12-12 13:59:04'),
(367, 'Yep', 'AGBE', 111, '2023-12-12 13:59:13'),
(368, 'Yep', 'AGBE', 111, '2023-12-12 13:59:59'),
(369, 'Yep', 'AGBE', 111, '2023-12-12 14:00:10'),
(370, 'Ã§a marche', 'AGBE', 111, '2023-12-12 14:00:24'),
(371, 'Ã§a marche', 'AGBE', 111, '2023-12-12 14:00:55'),
(372, 'Ã§a marche', 'AGBE', 111, '2023-12-12 14:03:50'),
(373, 'Ã§a marche', 'AGBE', 111, '2023-12-12 14:04:43'),
(374, 'Ã§a marche', 'AGBE', 111, '2023-12-12 14:05:37'),
(375, 'Ã§a marche', 'AGBE', 111, '2023-12-12 14:06:29'),
(376, 'Ok', 'AGBE', 111, '2023-12-12 14:10:30'),
(377, 'Ok', 'AGBE', 111, '2023-12-12 14:13:06'),
(378, 'Samething', 'AGBE', 111, '2023-12-12 14:15:51'),
(379, 'Samething', 'AGBE', 111, '2023-12-12 14:16:14'),
(380, 'Samething', 'AGBE', 111, '2023-12-12 14:16:24'),
(382, 'Hello\r\n', 'AGBE', 111, '2023-12-12 14:22:08'),
(383, 'Hello\r\n', 'AGBE', 111, '2023-12-12 14:22:20'),
(384, 'okok', 'AGBE', 111, '2023-12-12 14:22:55'),
(385, 'Popo', 'AGBE', 111, '2023-12-12 14:23:19'),
(386, 'AKAK', 'AGBE', 111, '2023-12-12 14:23:56'),
(387, 'mmm', 'AGBE', 111, '2023-12-12 14:24:32'),
(388, 'mpmp', 'AGBE', 111, '2023-12-12 14:24:54'),
(389, 'xxxxx', 'AGBE', 111, '2023-12-12 14:27:25'),
(390, 'TPTPTP', 'AGBE', 111, '2023-12-12 14:28:17'),
(426, 'sssssssffffff', 'AGBE', 117, '2023-12-12 20:23:14'),
(392, 'OKKKK', 'AGBE', 103, '2023-12-12 16:45:59'),
(393, 'OKKKK', 'AGBE', 103, '2023-12-12 16:46:32'),
(394, 'OUais', 'AGBE', 115, '2023-12-12 16:46:48'),
(395, 'OUais', 'AGBE', 115, '2023-12-12 16:47:02'),
(396, 'HELLO\r\n', 'AGBE', 117, '2023-12-12 16:47:47'),
(397, 'Welcome', 'AGBE', 117, '2023-12-12 16:47:59'),
(398, 'Hello', 'AGBE', 115, '2023-12-12 16:49:50'),
(399, 'Hello', 'AGBE', 115, '2023-12-12 16:55:24'),
(400, 'Yo', 'AGBE', 115, '2023-12-12 16:55:44'),
(402, 'dddd', 'AGBE', 117, '2023-12-12 18:23:41'),
(407, 'ddddd', 'AGBE', 115, '2023-12-12 18:26:55'),
(457, 'yep 30', 'AGBE', 124, '2023-12-30 13:05:50'),
(409, 'ddddd', 'AGBE', 115, '2023-12-12 18:28:38'),
(438, 'salut', 'Sandra', 119, '2023-12-20 00:03:25'),
(411, 'ppppp', 'AGBE', 115, '2023-12-12 18:30:07'),
(412, 'ppppp', 'AGBE', 115, '2023-12-12 18:31:42'),
(413, 'ppppp', 'AGBE', 115, '2023-12-12 18:32:07'),
(414, 'ppppp', 'AGBE', 115, '2023-12-12 18:32:36'),
(415, 'ppppp', 'AGBE', 115, '2023-12-12 18:32:46'),
(416, 'ppppp', 'AGBE', 115, '2023-12-12 18:33:06'),
(417, 'ppppp', 'AGBE', 115, '2023-12-12 18:33:21'),
(418, 'ppppp', 'AGBE', 115, '2023-12-12 18:33:34'),
(419, 'ppppp', 'AGBE', 115, '2023-12-12 18:33:52'),
(420, 'ppppp', 'AGBE', 115, '2023-12-12 18:35:40'),
(421, 'Hi', 'AGBE', 115, '2023-12-12 18:36:16'),
(422, 'Hi', 'AGBE', 115, '2023-12-12 20:14:30'),
(423, 'eeeee', 'AGBE', 117, '2023-12-12 20:21:00'),
(424, 'dddd', 'AGBE', 114, '2023-12-12 20:21:38'),
(425, 'ssss', 'AGBE', 111, '2023-12-12 20:21:53'),
(427, 'sssssssffffff', 'AGBE', 117, '2023-12-12 20:23:51'),
(428, 'sssssssffffff', 'AGBE', 117, '2023-12-12 20:24:08'),
(429, 'sssssssffffff', 'AGBE', 117, '2023-12-12 20:24:23'),
(430, 'dddd', 'AGBE', 102, '2023-12-12 20:24:57'),
(435, 'cool', 'AGBE', 119, '2023-12-19 23:58:55'),
(432, 'Test XSS', 'AGBE', 118, '2023-12-12 20:52:35'),
(433, 'Hello c\'est moi Sandra', 'Sandra', 118, '2023-12-12 21:01:04'),
(434, 'YEp', 'AGBE', 119, '2023-12-12 21:18:17'),
(439, 'Hello', 'AGBE', 120, '2023-12-21 21:38:13'),
(440, 'Ok', 'AGBE', 120, '2023-12-21 21:46:31'),
(442, 'Merci pour la lecture', 'AGBE', 120, '2023-12-22 18:23:59'),
(443, 'Test int ok', 'AGBE', 123, '2023-12-27 11:38:36'),
(444, 'Test int ok', 'AGBE', 123, '2023-12-27 11:40:40'),
(445, 'Test int ok', 'AGBE', 123, '2023-12-27 11:41:52'),
(446, 'Bien', 'AGBE', 123, '2023-12-27 11:42:02'),
(447, 'ok', 'AGBE', 122, '2023-12-27 11:43:45'),
(448, 'bien', 'AGBE', 122, '2023-12-27 11:44:08'),
(451, 'ok2', 'AGBE', 122, '2023-12-27 11:54:45'),
(452, 'Yep ', 'AGBE', 124, '2023-12-27 11:58:05'),
(454, 'FormHelper', 'AGBE', 124, '2023-12-27 21:39:58'),
(456, 'yep', 'AGBE', 124, '2023-12-28 22:03:18'),
(458, 'ok 30', 'AGBE', 122, '2023-12-30 13:06:08');

-- --------------------------------------------------------

--
-- Structure de la table `commentmoderator`
--

DROP TABLE IF EXISTS `commentmoderator`;
CREATE TABLE IF NOT EXISTS `commentmoderator` (
  `userId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL,
  PRIMARY KEY (`userId`,`commentId`),
  KEY `commentId` (`commentId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentmoderator`
--

INSERT INTO `commentmoderator` (`userId`, `commentId`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `createdAt`) VALUES
(1, 'Contact Person 1', 'contact1@example.com', 'Hello, I have a question...', '2023-07-27 19:07:13'),
(2, 'Contact Person 2', 'contact2@example.com', 'Hi, can you help me with...', '2023-07-27 19:07:13'),
(3, 'Contact Person 3', 'contact3@example.com', 'Greetings, I need assistance...', '2023-07-27 19:07:13'),
(4, 'AGBE', 'mike.agbelou@gmail.com', 'Pour leboncoin, votre expÃ©rience sur notre site est une prioritÃ©. C\'est pourquoi nous utilisons des cookies et autres traceurs pour vous fournir notre service, le personnaliser, en mesurerlâ€™audience et amÃ©liorer votre expÃ©rience.Sur la base de votre consentement des informations liÃ©es Ã  votre navigation sur notre site (telle que lâ€™IP, les pages visitÃ©es etc.) sont stockÃ©es et/ou lues sur votre terminal par leboncoin et ses partenaires, ces derniers pouvant Ã©galement traiter vos donnÃ©es personnelles sur la base de votre consentement ou de leur intÃ©rÃªt lÃ©gitime, auquel vous pouvez vous opposer en cliquant sur le bouton Â« Personnaliser Â», afin de diffuser des publicitÃ©s personnalisÃ©es, mesurer leurs performances, obtenir des donnÃ©es d\'audience en lien avec cette publicitÃ© et dÃ©velopper et amÃ©liorer les produits.', '2023-11-15 18:18:25'),
(21, 'Test2', 'asibat75@gmail.com', 'Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.', '2023-12-01 20:21:31'),
(20, 'Test1', 'mike.agbelou@gmail.com', 'Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.', '2023-12-01 20:21:18'),
(18, 'Sandra', 'mike.agbelou@gmail.com', 'Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.', '2023-12-01 20:20:47'),
(19, 'Test1', 'share-dev@groupe-lesbatisseurs.fr', 'Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.', '2023-12-01 20:21:10'),
(12, 'Test', 'mike.agbelou@gmail.com', 'Pour leboncoin, votre expÃ©rience sur notre site est une prioritÃ©. C\'est pourquoi nous utilisons des cookies et autres traceurs pour vous fournir notre service, le personnaliser, en mesurer lâ€™audience et amÃ©liorer votre expÃ©rience.\r\nSur la base de votre consentement des informations liÃ©es Ã  votre navigation sur notre site (telle que lâ€™IP, les pages visitÃ©es etc.) sont stockÃ©es et/ou lues sur votre terminal par leboncoin et ses partenaires, ces derniers pouvant Ã©galement traiter vos donnÃ©es personnelles sur la base de votre consentement ou de leur intÃ©rÃªt lÃ©gitime, auquel vous pouvez vous opposer en cliquant sur le bouton Â« Personnaliser Â», afin de diffuser des publicitÃ©s personnalisÃ©es, mesurer leurs performances, obtenir des donnÃ©es d\'audience en lien avec cette publicitÃ© et dÃ©velopper et amÃ©liorer les produits.', '2023-11-15 19:34:39'),
(9, 'AGBE2', 'mike.agbelou@gmail.com', 'Pour leboncoin, votre expÃ©rience sur notre site est une prioritÃ©. C\'est pourquoi nous utilisons des cookies et autres traceurs pour vous fournir notre service, le personnaliser, en mesurer lâ€™audience et amÃ©liorer votre expÃ©rience.\r\nSur la base de votre consentement des informations liÃ©es Ã  votre navigation sur notre site (telle que lâ€™IP, les pages visitÃ©es etc.) sont stockÃ©es et/ou lues sur votre terminal par leboncoin et ses partenaires, ces derniers pouvant Ã©galement traiter vos donnÃ©es personnelles sur la base de votre consentement ou de leur intÃ©rÃªt lÃ©gitime, auquel vous pouvez vous opposer en cliquant sur le bouton Â« Personnaliser Â», afin de diffuser des publicitÃ©s personnalisÃ©es, mesurer leurs performances, obtenir des donnÃ©es d\'audience en lien avec cette publicitÃ© et dÃ©velopper et amÃ©liorer les produits.', '2023-11-15 18:29:25'),
(42, 'Mike', 'mike.agbelou@gmail.com', '    /**\r\n     * Render a view.\r\n     *\r\n     * @param string $fileName    The name of the Twig template file.\r\n     * @param array  $viewContent An associative array of data to pass to the view.\r\n     */\r\n    protected function view(string $fileName, array $viewContent = []): void\r\n    {\r\n        ob_start();\r\n        extract($this->_param);\r\n        ob_get_clean();\r\n        echo $this->_twig->render($fileName, $viewContent);\r\n        exit ;\r\n    }', '2023-12-22 13:52:56'),
(17, 'Test2', 'test2@gmail.com', 'Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.Details on how to mark up your icons depending on how you&#039;re using them. Make your site icons usable by the most people, and start here.', '2023-12-01 20:20:28'),
(13, 'AGBE', 'mike.agbelou@gmail.com', 'dddddddd', '2023-11-15 19:56:41'),
(14, 'AGBE', 'mike.agbelou@gmail.com', 'dddddd', '2023-11-15 19:57:03'),
(15, 'AGBE', 'test@test.com', 'mmmmmmmmmmmccccccccccccccccghgggggggggggggggggggggggggggggggggggggggggggggg', '2023-11-29 08:32:18'),
(45, 'FormHelper', 'mike.agbelou@gmail.com', 'Test FormhelperTest FormhelperTest FormhelperTest FormhelperTest FormhelperTest FormhelperTest FormhelperTest FormhelperTest FormhelperTest FormhelperTest FormhelperTest FormhelperTest Formhelper', '2023-12-27 20:35:51'),
(43, '22Decembre', 'test@test.com', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit similique distinctio quidem blanditiis architecto ullam a itaque quisquam nihil! Unde ducimus deleniti exercitationem minima, molestiae ab saepe libero. Doloribus, a? Magnam amet labore exercitationem maxime consectetur molestias quas quia dicta, praesentium minus illum quis fuga, fugiat velit voluptate sed no', '2023-12-22 17:23:18'),
(44, 'Test Int', 'mike.agbelou@gmail.com', 'Updated About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards. Example Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed. Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.', '2023-12-27 10:38:15'),
(29, 'Test XSS', 'mike.agbelou@gmail.com', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit similique distinctio quidem blanditiis architecto ullam a itaque quisquam nihil! Unde ducimus deleniti exercitationem minima, molestiae ab saepe libero. Doloribus, a?\r\n\r\nMagnam amet labore exercitationem maxime consectetur molestias quas quia dicta, praesentium minus illum quis fuga, fugiat velit voluptate sed nostrum ipsam atque.\r\n', '2023-12-12 19:47:08'),
(28, 'Mike', 'mike.agbelou@gmail.com', 'Pour leboncoin, votre expÃ©rience sur notre site est une prioritÃ©. C&#039;est pourquoi nous utilisons des cookies et autres traceurs pour vous fournir notre service, le personnaliser, en mesurer lâ€™audience et amÃ©liorer votre expÃ©rience. Sur la base de votre consentement des informations liÃ©es Ã  votre navigation sur notre site (telle que lâ€™IP, les pages visitÃ©es etc.) sont stockÃ©es et/ou lues sur votre terminal par leboncoin et ses partenaires, ces derniers pouvant Ã©galement traiter vos donnÃ©es personnelles sur la base de votre consentement ou de leur intÃ©rÃªt lÃ©gitime, auquel vous pouvez vous opposer en cliquant sur le bouton Â« Personnaliser Â», afin de diffuser des publicitÃ©s personnalisÃ©es, mesurer leurs performances, obtenir des donnÃ©es d&#039;audience en lien avec cette publicitÃ© et dÃ©velopper et amÃ©liorer les produits.', '2023-12-12 19:38:06'),
(27, 'ABDEL', 'abdel@gmail.com', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit similique distinctio quidem blanditiis architecto ullam a itaque quisquam nihil! Unde ducimus deleniti exercitationem minima, molestiae ab saepe libero. Doloribus, a? Magnam amet labore exercitationem maxime consectetur molestias quas quia dicta, praesentium minus illum quis fuga, fugiat velit voluptate sed nostrum ipsam atque. Quaerat voluptas natus velit deleniti reprehenderit vero ad eos ab reiciendis. Libero dignissimos temporibus ipsam sint dolores voluptate consequatur debitis tempora doloremque. Creating Something New\r\n', '2023-12-12 19:31:36'),
(46, 'Test Hints', 'mike.agbelou@gmail.com', '<?php\r\n\r\ndeclare(strict_types=1);\r\n\r\nnamespace App\\Models;\r\n\r\n/**\r\n * Class Contact\r\n *\r\n * Represents a contact in your application.\r\n */\r\nclass Contact\r\n{\r\n    private int $id;\r\n\r\n    /**\r\n     * @var string|null The userName of the contact.\r\n     */\r\n    private string $userName;\r\n\r\n    /**\r\n     * @var string|null The user\'s email address.\r\n     */\r\n    private ?string $email;\r\n\r\n    /**\r\n     * @var string|null The contact message.\r\n     */\r\n    private string $message;\r\n\r\n    private string $createdAt;\r\n\r\n    /**\r\n     * Get the value of id.\r\n     *\r\n     * @return int The contact\'s ID.\r\n     */\r\n    public function getId(): int\r\n    {\r\n        return $this->id;\r\n    }\r\n\r\n    /**\r\n     * Set the value of id.\r\n     *\r\n     * @param int $id The contact\'s ID.\r\n     *\r\n     * @return self\r\n     */\r\n    public function setId(int $id): self\r\n    {\r\n        $this->id = $id;\r\n\r\n        return $this;\r\n    }\r\n\r\n    /**\r\n     * Get the userName of the contact.\r\n     *\r\n     * @return string The userName of the contact.\r\n     */\r\n    public function getUserName(): string\r\n    {\r\n        return $this->userName;\r\n    }\r\n\r\n    /**\r\n     * Set the userName of the contact.\r\n     *\r\n     * @param string $userName The userName of the contact.\r\n     *\r\n     * @return self\r\n     */\r\n    public function setUserName(string $userName): self\r\n    {\r\n        $this->userName = $userName;\r\n\r\n        return $this;\r\n    }\r\n\r\n    /**\r\n     * Get the user\'s email address.\r\n     *\r\n     * @return string|null The user\'s email address.\r\n     */\r\n    public function getEmail(): ?string\r\n    {\r\n        return $this->email;\r\n    }\r\n\r\n    /**\r\n     * Set the user\'s email address.\r\n     *\r\n     * @param string|null $email The user\'s email address.\r\n     *\r\n     * @return self\r\n     */\r\n    public function setEmail(?string $email): self\r\n    {\r\n        $this->email = $email;\r\n\r\n        return $this;\r\n    }\r\n\r\n    /**\r\n     * Get the value of message.\r\n     *\r\n     * @return string The contact message.\r\n     */\r\n    public function getMessage(): string\r\n    {\r\n        return $this->message;\r\n    }\r\n\r\n    /**\r\n     * Set the value of message.\r\n     *\r\n     * @param string $message The contact message.\r\n     *\r\n     * @return self\r\n     */\r\n    public function setMessage(string $message): self\r\n    {\r\n        $this->message = $message;\r\n\r\n        return $this;\r\n    }\r\n\r\n    /**\r\n     * Get the formatted value of createdAt.\r\n     *\r\n     * @return string The formatted creation date of the contact in the format \'d/m/Y H:i\'.\r\n     */\r\n    public function getCreatedAt(): string\r\n    {\r\n        $formattedDate = new \\DateTime($this->createdAt);\r\n\r\n        return $formattedDate->format(\'d/m/Y H:i\');\r\n    }\r\n\r\n    /**\r\n     * Set the value of createdAt.\r\n     *\r\n     * @param \\DateTime $createdAt The creation date of the contact.\r\n     *\r\n     * @return self\r\n     */\r\n    public function setCreatedAt(\\DateTime $createdAt): self\r\n    {\r\n        $this->createdAt = $createdAt->format(\'Y-m-d H:i:s\');\r\n\r\n        return $this;\r\n    }\r\n}\r\n', '2023-12-28 17:11:56');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text,
  `imageUrl` varchar(255) DEFAULT NULL,
  `categoryId` int(11) NOT NULL,
  `authorRole` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `postpreview` text,
  PRIMARY KEY (`id`),
  KEY `categoryId` (`categoryId`),
  KEY `authorId` (`authorRole`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `imageUrl`, `categoryId`, `authorRole`, `createdAt`, `updatedAt`, `postpreview`) VALUES
(111, 'Mise Ã  jour du post', 'Mise Ã  jour du post Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit similique distinctio quidem blanditiis architecto ullam a itaque quisquam nihil! Unde ducimus deleniti exercitationem minima, molestiae ab saepe libero. Doloribus, a?\r\n\r\nMagnam amet labore exercitationem maxime consectetur molestias quas quia dicta, praesentium minus illum quis fuga, fugiat velit voluptate sed nostrum ipsam atque.\r\n\r\nQuaerat voluptas natus velit deleniti reprehenderit vero ad eos ab reiciendis. Libero dignissimos temporibus ipsam sint dolores voluptate consequatur debitis tempora doloremque.\r\n\r\nCreating Something New\r\nLaborum placeat quas accusantium vitae perferendis dolores possimus tempora, qui consectetur hic ullam autem. Enim, rerum obcaecati numquam quaerat necessitatibus voluptatem? Repellat!\r\n\r\nQuasi, quos quaerat? Sint at odit possimus ullam saepe suscipit officiis nobis eaque, laudantium ut earum tempore repellendus mollitia odio nam! Unde?\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Nisi explicabo unde perferendis reprehenderit ullam nobis? Laborum amet voluptatem sunt natus? Tempore commodi corporis accusamus laudantium assumenda blanditiis aut nobis culpa.\r\n\r\nIt&#039;s time to build your new project\r\nFacilis enim voluptatibus qui voluptatum nemo non, facere, fugiat deserunt dicta ab sunt in sequi, assumenda nobis ipsam quidem corporis. Nemo, aliquam.\r\n\r\nIllum numquam sapiente debitis similique, a accusantium quisquam recusandae! Nihil quia nulla blanditiis. Nobis numquam iure facilis consequuntur beatae eos adipisci doloremque!\r\n\r\nVoluptate reiciendis nisi tempora laboriosam commodi sequi sapiente natus aut ab, cum aspernatur illo. Nobis laboriosam excepturi iste earum. Error, ab eius?\r\n\r\nQuam, nesciunt iusto, praesentium amet necessitatibus quod porro libero voluptates soluta nostrum quisquam delectus repellendus totam accusamus sint magni dolore atque qui.\r\n\r\n\r\nPhoto Credit: Unsplash\r\nIt&#039;s time to build your new project\r\nLaborum placeat quas accusantium vitae perferendis dolores possimus tempora, qui consectetur hic ullam autem. Enim, rerum obcaecati numquam quaerat necessitatibus voluptatem? Repellat!\r\n\r\nQuasi, quos quaerat? Sint at odit possimus ullam saepe suscipit officiis nobis eaque, laudantium ut earum tempore repellendus mollitia odio nam! Unde?\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Nisi explicabo unde perferendis reprehenderit ullam nobis? Laborum amet voluptatem sunt natus? Tempore commodi corporis accusamus laudantium assumenda blanditiis aut nobis culpa.\r\n\r\n', '6578bdc1dc612_post3.jpg', 2, 'Admin', '2023-12-07 21:52:24', '2023-12-12 21:08:33', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit similique distinctio quidem blanditiis architecto ullam a itaque quisquam nihil! Unde ducimus deleniti exercitationem minima, molestiae ab saepe libero. Doloribus, a?'),
(114, 'Pagination', 'About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards. Example Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed. Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.', '657276a44220e_post1.jpg', 1, 'Admin', '2023-12-08 02:51:32', '2023-12-08 02:51:32', 'About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar '),
(104, 'deuxiÃ¨me Modif test 27 Test3 ModifiÃ©', 'Bien modifiÃ© Pour leboncoin, votre expÃ©rience sur notre site est une prioritÃ©.\r\n\r\nC\'est pourquoi nous utilisons des cookies et autres traceurs pour vous fournir notre service, le personnaliser, en mesurer lâ€™audience et amÃ©liorer votre expÃ©rience.\r\n\r\nSur la base de votre consentement des informations liÃ©es Ã  votre navigation sur notre site (telle que lâ€™IP, les pages visitÃ©es etc.)\r\n![Mike img](http://localhost/mon-blog/public/assets/img/postImg/{{ latestPost.imageUrl }})sont stockÃ©es et/ou lues sur votre terminal par leboncoin et ses partenaires, ces derniers pouvant Ã©galement traiter vos donnÃ©es personnelles sur la base de votre consentement ou de leur intÃ©rÃªt lÃ©gitime, auquel vous pouvez vous opposer en cliquant sur le bouton Â« Personnaliser Â», afin de diffuser des publicitÃ©s personnalisÃ©es, mesurer leurs performances, obtenir des donnÃ©es d\'audience en lien avec cette publicitÃ© et dÃ©velopper et amÃ©liorer les produits.\r\nEn cliquant sur â€œAccepterâ€, vous consentez Ã  lâ€™utilisation de cookies pour lâ€™ensemble des finalitÃ©s ci-dessus. Vous pouvez Ã©galement configurer vos choix finalitÃ© par finalitÃ© en cliquant sur â€œPersonnaliserâ€ ou refuser en cliquant sur \"Continuer sans accepter\". Vous pouvez changer d\'avis Ã  tout moment en cliquant sur Â« Vie privÃ©e & cookies Â» figurant en bas de chaque page.', '658bfdea6eaba_mon-blog-descktop-mobile.jpg', 3, 'Admin', '2023-11-13 14:31:56', '2023-12-27 11:35:22', 'Test3 modifiÃ©'),
(103, 'Test3 modif 3', 'Modif 3 Pour leboncoin, votre expÃ©rience sur notre site est une prioritÃ©.\r\n\r\nC\'est pourquoi nous utilisons des cookies et autres traceurs pour vous fournir notre service, le personnaliser, en mesurer lâ€™audience et amÃ©liorer votre expÃ©rience.\r\nfffffffffffffffffffffffffffffff\r\nffffffffffffffffffffffffffffffffffff\r\nSur la base de votre consentement des informations liÃ©es Ã  votre navigation sur notre site (telle que lâ€™IP, les pages visitÃ©es etc.)\r\n![Mike img](http://localhost/mon-blog/public/assets/img/postImg/{{ latestPost.imageUrl }})sont stockÃ©es et/ou lues sur votre terminal par leboncoin et ses partenaires, ces derniers pouvant Ã©galement traiter vos donnÃ©es personnelles sur la base de votre consentement ou de leur intÃ©rÃªt lÃ©gitime, auquel vous pouvez vous opposer en cliquant sur le bouton Â« Personnaliser Â», afin de diffuser des publicitÃ©s personnalisÃ©es, mesurer leurs performances, obtenir des donnÃ©es d\'audience en lien avec cette publicitÃ© et dÃ©velopper et amÃ©liorer les produits.\r\nEn cliquant sur â€œAccepterâ€, vous consentez Ã  lâ€™utilisation de cookies pour lâ€™ensemble des finalitÃ©s ci-dessus. Vous pouvez Ã©galement configurer vos choix finalitÃ© par finalitÃ© en cliquant sur â€œPersonnaliserâ€ ou refuser en cliquant sur \"Continuer sans accepter\". Vous pouvez changer d\'avis Ã  tout moment en cliquant sur Â« Vie privÃ©e & cookies Â» figurant en bas de chaque page.', '6552587158803_post9.jpg', 3, 'Admin', '2023-11-13 14:31:09', '2023-11-13 17:10:09', 'Test3 modif 3'),
(101, 'Tester ', 'Celui ou About \r\nA card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards.\r\n\r\nExample \r\nCards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed.\r\n\r\nBelow is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.', '655291376a6f6_post16.jpg', 3, 'Admin', '2023-11-13 13:36:15', '2023-11-13 21:12:23', 'Tester c\'est se rassurer'),
(120, 'Test for image Upload', 'Updated About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards. Example Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed. Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.', '65849cf92e06f_post4.jpg', 2, 'Admin', '2023-12-21 21:15:53', '2023-12-21 21:15:53', 'Updated About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re'),
(99, 'BONNE Modif', 'Bien Modif 4 En cliquant sur â€œAccepterâ€, vous consentez Ã  lâ€™utilisation de cookies pour lâ€™ensemble des finalitÃ©s ci-dessus. Vous pouvez Ã©galement configurer vos \r\nchoix finalitÃ© par finalitÃ© en cliquant sur â€œPersonnaliserâ€ ou refuser en cliquant sur \"Continuer sans accepter\". \r\nVous pouvez changer d\'avis Ã  tout moment en cliquant sur Â« Vie privÃ©e & cookies Â» figurant en bas de chaque page.', '655258b6af33e_post20.jpg', 1, 'Admin', '2023-11-13 13:27:59', '2023-11-13 17:11:18', 'Bonne ou bonne mais bien modifiÃ©'),
(100, 'Comme test 2', 'personnaliser, en mesurer lâ€™audience et amÃ©liorer votre expÃ©rience.\r\nSur la base de votre consentement des informations liÃ©es Ã  votre navigation sur notre site (telle que lâ€™IP, les pages visitÃ©es etc.) \r\nsont stockÃ©es et/ou lues sur votre terminal par leboncoin et ses partenaires, ces derniers pouvant Ã©galement traiter vos donnÃ©es\r\n personnelles sur la base de votre consentement ou de leur intÃ©rÃªt lÃ©gitime, auquel vous pouvez vous opposer en cliquant sur le bouton \r\nÂ« Personnaliser Â», afin de diffuser des publicitÃ©s personnalisÃ©es, mesurer leurs performances, obtenir des donnÃ©es d\'audience en lien avec cette publicitÃ© et dÃ©velopper et amÃ©liorer les produits.', '655224be407d1_post17.jpg', 2, 'Admin', '2023-11-13 13:29:34', '2023-11-13 13:29:34', 'Test 2 comme lÃ  '),
(95, 'TEST AUTEUR ', 'En cliquant sur â€œAccepterâ€, vous consentez Ã  lâ€™utilisation de cookies pour lâ€™ensemble des finalitÃ©s ci-dessus. Vous pouvez Ã©galement configurer vos \r\nchoix finalitÃ© par finalitÃ© en cliquant sur â€œPersonnaliserâ€ ou refuser en cliquant sur \"Continuer sans accepter\". \r\nVous pouvez changer d\'avis Ã  tout moment en cliquant sur Â« Vie privÃ©e & cookies Â» figurant en bas de chaque page.', '655212ab66e21_post2.jpg', 1, 'Admin', '2023-11-13 12:12:27', '2023-11-13 12:12:27', 'TEST 1'),
(106, 'Mon testeur', 'About \r\nA card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards.\r\n\r\nExample \r\nCards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed.\r\n\r\nBelow is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.', '65529052da0be_post2.jpg', 1, 'Admin', '2023-11-13 21:08:34', '2023-11-13 21:08:34', 'A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content'),
(118, 'Test XSS', 'About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards. Example Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed. Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and', '6578b9e6e771e_post13.jpg', 1, 'Admin', '2023-12-12 20:52:06', '2023-12-12 20:52:06', 'Je reste joignable sur ces canneaux\r\nPour toutes collaboration, n\'hÃ©sitez pas Ã  m\'Ã©crire ou m\'appeler sur ma ligne directe'),
(117, 'New Post', 'About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards. Example Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed. Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards. Example Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed. Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards. Example Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed. Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.', '65787e6497aa0_post19.jpg', 2, 'Admin', '2023-12-12 16:38:12', '2023-12-12 16:38:12', 'About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors'),
(119, 'Test Update date', 'Updated About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards. Example Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed. Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.', '6578bffadd1c6_post20.jpg', 1, 'Admin', '2023-12-12 21:18:02', '2023-12-12 21:18:02', 'About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, an'),
(123, 'Test avec des int', 'Updated About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards. Example Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed. Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.Updated About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards. Example Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed. Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.', '658bfe768e4d3_myma-chocolat-descktop-mobile.jpg', 3, 'Admin', '2023-12-27 11:37:42', '2023-12-27 11:37:42', 'Updated About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™r'),
(122, 'DÃ©cembre Post', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit similique distinctio quidem blanditiis architecto ullam a itaque quisquam nihil! Unde ducimus deleniti exercitationem minima, molestiae ab saepe libero. Doloribus, a? Magnam amet labore exercitationem maxime consectetur molestias quas quia dicta, praesentium minus illum quis fuga, fugiat velit voluptate sed noLorem ipsum dolor sit amet consectetur, adipisicing elit. Odit similique distinctio quidem blanditiis architecto ullam a itaque quisquam nihil! Unde ducimus deleniti exercitationem minima, molestiae ab saepe libero. Doloribus, a? Magnam amet labore exercitationem maxime consectetur molestias quas quia dicta, praesentium minus illum quis fuga, fugiat velit voluptate sed noLorem ipsum dolor sit amet consectetur, adipisicing elit. Odit similique distinctio quidem blanditiis architecto ullam a itaque quisquam nihil! Unde ducimus deleniti exercitationem minima, molestiae ab saepe libero. Doloribus, a? Magnam amet labore exercitationem maxime consectetur molestias quas quia dicta, praesentium minus illum quis fuga, fugiat velit voluptate sed no', '6585cdaa12888_admin-dashboard-descktop-mobile.jpg', 2, 'Admin', '2023-12-22 18:55:54', '2023-12-22 18:55:54', 'DÃ©cembre Poste Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit similique distinctio quidem blanditiis architecto ullam a itaque quisquam nihil! Unde '),
(124, 'Ok test 27', 'Updated About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards. Example Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed. Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.\r\n\r\nUpdated About A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If youâ€™re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards. Example Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed. Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so theyâ€™ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.\r\n\r\n', '658c032dc29f7_Chalet-Caviar-desktop-mobile.jpg', 2, 'Admin', '2023-12-27 11:57:49', '2023-12-27 11:57:49', 'Welcome to SB UI Kit Pro, a toolkit for building beautiful web interfaces, created by the development team at Start Bootstrap');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `roleId` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(50) NOT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`roleId`, `roleName`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'Visitor');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passWord` varchar(255) NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `userName`, `email`, `passWord`, `createdAt`) VALUES
(68, 'Ram', 'ram@gmail.com', '$2y$10$8rci6ZKZcviTeqorpbQk7ODwavgH/DbdcQ3yFJIh5yNPsowEzHikK', '2023-10-04 13:07:19'),
(1, 'AGBE', 'agbe@gmail.com', '$2y$10$FqamrUmDTdGWjaPHYicsu.ZFtOSmP0tidTuzKgEcCbR8NSFzz/Pii', '2023-10-20 21:12:45'),
(78, 'Marc', 'marc@gmail.com', '$2y$10$pNPGw4jI86iPbtlnYGQDdeowQXG/xAC6XNQJ37VonYQV4PbzUe4oe', '2023-10-22 19:51:07'),
(79, 'Mike', 'mike.agbelou@gmail.com', '$2y$10$y6iQFbAZ3.0du5g0W3WF2ueDlWt7K2vlP2Cd7/noAgGKhR5CoAxRu', '2023-11-15 09:38:37'),
(80, 'Sandra', 'sandra@gmail.com', '$2y$10$HXpDsRhq8F3Tk4qAj48hWe9qlbJNBcEWprZ7gfSKAAsv/Y3h/g75y', '2023-12-12 18:56:13'),
(82, 'Izia', 'izi@gmail.com', '$2y$10$JHy6ghFlyP2S5yFa4KBiC.suhOWkr0iEKHOzevR3wFD/QHoXjmMRO', '2023-12-27 12:14:37'),
(83, 'Eude', 'eude@gmail.com', '$2y$10$c69clR4uLYicGftowLk5oO/pEOIVIacnmDTk/C3z5Ie7XW6f897oC', '2023-12-28 17:43:20');

-- --------------------------------------------------------

--
-- Structure de la table `userrole`
--

DROP TABLE IF EXISTS `userrole`;
CREATE TABLE IF NOT EXISTS `userrole` (
  `userId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  PRIMARY KEY (`userId`,`roleId`),
  KEY `roleId` (`roleId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `userrole`
--

INSERT INTO `userrole` (`userId`, `roleId`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 3),
(78, 3),
(79, 3),
(80, 3),
(81, 3),
(82, 3),
(83, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
