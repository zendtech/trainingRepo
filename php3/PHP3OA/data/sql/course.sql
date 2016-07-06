-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2013 at 01:28 AM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `course`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`firstname` varchar(32) NOT NULL,
`lastname` varchar(32) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`) VALUES
(1, 'George', 'Stevenson'),
(2, 'Janet', 'Levitz'),
(3, 'Jason', 'Flores'),
(4, 'Susan', 'Chu'),
(5, 'Thomas', 'White');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`order_date` varchar(32) NOT NULL,
`order_status` varchar(16) NOT NULL,
`amount` int(11) NOT NULL,
`description` text NOT NULL,
`customer_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_date`, `order_status`, `amount`, `description`, `customer_id`) VALUES
(1, '1355097600', 'complete', 560, '', 4),
(2, '1359062345', 'invoiced', 9800, '', 3),
(3, '1357948800', 'held', 300, '', 2),
(4, '1359500400', 'open', 34, 'Paper', 3),
(5, '1359586800', 'open', 4570, 'PHP development', 1),
(6, '1359586800', 'invoiced', 2000, 'Laptop', 5),
(7, '1360796400', 'open', 300, 'A big box of chocolates.', 3);
