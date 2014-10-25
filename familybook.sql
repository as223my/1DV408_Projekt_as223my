-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 25 okt 2014 kl 16:30
-- Serverversion: 5.6.15-log
-- PHP-version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `a`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `groupID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`groupID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumpning av Data i tabell `group`
--

INSERT INTO `group` (`groupID`, `name`) VALUES
(76, 'Mias grupp'),
(75, 'VÃ¤nner');

-- --------------------------------------------------------

--
-- Tabellstruktur `groupmember`
--

CREATE TABLE IF NOT EXISTS `groupmember` (
  `groupmemberID` int(11) NOT NULL AUTO_INCREMENT,
  `groupID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`groupmemberID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumpning av Data i tabell `groupmember`
--

INSERT INTO `groupmember` (`groupmemberID`, `groupID`, `userID`) VALUES
(78, 75, 37),
(80, 75, 39),
(79, 75, 38),
(81, 76, 38),
(82, 76, 39);

-- --------------------------------------------------------

--
-- Tabellstruktur `stickynote`
--

CREATE TABLE IF NOT EXISTS `stickynote` (
  `stickynoteID` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(400) NOT NULL,
  `time` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`stickynoteID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumpning av Data i tabell `stickynote`
--

INSERT INTO `stickynote` (`stickynoteID`, `text`, `time`, `groupID`, `userID`) VALUES
(67, 'Tenta pÃ¥ fredag!', 1415111273, 75, 39);

-- --------------------------------------------------------

--
-- Tabellstruktur `text`
--

CREATE TABLE IF NOT EXISTS `text` (
  `textID` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(400) NOT NULL,
  `groupID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`textID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=386 ;

--
-- Dumpning av Data i tabell `text`
--

INSERT INTO `text` (`textID`, `text`, `groupID`, `userID`) VALUES
(380, 'Hej allihopa! <br>\r\n<br>\r\n:) ', 75, 39),
(381, 'Hej test! ', 75, 37),
(382, 'Mia?? ', 75, 37),
(383, 'HEJ! ', 75, 38),
(384, 'Hejsan! ', 76, 39),
(385, 'Tjena!! ', 76, 38);

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`userID`, `username`, `password`) VALUES
(39, 'test', '098f6bcd4621d373cade4e832627b4f6'),
(38, 'Mia', 'e10adc3949ba59abbe56e057f20f883e'),
(37, 'Annie', '202cb962ac59075b964b07152d234b70');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
