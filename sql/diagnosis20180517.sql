CREATE DATABASE  IF NOT EXISTS `diagnosis` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `diagnosis`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: diagnosis
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.26-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `diagonse_history`
--

DROP TABLE IF EXISTS `diagonse_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diagonse_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `img_path` varchar(255) DEFAULT NULL,
  `symptom_one` int(11) DEFAULT NULL,
  `symptom_two` int(11) DEFAULT NULL,
  `summary` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagonse_history`
--

LOCK TABLES `diagonse_history` WRITE;
/*!40000 ALTER TABLE `diagonse_history` DISABLE KEYS */;
INSERT INTO `diagonse_history` VALUES (1,2,2,0,'upload/images/1.jpg',1,4,'tesef','2018-05-12 06:13:27','2018-05-12 07:52:04'),(3,2,3,0,'http://localhost/diagnosis/public/upload/images/20180514/e5b432df80a78ce22ebe7e0047ffc29d.jpg',1,4,'123','2018-05-14 05:39:05','2018-05-14 05:39:05'),(4,2,3,0,'http://localhost/diagnosis/public/upload/images/20180514/afec7ea5496f2fbedbb3b025d2935fb9.jpg',2,7,'3333','2018-05-14 05:49:24','2018-05-14 05:49:24'),(5,3,3,0,'http://localhost/diagnosis/public/upload/images/20180514/afec7ea5496f2fbedbb3b025d2935fb9.jpg',2,7,'efwef','2018-05-14 15:31:33','2018-05-14 15:31:33'),(6,4,3,0,'http://localhost/diagnosis/public/upload/images/20180514/afec7ea5496f2fbedbb3b025d2935fb9.jpg',2,7,'hhh','2018-05-14 15:32:09','2018-05-14 15:32:09'),(7,4,3,0,'http://localhost/diagnosis/public/upload/images/20180514/afec7ea5496f2fbedbb3b025d2935fb9.jpg',2,8,'greee','2018-05-14 15:32:54','2018-05-14 15:32:54'),(8,2,3,0,'http://localhost/diagnosis/public/upload/images/20180517/ac7e74f51af01e8641cabd4c7f1df37f.jpg',1,5,'ttt','2018-05-16 19:33:51','2018-05-16 19:33:51'),(9,2,3,0,'http://localhost/diagnosis/public/upload/images/20180517/d828b1ef0b4acf4354363e0104325ed4.jpg',1,4,'ssss','2018-05-16 19:36:29','2018-05-16 19:36:29'),(10,2,3,0,'http://localhost/diagnosis/public/upload/images/20180517/eeece91e310fd5b9da428e81904eb86e.jpg',1,5,'ttt','2018-05-16 19:37:40','2018-05-16 19:37:40');
/*!40000 ALTER TABLE `diagonse_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mean`
--

DROP TABLE IF EXISTS `mean`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mean` (
  `s_one` int(11) NOT NULL,
  `s_two` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`s_one`,`s_two`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mean`
--

LOCK TABLES `mean` WRITE;
/*!40000 ALTER TABLE `mean` DISABLE KEYS */;
INSERT INTO `mean` VALUES (1,4,'邪热深重;胃肠热结'),(1,5,'12'),(1,6,'555'),(2,7,'gsf'),(2,8,'fhj'),(2,9,'fe'),(3,10,'jkj'),(3,11,'def'),(3,12,'ef');
/*!40000 ALTER TABLE `mean` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `sex` int(11) DEFAULT '0',
  `phone` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (2,'tom2',1,'18200049876',31,1,'2018-05-09 13:24:41','2018-05-10 09:28:02'),(3,'tom3',1,'18200049876',6,1,'2018-05-09 13:25:39','2018-05-10 09:28:02'),(4,'jerry',0,'18200049876',17,1,'2018-05-09 13:25:39','2018-05-10 09:28:02'),(5,'botton',1,'18200049876',20,0,'2018-05-09 13:25:39','2018-05-17 03:40:23'),(6,'berry',1,'18200049876',44,0,'2018-05-09 13:25:39','2018-05-17 03:40:23'),(8,'pm',1,'18284848484',33,0,'2018-05-09 15:46:56','2018-05-10 09:28:02'),(9,'tomtet122',1,'18206296913',0,0,'2018-05-10 01:32:43','2018-05-10 01:32:43'),(10,'adminssss',0,'18206296916',0,0,'2018-05-10 01:33:46','2018-05-10 01:33:46'),(11,'butt',0,'182062969913',0,0,'2018-05-10 01:36:37','2018-05-10 01:36:37'),(12,'buuukkd',1,'19999999999',0,0,'2018-05-10 01:37:07','2018-05-10 01:37:07');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `symptom`
--

DROP TABLE IF EXISTS `symptom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `symptom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(45) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `symptom`
--

LOCK TABLES `symptom` WRITE;
/*!40000 ALTER TABLE `symptom` DISABLE KEYS */;
INSERT INTO `symptom` VALUES (1,'绛红',0),(2,'青紫',0),(3,'淡白',0),(4,'焦黄干燥',1),(5,'黑二干燥',1),(6,'无苔',1),(7,'黄燥',2),(8,'焦黑而干',2),(9,'白润',2),(10,'test',3);
/*!40000 ALTER TABLE `symptom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT '0',
  `is_deleted` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'gavin3','admin@qq.com','$2y$10$sj05i6GJe3SOsQzIl8UBLeC.FhPV5KFylZ92WMuDIgqPoRIEEbAAy','z79tdjyy4XFurrbSechcFbpYRyBH8aZMejIlo6PNZtqnNhkvLsTEkQqryYth',0,0,'2018-05-08 01:06:50','2018-05-17 08:06:20'),(3,'tom222335','3131@qq.com','$2y$10$sj05i6GJe3SOsQzIl8UBLeC.FhPV5KFylZ92WMuDIgqPoRIEEbAAy','s36ecgzxDziKwNEY1SxZVmtyCOMovPvUFzJcdnBDpmyLSnnR9mp9FmEC2wdM',1,0,'2018-05-09 07:06:33','2018-05-17 03:41:27'),(4,'gavin','4444@qq.com','$2y$10$R19cTLFcfTELdt4.ePmYKeCjCoWPoftqJ3XY5DdRbaBA9KEJgJxWO',NULL,0,0,'2018-05-09 01:11:56','2018-05-09 10:11:04'),(5,'diliburongbb','33@qq.com','$2y$10$fldJ2H6D82o/OcM.kGjqvu7MvMUPn5YK7VCnWmbCWThJMBPVGRPmK',NULL,1,0,'2018-05-09 01:12:26','2018-05-09 10:11:04'),(6,'diliburong','123@qqq.com','$2y$10$S791vOnoZr.xTVB.ZnyxC.lH/ZQnzujEuo1MpCpsV77ekr77gQ8Hi',NULL,0,0,'2018-05-09 23:00:33','2018-05-09 23:00:33'),(7,'tomteteee','23232@qq.com','$2y$10$p7.RyUIFCtSELjYxuut20ea.uTVi5IuKGVJCPW2wH/lndB9YRPfzK',NULL,0,0,'2018-05-09 23:53:21','2018-05-09 23:53:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'diagnosis'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-17 16:07:00
