-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: db_theribs
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
-- Table structure for table `tbl_adiantamentos`
--

DROP TABLE IF EXISTS `tbl_adiantamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_adiantamentos` (
  `id_adiantamento` int(11) NOT NULL AUTO_INCREMENT,
  `porcentagem` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `validacao` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_adiantamento`),
  KEY `fk_funcionario_adiantamento_idx` (`id_funcionario`),
  CONSTRAINT `fk_funcionario_adiantamento` FOREIGN KEY (`id_funcionario`) REFERENCES `tbl_funcionario` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_adiantamentos`
--

LOCK TABLES `tbl_adiantamentos` WRITE;
/*!40000 ALTER TABLE `tbl_adiantamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_adiantamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_avaliacao`
--

DROP TABLE IF EXISTS `tbl_avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_avaliacao` (
  `id_avaliacao` int(11) NOT NULL,
  `avaliacao` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id_avaliacao`),
  KEY `fk_cliente_avaliacao_idx` (`id_cliente`),
  CONSTRAINT `fk_cliente_avaliacao` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_avaliacao`
--

LOCK TABLES `tbl_avaliacao` WRITE;
/*!40000 ALTER TABLE `tbl_avaliacao` DISABLE KEYS */;
INSERT INTO `tbl_avaliacao` VALUES (1,5,1),(2,4,2),(3,5,3);
/*!40000 ALTER TABLE `tbl_avaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_avaliacao_funcionario`
--

DROP TABLE IF EXISTS `tbl_avaliacao_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_avaliacao_funcionario` (
  `id_avaliacao` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  KEY `fk_avaliacao_funcionario_idx` (`id_avaliacao`),
  KEY `fk_funcionario_avaliacao_idx` (`id_funcionario`),
  CONSTRAINT `fk_avaliacao_funcionario` FOREIGN KEY (`id_avaliacao`) REFERENCES `tbl_avaliacao` (`id_avaliacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_funcionario_avaliacao` FOREIGN KEY (`id_funcionario`) REFERENCES `tbl_funcionario` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_avaliacao_funcionario`
--

LOCK TABLES `tbl_avaliacao_funcionario` WRITE;
/*!40000 ALTER TABLE `tbl_avaliacao_funcionario` DISABLE KEYS */;
INSERT INTO `tbl_avaliacao_funcionario` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `tbl_avaliacao_funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_avaliacao_produto`
--

DROP TABLE IF EXISTS `tbl_avaliacao_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_avaliacao_produto` (
  `id_avaliacao` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  KEY `fk_produto_cliente_avaliacao_idx` (`id_produto`),
  KEY `fk_avaliacao_cliente_produto` (`id_avaliacao`),
  CONSTRAINT `fk_avaliacao_cliente_produto` FOREIGN KEY (`id_avaliacao`) REFERENCES `tbl_avaliacao` (`id_avaliacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_cliente_avaliacao` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produto` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_avaliacao_produto`
--

LOCK TABLES `tbl_avaliacao_produto` WRITE;
/*!40000 ALTER TABLE `tbl_avaliacao_produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_avaliacao_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_avaliacao_restaurante`
--

DROP TABLE IF EXISTS `tbl_avaliacao_restaurante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_avaliacao_restaurante` (
  `id_avaliacao` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  KEY `fk_avaliacao_cliente_restaurante_idx` (`id_avaliacao`),
  KEY `fk_restaurante_cliente_avaliacao_idx` (`id_restaurante`),
  CONSTRAINT `fk_avaliacao_cliente_restaurante` FOREIGN KEY (`id_avaliacao`) REFERENCES `tbl_avaliacao` (`id_avaliacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_restaurante_cliente_avaliacao` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_avaliacao_restaurante`
--

LOCK TABLES `tbl_avaliacao_restaurante` WRITE;
/*!40000 ALTER TABLE `tbl_avaliacao_restaurante` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_avaliacao_restaurante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_boleto`
--

DROP TABLE IF EXISTS `tbl_boleto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_boleto` (
  `id_boleto` int(11) NOT NULL,
  `emissao` date NOT NULL,
  `vencimento` date NOT NULL,
  `valor` float NOT NULL,
  `situacao` tinyint(1) NOT NULL,
  `id_compra` int(11) NOT NULL,
  PRIMARY KEY (`id_boleto`),
  KEY `fk_compra_boleto_idx` (`id_compra`),
  CONSTRAINT `fk_compra_boleto` FOREIGN KEY (`id_compra`) REFERENCES `tbl_compra` (`id_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_boleto`
--

LOCK TABLES `tbl_boleto` WRITE;
/*!40000 ALTER TABLE `tbl_boleto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_boleto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_brinde`
--

DROP TABLE IF EXISTS `tbl_brinde`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_brinde` (
  `id_brinde` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  `img` varchar(45) NOT NULL,
  `id_valor_brinde` int(11) DEFAULT NULL,
  `nome_brinde` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_brinde`),
  KEY `fk_valor_brinde_idx` (`id_valor_brinde`),
  CONSTRAINT `fk_valor_brinde` FOREIGN KEY (`id_valor_brinde`) REFERENCES `tbl_valores_brindes` (`id_valor_brinde`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_brinde`
--

LOCK TABLES `tbl_brinde` WRITE;
/*!40000 ALTER TABLE `tbl_brinde` DISABLE KEYS */;
INSERT INTO `tbl_brinde` VALUES (1,'fafafa','../fotos/7751f6fa64c63a5ba6ee6e82336a31ec.png',2,'Chaveiro');
/*!40000 ALTER TABLE `tbl_brinde` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cabecalho`
--

DROP TABLE IF EXISTS `tbl_cabecalho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cabecalho` (
  `id_cabecalho` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(100) DEFAULT NULL,
  `texto_boas_vindas` varchar(50) DEFAULT NULL,
  `foto_usuario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_cabecalho`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cabecalho`
--

LOCK TABLES `tbl_cabecalho` WRITE;
/*!40000 ALTER TABLE `tbl_cabecalho` DISABLE KEYS */;
INSERT INTO `tbl_cabecalho` VALUES (1,'000a16ae3f173d9b2055ec85fd80da3d.png','Bem Vindo!','d4785bf795ea822c175989713b4ddb85.png');
/*!40000 ALTER TABLE `tbl_cabecalho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cartao`
--

DROP TABLE IF EXISTS `tbl_cartao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cartao` (
  `id_cartao` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(45) NOT NULL,
  `vencimento` date NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `codigo` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id_cartao`),
  KEY `fk_cliente_cartao_idx` (`id_cliente`),
  CONSTRAINT `fk_cliente_cartao` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cartao`
--

LOCK TABLES `tbl_cartao` WRITE;
/*!40000 ALTER TABLE `tbl_cartao` DISABLE KEYS */;
INSERT INTO `tbl_cartao` VALUES (2,'1545161634','2000-02-20',1,'125','Paulo ss'),(4,'40028922','2000-02-20',1,'567','Filipe ss'),(5,'1545161634','2000-02-20',1,'125','Paulo Henrique');
/*!40000 ALTER TABLE `tbl_cartao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cidade`
--

DROP TABLE IF EXISTS `tbl_cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cidade` (
  `id_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `cidade` varchar(200) NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_cidade`),
  KEY `fk_estado_idx` (`id_estado`),
  CONSTRAINT `fk_estado` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cidade`
--

LOCK TABLES `tbl_cidade` WRITE;
/*!40000 ALTER TABLE `tbl_cidade` DISABLE KEYS */;
INSERT INTO `tbl_cidade` VALUES (1,'São Paulo',1),(2,'Campinas',1),(3,'Campos do Jordão',1);
/*!40000 ALTER TABLE `tbl_cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cliente`
--

DROP TABLE IF EXISTS `tbl_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `senha` varchar(12) NOT NULL,
  `numero` varchar(6) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cliente`
--

LOCK TABLES `tbl_cliente` WRITE;
/*!40000 ALTER TABLE `tbl_cliente` DISABLE KEYS */;
INSERT INTO `tbl_cliente` VALUES (1,'Llala','(11) 4202-8396','(11) 95118-1978','bruno27@uol.com','45','123','504','http://www.media.inaf.it/wp-content/uploads/2014/02/Einstein_laughing.jpeg','06390070'),(2,'haghagshdgahsgh','(11) 4202-8396','(11) 95118-1978','bruno@uol.com','444.176.588-62','123456','125','http://www.media.inaf.it/wp-content/uploads/2014/02/Einstein_laughing.jpeg','06390070'),(3,'diego','42028396','11992965490','bubu-diego@hotmail.com','444.176.588-62','152115','1117','http://www.media.inaf.it/wp-content/uploads/2014/02/Einstein_laughing.jpeg','06390070'),(4,'Matheus Silva da Cruz','1134126717','11993352163','matheusxx20111@hotmail.com','41702922863','123456789','',NULL,'06405050'),(5,'Teste teste','12315','123451','bruno@uol.com','44417658862','123','504',NULL,'06390070'),(6,'Paulo Henrique','1147031538','11943862621','phlferreira1209@gmail.com','48767167810','12092000','',NULL,'06717133');
/*!40000 ALTER TABLE `tbl_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cliente_endereco`
--

DROP TABLE IF EXISTS `tbl_cliente_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cliente_endereco` (
  `id_cliente` int(11) NOT NULL,
  `id_endereco` int(11) NOT NULL,
  KEY `fk_cliente_endereco_idx` (`id_cliente`),
  KEY `fk_endereco_cliente_idx` (`id_endereco`),
  CONSTRAINT `fk_cliente_endereco` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_endereco_cliente` FOREIGN KEY (`id_endereco`) REFERENCES `tbl_endereco` (`id_endereco`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cliente_endereco`
--

LOCK TABLES `tbl_cliente_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_cliente_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_cliente_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_compra`
--

DROP TABLE IF EXISTS `tbl_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_compra` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_fornecedor` int(11) NOT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `fk_fornecedor_compra_idx` (`id_fornecedor`),
  CONSTRAINT `fk_fornecedor_compra` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbl_fornecedor` (`id_fornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_compra`
--

LOCK TABLES `tbl_compra` WRITE;
/*!40000 ALTER TABLE `tbl_compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_compra_ingrediente`
--

DROP TABLE IF EXISTS `tbl_compra_ingrediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_compra_ingrediente` (
  `id_compra` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unidade` float NOT NULL,
  KEY `fk_compra_ingrediente_idx` (`id_compra`),
  KEY `fk_ingrediente_compra_idx` (`id_ingrediente`),
  CONSTRAINT `fk_compra_ingrediente` FOREIGN KEY (`id_compra`) REFERENCES `tbl_compra` (`id_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ingrediente_compra` FOREIGN KEY (`id_ingrediente`) REFERENCES `tbl_ingrediente` (`id_igrediente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_compra_ingrediente`
--

LOCK TABLES `tbl_compra_ingrediente` WRITE;
/*!40000 ALTER TABLE `tbl_compra_ingrediente` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_compra_ingrediente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_compra_nota`
--

DROP TABLE IF EXISTS `tbl_compra_nota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_compra_nota` (
  `id_compra` int(11) NOT NULL,
  `id_nota` int(11) NOT NULL,
  KEY `fk_nota_compra_idx` (`id_nota`),
  KEY `fk_compra_nota` (`id_compra`),
  CONSTRAINT `fk_compra_nota` FOREIGN KEY (`id_compra`) REFERENCES `tbl_compra` (`id_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nota_compra` FOREIGN KEY (`id_nota`) REFERENCES `tbl_nota_fiscal` (`id_nota_fiscal`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_compra_nota`
--

LOCK TABLES `tbl_compra_nota` WRITE;
/*!40000 ALTER TABLE `tbl_compra_nota` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_compra_nota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_compra_produto`
--

DROP TABLE IF EXISTS `tbl_compra_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_compra_produto` (
  `id_compra` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unidade` float NOT NULL,
  KEY `fk_compra_produto_idx` (`id_compra`),
  KEY `fk_produto_compra_idx` (`id_produto`),
  CONSTRAINT `fk_compra_produto` FOREIGN KEY (`id_compra`) REFERENCES `tbl_compra` (`id_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_compra` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produto` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_compra_produto`
--

LOCK TABLES `tbl_compra_produto` WRITE;
/*!40000 ALTER TABLE `tbl_compra_produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_compra_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cor`
--

DROP TABLE IF EXISTS `tbl_cor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cor` (
  `id_cor` int(11) NOT NULL AUTO_INCREMENT,
  `rgb` varchar(45) NOT NULL,
  PRIMARY KEY (`id_cor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cor`
--

LOCK TABLES `tbl_cor` WRITE;
/*!40000 ALTER TABLE `tbl_cor` DISABLE KEYS */;
INSERT INTO `tbl_cor` VALUES (1,'rgb(156,4,4)');
/*!40000 ALTER TABLE `tbl_cor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_deposito_bancario`
--

DROP TABLE IF EXISTS `tbl_deposito_bancario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_deposito_bancario` (
  `id_deposito_bancario` int(11) NOT NULL,
  `valor` double NOT NULL,
  `situacao` tinyint(1) NOT NULL,
  `data_limite` date NOT NULL,
  `id_compra` int(11) NOT NULL,
  PRIMARY KEY (`id_deposito_bancario`),
  KEY `fk_compra_deposito_idx` (`id_compra`),
  CONSTRAINT `fk_compra_deposito` FOREIGN KEY (`id_compra`) REFERENCES `tbl_compra` (`id_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_deposito_bancario`
--

LOCK TABLES `tbl_deposito_bancario` WRITE;
/*!40000 ALTER TABLE `tbl_deposito_bancario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_deposito_bancario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_destaque`
--

DROP TABLE IF EXISTS `tbl_destaque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_destaque` (
  `id_destaque` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `id_img` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  PRIMARY KEY (`id_destaque`),
  KEY `fk_produto_destaque_idx` (`id_produto`),
  CONSTRAINT `fk_produto_destaque` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produto` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_destaque`
--

LOCK TABLES `tbl_destaque` WRITE;
/*!40000 ALTER TABLE `tbl_destaque` DISABLE KEYS */;
INSERT INTO `tbl_destaque` VALUES (1,'teste',111,26),(2,'aaaasfhds',115,20);
/*!40000 ALTER TABLE `tbl_destaque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_endereco`
--

DROP TABLE IF EXISTS `tbl_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_endereco` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `cep` varchar(45) NOT NULL,
  `complemento` varchar(45) NOT NULL,
  `logradouro` varchar(45) NOT NULL,
  PRIMARY KEY (`id_endereco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_endereco`
--

LOCK TABLES `tbl_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estado`
--

DROP TABLE IF EXISTS `tbl_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(80) NOT NULL,
  `uf` varchar(2) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado`
--

LOCK TABLES `tbl_estado` WRITE;
/*!40000 ALTER TABLE `tbl_estado` DISABLE KEYS */;
INSERT INTO `tbl_estado` VALUES (1,'São Paulo','SP');
/*!40000 ALTER TABLE `tbl_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estoque`
--

DROP TABLE IF EXISTS `tbl_estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_estoque` (
  `id_estoque` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurante` int(11) NOT NULL,
  PRIMARY KEY (`id_estoque`),
  KEY `fk_estoque_restaurante_idx` (`id_restaurante`),
  CONSTRAINT `fk_estoque_restaurante` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estoque`
--

LOCK TABLES `tbl_estoque` WRITE;
/*!40000 ALTER TABLE `tbl_estoque` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_estoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_evento_imagem`
--

DROP TABLE IF EXISTS `tbl_evento_imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_evento_imagem` (
  `id_evento` int(11) NOT NULL,
  `id_img` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_evento_imagem`
--

LOCK TABLES `tbl_evento_imagem` WRITE;
/*!40000 ALTER TABLE `tbl_evento_imagem` DISABLE KEYS */;
INSERT INTO `tbl_evento_imagem` VALUES (11,70),(11,71),(11,72),(11,73),(11,74),(11,75),(11,70),(11,72),(11,74),(11,70),(11,72),(11,74),(11,70),(11,72),(11,74),(11,70),(11,72),(11,74),(12,95),(12,96),(12,97),(12,98),(12,99),(12,100);
/*!40000 ALTER TABLE `tbl_evento_imagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_eventos`
--

DROP TABLE IF EXISTS `tbl_eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_eventos` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `sobre` varchar(45) NOT NULL,
  `data` date NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `img_evento` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_evento`),
  KEY `fk_restaurante_evento_idx` (`id_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_eventos`
--

LOCK TABLES `tbl_eventos` WRITE;
/*!40000 ALTER TABLE `tbl_eventos` DISABLE KEYS */;
INSERT INTO `tbl_eventos` VALUES (11,'Evento 1','sadasdasdasdas','2017-12-18',10,'http://www.estaciocarreiras.com.br/wp-content/uploads/2015/10/Eventos.jpg'),(12,'Evento BK','sadasdas','2017-11-03',12,'http://www.estaciocarreiras.com.br/wp-content/uploads/2015/10/Eventos.jpg');
/*!40000 ALTER TABLE `tbl_eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fale`
--

DROP TABLE IF EXISTS `tbl_fale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_fale` (
  `id_fale` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `ocorencia` int(11) NOT NULL,
  `descritivo` varchar(45) NOT NULL,
  `unidade` int(11) NOT NULL,
  PRIMARY KEY (`id_fale`),
  KEY `id_unidade_idx` (`unidade`),
  KEY `ocorrencia_idx` (`ocorencia`),
  CONSTRAINT `id_unidade` FOREIGN KEY (`unidade`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ocorrencia` FOREIGN KEY (`ocorencia`) REFERENCES `tbl_ocorrencia` (`id_ocorrencia`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fale`
--

LOCK TABLES `tbl_fale` WRITE;
/*!40000 ALTER TABLE `tbl_fale` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_fale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_faq`
--

DROP TABLE IF EXISTS `tbl_faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_faq` (
  `id_faq` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta` varchar(50) NOT NULL,
  `resposta` varchar(50) NOT NULL,
  PRIMARY KEY (`id_faq`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_faq`
--

LOCK TABLES `tbl_faq` WRITE;
/*!40000 ALTER TABLE `tbl_faq` DISABLE KEYS */;
INSERT INTO `tbl_faq` VALUES (5,'O que vocês fazem?','fafasfasfas');
/*!40000 ALTER TABLE `tbl_faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ferias`
--

DROP TABLE IF EXISTS `tbl_ferias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_ferias` (
  `id_ferias` int(11) NOT NULL AUTO_INCREMENT,
  `qtde_dias` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `validacao` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_ferias`),
  KEY `fk_ferias_funcionario_idx` (`id_funcionario`),
  CONSTRAINT `fk_ferias_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `tbl_funcionario` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ferias`
--

LOCK TABLES `tbl_ferias` WRITE;
/*!40000 ALTER TABLE `tbl_ferias` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ferias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fornecedor`
--

DROP TABLE IF EXISTS `tbl_fornecedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_fornecedor` (
  `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `cnpj` varchar(45) NOT NULL,
  PRIMARY KEY (`id_fornecedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fornecedor`
--

LOCK TABLES `tbl_fornecedor` WRITE;
/*!40000 ALTER TABLE `tbl_fornecedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_fornecedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fornecedor_endereco`
--

DROP TABLE IF EXISTS `tbl_fornecedor_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_fornecedor_endereco` (
  `id_fornecedor` int(11) NOT NULL,
  `id_endereco` int(11) NOT NULL,
  KEY `fk_fornecedor_endereco_idx` (`id_fornecedor`),
  KEY `fk_endereco_fornecedor_idx` (`id_endereco`),
  CONSTRAINT `fk_endereco_fornecedor` FOREIGN KEY (`id_endereco`) REFERENCES `tbl_endereco` (`id_endereco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fornecedor_endereco` FOREIGN KEY (`id_fornecedor`) REFERENCES `tbl_fornecedor` (`id_fornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fornecedor_endereco`
--

LOCK TABLES `tbl_fornecedor_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_fornecedor_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_fornecedor_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_funcao`
--

DROP TABLE IF EXISTS `tbl_funcao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_funcao` (
  `id_funcao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `id_setor` int(11) NOT NULL,
  PRIMARY KEY (`id_funcao`),
  KEY `fk_setor_funcao_idx` (`id_setor`),
  CONSTRAINT `fk_setor_funcao` FOREIGN KEY (`id_setor`) REFERENCES `tbl_setor` (`id_setor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_funcao`
--

LOCK TABLES `tbl_funcao` WRITE;
/*!40000 ALTER TABLE `tbl_funcao` DISABLE KEYS */;
INSERT INTO `tbl_funcao` VALUES (1,'Panfleteiro',22),(2,'Garçom',23);
/*!40000 ALTER TABLE `tbl_funcao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_funcionario`
--

DROP TABLE IF EXISTS `tbl_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_funcionario` (
  `id_funcionario` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `id_funcao` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `senha` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_funcionario`),
  KEY `fk_restaurante_funcionario_idx` (`id_restaurante`),
  KEY `fk_funcao_funcionario_idx` (`id_funcao`),
  CONSTRAINT `fk_funcao_funcionario` FOREIGN KEY (`id_funcao`) REFERENCES `tbl_funcao` (`id_funcao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_restaurante_funcionario` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_funcionario`
--

LOCK TABLES `tbl_funcionario` WRITE;
/*!40000 ALTER TABLE `tbl_funcionario` DISABLE KEYS */;
INSERT INTO `tbl_funcionario` VALUES (1,'Marcelo Bruno','951181978','bruno@uol.com',1,10,'666'),(2,'Patati','50505050','patati@email.com',2,11,'321'),(3,'Patata','40404040','patata@email.com',2,11,'543');
/*!40000 ALTER TABLE `tbl_funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_funcionario_endereco`
--

DROP TABLE IF EXISTS `tbl_funcionario_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_funcionario_endereco` (
  `id_funcionario` int(11) NOT NULL,
  `id_endereco` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_funcionario_endereco`
--

LOCK TABLES `tbl_funcionario_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_funcionario_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_funcionario_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_galeria`
--

DROP TABLE IF EXISTS `tbl_galeria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_galeria` (
  `id_galeria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_galeria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_galeria`
--

LOCK TABLES `tbl_galeria` WRITE;
/*!40000 ALTER TABLE `tbl_galeria` DISABLE KEYS */;
INSERT INTO `tbl_galeria` VALUES (1,'galeria 1'),(2,'galeria 2'),(3,'galeria 3'),(4,'galeria 4'),(5,'galeria 5');
/*!40000 ALTER TABLE `tbl_galeria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_galeria_img`
--

DROP TABLE IF EXISTS `tbl_galeria_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_galeria_img` (
  `id_galeria` int(11) NOT NULL,
  `id_img` int(11) NOT NULL,
  KEY `fk_img_galeria_idx` (`id_img`),
  KEY `fk_galeria_img_idx` (`id_galeria`),
  CONSTRAINT `fk_galeria_img` FOREIGN KEY (`id_galeria`) REFERENCES `tbl_galeria` (`id_galeria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_img_galeria` FOREIGN KEY (`id_img`) REFERENCES `tbl_imagem` (`id_imagem`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_galeria_img`
--

LOCK TABLES `tbl_galeria_img` WRITE;
/*!40000 ALTER TABLE `tbl_galeria_img` DISABLE KEYS */;
INSERT INTO `tbl_galeria_img` VALUES (1,1),(1,2),(1,3),(2,4),(2,5),(2,6),(2,7),(3,8),(3,9),(4,10),(4,11),(4,12),(5,13),(5,14),(5,15),(5,16),(5,17);
/*!40000 ALTER TABLE `tbl_galeria_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_galeria_titulo`
--

DROP TABLE IF EXISTS `tbl_galeria_titulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_galeria_titulo` (
  `idTitulo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`idTitulo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_galeria_titulo`
--

LOCK TABLES `tbl_galeria_titulo` WRITE;
/*!40000 ALTER TABLE `tbl_galeria_titulo` DISABLE KEYS */;
INSERT INTO `tbl_galeria_titulo` VALUES (1,'The Ribs','O melhor restaurante');
/*!40000 ALTER TABLE `tbl_galeria_titulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_graduacoes`
--

DROP TABLE IF EXISTS `tbl_graduacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_graduacoes` (
  `id_graduacao` int(11) NOT NULL AUTO_INCREMENT,
  `desc` text NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  PRIMARY KEY (`id_graduacao`),
  KEY `fk_graduacao_funcionario_idx` (`id_funcionario`),
  CONSTRAINT `fk_graduacao_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `tbl_funcionario` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_graduacoes`
--

LOCK TABLES `tbl_graduacoes` WRITE;
/*!40000 ALTER TABLE `tbl_graduacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_graduacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_historia`
--

DROP TABLE IF EXISTS `tbl_historia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_historia` (
  `id_historia` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(11) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id_historia`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_historia`
--

LOCK TABLES `tbl_historia` WRITE;
/*!40000 ALTER TABLE `tbl_historia` DISABLE KEYS */;
INSERT INTO `tbl_historia` VALUES (2,2017,'skamdksamdksamkdm'),(3,2015,'sd,ad,asdsadas'),(4,2018,'assd'),(5,2016,'The ribs em 2016'),(6,2014,'Criação dos Eventos The Ribs');
/*!40000 ALTER TABLE `tbl_historia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_home_carrossel`
--

DROP TABLE IF EXISTS `tbl_home_carrossel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_home_carrossel` (
  `id_home_carrossel` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id_home_carrossel`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_home_carrossel`
--

LOCK TABLES `tbl_home_carrossel` WRITE;
/*!40000 ALTER TABLE `tbl_home_carrossel` DISABLE KEYS */;
INSERT INTO `tbl_home_carrossel` VALUES (1,'imagens/carne.jpg'),(2,'imagens/img10.jpg'),(3,'imagens/costela_assada.jpg'),(4,'imagens/img9.jpg'),(5,'imagens/costela_assada.jpg'),(7,'imagens/carne.jpg');
/*!40000 ALTER TABLE `tbl_home_carrossel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_home_menu`
--

DROP TABLE IF EXISTS `tbl_home_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_home_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `imagem` varchar(100) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `area` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_home_menu`
--

LOCK TABLES `tbl_home_menu` WRITE;
/*!40000 ALTER TABLE `tbl_home_menu` DISABLE KEYS */;
INSERT INTO `tbl_home_menu` VALUES (1,'imagens/back-galeria.png','Home','',1),(2,'imagens/0foa.jpg','Login e Cadastro','Venha se cadastrar na melhor Steakhouse do Brasl',2),(3,'imagens/back-contato.png','contato','teste',3),(4,'imagens/back-eventos.png','eventos','teste',4),(5,'imagens/back-sobre.png','Sobre','Quer nos conhecer ? Clique aqui e saiba mais sobre a melhor SteakHouse do Brasil',5),(6,'imagens/back-galeria.png','galeria','teste',6),(7,'imagens/back-reservas.png','reservas','teste',7),(8,'imagens/back-sobre.png','sobre','teste',8);
/*!40000 ALTER TABLE `tbl_home_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_home_slide`
--

DROP TABLE IF EXISTS `tbl_home_slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_home_slide` (
  `id_home_slide` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id_home_slide`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_home_slide`
--

LOCK TABLES `tbl_home_slide` WRITE;
/*!40000 ALTER TABLE `tbl_home_slide` DISABLE KEYS */;
INSERT INTO `tbl_home_slide` VALUES (1,'imagens/1.jpg'),(3,'imagens/mr robot.jpg'),(4,'imagens/2.png');
/*!40000 ALTER TABLE `tbl_home_slide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_imagem`
--

DROP TABLE IF EXISTS `tbl_imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_imagem` (
  `id_imagem` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id_imagem`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_imagem`
--

LOCK TABLES `tbl_imagem` WRITE;
/*!40000 ALTER TABLE `tbl_imagem` DISABLE KEYS */;
INSERT INTO `tbl_imagem` VALUES (1,'../fotos/2bdac302b7adaae4a62ce3d7ed3cc8c1.png'),(2,'../fotos/15983e5daac7fd7c4675a278ce155a21.jpg'),(3,'../fotos/c2ab0c753b181d0a6f05243c8ac9eb2a.png'),(4,'../fotos/35393e0e13c8f3b20a9317d38e7c58f8.JPG'),(5,'../fotos/e247cb3bcda3c3e407647e761f5391c9.png'),(6,'../fotos/6fa22ec3c521bed88906cb26c21785d1.png'),(7,'../fotos/2bb44127636b62da139f256ceb75647e.png'),(8,'../fotos/246279a08f9bec70dfdd00cd9fc37bae.jpg'),(9,'../fotos/fd23ca818a24a3850f277f0f7b93dbbd.png'),(10,'../fotos/0ce26d8b216b928995b2a7a1cab57305.png'),(11,'../fotos/a1b5fc9aad1d7c565d6206971f3b49c2.jpg'),(12,'../fotos/0fbba57ed26e4224490a3e4f4c17bfa7.png'),(13,'../fotos/189e4ff5f07625114c3ba15e1d0883ff.png'),(14,'../fotos/fcbad07af16362f7cf520c9b564d55dd.png'),(15,'../fotos/2227c8ccce948438e1cf71a51a703ea3.jpg'),(16,'../fotos/5e20943770dc3ff905e4694233fca9dd.png'),(17,'../fotos/60eeb4304b34b8d25c8c3c4b7020678a.jpg'),(18,'11'),(19,'../fotos/2f69c23ce92c424bfa2283f51141e270.png'),(20,'../fotos/56ec354732e9837b1181c457ee52f236.jpg'),(21,'../fotos/840b75e18690181e1c7f52fffb968f1f.png'),(22,'../fotos/b3a5d1766e5f53499f643d4d3aff1442.png'),(23,'../fotos/1a9468a0b845ebcdcdd29386e893f689.jpg'),(24,'../fotos/d82b32f04fd611b0d9d46fe2f2f948b8.jpg'),(25,'../fotos/c7d6bf09faad4c87e641d436b79d5ee0.jpg'),(26,'456'),(27,'../fotos/801a188a1194a752862d33a94de9e484.jpg'),(28,'../fotos/affef78e18c663ba27a419e0ed1357ea.jpg'),(29,'../fotos/02324f125c5b7be5e75aab391896ad43.jpg'),(30,'645'),(31,'../fotos/d8536cab2ef7676e09f76b341d999a38.png'),(32,'../fotos/9b2183a184cb058901240220789763ef.jpg'),(33,'../fotos/664c7d9202b6ea9613a05f49022ddc4c.jpg'),(34,'imagens/download.jpg'),(35,'../fotos/7c2109b90a0ab5c7ea66ab601791c237.jpg'),(36,'../fotos/770603b571825458f68f2002870363e9.png'),(37,'imagens/java.png'),(40,'imagens/html.png'),(41,''),(42,'../fotos/16eed85bede7014e7f7e6cbe127c7f4f.png'),(43,''),(44,'../fotos/a8f2151f2eaf6dc2de4145d78fb3a309.png'),(45,''),(46,'../fotos/1b3805bd8a4fac81e0b059b17349cc90.PNG'),(47,'imagens/back-contato.png'),(48,'imagens/back-cardapio.png'),(49,'imagens/bcak-contato.png'),(50,'../fotos/0f9fb9925caf7e1d40e20fa2fcd303ff.png'),(51,'../fotos/848f3ed0a1e251ebd2916244c3c8af6f.png'),(52,'../fotos/7ada2a7a707efd91a4e3360979a38660.png'),(53,'../fotos/16abf4c6ab80fa7e0e9a1f45592ef87c.PNG'),(54,'../fotos/54d821603f6e0e12f2eb596d1ad8252a.png'),(55,'../fotos/37ac4ac9792085108d222ccc3226fbab.png'),(56,'imagens/back-cardapio.png'),(57,'../fotos/4475f04f964136b92d5e15076ea80b67.png'),(58,'../fotos/5f218c2b935285e575a9d49eb906ba68.png'),(59,'../fotos/92124b143dc2ca89eaa874dca8874224.png'),(60,'../fotos/6b1d3d189ff73a6a9df471cb86bb5519.PNG'),(61,'../fotos/6454accab40a600ee81f08922850b17b.png'),(62,'../fotos/b14a0c1f7c7b876413382938ec4118ac.png'),(63,'imagens/carne.jpg'),(64,'imagens/back-cardapio.png'),(65,'../fotos/fb8b94c058595bf9c88b10d3920ac623.png'),(66,'imagens/back-cardapio.png'),(67,'../fotos/f1ab99c912afc2ec4665ecf9c2870179.png'),(68,'imagens/back-cardapio.png'),(69,'../fotos/9667f732d060bdfd7a42bae63222340c.png'),(70,'../fotos/1534f1227f40c243795ffa0d0cfd4d49.png'),(71,'../fotos/4bf2192fa4f2dc1f6d854972c32efe00.png'),(72,'../fotos/91a6fecf932e131c325a5a0393377dd9.jpg'),(73,'../fotos/9c17f474a7abbed77296476c9e290f95.PNG'),(74,'../fotos/f7f8fee5880a3f65f35c80dc6bb668a8.png'),(75,'../fotos/6bef70893c13676993ad55184c12f20c.png'),(76,'imagens/Capturar.JPG'),(77,'../fotos/ac60e0b073c38c01550fd0a6d181f4e8.png'),(78,'imagens/carne-vegetais.jpg'),(83,'imagens/Capturar.JPG'),(84,'imagens/Capturar.JPG'),(85,'imagens/Capturar.JPG'),(86,'imagens/Capturar.JPG'),(87,'imagens/carne-vegetais.jpg'),(88,'imagens/chef1.jpg'),(89,'imagens/carne-vegetais.jpg'),(90,'imagens/carne-vegetais.jpg'),(91,'imagens/img5.jpg'),(92,'imagens/carne.jpg'),(94,'imagens/5.png'),(95,'imagens/0foa.jpg'),(96,'imagens/Capturar.JPG'),(97,'imagens/0foa.jpg'),(98,'imagens/Capturar.JPG'),(99,'imagens/0foa.jpg'),(100,'imagens/0foa.jpg'),(102,'imagens/back-cardapio.png'),(103,'imagens/carne-vegetais.jpg'),(104,'imagens/carne-vegetais.jpg'),(105,'imagens/0foa.jpg'),(106,'imagens/0foa.jpg'),(107,'imagens/Capturar.JPG'),(108,'imagens/Capturar.JPG'),(109,'imagens/0foa.jpg'),(110,'imagens/salada.jpg'),(111,'imagens/0foa.jpg'),(112,'imagens/chef3.jpg'),(113,'imagens/2.png'),(114,'imagens/dieta-da-salada.jpg'),(115,'imagens/0foa.jpg');
/*!40000 ALTER TABLE `tbl_imagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ingrediente`
--

DROP TABLE IF EXISTS `tbl_ingrediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_ingrediente` (
  `id_igrediente` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(10) unsigned NOT NULL,
  `nome` varchar(45) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `unidade_medida` varchar(10) NOT NULL,
  PRIMARY KEY (`id_igrediente`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ingrediente`
--

LOCK TABLES `tbl_ingrediente` WRITE;
/*!40000 ALTER TABLE `tbl_ingrediente` DISABLE KEYS */;
INSERT INTO `tbl_ingrediente` VALUES (1,0,'Arroz',0,''),(2,0,'Feijão',0,''),(3,0,'Picanha',0,''),(4,0,'Maminha',0,''),(5,0,'Alface',0,''),(6,0,'Tomate',0,''),(7,0,'Farofa',0,'');
/*!40000 ALTER TABLE `tbl_ingrediente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ingrediente_estoque`
--

DROP TABLE IF EXISTS `tbl_ingrediente_estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_ingrediente_estoque` (
  `id_ingrediente` int(11) NOT NULL,
  `id_estoque` int(11) NOT NULL,
  KEY `fk_ingrediente_estoque_idx` (`id_ingrediente`),
  KEY `fk_estoque_ingrediente_idx` (`id_estoque`),
  CONSTRAINT `fk_estoque_ingrediente` FOREIGN KEY (`id_estoque`) REFERENCES `tbl_estoque` (`id_estoque`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ingrediente_estoque` FOREIGN KEY (`id_ingrediente`) REFERENCES `tbl_ingrediente` (`id_igrediente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ingrediente_estoque`
--

LOCK TABLES `tbl_ingrediente_estoque` WRITE;
/*!40000 ALTER TABLE `tbl_ingrediente_estoque` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ingrediente_estoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_institucional`
--

DROP TABLE IF EXISTS `tbl_institucional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_institucional` (
  `id_instituciaonal` int(11) NOT NULL AUTO_INCREMENT,
  `missao` text NOT NULL,
  `visao` text NOT NULL,
  `valores` text NOT NULL,
  `fundadores` text NOT NULL,
  PRIMARY KEY (`id_instituciaonal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_institucional`
--

LOCK TABLES `tbl_institucional` WRITE;
/*!40000 ALTER TABLE `tbl_institucional` DISABLE KEYS */;
INSERT INTO `tbl_institucional` VALUES (1,'A nossa missão é ser a maior SteakHouse até 2020','Nossa visão é ampla','Muito Caro','Uns mano aí');
/*!40000 ALTER TABLE `tbl_institucional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_jeito`
--

DROP TABLE IF EXISTS `tbl_jeito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_jeito` (
  `img_1` text NOT NULL,
  `img_2` text NOT NULL,
  `img_3` text NOT NULL,
  `img_4` text NOT NULL,
  `img_5` text NOT NULL,
  `img_6` text NOT NULL,
  `img_7` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_jeito`
--

LOCK TABLES `tbl_jeito` WRITE;
/*!40000 ALTER TABLE `tbl_jeito` DISABLE KEYS */;
INSERT INTO `tbl_jeito` VALUES ('../fotos/b5f6751124f717e7110c96998850b5c0.png','../fotos/e29794c920ec1d10ebae3ea0318416ce.png','../fotos/694cb03469538b054d559db9f990e291.png','../fotos/b86a557aaced8557ecb24737f460b210.png','../fotos/aac20a10204e654993e79f560b6a39a1.png','../fotos/6e81c5de1edd956a34908838332f20dc.png','../fotos/505b214d4790cafe550e45956e28270f.png');
/*!40000 ALTER TABLE `tbl_jeito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menu_home`
--

DROP TABLE IF EXISTS `tbl_menu_home`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_menu_home` (
  `id_menu_home` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_menu_home`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu_home`
--

LOCK TABLES `tbl_menu_home` WRITE;
/*!40000 ALTER TABLE `tbl_menu_home` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_menu_home` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menu_img`
--

DROP TABLE IF EXISTS `tbl_menu_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_menu_img` (
  `id_menu_home` int(11) NOT NULL,
  `id_img` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu_img`
--

LOCK TABLES `tbl_menu_img` WRITE;
/*!40000 ALTER TABLE `tbl_menu_img` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_menu_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mesa`
--

DROP TABLE IF EXISTS `tbl_mesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mesa` (
  `id_mesa` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `lugares` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `validacao_reserva` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_mesa`),
  KEY `fk_restaurante_mesa_idx` (`id_restaurante`),
  CONSTRAINT `fk_restaurante_mesa` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mesa`
--

LOCK TABLES `tbl_mesa` WRITE;
/*!40000 ALTER TABLE `tbl_mesa` DISABLE KEYS */;
INSERT INTO `tbl_mesa` VALUES (1,1,4,10,0),(2,2,6,10,0),(3,1,6,11,1),(4,2,4,11,1),(5,3,2,11,1),(6,4,2,11,0),(7,5,2,11,0);
/*!40000 ALTER TABLE `tbl_mesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_motivo_login`
--

DROP TABLE IF EXISTS `tbl_motivo_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_motivo_login` (
  `id_motivo` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `id_img` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_motivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_motivo_login`
--

LOCK TABLES `tbl_motivo_login` WRITE;
/*!40000 ALTER TABLE `tbl_motivo_login` DISABLE KEYS */;
INSERT INTO `tbl_motivo_login` VALUES (1,'Teste 1','Descricao tralala',6,1),(2,'Teste 2','lalalala',7,0),(3,'Teste 3','cupcake',8,0),(4,'Teste','LAlalala',32,1),(5,'asa','sdaasdas',34,0),(6,'fsafas','fasas',40,0),(7,'Por que se cadastrar?','fasssssjqadgnqkjdgnqjgjqsgnkadnkjgasdgasd',47,1);
/*!40000 ALTER TABLE `tbl_motivo_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nota_brinde`
--

DROP TABLE IF EXISTS `tbl_nota_brinde`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nota_brinde` (
  `id_nota_fiscal` int(11) NOT NULL,
  `id_brinde` int(11) NOT NULL,
  `retirado` tinyint(4) NOT NULL,
  KEY `fk_nota_brinde_idx` (`id_nota_fiscal`),
  KEY `fk_brinde_nota_idx` (`id_brinde`),
  CONSTRAINT `fk_brinde_nota` FOREIGN KEY (`id_brinde`) REFERENCES `tbl_brinde` (`id_brinde`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nota_brinde` FOREIGN KEY (`id_nota_fiscal`) REFERENCES `tbl_nota_fiscal` (`id_nota_fiscal`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nota_brinde`
--

LOCK TABLES `tbl_nota_brinde` WRITE;
/*!40000 ALTER TABLE `tbl_nota_brinde` DISABLE KEYS */;
INSERT INTO `tbl_nota_brinde` VALUES (1,1,1);
/*!40000 ALTER TABLE `tbl_nota_brinde` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nota_fiscal`
--

DROP TABLE IF EXISTS `tbl_nota_fiscal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nota_fiscal` (
  `id_nota_fiscal` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(45) NOT NULL,
  `emissao` datetime DEFAULT NULL,
  `id_pedido` int(11) NOT NULL,
  PRIMARY KEY (`id_nota_fiscal`),
  KEY `fk_pedido_nota_idx` (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nota_fiscal`
--

LOCK TABLES `tbl_nota_fiscal` WRITE;
/*!40000 ALTER TABLE `tbl_nota_fiscal` DISABLE KEYS */;
INSERT INTO `tbl_nota_fiscal` VALUES (1,'128151',NULL,1),(2,'128152',NULL,2);
/*!40000 ALTER TABLE `tbl_nota_fiscal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ocorrencia`
--

DROP TABLE IF EXISTS `tbl_ocorrencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_ocorrencia` (
  `id_ocorrencia` int(11) NOT NULL AUTO_INCREMENT,
  `ocorrencia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_ocorrencia`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ocorrencia`
--

LOCK TABLES `tbl_ocorrencia` WRITE;
/*!40000 ALTER TABLE `tbl_ocorrencia` DISABLE KEYS */;
INSERT INTO `tbl_ocorrencia` VALUES (57,'Reclamação');
/*!40000 ALTER TABLE `tbl_ocorrencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pais`
--

DROP TABLE IF EXISTS `tbl_pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pais` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(45) NOT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pais`
--

LOCK TABLES `tbl_pais` WRITE;
/*!40000 ALTER TABLE `tbl_pais` DISABLE KEYS */;
INSERT INTO `tbl_pais` VALUES (1,'Brasil');
/*!40000 ALTER TABLE `tbl_pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pedido`
--

DROP TABLE IF EXISTS `tbl_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `id_garcom` int(11) NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_cliente_pedido_idx` (`id_cliente`),
  KEY `fk_garcom_pedido_idx` (`id_garcom`),
  KEY `fk_pedido_mesa_idx` (`id_mesa`),
  CONSTRAINT `fk_cliente_pedido` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_mesa` FOREIGN KEY (`id_mesa`) REFERENCES `tbl_mesa` (`id_mesa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pedido`
--

LOCK TABLES `tbl_pedido` WRITE;
/*!40000 ALTER TABLE `tbl_pedido` DISABLE KEYS */;
INSERT INTO `tbl_pedido` VALUES (1,'2017-10-05',1,2,2),(2,'2017-10-08',3,1,2),(3,'2017-10-10',2,3,3);
/*!40000 ALTER TABLE `tbl_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pedido_nota`
--

DROP TABLE IF EXISTS `tbl_pedido_nota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pedido_nota` (
  `id_pedido` int(11) NOT NULL,
  `id_nota` int(11) NOT NULL,
  KEY `fk_pedido_nota_idx` (`id_pedido`),
  KEY `fk_nota_pedido_idx` (`id_nota`),
  CONSTRAINT `fk_nota_pedido` FOREIGN KEY (`id_nota`) REFERENCES `tbl_nota_fiscal` (`id_nota_fiscal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_nota` FOREIGN KEY (`id_pedido`) REFERENCES `tbl_pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pedido_nota`
--

LOCK TABLES `tbl_pedido_nota` WRITE;
/*!40000 ALTER TABLE `tbl_pedido_nota` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pedido_nota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pedido_produto`
--

DROP TABLE IF EXISTS `tbl_pedido_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pedido_produto` (
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  KEY `fk_produto_pedido_idx` (`id_produto`),
  KEY `fk_pedido_produto` (`id_pedido`),
  CONSTRAINT `fk_pedido_produto` FOREIGN KEY (`id_pedido`) REFERENCES `tbl_pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_pedido` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produto` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pedido_produto`
--

LOCK TABLES `tbl_pedido_produto` WRITE;
/*!40000 ALTER TABLE `tbl_pedido_produto` DISABLE KEYS */;
INSERT INTO `tbl_pedido_produto` VALUES (1,2),(2,1),(3,2),(1,1);
/*!40000 ALTER TABLE `tbl_pedido_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_periodo`
--

DROP TABLE IF EXISTS `tbl_periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_periodo` (
  `id_periodo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `horario` varchar(45) NOT NULL,
  PRIMARY KEY (`id_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_periodo`
--

LOCK TABLES `tbl_periodo` WRITE;
/*!40000 ALTER TABLE `tbl_periodo` DISABLE KEYS */;
INSERT INTO `tbl_periodo` VALUES (1,'Almoço','11:30-15:00'),(2,'Janta','18:00-00:00');
/*!40000 ALTER TABLE `tbl_periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto`
--

DROP TABLE IF EXISTS `tbl_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `preco` double NOT NULL,
  `descricao` text,
  `tipo_produto` int(11) NOT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `fk_tipo_produto_idx` (`tipo_produto`),
  CONSTRAINT `fk_tipo_produto` FOREIGN KEY (`tipo_produto`) REFERENCES `tbl_tipo_produto` (`id_tipo_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto`
--

LOCK TABLES `tbl_produto` WRITE;
/*!40000 ALTER TABLE `tbl_produto` DISABLE KEYS */;
INSERT INTO `tbl_produto` VALUES (1,'Picanha ao forno',30,'Carne',1),(2,'suco',5,'Suco de morango',4),(18,'Funciooonaaaa',20,'aaaaaaaa',3),(20,'Salada mista',15,'aaaaaaaa',4),(21,'123 Testando',18,'sfedg dht tsh',3),(22,'123 Testando',18,'sfedg dht tsh',3),(23,'123 Testando',18,'sfedg dht tsh',3),(24,'123 Testando',18,'sfedg dht tsh',3),(25,'bbbbb',12,'sadasd',4),(26,'Costela de porco',18,'arfrsygrt6u',4),(27,'Costela mal passada',20,'afssfrghthj',4),(28,'Picanha e Batata',50,'Ter uma alimentação saudável é fundamental para que as funções do organismo funcionem de foma equilibrada.De forma prática, uma alimentação saudável é aquela composta por todos os macro e micronutrientes.',4),(29,'aaaa',20,'sfery',1),(30,'asf',50,'dsgd',1),(31,'sdg',100,'sgffth',2);
/*!40000 ALTER TABLE `tbl_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto_img`
--

DROP TABLE IF EXISTS `tbl_produto_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produto_img` (
  `id_produto` int(11) NOT NULL,
  `id_img` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto_img`
--

LOCK TABLES `tbl_produto_img` WRITE;
/*!40000 ALTER TABLE `tbl_produto_img` DISABLE KEYS */;
INSERT INTO `tbl_produto_img` VALUES (3,78),(4,86),(4,87),(4,87),(4,87),(4,88),(4,89),(4,90),(4,91),(19,92),(20,110),(26,108),(27,104),(28,107),(29,112),(30,113),(31,114);
/*!40000 ALTER TABLE `tbl_produto_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto_ingrediente`
--

DROP TABLE IF EXISTS `tbl_produto_ingrediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produto_ingrediente` (
  `qtde` float NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL,
  KEY `fk_produto_ingrediente_idx` (`id_produto`),
  KEY `fk_ingrediente_produto_idx` (`id_ingrediente`),
  CONSTRAINT `fk_ingrediente_produto` FOREIGN KEY (`id_ingrediente`) REFERENCES `tbl_ingrediente` (`id_igrediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_ingrediente` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produto` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto_ingrediente`
--

LOCK TABLES `tbl_produto_ingrediente` WRITE;
/*!40000 ALTER TABLE `tbl_produto_ingrediente` DISABLE KEYS */;
INSERT INTO `tbl_produto_ingrediente` VALUES (1,1,3),(1,1,1),(1,1,2),(2,28,1),(25,28,2),(2,28,3),(36,28,4),(78,28,5),(5,28,6),(1,28,7),(1,27,1),(2,27,3),(3,27,6),(2,27,7),(7,26,1),(3,26,5),(2,20,3),(1,20,4),(2,20,5),(4,29,2),(1,30,1),(5,31,6);
/*!40000 ALTER TABLE `tbl_produto_ingrediente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto_restaurante`
--

DROP TABLE IF EXISTS `tbl_produto_restaurante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produto_restaurante` (
  `id_produto` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  KEY `fk_produto_restaurante_idx` (`id_produto`),
  KEY `fk_restuarante_produto_idx` (`id_restaurante`),
  CONSTRAINT `fk_produto_restaurante` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produto` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_restuarante_produto` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto_restaurante`
--

LOCK TABLES `tbl_produto_restaurante` WRITE;
/*!40000 ALTER TABLE `tbl_produto_restaurante` DISABLE KEYS */;
INSERT INTO `tbl_produto_restaurante` VALUES (26,10),(27,10),(27,11),(27,10),(27,11),(28,10),(28,11),(28,10),(28,11),(28,12),(28,10),(28,11),(28,12),(26,10),(28,10),(28,11),(28,12),(28,10),(28,11),(28,12),(20,10),(20,11),(20,10),(20,11),(27,10),(27,11),(28,10),(28,11),(28,12),(27,10),(27,11),(26,10),(20,10),(20,11),(20,10),(20,11),(20,12),(29,11),(30,10),(30,11),(31,12);
/*!40000 ALTER TABLE `tbl_produto_restaurante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto_tipo_prato`
--

DROP TABLE IF EXISTS `tbl_produto_tipo_prato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produto_tipo_prato` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_prato` int(11) NOT NULL,
  KEY `fk_tipo_prato_produto_idx` (`id_tipo_prato`),
  KEY `fk_produto_tipo_prato` (`id_produto`),
  CONSTRAINT `fk_produto_tipo_prato` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produto` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_prato_produto` FOREIGN KEY (`id_tipo_prato`) REFERENCES `tbl_tipo_prato` (`id_tipo_prato`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto_tipo_prato`
--

LOCK TABLES `tbl_produto_tipo_prato` WRITE;
/*!40000 ALTER TABLE `tbl_produto_tipo_prato` DISABLE KEYS */;
INSERT INTO `tbl_produto_tipo_prato` VALUES (26,1),(27,1),(28,1),(29,1),(30,1),(31,3);
/*!40000 ALTER TABLE `tbl_produto_tipo_prato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rede`
--

DROP TABLE IF EXISTS `tbl_rede`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rede` (
  `id_rede` int(11) NOT NULL AUTO_INCREMENT,
  `nome_rede` varchar(50) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `hexadecimal` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`id_rede`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rede`
--

LOCK TABLES `tbl_rede` WRITE;
/*!40000 ALTER TABLE `tbl_rede` DISABLE KEYS */;
INSERT INTO `tbl_rede` VALUES (1,'Facebook','https://www.facebook.com','daa9e6de037d3240af08fcd84715940f.png','#3b5998'),(2,'Instagram','https://www.facebook.com','adf1a56eb982be796172fa3364aa68b6.png','#3b5998'),(5,'Twitter','https://www.facebook.com','1062ea708e0f80b6560ae42dafbfee95.png',NULL);
/*!40000 ALTER TABLE `tbl_rede` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reserva`
--

DROP TABLE IF EXISTS `tbl_reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_reserva` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_reserva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reserva`
--

LOCK TABLES `tbl_reserva` WRITE;
/*!40000 ALTER TABLE `tbl_reserva` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reserva_funcionario`
--

DROP TABLE IF EXISTS `tbl_reserva_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_reserva_funcionario` (
  `id_reserva` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  KEY `fk_funcionario_reserva_idx` (`id_funcionario`),
  KEY `fk_reserva_funcionario` (`id_reserva`),
  CONSTRAINT `fk_funcionario_reserva` FOREIGN KEY (`id_funcionario`) REFERENCES `tbl_funcionario` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_funcionario` FOREIGN KEY (`id_reserva`) REFERENCES `tbl_reservas` (`id_reserva`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reserva_funcionario`
--

LOCK TABLES `tbl_reserva_funcionario` WRITE;
/*!40000 ALTER TABLE `tbl_reserva_funcionario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_reserva_funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reservas`
--

DROP TABLE IF EXISTS `tbl_reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_reservas` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `data` date NOT NULL,
  `validacao` tinyint(1) DEFAULT NULL,
  `id_mesa` int(11) NOT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `fk_cliente_reserva_idx` (`id_cliente`),
  KEY `fk_periodo_reserva_idx` (`id_periodo`),
  KEY `fk_mesa_reserva_idx` (`id_mesa`),
  CONSTRAINT `fk_cliente_reserva` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mesa_reserva` FOREIGN KEY (`id_mesa`) REFERENCES `tbl_mesa` (`id_mesa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_periodo_reserva` FOREIGN KEY (`id_periodo`) REFERENCES `tbl_periodo` (`id_periodo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reservas`
--

LOCK TABLES `tbl_reservas` WRITE;
/*!40000 ALTER TABLE `tbl_reservas` DISABLE KEYS */;
INSERT INTO `tbl_reservas` VALUES (1,1,1,'2017-11-10',0,4),(2,2,2,'2017-12-10',0,4),(3,1,1,'2017-11-20',1,1),(4,4,1,'2017-12-12',1,3),(5,4,2,'2017-12-14',1,5),(6,5,2,'2017-12-25',0,5);
/*!40000 ALTER TABLE `tbl_reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_restaurante`
--

DROP TABLE IF EXISTS `tbl_restaurante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_restaurante` (
  `id_restaurante` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `tipo_restaurante` int(11) NOT NULL,
  `telefone` varchar(10) NOT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_restaurante`),
  KEY `tipo_restaurantr_idx` (`tipo_restaurante`),
  CONSTRAINT `tipo_restaurantr` FOREIGN KEY (`tipo_restaurante`) REFERENCES `tipo_restaurante` (`id_tipo_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_restaurante`
--

LOCK TABLES `tbl_restaurante` WRITE;
/*!40000 ALTER TABLE `tbl_restaurante` DISABLE KEYS */;
INSERT INTO `tbl_restaurante` VALUES (10,'The Rib\'s Steakhouse - São Paulo',1,'40028922','06390070','789','e24c6835a9a057d58f773143f8aaf930.png','8468114'),(11,'The Rib\'s Steakhouse - Carapucuíba',2,'42028396','06390070','876','859b66041fc95b88770379c242e6addf.jpg','2165251'),(12,'The Rib\'s Steakhouse - Barueri',2,'41813264','06390090','543','f634ea04ddb46527bf521d142c784f89.png','15248425'),(15,'The RibsSteakhouse - Osasco',1,'40028922','06390090','71','87ff01a40e6abdc128547286ef7a081c.png','1684154351');
/*!40000 ALTER TABLE `tbl_restaurante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_restaurante_endereco`
--

DROP TABLE IF EXISTS `tbl_restaurante_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_restaurante_endereco` (
  `id_restaurante` int(11) NOT NULL,
  `id_endereco` int(11) NOT NULL,
  KEY `fk_restaurante_endereco_idx` (`id_restaurante`),
  KEY `fk_endereco_restaurante_idx` (`id_endereco`),
  CONSTRAINT `fk_endereco_restaurante` FOREIGN KEY (`id_endereco`) REFERENCES `tbl_endereco` (`id_endereco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_restaurante_endereco` FOREIGN KEY (`id_restaurante`) REFERENCES `tbl_restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_restaurante_endereco`
--

LOCK TABLES `tbl_restaurante_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_restaurante_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_restaurante_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_restaurante_img`
--

DROP TABLE IF EXISTS `tbl_restaurante_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_restaurante_img` (
  `id_restaurante` int(11) NOT NULL,
  `id_img` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_restaurante_img`
--

LOCK TABLES `tbl_restaurante_img` WRITE;
/*!40000 ALTER TABLE `tbl_restaurante_img` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_restaurante_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setor`
--

DROP TABLE IF EXISTS `tbl_setor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_setor` (
  `id_setor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id_setor`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setor`
--

LOCK TABLES `tbl_setor` WRITE;
/*!40000 ALTER TABLE `tbl_setor` DISABLE KEYS */;
INSERT INTO `tbl_setor` VALUES (19,'Recursos Humanos'),(20,'Administração'),(21,'Financeiro'),(22,'Marketing'),(23,'atendimento');
/*!40000 ALTER TABLE `tbl_setor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_slider`
--

DROP TABLE IF EXISTS `tbl_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_slider` (
  `id_slider` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_slider`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_slider`
--

LOCK TABLES `tbl_slider` WRITE;
/*!40000 ALTER TABLE `tbl_slider` DISABLE KEYS */;
INSERT INTO `tbl_slider` VALUES (1,'Galeria'),(2,'Sobre');
/*!40000 ALTER TABLE `tbl_slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_slider_img`
--

DROP TABLE IF EXISTS `tbl_slider_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_slider_img` (
  `id_slider` int(11) NOT NULL,
  `id_img` int(11) NOT NULL,
  KEY `fk_img_slider_idx` (`id_img`),
  KEY `fk_slider_img_idx` (`id_slider`),
  CONSTRAINT `fk_img_slider` FOREIGN KEY (`id_img`) REFERENCES `tbl_imagem` (`id_imagem`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_slider_img` FOREIGN KEY (`id_slider`) REFERENCES `tbl_slider` (`id_slider`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_slider_img`
--

LOCK TABLES `tbl_slider_img` WRITE;
/*!40000 ALTER TABLE `tbl_slider_img` DISABLE KEYS */;
INSERT INTO `tbl_slider_img` VALUES (1,27),(1,25),(1,28),(1,29),(2,21),(2,22),(1,20),(2,31),(1,35),(1,36),(1,77),(2,105);
/*!40000 ALTER TABLE `tbl_slider_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_prato`
--

DROP TABLE IF EXISTS `tbl_tipo_prato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo_prato` (
  `id_tipo_prato` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `imagem` text NOT NULL,
  PRIMARY KEY (`id_tipo_prato`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_prato`
--

LOCK TABLES `tbl_tipo_prato` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_prato` DISABLE KEYS */;
INSERT INTO `tbl_tipo_prato` VALUES (1,'Steaks','../fotos/2b23c22c91c2c08ef6a73a6dc517f68c.png'),(3,'Veganos','../fotos/08aed993eb5f9004a4e50b8882841233.jpg'),(4,'Cebola','../fotos/3757e1293247c18df1bebd90680f74a7.jpg');
/*!40000 ALTER TABLE `tbl_tipo_prato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_produto`
--

DROP TABLE IF EXISTS `tbl_tipo_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo_produto` (
  `id_tipo_produto` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_produto`
--

LOCK TABLES `tbl_tipo_produto` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_produto` DISABLE KEYS */;
INSERT INTO `tbl_tipo_produto` VALUES (1,'bebida'),(2,'sobremesa'),(3,'prato principal'),(4,'entrada');
/*!40000 ALTER TABLE `tbl_tipo_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_valores_brindes`
--

DROP TABLE IF EXISTS `tbl_valores_brindes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_valores_brindes` (
  `id_valor_brinde` int(11) NOT NULL AUTO_INCREMENT,
  `valor_min` float DEFAULT NULL,
  `valor_max` float DEFAULT NULL,
  PRIMARY KEY (`id_valor_brinde`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_valores_brindes`
--

LOCK TABLES `tbl_valores_brindes` WRITE;
/*!40000 ALTER TABLE `tbl_valores_brindes` DISABLE KEYS */;
INSERT INTO `tbl_valores_brindes` VALUES (1,15,20),(2,21,30),(3,31,40),(4,41,50),(5,50,100),(6,100,150),(7,151,200),(8,201,300),(9,301,400),(10,401,500);
/*!40000 ALTER TABLE `tbl_valores_brindes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_restaurante`
--

DROP TABLE IF EXISTS `tipo_restaurante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_restaurante` (
  `id_tipo_restaurante` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo_restaurante`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_restaurante`
--

LOCK TABLES `tipo_restaurante` WRITE;
/*!40000 ALTER TABLE `tipo_restaurante` DISABLE KEYS */;
INSERT INTO `tipo_restaurante` VALUES (1,'Sede'),(2,'Filial');
/*!40000 ALTER TABLE `tipo_restaurante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_eventos`
--

DROP TABLE IF EXISTS `vw_eventos`;
/*!50001 DROP VIEW IF EXISTS `vw_eventos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_eventos` AS SELECT 
 1 AS `id_evento`,
 1 AS `nome`,
 1 AS `sobre`,
 1 AS `data`,
 1 AS `imagem`,
 1 AS `restaurante`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_produros`
--

DROP TABLE IF EXISTS `vw_produros`;
/*!50001 DROP VIEW IF EXISTS `vw_produros`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_produros` AS SELECT 
 1 AS `id_produto`,
 1 AS `nome`,
 1 AS `preco`,
 1 AS `descricao`,
 1 AS `tipo_produto`,
 1 AS `id_img`,
 1 AS `url`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_slider_img`
--

DROP TABLE IF EXISTS `vw_slider_img`;
/*!50001 DROP VIEW IF EXISTS `vw_slider_img`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_slider_img` AS SELECT 
 1 AS `id_slider`,
 1 AS `id_imagem`,
 1 AS `url`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'db_theribs'
--

--
-- Final view structure for view `vw_eventos`
--

/*!50001 DROP VIEW IF EXISTS `vw_eventos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_eventos` AS select `e`.`id_evento` AS `id_evento`,`e`.`nome` AS `nome`,`e`.`sobre` AS `sobre`,`e`.`data` AS `data`,`img`.`url` AS `imagem`,`r`.`Nome` AS `restaurante` from (((`tbl_eventos` `e` join `tbl_evento_imagem` `ei` on((`e`.`id_evento` = `ei`.`id_evento`))) join `tbl_imagem` `img` on((`ei`.`id_img` = `img`.`id_imagem`))) join `tbl_restaurante` `r` on((`e`.`id_restaurante` = `r`.`id_restaurante`))) group by `e`.`id_evento` order by `e`.`data` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_produros`
--

/*!50001 DROP VIEW IF EXISTS `vw_produros`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_produros` AS select `tp`.`id_produto` AS `id_produto`,`tp`.`nome` AS `nome`,`tp`.`preco` AS `preco`,`tp`.`descricao` AS `descricao`,`tp`.`tipo_produto` AS `tipo_produto`,`tpi`.`id_img` AS `id_img`,`ti`.`url` AS `url` from ((`tbl_produto` `tp` join `tbl_produto_img` `tpi` on((`tpi`.`id_produto` = `tp`.`id_produto`))) join `tbl_imagem` `ti` on((`ti`.`id_imagem` = `tpi`.`id_img`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_slider_img`
--

/*!50001 DROP VIEW IF EXISTS `vw_slider_img`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_slider_img` AS select `s`.`id_slider` AS `id_slider`,`i`.`id_imagem` AS `id_imagem`,`i`.`url` AS `url` from ((`tbl_slider` `s` join `tbl_slider_img` `si` on((`s`.`id_slider` = `si`.`id_slider`))) join `tbl_imagem` `i` on((`si`.`id_img` = `i`.`id_imagem`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-22 19:35:22
