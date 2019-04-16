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
  `code` varchar(50) DEFAULT NULL COMMENT '编码',
  `brandid` int(10) unsigned DEFAULT NULL COMMENT '品牌主键id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COMMENT='别名表';

/*Data for the table `tb_aliases` */

insert  into `tb_aliases`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`code`,`brandid`) values (1,'12K镀金',NULL,NULL,NULL,NULL,NULL,NULL,NULL,207),(2,'2.55',NULL,NULL,NULL,NULL,NULL,NULL,NULL,43),(3,'5050',NULL,NULL,NULL,NULL,NULL,NULL,NULL,204),(4,'BRIKIN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,100),(5,'CLASSIC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,43),(6,'GST',NULL,NULL,NULL,NULL,NULL,NULL,NULL,43),(7,'H扣',NULL,NULL,NULL,NULL,NULL,NULL,NULL,100),(8,'KELLY',NULL,NULL,NULL,NULL,NULL,NULL,NULL,100),(9,'LADY',NULL,NULL,NULL,NULL,NULL,NULL,NULL,63),(10,'LE BOY',NULL,NULL,NULL,NULL,NULL,NULL,NULL,43),(11,'ROMA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,27),(12,'YEEZY',NULL,NULL,NULL,NULL,NULL,NULL,NULL,221),(13,'Z扣',NULL,NULL,NULL,NULL,NULL,NULL,NULL,224),(14,'爱心',NULL,NULL,NULL,NULL,NULL,NULL,NULL,94),(15,'芭比娃娃',NULL,NULL,NULL,NULL,NULL,NULL,NULL,154),(16,'贝壳头',NULL,NULL,NULL,NULL,NULL,NULL,NULL,5),(17,'变形金刚熊',NULL,NULL,NULL,NULL,NULL,NULL,NULL,156),(18,'别针熊',NULL,NULL,NULL,NULL,NULL,NULL,NULL,154),(19,'波点',NULL,NULL,NULL,NULL,NULL,NULL,NULL,119),(20,'彩虹',NULL,NULL,NULL,NULL,NULL,NULL,NULL,212),(21,'彩片',NULL,NULL,NULL,NULL,NULL,NULL,NULL,187),(22,'彩色迷彩',NULL,NULL,NULL,NULL,NULL,NULL,NULL,212),(23,'翅膀',NULL,NULL,NULL,NULL,NULL,NULL,NULL,136),(24,'大匡威',NULL,NULL,NULL,NULL,NULL,NULL,NULL,189),(25,'大匡威 ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,60),(26,'大象',NULL,NULL,NULL,NULL,NULL,NULL,NULL,126),(27,'倒三角',NULL,NULL,NULL,NULL,NULL,NULL,NULL,189),(28,'吊床包',NULL,NULL,NULL,NULL,NULL,NULL,NULL,126),(29,'豆豆',NULL,NULL,NULL,NULL,NULL,NULL,NULL,209),(30,'方扣',NULL,NULL,NULL,NULL,NULL,NULL,NULL,195),(31,'飞鱼',NULL,NULL,NULL,NULL,NULL,NULL,NULL,119),(32,'愤怒的小鸟',NULL,NULL,NULL,NULL,NULL,NULL,NULL,77),(33,'风镜',NULL,NULL,NULL,NULL,NULL,NULL,NULL,190),(34,'狗头',NULL,NULL,NULL,NULL,NULL,NULL,NULL,91),(35,'海绵宝宝',NULL,NULL,NULL,NULL,NULL,NULL,NULL,154),(36,'黑武士',NULL,NULL,NULL,NULL,NULL,NULL,NULL,221),(37,'红唇',NULL,NULL,NULL,NULL,NULL,NULL,NULL,175),(38,'蝴蝶',NULL,NULL,NULL,NULL,NULL,NULL,NULL,212),(39,'蝴蝶结',NULL,NULL,NULL,NULL,NULL,NULL,NULL,197),(40,'虎头',NULL,NULL,NULL,NULL,NULL,NULL,NULL,119),(41,'虎头',NULL,NULL,NULL,NULL,NULL,NULL,NULL,120),(42,'花朵',NULL,NULL,NULL,NULL,NULL,NULL,NULL,66),(43,'花卉',NULL,NULL,NULL,NULL,NULL,NULL,NULL,221),(44,'皇冠',NULL,NULL,NULL,NULL,NULL,NULL,NULL,66),(45,'机车',NULL,NULL,NULL,NULL,NULL,NULL,NULL,23),(46,'经典Y扣',NULL,NULL,NULL,NULL,NULL,NULL,NULL,196),(47,'经典格纹',NULL,NULL,NULL,NULL,NULL,NULL,NULL,32),(48,'经典款',NULL,NULL,NULL,NULL,NULL,NULL,NULL,141),(49,'经典款',NULL,NULL,NULL,NULL,NULL,NULL,NULL,149),(50,'恐龙',NULL,NULL,NULL,NULL,NULL,NULL,NULL,196),(51,'骷髅',NULL,NULL,NULL,NULL,NULL,NULL,NULL,8),(52,'骷髅头',NULL,NULL,NULL,NULL,NULL,NULL,NULL,175),(53,'老佛爷    ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,77),(54,'肋骨',NULL,NULL,NULL,NULL,NULL,NULL,NULL,8),(55,'马鞍包',NULL,NULL,NULL,NULL,NULL,NULL,NULL,147),(56,'马赛克双枪',NULL,NULL,NULL,NULL,NULL,NULL,NULL,192),(57,'麦当劳',NULL,NULL,NULL,NULL,NULL,NULL,NULL,154),(58,'蟒蛇',NULL,NULL,NULL,NULL,NULL,NULL,NULL,136),(59,'铆钉',NULL,NULL,NULL,NULL,NULL,NULL,NULL,8),(60,'铆钉',NULL,NULL,NULL,NULL,NULL,NULL,NULL,175),(61,'铆钉',NULL,NULL,NULL,NULL,NULL,NULL,NULL,48),(62,'铆钉',NULL,NULL,NULL,NULL,NULL,NULL,NULL,212),(63,'美杜莎',NULL,NULL,NULL,NULL,NULL,NULL,NULL,215),(64,'美杜莎',NULL,NULL,NULL,NULL,NULL,NULL,NULL,223),(65,'迷彩',NULL,NULL,NULL,NULL,NULL,NULL,NULL,212),(66,'蜜蜂',NULL,NULL,NULL,NULL,NULL,NULL,NULL,66),(67,'女神靴 ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,60),(68,'秋千',NULL,NULL,NULL,NULL,NULL,NULL,NULL,41),(69,'杀手',NULL,NULL,NULL,NULL,NULL,NULL,NULL,181),(70,'鲨鱼',NULL,NULL,NULL,NULL,NULL,NULL,NULL,158),(71,'鲨鱼',NULL,NULL,NULL,NULL,NULL,NULL,NULL,196),(72,'闪电',NULL,NULL,NULL,NULL,NULL,NULL,NULL,165),(73,'蛇头 ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,35),(74,'圣诞熊',NULL,NULL,NULL,NULL,NULL,NULL,NULL,154),(75,'圣母',NULL,NULL,NULL,NULL,NULL,NULL,NULL,91),(76,'狮子头',NULL,NULL,NULL,NULL,NULL,NULL,NULL,218),(77,'双G',NULL,NULL,NULL,NULL,NULL,NULL,NULL,94),(78,'双LOGO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,35),(79,'双金片',NULL,NULL,NULL,NULL,NULL,NULL,NULL,90),(80,'双马蹄扣',NULL,NULL,NULL,NULL,NULL,NULL,NULL,197),(81,'双枪',NULL,NULL,NULL,NULL,NULL,NULL,NULL,192),(82,'双枪国旗款',NULL,NULL,NULL,NULL,NULL,NULL,NULL,192),(83,'双钻片',NULL,NULL,NULL,NULL,NULL,NULL,NULL,90),(84,'锁头',NULL,NULL,NULL,NULL,NULL,NULL,NULL,34),(85,'太空熊',NULL,NULL,NULL,NULL,NULL,NULL,NULL,154),(86,'桃心',NULL,NULL,NULL,NULL,NULL,NULL,NULL,45),(87,'铁塔',NULL,NULL,NULL,NULL,NULL,NULL,NULL,119),(88,'兔子',NULL,NULL,NULL,NULL,NULL,NULL,NULL,143),(89,'袜子鞋',NULL,NULL,NULL,NULL,NULL,NULL,NULL,23),(90,'王菲款',NULL,NULL,NULL,NULL,NULL,NULL,NULL,149),(91,'巫师帽 ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,60),(92,'吸血鬼',NULL,NULL,NULL,NULL,NULL,NULL,NULL,196),(93,'限量款',NULL,NULL,NULL,NULL,NULL,NULL,NULL,96),(94,'相机包',NULL,NULL,NULL,NULL,NULL,NULL,NULL,135),(95,'小怪兽',NULL,NULL,NULL,NULL,NULL,NULL,NULL,77),(96,'小鹿',NULL,NULL,NULL,NULL,NULL,NULL,NULL,91),(97,'小猫',NULL,NULL,NULL,NULL,NULL,NULL,NULL,44),(98,'小蜜蜂',NULL,NULL,NULL,NULL,NULL,NULL,NULL,94),(99,'小熊',NULL,NULL,NULL,NULL,NULL,NULL,NULL,131),(100,'小熊',NULL,NULL,NULL,NULL,NULL,NULL,NULL,154),(101,'小鸭子',NULL,NULL,NULL,NULL,NULL,NULL,NULL,158),(102,'小猪',NULL,NULL,NULL,NULL,NULL,NULL,NULL,47),(103,'笑脸',NULL,NULL,NULL,NULL,NULL,NULL,NULL,41),(104,'星空',NULL,NULL,NULL,NULL,NULL,NULL,NULL,212),(105,'星星',NULL,NULL,NULL,NULL,NULL,NULL,NULL,196),(106,'星星',NULL,NULL,NULL,NULL,NULL,NULL,NULL,91),(107,'星星',NULL,NULL,NULL,NULL,NULL,NULL,NULL,202),(108,'熊猫',NULL,NULL,NULL,NULL,NULL,NULL,NULL,126),(109,'眼睛',NULL,NULL,NULL,NULL,NULL,NULL,NULL,45),(110,'眼睛',NULL,NULL,NULL,NULL,NULL,NULL,NULL,119),(111,'眼睛',NULL,NULL,NULL,NULL,NULL,NULL,NULL,120),(112,'眼镜蛇',NULL,NULL,NULL,NULL,NULL,NULL,NULL,91),(113,'眼镜熊',NULL,NULL,NULL,NULL,NULL,NULL,NULL,158),(114,'燕子',NULL,NULL,NULL,NULL,NULL,NULL,NULL,143),(115,'燕子包',NULL,NULL,NULL,NULL,NULL,NULL,NULL,178),(116,'椰子',NULL,NULL,NULL,NULL,NULL,NULL,NULL,6),(117,'鹰头',NULL,NULL,NULL,NULL,NULL,NULL,NULL,201),(118,'邮差包',NULL,NULL,NULL,NULL,NULL,NULL,NULL,147),(119,'羽毛',NULL,NULL,NULL,NULL,NULL,NULL,NULL,14),(120,'纸板熊',NULL,NULL,NULL,NULL,NULL,NULL,NULL,156),(121,'中国新年款',NULL,NULL,NULL,NULL,NULL,NULL,NULL,119),(122,'竹节',NULL,NULL,NULL,NULL,NULL,NULL,NULL,94),(123,'自由女神',NULL,NULL,NULL,NULL,NULL,NULL,NULL,165),(124,'嘴唇',NULL,NULL,NULL,NULL,NULL,NULL,NULL,22),(125,'嘴唇',NULL,NULL,NULL,NULL,NULL,NULL,NULL,45);

/*Table structure for table `tb_brand` */

DROP TABLE IF EXISTS `tb_brand`;

CREATE TABLE `tb_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  `countryid` int(10) unsigned DEFAULT NULL,
  `filename` varchar(200) DEFAULT NULL COMMENT 'LOGO',
  `memo` text,
  `officialwebsite` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=utf8mb4 COMMENT='品牌表';

/*Data for the table `tb_brand` */

insert  into `tb_brand`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`countryid`,`filename`,`memo`,`officialwebsite`) values (1,'菲利林','3.1 PHILLIP LIM',NULL,NULL,NULL,NULL,NULL,30,'brand/1.jpg',NULL,''),(2,'阿米迪奥・铁狮东尼','A.TESTONI',NULL,NULL,NULL,NULL,NULL,60,'brand/2.jpg',NULL,'http://www.testoni.com'),(3,'广告杂项','AD POSTER',NULL,NULL,NULL,NULL,NULL,52,'',NULL,''),(4,'阿迪达斯&拉夫西蒙','ADIDAS BY RAF SIMONS',NULL,NULL,NULL,NULL,NULL,15,'',NULL,''),(5,'ADIDAS BY RICK OWENS','ADIDAS BY RICK OWENS',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(6,'椰子','ADIDAS YEEZY',NULL,NULL,NULL,NULL,NULL,13,'',NULL,''),(7,'ALBERTO PREMI','ALBERTO PREMI',NULL,NULL,NULL,NULL,NULL,60,'brand/7.jpg',NULL,'http://www.albertopremi.com/'),(8,'亚历山大-麦昆','ALEXANDER MCQUEEN',NULL,NULL,NULL,NULL,NULL,63,'brand/8.jpg',NULL,'http://www.alexandermcqueen.co.uk/'),(9,'ALEXANDER WANG','ALEXANDER WANG',NULL,NULL,NULL,NULL,NULL,30,'',NULL,''),(10,'','AMBUSH',NULL,NULL,NULL,NULL,NULL,41,'brand/10.jpg',NULL,'http://www.ambushdesign.com/'),(11,'Alexandre Mattiussi','AMI',NULL,NULL,NULL,NULL,NULL,64,'brand/11.jpg',NULL,'https://www.amiparis.com'),(12,'','AMIRI',NULL,NULL,NULL,NULL,NULL,30,'',NULL,''),(13,'安哥杰克森','ANGEL JACKSON',NULL,NULL,NULL,NULL,NULL,60,'brand/13.jpg',NULL,'http://www.angeljackson.com/'),(14,'安娜','ANNA BAIGUERA',NULL,NULL,NULL,NULL,NULL,60,'brand/14.jpg',NULL,'http://www.annabaiguera.com/'),(15,'安特 皮塔格拉','ANTPITAGORA',NULL,NULL,NULL,NULL,NULL,60,'brand/15.jpg',NULL,'http://www.antpitagora.com/'),(16,'阿玛尼黑标','ARMANI COLLEZIONI',NULL,NULL,NULL,NULL,NULL,60,'brand/16.jpg',NULL,'http://www.armani.com/us/armanicollezioni'),(17,'阿玛尼牛仔','ARMANI JEANS',NULL,NULL,NULL,NULL,NULL,60,'brand/17.jpg',NULL,'http://www.armanijeanssale.org/'),(18,'阿玛尼童装','ARMANI JUNIOR',NULL,NULL,NULL,NULL,NULL,60,'brand/18.jpg',NULL,'http://www.armani.com/it/armanijunior'),(19,'','ARMY',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(20,'爱莎尚品','ASA',NULL,NULL,NULL,NULL,NULL,66,'brand/20.jpg',NULL,''),(21,'ATELIERVLISCO','ATELIERVLISCO',NULL,NULL,NULL,NULL,NULL,60,'brand/21.jpg',NULL,'http://www.ateliervlisco.com/'),(22,'AU JOUR LE JOUR','AU JOUR LE JOUR',NULL,NULL,NULL,NULL,NULL,60,'brand/22.jpg',NULL,'http://www.aujourlejour.it'),(23,'巴黎世家','BALENCIAGA',NULL,NULL,NULL,NULL,NULL,15,'brand/23.jpg',NULL,'http://www.balenciaga.com/us'),(24,'巴利','BALLY',NULL,NULL,NULL,NULL,NULL,42,'brand/24.jpg',NULL,'http://www.bally.cn/Index.aspx'),(25,'巴尔曼','BALMAIN',NULL,NULL,NULL,NULL,NULL,15,'',NULL,''),(26,'BOSS 绿标','BOSS GREEN',NULL,NULL,NULL,NULL,NULL,13,'',NULL,''),(27,'宝缇嘉','BOTTEGA VENETA',NULL,NULL,NULL,NULL,NULL,60,'brand/27.jpg',NULL,'http://www.bottegaveneta.com/us/shop'),(28,'','BOUTIQUE MOSCHINO',NULL,NULL,NULL,NULL,NULL,60,'brand/28.jpg',NULL,''),(29,'伦敦男孩','BOY LONDON',NULL,NULL,NULL,NULL,NULL,64,'brand/29.jpg',NULL,'http://boy-london.com/'),(30,'BRIONI','BRIONI',NULL,NULL,NULL,NULL,NULL,60,'brand/30.jpg',NULL,''),(31,'BROOKSFIELD','BROOKSFIELD',NULL,NULL,NULL,NULL,NULL,60,'brand/31.jpg',NULL,''),(32,'博柏利','BURBERRY',NULL,NULL,NULL,NULL,NULL,63,'brand/32.jpg',NULL,'http://us.burberry.com/'),(33,'博柏利童装','BURBERRY KIDS',NULL,NULL,NULL,NULL,NULL,64,'',NULL,''),(34,'BUSCEMI','BUSCEMI',NULL,NULL,NULL,NULL,NULL,30,'brand/34.jpg',NULL,'http://jonbuscemi.com/'),(35,'宝格丽','BVLGARI',NULL,NULL,NULL,NULL,NULL,60,'brand/35.jpg',NULL,'http://zh-cn.bulgari.com'),(36,'','CANADA GOOSE',NULL,NULL,NULL,NULL,NULL,20,'brand/36.jpg',NULL,'http://www.canada-goose.com'),(37,'加拿大鹅童装','CANADA GOOSE KID',NULL,NULL,NULL,NULL,NULL,20,'',NULL,''),(38,'卡雷拉','CARRERA',NULL,NULL,NULL,NULL,NULL,42,'brand/38.jpg',NULL,''),(39,'卡地亚','CARTIER',NULL,NULL,NULL,NULL,NULL,15,'brand/39.jpg',NULL,'http://www.cartier.com/'),(40,'卡纷','CARVEN',NULL,NULL,NULL,NULL,NULL,15,'brand/40.jpg',NULL,''),(41,'赛琳','CELINE',NULL,NULL,NULL,NULL,NULL,15,'brand/41.jpg',NULL,'http://www.celine.com/'),(42,'','CHAMPION',NULL,NULL,NULL,NULL,NULL,30,'brand/42.jpg',NULL,''),(43,'香奈儿','CHANEL',NULL,NULL,NULL,NULL,NULL,15,'brand/43.jpg',NULL,'http://www.chanel.com/en_US/'),(44,'夏洛特·奥林匹亚','CHARLOTTE OLYMPIA',NULL,NULL,NULL,NULL,NULL,63,'brand/44.jpg',NULL,'http://www.charlotteolympia.com/'),(45,'嘉拉·法拉格尼','CHIARA FERRAGNI',NULL,NULL,NULL,NULL,NULL,60,'brand/45.jpg',NULL,'http://www.chiaraferragnicollection.com/en/'),(46,'CHIARA FERRAGNI KID','CHIARA FERRAGNI KID',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(47,'寇依','CHLOE',NULL,NULL,NULL,NULL,NULL,15,'brand/47.jpg',NULL,'http://www.chloe.com/'),(48,'克里斯汀陆伯丁','CHRISTIAN LOUBOUTIN',NULL,NULL,NULL,NULL,NULL,15,'brand/48.jpg',NULL,'http://www.christainlouboutin.com/'),(49,'克里斯托弗·凯恩','CHRISTOPHER KANE',NULL,NULL,NULL,NULL,NULL,63,'brand/49.jpg',NULL,''),(50,'克罗心','CHROME HEARTS',NULL,NULL,NULL,NULL,NULL,30,'',NULL,''),(51,'','CINZIA ARAIA',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(52,'卡尔文·克莱恩','CK',NULL,NULL,NULL,NULL,NULL,30,'brand/52.jpg',NULL,'http://www.ck.com/zh_CN/'),(53,'CLASS CAVALLI','CLASS CAVALLI',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(54,'CNC','CNC',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(55,'寇驰','COACH',NULL,NULL,NULL,NULL,NULL,30,'brand/55.jpg',NULL,'http://www.coach.com/international/'),(56,'','COLIAC',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(57,'川久保玲','COMME DES GARCONS',NULL,NULL,NULL,NULL,NULL,15,'brand/57.jpg',NULL,'http://www.comme-des-garcons.com/'),(58,'','COMMON PROJECTS',NULL,NULL,NULL,NULL,NULL,30,'brand/58.jpg',NULL,''),(59,'DALMINE','DALMINE',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(60,'','DARK SHADOW',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(61,'Decimo Hombre','Decimo Hombre',NULL,NULL,NULL,NULL,NULL,15,'',NULL,''),(62,'','DESIGNINVERSO',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(63,'克里斯汀·迪奥','DIOR',NULL,NULL,NULL,NULL,NULL,15,'brand/63.jpg',NULL,'http://www.dior.com/home/it_it'),(64,'迪奥','DIOR HOMME',NULL,NULL,NULL,NULL,NULL,15,'',NULL,''),(65,'贝肯鲍','DIRK BIKKEMBERGS',NULL,NULL,NULL,NULL,NULL,13,'brand/65.jpg',NULL,'http://www.bikkembergs.com/'),(66,'杜嘉班纳','DOLCE & GABBANA',NULL,NULL,NULL,NULL,NULL,60,'brand/66.jpg',NULL,'http://www.dolcegabbana.com/'),(67,'D二次方','DSQUARED2',NULL,NULL,NULL,NULL,NULL,60,'brand/67.jpg',NULL,'http://www.dsquared2.com/'),(68,'登喜路','DUNHILL',NULL,NULL,NULL,NULL,NULL,63,'brand/68.jpg',NULL,'http://www.dunhill.com/'),(69,'杜维迪卡','DUVETICA',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(70,'EA7','EA7',NULL,NULL,NULL,NULL,NULL,60,'brand/70.jpg',NULL,'http://www.armani.cn/gb/ea7'),(71,'爱步','ECCO',NULL,NULL,NULL,NULL,NULL,2,'brand/71.jpg',NULL,'http://us.shop.ecco.com/'),(72,'ECO','ECO',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(73,'ELISABETTA FRANCHI','ELISABETTA FRANCHI',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(74,'安普里奥·阿玛尼','EMPORIO ARMANI',NULL,NULL,NULL,NULL,NULL,60,'brand/74.jpg',NULL,'http://www.armani.com/us/emporioarmani'),(75,'恩普里奥.杰尼亚','ERMENEGILDO ZEGNA',NULL,NULL,NULL,NULL,NULL,60,'brand/75.jpg',NULL,'http://www.zegna.com/ca/home.html'),(76,'ETRO','ETRO',NULL,NULL,NULL,NULL,NULL,60,'brand/76.jpg',NULL,'https://www.etro.com/zh_cn/'),(77,'芬迪','FENDI',NULL,NULL,NULL,NULL,NULL,60,'brand/77.jpg',NULL,'http://www.fendi.com/ii/en'),(78,'芬迪童装','FENDI KIDS',NULL,NULL,NULL,NULL,NULL,60,'',NULL,'http://www.fendi.com/ii/en'),(79,'FERRARI','FERRARI',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(80,'FESTA','FESTA',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(81,'FORTE COUTURE','FORTE COUTURE',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(82,'弗兰基 莫雷诺','FRANKIE MORELLO',NULL,NULL,NULL,NULL,NULL,60,'brand/82.jpg',NULL,'http://www.frankiemorello.it/'),(83,'芙拉','FURLA',NULL,NULL,NULL,NULL,NULL,60,'brand/83.jpg',NULL,''),(84,'GARDEUR-G DESIGN','GARDEUR-G DESIGN',NULL,NULL,NULL,NULL,NULL,13,'',NULL,''),(85,'','GCDS',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(86,'','GEDEBE',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(87,'','GIAB\'S',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(88,'GIACOMORELLI','GIACOMORELLI',NULL,NULL,NULL,NULL,NULL,60,'brand/88.jpg',NULL,'http://www.giacomorelli.com/'),(89,'乔治·阿玛尼','GIORGIO ARMANI',NULL,NULL,NULL,NULL,NULL,60,'brand/89.jpg',NULL,'http://www.giorgioarmanibeauty-usa.com/'),(90,'朱塞佩·萨诺第','GIUSEPPE ZANOTTI',NULL,NULL,NULL,NULL,NULL,60,'brand/90.jpg',NULL,'http://www.giuseppezanottidesign.com'),(91,'纪梵希','GIVENCHY',NULL,NULL,NULL,NULL,NULL,15,'brand/91.jpg',NULL,'http://www.givenchy.com/cn/'),(92,'黄金鹅','GOLDEN GOOSE',NULL,NULL,NULL,NULL,NULL,60,'brand/92.jpg',NULL,''),(93,'灰蚂蚁','GREY ANT',NULL,NULL,NULL,NULL,NULL,30,'brand/93.jpg',NULL,'http://shop.greyant.com/'),(94,'古琦','GUCCI',NULL,NULL,NULL,NULL,NULL,60,'brand/94.jpg',NULL,'http://www.gucci.com/cn/home?utm_source=baidu_cn&utm_medium=Brandzone&utm_term=headline&utm_campaign=officialwebsite'),(95,'盖尔斯','GUESS',NULL,NULL,NULL,NULL,NULL,30,'',NULL,''),(96,'贵迪','GUIDI',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(97,'HACKETT','HACKETT',NULL,NULL,NULL,NULL,NULL,40,'',NULL,''),(98,'HACULLA','HACULLA',NULL,NULL,NULL,NULL,NULL,30,'brand/98.jpg',NULL,'http://www.haculla.com/'),(99,'海尔姆特·朗','HELMUT LANG',NULL,NULL,NULL,NULL,NULL,30,'brand/99.jpg',NULL,''),(100,'爱马仕','HERMES',NULL,NULL,NULL,NULL,NULL,15,'brand/100.jpg',NULL,'http://www.hermes.com/index_default.html'),(101,'HOGAN','HOGAN',NULL,NULL,NULL,NULL,NULL,60,'brand/101.jpg',NULL,'https://www.hogan.cn/cn-zh/home.html'),(102,'HOLDEM','HOLDEM',NULL,NULL,NULL,NULL,NULL,49,'',NULL,''),(103,'HBA','HOOD BY AIR',NULL,NULL,NULL,NULL,NULL,30,'',NULL,''),(104,'','HOW AND WHAT',NULL,NULL,NULL,NULL,NULL,19,'',NULL,''),(105,'胡戈-波士','HUGO BOSS',NULL,NULL,NULL,NULL,NULL,13,'brand/105.jpg',NULL,'http://store-us.hugoboss.com/'),(106,'ICE','ICE',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(107,'ICEBERG','ICEBERG',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(108,'IH NOM UH NIT','IH NOM UH NIT',NULL,NULL,NULL,NULL,NULL,15,'brand/108.jpg',NULL,'http://www.ihnomuhnit.co/en'),(109,'J BRAND','J BRAND',NULL,NULL,NULL,NULL,NULL,30,'brand/109.jpg',NULL,''),(110,'JIL SANDER','JIL SANDER',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(111,'周仰杰','JIMMY CHOO',NULL,NULL,NULL,NULL,NULL,63,'brand/111.jpg',NULL,'http://row.jimmychoo.com/on/demandware.store/Sites-jchrow-Site/en/Default-Start?geoip=geoip'),(112,'JOHN SMEDLEY','JOHN SMEDLEY',NULL,NULL,NULL,NULL,NULL,63,'',NULL,''),(113,'JOSHUA SANDERS','JOSHUA SANDERS',NULL,NULL,NULL,NULL,NULL,60,'brand/113.jpg',NULL,'http://www.joshua-sanders.com'),(114,'JUICY','JUICY',NULL,NULL,NULL,NULL,NULL,30,'',NULL,''),(115,'卡沃利','JUST CAVALLI',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(116,'','JUUNJ',NULL,NULL,NULL,NULL,NULL,19,'brand/116.jpg',NULL,''),(117,'卡尔 拉格斐','KARL LAGERFELD',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(118,'KATE SPADE','KATE SPADE',NULL,NULL,NULL,NULL,NULL,30,'',NULL,''),(119,'高田贤三','KENZO',NULL,NULL,NULL,NULL,NULL,15,'brand/119.jpg',NULL,'https://www.kenzo.com/'),(120,'高田贤三童装','KENZO BABY',NULL,NULL,NULL,NULL,NULL,15,'brand/120.jpg',NULL,'https://www.kenzo.com/'),(121,'考拉比','KOALABI',NULL,NULL,NULL,NULL,NULL,66,'brand/121.jpg',NULL,''),(122,'','KTZ',NULL,NULL,NULL,NULL,NULL,64,'',NULL,''),(123,'兰姿','LANCEL',NULL,NULL,NULL,NULL,NULL,15,'brand/123.jpg',NULL,'http://www.lancel.com/'),(124,'浪凡','LANVIN',NULL,NULL,NULL,NULL,NULL,15,'brand/124.jpg',NULL,'http://www.lanvin.com/'),(125,'琳达·法罗','LINDA FARROW',NULL,NULL,NULL,NULL,NULL,63,'brand/125.jpg',NULL,'http://www.lindafarrowvintage.com/'),(126,'罗意威','LOEWE',NULL,NULL,NULL,NULL,NULL,54,'brand/126.jpg',NULL,'http://www.loewe.com/'),(127,'珑骧','LONG CHAMP',NULL,NULL,NULL,NULL,NULL,15,'brand/127.jpg',NULL,'http://www.longchamp.com/'),(128,'LONG CLOTHING','LONG CLOTHING',NULL,NULL,NULL,NULL,NULL,64,'brand/128.jpg',NULL,'http://www.longclothing.com'),(129,'路易里曼','LOUIS LEEMAN',NULL,NULL,NULL,NULL,NULL,60,'brand/129.jpg',NULL,''),(130,'路易-威登','LOUIS VUITTON',NULL,NULL,NULL,NULL,NULL,15,'brand/130.jpg',NULL,'http://fr.louisvuitton.com/fra-fr/homepage'),(131,'最爱马斯奇诺','LOVE MOSCHINO',NULL,NULL,NULL,NULL,NULL,60,'brand/131.jpg',NULL,'http://www.moschino.com/it'),(132,'','MAJE',NULL,NULL,NULL,NULL,NULL,15,'',NULL,''),(133,'马诺洛','MANOLO BLAHNIK',NULL,NULL,NULL,NULL,NULL,15,'brand/133.jpg',NULL,'www.manoloblahnik.com'),(134,'马克.马克-雅各布','MARC BY MARC JACOBS',NULL,NULL,NULL,NULL,NULL,30,'brand/134.jpg',NULL,''),(135,'马克-雅各布','MARC JACOBS',NULL,NULL,NULL,NULL,NULL,30,'brand/135.jpg',NULL,'http://www.marcjacobs.com/'),(136,'马克布隆','MARCELO BURLON',NULL,NULL,NULL,NULL,NULL,60,'brand/136.jpg',NULL,'http://www.marceloburlonblog.com/'),(137,'MARCELO BURLON KID','MARCELO BURLON KID',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(138,'','MARNI',NULL,NULL,NULL,NULL,NULL,60,'brand/138.jpg',NULL,''),(139,'马丁·马吉拉','MARTIN MARGIELA',NULL,NULL,NULL,NULL,NULL,15,'',NULL,''),(140,'马图','MATUA',NULL,NULL,NULL,NULL,NULL,60,'brand/140.jpg',NULL,''),(141,'麦丝玛拉','MAXMARA',NULL,NULL,NULL,NULL,NULL,60,'brand/141.jpg',NULL,'cn.maxmara.com'),(142,'MCM','MCM',NULL,NULL,NULL,NULL,NULL,13,'brand/142.jpg',NULL,'http://www.mcmworldwide.com/'),(143,'麦昆','MCQ',NULL,NULL,NULL,NULL,NULL,63,'brand/143.jpg',NULL,'http://www.alexandermcqueen.com/us/mcq/'),(144,'MELIS YILDIZ','MELIS YILDIZ',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(145,'梅丽莎','MELISSA',NULL,NULL,NULL,NULL,NULL,60,'brand/145.jpg',NULL,''),(146,'MENBUR','MENBUR',NULL,NULL,NULL,NULL,NULL,54,'',NULL,''),(147,'迈克-柯尔','MICHAEL KORS',NULL,NULL,NULL,NULL,NULL,30,'brand/147.jpg',NULL,'http://www.michaelkors.cn/'),(148,'缪缪','MIU MIU',NULL,NULL,NULL,NULL,NULL,60,'brand/148.jpg',NULL,'http://www.miumiu.com/hans?cc=CN'),(149,'盟可睐','MONCLER',NULL,NULL,NULL,NULL,NULL,15,'brand/149.jpg',NULL,'http://eng.moncler.com/'),(150,'盟可睞童装','MONCLER KID',NULL,NULL,NULL,NULL,NULL,15,'',NULL,''),(151,'MONCLER X OFF WHITE','MONCLER X OFF WHITE',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(152,'万宝龙','MONT BLANC',NULL,NULL,NULL,NULL,NULL,13,'brand/152.jpg',NULL,'http://www.montblanc.com/en-us/shop/watches.aspx'),(153,'','MOOSE KNUCKLES',NULL,NULL,NULL,NULL,NULL,20,'',NULL,''),(154,'莫斯奇诺','MOSCHINO',NULL,NULL,NULL,NULL,NULL,60,'brand/154.jpg',NULL,'https://secure.moschino.com/chooseyourcountry.asp'),(155,'MOSCHINO CHEAP&CHIC','MOSCHINO CHEAP&CHIC',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(156,'','MOSCHINO COUTURE',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(157,'','MOSCHINO KID',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(158,'莫斯奇诺 泳装','MOSCHINO SWIM',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(159,'','MR&MRS ITALY',NULL,NULL,NULL,NULL,NULL,60,'brand/159.jpg',NULL,''),(160,'MSGM','MSGM',NULL,NULL,NULL,NULL,NULL,60,'brand/160.jpg',NULL,'http://msgm.it/'),(161,'MSGM童装','MSGM KID',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(162,'MULBERRY','MULBERRY',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(163,'21号','N°21',NULL,NULL,NULL,NULL,NULL,60,'brand/163.jpg',NULL,'http://www.numeroventuno.com/'),(164,'nana-nana','NANA-NANA',NULL,NULL,NULL,NULL,NULL,41,'brand/164.jpg',NULL,'https://midtownproject.co.jp/'),(165,'尼奥·贝奈特','NEIL BARRETT',NULL,NULL,NULL,NULL,NULL,60,'brand/165.jpg',NULL,'http://www.neilbarrett.com/'),(166,'','NUNUNU',NULL,NULL,NULL,NULL,NULL,60,'brand/166.jpg',NULL,''),(167,'奥克利','OAKLEY',NULL,NULL,NULL,NULL,NULL,60,'brand/167.jpg',NULL,'http://uk.oakley.com/'),(168,'纯白色','OFF WHITE',NULL,NULL,NULL,NULL,NULL,30,'brand/168.jpg',NULL,'http://www.off---white.com/'),(169,'OPENING CEREMONY','OPENING CEREMONY',NULL,NULL,NULL,NULL,NULL,30,'brand/169.jpg',NULL,''),(170,'葩莎帝','PASOTTI',NULL,NULL,NULL,NULL,NULL,60,'brand/170.jpg',NULL,'http://www.pasotti.com/'),(171,'保罗-史密斯','PAUL SMITH',NULL,NULL,NULL,NULL,NULL,63,'brand/171.jpg',NULL,'http://www.paulsmith.co.uk/'),(172,'保罗史密斯童装','PAUL SMITH JUNIOR',NULL,NULL,NULL,NULL,NULL,63,'',NULL,''),(173,'宝鲨','PAUL&SHARK',NULL,NULL,NULL,NULL,NULL,60,'brand/173.jpg',NULL,'http://www.paulshark.it/'),(174,'宝拉·凯蒂马托瑞','PAULA CADEMARTORI',NULL,NULL,NULL,NULL,NULL,60,'brand/174.jpg',NULL,'http://www.paulacademartori.com'),(175,'菲利普','PHILIPP PLEIN',NULL,NULL,NULL,NULL,NULL,13,'brand/175.jpg',NULL,'http://www.philipp-plein.com'),(176,'PICCIONE','PICCIONE.PICCIONE',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(177,'皮埃尔·巴尔曼','PIERRE BALMAIN',NULL,NULL,NULL,NULL,NULL,15,'brand/177.jpg',NULL,''),(178,'PINKO','PINKO',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(179,'PLEIN SPORT','PLEIN SPORT',NULL,NULL,NULL,NULL,NULL,60,'brand/179.jpg',NULL,'http://pleinsport.com'),(180,'宝丽来','POLAROID',NULL,NULL,NULL,NULL,NULL,60,'brand/180.jpg',NULL,'http://polaroideyewear.com'),(181,'普拉达','PRADA',NULL,NULL,NULL,NULL,NULL,60,'brand/181.jpg',NULL,'http://www.prada.com/hans?cc=CN'),(182,'贝缇巴拉纳斯','PRETTY BALLERINAS',NULL,NULL,NULL,NULL,NULL,54,'brand/182.jpg',NULL,'http://www.prettyballerinas.com/'),(183,'PROENZA SCHOULER','PROENZA SCHOULER',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(184,'代金卡','QT其他使用',NULL,NULL,NULL,NULL,NULL,15,'',NULL,''),(185,'R13','R13',NULL,NULL,NULL,NULL,NULL,30,'brand/185.jpg',NULL,'https://www.r13denim.com/'),(186,'拉尔夫-劳伦','RALPH LAUREN',NULL,NULL,NULL,NULL,NULL,30,'brand/186.jpg',NULL,'http://www.ralphlauren.com/frontdoor/index.jsp'),(187,'雷朋','RAY-BAN',NULL,NULL,NULL,NULL,NULL,60,'brand/187.jpg',NULL,'http://china.ray-ban.com/zh/'),(188,'华伦天奴','RED VALENTINO',NULL,NULL,NULL,NULL,NULL,60,'brand/188.jpg',NULL,'http://www.redvalentino.com/'),(189,'瑞克·欧文斯','RICK OWENS',NULL,NULL,NULL,NULL,NULL,30,'brand/189.jpg',NULL,'http://www.rickowens.eu/en/'),(190,'暴风骑士','RIDERS ON THE STORM',NULL,NULL,NULL,NULL,NULL,60,'brand/190.jpg',NULL,''),(191,'风暴骑士儿童','RIDERS ON THE STORM KIDS',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(192,'双枪','ROAR',NULL,NULL,NULL,NULL,NULL,41,'brand/192.jpg',NULL,''),(193,'罗伯特·卡沃利','ROBERTO CAVALLI',NULL,NULL,NULL,NULL,NULL,60,'brand/193.jpg',NULL,''),(194,'罗恩','ROEN',NULL,NULL,NULL,NULL,NULL,41,'brand/194.jpg',NULL,'http://www.roen.jp/'),(195,'罗杰·维威耶','ROGER VIVIER',NULL,NULL,NULL,NULL,NULL,15,'brand/195.jpg',NULL,'http://www.rogervivier.com/'),(196,'伊夫圣罗兰','SAINT LAURENT PARIS',NULL,NULL,NULL,NULL,NULL,15,'brand/196.jpg',NULL,'http://www.ysl.com/us'),(197,'菲拉格慕','SALVATORE FERRAGAMO',NULL,NULL,NULL,NULL,NULL,60,'brand/197.jpg',NULL,'http://www.ferragamo.com/'),(198,'克洛伊','SEE BY CHLOE\'',NULL,NULL,NULL,NULL,NULL,15,'brand/198.jpg',NULL,'http://www.chloe.com/#/collections/see-by-chloe/chs'),(199,'SERGIO ROSSI','SERGIO ROSSI',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(200,'SIVIGLIA','SIVIGLIA',NULL,NULL,NULL,NULL,NULL,13,'',NULL,''),(201,'史提芬劳 尼治','STEFANO RICCI',NULL,NULL,NULL,NULL,NULL,60,'brand/201.jpg',NULL,'http://www.stefanoricci.com/'),(202,'斯特拉-麦卡托尼','STELLA MCCARTNEY',NULL,NULL,NULL,NULL,NULL,30,'brand/202.jpg',NULL,'www.stellamccartney.cn'),(203,'斯特拉.麦特卡尼童装','STELLA MCCARTNEY KID',NULL,NULL,NULL,NULL,NULL,30,'',NULL,''),(204,'斯图尔特·韦茨曼','STUART WEITZMAN',NULL,NULL,NULL,NULL,NULL,30,'brand/204.jpg',NULL,''),(205,'施华洛世奇','SWAROVSKI',NULL,NULL,NULL,NULL,NULL,42,'brand/205.jpg',NULL,'http://www.swarovski.com/Web_US/en/index'),(206,'','THIS IS NOT CLOTHING',NULL,NULL,NULL,NULL,NULL,15,'brand/206.jpg',NULL,'http://www.thisisnotclothing.com'),(207,'汤姆·布郎','THOM BROWNE',NULL,NULL,NULL,NULL,NULL,30,'',NULL,''),(208,'蒂凡尼','TIFFANY&CO',NULL,NULL,NULL,NULL,NULL,30,'brand/208.jpg',NULL,'http://www.tiffany.cn/'),(209,'托德斯','TOD\'S',NULL,NULL,NULL,NULL,NULL,60,'brand/209.jpg',NULL,'http://www.tods.com/'),(210,'汤丽柏琦','TORY BURCH',NULL,NULL,NULL,NULL,NULL,30,'brand/210.jpg',NULL,'http://www.toryburch.com/'),(211,'URSULA MASCARO','URSULA MASCARO',NULL,NULL,NULL,NULL,NULL,54,'brand/211.jpg',NULL,'http://www.ursulamascaro.com/'),(212,'华伦天奴','VALENTINO',NULL,NULL,NULL,NULL,NULL,60,'brand/212.jpg',NULL,'http://www.valentino.com/'),(213,'梵克雅宝','VAN CLEEF & ARPELS',NULL,NULL,NULL,NULL,NULL,15,'brand/213.jpg',NULL,'http://www.vancleefarpels.com/cn/zh/?from_unlocalized=1'),(214,'','VASA',NULL,NULL,NULL,NULL,NULL,60,'',NULL,''),(215,'范思哲','VERSACE',NULL,NULL,NULL,NULL,NULL,60,'brand/215.jpg',NULL,'http://www.versace.com/'),(216,'范思哲','VERSACE COLLECTION',NULL,NULL,NULL,NULL,NULL,60,'brand/216.jpg',NULL,'http://www.versacecollection.com/'),(217,'范思哲牛仔','VERSACE JEANS',NULL,NULL,NULL,NULL,NULL,60,'brand/217.jpg',NULL,'http://www.versace-jeans.com/'),(218,'范瑟丝','VERSUS',NULL,NULL,NULL,NULL,NULL,60,'brand/218.jpg',NULL,'http://www.versus.it/'),(219,'维维安-韦斯特伍德','VIVIENNE WESTWOOD',NULL,NULL,NULL,NULL,NULL,63,'brand/219.jpg',NULL,'http://www.viviennewestwood.com/'),(220,'艾格','WEEKEND',NULL,NULL,NULL,NULL,NULL,15,'brand/220.jpg',NULL,''),(221,'Y-3','Y-3',NULL,NULL,NULL,NULL,NULL,13,'brand/221.jpg',NULL,'http://www.y-3.com'),(222,'杜旸','YANG DU',NULL,NULL,NULL,NULL,NULL,63,'brand/222.jpg',NULL,'WWW.YANGDU-DUYANG.COM'),(223,'范思哲童装','YOUNG VERSACE',NULL,NULL,NULL,NULL,NULL,60,'brand/223.jpg',NULL,''),(224,'Z杰尼亚','Z ZEGNA',NULL,NULL,NULL,NULL,NULL,60,'brand/224.jpg',NULL,'http://www.zegna.com/cn/z-zegna.html'),(225,'杰尼亚运动','ZEGNA SPORT',NULL,NULL,NULL,NULL,NULL,60,'brand/225.jpg',NULL,'http://www.zegna.com/cn/zegna-sport.html');

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
  `brandgroupid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brandgroupid` (`brandgroupid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COMMENT='子品类';

/*Data for the table `tb_brandgroupchild` */

insert  into `tb_brandgroupchild`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`brandgroupid`) values (2,'上衣','','',NULL,NULL,NULL,NULL,1),(4,'夹克','','',NULL,NULL,NULL,NULL,1),(5,'运动服','','',NULL,NULL,NULL,NULL,1),(6,'网球鞋','','',NULL,NULL,NULL,NULL,3),(7,'足球鞋','','',NULL,NULL,NULL,NULL,3),(8,'篮球鞋','','',NULL,NULL,NULL,NULL,3),(9,'跑步鞋','','',NULL,NULL,NULL,NULL,3),(10,'项链','','',NULL,NULL,NULL,NULL,4),(11,'戒指','','',NULL,NULL,NULL,NULL,4),(12,'背包','','',NULL,NULL,NULL,NULL,2),(13,'手提包','','',NULL,NULL,NULL,NULL,2),(14,'电脑包','','',NULL,NULL,NULL,NULL,2),(15,'长袖T恤衫','','',NULL,NULL,NULL,NULL,5),(16,'斜挎包','','',NULL,NULL,NULL,NULL,2),(17,'手提包','','',NULL,NULL,NULL,NULL,2),(18,'太阳镜','','',NULL,NULL,NULL,NULL,6),(19,'腰带','','',NULL,NULL,NULL,NULL,7);

/*Table structure for table `tb_brandgroupchild_property` */

DROP TABLE IF EXISTS `tb_brandgroupchild_property`;

CREATE TABLE `tb_brandgroupchild_property` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name_cn` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '德语名称',
  `brandgroupchildid` int(11) DEFAULT NULL COMMENT '所属id',
  `displayindex` int(11) DEFAULT NULL COMMENT '显示顺序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='自定义属性';

/*Data for the table `tb_brandgroupchild_property` */

insert  into `tb_brandgroupchild_property`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`brandgroupchildid`,`displayindex`) values (1,'腰围','','',NULL,NULL,NULL,NULL,2,3),(3,'衣长','','',NULL,NULL,NULL,NULL,2,1),(6,'宽度','','',NULL,NULL,NULL,NULL,12,2),(7,'高度','','',NULL,NULL,NULL,NULL,12,3),(8,'厚度','','',NULL,NULL,NULL,NULL,12,1),(10,'胸围','','',NULL,NULL,NULL,NULL,2,5),(11,'袖长','','',NULL,NULL,NULL,NULL,2,4),(12,'袖长','','',NULL,'',NULL,NULL,15,1),(13,'衣长','','',NULL,'',NULL,NULL,15,2),(14,'胸围','','',NULL,'',NULL,NULL,15,3),(15,'腰围','','',NULL,'',NULL,NULL,15,4),(16,'高度','','',NULL,'',NULL,NULL,6,2),(17,'长度','','',NULL,'',NULL,NULL,6,1);

/*Table structure for table `tb_buycar` */

DROP TABLE IF EXISTS `tb_buycar`;

CREATE TABLE `tb_buycar` (
  `id` int(10) NOT NULL,
  `product_id` int(10) unsigned NOT NULL COMMENT '商品id',
  `product_name` varchar(255) NOT NULL COMMENT '商品名称',
  `color_id` int(10) unsigned NOT NULL COMMENT '颜色id',
  `color_name` int(11) NOT NULL COMMENT '颜色名称',
  `size_id` int(11) NOT NULL COMMENT '规格id',
  `size_name` int(11) NOT NULL COMMENT '规格名称',
  `member_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `number` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '数量',
  `price` decimal(9,2) NOT NULL COMMENT '价格',
  `total_price` decimal(9,2) NOT NULL COMMENT '总价格'
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
  `code` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='asa颜色模板';

/*Data for the table `tb_colortemplate` */

insert  into `tb_colortemplate`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`picture`,`code`) values (1,'红色','','',NULL,NULL,NULL,NULL,'colortemplate/bde9713e9d89260fb001ef2723b53331.jpg','red'),(2,'黑色','','黑色',NULL,NULL,NULL,NULL,'colortemplate/fa9e7e53209f9a7daf6e381a6ee9b00b.jpg','black'),(3,'蓝色','','',NULL,NULL,NULL,NULL,'','blue'),(4,'白色','','',NULL,NULL,NULL,NULL,'','white'),(5,'绿色','','',NULL,NULL,NULL,NULL,'','green'),(6,'黄色','','',NULL,NULL,NULL,NULL,'','yellow');

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
  `randid` int(11) DEFAULT NULL,
  `saleportid` int(11) unsigned DEFAULT NULL COMMENT '商城的销售端口',
  PRIMARY KEY (`id`),
  UNIQUE KEY `randid` (`randid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_company` */

insert  into `tb_company`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`countryid`,`memo`,`randid`,`saleportid`) values (1,'company1552557078',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1);

/*Table structure for table `tb_companyhost` */

DROP TABLE IF EXISTS `tb_companyhost`;

CREATE TABLE `tb_companyhost` (
  `id` int(10) unsigned NOT NULL COMMENT '主键id',
  `url` varchar(100) DEFAULT NULL COMMENT '网址',
  `companyid` int(10) unsigned NOT NULL COMMENT '公司id',
  `is_default` tinyint(1) DEFAULT '0' COMMENT '是否为默认：0-非默认 1-默认'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='公司商铺域名表';

/*Data for the table `tb_companyhost` */

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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COMMENT='国家表';

/*Data for the table `tb_country` */

insert  into `tb_country`(`id`,`code`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`localcurrency`) values (1,'ALB','阿尔巴尼亚','ALBANIA',NULL,NULL,NULL,NULL,NULL,NULL),(2,'EGY','埃及','EGYPT',NULL,NULL,NULL,NULL,NULL,NULL),(3,'IRL','爱尔兰','IRELAND',NULL,NULL,NULL,NULL,NULL,NULL),(4,'AUT','奥地利','AUSTRIA',NULL,NULL,NULL,NULL,NULL,NULL),(5,'AUS','澳大利亚','AUSTRALIA',NULL,NULL,NULL,NULL,NULL,NULL),(6,'BRZ','巴西','BRAZIL',NULL,NULL,NULL,NULL,NULL,NULL),(7,'BEL','白俄罗斯','BELARUS',NULL,NULL,NULL,NULL,NULL,NULL),(8,'BUL','保加利亚','BULGARIA',NULL,NULL,NULL,NULL,NULL,NULL),(9,'BEL','比利时','BELGIAN',NULL,NULL,NULL,NULL,NULL,NULL),(10,'BIH','波黑','BOSNIA AND HERZEGOVINA',NULL,NULL,NULL,NULL,NULL,NULL),(11,'POL','波兰','POLAND',NULL,NULL,NULL,NULL,NULL,NULL),(12,'波斯尼亚','波斯尼亚','BOSNIA',NULL,NULL,NULL,NULL,NULL,NULL),(13,'DEU','德国','GERMANY',NULL,NULL,NULL,NULL,NULL,NULL),(14,'ECU','厄瓜多尔','ECUADOR',NULL,NULL,NULL,NULL,NULL,NULL),(15,'FRE','法国','FRANCE',NULL,NULL,NULL,NULL,NULL,NULL),(16,'EXUE','非欧盟','EXTRA UE',NULL,NULL,NULL,NULL,NULL,NULL),(17,'PHI','菲律宾','PHILIPPINES',NULL,NULL,NULL,NULL,NULL,NULL),(18,'GEO','格鲁吉亚','GEORGIA',NULL,NULL,NULL,NULL,NULL,NULL),(19,'KRE','韩国','KOREA',NULL,NULL,NULL,NULL,NULL,NULL),(20,'CAN','加拿大','CANADA',NULL,NULL,NULL,NULL,NULL,NULL),(21,'CAM','柬埔寨','CAMBODIA',NULL,NULL,NULL,NULL,NULL,NULL),(22,'CRO','克罗地亚','CROATIA',NULL,NULL,NULL,NULL,NULL,NULL),(23,'LAO','老挝','LAOS',NULL,NULL,NULL,NULL,NULL,NULL),(24,'LTU','立陶宛','LITHUANIA',NULL,NULL,NULL,NULL,NULL,NULL),(25,'ROM','罗马尼亚','ROMANIA',NULL,NULL,NULL,NULL,NULL,NULL),(26,'MAD','马达加斯加','MADAGASCAR',NULL,NULL,NULL,NULL,NULL,NULL),(27,'MAL','马来西亚','MALAYSIA',NULL,NULL,NULL,NULL,NULL,NULL),(28,'MAC','马其顿','MACEDONIA',NULL,NULL,NULL,NULL,NULL,NULL),(29,'MAU','毛里求斯','MAURITIUS',NULL,NULL,NULL,NULL,NULL,NULL),(30,'USA','美国','U.S.A.',NULL,NULL,NULL,NULL,NULL,NULL),(31,'BGD','孟加拉','BANGLADESH',NULL,NULL,NULL,NULL,NULL,NULL),(32,'PER','秘鲁','PERU',NULL,NULL,NULL,NULL,NULL,NULL),(33,'MMR','缅甸','MYANMAR(BURMA)',NULL,NULL,NULL,NULL,NULL,NULL),(34,'MOD','摩尔达维亚','MOLDAVIA',NULL,NULL,NULL,NULL,NULL,NULL),(35,'MOL','摩尔多瓦','MOLDOVA',NULL,NULL,NULL,NULL,NULL,NULL),(36,'MAR','摩洛哥','MOROCCO',NULL,NULL,NULL,NULL,NULL,NULL),(37,'MEX','墨西哥','MEXICAN',NULL,NULL,NULL,NULL,NULL,NULL),(38,'NGA','尼日利亚','NIGERIA',NULL,NULL,NULL,NULL,NULL,NULL),(39,'EUR','欧盟','EURO',NULL,NULL,NULL,NULL,NULL,NULL),(40,'PRT','葡萄牙','PORTUGAL',NULL,NULL,NULL,NULL,NULL,NULL),(41,'JPN','日本','JAPAN',NULL,NULL,NULL,NULL,NULL,NULL),(42,'CHE','瑞士','SWITZERLAND',NULL,NULL,NULL,NULL,NULL,NULL),(43,'RU','塞尔维亚','SERBIA',NULL,NULL,NULL,NULL,NULL,NULL),(44,'SLA','斯里兰卡','SRI LANKA',NULL,NULL,NULL,NULL,NULL,NULL),(45,'SLK','斯洛伐克','SLOVAKIA',NULL,NULL,NULL,NULL,NULL,NULL),(46,'SLO','斯洛文尼亚','SLOVENIA',NULL,NULL,NULL,NULL,NULL,NULL),(47,'SCO','苏格兰','SCOTLAND',NULL,NULL,NULL,NULL,NULL,NULL),(48,'TWN','台湾','TAIWAN',NULL,NULL,NULL,NULL,NULL,NULL),(49,'THA','泰国','THAILAND',NULL,NULL,NULL,NULL,NULL,NULL),(50,'TUN','突尼斯','TUNIS',NULL,NULL,NULL,NULL,NULL,NULL),(51,'TUR','土耳其','TURKRY',NULL,NULL,NULL,NULL,NULL,NULL),(52,'XXX未知','未知AAA','WEIZHI',NULL,NULL,NULL,NULL,NULL,NULL),(53,'UKA','乌克兰','UKRAINE',NULL,NULL,NULL,NULL,NULL,NULL),(54,'ESP','西班牙','SPAIN',NULL,NULL,NULL,NULL,NULL,NULL),(55,'GRE','希腊','GREECE',NULL,NULL,NULL,NULL,NULL,NULL),(56,'HKG','香港','HONG KONG',NULL,NULL,NULL,NULL,NULL,NULL),(57,'HUN','匈牙利','HUNGARY',NULL,NULL,NULL,NULL,NULL,NULL),(58,'ARM','亚美尼亚','ARMENIA',NULL,NULL,NULL,NULL,NULL,NULL),(59,'ILS','以色列','STATE OF ISRAEL',NULL,NULL,NULL,NULL,NULL,NULL),(60,'ITA','意大利','ITALY',NULL,NULL,NULL,NULL,NULL,NULL),(61,'IND','印度','INDIA',NULL,NULL,NULL,NULL,NULL,NULL),(62,'INA','印度尼西亚','INDONESIA',NULL,NULL,NULL,NULL,NULL,NULL),(63,'GBR','英国','ENGLAND',NULL,NULL,NULL,NULL,NULL,NULL),(64,'UKI','英国','THE UNITED KINGDOM',NULL,NULL,NULL,NULL,NULL,NULL),(65,'VIT','越南','VIETNAM',NULL,NULL,NULL,NULL,NULL,NULL),(66,'CHN','中国','CHINA',NULL,NULL,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=270 DEFAULT CHARSET=utf8mb4 COMMENT='材质';

/*Data for the table `tb_material` */

insert  into `tb_material`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`code`) values (1,'绒毛','',NULL,NULL,NULL,NULL,NULL,'RM'),(2,'合成材质','',NULL,NULL,NULL,NULL,NULL,'HCCZ'),(3,'炭素纤维','',NULL,NULL,NULL,NULL,NULL,'TSQW'),(4,'注塑','',NULL,NULL,NULL,NULL,NULL,'ZS'),(5,'陶瓷','',NULL,NULL,NULL,NULL,NULL,'TC'),(6,'棉毛','',NULL,NULL,NULL,NULL,NULL,'MM'),(7,'木制','',NULL,NULL,NULL,NULL,NULL,'M'),(8,'板材','',NULL,NULL,NULL,NULL,NULL,'BC'),(9,'银','',NULL,NULL,NULL,NULL,NULL,'Y'),(10,'鹅毛','',NULL,NULL,NULL,NULL,NULL,'EM'),(11,'骆驼绒','',NULL,NULL,NULL,NULL,NULL,'LTR'),(12,'羊驼绒','',NULL,NULL,NULL,NULL,NULL,'YTR'),(13,'珍珠鱼皮','',NULL,NULL,NULL,NULL,NULL,'ZZYP'),(14,'禁用/环氧树脂','',NULL,NULL,NULL,NULL,NULL,'HYSZ'),(15,'缟玛瑙','',NULL,NULL,NULL,NULL,NULL,'GMN'),(16,'白鸭绒','',NULL,NULL,NULL,NULL,NULL,'BYR'),(17,'未知AAAA','',NULL,NULL,NULL,NULL,NULL,'WZ'),(18,'橡胶皮革','',NULL,NULL,NULL,NULL,NULL,'XJPG'),(19,'牛毛皮','',NULL,NULL,NULL,NULL,NULL,'NMP'),(20,'羽绒','',NULL,NULL,NULL,NULL,NULL,'YR'),(21,'糖','ABC',NULL,NULL,NULL,NULL,NULL,'T'),(22,'醋酸纤维','ACETATE FIBER',NULL,NULL,NULL,NULL,NULL,'CSXW'),(23,'丙烯酸纤维','ACRILICA',NULL,NULL,NULL,NULL,NULL,'BXS'),(24,'压克力','Acryl',NULL,NULL,NULL,NULL,NULL,'Acryl'),(25,'腈纶','ACRYLIC',NULL,NULL,NULL,NULL,NULL,'QL'),(26,'人造皮毛/晴纶','ACRYLIQUE',NULL,NULL,NULL,NULL,NULL,'RZPM'),(27,'磨毛棉','AF',NULL,NULL,NULL,NULL,NULL,'MMM'),(28,'羊驼毛','ALPACA(WP)',NULL,NULL,NULL,NULL,NULL,'YTM'),(29,'奥特纤维','altre fibre',NULL,NULL,NULL,NULL,NULL,'ATQW'),(30,'铝','Aluminum',NULL,NULL,NULL,NULL,NULL,'AI'),(31,'安哥拉兔毛','ANGORA',NULL,NULL,NULL,NULL,NULL,'AGLTM'),(32,'竹纤维','Bamboo',NULL,NULL,NULL,NULL,NULL,'ZXW'),(33,'铜','BRASS',NULL,NULL,NULL,NULL,NULL,'T'),(34,'水牛皮','BUFFALO',NULL,NULL,NULL,NULL,NULL,'SNP'),(35,'牛皮','CALF',NULL,NULL,NULL,NULL,NULL,'NP'),(36,'狼毛','CANIS LATRANS',NULL,NULL,NULL,NULL,NULL,'LM'),(37,'金银线','CANNETILLE',NULL,NULL,NULL,NULL,NULL,'jyx'),(38,'帆布','CANVAS',NULL,NULL,NULL,NULL,NULL,'FB'),(39,'人造帆布','CANVAS',NULL,NULL,NULL,NULL,NULL,'CA'),(40,'羊绒','Cashmere',NULL,NULL,NULL,NULL,NULL,'YR'),(41,'山羊绒','CASHMERE',NULL,NULL,NULL,NULL,NULL,'YR'),(42,'涂层帆布','Coated Canvas',NULL,NULL,NULL,NULL,NULL,'TCFB'),(43,'涂层棉布','COATED COTTON',NULL,NULL,NULL,NULL,NULL,'TCMB'),(44,'兔毛','CONY HAIR',NULL,NULL,NULL,NULL,NULL,'TM'),(45,'果实纽扣','COROZO BOTTON',NULL,NULL,NULL,NULL,NULL,'GSJK'),(46,'棉','COTTON',NULL,NULL,NULL,NULL,NULL,'M'),(47,'牛皮革','cow leather',NULL,NULL,NULL,NULL,NULL,'NPG'),(48,'郊狼毛皮','COYOTE FUR',NULL,NULL,NULL,NULL,NULL,'JLMP'),(49,'鳄鱼皮','CROCODILE LEATHER',NULL,NULL,NULL,NULL,NULL,'EYP'),(50,'凯门鳄','crocodilus',NULL,NULL,NULL,NULL,NULL,'KME'),(51,'水晶','CRYSTAL',NULL,NULL,NULL,NULL,NULL,'SJ'),(52,'铜氨纤维','CUPRO',NULL,NULL,NULL,NULL,NULL,'TAXW'),(53,'鹿皮','DEER SKIN',NULL,NULL,NULL,NULL,NULL,'LP'),(54,'特拉纶','DRALON',NULL,NULL,NULL,NULL,NULL,'TLL'),(55,'绒毛','',NULL,NULL,NULL,NULL,NULL,'RM'),(56,'合成材质','',NULL,NULL,NULL,NULL,NULL,'HCCZ'),(57,'炭素纤维','',NULL,NULL,NULL,NULL,NULL,'TSQW'),(58,'注塑','',NULL,NULL,NULL,NULL,NULL,'ZS'),(59,'陶瓷','',NULL,NULL,NULL,NULL,NULL,'TC'),(60,'棉毛','',NULL,NULL,NULL,NULL,NULL,'MM'),(61,'木制','',NULL,NULL,NULL,NULL,NULL,'M'),(62,'板材','',NULL,NULL,NULL,NULL,NULL,'BC'),(63,'银','',NULL,NULL,NULL,NULL,NULL,'Y'),(64,'鹅毛','',NULL,NULL,NULL,NULL,NULL,'EM'),(65,'骆驼绒','',NULL,NULL,NULL,NULL,NULL,'LTR'),(66,'羊驼绒','',NULL,NULL,NULL,NULL,NULL,'YTR'),(67,'珍珠鱼皮','',NULL,NULL,NULL,NULL,NULL,'ZZYP'),(68,'禁用/环氧树脂','',NULL,NULL,NULL,NULL,NULL,'HYSZ'),(69,'缟玛瑙','',NULL,NULL,NULL,NULL,NULL,'GMN'),(70,'白鸭绒','',NULL,NULL,NULL,NULL,NULL,'BYR'),(71,'未知AAAA','',NULL,NULL,NULL,NULL,NULL,'WZ'),(72,'橡胶皮革','',NULL,NULL,NULL,NULL,NULL,'XJPG'),(73,'牛毛皮','',NULL,NULL,NULL,NULL,NULL,'NMP'),(74,'羽绒','',NULL,NULL,NULL,NULL,NULL,'YR'),(75,'糖','ABC',NULL,NULL,NULL,NULL,NULL,'T'),(76,'醋酸纤维','ACETATE FIBER',NULL,NULL,NULL,NULL,NULL,'CSXW'),(77,'丙烯酸纤维','ACRILICA',NULL,NULL,NULL,NULL,NULL,'BXS'),(78,'压克力','Acryl',NULL,NULL,NULL,NULL,NULL,'Acryl'),(79,'腈纶','ACRYLIC',NULL,NULL,NULL,NULL,NULL,'QL'),(80,'人造皮毛/晴纶','ACRYLIQUE',NULL,NULL,NULL,NULL,NULL,'RZPM'),(81,'磨毛棉','AF',NULL,NULL,NULL,NULL,NULL,'MMM'),(82,'羊驼毛','ALPACA(WP)',NULL,NULL,NULL,NULL,NULL,'YTM'),(83,'奥特纤维','altre fibre',NULL,NULL,NULL,NULL,NULL,'ATQW'),(84,'铝','Aluminum',NULL,NULL,NULL,NULL,NULL,'AI'),(85,'安哥拉兔毛','ANGORA',NULL,NULL,NULL,NULL,NULL,'AGLTM'),(86,'竹纤维','Bamboo',NULL,NULL,NULL,NULL,NULL,'ZXW'),(87,'铜','BRASS',NULL,NULL,NULL,NULL,NULL,'T'),(88,'水牛皮','BUFFALO',NULL,NULL,NULL,NULL,NULL,'SNP'),(89,'牛皮','CALF',NULL,NULL,NULL,NULL,NULL,'NP'),(90,'狼毛','CANIS LATRANS',NULL,NULL,NULL,NULL,NULL,'LM'),(91,'金银线','CANNETILLE',NULL,NULL,NULL,NULL,NULL,'jyx'),(92,'帆布','CANVAS',NULL,NULL,NULL,NULL,NULL,'FB'),(93,'人造帆布','CANVAS',NULL,NULL,NULL,NULL,NULL,'CA'),(94,'羊绒','Cashmere',NULL,NULL,NULL,NULL,NULL,'YR'),(95,'山羊绒','CASHMERE',NULL,NULL,NULL,NULL,NULL,'YR'),(96,'涂层帆布','Coated Canvas',NULL,NULL,NULL,NULL,NULL,'TCFB'),(97,'涂层棉布','COATED COTTON',NULL,NULL,NULL,NULL,NULL,'TCMB'),(98,'兔毛','CONY HAIR',NULL,NULL,NULL,NULL,NULL,'TM'),(99,'果实纽扣','COROZO BOTTON',NULL,NULL,NULL,NULL,NULL,'GSJK'),(100,'棉','COTTON',NULL,NULL,NULL,NULL,NULL,'M'),(101,'牛皮革','cow leather',NULL,NULL,NULL,NULL,NULL,'NPG'),(102,'郊狼毛皮','COYOTE FUR',NULL,NULL,NULL,NULL,NULL,'JLMP'),(103,'鳄鱼皮','CROCODILE LEATHER',NULL,NULL,NULL,NULL,NULL,'EYP'),(104,'凯门鳄','crocodilus',NULL,NULL,NULL,NULL,NULL,'KME'),(105,'水晶','CRYSTAL',NULL,NULL,NULL,NULL,NULL,'SJ'),(106,'铜氨纤维','CUPRO',NULL,NULL,NULL,NULL,NULL,'TAXW'),(107,'鹿皮','DEER SKIN',NULL,NULL,NULL,NULL,NULL,'LP'),(108,'特拉纶','DRALON',NULL,NULL,NULL,NULL,NULL,'TLL'),(109,'绒毛','',NULL,NULL,NULL,NULL,NULL,'RM'),(110,'合成材质','',NULL,NULL,NULL,NULL,NULL,'HCCZ'),(111,'炭素纤维','',NULL,NULL,NULL,NULL,NULL,'TSQW'),(112,'注塑','',NULL,NULL,NULL,NULL,NULL,'ZS'),(113,'陶瓷','',NULL,NULL,NULL,NULL,NULL,'TC'),(114,'棉毛','',NULL,NULL,NULL,NULL,NULL,'MM'),(115,'木制','',NULL,NULL,NULL,NULL,NULL,'M'),(116,'板材','',NULL,NULL,NULL,NULL,NULL,'BC'),(117,'银','',NULL,NULL,NULL,NULL,NULL,'Y'),(118,'鹅毛','',NULL,NULL,NULL,NULL,NULL,'EM'),(119,'骆驼绒','',NULL,NULL,NULL,NULL,NULL,'LTR'),(120,'羊驼绒','',NULL,NULL,NULL,NULL,NULL,'YTR'),(121,'珍珠鱼皮','',NULL,NULL,NULL,NULL,NULL,'ZZYP'),(122,'禁用/环氧树脂','',NULL,NULL,NULL,NULL,NULL,'HYSZ'),(123,'缟玛瑙','',NULL,NULL,NULL,NULL,NULL,'GMN'),(124,'白鸭绒','',NULL,NULL,NULL,NULL,NULL,'BYR'),(125,'未知AAAA','',NULL,NULL,NULL,NULL,NULL,'WZ'),(126,'橡胶皮革','',NULL,NULL,NULL,NULL,NULL,'XJPG'),(127,'牛毛皮','',NULL,NULL,NULL,NULL,NULL,'NMP'),(128,'羽绒','',NULL,NULL,NULL,NULL,NULL,'YR'),(129,'糖','ABC',NULL,NULL,NULL,NULL,NULL,'T'),(130,'醋酸纤维','ACETATE FIBER',NULL,NULL,NULL,NULL,NULL,'CSXW'),(131,'丙烯酸纤维','ACRILICA',NULL,NULL,NULL,NULL,NULL,'BXS'),(132,'压克力','Acryl',NULL,NULL,NULL,NULL,NULL,'Acryl'),(133,'腈纶','ACRYLIC',NULL,NULL,NULL,NULL,NULL,'QL'),(134,'人造皮毛/晴纶','ACRYLIQUE',NULL,NULL,NULL,NULL,NULL,'RZPM'),(135,'磨毛棉','AF',NULL,NULL,NULL,NULL,NULL,'MMM'),(136,'羊驼毛','ALPACA(WP)',NULL,NULL,NULL,NULL,NULL,'YTM'),(137,'奥特纤维','altre fibre',NULL,NULL,NULL,NULL,NULL,'ATQW'),(138,'铝','Aluminum',NULL,NULL,NULL,NULL,NULL,'AI'),(139,'安哥拉兔毛','ANGORA',NULL,NULL,NULL,NULL,NULL,'AGLTM'),(140,'竹纤维','Bamboo',NULL,NULL,NULL,NULL,NULL,'ZXW'),(141,'铜','BRASS',NULL,NULL,NULL,NULL,NULL,'T'),(142,'水牛皮','BUFFALO',NULL,NULL,NULL,NULL,NULL,'SNP'),(143,'牛皮','CALF',NULL,NULL,NULL,NULL,NULL,'NP'),(144,'狼毛','CANIS LATRANS',NULL,NULL,NULL,NULL,NULL,'LM'),(145,'金银线','CANNETILLE',NULL,NULL,NULL,NULL,NULL,'jyx'),(146,'帆布','CANVAS',NULL,NULL,NULL,NULL,NULL,'FB'),(147,'人造帆布','CANVAS',NULL,NULL,NULL,NULL,NULL,'CA'),(148,'羊绒','Cashmere',NULL,NULL,NULL,NULL,NULL,'YR'),(149,'山羊绒','CASHMERE',NULL,NULL,NULL,NULL,NULL,'YR'),(150,'涂层帆布','Coated Canvas',NULL,NULL,NULL,NULL,NULL,'TCFB'),(151,'涂层棉布','COATED COTTON',NULL,NULL,NULL,NULL,NULL,'TCMB'),(152,'兔毛','CONY HAIR',NULL,NULL,NULL,NULL,NULL,'TM'),(153,'果实纽扣','COROZO BOTTON',NULL,NULL,NULL,NULL,NULL,'GSJK'),(154,'棉','COTTON',NULL,NULL,NULL,NULL,NULL,'M'),(155,'牛皮革','cow leather',NULL,NULL,NULL,NULL,NULL,'NPG'),(156,'郊狼毛皮','COYOTE FUR',NULL,NULL,NULL,NULL,NULL,'JLMP'),(157,'鳄鱼皮','CROCODILE LEATHER',NULL,NULL,NULL,NULL,NULL,'EYP'),(158,'凯门鳄','crocodilus',NULL,NULL,NULL,NULL,NULL,'KME'),(159,'水晶','CRYSTAL',NULL,NULL,NULL,NULL,NULL,'SJ'),(160,'铜氨纤维','CUPRO',NULL,NULL,NULL,NULL,NULL,'TAXW'),(161,'鹿皮','DEER SKIN',NULL,NULL,NULL,NULL,NULL,'LP'),(162,'特拉纶','DRALON',NULL,NULL,NULL,NULL,NULL,'TLL'),(163,'鸭绒','DUCK DOWN',NULL,NULL,NULL,NULL,NULL,'YR'),(164,'羽毛','DUCK FEATHER',NULL,NULL,NULL,NULL,NULL,'YM'),(165,'聚氨酯弹性纤维','ELASTAN',NULL,NULL,NULL,NULL,NULL,'JAZTXXW'),(166,'弹性纤维','ELASTIC FIBERS',NULL,NULL,NULL,NULL,NULL,'TXXW'),(167,'弹性多聚酯纤维','ELASTOMUL TIESTER',NULL,NULL,NULL,NULL,NULL,'TXDJZXW'),(168,'珐琅','enamel',NULL,NULL,NULL,NULL,NULL,'FL'),(169,'环氧树脂','EPOXY RESIN',NULL,NULL,NULL,NULL,NULL,'HYSZ'),(170,'金属纤维','FIBRA METALLIZED',NULL,NULL,NULL,NULL,NULL,'JSXW'),(171,'纤维','FIBRE',NULL,NULL,NULL,NULL,NULL,'XW'),(172,'亚麻','FLAX',NULL,NULL,NULL,NULL,NULL,'YM'),(173,'狐狸毛','FOX FUR',NULL,NULL,NULL,NULL,NULL,'HLM'),(174,'玻璃纤维','GLASS FIBRE',NULL,NULL,NULL,NULL,NULL,'BLXW'),(175,'金','GOLD',NULL,NULL,NULL,NULL,NULL,'GOLD'),(176,'鹅绒','GOOSE DOWN',NULL,NULL,NULL,NULL,NULL,'ER'),(177,'马毛','HORSEHAIR MATERIAL',NULL,NULL,NULL,NULL,NULL,'MM'),(178,'马皮','HORSEHIDE',NULL,NULL,NULL,NULL,NULL,'MP'),(179,'日本传统手工纸纤维','JAPANESE PAPER',NULL,NULL,NULL,NULL,NULL,'RBZXW'),(180,'黄麻','JUTE',NULL,NULL,NULL,NULL,NULL,'HM'),(181,'开司米','KASHMIR',NULL,NULL,NULL,NULL,NULL,'KSM'),(182,'羔羊毛','LAMB',NULL,NULL,NULL,NULL,NULL,'GYM'),(183,'羔羊皮','LAMB SKIN',NULL,NULL,NULL,NULL,NULL,'gyp'),(184,'拉娜美利奴羊毛','LANA MERINO MERINO WOOL',NULL,NULL,NULL,NULL,NULL,'LNMLNYM'),(185,'皮','LEATHER',NULL,NULL,NULL,NULL,NULL,'P'),(186,'麻','LINEN',NULL,NULL,NULL,NULL,NULL,'M'),(187,'蜥蜴皮','LIZARD LEATHER',NULL,NULL,NULL,NULL,NULL,'XYP'),(188,'莱卡','LYCRA',NULL,NULL,NULL,NULL,NULL,'LK'),(189,'莱赛尔纤维','LYOCELL',NULL,NULL,NULL,NULL,NULL,'LSE'),(190,'纤维素纤维','LYOCELL',NULL,NULL,NULL,NULL,NULL,'XWSXW'),(191,'溶解性纤维','Lyocell',NULL,NULL,NULL,NULL,NULL,'RJXXW'),(192,'薄棉布','MADRAS',NULL,NULL,NULL,NULL,NULL,'BMB'),(193,'枫木','MAPLE',NULL,NULL,NULL,NULL,NULL,'FM'),(194,'貂毛','MARTEN HAIR',NULL,NULL,NULL,NULL,NULL,'DM'),(195,'马特拉塞凸纹布','MATELASSE',NULL,NULL,NULL,NULL,NULL,'MTLS'),(196,'美利奴羊毛','MERINO WOOL',NULL,NULL,NULL,NULL,NULL,'MLNYM'),(197,'金属','METAL',NULL,NULL,NULL,NULL,NULL,'JS'),(198,'合金','METAL',NULL,NULL,NULL,NULL,NULL,'HJ'),(199,'金属涂层纤维','metallized fibre',NULL,NULL,NULL,NULL,NULL,'JTXW'),(200,'水貂','MINK FUR',NULL,NULL,NULL,NULL,NULL,'SD'),(201,'美耐底','MND',NULL,NULL,NULL,NULL,NULL,'MND'),(202,'腈氯綸','MODACRYLIC',NULL,NULL,NULL,NULL,NULL,'MA'),(203,'莫代尔','MODAL',NULL,NULL,NULL,NULL,NULL,'MDE'),(204,'马海毛','MOHAIR',NULL,NULL,NULL,NULL,NULL,'MHM'),(205,'牛仔布','niuzaibu',NULL,NULL,NULL,NULL,NULL,'NZB'),(206,'貉子毛','NYCTEREUTES PROCYONOIDES',NULL,NULL,NULL,NULL,NULL,'HZM'),(207,'尼龙','NYLON',NULL,NULL,NULL,NULL,NULL,'NL'),(208,'鸵鸟皮','OSTRICH LEATHER',NULL,NULL,NULL,NULL,NULL,'TNP'),(209,'其它','OTHER',NULL,NULL,NULL,NULL,NULL,'QT'),(210,'塑料','PA',NULL,NULL,NULL,NULL,NULL,'SL'),(211,'稻草','PAILLE',NULL,NULL,NULL,NULL,NULL,'DC'),(212,'纸','paper',NULL,NULL,NULL,NULL,NULL,'PAPER'),(213,'毛绒/长毛绒','PELUCHE',NULL,NULL,NULL,NULL,NULL,'MR/CMR'),(214,'猪皮','PIGSKIN',NULL,NULL,NULL,NULL,NULL,'ZP'),(215,'聚烯经','PO',NULL,NULL,NULL,NULL,NULL,'JXJ'),(216,'涤纶','POLISETERE',NULL,NULL,NULL,NULL,NULL,'DL'),(217,'腈纶开司米','POLYAKRYL',NULL,NULL,NULL,NULL,NULL,'QLKSM'),(218,'锦纶','Polyamide',NULL,NULL,NULL,NULL,NULL,'JL'),(219,'聚酰胺','POLYAMIDE',NULL,NULL,NULL,NULL,NULL,'JXA'),(220,'聚碳酸酯','POLYCARBONATE(PC)',NULL,NULL,NULL,NULL,NULL,'JTSZ'),(221,'聚酯纤维','POLYESTER',NULL,NULL,NULL,NULL,NULL,'JZXW'),(222,'涤纶金属丝','POLYESTER METAL',NULL,NULL,NULL,NULL,NULL,'DLJSS'),(223,'金属聚酯纤维','POLYESTER METALLISED',NULL,NULL,NULL,NULL,NULL,'jsjz'),(224,'聚醚','POLYETHER',NULL,NULL,NULL,NULL,NULL,'JM'),(225,'聚乙烯/丙纶','POLYETHYLENE',NULL,NULL,NULL,NULL,NULL,'JYX'),(226,'聚丙烯','POLYPROPYLENE(PP)',NULL,NULL,NULL,NULL,NULL,'JBXQ'),(227,'聚苯乙烯','POLYSTYRENE',NULL,NULL,NULL,NULL,NULL,'PS'),(228,'聚氨酯','POLYURETHANE(PU)',NULL,NULL,NULL,NULL,NULL,'JAZ'),(229,'维纶','POLYVINYL',NULL,NULL,NULL,NULL,NULL,'WL'),(230,'PU','PU',NULL,NULL,NULL,NULL,NULL,'PU'),(231,'聚氯乙烯','PVC',NULL,NULL,NULL,NULL,NULL,'JLYX'),(232,'PVC','PVC',NULL,NULL,NULL,NULL,NULL,'PVC'),(233,'兔毛皮','RABBIT FUR',NULL,NULL,NULL,NULL,NULL,'TMP'),(234,'浣熊毛','RACCOON',NULL,NULL,NULL,NULL,NULL,'HX'),(235,'人造丝','RAYON',NULL,NULL,NULL,NULL,NULL,'RZS'),(236,'树脂','RESINA',NULL,NULL,NULL,NULL,NULL,'SZ'),(237,'橡胶','RUBBER',NULL,NULL,NULL,NULL,NULL,'RUBBER'),(238,'橡胶','RUBBER',NULL,NULL,NULL,NULL,NULL,'XJ'),(239,'人造纤维','RZXW',NULL,NULL,NULL,NULL,NULL,'RZXW'),(240,'绸缎','SATIN',NULL,NULL,NULL,NULL,NULL,'SD'),(241,'剪绒','SHEARLING',NULL,NULL,NULL,NULL,NULL,'JR'),(242,'硅胶','SILICONE',NULL,NULL,NULL,NULL,NULL,'GJ'),(243,'桑蚕丝','SILK',NULL,NULL,NULL,NULL,NULL,'SCS'),(244,'禁用/桑蚕丝','SILK',NULL,NULL,NULL,NULL,NULL,'SI'),(245,'银','SILVER',NULL,NULL,NULL,NULL,NULL,'SILVER'),(246,'蛇皮','SNAKE',NULL,NULL,NULL,NULL,NULL,'SP'),(247,'氨纶','SPANDEX',NULL,NULL,NULL,NULL,NULL,'AL'),(248,'不锈钢','STAINLESS STEEL',NULL,NULL,NULL,NULL,NULL,'BXG'),(249,'钢','STEEL',NULL,NULL,NULL,NULL,NULL,'G'),(250,'玻璃','STRASS',NULL,NULL,NULL,NULL,NULL,'BL'),(251,'秸秆','straw',NULL,NULL,NULL,NULL,NULL,'straw'),(252,'羊皮','SUEDE',NULL,NULL,NULL,NULL,NULL,'YP'),(253,'山羊皮','SUEDE',NULL,NULL,NULL,NULL,NULL,'SYP'),(254,'施华洛世奇水晶','SWAROVSKI CRYSTAL',NULL,NULL,NULL,NULL,NULL,'SHLSQ-SJ'),(255,'合成皮革','SYNTHETIC LEATHER',NULL,NULL,NULL,NULL,NULL,'HCG'),(256,'天丝纤维','TENCEL',NULL,NULL,NULL,NULL,NULL,'TSXW'),(257,'织物','TEXTILE',NULL,NULL,NULL,NULL,NULL,'ZW'),(258,'三醋酯纤维','TRIACETATE',NULL,NULL,NULL,NULL,NULL,'SCZXW'),(259,'醋酯纤维','TRIACETATE',NULL,NULL,NULL,NULL,NULL,'CZXW'),(260,'丝绒','VELVET',NULL,NULL,NULL,NULL,NULL,'SR'),(261,'初剪羊毛','VIRGIN WOOL',NULL,NULL,NULL,NULL,NULL,'CJYM'),(262,'粘胶纤维','VISCOSE',NULL,NULL,NULL,NULL,NULL,'ZJ'),(263,'禁用/粘胶纤维','VISCOSE',NULL,NULL,NULL,NULL,NULL,'禁用JZ'),(264,'羊毛','WOOL',NULL,NULL,NULL,NULL,NULL,'YM'),(265,'羊毛皮','woolfell',NULL,NULL,NULL,NULL,NULL,'YMP'),(266,'牦牛绒','YAK',NULL,NULL,NULL,NULL,NULL,'MNR'),(267,'羊皮革','yangpige',NULL,NULL,NULL,NULL,NULL,'YPG'),(268,'锌合金','ZAMAK',NULL,NULL,NULL,NULL,NULL,'XHJ'),(269,'锌','ZINCO',NULL,NULL,NULL,NULL,NULL,'XIN');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='订单主表';

/*Data for the table `tb_order` */

insert  into `tb_order`(`id`,`bussinesstypeid`,`makedate`,`makestaff`,`supplierid`,`finalsupplierid`,`bookingid`,`agentid`,`purchasedept`,`orderno`,`total`,`currency`,`auditstaff`,`auditdate`,`ordercode`,`worldordercode`,`isstatus`,`formtype`,`memo`,`contactor`,`ourcontactor`,`ageseason`,`seasontype`,`invoiceno`,`ddtype`,`morderid`,`exchangerate`,`bussinesstype`,`discount`,`property`,`companyid`,`status`) values (6,NULL,'2019-03-29 16:27:36',1,6,0,0,NULL,NULL,'D000001201903291627363324','0.00','',0,NULL,'','',NULL,'','','','',2,0,'',NULL,NULL,'0.0000',1,'0.00',0,1,3),(7,NULL,'2019-04-01 19:31:46',1,1,1,0,NULL,NULL,'D000001201904011931467284','0.00','',0,NULL,'','',NULL,'','','','',1,1,'',NULL,NULL,'0.0000',1,'0.00',1,1,3),(8,NULL,'2019-04-01 19:32:29',1,5,5,0,NULL,NULL,'D000001201904011932295137','0.00','',0,NULL,'','',NULL,'','','','',6,1,'',NULL,NULL,'0.0000',2,'0.00',1,1,2),(9,NULL,'2019-04-01 19:33:22',1,6,6,0,NULL,NULL,'D000001201904011933222331','0.00','',0,NULL,'','',NULL,'','','','',5,2,'',NULL,NULL,'0.0000',1,'0.00',1,1,2),(10,NULL,'2019-04-01 19:33:57',1,4,4,0,NULL,NULL,'D000001201904011933571910','0.00','',0,NULL,'','',NULL,'','','','',2,1,'',NULL,NULL,'0.0000',2,'0.00',2,1,2),(11,NULL,'2019-04-03 16:10:40',1,4,0,0,NULL,NULL,'D000001201904031610405788','0.00','',0,NULL,'','',NULL,'','','','',3,0,'',NULL,NULL,'0.0000',2,'0.00',1,1,1),(12,NULL,'2019-04-03 16:11:33',1,4,0,0,NULL,NULL,'D000001201904031611336730','0.00','',0,NULL,'','',NULL,'','','','',3,0,'',NULL,NULL,'0.0000',2,'0.00',1,1,2);

/*Table structure for table `tb_order_payment` */

DROP TABLE IF EXISTS `tb_order_payment`;

CREATE TABLE `tb_order_payment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` int(11) DEFAULT NULL COMMENT '订单id',
  `currency` tinyint(4) DEFAULT NULL COMMENT '币种',
  `amount` decimal(15,2) DEFAULT NULL COMMENT '金额',
  `makestaff` int(11) DEFAULT NULL COMMENT '添加人',
  `maketime` datetime DEFAULT NULL COMMENT '添加时间',
  `confirmstaff` int(11) DEFAULT NULL COMMENT '付款确认人',
  `confirmtime` datetime DEFAULT NULL COMMENT '付款确认时间',
  `paymentdate` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '付款日期',
  `companyid` int(11) DEFAULT NULL COMMENT '公司id',
  `status` tinyint(4) DEFAULT '0' COMMENT '付款状态：0=未支付；1=已支付',
  `payment_type` tinyint(4) DEFAULT NULL COMMENT '收款类型：1=定金；2=货款',
  `memo` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `orderid` (`orderid`),
  KEY `companyid` (`companyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tb_order_payment` */

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
  KEY `productid` (`productid`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COMMENT='订单明细';

/*Data for the table `tb_orderdetails` */

insert  into `tb_orderdetails`(`id`,`orderid`,`sizecontentid`,`number`,`productid`,`price`,`confirm_number`,`companyid`,`is_append`,`createdate`,`status`,`actualnumber`) values (35,6,13,2,2,'1000.00',6,1,0,'2019-04-01 19:27:43',NULL,0),(36,6,12,2,2,'1000.00',6,1,0,'2019-04-01 19:27:43',NULL,0),(37,6,11,2,2,'1000.00',6,1,0,'2019-04-01 19:27:43',NULL,0),(38,6,10,2,2,'1000.00',0,1,0,'2019-04-01 19:27:43',NULL,0),(39,6,9,5,2,'1000.00',0,1,0,'2019-04-01 19:27:43',NULL,0),(40,6,8,3,2,'1000.00',0,1,0,'2019-04-01 19:27:43',NULL,0),(41,6,7,2,2,'1000.00',4,1,0,'2019-04-01 19:27:43',NULL,0),(42,6,6,3,2,'1000.00',2,1,0,'2019-04-01 19:27:43',NULL,0),(43,8,5,1,6,'2500.00',0,1,0,'2019-04-01 19:32:43',NULL,0),(44,8,4,1,6,'2500.00',0,1,0,'2019-04-01 19:32:43',NULL,0),(45,8,3,1,6,'2500.00',0,1,0,'2019-04-01 19:32:43',NULL,0),(46,8,2,1,6,'2500.00',0,1,0,'2019-04-01 19:32:43',NULL,0),(47,8,1,1,6,'2500.00',0,1,0,'2019-04-01 19:32:43',NULL,0),(48,8,5,1,1,'126.50',0,1,0,'2019-04-01 19:32:43',NULL,0),(49,8,4,1,1,'126.50',0,1,0,'2019-04-01 19:32:43',NULL,0),(50,8,3,1,1,'126.50',0,1,0,'2019-04-01 19:32:43',NULL,0),(51,8,2,1,1,'126.50',0,1,0,'2019-04-01 19:32:43',NULL,0),(52,8,1,1,1,'126.50',0,1,0,'2019-04-01 19:32:43',NULL,0),(53,9,13,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(54,9,12,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(55,9,11,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(56,9,10,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(57,9,9,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(58,9,8,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(59,9,7,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(60,9,6,1,3,'2000.00',0,1,0,'2019-04-01 19:33:22',NULL,0),(61,10,13,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(62,10,12,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(63,10,11,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(64,10,10,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(65,10,9,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(66,10,8,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(67,10,7,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(68,10,6,1,2,'1000.00',0,1,0,'2019-04-01 19:33:57',NULL,0),(69,10,5,1,1,'126.50',0,1,0,'2019-04-01 19:33:57',NULL,0),(70,10,4,1,1,'126.50',0,1,0,'2019-04-01 19:33:57',NULL,0),(71,10,3,1,1,'126.50',0,1,0,'2019-04-01 19:33:57',NULL,0),(72,10,2,1,1,'126.50',0,1,0,'2019-04-01 19:33:57',NULL,0),(73,10,1,1,1,'126.50',0,1,0,'2019-04-01 19:33:57',NULL,0),(74,11,5,1,1,NULL,0,1,0,'2019-04-03 16:10:40',NULL,0),(75,11,4,1,1,NULL,0,1,0,'2019-04-03 16:10:40',NULL,0),(76,11,3,1,1,NULL,0,1,0,'2019-04-03 16:10:40',NULL,0),(77,11,2,1,1,NULL,0,1,0,'2019-04-03 16:10:40',NULL,0),(78,11,1,1,1,NULL,0,1,0,'2019-04-03 16:10:40',NULL,0),(79,12,5,1,1,'125.00',0,1,0,'2019-04-03 16:11:39',NULL,0),(80,12,4,1,1,'125.00',0,1,0,'2019-04-03 16:11:39',NULL,0),(81,12,3,1,1,'125.00',0,1,0,'2019-04-03 16:11:39',NULL,0),(82,12,2,1,1,'125.00',0,1,0,'2019-04-03 16:11:39',NULL,0),(83,12,1,1,1,'125.00',0,1,0,'2019-04-03 16:11:39',NULL,0);

/*Table structure for table `tb_permission` */

DROP TABLE IF EXISTS `tb_permission`;

CREATE TABLE `tb_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属权限id，默认0为顶级权限',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '权限名称',
  `memo_cn` varchar(50) DEFAULT NULL COMMENT '中文描述',
  `memo_en` varchar(50) DEFAULT NULL COMMENT '英文描述',
  `memo_hk` varchar(50) DEFAULT NULL COMMENT '粤语描述',
  `memo_fr` varchar(50) DEFAULT NULL COMMENT '法语描述',
  `memo_it` varchar(50) DEFAULT NULL COMMENT '意大利语描述',
  `memo_sp` varchar(50) DEFAULT NULL COMMENT '西班牙语描述',
  `memo_de` varchar(50) DEFAULT NULL COMMENT '德语描述',
  `is_only_superadmin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为专属超级管理员权限，0-不是 1-是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_permission` */

insert  into `tb_permission`(`id`,`pid`,`name`,`memo_cn`,`memo_en`,`memo_hk`,`memo_fr`,`memo_it`,`memo_sp`,`memo_de`,`is_only_superadmin`) values (1,0,'','组织架构',NULL,NULL,NULL,NULL,NULL,NULL,0),(2,0,'','基础数据',NULL,NULL,NULL,NULL,NULL,NULL,0),(3,0,'','商品管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(4,0,'','客户管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(5,0,'','供应链相关',NULL,NULL,NULL,NULL,NULL,NULL,0),(6,0,'','库存管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(7,0,'','销售管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(12,1,'user','员工信息管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(13,1,'group','权限组管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(14,1,'department','部门信息管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(15,2,'brand\r\n','品牌管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(16,2,'brandgroup','品类管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(17,2,'ageseason','款式年代管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(18,2,'colortemplate','颜色模板管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(19,2,'sizetop','尺码模板管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(20,2,'material','材质管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(21,2,'ulnarinch','商品尺寸管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(22,2,'country','国际地区管理',NULL,NULL,NULL,NULL,NULL,NULL,1),(23,2,'saleport','销售端口管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(24,2,'warehouse','仓库管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(25,5,'order-submit','订单提交',NULL,NULL,NULL,NULL,NULL,NULL,0),(26,5,'order-confirm','订单审核',NULL,NULL,NULL,NULL,NULL,NULL,0),(27,5,'order-finish','订单完结',NULL,NULL,NULL,NULL,NULL,NULL,0),(28,5,'confirmorder-submit','提交发货单',NULL,NULL,NULL,NULL,NULL,NULL,0),(29,5,'confirmorder-confirm','发货单审核',NULL,NULL,NULL,NULL,NULL,NULL,0),(30,5,'warehousing','商品入库',NULL,NULL,NULL,NULL,NULL,NULL,0),(31,6,'requisition','调拨商品',NULL,NULL,NULL,NULL,NULL,NULL,0),(32,7,'sales','提交销售单',NULL,NULL,NULL,NULL,NULL,NULL,0),(33,3,'product','商品管理',NULL,NULL,NULL,NULL,NULL,NULL,0),(34,4,'supplier','客户管理',NULL,NULL,NULL,NULL,NULL,NULL,0);

/*Table structure for table `tb_permission_action` */

DROP TABLE IF EXISTS `tb_permission_action`;

CREATE TABLE `tb_permission_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `permissionid` int(10) unsigned DEFAULT NULL COMMENT '权限id',
  `controller` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '控制器名称',
  `action` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '方法名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_permission_module_permissionid_module_controller_action` (`permissionid`,`controller`,`action`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_permission_action` */

insert  into `tb_permission_action`(`id`,`permissionid`,`controller`,`action`) values (1,12,'user','add'),(3,12,'user','delete'),(7,12,'user','deletegroup'),(2,12,'user','edit'),(4,12,'warehouseuser','add'),(6,12,'warehouseuser','delete'),(5,12,'warehouseuser','edit'),(12,13,'group','add'),(14,13,'group','delete'),(13,13,'group','edit'),(11,13,'group','setting'),(8,14,'department','add'),(10,14,'department','delete'),(9,14,'department','edit'),(18,15,'aliases','add'),(20,15,'aliases','delete'),(19,15,'aliases','edit'),(15,15,'brand','add'),(17,15,'brand','delete'),(16,15,'brand','edit'),(21,15,'series','add'),(23,15,'series','delete'),(22,15,'series','edit'),(24,16,'brandgroup','add'),(26,16,'brandgroup','delete'),(25,16,'brandgroup','edit'),(27,16,'brandgroupchild','add'),(29,16,'brandgroupchild','delete'),(28,16,'brandgroupchild','edit'),(30,16,'brandgroupchildproperty','add'),(32,16,'brandgroupchildproperty','delete'),(34,16,'brandgroupchildproperty','down'),(31,16,'brandgroupchildproperty','edit'),(33,16,'brandgroupchildproperty','up'),(35,17,'ageseason','add'),(37,17,'ageseason','delete'),(36,17,'ageseason','edit'),(38,18,'colortemplate','add'),(40,18,'colortemplate','delete'),(39,18,'colortemplate','edit'),(44,19,'sizecontent','add'),(46,19,'sizecontent','delete'),(45,19,'sizecontent','edit'),(41,19,'sizetop','add'),(43,19,'sizetop','delete'),(42,19,'sizetop','edit'),(47,20,'material','add'),(49,20,'material','delete'),(48,20,'material','edit'),(50,21,'ulnarinch','add'),(52,21,'ulnarinch','delete'),(51,21,'ulnarinch','edit'),(56,22,'country','add'),(58,22,'country','delete'),(57,22,'country','edit'),(59,23,'saleport','add'),(61,23,'saleport','delete'),(60,23,'saleport','edit'),(53,24,'warehouse','add'),(55,24,'warehouse','delete'),(54,24,'warehouse','edit'),(66,25,'order','delete'),(65,25,'order','saveorder'),(90,25,'orderpayment','add'),(91,25,'orderpayment','delete'),(92,25,'orderpayment','edit'),(93,25,'orderpayment','page'),(68,26,'order','cancel'),(67,26,'order','confirm'),(69,27,'order','finish'),(71,28,'confirmorder','delete'),(70,28,'confirmorder','saveorder'),(72,28,'confirmorder','search'),(74,29,'confirmorder','cancel'),(73,29,'confirmorder','confirm'),(75,30,'warehousing','create'),(76,30,'warehousing','delete'),(79,31,'requisition','save'),(78,32,'sales','delete'),(77,32,'sales','savesale'),(88,32,'salesreceive\r\n','edit'),(86,32,'salesreceive','add'),(87,32,'salesreceive','delete'),(89,32,'salesreceive','page'),(83,33,'product','add'),(85,33,'product','delete'),(84,33,'product','edit'),(82,33,'product','savecode'),(81,33,'product','savecolorgroup'),(80,33,'product','saveproperty'),(62,34,'supplier','add'),(64,34,'supplier','delete'),(63,34,'supplier','edit');

/*Table structure for table `tb_permission_group` */

DROP TABLE IF EXISTS `tb_permission_group`;

CREATE TABLE `tb_permission_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `groupid` int(10) unsigned NOT NULL COMMENT '组id',
  `permissionid` int(10) unsigned NOT NULL COMMENT '权限id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_permission_group` */

insert  into `tb_permission_group`(`id`,`groupid`,`permissionid`) values (28,1,12),(29,1,13),(30,1,14),(31,1,32),(32,1,25);

/*Table structure for table `tb_picture` */

DROP TABLE IF EXISTS `tb_picture`;

CREATE TABLE `tb_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(100) DEFAULT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productid` (`productid`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COMMENT='图片表';

/*Data for the table `tb_picture` */

insert  into `tb_picture`(`id`,`name`,`filename`,`productid`) values (1,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/b7a99f2cf0403a6a0f70d4beb6004759.jpg',NULL),(2,'下载.jpg','product/a52ed93c656aee6a072fa8bec842f529.jpg',NULL),(3,'下载 (1).jpg','product/d21e35b830dcac19e66472488a4df453.jpg',NULL),(4,'下载 (1).jpg','product/c7c6cea60322a5db87614a0e96c10f33.jpg',NULL),(5,'下载.jpg','product/6b313ca8ef9bb69870fa57ff95918b5e.jpg',NULL),(6,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/abdb17b3650f1e46a9784fe4bcf65e52.jpg',1),(7,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/b73dbfa2dcc8d0a02c141c2df4fcf8a6.jpg',1),(8,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/ad35d904308c798bccb0b3e25b990f12.jpg',1),(9,'下载.jpg','product/7d4bf152db62db3234c7a4e0b1d02bfc.jpg',1),(10,'下载 (1).jpg','product/2864be543116105840894a606cf78017.jpg',1),(11,'下载.jpg','product/8bcf6a0c6cc88ff260d0fa78b0f57eae.jpg',1),(12,'下载 (1).jpg','product/435fb1115b1b06afe0b6c7adf5f974aa.jpg',1),(13,'下载.jpg','product/3425fa313d2614ca10c423fa43f20372.jpg',1),(14,'下载 (1).jpg','product/8b50e51db96203eee3fee394940b9fb5.jpg',1),(15,'下载.jpg','product/28d746c501f7e70261ab98184ddf0ef1.jpg',1),(16,'下载 (1).jpg','product/fb321ece3b350c9efb8dfb1708765527.jpg',1),(17,'下载.jpg','product/772181cede835ae77e1aa74dadb6586b.jpg',1),(18,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/9ea1fbd6778852de47bce6ae87cc49c8.jpg',1),(19,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/c86aa0902d9cca60c7b54d7796335d7e.jpg',1),(20,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/8bdfb4547875859ac65a184557e41c17.jpg',1),(21,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/6f5a52858b061e916709cbfcabee9e04.jpg',1),(22,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/f15ee7b88c9659cdeb6fdf141319eeed.jpg',1),(23,'下载 (1).jpg','product/6118615a70c265497a4ae3cf7382071f.jpg',2),(24,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/bd352194b8bd7e772a2df0a5d4c982d2.jpg',1),(25,'60c871d4-f5b6-4576-922b-aa5dba77e537.jpg','product/0745a0887ccc1d417dc4d21a59e01735.jpg',2),(26,'下载 (1).jpg','product/7562457cb4a12f44e807f2f9702069cc.jpg',6),(27,'下载.jpg','product/dfd37e5e56c74b5bfeab869a8790c352.jpg',1),(28,'下载.jpg','product/14b568d5d3ec652e544b1c4a5905b7d0.jpg',5),(29,'下载 (1).jpg','product/20ab3f3335b0ada9e127d0e7929d5620.jpg',5),(30,'2101062000023(1).jpg','product/cee36038c5a2752a77d881778d904153.jpg',4),(31,'2101062000023(2).JPG','product/b7454388764a965db3fbc3219fcbe2d7.jpg',4),(32,'2101062000023(3).JPG','product/6fe1fe4d5ac2ed3289cd86441798ec0d.jpg',4),(33,'2101062000023(3).JPG','product/ffe0dc1f58a7b7fed97c2c5acb2c1237.jpg',4),(34,'2101062000023(5).JPG','product/2c27a8db327cdf1bc64ee855917635b9.jpg',4),(35,'2101062000023(6).JPG','product/b3cb0feeb12e847cde4aa9430ede879d.jpg',4),(36,'2101062000023(8).JPG','product/35f73d1102fd67aadb1bc6c6c648eb68.jpg',4),(37,'下载 (1).jpg','product/21f189f02d67de8c1c765e16514d967c.jpg',2);

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
  `picture2` varchar(100) DEFAULT NULL COMMENT '副图',
  `picture` varchar(100) DEFAULT NULL COMMENT '主图',
  `ageseason` varchar(200) DEFAULT NULL COMMENT '年代',
  `countries` varchar(100) DEFAULT NULL COMMENT '产地',
  `material` int(10) unsigned DEFAULT NULL,
  `producttemplate` int(10) unsigned DEFAULT NULL,
  `season` varchar(20) DEFAULT NULL,
  `laststoragedate` varchar(19) DEFAULT NULL,
  `aliases` varchar(100) DEFAULT NULL COMMENT '别名',
  `series` varchar(100) DEFAULT NULL,
  `series2` varchar(100) DEFAULT NULL,
  `ulnarinch` varchar(50) DEFAULT NULL,
  `factoryprice` decimal(16,2) DEFAULT NULL COMMENT '出厂价',
  `factorypricecurrency` varchar(10) DEFAULT NULL COMMENT '出厂价币种',
  `retailprice` decimal(16,2) DEFAULT NULL COMMENT '成交价格',
  `retailpricecurrency` varchar(10) DEFAULT NULL COMMENT '成交价格币种',
  `product_group` varchar(200) DEFAULT NULL COMMENT '同款不同色数据',
  `nationalprice` decimal(16,2) DEFAULT NULL COMMENT '国内价格',
  `ulnarinch_memo` varchar(100) DEFAULT NULL COMMENT '尺寸备注',
  `sizecontentids` varchar(100) DEFAULT NULL COMMENT '尺码ids',
  `sizetopid` int(11) DEFAULT NULL COMMENT '尺码模板',
  `companyid` int(11) DEFAULT NULL,
  `adduserid` int(11) DEFAULT NULL COMMENT '建档人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='商品表';

/*Data for the table `tb_product` */

insert  into `tb_product`(`id`,`productname`,`wordcode_1`,`wordcode_2`,`wordcode_3`,`wordcode_4`,`wordprice`,`wordpricecurrency`,`gender`,`brandid`,`brandgroupid`,`childbrand`,`brandcolor`,`picture2`,`picture`,`ageseason`,`countries`,`material`,`producttemplate`,`season`,`laststoragedate`,`aliases`,`series`,`series2`,`ulnarinch`,`factoryprice`,`factorypricecurrency`,`retailprice`,`retailpricecurrency`,`product_group`,`nationalprice`,`ulnarinch_memo`,`sizecontentids`,`sizetopid`,`companyid`,`adduserid`) values (1,'BOUTIQUE MOSCHINO 女士黄色长袖T恤衫','111','aaa','xty','','275.00','2','5,3,1',5,5,15,'6','product/0820505ecba45bc993739ba4152aeecf.jpg','product/d237442d5a8662c9a997666a652d5693.jpg','6,7','2,1',0,0,'5,4','','','0','0','','110.00','2','125.00','2','1,6|9,2|11,5','0.00','','5,1,3,4',1,1,NULL),(2,'PRADA 黑色斜跨包','111','aaa','789','','3500.00','2','',6,2,16,'2','product/ae8deb1ae3139a6e603475441d75680f.jpg','product/91a791ff46592e73f3b37a5e293a0033.jpg','4','6',0,0,'','','','0','0','','1800.00','2','2000.00','2','','0.00','','10,11,12',2,1,NULL),(3,'CELINE 女士黑色皮秋千手提包','111','bbb','345','','5000.00','5','',7,2,17,'1','product/6b68287325bb6c177db50fc2df87b60c.jpg','product/648b73a8f8f5fea0b2d4b5350cb011fb.jpg','8','7',0,0,'','','','0','0','','3000.00','5','3500.00','5','','4000.00','',NULL,2,1,1),(4,'FENDI棕色猫眼太阳眼镜','111','aaa','555','','2600.00','3','',8,6,18,'1','product/02527a4f790df36804113733063d950e.jpg','product/229af358a71ac1ff37121de9d945377f.jpg','2','7',0,0,'','','','0','0','','1200.00','3','1500.00','3','','1800.00','',NULL,1,1,1),(5,'FENDI 女士巧克力色腰带','111','aaa','345','','0.00','','',8,7,19,'1','product/52df0f5164d0a27477eed0f2f68470b5.jpg','product/dec023d82f398c2aa2408c589aa13ec3.jpg','8','7',0,0,'','','','0','0','','0.00','','0.00','','','0.00','',NULL,1,1,1),(6,'CHIARA FERRAGNI 女士黑色背包','111','aaa','234','','0.00','','',9,2,12,'3','product/c150ec24aa1394ec267e5bc80b835c5f.jpg','product/18f80ccfeb3cac2bf41e7bf14ff5fa5c.jpg','8','8',0,0,'','','','0','0','','0.00','','0.00','','','0.00','',NULL,1,1,1),(7,'333377','111','aaa','123','','0.00','','',5,2,12,'2','product/75d558e4814861b7ceafa5e735ba0079.jpg','product/f12c64fefbfa5e8ec9d83c4353e170be.jpg','3','6',0,0,'','','','0','0','','0.00','','0.00','','','0.00','',NULL,1,1,1),(9,'BOUTIQUE MOSCHINO 女士黄色长袖T恤衫','111','aaa','bbb','','275.00','2','5,3,1',5,5,15,'2','product/65ff30e7c8a1d58a2a3095aa17e5f016.jpg','product/bd005df1ad6841e6bca33f95030ea811.jpg','6,7','2,1',0,0,'5,4','','','0','0','','110.00','2','125.00','2','1,6|9,2|11,5','0.00','',NULL,1,1,1),(10,'BOUTIQUE MOSCHINO 女士黄色长袖T恤衫','111','aaa','ccc','','275.00','2','5,3,1',5,5,15,'3','','','6,7','2,1',0,0,'5,4',NULL,'','0','0','','110.00','2','125.00','2','','0.00','',NULL,1,1,1),(11,'BOUTIQUE MOSCHINO 女士黄色长袖T恤衫','111','aaa','ddd','','275.00','2','5,3,1',5,5,15,'5','','','6,7','2,1',0,0,'5,4','','','0','0','','110.00','2','125.00','2','1,6|9,2|11,5','0.00','','5,4',1,1,1);

/*Table structure for table `tb_product_memo` */

DROP TABLE IF EXISTS `tb_product_memo`;

CREATE TABLE `tb_product_memo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COMMENT='商品描述';

/*Data for the table `tb_product_memo` */

insert  into `tb_product_memo`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`) values (1,'V领\r',NULL,NULL,NULL,NULL,NULL,NULL),(2,'薄款\r',NULL,NULL,NULL,NULL,NULL,NULL),(3,'叉肩\r',NULL,NULL,NULL,NULL,NULL,NULL),(4,'长袖\r',NULL,NULL,NULL,NULL,NULL,NULL),(5,'单面\r',NULL,NULL,NULL,NULL,NULL,NULL),(6,'低帮\r',NULL,NULL,NULL,NULL,NULL,NULL),(7,'短袖\r',NULL,NULL,NULL,NULL,NULL,NULL),(8,'翻毛皮\r',NULL,NULL,NULL,NULL,NULL,NULL),(9,'高帮\r',NULL,NULL,NULL,NULL,NULL,NULL),(10,'格纹\r',NULL,NULL,NULL,NULL,NULL,NULL),(11,'厚款\r',NULL,NULL,NULL,NULL,NULL,NULL),(12,'加厚款\r',NULL,NULL,NULL,NULL,NULL,NULL),(13,'可裁剪\r',NULL,NULL,NULL,NULL,NULL,NULL),(14,'蕾丝\r',NULL,NULL,NULL,NULL,NULL,NULL),(15,'连帽\r',NULL,NULL,NULL,NULL,NULL,NULL),(16,'两件套\r',NULL,NULL,NULL,NULL,NULL,NULL),(17,'迷彩\r',NULL,NULL,NULL,NULL,NULL,NULL),(18,'牛仔\r',NULL,NULL,NULL,NULL,NULL,NULL),(19,'欧版\r',NULL,NULL,NULL,NULL,NULL,NULL),(20,'漆面\r',NULL,NULL,NULL,NULL,NULL,NULL),(21,'棋盘格\r',NULL,NULL,NULL,NULL,NULL,NULL),(22,'三件套\r',NULL,NULL,NULL,NULL,NULL,NULL),(23,'三折\r',NULL,NULL,NULL,NULL,NULL,NULL),(24,'双面\r',NULL,NULL,NULL,NULL,NULL,NULL),(25,'双腰带\r',NULL,NULL,NULL,NULL,NULL,NULL),(26,'双腰带扣\r',NULL,NULL,NULL,NULL,NULL,NULL),(27,'四件套\r',NULL,NULL,NULL,NULL,NULL,NULL),(28,'网眼/打孔\r',NULL,NULL,NULL,NULL,NULL,NULL),(29,'无袖\r',NULL,NULL,NULL,NULL,NULL,NULL),(30,'压花\r',NULL,NULL,NULL,NULL,NULL,NULL),(31,'亚洲版\r',NULL,NULL,NULL,NULL,NULL,NULL),(32,'一字领\r',NULL,NULL,NULL,NULL,NULL,NULL),(33,'圆领\r',NULL,NULL,NULL,NULL,NULL,NULL),(34,'针织\r',NULL,NULL,NULL,NULL,NULL,NULL),(35,'正常\r',NULL,NULL,NULL,NULL,NULL,NULL);

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
  `childbrand` int(11) DEFAULT NULL COMMENT '子品类id',
  `number` int(11) DEFAULT NULL,
  `picture` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '主图',
  `picture2` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '副图',
  `color` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '颜色',
  `color_group` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '同组颜色',
  `price` decimal(16,2) DEFAULT NULL COMMENT '原价',
  `realprice` decimal(16,2) DEFAULT NULL COMMENT '折扣价',
  `companyid` int(11) DEFAULT NULL,
  UNIQUE KEY `companyid_2` (`companyid`,`productid`),
  PRIMARY KEY `id` (`id`),
  KEY `companyid` (`companyid`,`brandgroupid`,`childbrand`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tb_product_search` */

insert  into `tb_product_search`(`id`,`productname`,`productid`,`sizetopid`,`brandgroupid`,`childbrand`,`number`,`picture`,`picture2`,`color`,`color_group`,`companyid`) values (6,'PRADA 黑色斜跨包',2,2,2,16,8,'product/91a791ff46592e73f3b37a5e293a0033.jpg','product/ae8deb1ae3139a6e603475441d75680f.jpg',NULL,NULL,1),(7,'BOUTIQUE MOSCHINO 女士黄色长袖T恤衫',1,1,5,15,23,'product/d237442d5a8662c9a997666a652d5693.jpg','product/0820505ecba45bc993739ba4152aeecf.jpg',NULL,NULL,1);

/*Table structure for table `tb_product_size_property` */

DROP TABLE IF EXISTS `tb_product_size_property`;

CREATE TABLE `tb_product_size_property` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `productid` int(11) DEFAULT NULL,
  `sizecontentid` int(11) DEFAULT NULL,
  `propertyid` int(11) DEFAULT NULL,
  `content` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productid` (`productid`,`sizecontentid`,`propertyid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tb_product_size_property` */

insert  into `tb_product_size_property`(`id`,`productid`,`sizecontentid`,`propertyid`,`content`) values (1,1,5,12,'33'),(2,1,5,13,'23'),(3,1,1,13,'232'),(4,1,1,12,'23'),(5,1,3,13,'323'),(6,1,3,12,'23'),(7,1,4,12,'232'),(8,1,4,15,'88');

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

/*Table structure for table `tb_sales_receive` */

DROP TABLE IF EXISTS `tb_sales_receive`;

CREATE TABLE `tb_sales_receive` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `salesid` int(11) DEFAULT NULL COMMENT '销售单id',
  `currency` tinyint(4) DEFAULT NULL COMMENT '币种',
  `amount` decimal(15,2) DEFAULT NULL COMMENT '金额',
  `makestaff` int(11) DEFAULT NULL COMMENT '添加人',
  `maketime` datetime DEFAULT NULL COMMENT '添加时间',
  `confirmstaff` int(11) DEFAULT NULL COMMENT '收款确认人',
  `confirmtime` datetime DEFAULT NULL COMMENT '收款确认时间',
  `paymentdate` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '收款日期',
  `companyid` int(11) DEFAULT NULL COMMENT '公司id',
  `status` tinyint(4) DEFAULT '0' COMMENT '收款状态：0=未收到；1=已收到',
  `payment_type` tinyint(11) DEFAULT NULL COMMENT '收款类型：1=定金；2=货款',
  `memo` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `salesid` (`salesid`),
  KEY `companyid` (`companyid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tb_sales_receive` */

insert  into `tb_sales_receive`(`id`,`salesid`,`currency`,`amount`,`makestaff`,`maketime`,`confirmstaff`,`confirmtime`,`paymentdate`,`companyid`,`status`,`payment_type`,`memo`) values (1,NULL,5,'100.00',NULL,NULL,NULL,NULL,NULL,1,0,1,'定金'),(3,53,2,'66.00',1,'2019-04-11 14:21:36',NULL,NULL,'2019-04-16',1,1,2,''),(4,53,5,'200.00',1,'2019-04-11 15:25:20',NULL,NULL,'2019-04-10',1,0,2,'');

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
  `brandid` int(10) unsigned DEFAULT NULL COMMENT '品牌主键id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=438 DEFAULT CHARSET=utf8mb4 COMMENT='系列表';

/*Data for the table `tb_series` */

insert  into `tb_series`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`code`,`brandid`) values (1,'BEDFORD',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(2,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(3,'PALAZZO MEDUSA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',215),(4,'TRIPLE S',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',23),(5,'ICON',NULL,NULL,NULL,NULL,NULL,NULL,'三条卫衣，衬衫，运动裤',207),(6,'SNOW MANTRA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(7,'CROISETTE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',130),(8,'SAVAVVAH',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(9,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'PBI CAMP HOODY',36),(10,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'MYSTIQUE PARKA',36),(11,'ANDERSEN',NULL,NULL,NULL,NULL,NULL,NULL,'男',150),(12,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CHETEAU PARKA',36),(13,'MERCER',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(14,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CAMP HOODY',36),(15,'FERITO',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',141),(16,'PUMPS',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(17,'ROSSCLAIR',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(18,'SELMA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(19,'KENSINGTON ',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(20,'HIRONDELLE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(21,'REPRAT',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(22,'UNDER WEAR',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',215),(23,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'GRIZZLY SNOWSUIT',36),(24,'100MM FLAT',NULL,NULL,NULL,NULL,NULL,NULL,'100MM帮高 女鞋',34),(25,'CHEVECHE GILET',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(26,'ANET',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(27,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'COASTAL SHELL BLACK LABLE',36),(28,'GASTONET',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(29,'MAGLIA TRICOT G',NULL,NULL,NULL,NULL,NULL,NULL,'男',150),(30,'ABITO TRICOT',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(31,'MONTEBELLO',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(32,'MAJEURE',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(33,'LIRIOPE',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(34,'CHITALPA',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(35,'ABY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',47),(36,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'ROWAN PARKA',36),(37,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'SOLARIS PARKA',36),(38,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'EMORY PARKA',36),(39,'GARIBALDI',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(40,'ROSEMONT',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(41,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'LORETTE PARKA',36),(42,'PANTALONE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(43,'POINTED SLIPPERS',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(44,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HAYWARD SHELL',36),(45,'MONOGRAM DENIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',130),(46,'CHARPAL',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(47,'WYNDHAM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(48,'PALAZZO EMPIRE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',215),(49,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'BORDEN BOMBER',36),(50,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(51,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE LITE SKIRT',36),(52,'AIMEET',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(53,'CHINESE NEW YEAR',NULL,NULL,NULL,NULL,NULL,NULL,'18中国新年款',119),(54,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(55,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE LITE JACKET',36),(56,'COMPLETO MAGLIA',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(57,'SIGNATURE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',215),(58,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'WOOLFORD JACKET FUSION FIT',36),(59,'TAURUA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(60,'LOW SNEAKER',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(61,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE LITE JACKET',36),(62,'ACCENTEUR',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(63,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'SELKIRK PARKA',36),(64,'骷髅',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',170),(65,'JOYCE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(66,'MAITLAND',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(67,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'SUMMIT JACKET',36),(68,'ODILE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(69,'VAIREA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(70,'LINEN',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(71,'SANDALS',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(72,'FLAMMETTE',NULL,NULL,NULL,NULL,NULL,NULL,'女款 ',149),(73,'LORETTE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(74,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'SYLVAN VEST',36),(75,'NUAGES',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(76,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'RIDGE PANT',36),(77,'PON PON',NULL,NULL,NULL,NULL,NULL,NULL,'毛球',113),(78,'T-LINE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(79,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CARSON PARKA',36),(80,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'LODGE HOODY',36),(81,'SAINTONGE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',130),(82,'RELAXED',NULL,NULL,NULL,NULL,NULL,NULL,'EXPEDITION PARKA',36),(83,'MONTEBELLO',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(84,'CHATEAU',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(85,'ARMSTRONG HOODY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(86,'ICON',NULL,NULL,NULL,NULL,NULL,NULL,'ICON',119),(87,'56',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(88,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'LOGAN PARKA',36),(89,'POCHETTE VOYAGE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',130),(90,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'MONTEBELLO PARKA FUSION FIT',36),(91,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'MONTEBELLO PARKA',36),(92,'YEEZY BOOST',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',6),(93,'CHILLIWACK BOMBER',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(94,'MAGLIA GIROCOLL',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(95,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(96,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE PERREN JACKET',36),(97,'MADAME',NULL,NULL,NULL,NULL,NULL,NULL,'经典款',141),(98,'CAPSULE LACES',NULL,NULL,NULL,NULL,NULL,NULL,'系带',113),(99,'BAROQUE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',215),(100,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'LANGFORD PARKA BLACK LABLE',36),(101,'JULES',NULL,NULL,NULL,NULL,NULL,NULL,'男',150),(102,'GANCIO',NULL,NULL,NULL,NULL,NULL,NULL,'钱夹',197),(103,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CLARENCE COAT BLACK LABLE',36),(104,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'SKRESLET PARKA',36),(105,'MAGLIA CARDIGAN',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(106,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'LANGFORD PARKA',36),(107,'GRIVE',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(108,'I FEEL',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(109,'ACC',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',94),(110,'FREESTYLE VEST',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(111,'NEW SENECA',NULL,NULL,NULL,NULL,NULL,NULL,'男',150),(112,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(113,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'MAITLAND PARKA BLACK LABLE',36),(114,'CARSON',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(115,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'FREESTYLE VEST',36),(116,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'WOLVERINE PANTS',36),(117,'动物系列',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(118,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'THUNDER PANTS',36),(119,'HAMILTON ',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(120,'TRILLIUM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(121,'GIVRON GILBT',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(122,'NEW TOLEDO',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(123,'MINI PHD BAG',NULL,NULL,NULL,NULL,NULL,NULL,'小号',34),(124,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'SHELBURNE PARKA FUSION FIT',36),(125,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(126,'DORIST',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(127,'PUZZLE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(128,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'ROSSCLAIR PARKA BLACK LABLE',36),(129,'CHILLIWACK BOMBER',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(130,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'TUNDRA PANT',36),(131,'PTE CAR.SIMP.MNG',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',130),(132,'MAGLIA TRICOT C',NULL,NULL,NULL,NULL,NULL,NULL,'男',150),(133,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'COASTAL SHELL BLACK LABLE',36),(134,'T-LINR',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(135,'NEVERFULL',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',130),(136,'CALLIS',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(137,'HYBRIDGE LITE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(138,'SKULL',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',8),(139,'BVLGARI BVLGARI',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',35),(140,'SAVANNAH',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(141,'THE RUCKSACK ',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',32),(142,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'BEECHWOOD PARKA BLACK LABLE',36),(143,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CALLAGHAN PARKA',36),(144,'ALBERTA',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(145,'MONTBELIARD',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(146,'LOWLAND',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',204),(147,'SWIM',NULL,NULL,NULL,NULL,NULL,NULL,'泳装系列',131),(148,'IPHONE 6 PLUS',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(149,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'TIMBER SHELL JACKET',36),(150,'CROSSBODIES',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(151,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'PEMBINA COAT BLACK LABLE',36),(152,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'MACMILLAN PARKA BLACK LABLE',36),(153,'COMPL. MAGLIA C',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(154,'EXPEDITION PBI',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(155,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CARSON PARKA BLACK LABLE',36),(156,'EXPEDITION',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(157,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'PBI SHERWOOD HOODY',36),(158,'123',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',143),(159,'SLIP ON',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(160,'LODGE HOODY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(161,'GARSON CREW VEST',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(162,'CAMILLE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(163,'CHELSEA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(164,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CALLAGHAN PARKA BLACK LABLE',36),(165,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'MACMILLAN PARKA FUSION FIT',36),(166,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'BROOKVALE HOODY COAT',36),(167,'ALLISTON JACKET',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(168,'GINNY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(169,'BURNETT',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(170,'CORNER FRAME DILLON',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(171,'RELAXED',NULL,NULL,NULL,NULL,NULL,NULL,'RESOLUTE PARKA',36),(172,'SUYEN',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(173,'WYNDHAM PARKA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(174,'CHAMPERY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(175,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'BROMLEY BOMBER',36),(176,'HAMMOCK',NULL,NULL,NULL,NULL,NULL,NULL,'吊床包',126),(177,'HELLO KITTY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',178),(178,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'ELROSE PARKA BLACK LABLE',36),(179,'MOCK CROC',NULL,NULL,NULL,NULL,NULL,NULL,'手包',215),(180,'NEVERSTOP',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(181,'COCA COLA合作款',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',178),(182,'LUCY',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(183,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'BRITTANIA PARKA',36),(184,'ALICE',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(185,'FULTON ',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(186,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'RIDEAU PARKA',36),(187,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CHATEAU PARKA FUSION FIT',36),(188,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'CONSTABLE PARKA',36),(189,'LANGFORD PARKA FF',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(190,'HYPOLAIS',NULL,NULL,NULL,NULL,NULL,NULL,'女款 ',149),(191,'VICTORIA PARKA FF',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(192,'ZAPPA GALAXY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',204),(193,'BRIT',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',32),(194,'SLIPPERS',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(195,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'BRACEBRIDGE JACKET',36),(196,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE LITE HOODY',36),(197,'KOZOKO LOW',NULL,NULL,NULL,NULL,NULL,NULL,'限量',221),(198,'JONQUIERES',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(199,'EMORY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(200,'NAPPA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(201,'MACAIRE',NULL,NULL,NULL,NULL,NULL,NULL,'男',150),(202,'TIELIND',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',204),(203,'IPHONE 6',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(204,'CAPSULE CRISS CROSS',NULL,NULL,NULL,NULL,NULL,NULL,'十字绑带',113),(205,'AUBERT',NULL,NULL,NULL,NULL,NULL,NULL,'男',150),(206,'ARTHON',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(207,'ITALIAN BREAKFAST',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(208,'CAMERON',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(209,'QUINN',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(210,'LODGE JACKET FF',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(211,'ALBERIC',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(212,'FLIRTING',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(213,'RELAXED',NULL,NULL,NULL,NULL,NULL,NULL,'TUNDRA BIB OVERALL',36),(214,'CALLAGHAN',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(215,'KEY CHARMS ',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(216,'FREESTYLE CREW VEST',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(217,'GELINOTTE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(218,'CHILLIWACK BOMBER PBI',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(219,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'BRACEBRIDGE JACKET BLACK LABLE',36),(220,'NILE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',47),(221,'CITADEL',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(222,'VICTORINE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',130),(223,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'BEECHWOOD PARKA',36),(224,'GATE SMALL',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(225,'GATE MINI',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(226,'BRANDED',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(227,'BARCELONA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(228,'CONV TOTE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(229,'RELAXED',NULL,NULL,NULL,NULL,NULL,NULL,'EXPEDITION PARKA FUSION FIT',36),(230,'VARA FAMILY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',197),(231,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'SHELBURNE PARKA',36),(232,'MACCULLOCH',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(233,'POCHETTE JOUR',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',130),(234,'EXPEDITION',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(235,'APHRI',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(236,'DREW',NULL,NULL,NULL,NULL,NULL,NULL,'小猪包',47),(237,'REPEAT',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(238,'MONOGRAM CONFIDENTIAL',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',130),(239,'CORE',NULL,NULL,NULL,NULL,NULL,NULL,'核心款',119),(240,'MAGLIA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(241,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'PBI CHILLIWACK BOMBER',36),(242,'ADORNE',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(243,'CAMP HOODED JACKET FF',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(244,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'LODGE DOWN JACKET',36),(245,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'ROSSCLAIR PARKA',36),(246,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'MOUNTAINEER JACKET',36),(247,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'WINDERMERE COAT BLACK LABLE',36),(248,'MAGLIA TIRICOT G',NULL,NULL,NULL,NULL,NULL,NULL,'男',150),(249,'RELAXED',NULL,NULL,NULL,NULL,NULL,NULL,'DAWSON PARKA',36),(250,'T MINI BAG',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(251,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'LORETTE PARKA BLACK LABLE',36),(252,'LORETTE PARKA FF',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(253,'ANAGRAM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(254,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'WYNDHAM PARKA',36),(255,'LODGE HOODY PBI',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(256,'HORSEFERRY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',32),(257,'SOFT HORSE FULL GRAIN',NULL,NULL,NULL,NULL,NULL,NULL,'马皮',96),(258,'ESPADRILLAS',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(259,'PHD BLCKPACK',NULL,NULL,NULL,NULL,NULL,NULL,'大号',34),(260,'REN',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',221),(261,'K2',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(262,'JERSEY',NULL,NULL,NULL,NULL,NULL,NULL,'卫衣T恤',119),(263,'YOUTH BRITTANIA PARKA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',37),(264,'JASMINUM',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(265,'GOYA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(266,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE LITE COAT',36),(267,'CHILLIWACK',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(268,'WRONG PICTURE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',81),(269,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'BROOKVALE HOODED COAT BLACK LABLE',36),(270,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'MAITLAND PARKA',36),(271,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'RUNDLE BOMBER',36),(272,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'TRILLIUM PARKA FUSION FIT',36),(273,'BADY',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(274,'ROSSCLAIR PARKA FF',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(275,'123',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',143),(276,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE LITE JACKET BLACK LABLE',36),(277,'APHROTITI',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(278,'SALIX',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(279,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'BROOKVALE JACKET BLACK LABLE',36),(280,'NETTARE PANT',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',141),(281,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CANNINGTON PARKA BLACK LABLE',36),(282,'LONDON',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',32),(283,'VARA 1',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',197),(284,'CHATEAU',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(285,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CHETEAU PARKA BLACK LABLE',36),(286,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'LODGE DOWN VEST',36),(287,'GATE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(288,'FUR FRINGE',NULL,NULL,NULL,NULL,NULL,NULL,'毛穗',113),(289,'SPLENDEUR',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(290,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'WOOLFORD JACKET',36),(291,'FAUCON',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(292,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'BANFF PARKA',36),(293,'OTHER',NULL,NULL,NULL,NULL,NULL,NULL,'其他',119),(294,'TORCYN',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(295,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'PBI LODGE HOODY',36),(296,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'ALDERWOOD SHELL',36),(297,'RESOLUTE ',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(298,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'BRUNSWICK ANORAK SHELL',36),(299,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE SUTTON PARKA',36),(300,'MAGLIA POLO MAN',NULL,NULL,NULL,NULL,NULL,NULL,'男',150),(301,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CITADEL PARKA',36),(302,'DANAE',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(303,'BADY',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(304,'RIDEAU',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(305,'GASTON',NULL,NULL,NULL,NULL,NULL,NULL,'男',150),(306,'RELAXED',NULL,NULL,NULL,NULL,NULL,NULL,'SNOW MANTRA PARKA',36),(307,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'LYNX PARKA',36),(308,'MOKA',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(309,'KINLEY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(310,'BEECHWOOD',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(311,'CAPSULE NY - LA',NULL,NULL,NULL,NULL,NULL,NULL,'字母',113),(312,'BUTOR',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(313,'LILIA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',141),(314,'MYSTIQUE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(315,'SHELBURNE PARKA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(316,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CHELSEA PARKA BLACK LABLE',36),(317,'NEW AUBERT',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(318,'MYSTIQUE PARKA FF',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(319,'STAMP',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(320,'PERLEY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(321,'MACMILLAN PARKA FF',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(322,'VICTORIA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(323,'LANGFORD',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(324,'AKEBIA',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(325,'TESS',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',47),(326,'ABITO',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(327,'BERRETTO',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(328,'CAPSULE SMILE',NULL,NULL,NULL,NULL,NULL,NULL,'笑脸',113),(329,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'BROOKVALE HOODY',36),(330,'BLOIS',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(331,'123',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',143),(332,'100MM ALTA',NULL,NULL,NULL,NULL,NULL,NULL,'100MM内增高',34),(333,'GUITAR STRAPS',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(334,'CINDY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(335,'CAMP HOODY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(336,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'PBI BOBCAT HOODY',36),(337,'MONSTERS',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(338,'CAMUSTARS',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',212),(339,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(340,'5050',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',204),(341,'MAYA',NULL,NULL,NULL,NULL,NULL,NULL,'男',150),(342,'MAYA',NULL,NULL,NULL,NULL,NULL,NULL,'男款',149),(343,'B21 NEO',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',63),(344,'DILLON',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(345,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'BALMORAL PARKA BLACK LABLE',36),(346,'RELAXED',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(347,'INSIGNIA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',8),(348,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE SUTTON PARKA',36),(349,'YOUTH LOGAN PARKA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',37),(350,'RESERVE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',204),(351,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'ARCTIC RIGGER COVERALL',36),(352,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE LITE VEST',36),(353,'SLOAN',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(354,'GHANY',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(355,'SUTTON',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(356,'JADE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(357,'HYBRIDGE LITE HOODY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(358,'CHLOE C',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',47),(359,'FLAMENCO  ',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(360,'HOLLY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(361,'100MM',NULL,NULL,NULL,NULL,NULL,NULL,'100MM帮高',34),(362,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'SHELBURNE PARKA BLACK LABLE',36),(363,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(364,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(365,'FAYE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',47),(366,'ANIMALES',NULL,NULL,NULL,NULL,NULL,NULL,'动物系列',126),(367,'CARSON',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(368,'HERMINE',NULL,NULL,NULL,NULL,NULL,NULL,'女款 ',149),(369,'ELLISON JACKET',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(370,'CABRI HOODY',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(371,'SHELBURNE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(372,'VARA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',197),(373,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'LAMB SNOWSUIT',36),(374,'SERPENTI FOREVER',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',35),(375,'CLAPTON BPACK',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',130),(376,'ROCKSTUD',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',212),(377,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'LANGFORD PARKA FUSION FIT',36),(378,'GRENOBLE',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(379,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'KENSINGTON PARKA FUSION FIT',36),(380,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(381,'AZINZA',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(382,'NEW MAYA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(383,'T-POUCH',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',126),(384,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE LITE VEST',36),(385,'MACMILLAN',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(386,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'ROSSCLAIR PARKA FUSION FIT',36),(387,'SUYEN',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(388,'MOKA',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(389,'CHATEAU',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(390,'PEMBINA COAT BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(391,'RODEZ',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(392,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'PRITCHARD COAT BLACK LABLE',36),(393,'ROUBAIX',NULL,NULL,NULL,NULL,NULL,NULL,'婴童',150),(394,'ADDA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',141),(395,'YOUTH RUNDLE BOMBER',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',37),(396,'ANETTE',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(397,'TARTAN',NULL,NULL,NULL,NULL,NULL,NULL,'格子',113),(398,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(399,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'CAMP COAT',36),(400,'MAYA',NULL,NULL,NULL,NULL,NULL,NULL,'男款',149),(401,'ROGER',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(402,'SELMA STUD',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(403,'BLACK LABEL',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(404,'NEW MACAIRE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(405,'PAGLIACCETTO',NULL,NULL,NULL,NULL,NULL,NULL,'婴童 ',150),(406,'TEMOE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(407,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'SAVONA BOMBER BLACK LABLE',36),(408,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE LITE HOODY',36),(409,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'WHISTLER PARKA',36),(410,'BERANGER',NULL,NULL,NULL,NULL,NULL,NULL,'女',150),(411,'MONIEUX',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(412,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'SAVONA BOMBER',36),(413,'KENSINGTON',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(414,'CLAIRETTE',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(415,'MAKE UP',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',45),(416,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'PBI PUP BUNTING',36),(417,'RELAXED',NULL,NULL,NULL,NULL,NULL,NULL,'PBI EXPEDITION PARKA',36),(418,'WOOLFORD',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(419,'SATCHEL',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(420,'TAHIATA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(421,'丝绒系列',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',175),(422,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HEATHERTON PARKA',36),(423,'BETULA',NULL,NULL,NULL,NULL,NULL,NULL,'女款',149),(424,'LABBRO ',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',141),(425,'JET SET TRAVEL',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(426,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',36),(427,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'TRILLIUM PARKA',36),(428,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'PRITCHARD COAT',36),(429,'DELFINA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(430,'SACCO PORTA BEBE',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',150),(431,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'KENSINGTON PARKA',36),(432,'SLIM',NULL,NULL,NULL,NULL,NULL,NULL,'HYBRIDGE PERREN JACKET',36),(433,'SWIM',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',165),(434,'AVA',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',147),(435,'REGULAR',NULL,NULL,NULL,NULL,NULL,NULL,'CHILLIWACK BOMBER',36),(436,'PALAZZO',NULL,NULL,NULL,NULL,NULL,NULL,'NULL',215),(437,'QASA',NULL,NULL,NULL,NULL,NULL,NULL,'武士系列',221);

/*Table structure for table `tb_series2` */

DROP TABLE IF EXISTS `tb_series2`;

CREATE TABLE `tb_series2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `seriesid` int(10) unsigned DEFAULT NULL COMMENT '系列主键ID',
  `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
  `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
  `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
  `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
  `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
  `code` varchar(100) DEFAULT NULL COMMENT '中文代码名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COMMENT='子系列';

/*Data for the table `tb_series2` */

insert  into `tb_series2`(`id`,`seriesid`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`code`) values (1,2,'ALDERWOOD SHELL',NULL,NULL,NULL,NULL,NULL,NULL,''),(2,380,'ARCTIC RIGGER COVERALL',NULL,NULL,NULL,NULL,NULL,NULL,''),(3,2,'BALMORAL PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(4,2,'BANFF PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(5,2,'BEECHWOOD PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(6,2,'BEECHWOOD PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(7,380,'BORDEN BOMBER',NULL,NULL,NULL,NULL,NULL,NULL,''),(8,2,'BRACEBRIDGE JACKET',NULL,NULL,NULL,NULL,NULL,NULL,''),(9,2,'BRACEBRIDGE JACKET BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(10,380,'BRITTANIA PARKA',NULL,NULL,NULL,NULL,NULL,NULL,'YOUTH'),(11,380,'BRITTANIA PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(12,2,'BROMLEY BOMBER',NULL,NULL,NULL,NULL,NULL,NULL,''),(13,2,'BROOKVALE HOODED COAT BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(14,2,'BROOKVALE HOODY',NULL,NULL,NULL,NULL,NULL,NULL,''),(15,2,'BROOKVALE HOODY COAT',NULL,NULL,NULL,NULL,NULL,NULL,''),(16,2,'BROOKVALE JACKET',NULL,NULL,NULL,NULL,NULL,NULL,''),(17,2,'BROOKVALE JACKET BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(18,2,'BRUNSWICK ANORAK SHELL',NULL,NULL,NULL,NULL,NULL,NULL,''),(19,2,'BURNETT JACKET',NULL,NULL,NULL,NULL,NULL,NULL,''),(20,2,'CALLAGHAN PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(21,2,'CALLAGHAN PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(22,2,'CAMP COAT',NULL,NULL,NULL,NULL,NULL,NULL,''),(23,2,'CAMP HOODED JACKET',NULL,NULL,NULL,NULL,NULL,NULL,''),(24,2,'CAMP HOODY',NULL,NULL,NULL,NULL,NULL,NULL,''),(25,2,'CANNINGTON PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(26,2,'CARSON PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(27,2,'CARSON PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(28,2,'CHATEAU PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(29,2,'CHATEAU PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(30,2,'CHATEAU PARKA FUSION FIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(31,2,'CHELSEA PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(32,2,'CHELSEA PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(33,2,'CHELSEA PARKA FUSION FIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(34,380,'CHILLIWACK BOMBER',NULL,NULL,NULL,NULL,NULL,NULL,''),(35,2,'CITADEL PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(36,2,'CLARENCE COAT BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(37,2,'COASTAL SHELL BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(38,380,'CONSTABLE PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(39,346,'DAWSON PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(40,380,'EAKIN PARKA',NULL,NULL,NULL,NULL,NULL,NULL,'YOUTH'),(41,2,'ELROSE PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(42,2,'EMORY PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(43,2,'EMORY PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(44,346,'EXPEDITION PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(45,346,'EXPEDITION PARKA FUSION FIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(46,380,'FREESTYLE VEST',NULL,NULL,NULL,NULL,NULL,NULL,''),(47,2,'FREESTYLE VEST',NULL,NULL,NULL,NULL,NULL,NULL,''),(48,380,'GRIZZLY BOMBER ',NULL,NULL,NULL,NULL,NULL,NULL,'KID'),(49,380,'GRIZZLY SNOWSUIT',NULL,NULL,NULL,NULL,NULL,NULL,'KID'),(50,380,'GRIZZLY SNOWSUIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(51,2,'HAYWARD SHELL',NULL,NULL,NULL,NULL,NULL,NULL,''),(52,2,'HEATHERTON PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(53,2,'HYBRIDGE LITE COAT',NULL,NULL,NULL,NULL,NULL,NULL,''),(54,2,'HYBRIDGE LITE HOODY',NULL,NULL,NULL,NULL,NULL,NULL,''),(55,2,'HYBRIDGE LITE JACKET',NULL,NULL,NULL,NULL,NULL,NULL,''),(56,2,'HYBRIDGE LITE JACKET BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(57,2,'HYBRIDGE LITE SKIRT',NULL,NULL,NULL,NULL,NULL,NULL,''),(58,2,'HYBRIDGE LITE VEST',NULL,NULL,NULL,NULL,NULL,NULL,''),(59,2,'HYBRIDGE PERREN JACKET',NULL,NULL,NULL,NULL,NULL,NULL,''),(60,2,'HYBRIDGE SUTTON PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(61,380,'JUNIPER PARKA',NULL,NULL,NULL,NULL,NULL,NULL,'YOUTH'),(62,2,'KENSINGTON PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(63,2,'KENSINGTON PARKA FUSION FIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(64,380,'KIDS PBI BOCAT HOODY',NULL,NULL,NULL,NULL,NULL,NULL,'KID'),(65,380,'LAMB SNOWSUIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(66,380,'LAMB SNOWSUIT',NULL,NULL,NULL,NULL,NULL,NULL,'BABY'),(67,2,'LANGFORD PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(68,2,'LANGFORD PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(69,2,'LANGFORD PARKA FUSION FIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(70,2,'LODGE DOWN JACKET',NULL,NULL,NULL,NULL,NULL,NULL,''),(71,2,'LODGE DOWN VEST',NULL,NULL,NULL,NULL,NULL,NULL,''),(72,2,'LODGE HOODY',NULL,NULL,NULL,NULL,NULL,NULL,''),(73,380,'LOGAN PARKA',NULL,NULL,NULL,NULL,NULL,NULL,'YOUTH'),(74,2,'LORETTE PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(75,2,'LORETTE PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(76,380,'LUNENBERG PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(77,380,'LYNX PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(78,380,'LYNX PARKA',NULL,NULL,NULL,NULL,NULL,NULL,'KID'),(79,2,'MACMILLAN PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(80,2,'MACMILLAN PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(81,2,'MACMILLAN PARKA FUSION FIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(82,2,'MAITLAND PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(83,2,'MAITLAND PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(84,2,'MONTEBELLO PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(85,2,'MONTEBELLO PARKA FUSION FIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(86,2,'MOUNTAINEER JACKET',NULL,NULL,NULL,NULL,NULL,NULL,''),(87,380,'MYSTIQUE PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(88,380,'PBI BOBCAT HOODY',NULL,NULL,NULL,NULL,NULL,NULL,''),(89,2,'PBI CAMP HOODY',NULL,NULL,NULL,NULL,NULL,NULL,''),(90,380,'PBI CHILLIWACK BOMBER',NULL,NULL,NULL,NULL,NULL,NULL,''),(91,346,'PBI EXPEDITION PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(92,2,'PBI LODGE HOODY',NULL,NULL,NULL,NULL,NULL,NULL,''),(93,380,'PBI PUP BUNTING',NULL,NULL,NULL,NULL,NULL,NULL,''),(94,380,'PBI SHERWOOD HOODY',NULL,NULL,NULL,NULL,NULL,NULL,''),(95,2,'PEMBINA COAT BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(96,346,'PERLEY 3-IN-1 PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(97,2,'PRITCHARD COAT',NULL,NULL,NULL,NULL,NULL,NULL,''),(98,2,'PRITCHARD COAT BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(99,346,'RESOLUTE PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(100,2,'RIDEAU PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(101,2,'RIDEAU PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(102,2,'RIDGE PANT',NULL,NULL,NULL,NULL,NULL,NULL,''),(103,2,'ROSSCLAIR PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(104,2,'ROSSCLAIR PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(105,2,'ROSSCLAIR PARKA FUSION FIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(106,2,'ROWAN PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(107,380,'RUNDLE BOMBER',NULL,NULL,NULL,NULL,NULL,NULL,'YOUTH'),(108,380,'RUNDLE BOMBER',NULL,NULL,NULL,NULL,NULL,NULL,''),(109,2,'SAVONA BOMBER',NULL,NULL,NULL,NULL,NULL,NULL,''),(110,2,'SAVONA BOMBER BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(111,2,'SELKIRK PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(112,2,'SHELBURNE PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(113,2,'SHELBURNE PARKA BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(114,2,'SHELBURNE PARKA FUSION FIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(115,2,'SKRESLET PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(116,346,'SNOW MANTRA PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(117,380,'SNOWY OWL PARKA',NULL,NULL,NULL,NULL,NULL,NULL,'KID'),(118,380,'SOLARIS PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(119,2,'SUMMIT JACKET',NULL,NULL,NULL,NULL,NULL,NULL,''),(120,2,'SYLVAN VEST',NULL,NULL,NULL,NULL,NULL,NULL,''),(121,380,'THUNDER PANT',NULL,NULL,NULL,NULL,NULL,NULL,'KID'),(122,380,'THUNDER PANTS',NULL,NULL,NULL,NULL,NULL,NULL,''),(123,2,'TIMBER SHELL JACKET',NULL,NULL,NULL,NULL,NULL,NULL,''),(124,380,'TRILLIUM PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(125,380,'TRILLIUM PARKA FUSION FIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(126,346,'TUNDRA BIB OVERALL',NULL,NULL,NULL,NULL,NULL,NULL,''),(127,380,'TUNDRA PANT',NULL,NULL,NULL,NULL,NULL,NULL,''),(128,380,'VANIER VEST',NULL,NULL,NULL,NULL,NULL,NULL,'YOUTH'),(129,2,'VICTORIA PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(130,2,'WHISTLER PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(131,2,'WINDERMERE COAT BLACK LABLE',NULL,NULL,NULL,NULL,NULL,NULL,''),(132,380,'WOLVERINE PANT',NULL,NULL,NULL,NULL,NULL,NULL,'YOUTH'),(133,380,'WOLVERINE PANTS',NULL,NULL,NULL,NULL,NULL,NULL,''),(134,2,'WOOLFORD JACKET',NULL,NULL,NULL,NULL,NULL,NULL,''),(135,2,'WOOLFORD JACKET FUSION FIT',NULL,NULL,NULL,NULL,NULL,NULL,''),(136,2,'WYNDHAM PARKA',NULL,NULL,NULL,NULL,NULL,NULL,''),(137,380,'YOUTH PBI CHILLIWACK',NULL,NULL,NULL,NULL,NULL,NULL,'YOUTH'),(138,380,'YOUTH PBI EXPEDITION',NULL,NULL,NULL,NULL,NULL,NULL,'YOUTH'),(139,380,'YOUTH PBI SHERWOOD HOODY',NULL,NULL,NULL,NULL,NULL,NULL,'YOUTH');

/*Table structure for table `tb_sizecontent` */

DROP TABLE IF EXISTS `tb_sizecontent`;

CREATE TABLE `tb_sizecontent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `topid` int(10) unsigned DEFAULT NULL COMMENT '尺码组主键id',
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
  PRIMARY KEY (`id`),
  KEY `topid` (`topid`)
) ENGINE=InnoDB AUTO_INCREMENT=467 DEFAULT CHARSET=utf8mb4 COMMENT='尺码明细';

/*Data for the table `tb_sizecontent` */

insert  into `tb_sizecontent`(`id`,`topid`,`content_cn`,`content_en`,`content_hk`,`content_fr`,`content_it`,`content_sp`,`content_de`,`sortnum`,`memo_cn`,`memo_en`,`memo_hk`,`memo_fr`,`memo_it`,`memo_sp`,`memo_de`) values (1,1,'35',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,1,'35.5',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,1,'36',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,'36.5',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,1,'37',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,1,'37.5',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,1,'38',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,1,'38.5',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,1,'39',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,1,'39.5',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,1,'40',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,1,'40.5',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,1,'41',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,1,'41.5',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,1,'42',NULL,NULL,NULL,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,1,'42.5',NULL,NULL,NULL,NULL,NULL,NULL,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,1,'43',NULL,NULL,NULL,NULL,NULL,NULL,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,1,'43.5',NULL,NULL,NULL,NULL,NULL,NULL,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,1,'44',NULL,NULL,NULL,NULL,NULL,NULL,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,1,'44.5',NULL,NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,1,'45',NULL,NULL,NULL,NULL,NULL,NULL,21,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,2,'44',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,2,'46',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,2,'48',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,2,'50',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,2,'52',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,2,'54',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,2,'56',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,3,'35-37',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,3,'38-40',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,4,'20-21',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,4,'22-23',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,4,'24-25',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,4,'26-27',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,4,'28-29',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,4,'30-31',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,4,'32-33',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,4,'34-35',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,5,'27-29',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,5,'30-32',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,5,'33-35',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(42,6,'XS/S',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(43,6,'S/M',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(44,6,'M/L',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(45,6,'L/XL',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(46,6,'XXS/XS',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(47,7,'2',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(48,7,'2.5',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(49,7,'3',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(50,7,'3.5',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(51,7,'4',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(52,7,'4.5',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(53,7,'5',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(54,7,'5.5',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(55,7,'6',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(56,7,'6.5',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(57,7,'7',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(58,7,'7.5',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(59,7,'8',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(60,7,'8.5',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(61,7,'9',NULL,NULL,NULL,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(62,7,'9.5',NULL,NULL,NULL,NULL,NULL,NULL,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(63,7,'10',NULL,NULL,NULL,NULL,NULL,NULL,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(64,8,'4.5',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(65,8,'4',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(66,8,'5',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(67,8,'5.5',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(68,8,'6',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(69,8,'6.5',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(70,8,'7',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(71,8,'7.5',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(72,8,'8',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(73,8,'8.5',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(74,8,'9',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(75,8,'9.5',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(76,8,'10',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(77,8,'10.5',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78,8,'11',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(79,8,'11.5',NULL,NULL,NULL,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(80,9,'1',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(81,9,'2',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(82,9,'3',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(83,10,'60',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(84,10,'61',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(85,10,'62',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(86,10,'63',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(87,10,'64',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(88,10,'65',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(89,10,'66',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(90,12,'OVER SIZE',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(91,12,'O/S',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(92,12,'O/M',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(93,12,'O/L',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(94,14,'7A',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(95,14,'8A',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(96,14,'XXS',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(97,14,'XS',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(98,14,'S',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(99,15,'12',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(100,15,'13',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(101,15,'14',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(102,15,'15',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(103,15,'16',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(104,15,'17',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(105,15,'18',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(106,15,'19',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(107,15,'20',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(108,15,'21',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(109,15,'22',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(110,15,'23',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(111,15,'24',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(112,15,'25',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(113,16,'38.5',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(114,16,'39',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(115,16,'39.5',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(116,16,'40',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(117,16,'40.5',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(118,16,'41',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(119,16,'41.5',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(120,16,'42',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(121,16,'42.5',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(122,16,'43',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(123,16,'43.5',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(124,16,'44',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(125,16,'44.5',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(126,16,'45',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(127,16,'45.5',NULL,NULL,NULL,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(128,16,'46',NULL,NULL,NULL,NULL,NULL,NULL,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(129,17,'6M-12M',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(130,17,'12M-18M',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(131,17,'18M-24M',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(132,17,'2Y-3Y',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(133,17,'3Y-4Y',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(134,17,'4Y-5Y',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(135,17,'6Y-7Y',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(136,17,'8Y-9Y',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(137,17,'10Y-11Y',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(138,17,'12Y-14Y',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(139,18,'T1',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(140,18,'T2',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(141,18,'T3',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(142,18,'3M/6M',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(143,18,'9M/12M',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(144,18,'18M/3A',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(145,18,'2A/4A',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(146,18,'5A/8A',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(147,18,'10A/16A',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(148,19,'37',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(149,19,'38',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(150,19,'39',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(151,19,'40',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(152,19,'41',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(153,19,'42',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(154,19,'43',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(155,19,'44',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(156,19,'45',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(157,19,'46',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(158,20,'32',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(159,20,'34',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(160,20,'36',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(161,20,'38',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(162,20,'40',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(163,20,'42',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(164,20,'44',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(165,20,'46',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(166,20,'48',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(167,20,'50',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(168,21,'46',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(169,21,'48',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(170,21,'50',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(171,21,'52',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(172,21,'54',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(173,21,'56',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(174,21,'58',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(175,21,'60',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(176,23,'3.5',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(177,23,'4',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(178,23,'4.5',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(179,23,'5',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(180,23,'5.5',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(181,23,'6',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(182,23,'6.5',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(183,23,'7',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(184,23,'7.5',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(185,23,'8',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(186,23,'8.5',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(187,23,'9',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(188,23,'9.5',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(189,23,'10',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(190,23,'10.5',NULL,NULL,NULL,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(191,23,'11',NULL,NULL,NULL,NULL,NULL,NULL,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(192,23,'11.5',NULL,NULL,NULL,NULL,NULL,NULL,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(193,23,'12',NULL,NULL,NULL,NULL,NULL,NULL,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(194,24,'2-3',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(195,24,'4-5',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(196,24,'6-7',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(197,25,'UNI',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(198,27,'24',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(199,27,'25',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(200,27,'26',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(201,27,'27',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(202,27,'28',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(203,27,'29',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(204,27,'30',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(205,27,'31',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(206,27,'32',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(207,27,'33',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(208,27,'34',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(209,28,'4.5',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(210,28,'5',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(211,28,'5.5',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(212,28,'6',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(213,28,'6.5',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(214,28,'7',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(215,28,'7.5',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(216,28,'8',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(217,28,'8.5',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(218,28,'9',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(219,28,'9.5',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(220,28,'10',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(221,28,'10.5',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(222,28,'11',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(223,28,'11.5',NULL,NULL,NULL,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(224,28,'12',NULL,NULL,NULL,NULL,NULL,NULL,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(225,28,'12.5',NULL,NULL,NULL,NULL,NULL,NULL,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(226,28,'13',NULL,NULL,NULL,NULL,NULL,NULL,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(227,29,'XXXS',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(228,29,'XXS',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(229,29,'XS',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(230,29,'S',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(231,29,'M',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(232,29,'L',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(233,29,'XL',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(234,29,'XXL',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(235,29,'XXXL',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(236,29,'XXXXL',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(237,30,'46',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(238,30,'48',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(239,30,'50',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(240,30,'52',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(241,30,'54',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(242,30,'56',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(243,30,'58',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(244,30,'60',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(245,30,'62',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(246,30,'64',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(247,30,'66',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(248,30,'68',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(249,30,'70',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(250,30,'72',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(251,31,'1M',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(252,31,'3M',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(253,31,'6M',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(254,31,'9M',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(255,32,'3M',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(256,32,'6M',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(257,32,'9M',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(258,32,'12M',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(259,32,'18M',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(260,32,'2A',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(261,32,'3A',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(262,32,'4A',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(263,32,'5A',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(264,32,'6A',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(265,32,'7A',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(266,32,'8A',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(267,32,'9A',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(268,32,'10A',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(269,32,'11A',NULL,NULL,NULL,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(270,32,'12A',NULL,NULL,NULL,NULL,NULL,NULL,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(271,32,'13A',NULL,NULL,NULL,NULL,NULL,NULL,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(272,32,'14A',NULL,NULL,NULL,NULL,NULL,NULL,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(273,32,'15A',NULL,NULL,NULL,NULL,NULL,NULL,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(274,32,'16A',NULL,NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(275,33,'2A',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(276,33,'3A',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(277,33,'4A',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(278,33,'5A',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(279,33,'6A',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(280,34,'12M',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(281,34,'18M',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(282,34,'24M',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(283,35,'36',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(284,35,'36.5',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(285,35,'37',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(286,35,'37.5',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(287,35,'38',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(288,35,'38.5',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(289,35,'39',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(290,35,'39.5',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(291,35,'40',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(292,35,'40.5',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(293,35,'41',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(294,35,'41.5',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(295,35,'42',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(296,35,'42.5',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(297,35,'43',NULL,NULL,NULL,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(298,35,'43.5',NULL,NULL,NULL,NULL,NULL,NULL,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(299,35,'44',NULL,NULL,NULL,NULL,NULL,NULL,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(300,35,'44.5',NULL,NULL,NULL,NULL,NULL,NULL,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(301,35,'45',NULL,NULL,NULL,NULL,NULL,NULL,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(302,37,'1M-3M',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(303,37,'3M-6M',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(304,37,'6M-9M',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(305,37,'9M-12M',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(306,37,'12M-18M',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(307,37,'18M-24M',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(308,37,'2A',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(309,37,'3A',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(310,38,'42',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(311,38,'44',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(312,38,'46',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(313,38,'48',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(314,38,'50',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(315,38,'52',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(316,38,'54',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(317,38,'56',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(318,38,'58',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(319,38,'60',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(320,39,'I',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(321,39,'II',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(322,39,'III',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(323,39,'IV',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(324,39,'V',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(325,39,'VI',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(326,39,'VII',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(327,39,'VIII',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(328,40,'3',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(329,40,'3.5',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(330,40,'4',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(331,40,'4.5',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(332,40,'5',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(333,40,'5.5',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(334,40,'6',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(335,40,'6.5',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(336,40,'7',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(337,40,'7.5',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(338,40,'8',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(339,40,'8.5',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(340,40,'9',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(341,40,'9.5',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(342,40,'10',NULL,NULL,NULL,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(343,41,'9',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(344,41,'11',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(345,41,'13',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(346,41,'15',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(347,41,'16',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(348,41,'17',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(349,41,'18',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(350,41,'19',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(351,41,'20',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(352,41,'21',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(353,41,'22',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(354,41,'23',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(355,41,'24',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(356,41,'25',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(357,42,'3436',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(358,42,'3739',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(359,42,'4042',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(360,42,'4345',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(361,43,'28',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(362,43,'29',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(363,43,'30',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(364,43,'31',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(365,43,'32',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(366,43,'33',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(367,43,'34',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(368,43,'35',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(369,43,'36',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(370,43,'37',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(371,43,'38',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(372,43,'39',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(373,43,'40',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(374,44,'44',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(375,44,'46',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(376,44,'48',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(377,44,'50',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(378,44,'52',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(379,44,'54',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(380,44,'56',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(381,44,'58',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(382,44,'60',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(383,44,'62',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(384,45,'SS',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(385,45,'S',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(386,45,'M',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(387,45,'L',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(388,46,'1',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(389,46,'2',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(390,46,'3',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(391,47,'26',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(392,47,'27',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(393,47,'28',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(394,47,'29',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(395,47,'30',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(396,47,'31',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(397,47,'32',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(398,47,'33',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(399,47,'34',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(400,47,'35',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(401,47,'36',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(402,47,'37',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(403,47,'38',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(404,47,'39',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(405,47,'40',NULL,NULL,NULL,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(406,48,'XXS',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(407,48,'XS',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(408,48,'S',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(409,48,'M',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(410,48,'L',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(411,48,'XL',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(412,48,'XXL',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(413,48,'XXXL',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(414,49,'65',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(415,49,'70',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(416,49,'75',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(417,49,'80',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(418,49,'85',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(419,49,'90',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(420,49,'95',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(421,49,'100',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(422,49,'105',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(423,49,'110',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(424,49,'115',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(425,49,'120',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(426,49,'125',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(427,50,'34',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(428,50,'34.5',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(429,50,'35',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(430,50,'35.5',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(431,50,'36',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(432,50,'36.5',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(433,50,'37',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(434,50,'37.5',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(435,50,'38',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(436,50,'38.5',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(437,50,'39',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(438,50,'39.5',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(439,50,'40',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(440,50,'40.5',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(441,50,'41',NULL,NULL,NULL,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(442,51,'00',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(443,51,'0',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(444,51,'1',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(445,51,'2',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(446,51,'3',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(447,51,'4',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(448,51,'5',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(449,51,'6',NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(450,51,'7',NULL,NULL,NULL,NULL,NULL,NULL,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(451,51,'8',NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(452,51,'9',NULL,NULL,NULL,NULL,NULL,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(453,51,'10',NULL,NULL,NULL,NULL,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(454,51,'11',NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(455,51,'12',NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(456,52,'1M',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(457,52,'3M',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(458,52,'6M',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(459,52,'9M',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(460,52,'12M',NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(461,52,'18M',NULL,NULL,NULL,NULL,NULL,NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(462,52,'24M',NULL,NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(463,53,'M',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(464,53,'L',NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(465,53,'XL',NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(466,53,'XXL',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COMMENT='尺码组';

/*Data for the table `tb_sizetop` */

insert  into `tb_sizetop`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`,`code`) values (1,'鞋 男女通用',NULL,NULL,NULL,NULL,NULL,NULL,'P'),(2,'禁用   上装/男',NULL,NULL,NULL,NULL,NULL,NULL,'D'),(3,'女鞋分段码',NULL,NULL,NULL,NULL,NULL,NULL,'XX CHIARA.F'),(4,'童装20-35',NULL,NULL,NULL,NULL,NULL,NULL,'TZ NUNUNU'),(5,'儿童袜子',NULL,NULL,NULL,NULL,NULL,NULL,'TZ BURBERRY'),(6,'服装XS/S-M/L',NULL,NULL,NULL,NULL,NULL,NULL,'FZT3'),(7,'鞋类/男女',NULL,NULL,NULL,NULL,NULL,NULL,'Q'),(8,'禁用2',NULL,NULL,NULL,NULL,NULL,NULL,'XXT2'),(9,'下装',NULL,NULL,NULL,NULL,NULL,NULL,'T'),(10,'眼镜B',NULL,NULL,NULL,NULL,NULL,NULL,'PS2'),(11,'服装JP-S/FR-S-JP-3XL/FR-XL',NULL,NULL,NULL,NULL,NULL,NULL,'FZT6'),(12,'上装/男女',NULL,NULL,NULL,NULL,NULL,NULL,'N'),(13,'Y-3帽子',NULL,NULL,NULL,NULL,NULL,NULL,'PS6'),(14,'童装7A-S',NULL,NULL,NULL,NULL,NULL,NULL,'TZ Y.VERSACE'),(15,'儿童鞋12-22',NULL,NULL,NULL,NULL,NULL,NULL,'TZ XX1'),(16,'男鞋38-46',NULL,NULL,NULL,NULL,NULL,NULL,'XXM1'),(17,'童装6M-14Y',NULL,NULL,NULL,NULL,NULL,NULL,'TZ NUNUNU'),(18,'儿童帽子',NULL,NULL,NULL,NULL,NULL,NULL,'TZ MZ'),(19,'衬衫37-46',NULL,NULL,NULL,NULL,NULL,NULL,'FZT2'),(20,'女装32-50',NULL,NULL,NULL,NULL,NULL,NULL,'FZW2'),(21,'下装/男裤',NULL,NULL,NULL,NULL,NULL,NULL,'O'),(22,'服装FR34-FR48',NULL,NULL,NULL,NULL,NULL,NULL,'FZT7'),(23,'男女鞋(禁用)',NULL,NULL,NULL,NULL,NULL,NULL,'ADIDAS'),(24,'童装尺码',NULL,NULL,NULL,NULL,NULL,NULL,'TZ CANADA GOOSE KID'),(25,'均码',NULL,NULL,NULL,NULL,NULL,NULL,'JM'),(26,'童装8A-14A',NULL,NULL,NULL,NULL,NULL,NULL,'TZ Y.VERSACE'),(27,'女裤24-34',NULL,NULL,NULL,NULL,NULL,NULL,'FZW1'),(28,'男鞋4.5-13',NULL,NULL,NULL,NULL,NULL,NULL,'XXM2'),(29,'服装XXXS-XXXL',NULL,NULL,NULL,NULL,NULL,NULL,'FZT1'),(30,'眼镜',NULL,NULL,NULL,NULL,NULL,NULL,'PS4'),(31,'童装1M-9M',NULL,NULL,NULL,NULL,NULL,NULL,'TZ Y.VERSACE'),(32,'童装3M-16A',NULL,NULL,NULL,NULL,NULL,NULL,'TZ KENZO'),(33,'童装2A-6A',NULL,NULL,NULL,NULL,NULL,NULL,'TZ Y.VERSACE'),(34,'童装12M-24M',NULL,NULL,NULL,NULL,NULL,NULL,'TZ Y.VERSACE'),(35,'禁用1',NULL,NULL,NULL,NULL,NULL,NULL,'XXT1'),(36,'Y.VERSACE童装',NULL,NULL,NULL,NULL,NULL,NULL,'TZ Y.VERSACE'),(37,'MONCLER 童装',NULL,NULL,NULL,NULL,NULL,NULL,'TZ MONCLER'),(38,'男装44-60',NULL,NULL,NULL,NULL,NULL,NULL,'FZM2'),(39,'服装I-VIII',NULL,NULL,NULL,NULL,NULL,NULL,'FZT4'),(40,'女鞋4-10',NULL,NULL,NULL,NULL,NULL,NULL,'XXW2'),(41,'手链/戒指',NULL,NULL,NULL,NULL,NULL,NULL,'PS1'),(42,'袜子',NULL,NULL,NULL,NULL,NULL,NULL,'PS5'),(43,'男裤28-38',NULL,NULL,NULL,NULL,NULL,NULL,'FZM1'),(44,'帽子（儿童）',NULL,NULL,NULL,NULL,NULL,NULL,'X'),(45,'帽子',NULL,NULL,NULL,NULL,NULL,NULL,'PS2'),(46,'帽子',NULL,NULL,NULL,NULL,NULL,NULL,'U'),(47,'儿童鞋 26-35',NULL,NULL,NULL,NULL,NULL,NULL,'TZ XX2'),(48,'下装/裤',NULL,NULL,NULL,NULL,NULL,NULL,'R'),(49,'腰带',NULL,NULL,NULL,NULL,NULL,NULL,'PS3'),(50,'女鞋34-43',NULL,NULL,NULL,NULL,NULL,NULL,'XXW1'),(51,'服装00-10',NULL,NULL,NULL,NULL,NULL,NULL,'FZT5'),(52,'童装1M-24M',NULL,NULL,NULL,NULL,NULL,NULL,'TZ A.JUNIOR'),(53,'童装M-XXL',NULL,NULL,NULL,NULL,NULL,NULL,'TZ Y.VERSACE');

/*Table structure for table `tb_supplier` */

DROP TABLE IF EXISTS `tb_supplier`;

CREATE TABLE `tb_supplier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `suppliername` varchar(50) DEFAULT NULL COMMENT '名称',
  `englishname` varchar(50) DEFAULT NULL COMMENT '英文名称',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `phone` varchar(30) DEFAULT NULL COMMENT '电话',
  `zipcode` varchar(20) DEFAULT NULL COMMENT '邮编',
  `email` varchar(200) DEFAULT NULL COMMENT 'email',
  `countrycity` varchar(50) DEFAULT NULL,
  `suppliercode` varchar(50) DEFAULT NULL COMMENT '编码',
  `fax` varchar(50) DEFAULT NULL COMMENT '传真',
  `suppliertype` tinyint(1) DEFAULT NULL COMMENT '0-供货商 1-报关行 2-供应商 3-承运人 4-客户 5-品牌商',
  `memo` text COMMENT '备注',
  `nickname` varchar(100) DEFAULT NULL COMMENT '昵称',
  `legal` varchar(50) DEFAULT NULL COMMENT '法人',
  `website` varchar(150) DEFAULT NULL COMMENT '公司网址',
  `registeredcapital` varchar(100) DEFAULT NULL COMMENT '注册资本',
  `businesslicense` varchar(30) DEFAULT NULL COMMENT '营业执照',
  `heading` varchar(20) DEFAULT NULL COMMENT '税号',
  `createtime` datetime DEFAULT NULL COMMENT '生成时间',
  `companyid` int(11) DEFAULT NULL COMMENT '公司id',
  `qq` varchar(150) DEFAULT NULL COMMENT 'QQ',
  `weixin` varchar(150) DEFAULT NULL COMMENT '微信',
  `alipay` varchar(150) DEFAULT NULL COMMENT '支付宝',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

/*Data for the table `tb_supplier` */

insert  into `tb_supplier`(`id`,`suppliername`,`englishname`,`address`,`phone`,`zipcode`,`email`,`countrycity`,`suppliercode`,`fax`,`suppliertype`,`memo`,`nickname`,`legal`,`website`,`registeredcapital`,`businesslicense`,`heading`,`createtime`,`companyid`,`qq`,`weixin`,`alipay`) values (1,'GIANO S.N.C.','66','56','',NULL,NULL,'11','GIANO S.N.C.','',4,'66','11','','','','','',NULL,NULL,'','44',''),(2,'顺丰速递','','rr','',NULL,NULL,'1','007','',0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'菜鸟物流','','','',NULL,NULL,'2','003','',0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'GILMAR','','','',NULL,NULL,'2','GILMAR','',0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'LEMCO SRL','','','',NULL,NULL,'','LEMCO SRL','',0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'VASA-FASHION SRL','','','',NULL,NULL,'','VASA-FASHION SRL','',0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

/*Data for the table `tb_ulnarinch` */

insert  into `tb_ulnarinch`(`id`,`name_cn`,`name_en`,`name_hk`,`name_fr`,`name_it`,`name_sp`,`name_de`) values (16,'1.0CM\r',NULL,NULL,NULL,NULL,NULL,NULL),(17,'2.0CM\r',NULL,NULL,NULL,NULL,NULL,NULL),(18,'3.0CM\r',NULL,NULL,NULL,NULL,NULL,NULL),(19,'3.2CM\r',NULL,NULL,NULL,NULL,NULL,NULL),(20,'3.3CM\r',NULL,NULL,NULL,NULL,NULL,NULL),(21,'3.5CM\r',NULL,NULL,NULL,NULL,NULL,NULL),(22,'3.8CM\r',NULL,NULL,NULL,NULL,NULL,NULL),(23,'4.0CM\r',NULL,NULL,NULL,NULL,NULL,NULL),(24,'4.5CM\r',NULL,NULL,NULL,NULL,NULL,NULL),(25,'7.0CM\r',NULL,NULL,NULL,NULL,NULL,NULL),(26,'I-PHONE 8\r',NULL,NULL,NULL,NULL,NULL,NULL),(27,'I-PHONE 8PLUS\r',NULL,NULL,NULL,NULL,NULL,NULL),(28,'I-PHONE X\r',NULL,NULL,NULL,NULL,NULL,NULL),(29,'OVER SIZE\r',NULL,NULL,NULL,NULL,NULL,NULL),(30,'REGULAR正常\r',NULL,NULL,NULL,NULL,NULL,NULL),(31,'RELAXED宽松\r',NULL,NULL,NULL,NULL,NULL,NULL),(32,'SILM修身\r',NULL,NULL,NULL,NULL,NULL,NULL),(33,'长款\r',NULL,NULL,NULL,NULL,NULL,NULL),(34,'长袖\r',NULL,NULL,NULL,NULL,NULL,NULL),(35,'大号\r',NULL,NULL,NULL,NULL,NULL,NULL),(36,'短款\r',NULL,NULL,NULL,NULL,NULL,NULL),(37,'短袖\r',NULL,NULL,NULL,NULL,NULL,NULL),(38,'均码\r',NULL,NULL,NULL,NULL,NULL,NULL),(39,'迷你MINI\r',NULL,NULL,NULL,NULL,NULL,NULL),(40,'小号SMALL\r',NULL,NULL,NULL,NULL,NULL,NULL),(41,'中号',NULL,NULL,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tb_warehouse_user` */

insert  into `tb_warehouse_user`(`id`,`warehouseid`,`userid`,`warehouseroleid`,`create_time`,`companyid`) values (2,2,1,2,NULL,1),(3,5,1,2,NULL,1),(5,2,2,NULL,NULL,1),(6,1,1,1,NULL,1);

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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
