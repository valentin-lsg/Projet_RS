-- MySQL dump 10.13  Distrib 5.7.24, for Win64 (x86_64)
--
-- Host: localhost    Database: no
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Table structure for table `commentary`
--

DROP TABLE IF EXISTS `commentary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id_foreign` (`post_id`),
  KEY `user_id_foreign` (`user_id`),
  CONSTRAINT `post_id_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_id_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentary`
--

LOCK TABLES `commentary` WRITE;
/*!40000 ALTER TABLE `commentary` DISABLE KEYS */;
INSERT INTO `commentary` VALUES (1,11,6,'cest bien beau tout ├ºa'),(4,11,6,'hello'),(5,11,6,'commentaire de admin'),(6,15,8,'bravo ! ');
/*!40000 ALTER TABLE `commentary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friendlist`
--

DROP TABLE IF EXISTS `friendlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friendlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `friend_id` int(11) NOT NULL,
  `friend_username` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `friendlist_user_id_foreign` (`user_id`),
  CONSTRAINT `friendlist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friendlist`
--

LOCK TABLES `friendlist` WRITE;
/*!40000 ALTER TABLE `friendlist` DISABLE KEYS */;
INSERT INTO `friendlist` VALUES (9,8,'test',6),(10,7,'admin2',6),(11,9,'cvcvv',6);
/*!40000 ALTER TABLE `friendlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `post` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_post`
--

DROP TABLE IF EXISTS `group_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `who_post` int(10) unsigned NOT NULL,
  `texte` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `commentary` json NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_post_group_id_foreign` (`group_id`),
  KEY `group_post_who_post_foreign` (`who_post`),
  CONSTRAINT `group_post_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE,
  CONSTRAINT `group_post_who_post_foreign` FOREIGN KEY (`who_post`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_post`
--

LOCK TABLES `group_post` WRITE;
/*!40000 ALTER TABLE `group_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send` text NOT NULL,
  `who_send` int(10) unsigned NOT NULL,
  `who_receive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (2,'2022-05-18 08:25:09','test nouvelle db',1,2),(4,'2022-05-18 12:00:18','test mess de autre',1,3),(5,'2022-05-20 11:56:48','a',6,8),(6,'2022-05-20 11:56:55','zz',6,9),(7,'2022-05-20 11:56:57','zz',6,9),(8,'2022-05-20 11:58:02','qq',6,8),(9,'2022-05-20 12:05:49','hbiurn',6,7),(10,'2022-05-22 08:28:02','rijenth',6,6),(11,'2022-05-22 08:28:02','rijenth',6,6),(12,'2022-05-22 08:28:44','salut je suis test',8,6);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `admin` json NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_user_id_foreign` (`user_id`),
  CONSTRAINT `page_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `commentary` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profil_user_id_foreign` (`user_id`),
  CONSTRAINT `profil_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (4,6,'noah','salut noah ','../upload/post/16527049961684082274.png',''),(11,8,'yoyooyyoyo','njfklneljfen','../upload/post/16527966891091481610.png',''),(12,6,'Ma nouvelle publication !','eifezfj','../upload/post/16528009731806651709.png',''),(15,6,'mon nouveau post','ceci est un contenu',NULL,''),(16,6,'Ma photo de profil','est incroyable','../upload/post/1653213655982493422.png','');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profil`
--

DROP TABLE IF EXISTS `profil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner` varchar(255) NOT NULL,
  `profil_picture` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profil_id_foreign_key` (`user_id`),
  CONSTRAINT `profil_id_foreign_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profil`
--

LOCK TABLES `profil` WRITE;
/*!40000 ALTER TABLE `profil` DISABLE KEYS */;
INSERT INTO `profil` VALUES (1,'../upload/default_banner.png','../upload/default_pp.png','Ceci est la description de imageban',1),(4,'../upload/default_banner.png','../upload/default_pp.png','Ceci est la description de egjoziegjze',4),(5,'../upload/default_banner.png','../upload/default_pp.png','Ceci est la description de rtyvubhinjo',5),(6,'../upload/profil/admin/banner/16530532521299876361.png','../upload/profil/admin/profilPicture/16530532522063134516.png','Bonjour, je suis l\'admin ! ',6),(7,'../upload/default/default_banner.png','../upload/default/default_pp.png','Ceci est la description de admin2',7),(8,'../upload/default/default_banner.png','../upload/profil/test/profilPicture/1652980902327079186.png','Ceci est la description de test',8),(9,'../upload/default/default_banner.png','../upload/default/default_pp.png','Ceci est la description de cvcvv',9),(10,'../upload/default/default_banner.png','../upload/default/default_pp.png','Ceci est la description de GREGE',10);
/*!40000 ALTER TABLE `profil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_membership`
--

DROP TABLE IF EXISTS `user_membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_membership` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `user_group` int(10) unsigned NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_candidate` tinyint(1) NOT NULL,
  `is_member` tinyint(1) NOT NULL,
  `is_exclude` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_membership_user_id_foreign` (`user_id`),
  KEY `user_membership_user_group_foreign` (`user_group`),
  CONSTRAINT `user_membership_user_group_foreign` FOREIGN KEY (`user_group`) REFERENCES `group` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_membership_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_membership`
--

LOCK TABLES `user_membership` WRITE;
/*!40000 ALTER TABLE `user_membership` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_membership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `phone` char(10) NOT NULL,
  `account_state` enum('0','1') DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test','test','test@mvcdlg.Fr','France','$2y$10$yVpQ1YYb8qA/O64npmbArOhObYAbC.IHHiOvr4cZdH1TDmZ/T0pUG','2000-01-01','0611223344','0','imageban'),(4,'fezrthsdyj','hubijnklrety','grger@live.fr','France','$2y$10$w70HB0Vk3jegVwLlrb0ONuHLZ2ozMefbg4TUN54X5Ym8inF4QbbNG','2000-01-01','0612345678','0','egjoziegjze'),(5,'cytvubi','cyvubi','vuybi@live.Fr','France','$2y$10$FKwbrT4n12QhuS2AG05vbuap0LVASSQ/b5CjVVxKPTjnzL/LgAMba','2000-01-01','0611223344','0','rtyvubhinjo'),(6,'admin','admin','admin@admin.admin','France','$2y$10$vXCkM2MC4jc6QTtqspbM1.focO6odDUgDfsLFx4AhmXVgxJ7C27ti','2021-04-01','0611223344','0','admin'),(7,'admin2','aizodnajfn','test123@test123.fr','France','$2y$10$03QvPxravI79rV6/5sjBl.nd/ME42Eaxe2yoErSjnbtcGoBEQ.K72','1990-03-15','0622334455','0','admin2'),(8,'zaoifnaiofn','ivonezknzei','izgze@live.Fr','France','$2y$10$2dxBBO3BY7t6xu5WBDv5C.onvH27ivJBcp9fRa.9u/YbBcaXozUh.','2007-07-07','0707070707','0','test'),(9,'yyy','hyyyy','dsfs@live.fr','France','$2y$10$llWHTZwsa5703sUCxp2CBOm62/JrX4RhxLzHpulb7SZYpA4hGG09W','9999-09-09','0611223344','0','cvcvv'),(10,'rijenth13','test','gregerg@gmail.com','France','$2y$10$Qgba.kr9Wv/.3sIKGMpQ.e71srIJCo/teR7NeazOZpnoUJrPoxXCu','9999-12-10','0622334455','0','GREGE');
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

-- Dump completed on 2022-05-22 23:40:05
