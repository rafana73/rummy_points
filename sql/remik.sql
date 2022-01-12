-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 12 Sty 2022, 17:22
-- Wersja serwera: 10.3.29-MariaDB-0+deb10u1
-- Wersja PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `remik`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gracze`
--

CREATE TABLE `gracze` (
  `id_gracza` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `data` date NOT NULL,
  `id_rozgrywka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rozgrywka`
--

CREATE TABLE `rozgrywka` (
  `id` int(11) NOT NULL,
  `id_gracza` int(11) NOT NULL,
  `id_rozgrywka` int(11) NOT NULL,
  `punkty` int(11) NOT NULL,
  `czas` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `gracze`
--
ALTER TABLE `gracze`
  ADD PRIMARY KEY (`id_gracza`);

--
-- Indeksy dla tabeli `rozgrywka`
--
ALTER TABLE `rozgrywka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gracza` (`id_gracza`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `gracze`
--
ALTER TABLE `gracze`
  MODIFY `id_gracza` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `rozgrywka`
--
ALTER TABLE `rozgrywka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
