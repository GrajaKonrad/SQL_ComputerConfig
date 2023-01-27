-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Sty 2023, 01:10
-- Wersja serwera: 10.4.6-MariaDB
-- Wersja PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt_sql`
--

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Dodajchlodzeniecpu` (`idchlodzenia` INT(11), `idkonfiguracji` INT(11))  BEGIN
	UPDATE konfiguracje
	SET ChlodzenieCPU=idChlodzenia
	WHERE id=idkonfiguracji;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Dodajdyski` (IN `idDYS` INT(11), IN `idKONFIG` INT(11))  BEGIN
    INSERT INTO dyskikonfiguracji (konfiguracja, dysk)
    VALUES (idKONFIG, idDYS);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Dodajkartydzwiekowe` (`idkarty` INT(11), `idkonfiguracji` INT(11))  BEGIN
	UPDATE konfiguracje
	SET kartadzwiekowa=idkarty
	WHERE id=idkonfiguracji;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Dodajkartygraficzne` (`idkarty` INT(11), `idkonfiguracji` INT(11))  BEGIN
	UPDATE konfiguracje
	SET kartagraficzna=idkarty
	WHERE id=idkonfiguracji;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Dodajkartysieciowe` (`idkarty` INT(11), `idkonfiguracji` INT(11))  BEGIN
	UPDATE konfiguracje
	SET kartasieciowa=idkarty
	WHERE id=idkonfiguracji;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Dodajobudowa` (`idobudowy` INT(11), `idkonfiguracji` INT(11))  BEGIN
	UPDATE konfiguracje
	SET obudowa=idobudowy
	WHERE id=idkonfiguracji;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Dodajpamiecram` (`idRAM` INT(11), `idkonfiguracji` INT(11))  BEGIN
	INSERT INTO pamiecramkonfiguracji
	VALUES (idkonfiguracji,idRAM);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Dodajplytyglowne` (`idplyty` INT(11), `idkonfiguracji` INT(11))  BEGIN
	UPDATE konfiguracje
	SET plytaglowna=idplyty
	WHERE id=idkonfiguracji;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Dodajprocesory` (`idprocesora` INT(11), `idkonfiguracji` INT(11))  BEGIN
	UPDATE konfiguracje
	SET procesor=idprocesora
	WHERE id=idkonfiguracji;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Dodajzasilacze` (`idzasilacza` INT(11), `idkonfiguracji` INT(11))  BEGIN
	UPDATE konfiguracje
	SET Zasilacz=idzasilacza
	WHERE id=idkonfiguracji;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `chlodzeniecpu`
--

CREATE TABLE `chlodzeniecpu` (
  `Id` int(11) NOT NULL,
  `Producent` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Model` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Typ` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `IloscWentylatorow` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `chlodzeniecpu`
--

INSERT INTO `chlodzeniecpu` (`Id`, `Producent`, `Model`, `Typ`, `IloscWentylatorow`) VALUES
(1, 'SilentiumPC', 'Fortis 5 ARGB 140mm', 'Aktywne', 1),
(2, 'Cooler Master', 'MasterLiquid ML240L V2 RGB 2x120mm', 'Wodne', 2),
(3, 'ENDORFY', 'Navis F360 3x120mm', 'Wodne', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `chlodzeniecpukompatybilnosc`
--

CREATE TABLE `chlodzeniecpukompatybilnosc` (
  `ChlodzenieCPU` int(11) NOT NULL,
  `Socket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dyski`
--

CREATE TABLE `dyski` (
  `Id` int(11) NOT NULL,
  `Producent` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Model` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Typ` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `Zlacze` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `Pojemnosc` int(11) DEFAULT NULL,
  `PredkoscZapisu` float DEFAULT NULL,
  `PredkoscOdczytu` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `dyski`
--

INSERT INTO `dyski` (`Id`, `Producent`, `Model`, `Typ`, `Zlacze`, `Pojemnosc`, `PredkoscZapisu`, `PredkoscOdczytu`) VALUES
(1, 'KIOXIA', '1TB M.2 PCIe NVMe EXCERIA G2', 'SSD', 'M.2', 1000, 1700, 2100),
(2, 'GOODRAM', '512GB 2,5\" SATA SSD CX400', 'SSD', '2,5\" SATA', 512, 500, 550),
(3, 'Lexar', '1TB M.2 PCIe NVMe NM620', 'SSD', 'M.2', 1000, 3000, 3300);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dyskikonfiguracji`
--

CREATE TABLE `dyskikonfiguracji` (
  `Konfiguracja` int(11) NOT NULL,
  `Dysk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `dyskikonfiguracji`
--

INSERT INTO `dyskikonfiguracji` (`Konfiguracja`, `Dysk`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kartydzwiekowe`
--

CREATE TABLE `kartydzwiekowe` (
  `Id` int(11) NOT NULL,
  `Producent` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Model` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `CzestotliwoscProbkowania` int(11) DEFAULT NULL,
  `RozmiarPCI` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kartydzwiekowe`
--

INSERT INTO `kartydzwiekowe` (`Id`, `Producent`, `Model`, `CzestotliwoscProbkowania`, `RozmiarPCI`) VALUES
(1, 'Creative', 'Sound Blaster Audigy FX', 24, 'PCI-E'),
(2, 'ASUS', 'Xonar AE', 24, 'PCI-E'),
(3, 'Creative', 'Sound Blaster X AE-5 Plus', 32, 'PCI-E');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kartygraficzne`
--

CREATE TABLE `kartygraficzne` (
  `Id` int(11) NOT NULL,
  `Producent` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Model` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Seria` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `TaktowanieRdzenia` float DEFAULT NULL,
  `TypPamieci` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `WielkoscPamieci` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kartygraficzne`
--

INSERT INTO `kartygraficzne` (`Id`, `Producent`, `Model`, `Seria`, `TaktowanieRdzenia`, `TypPamieci`, `WielkoscPamieci`) VALUES
(1, 'Sapphire', 'Radeon RX 6600', 'Radeon RX 6000', 2491, 'GDDR6', 8),
(2, 'KFA2', 'GeForce RTX 3060 Ti', 'GeForce RTX z serii 30', 1665, 'GDDR6X', 8),
(3, 'Gigabyte', 'GeForce RTX 4070 Ti', 'GeForce RTX z serii 40', 2640, 'GDDR6X', 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kartysieciowe`
--

CREATE TABLE `kartysieciowe` (
  `Id` int(11) NOT NULL,
  `Producent` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Model` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `ProtokolyWiFi` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `MaksPredkosc` float DEFAULT NULL,
  `RozmiarPCI` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kartysieciowe`
--

INSERT INTO `kartysieciowe` (`Id`, `Producent`, `Model`, `ProtokolyWiFi`, `MaksPredkosc`, `RozmiarPCI`) VALUES
(1, 'ASUS', 'PCE-AX3000 BT 5.0', 'Wi-Fi 6 (802.11 a/b/g/n/ac/ax)', 3000, 'PCI-E'),
(2, 'TP-Link', 'Archer T5E BT 4.2', 'Wi-Fi 5 (802.11 a/b/g/n/ac)', 1200, 'PCI-E'),
(3, 'Tenda', 'Tenda E12', 'Wi-Fi 5 (802.11 a/b/g/n/ac)', 867, 'PCI-E');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konfiguracje`
--

CREATE TABLE `konfiguracje` (
  `Id` int(11) NOT NULL,
  `Nazwa` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `ChlodzenieCPU` int(11) DEFAULT NULL,
  `Procesor` int(11) DEFAULT NULL,
  `PlytaGlowna` int(11) DEFAULT NULL,
  `Obudowa` int(11) DEFAULT NULL,
  `Zasilacz` int(11) DEFAULT NULL,
  `KartaGraficzna` int(11) DEFAULT NULL,
  `KartaDzwiekowa` int(11) DEFAULT NULL,
  `KartaSieciowa` int(11) DEFAULT NULL,
  `Uzytkownik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `konfiguracje`
--

INSERT INTO `konfiguracje` (`Id`, `Nazwa`, `ChlodzenieCPU`, `Procesor`, `PlytaGlowna`, `Obudowa`, `Zasilacz`, `KartaGraficzna`, `KartaDzwiekowa`, `KartaSieciowa`, `Uzytkownik`) VALUES
(1, 'cos', 2, 3, 2, NULL, 4, NULL, NULL, NULL, 16),
(2, 'New configuration', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(3, 'New configuration', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4, 'New configuration', NULL, 3, 2, 4, 3, NULL, 3, NULL, 16),
(5, 'New configuration', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(6, 'New configuration', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(7, 'New configuration', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(8, 'New configuration', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(9, 'New configuration', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `obudowa`
--

CREATE TABLE `obudowa` (
  `Id` int(11) NOT NULL,
  `Producent` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Model` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Standard` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `ZasilanieWentlatorow` int(11) DEFAULT NULL,
  `DostepneWentylatory` int(11) DEFAULT NULL,
  `Material` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `StandardWymiarow` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `obudowa`
--

INSERT INTO `obudowa` (`Id`, `Producent`, `Model`, `Standard`, `ZasilanieWentlatorow`, `DostepneWentylatory`, `Material`, `StandardWymiarow`) VALUES
(3, 'KRUX', 'Vako', 'Middle Tower', 3, 6, 'Stal, szkło hartowane', 1),
(4, 'Genesis', 'Irid 505 Black V2', 'Middle Tower', 2, 6, 'Tworzywo sztuczne, stal, szkło hartowane', 1),
(5, 'ENDORFY', 'Signum 300 ARGB', 'Middle Tower', 4, 8, 'Szkło hartowane', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pamiecram`
--

CREATE TABLE `pamiecram` (
  `Id` int(11) NOT NULL,
  `Producent` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Model` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Typ` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `Pojemnosc` int(11) DEFAULT NULL,
  `Predkosc` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pamiecram`
--

INSERT INTO `pamiecram` (`Id`, `Producent`, `Model`, `Typ`, `Pojemnosc`, `Predkosc`) VALUES
(1, 'Kingston FURY', 'Beast Black', 'DDR4', 16, 3200),
(2, 'GOODRAM', 'IRDM RGB', 'DDR4', 16, 3600),
(3, 'ADATA', 'Gammix D10', 'DDR4', 16, 3200);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pamiecramkonfiguracji`
--

CREATE TABLE `pamiecramkonfiguracji` (
  `Konfiguracja` int(11) NOT NULL,
  `PamiecRAM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pamiecramkonfiguracji`
--

INSERT INTO `pamiecramkonfiguracji` (`Konfiguracja`, `PamiecRAM`) VALUES
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `plytyglowne`
--

CREATE TABLE `plytyglowne` (
  `Id` int(11) NOT NULL,
  `Producent` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Model` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `ChipsetPlytyGlownej` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `TypObslugiwanejPamieci` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `IloscSlotowPamieciRAM` int(11) DEFAULT NULL,
  `IloscSlotowNvme` int(11) DEFAULT NULL,
  `IloscPortowSATA` int(11) DEFAULT NULL,
  `Socket` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `plytyglowne`
--

INSERT INTO `plytyglowne` (`Id`, `Producent`, `Model`, `ChipsetPlytyGlownej`, `TypObslugiwanejPamieci`, `IloscSlotowPamieciRAM`, `IloscSlotowNvme`, `IloscPortowSATA`, `Socket`) VALUES
(1, 'ASUS', 'PRIME B450-PLUS', 'AMD B450', 'DDR4', 4, 1, 6, 2),
(2, 'Gigabyte', 'B550M DS3H', 'AMD B550', 'DDR4', 4, 0, 4, 2),
(3, 'MSI', 'MAG B550 TOMAHAWK', 'AMD B550', 'DDR4', 4, 0, 6, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `procesory`
--

CREATE TABLE `procesory` (
  `Id` int(11) NOT NULL,
  `Producent` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Model` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Rdzenie` int(11) DEFAULT NULL,
  `Watki` int(11) DEFAULT NULL,
  `Socket` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `procesory`
--

INSERT INTO `procesory` (`Id`, `Producent`, `Model`, `Rdzenie`, `Watki`, `Socket`) VALUES
(2, 'AMD', 'Ryzen 5 5600', 6, 12, 2),
(3, 'Intel', 'Core i5-12400F', 6, 12, 14),
(4, 'Intel', 'Core i3-12100F', 4, 8, 14);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `socket`
--

CREATE TABLE `socket` (
  `Id` int(11) NOT NULL,
  `Nazwa` varchar(128) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `socket`
--

INSERT INTO `socket` (`Id`, `Nazwa`) VALUES
(1, 'Socket 1700'),
(2, 'Socket AM4'),
(3, 'Socket AM5'),
(4, 'Socket AM3+'),
(5, 'Socket FM1'),
(6, 'Socket 2066'),
(7, 'Socket 2011'),
(8, 'Socket 1156'),
(9, 'Socket 1150'),
(10, 'Socket 1155'),
(11, 'Socket 1151'),
(12, 'Socket AM2+'),
(13, 'Socket FM2+'),
(14, 'Socket 1700');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `standardwymiarow`
--

CREATE TABLE `standardwymiarow` (
  `Id` int(11) NOT NULL,
  `Nazwa` varchar(128) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `standardwymiarow`
--

INSERT INTO `standardwymiarow` (`Id`, `Nazwa`) VALUES
(1, 'ATX'),
(2, 'SFX'),
(3, 'TFX'),
(4, 'FlexATX'),
(5, 'AT PSU'),
(6, 'PS3');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `Id` int(11) NOT NULL,
  `Email` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Haslo` varchar(128) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`Id`, `Email`, `Haslo`) VALUES
(1, 'User1', 'password'),
(12, 'Dorothy Finch', 'Pa$$w0rd!'),
(13, 'Claudia Barker', 'Pa$$w0rd!'),
(14, 'Summer Barry', 'Pa$$w0rd!'),
(16, 'admin', 'asdf'),
(17, 'Tana Mendoza', 'Pa$$w0rd!');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zasilacze`
--

CREATE TABLE `zasilacze` (
  `Id` int(11) NOT NULL,
  `Producent` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Model` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Moc` float DEFAULT NULL,
  `Certyfikat` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `StandardWymiarow` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zasilacze`
--

INSERT INTO `zasilacze` (`Id`, `Producent`, `Model`, `Moc`, `Certyfikat`, `StandardWymiarow`) VALUES
(2, 'be quiet!', 'Dark Power PRO 12', 1500, '80 PLUS Titanium', 1),
(3, 'Gigabyte', 'Aorus', 750, '80 Plus Gold', 1),
(4, 'Corsair', 'RM750x', 750, '80 Plus Gold', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `chlodzeniecpu`
--
ALTER TABLE `chlodzeniecpu`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `chlodzeniecpukompatybilnosc`
--
ALTER TABLE `chlodzeniecpukompatybilnosc`
  ADD PRIMARY KEY (`ChlodzenieCPU`,`Socket`),
  ADD KEY `Socket` (`Socket`);

--
-- Indeksy dla tabeli `dyski`
--
ALTER TABLE `dyski`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `dyskikonfiguracji`
--
ALTER TABLE `dyskikonfiguracji`
  ADD PRIMARY KEY (`Konfiguracja`,`Dysk`),
  ADD KEY `Dysk` (`Dysk`);

--
-- Indeksy dla tabeli `kartydzwiekowe`
--
ALTER TABLE `kartydzwiekowe`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `kartygraficzne`
--
ALTER TABLE `kartygraficzne`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `kartysieciowe`
--
ALTER TABLE `kartysieciowe`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `konfiguracje`
--
ALTER TABLE `konfiguracje`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Email` (`Uzytkownik`),
  ADD KEY `KartaSieciowa` (`KartaSieciowa`),
  ADD KEY `KartaDzwiekowa` (`KartaDzwiekowa`),
  ADD KEY `KartaGraficzna` (`KartaGraficzna`),
  ADD KEY `Zasilacz` (`Zasilacz`),
  ADD KEY `Obudowa` (`Obudowa`),
  ADD KEY `PlytaGlowna` (`PlytaGlowna`),
  ADD KEY `Procesor` (`Procesor`),
  ADD KEY `Chlodzenie` (`ChlodzenieCPU`);

--
-- Indeksy dla tabeli `obudowa`
--
ALTER TABLE `obudowa`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `StandardWymiarow` (`StandardWymiarow`);

--
-- Indeksy dla tabeli `pamiecram`
--
ALTER TABLE `pamiecram`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `pamiecramkonfiguracji`
--
ALTER TABLE `pamiecramkonfiguracji`
  ADD PRIMARY KEY (`Konfiguracja`,`PamiecRAM`),
  ADD KEY `PamiecRAM` (`PamiecRAM`);

--
-- Indeksy dla tabeli `plytyglowne`
--
ALTER TABLE `plytyglowne`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Socket` (`Socket`);

--
-- Indeksy dla tabeli `procesory`
--
ALTER TABLE `procesory`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Socket` (`Socket`),
  ADD KEY `Socket_2` (`Socket`);

--
-- Indeksy dla tabeli `socket`
--
ALTER TABLE `socket`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `standardwymiarow`
--
ALTER TABLE `standardwymiarow`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `zasilacze`
--
ALTER TABLE `zasilacze`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `StandardWymiarow` (`StandardWymiarow`),
  ADD KEY `StandardWymiarow_2` (`StandardWymiarow`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `chlodzeniecpu`
--
ALTER TABLE `chlodzeniecpu`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `dyski`
--
ALTER TABLE `dyski`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `kartydzwiekowe`
--
ALTER TABLE `kartydzwiekowe`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `kartygraficzne`
--
ALTER TABLE `kartygraficzne`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `kartysieciowe`
--
ALTER TABLE `kartysieciowe`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `konfiguracje`
--
ALTER TABLE `konfiguracje`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `obudowa`
--
ALTER TABLE `obudowa`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `pamiecram`
--
ALTER TABLE `pamiecram`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `plytyglowne`
--
ALTER TABLE `plytyglowne`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `procesory`
--
ALTER TABLE `procesory`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `socket`
--
ALTER TABLE `socket`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `standardwymiarow`
--
ALTER TABLE `standardwymiarow`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `zasilacze`
--
ALTER TABLE `zasilacze`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `chlodzeniecpukompatybilnosc`
--
ALTER TABLE `chlodzeniecpukompatybilnosc`
  ADD CONSTRAINT `chlodzeniecpukompatybilnosc_ibfk_1` FOREIGN KEY (`Socket`) REFERENCES `socket` (`Id`),
  ADD CONSTRAINT `chlodzeniecpukompatybilnosc_ibfk_2` FOREIGN KEY (`ChlodzenieCPU`) REFERENCES `chlodzeniecpu` (`Id`);

--
-- Ograniczenia dla tabeli `dyskikonfiguracji`
--
ALTER TABLE `dyskikonfiguracji`
  ADD CONSTRAINT `dyskikonfiguracji_ibfk_1` FOREIGN KEY (`Konfiguracja`) REFERENCES `konfiguracje` (`Id`),
  ADD CONSTRAINT `dyskikonfiguracji_ibfk_2` FOREIGN KEY (`Dysk`) REFERENCES `dyski` (`Id`);

--
-- Ograniczenia dla tabeli `konfiguracje`
--
ALTER TABLE `konfiguracje`
  ADD CONSTRAINT `konfiguracje_ibfk_10` FOREIGN KEY (`Uzytkownik`) REFERENCES `uzytkownicy` (`Id`),
  ADD CONSTRAINT `konfiguracje_ibfk_11` FOREIGN KEY (`KartaDzwiekowa`) REFERENCES `kartydzwiekowe` (`Id`),
  ADD CONSTRAINT `konfiguracje_ibfk_2` FOREIGN KEY (`ChlodzenieCPU`) REFERENCES `chlodzeniecpu` (`Id`),
  ADD CONSTRAINT `konfiguracje_ibfk_3` FOREIGN KEY (`Procesor`) REFERENCES `procesory` (`Id`),
  ADD CONSTRAINT `konfiguracje_ibfk_4` FOREIGN KEY (`PlytaGlowna`) REFERENCES `plytyglowne` (`Id`),
  ADD CONSTRAINT `konfiguracje_ibfk_5` FOREIGN KEY (`Obudowa`) REFERENCES `obudowa` (`Id`),
  ADD CONSTRAINT `konfiguracje_ibfk_6` FOREIGN KEY (`Zasilacz`) REFERENCES `zasilacze` (`Id`),
  ADD CONSTRAINT `konfiguracje_ibfk_7` FOREIGN KEY (`KartaGraficzna`) REFERENCES `kartygraficzne` (`Id`),
  ADD CONSTRAINT `konfiguracje_ibfk_9` FOREIGN KEY (`KartaSieciowa`) REFERENCES `kartysieciowe` (`Id`);

--
-- Ograniczenia dla tabeli `obudowa`
--
ALTER TABLE `obudowa`
  ADD CONSTRAINT `obudowa_ibfk_1` FOREIGN KEY (`StandardWymiarow`) REFERENCES `standardwymiarow` (`Id`);

--
-- Ograniczenia dla tabeli `pamiecramkonfiguracji`
--
ALTER TABLE `pamiecramkonfiguracji`
  ADD CONSTRAINT `pamiecramkonfiguracji_ibfk_1` FOREIGN KEY (`Konfiguracja`) REFERENCES `konfiguracje` (`Id`),
  ADD CONSTRAINT `pamiecramkonfiguracji_ibfk_2` FOREIGN KEY (`PamiecRAM`) REFERENCES `pamiecram` (`Id`);

--
-- Ograniczenia dla tabeli `plytyglowne`
--
ALTER TABLE `plytyglowne`
  ADD CONSTRAINT `plytyglowne_ibfk_1` FOREIGN KEY (`Socket`) REFERENCES `socket` (`Id`);

--
-- Ograniczenia dla tabeli `procesory`
--
ALTER TABLE `procesory`
  ADD CONSTRAINT `procesory_ibfk_1` FOREIGN KEY (`Socket`) REFERENCES `socket` (`Id`);

--
-- Ograniczenia dla tabeli `zasilacze`
--
ALTER TABLE `zasilacze`
  ADD CONSTRAINT `zasilacze_ibfk_1` FOREIGN KEY (`StandardWymiarow`) REFERENCES `standardwymiarow` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
