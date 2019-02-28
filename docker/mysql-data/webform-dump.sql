-- MySQL dump 10.13  Distrib 5.7.23, for osx10.9 (x86_64)
--
-- Host: us-cdbr-iron-east-03.cleardb.net    Database: heroku_5a23e21222f4b1f
-- ------------------------------------------------------
-- Server version	5.5.56-log

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

CREATE DATABASE IF NOT EXISTS `webform`;
USE `webform`;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1902 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` VALUES (2,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"First Form\"},\"data\":[{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"}]}','2019-02-14 00:58:01','2019-02-16 00:05:55',NULL),(12,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"Clone of First Form\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"}]}','2019-02-15 00:21:14','2019-02-15 00:23:40','2019-02-15 00:23:40'),(22,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"Clone of First Form\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"}]}','2019-02-15 00:23:59','2019-02-15 00:23:59',NULL),(32,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"Clone of Clone of First Form\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"}]}','2019-02-15 00:28:15','2019-02-15 00:28:45','2019-02-15 00:28:45'),(42,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"My Form\"},\"data\":[]}','2019-02-16 00:44:39','2019-02-16 00:47:29','2019-02-16 00:47:29'),(52,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"My Form\"},\"data\":[{\"label\":\"Submit Button\",\"button\":\"Submit\",\"id\":\"button\",\"formtype\":\"m14\",\"color\":\"btn-default\"}]}','2019-02-16 00:47:51','2019-02-16 01:00:10','2019-02-16 01:00:10'),(62,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"My Form\"},\"data\":[{\"label\":\"Radio buttons\",\"radios\":\"\\n\\n                        \\n                        \\n                          \\n                          Option one\\n                        \\n                        \\n                          \\n                          Option two\\n                        \\n                      \",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\"}]}','2019-02-16 01:00:32','2019-02-16 01:13:02','2019-02-16 01:13:02'),(72,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"My Form\"},\"data\":[{\"label\":\"Select - Basic\",\"option\":\"\\n                          Enter\\n                          Your\\n                          Options\\n                          Here!\\n                        \",\"id\":\"select_dropdown\",\"formtype\":\"s02\",\"required\":\"true\"},{\"label\":\"Checkboxes\",\"checkboxes\":\"\\n\\n                        \\n                        \\n                          \\n                          Option one\\n                        \\n                        \\n                          \\n                          Option two\\n                        \\n                      \",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Full names\",\"id\":\"state\",\"formtype\":\"s14\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Full names, abbr value\",\"id\":\"state_1\",\"formtype\":\"s15\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Abbreviated\",\"id\":\"state_2\",\"formtype\":\"s16\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"}]}','2019-02-16 01:14:47','2019-02-16 01:27:28','2019-02-16 01:27:28'),(82,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"My Form\"},\"data\":[{\"label\":\"Select - Basic\",\"option\":\"Enter\\n\\t\\t\\t\\t\\t  Your\\n\\t\\t\\t\\t\\t  Options\\n\\t\\t\\t\\t\\t  Here!\",\"id\":\"select_dropdown\",\"formtype\":\"s02\",\"required\":\"true\"},{\"label\":\"Checkboxes\",\"checkboxes\":\"Option one\\n\\t\\t\\t\\t\\t  Option two\",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\"},{\"label\":\"Radio buttons\",\"radios\":\"Option one\\t\\t\\t\\t\\t  Option two\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Full names, abbr value\",\"id\":\"state_1\",\"formtype\":\"s15\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Full names\",\"id\":\"state\",\"formtype\":\"s14\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Abbreviated\",\"id\":\"state_2\",\"formtype\":\"s16\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"}]}','2019-02-16 01:27:46','2019-02-16 01:31:29','2019-02-16 01:31:29'),(92,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"My Form\"},\"data\":[{\"label\":\"Select - Basic\",\"option\":\"Enter\\n\\t\\t\\t\\t\\t  Your\\n\\t\\t\\t\\t\\t  Options\\n\\t\\t\\t\\t\\t  Here!\",\"id\":\"select_dropdown\",\"formtype\":\"s02\",\"required\":\"true\"},{\"label\":\"Checkboxes\",\"checkboxes\":\"Option one\\n\\t\\t\\t\\t\\t  Option two\",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\"},{\"label\":\"Radio buttons\",\"radios\":\"Option one\\n\\t\\t\\t\\t\\t  Option two\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Full names\",\"id\":\"state\",\"formtype\":\"s14\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"}]}','2019-02-16 01:27:47','2019-02-16 01:28:46','2019-02-16 01:28:46'),(102,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"State Test\"},\"data\":[{\"label\":\"Select - Basic\",\"option\":\"Enter\\nYour\\nOptions\\nHere!\",\"id\":\"select_dropdown\",\"formtype\":\"s02\",\"required\":\"true\"},{\"label\":\"Checkboxes\",\"checkboxes\":\"\\n\\n\\n\\nOption one\\n\\n\\n\\nOption two\\n\\n  \",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\"},{\"label\":\"Radio buttons\",\"radios\":\"Option one\\nOption two\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Full names\",\"id\":\"state\",\"formtype\":\"s14\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Full names, abbr value\",\"id\":\"state_1\",\"formtype\":\"s15\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Abbreviated\",\"id\":\"state_2\",\"formtype\":\"s16\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"}]}','2019-02-16 01:31:46','2019-02-21 18:25:25',NULL),(1872,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"My Form\"},\"data\":[{\"label\":\"Radio buttons\",\"radios\":\"one\\ntwo\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\"}]}','2019-02-26 18:03:51','2019-02-26 18:04:43','2019-02-26 18:04:43'),(1882,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"My Form\"},\"data\":[{\"label\":\"Radio buttons\",\"radios\":\"onetwo  \",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":\"Option one\\nOption two\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":\"Option one\\nOption two\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":\"Option one\\nOption two\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\"}]}','2019-02-26 18:05:12','2019-02-26 18:19:11','2019-02-26 18:19:11'),(1892,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"My Form\"},\"data\":[{\"label\":\"Radio buttons\",\"radios\":\"one\\ntwo\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\"}]}','2019-02-26 18:19:35','2019-02-26 18:56:03',NULL);
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (12,'2019_02_12_194453_create_users_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_form`
--

DROP TABLE IF EXISTS `user_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_form` (
  `user_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_form`
--

LOCK TABLES `user_form` WRITE;
/*!40000 ALTER TABLE `user_form` DISABLE KEYS */;
INSERT INTO `user_form` VALUES (2,2,'2019-02-14 00:58:02','2019-02-14 00:58:02',NULL),(2,12,'2019-02-15 00:21:14','2019-02-15 00:23:39','2019-02-15 00:23:39'),(2,22,'2019-02-15 00:24:00','2019-02-15 00:24:00',NULL),(2,32,'2019-02-15 00:28:15','2019-02-15 00:28:44','2019-02-15 00:28:44'),(2,42,'2019-02-16 00:44:39','2019-02-16 00:47:28','2019-02-16 00:47:28'),(2,52,'2019-02-16 00:47:51','2019-02-16 01:00:09','2019-02-16 01:00:09'),(2,62,'2019-02-16 01:00:32','2019-02-16 01:13:01','2019-02-16 01:13:01'),(2,72,'2019-02-16 01:14:47','2019-02-16 01:27:27','2019-02-16 01:27:27'),(2,82,'2019-02-16 01:27:46','2019-02-16 01:31:28','2019-02-16 01:31:28'),(2,92,'2019-02-16 01:27:48','2019-02-16 01:28:45','2019-02-16 01:28:45'),(2,102,'2019-02-16 01:31:47','2019-02-16 01:31:47',NULL),(2,1872,'2019-02-26 18:03:51','2019-02-26 18:04:42','2019-02-26 18:04:42'),(2,1882,'2019-02-26 18:05:13','2019-02-26 18:19:09','2019-02-26 18:19:09'),(2,1892,'2019-02-26 18:19:35','2019-02-26 18:19:35',NULL);
/*!40000 ALTER TABLE `user_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(30) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3812 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2722,'johndoe@example.com','john doe','$2y$12$p2trm6hmAlAJTIgjh5rb3eR.CKD0p4S9k0Fhtsypbqf5u/Gr0t3zq','61b7f105fa2ed81c999d677be184ae13c5a01ab4','2019-02-27 23:12:07',NULL);
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

-- Dump completed on 2019-02-27 15:13:21
