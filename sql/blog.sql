-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 02 mars 2022 à 15:04
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog_exercice`
--

-- --------------------------------------------------------

--
-- Structure de la table `blog_articles`
--

CREATE TABLE `blog_articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `blog_articles`
--

INSERT INTO `blog_articles` (`id`, `title`, `content`, `user_id`, `created_at`, `modified_at`, `status`, `image`) VALUES
(3, 'I\'m baby enamel', 'I\'m baby enamel pin microdosing skateboard photo booth meggings gastropub cardigan try-hard, hella selfies forage. Yuccie actually keytar hammock, celiac seitan normcore hot chicken +1 adaptogen disrupt tumeric tote bag jean shorts taxidermy. Man bun vegan marfa fam keytar, DIY intelligentsia. Chicharrones iPhone occupy freegan. Four loko hashtag semiotics ennui everyday carry master cleanse venmo, green juice ethical migas tumeric lumbersexual paleo jianbing taiyaki.', 1, '2022-03-02 14:19:27', '2022-03-02 14:19:27', 'draft', NULL),
(4, 'VHS godard coloring book', 'VHS godard coloring book sustainable. Snackwave blue bottle paleo freegan neutra intelligentsia normcore whatever pitchfork hell of vape put a bird on it. Kombucha shoreditch shaman mustache hella squid semiotics iPhone man braid knausgaard brunch dreamcatcher. Knausgaard wayfarers snackwave, food truck enamel pin deep v lomo selfies fanny pack keffiyeh. Next level subway tile kale chips pop-up whatever prism vexillologist tattooed. Church-key trust fund ethical microdosing XOXO brooklyn semiotics etsy selvage schlitz pickled.', 1, '2022-03-02 14:19:27', '2022-03-02 14:19:27', 'publish', NULL),
(5, 'Direct trade church-key', 'Direct trade church-key sustainable authentic franzen taiyaki. Vaporware sartorial blog put a bird on it umami tofu succulents chia pabst swag direct trade poke hashtag disrupt snackwave. Farm-to-table portland beard vape, chambray offal cloud bread shabby chic cronut. Williamsburg sriracha flannel, portland brunch palo santo fashion axe tbh la croix PBR&B kale chips beard everyday carry. Roof party DIY beard flannel, polaroid normcore synth whatever swag cloud bread put a bird on it chambray cliche deep v. Chia 90\'s shaman, meditation enamel pin four loko flannel. Quinoa letterpress dreamcatcher flexitarian hexagon.', 1, '2022-03-02 14:28:59', '2022-03-02 14:28:59', 'draft', NULL),
(6, 'Tumeric', 'Tumeric next level tattooed, put a bird on it migas pop-up ennui everyday carry crucifix. Literally plaid hammock venmo activated charcoal. Wolf skateboard kinfolk, whatever jianbing helvetica sustainable gastropub edison bulb live-edge poke. Pok pok hella shabby chic bespoke locavore street art tattooed blog scenester heirloom tumeric quinoa four dollar toast raclette tacos.', 1, '2022-03-02 14:28:59', '2022-03-02 14:28:59', 'publish', NULL),
(7, 'Jianbing celiac', 'Jianbing celiac PBR&B crucifix microdosing franzen mumblecore health goth. Ethical retro VHS, pitchfork af mustache austin man bun deep v godard tumeric. Vape cray kale chips keffiyeh. Tilde glossier hella, small batch synth migas plaid bespoke tacos green juice tumeric.', 1, '2022-03-02 14:31:08', '2022-03-02 14:31:08', 'draft', NULL),
(8, 'Bicycle', 'Bicycle rights small batch fam pug ethical. Forage knausgaard pok pok literally hashtag franzen authentic XOXO glossier health goth tofu butcher brunch chicharrones. Chartreuse lomo roof party seitan artisan bicycle rights hot chicken small batch normcore direct trade tattooed everyday carry hella. Vaporware mlkshk DIY intelligentsia banjo blue bottle.', 1, '2022-03-02 14:31:08', '2022-03-02 14:31:08', 'publish', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `blog_users`
--

CREATE TABLE `blog_users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `role` varchar(20) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `blog_users`
--

INSERT INTO `blog_users` (`id`, `pseudo`, `email`, `password`, `created_at`, `role`, `token`) VALUES
(1, 'user1', 'user1@blog.fr', 'test', '2022-03-02 10:58:26', 'abonné', ''),
(2, 'Orianne', 'orianne.cielat@gmail.com', '$2y$10$N/SPZPMZ5xoZwHUfxa8LrOpOrlIWw/ybDW78yi9/iYdkgezD0RvOu', '2022-03-02 11:39:58', 'Abonné', 'eEVUo56wnF4ELMDWKA4zz9zcgpPGZlkV8aTrH0XxjQJ6aTXrjyKh1jYj4epK4Rn8QgO9eV'),
(3, 'Admin', 'admin@admin.com', '$2y$10$UgTNNNAikGzv/Q45wLpix.g7HhfIw.YbvJkdErKIvCEzmIo9hMp42', '2022-03-02 11:40:37', 'admin', 'aJ8pCb46MCl4diWZFgS4lfo9oSwFAFWnpHRqHO2pGjRCONQrZ1PQliJ5gnhuUigIqaf0z1'),
(4, 'Oria', 'oria.cielat@gmail.com', '$2y$10$0ugmjEoBrvo3Zb8tJ8PxSOfCSg7ronqQW.Wbe8lzqUGUx9L99j/3e', '2022-03-02 11:41:24', 'Abonné', 'aLO7e7WxnxwAzwNhgYgkWLMxuNR6dzWO7BMBmX4GyMxYX2hfNAnzVN7vfOV2r7TbFBuKv4'),
(5, 'test1', 'test1@test.fr', '$2y$10$rwl1/pYEwvFGfEqttwHZhe2I6afDF9Ww95IT1GdKvbUM6kUxuFXf2', '2022-03-02 11:47:27', 'Abonné', 'zRR6YdAP6YHvwzGFzTgXgAQx8YtRxT4LfwHDqqpvRxjrzA0S7xfnFymMJImlIoJAChfvvV');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `blog_articles`
--
ALTER TABLE `blog_articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `blog_users`
--
ALTER TABLE `blog_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `blog_articles`
--
ALTER TABLE `blog_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `blog_users`
--
ALTER TABLE `blog_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */