-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 23, 2019 at 10:23 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `UBankDAT`
--

-- --------------------------------------------------------

--
-- Table structure for table `passbook1`
--

CREATE TABLE IF NOT EXISTS `passbook1` (
  `transactionid` int(5) NOT NULL,
  `transactiondate` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `ifsc` varchar(255) DEFAULT NULL,
  `credit` int(10) DEFAULT NULL,
  `debit` int(10) DEFAULT NULL,
  `amount` float(15,2) DEFAULT NULL,
  `narration` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passbook1`
--

INSERT INTO `passbook1` (`transactionid`, `transactiondate`, `name`, `branch`, `ifsc`, `credit`, `debit`, `amount`, `narration`) VALUES
(1, '2018-12-09 00:00:00', 'Adam Ronald', 'United States', 'US56K', 15000, 0, 15000.00, 'Account Open');

-- --------------------------------------------------------

--
-- Table structure for table `passbook2`
--

CREATE TABLE IF NOT EXISTS `passbook2` (
  `transactionid` int(5) NOT NULL,
  `transactiondate` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `ifsc` varchar(255) DEFAULT NULL,
  `credit` int(10) DEFAULT NULL,
  `debit` int(10) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `narration` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passbook2`
--

INSERT INTO `passbook2` (`transactionid`, `transactiondate`, `name`, `branch`, `ifsc`, `credit`, `debit`, `amount`, `narration`) VALUES
(1, '2018-12-09 00:00:00', 'Henry Hart', 'United Kingdom', 'UK21C', 5000, 0, 5000.00, 'Account Open');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `readby` varchar(255) NOT NULL,
  `askedby` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `name`, `email`, `question`, `message`, `status`, `readby`, `askedby`, `time`) VALUES
(2, 'John Doe', 'johndoe@gmail.com', 'Services', 'Hi, I would like to know more about the two account types and which one will suit me the best. I am trying to save some money for later. Greets, John', 'TO REVIEW', '', 'Homepage', '2019-01-20 08:44:25'),
(6, 'John Watson', 'johnwatson@mail.com', 'Job', 'Hi, I would like to apply for a job at UBank. Could you please send me all the information I need to send to you?', 'TO REVIEW', '', 'Homepage', '2019-01-20 09:54:58'),
(7, 'Bert Geertsen', 'bgeertsen@mail.com', 'Banking', 'Hello, I lost my password for my savings account. Could you please help me to recover it? I have all of my information ready and I can verify myself.', 'DOING', 'Dan Cody', 'Homepage', '2019-01-21 06:50:52'),
(13, 'Adam Ronald', 'adam@ubank.me', '(C) Job', 'Hello, I was wondering how long exactly would it take to ship a ''visa card'' to me. I live in the US and need one, because my old one broke last night.', 'REVIEWED', 'Dan Cody', 'Support Panel', '2019-01-21 07:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `req_creditcard`
--

CREATE TABLE IF NOT EXISTS `req_creditcard` (
  `id` int(10) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `account_no` int(10) NOT NULL,
  `creditcard_status` varchar(50) NOT NULL,
  `creditcard_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `req_mastercard`
--

CREATE TABLE IF NOT EXISTS `req_mastercard` (
  `id` int(10) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `account_no` int(10) NOT NULL,
  `mastercard_status` varchar(25) NOT NULL,
  `mastercard_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req_mastercard`
--

INSERT INTO `req_mastercard` (`id`, `cust_name`, `account_no`, `mastercard_status`, `mastercard_date`) VALUES
(1, 'Adam Ronald', 1, 'PENDING', '2019-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `req_visacard`
--

CREATE TABLE IF NOT EXISTS `req_visacard` (
  `id` int(10) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `account_no` int(10) NOT NULL,
  `visacard_status` varchar(25) NOT NULL,
  `visacard_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req_visacard`
--

INSERT INTO `req_visacard` (`id`, `cust_name`, `account_no`, `visacard_status`, `visacard_date`) VALUES
(1, 'Henry Hart', 2, 'PENDING', '2019-08-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `passbook1`
--
ALTER TABLE `passbook1`
  ADD PRIMARY KEY (`transactionid`);

--
-- Indexes for table `passbook2`
--
ALTER TABLE `passbook2`
  ADD PRIMARY KEY (`transactionid`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_creditcard`
--
ALTER TABLE `req_creditcard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_mastercard`
--
ALTER TABLE `req_mastercard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_visacard`
--
ALTER TABLE `req_visacard`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `passbook1`
--
ALTER TABLE `passbook1`
  MODIFY `transactionid` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `passbook2`
--
ALTER TABLE `passbook2`
  MODIFY `transactionid` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `req_creditcard`
--
ALTER TABLE `req_creditcard`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `req_mastercard`
--
ALTER TABLE `req_mastercard`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `req_visacard`
--
ALTER TABLE `req_visacard`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
