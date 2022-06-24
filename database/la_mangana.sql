-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: localhost    Database: la_mangana
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cirujia`
--

DROP TABLE IF EXISTS `cirujia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cirujia` (
  `idcirujia` int(11) NOT NULL AUTO_INCREMENT,
  `idconsulta` int(11) NOT NULL,
  `tipo_cirujia` varchar(30) NOT NULL,
  `entrada` datetime NOT NULL,
  `salida` datetime DEFAULT NULL,
  `costo` float(10,2) NOT NULL,
  `observaciones` varchar(50) DEFAULT NULL,
  `documento` varchar(30) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`idcirujia`),
  KEY `fk_idconsulta_cirujia_consulta_idx` (`idconsulta`),
  CONSTRAINT `fk_idconsulta_cirujia_consulta` FOREIGN KEY (`idconsulta`) REFERENCES `consulta` (`idconsulta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cirujia`
--

LOCK TABLES `cirujia` WRITE;
/*!40000 ALTER TABLE `cirujia` DISABLE KEYS */;
INSERT INTO `cirujia` VALUES (1,4,'X','2021-10-14 18:01:00',NULL,100.00,'',NULL,1),(2,6,'X','2021-10-29 12:00:00',NULL,100.00,'',NULL,1),(3,8,'X','2021-10-30 22:00:00',NULL,100.00,'',NULL,1);
/*!40000 ALTER TABLE `cirujia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consulta`
--

DROP TABLE IF EXISTS `consulta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consulta` (
  `idconsulta` int(11) NOT NULL AUTO_INCREMENT,
  `idmascota` int(11) NOT NULL,
  `idmedico` int(11) NOT NULL,
  `observaciones` varchar(50) NOT NULL,
  `acs_mascota` json DEFAULT NULL,
  `servicios` json NOT NULL,
  `costo` float(10,2) NOT NULL,
  `momento` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`idconsulta`),
  KEY `fk_idmascota_consulta_mascota_idx` (`idmascota`),
  KEY `fk_idmedico_consulta_user_idx` (`idmedico`),
  CONSTRAINT `fk_idmascota_consulta_mascota` FOREIGN KEY (`idmascota`) REFERENCES `mascota` (`idmascota`),
  CONSTRAINT `fk_idmedico_consulta_user` FOREIGN KEY (`idmedico`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consulta`
--

LOCK TABLES `consulta` WRITE;
/*!40000 ALTER TABLE `consulta` DISABLE KEYS */;
INSERT INTO `consulta` VALUES (1,1,3,'Contusión','{\"item0\": \"collar\", \"item1\": \"zapatitos\"}','{\"cirujia\": \"1\", \"hospital\": \"1\", \"medicina\": \"1\"}',50.00,'2021-09-29 12:42:19',1),(2,3,3,'Consulta','{\"item0\": \"Collar\", \"item1\": \"Zapatitos\"}','{\"medicina\": \"1\"}',50.00,'2021-09-30 11:41:32',1),(3,1,19,'Consulta',NULL,'{\"medicina\": \"1\"}',50.00,'2021-10-06 21:58:51',1),(4,3,19,'Fractura',NULL,'{\"cirugia\": \"1\", \"hospital\": \"1\", \"medicina\": \"1\"}',50.00,'2021-10-14 14:14:38',1),(5,2,19,'Parásitos intestinales',NULL,'{\"medicina\": \"1\"}',50.00,'2021-10-19 13:21:43',1),(6,7,19,'Cirugía','{\"item0\": \"Collar\", \"item1\": \"Chamarrita\"}','{\"cirugia\": \"1\", \"hospital\": \"1\", \"medicina\": \"1\"}',50.00,'2021-10-29 11:56:29',1),(7,9,3,'Consulta',NULL,'{\"medicina\": \"1\"}',50.00,'2021-10-29 15:47:13',1),(8,6,3,'Roto la patita','{\"item0\": \"Collar de bolitas\", \"item1\": \"Correa\", \"item2\": \"Chamarrita\"}','{\"cirugia\": \"1\", \"hospital\": \"1\", \"medicina\": \"1\"}',50.00,'2021-10-30 20:53:14',1),(9,9,29,'Desparasitación',NULL,'{\"medicina\": \"1\"}',0.00,'2022-04-20 20:23:07',1),(10,7,29,'Desparasitación',NULL,'{\"medicina\": \"1\"}',0.00,'2022-04-21 23:29:04',1),(11,5,29,'Desparasitación',NULL,'{\"medicina\": \"1\"}',0.00,'2022-04-22 17:48:51',1),(12,2,3,'Spray antipulgas','{\"item0\": \"Collar\"}','{\"medicina\": \"1\"}',0.00,'2022-04-22 17:50:03',1),(13,3,3,'Spray antipulgas','{\"item0\": \"Collar\"}','{\"medicina\": \"1\"}',0.00,'2022-04-22 17:53:22',1),(14,7,29,'Desparasitación','{\"item0\": \"Collar\"}','{\"medicina\": \"1\"}',0.00,'2022-04-28 19:32:46',1),(15,1,3,'Desidratación','{\"item0\": \"Gorrito\"}','{\"medicina\": \"1\"}',50.00,'2022-05-04 12:39:27',1);
/*!40000 ALTER TABLE `consulta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hospitalizacion`
--

DROP TABLE IF EXISTS `hospitalizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hospitalizacion` (
  `idhospitalizacion` int(11) NOT NULL AUTO_INCREMENT,
  `idconsulta` int(11) NOT NULL,
  `idjaula` int(11) NOT NULL,
  `motivo` varchar(30) NOT NULL,
  `observaciones` varchar(50) DEFAULT NULL,
  `entrada` datetime NOT NULL,
  `salida` datetime DEFAULT NULL,
  `costo` float(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`idhospitalizacion`),
  KEY `fk_idjaula_hospitalizacion_jaula_idx` (`idjaula`),
  KEY `fk_idconsulta_hospitalizacion_consulta_idx` (`idconsulta`),
  CONSTRAINT `fk_idconsulta_hospitalizacion_consulta` FOREIGN KEY (`idconsulta`) REFERENCES `consulta` (`idconsulta`),
  CONSTRAINT `fk_idjaula_hospitalizacion_jaula` FOREIGN KEY (`idjaula`) REFERENCES `jaula` (`idjaula`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hospitalizacion`
--

LOCK TABLES `hospitalizacion` WRITE;
/*!40000 ALTER TABLE `hospitalizacion` DISABLE KEYS */;
INSERT INTO `hospitalizacion` VALUES (1,1,2,'X','','2021-09-29 15:28:00',NULL,100.00,1),(2,4,4,'X','','2021-10-14 18:00:00',NULL,100.00,1),(3,6,3,'X','','2021-10-29 12:00:00',NULL,100.00,1),(4,8,1,'X','','2021-10-30 21:00:00',NULL,100.00,1),(5,8,1,'X','','2021-10-30 21:00:00',NULL,100.00,1);
/*!40000 ALTER TABLE `hospitalizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jaula`
--

DROP TABLE IF EXISTS `jaula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jaula` (
  `idjaula` int(11) NOT NULL AUTO_INCREMENT,
  `jaula` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`idjaula`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jaula`
--

LOCK TABLES `jaula` WRITE;
/*!40000 ALTER TABLE `jaula` DISABLE KEYS */;
INSERT INTO `jaula` VALUES (1,3,2),(2,2,2),(3,4,2),(4,5,2);
/*!40000 ALTER TABLE `jaula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mascota`
--

DROP TABLE IF EXISTS `mascota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mascota` (
  `idmascota` int(11) NOT NULL AUTO_INCREMENT,
  `idmascota_raza` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `sexo` tinyint(4) NOT NULL,
  `ano_nacimiento` year(4) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`idmascota`),
  KEY `fk_idmascota_raza_mascota_mascota_raza_idx` (`idmascota_raza`),
  KEY `fk_iduser_mascora_user_idx` (`iduser`),
  CONSTRAINT `fk_idmascota_raza_mascota_mascota_raza` FOREIGN KEY (`idmascota_raza`) REFERENCES `mascota_raza` (`idmascota_raza`),
  CONSTRAINT `fk_iduser_mascora_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mascota`
--

LOCK TABLES `mascota` WRITE;
/*!40000 ALTER TABLE `mascota` DISABLE KEYS */;
INSERT INTO `mascota` VALUES (1,2,5,'Laica',1,2008,'2021-05-24 19:17:06',1),(2,2,6,'Rocky',2,2010,'2021-05-24 19:17:06',1),(3,1,6,'Wero',2,2012,'2021-05-31 12:36:44',1),(4,7,5,'Tobi',2,2017,'2021-05-31 12:53:40',1),(5,4,7,'Bola de nieve',1,2020,'2021-06-01 18:03:40',1),(6,2,8,'Negro',2,2019,'2021-06-01 18:44:34',1),(7,3,11,'Cofi',2,2017,'2021-06-01 18:46:40',1),(8,1,10,'canelo3344',2,2015,'2021-06-01 19:44:15',1),(9,4,27,'Pelusa',1,2019,'2021-07-19 21:50:30',1),(10,2,25,'Ladybug',1,2019,'2021-11-04 16:58:40',1),(11,7,30,'Milaneso',2,2022,'2022-04-29 20:35:49',1);
/*!40000 ALTER TABLE `mascota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mascota_atributos`
--

DROP TABLE IF EXISTS `mascota_atributos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mascota_atributos` (
  `idmascota_atributos` int(11) NOT NULL AUTO_INCREMENT,
  `idmascota` int(11) NOT NULL,
  `peso` float(5,3) NOT NULL,
  `tamano` tinyint(4) NOT NULL,
  `condicion_corporal` tinyint(4) NOT NULL,
  `fecha` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`idmascota_atributos`),
  KEY `fk_idmascota_mascota_atributos_mascota_idx` (`idmascota`),
  CONSTRAINT `fk_idmascota_mascota_atributos_mascota` FOREIGN KEY (`idmascota`) REFERENCES `mascota` (`idmascota`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mascota_atributos`
--

LOCK TABLES `mascota_atributos` WRITE;
/*!40000 ALTER TABLE `mascota_atributos` DISABLE KEYS */;
INSERT INTO `mascota_atributos` VALUES (1,3,10.000,2,1,'2021-05-31',1),(2,4,6.000,1,2,'2021-05-31',1),(3,1,12.100,2,2,'2020-12-18',1),(4,1,12.350,3,2,'2021-01-18',1),(5,1,13.120,3,2,'2021-02-18',1),(6,1,13.490,3,2,'2021-03-18',1),(7,1,14.900,3,3,'2021-04-18',1),(8,1,15.456,3,3,'2021-05-18',1),(9,5,1.000,1,2,'2021-06-01',1),(10,6,8.000,2,1,'2021-06-01',1),(11,7,3.000,1,2,'2021-06-01',1),(12,8,4.000,1,2,'2021-06-01',1),(13,9,3.300,2,2,'2021-07-19',1),(14,2,10.000,2,2,'2021-10-19',1),(15,1,15.490,3,3,'2021-09-29',1),(16,1,15.500,3,3,'2021-10-06',1),(17,3,12.296,2,2,'2021-09-30',1),(18,3,12.230,2,2,'2021-10-14',1),(19,7,3.200,1,2,'2021-10-29',1),(20,9,3.630,2,2,'2021-10-29',1),(21,6,10.000,2,2,'2021-10-30',1),(22,10,1.190,1,1,'2021-11-04',1),(23,9,5.130,2,2,'2022-04-20',1),(24,7,4.650,2,2,'2022-04-21',1),(25,5,1.600,1,2,'2022-04-22',1),(26,2,11.230,2,2,'2022-04-22',1),(27,3,12.290,2,2,'2022-04-22',1),(28,7,5.690,2,2,'2022-04-28',1),(29,11,0.900,1,1,'2022-04-29',1),(30,1,15.500,3,2,'2022-05-04',1);
/*!40000 ALTER TABLE `mascota_atributos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mascota_especie`
--

DROP TABLE IF EXISTS `mascota_especie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mascota_especie` (
  `idmascota_especie` int(11) NOT NULL AUTO_INCREMENT,
  `especie` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`idmascota_especie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mascota_especie`
--

LOCK TABLES `mascota_especie` WRITE;
/*!40000 ALTER TABLE `mascota_especie` DISABLE KEYS */;
INSERT INTO `mascota_especie` VALUES (1,'Canino',1),(2,'Felino',1);
/*!40000 ALTER TABLE `mascota_especie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mascota_raza`
--

DROP TABLE IF EXISTS `mascota_raza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mascota_raza` (
  `idmascota_raza` int(11) NOT NULL AUTO_INCREMENT,
  `idmascota_especie` int(11) NOT NULL,
  `raza` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`idmascota_raza`),
  KEY `fk_idmascota_especie_mascota_raza_mascota_especie_idx` (`idmascota_especie`),
  CONSTRAINT `fk_idmascota_especie_mascota_raza_mascota_especie` FOREIGN KEY (`idmascota_especie`) REFERENCES `mascota_especie` (`idmascota_especie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mascota_raza`
--

LOCK TABLES `mascota_raza` WRITE;
/*!40000 ALTER TABLE `mascota_raza` DISABLE KEYS */;
INSERT INTO `mascota_raza` VALUES (1,1,'Pastor Alemán',1),(2,1,'Bulldog',1),(3,2,'Ragdoll',1),(4,2,'Fold escocés',1),(5,2,'British',1),(6,1,'Pastor belga',1),(7,1,'Chihuahua',1);
/*!40000 ALTER TABLE `mascota_raza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicina`
--

DROP TABLE IF EXISTS `medicina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicina` (
  `idmedicina` int(11) NOT NULL AUTO_INCREMENT,
  `idconsulta` int(11) NOT NULL,
  `diagnostico` varchar(50) DEFAULT NULL,
  `medicacion` json NOT NULL,
  `fecha` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`idmedicina`),
  KEY `fk_idconsulta_medicina_consulta_idx` (`idconsulta`),
  CONSTRAINT `fk_idconsulta_medicina_consulta` FOREIGN KEY (`idconsulta`) REFERENCES `consulta` (`idconsulta`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicina`
--

LOCK TABLES `medicina` WRITE;
/*!40000 ALTER TABLE `medicina` DISABLE KEYS */;
INSERT INTO `medicina` VALUES (1,1,NULL,'{\"item0\": \"s, 1 Mililítro Cada 8 horas\"}','0000-00-00 00:00:00',1),(2,4,NULL,'{\"item0\": \"s, 1 Mililítro Cada 8 horas\"}','0000-00-00 00:00:00',1),(3,2,NULL,'{\"item0\": \"Antibiotico, 1 Píldora / Pastilla Cada 8 horas\", \"item1\": \"Analgésico, 1 Píldora / Pastilla Cada 8 horas\"}','0000-00-00 00:00:00',1),(4,3,NULL,'{\"item0\": \"Analgésico, 1 Píldora / Pastilla Cada 8 horas\", \"item1\": \"Desinflamatorio, 1 Píldora / Pastilla Cada 8 horas\", \"item2\": \"Antibiotico, 1 Inyección Cada 10 horas\"}','0000-00-00 00:00:00',1),(5,5,NULL,'{\"item0\": \"Antibiotico, 1 Píldora / Pastilla Cada 8 horas\", \"item1\": \"Analgésico, 2 Píldora / Pastilla Cada 12 horas\", \"item2\": \"Desinflamatorio, 1 Inyección Cada 8 horas\"}','0000-00-00 00:00:00',1),(6,6,NULL,'{\"item0\": \"Antibiotico, 1 Inyección Cada 8 horas\"}','0000-00-00 00:00:00',1),(7,7,NULL,'{\"item0\": \"Ketorolaco, 1 Píldora / Pastilla Cada 8 horas\", \"item1\": \"Antibiotico, 1 Ampolleta Cada 8 horas\", \"item2\": \"s, 1 Ampolleta Cada 8 horas\"}','0000-00-00 00:00:00',1),(8,8,NULL,'{\"item0\": \"Antibiotico, 1 Ampolleta Cada 8 horas\"}','0000-00-00 00:00:00',1),(9,9,NULL,'{\"item0\": \"NextGard, 1 Píldora / Pastilla 1 vez\"}','2022-04-20 20:29:04',1),(10,10,NULL,'{\"item0\": \"NextGard, 1 Píldora / Pastilla 1 vez\"}','2022-04-21 23:30:11',1),(11,11,NULL,'{\"item0\": \"NextGard, 1 Píldora / Pastilla 1 vez\"}','2022-04-22 17:49:45',1),(12,12,NULL,'{\"item0\": \"PPT, 1 Píldora / Pastilla 1 vez al día por 1 semana\"}','2022-04-22 17:52:47',1),(13,13,NULL,'{\"item0\": \"PPT, 1 Píldora / Pastilla 1 vez al día por 1 semana\"}','2022-04-22 17:54:05',1),(14,14,NULL,'{\"item0\": \"NextGard, 1 Píldora / Pastilla 1 vez\"}','2022-04-28 19:33:55',1),(15,15,NULL,'{\"item0\": \"Suero canino, 200 Mililítro cada 8 horas\"}','2022-05-04 12:41:18',1);
/*!40000 ALTER TABLE `medicina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Vicky Nesquik','2021-01-12',1,1),(2,'Daniel Santos','2021-01-17',2,1),(3,'Adán Casados','2021-01-17',3,1),(4,'Francisco Sánchez','2021-01-18',0,0),(5,'Jesús Antonio Mendezx','2021-01-20',0,1),(6,'José Lameiras','2021-01-24',0,1),(7,'Juán Pérez','2021-02-07',0,1),(8,'Rosa María','2021-02-07',0,1),(9,'Manuel Hernández','2021-02-07',0,1),(10,'Eliot Noah','2021-02-07',0,1),(11,'Elena Fisher','2021-02-07',0,1),(12,'Rafael Torres','2021-02-10',0,0),(13,'Santiago Pérez','2021-02-11',0,0),(14,'Alberto Hernández','2021-02-11',0,0),(15,'Alan Torres','2021-02-11',0,0),(16,'María Fernanda','2021-02-11',0,0),(17,'Claudia Martínez','2021-02-11',0,0),(18,'Sergio Mendoza','2021-02-11',0,0),(19,'Guadalupe Jiménez Barragán','2021-02-11',3,1),(20,'Miguel Angel','2021-02-11',3,0),(21,'Juán Carlos','2021-03-09',3,0),(22,'Lleno Mendoza','2021-04-29',0,0),(23,'Vacío Mendoza','2021-05-01',0,0),(24,'Luis Vazquez','2021-05-01',3,0),(25,'Luz Demetria Estrada Ochoa','2021-06-01',0,1),(26,'Andres Tuxtla','2021-06-01',2,1),(27,'Lola Hernandez','2021-06-05',0,1),(28,'Daniel Santos','2021-12-03',2,1),(29,'luis hernandez','2022-03-09',3,1),(30,'Marelda Amaro','2022-04-29',0,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_acceso`
--

DROP TABLE IF EXISTS `user_acceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_acceso` (
  `iduser_acceso` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(150) NOT NULL,
  `fecha` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`iduser_acceso`),
  KEY `fk_iduser_user_acceso_user_idx` (`iduser`),
  CONSTRAINT `fk_iduser_user_acceso_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_acceso`
--

LOCK TABLES `user_acceso` WRITE;
/*!40000 ALTER TABLE `user_acceso` DISABLE KEYS */;
INSERT INTO `user_acceso` VALUES (1,1,'VickyzNesquik','$2a$07$s4N0mo1jJnaYh28GsdV8MeJYEa/hhW7x02RlJpempWXTmjGi4s2HG','2021-01-12',0),(2,2,'DaniSantos','$2a$07$s4N0mo1jJnaYh28GsdV8Mepr180tQyRLsVWevajJupHwfvvPnKQNu','2021-01-17',0),(3,3,'AdanCasados','$2a$07$s4N0mo1jJnaYh28GsdV8MeJYEa/hhW7x02RlJpempWXTmjGi4s2HG','2021-01-17',0),(4,19,'GuadalupeJ','$2a$07$s4N0mo1jJnaYh28GsdV8MeJYEa/hhW7x02RlJpempWXTmjGi4s2HG','2021-02-11',0),(5,20,'MAngel','hhW7x02RlJpempWXTmjGi4s2HG','2021-02-11',0),(6,21,'JCarlos','hhW7x02RlJpempWXTmjGi4s2HG','2021-03-09',0),(7,24,'LuisV','hhW7x02RlJpempWXTmjGi4s2HG','2021-05-01',0),(8,26,'andres','$2a$07$s4N0mo1jJnaYh28GsdV8MeJYEa/hhW7x02RlJpempWXTmjGi4s2HG','2021-06-01',0),(9,28,'DaniSantos','$2a$07$s4N0mo1jJnaYh28GsdV8MeJYEa/hhW7x02RlJpempWXTmjGi4s2HG','2021-12-03',0),(10,29,'luis','$2a$07$s4N0mo1jJnaYh28GsdV8Me.2T.iqcoLJ/NxIRECEZXLW9sbAnEIry','2022-03-09',0);
/*!40000 ALTER TABLE `user_acceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_correo`
--

DROP TABLE IF EXISTS `user_correo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_correo` (
  `iduser_correo` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`iduser_correo`),
  KEY `fk_iduser_user_correo_user_idx` (`iduser`),
  CONSTRAINT `fk_iduser_user_correo_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_correo`
--

LOCK TABLES `user_correo` WRITE;
/*!40000 ALTER TABLE `user_correo` DISABLE KEYS */;
INSERT INTO `user_correo` VALUES (1,5,'jesusAlbertoail@gmail.com',0),(2,6,'jlameiras@tecmartinez.edu.mx',1),(3,5,'jesusAlberto@outlock.com',2),(4,6,'jlameiras@gmail.com',2),(5,10,'eliot@rmail.com',2),(12,5,'nuevo@correo.com',0),(13,5,'nuevo@correo.com',0),(14,5,'nuevo@correo.com',0),(15,5,'nuevo@correo.com',0),(16,5,'nuevo@correo.com',0),(17,5,'nuevo@correo.com',0),(18,5,'nuevo@correo.com',0),(19,5,'nuevo@correo.com',0),(20,5,'nuevo@correo.com',0),(21,5,'nuevo@correo.com',0),(22,5,'nuevo@correo.com',0),(23,5,'nuevo@correo.com',0),(24,5,'nuevo@correo.com',0),(25,5,'nuevo1@correo.com',0),(26,5,'nuevo2@correo.com',0),(27,5,'nuevo3@correo.com',0),(28,5,'nuevo4@correo.com',0),(29,5,'nuevo5@correo.com',0),(30,5,'nuevo7@correo.com',0),(31,5,'nuevo8@correo.com',0),(32,8,'rosita_hdzz@gmail.com',2),(33,5,'nuevo@correo.co',0),(34,5,'lamangana.RAR@gmail.com',1),(35,8,'holamexico@gmail.com',1),(36,2,'dani@email.com',1),(37,1,'Vicky@email.com',1),(38,1,'admin@email.com',2),(39,1,'admin@email.com',1),(40,19,'gGimenez@email.com',1),(42,2,'daniSantos@email.com',2),(43,7,'gGimenez@email.com',2),(44,27,'Lola_hdz@easports.com',0),(45,27,'Lola_hdz@easports.com',2),(46,27,'lolitaHdz@gmail.com',1),(47,9,'manuelito@correo.com',2);
/*!40000 ALTER TABLE `user_correo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_domicilio`
--

DROP TABLE IF EXISTS `user_domicilio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_domicilio` (
  `iduser_domicilio` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `colonia` varchar(50) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `num_casaex` int(11) DEFAULT NULL,
  `num_casaint` int(11) DEFAULT NULL,
  `calle1` varchar(25) DEFAULT NULL,
  `calle2` varchar(25) DEFAULT NULL,
  `referencia` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`iduser_domicilio`),
  KEY `fk_iduser_user_domicilio_user_idx` (`iduser`),
  CONSTRAINT `fk_iduser_user_domicilio_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_domicilio`
--

LOCK TABLES `user_domicilio` WRITE;
/*!40000 ALTER TABLE `user_domicilio` DISABLE KEYS */;
INSERT INTO `user_domicilio` VALUES (1,5,'Veracruz','Poza Rica de Hidalgo','INFONAVIT las Gaviotas','Oca',305,24,'','','Casa 24 de infonavit',1),(2,5,'Veracruz','Martínez de la Torre','Villa Rica','Mighel Hidalgo',101,NULL,NULL,NULL,'Entrada al campo',0),(3,5,'Veracruz','Martínez de la Torre','Ejidal','Pedro Belli',301,NULL,NULL,NULL,'En la tiendita Las flores',0),(4,5,'Veracruz','Martínez de la Torre','Ejidal','Ignacio Zaragoza',301,NULL,NULL,NULL,'En esquina tiendita Las flores',0),(5,10,'Veracruz','Martínez de la Torre','Centro','Ignacio Allende',201,13,NULL,NULL,'Despacho de abogados Allende',1),(9,5,'Veracruz','Martínez de la Torre','Tlatelolco','Ruíz Cortínez',210,NULL,NULL,NULL,'Privada',0),(10,6,'Veracruz','Martínez de la Torre','Ejidal','Ruíz Cortínez',211,101,'','','Referencia',2),(11,8,'Veracruz','Martínez de la Torre','Libertad','Buena Vista',300,0,'las aguilas','nino perdido','hay una tienda en la esquina color azul',1),(12,5,'Hidalgo','Ixmiquilpan','Panales','Quiterio',126,0,'','','Cerca de un canal de agua dulce',2),(13,8,'Veracruz','Martínez de la Torre','Ejidal','Ruíz Cortínez',126,0,'lomas','benito juares','casa un piso',1),(14,2,'Veracruz','San Rafael','Centro','Justo Cierra',90,0,'','','Al lado de Alvisar express',2),(15,9,'Querétaro','Santiago de Querétaro','El Marques','Avenida Cimatario',41,0,'','','Frente a butique médica D Tere',2),(16,27,'Veracruz','Martínez de la Torre','Tlatelolco','Villa Rica',315,0,'','','A contra esquina de abarrotes la tiendita casa bca',2);
/*!40000 ALTER TABLE `user_domicilio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_especialidad`
--

DROP TABLE IF EXISTS `user_especialidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_especialidad` (
  `iduser_especialidad` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `especialidad` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`iduser_especialidad`),
  KEY `fk_iduser_user_especialidad_user_idx` (`iduser`),
  CONSTRAINT `fk_iduser_user_especialidad_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_especialidad`
--

LOCK TABLES `user_especialidad` WRITE;
/*!40000 ALTER TABLE `user_especialidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_especialidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_telefono`
--

DROP TABLE IF EXISTS `user_telefono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_telefono` (
  `iduser_telefono` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`iduser_telefono`),
  KEY `fk_iduser_user_telefono_user_idx` (`iduser`),
  CONSTRAINT `fk_iduser_user_telefono_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_telefono`
--

LOCK TABLES `user_telefono` WRITE;
/*!40000 ALTER TABLE `user_telefono` DISABLE KEYS */;
INSERT INTO `user_telefono` VALUES (1,5,1,'6648837219',1),(2,10,1,'1234567891',1),(9,5,2,'1234567891',0),(10,5,2,'9928718391',2),(11,8,2,'2321256982',1),(12,11,2,'2321101010',2),(13,5,2,'2320011119',0),(14,6,1,'2321101011',1),(15,5,1,'1234567890',0),(16,2,3,'4234567819',2),(17,6,1,'4234567890',2),(18,7,1,'2323425682',1),(19,27,1,'3211981722',2),(20,9,1,'2321456890',2);
/*!40000 ALTER TABLE `user_telefono` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-24 16:10:36
