-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Dim 18 fév. 2024 à 21:33
-- Version du serveur :  8.0.36-0ubuntu0.20.04.1
-- Version de PHP : 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `module7`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pseudo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `pseudo`, `date_creation`) VALUES
(3, 'marie.nana@gmail.com', '6b9418c1aeec9dbbfa2cd97d2d04961c', 'nana', '2024-02-17 13:50:43'),
(5, 'marie.dodo@gmail.com', '$2y$10$FhUV48LjIW/Ii.VHrLj6BOWiR6VfFz97mgmqCl71TR3sNJ0M5p3Ta', 'dodo', '2024-02-17 14:35:25'),
(6, 'marie.nono@gmail.com', '$2y$10$4PhvssUPlmN.d63sqtD.HOX/zNe0CRfrnbCenIuJMtQopXoVEUhAm', 'nono', '2024-02-18 10:48:52'),
(7, 'marie.lili@gmail.com', '$2y$10$wtbpeY2Gdp.KcMt79JfoyOSbR5X.FyUOHMlUWI7ptDjvXXLJjFlLq', 'lili', '2024-02-18 14:09:19'),
(8, 'marie.dada@gmail.com', '$2y$10$emEZj7YueOrvMrfHyw71aeZT5Exrg/GHFbH0/WN2302ucl0nJUVxS', 'dada', '2024-02-18 20:56:53');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `modele` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `en_vente` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `nom`, `modele`, `description`, `date_creation`, `image`, `en_vente`) VALUES
(1, 'Acura NSX 2016', 'Acura 2016 NSX Hybride Super sport 2016', 'Prix: 52490 $\r\nNombre de place 5\r\nMoteur V6 3.5L / 24 soup.\r\nPuissance 310 ch / 273 lb-pi\r\nConsommation 10.0 L/100km\r\n0-100 km/h 6.7 sec\r\nVitesse 210 km/h', '2024-02-06 00:00:00', 'https://www.autoneuve.ca/media/zoo/images/AcuraNSX-2017-01_0c4f4b40fdfb5a1af1958d10480f3c6e.jpg', 0),
(3, 'Alfa Romeo 4C Spider 2016', 'Catégorie 4C, 2016, Alfa Romeo, Roadster, Performance Année 2016', 'DDécouvrez la fiche technique automobiles détaillées du véhicule. Photos et images du design intérieur et extérieur de l’auto. Données, caractéristiques et du véhicule tel que le prix, dimensions de la voiture, spécification (specs) moteur, boite de vitesse, capacité de remorquage et garantie du fabricant. Statistiques (stats) et essais routiers, résultats de test du véhicule : consommation d’essence Litres aux 100km, performance, accélération 0-100km /h, vitesse maximale et la côte de sécurité IIHS.', '2024-02-18 08:59:36', 'https://www.autoneuve.ca/media/zoo/images/Alfa-Romeo-4C-Spyder-2016-2_68ecf7c8b2e1dfbcc554ffc64fbc1097.jpg', 1),
(6, 'Ferrari LaFerrari F70 2016', 'Catégorie 2016, F70, Hybride, Ferrari, Hyper sport', 'Découvrez la fiche technique automobiles détaillées du véhicule. Photos et images du design intérieur et extérieur de l’auto. Données, caractéristiques et du véhicule tel que le prix, dimensions de la voiture, spécification (specs) moteur, boite de vitesse, capacité de remorquage et garantie du fabricant. Statistiques (stats) et essais routiers, résultats de test du véhicule : consommation d’essence Litres aux 100km, performance, accélération 0-100km /h, vitesse maximale et la côte de sécurité IIHS.', '2024-02-18 16:36:29', 'https://www.autoneuve.ca/media/zoo/images/Ferrari-LaFerrari-2016-1_1a5fef9a6e3b2ebdcba69caac7b80016.jpg', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
