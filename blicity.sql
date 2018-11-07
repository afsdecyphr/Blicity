-- MySQL dump 10.13  Distrib 8.0.4-rc, for Win64 (x86_64)
--
-- Host: localhost    Database: blicity
-- ------------------------------------------------------
-- Server version	8.0.4-rc-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bolos`
--

DROP TABLE IF EXISTS `bolos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `bolos` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `plate` varchar(255) NOT NULL,
  `makemodel` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bolos`
--

LOCK TABLES `bolos` WRITE;
/*!40000 ALTER TABLE `bolos` DISABLE KEYS */;
/*!40000 ALTER TABLE `bolos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calls`
--

DROP TABLE IF EXISTS `calls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `calls` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ucid` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `assigned` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls`
--

LOCK TABLES `calls` WRITE;
/*!40000 ALTER TABLE `calls` DISABLE KEYS */;
INSERT INTO `calls` VALUES (1,'dsha','call description','[\"cc1acb28-673e-4e54-84d2-55087f2ce2ec\", \"617c396f-7aad-4601-b7ce-941cdad1cef3\"]');
/*!40000 ALTER TABLE `calls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `characters`
--

DROP TABLE IF EXISTS `characters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `characters` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(6) NOT NULL,
  `gender` int(6) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `association` varchar(255) DEFAULT NULL,
  `licenseStatus` int(6) DEFAULT NULL,
  `weaponLicenseStatus` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `characters`
--

LOCK TABLES `characters` WRITE;
/*!40000 ALTER TABLE `characters` DISABLE KEYS */;
INSERT INTO `characters` VALUES (1,'29f89bac-f1bf-4b34-a1a0-f862730aaae3','max jones',21,2,'test addrress','csdhj',2,1),(2,'9ef0e3f3-bab3-49ac-800a-7980980af2b2','Max Well',22,0,'cdjsp[','csdhj',1,1);
/*!40000 ALTER TABLE `characters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `known_ips`
--

DROP TABLE IF EXISTS `known_ips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `known_ips` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `known_ips`
--

LOCK TABLES `known_ips` WRITE;
/*!40000 ALTER TABLE `known_ips` DISABLE KEYS */;
INSERT INTO `known_ips` VALUES (1,'csdhj','::1'),(2,'','::1');
/*!40000 ALTER TABLE `known_ips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `settings` (
  `title` varchar(255) NOT NULL,
  `siteUrl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES ('Blicity (DEV)','http://localhost:8080/Blicity/Blicity/live/');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tickets` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `giventouuid` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `issuedBy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,'29f89bac-f1bf-4b34-a1a0-f862730aaae3','dsa','dsa','cc1acb28-673e-4e54-84d2-55087f2ce2ec'),(2,'29f89bac-f1bf-4b34-a1a0-f862730aaae3','jk','290','cc1acb28-673e-4e54-84d2-55087f2ce2ec'),(3,'9ef0e3f3-bab3-49ac-800a-7980980af2b2','cndk','njfed','cc1acb28-673e-4e54-84d2-55087f2ce2ec'),(4,'29f89bac-f1bf-4b34-a1a0-f862730aaae3','cdsj','hucde','cc1acb28-673e-4e54-84d2-55087f2ce2ec'),(5,'29f89bac-f1bf-4b34-a1a0-f862730aaae3','cdsj','hucde','cc1acb28-673e-4e54-84d2-55087f2ce2ec');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `units` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `association` varchar(255) DEFAULT NULL,
  `callsign` varchar(255) NOT NULL,
  `status` int(6) NOT NULL,
  `currentcall_ucid` varchar(255) DEFAULT NULL,
  `dispatch` int(1) DEFAULT NULL,
  `mdt` int(6) DEFAULT NULL,
  `civ` int(6) DEFAULT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (11,'617c396f-7aad-4601-b7ce-941cdad1cef3','csdhj','DISP-01',1,'',1,1,1,'hjk;\ncmdslds;\nbuyi;yu');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_log`
--

DROP TABLE IF EXISTS `user_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user_log` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` varchar(255) DEFAULT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_log`
--

LOCK TABLES `user_log` WRITE;
/*!40000 ALTER TABLE `user_log` DISABLE KEYS */;
INSERT INTO `user_log` VALUES (1,'1541435230','csdhj','Ran character search. Details: [UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"]','::1'),(2,'1541435249','csdhj','Issued ticket. Details: [IssuedTo UCID:\"9ef0e3f3-bab3-49ac-800a-7980980af2b2\"], [Reason:\"cndk\"], [Amount:\"njfed\"]','::1'),(3,'1541438362','csdhj','Added bolo. Details: [LicensePlate:\"dsa\"], [MakeModel:\"dsa\"], [Color:\"dsa\"]','::1'),(4,'1541438371','csdhj','Issued ticket. Details: [IssuedTo UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"], [Reason:\"cdsj\"], [Amount:\"hucde\"]','::1'),(5,'1541438373','csdhj','Issued ticket. Details: [IssuedTo UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"], [Reason:\"cdsj\"], [Amount:\"hucde\"]','::1'),(6,'1541438388','csdhj','Issued warrant. Details: [IssuedTo UCID:\"29f89bac-f1bf-4b34-a1a0-f862730aaae3\"], [Reason:\"cdn\"]','::1');
/*!40000 ALTER TABLE `user_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `theme` varchar(255) DEFAULT 'dark',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'csdhj','Decyphr','$2y$10$vHpeiWxDWYBXQ5qjSYts1eaV5xpa63qdrwN8hqD7qCYftRLBGrMbe',0,'dark');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `vehicles` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `uvid` varchar(255) DEFAULT NULL,
  `association` varchar(255) DEFAULT NULL,
  `licensePlate` varchar(255) DEFAULT NULL,
  `makemodel` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `vehicleTags` int(6) DEFAULT NULL,
  `insuranceStatus` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warrants`
--

DROP TABLE IF EXISTS `warrants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `warrants` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `gieventouuid` varchar(255) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `issuedBy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warrants`
--

LOCK TABLES `warrants` WRITE;
/*!40000 ALTER TABLE `warrants` DISABLE KEYS */;
INSERT INTO `warrants` VALUES (1,'29f89bac-f1bf-4b34-a1a0-f862730aaae3','jkl','cc1acb28-673e-4e54-84d2-55087f2ce2ec'),(2,'29f89bac-f1bf-4b34-a1a0-f862730aaae3','cds','cc1acb28-673e-4e54-84d2-55087f2ce2ec'),(3,'29f89bac-f1bf-4b34-a1a0-f862730aaae3','cdn','cc1acb28-673e-4e54-84d2-55087f2ce2ec');
/*!40000 ALTER TABLE `warrants` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-06 18:16:29
