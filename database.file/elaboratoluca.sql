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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acquisto`
--

LOCK TABLES `acquisto` WRITE;
/*!40000 ALTER TABLE `acquisto` DISABLE KEYS */;
INSERT INTO `acquisto` VALUES (9,5,8,9),(10,2,9,9),(12,3,35,11),(14,1,259,13),(19,1,20,15),(20,1,433,16),(21,2,23,17),(22,2,304,18),(23,1,305,18),(24,1,280,18),(25,1,433,18),(26,1,246,19),(27,1,247,19),(28,2,61,19),(29,1,192,19),(30,1,274,20),(31,1,262,21),(32,2,249,22),(33,1,197,23),(34,1,263,24),(35,1,108,25),(36,1,233,26);
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
) ENGINE=InnoDB AUTO_INCREMENT=287 DEFAULT CHARSET=utf8mb4;
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colore_prodotto`
--

LOCK TABLES `colore_prodotto` WRITE;
/*!40000 ALTER TABLE `colore_prodotto` DISABLE KEYS */;
INSERT INTO `colore_prodotto` VALUES (1,'nero','#000000'),(2,'blu marino (navy)','#000080'),(3,'bianco','#ffffff'),(4,'arancione medio','#e84d35'),(5,'oro','#ffd261'),(6,'blu scuro','#00022e'),(7,'arancione chiaro','#FF4500'),(8,'blu chiaro','#5DADEC'),(9,'giallo','#FFFF00'),(10,'rosso','#FF0000'),(11,'marrone chiaro','#987654'),(12,'verde chiaro','#1eff00'),(13,'giallo acceso','#d4ff00'),(14,'verde scuro','#028a00'),(15,'blu','#015fda'),(16,'arancione scuro','#c76a00'),(17,'viola','#5900ff'),(18,'tiffany','#bdffe9'),(19,'beige','#ffdc7a'),(20,'argento','#d1d1d1'),(21,'cafe creme','#ff99a3');
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
  PRIMARY KEY (`IDimmagine_prodotto`),
  UNIQUE KEY `file_name` (`file_name`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `immagine_prodotto`
--

LOCK TABLES `immagine_prodotto` WRITE;
/*!40000 ALTER TABLE `immagine_prodotto` DISABLE KEYS */;
INSERT INTO `immagine_prodotto` VALUES (33,'0000207047334_01_ws.jpg'),(32,'000NB1909A_001_main.jpg'),(41,'01.jpg'),(79,'047368-fv.jpg'),(67,'0DLVHB018marrone-01.jpg'),(45,'11529521-1.jpg'),(43,'1161785.jpg'),(51,'147351_4G704_2766_002_100_0000_Light-Sciarpa-in-lana-jacquard-con-motivo-GG-e-Web.jpg'),(50,'14745362_24960438_300.jpg'),(39,'22501_1.jpg'),(46,'39-valigeria-ambrosetti-calvin-klein-portafoglio-nero-uomo-k50k500915-600x600.jpg'),(19,'3C8D_R15_HERO-scaled.jpg'),(37,'4440735_500_A.jpg'),(82,'446x669-guanti-donna-guess-neri-aw8207-wol02-bla.jpg'),(42,'450892A9L601098nero-02.jpg'),(60,'462569ZIJ151000nero-02.jpg'),(80,'598993_3GC15_9764_001_100_0000_Light-Sciarpa-in-lana-con-motivo-GG-jacquard.jpg'),(68,'68f39f1c817d8dad1111f0b5f491cbe044e26495_000140830021260_00_1.jpg'),(66,'90_AUD01039-A232741_A1203_10_GrecaBorderSportsBra-Bras-versace-online-store_5_0.jpg'),(59,'90_EA9HWA318-ES0148_E899_10_LogoBaroquePrintPleatedSkirt-Skirts-versace-online-store_0_1.jpg'),(20,'90_EC1GWA9A8-E25188_E899_10_VersaillesPrintHoodedJacket-JacketsandCoats-versace-online-store_0_2.jpg'),(56,'90_ED2HWA440-ES0990_E899_10_LogoBaroquePrintDress-Dresses-versace-online-store_0_0.jpg'),(31,'92a189f491184517adefcfc9e49a68f1.jpg'),(48,'963411281_o.jpg'),(52,'A1EZS001-hero.jpg'),(38,'A20---jordan---9A0092023.jpg'),(64,'abbigliamento-mare-donna-versace-costume-intero-versace-x-pride-nero.jpg'),(22,'Armani-Exchange-6HZG1B-ZMU5Z-Blu-01.jpg'),(76,'ba36cec504804875ae06fbc194ff7e0a.jpg'),(72,'bf55d3a8e2eb260bf3ecffaae6db5557.jpg'),(71,'BH6031H0VL001-02-01.jpg'),(29,'boss-calzoncini-da-bagno-con-coulisse-ed-etichetta-stampata-nero-abbigliamento-mare-uomo.jpg'),(57,'Camicia-donna-Armani-jeans-OUSKILA-Blu-Armani-jeans-8057015634906.jpg'),(81,'efd4d8e8b95f455aac8d3b1229281188.jpg'),(17,'emporio-armani-shirts-white-stretch-cotton-shirt-00000143935f00s011.jpg'),(58,'felpa-donna-adidas-24-1.jpg'),(24,'felpa-supreme.jpg'),(18,'GN2899-01.jpg'),(63,'gucci-cintura-donna-vera-pelle-nuova-originale-fr-moda-neri.jpg'),(34,'gucci-cintura-gg-in-pelle-40mm.jpg'),(78,'gucci-gg0875s.jpg'),(74,'image_10667_3.jpg'),(75,'img_2d_0001_large_78_107.jpg'),(49,'iwc-iw371491-image-66848-951603.jpg'),(65,'jdit_product_list.jpg'),(61,'jeans-501-cropped-boyfriend-con-strappi-donna-denim-chiaro_31080_zoom.jpg'),(73,'jordan-air-jordan-1-retro-high-og-nrg-white-black-igloo-861428-100-1_1.jpg'),(1,'maglia_nera_adidas.jpg'),(69,'moschinopp.jpg'),(40,'nike-air-force-1-07.jpg'),(54,'nike-air-force-1-low-x-travis-scott-cactus-jack-.jpg'),(27,'nike-maglietta-palestra-swoosh-slim-nero-uomo.jpg'),(28,'nike-shorts-doppio-swoosh-nero-uomo.jpg'),(25,'pantaloni-nike-nsw-swoosh-pant-black-white-206761-1080s-1.jpg'),(26,'pantaloni-tommy-hilfiger-tj-crest-dad-jeans-dark-blue-denim-168048-1080s-1.jpg'),(16,'poloRLblunavy.jpg'),(47,'ray-ban-aviator-rb-3025-polarizzato.jpg'),(30,'s-l300.jpg'),(44,'S311000071-1_09f952dc-154f-4bdb-a2cd-10de04f53adf.jpg'),(53,'S4055390_JK3.jpg'),(62,'t-shirt-trefoil.jpg'),(55,'the-north-face-nuptse-crop-giacca-donna-viola-152store-neri-piumini-corti.jpg'),(23,'unnamed.jpg'),(77,'valentinobag.jpg'),(70,'zaino-donna-alviero-martini-prima-classe_2881428.jpg'),(36,'zaino-sportswear-heritage-G5Wt0h.jpg'),(35,'zaino-the-north-face-borealis-classic-porta-pc-fino-a-15-nero-t0cf9ckt0-donna-uomo-le-sac-neri-zaini-da-uomo.jpg');
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodo_pagamento`
--

LOCK TABLES `metodo_pagamento` WRITE;
/*!40000 ALTER TABLE `metodo_pagamento` DISABLE KEYS */;
INSERT INTO `metodo_pagamento` VALUES (15,'Luca','Milanesi','1111-2222-3333-4444',4,2028,123,38,100000.00),(16,'Luca','Milanesi','9999-9999-9999-9999',3,2058,555,38,100000.00),(17,'Mario','Rossi','1212-1212-1212-1212',5,2028,987,39,99965.00),(18,'giorgia','verdi','5555-5555-5555-5555',8,2030,555,46,100000.00),(19,'provaNome','provaCognome','8888-8888-8888-8888',8,2040,888,37,99977.50);
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
INSERT INTO `oggetto` VALUES (1,'Giacche e Cappotti',1),(2,'Abiti',1),(3,'Camicie',1),(5,'T-shirts e Polo',1),(6,'Felpe',1),(7,'Pantaloni',1),(8,'Jeans',1),(9,'Abbigliamento Sportivo',1),(10,'Abbigliamento Mare',1),(11,'Intimo e Calze',1),(13,'Zaini',2),(14,'Marsupi',2),(15,'Sneakers',3),(16,'Mocassini',3),(17,'Stivali',3),(18,'Scarpe Sportive',3),(19,'Sandali e Ciabatte',3),(20,'Cinture',1),(21,'Portafogli',4),(22,'Occhiali da Sole',4),(24,'Orologi',4),(25,'Cravatte e Sciarpe',4),(26,'Cappelli e Guanti',4),(28,'Giacche e Cappotti',5),(29,'Abiti',5),(31,'Camicie e Top',5),(33,'T-Shirts e Felpe',5),(34,'Gonne',5),(35,'Pantaloni e Shorts',5),(36,'Jeans',5),(37,'Abbigliamento Sportivo',5),(38,'Abbigliamento Mare',5),(39,'Intimo e Calze',5),(45,'Borsa a spalla',6),(46,'Borsa a mano',6),(47,'Pochette',6),(48,'Zaini e Marsupi',6),(50,'Stivali',7),(51,'Décolleté',7),(52,'Sneakers',7),(53,'Ballerine',7),(54,'Scarpe sportive',7),(55,'Cinture',5),(56,'Portafogli',8),(57,'Occhiali da Sole',8),(59,'Orologi',8),(60,'Foulard e Sciarpe',8),(61,'Cappelli e Guanti',8);
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
  `latitudine` varchar(25) DEFAULT NULL,
  `longitudine` varchar(25) DEFAULT NULL,
  `altitudine` varchar(25) DEFAULT NULL,
  `idutente` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDordine`),
  KEY `idutente` (`idutente`),
  CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`idutente`) REFERENCES `utenti` (`IDutente`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordine`
--

LOCK TABLES `ordine` WRITE;
/*!40000 ALTER TABLE `ordine` DISABLE KEYS */;
INSERT INTO `ordine` VALUES (9,'Luca','Milanesi','milanesiluca2002@gmail.com','Via Asiago 55','Milano','Baranzate',20021,'**** **** **** 4444','2021-04-29 16:01:42','45.52473361299953','9.122385551623362','12',38),(11,'Luca','Milanesi','milanesiluca2002@gmail.com','Via Asiago 55','Milano','Baranzate',20021,'**** **** **** 4444','2020-04-29 16:31:09','45.52473361299953','9.122385551623362','12',38),(13,'Luca','Milanesi','milanesiluca2002@gmail.com','Via Asiago 55','milano','Baranzate',20021,'**** **** **** 4444','2021-05-05 00:26:12','45.52473361299953','9.122385551623362','12',38),(15,'mario','rossi','mario.rossi@gmail.com','via varalli 1 ','Milano','Baranzate',20021,'**** **** **** 1212','2021-05-06 23:37:25','45.52473361299953','9.125977779304236','0',39),(16,'mario','rossi','mario.rossi@gmail.com','via varalli 1','milano','bollate',20021,'**** **** **** 1212','2021-05-06 23:38:29','45.52473361299953','9.125977779304236','0',39),(17,'mario','rossi','mario.rossi@gmail.com','via varalli 1','milano','bollate',20021,'**** **** **** 1212','2021-05-06 23:39:25','45.52473361299953','9.125977779304236','0',39),(18,'giorgia','verdi','giorgia.verdi@gmail.com','corso europa 5','milano','milano',20122,'**** **** **** 5555','2021-05-06 23:48:48','45.4639915862949','9.195855203838882','0',46),(19,'provaNome','provaCognome','prova@gmail.com','Via prima strada 5','milano','lainate',20020,'**** **** **** 8888','2021-05-06 23:53:39','45.55225505768646','9.023923943646663','20',37),(20,'Luca','Milanesi','milanesiluca2002@gmail.com','Via Asiago 55','Milano','Baranzate',20021,'**** **** **** 4444','2021-05-07 16:49:20','45.52473361299953','9.122385551623362','12',38),(21,'Milano','Milanesi','milanesiluca2002@gmail.com','Via Asiago 55','Milano','Baranzate',20021,'**** **** **** 4444','2021-05-10 22:53:29','45.52473361299953','9.122385551623362','12',38),(22,'provaNome','provaCognome','prova@gmail.com','Via prima strada 5','lainate','milano',20045,'**** **** **** 8888','2021-05-10 23:05:36','45.55225505768646','9.023923943646663','20',37),(23,'provaNome','provaCognome','prova@gmail.com','Via prima strada 5','Milano','lainate',20045,'**** **** **** 8888','2021-05-15 17:17:09','123','123','123',37),(24,'provaNome','provaCognome','prova@gmail.com','Via prima strada 5','provaNome','milano',20045,'**** **** **** 8888','2021-05-15 17:18:35','123','123','123',37),(25,'provaNome','provaCognome','prova@gmail.com','Via prima strada 5','provaNome','milano',20045,'**** **** **** 8888','2021-05-15 17:47:25','123','123','123',37),(26,'mario','rossi','mario.rossi@gmail.com','Via Giovanni Da Milano 2','milano','milano',20133,'**** **** **** 1212','2021-05-15 17:57:41','111112312','51251255','2131231.231231',39);
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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prodotto`
--

LOCK TABLES `prodotto` WRITE;
/*!40000 ALTER TABLE `prodotto` DISABLE KEYS */;
INSERT INTO `prodotto` VALUES (1,'t-shirt adidas nera retrò girocollo',1,30.00,5,1,1,'2021-04-01 00:08:10'),(2,'polo ralph lauren blu navy - slim-fit',3,124.99,5,2,16,'2021-04-15 00:08:15'),(3,'camicia di armani in cotone - bianca',2,150.00,3,3,17,'2021-04-20 00:09:10'),(4,'t-shirt adicolor bianca classics trefoil',1,29.99,33,3,18,'2021-04-20 00:09:50'),(5,'giacca retro1996 nuptse the north face',4,280.00,1,4,19,'2021-04-12 00:09:50'),(6,'giacca versace oro con cappuccio ',5,399.99,1,5,20,'2021-04-25 19:25:57'),(12,'armani exchange blazer blu uomo',2,120.00,2,6,22,'2021-05-01 16:16:38'),(13,'felpa the north face arancione',4,139.99,6,7,23,'2021-05-08 16:25:24'),(14,'supreme box logo bianca ',6,550.00,6,3,24,'2021-05-01 16:28:25'),(15,'nike nsw swoosh pant',7,59.99,7,1,25,'2021-05-01 16:31:17'),(16,'tj crest dad jeans',8,50.00,8,8,26,'2021-05-01 16:34:24'),(17,'nike maglietta palestra swoosh slim ',7,35.00,9,1,27,'2021-05-01 16:36:54'),(18,'nike shorts doppio swoosh nero uomo',7,50.00,9,1,28,'2021-05-01 16:38:38'),(19,'boss calzoncini da bagno',9,59.99,10,1,29,'2021-05-01 16:43:00'),(20,'costume da bagno adidas - boxer giallo',1,20.00,10,9,30,'2021-05-01 16:47:01'),(21,'calze sportive puma - 6 pezzi',10,13.99,11,1,31,'2021-05-01 16:48:43'),(22,'boxer neri calvin klein',11,25.00,11,1,32,'2021-05-01 17:01:59'),(23,'cintura da uomo calvin klein 40Mm ',11,50.00,20,1,33,'2021-05-01 17:03:56'),(24,'cintura gucci in pelle 40mm',12,250.00,20,1,34,'2021-05-01 17:07:08'),(25,'zaino the north face nero ',4,99.99,13,1,35,'2021-05-01 17:09:53'),(26,'zaino rosso - nike ',7,50.00,13,10,36,'2021-05-01 17:12:47'),(27,'camicia azzurra armani',2,110.00,3,8,37,'2021-05-01 17:25:26'),(28,'marsupio jordan nero',13,29.99,14,1,38,'2021-05-01 17:27:36'),(29,'guess vezzola marsupio con stampa',14,74.99,14,11,39,'2021-05-01 17:31:33'),(33,'nike air force 1',7,110.00,15,3,40,'2021-05-04 22:07:40'),(34,'yeezy boost 350 v2 semi frozen yellow',1,349.99,15,13,41,'2021-05-08 22:21:40'),(35,'mocassini uomo in pelle ',12,450.00,16,1,42,'2021-05-04 22:23:54'),(36,'stivali uomo timberland icon waterproof',17,155.00,17,5,43,'2021-05-04 22:27:07'),(37,'scarpe sportive nike - nere',7,35.00,18,1,44,'2021-05-04 22:30:16'),(38,'ciabatte the north face',4,38.00,19,1,45,'2021-05-04 22:31:44'),(39,'portafoglio ck uomo',11,60.00,21,1,46,'2021-05-04 22:35:20'),(40,'ray-ban aviator rb 3025 polarizzato',18,150.00,22,5,47,'2021-05-04 22:37:20'),(42,'rolex daytona 40mm verde dial',19,15000.00,24,14,48,'2021-05-04 22:44:24'),(43,'iwc portugieser cronografo in acciaio - blu',20,5499.99,24,15,49,'2021-05-04 22:48:11'),(44,'cravatta dolce & gabbana nera con stampa',21,120.00,25,1,50,'2021-05-04 22:51:28'),(45,'sciarpa gucci',12,300.00,25,11,51,'2021-05-04 22:54:24'),(46,'bucket hat con logo ricamato\r\n',17,30.00,26,1,52,'2021-05-04 22:59:35'),(47,'guanti invernali neri',4,24.99,26,1,53,'2021-05-04 23:00:58'),(48,'nike air force 1 low cactus jack',7,499.99,15,16,54,'2021-05-04 23:10:09'),(49,'the north face nuptse crop viola',4,220.00,28,17,55,'2021-05-05 22:36:15'),(50,'abito con stampa logo baroque',5,400.00,29,9,56,'2021-05-05 22:58:55'),(52,'camicia donna armani jeans ouskila blu',2,150.00,31,8,57,'2021-05-05 23:17:03'),(53,'felpa donna adidas',1,50.00,33,1,58,'2021-05-05 23:19:08'),(54,'gonna plissettata con stampa logo baroque',5,285.00,34,5,59,'2021-05-08 17:59:10'),(55,'pantaloni donna doppia g',12,850.00,35,1,60,'2021-05-05 23:23:57'),(56,'jeans 501 cropped con strappi donna ',22,99.99,36,8,61,'2021-05-05 23:26:00'),(59,'maglietta sportiva donna azzurra',1,25.00,37,8,62,'2021-05-05 23:28:35'),(60,'cintura donna vera pelle gucci',12,320.00,55,1,63,'2021-05-05 23:30:06'),(61,'abbigliamento mare donna - costume intero',5,75.00,38,1,64,'2021-05-06 08:32:24'),(62,'calzini nike donna - 3 pezzi',7,12.50,39,3,65,'2021-05-06 08:37:33'),(63,'reggiseno sportivo con bordo greca',5,59.99,39,10,66,'2021-05-06 08:39:49'),(64,'borsa a spalla da donna',23,1499.99,45,11,67,'2021-05-06 08:47:59'),(65,'mini borsa a mano gucci',12,800.00,46,1,68,'2021-05-06 08:52:06'),(66,'pochette moschino donna ',24,250.00,47,1,69,'2021-05-06 08:56:01'),(67,'zaino donna alviero martini',25,250.00,48,1,70,'2021-05-06 09:01:42'),(68,'stivaletti lock di pelle con lucchetto',26,1250.00,50,1,71,'2021-05-06 09:06:36'),(69,'decollete leopard in vernice (10,50)',12,499.99,51,5,72,'2021-05-06 09:11:56'),(70,'air jordan 1 retro high og nrg igloo',13,950.00,52,18,73,'2021-05-06 09:25:20'),(71,'sneakers donna nike air force 1 x stussy ',7,230.00,52,1,74,'2021-05-06 09:27:34'),(72,'ballerine alviero martini prima classe ',25,100.00,53,19,75,'2021-05-06 09:32:14'),(73,'run 2.0 - scarpe running donna',1,49.99,54,13,76,'2021-05-06 09:35:17'),(74,'portafoglio nero valentino con logo',16,80.00,56,1,77,'2021-05-06 09:39:24'),(75,'occhiali da sole donna - gucci',12,310.00,57,1,78,'2021-05-06 09:42:31'),(76,'patek philippe calatrava orologio 18kt ',27,7499.99,59,5,79,'2021-05-06 09:47:04'),(77,'foulard da donna gucci',12,300.00,60,11,80,'2021-05-06 09:49:39'),(78,'logo box cuffed beanie unisex - berretto',4,30.00,61,21,81,'2021-05-06 09:52:20'),(79,'guanti donna guess neri\r\n',14,30.00,61,1,82,'2021-05-06 09:55:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=438 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prodotto_taglia`
--

LOCK TABLES `prodotto_taglia` WRITE;
/*!40000 ALTER TABLE `prodotto_taglia` DISABLE KEYS */;
INSERT INTO `prodotto_taglia` VALUES (8,0,1,1),(9,0,2,1),(10,0,3,1),(12,0,4,1),(13,0,5,1),(14,0,1,2),(15,9,2,2),(16,50,3,2),(17,28,4,2),(18,0,5,2),(19,0,1,3),(20,10,2,3),(21,48,3,3),(22,0,4,3),(23,62,5,3),(24,45,1,4),(25,0,2,4),(26,21,3,4),(27,30,4,4),(28,15,5,4),(29,0,1,5),(30,9,2,5),(31,18,3,5),(32,0,4,5),(33,40,5,5),(34,0,1,6),(35,6,2,6),(36,50,3,6),(37,32,4,6),(38,0,5,6),(56,0,1,12),(57,100,2,12),(58,50,3,12),(59,0,4,12),(60,60,5,12),(61,148,1,13),(62,0,2,13),(63,100,3,13),(64,50,4,13),(65,0,5,13),(66,0,1,14),(67,150,2,14),(68,0,3,14),(69,200,4,14),(70,0,5,14),(71,0,1,15),(72,50,2,15),(73,0,3,15),(74,100,4,15),(75,0,5,15),(76,100,1,16),(77,0,2,16),(78,100,3,16),(79,100,4,16),(80,0,5,16),(81,0,1,17),(82,100,2,17),(83,100,3,17),(84,100,4,17),(85,0,5,17),(86,100,1,18),(87,0,2,18),(88,100,3,18),(89,100,4,18),(90,100,5,18),(91,0,1,19),(92,100,2,19),(93,100,3,19),(94,100,4,19),(95,100,5,19),(96,0,1,20),(97,50,2,20),(98,100,3,20),(99,100,4,20),(100,0,5,20),(101,100,1,21),(102,100,2,21),(103,0,3,21),(104,100,4,21),(105,0,5,21),(106,100,1,22),(107,50,2,22),(108,99,3,22),(109,0,4,22),(110,100,5,22),(111,100,1,23),(112,100,2,23),(113,0,3,23),(114,100,4,23),(115,0,5,23),(116,0,1,24),(117,100,2,24),(118,100,3,24),(119,100,4,24),(120,100,5,24),(121,80,6,25),(122,45,6,26),(123,50,1,27),(124,100,2,27),(125,10,3,27),(126,0,4,27),(127,100,5,27),(128,60,6,28),(129,80,6,29),(172,50,7,33),(173,100,8,33),(174,100,9,33),(175,0,10,33),(176,98,11,33),(177,149,12,33),(178,0,13,33),(179,100,14,33),(180,98,15,33),(181,100,16,33),(182,200,17,33),(183,148,18,33),(184,200,19,33),(185,0,20,33),(186,100,7,34),(187,150,8,34),(188,0,9,34),(189,150,10,34),(190,100,11,34),(191,100,12,34),(192,99,13,34),(193,80,14,34),(194,100,15,34),(195,0,16,34),(196,150,17,34),(197,99,18,34),(198,0,19,34),(199,100,20,34),(200,150,7,35),(201,100,8,35),(202,0,9,35),(203,0,10,35),(204,100,11,35),(205,110,12,35),(206,0,13,35),(207,150,14,35),(208,0,15,35),(209,0,16,35),(210,0,17,35),(211,0,18,35),(212,0,19,35),(213,0,20,35),(214,0,7,36),(215,100,8,36),(216,100,9,36),(217,101,10,36),(218,0,11,36),(219,50,12,36),(220,0,13,36),(221,80,14,36),(222,0,15,36),(223,0,16,36),(224,0,17,36),(225,0,18,36),(226,0,19,36),(227,0,20,36),(228,0,7,37),(229,150,8,37),(230,100,9,37),(231,100,10,37),(232,100,11,37),(233,49,12,37),(234,0,13,37),(235,100,14,37),(236,0,15,37),(237,0,16,37),(238,0,17,37),(239,0,18,37),(240,0,19,37),(241,0,20,37),(242,101,7,38),(243,100,8,38),(244,0,9,38),(245,50,10,38),(246,99,11,38),(247,49,12,38),(248,0,13,38),(249,98,14,38),(250,150,15,38),(251,100,16,38),(252,0,17,38),(253,100,18,38),(254,100,19,38),(255,0,20,38),(256,50,21,39),(257,150,21,40),(259,24,21,42),(260,50,21,43),(261,80,21,44),(262,24,21,45),(263,49,21,46),(264,50,21,47),(265,0,7,48),(266,100,8,48),(267,100,9,48),(268,0,10,48),(269,50,11,48),(270,50,12,48),(271,50,13,48),(272,100,14,48),(273,0,15,48),(274,99,16,48),(275,0,17,48),(276,100,18,48),(277,0,19,48),(278,0,20,48),(279,0,1,49),(280,99,2,49),(281,100,3,49),(282,100,4,49),(283,0,5,49),(284,0,1,50),(285,100,2,50),(286,100,3,50),(287,100,4,50),(288,0,5,50),(294,0,1,52),(295,100,2,52),(296,0,3,52),(297,100,4,52),(298,100,5,52),(299,100,1,53),(300,100,2,53),(301,0,3,53),(302,100,4,53),(303,0,5,53),(304,98,1,54),(305,49,2,54),(306,51,3,54),(307,100,4,54),(308,0,5,54),(309,50,1,55),(310,50,2,55),(311,0,3,55),(312,100,4,55),(313,0,5,55),(314,100,1,56),(315,0,2,56),(316,0,3,56),(317,100,4,56),(318,0,5,56),(319,100,1,59),(320,100,2,59),(321,100,3,59),(322,0,4,59),(323,0,5,59),(324,50,1,60),(325,0,2,60),(326,50,3,60),(327,100,4,60),(328,0,5,60),(329,100,1,61),(330,0,2,61),(331,50,3,61),(332,100,4,61),(333,0,5,61),(334,100,1,62),(335,101,2,62),(336,0,3,62),(337,50,4,62),(338,0,5,62),(339,0,1,63),(340,50,2,63),(341,0,3,63),(342,100,4,63),(343,0,5,63),(344,50,6,64),(345,50,6,65),(346,25,6,66),(347,100,6,67),(348,0,7,68),(349,50,8,68),(350,50,9,68),(351,50,10,68),(352,0,11,68),(353,100,12,68),(354,100,13,68),(355,0,14,68),(356,0,15,68),(357,0,16,68),(358,100,17,68),(359,0,18,68),(360,0,19,68),(361,0,20,68),(362,0,7,69),(363,50,8,69),(364,50,9,69),(365,0,10,69),(366,100,11,69),(367,0,12,69),(368,0,13,69),(369,150,14,69),(370,0,15,69),(371,100,16,69),(372,100,17,69),(373,0,18,69),(374,0,19,69),(375,0,20,69),(376,0,7,70),(377,0,8,70),(378,0,9,70),(379,0,10,70),(380,0,11,70),(381,0,12,70),(382,0,13,70),(383,0,14,70),(384,0,15,70),(385,0,16,70),(386,0,17,70),(387,0,18,70),(388,0,19,70),(389,0,20,70),(390,0,7,71),(391,100,8,71),(392,100,9,71),(393,100,10,71),(394,0,11,71),(395,50,12,71),(396,50,13,71),(397,50,14,71),(398,0,15,71),(399,0,16,71),(400,100,17,71),(401,100,18,71),(402,0,19,71),(403,0,20,71),(404,0,7,72),(405,50,8,72),(406,50,9,72),(407,50,10,72),(408,100,11,72),(409,0,12,72),(410,0,13,72),(411,100,14,72),(412,100,15,72),(413,0,16,72),(414,0,17,72),(415,0,18,72),(416,0,19,72),(417,0,20,72),(418,50,7,73),(419,0,8,73),(420,100,9,73),(421,100,10,73),(422,100,11,73),(423,0,12,73),(424,50,13,73),(425,50,14,73),(426,50,15,73),(427,100,16,73),(428,0,17,73),(429,0,18,73),(430,100,19,73),(431,0,20,73),(432,25,21,74),(433,48,21,75),(434,10,21,76),(435,20,21,77),(436,50,21,78),(437,25,21,79);
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produttore_prodotto`
--

LOCK TABLES `produttore_prodotto` WRITE;
/*!40000 ALTER TABLE `produttore_prodotto` DISABLE KEYS */;
INSERT INTO `produttore_prodotto` VALUES (1,'adidas'),(25,'alviero martini'),(2,'armani'),(9,'boss'),(11,'calvin klein'),(21,'dolce & gabbana'),(26,'givenchy'),(12,'gucci'),(14,'guess'),(20,'iwc'),(13,'jordan'),(22,'levis'),(23,'louis vuitton'),(24,'moschino'),(7,'nike'),(27,'patek philippe'),(10,'puma'),(3,'ralph lauren'),(18,'ray-ban'),(19,'rolex'),(6,'supreme'),(4,'the north face'),(17,'timberland'),(8,'tommy hilfiger'),(16,'valentino'),(5,'versace');
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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recensioni`
--

LOCK TABLES `recensioni` WRITE;
/*!40000 ALTER TABLE `recensioni` DISABLE KEYS */;
INSERT INTO `recensioni` VALUES (48,'Ottimo prodotto, consigliato ','Ottimo',5,'2021-04-12 00:37:06',37,3),(49,'Consigliato per tutti','Buon prodotto',4,'2021-04-12 15:32:31',38,5),(50,'Prodotto discreto, buoni materiali','Discreto',3,'2021-04-12 15:34:11',38,4),(51,'Ottimi materiali e ottimo prodotto','Buonissimi materiali',4,'2021-04-12 15:36:04',38,3),(52,'ottimo acquisto','consigliato',4,'2021-04-14 10:43:07',38,2),(56,'Buoni materiali e buon prodotto rispetto al prezzo','Buona qualità prezzo',3,'2021-04-28 18:32:35',38,1),(57,'Ottimi materiali ','Uno dei migliori di sempre ',5,'2021-04-29 00:36:57',39,6),(58,'Migliori sneakers tra tutte','Le migliori di sempre',5,'2021-05-07 17:16:54',38,33);
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
INSERT INTO `taglia` VALUES (1,'XS',1),(2,'S',1),(3,'M',1),(4,'L',1),(5,'XL',1),(6,'unsize',2),(7,'38',3),(8,'39',3),(9,'39.5',3),(10,'40',3),(11,'40.5',3),(12,'41',3),(13,'41.5',3),(14,'42',3),(15,'42.5',3),(16,'43',3),(17,'43.5',3),(18,'44',3),(19,'44.5',3),(20,'45',3),(21,'unsize',4);
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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
INSERT INTO `utenti` VALUES (37,'provaNome','provaCognome','prova@gmail.com','provausername','$2y$10$Sfxywxkei9Splvu6z9i.meC4PBzU83YCtnMXuCRGIRt3hlKthj2zW'),(38,'Luca','Milanesi','milanesiluca2002@gmail.com','mrluca','$2y$10$oetU1Y1TEpu5X/8FmuTeZeZZhabU/yR4XQ2s3CdY.GBqpg2S1.vN.'),(39,'Mario','Rossi','mario.rossi@gmail.com','mario12','$2y$10$UaZm1LkbbV8ZtfjGI72IMecgpfx/bLxZ4E26sLCktNDVqgx.wqJVi'),(46,'Giorgia','Verdi','giorgia.verdi@gmail.com','giorgia123','$2y$10$VcVJglXcMD5EfbhxQLvlA.F/b1s1FGGpNdSZsikdoItSZMGcw/x0O');
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

-- Dump completed on 2021-05-16  1:13:03
