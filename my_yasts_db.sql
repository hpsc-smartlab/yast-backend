-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2018 alle 16:13
-- Versione del server: 5.6.33-log
-- PHP Version: 5.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_yasts`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `bitwheels`
--

CREATE TABLE IF NOT EXISTS `bitwheels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `bitwheel` int(11) NOT NULL,
  `data_ora` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `corsa`
--

CREATE TABLE IF NOT EXISTS `corsa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indirizzoPasseggero` varchar(500) NOT NULL,
  `indirizzoAutista` varchar(500) NOT NULL,
  `destinazione` varchar(500) NOT NULL,
  `nomePasseggero` varchar(200) NOT NULL,
  `nomeAutista` varchar(200) NOT NULL,
  `esito` int(11) NOT NULL,
  `esitoLetturaPasseggero` int(11) NOT NULL DEFAULT '0',
  `costo` varchar(200) DEFAULT NULL,
  `targa` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(10,8) NOT NULL,
  `indirizzo` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `servizio` int(11) NOT NULL,
  `occupato` int(11) NOT NULL DEFAULT '0',
  `targa` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `regalo`
--

CREATE TABLE IF NOT EXISTS `regalo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `qnt` varchar(100) NOT NULL,
  `giorno` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `rider`
--

CREATE TABLE IF NOT EXISTS `rider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(10,8) NOT NULL,
  `indirizzo` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `servizio` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `riepilogo_corse`
--

CREATE TABLE IF NOT EXISTS `riepilogo_corse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indirizzoPasseggero` varchar(100) NOT NULL,
  `indirizzoAutista` varchar(100) NOT NULL,
  `destinazione` varchar(100) NOT NULL,
  `nomePasseggero` varchar(100) NOT NULL,
  `nomeAutista` varchar(100) NOT NULL,
  `esito` int(11) NOT NULL,
  `feedback` int(11) NOT NULL,
  `buonoOttenuto` int(11) DEFAULT '0',
  `bitwheels` varchar(30) NOT NULL DEFAULT '0',
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `utente` int(11) DEFAULT '0',
  `driver` int(11) NOT NULL DEFAULT '0',
  `path_documento` varchar(500) DEFAULT NULL,
  `path_patente` varchar(500) DEFAULT NULL,
  `targa` varchar(7) DEFAULT NULL,
  `veicolo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
