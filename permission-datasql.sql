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
/*Data for the table `tb_permission` */

insert  into `tb_permission`(`id`,`pid`,`name`,`memo_cn`,`memo_en`,`memo_hk`,`memo_fr`,`memo_it`,`memo_sp`,`memo_de`,`is_only_superadmin`) values (1,0,'','组织架构',NULL,NULL,NULL,NULL,NULL,NULL,0),(2,0,'','基础数据',NULL,NULL,NULL,NULL,NULL,NULL,0),(3,0,'','商品管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(4,0,'','客户管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(5,0,'','供应链相关',NULL,NULL,NULL,NULL,NULL,NULL,0),(6,0,'','库存管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(7,0,'','销售管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(12,1,'user','员工信息管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(13,1,'group','权限组管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(14,1,'department','部门信息管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(15,2,'brand\n','品牌管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(16,2,'brandgroup','品类管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(17,2,'ageseason','款式年代管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(18,2,'colortemplate','颜色模板管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(19,2,'sizetop','尺码模板管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(20,2,'material','材质管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(21,2,'ulnarinch','商品尺寸管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(22,2,'country','国际地区管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(23,2,'saleport','销售端口管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(24,2,'warehouse','仓库管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(25,5,'order-submit','订单提交',NULL,NULL,NULL,NULL,NULL,NULL,0),(26,5,'order-confirm','订单审核',NULL,NULL,NULL,NULL,NULL,NULL,0),(27,5,'order-finish','订单完结',NULL,NULL,NULL,NULL,NULL,NULL,0),(28,5,'confirmorder-submit','提交发货单',NULL,NULL,NULL,NULL,NULL,NULL,0),(29,5,'confirmorder-confirm','发货单审核',NULL,NULL,NULL,NULL,NULL,NULL,0),(30,5,'warehousing','商品入库',NULL,NULL,NULL,NULL,NULL,NULL,0),(31,6,'requisition','调拨商品',NULL,NULL,NULL,NULL,NULL,NULL,0),(32,7,'sales','提交销售单',NULL,NULL,NULL,NULL,NULL,NULL,0),(33,3,'product','商品管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(34,4,'supplier','客户管理',NULL,NULL,NULL,NULL,NULL,NULL,0);

/*Data for the table `tb_permission_module` */

insert  into `tb_permission_module`(`id`,`permissionid`,`controller`,`action`) values (1,12,'user','add'),(3,12,'user','delete'),(7,12,'user','deletegroup'),(2,12,'user','edit'),(4,12,'warehouseuser','add'),(6,12,'warehouseuser','delete'),(5,12,'warehouseuser','edit'),(12,13,'group','add'),(14,13,'group','delete'),(13,13,'group','edit'),(11,13,'group','setting'),(8,14,'department','add'),(10,14,'department','delete'),(9,14,'department','edit'),(18,15,'aliases','add'),(20,15,'aliases','delete'),(19,15,'aliases','edit'),(15,15,'brand','add'),(17,15,'brand','delete'),(16,15,'brand','edit'),(21,15,'series','add'),(23,15,'series','delete'),(22,15,'series','edit'),(24,16,'brandgroup','add'),(26,16,'brandgroup','delete'),(25,16,'brandgroup','edit'),(27,16,'brandgroupchild','add'),(29,16,'brandgroupchild','delete'),(28,16,'brandgroupchild','edit'),(30,16,'brandgroupchildproperty','add'),(32,16,'brandgroupchildproperty','delete'),(34,16,'brandgroupchildproperty','down'),(31,16,'brandgroupchildproperty','edit'),(33,16,'brandgroupchildproperty','up'),(35,17,'ageseason','add'),(37,17,'ageseason','delete'),(36,17,'ageseason','edit'),(38,18,'colortemplate','add'),(40,18,'colortemplate','delete'),(39,18,'colortemplate','edit'),(44,19,'sizecontent','add'),(46,19,'sizecontent','delete'),(45,19,'sizecontent','edit'),(41,19,'sizetop','add'),(43,19,'sizetop','delete'),(42,19,'sizetop','edit'),(47,20,'material','add'),(49,20,'material','delete'),(48,20,'material','edit'),(50,21,'ulnarinch','add'),(52,21,'ulnarinch','delete'),(51,21,'ulnarinch','edit'),(56,22,'country','add'),(58,22,'country','delete'),(57,22,'country','edit'),(59,23,'saleport','add'),(61,23,'saleport','delete'),(60,23,'saleport','edit'),(53,24,'warehouse','add'),(55,24,'warehouse','delete'),(54,24,'warehouse','edit'),(66,25,'order','delete'),(65,25,'order','saveorder'),(68,26,'order','cancel'),(67,26,'order','confirm'),(69,27,'order','finish'),(71,28,'confirmorder','delete'),(70,28,'confirmorder','saveorder'),(72,28,'confirmorder','search'),(74,29,'confirmorder','cancel'),(73,29,'confirmorder','confirm'),(75,30,'warehousing','create'),(76,30,'warehousing','delete'),(79,31,'requisition','save'),(78,32,'sales','delete'),(77,32,'sales','savesale'),(83,33,'product','add'),(85,33,'product','delete'),(84,33,'product','edit'),(82,33,'product','savecode'),(81,33,'product','savecolorgroup'),(80,33,'product','saveproperty'),(62,34,'supplier','add'),(64,34,'supplier','delete'),(63,34,'supplier','edit');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
