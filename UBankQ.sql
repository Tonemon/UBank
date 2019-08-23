-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 17, 2019 at 09:22 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `UBankQ`
--

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
(13, 'Lil Yeet', 'yeet@yeet.com', '(C) Job', 'Hello, I was wondering how long exactly would it take to ship a ''visa card'' to me. I live in the US and need one, because my old one broke last night.', 'REVIEWED', 'Dan Cody', 'Customer', '2019-01-21 07:41:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
