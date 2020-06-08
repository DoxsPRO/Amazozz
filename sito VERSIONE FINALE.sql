-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 08, 2020 alle 15:58
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sito`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `carte`
--

CREATE TABLE `carte` (
  `CartaID` int(5) NOT NULL,
  `NumCarta` char(32) DEFAULT NULL,
  `NomeProprietario` char(50) NOT NULL,
  `CognomeProprietario` char(50) NOT NULL,
  `Scadenza` date DEFAULT NULL,
  `CVV2` char(255) DEFAULT NULL,
  `ClienteID` int(5) DEFAULT NULL,
  `OrdineID` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `carte`
--

INSERT INTO `carte` (`CartaID`, `NumCarta`, `NomeProprietario`, `CognomeProprietario`, `Scadenza`, `CVV2`, `ClienteID`, `OrdineID`) VALUES
(20, '1233-2312-1231-3212', 'Domenico', 'Ciancio', '2202-02-01', '$2y$10$6xcAM9RK2DVMUtJQcKqgJer81NjNQ0e7RiQg9wIuWdvpXTLSjujQG', 17, 38),
(21, '2235-9859-8852-9695', 'Domenico', 'Ciancio', '2024-02-01', '$2y$10$90qFH1dXtuipWguNi0Z4l.tBpgQIdXbeRordp4ysYRxAONg/MVtzK', 23, 39),
(22, '2235-9859-8852-9695', 'Domenico', 'Ciancio', '2024-02-01', '$2y$10$90qFH1dXtuipWguNi0Z4l.tBpgQIdXbeRordp4ysYRxAONg/MVtzK', 23, 40);

-- --------------------------------------------------------

--
-- Struttura della tabella `clienti`
--

CREATE TABLE `clienti` (
  `ClienteID` int(5) NOT NULL,
  `Nome` char(50) DEFAULT NULL,
  `Cognome` char(50) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `CodiceFiscale` char(30) DEFAULT NULL,
  `Provincia` char(50) DEFAULT NULL,
  `Citta` char(50) DEFAULT NULL,
  `Indirizzo` char(50) DEFAULT NULL,
  `CAP` char(5) DEFAULT NULL,
  `Telefono` char(9) DEFAULT NULL,
  `Username` char(50) NOT NULL,
  `Password` char(255) NOT NULL,
  `Email` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `clienti`
--

INSERT INTO `clienti` (`ClienteID`, `Nome`, `Cognome`, `Data`, `CodiceFiscale`, `Provincia`, `Citta`, `Indirizzo`, `CAP`, `Telefono`, `Username`, `Password`, `Email`) VALUES
(23, 'Domenico', 'Ciancio', '2001-12-06', 'DOMENICOCIANCIO1', 'Salerno', 'Olevano sul Tusciano', 'Via San Leone Magno n 21', '84062', '338429525', 'Doxs', '$2y$10$y2jRj7pdGG4abkn9/2.laul.stZXrH5CL1.WJmdHYut9sxaY6vImS', 'doxspro1@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `dettaglioordini`
--

CREATE TABLE `dettaglioordini` (
  `ProdottoID` int(5) NOT NULL,
  `OrdineID` int(5) NOT NULL,
  `NumPezzi` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `dettaglioordini`
--

INSERT INTO `dettaglioordini` (`ProdottoID`, `OrdineID`, `NumPezzi`) VALUES
(11112, 39, 670),
(11113, 40, 100);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `OrdineID` int(5) NOT NULL,
  `ClienteID` int(5) DEFAULT NULL,
  `NomeDestinatario` char(50) NOT NULL,
  `CognomeDestinatario` char(50) NOT NULL,
  `EmailSpedizione` char(50) NOT NULL,
  `TelefonoSpedizione` char(10) NOT NULL,
  `IndirizzoSpedizione` char(30) DEFAULT NULL,
  `CittaSpedizione` char(50) NOT NULL,
  `ProvinciaSpedizione` char(50) NOT NULL,
  `CapSpedizione` int(5) NOT NULL,
  `DataOrdine` date DEFAULT NULL,
  `TotaleOrdine` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`OrdineID`, `ClienteID`, `NomeDestinatario`, `CognomeDestinatario`, `EmailSpedizione`, `TelefonoSpedizione`, `IndirizzoSpedizione`, `CittaSpedizione`, `ProvinciaSpedizione`, `CapSpedizione`, `DataOrdine`, `TotaleOrdine`) VALUES
(38, 17, 'Domenico', 'Ciancio', 'doxspro1@gmail.com', '338429525', 'Via dei Greci n 23', 'Olevano sul Tusciano', 'Salerno', 84062, '2020-06-06', 176),
(39, 23, 'Domenico', 'Ciancio', 'doxspro1@gmail.com', '338429525', 'Via San Leone Magno n 21', 'Olevano sul Tusciano', 'Salerno', 84062, '2020-06-08', 670),
(40, 23, 'Domenico', 'Ciancio', 'doxspro1@gmail.com', '338429525', 'Via San Leone Magno n 21', 'Olevano sul Tusciano', 'Salerno', 84062, '2020-06-08', 100);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `ProdottoID` int(5) NOT NULL,
  `Nome` char(50) DEFAULT NULL,
  `Specifiche` char(200) DEFAULT NULL,
  `Prezzo` float DEFAULT NULL,
  `Quantita` int(5) DEFAULT NULL,
  `immagine` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`ProdottoID`, `Nome`, `Specifiche`, `Prezzo`, `Quantita`, `immagine`) VALUES
(11112, 'samsung galaxy s10', 'display 6.1 pollici risoluzione 3040x144 pixel Fotocamera da 12 megapixelcon una risoluzione di 4032x3024 pixel e di registrare video in 4K alla risoluzione di 3840x2160 pixel spessore di 7.8mm', 670, 3256, 'eCommerceAssets\\product\\samsungS10.jpg'),
(11113, 'mouse razer viper mini', '\r\n    Sensore ottico da 8.500 DPI reali\r\n    Switch ottici per mouse Razer™\r\n    Illuminazione underglow Razer Chroma™ RGB\r\n    Cavo Speedflex Razer\r\n    Profilo su memoria integrata\r\n', 100, 169, 'eCommerceAssets\\product\\mouse.jpg'),
(11114, 'msi GeForce RTX 2070 Ventus GP', 'Scheda Grafica 8 GB, GDDR6, 1620 MHz, 3 x DisplayPort, 1 x HDMI, TORX Fan 2.0, Sistema di Raffreddamento a Doppia Ventola', 489, 558, 'eCommerceAssets\\product\\RTX-2070.jpg'),
(11115, 'Corsair Vengeance LPX Memorie', ' 8 GB (1 X 8 GB), DDR4, 3000 MHz, C16 XMP 2.0, Nero', 45, 2000, 'eCommerceAssets\\product\\ram.jpg'),
(11116, 'Samsung Memorie MZ-76E500 860 EVO', 'SSD Interno da 500 GB, SATA, 2.5\"', 88, 2142, 'eCommerceAssets\\product\\samsungSSD.jpg'),
(11117, 'rucial MX500 CT500MX500SSD1(Z)', ' SSD Interno, 500 GB, 3D NAND, SATA, 2.5 Pollici', 69, 700, NULL),
(11118, 'Kingston A400 SSD SA400S37/240G', 'Unità a Stato Solido Interne 2.5\" SATA, 240 GB', 41, 999, NULL),
(11119, 'Samsung S24F350', 'Monitor per PC 24 pollici Risoluzione 1920 x 1080, Full HD, 60 Hz D-Sub, HDMI, Pannello PLS, Nero', 180, 200, NULL),
(11121, 'Samsung Monitor C27F396', 'Curvo, 27\'\' Full HD, 1920 x 1080, 60 Hz, 4 ms, Freesync, D-sub, HDMI, Nero', 160, 1200, NULL),
(11122, 'ASUS PRIME A320M-K Scheda Madre', 'AMD AM4 (Ryzen gen 1 e 2) uATX, DDR4 3200 MHz, 32 GB/s M.2, HDMI, USB 3.0', 64.61, 250, NULL),
(11123, 'MSI B450 GAMING PLUS MAX', 'Scheda Madre con Core Boost, Turbo M.2, Socket AM4, Memorie DDR4, Form factor ATX, Connettore USB 3.2 Gen2', 109.99, 240, NULL),
(11124, 'MSI MPG Z390 GAMING PLUS Scheda Madre', 'Socket LGA 1151, Nero', 132.4, 300, NULL),
(11125, 'AMD Ryzen 5 3600 Processore', '6C / 12T, 35 MB di cache, 4,2 GHz Max Boost)', 183, 1000, NULL),
(11126, 'Intel Core i3-9100F Processore', '4x3.6 (Boost 4.2) GHz 6MB-L3 Cache Socket 1151', 90.24, 1250, NULL),
(11127, 'Intel Core i7-9700K processore', '3,6 GHz Scatola 12 MB Cache intelligente', 380, 1998, NULL),
(11128, 'Sony MDR-ZX110', 'Cuffie On-Ear, Rosa', 10, 200, NULL),
(11129, 'AUKEY Cuffie Bluetooth', 'Sport Bassi Potenziati, Auricolari Wireless in Ear con 8 Ore di Tempo di Utilizzo, Resistente al Sudore, Microfono Incorporato, per iPhone, Huawei, Samsung', 21.99, 500, NULL),
(11211, 'Logitech G432', 'Cuffie Gaming Cablate, Audio Surround 7.1, Cuffie DTS: X 2.0, Driver Audio 50 mm, ‎Jack Audio USB 3.5 mm, Microfono Flip-to-Mute, Leggere, PC/Mac/Xbox One/PS4/Nintendo ‎Switch, Nero/Blu', 66.8, 600, NULL),
(11212, 'HyperX HX-HSCS-BK', 'Cloud Stinger, Cuffie Gaming', 59.99, 1000, NULL),
(11213, 'TONOR PC', 'Microfono USB Condensatore per Computer Gioco Mic Plug & Play con Treppiede e Filtro Pop per Registrazione Vocale, Podcasting, Streaming, Video di Youtube per Laptop iMac PC Desktop', 43.99, 80, NULL),
(11214, 'EIVOTOR Microfono', 'USB per PC, Voice Microfono Desktop Gaming per Computer Omnidirezionale Plug & Play con Pulsante Mute Compatibile con PS4, Mac, Windows 7/8/10 per Youtube, Skype, Podcast', 24.79, 100, NULL),
(11215, 'Logitech B100', 'Mouse USB Cablato, 3 Pulsanti, Rilevamento Ottico, Ambidestro, PC/Mac/‎Laptop, ‎Nero', 6.99, 49, NULL),
(11216, 'Razer DeathAdder Elite', 'Mouse per eSports con tasti mec anici, 16.000 DPI sensore ottico 5G, mouse interruttori, fino a 50 milioni di clic, fattore di forma ergonomico', 49.99, 500, NULL),
(11217, 'Logitech G402 Hyperion Fury', 'FPS Mouse Gaming, 4000 DPI, Design Leggero, 8 Pulsanti Programmabili, Compatibile con PC/Mac/Laptop, Nero', 38.99, 2000, NULL),
(11218, 'Logitech G213 Prodigy', 'Tastiera Gaming, RGB Lightsync Backlit Keys, Resistente agli schizzi, Tasti personalizzabili, Tasti multimedia personalizzabili, Layout QWERTY US, Nero', 37.49, 1200, NULL),
(11219, 'Logitech G413', 'Tastiera Gaming Meccanica, Tasti Retroilluminati, Switch Meccanici Romer-G ‎Tactile, Telaio Lega Alluminio, Funzioni Personalizzate, Passthrough USB, Layout Italiano ‎QWERTY, Nero', 82.95, 1300, NULL),
(12111, 'Razer Cynosa', 'Lite Tastiera da Gioco con Illuminazione con RGB Chroma, Completamente Programmabile, Layout Italiano', 49.99, 1400, NULL),
(12112, 'Razer Huntsman', 'Tastiera Gaming Premium con Tasti Opto-Meccanici Razer, Barra Stabilizzatrice dei Tasti, RGB Chroma, Layout Italiano', 126.17, 5000, NULL),
(12113, 'Corsair K55', 'RGB Tastiera Gaming (Cablato) USB 2.0 Type-A, Retroilluminazione RGB Multicolore, Italiano QWERTY, Nero', 64.99, 2982, NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`CartaID`),
  ADD KEY `ClienteID` (`ClienteID`),
  ADD KEY `OrdineID` (`OrdineID`);

--
-- Indici per le tabelle `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`ClienteID`);

--
-- Indici per le tabelle `dettaglioordini`
--
ALTER TABLE `dettaglioordini`
  ADD KEY `OrdineID` (`OrdineID`),
  ADD KEY `ProdottoID` (`ProdottoID`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`OrdineID`),
  ADD KEY `ClienteID` (`ClienteID`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`ProdottoID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `carte`
--
ALTER TABLE `carte`
  MODIFY `CartaID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT per la tabella `clienti`
--
ALTER TABLE `clienti`
  MODIFY `ClienteID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `OrdineID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carte`
--
ALTER TABLE `carte`
  ADD CONSTRAINT `carte_ibfk_1` FOREIGN KEY (`ClienteID`) REFERENCES `clienti` (`ClienteID`),
  ADD CONSTRAINT `carte_ibfk_2` FOREIGN KEY (`OrdineID`) REFERENCES `ordini` (`OrdineID`);

--
-- Limiti per la tabella `dettaglioordini`
--
ALTER TABLE `dettaglioordini`
  ADD CONSTRAINT `dettaglioordini_ibfk_1` FOREIGN KEY (`OrdineID`) REFERENCES `ordini` (`OrdineID`),
  ADD CONSTRAINT `dettaglioordini_ibfk_2` FOREIGN KEY (`ProdottoID`) REFERENCES `prodotti` (`ProdottoID`);

--
-- Limiti per la tabella `ordini`
--
ALTER TABLE `ordini`
  ADD CONSTRAINT `ordini_ibfk_1` FOREIGN KEY (`ClienteID`) REFERENCES `clienti` (`ClienteID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
