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
-- Database: `UBankMAIN`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) NOT NULL,
  `sender_id` int(10) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `reciever_id` int(10) NOT NULL,
  `reciever_name` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `sender_id`, `sender_name`, `reciever_id`, `reciever_name`, `status`) VALUES
(3, 1, 'Adam Ronald', 2, 'Henry Hart', 'ACTIVE'),
(4, 2, 'Henry Hart', 1, 'Adam Ronald', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `newusers`
--

CREATE TABLE IF NOT EXISTS `newusers` (
  `id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `account` varchar(7) NOT NULL,
  `address` varchar(40) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `branch` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newusers`
--

INSERT INTO `newusers` (`id`, `name`, `username`, `email`, `gender`, `dob`, `account`, `address`, `mobile`, `password`, `branch`) VALUES
(1, 'Steven Hall', 'steven', 'steven@ubank.me', 'M', '1964-11-04', 'current', 'Street 5', '312-443-829', 'steven123', 'United Kingdom');

-- --------------------------------------------------------

--
-- Table structure for table `security`
--

CREATE TABLE IF NOT EXISTS `security` (
  `id` int(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `timeleft` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1323 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `security`
--

INSERT INTO `security` (`id`, `description`, `message`, `status`, `author`, `timeleft`) VALUES
(1321, 'System Maintenance', 'Developing messages board. Normal online banking should be working.', 'PENDING', 'Development Center', '2019-07-20 20:00:00'),
(1322, 'Security Maintenance', 'Fixing different minor bugs during the night. UBank Online banking will be unavailable for a moment.', 'PENDING', 'Security Center', '2019-07-19 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `account` varchar(7) NOT NULL,
  `address` varchar(40) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(80) NOT NULL,
  `lastlogin` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `gender`, `dob`, `account`, `address`, `mobile`, `username`, `email`, `password`, `lastlogin`) VALUES
(1, 'James Carter', 'M', '1994-01-01', 'admin', 'street 5', '00001111', 'admin', 'admin@ubank.me', 'f31e9910ef963fb172fe8148a155eb6a67b96d89', '2019-08-23 22:22:52'),
(2, 'Bob Adams', 'M', '1996-01-01', 'admin', 'street 7', '00002222', 'bob', 'bob@ubank.me', '4ee51c0e3146c56a792f837fb30ebd21ddd873a6', '2019-08-23 22:22:36'),
(3, 'Dan Cody', 'M', '1960-02-08', 'staff', 'street 8', '00004444', 'dan', 'dan@ubank.me', 'a4b562900e7d84c3044bf91388fbc31569064c30', '2019-08-23 22:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `account` varchar(7) NOT NULL,
  `address` varchar(40) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(80) NOT NULL,
  `username` varchar(20) NOT NULL,
  `branch` varchar(32) NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `accstatus` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `dob`, `account`, `address`, `mobile`, `email`, `password`, `username`, `branch`, `ifsc`, `lastlogin`, `accstatus`) VALUES
(1, 'Adam Ronald', 'M', '2001-01-01', 'current', 'street 5', '000113', 'adam@ubank.me', '561c62b788bde046b2f0731835fe9770bb44231f', 'adam', 'United States', 'US56K', '2019-08-23 22:21:12', 'ACTIVE'),
(2, 'Henry Hart', 'M', '2002-01-01', 'savings', 'street 7', '000222', 'henry@ubank.me', 'bdb302f0856032ee1a69e129c38dce471a20b6a1', 'henry', 'United Kingdom', 'UK21C', '2019-08-23 22:21:06', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `usersclosed`
--

CREATE TABLE IF NOT EXISTS `usersclosed` (
  `id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `username` varchar(20) NOT NULL,
  `acc_type` varchar(7) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `deleted` varchar(10) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersclosed`
--

INSERT INTO `usersclosed` (`id`, `name`, `username`, `acc_type`, `mobile`, `email`, `deleted`, `reason`) VALUES
(31, 'Deleted User', 'deleted', 'normal', '4534346356', 'deleted@deleted.com', 'deleted', '## other ##'),
(32, 'John Appleseed', 'j.appleseed', 'normal', '4345452', 'john@appleseed.com', 'closed', 'I don''t use this account anymore.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newusers`
--
ALTER TABLE `newusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `security`
--
ALTER TABLE `security`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `usersclosed`
--
ALTER TABLE `usersclosed`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `newusers`
--
ALTER TABLE `newusers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `security`
--
ALTER TABLE `security`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1323;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
