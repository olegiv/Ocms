-- MySQL dump 10.13  Distrib 8.0.15, for macos10.14 (x86_64)
--
-- Host: localhost    Database: ocms
-- ------------------------------------------------------
-- Server version	8.0.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alias`
--

DROP TABLE IF EXISTS `alias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `alias` (
                       `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                       `alias` varchar(255) NOT NULL,
                       `node` int(11) unsigned DEFAULT NULL,
                       `controller` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
                       PRIMARY KEY (`id`),
                       UNIQUE KEY `alias` (`alias`),
                       KEY `fk_ocms_alias_node_idx` (`node`),
                       CONSTRAINT `fk_ocms_alias_node` FOREIGN KEY (`node`) REFERENCES `node` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alias`
--

LOCK TABLES `alias` WRITE;
/*!40000 ALTER TABLE `alias` DISABLE KEYS */;
INSERT INTO `alias` VALUES (1,'/blog',2,NULL),(2,'/about',3,NULL),(3,'/example',4,NULL),(4,'/example/form',NULL,'\\Ocms\\app\\example\\controller\\ExampleFormController::display'),(5,'/migration',NULL,'\\Ocms\\core\\app\\blog\\controller\\MigrationController::migrate'),(6,'/download',5,NULL);
/*!40000 ALTER TABLE `alias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `block`
--

DROP TABLE IF EXISTS `block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `block` (
                       `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                       `id2_sidebar` varchar(100) NOT NULL,
                       `title` varchar(255) NOT NULL,
                       `body` text NOT NULL,
                       `controller` varchar(100) NOT NULL,
                       `display_in_nodes_logic` tinyint(1) NOT NULL,
                       `display_in_nodes` varchar(100) NOT NULL,
                       `display_in_blog` tinyint(1) NOT NULL,
                       `display_title` tinyint(1) NOT NULL,
                       PRIMARY KEY (`id`),
                       KEY `fk_ocms_block_sidebar_idx` (`id2_sidebar`),
                       CONSTRAINT `fk_ocms_block_sidebar` FOREIGN KEY (`id2_sidebar`) REFERENCES `sidebar` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `block`
--

LOCK TABLES `block` WRITE;
/*!40000 ALTER TABLE `block` DISABLE KEYS */;
INSERT INTO `block` VALUES (1,'right','Right block','This is my right block','',0,'',0,1),(2,'right','Facebook','Facebook widget','',0,'',0,1),(3,'left','Left block','This is my left block','',0,'',0,1),(4,'middle','Blogs','','BLOG_LIST',1,'2',0,0),(6,'none','Embedded Block Example','<h4>This is an embedded block example<h4>','',0,'',0,1);
/*!40000 ALTER TABLE `block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `blog` (
                      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                      `id2_author` int(11) unsigned NOT NULL,
                      `id2_category` int(11) unsigned NOT NULL,
                      `created` datetime NOT NULL,
                      `content_date` datetime NOT NULL,
                      `thumbnail` varchar(255) NOT NULL,
                      `title` varchar(255) NOT NULL,
                      `tags` varchar(255) NOT NULL,
                      `abstract` text NOT NULL,
                      `body` text NOT NULL,
                      `description` text NOT NULL,
                      PRIMARY KEY (`id`),
                      KEY `fk_ocms_blog_author_idx` (`id2_author`),
                      KEY `fk_ocms_blog_category_idx` (`id2_category`),
                      CONSTRAINT `fk_ocms_blog_author` FOREIGN KEY (`id2_author`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
                      CONSTRAINT `fk_ocms_blog_category` FOREIGN KEY (`id2_category`) REFERENCES `category` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (100,1,1,'2018-10-01 00:00:00','2018-10-01 00:00:00','','Can Bender bend an iPhone6 Plus?','','From an engineering standpoint, the iPhone is an amazingly small and delicately constructed device. The only thing really contributing to the structural integrity of the iPhone 6 Plus is the thin aluminum frame that covers the back and reaches around the sides.','\n<p>\n	YES! He can. Even not Bender but you - just look how to do it.\n</p>\n<p data-textannotation-id=\"0e32af19d50fcba027757a08c4af7aed\">\n	According to experts, though, it probably shouldn\'t be surprising. As Jeremy Irons, a Design Engineer at&nbsp;<a href=\"http://creativeengineering.com/\" target=\"_blank\">Creative Engineering&nbsp;</a>explained:\n</p>\n<p data-textannotation-id=\"c1830b3478b878fd3201e5c7712336af\">\n	<em>From an engineering standpoint, the iPhone is an amazingly small and delicately constructed device. The only thing really contributing to the structural integrity of the iPhone 6 Plus is the thin aluminum frame that covers the back and reaches around the sides. There is also another very thin piece of steel behind the glass, but we are not working with much as far as bending strength.</em>\n</p>','From an engineering standpoint, the iPhone is an amazingly small and delicately constructed device. The only thing really contributing to the structural integrity of the iPhone 6 Plus is the thin aluminum frame that covers the back and reaches around the sides.'),(101,2,2,'2018-11-01 00:00:00','2018-11-01 00:00:00','','SQL Joins Diagram','','For those about to SQL - we salute you :-)','<p>\n	For those about to SQL - we salute you :-)\n</p>\n\n<p>\n	Source: <a title=\"Data Visualisation at Google +\" href=\"https://plus.google.com/111053008130113715119/about\" target=\"_blank\">Data Visualisation</a>\n</p>','For those about to SQL - we salute you :-)');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `category` (
                          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                          `label` varchar(255) NOT NULL,
                          PRIMARY KEY (`id`),
                          UNIQUE KEY `label` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'News'),(2,'Site News');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `menu` (
                      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                      `id2_node` int(11) unsigned DEFAULT NULL,
                      `ranking` int(11) unsigned NOT NULL,
                      `parentNodeId` int(11) unsigned NOT NULL,
                      `url` varchar(255) NOT NULL,
                      `label` varchar(255) NOT NULL,
                      PRIMARY KEY (`id`),
                      KEY `fk_ocms_menu_node_idx` (`id2_node`),
                      CONSTRAINT `fk_ocms_menu_node` FOREIGN KEY (`id2_node`) REFERENCES `node` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,2,3,0,'/blog','Blogs'),(2,3,4,0,'/about','About'),(3,1,1,0,'/','Homepage'),(4,4,5,0,'/example','Application Example'),(6,NULL,6,0,'/example/form','Form Example'),(7,5,2,0,'/download','Download');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node`
--

DROP TABLE IF EXISTS `node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `node` (
                      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                      `template` varchar(45) NOT NULL,
                      `title` varchar(255) NOT NULL,
                      `tags` varchar(255) NOT NULL,
                      `body` text NOT NULL,
                      `abstract` text NOT NULL,
                      `description` text NOT NULL,
                      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=405 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node`
--

LOCK TABLES `node` WRITE;
/*!40000 ALTER TABLE `node` DISABLE KEYS */;
INSERT INTO `node` VALUES (1,'','OCMS Homepage','','<h3>Welcome!</h3>','','OCMS Homepage'),(2,'','Blogs','','<h3>Weclome to OCMS Blogs!</h3>','','OCMS Blogs'),(3,'','About','','<h3>Welcome to About page!</h3>','This is About OCMS page.','About OCMS'),(4,'single','Application Example','','<p>This is application controller HTML output example</p><div><ocms:controller>\\Ocms\\app\\example\\controller\\ExampleController::withoutParams</ocms:controller></div><div><ocms:controller>\\Ocms\\app\\example\\controller\\ExampleController::withoutParams</ocms:controller></div>','',''),(5,'','Download OCMS','','<p>Get started by downloading OCMS core files.\n    These official releases come bundled with modules and themes to give you a good starting point to help build your site.</p>\n\n<h2>Download the latest release from Github</h2>\n\n<ul>\n    <li><a href=\"https://github.com/olegiv/Ocms/releases/latest\" target=\"_blank\">Download source code</a></li>\n    <li><a href=\"https://github.com/olegiv/Ocms/releases\" target=\"_blank\">Changelog</a></li>\n    <li><a href=\"https://github.com/olegiv/Ocms/blob/master/LICENSE.txt\" target=\"\">License</a></li>\n</ul>\n\n<h2>Download using Composer</h2>\n\n<pre>$ composer create-project ocms/ocms-core</pre>\n\n<h2>Previous releases</h2>\n\n<p>For previous releases, visit the <a href=\"https://github.com/olegiv/Ocms/releases\" target=\"\">Github release page</a>.</p>','',''),(404,'','404 - Page not found','','Page not found','','');
/*!40000 ALTER TABLE `node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sidebar`
--

DROP TABLE IF EXISTS `sidebar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `sidebar` (
                         `id` varchar(100) NOT NULL,
                         `title` varchar(100) NOT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sidebar`
--

LOCK TABLES `sidebar` WRITE;
/*!40000 ALTER TABLE `sidebar` DISABLE KEYS */;
INSERT INTO `sidebar` VALUES ('bottom','Bottom'),('left','Left'),('middle','Middle'),('none','None'),('right','Right'),('top','Top');
/*!40000 ALTER TABLE `sidebar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `tag` (
                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                     `label` varchar(255) NOT NULL,
                     PRIMARY KEY (`id`),
                     UNIQUE KEY `label_UNIQUE` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
                      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                      `username` varchar(100) NOT NULL,
                      `password` varchar(100) NOT NULL,
                      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'opossum','mypass'),(2,'possum','123'),(3,'fox','fox');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-26 23:59:08