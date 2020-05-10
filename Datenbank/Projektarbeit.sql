-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2020 at 02:51 PM
-- Server version: 10.3.22-MariaDB-0ubuntu0.19.10.1
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Projektarbeit`
--

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE `entry` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_created` int(10) UNSIGNED DEFAULT NULL,
  `subjectID` int(10) UNSIGNED DEFAULT NULL,
  `userID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`id`, `text`, `time_created`, `subjectID`, `userID`) VALUES
(1, 'Übungen aus dem Buch „cambridge objective pet“ durchgegangen', 1565820000, 1, 1),
(2, 'Auflistung möglicher PC-Komponenten und Erklärung dieser in englischer Sprache. Briefverfassung auf Englisch.', 1565820000, 1, 1),
(3, 'Schreib und Hör-Übungen auf Englisch aus dem IT-Fachbereich. Textinterpretation auf Deutsch und Englisch in Wort und Schrift.', 1565906400, 1, 1),
(4, 'Weiterführung des Thema „Binärcodierung“.  Schriftliche Implementierung einer Digitaluhrschaltung. Fortführung des Thema Computerhardware: Schwerpunkt Motherboard, CPU und CPU-caches.', 1568628000, 2, 1),
(5, 'Satzbau im englischen und Praxisunterricht mit Übungen zum Satzbau im englischen.', 1563195600, 1, 1),
(6, 'Dokumentation zur Projektarbeit verfasst und noch bissi Styling betrieben.', 1589061600, 5, 1),
(7, 'Distributionswege: Direkter, indirekter und Mischvertrieb.', 1588197600, 6, 1),
(8, 'Fortführung der Policy und Nutzerrichtlinien-Administration.', 1588111200, 8, 1),
(9, 'Normalisierung in 2. Normalform. Einfaches Verfahren.', 1584918000, 9, 1),
(10, '3. Normalform und Transitive Abhängkeiten.', 1585004400, 9, 1),
(11, 'Schnittstellen/Interfaces als Anternative zu Mehrfachvererbung in Klassen.', 1588543200, 7, 1),
(12, 'Detaillierte Erklärung zu KV-Diagrammen.\r\nÜbungen zu Schaltkreisen und deren Aufbau in Wahrheitstabellen, KV-Diagrammen und disjunktiver Normalform.', 1567548000, 2, 1),
(13, 'Aufbau einer Verbindung zum MySQL-Server und Grundlagen der Datenbankabfragen mit PHP unter Verwendung der &quot;mysqli&quot;-Schnittstelle.', 1585519200, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `description`) VALUES
(1, 'Englisch', NULL),
(2, 'Elektrotechnik', NULL),
(5, 'EBAS-PHP', NULL),
(6, 'Markt &amp; Kundenbeziehung', NULL),
(7, 'EBAS-C#', NULL),
(8, 'BetITs', NULL),
(9, 'EBAS-SQL', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_created` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `time_created`) VALUES
(1, 'Alexander Petrasovics', 'test1234', 1588942040);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjectID` (`subjectID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entry`
--
ALTER TABLE `entry`
  ADD CONSTRAINT `entry_ibfk_1` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
