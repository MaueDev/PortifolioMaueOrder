-- MariaDB dump 10.19  Distrib 10.5.12-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: u334020782_mauetech
-- ------------------------------------------------------
-- Server version	10.5.12-MariaDB-cll-lve

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
-- Table structure for table `_Clientes`
--

DROP TABLE IF EXISTS `_Clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_Clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código de identificação do cliente',
  `Nome` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CPF` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `E_CEP` bigint(20) DEFAULT NULL,
  `E_Logradouro` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `E_Numero` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `E_Bairro` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `E_Complemento` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `E_Cidade` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Data_Nascimento` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `_Clientes_UN` (`id`),
  UNIQUE KEY `_Clientes_id_IDX` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_Clientes`
--

/*!40000 ALTER TABLE `_Clientes` DISABLE KEYS */;
INSERT INTO `_Clientes` VALUES (1,'Mauricio Rodrigues','14576255630',38295000,'Avenida Pernambuco','815','Centro','Apartamento','Limeira do Oeste','mauricio.rsc.mg@gmail.com','1999-03-08');
/*!40000 ALTER TABLE `_Clientes` ENABLE KEYS */;

--
-- Table structure for table `_Produtos`
--

DROP TABLE IF EXISTS `_Produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_Produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código de identificação do produto',
  `Nome` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vr_produto` decimal(5,2) DEFAULT NULL COMMENT 'Valor Unitário',
  PRIMARY KEY (`id`),
  UNIQUE KEY `_Produtos_UN` (`id`),
  UNIQUE KEY `_Produtos_id_IDX` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_Produtos`
--

/*!40000 ALTER TABLE `_Produtos` DISABLE KEYS */;
INSERT INTO `_Produtos` VALUES (1,'Coca-Cola 2L',8.50),(2,'Fanta 2L',8.00),(3,'Fanta 3L',10.50);
/*!40000 ALTER TABLE `_Produtos` ENABLE KEYS */;

--
-- Table structure for table `_cad_Pedidos`
--

DROP TABLE IF EXISTS `_cad_Pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_cad_Pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Status` int(11) DEFAULT 0 COMMENT '0 = Aberto | 1 Finalizada',
  `DataInicioPedido` datetime DEFAULT NULL,
  `DataConclusao` datetime DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `VrPedido` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `_cad_Pedidos_UN` (`id`),
  UNIQUE KEY `_cad_Pedidos_id_IDX` (`id`) USING BTREE,
  KEY `_cad_Pedidos_FK` (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_cad_Pedidos`
--

/*!40000 ALTER TABLE `_cad_Pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `_cad_Pedidos` ENABLE KEYS */;

--
-- Table structure for table `_login`
--

DROP TABLE IF EXISTS `_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `_login_idColumn1_IDX` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_login`
--

/*!40000 ALTER TABLE `_login` DISABLE KEYS */;
INSERT INTO `_login` VALUES (1,'maue','202cb962ac59075b964b07152d234b70');
/*!40000 ALTER TABLE `_login` ENABLE KEYS */;

--
-- Table structure for table `_mv_Pedidos`
--

DROP TABLE IF EXISTS `_mv_Pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_mv_Pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idVenda` int(11) DEFAULT NULL,
  `idProduto` int(11) DEFAULT NULL,
  `VrProduto` decimal(5,2) DEFAULT NULL,
  `qtdProduto` int(11) DEFAULT 1,
  `DataAdc` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `_mv_Pedidos_UN` (`id`),
  KEY `_mv_Pedidos_FK` (`idProduto`),
  KEY `_mv_Pedidos_FK_2` (`idVenda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_mv_Pedidos`
--

/*!40000 ALTER TABLE `_mv_Pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `_mv_Pedidos` ENABLE KEYS */;

--
-- Dumping routines for database 'u334020782_mauetech'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-31 14:52:29
