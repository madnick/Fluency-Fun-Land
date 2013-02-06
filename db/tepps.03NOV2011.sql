-- MySQL dump 10.13  Distrib 5.1.36, for suse-linux-gnu (i686)
--
-- Host: localhost    Database: tepps
-- ------------------------------------------------------
-- Server version	5.1.36-log

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
-- Current Database: `tepps`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `tepps` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `tepps`;

--
-- Table structure for table `awards`
--

DROP TABLE IF EXISTS `awards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `award_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awards`
--

LOCK TABLES `awards` WRITE;
/*!40000 ALTER TABLE `awards` DISABLE KEYS */;
INSERT INTO `awards` VALUES (1,'Best 1','Best1.png'),(2,'Best2','best.png'),(3,'Crown','crown.png'),(4,'Gold Medal','gold_medal.png'),(5,'Gold Thophy 1','gold_throphy1.png'),(6,'Gold Throphy 2','gold_throphy2.png'),(7,'Gold Throphy 3','gold_throphy3.png'),(8,'One','one.png'),(9,'Ribbon','ribbon.png'),(10,'Silver Throphy 1','silver_throphy1.png'),(11,'Silver Throphy 2','silver_throphy2.png'),(12,'Star','star.png');
/*!40000 ALTER TABLE `awards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User Email',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user-login` (`username`),
  UNIQUE KEY `unique-email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('Sheen','203ad5ffa1d7c650ad681fdff3965cd2','Charlie Sheen','2011-09-28',3,'c.sheen@yahoo.com'),('Lee','e99a18c428cb38d5f260853678922e03','Lee M','2011-09-28',6,'lee@gmail.com'),('nick','e99a18c428cb38d5f260853678922e03','Nicholas Basic','2011-09-28',10,'s.ivkovic@ballarat.edu.au'),('child90','7be69b51a41c27ee75e0b6fde2831592','Tom ','2011-09-29',11,'child@test.com'),('nick90','fc5e038d38a57032085441e7fe7010b0','Nick Baisc','2011-09-29',12,'nick90@blah.com'),('gmeredith','9a921e226dc3da58d914269df522b40e','Grant Meredith','2011-10-26',13,'g.meredith@ballarat.edu.au'),('jacquiposs','7e0589ab6c9920a3e17d771f13b5ca24','Jacqui McGrath','2011-10-28',14,'j.blah@test.com'),('nickb','b7cfd8127665ebe8ba0751286c3e2389','nickb','2011-11-01',15,'nickb@gmail.com');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_awards`
--

DROP TABLE IF EXISTS `users_awards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_awards` (
  `user_id` int(11) NOT NULL,
  `award_id` int(11) unsigned NOT NULL,
  `award_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `date_achieved` date NOT NULL,
  `user_award_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user_award_id`),
  KEY `user-id` (`user_id`),
  KEY `award-id` (`award_id`),
  CONSTRAINT `users_awards_ibfk_2` FOREIGN KEY (`award_id`) REFERENCES `awards` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `users_awards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_awards`
--

LOCK TABLES `users_awards` WRITE;
/*!40000 ALTER TABLE `users_awards` DISABLE KEYS */;
INSERT INTO `users_awards` VALUES (10,1,'Sasha Test','2011-10-20',1),(10,2,'Nick award','2011-10-22',2),(10,1,'Ten theme pack create','2011-10-25',3),(10,5,'car','2011-10-25',6),(10,9,'fes','2011-10-25',7),(10,5,'dsa','2011-10-25',8),(10,10,'Sasha Testing 123','2011-10-26',9),(10,10,'Sasha Testing 123','2011-10-26',10),(10,11,'15 theme pack created','2011-11-02',12);
/*!40000 ALTER TABLE `users_awards` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-11-03  9:34:30
