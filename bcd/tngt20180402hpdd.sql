-- MySQL dump 10.13  Distrib 5.5.51-38.2, for Linux (x86_64)
--
-- Host: localhost    Database: tonig231_tonight
-- ------------------------------------------------------
-- Server version	5.5.51-38.2

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
INSERT INTO `tbl_cabelo` (`id_cabelo`, `cor`) VALUES (1,'Loiro'),(2,'Moreno'),(3,'Ruivo'),(4,'Outro');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cliente`
--

LOCK TABLES `tbl_cliente` WRITE;
/*!40000 ALTER TABLE `tbl_cliente` DISABLE KEYS */;
INSERT INTO `tbl_cliente` (`id_cliente`, `nome`, `nasc`, `email`, `celular`, `senha`, `sexo`, `uf`, `cidade`, `data_cadastro`, `enteresse`, `foto_perfil`) VALUES (8,'Kimberlly','1996-10-10','kimberllytailandesa@gmail.com','(85)998625877','141831',1,'CE','Fortaleza','2018-03-28 16:51:00',3,'midia/PhotoGrid_1522262613032.jpg'),(10,'Kimberlly','1996-11-14','Kimberllytailandesa@gmai.com','(85)998625877','141831',1,'CE','Fortaleza','2018-04-02 15:35:00',3,NULL);
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
  PRIMARY KEY (`id_cliente_filiado`),
  KEY `id_cliente_idx` (`id_cliente`),
  CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Table structure for table `tbl_desconto`
--

DROP TABLE IF EXISTS `tbl_desconto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_desconto` (
  `id_desconto` int(11) NOT NULL AUTO_INCREMENT,
  `desconto` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id_desconto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_desconto`
--

LOCK TABLES `tbl_desconto` WRITE;
/*!40000 ALTER TABLE `tbl_desconto` DISABLE KEYS */;
INSERT INTO `tbl_desconto` (`id_desconto`, `desconto`, `status`, `data`) VALUES (1,100,1,'2018-04-01 23:56:18');
/*!40000 ALTER TABLE `tbl_desconto` ENABLE KEYS */;
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
INSERT INTO `tbl_etnia` (`id_etnia`, `etnia`) VALUES (1,'Branca'),(2,'Parda'),(3,'Negra');
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
  `apelido` varchar(30) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_filiado`
--

LOCK TABLES `tbl_filiado` WRITE;
/*!40000 ALTER TABLE `tbl_filiado` DISABLE KEYS */;
INSERT INTO `tbl_filiado` (`id_filiado`, `nome`, `apelido`, `nasc`, `email`, `senha`, `celular1`, `celular2`, `etnia`, `sexo`, `apresentacao`, `foto_perfil`, `altura`, `peso`, `conta_ativa`, `status`, `acompanha`, `cobrar`, `id_tipo_conta`, `id_cabelo`, `uf`, `cidade`, `data_cadastro`, `excluido`) VALUES (9,'roger de jesus bellussi',NULL,'1990-01-11','rogerbellussi17@gmail.com','123456','(15)32411215','',2,2,'-','-','1.83',70,0,0,'1','200',1,NULL,'SP','Ibiúna','2018-03-21 18:48:00','2018-03-27'),(10,'Teste','teste','1998-06-03','teste@sandbox.pagseguro.com.br','aaa','(11)687654654','(22)852244614',1,1,'-','-','1.68',0,0,0,'2','100',1,NULL,'SP','Itapevi','2018-03-22 15:12:00','2018-03-27'),(11,'Hellen Raquel santana','Jullye Yasmin','1996-02-05','hellenraquel2014@hotmail.com','8550743123','(11)945391613','',3,1,'-','-','1.63',52,0,0,'3','150',1,NULL,'SP','São Caetano do Sul','2018-03-27 00:16:00','2018-04-02'),(12,'Jessica','Barbie','1998-04-12','Subbabypet@gmail.com','12041998','(11)941063606','',1,1,NULL,'midia/15223795945abdab4a3c9c7.jpg','1.63',45,1,1,'3','200',1,NULL,'SP','São Paulo','2018-03-30 00:12:00',NULL),(13,'Lucas souza','Lucas','1999-08-17','lucastoledodesouzapqd@gmail.com','lucassouza','(22)997383025','',1,2,NULL,'midia/15226379365ac19c70f3d2e.jpg','1.80',80,1,1,'1','150',1,NULL,'RJ','Rio das Ostras','2018-04-01 23:58:00',NULL),(14,'Morango','Kimberlly','1996-11-14','Kimberllytailandesa@gmail.com','141831','(85)998625877','(85)998625877',1,1,NULL,'midia/15226957965ac27e74f1fa0.jpg','1.59',64,1,1,'3','200',1,NULL,'CE','Fortaleza','2018-04-02 13:36:00',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_filiado_midia`
--

LOCK TABLES `tbl_filiado_midia` WRITE;
/*!40000 ALTER TABLE `tbl_filiado_midia` DISABLE KEYS */;
INSERT INTO `tbl_filiado_midia` (`id_filiado_midia`, `id_filiado`, `midia`, `descricao`, `data_upload`) VALUES (2,12,'midia/15223796055abdab551408a.jpg',1,'2018-03-30 00:13:00'),(3,12,'midia/15223796145abdab5ecf7d1.jpg',1,'2018-03-30 00:13:00'),(4,12,'midia/15223796305abdab6e40d60.jpg',1,'2018-03-30 00:13:00'),(5,13,'midia/15226379595ac19c87aba34.jpg',1,'2018-04-01 23:59:00'),(6,13,'midia/15226379825ac19c9e1b073.jpg',1,'2018-04-01 23:59:00'),(7,13,'midia/15226383795ac19e2bdc709.jpg',1,'2018-04-02 00:06:00'),(8,14,'midia/15226971645ac283cc48106.jpg',1,'2018-04-02 14:51:00'),(9,12,'midia/img3211.jpg',1,'2018-04-02 15:24:21'),(10,12,'midia/img3212.jpg',1,'2018-04-02 15:25:51'),(11,12,'midia/img3213.jpg',1,'2018-04-02 15:26:10'),(12,14,'midia/15226972295ac2840d7c4a1.jpg',1,'2018-04-02 16:27:00');
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
  `filiado` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_home`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_home_slide`
--

LOCK TABLES `tbl_home_slide` WRITE;
/*!40000 ALTER TABLE `tbl_home_slide` DISABLE KEYS */;
INSERT INTO `tbl_home_slide` (`id_home`, `imagem`, `filiado`) VALUES (1,'imagens/logo2.jpg',NULL),(2,'imagens/free-wallpaper.jpg',NULL),(7,'imagens/download.jpg',NULL),(14,'imagens/15210784075aa9d087034d5.jpg',NULL),(17,'imagens/15214144155aaef10fa3c63.jpg',NULL),(18,'imagens/15214144375aaef1254aae8.jpg',NULL),(19,'imagens/15214144665aaef14232e04.jpg',NULL),(20,'imagens/15214144835aaef1535ccbc.jpg',NULL),(21,'imagens/15221209295ab9b8e16bb34.jpg',NULL),(23,'imagens/15221922125abacf54b207e.png',NULL),(24,'midia/15223795945abdab4a3c9c7.jpg',12),(25,'midia/15226379365ac19c70f3d2e.jpg',13);
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
INSERT INTO `tbl_index` (`id_index`, `imagem`, `campo`) VALUES (1,'imagens/download.jpg',1),(2,'imagens/www.eyeyspyu.com-mature-men-dont-cheat.jpg',2),(3,'imagens/images (4).jpg',3),(4,'imagens/overshape.jpg',4),(5,'imagens/images (5).jpg',5),(6,'imagens/images (6).jpg',6);
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
  `desconto` int(5) DEFAULT NULL,
  `code` varchar(40) DEFAULT NULL,
  `referencia` varchar(28) DEFAULT NULL,
  `forma` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`id_transferencia`),
  KEY `fk_filiado_idx` (`id_filiado`)
) ENGINE=InnoDB AUTO_INCREMENT=262 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mensalidade`
--

LOCK TABLES `tbl_mensalidade` WRITE;
/*!40000 ALTER TABLE `tbl_mensalidade` DISABLE KEYS */;
INSERT INTO `tbl_mensalidade` (`id_transferencia`, `id_filiado`, `data_hora`, `valor`, `status`, `desconto`, `code`, `referencia`, `forma`) VALUES (259,12,'2018-04-02 12:23:58',0,3,299,'ref040212','mensal12','promocao'),(260,13,'2018-04-02 12:25:16',0,3,299,'ref040213','mensal13','promocao'),(261,14,'2018-04-10 13:36:00',0,3,0,'ref04-02','mensal14','promocao');
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
  `bairro` varchar(150) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `cep` varchar(12) DEFAULT NULL,
  `desconto` int(4) DEFAULT NULL,
  `cpf` varchar(30) NOT NULL,
  `bandeira_cartao` varchar(40) DEFAULT NULL,
  `numero_cartao` varchar(32) DEFAULT NULL,
  `cvv` varchar(15) DEFAULT NULL,
  `expiracaoMes` varchar(15) DEFAULT NULL,
  `expiracaoAno` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_dados_pagamento`),
  KEY `fk_filiado_idx` (`id_filiado`),
  CONSTRAINT `fk_filiado` FOREIGN KEY (`id_filiado`) REFERENCES `tbl_filiado` (`id_filiado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pagamento_filiado`
--

LOCK TABLES `tbl_pagamento_filiado` WRITE;
/*!40000 ALTER TABLE `tbl_pagamento_filiado` DISABLE KEYS */;
INSERT INTO `tbl_pagamento_filiado` (`id_dados_pagamento`, `id_filiado`, `nome`, `sobrenome`, `telefone`, `rua`, `numero`, `bairro`, `cidade`, `uf`, `cep`, `desconto`, `cpf`, `bandeira_cartao`, `numero_cartao`, `cvv`, `expiracaoMes`, `expiracaoAno`) VALUES (4,9,'beatriz','de jesus bellussi','(15)3241125','Rua Urano','25','Vila Eunice','Jandira','SP','06602220',0,'NDY2NDc0ODg4NDc=',NULL,'NTQ0MzE1MzQ4MTc4Nzg2MA==','Nzcx','MDg=','MjAyMg=='),(5,10,'Teste','teste','(11)32411215','Estrada das Pitas','85','Chácara Santa Cecília','Itapevi','SP','06655505',189,'MzY0NjM0MjMzMTk=',NULL,'NDExMTExMTExMTExMTExMQ==','MTIz','MTI=','MjAzMA=='),(6,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'NDQyMzMyNzY4MzE=',NULL,NULL,NULL,NULL,NULL),(7,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'NDgxMzU2Njc4MjU=',NULL,NULL,NULL,NULL,NULL),(8,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MjA0NTU0NTY3OTg=',NULL,NULL,NULL,NULL,NULL),(9,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MDIzNzc3NjkyODQ=',NULL,NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_conta`
--

LOCK TABLES `tbl_tipo_conta` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_conta` DISABLE KEYS */;
INSERT INTO `tbl_tipo_conta` (`id_tipo_conta`, `titulo`, `valor`, `foto`, `video`) VALUES (1,'Basica',299,3,0),(2,'Comum',499,5,0),(4,'GOLD ',699,8,2);
/*!40000 ALTER TABLE `tbl_tipo_conta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'tonig231_tonight'
--

--
-- Dumping routines for database 'tonig231_tonight'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-02 16:36:31
