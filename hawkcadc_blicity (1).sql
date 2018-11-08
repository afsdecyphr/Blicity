-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2018 at 02:06 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hawkcadc_blicity`
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

--
-- Dumping data for table `bolos`
--

INSERT INTO `bolos` (`id`, `plate`, `makemodel`, `color`) VALUES
(41, 'tre', '5e', 'te'),
(42, 'sda', 'dsa', 'qdwq');

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

--
-- Dumping data for table `calls`
--

INSERT INTO `calls` (`id`, `ucid`, `description`, `assigned`) VALUES
(3, 'b533fe72-f78d-4f6d-92ad-4020ec47b57c', 'gfvds', '[\"617c396f-7aad-4601-b7ce-941cdad1cef3\",\"4853e905-9959-4fe8-94e8-ba76d2276b33\"]'),
(4, 'f2d5934e-9d0d-41af-a5fe-32744d9dd268', 'cs', '[\"617c396f-7aad-4601-b7ce-941cdad1cef3\"]'),
(5, 'ba429f39-cdde-40a2-83ee-e19d61089855', 'dsa', '[]'),
(6, '68e94b2f-cbe0-4bfc-ad43-14a546ca61bd', 'dsa', '[]'),
(7, '1d48d57d-b38b-4067-b8a2-651957d58061', 'dsa', '[]'),
(8, 'be482a03-c26d-432b-88c8-227598818667', 'dsabtd', '[]'),
(9, '66331488-bd20-4cdc-aa85-fd658fa850aa', 'dsabtdhygf', '[]');

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
  `weaponLicenseStatus` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`id`, `uuid`, `name`, `age`, `gender`, `address`, `association`, `licenseStatus`, `weaponLicenseStatus`) VALUES
(1, '29f89bac-f1bf-4b34-a1a0-f862730aaae3', 'max jones', 21, 2, 'test addrress', 'csdhj', 2, 1),
(2, '9ef0e3f3-bab3-49ac-800a-7980980af2b2', 'Max Well', 22, 0, 'cdjsp[', 'csdhj', 1, 1),
(4, '9a0d9f1b-98e4-4a76-b9cc-b254e84d0eba', 'df', 19, 0, 'dfsdfsdf', '1a745b26-d781-47f6-8cae-a1d4c68c8ec6', 0, 0),
(5, 'db4213a9-03e0-42b9-bbdd-f75e7b0ef6b6', 'Braden H', 34, 0, '412 Marina Ave.', 'e2ec4d2d-689d-41ba-9795-b3f7c4030b20', 0, 0);

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
(8, 'Test Dep1');

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
(5, 'e2ec4d2d-689d-41ba-9795-b3f7c4030b20', '67.45.32.18'),
(6, 'e2ec4d2d-689d-41ba-9795-b3f7c4030b20', '67.45.32.121');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `title` varchar(255) NOT NULL,
  `siteUrl` varchar(255) DEFAULT NULL,
  `discordModule` int(11) NOT NULL,
  `customDepartmentsModule` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`title`, `siteUrl`, `discordModule`, `customDepartmentsModule`) VALUES
('Blicity (HAWK DEV BUILD)', 'http://blicity.hawkcad.com/', 1, 1);

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
(5, '29f89bac-f1bf-4b34-a1a0-f862730aaae3', 'cdsj', 'hucde', 'cc1acb28-673e-4e54-84d2-55087f2ce2ec');

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
(11, '617c396f-7aad-4601-b7ce-941cdad1cef3', 'csdhj', 'DISP-01', 1, '', 1, 1, 1, 'hjk;\ncmdslds;\nbuyi;yu'),
(16, '02de9d03-bc0d-4b38-a4db-a048cae5c2d4', '1a745b26-d781-47f6-8cae-a1d4c68c8ec6', '789456123', 2, '', 1, 1, 1, ''),
(17, 'eb274dee-15aa-4516-bb6c-ef5a10b9d918', '1a745b26-d781-47f6-8cae-a1d4c68c8ec6', '78945`````````````6123', 0, '', 1, 1, 1, ''),
(18, '4853e905-9959-4fe8-94e8-ba76d2276b33', 'e2ec4d2d-689d-41ba-9795-b3f7c4030b20', '1k-42', 1, '', 1, 1, 1, ''),
(19, 'b1cc96c6-becb-4639-882a-f6b7b2330220', '4f331bcb-1ba2-4518-a656-981635937be3', 'DSA', 0, '', 0, 0, 1, ''),
(20, '8d3a8d75-1b6f-4525-b3c2-17f463761196', '4f331bcb-1ba2-4518-a656-981635937be3', 'DSAA', 0, '', 0, 0, 1, ''),
(21, '4c51a064-b83f-419d-91a8-30df358def5b', 'csdhj', 'dsad', 1, '', 1, 1, 1, '');

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
(1, 'csdhj', 'Decyphr', '$2y$10$vHpeiWxDWYBXQ5qjSYts1eaV5xpa63qdrwN8hqD7qCYftRLBGrMbe', 0, 'dark', 'Decyphr#1065'),
(4, 'e2ec4d2d-689d-41ba-9795-b3f7c4030b20', 'smileyisbae', '$2y$10$pFbBLMQ4Tj8vcIxvgd/RvOkYNgFbmcPquEOsGs.KfEfE8fwx0Hky2', 1, 'dark', 'Braden H.#9035'),
(5, '8a794796-bf0f-40f6-a19b-1d0256cf9276', 'dsa', '$2y$10$lbFIgpNFSG1IKOPxefq2COLMiBVqItHlttqywm75U.o8L6.EwQhF2', 1, 'dark', ''),
(6, '1a745b26-d781-47f6-8cae-a1d4c68c8ec6', 'OfficerScentral', '$2y$10$cGMeMMXEkyEWRLiPe9ryf.lY80i0TjD0JuCWxMQ7hJk6hm1eNAZHy', 0, 'dark', ''),
(7, '4f331bcb-1ba2-4518-a656-981635937be3', 'dsaa', '$2y$10$MAb9N1RczG9IBJtGzMlC0Od1UMSNqTuBd5zkCSJ9qTmjmPPPPs.Ja', 9, 'dark', ''),
(8, '26be408f-6286-4d20-bead-18b1a3c0d346', 'Ben', '$2y$10$ZE.wyWTFr7fTQPbaKJkFU.fZRFcL/jHkoj1O/LWu9sFzZCJ498I5y', 0, 'dark', ''),
(9, '7716abac-c296-4f14-8cce-8eb41d24b1d7', 'dsaaa', '$2y$10$.KUSXx6OK7BjP0mbIn2DZu25EJAKnfT4YXr3T/.V1tKJeWrJ47vLK', 9, 'dark', 'dsaaaa');

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
(101, '1541632362', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(102, '1541632408', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(103, '1541632429', 'csdhj', 'Created call. Details: [Description:\"gfvds\"]', '107.215.32.123'),
(104, '1541632432', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(105, '1541632434', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(106, '1541632458', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"\"]', '107.215.32.123'),
(107, '1541632461', 'csdhj', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '107.215.32.123'),
(108, '1541632539', 'csdhj', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '107.215.32.123'),
(109, '1541632539', 'csdhj', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '107.215.32.123'),
(110, '1541632542', 'csdhj', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '107.215.32.123'),
(111, '1541632547', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(112, '1541632548', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(113, '1541632596', 'csdhj', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '107.215.32.123'),
(114, '1541632606', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(115, '1541632632', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(116, '1541632634', 'csdhj', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '107.215.32.123'),
(117, '1541632636', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(118, '1541632638', 'csdhj', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '107.215.32.123'),
(119, '1541632641', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(120, '1541632680', 'csdhj', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '107.215.32.123'),
(121, '1541657400', 'csdhj', 'Created call. Details: [Description:\"cs\"]', '107.215.32.123'),
(122, '1541657408', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(123, '1541657409', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(124, '1541657411', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(125, '1541657411', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(126, '1541657417', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(127, '1541657419', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(128, '1541657420', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(129, '1541657422', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(130, '1541657422', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(131, '1541657452', 'csdhj', 'Created call. Details: [Description:\"dsa\"]', '107.215.32.123'),
(132, '1541657458', 'csdhj', 'Created call. Details: [Description:\"dsa\"]', '107.215.32.123'),
(133, '1541657468', 'csdhj', 'Created call. Details: [Description:\"dsa\"]', '107.215.32.123'),
(134, '1541657483', 'csdhj', 'Created call. Details: [Description:\"dsabtd\"]', '107.215.32.123'),
(135, '1541657491', 'csdhj', 'Created call. Details: [Description:\"dsabtdhygf\"]', '107.215.32.123'),
(136, '1541657529', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(137, '1541657529', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(138, '1541657530', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(139, '1541657532', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(140, '1541657532', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(141, '1541657534', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(142, '1541657541', 'csdhj', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '107.215.32.123'),
(143, '1541657542', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(144, '1541657542', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(145, '1541657616', 'csdhj', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '107.215.32.123'),
(146, '1541657646', 'e2ec4d2d-689d-41ba-9795-b3f7c4030b20', 'Updated status. Details: [Target UUID:\"4853e905-9959-4fe8-94e8-ba76d2276b33\"], [Status:\"1\"]', '67.45.32.121'),
(147, '1541657650', 'e2ec4d2d-689d-41ba-9795-b3f7c4030b20', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '67.45.32.121'),
(148, '1541657658', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(149, '1541657660', 'csdhj', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '107.215.32.123'),
(150, '1541657662', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(151, '1541657663', 'csdhj', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '107.215.32.123'),
(152, '1541657663', 'e2ec4d2d-689d-41ba-9795-b3f7c4030b20', 'Updated status. Details: [Target UUID:\"4853e905-9959-4fe8-94e8-ba76d2276b33\"], [Status:\"\"]', '67.45.32.121'),
(153, '1541657665', 'csdhj', 'Updated status. Details: [Target UUID:\"4c51a064-b83f-419d-91a8-30df358def5b\"], [Status:\"\"]', '107.215.32.123'),
(154, '1541657665', 'e2ec4d2d-689d-41ba-9795-b3f7c4030b20', 'Assigned self to call. Details: [UCID:\"b533fe72-f78d-4f6d-92ad-4020ec47b57c\"]', '67.45.32.121'),
(155, '1541658015', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"0\"]', '107.215.32.123'),
(156, '1541658019', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(157, '1541659079', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"3\"]', '107.215.32.123'),
(158, '1541659080', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"4\"]', '107.215.32.123'),
(159, '1541659082', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"2\"]', '107.215.32.123'),
(160, '1541659082', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"0\"]', '107.215.32.123'),
(161, '1541659084', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(162, '1541659085', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(163, '1541659363', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"0\"]', '107.215.32.123'),
(164, '1541659377', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(165, '1541659387', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"2\"]', '107.215.32.123'),
(166, '1541659388', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"0\"]', '107.215.32.123'),
(167, '1541659428', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(168, '1541659429', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"2\"]', '107.215.32.123'),
(169, '1541659449', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"0\"]', '107.215.32.123'),
(170, '1541659588', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(171, '1541659594', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"2\"]', '107.215.32.123'),
(172, '1541659594', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"2\"]', '107.215.32.123'),
(173, '1541659598', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"3\"]', '107.215.32.123'),
(174, '1541659600', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"3\"]', '107.215.32.123'),
(175, '1541659602', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"0\"]', '107.215.32.123'),
(176, '1541659674', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(177, '1541659674', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(178, '1541659689', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"2\"]', '107.215.32.123'),
(179, '1541659693', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"0\"]', '107.215.32.123'),
(180, '1541659707', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(181, '1541659757', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"4\"]', '107.215.32.123'),
(182, '1541659759', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"3\"]', '107.215.32.123'),
(183, '1541659763', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"4\"]', '107.215.32.123'),
(184, '1541659769', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"3\"]', '107.215.32.123'),
(185, '1541659771', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"4\"]', '107.215.32.123'),
(186, '1541659773', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(187, '1541659807', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"4\"]', '107.215.32.123'),
(188, '1541659812', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"5\"]', '107.215.32.123'),
(189, '1541659876', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"4\"]', '107.215.32.123'),
(190, '1541659877', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(191, '1541659896', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"2\"]', '107.215.32.123'),
(192, '1541659914', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"0\"]', '107.215.32.123'),
(193, '1541659919', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123'),
(194, '1541659941', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"2\"]', '107.215.32.123'),
(195, '1541659942', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"0\"]', '107.215.32.123'),
(196, '1541659944', 'csdhj', 'Updated status. Details: [Target UUID:\"617c396f-7aad-4601-b7ce-941cdad1cef3\"], [Status:\"1\"]', '107.215.32.123');

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
(8, '40d7c850-4613-4005-aa65-9c200b763722', '29f89bac-f1bf-4b34-a1a0-f862730aaae3', 'LP', 'Ford', 'classicGraphite', 1, 1);

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
  ADD PRIMARY KEY (`title`);

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
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customdepartmentsmodule`
--
ALTER TABLE `customdepartmentsmodule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `known_ips`
--
ALTER TABLE `known_ips`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

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
