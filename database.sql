-- MySQL dump 10.11
--
-- Host: localhost    Database: wenjianguanli
-- ------------------------------------------------------
-- Server version	5.0.51b-community-nt

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
-- Table structure for table `file_inf`
--

DROP TABLE IF EXISTS `file_inf`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `file_inf` (
  `file_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `type_id` varchar(255) NOT NULL,
  `upload_date` datetime NOT NULL,
  `share` tinyint(4) default NULL,
  `file_size` tinyint(4) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `rem_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `file_inf`
--

LOCK TABLES `file_inf` WRITE;
/*!40000 ALTER TABLE `file_inf` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_inf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_record`
--

DROP TABLE IF EXISTS `log_record`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `log_record` (
  `note_id` varchar(20) NOT NULL,
  `rem_id` varchar(20) NOT NULL,
  `opration` varchar(255) default NULL,
  `op_date` datetime NOT NULL,
  `login_ip` varchar(20) NOT NULL,
  `rem_name` varchar(20) NOT NULL,
  PRIMARY KEY  (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `log_record`
--

LOCK TABLES `log_record` WRITE;
/*!40000 ALTER TABLE `log_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rele_list`
--

DROP TABLE IF EXISTS `rele_list`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `rele_list` (
  `ID` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `rem_id` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `rele_list`
--

LOCK TABLES `rele_list` WRITE;
/*!40000 ALTER TABLE `rele_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `rele_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rem_inf`
--

DROP TABLE IF EXISTS `rem_inf`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `rem_inf` (
  `id` int(10) NOT NULL,
  `rem_id` varchar(20) NOT NULL,
  `rem_password` varchar(20) NOT NULL,
  `login_time` date NOT NULL,
  `lastlogin_date` date NOT NULL,
  `login_count` int(10) NOT NULL,
  `personal_inf` varchar(255) NOT NULL,
  `rem_sex` char(10) NOT NULL default '',
  `rem_email` varchar(20) default NULL,
  PRIMARY KEY  (`rem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `rem_inf`
--

LOCK TABLES `rem_inf` WRITE;
/*!40000 ALTER TABLE `rem_inf` DISABLE KEYS */;
INSERT INTO `rem_inf` VALUES (0,'1234123','12314eqwe','0000-00-00','0000-00-00',0,'','',NULL),(0,'qqqqqq','123123','0000-00-00','2015-11-22',2,'etty','?',NULL),(0,'wwwwww','333333','0000-00-00','2015-11-22',4,'dsfgz','?',NULL);
/*!40000 ALTER TABLE `rem_inf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin','admin');
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

-- Dump completed on 2015-11-23 14:53:34
