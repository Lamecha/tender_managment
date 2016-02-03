-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2012 at 03:00 PM
-- Server version: 5.1.50
-- PHP Version: 5.3.9-ZS5.6.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `railway`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

CREATE TABLE IF NOT EXISTS `attachment` (
  `id` int(255) NOT NULL,
  `module-id` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attachment`
--


-- --------------------------------------------------------

--
-- Table structure for table `itemcategory`
--

CREATE TABLE IF NOT EXISTS `itemcategory` (
  `id` int(255) NOT NULL,
  `categoryname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemcategory`
--


-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(255) NOT NULL,
  `categoryid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `attachid` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--


-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `flag` enum('0','1') NOT NULL,
  `type` enum('1','2','3') NOT NULL,
  `P_id` int(255) NOT NULL,
  `lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `login`
--


-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE IF NOT EXISTS `office` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `officename` varchar(255) NOT NULL,
  `officemail` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `officername` varchar(255) NOT NULL,
  `officermail` varchar(255) NOT NULL,
  `officermobile` varchar(255) NOT NULL,
  `officerphone` varchar(255) NOT NULL,
  `officeradd` text NOT NULL,
  `officerphoto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `office`
--


-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `concerning` int(255) NOT NULL,
  `profileid` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--


-- --------------------------------------------------------

--
-- Table structure for table `puchaser`
--

CREATE TABLE IF NOT EXISTS `puchaser` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `attachid` int(255) NOT NULL,
  `officeaddress` text NOT NULL,
  `officephone` varchar(15) NOT NULL,
  `officemobile` varchar(15) NOT NULL,
  `officemail` varchar(255) NOT NULL,
  `officername` varchar(255) NOT NULL,
  `officeradd` text NOT NULL,
  `officermail` varchar(255) NOT NULL,
  `officerphone` varchar(255) NOT NULL,
  `officermobile` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `puchaser`
--

