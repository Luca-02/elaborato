-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: elaboratoluca
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
-- Table structure for table `acquisto`
--

DROP TABLE IF EXISTS `acquisto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acquisto` (
  `IDacquisto` int(11) NOT NULL AUTO_INCREMENT,
  `quantita_acquisto` int(11) DEFAULT NULL,
  `idprodotto_taglia` int(11) DEFAULT NULL,
  `idordine` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDacquisto`),
  KEY `idprodotto_taglia` (`idprodotto_taglia`),
  KEY `idordine` (`idordine`),
  CONSTRAINT `acquisto_ibfk_1` FOREIGN KEY (`idprodotto_taglia`) REFERENCES `prodotto_taglia` (`IDprodotto_taglia`),
  CONSTRAINT `acquisto_ibfk_2` FOREIGN KEY (`idordine`) REFERENCES `ordine` (`IDordine`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acquisto`
--

LOCK TABLES `acquisto` WRITE;
/*!40000 ALTER TABLE `acquisto` DISABLE KEYS */;
INSERT INTO `acquisto` VALUES (9,5,8,9),(10,1,9,9),(12,1,35,11);
/*!40000 ALTER TABLE `acquisto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calzatura_oggetto`
--

DROP TABLE IF EXISTS `calzatura_oggetto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calzatura_oggetto` (
  `IDcalzatura_oggetto` int(11) NOT NULL AUTO_INCREMENT,
  `idtipo_oggetto` int(11) DEFAULT NULL,
  `idtipo_calzatura` int(11) DEFAULT NULL,
  `nome` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDcalzatura_oggetto`),
  KEY `idtipo_oggetto` (`idtipo_oggetto`),
  KEY `idtipo_calzatura` (`idtipo_calzatura`),
  CONSTRAINT `calzatura_oggetto_ibfk_1` FOREIGN KEY (`idtipo_oggetto`) REFERENCES `tipo_oggetto` (`IDtipo_oggetto`),
  CONSTRAINT `calzatura_oggetto_ibfk_2` FOREIGN KEY (`idtipo_calzatura`) REFERENCES `tipo_calzatura` (`IDtipo_calzatura`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calzatura_oggetto`
--

LOCK TABLES `calzatura_oggetto` WRITE;
/*!40000 ALTER TABLE `calzatura_oggetto` DISABLE KEYS */;
INSERT INTO `calzatura_oggetto` VALUES (1,1,1,'Abbigliamento uomo'),(2,2,1,'Borse uomo'),(3,3,1,'Calzature uomo'),(4,4,1,'Accessori uomo'),(5,1,2,'Abbigliamento donna'),(6,2,2,'Borse donna'),(7,3,2,'Calzature donna'),(8,4,2,'Accessori donna');
/*!40000 ALTER TABLE `calzatura_oggetto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrello`
--

DROP TABLE IF EXISTS `carrello`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrello` (
  `IDcarrello` int(11) NOT NULL AUTO_INCREMENT,
  `quantita_carrello` int(11) DEFAULT NULL,
  `idutente` int(11) DEFAULT NULL,
  `idprodotto_taglia` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDcarrello`),
  KEY `idutente` (`idutente`),
  KEY `idprodotto_taglia` (`idprodotto_taglia`),
  CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`idutente`) REFERENCES `utenti` (`IDutente`),
  CONSTRAINT `carrello_ibfk_2` FOREIGN KEY (`idprodotto_taglia`) REFERENCES `prodotto_taglia` (`IDprodotto_taglia`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrello`
--

LOCK TABLES `carrello` WRITE;
/*!40000 ALTER TABLE `carrello` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrello` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colore_prodotto`
--

DROP TABLE IF EXISTS `colore_prodotto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colore_prodotto` (
  `IDcolore_prodotto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_colore` varchar(30) DEFAULT NULL,
  `codice_colore` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`IDcolore_prodotto`),
  UNIQUE KEY `codice_colore` (`codice_colore`),
  UNIQUE KEY `nome_colore` (`nome_colore`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colore_prodotto`
--

LOCK TABLES `colore_prodotto` WRITE;
/*!40000 ALTER TABLE `colore_prodotto` DISABLE KEYS */;
INSERT INTO `colore_prodotto` VALUES (1,'nero','#000000'),(2,'blu marino (navy)','#000080'),(3,'bianco','#ffffff'),(4,'arancione medio','#e84d35'),(5,'oro','#ffd261'),(6,'blu scuro','#00022e'),(7,'arancione chiaro','#FF4500'),(8,'blu chiaro','#5DADEC'),(9,'giallo','#FFFF00'),(10,'rosso','#FF0000'),(11,'marrone chiaro','#987654'),(12,'verde chiaro','#1eff00');
/*!40000 ALTER TABLE `colore_prodotto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `immagine_prodotto`
--

DROP TABLE IF EXISTS `immagine_prodotto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `immagine_prodotto` (
  `IDimmagine_prodotto` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDimmagine_prodotto`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `immagine_prodotto`
--

LOCK TABLES `immagine_prodotto` WRITE;
/*!40000 ALTER TABLE `immagine_prodotto` DISABLE KEYS */;
INSERT INTO `immagine_prodotto` VALUES (1,'maglia_nera_adidas.jpg'),(16,'poloRLblunavy.jpg'),(17,'emporio-armani-shirts-white-stretch-cotton-shirt-00000143935f00s011.jpg'),(18,'GN2899-01.jpg'),(19,'3C8D_R15_HERO-scaled.jpg'),(20,'90_EC1GWA9A8-E25188_E899_10_VersaillesPrintHoodedJacket-JacketsandCoats-versace-online-store_0_2.jpg'),(22,'Armani-Exchange-6HZG1B-ZMU5Z-Blu-01.jpg'),(23,'unnamed.jpg'),(24,'felpa-supreme.jpg'),(25,'pantaloni-nike-nsw-swoosh-pant-black-white-206761-1080s-1.jpg'),(26,'pantaloni-tommy-hilfiger-tj-crest-dad-jeans-dark-blue-denim-168048-1080s-1.jpg'),(27,'nike-maglietta-palestra-swoosh-slim-nero-uomo.jpg'),(28,'nike-shorts-doppio-swoosh-nero-uomo.jpg'),(29,'boss-calzoncini-da-bagno-con-coulisse-ed-etichetta-stampata-nero-abbigliamento-mare-uomo.jpg'),(30,'s-l300.jpg'),(31,'92a189f491184517adefcfc9e49a68f1.jpg'),(32,'000NB1909A_001_main.jpg'),(33,'0000207047334_01_ws.jpg'),(34,'gucci-cintura-gg-in-pelle-40mm.jpg'),(35,'zaino-the-north-face-borealis-classic-porta-pc-fino-a-15-nero-t0cf9ckt0-donna-uomo-le-sac-neri-zaini-da-uomo.jpg'),(36,'zaino-sportswear-heritage-G5Wt0h.jpg'),(37,'4440735_500_A.jpg'),(38,'A20---jordan---9A0092023.jpg'),(39,'22501_1.jpg');
/*!40000 ALTER TABLE `immagine_prodotto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodo_pagamento`
--

DROP TABLE IF EXISTS `metodo_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metodo_pagamento` (
  `IDmetodo_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `nome_intestatario` varchar(30) DEFAULT NULL,
  `cognome_intestatario` varchar(30) DEFAULT NULL,
  `numero_carta` varchar(19) DEFAULT NULL,
  `anno_scadenza` int(11) DEFAULT NULL,
  `mese_scadenza` int(11) DEFAULT NULL,
  `cvv` int(11) DEFAULT NULL,
  `idutente` int(11) DEFAULT NULL,
  `saldo_carta` decimal(10,2) NOT NULL,
  PRIMARY KEY (`IDmetodo_pagamento`),
  UNIQUE KEY `numero_carta` (`numero_carta`),
  UNIQUE KEY `numero_carta_2` (`numero_carta`),
  KEY `idutente` (`idutente`),
  CONSTRAINT `metodo_pagamento_ibfk_1` FOREIGN KEY (`idutente`) REFERENCES `utenti` (`IDutente`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodo_pagamento`
--

LOCK TABLES `metodo_pagamento` WRITE;
/*!40000 ALTER TABLE `metodo_pagamento` DISABLE KEYS */;
INSERT INTO `metodo_pagamento` VALUES (15,'Luca','Milanesi','1111-2222-3333-4444',4,2028,123,38,8740.06),(16,'Luca','Milanesi','9999-9999-9999-9999',3,2058,555,38,10000.00),(17,'Mario','Rossi','1212-1212-1212-1212',5,2028,987,39,9970.01);
/*!40000 ALTER TABLE `metodo_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oggetto`
--

DROP TABLE IF EXISTS `oggetto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oggetto` (
  `IDoggetto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_oggetto` varchar(30) DEFAULT NULL,
  `idcalzatura_oggetto` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDoggetto`),
  KEY `idcalzatura_oggetto` (`idcalzatura_oggetto`),
  CONSTRAINT `oggetto_ibfk_1` FOREIGN KEY (`idcalzatura_oggetto`) REFERENCES `calzatura_oggetto` (`IDcalzatura_oggetto`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oggetto`
--

LOCK TABLES `oggetto` WRITE;
/*!40000 ALTER TABLE `oggetto` DISABLE KEYS */;
INSERT INTO `oggetto` VALUES (1,'Giacche e Cappotti',1),(2,'Abiti',1),(3,'Camicie',1),(5,'T-shirts e Polo',1),(6,'Felpe',1),(7,'Pantaloni',1),(8,'Jeans',1),(9,'Abbigliamento Sportivo',1),(10,'Abbigliamento Mare',1),(11,'Intimo e Calze',1),(13,'Zaini',2),(14,'Marsupi',2),(15,'Sneakers',3),(16,'Mocassini',3),(17,'Stivali',3),(18,'Scarpe Sportive',3),(19,'Sandali e Ciabatte',3),(20,'Cinture',1),(21,'Portafogli',4),(22,'Occhiali da Sole',4),(24,'Orologi',4),(25,'Cravatte e Sciarpe',4),(26,'Cappelli e Guanti',4),(28,'Giacche e Cappotti',5),(29,'Abiti',5),(31,'Camicie e Top',5),(33,'T-Shirts e Felpe',5),(34,'Gonne',5),(35,'Pantaloni e Shorts',5),(36,'Jeans',5),(37,'Abbigliamento Sportivo',5),(38,'Abbigliamento Mare',5),(39,'Intimo e Calze',5),(45,'Borsa a spalla',6),(46,'Borsa a mano',6),(47,'Pochette',6),(48,'Zaini e Marsupi',6),(49,'Sandali',7),(50,'Stivali',7),(51,'Décolleté',7),(52,'Sneakers',7),(53,'Ballerine',7),(54,'Scarpe sportive',7),(55,'Cinture',5),(56,'Portafogli',8),(57,'Occhiali da Sole',8),(59,'Orologi',8),(60,'Foulard e Sciarpe',8),(61,'Cappelli e Guanti',8);
/*!40000 ALTER TABLE `oggetto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordine`
--

DROP TABLE IF EXISTS `ordine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordine` (
  `IDordine` int(11) NOT NULL AUTO_INCREMENT,
  `nome_destinatario` varchar(30) DEFAULT NULL,
  `cognome_destinatario` varchar(30) DEFAULT NULL,
  `email_destinatario` varchar(80) DEFAULT NULL,
  `indirizzo` varchar(100) DEFAULT NULL,
  `citta` varchar(30) DEFAULT NULL,
  `provincia` varchar(30) DEFAULT NULL,
  `cap` int(11) DEFAULT NULL,
  `numero_carta_utilizzata` varchar(19) DEFAULT NULL,
  `data_ordine` datetime DEFAULT NULL,
  `idutente` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDordine`),
  KEY `idutente` (`idutente`),
  CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`idutente`) REFERENCES `utenti` (`IDutente`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordine`
--

LOCK TABLES `ordine` WRITE;
/*!40000 ALTER TABLE `ordine` DISABLE KEYS */;
INSERT INTO `ordine` VALUES (9,'Luca','Milanesi','milanesiluca2002@gmail.com','Via Asiago 55, Baranzate','Milano','Baranzate',20021,'**** **** **** 4444','2021-04-29 16:01:42',38),(11,'Luca','Milanesi','milanesiluca2002@gmail.com','Via Asiago 55','Milano','Baranzate',20021,'**** **** **** 4444','2020-04-29 16:31:09',38);
/*!40000 ALTER TABLE `ordine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prodotto`
--

DROP TABLE IF EXISTS `prodotto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prodotto` (
  `IDprodotto` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(50) DEFAULT NULL,
  `idproduttore_prodotto` int(11) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `idoggetto` int(11) DEFAULT NULL,
  `idcolore_prodotto` int(11) DEFAULT NULL,
  `idimmagine_prodotto` int(11) DEFAULT NULL,
  `data_pubblicazione` datetime DEFAULT NULL,
  PRIMARY KEY (`IDprodotto`),
  UNIQUE KEY `titolo` (`titolo`),
  KEY `idoggetto` (`idoggetto`),
  KEY `idcolore_prodotto` (`idcolore_prodotto`),
  KEY `idproduttore_prodotto` (`idproduttore_prodotto`),
  KEY `idimmagine_prodotto` (`idimmagine_prodotto`),
  CONSTRAINT `prodotto_ibfk_1` FOREIGN KEY (`idoggetto`) REFERENCES `oggetto` (`IDoggetto`),
  CONSTRAINT `prodotto_ibfk_2` FOREIGN KEY (`idcolore_prodotto`) REFERENCES `colore_prodotto` (`IDcolore_prodotto`),
  CONSTRAINT `prodotto_ibfk_3` FOREIGN KEY (`idproduttore_prodotto`) REFERENCES `produttore_prodotto` (`IDproduttore_prodotto`),
  CONSTRAINT `prodotto_ibfk_4` FOREIGN KEY (`idimmagine_prodotto`) REFERENCES `immagine_prodotto` (`IDimmagine_prodotto`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prodotto`
--

LOCK TABLES `prodotto` WRITE;
/*!40000 ALTER TABLE `prodotto` DISABLE KEYS */;
INSERT INTO `prodotto` VALUES (1,'t-shirt adidas nera retrò girocollo',1,30.00,5,1,1,'2021-04-01 00:08:10'),(2,'polo ralph lauren blu navy - slim-fit',3,124.99,5,2,16,'2021-04-15 00:08:15'),(3,'camicia di armani in cotone - bianca',2,150.00,3,3,17,'2021-04-20 00:09:10'),(4,'t-shirt adicolor bianca classics trefoil',1,29.99,33,3,18,'2021-04-20 00:09:50'),(5,'giacca retro1996 nuptse the north face',4,280.00,1,4,19,'2021-04-12 00:09:50'),(6,'giacca versace oro con cappuccio ',5,399.99,1,5,20,'2021-04-25 19:25:57'),(12,'armani exchange blazer blu uomo',2,120.00,2,6,22,'2021-05-01 16:16:38'),(13,'felpa the north face arancione',4,139.99,6,7,23,'2021-05-01 16:25:24'),(14,'supreme box logo bianca ',6,550.00,6,3,24,'2021-05-01 16:28:25'),(15,'nike\r\nnsw swoosh pant',7,59.99,7,1,25,'2021-05-01 16:31:17'),(16,'tj crest dad jeans',8,50.00,8,8,26,'2021-05-01 16:34:24'),(17,'nike maglietta palestra swoosh slim nero uomo',7,35.00,9,1,27,'2021-05-01 16:36:54'),(18,'nike shorts doppio swoosh nero uomo',7,50.00,9,1,28,'2021-05-01 16:38:38'),(19,'boss calzoncini da bagno',9,59.99,10,1,29,'2021-05-01 16:43:00'),(20,'costume da bagno adidas - boxer giallo',1,20.00,10,9,30,'2021-05-01 16:47:01'),(21,'calze sportive puma - 6 pezzi',10,13.99,11,1,31,'2021-05-01 16:48:43'),(22,'boxer neri calvin klein',11,25.00,11,1,32,'2021-05-01 17:01:59'),(23,'cintura da uomo calvin klein 40Mm ',11,50.00,20,1,33,'2021-05-01 17:03:56'),(24,'cintura gucci in pelle 40mm',12,250.00,20,1,34,'2021-05-01 17:07:08'),(25,'zaino the north face nero ',4,99.99,13,1,35,'2021-05-01 17:09:53'),(26,'zaino rosso - nike ',7,50.00,13,10,36,'2021-05-01 17:12:47'),(27,'camicia azzurra armani',2,110.00,3,8,37,'2021-05-01 17:25:26'),(28,'marsupio jordan nero',13,29.99,14,1,38,'2021-05-01 17:27:36'),(29,'guess vezzola marsupio con stampa',14,74.99,14,11,39,'2021-05-01 17:31:33');
/*!40000 ALTER TABLE `prodotto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prodotto_taglia`
--

DROP TABLE IF EXISTS `prodotto_taglia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prodotto_taglia` (
  `IDprodotto_taglia` int(11) NOT NULL AUTO_INCREMENT,
  `quantita` int(11) DEFAULT NULL,
  `idtaglia` int(11) DEFAULT NULL,
  `idprodotto` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDprodotto_taglia`),
  KEY `idtaglia` (`idtaglia`),
  KEY `idprodotto` (`idprodotto`),
  CONSTRAINT `prodotto_taglia_ibfk_1` FOREIGN KEY (`idtaglia`) REFERENCES `taglia` (`IDtaglia`),
  CONSTRAINT `prodotto_taglia_ibfk_2` FOREIGN KEY (`idprodotto`) REFERENCES `prodotto` (`IDprodotto`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prodotto_taglia`
--

LOCK TABLES `prodotto_taglia` WRITE;
/*!40000 ALTER TABLE `prodotto_taglia` DISABLE KEYS */;
INSERT INTO `prodotto_taglia` VALUES (8,100,1,1),(9,100,2,1),(10,100,3,1),(12,100,4,1),(13,100,5,1),(14,0,1,2),(15,9,2,2),(16,50,3,2),(17,28,4,2),(18,0,5,2),(19,0,1,3),(20,11,2,3),(21,48,3,3),(22,0,4,3),(23,64,5,3),(24,45,1,4),(25,0,2,4),(26,21,3,4),(27,30,4,4),(28,15,5,4),(29,0,1,5),(30,9,2,5),(31,18,3,5),(32,0,4,5),(33,40,5,5),(34,0,1,6),(35,6,2,6),(36,50,3,6),(37,32,4,6),(38,0,5,6),(56,0,1,12),(57,100,2,12),(58,50,3,12),(59,0,4,12),(60,60,5,12),(61,150,1,13),(62,0,2,13),(63,100,3,13),(64,50,4,13),(65,0,5,13),(66,0,1,14),(67,150,2,14),(68,0,3,14),(69,200,4,14),(70,0,5,14),(71,0,1,15),(72,50,2,15),(73,0,3,15),(74,100,4,15),(75,0,5,15),(76,100,1,16),(77,0,2,16),(78,100,3,16),(79,100,4,16),(80,0,5,16),(81,0,1,17),(82,100,2,17),(83,100,3,17),(84,100,4,17),(85,0,5,17),(86,100,1,18),(87,0,2,18),(88,100,3,18),(89,100,4,18),(90,100,5,18),(91,0,1,19),(92,100,2,19),(93,100,3,19),(94,100,4,19),(95,100,5,19),(96,0,1,20),(97,50,2,20),(98,100,3,20),(99,100,4,20),(100,0,5,20),(101,100,1,21),(102,100,2,21),(103,0,3,21),(104,100,4,21),(105,0,5,21),(106,100,1,22),(107,50,2,22),(108,100,3,22),(109,0,4,22),(110,100,5,22),(111,100,1,23),(112,100,2,23),(113,0,3,23),(114,100,4,23),(115,0,5,23),(116,0,1,24),(117,100,2,24),(118,100,3,24),(119,100,4,24),(120,100,5,24),(121,80,6,25),(122,45,6,26),(123,50,1,27),(124,100,2,27),(125,10,3,27),(126,0,4,27),(127,100,5,27),(128,60,6,28),(129,80,6,29);
/*!40000 ALTER TABLE `prodotto_taglia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produttore_prodotto`
--

DROP TABLE IF EXISTS `produttore_prodotto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produttore_prodotto` (
  `IDproduttore_prodotto` int(11) NOT NULL AUTO_INCREMENT,
  `produttore` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDproduttore_prodotto`),
  UNIQUE KEY `produttore` (`produttore`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produttore_prodotto`
--

LOCK TABLES `produttore_prodotto` WRITE;
/*!40000 ALTER TABLE `produttore_prodotto` DISABLE KEYS */;
INSERT INTO `produttore_prodotto` VALUES (1,'adidas'),(2,'armani'),(9,'boss'),(11,'calvin klein'),(12,'gucci'),(14,'guess'),(13,'jordan'),(7,'nike'),(10,'puma'),(3,'ralph lauren'),(6,'supreme'),(4,'the north face'),(8,'tommy hilfiger'),(16,'valentino'),(5,'versace');
/*!40000 ALTER TABLE `produttore_prodotto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recensioni`
--

DROP TABLE IF EXISTS `recensioni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recensioni` (
  `IDrecensione` int(11) NOT NULL AUTO_INCREMENT,
  `testo_recensione` varchar(1500) DEFAULT NULL,
  `titolo_recensione` varchar(50) DEFAULT NULL,
  `valutazione` int(11) DEFAULT NULL,
  `data_recensione` datetime DEFAULT NULL,
  `idutente` int(11) DEFAULT NULL,
  `idprodotto` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDrecensione`),
  KEY `idutente` (`idutente`),
  KEY `idprodotto` (`idprodotto`),
  CONSTRAINT `recensioni_ibfk_1` FOREIGN KEY (`idutente`) REFERENCES `utenti` (`IDutente`),
  CONSTRAINT `recensioni_ibfk_2` FOREIGN KEY (`idprodotto`) REFERENCES `prodotto` (`IDprodotto`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recensioni`
--

LOCK TABLES `recensioni` WRITE;
/*!40000 ALTER TABLE `recensioni` DISABLE KEYS */;
INSERT INTO `recensioni` VALUES (48,'Ottimo prodotto, consigliato ','Ottimo',5,'2021-04-12 00:37:06',37,3),(49,'Consigliato per tutti','Buon prodotto',4,'2021-04-12 15:32:31',38,5),(50,'Prodotto discreto, buoni materiali','Discreto',3,'2021-04-12 15:34:11',38,4),(51,'Ottimi materiali e ottimo prodotto','Buonissimi materiali',4,'2021-04-12 15:36:04',38,3),(52,'ottimo acquisto','consigliato',4,'2021-04-14 10:43:07',38,2),(56,'Buoni materiali e buon prodotto rispetto al prezzo','Buona qualità prezzo',3,'2021-04-28 18:32:35',38,1),(57,'Ottimi materiali ','Uno dei migliori di sempre ',5,'2021-04-29 00:36:57',39,6);
/*!40000 ALTER TABLE `recensioni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taglia`
--

DROP TABLE IF EXISTS `taglia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taglia` (
  `IDtaglia` int(11) NOT NULL AUTO_INCREMENT,
  `taglia` varchar(30) DEFAULT NULL,
  `idtipo_oggetto` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDtaglia`),
  KEY `idtipo_oggetto` (`idtipo_oggetto`),
  CONSTRAINT `taglia_ibfk_1` FOREIGN KEY (`idtipo_oggetto`) REFERENCES `tipo_oggetto` (`IDtipo_oggetto`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taglia`
--

LOCK TABLES `taglia` WRITE;
/*!40000 ALTER TABLE `taglia` DISABLE KEYS */;
INSERT INTO `taglia` VALUES (1,'XS',1),(2,'S',1),(3,'M',1),(4,'L',1),(5,'XL',1),(6,'none',2),(7,'38',3),(8,'39',3),(9,'39.5',3),(10,'40',3),(11,'40.5',3),(12,'41',3),(13,'41.5',3),(14,'42',3),(15,'42.5',3),(16,'43',3),(17,'43.5',3),(18,'44',3),(19,'44.5',3),(20,'45',3),(21,'none',4);
/*!40000 ALTER TABLE `taglia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_calzatura`
--

DROP TABLE IF EXISTS `tipo_calzatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_calzatura` (
  `IDtipo_calzatura` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDtipo_calzatura`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_calzatura`
--

LOCK TABLES `tipo_calzatura` WRITE;
/*!40000 ALTER TABLE `tipo_calzatura` DISABLE KEYS */;
INSERT INTO `tipo_calzatura` VALUES (1,'Uomo'),(2,'Donna');
/*!40000 ALTER TABLE `tipo_calzatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_oggetto`
--

DROP TABLE IF EXISTS `tipo_oggetto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_oggetto` (
  `IDtipo_oggetto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDtipo_oggetto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_oggetto`
--

LOCK TABLES `tipo_oggetto` WRITE;
/*!40000 ALTER TABLE `tipo_oggetto` DISABLE KEYS */;
INSERT INTO `tipo_oggetto` VALUES (1,'Abbigliamento'),(2,'Borse'),(3,'Calzature'),(4,'Accessori');
/*!40000 ALTER TABLE `tipo_oggetto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utenti` (
  `IDutente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`IDutente`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
INSERT INTO `utenti` VALUES (37,'provaNome','provaCognome','prova@gmail.com','provausername','$2y$10$Sfxywxkei9Splvu6z9i.meC4PBzU83YCtnMXuCRGIRt3hlKthj2zW'),(38,'Luca','Milanesi','milanesiluca2002@gmail.com','mrluca','$2y$10$oetU1Y1TEpu5X/8FmuTeZeZZhabU/yR4XQ2s3CdY.GBqpg2S1.vN.'),(39,'Mario','Rossi','mario.rossi@gmail.com','mario12','$2y$10$UaZm1LkbbV8ZtfjGI72IMecgpfx/bLxZ4E26sLCktNDVqgx.wqJVi');
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-03  0:01:59
