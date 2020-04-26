-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: erp
-- ------------------------------------------------------
-- Server version	5.7.26

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
-- Table structure for table `tb_productstock_summary`
--

DROP TABLE IF EXISTS `tb_productstock_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_productstock_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `companyid` int(11) DEFAULT NULL COMMENT '公司',
  `warehouseid` int(10) unsigned NOT NULL COMMENT '仓库id',
  `productid` int(11) DEFAULT NULL COMMENT '产品',
  `property` int(11) DEFAULT NULL COMMENT '属性',
  `defective_level` tinyint(1) DEFAULT NULL COMMENT '残品',
  `number` int(11) DEFAULT '0' COMMENT '数量',
  `wordcode` varchar(200) CHARACTER SET latin1 DEFAULT NULL COMMENT '国际码',
  `ageseason` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT '年代',
  `countries` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT '产地',
  `brandid` int(11) DEFAULT NULL COMMENT '品牌',
  `brandgroupid` int(11) DEFAULT NULL COMMENT '品类',
  `childbrand` int(11) DEFAULT NULL COMMENT '子品类',
  `brandcolor` int(11) DEFAULT NULL COMMENT '色系',
  `ulnarinch` varchar(200) CHARACTER SET latin1 DEFAULT NULL COMMENT '商品尺寸',
  `saletypeid` int(11) DEFAULT NULL COMMENT '销售属性',
  `producttypeid` int(11) DEFAULT NULL COMMENT '商品属性',
  `gender` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT '性别',
  `spring` tinyint(1) DEFAULT NULL COMMENT '春',
  `summer` tinyint(1) DEFAULT NULL COMMENT '夏',
  `fall` tinyint(1) DEFAULT NULL COMMENT '秋',
  `winter` tinyint(1) DEFAULT NULL COMMENT '冬',
  `series` int(11) DEFAULT NULL COMMENT '商品系列',
  `sizecontentid` int(10) unsigned DEFAULT NULL COMMENT '尺码组id',
  `reserve_number` int(11) DEFAULT '0' COMMENT '锁定数量',
  `sales_number` int(11) DEFAULT '0' COMMENT '已售数量',
  `shipping_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '在途数量',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='商品库存检索表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_productstock_summary`
--

LOCK TABLES `tb_productstock_summary` WRITE;
/*!40000 ALTER TABLE `tb_productstock_summary` DISABLE KEYS */;
INSERT INTO `tb_productstock_summary` VALUES (1,1,1,337,1,1,2,'DS20S5800CTEH409','10','',60,3,29,2,'0',8,2,'2',1,1,1,1,0,134,0,0,0,'2020-04-23 09:56:56','2020-04-23 09:56:56'),(2,1,1,337,1,1,3,'DS20S5800CTEH409','10','',60,3,29,2,'0',8,2,'2',1,1,1,1,0,135,0,0,0,'2020-04-23 09:56:56','2020-04-23 09:56:56'),(3,1,1,337,1,1,4,'DS20S5800CTEH409','10','',60,3,29,2,'0',8,2,'2',1,1,1,1,0,136,0,0,0,'2020-04-23 09:56:56','2020-04-23 09:56:56'),(4,1,1,339,1,1,5,'DS20S5802MUEH4110','10','',60,3,29,4,'0',8,2,'2',1,1,1,1,0,134,0,0,0,'2020-04-23 09:56:56','2020-04-23 09:56:56'),(5,1,2,337,1,1,7,'DS20S5800CTEH409','10','',60,3,29,2,'0',8,2,'2',1,1,1,1,0,134,1,1,0,'2020-04-23 09:56:56','2020-04-23 09:56:56'),(6,1,2,337,1,1,9,'DS20S5800CTEH409','10','',60,3,29,2,'0',8,2,'2',1,1,1,1,0,136,1,0,0,'2020-04-23 09:56:56','2020-04-23 09:56:56'),(7,1,4,339,1,1,8,'DS20S5802MUEH4110','10','',60,3,29,4,'0',8,2,'2',1,1,1,1,0,134,0,0,0,'2020-04-23 09:56:56','2020-04-23 09:56:56'),(8,1,5,337,1,1,9,'DS20S5800CTEH409','10','',60,3,29,2,'0',8,2,'2',1,1,1,1,0,136,0,0,0,'2020-04-23 09:56:56','2020-04-23 09:56:56'),(9,1,3,337,1,1,9,'DS20S5800CTEH409','10','',60,3,29,2,'0',8,2,'2',1,1,1,1,0,136,0,0,0,'2020-04-23 09:56:56','2020-04-23 09:56:56'),(10,1,2,337,1,1,2,'DS20S5800CTEH409','10','',60,3,29,2,'0',8,2,'2',1,1,1,1,0,133,0,0,0,'2020-04-23 09:56:56','2020-04-23 09:56:56'),(11,1,2,337,1,1,2,'DS20S5800CTEH409','10','',60,3,29,2,'0',8,2,'2',1,1,1,1,0,135,0,0,0,'2020-04-23 09:56:56','2020-04-23 09:56:56'),(12,1,2,337,1,1,2,'DS20S5800CTEH409','10','',60,3,29,2,'0',8,2,'2',1,1,1,1,0,137,0,0,0,'2020-04-23 09:56:56','2020-04-23 09:56:56');
/*!40000 ALTER TABLE `tb_productstock_summary` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-26 16:36:37
