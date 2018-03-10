-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: db_tonight
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Table structure for table `tbl_cabelo`
--

DROP TABLE IF EXISTS `tbl_cabelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cabelo` (
  `id_cabelo` int(11) NOT NULL AUTO_INCREMENT,
  `cor` varchar(20) NOT NULL,
  PRIMARY KEY (`id_cabelo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cabelo`
--

LOCK TABLES `tbl_cabelo` WRITE;
/*!40000 ALTER TABLE `tbl_cabelo` DISABLE KEYS */;
INSERT INTO `tbl_cabelo` VALUES (1,'Loiro'),(2,'Moreno'),(3,'Ruivo'),(4,'Outro');
/*!40000 ALTER TABLE `tbl_cabelo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cliente`
--

DROP TABLE IF EXISTS `tbl_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `nasc` date NOT NULL,
  `email` varchar(45) NOT NULL,
  `celular` varchar(13) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `sexo` int(11) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `enteresse` int(1) NOT NULL,
  `foto_perfil` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cliente`
--

LOCK TABLES `tbl_cliente` WRITE;
/*!40000 ALTER TABLE `tbl_cliente` DISABLE KEYS */;
INSERT INTO `tbl_cliente` VALUES (1,'Usuario','1999-11-19','usuario@gmail.com','(11)879865455','qwe',1,'SP','Itapevi','2018-02-17 16:00:00',2,'midia/a The queen.JPG'),(3,'teste','1990-01-01','teste@email.com','(11)132411215','asd',2,'SP','Itapevi','2018-02-22 18:32:00',1,'midia/logo2.jpg');
/*!40000 ALTER TABLE `tbl_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cliente_filiado`
--

DROP TABLE IF EXISTS `tbl_cliente_filiado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cliente_filiado` (
  `id_cliente_filiado` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_filiado` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente_filiado`),
  KEY `id_filiado_idx` (`id_filiado`),
  KEY `id_cliente_idx` (`id_cliente`),
  CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_filiado` FOREIGN KEY (`id_filiado`) REFERENCES `tbl_filiado` (`id_filiado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cliente_filiado`
--

LOCK TABLES `tbl_cliente_filiado` WRITE;
/*!40000 ALTER TABLE `tbl_cliente_filiado` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_cliente_filiado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cliente_transferencia`
--

DROP TABLE IF EXISTS `tbl_cliente_transferencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cliente_transferencia` (
  `id_transferencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_filiado` int(11) NOT NULL,
  `data_hora` datetime NOT NULL,
  `valor` float NOT NULL,
  PRIMARY KEY (`id_transferencia`),
  KEY `fk_cliente_idx` (`id_cliente`),
  KEY `fk_filiado_idx` (`id_filiado`),
  CONSTRAINT `fk_cliente_transf` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_filiado_transf` FOREIGN KEY (`id_filiado`) REFERENCES `tbl_filiado` (`id_filiado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cliente_transferencia`
--

LOCK TABLES `tbl_cliente_transferencia` WRITE;
/*!40000 ALTER TABLE `tbl_cliente_transferencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_cliente_transferencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_etnia`
--

DROP TABLE IF EXISTS `tbl_etnia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_etnia` (
  `id_etnia` int(11) NOT NULL AUTO_INCREMENT,
  `etnia` varchar(45) NOT NULL,
  PRIMARY KEY (`id_etnia`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_etnia`
--

LOCK TABLES `tbl_etnia` WRITE;
/*!40000 ALTER TABLE `tbl_etnia` DISABLE KEYS */;
INSERT INTO `tbl_etnia` VALUES (1,'Branca'),(2,'Parda'),(3,'Negra');
/*!40000 ALTER TABLE `tbl_etnia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_filiado`
--

DROP TABLE IF EXISTS `tbl_filiado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_filiado` (
  `id_filiado` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `nasc` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `celular1` varchar(13) NOT NULL,
  `celular2` varchar(13) DEFAULT NULL,
  `etnia` int(11) NOT NULL,
  `sexo` int(11) NOT NULL,
  `apresentacao` varchar(300) DEFAULT NULL,
  `foto_perfil` varchar(150) DEFAULT NULL,
  `altura` varchar(4) NOT NULL,
  `peso` int(11) DEFAULT NULL,
  `conta_ativa` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `acompanha` varchar(100) NOT NULL,
  `cobrar` varchar(10) NOT NULL,
  `id_tipo_conta` int(11) NOT NULL,
  `id_cabelo` int(11) DEFAULT NULL,
  `uf` varchar(2) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `excluido` date DEFAULT NULL,
  PRIMARY KEY (`id_filiado`),
  KEY `id_tipo_conta_idx` (`id_tipo_conta`),
  KEY `fk_cabelo_idx` (`id_cabelo`),
  KEY `fk_etnia_filiado_idx` (`etnia`),
  CONSTRAINT `fk_cabelo` FOREIGN KEY (`id_cabelo`) REFERENCES `tbl_cabelo` (`id_cabelo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_etnia_filiado` FOREIGN KEY (`etnia`) REFERENCES `tbl_etnia` (`id_etnia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_conta` FOREIGN KEY (`id_tipo_conta`) REFERENCES `tbl_tipo_conta` (`id_tipo_conta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_filiado`
--

LOCK TABLES `tbl_filiado` WRITE;
/*!40000 ALTER TABLE `tbl_filiado` DISABLE KEYS */;
INSERT INTO `tbl_filiado` VALUES (1,'usuario','2000-01-03','teste@sandbox.pagseguro.com.br','aaa','(11)32411215','(11)32411215',2,1,'Apresentação teste','midia/usuaria.jpg','160',58,1,1,'2','1000',1,3,'SP','Itapevi','2018-02-19 20:41:00',NULL),(2,'teste','1987-04-03','teste2@gmail.com','aaa','(11)32411215','(11)32411215',1,2,NULL,'midia//usuario.jpg','160',50,1,1,'1','100000',2,NULL,'MT','Cuiabá','2018-02-22 19:16:00',NULL),(3,'Teste ultimate','1970-03-03','testando@email.com','aaaaaaaaaa','(55)555555555','(55)555555555',3,2,'-','-','1.70',60,0,0,'3','200',3,NULL,'SP','Vicentinópolis (Santo Antônio do Aracanguá)','2018-03-07 19:46:00','2018-03-08');
/*!40000 ALTER TABLE `tbl_filiado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_filiado_midia`
--

DROP TABLE IF EXISTS `tbl_filiado_midia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_filiado_midia` (
  `id_filiado_midia` int(11) NOT NULL AUTO_INCREMENT,
  `id_filiado` int(11) NOT NULL,
  `midia` varchar(150) NOT NULL,
  `descricao` int(1) NOT NULL,
  `data_upload` datetime NOT NULL,
  PRIMARY KEY (`id_filiado_midia`,`id_filiado`),
  KEY `filiado_idx` (`id_filiado`),
  CONSTRAINT `filiado` FOREIGN KEY (`id_filiado`) REFERENCES `tbl_filiado` (`id_filiado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_filiado_midia`
--

LOCK TABLES `tbl_filiado_midia` WRITE;
/*!40000 ALTER TABLE `tbl_filiado_midia` DISABLE KEYS */;
INSERT INTO `tbl_filiado_midia` VALUES (1,1,'midia/logo.png',1,'2018-02-24 14:48:00'),(2,1,'midia/logo.jpg',1,'2018-02-24 14:48:00'),(3,1,'midia/logo2.jpg',1,'2018-02-26 20:49:00'),(4,2,'midia/logo.png',1,'2018-03-03 19:50:00');
/*!40000 ALTER TABLE `tbl_filiado_midia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_home_slide`
--

DROP TABLE IF EXISTS `tbl_home_slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_home_slide` (
  `id_home` int(11) NOT NULL AUTO_INCREMENT,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id_home`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_home_slide`
--

LOCK TABLES `tbl_home_slide` WRITE;
/*!40000 ALTER TABLE `tbl_home_slide` DISABLE KEYS */;
INSERT INTO `tbl_home_slide` VALUES (1,'imagens/logo2.jpg'),(2,'imagens/free-wallpaper.jpg'),(5,'imagens/back.png');
/*!40000 ALTER TABLE `tbl_home_slide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_index`
--

DROP TABLE IF EXISTS `tbl_index`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_index` (
  `id_index` int(11) NOT NULL AUTO_INCREMENT,
  `imagem` varchar(100) NOT NULL,
  `campo` int(11) NOT NULL,
  PRIMARY KEY (`id_index`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_index`
--

LOCK TABLES `tbl_index` WRITE;
/*!40000 ALTER TABLE `tbl_index` DISABLE KEYS */;
INSERT INTO `tbl_index` VALUES (1,'-',1),(2,'-',2),(3,'-',3),(4,'-',4),(5,'-',5),(6,'-',6);
/*!40000 ALTER TABLE `tbl_index` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mensalidade`
--

DROP TABLE IF EXISTS `tbl_mensalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mensalidade` (
  `id_transferencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_filiado` int(11) NOT NULL,
  `data_hora` datetime DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `desconto` float DEFAULT NULL,
  `code` varchar(40) DEFAULT NULL,
  `referencia` varchar(28) DEFAULT NULL,
  `forma` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`id_transferencia`),
  KEY `fk_filiado_idx` (`id_filiado`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mensalidade`
--

LOCK TABLES `tbl_mensalidade` WRITE;
/*!40000 ALTER TABLE `tbl_mensalidade` DISABLE KEYS */;
INSERT INTO `tbl_mensalidade` VALUES (1,1,'2018-03-02 20:39:00',NULL,3,0,NULL,NULL,NULL),(2,1,'2018-01-02 18:47:00',299,1,0,'ECCC7169-7356-40FD-B41B-9E6EA1E33726','mensal118-03-03','boleto'),(3,1,'2018-03-03 18:56:00',299,1,0,'B5ACD5E5-CEB4-4EA4-8846-AE463ED882CA','mensal118-03-03','boleto'),(4,1,'2018-03-03 18:58:00',299,1,0,'080290B8-1493-4DE0-9345-FB2362755A8E','mensal118-03-03','boleto'),(5,1,'2018-03-03 18:59:00',299,1,0,'962D168F-6985-47AF-8076-091D5BB985EF','mensal118-03-03','boleto'),(6,1,'2018-03-03 19:01:00',299,1,0,'6271E76B-B103-4D00-A767-6BDB6EAD626F','mensal118-03-03','boleto'),(7,1,'2018-03-03 19:03:00',299,1,0,'CC328EB0-9E23-469B-97FD-F9218D35621A','mensal118-03-03','boleto'),(8,1,'2018-03-03 19:04:00',299,1,0,'0207BB55-08FA-494D-8EF3-503FD90A0856','mensal118-03-03','boleto'),(9,1,'2018-03-03 19:05:00',299,1,0,'8E7E90E4-52B1-435C-A6E8-24C0170C74B5','mensal118-03-03','boleto'),(10,1,'2018-03-03 19:07:00',299,1,0,'F33A4956-36DE-4D49-B074-7E20021737F4','mensal118-03-03','boleto'),(11,2,'2018-01-03 19:19:00',299,1,0,'3C42CA3D-D6FF-4F52-8C54-308A464446B9','mensal118-03-03','card');
/*!40000 ALTER TABLE `tbl_mensalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pagamento_cliente`
--

DROP TABLE IF EXISTS `tbl_pagamento_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pagamento_cliente` (
  `id_dados_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `rua` varchar(200) NOT NULL,
  `numero` varchar(4) NOT NULL,
  `bairro` varchar(150) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `cep` varchar(12) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `bandeira_cartao` varchar(45) NOT NULL,
  `numero_cartao` int(20) NOT NULL,
  `cvv` int(5) NOT NULL,
  `expiracaoMes` int(2) NOT NULL,
  `expiracaoAno` int(4) NOT NULL,
  PRIMARY KEY (`id_dados_pagamento`),
  KEY `fk_cliente_idx` (`id_cliente`),
  CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pagamento_cliente`
--

LOCK TABLES `tbl_pagamento_cliente` WRITE;
/*!40000 ALTER TABLE `tbl_pagamento_cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pagamento_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pagamento_filiado`
--

DROP TABLE IF EXISTS `tbl_pagamento_filiado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pagamento_filiado` (
  `id_dados_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_filiado` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `rua` varchar(200) DEFAULT NULL,
  `numero` varchar(4) DEFAULT NULL,
  `bairro` varchar(150) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(12) NOT NULL,
  `desconto` int(3) DEFAULT NULL,
  `cpf` varchar(30) NOT NULL,
  `bandeira_cartao` varchar(40) DEFAULT NULL,
  `numero_cartao` varchar(32) DEFAULT NULL,
  `cvv` varchar(15) DEFAULT NULL,
  `expiracaoMes` varchar(15) DEFAULT NULL,
  `expiracaoAno` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_dados_pagamento`),
  KEY `fk_filiado_idx` (`id_filiado`),
  CONSTRAINT `fk_filiado` FOREIGN KEY (`id_filiado`) REFERENCES `tbl_filiado` (`id_filiado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pagamento_filiado`
--

LOCK TABLES `tbl_pagamento_filiado` WRITE;
/*!40000 ALTER TABLE `tbl_pagamento_filiado` DISABLE KEYS */;
INSERT INTO `tbl_pagamento_filiado` VALUES (1,1,'Testador','Testando','(55)22222222','Rua Maria Salete Serafim Gomes','8','Chácara Santa Cecília','Itapevi','SP','06655520',0,'NDg5MDIxMTY4MzI=',NULL,'NDExMTExMTExMTExMTExMQ==','MTIz','MTI=','MjAzMA==');
/*!40000 ALTER TABLE `tbl_pagamento_filiado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_conta`
--

DROP TABLE IF EXISTS `tbl_tipo_conta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo_conta` (
  `id_tipo_conta` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `valor` int(4) NOT NULL,
  `foto` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  PRIMARY KEY (`id_tipo_conta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_conta`
--

LOCK TABLES `tbl_tipo_conta` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_conta` DISABLE KEYS */;
INSERT INTO `tbl_tipo_conta` VALUES (1,'Basica',299,3,0),(2,'Comum',499,5,0),(3,'Gold',699,5,1);
/*!40000 ALTER TABLE `tbl_tipo_conta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-09 21:42:00
