-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: erp
-- ------------------------------------------------------
-- Server version	5.7.19-log

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
-- Table structure for table `模版`
--

DROP TABLE IF EXISTS `模版`;


CREATE TABLE `模版` (
                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                    `sys_create_stuff` int(10) unsigned NOT NULL,
                    `sys_create_date` datetime NOT NULL,
                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                    `sys_modify_date` datetime NOT NULL,
                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                    `sys_delete_date` datetime DEFAULT NULL,
                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';


--
-- Dumping data for table `模版`
--

LOCK TABLES `模版` WRITE;
/*!40000 ALTER TABLE `模版` DISABLE KEYS */;
/*!40000 ALTER TABLE `模版` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_invoice`
--

DROP TABLE IF EXISTS `ac_invoice`;


CREATE TABLE `ac_invoice` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                            `sys_create_stuff` int(10) unsigned NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `invoicedate` datetime DEFAULT NULL,
                            `supplierid` int(10) unsigned DEFAULT NULL,
                            `paycusid` int(10) unsigned DEFAULT NULL,
                            `rate` decimal(16,9) DEFAULT NULL,
                            `departmentid` int(10) unsigned DEFAULT NULL,
                            `userid` int(10) unsigned DEFAULT NULL,
                            `currencyid` int(10) unsigned DEFAULT NULL,
                            `sum` decimal(16,9) DEFAULT NULL,
                            `dsum` decimal(16,9) DEFAULT NULL,
                            `ssum` decimal(16,9) DEFAULT NULL,
                            `invoicesum` decimal(16,9) DEFAULT NULL,
                            `exchangrate` decimal(16,9) DEFAULT NULL,
                            `invoiceno` varchar(20) DEFAULT NULL,
                            `memo` varchar(100) DEFAULT NULL,
                            `checkstatus` varchar(1) DEFAULT NULL COMMENT '0-未审核，1-已审核',
                            `checkid` int(10) unsigned DEFAULT NULL,
                            `glstatus` varchar(1) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='货款发票主表';


--
-- Dumping data for table `ac_invoice`
--

LOCK TABLES `ac_invoice` WRITE;
/*!40000 ALTER TABLE `ac_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_invoice_fee`
--

DROP TABLE IF EXISTS `ac_invoice_fee`;


CREATE TABLE `ac_invoice_fee` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `invoicedate` datetime DEFAULT NULL,
                                `supplierid` int(10) unsigned DEFAULT NULL,
                                `paycusid` int(10) unsigned DEFAULT NULL,
                                `rate` decimal(16,9) DEFAULT NULL,
                                `departmentid` int(10) unsigned DEFAULT NULL,
                                `userid` int(10) unsigned DEFAULT NULL,
                                `currencyid` int(10) unsigned DEFAULT NULL,
                                `exchangrate` decimal(16,9) DEFAULT NULL,
                                `invoiceno` varchar(20) DEFAULT NULL,
                                `memo` text,
                                `checkstatus` varchar(1) DEFAULT NULL COMMENT '0-未审核，1-已审核',
                                `checkid` int(10) unsigned DEFAULT NULL,
                                `glstatus` varchar(1) DEFAULT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='运费发票主表';


--
-- Dumping data for table `ac_invoice_fee`
--

LOCK TABLES `ac_invoice_fee` WRITE;
/*!40000 ALTER TABLE `ac_invoice_fee` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_invoice_fee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_invoice_fee_detail`
--

DROP TABLE IF EXISTS `ac_invoice_fee_detail`;


CREATE TABLE `ac_invoice_fee_detail` (
                                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                       `sys_create_stuff` int(10) unsigned NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) unsigned NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `invoiceid` int(10) unsigned DEFAULT NULL,
                                       `feeid` int(10) unsigned DEFAULT NULL,
                                       `number` int(11) DEFAULT NULL,
                                       `feesum` decimal(16,9) DEFAULT NULL,
                                       `feecurrencyid` int(10) unsigned NOT NULL,
                                       `invoicecurrencyid` int(10) unsigned DEFAULT NULL,
                                       `invoicesum` decimal(16,9) DEFAULT NULL,
                                       `memo` varchar(100) DEFAULT NULL,
                                       `companyid` int(10) unsigned DEFAULT NULL,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='运费发票明细表';


--
-- Dumping data for table `ac_invoice_fee_detail`
--

LOCK TABLES `ac_invoice_fee_detail` WRITE;
/*!40000 ALTER TABLE `ac_invoice_fee_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_invoice_fee_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_invoice_prepay`
--

DROP TABLE IF EXISTS `ac_invoice_prepay`;


CREATE TABLE `ac_invoice_prepay` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `invoicedate` datetime DEFAULT NULL,
                                   `supplierid` int(10) unsigned DEFAULT NULL,
                                   `paycusid` int(10) unsigned DEFAULT NULL,
                                   `rate` decimal(16,9) DEFAULT NULL,
                                   `departmentid` int(10) unsigned DEFAULT NULL,
                                   `userid` int(10) unsigned DEFAULT NULL,
                                   `currencyid` int(10) unsigned DEFAULT NULL,
                                   `sum` decimal(16,9) DEFAULT NULL,
                                   `invoicesum` decimal(16,9) DEFAULT NULL,
                                   `exchangrate` decimal(16,9) DEFAULT NULL,
                                   `invoiceno` varchar(20) DEFAULT NULL,
                                   `memo` varchar(100) DEFAULT NULL,
                                   `checkstatus` varchar(1) DEFAULT NULL COMMENT '0-未审核，1-已审核',
                                   `checkid` int(10) unsigned DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订金发票主表';


--
-- Dumping data for table `ac_invoice_prepay`
--

LOCK TABLES `ac_invoice_prepay` WRITE;
/*!40000 ALTER TABLE `ac_invoice_prepay` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_invoice_prepay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_kmyue_wb`
--

DROP TABLE IF EXISTS `ac_kmyue_wb`;


CREATE TABLE `ac_kmyue_wb` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `ztid` int(10) unsigned DEFAULT NULL,
                             `kmid` int(10) unsigned DEFAULT NULL,
                             `nf` varchar(4) DEFAULT NULL,
                             `yf` varchar(2) DEFAULT NULL,
                             `currencyid` int(10) unsigned DEFAULT NULL,
                             `hl` decimal(19,6) DEFAULT NULL,
                             `qche` decimal(19,6) DEFAULT NULL,
                             `jffshe` decimal(19,6) DEFAULT NULL,
                             `dffshe` decimal(19,6) DEFAULT NULL,
                             `qmye` decimal(19,6) DEFAULT NULL,
                             `qcher` decimal(19,6) DEFAULT NULL,
                             `jffsher` decimal(19,6) DEFAULT NULL,
                             `dffsher` decimal(19,6) DEFAULT NULL,
                             `qmyer` decimal(19,6) DEFAULT NULL,
                             `cus_id` int(10) unsigned DEFAULT NULL,
                             `dep_id` int(10) unsigned DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='科目余额表';


--
-- Dumping data for table `ac_kmyue_wb`
--

LOCK TABLES `ac_kmyue_wb` WRITE;
/*!40000 ALTER TABLE `ac_kmyue_wb` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_kmyue_wb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_pzhb`
--

DROP TABLE IF EXISTS `ac_pzhb`;


CREATE TABLE `ac_pzhb` (
                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                         `sys_create_stuff` int(10) unsigned NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) unsigned NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                         `ztid` int(10) unsigned DEFAULT NULL,
                         `pzh_flow_type` varchar(2) DEFAULT NULL COMMENT 'th-调汇 jz-结转 fy-费用 fp-发票\r\n            hk-回款 zz-转账 cx-冲销 zc-正常\r\n            zj-折旧',
                         `pzh_type_id` int(10) unsigned DEFAULT NULL,
                         `nf` varchar(5) DEFAULT NULL,
                         `yf` varchar(2) DEFAULT NULL,
                         `rq` varchar(2) DEFAULT NULL,
                         `pzh` varchar(50) DEFAULT NULL,
                         `zy` varchar(1000) DEFAULT NULL,
                         `lrrid` int(10) unsigned DEFAULT NULL,
                         `shr` int(10) unsigned DEFAULT NULL,
                         `shrq` datetime DEFAULT NULL,
                         `jzr` int(10) unsigned DEFAULT NULL,
                         `jzrq` datetime DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='凭证表';


--
-- Dumping data for table `ac_pzhb`
--

LOCK TABLES `ac_pzhb` WRITE;
/*!40000 ALTER TABLE `ac_pzhb` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_pzhb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_pzhh`
--

DROP TABLE IF EXISTS `ac_pzhh`;


CREATE TABLE `ac_pzhh` (
                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                         `sys_create_stuff` int(10) unsigned NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) unsigned NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                         `ztid` int(10) unsigned DEFAULT NULL,
                         `nf` varchar(5) DEFAULT NULL,
                         `yf` varchar(2) DEFAULT NULL,
                         `rq` varchar(2) DEFAULT NULL,
                         `pzh_type_id` int(10) unsigned DEFAULT NULL,
                         `pzhxh` int(11) DEFAULT NULL,
                         `yjbz` varchar(1) DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='凭证号表';


--
-- Dumping data for table `ac_pzhh`
--

LOCK TABLES `ac_pzhh` WRITE;
/*!40000 ALTER TABLE `ac_pzhh` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_pzhh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_pzhmxb`
--

DROP TABLE IF EXISTS `ac_pzhmxb`;


CREATE TABLE `ac_pzhmxb` (
                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                           `sys_create_stuff` int(10) unsigned NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                           `pzhid` int(10) unsigned DEFAULT NULL,
                           `kmid` int(10) unsigned DEFAULT NULL,
                           `currencyid` int(10) unsigned DEFAULT NULL,
                           `hl` decimal(19,6) DEFAULT NULL,
                           `jffshe` decimal(19,6) DEFAULT NULL,
                           `jffsher` decimal(19,6) DEFAULT NULL,
                           `dffshe` decimal(19,6) DEFAULT NULL,
                           `dffsher` decimal(19,6) DEFAULT NULL,
                           `zy` varchar(1000) DEFAULT NULL,
                           `sourse` varchar(1) DEFAULT NULL COMMENT 'y-业务 c-普通 r-回款',
                           `cus_id` int(10) unsigned DEFAULT NULL,
                           `dep_id` int(10) unsigned DEFAULT NULL,
                           `jord` varchar(1) DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='凭证明细表';


--
-- Dumping data for table `ac_pzhmxb`
--

LOCK TABLES `ac_pzhmxb` WRITE;
/*!40000 ALTER TABLE `ac_pzhmxb` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_pzhmxb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_sf_sheet`
--

DROP TABLE IF EXISTS `ac_sf_sheet`;


CREATE TABLE `ac_sf_sheet` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `sheetno` varchar(50) DEFAULT NULL,
                             `sorf` varchar(1) DEFAULT NULL,
                             `companyid` int(10) unsigned DEFAULT NULL,
                             `currencyid` int(10) unsigned DEFAULT NULL,
                             `sum` decimal(16,9) DEFAULT NULL,
                             `creator` int(10) unsigned DEFAULT NULL,
                             `date` datetime DEFAULT NULL,
                             `memo` text,
                             `externalno` varchar(50) DEFAULT NULL,
                             `header` text,
                             `originalsum` decimal(16,9) DEFAULT NULL,
                             `adjustsum` decimal(16,9) DEFAULT NULL,
                             `iskp` varchar(1) DEFAULT NULL,
                             `kpid` int(10) unsigned DEFAULT NULL,
                             `refundmemo` text,
                             `isrefund` varchar(1) DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='对账费单';


--
-- Dumping data for table `ac_sf_sheet`
--

LOCK TABLES `ac_sf_sheet` WRITE;
/*!40000 ALTER TABLE `ac_sf_sheet` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_sf_sheet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_sf_sheet_code`
--

DROP TABLE IF EXISTS `ac_sf_sheet_code`;


CREATE TABLE `ac_sf_sheet_code` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `year` varchar(5) DEFAULT NULL,
                                  `code` varchar(10) DEFAULT NULL,
                                  `month` varchar(5) DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='对账单号表';


--
-- Dumping data for table `ac_sf_sheet_code`
--

LOCK TABLES `ac_sf_sheet_code` WRITE;
/*!40000 ALTER TABLE `ac_sf_sheet_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_sf_sheet_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_sf_sheet_refund`
--

DROP TABLE IF EXISTS `ac_sf_sheet_refund`;


CREATE TABLE `ac_sf_sheet_refund` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                    `sys_create_stuff` int(10) unsigned NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `sheetid` int(10) unsigned DEFAULT NULL,
                                    `refunddate` datetime DEFAULT NULL,
                                    `refundbank` varchar(100) DEFAULT NULL,
                                    `currencyid` int(10) unsigned DEFAULT NULL,
                                    `refundsum` decimal(10,2) DEFAULT NULL,
                                    `invoiceno` varchar(100) DEFAULT NULL,
                                    `memo` varchar(1000) DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='对账单回款情况';


--
-- Dumping data for table `ac_sf_sheet_refund`
--

LOCK TABLES `ac_sf_sheet_refund` WRITE;
/*!40000 ALTER TABLE `ac_sf_sheet_refund` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_sf_sheet_refund` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd_arrivalnotice`
--

DROP TABLE IF EXISTS `dd_arrivalnotice`;


CREATE TABLE `dd_arrivalnotice` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `corderid` int(10) unsigned DEFAULT NULL,
                                  `orderno` varchar(50) DEFAULT NULL,
                                  `makedate` datetime DEFAULT NULL,
                                  `makestaff` int(10) unsigned DEFAULT NULL,
                                  `supplierid` int(10) unsigned NOT NULL,
                                  `currencyid` int(10) unsigned DEFAULT NULL,
                                  `total` decimal(16,9) DEFAULT NULL,
                                  `isstatus` varchar(1) DEFAULT NULL,
                                  `memo` varchar(200) DEFAULT NULL,
                                  `auditstaff` int(10) unsigned DEFAULT NULL,
                                  `auditdate` datetime DEFAULT NULL,
                                  `auditstatus` varchar(1) DEFAULT NULL,
                                  `exchangerate` decimal(16,9) DEFAULT NULL,
                                  `brandid` int(10) unsigned DEFAULT NULL,
                                  `finalsupplierid` int(10) unsigned DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='到货单';


--
-- Dumping data for table `dd_arrivalnotice`
--

LOCK TABLES `dd_arrivalnotice` WRITE;
/*!40000 ALTER TABLE `dd_arrivalnotice` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd_arrivalnotice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd_arrivalnotice_detail`
--

DROP TABLE IF EXISTS `dd_arrivalnotice_detail`;


CREATE TABLE `dd_arrivalnotice_detail` (
                                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                         `sys_create_stuff` int(10) unsigned NOT NULL,
                                         `sys_create_date` datetime NOT NULL,
                                         `sys_modify_stuff` int(10) unsigned NOT NULL,
                                         `sys_modify_date` datetime NOT NULL,
                                         `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                         `sys_delete_date` datetime DEFAULT NULL,
                                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                         `arrivalid` int(10) unsigned DEFAULT NULL,
                                         `detailid` int(10) unsigned DEFAULT NULL,
                                         `productid` int(10) unsigned DEFAULT NULL,
                                         `sizeid` int(10) unsigned DEFAULT NULL,
                                         `number` int(11) DEFAULT NULL,
                                         `currencyid` int(10) unsigned DEFAULT NULL,
                                         `price` decimal(16,9) DEFAULT NULL,
                                         `cost` decimal(16,9) DEFAULT NULL,
                                         `cjj` decimal(16,9) DEFAULT NULL,
                                         `yj` decimal(16,9) DEFAULT NULL,
                                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='到货单明细';


--
-- Dumping data for table `dd_arrivalnotice_detail`
--

LOCK TABLES `dd_arrivalnotice_detail` WRITE;
/*!40000 ALTER TABLE `dd_arrivalnotice_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd_arrivalnotice_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd_confirmorder`
--

DROP TABLE IF EXISTS `dd_confirmorder`;


CREATE TABLE `dd_confirmorder` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `orderno` varchar(50) DEFAULT NULL,
                                 `makedate` datetime DEFAULT NULL,
                                 `makestaff` int(10) unsigned DEFAULT NULL,
                                 `supplierid` int(10) unsigned NOT NULL,
                                 `currencyid` int(10) unsigned DEFAULT NULL,
                                 `total` decimal(16,9) DEFAULT NULL,
                                 `isstatus` varchar(1) DEFAULT NULL COMMENT '0-在途未入库，1-已入库，2-已备货未发出',
                                 `memo` varchar(200) DEFAULT NULL,
                                 `brandid` int(10) unsigned DEFAULT NULL,
                                 `season` int(10) unsigned DEFAULT NULL,
                                 `seasontype` varchar(1) DEFAULT NULL COMMENT '0-pre ,1-main ,2-fashion show',
                                 `auditstaff` int(10) unsigned DEFAULT NULL,
                                 `auditdate` datetime DEFAULT NULL,
                                 `auditstatus` varchar(1) DEFAULT NULL,
                                 `exchangerate` decimal(16,9) DEFAULT NULL,
                                 `finalsupplierid` int(10) unsigned DEFAULT NULL,
                                 `flightno` varchar(50) DEFAULT NULL,
                                 `flightdate` datetime DEFAULT NULL,
                                 `arrivaldate` datetime DEFAULT NULL,
                                 `mblno` varchar(50) DEFAULT NULL,
                                 `hblno` varchar(50) DEFAULT NULL,
                                 `dispatchport` varchar(50) DEFAULT NULL,
                                 `deliveryport` varchar(50) DEFAULT NULL,
                                 `transcompany` int(10) unsigned DEFAULT NULL,
                                 `isexamination` varchar(1) DEFAULT NULL,
                                 `examinationresult` varchar(50) DEFAULT NULL,
                                 `clearancedate` datetime DEFAULT NULL,
                                 `pickingdate` datetime DEFAULT NULL,
                                 `motortransportpool` varchar(50) DEFAULT NULL,
                                 `warehouseid` int(10) unsigned DEFAULT NULL,
                                 `ctns` decimal(16,9) DEFAULT NULL,
                                 `kgs` decimal(16,9) DEFAULT NULL,
                                 `cbm` decimal(16,9) DEFAULT NULL,
                                 `issjyh` varchar(1) DEFAULT NULL,
                                 `sellerid` int(10) unsigned NOT NULL,
                                 `sjyhresult` varchar(50) DEFAULT NULL,
                                 `buyerid` int(10) unsigned NOT NULL,
                                 `transporttype` varchar(1) DEFAULT NULL COMMENT '0-by air 1-快递 2-中转',
                                 `paytype` varchar(1) DEFAULT NULL COMMENT '0- t/t',
                                 `property` varchar(1) DEFAULT NULL COMMENT '0-自采 1-代销',
                                 `payoutpercentage` varchar(10) DEFAULT NULL,
                                 `pickingaddress` text,
                                 `chargedweight` decimal(16,9) DEFAULT NULL,
                                 `paydate` datetime DEFAULT NULL,
                                 `apickingdate` datetime DEFAULT NULL,
                                 `aarrivaldate` datetime DEFAULT NULL,
                                 `invoiceno` varchar(50) DEFAULT NULL,
                                 `dd_company` int(10) unsigned NOT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='发货单';


--
-- Dumping data for table `dd_confirmorder`
--

LOCK TABLES `dd_confirmorder` WRITE;
/*!40000 ALTER TABLE `dd_confirmorder` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd_confirmorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd_corder_ctn`
--

DROP TABLE IF EXISTS `dd_corder_ctn`;


CREATE TABLE `dd_corder_ctn` (
                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                               `sys_create_stuff` int(10) unsigned NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `corderid` int(10) unsigned DEFAULT NULL,
                               `ctnno` varchar(50) DEFAULT NULL,
                               `length` decimal(16,9) DEFAULT NULL,
                               `width` decimal(16,9) DEFAULT NULL,
                               `height` decimal(16,9) DEFAULT NULL,
                               `weight` decimal(16,9) DEFAULT NULL,
                               `cbm` decimal(16,9) DEFAULT NULL,
                               `memo` varchar(500) DEFAULT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='发货单装箱信息';


--
-- Dumping data for table `dd_corder_ctn`
--

LOCK TABLES `dd_corder_ctn` WRITE;
/*!40000 ALTER TABLE `dd_corder_ctn` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd_corder_ctn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd_corder_temp`
--

DROP TABLE IF EXISTS `dd_corder_temp`;


CREATE TABLE `dd_corder_temp` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `corderid` int(10) unsigned DEFAULT NULL,
                                `cdetailid` int(10) unsigned DEFAULT NULL,
                                `detailid` int(10) unsigned DEFAULT NULL,
                                `productid` int(10) unsigned DEFAULT NULL,
                                `sizeid` int(10) unsigned DEFAULT NULL,
                                `anumber` int(11) DEFAULT NULL,
                                `tm` varchar(50) DEFAULT NULL,
                                `currencyid` int(10) unsigned DEFAULT NULL,
                                `price` decimal(16,9) DEFAULT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='发货单入库快照';


--
-- Dumping data for table `dd_corder_temp`
--

LOCK TABLES `dd_corder_temp` WRITE;
/*!40000 ALTER TABLE `dd_corder_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd_corder_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd_corderdetails`
--

DROP TABLE IF EXISTS `dd_corderdetails`;


CREATE TABLE `dd_corderdetails` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `corderid` int(10) unsigned DEFAULT NULL,
                                  `detailid` int(10) unsigned DEFAULT NULL,
                                  `productid` int(10) unsigned DEFAULT NULL,
                                  `sizeid` int(10) unsigned DEFAULT NULL,
                                  `number` int(11) DEFAULT NULL,
                                  `currencyid` int(10) unsigned DEFAULT NULL,
                                  `price` decimal(16,9) DEFAULT NULL,
                                  `cost` decimal(16,9) DEFAULT NULL,
                                  `actualnumber` int(11) DEFAULT NULL,
                                  `isstatus` varchar(1) DEFAULT NULL COMMENT '0-未完成\r\n            1-完成',
                                  `containerno` varchar(500) DEFAULT NULL,
                                  `cjj` decimal(16,9) DEFAULT NULL,
                                  `yj` decimal(16,9) DEFAULT NULL,
                                  `size` varchar(50) DEFAULT NULL,
                                  `weight` varchar(50) DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='发货单明细';


--
-- Dumping data for table `dd_corderdetails`
--

LOCK TABLES `dd_corderdetails` WRITE;
/*!40000 ALTER TABLE `dd_corderdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd_corderdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd_fee`
--

DROP TABLE IF EXISTS `dd_fee`;


CREATE TABLE `dd_fee` (
                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                        `sys_create_stuff` int(10) unsigned NOT NULL,
                        `sys_create_date` datetime NOT NULL,
                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                        `sys_modify_date` datetime NOT NULL,
                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                        `sys_delete_date` datetime DEFAULT NULL,
                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                        `dd_id` int(10) unsigned DEFAULT NULL,
                        `feeid` int(10) unsigned DEFAULT NULL,
                        `currencyid` int(10) unsigned DEFAULT NULL,
                        `unitprice` decimal(10,2) DEFAULT NULL,
                        `amount` decimal(10,2) DEFAULT NULL,
                        `sum` decimal(10,2) DEFAULT NULL,
                        `companyid` int(10) unsigned DEFAULT NULL,
                        `sorf` varchar(1) DEFAULT NULL COMMENT 's-收 f-付',
                        `applyflag` varchar(1) DEFAULT NULL COMMENT '0-未申请 1-已申请',
                        `applyid` int(10) unsigned DEFAULT NULL,
                        `goodstotal` decimal(10,2) DEFAULT NULL,
                        `deduct` decimal(10,2) DEFAULT NULL,
                        `actuallypaid` decimal(10,2) DEFAULT NULL,
                        `amortized` tinyint(4) DEFAULT NULL,
                        `exchangerate` decimal(16,9) DEFAULT NULL,
                        `standarysum` decimal(10,2) DEFAULT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='供应链费用';


--
-- Dumping data for table `dd_fee`
--

LOCK TABLES `dd_fee` WRITE;
/*!40000 ALTER TABLE `dd_fee` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd_fee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd_order`
--

DROP TABLE IF EXISTS `dd_order`;


CREATE TABLE `dd_order` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                          `sys_create_stuff` int(10) unsigned NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `bussinesstypeid` int(10) unsigned DEFAULT NULL,
                          `makedate` datetime DEFAULT NULL,
                          `makestaff` int(10) unsigned DEFAULT NULL,
                          `supplierid` int(10) unsigned NOT NULL,
                          `finalsupplierid` int(10) unsigned DEFAULT NULL,
                          `bookingid` int(10) unsigned DEFAULT NULL,
                          `agentid` int(10) unsigned DEFAULT NULL,
                          `purchasedept` int(10) unsigned DEFAULT NULL,
                          `brandid` int(10) unsigned NOT NULL,
                          `orderno` varchar(50) DEFAULT NULL,
                          `total` decimal(16,9) DEFAULT NULL,
                          `currencyid` int(10) unsigned DEFAULT NULL,
                          `companyid` int(10) unsigned NOT NULL COMMENT '公司ID',
                          `auditstaff` int(10) unsigned DEFAULT NULL,
                          `auditdate` datetime DEFAULT NULL,
                          `ordercode` varchar(50) DEFAULT NULL,
                          `worldordercode` varchar(50) DEFAULT NULL,
                          `auditstatus` varchar(1) DEFAULT NULL,
                          `isstatus` varchar(1) DEFAULT NULL COMMENT '0-未完结 1-已完结',
                          `form` varchar(2) DEFAULT NULL COMMENT 'f-女款，m-男款,fm男款/女款',
                          `memo` varchar(200) DEFAULT NULL,
                          `contactor` varchar(200) DEFAULT NULL,
                          `ourcontactor` varchar(200) DEFAULT NULL,
                          `season` int(10) unsigned DEFAULT NULL,
                          `seasontype` varchar(1) DEFAULT NULL COMMENT '0-pre ,1-main ,2-fashion show',
                          `invoiceno` varchar(50) DEFAULT NULL,
                          `ddtype` varchar(1) DEFAULT NULL COMMENT '0-客户订单，1-品牌订单',
                          `morderid` int(10) unsigned DEFAULT NULL,
                          `exchangerate` decimal(16,9) DEFAULT NULL,
                          `bussinesstype` varchar(1) DEFAULT NULL COMMENT '0-期货 1-现货',
                          `zkl` decimal(16,9) DEFAULT NULL,
                          `tsl` decimal(16,9) DEFAULT NULL,
                          `property` varchar(1) DEFAULT NULL COMMENT '0-自采 1-代销',
                          PRIMARY KEY (`id`),
                          KEY `companyid` (`companyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订单主表';


--
-- Dumping data for table `dd_order`
--

LOCK TABLES `dd_order` WRITE;
/*!40000 ALTER TABLE `dd_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd_ordercode`
--

DROP TABLE IF EXISTS `dd_ordercode`;


CREATE TABLE `dd_ordercode` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `year` varchar(5) DEFAULT NULL,
                              `code` varchar(10) DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订单号表';


--
-- Dumping data for table `dd_ordercode`
--

LOCK TABLES `dd_ordercode` WRITE;
/*!40000 ALTER TABLE `dd_ordercode` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd_ordercode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd_orderdetails`
--

DROP TABLE IF EXISTS `dd_orderdetails`;


CREATE TABLE `dd_orderdetails` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `orderid` int(10) unsigned DEFAULT NULL,
                                 `companyid` int(10) unsigned NOT NULL COMMENT '公司ID',
                                 `sizeid` int(10) unsigned DEFAULT NULL,
                                 `number` int(11) DEFAULT NULL,
                                 `productid` int(10) unsigned DEFAULT NULL,
                                 `currencyid` int(10) unsigned DEFAULT NULL,
                                 `price` decimal(16,9) DEFAULT NULL,
                                 `actualnumber` int(11) DEFAULT NULL,
                                 `isstatus` varchar(1) DEFAULT NULL COMMENT '0-未完成\r\n            1-完成',
                                 `cost` decimal(16,9) DEFAULT NULL,
                                 `cbtype` varchar(1) DEFAULT NULL,
                                 `zkl` decimal(16,9) DEFAULT NULL,
                                 `tsbl` decimal(16,9) DEFAULT NULL,
                                 `cjj` decimal(16,9) DEFAULT NULL,
                                 `yj` decimal(16,9) DEFAULT NULL,
                                 `sortnum` int(11) DEFAULT NULL,
                                 `zje` decimal(16,9) DEFAULT NULL,
                                 `add_flag` varchar(1) DEFAULT NULL,
                                 `thattimestock` int(11) DEFAULT NULL,
                                 PRIMARY KEY (`id`),
                                 KEY `companyid` (`companyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订单明细';


--
-- Dumping data for table `dd_orderdetails`
--

LOCK TABLES `dd_orderdetails` WRITE;
/*!40000 ALTER TABLE `dd_orderdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd_orderdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd_quotation`
--

DROP TABLE IF EXISTS `dd_quotation`;


CREATE TABLE `dd_quotation` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `supplierid` int(10) unsigned DEFAULT NULL,
                              `form` varchar(1) DEFAULT NULL COMMENT 'f-女款，m-男款',
                              `year_season` varchar(10) DEFAULT NULL,
                              `rate` decimal(16,9) DEFAULT NULL,
                              `memo` varchar(1000) DEFAULT NULL,
                              `filename` varchar(100) DEFAULT NULL,
                              `s_filename` varchar(100) DEFAULT NULL COMMENT '在服务器上的文件名',
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='报价单主表';


--
-- Dumping data for table `dd_quotation`
--

LOCK TABLES `dd_quotation` WRITE;
/*!40000 ALTER TABLE `dd_quotation` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd_quotation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd_quotation_detail`
--

DROP TABLE IF EXISTS `dd_quotation_detail`;


CREATE TABLE `dd_quotation_detail` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `quotationid` int(10) unsigned DEFAULT NULL,
                                     `productid` int(10) unsigned DEFAULT NULL,
                                     `ordernumber` int(11) DEFAULT NULL,
                                     `pic1` varchar(200) DEFAULT NULL,
                                     `pic2` varchar(200) DEFAULT NULL,
                                     `pic3` varchar(200) DEFAULT NULL,
                                     `pic4` varchar(200) DEFAULT NULL,
                                     `price` decimal(16,9) DEFAULT NULL,
                                     `item` varchar(100) DEFAULT NULL,
                                     `sizeid` int(10) unsigned DEFAULT NULL,
                                     `memo` varchar(1000) DEFAULT NULL,
                                     `savesize` varchar(50) DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='报价单明细表';


--
-- Dumping data for table `dd_quotation_detail`
--

LOCK TABLES `dd_quotation_detail` WRITE;
/*!40000 ALTER TABLE `dd_quotation_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd_quotation_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_cfashion`
--

DROP TABLE IF EXISTS `if_cfashion`;


CREATE TABLE `if_cfashion` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `creationtime` datetime DEFAULT NULL,
                             `productid` int(10) unsigned DEFAULT NULL,
                             `currencyunit` varchar(50) DEFAULT NULL,
                             `description` text,
                             `mprice` decimal(18,0) DEFAULT NULL,
                             `price` decimal(18,0) DEFAULT NULL,
                             `del` int(11) DEFAULT NULL,
                             `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                             `returnstate` int(11) DEFAULT NULL,
                             `returntext` text,
                             `cprice` decimal(18,0) DEFAULT NULL,
                             `sourcefunction` varchar(50) DEFAULT NULL,
                             `sizeid` int(10) unsigned DEFAULT NULL,
                             `sku` varchar(50) DEFAULT NULL,
                             `stockchange` varchar(500) DEFAULT NULL,
                             `imglist` text,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='迷橙接口数据表';


--
-- Dumping data for table `if_cfashion`
--

LOCK TABLES `if_cfashion` WRITE;
/*!40000 ALTER TABLE `if_cfashion` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_cfashion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_exception`
--

DROP TABLE IF EXISTS `if_exception`;


CREATE TABLE `if_exception` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `productid` int(10) unsigned DEFAULT NULL,
                              `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                              `asacode` varchar(50) DEFAULT NULL,
                              `exception` char(1) DEFAULT NULL,
                              `sizeid` int(10) unsigned DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='库存变动日志数据表';


--
-- Dumping data for table `if_exception`
--

LOCK TABLES `if_exception` WRITE;
/*!40000 ALTER TABLE `if_exception` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_exception` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_imgorder`
--

DROP TABLE IF EXISTS `if_imgorder`;


CREATE TABLE `if_imgorder` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `productid` int(10) unsigned DEFAULT NULL,
                             `ifid` int(10) unsigned DEFAULT NULL COMMENT '0-添加 1-修改',
                             `numorder` int(11) DEFAULT NULL,
                             `imgname` char(1) DEFAULT NULL,
                             `imgsize` varchar(50) DEFAULT NULL,
                             `imgtype` varchar(50) DEFAULT NULL COMMENT '缩略图，详细图',
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='上传图片顺序';


--
-- Dumping data for table `if_imgorder`
--

LOCK TABLES `if_imgorder` WRITE;
/*!40000 ALTER TABLE `if_imgorder` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_imgorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_jingdong`
--

DROP TABLE IF EXISTS `if_jingdong`;


CREATE TABLE `if_jingdong` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `creationtime` datetime DEFAULT NULL,
                             `productid` int(10) unsigned DEFAULT NULL,
                             `currencyunit` varchar(50) DEFAULT NULL,
                             `description` text,
                             `mprice` decimal(18,0) DEFAULT NULL,
                             `price` decimal(18,0) DEFAULT NULL,
                             `del` int(11) DEFAULT NULL,
                             `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                             `returnstate` int(11) DEFAULT NULL,
                             `returntext` text,
                             `cprice` decimal(18,0) DEFAULT NULL,
                             `sourcefunction` varchar(50) DEFAULT NULL,
                             `sku` varchar(50) DEFAULT NULL,
                             `stockchange` varchar(500) DEFAULT NULL,
                             `imglist` text,
                             `externalno` varchar(50) DEFAULT NULL,
                             `sizeid` int(10) unsigned DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='京东接口数据表';


--
-- Dumping data for table `if_jingdong`
--

LOCK TABLES `if_jingdong` WRITE;
/*!40000 ALTER TABLE `if_jingdong` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_jingdong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_meilihui`
--

DROP TABLE IF EXISTS `if_meilihui`;


CREATE TABLE `if_meilihui` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `creationtime` datetime DEFAULT NULL,
                             `productid` int(10) unsigned DEFAULT NULL,
                             `currencyunit` varchar(50) DEFAULT NULL,
                             `description` text,
                             `mprice` decimal(18,0) DEFAULT NULL,
                             `price` decimal(18,0) DEFAULT NULL,
                             `del` int(11) DEFAULT NULL,
                             `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                             `returnstate` int(11) DEFAULT NULL,
                             `returntext` text,
                             `cprice` decimal(18,0) DEFAULT NULL,
                             `sourcefunction` varchar(50) DEFAULT NULL,
                             `sizeid` int(10) unsigned DEFAULT NULL,
                             `sku` varchar(50) DEFAULT NULL,
                             `stockchange` varchar(500) DEFAULT NULL,
                             `imglist` text,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='魅力惠接口数据表';


--
-- Dumping data for table `if_meilihui`
--

LOCK TABLES `if_meilihui` WRITE;
/*!40000 ALTER TABLE `if_meilihui` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_meilihui` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_meixi`
--

DROP TABLE IF EXISTS `if_meixi`;


CREATE TABLE `if_meixi` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                          `sys_create_stuff` int(10) unsigned NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `creationtime` datetime DEFAULT NULL,
                          `productid` int(10) unsigned DEFAULT NULL,
                          `currencyunit` varchar(50) DEFAULT NULL,
                          `description` text,
                          `mprice` decimal(18,0) DEFAULT NULL,
                          `price` decimal(18,0) DEFAULT NULL,
                          `del` int(11) DEFAULT NULL,
                          `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                          `returnstate` int(11) DEFAULT NULL COMMENT '0-未处理\r\n            1-处理成功\r\n            2-异常',
                          `returntext` text,
                          `cprice` decimal(18,0) DEFAULT NULL,
                          `sourcefunction` varchar(50) DEFAULT NULL,
                          `sku` varchar(50) DEFAULT NULL,
                          `stockchange` varchar(500) DEFAULT NULL,
                          `imglist` text,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='美西接口数据表';


--
-- Dumping data for table `if_meixi`
--

LOCK TABLES `if_meixi` WRITE;
/*!40000 ALTER TABLE `if_meixi` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_meixi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_ofashion`
--

DROP TABLE IF EXISTS `if_ofashion`;


CREATE TABLE `if_ofashion` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `creationtime` datetime DEFAULT NULL,
                             `productid` int(10) unsigned DEFAULT NULL,
                             `currencyunit` varchar(50) DEFAULT NULL,
                             `description` text,
                             `mprice` decimal(18,0) DEFAULT NULL,
                             `price` decimal(18,0) DEFAULT NULL,
                             `del` int(11) DEFAULT NULL,
                             `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                             `returnstate` int(11) DEFAULT NULL,
                             `returntext` text,
                             `cprice` decimal(18,0) DEFAULT NULL,
                             `sourcefunction` varchar(50) DEFAULT NULL,
                             `sizeid` int(10) unsigned DEFAULT NULL,
                             `sku` varchar(50) DEFAULT NULL,
                             `stockchange` varchar(500) DEFAULT NULL,
                             `imglist` text,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='迷橙接口数据表';


--
-- Dumping data for table `if_ofashion`
--

LOCK TABLES `if_ofashion` WRITE;
/*!40000 ALTER TABLE `if_ofashion` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_ofashion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_shangpin`
--

DROP TABLE IF EXISTS `if_shangpin`;


CREATE TABLE `if_shangpin` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `creationtime` datetime DEFAULT NULL,
                             `productid` int(10) unsigned DEFAULT NULL,
                             `currencyunit` varchar(50) DEFAULT NULL,
                             `description` text,
                             `mprice` decimal(18,0) DEFAULT NULL,
                             `price` decimal(18,0) DEFAULT NULL,
                             `del` int(11) DEFAULT NULL,
                             `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                             `returnstate` int(11) DEFAULT NULL,
                             `returntext` text,
                             `cprice` decimal(18,0) DEFAULT NULL,
                             `sourcefunction` varchar(50) DEFAULT NULL,
                             `sizeid` int(10) unsigned DEFAULT NULL,
                             `sku` varchar(50) DEFAULT NULL,
                             `stockchange` varchar(500) DEFAULT NULL,
                             `imglist` text,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='尚品接口数据表';


--
-- Dumping data for table `if_shangpin`
--

LOCK TABLES `if_shangpin` WRITE;
/*!40000 ALTER TABLE `if_shangpin` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_shangpin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_shangpin_direct`
--

DROP TABLE IF EXISTS `if_shangpin_direct`;


CREATE TABLE `if_shangpin_direct` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                    `sys_create_stuff` int(10) unsigned NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `creationtime` datetime DEFAULT NULL,
                                    `productid` int(10) unsigned DEFAULT NULL,
                                    `currencyunit` varchar(50) DEFAULT NULL,
                                    `description` text,
                                    `mprice` decimal(18,0) DEFAULT NULL,
                                    `price` decimal(18,0) DEFAULT NULL,
                                    `del` int(11) DEFAULT NULL,
                                    `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                                    `returnstate` int(11) DEFAULT NULL,
                                    `returntext` text,
                                    `cprice` decimal(18,0) DEFAULT NULL,
                                    `sourcefunction` varchar(50) DEFAULT NULL,
                                    `sizeid` int(10) unsigned DEFAULT NULL,
                                    `sku` varchar(50) DEFAULT NULL,
                                    `stockchange` varchar(500) DEFAULT NULL,
                                    `imglist` text,
                                    `categoryno` varchar(50) DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='尚品直发接口数据表';


--
-- Dumping data for table `if_shangpin_direct`
--

LOCK TABLES `if_shangpin_direct` WRITE;
/*!40000 ALTER TABLE `if_shangpin_direct` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_shangpin_direct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_siku`
--

DROP TABLE IF EXISTS `if_siku`;


CREATE TABLE `if_siku` (
                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                         `sys_create_stuff` int(10) unsigned NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) unsigned NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                         `creationtime` datetime DEFAULT NULL,
                         `productid` int(10) unsigned DEFAULT NULL,
                         `sizeid` int(10) unsigned DEFAULT NULL,
                         `salesid` int(10) unsigned DEFAULT NULL,
                         `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                         `returnstate` int(11) DEFAULT NULL,
                         `returntext` text,
                         `sourcefunction` varchar(50) DEFAULT NULL,
                         `sku` varchar(50) DEFAULT NULL,
                         `stockchange` int(11) DEFAULT NULL,
                         `imglist` text,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='美西接口数据表';


--
-- Dumping data for table `if_siku`
--

LOCK TABLES `if_siku` WRITE;
/*!40000 ALTER TABLE `if_siku` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_siku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_sxdzb`
--

DROP TABLE IF EXISTS `if_sxdzb`;


CREATE TABLE `if_sxdzb` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                          `sys_create_stuff` int(10) unsigned NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `productid` int(10) unsigned DEFAULT NULL,
                          `zpid` bigint(20) DEFAULT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='珍品上传商品对照';


--
-- Dumping data for table `if_sxdzb`
--

LOCK TABLES `if_sxdzb` WRITE;
/*!40000 ALTER TABLE `if_sxdzb` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_sxdzb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_zhenpin`
--

DROP TABLE IF EXISTS `if_zhenpin`;


CREATE TABLE `if_zhenpin` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                            `sys_create_stuff` int(10) unsigned NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `creationtime` datetime DEFAULT NULL,
                            `productid` int(10) unsigned DEFAULT NULL,
                            `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                            `returnstate` int(11) DEFAULT NULL,
                            `returntext` text,
                            `sourcefunction` varchar(50) DEFAULT NULL,
                            `sku` varchar(50) DEFAULT NULL,
                            `stockchange` int(11) DEFAULT NULL,
                            `imglist` text,
                            `currencyunit` varchar(50) DEFAULT NULL,
                            `mprice` varchar(50) DEFAULT NULL,
                            `price` varchar(50) DEFAULT NULL,
                            `cprice` varchar(50) DEFAULT NULL,
                            `description` text,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='珍品接口数据表';


--
-- Dumping data for table `if_zhenpin`
--

LOCK TABLES `if_zhenpin` WRITE;
/*!40000 ALTER TABLE `if_zhenpin` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_zhenpin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `if_zouxiu`
--

DROP TABLE IF EXISTS `if_zouxiu`;


CREATE TABLE `if_zouxiu` (
                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                           `sys_create_stuff` int(10) unsigned NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                           `creationtime` datetime DEFAULT NULL,
                           `productid` int(10) unsigned DEFAULT NULL,
                           `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                           `returnstate` int(11) DEFAULT NULL,
                           `returntext` text,
                           `mprice` decimal(18,0) DEFAULT NULL,
                           `price` decimal(18,0) DEFAULT NULL,
                           `description` text,
                           `currencyunit` varchar(50) DEFAULT NULL,
                           `sourcefunction` varchar(50) DEFAULT NULL,
                           `sku` varchar(50) DEFAULT NULL,
                           `stockchange` int(11) DEFAULT NULL,
                           `imglist` text,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='美西接口数据表';


--
-- Dumping data for table `if_zouxiu`
--

LOCK TABLES `if_zouxiu` WRITE;
/*!40000 ALTER TABLE `if_zouxiu` DISABLE KEYS */;
/*!40000 ALTER TABLE `if_zouxiu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_actual_to_productstock`
--

DROP TABLE IF EXISTS `link_actual_to_productstock`;


CREATE TABLE `link_actual_to_productstock` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `productstockid` int(10) unsigned DEFAULT NULL,
                                             `actualid` int(10) unsigned DEFAULT NULL,
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='实盘单到库存之间的记录';


--
-- Dumping data for table `link_actual_to_productstock`
--

LOCK TABLES `link_actual_to_productstock` WRITE;
/*!40000 ALTER TABLE `link_actual_to_productstock` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_actual_to_productstock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_barcode_to_size`
--

DROP TABLE IF EXISTS `link_barcode_to_size`;


CREATE TABLE `link_barcode_to_size` (
                                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                      `sys_create_stuff` int(10) unsigned NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) unsigned NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `sizeid` int(10) unsigned DEFAULT NULL,
                                      `productid` int(10) unsigned DEFAULT NULL,
                                      `barcode` varchar(50) DEFAULT NULL,
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';


--
-- Dumping data for table `link_barcode_to_size`
--

LOCK TABLES `link_barcode_to_size` WRITE;
/*!40000 ALTER TABLE `link_barcode_to_size` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_barcode_to_size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_brand_to_brandgroup`
--

DROP TABLE IF EXISTS `link_brand_to_brandgroup`;


CREATE TABLE `link_brand_to_brandgroup` (
                                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                          `sys_create_stuff` int(10) unsigned NOT NULL,
                                          `sys_create_date` datetime NOT NULL,
                                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                                          `sys_modify_date` datetime NOT NULL,
                                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                          `sys_delete_date` datetime DEFAULT NULL,
                                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                          `brandid` int(10) unsigned DEFAULT NULL,
                                          `groupid` int(10) unsigned DEFAULT NULL,
                                          `brandgroupid` int(10) unsigned DEFAULT NULL,
                                          `note` varchar(50) DEFAULT NULL,
                                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';


--
-- Dumping data for table `link_brand_to_brandgroup`
--

LOCK TABLES `link_brand_to_brandgroup` WRITE;
/*!40000 ALTER TABLE `link_brand_to_brandgroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_brand_to_brandgroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_brand_to_discount`
--

DROP TABLE IF EXISTS `link_brand_to_discount`;


CREATE TABLE `link_brand_to_discount` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `brandid` int(10) unsigned DEFAULT NULL,
                                        `decade` int(10) unsigned DEFAULT NULL,
                                        `groupid` int(10) unsigned DEFAULT NULL,
                                        `brandgroupid` int(10) unsigned DEFAULT NULL,
                                        `discount` decimal(10,2) DEFAULT NULL,
                                        `gender` varchar(1) DEFAULT NULL COMMENT '0-女式 1-男士 2-中性',
                                        `note` varchar(50) DEFAULT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品牌出厂价折扣';


--
-- Dumping data for table `link_brand_to_discount`
--

LOCK TABLES `link_brand_to_discount` WRITE;
/*!40000 ALTER TABLE `link_brand_to_discount` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_brand_to_discount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_brand_to_priced`
--

DROP TABLE IF EXISTS `link_brand_to_priced`;


CREATE TABLE `link_brand_to_priced` (
                                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                      `sys_create_stuff` int(10) unsigned NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) unsigned NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `brandtypeid` int(10) unsigned DEFAULT NULL,
                                      `priced` decimal(19,6) DEFAULT NULL,
                                      `brandid` int(10) unsigned DEFAULT NULL,
                                      `priceid` int(10) unsigned DEFAULT NULL,
                                      `pricedmark` varchar(1) DEFAULT NULL COMMENT '0 - 欧洲零售价\r\n            1 - 欧洲出厂价',
                                      `symbol` varchar(2) DEFAULT NULL,
                                      `isrounded` varchar(1) DEFAULT NULL COMMENT '0- 0-20 取0 ,21-70 取50,71-99 取100\r\n            1-0-1取0，1-6取5，6-9取10\r\n            2.不取整',
                                      `decade` int(10) unsigned DEFAULT NULL,
                                      `currencyid` int(10) unsigned DEFAULT NULL,
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';


--
-- Dumping data for table `link_brand_to_priced`
--

LOCK TABLES `link_brand_to_priced` WRITE;
/*!40000 ALTER TABLE `link_brand_to_priced` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_brand_to_priced` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_brandgroup_to_supplier`
--

DROP TABLE IF EXISTS `link_brandgroup_to_supplier`;


CREATE TABLE `link_brandgroup_to_supplier` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `supplierid` int(10) unsigned DEFAULT NULL,
                                             `brandgroupid` int(10) unsigned DEFAULT NULL,
                                             `decade` int(10) unsigned DEFAULT NULL,
                                             `markup` decimal(10,2) DEFAULT NULL,
                                             `currencyid` int(10) unsigned DEFAULT NULL,
                                             `sum` decimal(10,2) DEFAULT NULL,
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='供货商品类连接表';


--
-- Dumping data for table `link_brandgroup_to_supplier`
--

LOCK TABLES `link_brandgroup_to_supplier` WRITE;
/*!40000 ALTER TABLE `link_brandgroup_to_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_brandgroup_to_supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_cdetail_to_ddetail`
--

DROP TABLE IF EXISTS `link_cdetail_to_ddetail`;


CREATE TABLE `link_cdetail_to_ddetail` (
                                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                         `sys_create_stuff` int(10) unsigned NOT NULL,
                                         `sys_create_date` datetime NOT NULL,
                                         `sys_modify_stuff` int(10) unsigned NOT NULL,
                                         `sys_modify_date` datetime NOT NULL,
                                         `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                         `sys_delete_date` datetime DEFAULT NULL,
                                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                         `cdetailid` int(10) unsigned DEFAULT NULL,
                                         `ddetailid` int(10) unsigned DEFAULT NULL,
                                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 发货单明细 to 报关明细';


--
-- Dumping data for table `link_cdetail_to_ddetail`
--

LOCK TABLES `link_cdetail_to_ddetail` WRITE;
/*!40000 ALTER TABLE `link_cdetail_to_ddetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_cdetail_to_ddetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_childbrand_to_execution`
--

DROP TABLE IF EXISTS `link_childbrand_to_execution`;


CREATE TABLE `link_childbrand_to_execution` (
                                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                              `sys_create_stuff` int(10) unsigned NOT NULL,
                                              `sys_create_date` datetime NOT NULL,
                                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                                              `sys_modify_date` datetime NOT NULL,
                                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                              `sys_delete_date` datetime DEFAULT NULL,
                                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                              `childbrandid` int(10) unsigned DEFAULT NULL,
                                              `executionid` int(10) unsigned DEFAULT NULL,
                                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';


--
-- Dumping data for table `link_childbrand_to_execution`
--

LOCK TABLES `link_childbrand_to_execution` WRITE;
/*!40000 ALTER TABLE `link_childbrand_to_execution` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_childbrand_to_execution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_childbrand_to_innards`
--

DROP TABLE IF EXISTS `link_childbrand_to_innards`;


CREATE TABLE `link_childbrand_to_innards` (
                                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                            `sys_create_stuff` int(10) unsigned NOT NULL,
                                            `sys_create_date` datetime NOT NULL,
                                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                                            `sys_modify_date` datetime NOT NULL,
                                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                            `sys_delete_date` datetime DEFAULT NULL,
                                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                            `childbrandid` int(10) unsigned DEFAULT NULL,
                                            `innardsid` int(10) unsigned DEFAULT NULL,
                                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 子品类 to 内部结构';


--
-- Dumping data for table `link_childbrand_to_innards`
--

LOCK TABLES `link_childbrand_to_innards` WRITE;
/*!40000 ALTER TABLE `link_childbrand_to_innards` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_childbrand_to_innards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_childbrand_to_material`
--

DROP TABLE IF EXISTS `link_childbrand_to_material`;


CREATE TABLE `link_childbrand_to_material` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `childbrandid` int(10) unsigned DEFAULT NULL,
                                             `materialid` int(10) unsigned DEFAULT NULL,
                                             `hgcode` varchar(50) DEFAULT NULL,
                                             `taxrate` decimal(16,9) DEFAULT NULL,
                                             `sex` varchar(1) DEFAULT NULL COMMENT '0-女式 1-男士(中性也算男士)',
                                             `isfj` varchar(1) DEFAULT NULL COMMENT '0-否 1-法检',
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 子品类 to 材质';


--
-- Dumping data for table `link_childbrand_to_material`
--

LOCK TABLES `link_childbrand_to_material` WRITE;
/*!40000 ALTER TABLE `link_childbrand_to_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_childbrand_to_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_childbrand_to_outinnards`
--

DROP TABLE IF EXISTS `link_childbrand_to_outinnards`;


CREATE TABLE `link_childbrand_to_outinnards` (
                                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                               `sys_create_stuff` int(10) unsigned NOT NULL,
                                               `sys_create_date` datetime NOT NULL,
                                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                                               `sys_modify_date` datetime NOT NULL,
                                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                               `sys_delete_date` datetime DEFAULT NULL,
                                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                               `childbrandid` int(10) unsigned DEFAULT NULL,
                                               `outinnardsid` int(10) unsigned DEFAULT NULL,
                                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 子品类 to 外部结构';


--
-- Dumping data for table `link_childbrand_to_outinnards`
--

LOCK TABLES `link_childbrand_to_outinnards` WRITE;
/*!40000 ALTER TABLE `link_childbrand_to_outinnards` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_childbrand_to_outinnards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_childbrand_to_safety`
--

DROP TABLE IF EXISTS `link_childbrand_to_safety`;


CREATE TABLE `link_childbrand_to_safety` (
                                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                           `sys_create_stuff` int(10) unsigned NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `childbrandid` int(10) unsigned DEFAULT NULL,
                                           `safetyid` int(10) unsigned DEFAULT NULL,
                                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';


--
-- Dumping data for table `link_childbrand_to_safety`
--

LOCK TABLES `link_childbrand_to_safety` WRITE;
/*!40000 ALTER TABLE `link_childbrand_to_safety` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_childbrand_to_safety` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_color_to_brand`
--

DROP TABLE IF EXISTS `link_color_to_brand`;


CREATE TABLE `link_color_to_brand` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `colorid` int(10) unsigned DEFAULT NULL,
                                     `brandid` int(10) unsigned DEFAULT NULL,
                                     `colorname` varchar(50) DEFAULT NULL,
                                     `colorcode` varchar(50) DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 颜色模板与品牌链接的关系';


--
-- Dumping data for table `link_color_to_brand`
--

LOCK TABLES `link_color_to_brand` WRITE;
/*!40000 ALTER TABLE `link_color_to_brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_color_to_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_contacts_to_supplier`
--

DROP TABLE IF EXISTS `link_contacts_to_supplier`;


CREATE TABLE `link_contacts_to_supplier` (
                                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                           `sys_create_stuff` int(10) unsigned NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `supplierid` int(10) unsigned DEFAULT NULL,
                                           `companycontactsid` int(10) unsigned DEFAULT NULL,
                                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='表暂时未使用';


--
-- Dumping data for table `link_contacts_to_supplier`
--

LOCK TABLES `link_contacts_to_supplier` WRITE;
/*!40000 ALTER TABLE `link_contacts_to_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_contacts_to_supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_ctn_to_cdetail`
--

DROP TABLE IF EXISTS `link_ctn_to_cdetail`;


CREATE TABLE `link_ctn_to_cdetail` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `corderdetailid` int(10) unsigned DEFAULT NULL,
                                     `ctnid` int(10) unsigned DEFAULT NULL,
                                     `sum` int(11) DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='装箱单 发货单明细 连接表';


--
-- Dumping data for table `link_ctn_to_cdetail`
--

LOCK TABLES `link_ctn_to_cdetail` WRITE;
/*!40000 ALTER TABLE `link_ctn_to_cdetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_ctn_to_cdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_data_to_file`
--

DROP TABLE IF EXISTS `link_data_to_file`;


CREATE TABLE `link_data_to_file` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `dataid` int(10) unsigned DEFAULT NULL COMMENT '上传附件的相关数据id，例如：订单id等',
                                   `picturename` varchar(500) DEFAULT NULL,
                                   `picturepath` varchar(500) DEFAULT NULL COMMENT '带文件名，取文件完整路径=ftp+/+路径',
                                   `servername` varchar(100) DEFAULT NULL,
                                   `filetype` varchar(2) DEFAULT NULL COMMENT '0.-一般文件\r\n            1-商标注册证\r\n            2.品牌方发票\r\n            3.供货商发票\r\n            4.供货商装箱单\r\n            5.运单\r\n            6.付款水单\r\n            7.进口报关单\r\n            8.商检放行单\r\n            9.中国关税单\r\n            10.中国增值税单\r\n            11.品牌检测报告\r\n            12.报关文件\r\n            13.供货商合同\r\n            14.付汇水单',
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 数据 to 文件（上传附件）';


--
-- Dumping data for table `link_data_to_file`
--

LOCK TABLES `link_data_to_file` WRITE;
/*!40000 ALTER TABLE `link_data_to_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_data_to_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_department_to_salesport`
--

DROP TABLE IF EXISTS `link_department_to_salesport`;


CREATE TABLE `link_department_to_salesport` (
                                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                              `sys_create_stuff` int(10) unsigned NOT NULL,
                                              `sys_create_date` datetime NOT NULL,
                                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                                              `sys_modify_date` datetime NOT NULL,
                                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                              `sys_delete_date` datetime DEFAULT NULL,
                                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                              `departmentid` int(10) unsigned DEFAULT NULL,
                                              `sportid` int(10) unsigned DEFAULT NULL,
                                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口部门连接表';


--
-- Dumping data for table `link_department_to_salesport`
--

LOCK TABLES `link_department_to_salesport` WRITE;
/*!40000 ALTER TABLE `link_department_to_salesport` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_department_to_salesport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_detail_to_detail`
--

DROP TABLE IF EXISTS `link_detail_to_detail`;


CREATE TABLE `link_detail_to_detail` (
                                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                       `sys_create_stuff` int(10) unsigned NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) unsigned NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `pdetailid` int(10) unsigned DEFAULT NULL,
                                       `cdetailid` int(10) unsigned DEFAULT NULL,
                                       `sum` int(11) DEFAULT NULL,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品牌订单 客户订单连接表';


--
-- Dumping data for table `link_detail_to_detail`
--

LOCK TABLES `link_detail_to_detail` WRITE;
/*!40000 ALTER TABLE `link_detail_to_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_detail_to_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_distribute_to_cdetail`
--

DROP TABLE IF EXISTS `link_distribute_to_cdetail`;


CREATE TABLE `link_distribute_to_cdetail` (
                                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                            `sys_create_stuff` int(10) unsigned NOT NULL,
                                            `sys_create_date` datetime NOT NULL,
                                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                                            `sys_modify_date` datetime NOT NULL,
                                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                            `sys_delete_date` datetime DEFAULT NULL,
                                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                            `corderdetailid` int(10) unsigned DEFAULT NULL,
                                            `dstributeid` int(10) unsigned DEFAULT NULL,
                                            `sum` int(11) DEFAULT NULL,
                                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='分货单 发货单明细 连接表';


--
-- Dumping data for table `link_distribute_to_cdetail`
--

LOCK TABLES `link_distribute_to_cdetail` WRITE;
/*!40000 ALTER TABLE `link_distribute_to_cdetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_distribute_to_cdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_group_to_navigation`
--

DROP TABLE IF EXISTS `link_group_to_navigation`;


CREATE TABLE `link_group_to_navigation` (
                                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                          `groupid` int(10) unsigned DEFAULT NULL,
                                          `navigationid` int(10) unsigned DEFAULT NULL,
                                          `sys_create_stuff` int(10) unsigned NOT NULL,
                                          `sys_create_date` datetime NOT NULL,
                                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                                          `sys_modify_date` datetime NOT NULL,
                                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                          `sys_delete_date` datetime DEFAULT NULL,
                                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                          PRIMARY KEY (`id`),
                                          KEY `fk_reference_link_group_to_navigation_to_group` (`groupid`),
                                          CONSTRAINT `fk_reference_link_group_to_navigation_to_group` FOREIGN KEY (`groupid`) REFERENCES `tb_group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='组导航连接表';


--
-- Dumping data for table `link_group_to_navigation`
--

LOCK TABLES `link_group_to_navigation` WRITE;
/*!40000 ALTER TABLE `link_group_to_navigation` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_group_to_navigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_invoice_to_order`
--

DROP TABLE IF EXISTS `link_invoice_to_order`;


CREATE TABLE `link_invoice_to_order` (
                                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                       `sys_create_stuff` int(10) unsigned NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) unsigned NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `invoiceid` int(10) unsigned DEFAULT NULL,
                                       `orderid` int(10) unsigned DEFAULT NULL,
                                       `ordersum` decimal(19,6) DEFAULT NULL,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 运费发票 to 发货单';


--
-- Dumping data for table `link_invoice_to_order`
--

LOCK TABLES `link_invoice_to_order` WRITE;
/*!40000 ALTER TABLE `link_invoice_to_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_invoice_to_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_invoice_to_requisition`
--

DROP TABLE IF EXISTS `link_invoice_to_requisition`;


CREATE TABLE `link_invoice_to_requisition` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `invoiceid` int(10) unsigned DEFAULT NULL,
                                             `requisitionid` int(10) unsigned DEFAULT NULL,
                                             `type` varchar(1) DEFAULT NULL COMMENT '0-按金额 1-按件数',
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 运费发票 to 调拨单';


--
-- Dumping data for table `link_invoice_to_requisition`
--

LOCK TABLES `link_invoice_to_requisition` WRITE;
/*!40000 ALTER TABLE `link_invoice_to_requisition` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_invoice_to_requisition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_invoice_to_warehousing`
--

DROP TABLE IF EXISTS `link_invoice_to_warehousing`;


CREATE TABLE `link_invoice_to_warehousing` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `invoiceid` int(10) unsigned DEFAULT NULL,
                                             `warehousingid` int(10) unsigned DEFAULT NULL,
                                             `type` varchar(1) DEFAULT NULL COMMENT '0-按金额 1-按件数',
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 运费发票 to 入库单';


--
-- Dumping data for table `link_invoice_to_warehousing`
--

LOCK TABLES `link_invoice_to_warehousing` WRITE;
/*!40000 ALTER TABLE `link_invoice_to_warehousing` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_invoice_to_warehousing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_kp_to_store`
--

DROP TABLE IF EXISTS `link_kp_to_store`;


CREATE TABLE `link_kp_to_store` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `kpid` int(10) unsigned DEFAULT NULL,
                                  `productstockid` int(10) unsigned DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='开票库存链接表';


--
-- Dumping data for table `link_kp_to_store`
--

LOCK TABLES `link_kp_to_store` WRITE;
/*!40000 ALTER TABLE `link_kp_to_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_kp_to_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_prep_to_productstock`
--

DROP TABLE IF EXISTS `link_prep_to_productstock`;


CREATE TABLE `link_prep_to_productstock` (
                                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                           `sys_create_stuff` int(10) unsigned NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `productstockid` int(10) unsigned DEFAULT NULL,
                                           `prepid` int(10) unsigned DEFAULT NULL,
                                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预盘单到库存之间的记录';


--
-- Dumping data for table `link_prep_to_productstock`
--

LOCK TABLES `link_prep_to_productstock` WRITE;
/*!40000 ALTER TABLE `link_prep_to_productstock` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_prep_to_productstock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_pricelist_to_salesport`
--

DROP TABLE IF EXISTS `link_pricelist_to_salesport`;


CREATE TABLE `link_pricelist_to_salesport` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `pricelistid` int(10) unsigned DEFAULT NULL,
                                             `sportid` int(10) unsigned DEFAULT NULL,
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 价格单 to 销售端口';


--
-- Dumping data for table `link_pricelist_to_salesport`
--

LOCK TABLES `link_pricelist_to_salesport` WRITE;
/*!40000 ALTER TABLE `link_pricelist_to_salesport` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_pricelist_to_salesport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_closedway`
--

DROP TABLE IF EXISTS `link_product_to_closedway`;


CREATE TABLE `link_product_to_closedway` (
                                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                           `sys_create_stuff` int(10) unsigned NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `productid` int(10) unsigned DEFAULT NULL,
                                           `closedwayid` int(10) unsigned DEFAULT NULL,
                                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 闭合方式';


--
-- Dumping data for table `link_product_to_closedway`
--

LOCK TABLES `link_product_to_closedway` WRITE;
/*!40000 ALTER TABLE `link_product_to_closedway` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_closedway` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_decade`
--

DROP TABLE IF EXISTS `link_product_to_decade`;


CREATE TABLE `link_product_to_decade` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `productid` int(10) unsigned DEFAULT NULL,
                                        `decadeid` int(10) unsigned NOT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品表连接 年代季节';


--
-- Dumping data for table `link_product_to_decade`
--

LOCK TABLES `link_product_to_decade` WRITE;
/*!40000 ALTER TABLE `link_product_to_decade` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_decade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_dscrb`
--

DROP TABLE IF EXISTS `link_product_to_dscrb`;


CREATE TABLE `link_product_to_dscrb` (
                                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                       `sys_create_stuff` int(10) unsigned NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) unsigned NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `productid` int(10) unsigned DEFAULT NULL,
                                       `dscrbid` int(10) unsigned DEFAULT NULL,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品表连接 商品描述';


--
-- Dumping data for table `link_product_to_dscrb`
--

LOCK TABLES `link_product_to_dscrb` WRITE;
/*!40000 ALTER TABLE `link_product_to_dscrb` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_dscrb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_marketprice`
--

DROP TABLE IF EXISTS `link_product_to_marketprice`;


CREATE TABLE `link_product_to_marketprice` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `productid` int(10) unsigned DEFAULT NULL,
                                             `price` decimal(16,9) DEFAULT NULL,
                                             `priceresource` char(1) DEFAULT NULL,
                                             `historyflag` varchar(1) DEFAULT NULL COMMENT '0-当前记录 1-历史记录',
                                             `rate` decimal(16,9) DEFAULT NULL,
                                             `applyprice` decimal(16,9) DEFAULT NULL,
                                             `applystatus` varchar(1) DEFAULT NULL COMMENT '0-已申请\r\n            1-审批通过\r\n            2-驳回',
                                             `priceresourceid` int(10) unsigned DEFAULT NULL,
                                             `applydate` datetime DEFAULT NULL,
                                             `replydate` datetime DEFAULT NULL,
                                             `priceid` int(10) unsigned DEFAULT NULL,
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品表连接 市场价格';


--
-- Dumping data for table `link_product_to_marketprice`
--

LOCK TABLES `link_product_to_marketprice` WRITE;
/*!40000 ALTER TABLE `link_product_to_marketprice` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_marketprice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_material`
--

DROP TABLE IF EXISTS `link_product_to_material`;


CREATE TABLE `link_product_to_material` (
                                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                          `sys_create_stuff` int(10) unsigned NOT NULL,
                                          `sys_create_date` datetime NOT NULL,
                                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                                          `sys_modify_date` datetime NOT NULL,
                                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                          `sys_delete_date` datetime DEFAULT NULL,
                                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                          `productid` int(10) unsigned DEFAULT NULL,
                                          `materialid` int(10) unsigned DEFAULT NULL,
                                          `percentage` varchar(50) DEFAULT NULL,
                                          `note` int(10) unsigned DEFAULT NULL,
                                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 材质';


--
-- Dumping data for table `link_product_to_material`
--

LOCK TABLES `link_product_to_material` WRITE;
/*!40000 ALTER TABLE `link_product_to_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_material2`
--

DROP TABLE IF EXISTS `link_product_to_material2`;


CREATE TABLE `link_product_to_material2` (
                                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                           `sys_create_stuff` int(10) unsigned NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `productid` int(10) unsigned DEFAULT NULL,
                                           `materialid` int(10) unsigned DEFAULT NULL,
                                           `percentage` varchar(50) DEFAULT NULL,
                                           `note` int(10) unsigned DEFAULT NULL,
                                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 材质2';


--
-- Dumping data for table `link_product_to_material2`
--

LOCK TABLES `link_product_to_material2` WRITE;
/*!40000 ALTER TABLE `link_product_to_material2` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_material2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_materislstatus`
--

DROP TABLE IF EXISTS `link_product_to_materislstatus`;


CREATE TABLE `link_product_to_materislstatus` (
                                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                                `sys_create_date` datetime NOT NULL,
                                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                                `sys_modify_date` datetime NOT NULL,
                                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                                `sys_delete_date` datetime DEFAULT NULL,
                                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                                `productid` int(10) unsigned DEFAULT NULL,
                                                `materislstatusid` int(10) unsigned DEFAULT NULL,
                                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品表与材质状态';


--
-- Dumping data for table `link_product_to_materislstatus`
--

LOCK TABLES `link_product_to_materislstatus` WRITE;
/*!40000 ALTER TABLE `link_product_to_materislstatus` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_materislstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_occasions`
--

DROP TABLE IF EXISTS `link_product_to_occasions`;


CREATE TABLE `link_product_to_occasions` (
                                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                           `sys_create_stuff` int(10) unsigned NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `productid` int(10) unsigned DEFAULT NULL,
                                           `occasionsid` int(10) unsigned DEFAULT NULL,
                                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 场合风格';


--
-- Dumping data for table `link_product_to_occasions`
--

LOCK TABLES `link_product_to_occasions` WRITE;
/*!40000 ALTER TABLE `link_product_to_occasions` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_occasions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_origin`
--

DROP TABLE IF EXISTS `link_product_to_origin`;


CREATE TABLE `link_product_to_origin` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `productid` int(10) unsigned DEFAULT NULL,
                                        `originid` int(10) unsigned DEFAULT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品表连接 产地';


--
-- Dumping data for table `link_product_to_origin`
--

LOCK TABLES `link_product_to_origin` WRITE;
/*!40000 ALTER TABLE `link_product_to_origin` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_origin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_outproductinnards`
--

DROP TABLE IF EXISTS `link_product_to_outproductinnards`;


CREATE TABLE `link_product_to_outproductinnards` (
                                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                                   `sys_create_date` datetime NOT NULL,
                                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                                   `sys_modify_date` datetime NOT NULL,
                                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                                   `sys_delete_date` datetime DEFAULT NULL,
                                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                                   `productid` int(10) unsigned DEFAULT NULL,
                                                   `innardsid` int(10) unsigned DEFAULT NULL,
                                                   `sum` int(11) DEFAULT NULL,
                                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 外部结构';


--
-- Dumping data for table `link_product_to_outproductinnards`
--

LOCK TABLES `link_product_to_outproductinnards` WRITE;
/*!40000 ALTER TABLE `link_product_to_outproductinnards` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_outproductinnards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_picture`
--

DROP TABLE IF EXISTS `link_product_to_picture`;


CREATE TABLE `link_product_to_picture` (
                                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                         `sys_create_stuff` int(10) unsigned NOT NULL,
                                         `sys_create_date` datetime NOT NULL,
                                         `sys_modify_stuff` int(10) unsigned NOT NULL,
                                         `sys_modify_date` datetime NOT NULL,
                                         `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                         `sys_delete_date` datetime DEFAULT NULL,
                                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                         `productid` int(10) unsigned DEFAULT NULL,
                                         `pictureid` int(10) unsigned DEFAULT NULL,
                                         `picturetype` varchar(500) DEFAULT NULL,
                                         `sizetype` int(11) DEFAULT NULL,
                                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='图片表';


--
-- Dumping data for table `link_product_to_picture`
--

LOCK TABLES `link_product_to_picture` WRITE;
/*!40000 ALTER TABLE `link_product_to_picture` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_picture_ftp`
--

DROP TABLE IF EXISTS `link_product_to_picture_ftp`;


CREATE TABLE `link_product_to_picture_ftp` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `productid` int(10) unsigned DEFAULT NULL,
                                             `picturename` varchar(500) DEFAULT NULL,
                                             `picturepath` varchar(1000) DEFAULT NULL,
                                             `picturesize` varchar(1) DEFAULT NULL COMMENT '1-750*750\r\n            2-800*800\r\n            3-1200*1200',
                                             `uploadflag` varchar(1) DEFAULT NULL COMMENT '0-无需上传，1-需要上传',
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to ftp图片';


--
-- Dumping data for table `link_product_to_picture_ftp`
--

LOCK TABLES `link_product_to_picture_ftp` WRITE;
/*!40000 ALTER TABLE `link_product_to_picture_ftp` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_picture_ftp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_price`
--

DROP TABLE IF EXISTS `link_product_to_price`;


CREATE TABLE `link_product_to_price` (
                                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                       `sys_create_stuff` int(10) unsigned NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) unsigned NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `priceid` int(10) unsigned DEFAULT NULL,
                                       `currencyid` int(10) unsigned DEFAULT NULL,
                                       `price` decimal(10,2) DEFAULT NULL,
                                       `productid` int(10) unsigned DEFAULT NULL,
                                       `jsfs` varchar(100) DEFAULT NULL,
                                       `baseprice` decimal(10,2) DEFAULT NULL,
                                       `exchangerate` decimal(16,9) DEFAULT NULL,
                                       `rate` decimal(10,2) DEFAULT NULL,
                                       `symbol` varchar(1) DEFAULT NULL,
                                       `lockstatus` varchar(1) DEFAULT NULL COMMENT '0-未锁定 1-锁定',
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 商品销售价格(国内外零售价、批发价格)';


--
-- Dumping data for table `link_product_to_price`
--

LOCK TABLES `link_product_to_price` WRITE;
/*!40000 ALTER TABLE `link_product_to_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_price2`
--

DROP TABLE IF EXISTS `link_product_to_price2`;


CREATE TABLE `link_product_to_price2` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `priceid` int(10) unsigned DEFAULT NULL,
                                        `currencyid` int(10) unsigned DEFAULT NULL,
                                        `price` decimal(10,2) DEFAULT NULL,
                                        `productid` int(10) unsigned DEFAULT NULL,
                                        `jsfs` varchar(100) DEFAULT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 商品销售价格(国内外零售价、批发价格)';


--
-- Dumping data for table `link_product_to_price2`
--

LOCK TABLES `link_product_to_price2` WRITE;
/*!40000 ALTER TABLE `link_product_to_price2` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_price2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_price_history`
--

DROP TABLE IF EXISTS `link_product_to_price_history`;


CREATE TABLE `link_product_to_price_history` (
                                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                               `sys_create_stuff` int(10) unsigned NOT NULL,
                                               `sys_create_date` datetime NOT NULL,
                                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                                               `sys_modify_date` datetime NOT NULL,
                                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                               `sys_delete_date` datetime DEFAULT NULL,
                                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                               `priceid` int(10) unsigned DEFAULT NULL,
                                               `currencyid` int(10) unsigned DEFAULT NULL,
                                               `price` decimal(10,2) DEFAULT NULL,
                                               `productid` int(10) unsigned DEFAULT NULL,
                                               `actiontype` varchar(1) DEFAULT NULL COMMENT '0-添加 1-修改',
                                               `baseprice` decimal(10,2) DEFAULT NULL,
                                               `exchangerate` decimal(16,9) DEFAULT NULL,
                                               `rate` decimal(10,2) DEFAULT NULL,
                                               `symbol` varchar(1) DEFAULT NULL,
                                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 商品销售价格(国内外零售价、批发价格) 历史记录';


--
-- Dumping data for table `link_product_to_price_history`
--

LOCK TABLES `link_product_to_price_history` WRITE;
/*!40000 ALTER TABLE `link_product_to_price_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_price_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_productinnards`
--

DROP TABLE IF EXISTS `link_product_to_productinnards`;


CREATE TABLE `link_product_to_productinnards` (
                                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                                `sys_create_date` datetime NOT NULL,
                                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                                `sys_modify_date` datetime NOT NULL,
                                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                                `sys_delete_date` datetime DEFAULT NULL,
                                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                                `productid` int(10) unsigned DEFAULT NULL,
                                                `innardsid` int(10) unsigned DEFAULT NULL,
                                                `sum` int(11) DEFAULT NULL,
                                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 内部结构';


--
-- Dumping data for table `link_product_to_productinnards`
--

LOCK TABLES `link_product_to_productinnards` WRITE;
/*!40000 ALTER TABLE `link_product_to_productinnards` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_productinnards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_productparts`
--

DROP TABLE IF EXISTS `link_product_to_productparts`;


CREATE TABLE `link_product_to_productparts` (
                                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                              `sys_create_stuff` int(10) unsigned NOT NULL,
                                              `sys_create_date` datetime NOT NULL,
                                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                                              `sys_modify_date` datetime NOT NULL,
                                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                              `sys_delete_date` datetime DEFAULT NULL,
                                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                              `productid` int(10) unsigned DEFAULT NULL,
                                              `partsid` int(10) unsigned DEFAULT NULL,
                                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 附带配件';


--
-- Dumping data for table `link_product_to_productparts`
--

LOCK TABLES `link_product_to_productparts` WRITE;
/*!40000 ALTER TABLE `link_product_to_productparts` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_productparts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_salesnature`
--

DROP TABLE IF EXISTS `link_product_to_salesnature`;


CREATE TABLE `link_product_to_salesnature` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `productid` int(10) unsigned DEFAULT NULL,
                                             `salesnatureid` int(10) unsigned DEFAULT NULL,
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售性质连接表';


--
-- Dumping data for table `link_product_to_salesnature`
--

LOCK TABLES `link_product_to_salesnature` WRITE;
/*!40000 ALTER TABLE `link_product_to_salesnature` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_salesnature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_salesport`
--

DROP TABLE IF EXISTS `link_product_to_salesport`;


CREATE TABLE `link_product_to_salesport` (
                                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                           `sys_create_stuff` int(10) unsigned NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `productid` int(10) unsigned DEFAULT NULL,
                                           `sportid` int(10) unsigned DEFAULT NULL,
                                           `currencyid` int(10) unsigned DEFAULT NULL,
                                           `price` decimal(16,9) DEFAULT NULL,
                                           `discount` decimal(16,9) DEFAULT NULL,
                                           `sellspotname` varchar(100) DEFAULT NULL,
                                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口商品连接表';


--
-- Dumping data for table `link_product_to_salesport`
--

LOCK TABLES `link_product_to_salesport` WRITE;
/*!40000 ALTER TABLE `link_product_to_salesport` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_salesport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_salesport_history`
--

DROP TABLE IF EXISTS `link_product_to_salesport_history`;


CREATE TABLE `link_product_to_salesport_history` (
                                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                                   `sys_create_date` datetime NOT NULL,
                                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                                   `sys_modify_date` datetime NOT NULL,
                                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                                   `sys_delete_date` datetime DEFAULT NULL,
                                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                                   `productid` int(10) unsigned DEFAULT NULL,
                                                   `sportid` int(10) unsigned DEFAULT NULL,
                                                   `currencyid` int(10) unsigned DEFAULT NULL,
                                                   `price` decimal(16,9) DEFAULT NULL,
                                                   `actiontype` char(10) DEFAULT NULL COMMENT '0-添加\r\n            1-修改',
                                                   `discount` decimal(16,9) DEFAULT NULL,
                                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口商品连接 历史记录表';


--
-- Dumping data for table `link_product_to_salesport_history`
--

LOCK TABLES `link_product_to_salesport_history` WRITE;
/*!40000 ALTER TABLE `link_product_to_salesport_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_salesport_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_size`
--

DROP TABLE IF EXISTS `link_product_to_size`;


CREATE TABLE `link_product_to_size` (
                                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                      `sys_create_stuff` int(10) unsigned NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) unsigned NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `productid` int(10) unsigned DEFAULT NULL,
                                      `sizeid` int(10) unsigned DEFAULT NULL,
                                      `jdcode` varchar(50) DEFAULT NULL,
                                      `spotid` int(10) unsigned DEFAULT NULL COMMENT '空就是京东',
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 尺码';


--
-- Dumping data for table `link_product_to_size`
--

LOCK TABLES `link_product_to_size` WRITE;
/*!40000 ALTER TABLE `link_product_to_size` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_product_to_washinginstructions`
--

DROP TABLE IF EXISTS `link_product_to_washinginstructions`;


CREATE TABLE `link_product_to_washinginstructions` (
                                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                                     `sys_create_date` datetime NOT NULL,
                                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                                     `sys_modify_date` datetime NOT NULL,
                                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                                     `sys_delete_date` datetime DEFAULT NULL,
                                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                                     `productid` int(10) unsigned DEFAULT NULL,
                                                     `washinginstructionsid` int(10) unsigned DEFAULT NULL,
                                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 洗涤标准';


--
-- Dumping data for table `link_product_to_washinginstructions`
--

LOCK TABLES `link_product_to_washinginstructions` WRITE;
/*!40000 ALTER TABLE `link_product_to_washinginstructions` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_product_to_washinginstructions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_pzh_to_invoice`
--

DROP TABLE IF EXISTS `link_pzh_to_invoice`;


CREATE TABLE `link_pzh_to_invoice` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `invoiceid` int(10) unsigned DEFAULT NULL,
                                     `pzhid` int(10) unsigned DEFAULT NULL,
                                     `invoicecurrencyid` int(10) unsigned DEFAULT NULL,
                                     `invoicesum` decimal(16,9) DEFAULT NULL,
                                     `pzhcurrencyid` int(10) unsigned DEFAULT NULL,
                                     `pzhsum` decimal(16,9) DEFAULT NULL,
                                     `exchangerate` decimal(16,9) DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 凭证表 to 普通发票';


--
-- Dumping data for table `link_pzh_to_invoice`
--

LOCK TABLES `link_pzh_to_invoice` WRITE;
/*!40000 ALTER TABLE `link_pzh_to_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_pzh_to_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_pzh_to_invoicefee`
--

DROP TABLE IF EXISTS `link_pzh_to_invoicefee`;


CREATE TABLE `link_pzh_to_invoicefee` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `invoiceid` int(10) unsigned DEFAULT NULL,
                                        `pzhid` int(10) unsigned DEFAULT NULL,
                                        `invoicecurrencyid` int(10) unsigned DEFAULT NULL,
                                        `invoicesum` decimal(16,9) DEFAULT NULL,
                                        `pzhcurrencyid` int(10) unsigned DEFAULT NULL,
                                        `pzhsum` decimal(16,9) DEFAULT NULL,
                                        `exchangerate` decimal(16,9) DEFAULT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 凭证表 to 运费发票';


--
-- Dumping data for table `link_pzh_to_invoicefee`
--

LOCK TABLES `link_pzh_to_invoicefee` WRITE;
/*!40000 ALTER TABLE `link_pzh_to_invoicefee` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_pzh_to_invoicefee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_pzh_to_order`
--

DROP TABLE IF EXISTS `link_pzh_to_order`;


CREATE TABLE `link_pzh_to_order` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `orderid` int(10) unsigned DEFAULT NULL,
                                   `pzhid` int(10) unsigned DEFAULT NULL,
                                   `ordercurrencyid` int(10) unsigned DEFAULT NULL,
                                   `ordersum` decimal(16,9) DEFAULT NULL,
                                   `pzhcurrencyid` int(10) unsigned DEFAULT NULL,
                                   `pzhsum` decimal(16,9) DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 凭证表 to 订单';


--
-- Dumping data for table `link_pzh_to_order`
--

LOCK TABLES `link_pzh_to_order` WRITE;
/*!40000 ALTER TABLE `link_pzh_to_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_pzh_to_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_pzh_to_sales`
--

DROP TABLE IF EXISTS `link_pzh_to_sales`;


CREATE TABLE `link_pzh_to_sales` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `salesid` int(10) unsigned DEFAULT NULL,
                                   `pzhid` int(10) unsigned DEFAULT NULL,
                                   `salescurrencyid` int(10) unsigned DEFAULT NULL,
                                   `salessum` decimal(16,9) DEFAULT NULL,
                                   `pzhcurrencyid` int(10) unsigned DEFAULT NULL,
                                   `pzhsum` decimal(16,9) DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 凭证表 to 对账单（回款）';


--
-- Dumping data for table `link_pzh_to_sales`
--

LOCK TABLES `link_pzh_to_sales` WRITE;
/*!40000 ALTER TABLE `link_pzh_to_sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_pzh_to_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_pzh_to_sales_trans`
--

DROP TABLE IF EXISTS `link_pzh_to_sales_trans`;


CREATE TABLE `link_pzh_to_sales_trans` (
                                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                         `sys_create_stuff` int(10) unsigned NOT NULL,
                                         `sys_create_date` datetime NOT NULL,
                                         `sys_modify_stuff` int(10) unsigned NOT NULL,
                                         `sys_modify_date` datetime NOT NULL,
                                         `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                         `sys_delete_date` datetime DEFAULT NULL,
                                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                         `salesid` int(10) unsigned DEFAULT NULL,
                                         `pzhid` int(10) unsigned DEFAULT NULL,
                                         `salescurrencyid` int(10) unsigned DEFAULT NULL,
                                         `salessum` decimal(16,9) DEFAULT NULL,
                                         `pzhcurrencyid` int(10) unsigned DEFAULT NULL,
                                         `pzhsum` decimal(16,9) DEFAULT NULL,
                                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 凭证表 to 对账单（转账）';


--
-- Dumping data for table `link_pzh_to_sales_trans`
--

LOCK TABLES `link_pzh_to_sales_trans` WRITE;
/*!40000 ALTER TABLE `link_pzh_to_sales_trans` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_pzh_to_sales_trans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_pzh_to_warehousing_fee`
--

DROP TABLE IF EXISTS `link_pzh_to_warehousing_fee`;


CREATE TABLE `link_pzh_to_warehousing_fee` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `warehousingfeeid` int(10) unsigned DEFAULT NULL,
                                             `pzhid` int(10) unsigned DEFAULT NULL,
                                             `warehousingfeecurrencyid` int(10) unsigned NOT NULL,
                                             `warehousingfeesum` decimal(16,9) DEFAULT NULL,
                                             `pzhcurrencyid` int(10) unsigned DEFAULT NULL,
                                             `pzhsum` decimal(16,9) DEFAULT NULL,
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 凭证表 to 入库单费用';


--
-- Dumping data for table `link_pzh_to_warehousing_fee`
--

LOCK TABLES `link_pzh_to_warehousing_fee` WRITE;
/*!40000 ALTER TABLE `link_pzh_to_warehousing_fee` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_pzh_to_warehousing_fee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_return_to_productstock`
--

DROP TABLE IF EXISTS `link_return_to_productstock`;


CREATE TABLE `link_return_to_productstock` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `productstockid` int(10) unsigned DEFAULT NULL,
                                             `dealprice` decimal(10,2) DEFAULT NULL,
                                             `getpoints` int(11) DEFAULT NULL,
                                             `memberid` int(10) unsigned DEFAULT NULL,
                                             `returnid` int(10) unsigned DEFAULT NULL,
                                             `salelinkid` int(10) unsigned DEFAULT NULL,
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 退货单 to 库存';


--
-- Dumping data for table `link_return_to_productstock`
--

LOCK TABLES `link_return_to_productstock` WRITE;
/*!40000 ALTER TABLE `link_return_to_productstock` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_return_to_productstock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_rule_to_operation`
--

DROP TABLE IF EXISTS `link_rule_to_operation`;


CREATE TABLE `link_rule_to_operation` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `ruleid` int(10) unsigned DEFAULT NULL,
                                        `operationid` int(10) unsigned DEFAULT NULL,
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        PRIMARY KEY (`id`),
                                        KEY `fk_reference_link_rule_to_operationto_rule_id` (`ruleid`),
                                        CONSTRAINT `fk_reference_link_rule_to_operationto_rule_id` FOREIGN KEY (`ruleid`) REFERENCES `tb_rule` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='职能功能连接表';


--
-- Dumping data for table `link_rule_to_operation`
--

LOCK TABLES `link_rule_to_operation` WRITE;
/*!40000 ALTER TABLE `link_rule_to_operation` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_rule_to_operation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_sales_to_productstock`
--

DROP TABLE IF EXISTS `link_sales_to_productstock`;


CREATE TABLE `link_sales_to_productstock` (
                                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                            `sys_create_stuff` int(10) unsigned NOT NULL,
                                            `sys_create_date` datetime NOT NULL,
                                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                                            `sys_modify_date` datetime NOT NULL,
                                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                            `sys_delete_date` datetime DEFAULT NULL,
                                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                            `productstockid` int(10) unsigned DEFAULT NULL,
                                            `dealprice` decimal(10,2) DEFAULT NULL,
                                            `pricelistid` int(10) unsigned DEFAULT NULL,
                                            `getpoints` decimal(10,2) DEFAULT NULL,
                                            `memberid` int(10) unsigned DEFAULT NULL,
                                            `salesid` int(10) unsigned DEFAULT NULL,
                                            `returnflag` varchar(1) DEFAULT NULL COMMENT '0-正常 1-已退货',
                                            `expresscomoany` varchar(1) DEFAULT NULL COMMENT '0-顺丰 1-德邦 2-京东',
                                            `expressno` varchar(50) DEFAULT NULL,
                                            `expressfee` decimal(16,9) DEFAULT NULL,
                                            `expressstatus` varchar(1) DEFAULT NULL COMMENT '0-未发货 1-已发货 2-缺货',
                                            `expressuser` int(10) unsigned DEFAULT NULL,
                                            `isbj` varchar(1) DEFAULT NULL,
                                            `currencyid` int(10) unsigned DEFAULT NULL,
                                            `sum` decimal(16,9) DEFAULT NULL,
                                            `porc` varchar(1) DEFAULT NULL COMMENT '0-预付 1-到付',
                                            `detailid` int(10) unsigned DEFAULT NULL,
                                            `bgj` decimal(16,9) DEFAULT NULL,
                                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售到库存之间的记录';


--
-- Dumping data for table `link_sales_to_productstock`
--

LOCK TABLES `link_sales_to_productstock` WRITE;
/*!40000 ALTER TABLE `link_sales_to_productstock` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_sales_to_productstock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_salespot_to_childbrand`
--

DROP TABLE IF EXISTS `link_salespot_to_childbrand`;


CREATE TABLE `link_salespot_to_childbrand` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `salespotid` int(10) unsigned DEFAULT NULL,
                                             `brandtypeid` int(10) unsigned DEFAULT NULL,
                                             `rate` decimal(19,6) DEFAULT NULL,
                                             `isrounded` varchar(1) DEFAULT NULL COMMENT '0-不取整 1-取整',
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口 扣点连接表';


--
-- Dumping data for table `link_salespot_to_childbrand`
--

LOCK TABLES `link_salespot_to_childbrand` WRITE;
/*!40000 ALTER TABLE `link_salespot_to_childbrand` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_salespot_to_childbrand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_sellspot_to_brand`
--

DROP TABLE IF EXISTS `link_sellspot_to_brand`;


CREATE TABLE `link_sellspot_to_brand` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `sellspotid` int(10) unsigned NOT NULL,
                                        `brandid` int(10) unsigned NOT NULL,
                                        `level` varchar(1) NOT NULL COMMENT 'a\r\n            b\r\n            c\r\n            d',
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口品牌连接表';


--
-- Dumping data for table `link_sellspot_to_brand`
--

LOCK TABLES `link_sellspot_to_brand` WRITE;
/*!40000 ALTER TABLE `link_sellspot_to_brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_sellspot_to_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_special_to_productstock`
--

DROP TABLE IF EXISTS `link_special_to_productstock`;


CREATE TABLE `link_special_to_productstock` (
                                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                              `sys_create_stuff` int(10) unsigned NOT NULL,
                                              `sys_create_date` datetime NOT NULL,
                                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                                              `sys_modify_date` datetime NOT NULL,
                                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                              `sys_delete_date` datetime DEFAULT NULL,
                                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                              `productstockid` int(10) unsigned DEFAULT NULL,
                                              `specialid` int(10) unsigned NOT NULL,
                                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='其他出入库表到库存之间的记录';


--
-- Dumping data for table `link_special_to_productstock`
--

LOCK TABLES `link_special_to_productstock` WRITE;
/*!40000 ALTER TABLE `link_special_to_productstock` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_special_to_productstock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_spot_warehouse`
--

DROP TABLE IF EXISTS `link_spot_warehouse`;


CREATE TABLE `link_spot_warehouse` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `spotid` int(10) unsigned DEFAULT NULL,
                                     `warehouseid` int(10) unsigned DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='仓库销售端口连接表';


--
-- Dumping data for table `link_spot_warehouse`
--

LOCK TABLES `link_spot_warehouse` WRITE;
/*!40000 ALTER TABLE `link_spot_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_spot_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_supplier_to_brand`
--

DROP TABLE IF EXISTS `link_supplier_to_brand`;


CREATE TABLE `link_supplier_to_brand` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `supplierid` int(10) unsigned NOT NULL,
                                        `brandid` int(10) unsigned NOT NULL,
                                        `level` varchar(1) NOT NULL COMMENT 'a\r\n            b\r\n            c\r\n            d',
                                        `decade` int(10) unsigned DEFAULT NULL,
                                        `markup` decimal(10,2) DEFAULT NULL,
                                        `currencyid` int(10) unsigned DEFAULT NULL,
                                        `sum` decimal(10,2) DEFAULT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='供货商品牌连接表';


--
-- Dumping data for table `link_supplier_to_brand`
--

LOCK TABLES `link_supplier_to_brand` WRITE;
/*!40000 ALTER TABLE `link_supplier_to_brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_supplier_to_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_user_to_labourcontactor`
--

DROP TABLE IF EXISTS `link_user_to_labourcontactor`;


CREATE TABLE `link_user_to_labourcontactor` (
                                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                              `sys_create_stuff` int(10) unsigned NOT NULL,
                                              `sys_create_date` datetime NOT NULL,
                                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                                              `sys_modify_date` datetime NOT NULL,
                                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                              `sys_delete_date` datetime DEFAULT NULL,
                                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                              `userid` int(10) unsigned DEFAULT NULL,
                                              `datefrom` datetime DEFAULT NULL,
                                              `datato` datetime DEFAULT NULL,
                                              `memo` text,
                                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='员工合同记录';


--
-- Dumping data for table `link_user_to_labourcontactor`
--

LOCK TABLES `link_user_to_labourcontactor` WRITE;
/*!40000 ALTER TABLE `link_user_to_labourcontactor` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_user_to_labourcontactor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_user_to_price`
--

DROP TABLE IF EXISTS `link_user_to_price`;


CREATE TABLE `link_user_to_price` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                    `sys_create_stuff` int(10) unsigned NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `userid` int(10) unsigned DEFAULT NULL,
                                    `priceid` int(10) unsigned DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='价格单用户连接表';


--
-- Dumping data for table `link_user_to_price`
--

LOCK TABLES `link_user_to_price` WRITE;
/*!40000 ALTER TABLE `link_user_to_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_user_to_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_user_to_reportset`
--

DROP TABLE IF EXISTS `link_user_to_reportset`;


CREATE TABLE `link_user_to_reportset` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `userid` int(10) unsigned DEFAULT NULL,
                                        `reportid` int(10) unsigned DEFAULT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表用户与报表样式';


--
-- Dumping data for table `link_user_to_reportset`
--

LOCK TABLES `link_user_to_reportset` WRITE;
/*!40000 ALTER TABLE `link_user_to_reportset` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_user_to_reportset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_user_to_salesport`
--

DROP TABLE IF EXISTS `link_user_to_salesport`;


CREATE TABLE `link_user_to_salesport` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `userid` int(10) unsigned DEFAULT NULL,
                                        `sportid` int(10) unsigned DEFAULT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口用户连接表';


--
-- Dumping data for table `link_user_to_salesport`
--

LOCK TABLES `link_user_to_salesport` WRITE;
/*!40000 ALTER TABLE `link_user_to_salesport` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_user_to_salesport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_user_to_supplier`
--

DROP TABLE IF EXISTS `link_user_to_supplier`;


CREATE TABLE `link_user_to_supplier` (
                                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                       `sys_create_stuff` int(10) unsigned NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) unsigned NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `userid` int(10) unsigned DEFAULT NULL,
                                       `supplierid` int(10) unsigned DEFAULT NULL,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表用户与结算单位';


--
-- Dumping data for table `link_user_to_supplier`
--

LOCK TABLES `link_user_to_supplier` WRITE;
/*!40000 ALTER TABLE `link_user_to_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_user_to_supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_user_to_warehouse`
--

DROP TABLE IF EXISTS `link_user_to_warehouse`;


CREATE TABLE `link_user_to_warehouse` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `userid` int(10) unsigned DEFAULT NULL,
                                        `warehouseid` int(10) unsigned DEFAULT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='仓库用户连接表';


--
-- Dumping data for table `link_user_to_warehouse`
--

LOCK TABLES `link_user_to_warehouse` WRITE;
/*!40000 ALTER TABLE `link_user_to_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_user_to_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_config`
--

DROP TABLE IF EXISTS `sys_config`;


CREATE TABLE `sys_config` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                            `sys_create_stuff` int(10) unsigned NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `code` varchar(100) DEFAULT NULL COMMENT 'ftp-ftp文件服务器ip地址，value值不以/结尾',
                            `value` varchar(100) DEFAULT NULL,
                            `comment` varchar(100) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统参数值备注 code-文件服务器地址,fileipvalue - 文件名';


--
-- Dumping data for table `sys_config`
--

LOCK TABLES `sys_config` WRITE;
/*!40000 ALTER TABLE `sys_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_selfcompany`
--

DROP TABLE IF EXISTS `sys_selfcompany`;


CREATE TABLE `sys_selfcompany` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `companyid` int(10) unsigned DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统参数值 本公司id\r\n';


--
-- Dumping data for table `sys_selfcompany`
--

LOCK TABLES `sys_selfcompany` WRITE;
/*!40000 ALTER TABLE `sys_selfcompany` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_selfcompany` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_card`
--

DROP TABLE IF EXISTS `tb_card`;


CREATE TABLE `tb_card` (
                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                         `sys_create_stuff` int(10) unsigned NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) unsigned NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                         `member_id` int(10) unsigned DEFAULT NULL,
                         `cardno` varchar(50) DEFAULT NULL,
                         `password` varchar(50) DEFAULT NULL,
                         `total` decimal(16,9) DEFAULT NULL,
                         `telno` varchar(20) DEFAULT NULL,
                         `status` varchar(1) DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='消费卡';


--
-- Dumping data for table `tb_card`
--

LOCK TABLES `tb_card` WRITE;
/*!40000 ALTER TABLE `tb_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_check`
--

DROP TABLE IF EXISTS `tb_check`;


CREATE TABLE `tb_check` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                          `sys_create_stuff` int(10) unsigned NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `checkno` varchar(10) DEFAULT NULL,
                          `warehouseid` int(10) unsigned DEFAULT NULL,
                          `checker` int(10) unsigned DEFAULT NULL,
                          `check_flag` tinyint(4) DEFAULT NULL COMMENT '0-生成预盘单\r\n            1-生成实盘单\r\n            2-生成差异单\r\n            3-差异出入库',
                          `check_date` datetime DEFAULT NULL,
                          `form_memo` varchar(500) DEFAULT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='盘点主表';


--
-- Dumping data for table `tb_check`
--

LOCK TABLES `tb_check` WRITE;
/*!40000 ALTER TABLE `tb_check` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_check` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_check_detail`
--

DROP TABLE IF EXISTS `tb_check_detail`;


CREATE TABLE `tb_check_detail` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `checkid` int(10) unsigned DEFAULT NULL,
                                 `productid` int(10) unsigned DEFAULT NULL,
                                 `sizeid` int(10) unsigned DEFAULT NULL,
                                 `count` int(11) DEFAULT NULL,
                                 `checktype` varchar(1) DEFAULT NULL COMMENT 's-实盘 y-预盘 c-差异',
                                 `form_memo` varchar(500) DEFAULT NULL,
                                 `excelasacode` varchar(50) DEFAULT NULL,
                                 `excelsize` varchar(50) DEFAULT NULL,
                                 `excelcount` varchar(50) DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='盘点明细表';


--
-- Dumping data for table `tb_check_detail`
--

LOCK TABLES `tb_check_detail` WRITE;
/*!40000 ALTER TABLE `tb_check_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_check_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_company`
--

DROP TABLE IF EXISTS `tb_company`;


CREATE TABLE `tb_company` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                            `sys_create_stuff` int(10) unsigned NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `name_cn` varchar(1000) DEFAULT NULL COMMENT '中文名称',
                            `name_en` varchar(1000) DEFAULT NULL COMMENT '英文名称',
                            `name_hk` varchar(1000) DEFAULT NULL COMMENT '粤语名称',
                            `name_fr` varchar(1000) DEFAULT NULL COMMENT '法语名称',
                            `name_it` varchar(1000) DEFAULT NULL COMMENT '意大利语名称',
                            `name_sp` varchar(1000) DEFAULT NULL COMMENT '西班牙语名称',
                            `name_de` varchar(1000) DEFAULT NULL COMMENT '德语名称',
                            `countryid` int(10) unsigned DEFAULT NULL COMMENT '国家id',
                            `memo` text COMMENT '备注说明',
                            PRIMARY KEY (`id`),
                            KEY `countryid` (`countryid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;


--
-- Dumping data for table `tb_company`
--

LOCK TABLES `tb_company` WRITE;
/*!40000 ALTER TABLE `tb_company` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_contactlist`
--

DROP TABLE IF EXISTS `tb_contactlist`;


CREATE TABLE `tb_contactlist` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `corderid` int(10) unsigned DEFAULT NULL,
                                `addname` int(10) unsigned DEFAULT NULL,
                                `creationdate` datetime DEFAULT NULL,
                                `shipper` varchar(50) DEFAULT NULL,
                                `receivingparty` varchar(50) DEFAULT NULL,
                                `brand` varchar(50) DEFAULT NULL,
                                `boxnumber` int(11) DEFAULT NULL,
                                `number` int(11) DEFAULT NULL,
                                `weight` decimal(16,9) DEFAULT NULL,
                                `volume` decimal(16,9) DEFAULT NULL,
                                `chargeweight` decimal(16,9) DEFAULT NULL,
                                `sendout` varchar(50) DEFAULT NULL,
                                `destination` varchar(50) DEFAULT NULL,
                                `answerid` int(10) unsigned DEFAULT NULL,
                                `answerdate` datetime DEFAULT NULL,
                                `dhlwayblll` varchar(50) DEFAULT NULL,
                                `subbillno` varchar(500) DEFAULT NULL,
                                `freightprice` decimal(16,9) DEFAULT NULL,
                                `freighttotal` decimal(16,9) DEFAULT NULL,
                                `notificationtime` datetime DEFAULT NULL,
                                `deliverytime` datetime DEFAULT NULL,
                                `arrivaltime` datetime DEFAULT NULL,
                                `billno` varchar(50) DEFAULT NULL,
                                `singletype` varchar(1) DEFAULT NULL COMMENT '0-dhl 1-空运',
                                `memos` text,
                                `flightno` varchar(50) DEFAULT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='发货联系单';


--
-- Dumping data for table `tb_contactlist`
--

LOCK TABLES `tb_contactlist` WRITE;
/*!40000 ALTER TABLE `tb_contactlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_contactlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_declaration`
--

DROP TABLE IF EXISTS `tb_declaration`;


CREATE TABLE `tb_declaration` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `no` varchar(50) DEFAULT NULL,
                                `memo` varchar(1000) DEFAULT NULL,
                                `date` datetime DEFAULT NULL,
                                `corderid` int(10) unsigned DEFAULT NULL,
                                `pricerate` decimal(16,9) DEFAULT NULL,
                                `taxrate` decimal(16,9) DEFAULT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='报关单主表';


--
-- Dumping data for table `tb_declaration`
--

LOCK TABLES `tb_declaration` WRITE;
/*!40000 ALTER TABLE `tb_declaration` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_declaration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_declaration_detail`
--

DROP TABLE IF EXISTS `tb_declaration_detail`;


CREATE TABLE `tb_declaration_detail` (
                                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                       `sys_create_stuff` int(10) unsigned NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) unsigned NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `declarationid` int(10) unsigned DEFAULT NULL,
                                       `productname` varchar(100) DEFAULT NULL,
                                       `currencyid` int(10) unsigned DEFAULT NULL,
                                       `price` decimal(16,9) DEFAULT NULL,
                                       `count` int(11) DEFAULT NULL,
                                       `rate` decimal(16,9) DEFAULT NULL,
                                       `cprice` decimal(16,9) DEFAULT NULL,
                                       `tax` decimal(16,9) DEFAULT NULL,
                                       `cost` decimal(16,9) DEFAULT NULL,
                                       `totaltax` decimal(16,9) DEFAULT NULL,
                                       `totalcost` decimal(16,9) DEFAULT NULL,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='报关单明细表';


--
-- Dumping data for table `tb_declaration_detail`
--

LOCK TABLES `tb_declaration_detail` WRITE;
/*!40000 ALTER TABLE `tb_declaration_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_declaration_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_department`
--

DROP TABLE IF EXISTS `tb_department`;


CREATE TABLE `tb_department` (
                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                               `sys_create_stuff` int(10) unsigned NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `name` varchar(100) DEFAULT NULL,
                               `memo` varchar(1000) DEFAULT NULL,
                               `companyid` int(10) unsigned NOT NULL COMMENT '公司id',
                               `priceid` int(10) unsigned DEFAULT NULL COMMENT '此价格id可以是基础价格id，也可以是销售端口id',
                               `spotid` int(10) unsigned DEFAULT NULL,
                               `up_dp_id` int(10) unsigned DEFAULT '0' COMMENT '上级部门ID',
                               `checkingflag` varchar(1) DEFAULT NULL,
                               PRIMARY KEY (`id`),
                               KEY `companyid` (`companyid`),
                               KEY `up_dp_id` (`up_dp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='部门表';


--
-- Dumping data for table `tb_department`
--

LOCK TABLES `tb_department` WRITE;
/*!40000 ALTER TABLE `tb_department` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_discount_card`
--

DROP TABLE IF EXISTS `tb_discount_card`;


CREATE TABLE `tb_discount_card` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `number` varchar(50) DEFAULT NULL,
                                  `amount` decimal(16,9) DEFAULT NULL,
                                  `is_used` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                                  `is_actived` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                                  `activedid` int(10) unsigned DEFAULT NULL,
                                  `usedid` int(10) unsigned DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='优惠卷';


--
-- Dumping data for table `tb_discount_card`
--

LOCK TABLES `tb_discount_card` WRITE;
/*!40000 ALTER TABLE `tb_discount_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_discount_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_distribute`
--

DROP TABLE IF EXISTS `tb_distribute`;


CREATE TABLE `tb_distribute` (
                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                               `sys_create_stuff` int(10) unsigned NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `distributeno` varchar(50) DEFAULT NULL,
                               `owner` int(10) unsigned DEFAULT NULL,
                               `out_id` int(10) unsigned DEFAULT NULL,
                               `in_id` int(10) unsigned DEFAULT NULL,
                               `op_id` int(10) unsigned DEFAULT NULL,
                               `op_date` datetime DEFAULT NULL,
                               `memo` text,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='分货单主表';


--
-- Dumping data for table `tb_distribute`
--

LOCK TABLES `tb_distribute` WRITE;
/*!40000 ALTER TABLE `tb_distribute` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_distribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_distributecode`
--

DROP TABLE IF EXISTS `tb_distributecode`;


CREATE TABLE `tb_distributecode` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `year` varchar(5) DEFAULT NULL,
                                   `code` varchar(10) DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='分货单号表';


--
-- Dumping data for table `tb_distributecode`
--

LOCK TABLES `tb_distributecode` WRITE;
/*!40000 ALTER TABLE `tb_distributecode` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_distributecode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_express`
--

DROP TABLE IF EXISTS `tb_express`;


CREATE TABLE `tb_express` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                            `sys_create_stuff` int(10) unsigned NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `expresscompany` varchar(1) DEFAULT NULL COMMENT '0-顺丰 1-德邦 2-京东 3-其他 4-圆通',
                            `expressno` varchar(50) DEFAULT NULL,
                            `expressfee` decimal(16,9) DEFAULT NULL,
                            `memo` text,
                            `creator` int(10) unsigned NOT NULL,
                            `departmentid` int(10) unsigned DEFAULT NULL,
                            `type` varchar(1) DEFAULT NULL COMMENT '0-个人，1-部门，2-事业部，3-公司',
                            `f_person` varchar(50) DEFAULT NULL,
                            `f_telno` varchar(50) DEFAULT NULL,
                            `f_address` varchar(500) DEFAULT NULL,
                            `s_person` varchar(50) DEFAULT NULL,
                            `s_telno` varchar(50) DEFAULT NULL,
                            `s_address` varchar(500) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='单快递信息';


--
-- Dumping data for table `tb_express`
--

LOCK TABLES `tb_express` WRITE;
/*!40000 ALTER TABLE `tb_express` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_express` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_fee`
--

DROP TABLE IF EXISTS `tb_fee`;


CREATE TABLE `tb_fee` (
                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                        `sys_create_stuff` int(10) unsigned NOT NULL,
                        `sys_create_date` datetime NOT NULL,
                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                        `sys_modify_date` datetime NOT NULL,
                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                        `sys_delete_date` datetime DEFAULT NULL,
                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                        `applyno` varchar(50) DEFAULT NULL,
                        `applydate` datetime DEFAULT NULL,
                        `applystaff` int(10) unsigned DEFAULT NULL,
                        `staff` int(10) unsigned DEFAULT NULL,
                        `departmemtid` int(10) unsigned DEFAULT NULL,
                        `departmemtid2` int(10) unsigned DEFAULT NULL,
                        `leadercheckstatus` varchar(1) DEFAULT NULL COMMENT '0-未审核 1-审核通过 2-驳回',
                        `leaderid` int(10) unsigned DEFAULT NULL,
                        `leadercheckdate` datetime DEFAULT NULL,
                        `financecheckstatus` varchar(1) DEFAULT NULL COMMENT '0-未审核 1-审核通过 2-驳回',
                        `financeid` int(10) unsigned DEFAULT NULL,
                        `financecheckdate` datetime DEFAULT NULL,
                        `memo` varchar(500) DEFAULT NULL,
                        `pzhstatus` varchar(1) DEFAULT NULL,
                        `pzhid` int(10) unsigned DEFAULT NULL,
                        `managercheckstatus` varchar(1) DEFAULT NULL COMMENT '0-未审核 1-审核通过 2-驳回',
                        `managerid` int(10) unsigned DEFAULT NULL,
                        `managercheckdate` datetime DEFAULT NULL,
                        `type` varchar(1) DEFAULT NULL COMMENT '0-个人，1-部门，2-事业部，3-公司',
                        `reason` text,
                        `sheetid` int(10) unsigned DEFAULT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='费用申请';


--
-- Dumping data for table `tb_fee`
--

LOCK TABLES `tb_fee` WRITE;
/*!40000 ALTER TABLE `tb_fee` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_fee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_fee_detail`
--

DROP TABLE IF EXISTS `tb_fee_detail`;


CREATE TABLE `tb_fee_detail` (
                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                               `sys_create_stuff` int(10) unsigned NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `tbfeeid` int(10) unsigned DEFAULT NULL,
                               `feeid` int(10) unsigned DEFAULT NULL,
                               `sfcompanyid` int(10) unsigned DEFAULT NULL,
                               `number` decimal(16,9) DEFAULT NULL,
                               `feeprice` decimal(16,9) DEFAULT NULL,
                               `rate` decimal(16,9) DEFAULT NULL,
                               `feecurrencyid` int(10) unsigned DEFAULT NULL,
                               `feesum` decimal(16,9) DEFAULT NULL,
                               `memo` varchar(500) DEFAULT NULL,
                               `invoiceno` varchar(500) DEFAULT NULL,
                               `paydate` datetime DEFAULT NULL,
                               `sorf` varchar(1) DEFAULT NULL,
                               `ischeck` varchar(1) DEFAULT NULL COMMENT '0-未对账，1-已对账',
                               `isreturn` varchar(1) DEFAULT NULL COMMENT '0-未入账，1-已入账',
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='费用申请明细表';


--
-- Dumping data for table `tb_fee_detail`
--

LOCK TABLES `tb_fee_detail` WRITE;
/*!40000 ALTER TABLE `tb_fee_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_fee_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_feecode`
--

DROP TABLE IF EXISTS `tb_feecode`;


CREATE TABLE `tb_feecode` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                            `sys_create_stuff` int(10) unsigned NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `year` varchar(5) DEFAULT NULL,
                            `code` varchar(10) DEFAULT NULL,
                            `month` varchar(5) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='费用申请号表';


--
-- Dumping data for table `tb_feecode`
--

LOCK TABLES `tb_feecode` WRITE;
/*!40000 ALTER TABLE `tb_feecode` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_feecode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_group`
--

DROP TABLE IF EXISTS `tb_group`;


CREATE TABLE `tb_group` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                          `group_name` varchar(50) DEFAULT NULL,
                          `group_memo` varchar(500) DEFAULT NULL,
                          `companyid` int(10) unsigned DEFAULT NULL,
                          `sys_create_stuff` int(10) unsigned NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='组信息';


--
-- Dumping data for table `tb_group`
--

LOCK TABLES `tb_group` WRITE;
/*!40000 ALTER TABLE `tb_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_inve_actual`
--

DROP TABLE IF EXISTS `tb_inve_actual`;


CREATE TABLE `tb_inve_actual` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `form_num` varchar(30) DEFAULT NULL,
                                `checker` int(10) unsigned DEFAULT NULL,
                                `check_flag` tinyint(4) DEFAULT NULL,
                                `check_date` datetime DEFAULT NULL,
                                `form_memo` varchar(500) DEFAULT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tb_inve_actual';


--
-- Dumping data for table `tb_inve_actual`
--

LOCK TABLES `tb_inve_actual` WRITE;
/*!40000 ALTER TABLE `tb_inve_actual` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_inve_actual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_inve_actual_dtl`
--

DROP TABLE IF EXISTS `tb_inve_actual_dtl`;


CREATE TABLE `tb_inve_actual_dtl` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                    `sys_create_stuff` int(10) unsigned NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `curr_quantity` bigint(20) DEFAULT NULL,
                                    `real_quantity` bigint(20) DEFAULT NULL,
                                    `profit_loss` bigint(20) DEFAULT NULL,
                                    `product_id` int(10) unsigned DEFAULT NULL,
                                    `size_id` int(10) unsigned DEFAULT NULL,
                                    `inve_actual_id` int(10) unsigned DEFAULT NULL,
                                    `stock_id` int(10) unsigned DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tb_inve_actual_dtl';


--
-- Dumping data for table `tb_inve_actual_dtl`
--

LOCK TABLES `tb_inve_actual_dtl` WRITE;
/*!40000 ALTER TABLE `tb_inve_actual_dtl` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_inve_actual_dtl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_inve_prep`
--

DROP TABLE IF EXISTS `tb_inve_prep`;


CREATE TABLE `tb_inve_prep` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `form_num` varchar(30) DEFAULT NULL,
                              `checker` int(10) unsigned DEFAULT NULL,
                              `check_flag` tinyint(4) DEFAULT NULL,
                              `check_date` datetime DEFAULT NULL,
                              `form_memo` varchar(500) DEFAULT NULL,
                              `inve_actual_id` int(10) unsigned DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tb_inve_prep';


--
-- Dumping data for table `tb_inve_prep`
--

LOCK TABLES `tb_inve_prep` WRITE;
/*!40000 ALTER TABLE `tb_inve_prep` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_inve_prep` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_inve_prep_dtl`
--

DROP TABLE IF EXISTS `tb_inve_prep_dtl`;


CREATE TABLE `tb_inve_prep_dtl` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `product_id` int(10) unsigned DEFAULT NULL,
                                  `size_id` int(10) unsigned DEFAULT NULL,
                                  `curr_quantity` bigint(20) DEFAULT NULL,
                                  `inve_prep_id` int(10) unsigned DEFAULT NULL,
                                  `stock_id` int(10) unsigned DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tb_inve_prep_dtl';


--
-- Dumping data for table `tb_inve_prep_dtl`
--

LOCK TABLES `tb_inve_prep_dtl` WRITE;
/*!40000 ALTER TABLE `tb_inve_prep_dtl` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_inve_prep_dtl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_kp`
--

DROP TABLE IF EXISTS `tb_kp`;


CREATE TABLE `tb_kp` (
                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                       `sys_create_stuff` int(10) unsigned NOT NULL,
                       `sys_create_date` datetime NOT NULL,
                       `sys_modify_stuff` int(10) unsigned NOT NULL,
                       `sys_modify_date` datetime NOT NULL,
                       `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                       `sys_delete_date` datetime DEFAULT NULL,
                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                       `invoiceno` varchar(50) DEFAULT NULL,
                       `kpdate` datetime DEFAULT NULL,
                       `sum` decimal(16,9) DEFAULT NULL,
                       `sfcompanyid` int(10) unsigned DEFAULT NULL,
                       `header` text,
                       `memo` text,
                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='开票信息';


--
-- Dumping data for table `tb_kp`
--

LOCK TABLES `tb_kp` WRITE;
/*!40000 ALTER TABLE `tb_kp` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_kp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_member`
--

DROP TABLE IF EXISTS `tb_member`;


CREATE TABLE `tb_member` (
                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                           `sys_create_stuff` int(10) unsigned NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                           `name` varchar(50) DEFAULT NULL,
                           `code` varchar(20) DEFAULT NULL,
                           `form` varchar(1) DEFAULT NULL COMMENT 'f-female m-male',
                           `birth` date DEFAULT NULL,
                           `phoneno` varchar(50) DEFAULT NULL,
                           `email` varchar(50) DEFAULT NULL,
                           `address` varchar(50) DEFAULT NULL,
                           `zipcode` varchar(10) DEFAULT NULL,
                           `qq` varchar(50) DEFAULT NULL,
                           `wechat` varchar(50) DEFAULT NULL,
                           `microblog` varchar(50) DEFAULT NULL,
                           `totalscore` bigint(20) DEFAULT NULL,
                           `score` bigint(20) DEFAULT NULL,
                           `membercard` varchar(50) DEFAULT NULL,
                           `memberlevelid` int(10) unsigned DEFAULT NULL,
                           `membertype` varchar(1) DEFAULT NULL COMMENT '0-个人会员 1-公司会员',
                           `membercardid` int(10) unsigned DEFAULT NULL,
                           `creatorid` int(10) unsigned DEFAULT NULL,
                           `sourceid` int(10) unsigned DEFAULT NULL,
                           `idno` varchar(50) DEFAULT NULL,
                           `taxno` varchar(50) DEFAULT NULL,
                           `contactor` varchar(50) DEFAULT NULL,
                           `asawebno` varchar(50) DEFAULT NULL,
                           `openid` varchar(50) DEFAULT NULL,
                           `password` varchar(10) DEFAULT NULL,
                           `invitesum` bigint(20) DEFAULT NULL,
                           `invitetotal` bigint(20) DEFAULT NULL,
                           `invoteuser` int(10) unsigned DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员表';


--
-- Dumping data for table `tb_member`
--

LOCK TABLES `tb_member` WRITE;
/*!40000 ALTER TABLE `tb_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_member_address`
--

DROP TABLE IF EXISTS `tb_member_address`;


CREATE TABLE `tb_member_address` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `member_id` int(10) unsigned DEFAULT NULL,
                                   `name` varchar(50) DEFAULT NULL,
                                   `idno` varchar(50) DEFAULT NULL,
                                   `tel` varchar(50) DEFAULT NULL,
                                   `zipcode` varchar(10) DEFAULT NULL,
                                   `address` varchar(1000) DEFAULT NULL,
                                   `province` varchar(20) DEFAULT NULL,
                                   `city` varchar(20) DEFAULT NULL,
                                   `is_default` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员地址信息';


--
-- Dumping data for table `tb_member_address`
--

LOCK TABLES `tb_member_address` WRITE;
/*!40000 ALTER TABLE `tb_member_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_member_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_member_bank`
--

DROP TABLE IF EXISTS `tb_member_bank`;


CREATE TABLE `tb_member_bank` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `member_id` int(10) unsigned DEFAULT NULL,
                                `account_name` varchar(1000) DEFAULT NULL,
                                `account` varchar(1000) DEFAULT NULL,
                                `currency_id` int(10) unsigned DEFAULT NULL,
                                `bank_name` varchar(1000) DEFAULT NULL,
                                `bank_address` varchar(1000) DEFAULT NULL,
                                `is_default` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员银行';


--
-- Dumping data for table `tb_member_bank`
--

LOCK TABLES `tb_member_bank` WRITE;
/*!40000 ALTER TABLE `tb_member_bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_member_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_member_card`
--

DROP TABLE IF EXISTS `tb_member_card`;


CREATE TABLE `tb_member_card` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `number` varchar(50) DEFAULT NULL,
                                `is_used` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员卡号';


--
-- Dumping data for table `tb_member_card`
--

LOCK TABLES `tb_member_card` WRITE;
/*!40000 ALTER TABLE `tb_member_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_member_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_member_card_history`
--

DROP TABLE IF EXISTS `tb_member_card_history`;


CREATE TABLE `tb_member_card_history` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `member_id` int(10) unsigned DEFAULT NULL,
                                        `type` varchar(1) DEFAULT NULL COMMENT '0-充值 1-消费 ',
                                        `sum` decimal(19,6) DEFAULT NULL,
                                        `opdate` datetime DEFAULT NULL,
                                        `totalsum` decimal(19,6) DEFAULT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='储值卡操作记录';


--
-- Dumping data for table `tb_member_card_history`
--

LOCK TABLES `tb_member_card_history` WRITE;
/*!40000 ALTER TABLE `tb_member_card_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_member_card_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_member_contactor`
--

DROP TABLE IF EXISTS `tb_member_contactor`;


CREATE TABLE `tb_member_contactor` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `member_id` int(10) unsigned DEFAULT NULL,
                                     `name` char(10) DEFAULT NULL,
                                     `form` varchar(1) DEFAULT NULL COMMENT 'f-female\r\n            m-male',
                                     `birth` date DEFAULT NULL,
                                     `tel` varchar(50) DEFAULT NULL,
                                     `phoneno` varchar(50) DEFAULT NULL,
                                     `email` varchar(50) DEFAULT NULL,
                                     `address` varchar(50) DEFAULT NULL,
                                     `zipcode` varchar(10) DEFAULT NULL,
                                     `qq` varchar(50) DEFAULT NULL,
                                     `wechat` varchar(50) DEFAULT NULL,
                                     `microblog` varchar(50) DEFAULT NULL,
                                     `memo` varchar(50) DEFAULT NULL,
                                     `is_default` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员（公司）联系人';


--
-- Dumping data for table `tb_member_contactor`
--

LOCK TABLES `tb_member_contactor` WRITE;
/*!40000 ALTER TABLE `tb_member_contactor` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_member_contactor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_member_header`
--

DROP TABLE IF EXISTS `tb_member_header`;


CREATE TABLE `tb_member_header` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `member_id` int(10) unsigned DEFAULT NULL,
                                  `chinese_header` varchar(1000) DEFAULT NULL,
                                  `english_header` varchar(1000) DEFAULT NULL,
                                  `is_default` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员发票抬头';


--
-- Dumping data for table `tb_member_header`
--

LOCK TABLES `tb_member_header` WRITE;
/*!40000 ALTER TABLE `tb_member_header` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_member_header` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_member_preference`
--

DROP TABLE IF EXISTS `tb_member_preference`;


CREATE TABLE `tb_member_preference` (
                                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                      `sys_create_stuff` int(10) unsigned NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) unsigned NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `member_id` int(10) unsigned DEFAULT NULL,
                                      `brand_id` int(10) unsigned DEFAULT NULL,
                                      `brandgroup_id` int(10) unsigned DEFAULT NULL,
                                      `childbrandgroup_id` int(10) unsigned DEFAULT NULL,
                                      `sizetop_id` int(10) unsigned DEFAULT NULL,
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员偏好';


--
-- Dumping data for table `tb_member_preference`
--

LOCK TABLES `tb_member_preference` WRITE;
/*!40000 ALTER TABLE `tb_member_preference` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_member_preference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_member_preference_size`
--

DROP TABLE IF EXISTS `tb_member_preference_size`;


CREATE TABLE `tb_member_preference_size` (
                                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                           `sys_create_stuff` int(10) unsigned NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `memberpreference_id` int(10) unsigned DEFAULT NULL,
                                           `sizecontent_id` int(10) unsigned DEFAULT NULL,
                                           `sizetop_id` int(10) unsigned DEFAULT NULL,
                                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员偏好尺码表';


--
-- Dumping data for table `tb_member_preference_size`
--

LOCK TABLES `tb_member_preference_size` WRITE;
/*!40000 ALTER TABLE `tb_member_preference_size` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_member_preference_size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_member_preordination`
--

DROP TABLE IF EXISTS `tb_member_preordination`;


CREATE TABLE `tb_member_preordination` (
                                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                         `sys_create_stuff` int(10) unsigned NOT NULL,
                                         `sys_create_date` datetime NOT NULL,
                                         `sys_modify_stuff` int(10) unsigned NOT NULL,
                                         `sys_modify_date` datetime NOT NULL,
                                         `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                         `sys_delete_date` datetime DEFAULT NULL,
                                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                         `orderdate` datetime DEFAULT NULL,
                                         `memberid` int(10) unsigned DEFAULT NULL,
                                         `productid` int(10) unsigned DEFAULT NULL,
                                         `sizeid` int(10) unsigned DEFAULT NULL,
                                         `memo` text,
                                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预定信息';


--
-- Dumping data for table `tb_member_preordination`
--

LOCK TABLES `tb_member_preordination` WRITE;
/*!40000 ALTER TABLE `tb_member_preordination` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_member_preordination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_permission`
--

DROP TABLE IF EXISTS `tb_permission`;


CREATE TABLE `tb_permission` (
                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                               `sys_create_stuff` int(10) unsigned NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属权限id，默认0为顶级权限',
                               `name` varchar(100) NOT NULL DEFAULT '' COMMENT '权限名称',
                               `memo_cn` text COMMENT '中文描述',
                               `memo_en` text COMMENT '英文描述',
                               `memo_hk` text COMMENT '粤语描述',
                               `memo_fr` text COMMENT '法语描述',
                               `memo_it` text COMMENT '意大利语描述',
                               `memo_sp` text COMMENT '西班牙语描述',
                               `memo_de` text COMMENT '德语描述',
                               `is_only_superadmin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为专属超级管理员权限，0-不是 1-是',
                               PRIMARY KEY (`id`),
                               UNIQUE KEY `permission_name` (`name`),
                               KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4;


--
-- Dumping data for table `tb_permission`
--

LOCK TABLES `tb_permission` WRITE;
/*!40000 ALTER TABLE `tb_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_permission_group`
--

DROP TABLE IF EXISTS `tb_permission_group`;


CREATE TABLE `tb_permission_group` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `groupid` int(10) unsigned NOT NULL COMMENT '组id',
                                     `permissionid` int(10) unsigned NOT NULL COMMENT '权限id',
                                     `companyid` int(10) unsigned DEFAULT NULL COMMENT '公司id',
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Dumping data for table `tb_permission_group`
--

LOCK TABLES `tb_permission_group` WRITE;
/*!40000 ALTER TABLE `tb_permission_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_permission_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_permission_module`
--

DROP TABLE IF EXISTS `tb_permission_module`;


CREATE TABLE `tb_permission_module` (
                                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                      `sys_create_stuff` int(10) unsigned NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) unsigned NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `permissionid` int(10) unsigned DEFAULT NULL COMMENT '权限id',
                                      `module` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '模块名称',
                                      `controller` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '控制器名称',
                                      `action` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '方法名称',
                                      PRIMARY KEY (`id`),
                                      UNIQUE KEY `tb_permission_module_permissionid_module_controller_action` (`permissionid`,`module`,`controller`,`action`),
                                      KEY `permissionid` (`permissionid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Dumping data for table `tb_permission_module`
--

LOCK TABLES `tb_permission_module` WRITE;
/*!40000 ALTER TABLE `tb_permission_module` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_permission_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_picture`
--

DROP TABLE IF EXISTS `tb_picture`;


CREATE TABLE `tb_picture` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                            `sys_create_stuff` int(10) unsigned NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `picturename` varchar(20) DEFAULT NULL,
                            `picturestream` varchar(200) DEFAULT NULL,
                            `picturetype` char(10) DEFAULT NULL,
                            `picturegroup` varchar(50) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='图片表';


--
-- Dumping data for table `tb_picture`
--

LOCK TABLES `tb_picture` WRITE;
/*!40000 ALTER TABLE `tb_picture` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pre_requisition`
--

DROP TABLE IF EXISTS `tb_pre_requisition`;


CREATE TABLE `tb_pre_requisition` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                    `sys_create_stuff` int(10) unsigned NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `productstock_id` int(10) unsigned DEFAULT NULL,
                                    `stockid` int(10) unsigned DEFAULT NULL,
                                    `tostockid` int(10) unsigned DEFAULT NULL,
                                    `opid` int(10) unsigned DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预调拨单明细';


--
-- Dumping data for table `tb_pre_requisition`
--

LOCK TABLES `tb_pre_requisition` WRITE;
/*!40000 ALTER TABLE `tb_pre_requisition` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_pre_requisition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_product`
--

DROP TABLE IF EXISTS `tb_product`;


CREATE TABLE `tb_product` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                            `sys_create_stuff` int(10) unsigned NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(4) NOT NULL COMMENT '0-未删除 1-已删除',
                            `asacode` varchar(100) DEFAULT NULL,
                            `productname` varchar(50) DEFAULT NULL,
                            `wordcode_1` varchar(50) DEFAULT NULL,
                            `wordcode_2` varchar(50) DEFAULT NULL,
                            `wordcode_3` varchar(50) DEFAULT NULL,
                            `wordcode_4` varchar(50) DEFAULT NULL,
                            `wordprice` decimal(16,9) DEFAULT NULL COMMENT '国际零售价',
                            `wordpricecurrency` varchar(10) DEFAULT NULL COMMENT '国际零售价币种',
                            `gender` varchar(100) DEFAULT NULL COMMENT '0-女式 1-男士 2-中性',
                            `brandid` int(10) unsigned DEFAULT NULL COMMENT '品牌',
                            `brandgroupid` int(10) unsigned DEFAULT NULL COMMENT '品类',
                            `childbrand` int(10) unsigned DEFAULT NULL,
                            `brandcolor` varchar(100) DEFAULT NULL COMMENT '品牌色板',
                            `brandcolor2` int(10) unsigned DEFAULT NULL,
                            `picture2` varchar(100) DEFAULT NULL COMMENT '副图',
                            `picture` varchar(100) DEFAULT NULL COMMENT '主图',
                            `closeway` int(10) unsigned DEFAULT NULL,
                            `ageseason` varchar(200) DEFAULT NULL COMMENT '年代',
                            `productsize` int(10) unsigned DEFAULT NULL,
                            `countries` varchar(100) DEFAULT NULL COMMENT '产地',
                            `security` int(10) unsigned DEFAULT NULL,
                            `execution` int(10) unsigned DEFAULT NULL,
                            `material` int(10) unsigned DEFAULT NULL,
                            `productparst` int(10) unsigned DEFAULT NULL,
                            `occasion` varchar(200) DEFAULT NULL COMMENT '场合风格',
                            `producttemplate` int(10) unsigned DEFAULT NULL,
                            `materialstatus` int(10) unsigned DEFAULT NULL,
                            `season` varchar(20) DEFAULT NULL,
                            `oldasacode` varchar(50) DEFAULT NULL,
                            `officialwebsite` varchar(500) DEFAULT NULL,
                            `oldbarcode` varchar(500) DEFAULT NULL,
                            `laststoragedate` varchar(19) DEFAULT NULL,
                            `aliases_1` varchar(50) DEFAULT NULL COMMENT '商品系列',
                            `aliases_2` varchar(50) DEFAULT NULL COMMENT '商品子系列',
                            `aliases` varchar(50) DEFAULT NULL,
                            `series_id` int(10) unsigned DEFAULT NULL,
                            `series2_id` int(10) unsigned DEFAULT NULL,
                            `ulnarinch` varchar(50) DEFAULT NULL,
                            `vat` decimal(16,9) DEFAULT NULL,
                            `tariff` decimal(16,9) DEFAULT NULL,
                            `basecurrency` varchar(10) DEFAULT NULL,
                            `baseprice` decimal(16,9) DEFAULT NULL,
                            `entrymonth` varchar(5) DEFAULT NULL,
                            `factoryprice` decimal(16,9) DEFAULT NULL COMMENT '出厂价',
                            `factorypricecurrency` varchar(10) DEFAULT NULL COMMENT '出厂价币种',
                            `realprice` decimal(16,9) DEFAULT NULL COMMENT '成交价格',
                            `retailpricecurrency` varchar(10) DEFAULT NULL COMMENT '成交价格币种',
                            `dutyparagraph` varchar(50) DEFAULT NULL,
                            `orderprice` decimal(16,9) DEFAULT NULL COMMENT '合同价格',
                            `orderpricecurrency` varchar(10) DEFAULT NULL COMMENT '合同价格币种',
                            `retailprice` decimal(16,9) DEFAULT NULL COMMENT '可以填写的成本，入库时同步修改',
                            `groupid` int(10) unsigned DEFAULT NULL COMMENT '同款不同色',
                            `iskj` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                            `bxzs` varchar(1) DEFAULT NULL COMMENT '0-修身1-适中2-宽松',
                            `hbzs` varchar(1) DEFAULT NULL COMMENT '0-薄1-适中2-厚',
                            `rrzs` varchar(1) DEFAULT NULL COMMENT '0-柔软1-适中2-偏硬',
                            `tlzs` varchar(1) DEFAULT NULL COMMENT '0-无弹1-适中2-弹力',
                            `salemethodid` int(10) unsigned DEFAULT NULL,
                            `nationalprice` decimal(16,9) DEFAULT NULL,
                            `taxrate` decimal(16,9) DEFAULT NULL,
                            `isjh` varchar(1) DEFAULT NULL COMMENT '0-否1-是',
                            `inlenth` varchar(50) DEFAULT NULL,
                            `jdname` varchar(200) DEFAULT NULL,
                            `winterproofing` int(10) DEFAULT NULL,
                            `isfj` varchar(1) DEFAULT NULL COMMENT '0-否 1-法检',
                            `discount` decimal(10,2) DEFAULT NULL,
                            `ulnarinch_memo` varchar(100) DEFAULT NULL COMMENT '尺寸备注',
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品表';


--
-- Dumping data for table `tb_product`
--

LOCK TABLES `tb_product` WRITE;
/*!40000 ALTER TABLE `tb_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_product_price`
--

DROP TABLE IF EXISTS `tb_product_price`;


CREATE TABLE `tb_product_price` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `productid` int(10) unsigned DEFAULT NULL,
                                  `decadeid` int(10) unsigned DEFAULT NULL,
                                  `retailpricecurrency` int(10) unsigned DEFAULT NULL,
                                  `realprice` decimal(16,9) DEFAULT NULL,
                                  `factorypricecurrency` int(10) unsigned DEFAULT NULL,
                                  `factoryprice` decimal(16,9) DEFAULT NULL,
                                  `basecurrency` int(10) unsigned DEFAULT NULL,
                                  `baseprice` decimal(16,9) DEFAULT NULL,
                                  `nationalprice` decimal(16,9) DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='成交价，参考价，基准零售价，国内零售价 历史记录';


--
-- Dumping data for table `tb_product_price`
--

LOCK TABLES `tb_product_price` WRITE;
/*!40000 ALTER TABLE `tb_product_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_product_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_productstock`
--

DROP TABLE IF EXISTS `tb_productstock`;


CREATE TABLE `tb_productstock` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `productid` int(10) unsigned DEFAULT NULL,
                                 `sizeid` int(10) unsigned DEFAULT NULL,
                                 `storagetime` datetime DEFAULT NULL,
                                 `storagestaff` int(10) unsigned DEFAULT NULL,
                                 `stockid` int(10) unsigned DEFAULT NULL,
                                 `productno` bigint(20) DEFAULT NULL,
                                 `selltime` datetime DEFAULT NULL,
                                 `sellprice` decimal(16,9) DEFAULT NULL,
                                 `cost` decimal(16,9) DEFAULT NULL,
                                 `selltype` int(11) DEFAULT NULL COMMENT '0-待销\r\n            1-已售出\r\n            2-预售\r\n            3-在途\r\n            4-调拨锁定',
                                 `dealprice` decimal(16,9) DEFAULT NULL,
                                 `qualitystatus` int(11) DEFAULT NULL COMMENT '0-合格品\r\n            1-残次品\r\n            2-库存差异',
                                 `sellstaff` int(10) unsigned DEFAULT NULL,
                                 `is_print` varchar(1) DEFAULT NULL COMMENT '0-未打印\r\n            1-条形码打印\r\n            2-二维码打印',
                                 `corderid` int(10) unsigned DEFAULT NULL,
                                 `currencyid` int(10) unsigned DEFAULT NULL,
                                 `memo` varchar(500) DEFAULT NULL,
                                 `cpdate` datetime DEFAULT NULL,
                                 `cp_op` int(10) unsigned DEFAULT NULL,
                                 `intime` datetime DEFAULT NULL,
                                 `property` varchar(1) DEFAULT NULL COMMENT '0-自采 1-代销',
                                 `kpflag` varchar(1) DEFAULT NULL COMMENT '0-未开票 1-已开票',
                                 `decadeid` int(10) unsigned NOT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='库存';


--
-- Dumping data for table `tb_productstock`
--

LOCK TABLES `tb_productstock` WRITE;
/*!40000 ALTER TABLE `tb_productstock` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_productstock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_productstock_snapshot`
--

DROP TABLE IF EXISTS `tb_productstock_snapshot`;


CREATE TABLE `tb_productstock_snapshot` (
                                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                          `sys_create_stuff` int(10) unsigned NOT NULL,
                                          `sys_create_date` datetime NOT NULL,
                                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                                          `sys_modify_date` datetime NOT NULL,
                                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                          `sys_delete_date` datetime DEFAULT NULL,
                                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                          `snapdate` datetime DEFAULT NULL,
                                          `productstockid` int(10) unsigned DEFAULT NULL,
                                          `productid` int(10) unsigned DEFAULT NULL,
                                          `sizeid` int(10) unsigned DEFAULT NULL,
                                          `stockid` int(10) unsigned DEFAULT NULL,
                                          `productno` bigint(20) DEFAULT NULL,
                                          `selltime` datetime DEFAULT NULL,
                                          `sellprice` decimal(16,9) DEFAULT NULL,
                                          `cost` decimal(16,9) DEFAULT NULL,
                                          `selltype` int(11) DEFAULT NULL COMMENT '0-待销\r\n            1-已售出\r\n            2-预定\r\n            3-在途\r\n            4-调拨锁定',
                                          `dealprice` decimal(16,9) DEFAULT NULL,
                                          `qualitystatus` int(11) DEFAULT NULL COMMENT '0-合格品\r\n            1-残次品\r\n            2-库存差异',
                                          `sellstaff` int(10) unsigned DEFAULT NULL,
                                          `corderid` int(10) unsigned DEFAULT NULL,
                                          `currencyid` int(10) unsigned DEFAULT NULL,
                                          `memo` varchar(500) DEFAULT NULL,
                                          `cpdate` datetime DEFAULT NULL,
                                          `intime` datetime DEFAULT NULL,
                                          `property` varchar(1) DEFAULT NULL COMMENT '0-自采 1-代销',
                                          `kpflag` varchar(1) DEFAULT NULL COMMENT '0-未开票 1-已开票',
                                          `decadeid` int(10) unsigned NOT NULL,
                                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='库存快照表';


--
-- Dumping data for table `tb_productstock_snapshot`
--

LOCK TABLES `tb_productstock_snapshot` WRITE;
/*!40000 ALTER TABLE `tb_productstock_snapshot` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_productstock_snapshot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_requisition`
--

DROP TABLE IF EXISTS `tb_requisition`;


CREATE TABLE `tb_requisition` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `feecurrencyid` int(10) unsigned DEFAULT NULL,
                                `fee` decimal(16,9) DEFAULT NULL,
                                `apply_staff` int(10) unsigned DEFAULT NULL,
                                `apply_date` datetime NOT NULL,
                                `turnin_staff` int(10) unsigned DEFAULT NULL,
                                `turnin_date` datetime DEFAULT NULL,
                                `turnout_staff` int(10) unsigned NOT NULL,
                                `turnout_date` datetime DEFAULT NULL,
                                `out_id` int(10) unsigned NOT NULL,
                                `in_id` int(10) unsigned NOT NULL,
                                `memo` varchar(500) DEFAULT NULL,
                                `allocationconfirm` varchar(1) DEFAULT NULL COMMENT 'null-主调拨单才会是这个\r\n            4-出库未完成\r\n            0-入库未完成\r\n            1-出库拒绝\r\n            2-已完成\r\n            3-入库拒绝\r\n            ',
                                `requisitionno` varchar(50) DEFAULT NULL,
                                `salesid` int(10) unsigned DEFAULT NULL,
                                `ism` varchar(1) DEFAULT NULL COMMENT '1-主单，0或者空-子单或单对单库调拨单',
                                `qualitystatus` varchar(1) DEFAULT NULL COMMENT '0-合格品 1-残品',
                                `isamortized` varchar(1) DEFAULT NULL,
                                `expresscomoany` varchar(1) DEFAULT NULL COMMENT '0-顺丰 1-德邦 2-京东 3-其他',
                                `address` char(1) DEFAULT NULL,
                                `markno` varchar(50) DEFAULT NULL,
                                `returnflag` varchar(1) DEFAULT NULL COMMENT '0-普通调拨单，1-反向调拨单',
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='调拨单主表';


--
-- Dumping data for table `tb_requisition`
--

LOCK TABLES `tb_requisition` WRITE;
/*!40000 ALTER TABLE `tb_requisition` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_requisition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_requisition_detail`
--

DROP TABLE IF EXISTS `tb_requisition_detail`;


CREATE TABLE `tb_requisition_detail` (
                                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                       `sys_create_stuff` int(10) unsigned NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) unsigned NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `requisition_id` int(10) unsigned NOT NULL,
                                       `stock_id` int(10) unsigned DEFAULT NULL,
                                       `memo` varchar(500) DEFAULT NULL,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='调拨单明细';


--
-- Dumping data for table `tb_requisition_detail`
--

LOCK TABLES `tb_requisition_detail` WRITE;
/*!40000 ALTER TABLE `tb_requisition_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_requisition_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_requisition_detail_group`
--

DROP TABLE IF EXISTS `tb_requisition_detail_group`;


CREATE TABLE `tb_requisition_detail_group` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                             `sys_create_stuff` int(10) unsigned NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `requisition_id` int(10) unsigned NOT NULL,
                                             `product_id` int(10) unsigned DEFAULT NULL,
                                             `size_id` int(10) unsigned DEFAULT NULL,
                                             `count` int(11) DEFAULT NULL,
                                             `memo` varchar(100) DEFAULT NULL,
                                             `ctnno` varchar(50) DEFAULT NULL,
                                             `outcount` int(11) DEFAULT NULL,
                                             `incount` int(11) DEFAULT NULL,
                                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='调拨单明细(数量)';


--
-- Dumping data for table `tb_requisition_detail_group`
--

LOCK TABLES `tb_requisition_detail_group` WRITE;
/*!40000 ALTER TABLE `tb_requisition_detail_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_requisition_detail_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_requisition_express`
--

DROP TABLE IF EXISTS `tb_requisition_express`;


CREATE TABLE `tb_requisition_express` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `requisitionid` int(10) unsigned DEFAULT NULL,
                                        `expresscompany` varchar(1) DEFAULT NULL COMMENT '0-顺丰 1-德邦 2-京东 3-其他 4-圆通',
                                        `expressno` varchar(50) DEFAULT NULL,
                                        `expressfee` decimal(16,9) DEFAULT NULL,
                                        `memo` text,
                                        `creator` int(10) unsigned DEFAULT NULL,
                                        `departmentid` int(10) unsigned DEFAULT NULL,
                                        `type` varchar(1) DEFAULT NULL COMMENT '0-个人，1-部门，2-事业部，3-公司',
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='调拨单快递信息';


--
-- Dumping data for table `tb_requisition_express`
--

LOCK TABLES `tb_requisition_express` WRITE;
/*!40000 ALTER TABLE `tb_requisition_express` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_requisition_express` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_requisitioncode`
--

DROP TABLE IF EXISTS `tb_requisitioncode`;


CREATE TABLE `tb_requisitioncode` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                    `sys_create_stuff` int(10) unsigned NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `year` varchar(5) DEFAULT NULL,
                                    `code` varchar(10) DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='调拨单号表';


--
-- Dumping data for table `tb_requisitioncode`
--

LOCK TABLES `tb_requisitioncode` WRITE;
/*!40000 ALTER TABLE `tb_requisitioncode` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_requisitioncode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_rule`
--

DROP TABLE IF EXISTS `tb_rule`;


CREATE TABLE `tb_rule` (
                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                         `rule_name` varchar(50) DEFAULT NULL,
                         `rule_memo` varchar(500) DEFAULT NULL,
                         `companyid` int(10) unsigned DEFAULT NULL,
                         `sys_create_stuff` int(10) unsigned NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) unsigned NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用于存放系统的全部信息';


--
-- Dumping data for table `tb_rule`
--

LOCK TABLES `tb_rule` WRITE;
/*!40000 ALTER TABLE `tb_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_savings_card`
--

DROP TABLE IF EXISTS `tb_savings_card`;


CREATE TABLE `tb_savings_card` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `number` varchar(50) DEFAULT NULL,
                                 `password` varchar(10) DEFAULT NULL,
                                 `amount` decimal(16,9) DEFAULT NULL,
                                 `price` decimal(16,9) DEFAULT NULL,
                                 `is_used` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                                 `is_actived` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='储值卡';


--
-- Dumping data for table `tb_savings_card`
--

LOCK TABLES `tb_savings_card` WRITE;
/*!40000 ALTER TABLE `tb_savings_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_savings_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_special_requisition`
--

DROP TABLE IF EXISTS `tb_special_requisition`;


CREATE TABLE `tb_special_requisition` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `no` varchar(10) DEFAULT NULL,
                                        `stuffid` int(10) unsigned DEFAULT NULL,
                                        `check_flag` tinyint(4) DEFAULT NULL COMMENT '0-未生效\r\n            1-已生效\r\n            ',
                                        `check_date` datetime DEFAULT NULL,
                                        `memo` varchar(1000) DEFAULT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='其他出入库主表';


--
-- Dumping data for table `tb_special_requisition`
--

LOCK TABLES `tb_special_requisition` WRITE;
/*!40000 ALTER TABLE `tb_special_requisition` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_special_requisition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_special_requisition_detail`
--

DROP TABLE IF EXISTS `tb_special_requisition_detail`;


CREATE TABLE `tb_special_requisition_detail` (
                                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                               `sys_create_stuff` int(10) unsigned NOT NULL,
                                               `sys_create_date` datetime NOT NULL,
                                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                                               `sys_modify_date` datetime NOT NULL,
                                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                               `sys_delete_date` datetime DEFAULT NULL,
                                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                               `specialid` int(10) unsigned NOT NULL,
                                               `productid` int(10) unsigned DEFAULT NULL,
                                               `sizeid` int(10) unsigned DEFAULT NULL,
                                               `count` int(11) DEFAULT NULL,
                                               `warehouseid` int(10) unsigned DEFAULT NULL,
                                               `type` varchar(1) DEFAULT NULL COMMENT '0-出库 1-入库',
                                               `memo` varchar(500) DEFAULT NULL,
                                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='其他出入库明细表';


--
-- Dumping data for table `tb_special_requisition_detail`
--

LOCK TABLES `tb_special_requisition_detail` WRITE;
/*!40000 ALTER TABLE `tb_special_requisition_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_special_requisition_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_stock`
--

DROP TABLE IF EXISTS `tb_stock`;


CREATE TABLE `tb_stock` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                          `sys_create_stuff` int(10) unsigned NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `declarationid` int(10) unsigned DEFAULT NULL,
                          `productname` varchar(100) DEFAULT NULL,
                          `currencyid` int(10) unsigned DEFAULT NULL,
                          `price` decimal(16,9) DEFAULT NULL,
                          `count` int(11) DEFAULT NULL,
                          `rate` decimal(16,9) DEFAULT NULL,
                          `cprice` decimal(16,9) DEFAULT NULL,
                          `tax` decimal(16,9) DEFAULT NULL,
                          `cost` decimal(16,9) DEFAULT NULL,
                          `kpcount` int(11) DEFAULT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='账面库存表';


--
-- Dumping data for table `tb_stock`
--

LOCK TABLES `tb_stock` WRITE;
/*!40000 ALTER TABLE `tb_stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_supplier`
--

DROP TABLE IF EXISTS `tb_supplier`;


CREATE TABLE `tb_supplier` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `suppliername` varchar(50) DEFAULT NULL,
                             `englishname` varchar(50) DEFAULT NULL,
                             `address` varchar(100) DEFAULT NULL,
                             `phone` varchar(30) DEFAULT NULL,
                             `zipcode` varchar(500) DEFAULT NULL,
                             `email` varchar(500) DEFAULT NULL,
                             `quotedprice` varchar(20) DEFAULT NULL,
                             `developdate` datetime DEFAULT NULL,
                             `nationality` int(10) unsigned DEFAULT NULL,
                             `nature` varchar(100) DEFAULT NULL,
                             `supplierlevel` int(10) unsigned DEFAULT NULL,
                             `companyzipcode` varchar(100) DEFAULT NULL,
                             `maincontacts` varchar(50) DEFAULT NULL,
                             `microblog` varchar(100) DEFAULT NULL,
                             `countrycity` varchar(50) DEFAULT NULL,
                             `suppliercode` varchar(50) DEFAULT NULL,
                             `fax` varchar(50) DEFAULT NULL,
                             `calculation` varchar(50) DEFAULT NULL,
                             `legal` varchar(50) DEFAULT NULL,
                             `heading` varchar(50) DEFAULT NULL,
                             `businesslicense` varchar(50) DEFAULT NULL,
                             `headingnumber` varchar(50) DEFAULT NULL,
                             `registered` varchar(10) DEFAULT NULL,
                             `registeredcapital` decimal(15,0) DEFAULT NULL,
                             `endtime` varchar(10) DEFAULT NULL,
                             `type` varchar(1) DEFAULT NULL COMMENT '0-供货商 1-报关行 2-供应商 3-承运人 4-客户 5-品牌商',
                             `contractfrom` datetime DEFAULT NULL,
                             `contractto` datetime DEFAULT NULL,
                             `contractrate` decimal(16,9) DEFAULT NULL,
                             `contractremind` int(11) DEFAULT NULL,
                             `settlecompanyid` int(10) unsigned DEFAULT NULL,
                             `memo` text,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';


--
-- Dumping data for table `tb_supplier`
--

LOCK TABLES `tb_supplier` WRITE;
/*!40000 ALTER TABLE `tb_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_supplier_orderdate`
--

DROP TABLE IF EXISTS `tb_supplier_orderdate`;


CREATE TABLE `tb_supplier_orderdate` (
                                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                       `sys_create_stuff` int(10) unsigned NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) unsigned NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `supplierid` int(10) unsigned DEFAULT NULL,
                                       `brandid` int(10) unsigned DEFAULT NULL,
                                       `decade` int(10) unsigned DEFAULT NULL,
                                       `type` varchar(1) DEFAULT NULL COMMENT '0-pre ,1-main ,2-fashion show',
                                       `showdate` datetime DEFAULT NULL,
                                       `closedate` datetime DEFAULT NULL,
                                       `memo` text,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订货日期';


--
-- Dumping data for table `tb_supplier_orderdate`
--

LOCK TABLES `tb_supplier_orderdate` WRITE;
/*!40000 ALTER TABLE `tb_supplier_orderdate` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_supplier_orderdate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;


CREATE TABLE `tb_user` (
                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                         `login_name` varchar(50) DEFAULT NULL,
                         `password` varchar(50) DEFAULT NULL,
                         `real_name` varchar(50) DEFAULT NULL,
                         `departmentid` int(10) unsigned DEFAULT NULL,
                         `companyid` int(10) unsigned DEFAULT NULL COMMENT '公司id',
                         `groupid` int(10) unsigned DEFAULT NULL,
                         `storeid` int(10) unsigned DEFAULT NULL,
                         `sys_create_stuff` int(10) unsigned NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) unsigned NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-未删除 1-已删除',
                         `sex` varchar(50) DEFAULT NULL,
                         `section` varchar(50) DEFAULT NULL,
                         `date` varchar(100) DEFAULT NULL,
                         `phone` varchar(50) DEFAULT NULL,
                         `mobilephone` varchar(50) DEFAULT NULL,
                         `e_mail` varchar(100) DEFAULT NULL,
                         `email_password` varchar(50) DEFAULT NULL COMMENT '用于自动发送邮件',
                         `comment` varchar(100) DEFAULT NULL,
                         `countryid` int(10) unsigned DEFAULT NULL,
                         `departmentid2` int(10) unsigned DEFAULT NULL,
                         `address` text,
                         `contactor` text,
                         `leave_date` varchar(100) DEFAULT NULL,
                         `defaultprice` int(10) unsigned DEFAULT NULL,
                         `defaultwarehouse` int(10) unsigned DEFAULT NULL,
                         `defaultsellspot` int(10) unsigned DEFAULT NULL,
                         `idno` varchar(20) DEFAULT NULL,
                         `education` varchar(50) DEFAULT NULL,
                         `collegemajor` varchar(50) DEFAULT NULL,
                         `degree` varchar(50) DEFAULT NULL,
                         `graduatedcollege` varchar(50) DEFAULT NULL,
                         `stateofmarriage` varchar(50) DEFAULT NULL,
                         `censusregistration` varchar(50) DEFAULT NULL,
                         `status` varchar(1) DEFAULT NULL COMMENT '0-在职，1-离职，2-其他',
                         `reason` text,
                         `contactorphone` varchar(50) DEFAULT NULL,
                         `costdisplay` varchar(1) DEFAULT NULL,
                         `wechat` varchar(50) DEFAULT NULL,
                         `openid` varchar(50) DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `tb_user_login_name` (`login_name`),
                         KEY `departmentid` (`departmentid`),
                         KEY `groupid` (`groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';


--
-- Dumping data for table `tb_user`
--

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_verificationcode`
--

DROP TABLE IF EXISTS `tb_verificationcode`;


CREATE TABLE `tb_verificationcode` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `verificationcode` varchar(50) DEFAULT NULL,
                                     `source` varchar(100) DEFAULT NULL COMMENT '注册，绑定，支付',
                                     `sourceid` int(10) unsigned DEFAULT NULL COMMENT '前端发起动态密码验证，生成一次性guid，验证使用',
                                     `phoneno` varchar(20) DEFAULT NULL COMMENT '手机号',
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='动态密码验证表';


--
-- Dumping data for table `tb_verificationcode`
--

LOCK TABLES `tb_verificationcode` WRITE;
/*!40000 ALTER TABLE `tb_verificationcode` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_verificationcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_warehouse`
--

DROP TABLE IF EXISTS `tb_warehouse`;


CREATE TABLE `tb_warehouse` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `countryid` int(11) DEFAULT NULL COMMENT '国家ID',
                              `companyid` int(11) DEFAULT NULL COMMENT '公司ID',
                              `city` varchar(100) DEFAULT NULL COMMENT '城市名称',
                              `name` varchar(100) DEFAULT NULL COMMENT '仓库名称',
                              `address` varchar(100) DEFAULT NULL COMMENT '仓库地址',
                              `contact` varchar(100) DEFAULT NULL COMMENT '联系人',
                              `toll` varchar(20) DEFAULT NULL,
                              `fax` varchar(20) DEFAULT NULL,
                              `mobile` varchar(20) DEFAULT NULL,
                              `othercontact` varchar(50) DEFAULT NULL,
                              `code` varchar(20) DEFAULT NULL,
                              `defaultstore` varchar(1) DEFAULT NULL,
                              `zipcode` varchar(10) DEFAULT NULL,
                              `is_real` varchar(1) DEFAULT NULL,
                              `maxstock` bigint(20) DEFAULT NULL,
                              `maxsku` bigint(20) DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='仓库信息';


--
-- Dumping data for table `tb_warehouse`
--

LOCK TABLES `tb_warehouse` WRITE;
/*!40000 ALTER TABLE `tb_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_warehousing`
--

DROP TABLE IF EXISTS `tb_warehousing`;


CREATE TABLE `tb_warehousing` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `arrivalid` int(10) unsigned DEFAULT NULL,
                                `entrydate` datetime NOT NULL,
                                `warehouse_id` int(10) unsigned NOT NULL,
                                `season` int(10) unsigned DEFAULT NULL,
                                `seasontype` varchar(1) DEFAULT NULL COMMENT '0-pre ,1-main ,2-fashion show',
                                `op_id` int(10) unsigned NOT NULL,
                                `memo` varchar(500) DEFAULT NULL,
                                `ischecked` varchar(2) DEFAULT NULL,
                                `isamortized` varchar(2) DEFAULT NULL,
                                `entrycode` varchar(100) DEFAULT NULL,
                                `exchangerate` decimal(16,9) DEFAULT NULL,
                                `corderid` int(10) unsigned DEFAULT NULL,
                                `supplierid` int(10) unsigned NOT NULL,
                                `property` varchar(1) DEFAULT NULL COMMENT '0-自采 1-代销',
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='入库单主表';


--
-- Dumping data for table `tb_warehousing`
--

LOCK TABLES `tb_warehousing` WRITE;
/*!40000 ALTER TABLE `tb_warehousing` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_warehousing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_warehousing_detail`
--

DROP TABLE IF EXISTS `tb_warehousing_detail`;


CREATE TABLE `tb_warehousing_detail` (
                                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                       `sys_create_stuff` int(10) unsigned NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) unsigned NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(4) NOT NULL COMMENT '0-未删除 1-已删除',
                                       `detailid` int(10) unsigned DEFAULT NULL,
                                       `warehousing_id` int(10) unsigned NOT NULL,
                                       `product_id` int(10) unsigned NOT NULL,
                                       `size_id` int(10) unsigned NOT NULL,
                                       `amount` int(11) NOT NULL,
                                       `cost` decimal(16,9) NOT NULL,
                                       `memo` varchar(500) DEFAULT NULL,
                                       `cjj` decimal(16,9) DEFAULT NULL,
                                       `yj` decimal(16,9) DEFAULT NULL,
                                       `sellprice` decimal(16,9) DEFAULT NULL,
                                       `finalcost` decimal(16,9) DEFAULT NULL,
                                       `currencyid` int(10) unsigned DEFAULT NULL,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='入库单明细表';


--
-- Dumping data for table `tb_warehousing_detail`
--

LOCK TABLES `tb_warehousing_detail` WRITE;
/*!40000 ALTER TABLE `tb_warehousing_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_warehousing_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_warehousing_fee`
--

DROP TABLE IF EXISTS `tb_warehousing_fee`;


CREATE TABLE `tb_warehousing_fee` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                    `sys_create_stuff` int(10) unsigned NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `warehousingid` int(10) unsigned DEFAULT NULL,
                                    `feeid` int(10) unsigned DEFAULT NULL,
                                    `currencyid` int(10) unsigned DEFAULT NULL,
                                    `feeprice` decimal(10,2) DEFAULT NULL,
                                    `payment` int(10) unsigned DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='入库表-费用说明';


--
-- Dumping data for table `tb_warehousing_fee`
--

LOCK TABLES `tb_warehousing_fee` WRITE;
/*!40000 ALTER TABLE `tb_warehousing_fee` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_warehousing_fee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_brand_code`
--

DROP TABLE IF EXISTS `trans_brand_code`;


CREATE TABLE `trans_brand_code` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `brandid` int(10) unsigned DEFAULT NULL,
                                  `code` varchar(50) DEFAULT NULL,
                                  `transcode` varchar(50) DEFAULT NULL,
                                  `unit` varchar(10) DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品牌对照表';


--
-- Dumping data for table `trans_brand_code`
--

LOCK TABLES `trans_brand_code` WRITE;
/*!40000 ALTER TABLE `trans_brand_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_brand_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_color_code`
--

DROP TABLE IF EXISTS `trans_color_code`;


CREATE TABLE `trans_color_code` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `colorid` int(10) unsigned DEFAULT NULL,
                                  `code` varchar(50) DEFAULT NULL,
                                  `transcode` varchar(50) DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='颜色对照表';


--
-- Dumping data for table `trans_color_code`
--

LOCK TABLES `trans_color_code` WRITE;
/*!40000 ALTER TABLE `trans_color_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_color_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_group_code`
--

DROP TABLE IF EXISTS `trans_group_code`;


CREATE TABLE `trans_group_code` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `groupid` int(10) unsigned DEFAULT NULL,
                                  `code` varchar(50) DEFAULT NULL,
                                  `transcode` varchar(50) DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品类对照表';


--
-- Dumping data for table `trans_group_code`
--

LOCK TABLES `trans_group_code` WRITE;
/*!40000 ALTER TABLE `trans_group_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_group_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_size_code`
--

DROP TABLE IF EXISTS `trans_size_code`;


CREATE TABLE `trans_size_code` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `sizeid` int(10) unsigned DEFAULT NULL,
                                 `typeid` int(10) unsigned DEFAULT NULL,
                                 `code` varchar(50) DEFAULT NULL,
                                 `transcode` varchar(50) DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='尺码对照表';


--
-- Dumping data for table `trans_size_code`
--

LOCK TABLES `trans_size_code` WRITE;
/*!40000 ALTER TABLE `trans_size_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_size_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_afterservice`
--

DROP TABLE IF EXISTS `xs_afterservice`;


CREATE TABLE `xs_afterservice` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `memberid` int(10) unsigned DEFAULT NULL,
                                 `salesstaff` int(10) unsigned DEFAULT NULL,
                                 `salesdate` datetime DEFAULT NULL,
                                 `sellspotid` int(10) unsigned DEFAULT NULL,
                                 `saleno` varchar(50) DEFAULT NULL,
                                 `cusname` varchar(50) DEFAULT NULL,
                                 `custel` varchar(50) DEFAULT NULL,
                                 `status` varchar(1) DEFAULT NULL COMMENT '0-接收 1-处理中 2-完结',
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='售后单';


--
-- Dumping data for table `xs_afterservice`
--

LOCK TABLES `xs_afterservice` WRITE;
/*!40000 ALTER TABLE `xs_afterservice` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_afterservice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_afterservice_detail`
--

DROP TABLE IF EXISTS `xs_afterservice_detail`;


CREATE TABLE `xs_afterservice_detail` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `afterserviceid` int(10) unsigned DEFAULT NULL,
                                        `detailid` int(10) unsigned DEFAULT NULL,
                                        `count` int(11) DEFAULT NULL,
                                        `describtion` varchar(500) DEFAULT NULL,
                                        `dealtype` varchar(1) DEFAULT NULL COMMENT '0-修理1-保养2-调换3-退货',
                                        `fixdate` datetime DEFAULT NULL,
                                        `fixstuff` int(10) unsigned DEFAULT NULL,
                                        `backdate` datetime DEFAULT NULL,
                                        `backstuff` int(10) unsigned DEFAULT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='售后单明细';


--
-- Dumping data for table `xs_afterservice_detail`
--

LOCK TABLES `xs_afterservice_detail` WRITE;
/*!40000 ALTER TABLE `xs_afterservice_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_afterservice_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_pre_sales`
--

DROP TABLE IF EXISTS `xs_pre_sales`;


CREATE TABLE `xs_pre_sales` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `memberid` int(10) unsigned DEFAULT NULL,
                              `pricelistid` int(10) unsigned DEFAULT NULL,
                              `salesstaff` int(10) unsigned DEFAULT NULL,
                              `salesdate` datetime DEFAULT NULL,
                              `sellspotid` int(10) unsigned DEFAULT NULL,
                              `companyid` int(10) unsigned DEFAULT NULL,
                              `saleno` varchar(50) DEFAULT NULL,
                              `salestype` varchar(1) DEFAULT NULL COMMENT '0-零售\r\n            1-批发',
                              `warehouseid` int(10) unsigned DEFAULT NULL,
                              `status` varchar(1) DEFAULT NULL COMMENT '0-预售 1-已转销售 2-作废',
                              `islocal` varchar(1) DEFAULT NULL COMMENT '0-跨境电商 1-线下店铺 2-爱莎商城 3-代销',
                              `downpayment` decimal(16,9) DEFAULT NULL,
                              `remainingfund` decimal(16,9) DEFAULT NULL,
                              `actualprice` decimal(16,9) DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预售主表';


--
-- Dumping data for table `xs_pre_sales`
--

LOCK TABLES `xs_pre_sales` WRITE;
/*!40000 ALTER TABLE `xs_pre_sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_pre_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_pre_salescode`
--

DROP TABLE IF EXISTS `xs_pre_salescode`;


CREATE TABLE `xs_pre_salescode` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `year` varchar(5) DEFAULT NULL,
                                  `code` varchar(10) DEFAULT NULL,
                                  `month` varchar(5) DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预售单号表';


--
-- Dumping data for table `xs_pre_salescode`
--

LOCK TABLES `xs_pre_salescode` WRITE;
/*!40000 ALTER TABLE `xs_pre_salescode` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_pre_salescode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_pre_salesdetails`
--

DROP TABLE IF EXISTS `xs_pre_salesdetails`;


CREATE TABLE `xs_pre_salesdetails` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `sales_id` int(10) unsigned NOT NULL,
                                     `product_id` int(10) unsigned DEFAULT NULL,
                                     `size_id` int(10) unsigned DEFAULT NULL,
                                     `count` int(11) DEFAULT NULL,
                                     `dealprice` decimal(16,9) DEFAULT NULL,
                                     `price` decimal(16,9) DEFAULT NULL,
                                     `rate` decimal(16,9) DEFAULT NULL,
                                     `memo` varchar(500) DEFAULT NULL,
                                     `totalsellprice` decimal(16,9) DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预售单明细(数量)';


--
-- Dumping data for table `xs_pre_salesdetails`
--

LOCK TABLES `xs_pre_salesdetails` WRITE;
/*!40000 ALTER TABLE `xs_pre_salesdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_pre_salesdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_pricelist`
--

DROP TABLE IF EXISTS `xs_pricelist`;


CREATE TABLE `xs_pricelist` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `begindate` datetime DEFAULT NULL,
                              `enddate` datetime DEFAULT NULL,
                              `name` varchar(20) DEFAULT NULL,
                              `salesport` int(10) unsigned DEFAULT NULL,
                              `memo` varchar(500) DEFAULT NULL,
                              `priceid` int(10) unsigned DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='价格单基础资料 主表\r\n';


--
-- Dumping data for table `xs_pricelist`
--

LOCK TABLES `xs_pricelist` WRITE;
/*!40000 ALTER TABLE `xs_pricelist` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_pricelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_pricelistdetails`
--

DROP TABLE IF EXISTS `xs_pricelistdetails`;


CREATE TABLE `xs_pricelistdetails` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `productid` int(10) unsigned DEFAULT NULL,
                                     `productprice` decimal(10,2) DEFAULT NULL,
                                     `pricelistid` int(10) unsigned DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='价格单基础资料 明细从表';


--
-- Dumping data for table `xs_pricelistdetails`
--

LOCK TABLES `xs_pricelistdetails` WRITE;
/*!40000 ALTER TABLE `xs_pricelistdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_pricelistdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_return`
--

DROP TABLE IF EXISTS `xs_return`;


CREATE TABLE `xs_return` (
                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                           `sys_create_stuff` int(10) unsigned NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                           `actualprice` decimal(16,9) DEFAULT NULL,
                           `sellspotid` int(10) unsigned DEFAULT NULL,
                           `memberid` int(10) unsigned DEFAULT NULL,
                           `returnstaff` int(10) unsigned DEFAULT NULL,
                           `returndate` datetime DEFAULT NULL,
                           `returnno` varchar(50) DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='退货单';


--
-- Dumping data for table `xs_return`
--

LOCK TABLES `xs_return` WRITE;
/*!40000 ALTER TABLE `xs_return` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_return` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_returncode`
--

DROP TABLE IF EXISTS `xs_returncode`;


CREATE TABLE `xs_returncode` (
                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                               `sys_create_stuff` int(10) unsigned NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `year` varchar(5) DEFAULT NULL,
                               `code` varchar(10) DEFAULT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='退货单号表';


--
-- Dumping data for table `xs_returncode`
--

LOCK TABLES `xs_returncode` WRITE;
/*!40000 ALTER TABLE `xs_returncode` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_returncode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_sales`
--

DROP TABLE IF EXISTS `xs_sales`;


CREATE TABLE `xs_sales` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                          `sys_create_stuff` int(10) unsigned NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `actualprice` decimal(16,9) DEFAULT NULL,
                          `memberid` int(10) unsigned DEFAULT NULL,
                          `pricelistid` int(10) unsigned DEFAULT NULL,
                          `salesstaff` int(10) unsigned DEFAULT NULL,
                          `salesdate` datetime DEFAULT NULL,
                          `salesmode` varchar(2) DEFAULT NULL COMMENT '0-现金\r\n            1-刷卡\r\n            2-支票\r\n            3-储值卡\r\n            4-转账\r\n            5-协议结算\r\n            6-支付宝\r\n            7-微信支付',
                          `sellspotid` int(10) unsigned DEFAULT NULL,
                          `companyid` int(10) unsigned DEFAULT NULL,
                          `saleno` varchar(50) DEFAULT NULL,
                          `salestype` varchar(1) DEFAULT NULL COMMENT '0-未转 1-已转',
                          `warehouseid` int(10) unsigned DEFAULT NULL,
                          `expressno` varchar(50) DEFAULT NULL,
                          `expresspaidtype` varchar(1) DEFAULT NULL COMMENT '0-预付 1-到付 2-第三方付费 3-储值卡 4-转账 5-协议结算',
                          `expressfee` decimal(16,9) DEFAULT NULL,
                          `expressfeepayid` int(10) unsigned DEFAULT NULL,
                          `status` varchar(1) DEFAULT NULL COMMENT '0-预售 1-已售 2-作废',
                          `expresscomoany` varchar(1) DEFAULT NULL COMMENT '0-顺丰 1-德邦 2-京东 3-其他 4-圆通',
                          `address` int(10) unsigned DEFAULT NULL,
                          `islocal` varchar(1) DEFAULT NULL COMMENT '0-跨境电商 1-线下店铺 2-爱莎商城 3-分公司间调拨销售 4-代销 ',
                          `externalno` varchar(50) DEFAULT NULL,
                          `ischeck` varchar(1) DEFAULT NULL,
                          `sheetid` int(10) unsigned DEFAULT NULL,
                          `type` varchar(1) DEFAULT NULL COMMENT '0-普通 1-扫码 ',
                          `pickingtype` varchar(1) DEFAULT NULL COMMENT '0-自提 1-快递 2-门店直发',
                          `sender` int(10) unsigned DEFAULT NULL,
                          `supplierid` int(10) unsigned DEFAULT NULL,
                          `isjf` varchar(1) DEFAULT NULL COMMENT '0-未使用积分抵扣，1-使用积分抵扣',
                          `dksum` decimal(16,9) DEFAULT NULL,
                          `usedscore` bigint(20) DEFAULT NULL,
                          `exhibitionid` int(10) unsigned DEFAULT NULL,
                          `isused` varchar(1) DEFAULT NULL,
                          `invitesum` bigint(20) DEFAULT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售主表';


--
-- Dumping data for table `xs_sales`
--

LOCK TABLES `xs_sales` WRITE;
/*!40000 ALTER TABLE `xs_sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_sales_card`
--

DROP TABLE IF EXISTS `xs_sales_card`;


CREATE TABLE `xs_sales_card` (
                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                               `sys_create_stuff` int(10) unsigned NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `actualprice` decimal(16,9) DEFAULT NULL,
                               `memberid` int(10) unsigned DEFAULT NULL,
                               `salesstaff` int(10) unsigned DEFAULT NULL,
                               `salesdate` datetime DEFAULT NULL,
                               `sellspotid` int(10) unsigned DEFAULT NULL,
                               `companyid` int(10) unsigned DEFAULT NULL,
                               `saleno` varchar(50) DEFAULT NULL,
                               `ischeck` varchar(1) DEFAULT NULL,
                               `sheetid` int(10) unsigned DEFAULT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售储值卡主表';


--
-- Dumping data for table `xs_sales_card`
--

LOCK TABLES `xs_sales_card` WRITE;
/*!40000 ALTER TABLE `xs_sales_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_sales_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_sales_cardetails`
--

DROP TABLE IF EXISTS `xs_sales_cardetails`;


CREATE TABLE `xs_sales_cardetails` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `sales_id` int(10) unsigned NOT NULL,
                                     `dealprice` decimal(16,9) DEFAULT NULL,
                                     `price` decimal(16,9) DEFAULT NULL,
                                     `rate` decimal(16,9) DEFAULT NULL,
                                     `memo` varchar(500) DEFAULT NULL,
                                     `totalsellprice` decimal(16,9) DEFAULT NULL,
                                     `stockid` int(10) unsigned DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='储值卡销售单明细';


--
-- Dumping data for table `xs_sales_cardetails`
--

LOCK TABLES `xs_sales_cardetails` WRITE;
/*!40000 ALTER TABLE `xs_sales_cardetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_sales_cardetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_sales_pay`
--

DROP TABLE IF EXISTS `xs_sales_pay`;


CREATE TABLE `xs_sales_pay` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `sales_id` int(10) unsigned NOT NULL,
                              `paidtype` varchar(5) DEFAULT NULL COMMENT '0-现金\r\n            1-刷卡/银联\r\n            2-支票\r\n            3-储值卡\r\n            4-转账\r\n            5-协议结算\r\n            6-支付宝\r\n            7-微信支付\r\n            8-会员余额支付\r\n            9-刷卡手续费\r\n            10-快递费\r\n            11-返点\r\n            12-积分抵扣\r\n            13-代金券\r\n            14-刷卡/visa\r\n            15.joypay',
                              `ischeck` varchar(1) DEFAULT NULL,
                              `isreturn` varchar(1) DEFAULT NULL,
                              `sheetid` int(10) unsigned DEFAULT NULL,
                              `sum` decimal(16,9) DEFAULT NULL,
                              `memo` varchar(500) DEFAULT NULL,
                              `currencyid` int(10) unsigned DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售单付款明细';


--
-- Dumping data for table `xs_sales_pay`
--

LOCK TABLES `xs_sales_pay` WRITE;
/*!40000 ALTER TABLE `xs_sales_pay` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_sales_pay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_salescode`
--

DROP TABLE IF EXISTS `xs_salescode`;


CREATE TABLE `xs_salescode` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `year` varchar(5) DEFAULT NULL,
                              `code` varchar(10) DEFAULT NULL,
                              `month` varchar(5) DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售单号表';


--
-- Dumping data for table `xs_salescode`
--

LOCK TABLES `xs_salescode` WRITE;
/*!40000 ALTER TABLE `xs_salescode` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_salescode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_salesdetails`
--

DROP TABLE IF EXISTS `xs_salesdetails`;


CREATE TABLE `xs_salesdetails` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `sales_id` int(10) unsigned NOT NULL,
                                 `product_id` int(10) unsigned DEFAULT NULL,
                                 `size_id` int(10) unsigned DEFAULT NULL,
                                 `count` int(11) DEFAULT NULL,
                                 `dealprice` decimal(16,9) DEFAULT NULL,
                                 `price` decimal(16,9) DEFAULT NULL,
                                 `rate` decimal(16,9) DEFAULT NULL,
                                 `memo` varchar(500) DEFAULT NULL,
                                 `returnid` int(10) unsigned DEFAULT NULL,
                                 `totalsellprice` decimal(16,9) DEFAULT NULL,
                                 `saleno` varchar(50) DEFAULT NULL,
                                 `stockid` int(10) unsigned DEFAULT NULL,
                                 `pricememo` varchar(500) DEFAULT NULL,
                                 `exchangerate` decimal(16,9) DEFAULT NULL,
                                 `totalsellpricebwb` decimal(16,9) DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售单明细(数量)';


--
-- Dumping data for table `xs_salesdetails`
--

LOCK TABLES `xs_salesdetails` WRITE;
/*!40000 ALTER TABLE `xs_salesdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_salesdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_ac_cashflow_statement`
--

DROP TABLE IF EXISTS `zl_ac_cashflow_statement`;


CREATE TABLE `zl_ac_cashflow_statement` (
                                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                          `sys_create_stuff` int(10) unsigned NOT NULL,
                                          `sys_create_date` datetime NOT NULL,
                                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                                          `sys_modify_date` datetime NOT NULL,
                                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                          `sys_delete_date` datetime DEFAULT NULL,
                                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                          `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                          `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                          `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                          `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                          `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                          `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                          `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                          `subject_type` int(11) DEFAULT NULL COMMENT '0-正，1-负',
                                          `orderno` int(11) DEFAULT NULL,
                                          `parentid` int(10) unsigned DEFAULT NULL,
                                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='现金流量表格式';


--
-- Dumping data for table `zl_ac_cashflow_statement`
--

LOCK TABLES `zl_ac_cashflow_statement` WRITE;
/*!40000 ALTER TABLE `zl_ac_cashflow_statement` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_ac_cashflow_statement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_ac_cashflow_subject`
--

DROP TABLE IF EXISTS `zl_ac_cashflow_subject`;


CREATE TABLE `zl_ac_cashflow_subject` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                        `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                        `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                        `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                        `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                        `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                        `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                        `sorf` varchar(1) DEFAULT NULL COMMENT '0-正，1-负',
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='现金流量项目';


--
-- Dumping data for table `zl_ac_cashflow_subject`
--

LOCK TABLES `zl_ac_cashflow_subject` WRITE;
/*!40000 ALTER TABLE `zl_ac_cashflow_subject` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_ac_cashflow_subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_ac_km`
--

DROP TABLE IF EXISTS `zl_ac_km`;


CREATE TABLE `zl_ac_km` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                          `code` char(1) NOT NULL,
                          `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                          `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                          `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                          `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                          `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                          `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                          `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                          `km_type_id` int(10) unsigned NOT NULL,
                          `up_km_id` int(10) unsigned DEFAULT NULL,
                          `is_havexj` varchar(1) NOT NULL COMMENT '0-没有,1-有',
                          `jord` varchar(1) NOT NULL COMMENT 'j-借方,d-贷方',
                          `companyid` int(10) unsigned NOT NULL,
                          `sys_create_stuff` int(10) unsigned NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='科目表';


--
-- Dumping data for table `zl_ac_km`
--

LOCK TABLES `zl_ac_km` WRITE;
/*!40000 ALTER TABLE `zl_ac_km` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_ac_km` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_ac_km_type`
--

DROP TABLE IF EXISTS `zl_ac_km_type`;


CREATE TABLE `zl_ac_km_type` (
                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                               `code` varchar(1) NOT NULL,
                               `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                               `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                               `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                               `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                               `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                               `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                               `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                               `sys_create_stuff` int(10) unsigned NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='科目类别';


--
-- Dumping data for table `zl_ac_km_type`
--

LOCK TABLES `zl_ac_km_type` WRITE;
/*!40000 ALTER TABLE `zl_ac_km_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_ac_km_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_ac_pzh_rule`
--

DROP TABLE IF EXISTS `zl_ac_pzh_rule`;


CREATE TABLE `zl_ac_pzh_rule` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `rulecode` varchar(50) DEFAULT NULL,
                                `kmid` int(10) unsigned DEFAULT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='凭证科目规则';


--
-- Dumping data for table `zl_ac_pzh_rule`
--

LOCK TABLES `zl_ac_pzh_rule` WRITE;
/*!40000 ALTER TABLE `zl_ac_pzh_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_ac_pzh_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_ac_pzh_type`
--

DROP TABLE IF EXISTS `zl_ac_pzh_type`;


CREATE TABLE `zl_ac_pzh_type` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `ztid` int(10) unsigned NOT NULL,
                                `code` varchar(4) NOT NULL,
                                `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='现金、银行、转账';


--
-- Dumping data for table `zl_ac_pzh_type`
--

LOCK TABLES `zl_ac_pzh_type` WRITE;
/*!40000 ALTER TABLE `zl_ac_pzh_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_ac_pzh_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_ac_ztb`
--

DROP TABLE IF EXISTS `zl_ac_ztb`;


CREATE TABLE `zl_ac_ztb` (
                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                           `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                           `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                           `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                           `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                           `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                           `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                           `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                           `km_code_rule` varchar(50) NOT NULL,
                           `star_date` datetime NOT NULL,
                           `end_date` datetime DEFAULT NULL COMMENT '只有结束了才有值',
                           `is_end` varchar(1) NOT NULL COMMENT '0-未结束,1-结束',
                           `is_default` varchar(1) NOT NULL COMMENT '0-不是,1-是',
                           `pwd` varchar(50) DEFAULT NULL,
                           `companyid` int(10) unsigned NOT NULL,
                           `sys_create_stuff` int(10) unsigned NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='帐套表';


--
-- Dumping data for table `zl_ac_ztb`
--

LOCK TABLES `zl_ac_ztb` WRITE;
/*!40000 ALTER TABLE `zl_ac_ztb` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_ac_ztb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_ageseason`
--

DROP TABLE IF EXISTS `zl_ageseason`;


CREATE TABLE `zl_ageseason` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `name` varchar(100) DEFAULT NULL,
                              `memo` varchar(200) DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='年代季节';


--
-- Dumping data for table `zl_ageseason`
--

LOCK TABLES `zl_ageseason` WRITE;
/*!40000 ALTER TABLE `zl_ageseason` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_ageseason` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_aliases`
--

DROP TABLE IF EXISTS `zl_aliases`;


CREATE TABLE `zl_aliases` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                            `sys_create_stuff` int(10) unsigned NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                            `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                            `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                            `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                            `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                            `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                            `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                            `code` varchar(50) DEFAULT NULL,
                            `brandid` int(10) unsigned DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';


--
-- Dumping data for table `zl_aliases`
--

LOCK TABLES `zl_aliases` WRITE;
/*!40000 ALTER TABLE `zl_aliases` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_aliases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_bankinformation`
--

DROP TABLE IF EXISTS `zl_bankinformation`;


CREATE TABLE `zl_bankinformation` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                    `sys_create_stuff` int(10) unsigned NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                    `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                    `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                    `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                    `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                    `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                    `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                    `bankname2` varchar(100) DEFAULT NULL,
                                    `bankaddress` varchar(100) DEFAULT NULL,
                                    `bankaccount` varchar(50) DEFAULT NULL,
                                    `remittedaccount` varchar(50) DEFAULT NULL,
                                    `supplierid` int(10) unsigned DEFAULT NULL,
                                    `currency` int(10) unsigned DEFAULT NULL,
                                    `account` varchar(50) DEFAULT NULL,
                                    `isused` varchar(1) DEFAULT NULL COMMENT '0-常用，1-禁用',
                                    `memo` varchar(200) DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='银行信息';


--
-- Dumping data for table `zl_bankinformation`
--

LOCK TABLES `zl_bankinformation` WRITE;
/*!40000 ALTER TABLE `zl_bankinformation` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_bankinformation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_brand`
--

DROP TABLE IF EXISTS `zl_brand`;


CREATE TABLE `zl_brand` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                          `sys_create_stuff` int(10) unsigned NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `code` varchar(50) DEFAULT NULL,
                          `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                          `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                          `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                          `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                          `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                          `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                          `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                          `countryid` int(10) unsigned DEFAULT NULL,
                          `brandgroupid` int(10) unsigned DEFAULT NULL,
                          `imageurl` varchar(100) DEFAULT NULL,
                          `childbrand` int(10) unsigned DEFAULT NULL,
                          `description` varchar(1000) DEFAULT NULL,
                          `imagestream` varchar(200) DEFAULT NULL,
                          `memo` text,
                          `supplier` int(10) unsigned DEFAULT NULL,
                          `officialwebsite` varchar(500) DEFAULT NULL,
                          `isauthorized` tinyint(4) DEFAULT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品牌表';


--
-- Dumping data for table `zl_brand`
--

LOCK TABLES `zl_brand` WRITE;
/*!40000 ALTER TABLE `zl_brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_brandgroup`
--

DROP TABLE IF EXISTS `zl_brandgroup`;


CREATE TABLE `zl_brandgroup` (
                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                               `sys_create_stuff` int(10) unsigned NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `code` varchar(50) DEFAULT NULL,
                               `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                               `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                               `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                               `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                               `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                               `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                               `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品类表';


--
-- Dumping data for table `zl_brandgroup`
--

LOCK TABLES `zl_brandgroup` WRITE;
/*!40000 ALTER TABLE `zl_brandgroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_brandgroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_brandmemo`
--

DROP TABLE IF EXISTS `zl_brandmemo`;


CREATE TABLE `zl_brandmemo` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `brandid` int(10) unsigned DEFAULT NULL,
                              `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                              `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                              `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                              `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                              `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                              `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                              `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                              `memo` varchar(100) DEFAULT NULL,
                              `pic` varchar(200) DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品牌颜色材质备注';


--
-- Dumping data for table `zl_brandmemo`
--

LOCK TABLES `zl_brandmemo` WRITE;
/*!40000 ALTER TABLE `zl_brandmemo` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_brandmemo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_businesstype`
--

DROP TABLE IF EXISTS `zl_businesstype`;


CREATE TABLE `zl_businesstype` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                 `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                 `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                 `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                 `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                 `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                 `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='业务类型';


--
-- Dumping data for table `zl_businesstype`
--

LOCK TABLES `zl_businesstype` WRITE;
/*!40000 ALTER TABLE `zl_businesstype` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_businesstype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_childproductgroup`
--

DROP TABLE IF EXISTS `zl_childproductgroup`;


CREATE TABLE `zl_childproductgroup` (
                                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                      `sys_create_stuff` int(10) unsigned NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) unsigned NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                      `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                      `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                      `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                      `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                      `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                      `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                      `childcode` varchar(50) DEFAULT NULL,
                                      `productgroupid` int(10) unsigned DEFAULT NULL,
                                      `producttemplateid` int(10) unsigned DEFAULT NULL,
                                      `weight` decimal(16,9) DEFAULT NULL,
                                      `isfj` varchar(1) DEFAULT NULL COMMENT '0-否 1-法检',
                                      `cname4male` int(10) unsigned DEFAULT NULL,
                                      `cname4female` int(10) unsigned DEFAULT NULL,
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='子品类';


--
-- Dumping data for table `zl_childproductgroup`
--

LOCK TABLES `zl_childproductgroup` WRITE;
/*!40000 ALTER TABLE `zl_childproductgroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_childproductgroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_closedway`
--

DROP TABLE IF EXISTS `zl_closedway`;


CREATE TABLE `zl_closedway` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                              `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                              `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                              `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                              `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                              `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                              `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                              `memo_cn` text COMMENT '中文备注',
                              `memo_en` text COMMENT '英文备注',
                              `memo_hk` text COMMENT '粤语备注',
                              `memo_fr` text COMMENT '法语备注',
                              `memo_it` text COMMENT '意大利语备注',
                              `memo_sp` text COMMENT '西班牙语备注',
                              `memo_de` text COMMENT '德语备注',
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='闭合方式';


--
-- Dumping data for table `zl_closedway`
--

LOCK TABLES `zl_closedway` WRITE;
/*!40000 ALTER TABLE `zl_closedway` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_closedway` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_color`
--

DROP TABLE IF EXISTS `zl_color`;


CREATE TABLE `zl_color` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                          `sys_create_stuff` int(10) unsigned NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `code` varchar(10) DEFAULT NULL,
                          `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                          `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                          `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                          `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                          `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                          `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                          `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                          `colormatter` varchar(100) DEFAULT NULL,
                          `asacolorid` int(10) unsigned DEFAULT NULL,
                          `brandid` int(10) unsigned DEFAULT NULL,
                          `imagestream` varchar(200) DEFAULT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='其他品牌颜色模板';


--
-- Dumping data for table `zl_color`
--

LOCK TABLES `zl_color` WRITE;
/*!40000 ALTER TABLE `zl_color` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_colortemplate`
--

DROP TABLE IF EXISTS `zl_colortemplate`;


CREATE TABLE `zl_colortemplate` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                  `picture` varchar(200) DEFAULT NULL,
                                  `code` varchar(4) DEFAULT NULL,
                                  `color_note` varchar(200) DEFAULT NULL,
                                  `colortype` varchar(50) DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='asa颜色模板';


--
-- Dumping data for table `zl_colortemplate`
--

LOCK TABLES `zl_colortemplate` WRITE;
/*!40000 ALTER TABLE `zl_colortemplate` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_colortemplate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_companycontacts`
--

DROP TABLE IF EXISTS `zl_companycontacts`;


CREATE TABLE `zl_companycontacts` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                    `sys_create_stuff` int(10) unsigned NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                    `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                    `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                    `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                    `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                    `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                    `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                    `gender` varchar(10) DEFAULT NULL,
                                    `department` varchar(20) DEFAULT NULL,
                                    `position` varchar(20) DEFAULT NULL,
                                    `city` varchar(20) DEFAULT NULL,
                                    `company` varchar(50) DEFAULT NULL,
                                    `phone` varchar(30) DEFAULT NULL,
                                    `landline` varchar(30) DEFAULT NULL,
                                    `fax` varchar(30) DEFAULT NULL,
                                    `email` varchar(20) DEFAULT NULL,
                                    `msn` varchar(20) DEFAULT NULL,
                                    `qq` varchar(20) DEFAULT NULL,
                                    `skytpe` varchar(20) DEFAULT NULL,
                                    `microblog` varchar(20) DEFAULT NULL,
                                    `micromessage` varchar(20) DEFAULT NULL,
                                    `note` varchar(1000) DEFAULT NULL,
                                    `branch` varchar(100) DEFAULT NULL,
                                    `useid` int(10) unsigned DEFAULT NULL,
                                    `address` varchar(500) DEFAULT NULL,
                                    `zipcode` varchar(10) DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='联系人\r\n';


--
-- Dumping data for table `zl_companycontacts`
--

LOCK TABLES `zl_companycontacts` WRITE;
/*!40000 ALTER TABLE `zl_companycontacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_companycontacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_costformula`
--

DROP TABLE IF EXISTS `zl_costformula`;


CREATE TABLE `zl_costformula` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `productpriceid` int(10) unsigned DEFAULT NULL,
                                `symbol_1` char(10) DEFAULT NULL,
                                `coefficient_1` decimal(10,2) DEFAULT NULL,
                                `symbol_2` char(10) DEFAULT NULL,
                                `coefficient_2` decimal(10,2) DEFAULT NULL,
                                `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='成本计算公式';


--
-- Dumping data for table `zl_costformula`
--

LOCK TABLES `zl_costformula` WRITE;
/*!40000 ALTER TABLE `zl_costformula` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_costformula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_country`
--

DROP TABLE IF EXISTS `zl_country`;


CREATE TABLE `zl_country` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                            `code` varchar(20) NOT NULL,
                            `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                            `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                            `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                            `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                            `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                            `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                            `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                            `sys_create_stuff` int(10) unsigned NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `localcurrency` varchar(20) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='国家表';


--
-- Dumping data for table `zl_country`
--

LOCK TABLES `zl_country` WRITE;
/*!40000 ALTER TABLE `zl_country` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_currency`
--

DROP TABLE IF EXISTS `zl_currency`;


CREATE TABLE `zl_currency` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                             `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                             `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                             `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                             `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                             `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                             `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                             `currencycode` varchar(10) DEFAULT NULL,
                             `currencymark` tinyint(1) DEFAULT NULL,
                             `userflag` varchar(1) DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='币种表';


--
-- Dumping data for table `zl_currency`
--

LOCK TABLES `zl_currency` WRITE;
/*!40000 ALTER TABLE `zl_currency` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_customs_name`
--

DROP TABLE IF EXISTS `zl_customs_name`;


CREATE TABLE `zl_customs_name` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                 `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                 `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                 `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                 `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                 `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                 `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                 `memo` varchar(100) DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品报关名称\r\n';


--
-- Dumping data for table `zl_customs_name`
--

LOCK TABLES `zl_customs_name` WRITE;
/*!40000 ALTER TABLE `zl_customs_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_customs_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_decade`
--

DROP TABLE IF EXISTS `zl_decade`;


CREATE TABLE `zl_decade` (
                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                           `sys_create_stuff` int(10) unsigned NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                           `decade` varchar(10) DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品年代';


--
-- Dumping data for table `zl_decade`
--

LOCK TABLES `zl_decade` WRITE;
/*!40000 ALTER TABLE `zl_decade` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_decade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_delare_makings`
--

DROP TABLE IF EXISTS `zl_delare_makings`;


CREATE TABLE `zl_delare_makings` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                   `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                   `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                   `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                   `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                   `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                   `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                   `memo` varchar(100) DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='申报要素';


--
-- Dumping data for table `zl_delare_makings`
--

LOCK TABLES `zl_delare_makings` WRITE;
/*!40000 ALTER TABLE `zl_delare_makings` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_delare_makings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_ex_reportstyle`
--

DROP TABLE IF EXISTS `zl_ex_reportstyle`;


CREATE TABLE `zl_ex_reportstyle` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `code` varchar(20) DEFAULT NULL,
                                   `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                   `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                   `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                   `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                   `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                   `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                   `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                   `tdbackx` int(11) DEFAULT NULL,
                                   `tdbacky` int(11) DEFAULT NULL,
                                   `tdbackwidth` int(11) DEFAULT NULL,
                                   `tdbackheight` int(11) DEFAULT NULL,
                                   `memo` varchar(1000) DEFAULT NULL,
                                   `companyid` int(10) unsigned DEFAULT NULL,
                                   `picid` int(10) unsigned DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='快递单样式主表';


--
-- Dumping data for table `zl_ex_reportstyle`
--

LOCK TABLES `zl_ex_reportstyle` WRITE;
/*!40000 ALTER TABLE `zl_ex_reportstyle` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_ex_reportstyle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_ex_reportstyle_detail`
--

DROP TABLE IF EXISTS `zl_ex_reportstyle_detail`;


CREATE TABLE `zl_ex_reportstyle_detail` (
                                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                          `sys_create_stuff` int(10) unsigned NOT NULL,
                                          `sys_create_date` datetime NOT NULL,
                                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                                          `sys_modify_date` datetime NOT NULL,
                                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                          `sys_delete_date` datetime DEFAULT NULL,
                                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                          `type_id` int(10) unsigned DEFAULT NULL,
                                          `tdfield` varchar(200) DEFAULT NULL,
                                          `tdfieldx` int(11) DEFAULT NULL,
                                          `tdfieldy` int(11) DEFAULT NULL,
                                          `tdfieldwidth` int(11) DEFAULT NULL,
                                          `tdfieldheight` int(11) DEFAULT NULL,
                                          `is_visiable` varchar(1) DEFAULT NULL,
                                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='快递单样式明细表';


--
-- Dumping data for table `zl_ex_reportstyle_detail`
--

LOCK TABLES `zl_ex_reportstyle_detail` WRITE;
/*!40000 ALTER TABLE `zl_ex_reportstyle_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_ex_reportstyle_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_exchangerate`
--

DROP TABLE IF EXISTS `zl_exchangerate`;


CREATE TABLE `zl_exchangerate` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `exchangeratedate` varchar(50) DEFAULT NULL,
                                 `exportcurrency` int(10) unsigned DEFAULT NULL COMMENT '汇出币种',
                                 `importcurrency` int(10) unsigned DEFAULT NULL COMMENT '汇入币种',
                                 `exchangerate` decimal(10,5) DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='汇率';


--
-- Dumping data for table `zl_exchangerate`
--

LOCK TABLES `zl_exchangerate` WRITE;
/*!40000 ALTER TABLE `zl_exchangerate` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_exchangerate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_executioncategory`
--

DROP TABLE IF EXISTS `zl_executioncategory`;


CREATE TABLE `zl_executioncategory` (
                                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                      `sys_create_stuff` int(10) unsigned NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) unsigned NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                      `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                      `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                      `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                      `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                      `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                      `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                      `executionmatter` varchar(500) DEFAULT NULL,
                                      `memo_cn` text COMMENT '中文备注',
                                      `memo_en` text COMMENT '英文备注',
                                      `memo_hk` text COMMENT '粤语备注',
                                      `memo_fr` text COMMENT '法语备注',
                                      `memo_it` text COMMENT '意大利语备注',
                                      `memo_sp` text COMMENT '西班牙语备注',
                                      `memo_de` text COMMENT '德语备注',
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='执行标准';


--
-- Dumping data for table `zl_executioncategory`
--

LOCK TABLES `zl_executioncategory` WRITE;
/*!40000 ALTER TABLE `zl_executioncategory` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_executioncategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_exhibition`
--

DROP TABLE IF EXISTS `zl_exhibition`;


CREATE TABLE `zl_exhibition` (
                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                               `sys_create_stuff` int(10) unsigned NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                               `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                               `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                               `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                               `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                               `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                               `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                               `memo_cn` text COMMENT '中文备注',
                               `memo_en` text COMMENT '英文备注',
                               `memo_hk` text COMMENT '粤语备注',
                               `memo_fr` text COMMENT '法语备注',
                               `memo_it` text COMMENT '意大利语备注',
                               `memo_sp` text COMMENT '西班牙语备注',
                               `memo_de` text COMMENT '德语备注',
                               `status` varchar(1) DEFAULT NULL COMMENT '0-不可用 1-可用',
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='展会';


--
-- Dumping data for table `zl_exhibition`
--

LOCK TABLES `zl_exhibition` WRITE;
/*!40000 ALTER TABLE `zl_exhibition` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_exhibition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_feenames`
--

DROP TABLE IF EXISTS `zl_feenames`;


CREATE TABLE `zl_feenames` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `code` varchar(20) DEFAULT NULL,
                             `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                             `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                             `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                             `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                             `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                             `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                             `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                             `kmid` int(10) unsigned DEFAULT NULL,
                             `isamortize` tinyint(4) DEFAULT NULL COMMENT '0-不摊销 1-金额摊销 2-件数摊销',
                             `isused` varchar(1) DEFAULT NULL COMMENT '0-不常用 1-常用',
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='费用名称';


--
-- Dumping data for table `zl_feenames`
--

LOCK TABLES `zl_feenames` WRITE;
/*!40000 ALTER TABLE `zl_feenames` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_feenames` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_forbiddenword`
--

DROP TABLE IF EXISTS `zl_forbiddenword`;


CREATE TABLE `zl_forbiddenword` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                  `memo_cn` text COMMENT '中文备注',
                                  `memo_en` text COMMENT '英文备注',
                                  `memo_hk` text COMMENT '粤语备注',
                                  `memo_fr` text COMMENT '法语备注',
                                  `memo_it` text COMMENT '意大利语备注',
                                  `memo_sp` text COMMENT '西班牙语备注',
                                  `memo_de` text COMMENT '德语备注',
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='违禁词';


--
-- Dumping data for table `zl_forbiddenword`
--

LOCK TABLES `zl_forbiddenword` WRITE;
/*!40000 ALTER TABLE `zl_forbiddenword` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_forbiddenword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_imagetool`
--

DROP TABLE IF EXISTS `zl_imagetool`;


CREATE TABLE `zl_imagetool` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                              `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                              `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                              `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                              `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                              `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                              `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                              `type` varchar(1) DEFAULT NULL COMMENT '0-修改尺寸\r\n            1-修改尺寸并添加\r\n            2-裁剪并对齐',
                              `width` int(11) DEFAULT NULL,
                              `height` int(11) DEFAULT NULL,
                              `isneed` varchar(1) DEFAULT NULL,
                              `quality` int(11) DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='图片导出方式';


--
-- Dumping data for table `zl_imagetool`
--

LOCK TABLES `zl_imagetool` WRITE;
/*!40000 ALTER TABLE `zl_imagetool` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_imagetool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_invite_rule`
--

DROP TABLE IF EXISTS `zl_invite_rule`;


CREATE TABLE `zl_invite_rule` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `bonus` bigint(20) DEFAULT NULL,
                                `memo_cn` text COMMENT '中文备注',
                                `memo_en` text COMMENT '英文备注',
                                `memo_hk` text COMMENT '粤语备注',
                                `memo_fr` text COMMENT '法语备注',
                                `memo_it` text COMMENT '意大利语备注',
                                `memo_sp` text COMMENT '西班牙语备注',
                                `memo_de` text COMMENT '德语备注',
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员邀请规则';


--
-- Dumping data for table `zl_invite_rule`
--

LOCK TABLES `zl_invite_rule` WRITE;
/*!40000 ALTER TABLE `zl_invite_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_invite_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_invoice_header`
--

DROP TABLE IF EXISTS `zl_invoice_header`;


CREATE TABLE `zl_invoice_header` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `supplierid` int(10) unsigned DEFAULT NULL,
                                   `header` varchar(50) DEFAULT NULL,
                                   `memo_cn` text COMMENT '中文备注',
                                   `memo_en` text COMMENT '英文备注',
                                   `memo_hk` text COMMENT '粤语备注',
                                   `memo_fr` text COMMENT '法语备注',
                                   `memo_it` text COMMENT '意大利语备注',
                                   `memo_sp` text COMMENT '西班牙语备注',
                                   `memo_de` text COMMENT '德语备注',
                                   `isdefault` varchar(1) DEFAULT NULL COMMENT '1-默认 0-非默认',
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='客户 发票抬头';


--
-- Dumping data for table `zl_invoice_header`
--

LOCK TABLES `zl_invoice_header` WRITE;
/*!40000 ALTER TABLE `zl_invoice_header` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_invoice_header` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_language`
--

DROP TABLE IF EXISTS `zl_language`;


CREATE TABLE `zl_language` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `name` varchar(50) NOT NULL,
                             `code` varchar(20) NOT NULL,
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             PRIMARY KEY (`id`),
                             UNIQUE KEY `zl_language_name` (`name`),
                             UNIQUE KEY `zl_language_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='语言表';


--
-- Dumping data for table `zl_language`
--

LOCK TABLES `zl_language` WRITE;
/*!40000 ALTER TABLE `zl_language` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_material`
--

DROP TABLE IF EXISTS `zl_material`;


CREATE TABLE `zl_material` (
                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                             `sys_create_stuff` int(10) unsigned NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) unsigned NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                             `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                             `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                             `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                             `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                             `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                             `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                             `code` varchar(20) DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='材质';


--
-- Dumping data for table `zl_material`
--

LOCK TABLES `zl_material` WRITE;
/*!40000 ALTER TABLE `zl_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_materialnote`
--

DROP TABLE IF EXISTS `zl_materialnote`;


CREATE TABLE `zl_materialnote` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `content_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                 `content_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                 `content_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                 `content_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                 `content_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                 `content_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                 `content_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='材质备注';


--
-- Dumping data for table `zl_materialnote`
--

LOCK TABLES `zl_materialnote` WRITE;
/*!40000 ALTER TABLE `zl_materialnote` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_materialnote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_materialstatus`
--

DROP TABLE IF EXISTS `zl_materialstatus`;


CREATE TABLE `zl_materialstatus` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `code` varchar(20) DEFAULT NULL,
                                   `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                   `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                   `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                   `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                   `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                   `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                   `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='材质状态';


--
-- Dumping data for table `zl_materialstatus`
--

LOCK TABLES `zl_materialstatus` WRITE;
/*!40000 ALTER TABLE `zl_materialstatus` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_materialstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_memberlevel`
--

DROP TABLE IF EXISTS `zl_memberlevel`;


CREATE TABLE `zl_memberlevel` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                `discount` decimal(16,9) DEFAULT NULL,
                                `levelbasicscore` bigint(20) DEFAULT NULL,
                                `integralrule` decimal(16,9) DEFAULT NULL COMMENT '实际成交价格x积分规则=获得积分',
                                `exchangerule` decimal(16,9) DEFAULT NULL COMMENT '积分x对换规则=可兑换金额',
                                `levelcontent` varchar(50) DEFAULT NULL,
                                `isretail` varchar(1) DEFAULT NULL COMMENT '0-非零售等级，不能升级，1-零售等级，可以升级',
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员等级设置';


--
-- Dumping data for table `zl_memberlevel`
--

LOCK TABLES `zl_memberlevel` WRITE;
/*!40000 ALTER TABLE `zl_memberlevel` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_memberlevel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_occasionsstyle`
--

DROP TABLE IF EXISTS `zl_occasionsstyle`;


CREATE TABLE `zl_occasionsstyle` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                   `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                   `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                   `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                   `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                   `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                   `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                   `occasionsstylemode` varchar(200) DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='场合风格';


--
-- Dumping data for table `zl_occasionsstyle`
--

LOCK TABLES `zl_occasionsstyle` WRITE;
/*!40000 ALTER TABLE `zl_occasionsstyle` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_occasionsstyle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_pricesource`
--

DROP TABLE IF EXISTS `zl_pricesource`;


CREATE TABLE `zl_pricesource` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                `memo_cn` text COMMENT '中文备注',
                                `memo_en` text COMMENT '英文备注',
                                `memo_hk` text COMMENT '粤语备注',
                                `memo_fr` text COMMENT '法语备注',
                                `memo_it` text COMMENT '意大利语备注',
                                `memo_sp` text COMMENT '西班牙语备注',
                                `memo_de` text COMMENT '德语备注',
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='价格来源';


--
-- Dumping data for table `zl_pricesource`
--

LOCK TABLES `zl_pricesource` WRITE;
/*!40000 ALTER TABLE `zl_pricesource` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_pricesource` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_productdscrb`
--

DROP TABLE IF EXISTS `zl_productdscrb`;


CREATE TABLE `zl_productdscrb` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                 `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                 `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                 `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                 `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                 `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                 `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                 `memo_cn` text COMMENT '中文备注',
                                 `memo_en` text COMMENT '英文备注',
                                 `memo_hk` text COMMENT '粤语备注',
                                 `memo_fr` text COMMENT '法语备注',
                                 `memo_it` text COMMENT '意大利语备注',
                                 `memo_sp` text COMMENT '西班牙语备注',
                                 `memo_de` text COMMENT '德语备注',
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品描述';


--
-- Dumping data for table `zl_productdscrb`
--

LOCK TABLES `zl_productdscrb` WRITE;
/*!40000 ALTER TABLE `zl_productdscrb` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_productdscrb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_productinnards`
--

DROP TABLE IF EXISTS `zl_productinnards`;


CREATE TABLE `zl_productinnards` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                   `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                   `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                   `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                   `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                   `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                   `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='内部结构';


--
-- Dumping data for table `zl_productinnards`
--

LOCK TABLES `zl_productinnards` WRITE;
/*!40000 ALTER TABLE `zl_productinnards` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_productinnards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_productparts`
--

DROP TABLE IF EXISTS `zl_productparts`;


CREATE TABLE `zl_productparts` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `partscode` varchar(50) DEFAULT NULL,
                                 `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                 `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                 `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                 `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                 `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                 `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                 `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                 `packflag` varchar(1) DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='附带配件\r\n';


--
-- Dumping data for table `zl_productparts`
--

LOCK TABLES `zl_productparts` WRITE;
/*!40000 ALTER TABLE `zl_productparts` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_productparts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_productprice`
--

DROP TABLE IF EXISTS `zl_productprice`;


CREATE TABLE `zl_productprice` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                 `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                 `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                 `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                 `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                 `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                 `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                 `isdefault` varchar(1) DEFAULT NULL COMMENT '0 - 默认\r\n            1 - 不默认',
                                 `curreancyid` int(10) unsigned DEFAULT NULL,
                                 `sortnum` varchar(4) DEFAULT NULL,
                                 `isround` varchar(1) DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品销售价格 国内外零售价、批发价';


--
-- Dumping data for table `zl_productprice`
--

LOCK TABLES `zl_productprice` WRITE;
/*!40000 ALTER TABLE `zl_productprice` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_productprice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_productstyle`
--

DROP TABLE IF EXISTS `zl_productstyle`;


CREATE TABLE `zl_productstyle` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `brandgroup` int(10) unsigned DEFAULT NULL,
                                 `childbrand` int(10) unsigned DEFAULT NULL,
                                 `productstyle` varchar(10) DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品款号';


--
-- Dumping data for table `zl_productstyle`
--

LOCK TABLES `zl_productstyle` WRITE;
/*!40000 ALTER TABLE `zl_productstyle` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_productstyle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_producttemplate`
--

DROP TABLE IF EXISTS `zl_producttemplate`;


CREATE TABLE `zl_producttemplate` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                    `sys_create_stuff` int(10) unsigned NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                    `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                    `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                    `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                    `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                    `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                    `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                    `picture` varchar(200) DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品模板-主表';


--
-- Dumping data for table `zl_producttemplate`
--

LOCK TABLES `zl_producttemplate` WRITE;
/*!40000 ALTER TABLE `zl_producttemplate` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_producttemplate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_quotedprice`
--

DROP TABLE IF EXISTS `zl_quotedprice`;


CREATE TABLE `zl_quotedprice` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `s_id` varchar(50) DEFAULT NULL,
                                `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                `quotedprice` decimal(10,0) DEFAULT NULL,
                                `quoteddate` datetime DEFAULT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='zl_quotedprice';


--
-- Dumping data for table `zl_quotedprice`
--

LOCK TABLES `zl_quotedprice` WRITE;
/*!40000 ALTER TABLE `zl_quotedprice` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_quotedprice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_reportset`
--

DROP TABLE IF EXISTS `zl_reportset`;


CREATE TABLE `zl_reportset` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `code` varchar(50) DEFAULT NULL,
                              `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                              `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                              `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                              `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                              `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                              `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                              `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                              `memo_cn` text COMMENT '中文备注',
                              `memo_en` text COMMENT '英文备注',
                              `memo_hk` text COMMENT '粤语备注',
                              `memo_fr` text COMMENT '法语备注',
                              `memo_it` text COMMENT '意大利语备注',
                              `memo_sp` text COMMENT '西班牙语备注',
                              `memo_de` text COMMENT '德语备注',
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='报表样式设置';


--
-- Dumping data for table `zl_reportset`
--

LOCK TABLES `zl_reportset` WRITE;
/*!40000 ALTER TABLE `zl_reportset` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_reportset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_reportset_detail`
--

DROP TABLE IF EXISTS `zl_reportset_detail`;


CREATE TABLE `zl_reportset_detail` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `setid` int(10) unsigned DEFAULT NULL,
                                     `code_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                     `code_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                     `code_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                     `code_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                     `code_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                     `code_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                     `code_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                     `index` int(11) DEFAULT NULL,
                                     `width` int(11) DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='报表样式设置明细';


--
-- Dumping data for table `zl_reportset_detail`
--

LOCK TABLES `zl_reportset_detail` WRITE;
/*!40000 ALTER TABLE `zl_reportset_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_reportset_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_salesmethods`
--

DROP TABLE IF EXISTS `zl_salesmethods`;


CREATE TABLE `zl_salesmethods` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                 `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                 `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                 `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                 `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                 `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                 `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                 `salesmethodsmode` varchar(200) DEFAULT NULL,
                                 `brandtype` int(10) unsigned DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售方式';


--
-- Dumping data for table `zl_salesmethods`
--

LOCK TABLES `zl_salesmethods` WRITE;
/*!40000 ALTER TABLE `zl_salesmethods` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_salesmethods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_salesport`
--

DROP TABLE IF EXISTS `zl_salesport`;


CREATE TABLE `zl_salesport` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `protname_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                              `protname_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                              `protname_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                              `protname_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                              `protname_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                              `protname_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                              `protname_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                              `memo_cn` text COMMENT '中文备注',
                              `memo_en` text COMMENT '英文备注',
                              `memo_hk` text COMMENT '粤语备注',
                              `memo_fr` text COMMENT '法语备注',
                              `memo_it` text COMMENT '意大利语备注',
                              `memo_sp` text COMMENT '西班牙语备注',
                              `memo_de` text COMMENT '德语备注',
                              `storename_cn` varchar(1000) DEFAULT NULL COMMENT '中文名称',
                              `storename_en` varchar(1000) DEFAULT NULL COMMENT '英文名称',
                              `storename_hk` varchar(1000) DEFAULT NULL COMMENT '粤语名称',
                              `storename_fr` varchar(1000) DEFAULT NULL COMMENT '法语名称',
                              `storename_it` varchar(1000) DEFAULT NULL COMMENT '意大利语名称',
                              `storename_sp` varchar(1000) DEFAULT NULL COMMENT '西班牙语名称',
                              `storename_de` varchar(1000) DEFAULT NULL COMMENT '德语名称',
                              `isonline` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                              `address_cn` varchar(100) DEFAULT NULL COMMENT '中文地址',
                              `address_en` varchar(100) DEFAULT NULL COMMENT '英文地址',
                              `address_hk` varchar(100) DEFAULT NULL COMMENT '粤语地址',
                              `address_fr` varchar(100) DEFAULT NULL COMMENT '法语地址',
                              `address_it` varchar(100) DEFAULT NULL COMMENT '意大利语地址',
                              `address_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语地址',
                              `address_de` varchar(100) DEFAULT NULL COMMENT '德语地址',
                              `tel` varchar(50) DEFAULT NULL,
                              `isused` varchar(1) DEFAULT NULL,
                              `iskd` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                              `postmemo` text,
                              `cusid` int(10) unsigned DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口基础资料';


--
-- Dumping data for table `zl_salesport`
--

LOCK TABLES `zl_salesport` WRITE;
/*!40000 ALTER TABLE `zl_salesport` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_salesport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_salesport_mission`
--

DROP TABLE IF EXISTS `zl_salesport_mission`;


CREATE TABLE `zl_salesport_mission` (
                                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                      `sys_create_stuff` int(10) unsigned NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) unsigned NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `salespotid` int(10) unsigned DEFAULT NULL,
                                      `yearmonth` varchar(10) DEFAULT NULL COMMENT '格式为201801',
                                      `salesum` decimal(10,2) DEFAULT NULL,
                                      `profit` decimal(10,2) DEFAULT NULL,
                                      `rate` decimal(10,2) DEFAULT NULL,
                                      `memo_cn` text COMMENT '中文备注',
                                      `memo_en` text COMMENT '英文备注',
                                      `memo_hk` text COMMENT '粤语备注',
                                      `memo_fr` text COMMENT '法语备注',
                                      `memo_it` text COMMENT '意大利语备注',
                                      `memo_sp` text COMMENT '西班牙语备注',
                                      `memo_de` text COMMENT '德语备注',
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口任务额';


--
-- Dumping data for table `zl_salesport_mission`
--

LOCK TABLES `zl_salesport_mission` WRITE;
/*!40000 ALTER TABLE `zl_salesport_mission` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_salesport_mission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_securitycategory`
--

DROP TABLE IF EXISTS `zl_securitycategory`;


CREATE TABLE `zl_securitycategory` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                     `sys_create_stuff` int(10) unsigned NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) unsigned NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                     `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                     `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                     `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                     `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                     `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                     `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                     `item_cn` varchar(200) DEFAULT NULL COMMENT '中文事项',
                                     `item_en` varchar(200) DEFAULT NULL COMMENT '英文事项',
                                     `item_hk` varchar(200) DEFAULT NULL COMMENT '粤语事项',
                                     `item_fr` varchar(200) DEFAULT NULL COMMENT '法语事项',
                                     `item_it` varchar(200) DEFAULT NULL COMMENT '意大利语事项',
                                     `item_sp` varchar(200) DEFAULT NULL COMMENT '西班牙语事项',
                                     `item_de` varchar(200) DEFAULT NULL COMMENT '德语事项',
                                     `memo_cn` text COMMENT '中文备注',
                                     `memo_en` text COMMENT '英文备注',
                                     `memo_hk` text COMMENT '粤语备注',
                                     `memo_fr` text COMMENT '法语备注',
                                     `memo_it` text COMMENT '意大利语备注',
                                     `memo_sp` text COMMENT '西班牙语备注',
                                     `memo_de` text COMMENT '德语备注',
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='安全类别维护表';


--
-- Dumping data for table `zl_securitycategory`
--

LOCK TABLES `zl_securitycategory` WRITE;
/*!40000 ALTER TABLE `zl_securitycategory` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_securitycategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_series`
--

DROP TABLE IF EXISTS `zl_series`;


CREATE TABLE `zl_series` (
                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                           `sys_create_stuff` int(10) unsigned NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) unsigned NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                           `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                           `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                           `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                           `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                           `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                           `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                           `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                           `code` varchar(100) DEFAULT NULL COMMENT '代码名称',
                           `brandid` int(10) unsigned DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';


--
-- Dumping data for table `zl_series`
--

LOCK TABLES `zl_series` WRITE;
/*!40000 ALTER TABLE `zl_series` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_series2`
--

DROP TABLE IF EXISTS `zl_series2`;


CREATE TABLE `zl_series2` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                            `sys_create_stuff` int(10) unsigned NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `seriesid` int(10) unsigned DEFAULT NULL,
                            `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                            `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                            `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                            `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                            `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                            `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                            `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                            `code` varchar(100) DEFAULT NULL COMMENT '代码名称',
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='子系列';


--
-- Dumping data for table `zl_series2`
--

LOCK TABLES `zl_series2` WRITE;
/*!40000 ALTER TABLE `zl_series2` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_series2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_shippingtype`
--

DROP TABLE IF EXISTS `zl_shippingtype`;


CREATE TABLE `zl_shippingtype` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `code` varchar(10) DEFAULT NULL,
                                 `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                 `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                 `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                 `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                 `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                 `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                 `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                 `memo_cn` text COMMENT '中文备注',
                                 `memo_en` text COMMENT '英文备注',
                                 `memo_hk` text COMMENT '粤语备注',
                                 `memo_fr` text COMMENT '法语备注',
                                 `memo_it` text COMMENT '意大利语备注',
                                 `memo_sp` text COMMENT '西班牙语备注',
                                 `memo_de` text COMMENT '德语备注',
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='运输方式';


--
-- Dumping data for table `zl_shippingtype`
--

LOCK TABLES `zl_shippingtype` WRITE;
/*!40000 ALTER TABLE `zl_shippingtype` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_shippingtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_sizecontent`
--

DROP TABLE IF EXISTS `zl_sizecontent`;


CREATE TABLE `zl_sizecontent` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                `sys_create_stuff` int(10) unsigned NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) unsigned NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `topid` int(10) unsigned DEFAULT NULL,
                                `content_cn` varchar(100) DEFAULT NULL COMMENT '中文代码名称',
                                `content_en` varchar(100) DEFAULT NULL COMMENT '英文代码名称',
                                `content_hk` varchar(100) DEFAULT NULL COMMENT '粤语代码名称',
                                `content_fr` varchar(100) DEFAULT NULL COMMENT '法语代码名称',
                                `content_it` varchar(100) DEFAULT NULL COMMENT '意大利语代码名称',
                                `content_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语代码名称',
                                `content_de` varchar(100) DEFAULT NULL COMMENT '德语代码名称',
                                `sortnum` int(11) DEFAULT NULL,
                                `memo_cn` text COMMENT '中文备注',
                                `memo_en` text COMMENT '英文备注',
                                `memo_hk` text COMMENT '粤语备注',
                                `memo_fr` text COMMENT '法语备注',
                                `memo_it` text COMMENT '意大利语备注',
                                `memo_sp` text COMMENT '西班牙语备注',
                                `memo_de` text COMMENT '德语备注',
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='尺码明细';


--
-- Dumping data for table `zl_sizecontent`
--

LOCK TABLES `zl_sizecontent` WRITE;
/*!40000 ALTER TABLE `zl_sizecontent` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_sizecontent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_sizetop`
--

DROP TABLE IF EXISTS `zl_sizetop`;


CREATE TABLE `zl_sizetop` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                            `sys_create_stuff` int(10) unsigned NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) unsigned NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                            `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                            `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                            `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                            `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                            `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                            `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                            `code` varchar(50) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='尺码组';


--
-- Dumping data for table `zl_sizetop`
--

LOCK TABLES `zl_sizetop` WRITE;
/*!40000 ALTER TABLE `zl_sizetop` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_sizetop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_storemove`
--

DROP TABLE IF EXISTS `zl_storemove`;


CREATE TABLE `zl_storemove` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `productid` int(10) unsigned DEFAULT NULL,
                              `storeid` int(10) unsigned DEFAULT NULL,
                              `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                              `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                              `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                              `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                              `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                              `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                              `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                              `movedate` datetime DEFAULT NULL,
                              `movestate` varchar(50) DEFAULT NULL,
                              `memo_cn` text COMMENT '中文备注',
                              `memo_en` text COMMENT '英文备注',
                              `memo_hk` text COMMENT '粤语备注',
                              `memo_fr` text COMMENT '法语备注',
                              `memo_it` text COMMENT '意大利语备注',
                              `memo_sp` text COMMENT '西班牙语备注',
                              `memo_de` text COMMENT '德语备注',
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='??未使用';


--
-- Dumping data for table `zl_storemove`
--

LOCK TABLES `zl_storemove` WRITE;
/*!40000 ALTER TABLE `zl_storemove` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_storemove` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_style`
--

DROP TABLE IF EXISTS `zl_style`;


CREATE TABLE `zl_style` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                          `sys_create_stuff` int(10) unsigned NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) unsigned NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                          `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                          `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                          `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                          `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                          `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                          `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                          `stylemode` varchar(200) DEFAULT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='未使用';


--
-- Dumping data for table `zl_style`
--

LOCK TABLES `zl_style` WRITE;
/*!40000 ALTER TABLE `zl_style` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_style` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_supplier_type`
--

DROP TABLE IF EXISTS `zl_supplier_type`;


CREATE TABLE `zl_supplier_type` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `supplierid` int(10) unsigned DEFAULT NULL,
                                  `type` varchar(1) DEFAULT NULL COMMENT '0-供货商 1-报关行 2-供应商 3-承运人 4-客户',
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='关系单位类型';


--
-- Dumping data for table `zl_supplier_type`
--

LOCK TABLES `zl_supplier_type` WRITE;
/*!40000 ALTER TABLE `zl_supplier_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_supplier_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_supplierlevel`
--

DROP TABLE IF EXISTS `zl_supplierlevel`;


CREATE TABLE `zl_supplierlevel` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                  `sys_create_stuff` int(10) unsigned NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) unsigned NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                  `memo_cn` varchar(1000) DEFAULT NULL COMMENT '中文备注',
                                  `memo_en` varchar(1000) DEFAULT NULL COMMENT '英文备注',
                                  `memo_hk` varchar(1000) DEFAULT NULL COMMENT '粤语备注',
                                  `memo_fr` varchar(1000) DEFAULT NULL COMMENT '法语备注',
                                  `memo_it` varchar(1000) DEFAULT NULL COMMENT '意大利语备注',
                                  `memo_sp` varchar(1000) DEFAULT NULL COMMENT '西班牙语备注',
                                  `memo_de` varchar(1000) DEFAULT NULL COMMENT '德语备注',
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='供货商级别';


--
-- Dumping data for table `zl_supplierlevel`
--

LOCK TABLES `zl_supplierlevel` WRITE;
/*!40000 ALTER TABLE `zl_supplierlevel` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_supplierlevel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_sys_selfcompany`
--

DROP TABLE IF EXISTS `zl_sys_selfcompany`;


CREATE TABLE `zl_sys_selfcompany` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                    `sys_create_stuff` int(10) unsigned NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `supplier_id` int(10) unsigned DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='分公司列表';


--
-- Dumping data for table `zl_sys_selfcompany`
--

LOCK TABLES `zl_sys_selfcompany` WRITE;
/*!40000 ALTER TABLE `zl_sys_selfcompany` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_sys_selfcompany` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_template_descrb`
--

DROP TABLE IF EXISTS `zl_template_descrb`;


CREATE TABLE `zl_template_descrb` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                    `sys_create_stuff` int(10) unsigned NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) unsigned NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `tempid` int(10) unsigned DEFAULT NULL,
                                    `sizetopid` int(10) unsigned DEFAULT NULL,
                                    `sizeid` int(10) unsigned DEFAULT NULL,
                                    `baselenth` decimal(10,2) DEFAULT NULL,
                                    `lenth` decimal(10,2) DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品模板-尺码大小描述';


--
-- Dumping data for table `zl_template_descrb`
--

LOCK TABLES `zl_template_descrb` WRITE;
/*!40000 ALTER TABLE `zl_template_descrb` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_template_descrb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_templatelist`
--

DROP TABLE IF EXISTS `zl_templatelist`;


CREATE TABLE `zl_templatelist` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `templateid` int(10) unsigned DEFAULT NULL,
                                 `sizeid` int(10) unsigned DEFAULT NULL,
                                 `content_cn` varchar(1000) DEFAULT NULL COMMENT '中文备注',
                                 `content_en` varchar(1000) DEFAULT NULL COMMENT '英文备注',
                                 `content_hk` varchar(1000) DEFAULT NULL COMMENT '粤语备注',
                                 `content_fr` varchar(1000) DEFAULT NULL COMMENT '法语备注',
                                 `content_it` varchar(1000) DEFAULT NULL COMMENT '意大利语备注',
                                 `content_sp` varchar(1000) DEFAULT NULL COMMENT '西班牙语备注',
                                 `content_de` varchar(1000) DEFAULT NULL COMMENT '德语备注',
                                 `productid` int(10) unsigned DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品模板-数据表';


--
-- Dumping data for table `zl_templatelist`
--

LOCK TABLES `zl_templatelist` WRITE;
/*!40000 ALTER TABLE `zl_templatelist` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_templatelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_templatemanage`
--

DROP TABLE IF EXISTS `zl_templatemanage`;


CREATE TABLE `zl_templatemanage` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                   `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                   `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                   `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                   `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                   `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                   `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                   `tempid` int(10) unsigned DEFAULT NULL,
                                   `sortnum` int(11) DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品模板-从表';


--
-- Dumping data for table `zl_templatemanage`
--

LOCK TABLES `zl_templatemanage` WRITE;
/*!40000 ALTER TABLE `zl_templatemanage` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_templatemanage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_trans_code`
--

DROP TABLE IF EXISTS `zl_trans_code`;


CREATE TABLE `zl_trans_code` (
                               `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                               `sys_create_stuff` int(10) unsigned NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) unsigned NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                               `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                               `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                               `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                               `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                               `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                               `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                               `code` varchar(50) DEFAULT NULL,
                               `memo_cn` text COMMENT '中文备注',
                               `memo_en` text COMMENT '英文备注',
                               `memo_hk` text COMMENT '粤语备注',
                               `memo_fr` text COMMENT '法语备注',
                               `memo_it` text COMMENT '意大利语备注',
                               `memo_sp` text COMMENT '西班牙语备注',
                               `memo_de` text COMMENT '德语备注',
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='接口基础资料';


--
-- Dumping data for table `zl_trans_code`
--

LOCK TABLES `zl_trans_code` WRITE;
/*!40000 ALTER TABLE `zl_trans_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_trans_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_ulnarinch`
--

DROP TABLE IF EXISTS `zl_ulnarinch`;


CREATE TABLE `zl_ulnarinch` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                              `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                              `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                              `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                              `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                              `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                              `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';


--
-- Dumping data for table `zl_ulnarinch`
--

LOCK TABLES `zl_ulnarinch` WRITE;
/*!40000 ALTER TABLE `zl_ulnarinch` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_ulnarinch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_unit`
--

DROP TABLE IF EXISTS `zl_unit`;


CREATE TABLE `zl_unit` (
                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                         `sys_create_stuff` int(10) unsigned NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) unsigned NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                         `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                         `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                         `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                         `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                         `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                         `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                         `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                         `unitgroupid` varchar(50) DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='未使用';


--
-- Dumping data for table `zl_unit`
--

LOCK TABLES `zl_unit` WRITE;
/*!40000 ALTER TABLE `zl_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_unitgroup`
--

DROP TABLE IF EXISTS `zl_unitgroup`;


CREATE TABLE `zl_unitgroup` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                              `sys_create_stuff` int(10) unsigned NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) unsigned NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                              `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                              `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                              `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                              `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                              `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                              `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                              `memo_cn` text COMMENT '中文备注',
                              `memo_en` text COMMENT '英文备注',
                              `memo_hk` text COMMENT '粤语备注',
                              `memo_fr` text COMMENT '法语备注',
                              `memo_it` text COMMENT '意大利语备注',
                              `memo_sp` text COMMENT '西班牙语备注',
                              `memo_de` text COMMENT '德语备注',
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='zl_unitgroup';


--
-- Dumping data for table `zl_unitgroup`
--

LOCK TABLES `zl_unitgroup` WRITE;
/*!40000 ALTER TABLE `zl_unitgroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_unitgroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_washinginstructions`
--

DROP TABLE IF EXISTS `zl_washinginstructions`;


CREATE TABLE `zl_washinginstructions` (
                                        `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                        `sys_create_stuff` int(10) unsigned NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) unsigned NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                        `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                        `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                        `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                        `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                        `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                        `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                        `memo_cn` text COMMENT '中文备注',
                                        `memo_en` text COMMENT '英文备注',
                                        `memo_hk` text COMMENT '粤语备注',
                                        `memo_fr` text COMMENT '法语备注',
                                        `memo_it` text COMMENT '意大利语备注',
                                        `memo_sp` text COMMENT '西班牙语备注',
                                        `memo_de` text COMMENT '德语备注',
                                        `image` varchar(200) DEFAULT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='洗涤标准';


--
-- Dumping data for table `zl_washinginstructions`
--

LOCK TABLES `zl_washinginstructions` WRITE;
/*!40000 ALTER TABLE `zl_washinginstructions` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_washinginstructions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_winterproofing`
--

DROP TABLE IF EXISTS `zl_winterproofing`;


CREATE TABLE `zl_winterproofing` (
                                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                   `sys_create_stuff` int(10) unsigned NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) unsigned NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                   `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                   `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                   `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                   `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                   `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                   `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                   `memo_cn` text COMMENT '中文备注',
                                   `memo_en` text COMMENT '英文备注',
                                   `memo_hk` text COMMENT '粤语备注',
                                   `memo_fr` text COMMENT '法语备注',
                                   `memo_it` text COMMENT '意大利语备注',
                                   `memo_sp` text COMMENT '西班牙语备注',
                                   `memo_de` text COMMENT '德语备注',
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='防寒指数';


--
-- Dumping data for table `zl_winterproofing`
--

LOCK TABLES `zl_winterproofing` WRITE;
/*!40000 ALTER TABLE `zl_winterproofing` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_winterproofing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zl_yearexchange`
--

DROP TABLE IF EXISTS `zl_yearexchange`;


CREATE TABLE `zl_yearexchange` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
                                 `sys_create_stuff` int(10) unsigned NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) unsigned NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) unsigned DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `yeardate` varchar(50) DEFAULT NULL,
                                 `money` decimal(16,9) DEFAULT NULL COMMENT 'import:export',
                                 `begintime` datetime DEFAULT NULL,
                                 `endtime` datetime DEFAULT NULL,
                                 `import` int(10) unsigned DEFAULT NULL,
                                 `export` int(10) unsigned DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';


--
-- Dumping data for table `zl_yearexchange`
--

LOCK TABLES `zl_yearexchange` WRITE;
/*!40000 ALTER TABLE `zl_yearexchange` DISABLE KEYS */;
/*!40000 ALTER TABLE `zl_yearexchange` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;





--
-- 转存表中的数据 `tb_permission`
--

INSERT INTO `tb_permission` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `pid`, `name`, `memo_cn`, `memo_en`, `memo_hk`, `memo_fr`, `memo_it`, `memo_sp`, `memo_de`, `is_only_superadmin`) VALUES
(1, 1, '2019-03-08 13:37:45', 1, '2019-03-08 13:37:45', NULL, NULL, 0, 0, 'userControl', '用户管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 1, '2019-03-08 13:40:21', 1, '2019-03-08 13:40:21', NULL, NULL, 0, 0, 'databaseControl', '基础数据', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 1, '2019-03-08 13:42:08', 1, '2019-03-08 13:42:08', NULL, NULL, 0, 0, 'productControl', '商品管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(4, 1, '2019-03-08 13:43:12', 1, '2019-03-08 13:43:12', NULL, NULL, 0, 0, 'customControl', '客户管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(5, 1, '2019-03-08 13:45:10', 1, '2019-03-08 13:45:10', NULL, NULL, 0, 0, 'supplierControl', '供应链管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(6, 1, '2019-03-08 13:45:34', 1, '2019-03-08 13:45:34', NULL, NULL, 0, 0, 'stockControl', '库存管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(7, 1, '2019-03-08 13:46:13', 1, '2019-03-08 13:46:13', NULL, NULL, 0, 0, 'salesControl', '销售管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(8, 1, '2019-03-08 13:46:40', 1, '2019-03-08 13:46:40', NULL, NULL, 0, 0, 'memberControl', '会员管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(9, 1, '2019-03-08 13:47:16', 1, '2019-03-08 13:47:16', NULL, NULL, 0, 0, 'costControl', '费用管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(10, 1, '2019-03-08 13:48:08', 1, '2019-03-08 13:48:08', NULL, NULL, 0, 0, 'financialControl', '财务管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(11, 1, '2019-03-08 13:48:42', 1, '2019-03-08 13:48:42', NULL, NULL, 0, 0, 'systemControl', '系统管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(12, 1, '2019-03-08 13:50:11', 1, '2019-03-08 13:50:11', NULL, NULL, 0, 1, 'user', '员工信息', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(13, 1, '2019-03-08 13:51:06', 1, '2019-03-08 13:51:06', NULL, NULL, 0, 1, 'group', '组信息', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(14, 1, '2019-03-08 13:51:24', 1, '2019-03-08 13:51:24', NULL, NULL, 0, 1, 'department', '部门信息', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(15, 1, '2019-03-08 13:52:10', 1, '2019-03-08 13:52:10', NULL, NULL, 0, 2, 'productRelate', '商品相关', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(16, 1, '2019-03-08 13:52:45', 1, '2019-03-08 13:52:45', NULL, NULL, 0, 2, 'priceRelate', '价格相关', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(17, 1, '2019-03-08 13:56:20', 1, '2019-03-08 13:56:20', NULL, NULL, 0, 2, 'otherRelate', '其他', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(18, 1, '2019-03-08 13:57:31', 1, '2019-03-08 13:57:31', NULL, NULL, 0, 3, 'product', '商品信息', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(19, 1, '2019-03-08 13:57:53', 1, '2019-03-08 13:57:53', NULL, NULL, 0, 3, 'picture', '图片管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(20, 1, '2019-03-08 14:04:10', 1, '2019-03-08 14:04:10', NULL, NULL, 0, 3, 'pictureupload', '图片上传', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(21, 1, '2019-03-08 14:06:34', 1, '2019-03-08 14:06:34', NULL, NULL, 0, 4, 'supplier', '关系单位信息', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(22, 1, '2019-03-08 14:12:25', 1, '2019-03-08 14:12:25', NULL, NULL, 0, 4, 'quotation', '供货商报价', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(23, 1, '2019-03-08 14:17:08', 1, '2019-03-08 14:17:08', NULL, NULL, 0, 4, 'supplierlevel', '供货商级别', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(24, 1, '2019-03-08 14:20:47', 1, '2019-03-08 14:20:47', NULL, NULL, 0, 5, 'orderRelate', '订单管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(25, 1, '2019-03-08 14:27:24', 1, '2019-03-08 14:27:24', NULL, NULL, 0, 5, 'confirmorder', '发货单管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(26, 1, '2019-03-08 14:34:21', 1, '2019-03-08 14:34:21', NULL, NULL, 0, 5, 'warehousingRelate', '到货入库', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(27, 1, '2019-03-08 14:35:59', 1, '2019-03-08 14:35:59', NULL, NULL, 0, 6, 'requisitionRelate', '调拨相关', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(28, 1, '2019-03-08 14:48:07', 1, '2019-03-08 14:48:07', NULL, NULL, 0, 6, 'checkRelate', '库存盘点', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(29, 1, '2019-03-08 15:12:48', 1, '2019-03-08 15:12:48', NULL, NULL, 0, 6, 'stocksnapshot', '库存余额查询', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(30, 1, '2019-03-08 15:13:20', 1, '2019-03-08 15:13:20', NULL, NULL, 0, 6, 'productstock', '库存查询', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(31, 1, '2019-03-08 15:14:05', 1, '2019-03-08 15:14:05', NULL, NULL, 0, 6, 'productstockSnapshot', '库存快照统计', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(32, 1, '2019-03-08 15:18:29', 1, '2019-03-08 15:18:29', NULL, NULL, 0, 7, 'sales', '商品零售批发', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(33, 1, '2019-03-08 15:28:36', 1, '2019-03-08 15:28:36', NULL, NULL, 0, 7, 'salesstock', '销售端口库存统计', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(34, 1, '2019-03-08 15:37:15', 1, '2019-03-08 15:37:15', NULL, NULL, 0, 7, 'sfRelate', '销售对账', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(35, 1, '2019-03-08 15:38:04', 1, '2019-03-08 15:38:04', NULL, NULL, 0, 7, 'sale/statistics', '销售统计', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(36, 1, '2019-03-08 15:39:08', 1, '2019-03-08 15:39:08', NULL, NULL, 0, 8, 'member', '会员管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(37, 1, '2019-03-08 15:39:37', 1, '2019-03-08 15:39:37', NULL, NULL, 0, 8, 'memberlevel', '会员级别', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(38, 1, '2019-03-08 16:04:26', 1, '2019-03-08 16:04:26', NULL, NULL, 0, 9, 'fee', '费用申请', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(39, 1, '2019-03-08 16:08:03', 1, '2019-03-08 16:08:03', NULL, NULL, 0, 9, 'fee/leader', '费用申请主管审批', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(40, 1, '2019-03-08 16:08:30', 1, '2019-03-08 16:08:30', NULL, NULL, 0, 9, 'fee/finance', '费用申请财务审批', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(41, 1, '2019-03-08 16:10:11', 1, '2019-03-08 16:10:11', NULL, NULL, 0, 9, 'fee/manager', '费用申请经理审批', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(42, 1, '2019-03-08 16:12:20', 1, '2019-03-08 16:12:20', NULL, NULL, 0, 10, 'sfsheet', '对账查询', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(43, 1, '2019-03-08 16:18:42', 1, '2019-03-08 16:18:42', NULL, NULL, 0, 11, 'help', '系统帮助', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(44, 1, '2019-03-08 16:20:49', 1, '2019-03-08 16:20:49', NULL, NULL, 0, 11, 'modifypassword', '修改密码', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(45, 1, '2019-03-08 16:21:09', 1, '2019-03-08 16:21:09', NULL, NULL, 0, 11, 'logout', '退出登录', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(46, 1, '2019-03-08 17:33:06', 1, '2019-03-08 17:33:06', NULL, NULL, 0, 15, 'brand', '品牌维护', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(47, 1, '2019-03-08 17:33:41', 1, '2019-03-08 17:33:41', NULL, NULL, 0, 15, 'brandgroup', '品类维护', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(48, 1, '2019-03-08 17:37:24', 1, '2019-03-08 17:37:24', NULL, NULL, 0, 15, 'ageseason', '款式年代', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(49, 1, '2019-03-08 17:40:43', 1, '2019-03-08 17:40:43', NULL, NULL, 0, 15, 'colortemplate', '颜色模板', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(50, 1, '2019-03-08 17:41:02', 1, '2019-03-08 17:41:02', NULL, NULL, 0, 15, 'sizetop', '商品尺码', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(51, 1, '2019-03-08 17:41:20', 1, '2019-03-08 17:41:20', NULL, NULL, 0, 15, 'material', '材质管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(52, 1, '2019-03-08 17:41:39', 1, '2019-03-08 17:41:39', NULL, NULL, 0, 15, 'ulnarinch', '商品尺寸', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(53, 1, '2019-03-08 17:41:58', 1, '2019-03-08 17:41:58', NULL, NULL, 0, 15, 'aliases', '商品别名', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(54, 1, '2019-03-08 17:42:16', 1, '2019-03-08 17:42:16', NULL, NULL, 0, 15, 'productinnards', '内部结构', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(55, 1, '2019-03-08 17:42:35', 1, '2019-03-08 17:42:35', NULL, NULL, 0, 15, 'productparts', '附带配件', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(56, 1, '2019-03-08 17:42:52', 1, '2019-03-08 17:42:52', NULL, NULL, 0, 15, 'occasionsstyle', '场合风格', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(57, 1, '2019-03-08 17:49:10', 1, '2019-03-08 17:49:10', NULL, NULL, 0, 15, 'closedway', '闭合方式', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(58, 1, '2019-03-08 17:50:10', 1, '2019-03-08 17:50:10', NULL, NULL, 0, 15, 'executioncategory', '执行标准', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(59, 1, '2019-03-08 17:50:26', 1, '2019-03-08 17:50:26', NULL, NULL, 0, 15, 'securitycategory', '安全类别', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(60, 1, '2019-03-08 17:50:56', 1, '2019-03-08 17:50:56', NULL, NULL, 0, 15, 'washinginstructions', '洗涤说明', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(61, 1, '2019-03-08 17:51:32', 1, '2019-03-08 17:51:32', NULL, NULL, 0, 15, 'winterproofing', '防寒指数', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(62, 1, '2019-03-08 17:55:31', 1, '2019-03-08 17:55:31', NULL, NULL, 0, 16, 'productprice', '商品价格管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(63, 1, '2019-03-08 17:55:52', 1, '2019-03-08 17:55:52', NULL, NULL, 0, 16, 'costformula', '成本计算管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(64, 1, '2019-03-08 17:56:56', 1, '2019-03-08 17:56:56', NULL, NULL, 0, 17, 'warehouse', '仓库管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(65, 1, '2019-03-08 17:57:20', 1, '2019-03-08 17:57:20', NULL, NULL, 0, 17, 'salesport', '销售端口管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(66, 1, '2019-03-08 17:57:40', 1, '2019-03-08 17:57:40', NULL, NULL, 0, 17, 'country', '国际及地区信息维护', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(67, 1, '2019-03-08 17:58:11', 1, '2019-03-08 17:58:11', NULL, NULL, 0, 17, 'feenames', '费用名称', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(68, 1, '2019-03-08 17:58:31', 1, '2019-03-08 17:58:31', NULL, NULL, 0, 17, 'shippingtype', '运输方式', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(69, 1, '2019-03-08 17:58:53', 1, '2019-03-08 17:58:53', NULL, NULL, 0, 17, 'salesmethods', '销售性质', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(70, 1, '2019-03-08 17:59:10', 1, '2019-03-08 17:59:10', NULL, NULL, 0, 17, 'businesstype', '业务类型', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(71, 1, '2019-03-08 17:59:26', 1, '2019-03-08 17:59:26', NULL, NULL, 0, 17, 'reportstyle', '快递单样式', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(72, 1, '2019-03-08 17:59:51', 1, '2019-03-08 17:59:51', NULL, NULL, 0, 17, 'imagetool', '图片工具', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(73, 1, '2019-03-08 18:07:56', 1, '2019-03-08 18:07:56', NULL, NULL, 0, 24, 'order', '订单管理', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(74, 1, '2019-03-08 18:11:11', 1, '2019-03-08 18:11:11', NULL, NULL, 0, 24, 'order/search', '订单状态查询', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(75, 1, '2019-03-08 18:11:32', 1, '2019-03-08 18:11:32', NULL, NULL, 0, 24, 'order/export', '订单导出', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(76, 1, '2019-03-08 18:30:33', 1, '2019-03-08 18:30:33', NULL, NULL, 0, 26, 'warehousing', '到货入库', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(78, 1, '2019-03-08 18:32:22', 1, '2019-03-08 18:32:22', NULL, NULL, 0, 26, 'warehousing/list', '入库单查询', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(79, 1, '2019-03-08 18:37:56', 1, '2019-03-08 18:37:56', NULL, NULL, 0, 27, 'requisition/apply', '调拨单查询/申请', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(80, 1, '2019-03-08 18:46:27', 1, '2019-03-08 18:46:27', NULL, NULL, 0, 27, 'requisition/turnout', '调拨出库确认', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(81, 1, '2019-03-08 18:46:34', 1, '2019-03-08 18:46:34', NULL, NULL, 0, 27, 'requisition/turnin', '调拨入库确认', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(82, 1, '2019-03-08 18:55:25', 1, '2019-03-08 18:55:25', NULL, NULL, 0, 28, 'check', '盘点单列表', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(83, 1, '2019-03-08 18:56:24', 1, '2019-03-08 18:56:24', NULL, NULL, 0, 28, 'check/detail', '库存变动查询', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(84, 1, '2019-03-08 19:01:59', 1, '2019-03-08 19:01:59', NULL, NULL, 0, 34, 'sf/sheet', '销售对账页面', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(85, 1, '2019-03-08 19:02:43', 1, '2019-03-08 19:02:43', NULL, NULL, 0, 34, 'sf/search', '对账查询页面', NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------





/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-15 18:37:56
