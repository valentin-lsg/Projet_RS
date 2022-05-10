-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2022 at 11:39 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animes_listes`
--

-- --------------------------------------------------------

--
-- Table structure for table `animes`
--

CREATE Database if not exists animes_listes;

USE Database animes_listes;

CREATE TABLE `animes` (
  `id` int(11) NOT NULL,
  `nom_animes` varchar(60) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `nmbr_episodes` smallint(6) NOT NULL,
  `année` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `animes`
--

INSERT INTO `animes` (`id`, `nom_animes`, `categorie`, `nmbr_episodes`, `année`) VALUES
(1, '91 Day', 'Seinen', 13, 2016),
(2, 'Ajin', 'Seinen', 13, 2015),
(3, 'Akame ga kill', 'Shonen', 25, 2014),
(4, 'Rokudenashi Majutsu Koushi to Akashic Records', 'Shonen', 12, 2017),
(5, 'Alderamin on the Sky', 'Shonen', 13, 2016),
(6, 'Eyeshield 21', 'Shonen', 145, 2005),
(7, 'Blue Spring Ride', 'Shojo', 13, 2011),
(8, 'Another', 'Seinen', 24, 2012),
(9, 'Shingeki no Kyojin', 'Shonen', 40, 2013),
(10, 'One Piece', 'Shonen', 1004, 1999),
(11, 'Great Teacher Onizuka', 'Seinen', 46, 1999),
(12, 'Owari no seraph', 'Shonen', 24, 2015),
(13, 'The Strongest', 'Shonen', 12, 2022);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animes`
--
ALTER TABLE `animes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animes`
--
ALTER TABLE `animes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
