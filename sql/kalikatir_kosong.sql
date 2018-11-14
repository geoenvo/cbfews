-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: monitoringku.com
-- Generation Time: Nov 14, 2018 at 11:46 AM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kalikatir`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `site_id` varchar(200) DEFAULT NULL,
  `client_date` datetime DEFAULT NULL,
  `server_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `temperature` varchar(20) DEFAULT NULL,
  `humidity` varchar(20) DEFAULT NULL,
  `arg` varchar(20) DEFAULT NULL,
  `awlr` varchar(20) DEFAULT NULL,
  `stat` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `site_id` varchar(50) DEFAULT NULL,
  `site_name` varchar(100) DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lng` varchar(50) DEFAULT NULL,
  `polylines` varchar(500) DEFAULT NULL,
  `images` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `site_id`, `site_name`, `lat`, `lng`, `polylines`, `images`) VALUES
(1, '53', 'SITE AKAR SERIBU', '-7.673384', '112.4779243', NULL, 'akar_seribu_1.jpeg,akar_seribu_2.jpeg'),
(2, '55', 'SITE BEGAGAN LIMO', '-7.665442', '112.4760453', NULL, 'begagan_limo_1.jpeg,begagan_limo_2.jpeg'),
(3, '57', 'SITE JEMBATAN TROLIMAN', '-7.649386', '112.475151', NULL, 'dilem_1.jpeg'),
(4, '52', 'SITE KALIKATIR', '-7.6382128', '112.4638512', NULL, 'kalikatir_1.jpeg,kalikatir_2.jpeg,kalikatir_3.jpeg,kalikatir_4.jpeg,kalikatir_5.jpeg'),
(5, '58', 'SITE MATA AIR', '-7.653175', '112.473144', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `threshold`
--

CREATE TABLE `threshold` (
  `id` int(11) NOT NULL,
  `status_name` varchar(255) DEFAULT NULL,
  `min_value` int(11) DEFAULT NULL,
  `max_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threshold`
--

INSERT INTO `threshold` (`id`, `status_name`, `min_value`, `max_value`) VALUES
(1, 'AWAS', 100, 520),
(2, 'SIAGA', 80, 100),
(3, 'WASPADA', 50, 70),
(4, 'NORMAL', 0, 50);

-- --------------------------------------------------------

--
-- Table structure for table `updated_log`
--

CREATE TABLE `updated_log` (
  `id` int(11) NOT NULL,
  `site_id` varchar(200) DEFAULT NULL,
  `client_date` datetime DEFAULT NULL,
  `server_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `temperature` varchar(20) DEFAULT NULL,
  `humidity` varchar(20) DEFAULT NULL,
  `arg` varchar(20) DEFAULT NULL,
  `awlr` varchar(20) DEFAULT NULL,
  `stat` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `updated_log`
--

INSERT INTO `updated_log` (`id`, `site_id`, `client_date`, `server_date`, `temperature`, `humidity`, `arg`, `awlr`, `stat`) VALUES
(2, '53', '2018-11-14 04:38:34', '2018-04-18 13:50:23', '30.00', '99.00', '0', '12', NULL),
(3, '55', '2018-11-14 04:38:54', '2018-04-18 13:50:23', '31.00', '99.00', '0', '68', NULL),
(4, '52', '2018-11-14 04:39:33', '2018-04-24 10:52:24', '33.00', '99.00', '0', '51', NULL),
(5, '57', '2018-11-14 04:39:14', '2018-04-24 10:52:24', '31.00', '99.00', '0', '45', NULL),
(6, '59', '2018-04-25 02:26:51', '2018-04-24 12:00:07', '0.00', '0.00', '0', '0', NULL),
(10, '58', '2018-11-14 04:39:54', '2018-04-28 11:50:04', '30.00', '81.00', '0', '32', NULL),
(12, '54', '2018-04-30 00:14:55', '2018-04-30 10:20:03', '0.00', '0.00', '1', '0', NULL),
(15, '50', '2018-11-07 13:03:05', '2018-05-04 16:50:07', '0.00', '0.00', '0', '220', NULL),
(40, '565', '2018-11-12 15:44:40', '2018-10-02 15:10:05', '12.71', '0.00', '0', '0', NULL),
(41, '569', '2018-11-14 04:07:38', '2018-10-02 15:10:05', '12.45', '0.00', '0', '0', NULL),
(42, '575', '2018-11-13 22:57:51', '2018-10-02 15:10:05', '0.00', '0.00', '0', '0', NULL),
(43, '582', '2018-11-14 03:07:27', '2018-10-02 15:10:05', '0.00', '0.00', '0', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_alarm`
--

CREATE TABLE `user_alarm` (
  `id` int(11) NOT NULL,
  `reg_id` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threshold`
--
ALTER TABLE `threshold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updated_log`
--
ALTER TABLE `updated_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_alarm`
--
ALTER TABLE `user_alarm`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153594;
--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `threshold`
--
ALTER TABLE `threshold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `updated_log`
--
ALTER TABLE `updated_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `user_alarm`
--
ALTER TABLE `user_alarm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
