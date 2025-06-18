-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Št 19.Jún 2025, 01:42
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `databaza_shk_skuska`
--
CREATE DATABASE IF NOT EXISTS `databaza_shk_skuska` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovak_ci;
USE `databaza_shk_skuska`;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `admindata`
--

CREATE TABLE `admindata` (
  `id_admindata` int(11) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_heslo` varchar(100) NOT NULL,
  `admin_rola_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `admindata`
--

INSERT INTO `admindata` (`id_admindata`, `admin_email`, `admin_heslo`, `admin_rola_id`) VALUES
(1, 'administrator@shk.com', '$2y$10$9Y4YHllJ6ZJhGVbtlyLAbu98gXgRQWn5FzjZGlRhaH9kTflegGaaW', 1),
(2, 'admin@shk.com', '$2y$10$R1HeyUcMBjQow9XEtUs1TeZrN/ap2VHpote7YlXRtY8Z63CG9iMgu', 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `admindata_role`
--

CREATE TABLE `admindata_role` (
  `id_role` int(11) NOT NULL,
  `rola` varchar(20) NOT NULL,
  `zobrazenie` tinyint(1) NOT NULL,
  `upravenie` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `admindata_role`
--

INSERT INTO `admindata_role` (`id_role`, `rola`, `zobrazenie`, `upravenie`) VALUES
(1, 'superadmin', 1, 1),
(2, 'admin', 1, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `formdata`
--

CREATE TABLE `formdata` (
  `id_formdata` int(11) NOT NULL,
  `meno` varchar(20) NOT NULL,
  `priezvisko` varchar(25) NOT NULL,
  `vek` int(3) NOT NULL,
  `telcislo` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `stav_id` int(11) DEFAULT NULL,
  `typ_kurzu_id` int(11) NOT NULL,
  `kurz_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `formdata`
--

INSERT INTO `formdata` (`id_formdata`, `meno`, `priezvisko`, `vek`, `telcislo`, `email`, `stav_id`, `typ_kurzu_id`, `kurz_id`) VALUES
(1, 'Ivan', 'Skúša', 20, '0123456789', 'mail@mail.com', 4, 1, 1),
(8, 'Meno', 'Priezvisko', 20, '123456789', 'funguj@mail.com', 5, 4, 4),
(14, 'Meno', 'Priezvisko', 18, '9630852741', 'funguje.to@mail.com', 4, 2, 2),
(15, 'Skúška', 'Písmená', 19, '8646468968', 'nejaky@mail.com', 3, 3, 7),
(16, 'Ďaľšia', 'Skúška', 21, '4354433853', 'skusanie@mail.com', 3, 1, 5),
(17, 'Meno', 'Priezvisko', 22, '8674843864', 'asiuh@mail.com', NULL, 2, NULL),
(18, 'Meno', 'Priezvisko', 30, '4683846846', 'mp@mail.com', 2, 1, 9),
(19, 'Prvá', 'Optimalizácia', 21, '8434864684', 'optimalizacia1@shk.com', 2, 2, 10),
(20, 'Veľké', 'Finále', 18, '0000123456', 'velke.finale@mail.com', 1, 4, NULL),
(21, 'Ďalší', 'Prosím', 20, '0900987654', 'dalsi.prosim@mail.com', 1, 3, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `formdata_stav`
--

CREATE TABLE `formdata_stav` (
  `id_stav` int(11) NOT NULL,
  `stav` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `formdata_stav`
--

INSERT INTO `formdata_stav` (`id_stav`, `stav`) VALUES
(1, 'Zaregistrovaný'),
(2, 'Zaznamenaný'),
(3, 'Navštevuje kurz'),
(4, 'Ukončil úspešne'),
(5, 'Ukončil neúspešne');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `kurzy`
--

CREATE TABLE `kurzy` (
  `id_kurzy` int(11) NOT NULL,
  `kurz` varchar(30) NOT NULL,
  `zaciatok_datum` date NOT NULL,
  `koniec_datum` date DEFAULT NULL,
  `kapacita` int(11) NOT NULL,
  `typ_kurzu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `kurzy`
--

INSERT INTO `kurzy` (`id_kurzy`, `kurz`, `zaciatok_datum`, `koniec_datum`, `kapacita`, `typ_kurzu_id`) VALUES
(1, '04.04.2025 - 06.06.2025', '2025-04-04', '2025-06-06', 20, 1),
(2, '05.04.2025 - 07.06.2025', '2025-04-05', '2025-06-07', 20, 2),
(3, '05.04.2025 - 07.06.2025', '2025-04-05', '2025-06-07', 20, 3),
(4, '07.04.2025 - 09.06.2025', '2025-04-07', '2025-06-09', 20, 4),
(5, '13.06.2025 - 15.08.2025', '2025-06-13', '2025-08-15', 20, 1),
(6, '14.06.2025 - 16.08.2025', '2025-06-14', '2025-08-16', 20, 2),
(7, '14.06.2025 - 16.08.2025', '2025-06-14', '2025-08-16', 20, 3),
(8, '16.06.2025 - 18.08.2025', '2025-06-16', '2025-08-18', 20, 4),
(9, '22.08.2025 -', '2025-08-22', NULL, 20, 1),
(10, '23.08.2025 -', '2025-08-23', NULL, 20, 2),
(11, '23.08.2025 -', '2025-08-23', NULL, 20, 3),
(12, '25.08.2025 -', '2025-08-25', NULL, 20, 4);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `typy_kurzov`
--

CREATE TABLE `typy_kurzov` (
  `id_typy_kurzov` int(11) NOT NULL,
  `typ_kurzu` varchar(20) NOT NULL,
  `cas_zaciatku` time NOT NULL,
  `cas_konca` time NOT NULL,
  `den_tyzdna` varchar(10) NOT NULL,
  `aktualnost` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `typy_kurzov`
--

INSERT INTO `typy_kurzov` (`id_typy_kurzov`, `typ_kurzu`, `cas_zaciatku`, `cas_konca`, `den_tyzdna`, `aktualnost`) VALUES
(1, 'Piatok 18:00', '18:00:00', '20:00:00', 'piatok', 1),
(2, 'Sobota 10:00', '10:00:00', '12:00:00', 'sobota', 1),
(3, 'Sobota 14:00', '14:00:00', '16:00:00', 'sobota', 1),
(4, 'Pondelok 18:00', '18:00:00', '20:00:00', 'pondelok', 1);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `admindata`
--
ALTER TABLE `admindata`
  ADD PRIMARY KEY (`id_admindata`),
  ADD KEY `fk_admin_rola` (`admin_rola_id`);

--
-- Indexy pre tabuľku `admindata_role`
--
ALTER TABLE `admindata_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexy pre tabuľku `formdata`
--
ALTER TABLE `formdata`
  ADD PRIMARY KEY (`id_formdata`),
  ADD KEY `fk_formdata_stav` (`stav_id`),
  ADD KEY `fk_formdata_kurz` (`kurz_id`),
  ADD KEY `fk_formdata_typ_kurzu` (`typ_kurzu_id`) USING BTREE;

--
-- Indexy pre tabuľku `formdata_stav`
--
ALTER TABLE `formdata_stav`
  ADD PRIMARY KEY (`id_stav`);

--
-- Indexy pre tabuľku `kurzy`
--
ALTER TABLE `kurzy`
  ADD PRIMARY KEY (`id_kurzy`),
  ADD KEY `fk_kurzy_typ_kurzu` (`typ_kurzu_id`);

--
-- Indexy pre tabuľku `typy_kurzov`
--
ALTER TABLE `typy_kurzov`
  ADD PRIMARY KEY (`id_typy_kurzov`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `admindata`
--
ALTER TABLE `admindata`
  MODIFY `id_admindata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pre tabuľku `admindata_role`
--
ALTER TABLE `admindata_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pre tabuľku `formdata`
--
ALTER TABLE `formdata`
  MODIFY `id_formdata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pre tabuľku `formdata_stav`
--
ALTER TABLE `formdata_stav`
  MODIFY `id_stav` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `kurzy`
--
ALTER TABLE `kurzy`
  MODIFY `id_kurzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pre tabuľku `typy_kurzov`
--
ALTER TABLE `typy_kurzov`
  MODIFY `id_typy_kurzov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `admindata`
--
ALTER TABLE `admindata`
  ADD CONSTRAINT `fk_admin_rola` FOREIGN KEY (`admin_rola_id`) REFERENCES `admindata_role` (`id_role`) ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `formdata`
--
ALTER TABLE `formdata`
  ADD CONSTRAINT `fk_formdata_kurz` FOREIGN KEY (`kurz_id`) REFERENCES `kurzy` (`id_kurzy`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_formdata_stav` FOREIGN KEY (`stav_id`) REFERENCES `formdata_stav` (`id_stav`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_formdata_typ_kurzu` FOREIGN KEY (`typ_kurzu_id`) REFERENCES `typy_kurzov` (`id_typy_kurzov`) ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `kurzy`
--
ALTER TABLE `kurzy`
  ADD CONSTRAINT `fk_kurzy_typ_kurzu` FOREIGN KEY (`typ_kurzu_id`) REFERENCES `typy_kurzov` (`id_typy_kurzov`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
