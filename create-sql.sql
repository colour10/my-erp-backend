/*
SQLyog Ultimate v9.60 
MySQL - 5.7.25 : Database - erp
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tb_ageseason` */

DROP TABLE IF EXISTS `tb_ageseason`;

CREATE TABLE `tb_ageseason` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sessionmark` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL COMMENT '中文名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='年代季节';

/*Data for the table `tb_ageseason` */

insert  into `tb_ageseason`(`id`,`sessionmark`,`name`) values (1,'XX','2018'),(2,'SS','2018'),(3,'SS','2019'),(4,'FW','2019'),(5,'SS','2012'),(6,'FW','2018'),(7,'SS','2015'),(8,'FW','2015');

/*Table structure for table `tb_aliases` */

DROP TABLE IF EXISTS `tb_aliases`;

CREATE TABLE `tb_aliases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

/*Data for the table `tb_aliases` */

insert  into `tb_aliases`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`code`,`brandid`) values (1,'44','','',NULL,NULL,NULL,NULL,'33',2),(2,'fd','','',NULL,NULL,NULL,NULL,'ere',2);

/*Table structure for table `tb_brand` */

DROP TABLE IF EXISTS `tb_brand`;

CREATE TABLE `tb_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
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
  `filename` varchar(200) DEFAULT NULL COMMENT 'LOGO',
  `memo` text,
  `officialwebsite` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COMMENT='品牌表';

/*Data for the table `tb_brand` */

insert  into `tb_brand`(`id`,`code`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`countryid`,`brandgroupid`,`filename`,`memo`,`officialwebsite`) values (1,'','Gucci',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'',''),(2,'001','耐克','Nike','',NULL,NULL,NULL,NULL,2,1,NULL,'',''),(3,'004','Adidas','','',NULL,NULL,NULL,NULL,4,0,NULL,'',''),(4,'005','彪马','','',NULL,NULL,NULL,NULL,4,2,NULL,'',''),(5,'006','BOUTIQUE MOSCHINO','','',NULL,NULL,NULL,NULL,1,0,NULL,'',''),(6,'PRADA','PRADA','','',NULL,NULL,NULL,NULL,6,0,NULL,'',''),(7,'CELINE','CELINE','','',NULL,NULL,NULL,NULL,1,0,NULL,'',''),(8,'FENDI','FENDI','','',NULL,NULL,NULL,NULL,1,0,NULL,'',''),(9,'CHIARA FERRAGNI','CHIARA FERRAGNI','','',NULL,NULL,NULL,NULL,1,0,NULL,'','');

/*Table structure for table `tb_brandgroup` */

DROP TABLE IF EXISTS `tb_brandgroup`;

CREATE TABLE `tb_brandgroup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `code` varchar(50) DEFAULT NULL,
  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='品类表';

/*Data for the table `tb_brandgroup` */

insert  into `tb_brandgroup`(`id`,`code`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`) values (1,'33','衣服','','',NULL,NULL,NULL,NULL),(2,'44','包袋','','',NULL,NULL,NULL,NULL),(3,'55','鞋子','','',NULL,NULL,NULL,NULL),(4,'66','首饰','','',NULL,NULL,NULL,NULL),(5,'67','上装','','',NULL,NULL,NULL,NULL),(6,'68','眼镜','','',NULL,NULL,NULL,NULL),(7,'69','腰带','','',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_brandgroupchild` */

DROP TABLE IF EXISTS `tb_brandgroupchild`;

CREATE TABLE `tb_brandgroupchild` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  `childcode` varchar(50) DEFAULT NULL,
  `brandgroupid` int(10) unsigned DEFAULT NULL,
  `producttemplateid` int(10) unsigned DEFAULT NULL,
  `weight` decimal(16,9) DEFAULT NULL,
  `isfj` varchar(1) DEFAULT NULL COMMENT '0-否 1-法检',
  `cname4male` int(10) unsigned DEFAULT NULL,
  `cname4female` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COMMENT='子品类';

/*Data for the table `tb_brandgroupchild` */

insert  into `tb_brandgroupchild`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`childcode`,`brandgroupid`,`producttemplateid`,`weight`,`isfj`,`cname4male`,`cname4female`) values (2,'上衣','','',NULL,NULL,NULL,NULL,'0101',1,0,'0.000000000',NULL,NULL,NULL),(3,'风衣','','',NULL,NULL,NULL,NULL,'0102',1,0,'0.000000000',NULL,NULL,NULL),(4,'夹克','','',NULL,NULL,NULL,NULL,'0103',1,0,'0.000000000',NULL,NULL,NULL),(5,'运动服','','',NULL,NULL,NULL,NULL,'0105',1,0,'0.000000000',NULL,NULL,NULL),(6,'网球鞋','','',NULL,NULL,NULL,NULL,'0301',3,0,'0.000000000',NULL,NULL,NULL),(7,'足球鞋','','',NULL,NULL,NULL,NULL,'0302',3,0,'0.000000000',NULL,NULL,NULL),(8,'篮球鞋','','',NULL,NULL,NULL,NULL,'0303',3,0,'0.000000000',NULL,NULL,NULL),(9,'跑步鞋','','',NULL,NULL,NULL,NULL,'0304',3,0,'0.000000000',NULL,NULL,NULL),(10,'项链','','',NULL,NULL,NULL,NULL,'0401',4,0,'0.000000000',NULL,NULL,NULL),(11,'戒指','','',NULL,NULL,NULL,NULL,'0402',4,0,'0.000000000',NULL,NULL,NULL),(12,'背包','','',NULL,NULL,NULL,NULL,'0201',2,0,'0.000000000',NULL,NULL,NULL),(13,'手提包','','',NULL,NULL,NULL,NULL,'0202',2,0,'0.000000000',NULL,NULL,NULL),(14,'电脑包','','',NULL,NULL,NULL,NULL,'0203',2,0,'0.000000000',NULL,NULL,NULL),(15,'长袖T恤衫','','',NULL,NULL,NULL,NULL,'',5,1,'0.000000000',NULL,NULL,NULL),(16,'斜挎包','','',NULL,NULL,NULL,NULL,'',2,0,'0.000000000',NULL,NULL,NULL),(17,'手提包','','',NULL,NULL,NULL,NULL,'',2,0,'0.000000000',NULL,NULL,NULL),(18,'太阳镜','','',NULL,NULL,NULL,NULL,'',6,0,'0.000000000',NULL,NULL,NULL),(19,'腰带','','',NULL,NULL,NULL,NULL,'',7,0,'0.000000000',NULL,NULL,NULL);

/*Table structure for table `tb_buycar` */

DROP TABLE IF EXISTS `tb_buycar`;

CREATE TABLE `tb_buycar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `product_id` int(10) UNSIGNED NOT NULL COMMENT '商品id',
  `product_name` varchar(255) NOT NULL COMMENT '商品名称',
  `color_id` int(10) UNSIGNED NOT NULL COMMENT '颜色id',
  `color_name` varchar(64) NOT NULL COMMENT '颜色名称',
  `size_id` int(11) NOT NULL COMMENT '规格id',
  `size_name` varchar(64) NOT NULL COMMENT '规格名称',
  `member_id` int(10) UNSIGNED NOT NULL COMMENT '用户id',
  `number` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT '数量',
  `price` decimal(9,2) NOT NULL COMMENT '价格',
  `total_price` decimal(9,2) NOT NULL COMMENT '总价格',
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='购物车';

/*Data for the table `tb_buycar` */

/*Table structure for table `tb_colortemplate` */

DROP TABLE IF EXISTS `tb_colortemplate`;

CREATE TABLE `tb_colortemplate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='asa颜色模板';

/*Data for the table `tb_colortemplate` */

insert  into `tb_colortemplate`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`picture`,`code`,`color_note`,`colortype`) values (1,'红色','','',NULL,NULL,NULL,NULL,'colortemplate/bde9713e9d89260fb001ef2723b53331.jpg','','',''),(2,'黑色','','黑色',NULL,NULL,NULL,NULL,'colortemplate/fa9e7e53209f9a7daf6e381a6ee9b00b.jpg','',NULL,NULL);

/*Table structure for table `tb_company` */

DROP TABLE IF EXISTS `tb_company`;

CREATE TABLE `tb_company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name_cn` varchar(1000) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(1000) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(1000) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(1000) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(1000) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(1000) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(1000) DEFAULT NULL COMMENT '德语名称',
  `countryid` int(10) unsigned DEFAULT NULL COMMENT '国家id',
  `memo` text COMMENT '备注说明',
  `host` varchar(100) DEFAULT NULL COMMENT '绑定域名',
  `randid` int(11) DEFAULT NULL,
  `saleportid` int(11) unsigned DEFAULT NULL COMMENT '商城的销售端口',
  PRIMARY KEY (`id`),
  UNIQUE KEY `randid` (`randid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_company` */

insert  into `tb_company`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`countryid`,`memo`,`randid`,`saleportid`) values (1,'company1552557078',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1);

/*Table structure for table `tb_confirmorderdetails` */

DROP TABLE IF EXISTS `tb_confirmorderdetails`;

CREATE TABLE `tb_confirmorderdetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `confirmorderid` int(10) unsigned DEFAULT NULL COMMENT '发货单id',
  `orderdetailsid` int(10) unsigned DEFAULT NULL COMMENT '订单明细id',
  `number` int(11) DEFAULT NULL COMMENT '发货数量',
  `price` decimal(16,2) DEFAULT NULL COMMENT '单价',
  `actualnumber` int(11) DEFAULT NULL COMMENT '到货数量',
  `companyid` int(11) DEFAULT NULL COMMENT '公司id',
  PRIMARY KEY (`id`),
  KEY `orderdetailsid` (`orderdetailsid`),
  KEY `confirmorderid` (`confirmorderid`),
  CONSTRAINT `tb_confirmorderdetails_ibfk_1` FOREIGN KEY (`orderdetailsid`) REFERENCES `tb_orderdetails` (`id`),
  CONSTRAINT `tb_confirmorderdetails_ibfk_2` FOREIGN KEY (`confirmorderid`) REFERENCES `td_confirmorder` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='发货单明细';

/*Data for the table `tb_confirmorderdetails` */

insert  into `tb_confirmorderdetails`(`id`,`confirmorderid`,`orderdetailsid`,`number`,`price`,`actualnumber`,`companyid`) values (3,25,37,2,'1000.00',NULL,1),(4,25,36,2,'1000.00',NULL,1),(5,25,35,2,'1000.00',NULL,1),(6,26,42,1,'1000.00',NULL,1),(7,26,41,2,'1000.00',NULL,1);

/*Table structure for table `tb_country` */

DROP TABLE IF EXISTS `tb_country`;

CREATE TABLE `tb_country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `code` varchar(20) NOT NULL,
  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  `localcurrency` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='国家表';

/*Data for the table `tb_country` */

insert  into `tb_country`(`id`,`code`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`localcurrency`) values (1,'Spain','西班牙','','',NULL,NULL,NULL,NULL,'CAD'),(2,'France','法国','','',NULL,NULL,NULL,NULL,'USD'),(3,'787','英国','','',NULL,NULL,NULL,NULL,'EUR'),(4,'799','德国','','',NULL,NULL,NULL,NULL,''),(5,'800','美国','','',NULL,NULL,NULL,NULL,''),(6,'1','罗马尼亚','','',NULL,NULL,NULL,NULL,''),(7,'2','意大利','','',NULL,NULL,NULL,NULL,''),(8,'3','中国','','',NULL,NULL,NULL,NULL,'');

/*Table structure for table `tb_department` */

DROP TABLE IF EXISTS `tb_department`;

CREATE TABLE `tb_department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(100) DEFAULT NULL,
  `memo` varchar(1000) DEFAULT NULL,
  `companyid` int(10) unsigned NOT NULL COMMENT '公司id',
  `priceid` int(10) unsigned DEFAULT NULL COMMENT '此价格id可以是基础价格id，也可以是销售端口id',
  `spotid` int(10) unsigned DEFAULT NULL,
  `up_dp_id` int(10) unsigned DEFAULT '0' COMMENT '上级部门ID',
  `checkingflag` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='部门表';

/*Data for the table `tb_department` */

insert  into `tb_department`(`id`,`name`,`memo`,`companyid`,`priceid`,`spotid`,`up_dp_id`,`checkingflag`) values (1,'company1552557078',NULL,1,NULL,NULL,0,NULL),(2,'售后',NULL,1,NULL,NULL,1,NULL),(3,'技术12',NULL,1,NULL,NULL,1,NULL);

/*Table structure for table `tb_goods` */

DROP TABLE IF EXISTS `tb_goods`;

CREATE TABLE `tb_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `productid` int(10) unsigned NOT NULL,
  `sizecontentid` int(10) unsigned NOT NULL,
  `defective_level` tinyint(11) DEFAULT '0' COMMENT '残次品等级；0=合格品 1=残次品',
  `property` tinyint(1) DEFAULT NULL COMMENT '0-自采 1-代销',
  `change_time` datetime DEFAULT NULL COMMENT '修改时间',
  `change_stuff` int(10) unsigned DEFAULT NULL COMMENT '修改人',
  `price` decimal(11,2) NOT NULL COMMENT '价格',
  `companyid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productid` (`companyid`,`productid`,`sizecontentid`,`defective_level`,`property`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COMMENT='库存商品表';

/*Data for the table `tb_goods` */

insert  into `tb_goods`(`id`,`productid`,`sizecontentid`,`defective_level`,`property`,`change_time`,`change_stuff`,`price`,`companyid`) values (1,1,3,0,1,NULL,NULL,'1100.00',1),(2,1,4,0,2,NULL,NULL,'8000.00',1),(9,2,11,0,1,'2019-03-30 10:49:49',NULL,'1000.00',1),(10,2,12,0,1,'2019-03-30 10:49:49',NULL,'1000.00',1),(11,2,13,0,1,'2019-03-30 10:49:49',NULL,'1000.00',1),(18,2,6,0,1,'2019-04-01 17:50:11',NULL,'1000.00',1),(19,2,7,0,1,'2019-04-01 17:50:11',NULL,'1000.00',1);

/*Table structure for table `tb_group` */

DROP TABLE IF EXISTS `tb_group`;

CREATE TABLE `tb_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `group_name` varchar(50) DEFAULT NULL,
  `group_memo` varchar(500) DEFAULT NULL,
  `companyid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='组信息';

/*Data for the table `tb_group` */

insert  into `tb_group`(`id`,`group_name`,`group_memo`,`companyid`) values (1,'技术组','44',1),(2,'客服部','',1),(3,'临时','22',1);

/*Table structure for table `tb_material` */

DROP TABLE IF EXISTS `tb_material`;

CREATE TABLE `tb_material` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
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

/*Data for the table `tb_material` */

/*Table structure for table `tb_materialnote` */

DROP TABLE IF EXISTS `tb_materialnote`;

CREATE TABLE `tb_materialnote` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `content_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `content_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `content_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `content_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `content_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `content_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `content_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='材质备注';

/*Data for the table `tb_materialnote` */

/*Table structure for table `tb_member` */

DROP TABLE IF EXISTS `tb_member`;

CREATE TABLE `tb_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `login_name` varchar(100) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '会员名',
  `password` varchar(32) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL COMMENT '0-female 1-male',
  `birthday` varchar(10) DEFAULT NULL COMMENT '生日',
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
  `invitesum` bigint(20) DEFAULT NULL,
  `invitetotal` bigint(20) DEFAULT NULL,
  `invoteuser` int(10) unsigned DEFAULT NULL,
  `companyid` int(11) DEFAULT NULL COMMENT '公司ID',
  PRIMARY KEY (`id`),
  KEY `sys_delete_flag` (`companyid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='会员表';

/*Data for the table `tb_member` */

insert  into `tb_member`(`id`,`login_name`,`name`,`password`,`code`,`gender`,`birthday`,`phoneno`,`email`,`address`,`zipcode`,`qq`,`wechat`,`microblog`,`totalscore`,`score`,`membercard`,`memberlevelid`,`membertype`,`membercardid`,`creatorid`,`sourceid`,`idno`,`taxno`,`contactor`,`asawebno`,`openid`,`invitesum`,`invitetotal`,`invoteuser`,`companyid`) values (1,NULL,'changwei',NULL,NULL,1,'2019-03-11','','','','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(2,NULL,'Tom',NULL,NULL,0,'2019-03-26','','','','','507021','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(3,NULL,'小明',NULL,NULL,1,'2019-03-23','','','','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1);

/*Table structure for table `tb_member_address` */

DROP TABLE IF EXISTS `tb_member_address`;

CREATE TABLE `tb_member_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
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

/*Data for the table `tb_member_address` */

/*Table structure for table `tb_order` */

DROP TABLE IF EXISTS `tb_order`;

CREATE TABLE `tb_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `bussinesstypeid` int(10) unsigned DEFAULT NULL,
  `makedate` datetime DEFAULT NULL COMMENT '订单日期',
  `makestaff` int(10) unsigned DEFAULT NULL COMMENT '制单人',
  `supplierid` int(10) unsigned DEFAULT NULL COMMENT '供货商',
  `finalsupplierid` int(10) unsigned DEFAULT NULL COMMENT '发货单位',
  `bookingid` int(10) unsigned DEFAULT NULL COMMENT '订货单位',
  `agentid` int(10) unsigned DEFAULT NULL,
  `purchasedept` int(10) unsigned DEFAULT NULL,
  `orderno` varchar(50) DEFAULT NULL COMMENT '订单编号',
  `total` decimal(16,2) DEFAULT NULL COMMENT '总金额',
  `currency` varchar(10) DEFAULT NULL COMMENT '总金额货币',
  `auditstaff` int(10) unsigned DEFAULT NULL COMMENT '审核人',
  `auditdate` datetime DEFAULT NULL COMMENT '审核时间',
  `ordercode` varchar(50) DEFAULT NULL COMMENT '订单号',
  `worldordercode` varchar(50) DEFAULT NULL COMMENT '海外订单号',
  `isstatus` tinyint(1) DEFAULT NULL COMMENT '0-未完结 1-已完结',
  `formtype` varchar(2) DEFAULT NULL COMMENT '1-女款，2-男款,3-男款/女款',
  `memo` varchar(200) DEFAULT NULL COMMENT '备注',
  `contactor` varchar(200) DEFAULT NULL COMMENT '订货单位联系人',
  `ourcontactor` varchar(200) DEFAULT NULL COMMENT '我方联系人',
  `ageseason` int(10) unsigned DEFAULT NULL COMMENT '年代季节',
  `seasontype` tinyint(1) DEFAULT NULL COMMENT '0-pre ,1-main ,2-fashion show',
  `invoiceno` varchar(50) DEFAULT NULL COMMENT '订单发票号',
  `ddtype` tinyint(1) DEFAULT NULL COMMENT '0-客户订单，1-品牌订单',
  `morderid` int(10) unsigned DEFAULT NULL,
  `exchangerate` decimal(16,4) DEFAULT NULL COMMENT '汇率',
  `bussinesstype` tinyint(1) DEFAULT NULL COMMENT '订单类型：0-期货 1-现货',
  `discount` decimal(16,2) DEFAULT NULL COMMENT '折扣',
  `property` tinyint(1) DEFAULT NULL COMMENT '0-自采 1-代销',
  `companyid` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '订单状态：1=保存；2=送审；3=审核完成',
  PRIMARY KEY (`id`),
  KEY `companyid` (`companyid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='订单主表';

/*Data for the table `tb_order` */

insert  into `tb_order`(`id`,`bussinesstypeid`,`makedate`,`makestaff`,`supplierid`,`finalsupplierid`,`bookingid`,`agentid`,`purchasedept`,`orderno`,`total`,`currency`,`auditstaff`,`auditdate`,`ordercode`,`worldordercode`,`isstatus`,`formtype`,`memo`,`contactor`,`ourcontactor`,`ageseason`,`seasontype`,`invoiceno`,`ddtype`,`morderid`,`exchangerate`,`bussinesstype`,`discount`,`property`,`companyid`,`status`) values (6,NULL,'2019-03-29 16:27:36',1,6,0,0,NULL,NULL,'D000001201903291627363324','0.00','',0,NULL,'','',NULL,'','','','',2,0,'',NULL,NULL,'0.0000',1,'0.00',0,1,2),(7,NULL,'2019-04-01 19:31:46',1,1,1,0,NULL,NULL,'D000001201904011931467284','0.00','',0,NULL,'','',NULL,'','','','',1,1,'',NULL,NULL,'0.0000',1,'0.00',1,1,3),(8,NULL,'2019-04-01 19:32:29',1,5,5,0,NULL,NULL,'D000001201904011932295137','0.00','',0,NULL,'','',NULL,'','','','',6,1,'',NULL,NULL,'0.0000',2,'0.00',1,1,2),(9,NULL,'2019-04-01 19:33:22',1,6,6,0,NULL,NULL,'D000001201904011933222331','0.00','',0,NULL,'','',NULL,'','','','',5,2,'',NULL,NULL,'0.0000',1,'0.00',1,1,2),(10,NULL,'2019-04-01 19:33:57',1,4,4,0,NULL,NULL,'D000001201904011933571910','0.00','',0,NULL,'','',NULL,'','','','',2,1,'',NULL,NULL,'0.0000',2,'0.00',2,1,2);

/*Table structure for table `tb_orderdetails` */

DROP TABLE IF EXISTS `tb_orderdetails`;

CREATE TABLE `tb_orderdetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `orderid` int(10) unsigned NOT NULL COMMENT '订单id',
  `sizecontentid` int(10) unsigned NOT NULL COMMENT '尺码id',
  `number` int(11) NOT NULL COMMENT '数量',
  `productid` int(10) unsigned NOT NULL COMMENT '产品id',
  `price` decimal(16,2) DEFAULT NULL COMMENT '成交价',
  `confirm_number` int(11) DEFAULT '0' COMMENT '发货数量',
  `companyid` int(11) DEFAULT NULL COMMENT '公司id',
  `is_append` tinyint(11) DEFAULT '0' COMMENT '是否追加',
  `createdate` datetime DEFAULT NULL COMMENT '创建时间',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态',
  `actualnumber` int(11) DEFAULT '0' COMMENT '已经发货数量',
  PRIMARY KEY (`id`),
  UNIQUE KEY `companyid` (`companyid`,`orderid`,`productid`,`sizecontentid`),
  KEY `orderid` (`orderid`),
  KEY `productid` (`productid`),
  CONSTRAINT `tb_orderdetails_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `tb_order` (`id`),
  CONSTRAINT `tb_orderdetails_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `tb_product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COMMENT='订单明细';

/*Data for the table `tb_orderdetails` */

insert  into `tb_orderdetails`(`id`,`orderid`,`sizecontentid`,`number`,`productid`,`price`,`confirm_number`,`companyid`,`is_append`,`createdate`,`status`,`actualnumber`) values (35,6,13,2,2,'1000.00',6,1,0,'2019-04-01 19:27:43',NULL,0),(36,6,12,2,2,'1000.00',6,1,0,'2019-04-01 19:27:43',NULL,0),(37,6,11,2,2,'1000.00',6,1,0,'2019-04-01 19:27:43',NULL,0),(38,6,10,2,2,'1000.00',0,1,0,'2019-04-01 19:27:43',NULL,0),(39,6,9,5,2,'1000.00',0,1,0,'2019-04-01 19:27:43',NULL,0),(40,6,8,3,2,'1000.00',0,1,0,'2019-04-01 19:27:43',NULL,0),(41,6,7,2,2,'1000.00',4,1,0,'2019-04-01 19:27:43',NULL,0),(42,6,6,3,2,'1000.00',2,1,0,'2019-04-01 19:27:43',NULL,0),(43,8,5,1,6,'2500.00',0,1,0,'2019-04-01 19:32:43',NULL,0),(44,8,4,1,6,'2500.00',0,1,0,'2019-04-01 19:32:43',NULL,0),(45,8,3,1,6,'2500.00',0,1,0,'2019-04-01 19:32:43',NULL,0),(46,8,2,1,6,'2500.00',0,1,0,'2019-04-01 19:32:43',NULL,0),(47,8,1,1,6,'2500.00',0,1,0,'2019-04-01 19:32:43',NULL,0),(48,8,5,1,1,'126.50',0,1,0,'2019-04-01 19:32:43',NULL,0),(49,8,4,1,1,'126.50',0,1,0,'2019-04-01 19:32:43',NULL,0),(50,8,3,1,1,'126.50',0,1,0,'2019-04-01 19:32:43',NULL,0),(51,8,2,1,1,'126.50',0,1,0,'2019-04-01 19:32:43',NULL,0),(52,8,1,1,1,'126.50',0,1,0,'2019-04-01 19:32:43',NULL,0),(53,9,13,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(54,9,12,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(55,9,11,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(56,9,10,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(57,9,9,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(58,9,8,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(59,9,7,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(60,9,6,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(61,10,13,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(62,10,12,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(63,10,11,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(64,10,10,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(65,10,9,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(66,10,8,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(67,10,7,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(68,10,6,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(69,10,5,1,1,'126.50',0,1,0,'2019-04-01 19:33:57',NULL,0),(70,10,4,1,1,'126.50',0,1,0,'2019-04-01 19:33:57',NULL,0),(71,10,3,1,1,'126.50',0,1,0,'2019-04-01 19:33:57',NULL,0),(72,10,2,1,1,'126.50',0,1,0,'2019-04-01 19:33:57',NULL,0),(73,10,1,1,1,'126.50',0,1,0,'2019-04-01 19:33:57',NULL,0);

/*Table structure for table `tb_permission` */

DROP TABLE IF EXISTS `tb_permission`;

CREATE TABLE `tb_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
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
  UNIQUE KEY `permission_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_permission` */

insert  into `tb_permission`(`id`,`pid`,`name`,`memo_cn`,`memo_en`,`memo_hk`,`memo_fr`,`memo_it`,`memo_sp`,`memo_de`,`is_only_superadmin`) values (1,0,'userControl','用户管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(2,0,'databaseControl','基础数据',NULL,NULL,NULL,NULL,NULL,NULL,0),(3,0,'productControl','商品管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(4,0,'customControl','客户管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(5,0,'supplierControl','供应链管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(6,0,'stockControl','库存管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(7,0,'salesControl','销售管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(8,0,'memberControl','会员管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(9,0,'costControl','费用管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(10,0,'financialControl','财务管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(11,0,'systemControl','系统管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(12,1,'user','员工信息',NULL,NULL,NULL,NULL,NULL,NULL,0),(13,1,'group','组信息',NULL,NULL,NULL,NULL,NULL,NULL,0),(14,1,'department','部门信息',NULL,NULL,NULL,NULL,NULL,NULL,0),(15,2,'productRelate','商品相关',NULL,NULL,NULL,NULL,NULL,NULL,0),(16,2,'priceRelate','价格相关',NULL,NULL,NULL,NULL,NULL,NULL,0),(17,2,'otherRelate','其他',NULL,NULL,NULL,NULL,NULL,NULL,0),(18,3,'product','商品信息',NULL,NULL,NULL,NULL,NULL,NULL,0),(19,3,'picture','图片管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(20,3,'pictureupload','图片上传',NULL,NULL,NULL,NULL,NULL,NULL,0),(21,4,'supplier','关系单位信息',NULL,NULL,NULL,NULL,NULL,NULL,0),(22,4,'quotation','供货商报价',NULL,NULL,NULL,NULL,NULL,NULL,0),(23,4,'supplierlevel','供货商级别',NULL,NULL,NULL,NULL,NULL,NULL,0),(24,5,'orderRelate','订单管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(25,5,'confirmorder','发货单管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(26,5,'warehousingRelate','到货入库',NULL,NULL,NULL,NULL,NULL,NULL,0),(27,6,'requisitionRelate','调拨相关',NULL,NULL,NULL,NULL,NULL,NULL,0),(28,6,'checkRelate','库存盘点',NULL,NULL,NULL,NULL,NULL,NULL,0),(29,6,'stocksnapshot','库存余额查询',NULL,NULL,NULL,NULL,NULL,NULL,0),(30,6,'productstock','库存查询',NULL,NULL,NULL,NULL,NULL,NULL,0),(31,6,'productstockSnapshot','库存快照统计',NULL,NULL,NULL,NULL,NULL,NULL,0),(32,7,'sales','商品零售批发',NULL,NULL,NULL,NULL,NULL,NULL,0),(33,7,'salesstock','销售端口库存统计',NULL,NULL,NULL,NULL,NULL,NULL,0),(34,7,'sfRelate','销售对账',NULL,NULL,NULL,NULL,NULL,NULL,0),(35,7,'sale/statistics','销售统计',NULL,NULL,NULL,NULL,NULL,NULL,0),(36,8,'member','会员管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(37,8,'memberlevel','会员级别',NULL,NULL,NULL,NULL,NULL,NULL,0),(38,9,'fee','费用申请',NULL,NULL,NULL,NULL,NULL,NULL,0),(39,9,'fee/leader','费用申请主管审批',NULL,NULL,NULL,NULL,NULL,NULL,0),(40,9,'fee/finance','费用申请财务审批',NULL,NULL,NULL,NULL,NULL,NULL,0),(41,9,'fee/manager','费用申请经理审批',NULL,NULL,NULL,NULL,NULL,NULL,0),(42,10,'sfsheet','对账查询',NULL,NULL,NULL,NULL,NULL,NULL,0),(43,11,'help','系统帮助',NULL,NULL,NULL,NULL,NULL,NULL,0),(44,11,'modifypassword','修改密码',NULL,NULL,NULL,NULL,NULL,NULL,0),(45,11,'logout','退出登录',NULL,NULL,NULL,NULL,NULL,NULL,0),(46,15,'brand','品牌维护',NULL,NULL,NULL,NULL,NULL,NULL,0),(47,15,'brandgroup','品类维护',NULL,NULL,NULL,NULL,NULL,NULL,0),(48,15,'ageseason','款式年代',NULL,NULL,NULL,NULL,NULL,NULL,0),(49,15,'colortemplate','颜色模板',NULL,NULL,NULL,NULL,NULL,NULL,0),(50,15,'sizetop','商品尺码',NULL,NULL,NULL,NULL,NULL,NULL,0),(51,15,'material','材质管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(52,15,'ulnarinch','商品尺寸',NULL,NULL,NULL,NULL,NULL,NULL,0),(53,15,'aliases','商品别名',NULL,NULL,NULL,NULL,NULL,NULL,0),(54,15,'productinnards','内部结构',NULL,NULL,NULL,NULL,NULL,NULL,0),(55,15,'productparts','附带配件',NULL,NULL,NULL,NULL,NULL,NULL,0),(56,15,'occasionsstyle','场合风格',NULL,NULL,NULL,NULL,NULL,NULL,0),(57,15,'closedway','闭合方式',NULL,NULL,NULL,NULL,NULL,NULL,0),(58,15,'executioncategory','执行标准',NULL,NULL,NULL,NULL,NULL,NULL,0),(59,15,'securitycategory','安全类别',NULL,NULL,NULL,NULL,NULL,NULL,0),(60,15,'washinginstructions','洗涤说明',NULL,NULL,NULL,NULL,NULL,NULL,0),(61,15,'winterproofing','防寒指数',NULL,NULL,NULL,NULL,NULL,NULL,0),(62,16,'productprice','商品价格管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(63,16,'costformula','成本计算管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(64,17,'warehouse','仓库管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(65,17,'salesport','销售端口管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(66,17,'country','国际及地区信息维护',NULL,NULL,NULL,NULL,NULL,NULL,0),(67,17,'feenames','费用名称',NULL,NULL,NULL,NULL,NULL,NULL,0),(68,17,'shippingtype','运输方式',NULL,NULL,NULL,NULL,NULL,NULL,0),(69,17,'salesmethods','销售性质',NULL,NULL,NULL,NULL,NULL,NULL,0),(70,17,'businesstype','业务类型',NULL,NULL,NULL,NULL,NULL,NULL,0),(71,17,'reportstyle','快递单样式',NULL,NULL,NULL,NULL,NULL,NULL,0),(72,17,'imagetool','图片工具',NULL,NULL,NULL,NULL,NULL,NULL,0),(73,24,'order','订单管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(74,24,'order/search','订单状态查询',NULL,NULL,NULL,NULL,NULL,NULL,0),(75,24,'order/export','订单导出',NULL,NULL,NULL,NULL,NULL,NULL,0),(76,26,'warehousing','到货入库',NULL,NULL,NULL,NULL,NULL,NULL,0),(78,26,'warehousing/list','入库单查询',NULL,NULL,NULL,NULL,NULL,NULL,0),(79,27,'requisition/apply','调拨单查询/申请',NULL,NULL,NULL,NULL,NULL,NULL,0),(80,27,'requisition/turnout','调拨出库确认',NULL,NULL,NULL,NULL,NULL,NULL,0),(81,27,'requisition/turnin','调拨入库确认',NULL,NULL,NULL,NULL,NULL,NULL,0),(82,28,'check','盘点单列表',NULL,NULL,NULL,NULL,NULL,NULL,0),(83,28,'check/detail','库存变动查询',NULL,NULL,NULL,NULL,NULL,NULL,0),(84,34,'sf/sheet','销售对账页面',NULL,NULL,NULL,NULL,NULL,NULL,0),(85,34,'sf/search','对账查询页面',NULL,NULL,NULL,NULL,NULL,NULL,0);

/*Table structure for table `tb_permission_group` */

DROP TABLE IF EXISTS `tb_permission_group`;

CREATE TABLE `tb_permission_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `groupid` int(10) unsigned NOT NULL COMMENT '组id',
  `permissionid` int(10) unsigned NOT NULL COMMENT '权限id',
  `companyid` int(10) unsigned DEFAULT NULL COMMENT '公司id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_permission_group` */

/*Table structure for table `tb_permission_module` */

DROP TABLE IF EXISTS `tb_permission_module`;

CREATE TABLE `tb_permission_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `permissionid` int(10) unsigned DEFAULT NULL COMMENT '权限id',
  `module` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '模块名称',
  `controller` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '控制器名称',
  `action` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '方法名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_permission_module_permissionid_module_controller_action` (`permissionid`,`module`,`controller`,`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_permission_module` */

/*Table structure for table `tb_picture` */

DROP TABLE IF EXISTS `tb_picture`;

CREATE TABLE `tb_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(100) DEFAULT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COMMENT='图片表';

/*Data for the table `tb_picture` */

insert  into `tb_picture`(`id`,`name`,`filename`,`productid`) values (1,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/b7a99f2cf0403a6a0f70d4beb6004759.jpg',NULL),(2,'下载.jpg','product/a52ed93c656aee6a072fa8bec842f529.jpg',NULL),(3,'下载 (1).jpg','product/d21e35b830dcac19e66472488a4df453.jpg',NULL),(4,'下载 (1).jpg','product/c7c6cea60322a5db87614a0e96c10f33.jpg',NULL),(5,'下载.jpg','product/6b313ca8ef9bb69870fa57ff95918b5e.jpg',NULL),(6,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/abdb17b3650f1e46a9784fe4bcf65e52.jpg',1),(7,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/b73dbfa2dcc8d0a02c141c2df4fcf8a6.jpg',1),(8,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/ad35d904308c798bccb0b3e25b990f12.jpg',1),(9,'下载.jpg','product/7d4bf152db62db3234c7a4e0b1d02bfc.jpg',1),(10,'下载 (1).jpg','product/2864be543116105840894a606cf78017.jpg',1),(11,'下载.jpg','product/8bcf6a0c6cc88ff260d0fa78b0f57eae.jpg',1),(12,'下载 (1).jpg','product/435fb1115b1b06afe0b6c7adf5f974aa.jpg',1),(13,'下载.jpg','product/3425fa313d2614ca10c423fa43f20372.jpg',1),(14,'下载 (1).jpg','product/8b50e51db96203eee3fee394940b9fb5.jpg',1),(15,'下载.jpg','product/28d746c501f7e70261ab98184ddf0ef1.jpg',1),(16,'下载 (1).jpg','product/fb321ece3b350c9efb8dfb1708765527.jpg',1),(17,'下载.jpg','product/772181cede835ae77e1aa74dadb6586b.jpg',1),(18,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/9ea1fbd6778852de47bce6ae87cc49c8.jpg',1),(19,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/c86aa0902d9cca60c7b54d7796335d7e.jpg',1),(20,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/8bdfb4547875859ac65a184557e41c17.jpg',1),(21,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/6f5a52858b061e916709cbfcabee9e04.jpg',1),(22,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/f15ee7b88c9659cdeb6fdf141319eeed.jpg',1),(23,'下载 (1).jpg','product/6118615a70c265497a4ae3cf7382071f.jpg',2),(24,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/bd352194b8bd7e772a2df0a5d4c982d2.jpg',1),(25,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/0745a0887ccc1d417dc4d21a59e01735.jpg',2),(26,'下载 (1).jpg','product/7562457cb4a12f44e807f2f9702069cc.jpg',6),(27,'下载.jpg','product/dfd37e5e56c74b5bfeab869a8790c352.jpg',1),(28,'下载.jpg','product/14b568d5d3ec652e544b1c4a5905b7d0.jpg',5),(29,'下载 (1).jpg','product/20ab3f3335b0ada9e127d0e7929d5620.jpg',5),(30,'2101062000023(1).jpg','product/cee36038c5a2752a77d881778d904153.jpg',4),(31,'2101062000023(2).JPG','product/b7454388764a965db3fbc3219fcbe2d7.jpg',4),(32,'2101062000023(3).JPG','product/6fe1fe4d5ac2ed3289cd86441798ec0d.jpg',4),(33,'2101062000023(3).JPG','product/ffe0dc1f58a7b7fed97c2c5acb2c1237.jpg',4),(34,'2101062000023(5).JPG','product/2c27a8db327cdf1bc64ee855917635b9.jpg',4),(35,'2101062000023(6).JPG','product/b3cb0feeb12e847cde4aa9430ede879d.jpg',4),(36,'2101062000023(8).JPG','product/35f73d1102fd67aadb1bc6c6c648eb68.jpg',4);

/*Table structure for table `tb_product` */

DROP TABLE IF EXISTS `tb_product`;

CREATE TABLE `tb_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `productname` varchar(50) DEFAULT NULL,
  `wordcode_1` varchar(50) DEFAULT NULL,
  `wordcode_2` varchar(50) DEFAULT NULL,
  `wordcode_3` varchar(50) DEFAULT NULL,
  `wordcode_4` varchar(50) DEFAULT NULL,
  `wordprice` decimal(16,2) DEFAULT NULL COMMENT '国际零售价',
  `wordpricecurrency` varchar(10) DEFAULT NULL COMMENT '国际零售价币种',
  `gender` varchar(100) DEFAULT NULL COMMENT '0-女式 1-男士 2-中性',
  `brandid` int(10) unsigned DEFAULT NULL COMMENT '品牌',
  `brandgroupid` int(10) unsigned DEFAULT NULL COMMENT '品类',
  `childbrand` int(10) unsigned DEFAULT NULL,
  `brandcolor` varchar(100) DEFAULT NULL COMMENT '品牌色板',
  `brandcolor2` int(10) unsigned DEFAULT NULL,
  `picture2` varchar(100) DEFAULT NULL COMMENT '副图',
  `picture` varchar(100) DEFAULT NULL COMMENT '主图',
  `ageseason` varchar(200) DEFAULT NULL COMMENT '年代',
  `productsize` int(10) unsigned DEFAULT NULL,
  `countries` varchar(100) DEFAULT NULL COMMENT '产地',
  `material` int(10) unsigned DEFAULT NULL,
  `productparst` int(10) unsigned DEFAULT NULL,
  `producttemplate` int(10) unsigned DEFAULT NULL,
  `season` varchar(20) DEFAULT NULL,
  `laststoragedate` varchar(19) DEFAULT NULL,
  `aliases_1` varchar(50) DEFAULT NULL COMMENT '商品系列',
  `aliases_2` varchar(50) DEFAULT NULL COMMENT '商品子系列',
  `aliases` varchar(50) DEFAULT NULL,
  `series_id` int(10) unsigned DEFAULT NULL,
  `series2_id` int(10) unsigned DEFAULT NULL,
  `ulnarinch` varchar(50) DEFAULT NULL,
  `entrymonth` varchar(5) DEFAULT NULL,
  `factoryprice` decimal(16,2) DEFAULT NULL COMMENT '出厂价',
  `factorypricecurrency` varchar(10) DEFAULT NULL COMMENT '出厂价币种',
  `retailprice` decimal(16,2) DEFAULT NULL COMMENT '成交价格',
  `retailpricecurrency` varchar(10) DEFAULT NULL COMMENT '成交价格币种',
  `groupid` int(10) unsigned DEFAULT NULL COMMENT '同款不同色',
  `nationalprice` decimal(16,2) DEFAULT NULL COMMENT '国内价格',
  `winterproofing` int(10) DEFAULT NULL,
  `ulnarinch_memo` varchar(100) DEFAULT NULL COMMENT '尺寸备注',
  `sizetopid` int(11) DEFAULT NULL COMMENT '尺码模板',
  `companyid` int(11) DEFAULT NULL,
  `adduserid` int(11) DEFAULT NULL COMMENT '建档人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='商品表';

/*Data for the table `tb_product` */

insert  into `tb_product`(`id`,`productname`,`wordcode_1`,`wordcode_2`,`wordcode_3`,`wordcode_4`,`wordprice`,`wordpricecurrency`,`gender`,`brandid`,`brandgroupid`,`childbrand`,`brandcolor`,`brandcolor2`,`picture2`,`picture`,`ageseason`,`productsize`,`countries`,`material`,`productparst`,`producttemplate`,`season`,`laststoragedate`,`aliases_1`,`aliases_2`,`aliases`,`series_id`,`series2_id`,`ulnarinch`,`entrymonth`,`factoryprice`,`factorypricecurrency`,`retailprice`,`retailpricecurrency`,`groupid`,`nationalprice`,`winterproofing`,`ulnarinch_memo`,`sizetopid`,`companyid`,`adduserid`) values (1,'BOUTIQUE MOSCHINO 女士黄色长袖T恤衫','0221','A1410 ','','','275.00','2','5,3,1',5,5,15,'2,1',NULL,'product/0820505ecba45bc993739ba4152aeecf.jpg','product/d237442d5a8662c9a997666a652d5693.jpg','6,7',0,'2,1',0,0,0,'5,4','','','','',0,0,'','','110.00','2','0.00','2',0,'0.00',0,'',1,1,NULL),(2,'PRADA 黑色斜跨包','111','','','','0.00','','',6,2,16,'2',NULL,'product/ae8deb1ae3139a6e603475441d75680f.jpg','product/91a791ff46592e73f3b37a5e293a0033.jpg','',0,'6',0,0,0,'','','','','',0,0,'','','0.00','','0.00','',0,'0.00',0,'',2,1,NULL),(3,'CELINE 女士黑色皮秋千手提包','','','','','0.00','','',7,2,17,'1',NULL,'product/6b68287325bb6c177db50fc2df87b60c.jpg','product/648b73a8f8f5fea0b2d4b5350cb011fb.jpg','',0,'7',0,0,0,'','','','','',0,0,'','','0.00','','0.00','',0,'0.00',0,'',2,1,1),(4,'FENDI棕色猫眼太阳眼镜','','','','','0.00','','',8,6,18,'',NULL,'product/02527a4f790df36804113733063d950e.jpg','product/229af358a71ac1ff37121de9d945377f.jpg','',0,'7',0,0,0,'','','','','',0,0,'','','0.00','','0.00','',0,'0.00',0,'',1,1,1),(5,'FENDI 女士巧克力色腰带','','','','','0.00','','',8,7,19,'1',NULL,'product/52df0f5164d0a27477eed0f2f68470b5.jpg','product/dec023d82f398c2aa2408c589aa13ec3.jpg','8',0,'7',0,0,0,'','','','','',0,0,'','','0.00','','0.00','',0,'0.00',0,'',1,1,1),(6,'CHIARA FERRAGNI 女士黑色背包','','','','','0.00','','',9,2,12,'',NULL,'product/c150ec24aa1394ec267e5bc80b835c5f.jpg','product/18f80ccfeb3cac2bf41e7bf14ff5fa5c.jpg','',0,'8',0,0,0,'','','','','',0,0,'','','0.00','','0.00','',0,'0.00',0,'',1,1,1),(7,'333377','','','','','0.00','','',5,2,12,'2',NULL,'product/75d558e4814861b7ceafa5e735ba0079.jpg','product/f12c64fefbfa5e8ec9d83c4353e170be.jpg','3',0,'6',0,0,0,'','','','','',0,0,'','','0.00','','0.00','',0,'0.00',0,'',1,1,1);

/*Table structure for table `tb_product_price` */

DROP TABLE IF EXISTS `tb_product_price`;

CREATE TABLE `tb_product_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
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

/*Data for the table `tb_product_price` */

/*Table structure for table `tb_product_search` */

DROP TABLE IF EXISTS `tb_product_search`;

CREATE TABLE `tb_product_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productname` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '商品名称',
  `productid` int(11) unsigned DEFAULT NULL COMMENT '商品id',
  `sizetopid` int(11) DEFAULT NULL COMMENT '尺码组id',
  `brandgroupid` int(11) DEFAULT NULL COMMENT '品类id',
  `brandgroupname_cn` varchar(100) DEFAULT NULL COMMENT '品类中文名称',
  `brandgroupname_en` varchar(100) DEFAULT NULL COMMENT '品类英文名称',
  `brandgroupname_hk` varchar(100) DEFAULT NULL COMMENT '品类粤语名称',
  `brandgroupname_fr` varchar(100) DEFAULT NULL COMMENT '品类法语名称',
  `brandgroupname_it` varchar(100) DEFAULT NULL COMMENT '品类意大利语名称',
  `brandgroupname_sp` varchar(100) DEFAULT NULL COMMENT '品类西班牙语名称',
  `brandgroupname_de` varchar(100) DEFAULT NULL COMMENT '品类德语名称',
  `childbrand` int(11) DEFAULT NULL COMMENT '子品类id',
  `childbrandname_cn` varchar(100) DEFAULT NULL COMMENT '子品类中文名称',
  `childbrandname_en` varchar(100) DEFAULT NULL COMMENT '子品类英文名称',
  `childbrandname_hk` varchar(100) DEFAULT NULL COMMENT '子品类粤语名称',
  `childbrandname_fr` varchar(100) DEFAULT NULL COMMENT '子品类法语名称',
  `childbrandname_it` varchar(100) DEFAULT NULL COMMENT '子品类意大利语名称',
  `childbrandname_sp` varchar(100) DEFAULT NULL COMMENT '子品类西班牙语名称',
  `childbrandname_de` varchar(100) DEFAULT NULL COMMENT '子品类德语名称',
  `number` int(11) DEFAULT NULL COMMENT '库存数量',
  `picture` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '主图',
  `picture2` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '副图',
  `color` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '颜色',
  `color_group` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '同组颜色',
  `price` decimal(16,2) DEFAULT NULL COMMENT '原价',
  `realprice` decimal(16,2) DEFAULT NULL COMMENT '折扣价',
  `companyid` int(11) DEFAULT NULL COMMENT '公司id',
  UNIQUE KEY `companyid_2` (`companyid`,`productid`),
  PRIMARY KEY `id` (`id`),
  KEY `companyid` (`companyid`,`brandgroupid`,`childbrand`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tb_product_search` */

insert  into `tb_product_search`(`id`,`productname`,`productid`,`sizetopid`,`brandgroupid`,`childbrand`,`number`,`picture`,`picture2`,`color`,`color_group`,`companyid`) values (6,'电脑包',2,2,2,14,5,'product/a820ad1b132e17bf95f90e91c698b31d.jpg','product/96d821008f5dafc77012b9e8706431fd.jpg',NULL,NULL,1),(7,'黑色运动上衣',1,1,1,5,25,'product/69e58f464fa1b44a47e7becc80974c42.jpg','product/ea79feeeee36dfb964f0341a1dad38b5.jpg',NULL,NULL,1);

/*Table structure for table `tb_productcode` */

DROP TABLE IF EXISTS `tb_productcode`;

CREATE TABLE `tb_productcode` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `productid` int(11) unsigned DEFAULT NULL,
  `sizecontentid` int(11) unsigned DEFAULT NULL,
  `goods_code` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '货号',
  PRIMARY KEY (`id`),
  UNIQUE KEY `productid` (`productid`,`sizecontentid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tb_productcode` */

insert  into `tb_productcode`(`id`,`productid`,`sizecontentid`,`goods_code`) values (1,1,1,'23564569891'),(2,1,2,'23564569892'),(3,1,3,'23564569893'),(4,1,4,'23564569894'),(5,1,5,'23564569895');

/*Table structure for table `tb_productinnards` */

DROP TABLE IF EXISTS `tb_productinnards`;

CREATE TABLE `tb_productinnards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='内部结构';

/*Data for the table `tb_productinnards` */

insert  into `tb_productinnards`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`) values (1,'拉链','','',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_productparts` */

DROP TABLE IF EXISTS `tb_productparts`;

CREATE TABLE `tb_productparts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='附带配件\n';

/*Data for the table `tb_productparts` */

insert  into `tb_productparts`(`id`,`partscode`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`packflag`) values (1,'001','挂钩','','',NULL,NULL,NULL,NULL,'0'),(2,'002','鞋带','','',NULL,NULL,NULL,NULL,'');

/*Table structure for table `tb_productstock` */

DROP TABLE IF EXISTS `tb_productstock`;

CREATE TABLE `tb_productstock` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `goodsid` int(10) unsigned DEFAULT NULL,
  `productid` int(10) unsigned NOT NULL,
  `sizecontentid` int(10) unsigned NOT NULL,
  `defective_level` tinyint(11) DEFAULT '0' COMMENT '残次品等级；0=合格品 1=残次品',
  `property` tinyint(1) DEFAULT NULL COMMENT '0-自采 1-代销',
  `warehouseid` int(10) unsigned NOT NULL COMMENT '仓库id',
  `companyid` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_stuff` int(10) unsigned DEFAULT NULL COMMENT '创建人',
  `change_time` datetime DEFAULT NULL COMMENT '修改时间',
  `change_stuff` int(10) unsigned DEFAULT NULL COMMENT '修改人',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  PRIMARY KEY (`id`),
  UNIQUE KEY `companyid` (`companyid`,`warehouseid`,`goodsid`),
  KEY `warehouseid` (`warehouseid`,`defective_level`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COMMENT='库存';

/*Data for the table `tb_productstock` */

insert  into `tb_productstock`(`id`,`goodsid`,`productid`,`sizecontentid`,`defective_level`,`property`,`warehouseid`,`companyid`,`create_time`,`create_stuff`,`change_time`,`change_stuff`,`number`) values (1,1,1,3,0,1,2,1,'2019-03-26 12:03:35',1,'2019-03-30 14:20:40',1,3),(2,2,1,4,0,2,2,1,'2019-03-26 12:03:35',1,'2019-03-30 14:20:40',1,12),(3,2,1,4,0,2,4,1,'2019-03-28 09:26:28',1,'2019-03-28 09:28:37',1,3),(4,1,1,3,0,1,4,1,'2019-03-28 09:26:28',1,'2019-03-30 14:19:26',1,2),(5,9,2,11,0,1,2,1,'2019-03-30 10:49:49',1,'2019-03-30 10:49:49',1,2),(6,10,2,12,0,1,2,1,'2019-03-30 10:49:49',1,'2019-03-30 10:49:49',1,2),(7,11,2,13,0,1,2,1,'2019-03-30 10:49:49',1,'2019-03-30 10:49:49',1,1),(8,1,1,3,0,1,1,1,'2019-03-30 14:18:55',1,'2019-04-01 17:50:56',1,3),(9,2,1,4,0,2,1,1,'2019-03-30 14:18:55',1,'2019-03-30 14:20:58',1,5),(16,18,2,6,0,1,2,1,'2019-04-01 17:50:11',1,'2019-04-01 17:50:11',1,1),(17,19,2,7,0,1,2,1,'2019-04-01 17:50:11',1,'2019-04-01 17:50:11',1,2),(18,1,1,3,0,1,5,1,'2019-04-01 17:50:48',1,'2019-04-01 17:51:00',1,2);

/*Table structure for table `tb_productstock_log` */

DROP TABLE IF EXISTS `tb_productstock_log`;

CREATE TABLE `tb_productstock_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouseid` int(11) NOT NULL,
  `productstockid` int(11) NOT NULL,
  `number_before` int(11) NOT NULL,
  `number_after` int(11) NOT NULL,
  `change_type` int(11) NOT NULL,
  `change_time` datetime NOT NULL,
  `relationid` int(11) DEFAULT NULL,
  `companyid` int(11) DEFAULT NULL,
  `change_stuff` int(11) DEFAULT NULL COMMENT '操作人',
  PRIMARY KEY (`id`),
  KEY `companyid` (`companyid`,`warehouseid`),
  KEY `companyid_2` (`companyid`,`productstockid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tb_productstock_log` */

insert  into `tb_productstock_log`(`id`,`warehouseid`,`productstockid`,`number_before`,`number_after`,`change_type`,`change_time`,`relationid`,`companyid`,`change_stuff`) values (1,2,2,10,6,3,'2019-03-28 09:27:22',1,1,1),(2,2,1,10,5,3,'2019-03-28 09:27:22',2,1,1),(3,4,3,0,3,2,'2019-03-28 09:28:37',1,1,1),(4,4,4,0,4,2,'2019-03-28 09:28:37',2,1,1),(5,2,2,6,7,2,'2019-03-28 09:55:43',5,1,1),(6,2,1,5,6,2,'2019-03-28 09:55:43',6,1,1),(7,2,1,6,5,1,'2019-03-29 11:12:14',14,1,1),(8,2,2,7,5,1,'2019-03-29 11:18:59',15,1,1),(9,2,1,5,4,1,'2019-03-29 11:18:59',16,1,1),(10,2,2,5,3,1,'2019-03-29 11:26:59',17,1,1),(11,2,1,4,1,1,'2019-03-29 11:26:59',18,1,1),(12,2,1,10,6,1,'2019-03-29 11:29:07',19,1,1),(13,2,2,20,17,1,'2019-03-29 11:29:07',20,1,1),(14,2,5,0,2,4,'2019-03-30 10:49:49',13,1,1),(15,2,6,0,2,4,'2019-03-30 10:49:49',14,1,1),(16,2,7,0,1,4,'2019-03-30 10:49:49',15,1,1),(17,4,4,4,2,3,'2019-03-30 14:19:26',8,1,1),(18,2,2,17,12,3,'2019-03-30 14:20:40',9,1,1),(19,2,1,6,3,3,'2019-03-30 14:20:40',10,1,1),(20,1,9,0,5,2,'2019-03-30 14:20:58',9,1,1),(21,1,8,0,3,2,'2019-03-30 14:20:58',10,1,1),(22,1,8,3,5,2,'2019-03-30 14:21:24',8,1,1),(23,2,16,0,1,4,'2019-04-01 17:50:11',22,1,1),(24,2,17,0,2,4,'2019-04-01 17:50:11',23,1,1),(25,1,8,5,3,3,'2019-04-01 17:50:56',11,1,1),(26,5,18,0,2,2,'2019-04-01 17:51:00',11,1,1);

/*Table structure for table `tb_productstock_snapshot` */

DROP TABLE IF EXISTS `tb_productstock_snapshot`;

CREATE TABLE `tb_productstock_snapshot` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `snapdate` datetime DEFAULT NULL,
  `productstockid` int(10) unsigned DEFAULT NULL,
  `productid` int(10) unsigned DEFAULT NULL,
  `sizeid` int(10) unsigned DEFAULT NULL,
  `stockid` int(10) unsigned DEFAULT NULL,
  `productno` bigint(20) DEFAULT NULL,
  `selltime` datetime DEFAULT NULL,
  `sellprice` decimal(16,9) DEFAULT NULL,
  `cost` decimal(16,9) DEFAULT NULL,
  `selltype` int(11) DEFAULT NULL COMMENT '0-待销\n            1-已售出\n            2-预定\n            3-在途\n            4-调拨锁定',
  `dealprice` decimal(16,9) DEFAULT NULL,
  `qualitystatus` int(11) DEFAULT NULL COMMENT '0-合格品\n            1-残次品\n            2-库存差异',
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

/*Data for the table `tb_productstock_snapshot` */

/*Table structure for table `tb_producttemplate` */

DROP TABLE IF EXISTS `tb_producttemplate`;

CREATE TABLE `tb_producttemplate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  `picture` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='商品模板-主表';

/*Data for the table `tb_producttemplate` */

insert  into `tb_producttemplate`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`picture`) values (1,'44','','',NULL,NULL,NULL,NULL,'producttemplate/ec0fbceab6b1c0ea0b6fd84665e318d5.jpg');

/*Table structure for table `tb_requisition` */

DROP TABLE IF EXISTS `tb_requisition`;

CREATE TABLE `tb_requisition` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `feecurrencyid` int(10) unsigned DEFAULT NULL,
  `fee` decimal(16,9) DEFAULT NULL,
  `apply_staff` int(10) unsigned NOT NULL,
  `apply_date` datetime NOT NULL,
  `turnin_staff` int(10) unsigned DEFAULT NULL,
  `turnin_date` datetime DEFAULT NULL,
  `turnout_staff` int(10) unsigned DEFAULT NULL,
  `turnout_date` datetime DEFAULT NULL,
  `out_id` int(10) unsigned NOT NULL COMMENT '调出库id',
  `in_id` int(10) unsigned NOT NULL COMMENT '调入库id',
  `memo` varchar(500) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '1=出库拒绝 2=出库待确认 3=在途 4=入库拒绝 5=完成',
  `requisitionno` varchar(50) DEFAULT NULL,
  `salesid` int(10) unsigned DEFAULT NULL,
  `ism` tinyint(1) DEFAULT NULL COMMENT '1-主单，0或者空-子单或单对单库调拨单',
  `is_quality` tinyint(1) DEFAULT NULL COMMENT '0-合格品 1-残品',
  `is_amortized` tinyint(1) DEFAULT NULL,
  `expresscomoany` int(1) DEFAULT NULL COMMENT '0-顺丰 1-德邦 2-京东 3-其他',
  `address` char(1) DEFAULT NULL,
  `markno` varchar(50) DEFAULT NULL,
  `is_return` tinyint(1) DEFAULT NULL COMMENT '0-普通调拨单，1-反向调拨单',
  `companyid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `out_id` (`out_id`),
  KEY `in_id` (`in_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='调拨单主表';

/*Data for the table `tb_requisition` */

insert  into `tb_requisition`(`id`,`feecurrencyid`,`fee`,`apply_staff`,`apply_date`,`turnin_staff`,`turnin_date`,`turnout_staff`,`turnout_date`,`out_id`,`in_id`,`memo`,`status`,`requisitionno`,`salesid`,`ism`,`is_quality`,`is_amortized`,`expresscomoany`,`address`,`markno`,`is_return`,`companyid`) values (2,NULL,NULL,1,'2019-03-28 09:26:28',1,'2019-03-28 09:28:37',1,'2019-03-28 09:27:22',2,4,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(3,NULL,NULL,1,'2019-03-28 09:26:28',NULL,NULL,NULL,NULL,2,4,'out deny',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(4,NULL,NULL,1,'2019-03-28 09:28:37',1,'2019-03-28 09:55:43',1,'2019-03-28 09:28:37',4,2,'in deny',5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(10,NULL,NULL,1,'2019-03-30 14:18:55',1,'2019-03-30 14:21:24',1,'2019-03-30 14:19:26',4,1,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(11,NULL,NULL,1,'2019-03-30 14:18:55',1,'2019-03-30 14:20:58',1,'2019-03-30 14:20:40',2,1,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(12,NULL,NULL,1,'2019-04-01 17:50:48',1,'2019-04-01 17:51:00',1,'2019-04-01 17:50:56',1,5,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1);

/*Table structure for table `tb_requisition_detail` */

DROP TABLE IF EXISTS `tb_requisition_detail`;

CREATE TABLE `tb_requisition_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `requisitionid` int(10) unsigned NOT NULL COMMENT '调拨单id',
  `out_productstockid` int(11) unsigned DEFAULT NULL COMMENT '调出库存ID',
  `in_productstockid` int(11) unsigned DEFAULT NULL COMMENT '调入库存id',
  `number` int(11) DEFAULT NULL COMMENT '数量',
  `memo` varchar(100) DEFAULT NULL,
  `out_number` int(11) DEFAULT NULL COMMENT '出库数量',
  `in_number` int(11) DEFAULT NULL COMMENT '入库数量',
  PRIMARY KEY (`id`),
  KEY `in_productstockid` (`in_productstockid`),
  KEY `out_productstockid` (`out_productstockid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='调拨单明细(数量)';

/*Data for the table `tb_requisition_detail` */

insert  into `tb_requisition_detail`(`id`,`requisitionid`,`out_productstockid`,`in_productstockid`,`number`,`memo`,`out_number`,`in_number`) values (1,2,2,3,7,NULL,4,3),(2,2,1,4,6,NULL,5,4),(3,3,2,3,3,NULL,NULL,NULL),(4,3,1,4,1,NULL,NULL,NULL),(5,4,3,2,1,NULL,1,1),(6,4,4,1,1,NULL,1,1),(7,55,NULL,NULL,33,NULL,NULL,NULL),(8,10,4,8,2,NULL,2,2),(9,11,2,9,5,NULL,5,5),(10,11,1,8,3,NULL,3,3),(11,12,8,18,2,NULL,2,2);

/*Table structure for table `tb_saleport` */

DROP TABLE IF EXISTS `tb_saleport`;

CREATE TABLE `tb_saleport` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '名称',
  `discount` decimal(5,3) DEFAULT NULL COMMENT '折扣',
  `create_time` datetime DEFAULT NULL,
  `companyid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tb_saleport` */

insert  into `tb_saleport`(`id`,`name`,`discount`,`create_time`,`companyid`) values (1,'银河广场','0.900',NULL,1),(2,'自营网站','1.000',NULL,1),(3,'哈尔滨零售店','0.900',NULL,1),(4,'京东批发','0.800',NULL,1),(5,'寺库网','0.850',NULL,1),(6,'天猫自营店铺','0.900',NULL,1);

/*Table structure for table `tb_saleport_warehouse` */

DROP TABLE IF EXISTS `tb_saleport_warehouse`;

CREATE TABLE `tb_saleport_warehouse` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `saleportid` int(11) unsigned DEFAULT NULL,
  `warehouseid` int(11) unsigned DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `saleportid` (`saleportid`,`warehouseid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tb_saleport_warehouse` */

insert  into `tb_saleport_warehouse`(`id`,`saleportid`,`warehouseid`,`create_time`) values (1,1,1,NULL),(2,1,2,NULL);

/*Table structure for table `tb_sales` */

DROP TABLE IF EXISTS `tb_sales`;

CREATE TABLE `tb_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `memberid` int(10) unsigned DEFAULT NULL COMMENT '会员ID',
  `salesstaff` int(10) unsigned DEFAULT NULL COMMENT '销售人员ID',
  `salesdate` varchar(10) DEFAULT NULL COMMENT '销售日期',
  `discount` decimal(5,2) DEFAULT NULL COMMENT '折扣',
  `saleportid` int(10) unsigned DEFAULT NULL COMMENT '销售端口id',
  `companyid` int(10) unsigned NOT NULL COMMENT '公司id',
  `ordercode` varchar(50) DEFAULT NULL COMMENT '对账单号',
  `warehouseid` int(10) unsigned DEFAULT NULL COMMENT '销售仓库id',
  `expressno` varchar(50) DEFAULT NULL,
  `expresspaidtype` tinyint(1) DEFAULT NULL COMMENT '0-预付 1-到付 2-第三方付费 3-储值卡 4-转账 5-协议结算',
  `expressfee` decimal(16,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0-预售 1-已售 2-作废',
  `address` varchar(255) DEFAULT NULL,
  `externalno` varchar(50) DEFAULT NULL COMMENT '外部订单号',
  `pickingtype` tinyint(1) DEFAULT NULL COMMENT '0-自提 1-快递 2-门店直发',
  `makestaff` int(11) unsigned NOT NULL COMMENT '制单人',
  `makedate` datetime NOT NULL COMMENT '制单日期',
  `orderno` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orderno` (`orderno`),
  KEY `saleportid` (`saleportid`),
  CONSTRAINT `tb_sales_ibfk_1` FOREIGN KEY (`saleportid`) REFERENCES `tb_saleport` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COMMENT='销售主表';

/*Data for the table `tb_sales` */

insert  into `tb_sales`(`id`,`memberid`,`salesstaff`,`salesdate`,`discount`,`saleportid`,`companyid`,`ordercode`,`warehouseid`,`expressno`,`expresspaidtype`,`expressfee`,`status`,`address`,`externalno`,`pickingtype`,`makestaff`,`makedate`,`orderno`) values (53,0,2,'','1.60',1,1,'',2,'',0,'0.00',1,'','',0,1,'2019-03-29 11:12:14','S000001201903291112146905'),(54,2,0,'','1.30',3,1,'',2,'',0,'0.00',1,'','',0,1,'2019-03-29 11:13:46','S000001201903291113461155'),(55,0,0,'','1.60',1,1,'',2,'',0,'0.00',1,'','',0,1,'2019-03-29 11:26:59','S000001201903291126598729'),(56,0,0,'','1.60',1,1,'',2,'',0,'0.00',1,'','',0,1,'2019-03-29 11:29:07','S000001201903291129073631');

/*Table structure for table `tb_salesdetails` */

DROP TABLE IF EXISTS `tb_salesdetails`;

CREATE TABLE `tb_salesdetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `salesid` int(10) unsigned NOT NULL COMMENT '销售单id',
  `productstockid` int(10) unsigned DEFAULT NULL COMMENT '库存id',
  `number` int(11) DEFAULT NULL COMMENT '数量',
  `dealprice` decimal(16,2) DEFAULT NULL COMMENT '成交总价',
  `price` decimal(16,2) DEFAULT NULL COMMENT '基准单价',
  `is_match` tinyint(1) DEFAULT NULL COMMENT '是否是端口价格',
  PRIMARY KEY (`id`),
  KEY `salesid` (`salesid`),
  KEY `productstockid` (`productstockid`),
  CONSTRAINT `tb_salesdetails_ibfk_1` FOREIGN KEY (`salesid`) REFERENCES `tb_sales` (`id`),
  CONSTRAINT `tb_salesdetails_ibfk_2` FOREIGN KEY (`productstockid`) REFERENCES `tb_productstock` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COMMENT='销售单明细(数量)';

/*Data for the table `tb_salesdetails` */

insert  into `tb_salesdetails`(`id`,`salesid`,`productstockid`,`number`,`dealprice`,`price`,`is_match`) values (14,53,1,1,'0.00','1100.00',1),(15,54,2,2,'0.00','8000.00',1),(16,54,1,1,'0.00','1100.00',1),(17,55,2,2,'0.00','8000.00',1),(18,55,1,3,'0.00','1100.00',1),(19,56,1,4,'0.00','1100.00',1),(20,56,2,3,'0.00','8000.00',1);

/*Table structure for table `tb_series` */

DROP TABLE IF EXISTS `tb_series`;

CREATE TABLE `tb_series` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  `code` varchar(100) DEFAULT NULL COMMENT '中文代码名称',
  `brandid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

/*Data for the table `tb_series` */

insert  into `tb_series`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`code`,`brandid`) values (1,'44','','45',NULL,NULL,NULL,NULL,'55',2),(2,'22','','',NULL,NULL,NULL,NULL,'33',1),(3,'33','','',NULL,NULL,NULL,NULL,'33',3);

/*Table structure for table `tb_series2` */

DROP TABLE IF EXISTS `tb_series2`;

CREATE TABLE `tb_series2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `seriesid` int(10) unsigned DEFAULT NULL,
  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  `code` varchar(100) DEFAULT NULL COMMENT '中文代码名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='子系列';

/*Data for the table `tb_series2` */

insert  into `tb_series2`(`id`,`seriesid`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`code`) values (1,1,'444','454','',NULL,NULL,NULL,NULL,NULL),(2,2,'44','','',NULL,NULL,NULL,NULL,NULL),(3,1,'www','','',NULL,NULL,NULL,NULL,'www'),(4,1,'ccc','','',NULL,NULL,NULL,NULL,'cc');

/*Table structure for table `tb_sizecontent` */

DROP TABLE IF EXISTS `tb_sizecontent`;

CREATE TABLE `tb_sizecontent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COMMENT='尺码明细';

/*Data for the table `tb_sizecontent` */

insert  into `tb_sizecontent`(`id`,`topid`,`content_cn`,`content_en`,`content_hk`,`content_fr`,`content_it`,`content_sp`,`content_de`,`sortnum`,`memo_cn`,`memo_en`,`memo_hk`,`memo_fr`,`memo_it`,`memo_sp`,`memo_de`) values (1,1,'XXL','','',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,1,'XL','','',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,1,'S','','',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,'M','','',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,1,'XXXL','','',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,2,'36','','',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,2,'37','','',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,2,'38','','',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,2,'39','','',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,2,'40','','',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,2,'41','','',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,2,'42','','',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,2,'43','','',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tb_sizetop` */

DROP TABLE IF EXISTS `tb_sizetop`;

CREATE TABLE `tb_sizetop` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  `code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='尺码组';

/*Data for the table `tb_sizetop` */

insert  into `tb_sizetop`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`code`) values (1,'欧码','','',NULL,NULL,NULL,NULL,'001'),(2,'鞋号','','',NULL,NULL,NULL,NULL,'');

/*Table structure for table `tb_supplier` */

DROP TABLE IF EXISTS `tb_supplier`;

CREATE TABLE `tb_supplier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

/*Data for the table `tb_supplier` */

insert  into `tb_supplier`(`id`,`suppliername`,`englishname`,`address`,`phone`,`zipcode`,`email`,`quotedprice`,`developdate`,`nationality`,`nature`,`supplierlevel`,`companyzipcode`,`maincontacts`,`microblog`,`countrycity`,`suppliercode`,`fax`,`calculation`,`legal`,`heading`,`businesslicense`,`headingnumber`,`registered`,`registeredcapital`,`endtime`,`type`,`contractfrom`,`contractto`,`contractrate`,`contractremind`,`settlecompanyid`,`memo`) values (1,'GIANO S.N.C.','66','56','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'11','GIANO S.N.C.','',NULL,'','','',NULL,'','0','','',NULL,NULL,NULL,NULL,NULL,'66'),(2,'顺丰速递','','rr','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','007','',NULL,'','','',NULL,'','0','','',NULL,NULL,NULL,NULL,NULL,''),(3,'菜鸟物流','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2','003','',NULL,'','','',NULL,'','0','','',NULL,NULL,NULL,NULL,NULL,''),(4,'GILMAR','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2','GILMAR','',NULL,'','','',NULL,'','0','','',NULL,NULL,NULL,NULL,NULL,''),(5,'LEMCO SRL','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','LEMCO SRL','',NULL,'','','',NULL,'','0','','',NULL,NULL,NULL,NULL,NULL,''),(6,'VASA-FASHION SRL','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','VASA-FASHION SRL','',NULL,'','','',NULL,'','0','','',NULL,NULL,NULL,NULL,NULL,'');

/*Table structure for table `tb_templatemanage` */

DROP TABLE IF EXISTS `tb_templatemanage`;

CREATE TABLE `tb_templatemanage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='商品模板-从表';

/*Data for the table `tb_templatemanage` */

insert  into `tb_templatemanage`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`tempid`,`sortnum`) values (1,'55','','',NULL,NULL,NULL,NULL,1,66);

/*Table structure for table `tb_ulnarinch` */

DROP TABLE IF EXISTS `tb_ulnarinch`;

CREATE TABLE `tb_ulnarinch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

/*Data for the table `tb_ulnarinch` */

insert  into `tb_ulnarinch`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`) values (1,'1.0CM','','',NULL,NULL,NULL,NULL),(2,'2.0CM','','',NULL,NULL,NULL,NULL),(3,'3.0CM','','',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_user` */

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
  `sex` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobilephone` varchar(50) DEFAULT NULL,
  `e_mail` varchar(100) DEFAULT NULL,
  `email_password` varchar(50) DEFAULT NULL COMMENT '用于自动发送邮件',
  `memo` text COMMENT '备注',
  `countryid` int(10) unsigned DEFAULT NULL,
  `departmentid2` int(10) unsigned DEFAULT NULL,
  `address` text,
  `contactor` text,
  `leave_date` varchar(100) DEFAULT NULL,
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
  `saleportid` int(11) unsigned DEFAULT NULL COMMENT '默认销售端口',
  `saleportids` varchar(200) DEFAULT NULL COMMENT '销售端口',
  `warehouseid` int(11) DEFAULT NULL COMMENT '默认仓库',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_user_login_name` (`login_name`),
  KEY `saleportid` (`saleportid`),
  CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`saleportid`) REFERENCES `tb_saleport` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`login_name`,`password`,`real_name`,`departmentid`,`companyid`,`groupid`,`storeid`,`sex`,`section`,`date`,`phone`,`mobilephone`,`e_mail`,`email_password`,`memo`,`countryid`,`departmentid2`,`address`,`contactor`,`leave_date`,`idno`,`education`,`collegemajor`,`degree`,`graduatedcollege`,`stateofmarriage`,`censusregistration`,`status`,`reason`,`contactorphone`,`costdisplay`,`wechat`,`openid`,`saleportid`,`saleportids`,`warehouseid`) values (1,'admin','e10adc3949ba59abbe56e057f20f883e','场合',1,1,1,0,'','','','','','','',NULL,0,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3,1',NULL),(2,'路人甲','bcc720f2981d1a68dbd66ffd67560c37','',2,1,2,0,'','','','','','','',NULL,0,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tb_warehouse` */

DROP TABLE IF EXISTS `tb_warehouse`;

CREATE TABLE `tb_warehouse` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `countryid` int(11) DEFAULT NULL COMMENT '国家ID',
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
  `companyid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companyid` (`companyid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='仓库信息';

/*Data for the table `tb_warehouse` */

insert  into `tb_warehouse`(`id`,`countryid`,`city`,`name`,`address`,`contact`,`toll`,`fax`,`mobile`,`othercontact`,`code`,`defaultstore`,`zipcode`,`is_real`,`maxstock`,`maxsku`,`companyid`) values (1,0,'','北京仓库','','',NULL,'','','','',NULL,'','0',NULL,NULL,1),(2,0,'','成都仓库','','',NULL,'','','','',NULL,'','',NULL,NULL,1),(3,0,'','广州仓库','','',NULL,'','','','',NULL,'','',NULL,NULL,1),(4,0,'','香港仓库','','',NULL,'','','','',NULL,'','',NULL,NULL,1),(5,0,'','郑州仓库','','',NULL,'','','','',NULL,'','0',NULL,NULL,1);

/*Table structure for table `tb_warehouse_user` */

DROP TABLE IF EXISTS `tb_warehouse_user`;

CREATE TABLE `tb_warehouse_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `warehouseid` int(11) unsigned NOT NULL,
  `userid` int(11) unsigned NOT NULL,
  `warehouseroleid` tinyint(11) DEFAULT NULL COMMENT '仓库角色：1=管理员；2：销售',
  `create_time` datetime DEFAULT NULL,
  `companyid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `warehouseid` (`companyid`,`warehouseid`,`userid`,`warehouseroleid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tb_warehouse_user` */

insert  into `tb_warehouse_user`(`id`,`warehouseid`,`userid`,`warehouseroleid`,`create_time`,`companyid`) values (1,1,1,1,NULL,1),(2,2,1,2,NULL,1),(3,5,1,2,NULL,1),(5,2,2,NULL,NULL,1);

/*Table structure for table `tb_warehousing` */

DROP TABLE IF EXISTS `tb_warehousing`;

CREATE TABLE `tb_warehousing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `orderno` varchar(100) DEFAULT NULL COMMENT '入库单号',
  `companyid` int(11) DEFAULT NULL COMMENT '公司id',
  `warehouseid` int(11) DEFAULT NULL COMMENT '仓库id',
  `confirmorderid` int(10) unsigned DEFAULT NULL COMMENT '发货单id',
  `makedate` datetime DEFAULT NULL COMMENT '操作时间',
  `makestaff` int(10) unsigned NOT NULL COMMENT '操作人',
  `entrydate` date NOT NULL COMMENT '入库日期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `confirmorderid` (`confirmorderid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COMMENT='入库单主表';

/*Data for the table `tb_warehousing` */

insert  into `tb_warehousing`(`id`,`orderno`,`companyid`,`warehouseid`,`confirmorderid`,`makedate`,`makestaff`,`entrydate`) values (14,'T000001201903301049492874',1,2,25,'2019-03-30 10:49:49',1,'2019-03-30'),(21,'T000001201904011750116202',1,2,26,'2019-04-01 17:50:11',1,'2019-04-02'),(22,'T000001201904011945443290',1,4,27,'2019-04-01 19:45:44',1,'2019-04-01'),(23,'T000001201904011946153752',1,4,28,'2019-04-01 19:46:15',1,'2019-03-31'),(24,'T000001201904011946285391',1,4,29,'2019-04-01 19:46:28',1,'2019-03-28');

/*Table structure for table `tb_warehousingdetails` */

DROP TABLE IF EXISTS `tb_warehousingdetails`;

CREATE TABLE `tb_warehousingdetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `companyid` int(11) NOT NULL,
  `orderdetailsid` int(10) unsigned NOT NULL,
  `number` int(11) NOT NULL,
  `confirmorderdetailsid` int(11) DEFAULT NULL,
  `warehousingid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warehousingid` (`warehousingid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COMMENT='入库单明细表';

/*Data for the table `tb_warehousingdetails` */

insert  into `tb_warehousingdetails`(`id`,`companyid`,`orderdetailsid`,`number`,`confirmorderdetailsid`,`warehousingid`) values (13,1,37,2,3,14),(14,1,36,2,4,14),(15,1,35,1,5,14),(22,1,42,1,6,21),(23,1,41,2,7,21);

/*Table structure for table `td_confirmorder` */

DROP TABLE IF EXISTS `td_confirmorder`;

CREATE TABLE `td_confirmorder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `companyid` int(11) DEFAULT NULL COMMENT '公司id',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态:1-未提交审核；2-待审核；3-审核完成,4-作废',
  `orderno` varchar(50) DEFAULT NULL COMMENT '发货单号',
  `supplierid` int(10) unsigned DEFAULT NULL COMMENT '供货商id',
  `makedate` datetime DEFAULT NULL COMMENT '制单日期',
  `makestaff` int(10) unsigned DEFAULT NULL COMMENT '制单人',
  `currency` int(10) unsigned DEFAULT NULL COMMENT '货币类型',
  `total` decimal(16,2) DEFAULT NULL COMMENT '总金额',
  `isstatus` tinyint(1) DEFAULT NULL COMMENT '0-在途未入库，1-已入库，2-已备货未发出',
  `memo` varchar(200) DEFAULT NULL,
  `brandid` int(10) unsigned DEFAULT NULL,
  `ageseasonid` int(10) unsigned DEFAULT NULL COMMENT '年份季节id',
  `seasontype` tinyint(1) DEFAULT NULL COMMENT '0-pre ,1-main ,2-fashion show',
  `auditstaff` int(10) unsigned DEFAULT NULL COMMENT '审核人',
  `auditdate` datetime DEFAULT NULL COMMENT '审核日期',
  `exchangerate` decimal(16,4) DEFAULT NULL,
  `finalsupplierid` int(10) unsigned DEFAULT NULL COMMENT '供货单位id',
  `flightno` varchar(50) DEFAULT NULL COMMENT '航班号',
  `flightdate` varchar(10) DEFAULT NULL,
  `arrivaldate` varchar(10) DEFAULT NULL,
  `mblno` varchar(50) DEFAULT NULL COMMENT '主单号',
  `hblno` varchar(50) DEFAULT NULL COMMENT '子单号',
  `dispatchport` varchar(50) DEFAULT NULL,
  `deliveryport` varchar(50) DEFAULT NULL,
  `transcompany` int(10) unsigned DEFAULT NULL,
  `isexamination` tinyint(1) DEFAULT NULL,
  `examinationresult` varchar(50) DEFAULT NULL,
  `clearancedate` datetime DEFAULT NULL,
  `pickingdate` datetime DEFAULT NULL,
  `motortransportpool` varchar(50) DEFAULT NULL,
  `warehouseid` int(10) unsigned DEFAULT NULL,
  `box_number` int(11) DEFAULT NULL COMMENT '箱数',
  `weight` decimal(16,2) DEFAULT NULL COMMENT '重量',
  `volume` decimal(16,2) DEFAULT NULL COMMENT '体积',
  `issjyh` varchar(1) DEFAULT NULL,
  `sellerid` int(10) unsigned DEFAULT NULL,
  `sjyhresult` varchar(50) DEFAULT NULL,
  `buyerid` int(10) unsigned DEFAULT NULL,
  `transporttype` tinyint(1) DEFAULT NULL COMMENT '0-by air 1-快递 2-中转',
  `paytype` tinyint(1) DEFAULT NULL COMMENT '0- t/t',
  `property` tinyint(1) DEFAULT NULL COMMENT '0-自采 1-代销',
  `payoutpercentage` varchar(10) DEFAULT NULL COMMENT '属性',
  `pickingaddress` text,
  `chargedweight` decimal(16,2) DEFAULT NULL COMMENT '计费重量',
  `paydate` varchar(10) DEFAULT NULL,
  `apickingdate` varchar(10) DEFAULT NULL COMMENT '安排提货时间',
  `aarrivaldate` varchar(10) DEFAULT NULL COMMENT '到库时间',
  `invoiceno` varchar(50) DEFAULT NULL,
  `dd_company` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COMMENT='发货单';

/*Data for the table `td_confirmorder` */

insert  into `td_confirmorder`(`id`,`companyid`,`status`,`orderno`,`supplierid`,`makedate`,`makestaff`,`currency`,`total`,`isstatus`,`memo`,`brandid`,`ageseasonid`,`seasontype`,`auditstaff`,`auditdate`,`exchangerate`,`finalsupplierid`,`flightno`,`flightdate`,`arrivaldate`,`mblno`,`hblno`,`dispatchport`,`deliveryport`,`transcompany`,`isexamination`,`examinationresult`,`clearancedate`,`pickingdate`,`motortransportpool`,`warehouseid`,`box_number`,`weight`,`volume`,`issjyh`,`sellerid`,`sjyhresult`,`buyerid`,`transporttype`,`paytype`,`property`,`payoutpercentage`,`pickingaddress`,`chargedweight`,`paydate`,`apickingdate`,`aarrivaldate`,`invoiceno`,`dd_company`) values (25,1,3,'C000001201903291913295586',1,'2019-03-29 19:13:29',1,5,'0.00',NULL,NULL,NULL,1,1,NULL,NULL,'0.0000',1,'','',NULL,'','','','',0,NULL,NULL,NULL,NULL,NULL,2,0,'0.00','0.00',NULL,0,NULL,0,0,0,1,NULL,NULL,'0.00','','','','',0),(26,1,3,'C000001201904011733341115',4,'2019-04-01 17:33:34',1,0,'0.00',NULL,NULL,NULL,6,1,NULL,NULL,'0.0000',4,'','',NULL,'','','','',0,NULL,NULL,NULL,NULL,NULL,2,0,'0.00','0.00',NULL,0,NULL,0,0,0,1,NULL,NULL,'0.00','','','','',0),(27,1,2,'C000001201904011939563784',6,'2019-04-01 19:39:56',1,0,'0.00',NULL,NULL,NULL,2,1,NULL,NULL,'0.0000',6,'','',NULL,'','','','',0,NULL,NULL,NULL,NULL,NULL,4,0,'0.00','0.00',NULL,0,NULL,0,0,0,1,NULL,NULL,'0.00','','','','',0),(28,1,2,'C000001201904011941139972',5,'2019-04-01 19:41:13',1,0,'0.00',NULL,NULL,NULL,5,1,NULL,NULL,'0.0000',5,'','',NULL,'','','','',0,NULL,NULL,NULL,NULL,NULL,4,0,'0.00','0.00',NULL,0,NULL,0,0,0,1,NULL,NULL,'0.00','','','','',0),(29,1,3,'C000001201904011941359914',6,'2019-04-01 19:41:35',1,0,'0.00',NULL,NULL,NULL,6,2,NULL,NULL,'0.0000',6,'','',NULL,'','','','',0,NULL,NULL,NULL,NULL,NULL,4,0,'0.00','0.00',NULL,0,NULL,0,0,0,2,NULL,NULL,'0.00','','','','',0);

DROP TABLE IF EXISTS `tb_shoporder`;

CREATE TABLE `tb_shoporder` (
                              `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
                              `product_id` int(10) NOT NULL COMMENT '商品id',
                              `order_commonid` int(10) UNSIGNED NOT NULL COMMENT '订单公共表id',
                              `product_name` varchar(255) NOT NULL COMMENT '商品名称',
                              `price` decimal(9,2) NOT NULL COMMENT '价格',
                              `number` int(10) NOT NULL COMMENT '数量',
                              `total_price` decimal(9,2) NOT NULL COMMENT '此商品的总价格',
                              `picture` varchar(255) DEFAULT NULL,
                              `color_id` int(10) NOT NULL COMMENT '颜色id',
                              `color_name` varchar(64) NOT NULL COMMENT '颜色名称',
                              `size_id` int(10) NOT NULL COMMENT '规格id',
                              `size_name` varchar(64) NOT NULL COMMENT '规格名称',
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='支付订单详情表';


DROP TABLE IF EXISTS `tb_shoporder_common`;

CREATE TABLE `tb_shoporder_common` (
                                     `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
                                     `order_no` varchar(255) DEFAULT NULL COMMENT '订单号',
                                     `member_id` int(10) DEFAULT NULL COMMENT '会员id',
                                     `reciver_name` varchar(64) DEFAULT NULL COMMENT '收件人',
                                     `reciver_phone` varchar(64) DEFAULT NULL COMMENT '手机',
                                     `reciver_address` varchar(255) DEFAULT NULL COMMENT '地址',
                                     `reciver_no` varchar(18) DEFAULT NULL COMMENT '身份证',
                                     `total_price` decimal(9,2) DEFAULT NULL COMMENT '商品总计',
                                     `send_price` decimal(9,2) DEFAULT '0.00' COMMENT '运费',
                                     `final_price` decimal(9,2) DEFAULT NULL COMMENT '成交价',
                                     `order_status` int(1) DEFAULT '1' COMMENT '订单状态(1未支付；2已支付；未完成；3已完成；4已取消；5退款中；6已退款)',
                                     `pay_style` int(1) DEFAULT '0' COMMENT '支付方式(0未支付；1微信；2支付宝)',
                                     `create_time` datetime DEFAULT NULL COMMENT '发起时间',
                                     `pay_time` datetime DEFAULT NULL COMMENT '支付时间',
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='支付订单主表';

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
