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
-- Table structure for table `ocms_alias`
--

DROP TABLE IF EXISTS `ocms_alias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ocms_alias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL,
  `node` int(11) unsigned DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `fk_ocms_alias_node_idx` (`node`),
  CONSTRAINT `fk_ocms_alias_node` FOREIGN KEY (`node`) REFERENCES `ocms_node` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocms_alias`
--

LOCK TABLES `ocms_alias` WRITE;
/*!40000 ALTER TABLE `ocms_alias` DISABLE KEYS */;
INSERT INTO `ocms_alias` VALUES (1,'/blogs',2,NULL),(2,'/about',3,NULL),(3,'/example',4,NULL),(4,'/example/form',NULL,'\\Ocms\\app\\example\\controller\\ExampleFormController::display');
/*!40000 ALTER TABLE `ocms_alias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocms_block`
--

DROP TABLE IF EXISTS `ocms_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ocms_block` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id2_sidebar` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `controller` varchar(100) NOT NULL,
  `display_in_nodes_logic` tinyint(1) NOT NULL,
  `display_in_nodes` varchar(100) NOT NULL,
  `display_in_blog` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ocms_block_sidebar_idx` (`id2_sidebar`),
  CONSTRAINT `fk_ocms_block_sidebar` FOREIGN KEY (`id2_sidebar`) REFERENCES `ocms_sidebar` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocms_block`
--

LOCK TABLES `ocms_block` WRITE;
/*!40000 ALTER TABLE `ocms_block` DISABLE KEYS */;
INSERT INTO `ocms_block` VALUES (1,'right','Right block','This is my right block','',0,'',0),(2,'right','Facebook','Facebook widget','',0,'',0),(3,'left','Left block','This is my left block','',0,'',0),(4,'middle','Blogs','','BLOG_LIST',1,'2',0),(6,'none','Embedded Block Example','<h4>This is an embedded block example<h4>','',0,'',0);
/*!40000 ALTER TABLE `ocms_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocms_blog`
--

DROP TABLE IF EXISTS `ocms_blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ocms_blog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id2_author` int(11) unsigned NOT NULL,
  `id2_category` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `content_date` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `abstract` text NOT NULL,
  `body` text NOT NULL,
  `tags` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ocms_blog_author_idx` (`id2_author`),
  KEY `fk_ocms_blog_category_idx` (`id2_category`),
  CONSTRAINT `fk_ocms_blog_author` FOREIGN KEY (`id2_author`) REFERENCES `ocms_user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_ocms_blog_category` FOREIGN KEY (`id2_category`) REFERENCES `ocms_category` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocms_blog`
--

LOCK TABLES `ocms_blog` WRITE;
/*!40000 ALTER TABLE `ocms_blog` DISABLE KEYS */;
INSERT INTO `ocms_blog` VALUES (1,1,1,'2018-10-01 00:00:00','2018-10-01 00:00:00','Can Bender bend an iPhone6 Plus?','From an engineering standpoint, the iPhone is an amazingly small and delicately constructed device. The only thing really contributing to the structural integrity of the iPhone 6 Plus is the thin aluminum frame that covers the back and reaches around the sides.','<iframe src=\"//www.youtube.com/embed/znK652H6yQM?rel=0\" frameborder=\"0\" width=\"560\" height=\"315\"></iframe><br />\n<br />\nYES! He can. Even not Bender but you - just look how to do it.<br />\n<p>According to experts, though, it probably shouldn\'t be surprising. As Jeremy Irons, a Design Engineer at <a href=\"http://creativeengineering.com/\" target=\"_blank\">Creative Engineering </a>explained:</p><br />\n<p><em>From an engineering standpoint, the iPhone is an amazingly small and delicately constructed device. The only thing really contributing to the structural integrity of the iPhone 6 Plus is the thin aluminum frame that covers the back and reaches around the sides. There is also another very thin piece of steel behind the glass, but we are not working with much as far as bending strength.</em></p><br />\n<p><a href=\"/files/imported/2014-09-iphone6-bender-edition.png\"><img class=\"alignnone size-medium wp-image-351\" title=\"iphone6-bender-edition\" src=\"https://www.it-digest.info/files/imported/2014-09-iphone6-bender-edition-289x300.png\" alt=\"\" width=\"289\" height=\"300\" /></a></p>','bend iPhone Bender','From an engineering standpoint, the iPhone is an amazingly small and delicately constructed device. The only thing really contributing to the structural integrity of the iPhone 6 Plus is the thin aluminum frame that covers the back and reaches around the sides.'),(2,2,2,'2018-11-01 00:00:00','2018-11-01 00:00:00','SQL Joins Diagram','For those about to SQL - we salute you :-)','<p>For those who love SQL :-)</p><p><img src=\"https://www.it-digest.info/files/gallery/it-diagrams/sql-joins.jpg\" alt=\"\"></p><p>Source: <a title=\"Data Visualisation at Google +\" href=\"https://plus.google.com/111053008130113715119/about\" target=\"_blank\">Data Visualisation</a></p>','db join MySQL SQL syntax','For those about to SQL - we salute you :-)');
/*!40000 ALTER TABLE `ocms_blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocms_category`
--

DROP TABLE IF EXISTS `ocms_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ocms_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `label` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocms_category`
--

LOCK TABLES `ocms_category` WRITE;
/*!40000 ALTER TABLE `ocms_category` DISABLE KEYS */;
INSERT INTO `ocms_category` VALUES (1,'News'),(2,'Site News');
/*!40000 ALTER TABLE `ocms_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocms_menu`
--

DROP TABLE IF EXISTS `ocms_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ocms_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id2_node` int(11) unsigned DEFAULT NULL,
  `ranking` int(11) unsigned NOT NULL,
  `parentNodeId` int(11) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ocms_menu_node_idx` (`id2_node`),
  CONSTRAINT `fk_ocms_menu_node` FOREIGN KEY (`id2_node`) REFERENCES `ocms_node` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocms_menu`
--

LOCK TABLES `ocms_menu` WRITE;
/*!40000 ALTER TABLE `ocms_menu` DISABLE KEYS */;
INSERT INTO `ocms_menu` VALUES (1,2,2,0,'/blogs','Blogs'),(2,3,3,0,'/about','About'),(3,1,1,0,'/','Homepage'),(4,4,4,0,'/example','Application Example'),(6,NULL,5,0,'/example/form','Form Example');
/*!40000 ALTER TABLE `ocms_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocms_node`
--

DROP TABLE IF EXISTS `ocms_node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ocms_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(45) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `abstract` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=405 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocms_node`
--

LOCK TABLES `ocms_node` WRITE;
/*!40000 ALTER TABLE `ocms_node` DISABLE KEYS */;
INSERT INTO `ocms_node` VALUES (1,'','Homepage','<h3>Welcome!</h3>','CMS','OCMS Homepage',''),(2,'','Blogs','<h3>Weclome to Blogs!</h3>','blog,blogs','OCMS Blogs',''),(3,'','About','<h3>Welcome to About page!</h3>','about','About OCMS','This is About OCMS page.'),(4,'single','Application Example','<p>This is application controller HTML output example</p><div><ocms:controller>\\Ocms\\app\\example\\controller\\ExampleController::withoutParams</ocms:controller></div><div><ocms:controller>\\Ocms\\app\\example\\controller\\ExampleController::withoutParams</ocms:controller></div>','','',''),(404,'','404 - Page not found','Page not found','','','');
/*!40000 ALTER TABLE `ocms_node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocms_sidebar`
--

DROP TABLE IF EXISTS `ocms_sidebar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ocms_sidebar` (
  `id` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocms_sidebar`
--

LOCK TABLES `ocms_sidebar` WRITE;
/*!40000 ALTER TABLE `ocms_sidebar` DISABLE KEYS */;
INSERT INTO `ocms_sidebar` VALUES ('bottom','Bottom'),('left','Left'),('middle','Middle'),('none','None'),('right','Right'),('top','Top');
/*!40000 ALTER TABLE `ocms_sidebar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocms_user`
--

DROP TABLE IF EXISTS `ocms_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ocms_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocms_user`
--

LOCK TABLES `ocms_user` WRITE;
/*!40000 ALTER TABLE `ocms_user` DISABLE KEYS */;
INSERT INTO `ocms_user` VALUES (1,'opossum','mypass'),(2,'possum','123'),(3,'fox','fox');
/*!40000 ALTER TABLE `ocms_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-20  1:20:13
