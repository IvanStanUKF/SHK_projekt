-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Út 06.Máj 2025, 11:03
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

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `admindata`
--

CREATE TABLE `admindata` (
  `id_admindata` int(11) NOT NULL,
  `admin_meno` varchar(30) NOT NULL,
  `admin_heslo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `admindata`
--

INSERT INTO `admindata` (`id_admindata`, `admin_meno`, `admin_heslo`) VALUES
(1, 'administrator', 'AdminHeslo30');

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
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `formdata`
--

INSERT INTO `formdata` (`id_formdata`, `meno`, `priezvisko`, `vek`, `telcislo`, `email`) VALUES
(1, 'Ivan', 'Skúša', 20, '0123456789', 'mail@mail.com'),
(8, 'Meno', 'Priezvisko', 20, '123456789', 'funguj@mail.com'),
(14, 'Meno', 'Priezvisko', 18, '9630852741', 'funguje.to@mail.com'),
(15, 'Skúška', 'Písmená', 19, '8646468968', 'nejaky@mail.com'),
(16, 'Ďaľšia', 'Skúška', 21, '4354433853', 'skusanie@mail.com'),
(17, 'Meno', 'Priezvisko', 22, '8674843864', 'asiuh@mail.com'),
(18, 'Meno', 'Priezvisko', 30, '4683846846', 'mp@mail.com');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `admindata`
--
ALTER TABLE `admindata`
  ADD PRIMARY KEY (`id_admindata`);

--
-- Indexy pre tabuľku `formdata`
--
ALTER TABLE `formdata`
  ADD PRIMARY KEY (`id_formdata`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `admindata`
--
ALTER TABLE `admindata`
  MODIFY `id_admindata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pre tabuľku `formdata`
--
ALTER TABLE `formdata`
  MODIFY `id_formdata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
