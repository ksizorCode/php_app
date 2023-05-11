-- MySQL dump 10.13  Distrib 8.0.16, for macos10.14 (x86_64)
--
-- Host: localhost    Database: local
-- ------------------------------------------------------
-- Server version	8.0.16

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
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(8000) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'test','a@a.com','hello world','615364792');
INSERT INTO `contact` VALUES (2,'test','a@a.com','hello world','615364792');
INSERT INTO `contact` VALUES (3,'john doe','test@test.nl','Hello world!','31615364792');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(256) NOT NULL,
  `pagename` varchar(255) NOT NULL,
  `githublink` varchar(8000) NOT NULL,
  `websitelink` varchar(8000) DEFAULT NULL,
  `p1` varchar(8000) DEFAULT NULL,
  `p2` varchar(8000) DEFAULT NULL,
  `p3` varchar(8000) DEFAULT NULL,
  `p4` varchar(8000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'jpg1.jpg','apresdesheures.com','adh','https://github.com/tcudjoe/apresdesheures','http://apresdesheuresapparel.com/','Apr&#233;s des heur is a starting apparel business (established in 2021) and they want to start selling their products online.','On this platform the user will be able to create an account to make buying products easier, the user will be able to add, remove and edit the amount of products in and to the cart, the user will be able to purchase the products added to the card and will receive a receipt in their mail with their made purchase.','This platform will also have an admin panel for the client to easily add, remove and edit products and many more features.',NULL);
INSERT INTO `projects` VALUES (2,'Screenshot AI_IRA.png','Voice assistant IRA','ira','https://github.com/tcudjoe/AI-voiceAssistant-IRA','','IRA (pronounced Ir-ruh) is an Artificial Intelligence voice assistant which will have Machine Learning implemented in it.','IRA started as an idea that was lingering in my head for quite some time. After using Siri on a daily basis, I wanted to create my own \'Siri\'. After doing some research about home assistants, home automation and voice assistants, I decided to dive into the deep and just start coding.','IRA will be able to take commands and carry those commands out for use in the house. Ira will run on raspberry pi\'s troughout the house with microphones and motion sensors attached to them. The motion sensors will be used to detect in which room the user is so that the raspberry pi in that room is the only one that will respond and listen. All the raspberry pi\'s will be connected to a local server created with flask so users can also communicate with Ira from outside of the house.','');
INSERT INTO `projects` VALUES (3,'whiteonblack.png','ThuisGemaakt (flutter app)','thuisgemaakt','https://github.com/tcudjoe/flutter_app','','Thuisgemaakt is the first ever flutter app I made. It was initially a project for school but I got interested in it and so I decided to go futher with it. This is only ui/ux work. There are no api\'s and/or databases, they are yet to be implemented so stay tuned for updates!','ThuisGemaakt is essentially a big cookbook for those who like to switch up the recipe\'s. Every week, the user receives 7 new recipe\'s to try out for that week. Those recipe\'s will not be repeated the weeks after so every week are completely different recipe\'s. When a recipe is pressed the user gets to see the ingredients, the cook time, prep-time, serving amount and the calories per serving.',NULL,NULL);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(8000) NOT NULL,
  `email` varchar(8000) NOT NULL,
  `password` varchar(32) NOT NULL,
  `userrole` enum('admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','tyra20015@gmail.com','qwertyuiopasdfghjkzxcvbnm1234567','admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-05 22:13:06
