-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 25 okt 2014 kl 16:18
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumpning av Data i tabell `group`
--

INSERT INTO `group` (`groupID`, `name`) VALUES
(74, 'sds');

-- --------------------------------------------------------

--
-- Tabellstruktur `groupmember`
--

CREATE TABLE IF NOT EXISTS `groupmember` (
  `groupmemberID` int(11) NOT NULL AUTO_INCREMENT,
  `groupID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`groupmemberID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumpning av Data i tabell `groupmember`
--

INSERT INTO `groupmember` (`groupmemberID`, `groupID`, `userID`) VALUES
(77, 74, 37),
(74, 73, 38),
(76, 74, 38),
(72, 72, 38),
(70, 71, 38);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumpning av Data i tabell `stickynote`
--

INSERT INTO `stickynote` (`stickynoteID`, `text`, `time`, `groupID`, `userID`) VALUES
(64, 'egfrghf', 1414182112, 72, 38),
(57, 'sd', 1414179500, 71, 38),
(62, 'vdsdsgdsggdsgds', 1414182099, 72, 38);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=380 ;

--
-- Dumpning av Data i tabell `text`
--

INSERT INTO `text` (`textID`, `text`, `groupID`, `userID`) VALUES
(297, 'dfvsdgshndgs', 72, 38),
(299, 'gdsegsgs<br>\r\n<br>\r\nagdeg<br>\r\nsd<br>\r\ng<br>\r\n', 72, 37),
(295, 'saffsaa', 72, 38),
(288, 'ssd', 72, 37),
(291, 'hej', 72, 37),
(377, 'gdfs fdgbdg', 74, 37),
(378, 'sfdsf<br>\r\ndfasfsdf<br>\r\nfdsaf', 74, 37),
(379, 'jkh', 74, 37);

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`userID`, `username`, `password`) VALUES
(38, 'Mia', 'e10adc3949ba59abbe56e057f20f883e'),
(37, 'Annie', '202cb962ac59075b964b07152d234b70');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
