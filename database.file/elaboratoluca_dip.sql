-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: elaboratoluca_dip
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dipendenti`
--

DROP TABLE IF EXISTS `dipendenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dipendenti` (
  `IDdipendente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `luogo_nascita` varchar(30) DEFAULT NULL,
  `sesso` varchar(1) DEFAULT NULL,
  `provincia_sigla` varchar(2) DEFAULT NULL,
  `codice_fiscale` varchar(16) DEFAULT NULL,
  `salario_mensile` decimal(10,2) DEFAULT NULL,
  `ore_lavoro_settimanali` int(11) DEFAULT NULL,
  `email_personale` varchar(50) DEFAULT NULL,
  `email_aziendale` varchar(50) DEFAULT NULL,
  `password_aziendale` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDdipendente`),
  UNIQUE KEY `codice_fiscale` (`codice_fiscale`,`email_personale`,`email_aziendale`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dipendenti`
--

LOCK TABLES `dipendenti` WRITE;
/*!40000 ALTER TABLE `dipendenti` DISABLE KEYS */;
INSERT INTO `dipendenti` VALUES (1,'Giorgio','Bianchi','1986-10-05','Milano','M','MI','BNCGRG85R05F205C',2400.00,36,'giorgio.bianchi@gmail.com','giorgio.bianchi@milanesi.it','giorgio1');
/*!40000 ALTER TABLE `dipendenti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `giorni`
--

DROP TABLE IF EXISTS `giorni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `giorni` (
  `IDgiorno` int(11) NOT NULL AUTO_INCREMENT,
  `giorno` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IDgiorno`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `giorni`
--

LOCK TABLES `giorni` WRITE;
/*!40000 ALTER TABLE `giorni` DISABLE KEYS */;
INSERT INTO `giorni` VALUES (1,'Lun'),(2,'Mar'),(3,'Mer'),(4,'Gio'),(5,'Ven'),(6,'Sab'),(7,'Dom');
/*!40000 ALTER TABLE `giorni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orari_lavorativi`
--

DROP TABLE IF EXISTS `orari_lavorativi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orari_lavorativi` (
  `IDorario_lavorativo` int(11) NOT NULL AUTO_INCREMENT,
  `orario_inizio` time DEFAULT NULL,
  `orario_fine` time DEFAULT NULL,
  `idgiorno` int(11) DEFAULT NULL,
  `iddipendente` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDorario_lavorativo`),
  KEY `idgiorno` (`idgiorno`),
  KEY `iddipendente` (`iddipendente`),
  CONSTRAINT `orari_lavorativi_ibfk_1` FOREIGN KEY (`idgiorno`) REFERENCES `giorni` (`IDgiorno`),
  CONSTRAINT `orari_lavorativi_ibfk_2` FOREIGN KEY (`iddipendente`) REFERENCES `dipendenti` (`IDdipendente`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orari_lavorativi`
--

LOCK TABLES `orari_lavorativi` WRITE;
/*!40000 ALTER TABLE `orari_lavorativi` DISABLE KEYS */;
INSERT INTO `orari_lavorativi` VALUES (1,'09:00:00','17:00:00',1,1),(2,'09:00:00','17:00:00',2,1),(3,'09:00:00','15:00:00',3,1),(4,'09:00:00','17:00:00',4,1),(5,'09:00:00','15:00:00',5,1),(6,NULL,NULL,6,1),(7,NULL,NULL,7,1);
/*!40000 ALTER TABLE `orari_lavorativi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-16  1:13:11
