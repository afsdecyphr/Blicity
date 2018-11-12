-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2018 at 06:48 PM
-- Server version: 8.0.4-rc-log
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blicity`
--

-- --------------------------------------------------------

--
-- Table structure for table `bolos`
--

CREATE TABLE `bolos` (
  `id` int(6) UNSIGNED NOT NULL,
  `plate` varchar(255) NOT NULL,
  `makemodel` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE `calls` (
  `id` int(6) UNSIGNED NOT NULL,
  `ucid` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `assigned` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `id` int(6) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(6) NOT NULL,
  `gender` int(6) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `association` varchar(255) DEFAULT NULL,
  `licenseStatus` int(6) DEFAULT NULL,
  `weaponLicenseStatus` int(6) DEFAULT NULL,
  `fishingLicense` int(11) NOT NULL DEFAULT '0',
  `huntingLicense` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`id`, `uuid`, `name`, `age`, `gender`, `address`, `association`, `licenseStatus`, `weaponLicenseStatus`, `fishingLicense`, `huntingLicense`) VALUES
(1, '29f89bac-f1bf-4b34-a1a0-f862730aaae3', 'max jones', 21, 2, 'test addrress', 'csdhj', 2, 2, 0, 0),
(2, '9ef0e3f3-bab3-49ac-800a-7980980af2b2', 'Max Well', 22, 0, 'cdjsp[', 'csdhj', 1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customdepartmentsmodule`
--

CREATE TABLE `customdepartmentsmodule` (
  `id` int(11) NOT NULL,
  `depName` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customdepartmentsmodule`
--

INSERT INTO `customdepartmentsmodule` (`id`, `depName`) VALUES
(6, 'Sheriff'),
(2, 'Police'),
(3, 'Highway Patrol'),
(7, 'dsadds');

-- --------------------------------------------------------

--
-- Table structure for table `known_ips`
--

CREATE TABLE `known_ips` (
  `id` int(6) UNSIGNED NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `known_ips`
--

INSERT INTO `known_ips` (`id`, `uuid`, `ip`) VALUES
(1, 'csdhj', '::1'),
(2, '', '::1'),
(3, '1a745b26-d781-47f6-8cae-a1d4c68c8ec6', '173.244.44.30'),
(4, 'csdhj', '107.215.32.123'),
(5, 'e2ec4d2d-689d-41ba-9795-b3f7c4030b20', '67.45.32.18');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `siteUrl` varchar(255) DEFAULT NULL,
  `discordModule` int(11) NOT NULL,
  `customDepartmentsModule` int(11) NOT NULL DEFAULT '0',
  `dowfModule` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `siteUrl`, `discordModule`, `customDepartmentsModule`, `dowfModule`) VALUES
(1, 'Blicity (HAWK DEV BUILD)', 'http://localhost:8080/Blicity/Blicity/live/', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(6) UNSIGNED NOT NULL,
  `giventouuid` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `issuedBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `giventouuid`, `reason`, `amount`, `issuedBy`) VALUES
(1, '29f89bac-f1bf-4b34-a1a0-f862730aaae3', 'dsa', 'dsa', 'cc1acb28-673e-4e54-84d2-55087f2ce2ec'),
(2, '29f89bac-f1bf-4b34-a1a0-f862730aaae3', 'jk', '290', 'cc1acb28-673e-4e54-84d2-55087f2ce2ec'),
(3, '9ef0e3f3-bab3-49ac-800a-7980980af2b2', 'cndk', 'njfed', 'cc1acb28-673e-4e54-84d2-55087f2ce2ec'),
(4, '29f89bac-f1bf-4b34-a1a0-f862730aaae3', 'cdsj', 'hucde', 'cc1acb28-673e-4e54-84d2-55087f2ce2ec'),
(5, '29f89bac-f1bf-4b34-a1a0-f862730aaae3', 'cdsj', 'hucde', 'cc1acb28-673e-4e54-84d2-55087f2ce2ec'),
(6, '9ef0e3f3-bab3-49ac-800a-7980980af2b2', 'dsasda', 'ds', '617c396f-7aad-4601-b7ce-941cdad1cef3');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(6) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `association` varchar(255) DEFAULT NULL,
  `callsign` varchar(255) NOT NULL,
  `status` int(6) NOT NULL,
  `currentcall_ucid` varchar(255) DEFAULT NULL,
  `dispatch` int(1) DEFAULT NULL,
  `mdt` int(6) DEFAULT NULL,
  `civ` int(6) DEFAULT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `uuid`, `association`, `callsign`, `status`, `currentcall_ucid`, `dispatch`, `mdt`, `civ`, `notes`) VALUES
(11, '617c396f-7aad-4601-b7ce-941cdad1cef3', 'csdhj', 'DISP-01', 1, '', 1, 1, 1, 'hjk;\ncmdslds;\nbuyi;yu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `theme` varchar(255) DEFAULT 'dark',
  `discord` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `username`, `password`, `level`, `theme`, `discord`) VALUES
(1, 'csdhj', 'Decyphr', '$2y$10$vHpeiWxDWYBXQ5qjSYts1eaV5xpa63qdrwN8hqD7qCYftRLBGrMbe', 0, 'dark', 'Decyphr#1065');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` int(6) UNSIGNED NOT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `timestamp`, `uuid`, `action`, `ip`) VALUES
(1, '1541435230', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(2, '1541435249', 'csdhj', 'Issued ticket. Details: [IssuedTo UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"], [Reason:\"cndk\"], [Amount:\"njfed\"]', '::1'),
(3, '1541438362', 'csdhj', 'Added bolo. Details: [LicensePlate:\"dsa\"], [MakeModel:\"dsa\"], [Color:\"dsa\"]', '::1'),
(4, '1541438371', 'csdhj', 'Issued ticket. Details: [IssuedTo UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"], [Reason:\"cdsj\"], [Amount:\"hucde\"]', '::1'),
(5, '1541438373', 'csdhj', 'Issued ticket. Details: [IssuedTo UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"], [Reason:\"cdsj\"], [Amount:\"hucde\"]', '::1'),
(6, '1541438388', 'csdhj', 'Issued warrant. Details: [IssuedTo UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"], [Reason:\"cdn\"]', '::1'),
(7, '1541554649', '1a745b26-d781-47f6-8cae-a1d4c68c8ec6', 'Updated status. Details: [Target UUID:\"02de9d03-bc0d-4b38-a4db-a048cae5c2d4\"], [Status:\"1\"]', '173.244.44.30'),
(8, '1541554655', '1a745b26-d781-47f6-8cae-a1d4c68c8ec6', 'Updated status. Details: [Target UUID:\"02de9d03-bc0d-4b38-a4db-a048cae5c2d4\"], [Status:\"0\"]', '173.244.44.30'),
(9, '1541554656', '1a745b26-d781-47f6-8cae-a1d4c68c8ec6', 'Updated status. Details: [Target UUID:\"02de9d03-bc0d-4b38-a4db-a048cae5c2d4\"], [Status:\"1\"]', '173.244.44.30'),
(10, '1541554656', '1a745b26-d781-47f6-8cae-a1d4c68c8ec6', 'Updated status. Details: [Target UUID:\"02de9d03-bc0d-4b38-a4db-a048cae5c2d4\"], [Status:\"2\"]', '173.244.44.30'),
(11, '1541554658', '1a745b26-d781-47f6-8cae-a1d4c68c8ec6', 'Updated status. Details: [Target UUID:\"02de9d03-bc0d-4b38-a4db-a048cae5c2d4\"], [Status:\"1\"]', '173.244.44.30'),
(12, '1541554682', '1a745b26-d781-47f6-8cae-a1d4c68c8ec6', 'Updated status. Details: [Target UUID:\"02de9d03-bc0d-4b38-a4db-a048cae5c2d4\"], [Status:\"1\"]', '173.244.44.30'),
(13, '1541554723', 'csdhj', 'Added bolo. Details: [LicensePlate:\"tre\"], [MakeModel:\"5e\"], [Color:\"te\"]', '107.215.32.123'),
(14, '1541554730', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(15, '1541554735', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"2\"]', '107.215.32.123'),
(16, '1541554735', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(17, '1541554743', 'csdhj', 'Added bolo. Details: [LicensePlate:\"sda\"], [MakeModel:\"dsa\"], [Color:\"qdwq\"]', '107.215.32.123'),
(18, '1541575204', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(19, '1541575812', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(20, '1541575826', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(21, '1541575827', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(22, '1541575827', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(23, '1541575827', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(24, '1541575827', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(25, '1541575827', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(26, '1541575855', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(27, '1541575855', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(28, '1541575926', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(29, '1541575926', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(30, '1541575933', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(31, '1541575935', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(32, '1541575935', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(33, '1541575935', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(34, '1541575936', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(35, '1541575936', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(36, '1541575936', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(37, '1541575936', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(38, '1541575937', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(39, '1541575940', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(40, '1541575940', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(41, '1541575940', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(42, '1541575940', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(43, '1541575940', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(44, '1541575940', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(45, '1541575940', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(46, '1541575940', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(47, '1541575941', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(48, '1541575941', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(49, '1541575941', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(50, '1541575941', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(51, '1541575941', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(52, '1541575941', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(53, '1541575942', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(54, '1541575942', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(55, '1541575943', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(56, '1541575943', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(57, '1541575943', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(58, '1541575943', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(59, '1541575944', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(60, '1541575944', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(61, '1541575944', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(62, '1541575944', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(63, '1541576162', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(64, '1541576199', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(65, '1541576511', 'e2ec4d2d-689d-41ba-9795-b3f7c4030b20', 'Updated status. Details: [Target UUID:\"4853e905-9959-4fe8-94e8-ba76d2276b33\"], [Status:\"\"]', '67.45.32.18'),
(66, '1541576943', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(67, '1541576977', 'e2ec4d2d-689d-41ba-9795-b3f7c4030b20', 'Updated status. Details: [Target UUID:\"4853e905-9959-4fe8-94e8-ba76d2276b33\"], [Status:\"\"]', '67.45.32.18'),
(68, '1541577586', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(69, '1541577586', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(70, '1541577587', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(71, '1541577587', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(72, '1541577588', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(73, '1541577588', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(74, '1541577588', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(75, '1541577588', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(76, '1541577589', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(77, '1541577589', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(78, '1541577589', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(79, '1541577589', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(80, '1541577589', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(81, '1541577590', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(82, '1541577591', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(83, '1541577591', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(84, '1541577591', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(85, '1541577591', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(86, '1541577591', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(87, '1541577592', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(88, '1541577592', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(89, '1541577592', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(90, '1541577593', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(91, '1541577593', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(92, '1541577593', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(93, '1541577594', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(94, '1541577594', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(95, '1541577594', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(96, '1541577594', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(97, '1541577595', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(98, '1541577595', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(99, '1541577595', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(100, '1541577595', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(101, '1542038749', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(102, '1542038976', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(103, '1542038993', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(104, '1542039016', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(105, '1542039466', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(106, '1542039471', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(107, '1542039477', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(108, '1542039480', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(109, '1542040190', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(110, '1542040240', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(111, '1542040283', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(112, '1542040308', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(113, '1542040398', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(114, '1542040524', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(115, '1542040536', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(116, '1542040558', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(117, '1542040569', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(118, '1542040608', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(119, '1542040864', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(120, '1542040918', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(121, '1542040939', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(122, '1542041882', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(123, '1542041890', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(124, '1542041893', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(125, '1542041913', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(126, '1542041921', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(127, '1542041973', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(128, '1542042030', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(129, '1542042112', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(130, '1542042128', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(131, '1542042164', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(132, '1542042176', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(133, '1542042180', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(134, '1542042232', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(135, '1542042234', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(136, '1542042235', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(137, '1542042252', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(138, '1542042279', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(139, '1542042280', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(140, '1542042284', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(141, '1542042326', 'csdhj', 'Ran character search. Details: [UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"]', '::1'),
(142, '1542042329', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(143, '1542042331', 'csdhj', 'Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]', '::1'),
(144, '1542042534', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(145, '1542042536', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(146, '1542042536', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(147, '1542042557', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(148, '1542042594', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(149, '1542042637', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(150, '1542042638', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(151, '1542042639', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(152, '1542042643', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(153, '1542042644', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(154, '1542042654', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(155, '1542042655', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(156, '1542042705', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(157, '1542042707', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(158, '1542042710', 'csdhj', 'URemoved bolo. Details: [ID:\"41\"]', '::1'),
(159, '1542042711', 'csdhj', 'URemoved bolo. Details: [ID:\"42\"]', '::1'),
(160, '1542042782', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '::1'),
(161, '1542042791', 'csdhj', 'Added bolo. Details: [LicensePlate:\"cds\"], [MakeModel:\"cds\"], [Color:\"cds\"]', '::1'),
(162, '1542042800', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '::1'),
(163, '1542042804', 'csdhj', 'Updated status. Details: [Target UUID:\"\"], [Status:\"\"]', '::1'),
(164, '1542042822', 'csdhj', 'Issued ticket. Details: [IssuedTo UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"], [Reason:\"dsasda\"], [Amount:\"ds\"]', '::1'),
(165, '1542042909', 'csdhj', 'URemoved bolo. Details: [ID:\"43\"]', '::1'),
(166, '1542042924', 'csdhj', 'Added bolo. Details: [LicensePlate:\"dsa\"], [MakeModel:\"dsa\"], [Color:\"dsa\"]', '::1'),
(167, '1542043430', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '::1'),
(168, '1542047949', 'csdhj', 'URemoved bolo. Details: [ID:\"44\"]', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(6) UNSIGNED NOT NULL,
  `uvid` varchar(255) DEFAULT NULL,
  `association` varchar(255) DEFAULT NULL,
  `licensePlate` varchar(255) DEFAULT NULL,
  `makemodel` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `vehicleTags` int(6) DEFAULT NULL,
  `insuranceStatus` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `uvid`, `association`, `licensePlate`, `makemodel`, `color`, `vehicleTags`, `insuranceStatus`) VALUES
(8, '537a55e5-0dcb-404b-b40b-530b07ac2120', '9ef0e3f3-bab3-49ac-800a-7980980af2b2', 'dsa', 'dsa', 'chrome', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `warrants`
--

CREATE TABLE `warrants` (
  `id` int(6) UNSIGNED NOT NULL,
  `gieventouuid` varchar(255) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `issuedBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warrants`
--

INSERT INTO `warrants` (`id`, `gieventouuid`, `reason`, `issuedBy`) VALUES
(1, '29f89bac-f1bf-4b34-a1a0-f862730aaae3', 'jkl', 'cc1acb28-673e-4e54-84d2-55087f2ce2ec'),
(2, '29f89bac-f1bf-4b34-a1a0-f862730aaae3', 'cds', 'cc1acb28-673e-4e54-84d2-55087f2ce2ec'),
(3, '29f89bac-f1bf-4b34-a1a0-f862730aaae3', 'cdn', 'cc1acb28-673e-4e54-84d2-55087f2ce2ec');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bolos`
--
ALTER TABLE `bolos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customdepartmentsmodule`
--
ALTER TABLE `customdepartmentsmodule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `known_ips`
--
ALTER TABLE `known_ips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warrants`
--
ALTER TABLE `warrants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bolos`
--
ALTER TABLE `bolos`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customdepartmentsmodule`
--
ALTER TABLE `customdepartmentsmodule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `known_ips`
--
ALTER TABLE `known_ips`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `warrants`
--
ALTER TABLE `warrants`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
