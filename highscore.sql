-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 14. Jun 2023 um 19:45
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `highscore`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_user`
--

CREATE TABLE `tbl_user` (
  `IDUser` int(10) UNSIGNED NOT NULL,
  `Vorname` varchar(64) NOT NULL,
  `Nachname` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Passwort` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_user`
--

INSERT INTO `tbl_user` (`IDUser`, `Vorname`, `Nachname`, `Email`, `Passwort`) VALUES
(1, 'Max', 'Mustermann', 'max.mustermann@test.at', '$2y$10$DJEV7mFxC/r2gFzy63CZoeBuJXN8Vhkcyv0/eC3fufXRmfqoTRXm.'),
(2, 'Susi', 'Musterfrau', 'susi.musterfrau@test.at', '$2y$10$DJEV7mFxC/r2gFzy63CZoeBuJXN8Vhkcyv0/eC3fufXRmfqoTRXm.'),
(3, 'Jane', 'Doe', 'jane@doe.com', '$2y$10$DJEV7mFxC/r2gFzy63CZoeBuJXN8Vhkcyv0/eC3fufXRmfqoTRXm.');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`IDUser`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `IDUser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
