-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Apr 05, 2014 alle 14:15
-- Versione del server: 5.5.35
-- Versione PHP: 5.4.6-1ubuntu1.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fantacalcio`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisti`
--

CREATE TABLE IF NOT EXISTS `acquisti` (
  `giocatore` int(11) NOT NULL,
  `rosa` int(11) NOT NULL,
  `costo` float DEFAULT NULL,
  PRIMARY KEY (`giocatore`,`rosa`),
  KEY `rosa` (`rosa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `acquisti`
--

INSERT INTO `acquisti` (`giocatore`, `rosa`, `costo`) VALUES
(1, 13, NULL),
(1, 14, NULL),
(1, 16, NULL),
(1, 17, NULL),
(1, 18, NULL),
(3, 13, NULL),
(3, 15, NULL),
(3, 16, NULL),
(3, 17, NULL),
(3, 18, NULL),
(4, 13, NULL),
(4, 14, NULL),
(4, 15, NULL),
(4, 16, NULL),
(4, 17, NULL),
(4, 18, NULL),
(5, 13, NULL),
(5, 14, NULL),
(5, 15, NULL),
(5, 17, NULL),
(11, 13, NULL),
(11, 14, NULL),
(11, 16, NULL),
(12, 13, NULL),
(12, 14, NULL),
(12, 15, NULL),
(14, 13, NULL),
(14, 16, NULL),
(17, 13, NULL),
(17, 15, NULL),
(19, 13, NULL),
(19, 15, NULL),
(19, 16, NULL),
(19, 18, NULL),
(20, 16, NULL),
(21, 13, NULL),
(21, 16, NULL),
(22, 13, NULL),
(22, 15, NULL),
(22, 16, NULL),
(23, 13, NULL),
(23, 14, NULL),
(23, 15, NULL),
(23, 16, NULL),
(24, 13, NULL),
(24, 14, NULL),
(24, 15, NULL),
(24, 16, NULL),
(25, 13, NULL),
(25, 14, NULL),
(25, 15, NULL),
(25, 16, NULL),
(26, 13, NULL),
(26, 14, NULL),
(26, 16, NULL),
(27, 13, NULL),
(27, 14, NULL),
(27, 15, NULL),
(27, 16, NULL),
(28, 13, NULL),
(28, 15, NULL),
(28, 16, NULL),
(29, 13, NULL),
(29, 14, NULL),
(29, 15, NULL),
(29, 16, NULL),
(29, 17, NULL),
(30, 14, NULL),
(30, 15, NULL),
(30, 16, NULL),
(31, 13, NULL),
(31, 14, NULL),
(31, 15, NULL),
(31, 16, NULL),
(32, 13, NULL),
(32, 14, NULL),
(32, 15, NULL),
(32, 16, NULL),
(33, 13, NULL),
(33, 14, NULL),
(33, 15, NULL),
(33, 16, NULL),
(34, 14, NULL),
(34, 15, NULL),
(35, 15, NULL),
(35, 17, NULL),
(35, 18, NULL),
(36, 14, NULL),
(37, 14, NULL),
(37, 15, NULL),
(37, 16, NULL),
(38, 14, NULL),
(38, 15, NULL),
(38, 17, NULL),
(39, 14, NULL),
(39, 15, NULL),
(39, 17, NULL),
(40, 13, NULL),
(40, 14, NULL),
(40, 15, NULL),
(40, 16, NULL),
(41, 14, NULL),
(41, 16, NULL),
(41, 17, NULL),
(41, 18, NULL),
(42, 13, NULL),
(42, 14, NULL),
(42, 15, NULL),
(42, 16, NULL),
(43, 13, NULL),
(43, 14, NULL),
(44, 17, NULL),
(44, 18, NULL),
(45, 17, NULL),
(45, 18, NULL),
(46, 17, NULL),
(46, 18, NULL),
(47, 16, NULL),
(47, 18, NULL),
(48, 18, NULL),
(49, 17, NULL),
(49, 18, NULL),
(51, 17, NULL),
(51, 18, NULL),
(52, 17, NULL),
(52, 18, NULL),
(53, 18, NULL),
(54, 17, NULL),
(54, 18, NULL),
(55, 17, NULL),
(55, 18, NULL),
(56, 17, NULL),
(56, 18, NULL),
(57, 17, NULL),
(57, 18, NULL),
(58, 17, NULL),
(66, 17, NULL),
(66, 18, NULL),
(68, 17, NULL),
(69, 18, NULL),
(71, 18, NULL),
(215, 17, NULL),
(216, 17, NULL),
(280, 17, NULL),
(280, 18, NULL),
(281, 18, NULL),
(282, 18, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `formazioni`
--

CREATE TABLE IF NOT EXISTS `formazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partita` int(11) NOT NULL,
  `giocatore` int(11) NOT NULL,
  `rosa` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `partita_giocatore_rosa` (`partita`,`giocatore`,`rosa`),
  KEY `partita` (`partita`),
  KEY `giocatore` (`giocatore`),
  KEY `rosa` (`rosa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dump dei dati per la tabella `formazioni`
--

INSERT INTO `formazioni` (`id`, `partita`, `giocatore`, `rosa`, `numero`) VALUES
(37, 77, 1, 13, 1),
(38, 77, 3, 13, 2),
(39, 77, 27, 13, 3),
(40, 77, 4, 13, 4),
(41, 77, 29, 13, 5),
(42, 77, 32, 13, 6),
(43, 77, 26, 13, 7),
(44, 77, 24, 13, 8),
(45, 77, 22, 13, 9),
(46, 77, 12, 13, 10),
(48, 77, 14, 13, 12),
(49, 77, 31, 13, 13),
(50, 77, 33, 13, 14),
(51, 77, 21, 13, 15),
(52, 77, 19, 13, 16),
(53, 77, 17, 13, 17),
(54, 77, 23, 13, 18),
(55, 77, 28, 15, 1),
(56, 77, 3, 15, 2),
(57, 77, 4, 15, 3),
(58, 77, 27, 15, 4),
(59, 77, 29, 15, 5),
(60, 77, 30, 15, 6),
(61, 77, 5, 15, 7),
(62, 77, 19, 15, 8),
(63, 77, 22, 15, 9),
(64, 77, 24, 15, 10),
(65, 77, 40, 15, 11),
(66, 77, 34, 15, 12),
(67, 77, 31, 15, 13),
(68, 77, 33, 15, 14),
(69, 77, 32, 15, 15),
(70, 77, 37, 15, 16),
(71, 77, 25, 15, 17),
(72, 77, 23, 15, 18),
(73, 81, 1, 13, 1),
(74, 81, 3, 13, 2),
(75, 81, 4, 13, 3),
(76, 81, 27, 13, 4),
(77, 81, 29, 13, 5),
(78, 81, 5, 13, 6),
(79, 81, 11, 13, 7),
(80, 81, 19, 13, 8),
(81, 81, 21, 13, 9),
(82, 81, 12, 13, 10),
(83, 81, 23, 13, 11),
(84, 81, 14, 13, 12),
(85, 81, 33, 13, 13),
(86, 81, 42, 13, 14),
(87, 81, 22, 13, 15),
(88, 81, 24, 13, 16),
(89, 81, 25, 13, 17),
(90, 81, 40, 13, 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `giocatori`
--

CREATE TABLE IF NOT EXISTS `giocatori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `quotazione` int(11) NOT NULL,
  `ruolo` int(11) NOT NULL,
  `squadra` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ruolo` (`ruolo`),
  KEY `squadra` (`squadra`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=283 ;

--
-- Dump dei dati per la tabella `giocatori`
--

INSERT INTO `giocatori` (`id`, `nome`, `cognome`, `quotazione`, `ruolo`, `squadra`) VALUES
(1, 'Gianluigi', 'Buffon', 20, 1, 1),
(3, 'Leonardo', 'Bonucci', 9, 2, 1),
(4, 'Giorgio', 'Chiellini', 14, 2, 1),
(5, 'Claudio ', 'Marchisio', 18, 3, 1),
(11, 'Luca', 'Marrone', 8, 3, 18),
(12, 'Mirko', 'Vucinic', 24, 4, 1),
(14, 'Samir', 'Handanovic', 18, 1, 8),
(17, 'Gianluca', 'Pegolo', 11, 1, 18),
(18, 'Carlitos', 'Tevez', 32, 4, 1),
(19, 'Riccardo ', 'Montolivo', 24, 3, 3),
(20, 'Francesco', 'Totti', 30, 4, 7),
(21, 'Pedro', 'Obiang', 18, 3, 13),
(22, 'Giacomo', 'Bonaventura', 14, 3, 21),
(23, 'Robert', 'Acquafresca', 12, 4, 12),
(24, 'Antonio', 'Candreva', 20, 3, 6),
(25, 'Alberto', 'Gilardino', 23, 4, 16),
(26, 'Manuel', 'Vargas', 18, 3, 4),
(27, 'Nicola ', 'Legrottaglie', 11, 2, 9),
(28, 'Michael', 'Agazzi', 10, 1, 11),
(29, 'Daniele', 'Bonera', 13, 2, 3),
(30, 'Alessandro', 'Lucarelli', 15, 2, 10),
(31, 'Paolo', 'Cannavaro', 14, 2, 18),
(32, 'Michel', 'Bastos', 20, 3, 7),
(33, 'Nicolas', 'Burdisso', 13, 2, 16),
(34, 'Marco', 'Amelia', 4, 1, 3),
(35, 'Marco', 'Storari', 4, 1, 1),
(36, 'Morgan', 'De Sanctis', 12, 1, 7),
(37, 'Marco', 'Marchionni', 13, 3, 10),
(38, 'Kwadwo', 'Asamoah', 18, 3, 1),
(39, 'Andrea', 'Pirlo', 28, 3, 1),
(40, 'Maurito', 'Icardi', 12, 4, 8),
(41, 'Mario', 'Balotelli', 31, 4, 3),
(42, 'Andrea ', 'Ranocchia', 19, 2, 8),
(43, 'Facundo ', 'Roncaglia', 15, 2, 4),
(44, 'Marek', 'Hamsik', 29, 3, 2),
(45, 'Pepe', 'Reina', 14, 1, 2),
(46, 'Raul', 'Albiol', 18, 2, 2),
(47, 'Lorenzo', 'Insigne', 20, 4, 2),
(48, 'Gonzalo', 'Higuain', 30, 4, 2),
(49, 'Dries', 'Mertens', 16, 3, 2),
(51, 'Valon', 'Berhami', 14, 3, 2),
(52, 'Gokhan', 'Inler', 22, 3, 2),
(53, 'Goran', 'Pandev', 24, 4, 2),
(54, 'Christian', 'Maggio', 12, 2, 2),
(55, 'Giandomenico', 'Mesto', 8, 2, 2),
(56, 'Martin', 'Caceres', 9, 2, 1),
(57, 'Paul', 'Pogba', 28, 3, 1),
(58, 'Mario', 'Gomez', 30, 4, 4),
(59, 'Borja', 'Valero', 23, 3, 4),
(60, 'Alberto', 'Aquilani', 18, 3, 4),
(61, 'Manuel', 'Pasqual', 16, 2, 4),
(62, 'David', 'Pizarro', 20, 3, 4),
(63, 'Gonzalo', 'Rodriguez', 13, 2, 4),
(64, 'Norberto', 'Neto', 11, 1, 4),
(65, 'Nenad', 'Tomovic', 9, 2, 4),
(66, 'Gianpaolo', 'Pazzini', 20, 4, 3),
(67, 'Philipe', 'Mexes', 17, 2, 3),
(68, 'Stephan ', 'El Shaarawi', 26, 4, 3),
(69, 'Kesuke', 'Honda', 20, 3, 3),
(70, 'Christian', 'Abbiati', 13, 1, 3),
(71, 'Ricardo', 'Kaka', 29, 3, 3),
(72, 'Nigel', 'De Jong', 18, 3, 3),
(73, 'Kevin', 'Konstant', 11, 2, 3),
(74, 'Michael', 'Essien', 10, 3, 3),
(76, 'Mattia', 'De Sciglio', 17, 2, 3),
(77, 'Stefano', 'Mauri', 18, 3, 6),
(78, 'Miroslav', 'Klose', 25, 4, 6),
(79, 'AndrÃ¨', 'Dias', 15, 2, 6),
(80, 'Giuseppe', 'Biava', 12, 2, 6),
(81, 'Cristian', 'Ledesma', 16, 3, 6),
(82, 'Abdoulay', 'Konko', 15, 2, 6),
(83, 'Senad', 'Lulic', 21, 3, 6),
(84, 'Pedro', 'Cavanda', 14, 2, 6),
(85, 'Rolando', 'Bianchi', 18, 4, 12),
(86, 'Mattia', 'Perin', 12, 1, 16),
(87, 'Marco', 'Motta', 15, 2, 16),
(88, 'Fredy', 'Guarin', 22, 3, 8),
(89, 'Antonio', 'Di Natale', 28, 4, 5),
(90, 'Massimo', 'Donati', 11, 3, 17),
(91, 'Mattia', 'Destro', 21, 4, 7),
(92, 'Raja', 'Nainggolan', 18, 3, 7),
(93, 'Daniele', 'De Rossi', 17, 3, 7),
(94, 'Marco', 'Borriello', 15, 4, 7),
(95, 'Leandro', 'Castan', 16, 2, 7),
(96, 'Miralem', 'Pjanic', 21, 3, 7),
(97, 'Federico', 'Balzaretti', 14, 2, 7),
(98, 'Alessandro', 'Florenzi', 23, 3, 7),
(99, 'Adem', 'Ljajic', 23, 3, 7),
(100, 'Kevin', 'Strootman', 18, 3, 7),
(101, 'Ugo', 'Campagnaro', 12, 2, 8),
(102, 'Yuto', 'Nagatomo', 14, 2, 8),
(103, 'Esteban', 'Cambiasso', 18, 3, 8),
(104, 'Javier', 'Zanetti', 18, 3, 8),
(105, 'Juan', 'Jesus', 16, 2, 8),
(106, 'Walter', 'Samuel', 15, 2, 8),
(107, 'Diego', 'Milito', 26, 4, 8),
(108, 'Rodrigo', 'Palacio', 27, 4, 8),
(109, 'Andrea', 'Consigli', 14, 1, 21),
(110, 'Davide', 'Brivio', 17, 2, 21),
(111, 'Stefano', 'Lucchini', 8, 2, 21),
(112, 'Guglielmo', 'Stendardo', 12, 2, 21),
(113, 'Cristiano', 'Del Grosso', 9, 2, 21),
(114, 'Mario', 'Yepes', 11, 2, 21),
(115, 'Franco', 'Brienza', 12, 3, 21),
(116, 'Riccardo', 'Cazzola', 6, 3, 21),
(117, 'Marcelo', 'Estigarribia', 10, 3, 21),
(118, 'Luca ', 'Cigarini', 13, 3, 21),
(119, 'Giulio', 'Migliaccio', 9, 3, 21),
(120, 'Maxi', 'Moralez', 14, 3, 21),
(121, 'German', 'Denis', 18, 4, 21),
(122, 'Marko', 'Livaja', 11, 4, 21),
(123, 'Vlada', 'Avramov', 8, 1, 20),
(124, 'Davide', 'Astori', 10, 2, 20),
(125, 'Nicola', 'Murru', 10, 2, 20),
(126, 'Gabriele', 'Perico', 8, 2, 20),
(127, 'Francesco ', 'Pisano', 8, 2, 20),
(128, 'Luca', 'Rossettini', 6, 2, 20),
(129, 'Daniele', 'Conti', 12, 3, 20),
(130, 'Andrea', 'Cossu', 14, 3, 20),
(131, 'Albin', 'Ekdal', 13, 3, 20),
(132, 'Daniele', 'Dessena', 9, 3, 20),
(133, 'Mauricio', 'Pinilla', 17, 4, 20),
(134, 'Marco', 'Sau', 15, 4, 20),
(135, 'Victor', 'Ibarbo', 15, 4, 20),
(136, 'Andrade', 'Rafael', 8, 1, 17),
(137, 'Alessandro', 'Agostini', 10, 2, 17),
(138, 'Maurizio', 'Cacciatore', 9, 2, 17),
(139, 'Domenico', 'Maietta', 8, 2, 17),
(140, 'Evangelos', 'Moras', 7, 2, 17),
(141, 'Marco', 'Donadel', 6, 3, 17),
(142, 'Bosko', 'Jankovic', 12, 3, 17),
(143, 'Emil', 'Halfredsson', 10, 3, 17),
(144, 'Orestes', 'Romulo', 10, 3, 17),
(145, 'Luca', 'Toni', 17, 4, 17),
(146, 'Juan Manuel', 'Iturbe', 10, 4, 17),
(147, 'Juanito', 'Gomez', 9, 4, 17),
(148, 'Antonio', 'Mirante', 10, 1, 10),
(149, 'Mattia', 'Cassani', 10, 2, 10),
(150, 'Massino', 'Gobbi', 8, 2, 10),
(151, 'Christian', 'Molinaro', 8, 2, 10),
(152, 'Gabriel', 'Paletta', 9, 2, 10),
(153, 'Marco', 'Parolo', 15, 3, 10),
(154, 'Gianni', 'Munari', 8, 3, 10),
(155, 'Daniele', 'Galloppa', 7, 3, 10),
(156, 'Ezequiel', 'Schelotto', 12, 3, 10),
(157, 'Antonio', 'Cassano', 18, 4, 10),
(158, 'Nicola', 'Pozzi', 8, 4, 10),
(159, 'Carvalho', 'Amauri', 15, 4, 10),
(160, 'Johnatan', 'Biabiany', 13, 4, 10),
(161, 'Daniele', 'Padelli', 8, 1, 15),
(162, 'Jean', 'Gillet', 10, 1, 15),
(163, 'Cesare', 'Bovo', 10, 2, 15),
(164, 'Matteo', 'Darmian', 8, 2, 15),
(165, 'Salvatore', 'Masiello', 7, 2, 15),
(166, 'Emiliano', 'Moretti', 7, 2, 15),
(167, 'Giovanni', 'Pasquale', 5, 2, 15),
(168, 'Kamil', 'Glik', 9, 2, 15),
(169, 'Alessio', 'Cerci', 15, 3, 15),
(170, 'Jasmin', 'Kurtic', 10, 3, 15),
(171, 'Giuseppe', 'Vives', 8, 3, 15),
(172, 'Alessandro', 'Gazzi', 7, 3, 15),
(173, 'Ciro', 'Immobile', 12, 4, 15),
(174, 'Riccardo', 'Meggiorini', 8, 4, 15),
(175, 'Marcelo', 'Larrondo', 9, 4, 15),
(176, 'Paulo Victor', 'Barreto', 10, 4, 15),
(177, 'Gianluca', 'Curci', 9, 1, 12),
(178, 'Marek', 'Cech', 6, 2, 12),
(179, 'Andrea', 'Mantovani', 8, 2, 12),
(180, 'Archimede', 'Morleo', 8, 2, 12),
(181, 'Cesare', 'Natali', 9, 2, 12),
(182, 'Frederik', 'Sorensen', 9, 2, 12),
(183, 'Francesco', 'Della Rocca', 9, 3, 12),
(184, 'Michele', 'Pazienza', 9, 3, 12),
(185, 'Diego', 'Perez', 10, 3, 12),
(186, 'Barreto', 'Ibson', 7, 3, 12),
(187, 'Davide', 'Moscardelli', 8, 4, 12),
(188, 'Johnatan', 'Cristaldo', 9, 4, 12),
(189, 'Mariano', 'Andujar', 9, 1, 9),
(190, 'Gino', 'Peruzzi', 9, 2, 9),
(191, 'Federico', 'Spolli', 8, 2, 9),
(192, 'Giuseppe', 'Bellusci', 7, 2, 9),
(193, 'Alexis', 'Rolin', 6, 2, 9),
(194, 'Sergio', 'Almiron', 9, 3, 9),
(195, 'Francesco', 'Lodi', 10, 3, 9),
(196, 'Mariano', 'Izco', 8, 3, 9),
(197, 'Pablos', 'Barrientos', 9, 3, 9),
(198, 'Lucas', 'Castro', 7, 3, 9),
(199, 'Gonzalo', 'Berghessio', 10, 4, 9),
(200, 'Bruno', 'Petkovic', 6, 4, 9),
(201, 'Christian', 'Puggioni', 8, 1, 11),
(202, 'Michele', 'Canini', 7, 2, 11),
(203, 'Dario', 'Dainelli', 8, 2, 11),
(204, 'Matteo', 'Rubin', 5, 2, 11),
(205, 'Gennaro', 'Sardo', 7, 2, 11),
(206, 'Simone', 'Bentivoglio', 7, 3, 11),
(207, 'Roberto', 'Guana', 6, 3, 11),
(208, 'Ivan', 'Radovanovic', 7, 3, 11),
(209, 'Luca', 'Rigoni', 8, 3, 11),
(210, 'Victor', 'Obinna', 9, 4, 11),
(211, 'Alberto', 'Paloschi', 11, 4, 11),
(212, 'Sergio', 'Pellissier', 11, 4, 11),
(213, 'Stefan', 'Savic', 9, 2, 4),
(214, 'Massimo', 'Ambrosini', 7, 3, 4),
(215, 'Alessandro', 'Matri', 15, 4, 4),
(216, 'Giuseppe', 'Rossi', 18, 4, 4),
(217, 'Paolo', 'De Ceglie', 10, 2, 16),
(218, 'Luca', 'Antonelli', 9, 2, 16),
(219, 'Luca ', 'Antonini', 10, 2, 16),
(220, 'Alessandro', 'Gamberini', 10, 2, 16),
(221, 'Daniele', 'Portanova', 9, 2, 16),
(222, 'Andrea', 'Bertolacci', 10, 3, 16),
(223, 'Francelino', 'Matulazem', 8, 3, 16),
(224, 'Juraj', 'Kucka', 11, 3, 16),
(225, 'Giuseppe', 'Sculli', 8, 4, 16),
(226, 'Federico', 'Marchetti', 12, 1, 6),
(227, 'Michael', 'Ciani', 9, 2, 6),
(228, 'Brayan', 'Perea', 8, 4, 6),
(229, 'Balde', 'Keyta', 9, 4, 6),
(230, 'Francesco', 'Bardi', 8, 1, 19),
(231, 'Paolo', 'Castellini', 9, 2, 19),
(232, 'Andrea', 'Coda', 8, 2, 19),
(233, 'Ramos', 'Emerson', 7, 2, 19),
(234, 'Giuseppe', 'Gemiti', 8, 2, 19),
(235, 'Leandro', 'Rinaudo', 8, 2, 19),
(236, 'Andrea', 'Luci', 9, 3, 19),
(237, 'Leandro', 'Greco', 10, 3, 19),
(238, 'Marco', 'Benassi', 8, 3, 19),
(239, 'Marco', 'Biagianti', 9, 3, 19),
(240, 'Luca', 'Siligardi', 10, 4, 19),
(241, 'Sergio', 'Paulinho', 13, 4, 19),
(242, 'Innocent', 'Emeghara', 11, 4, 19),
(243, 'Angelo', 'Da Cosa', 8, 1, 13),
(244, 'Angelo', 'Fiorillo', 6, 1, 13),
(245, 'Andrea', 'Costa', 8, 2, 13),
(246, 'Lorenzo', 'De Silvestri', 9, 2, 13),
(247, 'Daniele', 'Gastaldello', 10, 2, 13),
(248, 'Gaetano', 'Berardi', 6, 2, 13),
(249, 'Alessio', 'Sestu', 11, 3, 13),
(250, 'Roberto', 'Soriano', 10, 3, 13),
(251, 'Angelo', 'Palombo', 9, 3, 13),
(252, 'Manolo', 'Gabbiadini', 15, 4, 13),
(253, 'Gianluca', 'Sansone', 10, 4, 13),
(254, 'Martins', 'Eder', 15, 4, 13),
(255, 'Simone', 'Scuffet', 1, 1, 5),
(256, 'Danilo', 'D''Ambrosio', 12, 2, 8),
(257, 'Dusan', 'Basta', 1, 2, 5),
(258, 'Maurizio', 'Domizzi', 10, 2, 5),
(259, 'Edinaldo', 'Naldo', 12, 2, 5),
(260, 'Silvan', 'Widmer', 8, 2, 5),
(261, 'Gabriel', 'Silva', 12, 2, 5),
(262, 'Andrea', 'Lazzari', 14, 3, 5),
(263, 'Alexander', 'Merkel', 8, 3, 5),
(264, 'Gianpiero', 'Pinzi', 9, 3, 5),
(265, 'Roberto', 'Pereyra', 11, 3, 5),
(266, 'Bruno', 'Fernandes', 9, 3, 5),
(267, 'Luis', 'Muriel', 16, 4, 5),
(268, 'Simone', 'Zaza', 14, 4, 18),
(269, 'Lorenzo', 'Ariaudo', 9, 2, 18),
(270, 'Francesco', 'Acerbi', 10, 2, 18),
(271, 'Emanuele', 'Terranova', 8, 2, 18),
(272, 'Reto', 'Ziegler', 9, 2, 18),
(273, 'Aleandro', 'Rosi', 9, 2, 18),
(274, 'Davide', 'Biondini', 11, 3, 18),
(275, 'Matteo', 'Brighi', 9, 3, 18),
(276, 'Domenico', 'Berardi', 18, 4, 18),
(277, 'Sergio', 'Floccari', 15, 4, 18),
(278, 'Antonio', 'Floro Flores', 19, 4, 18),
(279, 'Simone', 'Missiroli', 10, 3, 18),
(280, 'Andrea', 'Barzagli', 14, 2, 1),
(281, 'Fernando', 'Llorente', 21, 4, 1),
(282, 'Stephan', 'Lichsteiner', 17, 2, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `giornate`
--

CREATE TABLE IF NOT EXISTS `giornate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `lega` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lega` (`lega`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dump dei dati per la tabella `giornate`
--

INSERT INTO `giornate` (`id`, `numero`, `lega`) VALUES
(49, 1, 20),
(50, 2, 20),
(51, 3, 20),
(52, 4, 20),
(53, 5, 20),
(54, 6, 20),
(55, 7, 20),
(56, 8, 20),
(57, 9, 20);

-- --------------------------------------------------------

--
-- Struttura della tabella `gruppi`
--

CREATE TABLE IF NOT EXISTS `gruppi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `gruppi`
--

INSERT INTO `gruppi` (`id`, `nome`) VALUES
(1, 'admin'),
(2, 'lega_admin'),
(3, 'user'),
(4, 'anonimo');

-- --------------------------------------------------------

--
-- Struttura della tabella `inviti`
--

CREATE TABLE IF NOT EXISTS `inviti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invitante` int(11) NOT NULL,
  `invitato` int(11) NOT NULL,
  `lega` int(11) NOT NULL,
  `codice` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invitante` (`invitante`),
  KEY `invitato` (`invitato`),
  KEY `lega` (`lega`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `inviti`
--

INSERT INTO `inviti` (`id`, `invitante`, `invitato`, `lega`, `codice`) VALUES
(1, 22, 12, 25, 'a27ae0e1dcb64e7cf36901d20ed145780168fbc4');

-- --------------------------------------------------------

--
-- Struttura della tabella `leghe`
--

CREATE TABLE IF NOT EXISTS `leghe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `partecipanti` int(11) NOT NULL,
  `regolamento` int(11) NOT NULL,
  `inizio` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `regolamento` (`regolamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dump dei dati per la tabella `leghe`
--

INSERT INTO `leghe` (`id`, `nome`, `partecipanti`, `regolamento`, `inizio`) VALUES
(20, 'Lega personale 1', 3, 1, 0),
(21, 'Lega Basciano', 4, 1, 4),
(22, 'Lega Villa Mosca', 4, 1, 4),
(23, '000000000', 3, 1, 4),
(24, 'Fantaweb', 1000, 1, 0),
(25, 'Fanta Specola', 2, 1, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `moduli`
--

CREATE TABLE IF NOT EXISTS `moduli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portieri` int(11) NOT NULL,
  `difensori` int(11) NOT NULL,
  `centrocampisti` int(11) NOT NULL,
  `attaccanti` int(11) NOT NULL,
  `portieri_riserve` int(11) NOT NULL,
  `difensori_riserve` int(11) NOT NULL,
  `centrocampisti_riserve` int(11) NOT NULL,
  `attaccanti_riserve` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `moduli`
--

INSERT INTO `moduli` (`id`, `portieri`, `difensori`, `centrocampisti`, `attaccanti`, `portieri_riserve`, `difensori_riserve`, `centrocampisti_riserve`, `attaccanti_riserve`) VALUES
(1, 1, 4, 4, 2, 1, 2, 2, 2),
(2, 1, 3, 4, 3, 1, 2, 2, 2),
(3, 1, 5, 4, 1, 1, 2, 2, 2),
(4, 1, 4, 5, 1, 1, 2, 2, 2),
(5, 1, 4, 3, 3, 1, 2, 2, 2),
(6, 1, 5, 3, 2, 1, 2, 2, 2),
(7, 1, 3, 5, 2, 1, 2, 2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipazioni`
--

CREATE TABLE IF NOT EXISTS `partecipazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utente` int(11) NOT NULL,
  `lega` int(11) NOT NULL,
  `rosa` int(11) DEFAULT NULL,
  `ruolo` int(11) NOT NULL,
  `punteggio_totale` decimal(10,2) DEFAULT NULL,
  `punteggio_classifica` int(11) DEFAULT NULL,
  `gol_fatti` int(11) DEFAULT NULL,
  `gol_subiti` int(11) DEFAULT NULL,
  `partite_giocate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `partecipazione` (`utente`,`lega`,`rosa`),
  KEY `utente` (`utente`),
  KEY `rosa` (`rosa`),
  KEY `ruolo` (`ruolo`),
  KEY `lega` (`lega`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dump dei dati per la tabella `partecipazioni`
--

INSERT INTO `partecipazioni` (`id`, `utente`, `lega`, `rosa`, `ruolo`, `punteggio_totale`, `punteggio_classifica`, `gol_fatti`, `gol_subiti`, `partite_giocate`) VALUES
(16, 8, 20, 13, 2, 76.00, 1, 2, 2, NULL),
(17, 13, 20, 15, 3, 76.50, 2, 2, 2, 1),
(18, 12, 20, 14, 3, 0.00, 1, 0, 0, 1),
(19, 14, 21, 16, 2, NULL, NULL, NULL, NULL, NULL),
(20, 12, 21, NULL, 3, NULL, NULL, NULL, NULL, NULL),
(21, 15, 22, 17, 2, NULL, NULL, NULL, NULL, NULL),
(22, 12, 22, NULL, 3, NULL, NULL, NULL, NULL, NULL),
(23, 16, 23, NULL, 2, NULL, NULL, NULL, NULL, NULL),
(24, 22, 25, 18, 2, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `partite`
--

CREATE TABLE IF NOT EXISTS `partite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `squadra_casa` int(11) DEFAULT NULL,
  `formazione_casa` int(11) NOT NULL,
  `squadra_trasferta` int(11) DEFAULT NULL,
  `formazione_trasferta` int(11) NOT NULL,
  `punteggio_casa` decimal(10,2) DEFAULT NULL,
  `gol_casa` int(11) DEFAULT NULL,
  `punteggio_trasferta` decimal(10,2) DEFAULT NULL,
  `gol_trasferta` int(11) DEFAULT NULL,
  `giornata` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `casa` (`squadra_casa`),
  KEY `giornata` (`giornata`),
  KEY `trasferta` (`squadra_trasferta`),
  KEY `formazione_casa` (`formazione_casa`),
  KEY `formazione_trasferta` (`formazione_trasferta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dump dei dati per la tabella `partite`
--

INSERT INTO `partite` (`id`, `squadra_casa`, `formazione_casa`, `squadra_trasferta`, `formazione_trasferta`, `punteggio_casa`, `gol_casa`, `punteggio_trasferta`, `gol_trasferta`, `giornata`) VALUES
(73, NULL, 0, 13, 0, NULL, NULL, NULL, NULL, 49),
(74, 15, 0, 14, 0, NULL, NULL, NULL, NULL, 49),
(75, 13, 0, 14, 0, NULL, NULL, NULL, NULL, 50),
(76, 15, 0, NULL, 0, NULL, NULL, NULL, NULL, 50),
(77, 15, 0, 13, 0, 76.50, 2, 76.00, 2, 51),
(78, 14, 0, NULL, 0, NULL, NULL, NULL, NULL, 51),
(79, NULL, 0, 13, 0, NULL, NULL, NULL, NULL, 52),
(80, 15, 0, 14, 0, NULL, NULL, NULL, NULL, 52),
(81, 13, 0, 14, 0, NULL, NULL, NULL, NULL, 53),
(82, 15, 0, NULL, 0, NULL, NULL, NULL, NULL, 53),
(83, 15, 0, 13, 0, NULL, NULL, NULL, NULL, 54),
(84, 14, 0, NULL, 0, NULL, NULL, NULL, NULL, 54),
(85, NULL, 0, 13, 0, NULL, NULL, NULL, NULL, 55),
(86, 15, 0, 14, 0, NULL, NULL, NULL, NULL, 55),
(87, 13, 0, 14, 0, NULL, NULL, NULL, NULL, 56),
(88, 15, 0, NULL, 0, NULL, NULL, NULL, NULL, 56),
(89, 15, 0, 13, 0, NULL, NULL, NULL, NULL, 57),
(90, 14, 0, NULL, 0, NULL, NULL, NULL, NULL, 57);

-- --------------------------------------------------------

--
-- Struttura della tabella `partite_serie_a`
--

CREATE TABLE IF NOT EXISTS `partite_serie_a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `squadra_casa` int(11) NOT NULL,
  `squadra_trasferta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `partita` (`squadra_casa`,`squadra_trasferta`),
  KEY `casa` (`squadra_casa`),
  KEY `trasferta` (`squadra_trasferta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dump dei dati per la tabella `partite_serie_a`
--

INSERT INTO `partite_serie_a` (`id`, `squadra_casa`, `squadra_trasferta`) VALUES
(11, 3, 1),
(8, 4, 6),
(12, 7, 8),
(14, 15, 13),
(9, 16, 9),
(15, 17, 12),
(13, 18, 10),
(10, 19, 2),
(7, 20, 5),
(6, 21, 11);

-- --------------------------------------------------------

--
-- Struttura della tabella `permessi`
--

CREATE TABLE IF NOT EXISTS `permessi` (
  `servizio` int(11) NOT NULL,
  `gruppo` int(11) NOT NULL,
  PRIMARY KEY (`servizio`,`gruppo`),
  KEY `gruppo` (`gruppo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `permessi`
--

INSERT INTO `permessi` (`servizio`, `gruppo`) VALUES
(4, 1),
(5, 1),
(6, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(17, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(1, 4),
(3, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `probabili_formazioni`
--

CREATE TABLE IF NOT EXISTS `probabili_formazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `giocatore` int(11) NOT NULL,
  `squadra` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=263 ;

--
-- Dump dei dati per la tabella `probabili_formazioni`
--

INSERT INTO `probabili_formazioni` (`id`, `giocatore`, `squadra`) VALUES
(43, 70, 3),
(44, 76, 3),
(45, 29, 3),
(46, 67, 3),
(47, 73, 3),
(48, 74, 3),
(49, 72, 3),
(50, 71, 3),
(51, 69, 3),
(52, 66, 3),
(53, 41, 3),
(54, 109, 21),
(55, 113, 21),
(56, 110, 21),
(57, 111, 21),
(58, 112, 21),
(59, 120, 21),
(60, 22, 21),
(61, 118, 21),
(62, 117, 21),
(63, 121, 21),
(64, 122, 21),
(65, 123, 20),
(66, 124, 20),
(67, 125, 20),
(68, 126, 20),
(69, 127, 20),
(70, 132, 20),
(71, 131, 20),
(72, 130, 20),
(73, 129, 20),
(74, 134, 20),
(75, 135, 20),
(76, 148, 10),
(77, 30, 10),
(78, 149, 10),
(79, 150, 10),
(80, 152, 10),
(81, 156, 10),
(82, 153, 10),
(83, 37, 10),
(84, 157, 10),
(85, 159, 10),
(86, 160, 10),
(87, 136, 17),
(88, 137, 17),
(89, 138, 17),
(90, 139, 17),
(91, 140, 17),
(92, 90, 17),
(93, 144, 17),
(94, 142, 17),
(95, 145, 17),
(96, 146, 17),
(97, 147, 17),
(98, 161, 15),
(99, 168, 15),
(100, 166, 15),
(101, 165, 15),
(102, 164, 15),
(103, 171, 15),
(104, 170, 15),
(105, 169, 15),
(106, 173, 15),
(107, 175, 15),
(108, 176, 15),
(109, 177, 12),
(110, 182, 12),
(111, 181, 12),
(112, 180, 12),
(113, 179, 12),
(114, 178, 12),
(115, 184, 12),
(116, 185, 12),
(117, 187, 12),
(118, 85, 12),
(119, 188, 12),
(120, 14, 8),
(121, 106, 8),
(122, 42, 8),
(123, 105, 8),
(124, 101, 8),
(125, 102, 8),
(126, 104, 8),
(127, 103, 8),
(128, 88, 8),
(129, 107, 8),
(130, 108, 8),
(131, 36, 7),
(132, 97, 7),
(133, 95, 7),
(134, 96, 7),
(135, 98, 7),
(136, 93, 7),
(137, 92, 7),
(138, 99, 7),
(139, 100, 7),
(140, 91, 7),
(141, 20, 7),
(142, 189, 9),
(143, 27, 9),
(144, 190, 9),
(145, 191, 9),
(146, 192, 9),
(147, 198, 9),
(148, 197, 9),
(149, 196, 9),
(150, 195, 9),
(151, 194, 9),
(152, 199, 9),
(153, 28, 11),
(154, 202, 11),
(155, 203, 11),
(156, 204, 11),
(157, 205, 11),
(158, 209, 11),
(159, 208, 11),
(160, 207, 11),
(161, 206, 11),
(162, 211, 11),
(163, 212, 11),
(164, 64, 4),
(165, 63, 4),
(166, 43, 4),
(167, 65, 4),
(168, 61, 4),
(169, 26, 4),
(170, 62, 4),
(171, 60, 4),
(172, 59, 4),
(173, 58, 4),
(174, 216, 4),
(175, 86, 16),
(176, 219, 16),
(177, 221, 16),
(178, 220, 16),
(179, 218, 16),
(180, 217, 16),
(181, 224, 16),
(182, 222, 16),
(183, 223, 16),
(184, 25, 16),
(185, 225, 16),
(186, 226, 6),
(187, 82, 6),
(188, 227, 6),
(189, 79, 6),
(190, 84, 6),
(191, 83, 6),
(192, 24, 6),
(193, 81, 6),
(194, 77, 6),
(195, 78, 6),
(196, 229, 6),
(197, 45, 2),
(198, 55, 2),
(199, 46, 2),
(200, 54, 2),
(201, 52, 2),
(202, 51, 2),
(203, 49, 2),
(204, 44, 2),
(205, 48, 2),
(206, 53, 2),
(207, 47, 2),
(208, 230, 19),
(209, 231, 19),
(210, 232, 19),
(211, 233, 19),
(212, 234, 19),
(213, 238, 19),
(214, 237, 19),
(215, 236, 19),
(216, 240, 19),
(217, 241, 19),
(218, 242, 19),
(219, 243, 13),
(220, 248, 13),
(221, 245, 13),
(222, 246, 13),
(223, 247, 13),
(224, 251, 13),
(225, 250, 13),
(226, 249, 13),
(227, 21, 13),
(228, 252, 13),
(229, 254, 13),
(230, 255, 5),
(231, 261, 5),
(232, 259, 5),
(233, 258, 5),
(234, 257, 5),
(235, 266, 5),
(236, 262, 5),
(237, 264, 5),
(238, 265, 5),
(239, 89, 5),
(240, 267, 5),
(241, 1, 1),
(242, 280, 1),
(243, 282, 1),
(244, 4, 1),
(245, 3, 1),
(246, 5, 1),
(247, 39, 1),
(248, 57, 1),
(249, 38, 1),
(250, 18, 1),
(251, 281, 1),
(252, 17, 18),
(253, 272, 18),
(254, 31, 18),
(255, 269, 18),
(256, 270, 18),
(257, 273, 18),
(258, 275, 18),
(259, 274, 18),
(260, 11, 18),
(261, 276, 18),
(262, 278, 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `regole`
--

CREATE TABLE IF NOT EXISTS `regole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gol_fatto` decimal(10,2) NOT NULL DEFAULT '3.00',
  `gol_subito` decimal(10,2) NOT NULL DEFAULT '-1.00',
  `assist` decimal(10,2) NOT NULL DEFAULT '1.00',
  `autogol` decimal(10,2) NOT NULL DEFAULT '-3.00',
  `ammonizione` decimal(10,2) NOT NULL DEFAULT '0.50',
  `espulsione` decimal(10,2) NOT NULL DEFAULT '1.00',
  `rigore_sbagliato` decimal(10,2) NOT NULL DEFAULT '-3.00',
  `rigore_parato` decimal(10,2) NOT NULL DEFAULT '3.00',
  `gol_partita` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gol_pareggio` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `regole`
--

INSERT INTO `regole` (`id`, `gol_fatto`, `gol_subito`, `assist`, `autogol`, `ammonizione`, `espulsione`, `rigore_sbagliato`, `rigore_parato`, `gol_partita`, `gol_pareggio`) VALUES
(1, 3.00, -1.00, 1.00, -3.00, -0.50, -1.00, -3.00, 3.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `rose`
--

CREATE TABLE IF NOT EXISTS `rose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dump dei dati per la tabella `rose`
--

INSERT INTO `rose` (`id`, `nome`) VALUES
(13, 'Rosa 1'),
(14, 'Rosa 2'),
(15, 'Rosa 3'),
(16, 'Contrada cretone'),
(17, 'Rosa marco'),
(18, 'Francesco FC');

-- --------------------------------------------------------

--
-- Struttura della tabella `ruoli`
--

CREATE TABLE IF NOT EXISTS `ruoli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(3) NOT NULL,
  `descrizione` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `ruoli`
--

INSERT INTO `ruoli` (`id`, `nome`, `descrizione`) VALUES
(1, 'por', 'Portiere'),
(2, 'dif', 'Difensore'),
(3, 'cen', 'Centrocampista'),
(4, 'att', 'Attaccante');

-- --------------------------------------------------------

--
-- Struttura della tabella `serie_a`
--

CREATE TABLE IF NOT EXISTS `serie_a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `giornate` int(11) NOT NULL,
  `giornata` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `serie_a`
--

INSERT INTO `serie_a` (`id`, `giornate`, `giornata`) VALUES
(1, 38, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `servizi`
--

CREATE TABLE IF NOT EXISTS `servizi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `azione` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dump dei dati per la tabella `servizi`
--

INSERT INTO `servizi` (`id`, `nome`, `azione`) VALUES
(1, 'Iscrizione utente Start', 'subscription_start.php'),
(3, 'Iscrizione utente', 'subscription.php'),
(4, 'Home admin', 'admin/administration.php'),
(5, 'Servizi', 'admin/services.php'),
(6, 'Servizi CRUD', 'admin/serviceform.php'),
(8, 'Giocatori CRUD', 'admin/playerform.php'),
(9, 'Squadre', 'admin/teams.php'),
(10, 'Squadre CRUD', 'admin/teamform.php'),
(11, 'Utenti', 'admin/users.php'),
(12, 'Utenti CRUD', 'admin/userform.php'),
(17, 'Giocatori', 'admin/players.php'),
(21, 'Crea/Modifica lega start', 'user/league_start.php'),
(22, 'Crea/Modifica lega submit', 'user/league_submit.php'),
(23, 'Lega views', 'user/league.php'),
(24, 'Invito invia', 'user/sendInvite.php'),
(25, 'Invito accetta', 'user/acceptInvite.php'),
(26, 'Invito rimuovi', 'user/removeInvite.php');

-- --------------------------------------------------------

--
-- Struttura della tabella `squadre`
--

CREATE TABLE IF NOT EXISTS `squadre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dump dei dati per la tabella `squadre`
--

INSERT INTO `squadre` (`id`, `nome`) VALUES
(1, 'Juventus'),
(2, 'Napoli'),
(3, 'Milan'),
(4, 'Fiorentina'),
(5, 'Udinese'),
(6, 'Lazio'),
(7, 'Roma'),
(8, 'Inter'),
(9, 'Catania'),
(10, 'Parma'),
(11, 'Chievo'),
(12, 'Bologna'),
(13, 'Sampdoria'),
(15, 'Torino'),
(16, 'Genoa'),
(17, 'Verona'),
(18, 'Sassuolo'),
(19, 'Livorno'),
(20, 'Cagliari'),
(21, 'Atalanta');

-- --------------------------------------------------------

--
-- Struttura della tabella `statistiche`
--

CREATE TABLE IF NOT EXISTS `statistiche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `giocatore` int(11) NOT NULL,
  `presenze` int(11) DEFAULT NULL,
  `media` decimal(10,2) DEFAULT NULL,
  `gol_fatti` int(11) DEFAULT NULL,
  `gol_subiti` int(11) DEFAULT NULL,
  `ammonizioni` int(11) DEFAULT NULL,
  `espulsioni` int(11) DEFAULT NULL,
  `tot_assist` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `giocatore` (`giocatore`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `statistiche`
--

INSERT INTO `statistiche` (`id`, `giocatore`, `presenze`, `media`, `gol_fatti`, `gol_subiti`, `ammonizioni`, `espulsioni`, `tot_assist`) VALUES
(1, 1, 3, 6.33, 2, 1, 1, 2, 1),
(2, 3, 3, 6.33, 2, 1, 1, 2, 1),
(3, 4, 3, 6.33, 2, 1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `gruppo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `ruolo` (`gruppo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `email`, `password`, `nome`, `cognome`, `gruppo`) VALUES
(1, 'ds5787', 'danielesimonetti@msn.com', 'a1f72795bdc5f8dbc8168954d22e01c6', 'Daniele', 'Simonetti', 1),
(8, 'dasi5787', 'danielesimonetti@msn.it', 'dasi5787', 'Daniele', 'Simonetti', 3),
(11, '123456', 'fabio@fabio.it', '12345678', 'Fabio', 'Quagliarella', 3),
(12, '654321', 'daniele.simonetti87@gmail.com', '87654321', 'Alfredo', 'Paponchio', 3),
(13, 'antonio', 'ds5787@alice.it', 'e49679bcb49822b1f04b5544d29d7a47', 'Antonio', 'Antioni', 3),
(14, 'vanessa', 'vanemarrone@alice.it', 'vanessa88', 'Franco', 'Trentalance', 3),
(15, 'marcomarco', 'marco.dd23@gmail.com', 'daf76fc3dccc65ab231599f937dced29', 'Marco', 'Di Dionisio', 3),
(16, '000000', 'fracon@kiki.it', '00000000', 'Giacono', 'Santonio', 3),
(19, 'aldoaldo', 'aldo@aldo.it', 'd2788df2297119e03df191cea2afacd9', 'aldo', 'aldo', 3),
(21, 'aaaaaa', 'gigi@gigi.it', '3dbe00a167653a1aaee01d93e77e730e', 'Ff', 'ff', 3),
(22, '1234567', 'domfas@vafvd.it', '25d55ad283aa400af464c76d713c07ad', 'Francesco', 'Di Marco', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `voti`
--

CREATE TABLE IF NOT EXISTS `voti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `giocatore` int(11) NOT NULL,
  `giornata` int(11) NOT NULL,
  `voto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gol_fatto` int(11) NOT NULL DEFAULT '0',
  `gol_subito` int(11) NOT NULL DEFAULT '0',
  `assist` int(11) NOT NULL DEFAULT '0',
  `autogol` int(11) NOT NULL DEFAULT '0',
  `ammonizione` tinyint(1) NOT NULL DEFAULT '0',
  `espulsione` tinyint(1) NOT NULL DEFAULT '0',
  `rigore_parato` int(11) NOT NULL DEFAULT '0',
  `rigore_sbagliato` int(11) NOT NULL DEFAULT '0',
  `gol_partita` tinyint(1) NOT NULL DEFAULT '0',
  `gol_pareggio` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `giocatore-giornata` (`giocatore`,`giornata`),
  KEY `giocatore` (`giocatore`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=286 ;

--
-- Dump dei dati per la tabella `voti`
--

INSERT INTO `voti` (`id`, `giocatore`, `giornata`, `voto`, `gol_fatto`, `gol_subito`, `assist`, `autogol`, `ammonizione`, `espulsione`, `rigore_parato`, `rigore_sbagliato`, `gol_partita`, `gol_pareggio`) VALUES
(146, 1, 1, 6.00, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(147, 3, 1, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(148, 4, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(149, 5, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(150, 11, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(151, 12, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(152, 14, 1, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(154, 17, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(155, 18, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(156, 19, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(157, 20, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(158, 21, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(159, 22, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(160, 23, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(161, 24, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(162, 25, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(163, 26, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(164, 27, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(165, 28, 1, 6.00, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(166, 29, 1, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(167, 30, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(168, 31, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(169, 32, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(170, 33, 1, 4.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(171, 34, 1, 6.00, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(172, 35, 1, 6.00, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(173, 36, 1, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(174, 37, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(175, 38, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(176, 39, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(177, 40, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(178, 41, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(179, 42, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(180, 43, 1, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(181, 1, 2, 5.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(182, 3, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(183, 4, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(184, 5, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(185, 11, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(186, 12, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(187, 14, 2, 4.25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(189, 17, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(190, 18, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(191, 19, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(192, 20, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(193, 21, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(194, 22, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(195, 23, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(196, 24, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(197, 25, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(198, 26, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(199, 27, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(200, 28, 2, 7.00, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(201, 29, 2, 8.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(202, 30, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(203, 31, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(204, 32, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(205, 33, 2, 6.00, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0),
(206, 34, 2, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(207, 35, 2, 5.00, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(208, 36, 2, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(209, 37, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(210, 38, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(211, 39, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(212, 40, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(213, 41, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(214, 42, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(215, 43, 2, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(216, 1, 3, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(217, 3, 3, 7.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(218, 4, 3, 10.00, 2, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(219, 5, 3, 9.50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(220, 11, 3, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(221, 12, 3, 3.25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(222, 14, 3, 6.25, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0),
(224, 17, 3, 2.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(225, 18, 3, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(226, 19, 3, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(227, 20, 3, 0.00, 1, 0, 1, 0, 0, 0, 0, 1, 0, 0),
(228, 21, 3, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(229, 22, 3, 4.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(230, 23, 3, 7.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(231, 24, 3, 8.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(232, 25, 3, 8.00, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(233, 26, 3, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(234, 27, 3, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(235, 28, 3, 5.00, 0, 2, 0, 1, 0, 1, 1, 0, 0, 0),
(236, 29, 3, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(237, 30, 3, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(238, 31, 3, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(239, 32, 3, 5.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(240, 33, 3, 8.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(241, 34, 3, 4.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(242, 35, 3, 5.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(243, 36, 3, 6.50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(244, 37, 3, 3.25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(245, 38, 3, 6.00, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0),
(246, 39, 3, 6.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(247, 40, 3, 4.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(248, 41, 3, 8.00, 1, 2, 1, 0, 1, 0, 0, 0, 0, 0),
(249, 42, 3, 4.25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(250, 43, 3, 7.25, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(251, 1, 4, 8.00, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0),
(252, 3, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(253, 4, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(254, 5, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(255, 11, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(256, 12, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(257, 14, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(259, 17, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(260, 18, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(261, 19, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(262, 20, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(263, 21, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(264, 22, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(265, 23, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(266, 24, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(267, 25, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(268, 26, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(269, 27, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(270, 28, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(271, 29, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(272, 30, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(273, 31, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(274, 32, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(275, 33, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(276, 34, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(277, 35, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(278, 36, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(279, 37, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(280, 38, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(281, 39, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(282, 40, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(283, 41, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(284, 42, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(285, 43, 4, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `acquisti`
--
ALTER TABLE `acquisti`
  ADD CONSTRAINT `acquisti_ibfk_1` FOREIGN KEY (`giocatore`) REFERENCES `giocatori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acquisti_ibfk_2` FOREIGN KEY (`rosa`) REFERENCES `rose` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `formazioni`
--
ALTER TABLE `formazioni`
  ADD CONSTRAINT `formazioni_ibfk_1` FOREIGN KEY (`partita`) REFERENCES `partite` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formazioni_ibfk_2` FOREIGN KEY (`giocatore`) REFERENCES `giocatori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formazioni_ibfk_3` FOREIGN KEY (`rosa`) REFERENCES `rose` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `giocatori`
--
ALTER TABLE `giocatori`
  ADD CONSTRAINT `giocatori_ibfk_1` FOREIGN KEY (`ruolo`) REFERENCES `ruoli` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `giocatori_ibfk_2` FOREIGN KEY (`squadra`) REFERENCES `squadre` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `giornate`
--
ALTER TABLE `giornate`
  ADD CONSTRAINT `giornate_ibfk_1` FOREIGN KEY (`lega`) REFERENCES `leghe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `inviti`
--
ALTER TABLE `inviti`
  ADD CONSTRAINT `inviti_ibfk_3` FOREIGN KEY (`lega`) REFERENCES `leghe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inviti_ibfk_4` FOREIGN KEY (`invitante`) REFERENCES `utenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inviti_ibfk_5` FOREIGN KEY (`invitato`) REFERENCES `utenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `leghe`
--
ALTER TABLE `leghe`
  ADD CONSTRAINT `leghe_ibfk_2` FOREIGN KEY (`regolamento`) REFERENCES `regole` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `partecipazioni`
--
ALTER TABLE `partecipazioni`
  ADD CONSTRAINT `partecipazioni_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partecipazioni_ibfk_2` FOREIGN KEY (`lega`) REFERENCES `leghe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partecipazioni_ibfk_3` FOREIGN KEY (`rosa`) REFERENCES `rose` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `partecipazioni_ibfk_4` FOREIGN KEY (`ruolo`) REFERENCES `gruppi` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limiti per la tabella `partite`
--
ALTER TABLE `partite`
  ADD CONSTRAINT `partite_ibfk_3` FOREIGN KEY (`giornata`) REFERENCES `giornate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partite_ibfk_4` FOREIGN KEY (`squadra_casa`) REFERENCES `rose` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `partite_ibfk_5` FOREIGN KEY (`squadra_trasferta`) REFERENCES `rose` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `partite_serie_a`
--
ALTER TABLE `partite_serie_a`
  ADD CONSTRAINT `partite_serie_a_ibfk_1` FOREIGN KEY (`squadra_casa`) REFERENCES `squadre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partite_serie_a_ibfk_2` FOREIGN KEY (`squadra_trasferta`) REFERENCES `squadre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `permessi`
--
ALTER TABLE `permessi`
  ADD CONSTRAINT `permessi_ibfk_3` FOREIGN KEY (`servizio`) REFERENCES `servizi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permessi_ibfk_4` FOREIGN KEY (`gruppo`) REFERENCES `gruppi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `statistiche`
--
ALTER TABLE `statistiche`
  ADD CONSTRAINT `statistiche_ibfk_1` FOREIGN KEY (`giocatore`) REFERENCES `giocatori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `utenti_ibfk_1` FOREIGN KEY (`gruppo`) REFERENCES `gruppi` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `voti`
--
ALTER TABLE `voti`
  ADD CONSTRAINT `voti_ibfk_1` FOREIGN KEY (`giocatore`) REFERENCES `giocatori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
