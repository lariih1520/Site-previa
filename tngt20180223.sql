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
INSERT INTO `tbl_cabelo` VALUES (1,'Loiro(a)'),(2,'Moreno (a)'),(3,'Ruivo (a)'),(4,'Outro');
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
INSERT INTO `tbl_cliente` VALUES (1,'usuario','1999-11-19','usuario@gmail.com','','qwe',1,'','','2018-02-17 16:00:00',0,'midia/a The queen.JPG'),(3,'teste','1990-01-01','teste@email.com','(11)132411215','asd',2,'SP','Itapevi','2018-02-22 18:32:00',1,'midia/logo2.jpg');
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
  `id_etnia` int(11) NOT NULL,
  `etnia` varchar(45) NOT NULL,
  PRIMARY KEY (`id_etnia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_etnia`
--

LOCK TABLES `tbl_etnia` WRITE;
/*!40000 ALTER TABLE `tbl_etnia` DISABLE KEYS */;
INSERT INTO `tbl_etnia` VALUES (1,'Branco (a)'),(2,'Pardo (a)'),(3,'Negro (a)');
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
  `altura` float NOT NULL,
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
  PRIMARY KEY (`id_filiado`),
  KEY `id_tipo_conta_idx` (`id_tipo_conta`),
  KEY `fk_cabelo_idx` (`id_cabelo`),
  KEY `id_raca_idx` (`etnia`),
  CONSTRAINT `fk_cabelo` FOREIGN KEY (`id_cabelo`) REFERENCES `tbl_cabelo` (`id_cabelo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_etnia` FOREIGN KEY (`etnia`) REFERENCES `tbl_etnia` (`id_etnia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_conta` FOREIGN KEY (`id_tipo_conta`) REFERENCES `tbl_tipo_conta` (`id_tipo_conta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_filiado`
--

LOCK TABLES `tbl_filiado` WRITE;
/*!40000 ALTER TABLE `tbl_filiado` DISABLE KEYS */;
INSERT INTO `tbl_filiado` VALUES (1,'usuario','2000-01-03','teste1@gmail.com','aaa','(11)32411215','(11)32411215',2,1,NULL,'midia/usuaria.jpg',160,50,1,1,'1','100000',1,NULL,'RJ','','2018-02-19 20:41:00'),(2,'teste','1987-04-03','teste2@gmail.com','aaa','(11)32411215','(11)32411215',1,2,NULL,'midia//usuario.jpg',160,50,1,1,'1','100000',2,NULL,'SP','Itapevi','2018-02-22 19:16:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_filiado_midia`
--

LOCK TABLES `tbl_filiado_midia` WRITE;
/*!40000 ALTER TABLE `tbl_filiado_midia` DISABLE KEYS */;
INSERT INTO `tbl_filiado_midia` VALUES (1,1,'midia/free-wallpaper.jpg',1,'2018-02-23 16:51:00');
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
  `data_hora` datetime NOT NULL,
  `valor` float NOT NULL,
  `realizada` tinyint(1) NOT NULL,
  `desconto` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_transferencia`),
  KEY `fk_filiado_idx` (`id_filiado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mensalidade`
--

LOCK TABLES `tbl_mensalidade` WRITE;
/*!40000 ALTER TABLE `tbl_mensalidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_mensalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pagamento_cliente`
--

DROP TABLE IF EXISTS `tbl_pagamento_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pagamento_cliente` (
  `id_dados_pagamento` int(11) NOT NULL,
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
  `id_dados_pagamento` int(11) NOT NULL,
  `id_filiado` int(11) NOT NULL,
  `id_valor` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `rua` varchar(200) DEFAULT NULL,
  `numero` varchar(4) DEFAULT NULL,
  `bairro` varchar(150) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `cep` varchar(12) NOT NULL,
  `desconto` tinyint(1) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `bandeira_cartao` varchar(45) DEFAULT NULL,
  `numero_cartao` int(20) DEFAULT NULL,
  `cvv` int(5) DEFAULT NULL,
  `expiracaoMes` int(2) DEFAULT NULL,
  `expiracaoAno` int(4) DEFAULT NULL,
  `forma_pagamento` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_dados_pagamento`),
  KEY `fk_filiado_idx` (`id_filiado`),
  KEY `fk_valor_idx` (`id_valor`),
  CONSTRAINT `fk_filiado` FOREIGN KEY (`id_filiado`) REFERENCES `tbl_filiado` (`id_filiado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_valor` FOREIGN KEY (`id_valor`) REFERENCES `tbl_tipo_conta` (`id_tipo_conta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pagamento_filiado`
--

LOCK TABLES `tbl_pagamento_filiado` WRITE;
/*!40000 ALTER TABLE `tbl_pagamento_filiado` DISABLE KEYS */;
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
  `valor` float NOT NULL,
  `foto` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `tipo_conta` int(11) NOT NULL,
  PRIMARY KEY (`id_tipo_conta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_conta`
--

LOCK TABLES `tbl_tipo_conta` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_conta` DISABLE KEYS */;
INSERT INTO `tbl_tipo_conta` VALUES (1,'Basica',299,3,0,1),(2,'Comum',499,5,0,2),(3,'Gold',699,5,1,3);
/*!40000 ALTER TABLE `tbl_tipo_conta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_tonight'
--
/*!50003 DROP PROCEDURE IF EXISTS `VwDadosFiliado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `VwDadosFiliado`(id int)
BEGIN
	select fi.*, et.etnia, ca.cor as cabelo, tc.foto,
    tc.titulo, tc.valor as valor_conta, tc.video
	from tbl_filiado as fi
	inner join tbl_etnia as et
	on fi.etnia = et.id_etnia
    inner join tbl_tipo_conta as tc
	on tc.id_tipo_conta = fi.id_tipo_conta
	left join tbl_cabelo as ca
	on fi.id_cabelo = ca.id_cabelo
	where fi.id_filiado = id;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `VwDadosPag` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `VwDadosPag`(id int)
BEGIN
	
    select pf.*, tp.valor 
	from tbl_filiado as fi
	inner join tbl_pagamento_filiado as pf
	on fi.id_filiado = pf.id_filiado
	inner join tbl_tipo_conta as tp
	on pf.id_valor = tp.id_tipo_conta
	where fi.id_filiado = id;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `VwDadosUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `VwDadosUsuario`(id int)
BEGIN
	select cl.*
	from tbl_cliente as cl
    where cl.id_cliente = id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-23 19:32:02
