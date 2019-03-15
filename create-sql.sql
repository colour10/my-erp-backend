-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-03-13 17:04:52
-- 服务器版本： 5.7.19-log
-- PHP 版本： 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `erp`
--

-- --------------------------------------------------------

--
-- 表的结构 `ac_invoice`
--

CREATE TABLE `ac_invoice` (
                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `invoicedate` datetime DEFAULT NULL,
                            `supplierid` int(10) UNSIGNED DEFAULT NULL,
                            `paycusid` int(10) UNSIGNED DEFAULT NULL,
                            `rate` decimal(16,9) DEFAULT NULL,
                            `departmentid` int(10) UNSIGNED DEFAULT NULL,
                            `userid` int(10) UNSIGNED DEFAULT NULL,
                            `currencyid` int(10) UNSIGNED DEFAULT NULL,
                            `sum` decimal(16,9) DEFAULT NULL,
                            `dsum` decimal(16,9) DEFAULT NULL,
                            `ssum` decimal(16,9) DEFAULT NULL,
                            `invoicesum` decimal(16,9) DEFAULT NULL,
                            `exchangrate` decimal(16,9) DEFAULT NULL,
                            `invoiceno` varchar(20) DEFAULT NULL,
                            `memo` varchar(100) DEFAULT NULL,
                            `checkstatus` varchar(1) DEFAULT NULL COMMENT '0-未审核，1-已审核',
                            `checkid` int(10) UNSIGNED DEFAULT NULL,
                            `glstatus` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='货款发票主表';

-- --------------------------------------------------------

--
-- 表的结构 `ac_invoice_fee`
--

CREATE TABLE `ac_invoice_fee` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `invoicedate` datetime DEFAULT NULL,
                                `supplierid` int(10) UNSIGNED DEFAULT NULL,
                                `paycusid` int(10) UNSIGNED DEFAULT NULL,
                                `rate` decimal(16,9) DEFAULT NULL,
                                `departmentid` int(10) UNSIGNED DEFAULT NULL,
                                `userid` int(10) UNSIGNED DEFAULT NULL,
                                `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                `exchangrate` decimal(16,9) DEFAULT NULL,
                                `invoiceno` varchar(20) DEFAULT NULL,
                                `memo` text,
                                `checkstatus` varchar(1) DEFAULT NULL COMMENT '0-未审核，1-已审核',
                                `checkid` int(10) UNSIGNED DEFAULT NULL,
                                `glstatus` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='运费发票主表';

-- --------------------------------------------------------

--
-- 表的结构 `ac_invoice_fee_detail`
--

CREATE TABLE `ac_invoice_fee_detail` (
                                       `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                       `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `invoiceid` int(10) UNSIGNED DEFAULT NULL,
                                       `feeid` int(10) UNSIGNED DEFAULT NULL,
                                       `number` int(11) DEFAULT NULL,
                                       `feesum` decimal(16,9) DEFAULT NULL,
                                       `feecurrencyid` int(10) UNSIGNED NOT NULL,
                                       `invoicecurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                       `invoicesum` decimal(16,9) DEFAULT NULL,
                                       `memo` varchar(100) DEFAULT NULL,
                                       `companyid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='运费发票明细表';

-- --------------------------------------------------------

--
-- 表的结构 `ac_invoice_prepay`
--

CREATE TABLE `ac_invoice_prepay` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `invoicedate` datetime DEFAULT NULL,
                                   `supplierid` int(10) UNSIGNED DEFAULT NULL,
                                   `paycusid` int(10) UNSIGNED DEFAULT NULL,
                                   `rate` decimal(16,9) DEFAULT NULL,
                                   `departmentid` int(10) UNSIGNED DEFAULT NULL,
                                   `userid` int(10) UNSIGNED DEFAULT NULL,
                                   `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                   `sum` decimal(16,9) DEFAULT NULL,
                                   `invoicesum` decimal(16,9) DEFAULT NULL,
                                   `exchangrate` decimal(16,9) DEFAULT NULL,
                                   `invoiceno` varchar(20) DEFAULT NULL,
                                   `memo` varchar(100) DEFAULT NULL,
                                   `checkstatus` varchar(1) DEFAULT NULL COMMENT '0-未审核，1-已审核',
                                   `checkid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订金发票主表';

-- --------------------------------------------------------

--
-- 表的结构 `ac_kmyue_wb`
--

CREATE TABLE `ac_kmyue_wb` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `ztid` int(10) UNSIGNED DEFAULT NULL,
                             `kmid` int(10) UNSIGNED DEFAULT NULL,
                             `nf` varchar(4) DEFAULT NULL,
                             `yf` varchar(2) DEFAULT NULL,
                             `currencyid` int(10) UNSIGNED DEFAULT NULL,
                             `hl` decimal(19,6) DEFAULT NULL,
                             `qche` decimal(19,6) DEFAULT NULL,
                             `jffshe` decimal(19,6) DEFAULT NULL,
                             `dffshe` decimal(19,6) DEFAULT NULL,
                             `qmye` decimal(19,6) DEFAULT NULL,
                             `qcher` decimal(19,6) DEFAULT NULL,
                             `jffsher` decimal(19,6) DEFAULT NULL,
                             `dffsher` decimal(19,6) DEFAULT NULL,
                             `qmyer` decimal(19,6) DEFAULT NULL,
                             `cus_id` int(10) UNSIGNED DEFAULT NULL,
                             `dep_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='科目余额表';

-- --------------------------------------------------------

--
-- 表的结构 `ac_pzhb`
--

CREATE TABLE `ac_pzhb` (
                         `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                         `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                         `ztid` int(10) UNSIGNED DEFAULT NULL,
                         `pzh_flow_type` varchar(2) DEFAULT NULL COMMENT 'th-调汇 jz-结转 fy-费用 fp-发票\r\n            hk-回款 zz-转账 cx-冲销 zc-正常\r\n            zj-折旧',
                         `pzh_type_id` int(10) UNSIGNED DEFAULT NULL,
                         `nf` varchar(5) DEFAULT NULL,
                         `yf` varchar(2) DEFAULT NULL,
                         `rq` varchar(2) DEFAULT NULL,
                         `pzh` varchar(50) DEFAULT NULL,
                         `zy` varchar(1000) DEFAULT NULL,
                         `lrrid` int(10) UNSIGNED DEFAULT NULL,
                         `shr` int(10) UNSIGNED DEFAULT NULL,
                         `shrq` datetime DEFAULT NULL,
                         `jzr` int(10) UNSIGNED DEFAULT NULL,
                         `jzrq` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='凭证表';

-- --------------------------------------------------------

--
-- 表的结构 `ac_pzhh`
--

CREATE TABLE `ac_pzhh` (
                         `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                         `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                         `ztid` int(10) UNSIGNED DEFAULT NULL,
                         `nf` varchar(5) DEFAULT NULL,
                         `yf` varchar(2) DEFAULT NULL,
                         `rq` varchar(2) DEFAULT NULL,
                         `pzh_type_id` int(10) UNSIGNED DEFAULT NULL,
                         `pzhxh` int(11) DEFAULT NULL,
                         `yjbz` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='凭证号表';

-- --------------------------------------------------------

--
-- 表的结构 `ac_pzhmxb`
--

CREATE TABLE `ac_pzhmxb` (
                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                           `pzhid` int(10) UNSIGNED DEFAULT NULL,
                           `kmid` int(10) UNSIGNED DEFAULT NULL,
                           `currencyid` int(10) UNSIGNED DEFAULT NULL,
                           `hl` decimal(19,6) DEFAULT NULL,
                           `jffshe` decimal(19,6) DEFAULT NULL,
                           `jffsher` decimal(19,6) DEFAULT NULL,
                           `dffshe` decimal(19,6) DEFAULT NULL,
                           `dffsher` decimal(19,6) DEFAULT NULL,
                           `zy` varchar(1000) DEFAULT NULL,
                           `sourse` varchar(1) DEFAULT NULL COMMENT 'y-业务 c-普通 r-回款',
                           `cus_id` int(10) UNSIGNED DEFAULT NULL,
                           `dep_id` int(10) UNSIGNED DEFAULT NULL,
                           `jord` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='凭证明细表';

-- --------------------------------------------------------

--
-- 表的结构 `ac_sf_sheet`
--

CREATE TABLE `ac_sf_sheet` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `sheetno` varchar(50) DEFAULT NULL,
                             `sorf` varchar(1) DEFAULT NULL,
                             `companyid` int(10) UNSIGNED DEFAULT NULL,
                             `currencyid` int(10) UNSIGNED DEFAULT NULL,
                             `sum` decimal(16,9) DEFAULT NULL,
                             `creator` int(10) UNSIGNED DEFAULT NULL,
                             `date` datetime DEFAULT NULL,
                             `memo` text,
                             `externalno` varchar(50) DEFAULT NULL,
                             `header` text,
                             `originalsum` decimal(16,9) DEFAULT NULL,
                             `adjustsum` decimal(16,9) DEFAULT NULL,
                             `iskp` varchar(1) DEFAULT NULL,
                             `kpid` int(10) UNSIGNED DEFAULT NULL,
                             `refundmemo` text,
                             `isrefund` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='对账费单';

-- --------------------------------------------------------

--
-- 表的结构 `ac_sf_sheet_code`
--

CREATE TABLE `ac_sf_sheet_code` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `year` varchar(5) DEFAULT NULL,
                                  `code` varchar(10) DEFAULT NULL,
                                  `month` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='对账单号表';

-- --------------------------------------------------------

--
-- 表的结构 `ac_sf_sheet_refund`
--

CREATE TABLE `ac_sf_sheet_refund` (
                                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `sheetid` int(10) UNSIGNED DEFAULT NULL,
                                    `refunddate` datetime DEFAULT NULL,
                                    `refundbank` varchar(100) DEFAULT NULL,
                                    `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                    `refundsum` decimal(10,2) DEFAULT NULL,
                                    `invoiceno` varchar(100) DEFAULT NULL,
                                    `memo` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='对账单回款情况';

-- --------------------------------------------------------

--
-- 表的结构 `dd_arrivalnotice`
--

CREATE TABLE `dd_arrivalnotice` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `corderid` int(10) UNSIGNED DEFAULT NULL,
                                  `orderno` varchar(50) DEFAULT NULL,
                                  `makedate` datetime DEFAULT NULL,
                                  `makestaff` int(10) UNSIGNED DEFAULT NULL,
                                  `supplierid` int(10) UNSIGNED NOT NULL,
                                  `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                  `total` decimal(16,9) DEFAULT NULL,
                                  `isstatus` varchar(1) DEFAULT NULL,
                                  `memo` varchar(200) DEFAULT NULL,
                                  `auditstaff` int(10) UNSIGNED DEFAULT NULL,
                                  `auditdate` datetime DEFAULT NULL,
                                  `auditstatus` varchar(1) DEFAULT NULL,
                                  `exchangerate` decimal(16,9) DEFAULT NULL,
                                  `brandid` int(10) UNSIGNED DEFAULT NULL,
                                  `finalsupplierid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='到货单';

-- --------------------------------------------------------

--
-- 表的结构 `dd_arrivalnotice_detail`
--

CREATE TABLE `dd_arrivalnotice_detail` (
                                         `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                         `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                         `sys_create_date` datetime NOT NULL,
                                         `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                         `sys_modify_date` datetime NOT NULL,
                                         `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                         `sys_delete_date` datetime DEFAULT NULL,
                                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                         `arrivalid` int(10) UNSIGNED DEFAULT NULL,
                                         `detailid` int(10) UNSIGNED DEFAULT NULL,
                                         `productid` int(10) UNSIGNED DEFAULT NULL,
                                         `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                         `number` int(11) DEFAULT NULL,
                                         `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                         `price` decimal(16,9) DEFAULT NULL,
                                         `cost` decimal(16,9) DEFAULT NULL,
                                         `cjj` decimal(16,9) DEFAULT NULL,
                                         `yj` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='到货单明细';

-- --------------------------------------------------------

--
-- 表的结构 `dd_confirmorder`
--

CREATE TABLE `dd_confirmorder` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `orderno` varchar(50) DEFAULT NULL,
                                 `makedate` datetime DEFAULT NULL,
                                 `makestaff` int(10) UNSIGNED DEFAULT NULL,
                                 `supplierid` int(10) UNSIGNED NOT NULL,
                                 `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                 `total` decimal(16,9) DEFAULT NULL,
                                 `isstatus` varchar(1) DEFAULT NULL COMMENT '0-在途未入库，1-已入库，2-已备货未发出',
                                 `memo` varchar(200) DEFAULT NULL,
                                 `brandid` int(10) UNSIGNED DEFAULT NULL,
                                 `season` int(10) UNSIGNED DEFAULT NULL,
                                 `seasontype` varchar(1) DEFAULT NULL COMMENT '0-pre ,1-main ,2-fashion show',
                                 `auditstaff` int(10) UNSIGNED DEFAULT NULL,
                                 `auditdate` datetime DEFAULT NULL,
                                 `auditstatus` varchar(1) DEFAULT NULL,
                                 `exchangerate` decimal(16,9) DEFAULT NULL,
                                 `finalsupplierid` int(10) UNSIGNED DEFAULT NULL,
                                 `flightno` varchar(50) DEFAULT NULL,
                                 `flightdate` datetime DEFAULT NULL,
                                 `arrivaldate` datetime DEFAULT NULL,
                                 `mblno` varchar(50) DEFAULT NULL,
                                 `hblno` varchar(50) DEFAULT NULL,
                                 `dispatchport` varchar(50) DEFAULT NULL,
                                 `deliveryport` varchar(50) DEFAULT NULL,
                                 `transcompany` int(10) UNSIGNED DEFAULT NULL,
                                 `isexamination` varchar(1) DEFAULT NULL,
                                 `examinationresult` varchar(50) DEFAULT NULL,
                                 `clearancedate` datetime DEFAULT NULL,
                                 `pickingdate` datetime DEFAULT NULL,
                                 `motortransportpool` varchar(50) DEFAULT NULL,
                                 `warehouseid` int(10) UNSIGNED DEFAULT NULL,
                                 `ctns` decimal(16,9) DEFAULT NULL,
                                 `kgs` decimal(16,9) DEFAULT NULL,
                                 `cbm` decimal(16,9) DEFAULT NULL,
                                 `issjyh` varchar(1) DEFAULT NULL,
                                 `sellerid` int(10) UNSIGNED NOT NULL,
                                 `sjyhresult` varchar(50) DEFAULT NULL,
                                 `buyerid` int(10) UNSIGNED NOT NULL,
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
                                 `dd_company` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='发货单';

-- --------------------------------------------------------

--
-- 表的结构 `dd_corderdetails`
--

CREATE TABLE `dd_corderdetails` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `corderid` int(10) UNSIGNED DEFAULT NULL,
                                  `detailid` int(10) UNSIGNED DEFAULT NULL,
                                  `productid` int(10) UNSIGNED DEFAULT NULL,
                                  `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                  `number` int(11) DEFAULT NULL,
                                  `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                  `price` decimal(16,9) DEFAULT NULL,
                                  `cost` decimal(16,9) DEFAULT NULL,
                                  `actualnumber` int(11) DEFAULT NULL,
                                  `isstatus` varchar(1) DEFAULT NULL COMMENT '0-未完成\r\n            1-完成',
                                  `containerno` varchar(500) DEFAULT NULL,
                                  `cjj` decimal(16,9) DEFAULT NULL,
                                  `yj` decimal(16,9) DEFAULT NULL,
                                  `size` varchar(50) DEFAULT NULL,
                                  `weight` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='发货单明细';

-- --------------------------------------------------------

--
-- 表的结构 `dd_corder_ctn`
--

CREATE TABLE `dd_corder_ctn` (
                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `corderid` int(10) UNSIGNED DEFAULT NULL,
                               `ctnno` varchar(50) DEFAULT NULL,
                               `length` decimal(16,9) DEFAULT NULL,
                               `width` decimal(16,9) DEFAULT NULL,
                               `height` decimal(16,9) DEFAULT NULL,
                               `weight` decimal(16,9) DEFAULT NULL,
                               `cbm` decimal(16,9) DEFAULT NULL,
                               `memo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='发货单装箱信息';

-- --------------------------------------------------------

--
-- 表的结构 `dd_corder_temp`
--

CREATE TABLE `dd_corder_temp` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `corderid` int(10) UNSIGNED DEFAULT NULL,
                                `cdetailid` int(10) UNSIGNED DEFAULT NULL,
                                `detailid` int(10) UNSIGNED DEFAULT NULL,
                                `productid` int(10) UNSIGNED DEFAULT NULL,
                                `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                `anumber` int(11) DEFAULT NULL,
                                `tm` varchar(50) DEFAULT NULL,
                                `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                `price` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='发货单入库快照';

-- --------------------------------------------------------

--
-- 表的结构 `dd_fee`
--

CREATE TABLE `dd_fee` (
                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                        `sys_create_date` datetime NOT NULL,
                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                        `sys_modify_date` datetime NOT NULL,
                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                        `sys_delete_date` datetime DEFAULT NULL,
                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                        `dd_id` int(10) UNSIGNED DEFAULT NULL,
                        `feeid` int(10) UNSIGNED DEFAULT NULL,
                        `currencyid` int(10) UNSIGNED DEFAULT NULL,
                        `unitprice` decimal(10,2) DEFAULT NULL,
                        `amount` decimal(10,2) DEFAULT NULL,
                        `sum` decimal(10,2) DEFAULT NULL,
                        `companyid` int(10) UNSIGNED DEFAULT NULL,
                        `sorf` varchar(1) DEFAULT NULL COMMENT 's-收 f-付',
                        `applyflag` varchar(1) DEFAULT NULL COMMENT '0-未申请 1-已申请',
                        `applyid` int(10) UNSIGNED DEFAULT NULL,
                        `goodstotal` decimal(10,2) DEFAULT NULL,
                        `deduct` decimal(10,2) DEFAULT NULL,
                        `actuallypaid` decimal(10,2) DEFAULT NULL,
                        `amortized` tinyint(4) DEFAULT NULL,
                        `exchangerate` decimal(16,9) DEFAULT NULL,
                        `standarysum` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='供应链费用';

-- --------------------------------------------------------

--
-- 表的结构 `dd_order`
--

CREATE TABLE `dd_order` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `bussinesstypeid` int(10) UNSIGNED DEFAULT NULL,
                          `makedate` datetime DEFAULT NULL,
                          `makestaff` int(10) UNSIGNED DEFAULT NULL,
                          `supplierid` int(10) UNSIGNED NOT NULL,
                          `finalsupplierid` int(10) UNSIGNED DEFAULT NULL,
                          `bookingid` int(10) UNSIGNED DEFAULT NULL,
                          `agentid` int(10) UNSIGNED DEFAULT NULL,
                          `purchasedept` int(10) UNSIGNED DEFAULT NULL,
                          `brandid` int(10) UNSIGNED NOT NULL,
                          `orderno` varchar(50) DEFAULT NULL,
                          `total` decimal(16,9) DEFAULT NULL,
                          `currencyid` int(10) UNSIGNED DEFAULT NULL,
                          `auditstaff` int(10) UNSIGNED DEFAULT NULL,
                          `auditdate` datetime DEFAULT NULL,
                          `ordercode` varchar(50) DEFAULT NULL,
                          `worldordercode` varchar(50) DEFAULT NULL,
                          `auditstatus` varchar(1) DEFAULT NULL,
                          `isstatus` varchar(1) DEFAULT NULL COMMENT '0-未完结 1-已完结',
                          `form` varchar(2) DEFAULT NULL COMMENT 'f-女款，m-男款,fm男款/女款',
                          `memo` varchar(200) DEFAULT NULL,
                          `contactor` varchar(200) DEFAULT NULL,
                          `ourcontactor` varchar(200) DEFAULT NULL,
                          `season` int(10) UNSIGNED DEFAULT NULL,
                          `seasontype` varchar(1) DEFAULT NULL COMMENT '0-pre ,1-main ,2-fashion show',
                          `invoiceno` varchar(50) DEFAULT NULL,
                          `ddtype` varchar(1) DEFAULT NULL COMMENT '0-客户订单，1-品牌订单',
                          `morderid` int(10) UNSIGNED DEFAULT NULL,
                          `exchangerate` decimal(16,9) DEFAULT NULL,
                          `bussinesstype` varchar(1) DEFAULT NULL COMMENT '0-期货 1-现货',
                          `zkl` decimal(16,9) DEFAULT NULL,
                          `tsl` decimal(16,9) DEFAULT NULL,
                          `property` varchar(1) DEFAULT NULL COMMENT '0-自采 1-代销'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订单主表';

-- --------------------------------------------------------

--
-- 表的结构 `dd_ordercode`
--

CREATE TABLE `dd_ordercode` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `year` varchar(5) DEFAULT NULL,
                              `code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订单号表';

-- --------------------------------------------------------

--
-- 表的结构 `dd_orderdetails`
--

CREATE TABLE `dd_orderdetails` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `orderid` int(10) UNSIGNED DEFAULT NULL,
                                 `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                 `number` int(11) DEFAULT NULL,
                                 `productid` int(10) UNSIGNED DEFAULT NULL,
                                 `currencyid` int(10) UNSIGNED DEFAULT NULL,
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
                                 `thattimestock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订单明细';

-- --------------------------------------------------------

--
-- 表的结构 `dd_quotation`
--

CREATE TABLE `dd_quotation` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `supplierid` int(10) UNSIGNED DEFAULT NULL,
                              `form` varchar(1) DEFAULT NULL COMMENT 'f-女款，m-男款',
                              `year_season` varchar(10) DEFAULT NULL,
                              `rate` decimal(16,9) DEFAULT NULL,
                              `memo` varchar(1000) DEFAULT NULL,
                              `filename` varchar(100) DEFAULT NULL,
                              `s_filename` varchar(100) DEFAULT NULL COMMENT '在服务器上的文件名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='报价单主表';

-- --------------------------------------------------------

--
-- 表的结构 `dd_quotation_detail`
--

CREATE TABLE `dd_quotation_detail` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `quotationid` int(10) UNSIGNED DEFAULT NULL,
                                     `productid` int(10) UNSIGNED DEFAULT NULL,
                                     `ordernumber` int(11) DEFAULT NULL,
                                     `pic1` varchar(200) DEFAULT NULL,
                                     `pic2` varchar(200) DEFAULT NULL,
                                     `pic3` varchar(200) DEFAULT NULL,
                                     `pic4` varchar(200) DEFAULT NULL,
                                     `price` decimal(16,9) DEFAULT NULL,
                                     `item` varchar(100) DEFAULT NULL,
                                     `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                     `memo` varchar(1000) DEFAULT NULL,
                                     `savesize` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='报价单明细表';

-- --------------------------------------------------------

--
-- 表的结构 `if_cfashion`
--

CREATE TABLE `if_cfashion` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `creationtime` datetime DEFAULT NULL,
                             `productid` int(10) UNSIGNED DEFAULT NULL,
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
                             `sizeid` int(10) UNSIGNED DEFAULT NULL,
                             `sku` varchar(50) DEFAULT NULL,
                             `stockchange` varchar(500) DEFAULT NULL,
                             `imglist` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='迷橙接口数据表';

-- --------------------------------------------------------

--
-- 表的结构 `if_exception`
--

CREATE TABLE `if_exception` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `productid` int(10) UNSIGNED DEFAULT NULL,
                              `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                              `asacode` varchar(50) DEFAULT NULL,
                              `exception` char(1) DEFAULT NULL,
                              `sizeid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='库存变动日志数据表';

-- --------------------------------------------------------

--
-- 表的结构 `if_imgorder`
--

CREATE TABLE `if_imgorder` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `productid` int(10) UNSIGNED DEFAULT NULL,
                             `ifid` int(10) UNSIGNED DEFAULT NULL COMMENT '0-添加 1-修改',
                             `numorder` int(11) DEFAULT NULL,
                             `imgname` char(1) DEFAULT NULL,
                             `imgsize` varchar(50) DEFAULT NULL,
                             `imgtype` varchar(50) DEFAULT NULL COMMENT '缩略图，详细图'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='上传图片顺序';

-- --------------------------------------------------------

--
-- 表的结构 `if_jingdong`
--

CREATE TABLE `if_jingdong` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `creationtime` datetime DEFAULT NULL,
                             `productid` int(10) UNSIGNED DEFAULT NULL,
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
                             `sizeid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='京东接口数据表';

-- --------------------------------------------------------

--
-- 表的结构 `if_meilihui`
--

CREATE TABLE `if_meilihui` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `creationtime` datetime DEFAULT NULL,
                             `productid` int(10) UNSIGNED DEFAULT NULL,
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
                             `sizeid` int(10) UNSIGNED DEFAULT NULL,
                             `sku` varchar(50) DEFAULT NULL,
                             `stockchange` varchar(500) DEFAULT NULL,
                             `imglist` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='魅力惠接口数据表';

-- --------------------------------------------------------

--
-- 表的结构 `if_meixi`
--

CREATE TABLE `if_meixi` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `creationtime` datetime DEFAULT NULL,
                          `productid` int(10) UNSIGNED DEFAULT NULL,
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
                          `imglist` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='美西接口数据表';

-- --------------------------------------------------------

--
-- 表的结构 `if_ofashion`
--

CREATE TABLE `if_ofashion` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `creationtime` datetime DEFAULT NULL,
                             `productid` int(10) UNSIGNED DEFAULT NULL,
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
                             `sizeid` int(10) UNSIGNED DEFAULT NULL,
                             `sku` varchar(50) DEFAULT NULL,
                             `stockchange` varchar(500) DEFAULT NULL,
                             `imglist` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='迷橙接口数据表';

-- --------------------------------------------------------

--
-- 表的结构 `if_shangpin`
--

CREATE TABLE `if_shangpin` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `creationtime` datetime DEFAULT NULL,
                             `productid` int(10) UNSIGNED DEFAULT NULL,
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
                             `sizeid` int(10) UNSIGNED DEFAULT NULL,
                             `sku` varchar(50) DEFAULT NULL,
                             `stockchange` varchar(500) DEFAULT NULL,
                             `imglist` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='尚品接口数据表';

-- --------------------------------------------------------

--
-- 表的结构 `if_shangpin_direct`
--

CREATE TABLE `if_shangpin_direct` (
                                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `creationtime` datetime DEFAULT NULL,
                                    `productid` int(10) UNSIGNED DEFAULT NULL,
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
                                    `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                    `sku` varchar(50) DEFAULT NULL,
                                    `stockchange` varchar(500) DEFAULT NULL,
                                    `imglist` text,
                                    `categoryno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='尚品直发接口数据表';

-- --------------------------------------------------------

--
-- 表的结构 `if_siku`
--

CREATE TABLE `if_siku` (
                         `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                         `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                         `creationtime` datetime DEFAULT NULL,
                         `productid` int(10) UNSIGNED DEFAULT NULL,
                         `sizeid` int(10) UNSIGNED DEFAULT NULL,
                         `salesid` int(10) UNSIGNED DEFAULT NULL,
                         `operationtype` int(11) DEFAULT NULL COMMENT '0-添加 1-修改',
                         `returnstate` int(11) DEFAULT NULL,
                         `returntext` text,
                         `sourcefunction` varchar(50) DEFAULT NULL,
                         `sku` varchar(50) DEFAULT NULL,
                         `stockchange` int(11) DEFAULT NULL,
                         `imglist` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='美西接口数据表';

-- --------------------------------------------------------

--
-- 表的结构 `if_sxdzb`
--

CREATE TABLE `if_sxdzb` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `productid` int(10) UNSIGNED DEFAULT NULL,
                          `zpid` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='珍品上传商品对照';

-- --------------------------------------------------------

--
-- 表的结构 `if_zhenpin`
--

CREATE TABLE `if_zhenpin` (
                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `creationtime` datetime DEFAULT NULL,
                            `productid` int(10) UNSIGNED DEFAULT NULL,
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
                            `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='珍品接口数据表';

-- --------------------------------------------------------

--
-- 表的结构 `if_zouxiu`
--

CREATE TABLE `if_zouxiu` (
                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                           `creationtime` datetime DEFAULT NULL,
                           `productid` int(10) UNSIGNED DEFAULT NULL,
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
                           `imglist` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='美西接口数据表';

-- --------------------------------------------------------

--
-- 表的结构 `link_actual_to_productstock`
--

CREATE TABLE `link_actual_to_productstock` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `productstockid` int(10) UNSIGNED DEFAULT NULL,
                                             `actualid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='实盘单到库存之间的记录';

-- --------------------------------------------------------

--
-- 表的结构 `link_barcode_to_size`
--

CREATE TABLE `link_barcode_to_size` (
                                      `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                      `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                      `productid` int(10) UNSIGNED DEFAULT NULL,
                                      `barcode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

-- --------------------------------------------------------

--
-- 表的结构 `link_brandgroup_to_supplier`
--

CREATE TABLE `link_brandgroup_to_supplier` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `supplierid` int(10) UNSIGNED DEFAULT NULL,
                                             `brandgroupid` int(10) UNSIGNED DEFAULT NULL,
                                             `decade` int(10) UNSIGNED DEFAULT NULL,
                                             `markup` decimal(10,2) DEFAULT NULL,
                                             `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                             `sum` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='供货商品类连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_brand_to_brandgroup`
--

CREATE TABLE `link_brand_to_brandgroup` (
                                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                          `sys_create_date` datetime NOT NULL,
                                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                          `sys_modify_date` datetime NOT NULL,
                                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                          `sys_delete_date` datetime DEFAULT NULL,
                                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                          `brandid` int(10) UNSIGNED DEFAULT NULL,
                                          `groupid` int(10) UNSIGNED DEFAULT NULL,
                                          `brandgroupid` int(10) UNSIGNED DEFAULT NULL,
                                          `note` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

-- --------------------------------------------------------

--
-- 表的结构 `link_brand_to_discount`
--

CREATE TABLE `link_brand_to_discount` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `brandid` int(10) UNSIGNED DEFAULT NULL,
                                        `decade` int(10) UNSIGNED DEFAULT NULL,
                                        `groupid` int(10) UNSIGNED DEFAULT NULL,
                                        `brandgroupid` int(10) UNSIGNED DEFAULT NULL,
                                        `discount` decimal(10,2) DEFAULT NULL,
                                        `gender` varchar(1) DEFAULT NULL COMMENT '0-女式 1-男士 2-中性',
                                        `note` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品牌出厂价折扣';

-- --------------------------------------------------------

--
-- 表的结构 `link_brand_to_priced`
--

CREATE TABLE `link_brand_to_priced` (
                                      `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                      `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `brandtypeid` int(10) UNSIGNED DEFAULT NULL,
                                      `priced` decimal(19,6) DEFAULT NULL,
                                      `brandid` int(10) UNSIGNED DEFAULT NULL,
                                      `priceid` int(10) UNSIGNED DEFAULT NULL,
                                      `pricedmark` varchar(1) DEFAULT NULL COMMENT '0 - 欧洲零售价\r\n            1 - 欧洲出厂价',
                                      `symbol` varchar(2) DEFAULT NULL,
                                      `isrounded` varchar(1) DEFAULT NULL COMMENT '0- 0-20 取0 ,21-70 取50,71-99 取100\r\n            1-0-1取0，1-6取5，6-9取10\r\n            2.不取整',
                                      `decade` int(10) UNSIGNED DEFAULT NULL,
                                      `currencyid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

-- --------------------------------------------------------

--
-- 表的结构 `link_cdetail_to_ddetail`
--

CREATE TABLE `link_cdetail_to_ddetail` (
                                         `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                         `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                         `sys_create_date` datetime NOT NULL,
                                         `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                         `sys_modify_date` datetime NOT NULL,
                                         `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                         `sys_delete_date` datetime DEFAULT NULL,
                                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                         `cdetailid` int(10) UNSIGNED DEFAULT NULL,
                                         `ddetailid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 发货单明细 to 报关明细';

-- --------------------------------------------------------

--
-- 表的结构 `link_childbrand_to_execution`
--

CREATE TABLE `link_childbrand_to_execution` (
                                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                              `sys_create_date` datetime NOT NULL,
                                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                              `sys_modify_date` datetime NOT NULL,
                                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                              `sys_delete_date` datetime DEFAULT NULL,
                                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                              `childbrandid` int(10) UNSIGNED DEFAULT NULL,
                                              `executionid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

-- --------------------------------------------------------

--
-- 表的结构 `link_childbrand_to_innards`
--

CREATE TABLE `link_childbrand_to_innards` (
                                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                            `sys_create_date` datetime NOT NULL,
                                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                            `sys_modify_date` datetime NOT NULL,
                                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                            `sys_delete_date` datetime DEFAULT NULL,
                                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                            `childbrandid` int(10) UNSIGNED DEFAULT NULL,
                                            `innardsid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 子品类 to 内部结构';

-- --------------------------------------------------------

--
-- 表的结构 `link_childbrand_to_material`
--

CREATE TABLE `link_childbrand_to_material` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `childbrandid` int(10) UNSIGNED DEFAULT NULL,
                                             `materialid` int(10) UNSIGNED DEFAULT NULL,
                                             `hgcode` varchar(50) DEFAULT NULL,
                                             `taxrate` decimal(16,9) DEFAULT NULL,
                                             `sex` varchar(1) DEFAULT NULL COMMENT '0-女式 1-男士(中性也算男士)',
                                             `isfj` varchar(1) DEFAULT NULL COMMENT '0-否 1-法检'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 子品类 to 材质';

-- --------------------------------------------------------

--
-- 表的结构 `link_childbrand_to_outinnards`
--

CREATE TABLE `link_childbrand_to_outinnards` (
                                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                               `sys_create_date` datetime NOT NULL,
                                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                               `sys_modify_date` datetime NOT NULL,
                                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                               `sys_delete_date` datetime DEFAULT NULL,
                                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                               `childbrandid` int(10) UNSIGNED DEFAULT NULL,
                                               `outinnardsid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 子品类 to 外部结构';

-- --------------------------------------------------------

--
-- 表的结构 `link_childbrand_to_safety`
--

CREATE TABLE `link_childbrand_to_safety` (
                                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `childbrandid` int(10) UNSIGNED DEFAULT NULL,
                                           `safetyid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

-- --------------------------------------------------------

--
-- 表的结构 `link_color_to_brand`
--

CREATE TABLE `link_color_to_brand` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `colorid` int(10) UNSIGNED DEFAULT NULL,
                                     `brandid` int(10) UNSIGNED DEFAULT NULL,
                                     `colorname` varchar(50) DEFAULT NULL,
                                     `colorcode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 颜色模板与品牌链接的关系';

-- --------------------------------------------------------

--
-- 表的结构 `link_contacts_to_supplier`
--

CREATE TABLE `link_contacts_to_supplier` (
                                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `supplierid` int(10) UNSIGNED DEFAULT NULL,
                                           `companycontactsid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='表暂时未使用';

-- --------------------------------------------------------

--
-- 表的结构 `link_ctn_to_cdetail`
--

CREATE TABLE `link_ctn_to_cdetail` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `corderdetailid` int(10) UNSIGNED DEFAULT NULL,
                                     `ctnid` int(10) UNSIGNED DEFAULT NULL,
                                     `sum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='装箱单 发货单明细 连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_data_to_file`
--

CREATE TABLE `link_data_to_file` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `dataid` int(10) UNSIGNED DEFAULT NULL COMMENT '上传附件的相关数据id，例如：订单id等',
                                   `picturename` varchar(500) DEFAULT NULL,
                                   `picturepath` varchar(500) DEFAULT NULL COMMENT '带文件名，取文件完整路径=ftp+/+路径',
                                   `servername` varchar(100) DEFAULT NULL,
                                   `filetype` varchar(2) DEFAULT NULL COMMENT '0.-一般文件\r\n            1-商标注册证\r\n            2.品牌方发票\r\n            3.供货商发票\r\n            4.供货商装箱单\r\n            5.运单\r\n            6.付款水单\r\n            7.进口报关单\r\n            8.商检放行单\r\n            9.中国关税单\r\n            10.中国增值税单\r\n            11.品牌检测报告\r\n            12.报关文件\r\n            13.供货商合同\r\n            14.付汇水单'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 数据 to 文件（上传附件）';

-- --------------------------------------------------------

--
-- 表的结构 `link_department_to_salesport`
--

CREATE TABLE `link_department_to_salesport` (
                                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                              `sys_create_date` datetime NOT NULL,
                                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                              `sys_modify_date` datetime NOT NULL,
                                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                              `sys_delete_date` datetime DEFAULT NULL,
                                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                              `departmentid` int(10) UNSIGNED DEFAULT NULL,
                                              `sportid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口部门连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_detail_to_detail`
--

CREATE TABLE `link_detail_to_detail` (
                                       `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                       `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `pdetailid` int(10) UNSIGNED DEFAULT NULL,
                                       `cdetailid` int(10) UNSIGNED DEFAULT NULL,
                                       `sum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品牌订单 客户订单连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_distribute_to_cdetail`
--

CREATE TABLE `link_distribute_to_cdetail` (
                                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                            `sys_create_date` datetime NOT NULL,
                                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                            `sys_modify_date` datetime NOT NULL,
                                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                            `sys_delete_date` datetime DEFAULT NULL,
                                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                            `corderdetailid` int(10) UNSIGNED DEFAULT NULL,
                                            `dstributeid` int(10) UNSIGNED DEFAULT NULL,
                                            `sum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='分货单 发货单明细 连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_group_to_navigation`
--

CREATE TABLE `link_group_to_navigation` (
                                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                          `groupid` int(10) UNSIGNED DEFAULT NULL,
                                          `navigationid` int(10) UNSIGNED DEFAULT NULL,
                                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                          `sys_create_date` datetime NOT NULL,
                                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                          `sys_modify_date` datetime NOT NULL,
                                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                          `sys_delete_date` datetime DEFAULT NULL,
                                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='组导航连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_invoice_to_order`
--

CREATE TABLE `link_invoice_to_order` (
                                       `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                       `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `invoiceid` int(10) UNSIGNED DEFAULT NULL,
                                       `orderid` int(10) UNSIGNED DEFAULT NULL,
                                       `ordersum` decimal(19,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 运费发票 to 发货单';

-- --------------------------------------------------------

--
-- 表的结构 `link_invoice_to_requisition`
--

CREATE TABLE `link_invoice_to_requisition` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `invoiceid` int(10) UNSIGNED DEFAULT NULL,
                                             `requisitionid` int(10) UNSIGNED DEFAULT NULL,
                                             `type` varchar(1) DEFAULT NULL COMMENT '0-按金额 1-按件数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 运费发票 to 调拨单';

-- --------------------------------------------------------

--
-- 表的结构 `link_invoice_to_warehousing`
--

CREATE TABLE `link_invoice_to_warehousing` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `invoiceid` int(10) UNSIGNED DEFAULT NULL,
                                             `warehousingid` int(10) UNSIGNED DEFAULT NULL,
                                             `type` varchar(1) DEFAULT NULL COMMENT '0-按金额 1-按件数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 运费发票 to 入库单';

-- --------------------------------------------------------

--
-- 表的结构 `link_kp_to_store`
--

CREATE TABLE `link_kp_to_store` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `kpid` int(10) UNSIGNED DEFAULT NULL,
                                  `productstockid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='开票库存链接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_prep_to_productstock`
--

CREATE TABLE `link_prep_to_productstock` (
                                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `productstockid` int(10) UNSIGNED DEFAULT NULL,
                                           `prepid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预盘单到库存之间的记录';

-- --------------------------------------------------------

--
-- 表的结构 `link_pricelist_to_salesport`
--

CREATE TABLE `link_pricelist_to_salesport` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `pricelistid` int(10) UNSIGNED DEFAULT NULL,
                                             `sportid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 价格单 to 销售端口';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_closedway`
--

CREATE TABLE `link_product_to_closedway` (
                                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `productid` int(10) UNSIGNED DEFAULT NULL,
                                           `closedwayid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 闭合方式';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_decade`
--

CREATE TABLE `link_product_to_decade` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `productid` int(10) UNSIGNED DEFAULT NULL,
                                        `decadeid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品表连接 年代季节';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_dscrb`
--

CREATE TABLE `link_product_to_dscrb` (
                                       `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                       `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `productid` int(10) UNSIGNED DEFAULT NULL,
                                       `dscrbid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品表连接 商品描述';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_marketprice`
--

CREATE TABLE `link_product_to_marketprice` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `productid` int(10) UNSIGNED DEFAULT NULL,
                                             `price` decimal(16,9) DEFAULT NULL,
                                             `priceresource` char(1) DEFAULT NULL,
                                             `historyflag` varchar(1) DEFAULT NULL COMMENT '0-当前记录 1-历史记录',
                                             `rate` decimal(16,9) DEFAULT NULL,
                                             `applyprice` decimal(16,9) DEFAULT NULL,
                                             `applystatus` varchar(1) DEFAULT NULL COMMENT '0-已申请\r\n            1-审批通过\r\n            2-驳回',
                                             `priceresourceid` int(10) UNSIGNED DEFAULT NULL,
                                             `applydate` datetime DEFAULT NULL,
                                             `replydate` datetime DEFAULT NULL,
                                             `priceid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品表连接 市场价格';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_material`
--

CREATE TABLE `link_product_to_material` (
                                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                          `sys_create_date` datetime NOT NULL,
                                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                          `sys_modify_date` datetime NOT NULL,
                                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                          `sys_delete_date` datetime DEFAULT NULL,
                                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                          `productid` int(10) UNSIGNED DEFAULT NULL,
                                          `materialid` int(10) UNSIGNED DEFAULT NULL,
                                          `percentage` varchar(50) DEFAULT NULL,
                                          `note` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 材质';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_material2`
--

CREATE TABLE `link_product_to_material2` (
                                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `productid` int(10) UNSIGNED DEFAULT NULL,
                                           `materialid` int(10) UNSIGNED DEFAULT NULL,
                                           `percentage` varchar(50) DEFAULT NULL,
                                           `note` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 材质2';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_materislstatus`
--

CREATE TABLE `link_product_to_materislstatus` (
                                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                                `sys_create_date` datetime NOT NULL,
                                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                                `sys_modify_date` datetime NOT NULL,
                                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                                `sys_delete_date` datetime DEFAULT NULL,
                                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                                `productid` int(10) UNSIGNED DEFAULT NULL,
                                                `materislstatusid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品表与材质状态';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_occasions`
--

CREATE TABLE `link_product_to_occasions` (
                                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `productid` int(10) UNSIGNED DEFAULT NULL,
                                           `occasionsid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 场合风格';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_origin`
--

CREATE TABLE `link_product_to_origin` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `productid` int(10) UNSIGNED DEFAULT NULL,
                                        `originid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品表连接 产地';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_outproductinnards`
--

CREATE TABLE `link_product_to_outproductinnards` (
                                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                                   `sys_create_date` datetime NOT NULL,
                                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                                   `sys_modify_date` datetime NOT NULL,
                                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                                   `sys_delete_date` datetime DEFAULT NULL,
                                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                                   `productid` int(10) UNSIGNED DEFAULT NULL,
                                                   `innardsid` int(10) UNSIGNED DEFAULT NULL,
                                                   `sum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 外部结构';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_picture`
--

CREATE TABLE `link_product_to_picture` (
                                         `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                         `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                         `sys_create_date` datetime NOT NULL,
                                         `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                         `sys_modify_date` datetime NOT NULL,
                                         `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                         `sys_delete_date` datetime DEFAULT NULL,
                                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                         `productid` int(10) UNSIGNED DEFAULT NULL,
                                         `pictureid` int(10) UNSIGNED DEFAULT NULL,
                                         `picturetype` varchar(500) DEFAULT NULL,
                                         `sizetype` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='图片表';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_picture_ftp`
--

CREATE TABLE `link_product_to_picture_ftp` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `productid` int(10) UNSIGNED DEFAULT NULL,
                                             `picturename` varchar(500) DEFAULT NULL,
                                             `picturepath` varchar(1000) DEFAULT NULL,
                                             `picturesize` varchar(1) DEFAULT NULL COMMENT '1-750*750\r\n            2-800*800\r\n            3-1200*1200',
                                             `uploadflag` varchar(1) DEFAULT NULL COMMENT '0-无需上传，1-需要上传'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to ftp图片';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_price`
--

CREATE TABLE `link_product_to_price` (
                                       `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                       `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `priceid` int(10) UNSIGNED DEFAULT NULL,
                                       `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                       `price` decimal(10,2) DEFAULT NULL,
                                       `productid` int(10) UNSIGNED DEFAULT NULL,
                                       `jsfs` varchar(100) DEFAULT NULL,
                                       `baseprice` decimal(10,2) DEFAULT NULL,
                                       `exchangerate` decimal(16,9) DEFAULT NULL,
                                       `rate` decimal(10,2) DEFAULT NULL,
                                       `symbol` varchar(1) DEFAULT NULL,
                                       `lockstatus` varchar(1) DEFAULT NULL COMMENT '0-未锁定 1-锁定'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 商品销售价格(国内外零售价、批发价格)';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_price2`
--

CREATE TABLE `link_product_to_price2` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `priceid` int(10) UNSIGNED DEFAULT NULL,
                                        `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                        `price` decimal(10,2) DEFAULT NULL,
                                        `productid` int(10) UNSIGNED DEFAULT NULL,
                                        `jsfs` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 商品销售价格(国内外零售价、批发价格)';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_price_history`
--

CREATE TABLE `link_product_to_price_history` (
                                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                               `sys_create_date` datetime NOT NULL,
                                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                               `sys_modify_date` datetime NOT NULL,
                                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                               `sys_delete_date` datetime DEFAULT NULL,
                                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                               `priceid` int(10) UNSIGNED DEFAULT NULL,
                                               `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                               `price` decimal(10,2) DEFAULT NULL,
                                               `productid` int(10) UNSIGNED DEFAULT NULL,
                                               `actiontype` varchar(1) DEFAULT NULL COMMENT '0-添加 1-修改',
                                               `baseprice` decimal(10,2) DEFAULT NULL,
                                               `exchangerate` decimal(16,9) DEFAULT NULL,
                                               `rate` decimal(10,2) DEFAULT NULL,
                                               `symbol` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 商品销售价格(国内外零售价、批发价格) 历史记录';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_productinnards`
--

CREATE TABLE `link_product_to_productinnards` (
                                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                                `sys_create_date` datetime NOT NULL,
                                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                                `sys_modify_date` datetime NOT NULL,
                                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                                `sys_delete_date` datetime DEFAULT NULL,
                                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                                `productid` int(10) UNSIGNED DEFAULT NULL,
                                                `innardsid` int(10) UNSIGNED DEFAULT NULL,
                                                `sum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 内部结构';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_productparts`
--

CREATE TABLE `link_product_to_productparts` (
                                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                              `sys_create_date` datetime NOT NULL,
                                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                              `sys_modify_date` datetime NOT NULL,
                                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                              `sys_delete_date` datetime DEFAULT NULL,
                                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                              `productid` int(10) UNSIGNED DEFAULT NULL,
                                              `partsid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 附带配件';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_salesnature`
--

CREATE TABLE `link_product_to_salesnature` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `productid` int(10) UNSIGNED DEFAULT NULL,
                                             `salesnatureid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售性质连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_salesport`
--

CREATE TABLE `link_product_to_salesport` (
                                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `productid` int(10) UNSIGNED DEFAULT NULL,
                                           `sportid` int(10) UNSIGNED DEFAULT NULL,
                                           `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                           `price` decimal(16,9) DEFAULT NULL,
                                           `discount` decimal(16,9) DEFAULT NULL,
                                           `sellspotname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口商品连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_salesport_history`
--

CREATE TABLE `link_product_to_salesport_history` (
                                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                                   `sys_create_date` datetime NOT NULL,
                                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                                   `sys_modify_date` datetime NOT NULL,
                                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                                   `sys_delete_date` datetime DEFAULT NULL,
                                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                                   `productid` int(10) UNSIGNED DEFAULT NULL,
                                                   `sportid` int(10) UNSIGNED DEFAULT NULL,
                                                   `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                                   `price` decimal(16,9) DEFAULT NULL,
                                                   `actiontype` char(10) DEFAULT NULL COMMENT '0-添加\r\n            1-修改',
                                                   `discount` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口商品连接 历史记录表';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_size`
--

CREATE TABLE `link_product_to_size` (
                                      `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                      `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `productid` int(10) UNSIGNED DEFAULT NULL,
                                      `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                      `jdcode` varchar(50) DEFAULT NULL,
                                      `spotid` int(10) UNSIGNED DEFAULT NULL COMMENT '空就是京东'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 尺码';

-- --------------------------------------------------------

--
-- 表的结构 `link_product_to_washinginstructions`
--

CREATE TABLE `link_product_to_washinginstructions` (
                                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                                     `sys_create_date` datetime NOT NULL,
                                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                                     `sys_modify_date` datetime NOT NULL,
                                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                                     `sys_delete_date` datetime DEFAULT NULL,
                                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                                     `productid` int(10) UNSIGNED DEFAULT NULL,
                                                     `washinginstructionsid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 商品 to 洗涤标准';

-- --------------------------------------------------------

--
-- 表的结构 `link_pzh_to_invoice`
--

CREATE TABLE `link_pzh_to_invoice` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `invoiceid` int(10) UNSIGNED DEFAULT NULL,
                                     `pzhid` int(10) UNSIGNED DEFAULT NULL,
                                     `invoicecurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                     `invoicesum` decimal(16,9) DEFAULT NULL,
                                     `pzhcurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                     `pzhsum` decimal(16,9) DEFAULT NULL,
                                     `exchangerate` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 凭证表 to 普通发票';

-- --------------------------------------------------------

--
-- 表的结构 `link_pzh_to_invoicefee`
--

CREATE TABLE `link_pzh_to_invoicefee` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `invoiceid` int(10) UNSIGNED DEFAULT NULL,
                                        `pzhid` int(10) UNSIGNED DEFAULT NULL,
                                        `invoicecurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                        `invoicesum` decimal(16,9) DEFAULT NULL,
                                        `pzhcurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                        `pzhsum` decimal(16,9) DEFAULT NULL,
                                        `exchangerate` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 凭证表 to 运费发票';

-- --------------------------------------------------------

--
-- 表的结构 `link_pzh_to_order`
--

CREATE TABLE `link_pzh_to_order` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `orderid` int(10) UNSIGNED DEFAULT NULL,
                                   `pzhid` int(10) UNSIGNED DEFAULT NULL,
                                   `ordercurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                   `ordersum` decimal(16,9) DEFAULT NULL,
                                   `pzhcurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                   `pzhsum` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 凭证表 to 订单';

-- --------------------------------------------------------

--
-- 表的结构 `link_pzh_to_sales`
--

CREATE TABLE `link_pzh_to_sales` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `salesid` int(10) UNSIGNED DEFAULT NULL,
                                   `pzhid` int(10) UNSIGNED DEFAULT NULL,
                                   `salescurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                   `salessum` decimal(16,9) DEFAULT NULL,
                                   `pzhcurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                   `pzhsum` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 凭证表 to 对账单（回款）';

-- --------------------------------------------------------

--
-- 表的结构 `link_pzh_to_sales_trans`
--

CREATE TABLE `link_pzh_to_sales_trans` (
                                         `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                         `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                         `sys_create_date` datetime NOT NULL,
                                         `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                         `sys_modify_date` datetime NOT NULL,
                                         `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                         `sys_delete_date` datetime DEFAULT NULL,
                                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                         `salesid` int(10) UNSIGNED DEFAULT NULL,
                                         `pzhid` int(10) UNSIGNED DEFAULT NULL,
                                         `salescurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                         `salessum` decimal(16,9) DEFAULT NULL,
                                         `pzhcurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                         `pzhsum` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 凭证表 to 对账单（转账）';

-- --------------------------------------------------------

--
-- 表的结构 `link_pzh_to_warehousing_fee`
--

CREATE TABLE `link_pzh_to_warehousing_fee` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `warehousingfeeid` int(10) UNSIGNED DEFAULT NULL,
                                             `pzhid` int(10) UNSIGNED DEFAULT NULL,
                                             `warehousingfeecurrencyid` int(10) UNSIGNED NOT NULL,
                                             `warehousingfeesum` decimal(16,9) DEFAULT NULL,
                                             `pzhcurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                             `pzhsum` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 凭证表 to 入库单费用';

-- --------------------------------------------------------

--
-- 表的结构 `link_return_to_productstock`
--

CREATE TABLE `link_return_to_productstock` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `productstockid` int(10) UNSIGNED DEFAULT NULL,
                                             `dealprice` decimal(10,2) DEFAULT NULL,
                                             `getpoints` int(11) DEFAULT NULL,
                                             `memberid` int(10) UNSIGNED DEFAULT NULL,
                                             `returnid` int(10) UNSIGNED DEFAULT NULL,
                                             `salelinkid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表 退货单 to 库存';

-- --------------------------------------------------------

--
-- 表的结构 `link_rule_to_operation`
--

CREATE TABLE `link_rule_to_operation` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `ruleid` int(10) UNSIGNED DEFAULT NULL,
                                        `operationid` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='职能功能连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_salespot_to_childbrand`
--

CREATE TABLE `link_salespot_to_childbrand` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `salespotid` int(10) UNSIGNED DEFAULT NULL,
                                             `brandtypeid` int(10) UNSIGNED DEFAULT NULL,
                                             `rate` decimal(19,6) DEFAULT NULL,
                                             `isrounded` varchar(1) DEFAULT NULL COMMENT '0-不取整 1-取整'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口 扣点连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_sales_to_productstock`
--

CREATE TABLE `link_sales_to_productstock` (
                                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                            `sys_create_date` datetime NOT NULL,
                                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                            `sys_modify_date` datetime NOT NULL,
                                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                            `sys_delete_date` datetime DEFAULT NULL,
                                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                            `productstockid` int(10) UNSIGNED DEFAULT NULL,
                                            `dealprice` decimal(10,2) DEFAULT NULL,
                                            `pricelistid` int(10) UNSIGNED DEFAULT NULL,
                                            `getpoints` decimal(10,2) DEFAULT NULL,
                                            `memberid` int(10) UNSIGNED DEFAULT NULL,
                                            `salesid` int(10) UNSIGNED DEFAULT NULL,
                                            `returnflag` varchar(1) DEFAULT NULL COMMENT '0-正常 1-已退货',
                                            `expresscomoany` varchar(1) DEFAULT NULL COMMENT '0-顺丰 1-德邦 2-京东',
                                            `expressno` varchar(50) DEFAULT NULL,
                                            `expressfee` decimal(16,9) DEFAULT NULL,
                                            `expressstatus` varchar(1) DEFAULT NULL COMMENT '0-未发货 1-已发货 2-缺货',
                                            `expressuser` int(10) UNSIGNED DEFAULT NULL,
                                            `isbj` varchar(1) DEFAULT NULL,
                                            `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                            `sum` decimal(16,9) DEFAULT NULL,
                                            `porc` varchar(1) DEFAULT NULL COMMENT '0-预付 1-到付',
                                            `detailid` int(10) UNSIGNED DEFAULT NULL,
                                            `bgj` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售到库存之间的记录';

-- --------------------------------------------------------

--
-- 表的结构 `link_sellspot_to_brand`
--

CREATE TABLE `link_sellspot_to_brand` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `sellspotid` int(10) UNSIGNED NOT NULL,
                                        `brandid` int(10) UNSIGNED NOT NULL,
                                        `level` varchar(1) NOT NULL COMMENT 'a\r\n            b\r\n            c\r\n            d'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口品牌连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_special_to_productstock`
--

CREATE TABLE `link_special_to_productstock` (
                                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                              `sys_create_date` datetime NOT NULL,
                                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                              `sys_modify_date` datetime NOT NULL,
                                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                              `sys_delete_date` datetime DEFAULT NULL,
                                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                              `productstockid` int(10) UNSIGNED DEFAULT NULL,
                                              `specialid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='其他出入库表到库存之间的记录';

-- --------------------------------------------------------

--
-- 表的结构 `link_spot_warehouse`
--

CREATE TABLE `link_spot_warehouse` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `spotid` int(10) UNSIGNED DEFAULT NULL,
                                     `warehouseid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='仓库销售端口连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_supplier_to_brand`
--

CREATE TABLE `link_supplier_to_brand` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `supplierid` int(10) UNSIGNED NOT NULL,
                                        `brandid` int(10) UNSIGNED NOT NULL,
                                        `level` varchar(1) NOT NULL COMMENT 'a\r\n            b\r\n            c\r\n            d',
                                        `decade` int(10) UNSIGNED DEFAULT NULL,
                                        `markup` decimal(10,2) DEFAULT NULL,
                                        `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                        `sum` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='供货商品牌连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_user_to_labourcontactor`
--

CREATE TABLE `link_user_to_labourcontactor` (
                                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                              `sys_create_date` datetime NOT NULL,
                                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                              `sys_modify_date` datetime NOT NULL,
                                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                              `sys_delete_date` datetime DEFAULT NULL,
                                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                              `userid` int(10) UNSIGNED DEFAULT NULL,
                                              `datefrom` datetime DEFAULT NULL,
                                              `datato` datetime DEFAULT NULL,
                                              `memo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='员工合同记录';

-- --------------------------------------------------------

--
-- 表的结构 `link_user_to_price`
--

CREATE TABLE `link_user_to_price` (
                                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `userid` int(10) UNSIGNED DEFAULT NULL,
                                    `priceid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='价格单用户连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_user_to_reportset`
--

CREATE TABLE `link_user_to_reportset` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `userid` int(10) UNSIGNED DEFAULT NULL,
                                        `reportid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表用户与报表样式';

-- --------------------------------------------------------

--
-- 表的结构 `link_user_to_salesport`
--

CREATE TABLE `link_user_to_salesport` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `userid` int(10) UNSIGNED DEFAULT NULL,
                                        `sportid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口用户连接表';

-- --------------------------------------------------------

--
-- 表的结构 `link_user_to_supplier`
--

CREATE TABLE `link_user_to_supplier` (
                                       `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                       `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `userid` int(10) UNSIGNED DEFAULT NULL,
                                       `supplierid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='连接表用户与结算单位';

-- --------------------------------------------------------

--
-- 表的结构 `link_user_to_warehouse`
--

CREATE TABLE `link_user_to_warehouse` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `userid` int(10) UNSIGNED DEFAULT NULL,
                                        `warehouseid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='仓库用户连接表';

-- --------------------------------------------------------

--
-- 表的结构 `sys_config`
--

CREATE TABLE `sys_config` (
                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `code` varchar(100) DEFAULT NULL COMMENT 'ftp-ftp文件服务器ip地址，value值不以/结尾',
                            `value` varchar(100) DEFAULT NULL,
                            `comment` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统参数值备注 code-文件服务器地址,fileipvalue - 文件名';

-- --------------------------------------------------------

--
-- 表的结构 `sys_selfcompany`
--

CREATE TABLE `sys_selfcompany` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `companyid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统参数值 本公司id\r\n';

-- --------------------------------------------------------

--
-- 表的结构 `tb_card`
--

CREATE TABLE `tb_card` (
                         `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                         `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                         `member_id` int(10) UNSIGNED DEFAULT NULL,
                         `cardno` varchar(50) DEFAULT NULL,
                         `password` varchar(50) DEFAULT NULL,
                         `total` decimal(16,9) DEFAULT NULL,
                         `telno` varchar(20) DEFAULT NULL,
                         `status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='消费卡';

-- --------------------------------------------------------

--
-- 表的结构 `tb_check`
--

CREATE TABLE `tb_check` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `checkno` varchar(10) DEFAULT NULL,
                          `warehouseid` int(10) UNSIGNED DEFAULT NULL,
                          `checker` int(10) UNSIGNED DEFAULT NULL,
                          `check_flag` tinyint(4) DEFAULT NULL COMMENT '0-生成预盘单\r\n            1-生成实盘单\r\n            2-生成差异单\r\n            3-差异出入库',
                          `check_date` datetime DEFAULT NULL,
                          `form_memo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='盘点主表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_check_detail`
--

CREATE TABLE `tb_check_detail` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `checkid` int(10) UNSIGNED DEFAULT NULL,
                                 `productid` int(10) UNSIGNED DEFAULT NULL,
                                 `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                 `count` int(11) DEFAULT NULL,
                                 `checktype` varchar(1) DEFAULT NULL COMMENT 's-实盘 y-预盘 c-差异',
                                 `form_memo` varchar(500) DEFAULT NULL,
                                 `excelasacode` varchar(50) DEFAULT NULL,
                                 `excelsize` varchar(50) DEFAULT NULL,
                                 `excelcount` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='盘点明细表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_company`
--

CREATE TABLE `tb_company` (
                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `name_cn` varchar(1000) DEFAULT NULL COMMENT '中文名称',
                            `name_en` varchar(1000) DEFAULT NULL COMMENT '英文名称',
                            `name_hk` varchar(1000) DEFAULT NULL COMMENT '粤语名称',
                            `name_fr` varchar(1000) DEFAULT NULL COMMENT '法语名称',
                            `name_it` varchar(1000) DEFAULT NULL COMMENT '意大利语名称',
                            `name_sp` varchar(1000) DEFAULT NULL COMMENT '西班牙语名称',
                            `name_de` varchar(1000) DEFAULT NULL COMMENT '德语名称',
                            `countryid` int(10) UNSIGNED DEFAULT NULL COMMENT '国家id',
                            `memo` text COMMENT '备注说明'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- 表的结构 `tb_contactlist`
--

CREATE TABLE `tb_contactlist` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `corderid` int(10) UNSIGNED DEFAULT NULL,
                                `addname` int(10) UNSIGNED DEFAULT NULL,
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
                                `answerid` int(10) UNSIGNED DEFAULT NULL,
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
                                `flightno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='发货联系单';

-- --------------------------------------------------------

--
-- 表的结构 `tb_declaration`
--

CREATE TABLE `tb_declaration` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `no` varchar(50) DEFAULT NULL,
                                `memo` varchar(1000) DEFAULT NULL,
                                `date` datetime DEFAULT NULL,
                                `corderid` int(10) UNSIGNED DEFAULT NULL,
                                `pricerate` decimal(16,9) DEFAULT NULL,
                                `taxrate` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='报关单主表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_declaration_detail`
--

CREATE TABLE `tb_declaration_detail` (
                                       `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                       `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `declarationid` int(10) UNSIGNED DEFAULT NULL,
                                       `productname` varchar(100) DEFAULT NULL,
                                       `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                       `price` decimal(16,9) DEFAULT NULL,
                                       `count` int(11) DEFAULT NULL,
                                       `rate` decimal(16,9) DEFAULT NULL,
                                       `cprice` decimal(16,9) DEFAULT NULL,
                                       `tax` decimal(16,9) DEFAULT NULL,
                                       `cost` decimal(16,9) DEFAULT NULL,
                                       `totaltax` decimal(16,9) DEFAULT NULL,
                                       `totalcost` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='报关单明细表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_department`
--

CREATE TABLE `tb_department` (
                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `name` varchar(100) DEFAULT NULL,
                               `memo` varchar(1000) DEFAULT NULL,
                               `companyid` int(10) UNSIGNED NOT NULL COMMENT '公司id',
                               `priceid` int(10) UNSIGNED DEFAULT NULL COMMENT '此价格id可以是基础价格id，也可以是销售端口id',
                               `spotid` int(10) UNSIGNED DEFAULT NULL,
                               `up_dp_id` int(10) UNSIGNED DEFAULT '0' COMMENT '上级部门ID',
                               `checkingflag` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='部门表';


-- --------------------------------------------------------

--
-- 表的结构 `tb_discount_card`
--

CREATE TABLE `tb_discount_card` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `number` varchar(50) DEFAULT NULL,
                                  `amount` decimal(16,9) DEFAULT NULL,
                                  `is_used` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                                  `is_actived` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                                  `activedid` int(10) UNSIGNED DEFAULT NULL,
                                  `usedid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='优惠卷';

-- --------------------------------------------------------

--
-- 表的结构 `tb_distribute`
--

CREATE TABLE `tb_distribute` (
                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `distributeno` varchar(50) DEFAULT NULL,
                               `owner` int(10) UNSIGNED DEFAULT NULL,
                               `out_id` int(10) UNSIGNED DEFAULT NULL,
                               `in_id` int(10) UNSIGNED DEFAULT NULL,
                               `op_id` int(10) UNSIGNED DEFAULT NULL,
                               `op_date` datetime DEFAULT NULL,
                               `memo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='分货单主表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_distributecode`
--

CREATE TABLE `tb_distributecode` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `year` varchar(5) DEFAULT NULL,
                                   `code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='分货单号表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_express`
--

CREATE TABLE `tb_express` (
                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `expresscompany` varchar(1) DEFAULT NULL COMMENT '0-顺丰 1-德邦 2-京东 3-其他 4-圆通',
                            `expressno` varchar(50) DEFAULT NULL,
                            `expressfee` decimal(16,9) DEFAULT NULL,
                            `memo` text,
                            `creator` int(10) UNSIGNED NOT NULL,
                            `departmentid` int(10) UNSIGNED DEFAULT NULL,
                            `type` varchar(1) DEFAULT NULL COMMENT '0-个人，1-部门，2-事业部，3-公司',
                            `f_person` varchar(50) DEFAULT NULL,
                            `f_telno` varchar(50) DEFAULT NULL,
                            `f_address` varchar(500) DEFAULT NULL,
                            `s_person` varchar(50) DEFAULT NULL,
                            `s_telno` varchar(50) DEFAULT NULL,
                            `s_address` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='单快递信息';

-- --------------------------------------------------------

--
-- 表的结构 `tb_fee`
--

CREATE TABLE `tb_fee` (
                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                        `sys_create_date` datetime NOT NULL,
                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                        `sys_modify_date` datetime NOT NULL,
                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                        `sys_delete_date` datetime DEFAULT NULL,
                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                        `applyno` varchar(50) DEFAULT NULL,
                        `applydate` datetime DEFAULT NULL,
                        `applystaff` int(10) UNSIGNED DEFAULT NULL,
                        `staff` int(10) UNSIGNED DEFAULT NULL,
                        `departmemtid` int(10) UNSIGNED DEFAULT NULL,
                        `departmemtid2` int(10) UNSIGNED DEFAULT NULL,
                        `leadercheckstatus` varchar(1) DEFAULT NULL COMMENT '0-未审核 1-审核通过 2-驳回',
                        `leaderid` int(10) UNSIGNED DEFAULT NULL,
                        `leadercheckdate` datetime DEFAULT NULL,
                        `financecheckstatus` varchar(1) DEFAULT NULL COMMENT '0-未审核 1-审核通过 2-驳回',
                        `financeid` int(10) UNSIGNED DEFAULT NULL,
                        `financecheckdate` datetime DEFAULT NULL,
                        `memo` varchar(500) DEFAULT NULL,
                        `pzhstatus` varchar(1) DEFAULT NULL,
                        `pzhid` int(10) UNSIGNED DEFAULT NULL,
                        `managercheckstatus` varchar(1) DEFAULT NULL COMMENT '0-未审核 1-审核通过 2-驳回',
                        `managerid` int(10) UNSIGNED DEFAULT NULL,
                        `managercheckdate` datetime DEFAULT NULL,
                        `type` varchar(1) DEFAULT NULL COMMENT '0-个人，1-部门，2-事业部，3-公司',
                        `reason` text,
                        `sheetid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='费用申请';

-- --------------------------------------------------------

--
-- 表的结构 `tb_feecode`
--

CREATE TABLE `tb_feecode` (
                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `year` varchar(5) DEFAULT NULL,
                            `code` varchar(10) DEFAULT NULL,
                            `month` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='费用申请号表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_fee_detail`
--

CREATE TABLE `tb_fee_detail` (
                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `tbfeeid` int(10) UNSIGNED DEFAULT NULL,
                               `feeid` int(10) UNSIGNED DEFAULT NULL,
                               `sfcompanyid` int(10) UNSIGNED DEFAULT NULL,
                               `number` decimal(16,9) DEFAULT NULL,
                               `feeprice` decimal(16,9) DEFAULT NULL,
                               `rate` decimal(16,9) DEFAULT NULL,
                               `feecurrencyid` int(10) UNSIGNED DEFAULT NULL,
                               `feesum` decimal(16,9) DEFAULT NULL,
                               `memo` varchar(500) DEFAULT NULL,
                               `invoiceno` varchar(500) DEFAULT NULL,
                               `paydate` datetime DEFAULT NULL,
                               `sorf` varchar(1) DEFAULT NULL,
                               `ischeck` varchar(1) DEFAULT NULL COMMENT '0-未对账，1-已对账',
                               `isreturn` varchar(1) DEFAULT NULL COMMENT '0-未入账，1-已入账'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='费用申请明细表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_group`
--

CREATE TABLE `tb_group` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                          `group_name` varchar(50) DEFAULT NULL,
                          `group_memo` varchar(500) DEFAULT NULL,
                          `companyid` int(10) UNSIGNED DEFAULT NULL,
                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='组信息';


-- --------------------------------------------------------

--
-- 表的结构 `tb_inve_actual`
--

CREATE TABLE `tb_inve_actual` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `form_num` varchar(30) DEFAULT NULL,
                                `checker` int(10) UNSIGNED DEFAULT NULL,
                                `check_flag` tinyint(4) DEFAULT NULL,
                                `check_date` datetime DEFAULT NULL,
                                `form_memo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tb_inve_actual';

-- --------------------------------------------------------

--
-- 表的结构 `tb_inve_actual_dtl`
--

CREATE TABLE `tb_inve_actual_dtl` (
                                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `curr_quantity` bigint(20) DEFAULT NULL,
                                    `real_quantity` bigint(20) DEFAULT NULL,
                                    `profit_loss` bigint(20) DEFAULT NULL,
                                    `product_id` int(10) UNSIGNED DEFAULT NULL,
                                    `size_id` int(10) UNSIGNED DEFAULT NULL,
                                    `inve_actual_id` int(10) UNSIGNED DEFAULT NULL,
                                    `stock_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tb_inve_actual_dtl';

-- --------------------------------------------------------

--
-- 表的结构 `tb_inve_prep`
--

CREATE TABLE `tb_inve_prep` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `form_num` varchar(30) DEFAULT NULL,
                              `checker` int(10) UNSIGNED DEFAULT NULL,
                              `check_flag` tinyint(4) DEFAULT NULL,
                              `check_date` datetime DEFAULT NULL,
                              `form_memo` varchar(500) DEFAULT NULL,
                              `inve_actual_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tb_inve_prep';

-- --------------------------------------------------------

--
-- 表的结构 `tb_inve_prep_dtl`
--

CREATE TABLE `tb_inve_prep_dtl` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `product_id` int(10) UNSIGNED DEFAULT NULL,
                                  `size_id` int(10) UNSIGNED DEFAULT NULL,
                                  `curr_quantity` bigint(20) DEFAULT NULL,
                                  `inve_prep_id` int(10) UNSIGNED DEFAULT NULL,
                                  `stock_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tb_inve_prep_dtl';

-- --------------------------------------------------------

--
-- 表的结构 `tb_kp`
--

CREATE TABLE `tb_kp` (
                       `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                       `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                       `sys_create_date` datetime NOT NULL,
                       `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                       `sys_modify_date` datetime NOT NULL,
                       `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                       `sys_delete_date` datetime DEFAULT NULL,
                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                       `invoiceno` varchar(50) DEFAULT NULL,
                       `kpdate` datetime DEFAULT NULL,
                       `sum` decimal(16,9) DEFAULT NULL,
                       `sfcompanyid` int(10) UNSIGNED DEFAULT NULL,
                       `header` text,
                       `memo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='开票信息';

-- --------------------------------------------------------

--
-- 表的结构 `tb_member`
--

CREATE TABLE `tb_member` (
                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                           `memberlevelid` int(10) UNSIGNED DEFAULT NULL,
                           `membertype` varchar(1) DEFAULT NULL COMMENT '0-个人会员 1-公司会员',
                           `membercardid` int(10) UNSIGNED DEFAULT NULL,
                           `creatorid` int(10) UNSIGNED DEFAULT NULL,
                           `sourceid` int(10) UNSIGNED DEFAULT NULL,
                           `idno` varchar(50) DEFAULT NULL,
                           `taxno` varchar(50) DEFAULT NULL,
                           `contactor` varchar(50) DEFAULT NULL,
                           `asawebno` varchar(50) DEFAULT NULL,
                           `openid` varchar(50) DEFAULT NULL,
                           `password` varchar(10) DEFAULT NULL,
                           `invitesum` bigint(20) DEFAULT NULL,
                           `invitetotal` bigint(20) DEFAULT NULL,
                           `invoteuser` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_member_address`
--

CREATE TABLE `tb_member_address` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `member_id` int(10) UNSIGNED DEFAULT NULL,
                                   `name` varchar(50) DEFAULT NULL,
                                   `idno` varchar(50) DEFAULT NULL,
                                   `tel` varchar(50) DEFAULT NULL,
                                   `zipcode` varchar(10) DEFAULT NULL,
                                   `address` varchar(1000) DEFAULT NULL,
                                   `province` varchar(20) DEFAULT NULL,
                                   `city` varchar(20) DEFAULT NULL,
                                   `is_default` varchar(1) DEFAULT NULL COMMENT '0-否 1-是'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员地址信息';

-- --------------------------------------------------------

--
-- 表的结构 `tb_member_bank`
--

CREATE TABLE `tb_member_bank` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `member_id` int(10) UNSIGNED DEFAULT NULL,
                                `account_name` varchar(1000) DEFAULT NULL,
                                `account` varchar(1000) DEFAULT NULL,
                                `currency_id` int(10) UNSIGNED DEFAULT NULL,
                                `bank_name` varchar(1000) DEFAULT NULL,
                                `bank_address` varchar(1000) DEFAULT NULL,
                                `is_default` varchar(1) DEFAULT NULL COMMENT '0-否 1-是'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员银行';

-- --------------------------------------------------------

--
-- 表的结构 `tb_member_card`
--

CREATE TABLE `tb_member_card` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `number` varchar(50) DEFAULT NULL,
                                `is_used` varchar(1) DEFAULT NULL COMMENT '0-否 1-是'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员卡号';

-- --------------------------------------------------------

--
-- 表的结构 `tb_member_card_history`
--

CREATE TABLE `tb_member_card_history` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `member_id` int(10) UNSIGNED DEFAULT NULL,
                                        `type` varchar(1) DEFAULT NULL COMMENT '0-充值 1-消费 ',
                                        `sum` decimal(19,6) DEFAULT NULL,
                                        `opdate` datetime DEFAULT NULL,
                                        `totalsum` decimal(19,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='储值卡操作记录';

-- --------------------------------------------------------

--
-- 表的结构 `tb_member_contactor`
--

CREATE TABLE `tb_member_contactor` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `member_id` int(10) UNSIGNED DEFAULT NULL,
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
                                     `is_default` varchar(1) DEFAULT NULL COMMENT '0-否 1-是'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员（公司）联系人';

-- --------------------------------------------------------

--
-- 表的结构 `tb_member_header`
--

CREATE TABLE `tb_member_header` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `member_id` int(10) UNSIGNED DEFAULT NULL,
                                  `chinese_header` varchar(1000) DEFAULT NULL,
                                  `english_header` varchar(1000) DEFAULT NULL,
                                  `is_default` varchar(1) DEFAULT NULL COMMENT '0-否 1-是'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员发票抬头';

-- --------------------------------------------------------

--
-- 表的结构 `tb_member_preference`
--

CREATE TABLE `tb_member_preference` (
                                      `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                      `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `member_id` int(10) UNSIGNED DEFAULT NULL,
                                      `brand_id` int(10) UNSIGNED DEFAULT NULL,
                                      `brandgroup_id` int(10) UNSIGNED DEFAULT NULL,
                                      `childbrandgroup_id` int(10) UNSIGNED DEFAULT NULL,
                                      `sizetop_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员偏好';

-- --------------------------------------------------------

--
-- 表的结构 `tb_member_preference_size`
--

CREATE TABLE `tb_member_preference_size` (
                                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_create_date` datetime NOT NULL,
                                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                           `sys_modify_date` datetime NOT NULL,
                                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                           `sys_delete_date` datetime DEFAULT NULL,
                                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                           `memberpreference_id` int(10) UNSIGNED DEFAULT NULL,
                                           `sizecontent_id` int(10) UNSIGNED DEFAULT NULL,
                                           `sizetop_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员偏好尺码表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_member_preordination`
--

CREATE TABLE `tb_member_preordination` (
                                         `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                         `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                         `sys_create_date` datetime NOT NULL,
                                         `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                         `sys_modify_date` datetime NOT NULL,
                                         `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                         `sys_delete_date` datetime DEFAULT NULL,
                                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                         `orderdate` datetime DEFAULT NULL,
                                         `memberid` int(10) UNSIGNED DEFAULT NULL,
                                         `productid` int(10) UNSIGNED DEFAULT NULL,
                                         `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                         `memo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预定信息';

-- --------------------------------------------------------

--
-- 表的结构 `tb_permission`
--

CREATE TABLE `tb_permission` (
                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `pid` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '所属权限id，默认0为顶级权限',
                               `name` varchar(100) NOT NULL DEFAULT '' COMMENT '权限名称',
                               `memo_cn` text COMMENT '中文描述',
                               `memo_en` text COMMENT '英文描述',
                               `memo_hk` text COMMENT '粤语描述',
                               `memo_fr` text COMMENT '法语描述',
                               `memo_it` text COMMENT '意大利语描述',
                               `memo_sp` text COMMENT '西班牙语描述',
                               `memo_de` text COMMENT '德语描述',
                               `is_only_superadmin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为专属超级管理员权限，0-不是 1-是'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- 表的结构 `tb_permission_group`
--

CREATE TABLE `tb_permission_group` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `groupid` int(10) UNSIGNED NOT NULL COMMENT '组id',
                                     `permissionid` int(10) UNSIGNED NOT NULL COMMENT '权限id',
                                     `companyid` int(10) UNSIGNED DEFAULT NULL COMMENT '公司id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- 表的结构 `tb_permission_module`
--

CREATE TABLE `tb_permission_module` (
                                      `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                      `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `permissionid` int(10) UNSIGNED DEFAULT NULL COMMENT '权限id',
                                      `module` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '模块名称',
                                      `controller` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '控制器名称',
                                      `action` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '方法名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- 表的结构 `tb_picture`
--

CREATE TABLE `tb_picture` (
                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `picturename` varchar(20) DEFAULT NULL,
                            `picturestream` varchar(200) DEFAULT NULL,
                            `picturetype` char(10) DEFAULT NULL,
                            `picturegroup` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='图片表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_pre_requisition`
--

CREATE TABLE `tb_pre_requisition` (
                                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `productstock_id` int(10) UNSIGNED DEFAULT NULL,
                                    `stockid` int(10) UNSIGNED DEFAULT NULL,
                                    `tostockid` int(10) UNSIGNED DEFAULT NULL,
                                    `opid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预调拨单明细';

-- --------------------------------------------------------

--
-- 表的结构 `tb_product`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='商品表';



-- --------------------------------------------------------

--
-- 表的结构 `tb_productstock`
--

CREATE TABLE `tb_productstock` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `productid` int(10) UNSIGNED DEFAULT NULL,
                                 `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                 `storagetime` datetime DEFAULT NULL,
                                 `storagestaff` int(10) UNSIGNED DEFAULT NULL,
                                 `stockid` int(10) UNSIGNED DEFAULT NULL,
                                 `productno` bigint(20) DEFAULT NULL,
                                 `selltime` datetime DEFAULT NULL,
                                 `sellprice` decimal(16,9) DEFAULT NULL,
                                 `cost` decimal(16,9) DEFAULT NULL,
                                 `selltype` int(11) DEFAULT NULL COMMENT '0-待销\r\n            1-已售出\r\n            2-预售\r\n            3-在途\r\n            4-调拨锁定',
                                 `dealprice` decimal(16,9) DEFAULT NULL,
                                 `qualitystatus` int(11) DEFAULT NULL COMMENT '0-合格品\r\n            1-残次品\r\n            2-库存差异',
                                 `sellstaff` int(10) UNSIGNED DEFAULT NULL,
                                 `is_print` varchar(1) DEFAULT NULL COMMENT '0-未打印\r\n            1-条形码打印\r\n            2-二维码打印',
                                 `corderid` int(10) UNSIGNED DEFAULT NULL,
                                 `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                 `memo` varchar(500) DEFAULT NULL,
                                 `cpdate` datetime DEFAULT NULL,
                                 `cp_op` int(10) UNSIGNED DEFAULT NULL,
                                 `intime` datetime DEFAULT NULL,
                                 `property` varchar(1) DEFAULT NULL COMMENT '0-自采 1-代销',
                                 `kpflag` varchar(1) DEFAULT NULL COMMENT '0-未开票 1-已开票',
                                 `decadeid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='库存';

-- --------------------------------------------------------

--
-- 表的结构 `tb_productstock_snapshot`
--

CREATE TABLE `tb_productstock_snapshot` (
                                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                          `sys_create_date` datetime NOT NULL,
                                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                          `sys_modify_date` datetime NOT NULL,
                                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                          `sys_delete_date` datetime DEFAULT NULL,
                                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                          `snapdate` datetime DEFAULT NULL,
                                          `productstockid` int(10) UNSIGNED DEFAULT NULL,
                                          `productid` int(10) UNSIGNED DEFAULT NULL,
                                          `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                          `stockid` int(10) UNSIGNED DEFAULT NULL,
                                          `productno` bigint(20) DEFAULT NULL,
                                          `selltime` datetime DEFAULT NULL,
                                          `sellprice` decimal(16,9) DEFAULT NULL,
                                          `cost` decimal(16,9) DEFAULT NULL,
                                          `selltype` int(11) DEFAULT NULL COMMENT '0-待销\r\n            1-已售出\r\n            2-预定\r\n            3-在途\r\n            4-调拨锁定',
                                          `dealprice` decimal(16,9) DEFAULT NULL,
                                          `qualitystatus` int(11) DEFAULT NULL COMMENT '0-合格品\r\n            1-残次品\r\n            2-库存差异',
                                          `sellstaff` int(10) UNSIGNED DEFAULT NULL,
                                          `corderid` int(10) UNSIGNED DEFAULT NULL,
                                          `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                          `memo` varchar(500) DEFAULT NULL,
                                          `cpdate` datetime DEFAULT NULL,
                                          `intime` datetime DEFAULT NULL,
                                          `property` varchar(1) DEFAULT NULL COMMENT '0-自采 1-代销',
                                          `kpflag` varchar(1) DEFAULT NULL COMMENT '0-未开票 1-已开票',
                                          `decadeid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='库存快照表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_product_price`
--

CREATE TABLE `tb_product_price` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `productid` int(10) UNSIGNED DEFAULT NULL,
                                  `decadeid` int(10) UNSIGNED DEFAULT NULL,
                                  `retailpricecurrency` int(10) UNSIGNED DEFAULT NULL,
                                  `realprice` decimal(16,9) DEFAULT NULL,
                                  `factorypricecurrency` int(10) UNSIGNED DEFAULT NULL,
                                  `factoryprice` decimal(16,9) DEFAULT NULL,
                                  `basecurrency` int(10) UNSIGNED DEFAULT NULL,
                                  `baseprice` decimal(16,9) DEFAULT NULL,
                                  `nationalprice` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='成交价，参考价，基准零售价，国内零售价 历史记录';

-- --------------------------------------------------------

--
-- 表的结构 `tb_requisition`
--

CREATE TABLE `tb_requisition` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `feecurrencyid` int(10) UNSIGNED DEFAULT NULL,
                                `fee` decimal(16,9) DEFAULT NULL,
                                `apply_staff` int(10) UNSIGNED DEFAULT NULL,
                                `apply_date` datetime NOT NULL,
                                `turnin_staff` int(10) UNSIGNED DEFAULT NULL,
                                `turnin_date` datetime DEFAULT NULL,
                                `turnout_staff` int(10) UNSIGNED NOT NULL,
                                `turnout_date` datetime DEFAULT NULL,
                                `out_id` int(10) UNSIGNED NOT NULL,
                                `in_id` int(10) UNSIGNED NOT NULL,
                                `memo` varchar(500) DEFAULT NULL,
                                `allocationconfirm` varchar(1) DEFAULT NULL COMMENT 'null-主调拨单才会是这个\r\n            4-出库未完成\r\n            0-入库未完成\r\n            1-出库拒绝\r\n            2-已完成\r\n            3-入库拒绝\r\n            ',
                                `requisitionno` varchar(50) DEFAULT NULL,
                                `salesid` int(10) UNSIGNED DEFAULT NULL,
                                `ism` varchar(1) DEFAULT NULL COMMENT '1-主单，0或者空-子单或单对单库调拨单',
                                `qualitystatus` varchar(1) DEFAULT NULL COMMENT '0-合格品 1-残品',
                                `isamortized` varchar(1) DEFAULT NULL,
                                `expresscomoany` varchar(1) DEFAULT NULL COMMENT '0-顺丰 1-德邦 2-京东 3-其他',
                                `address` char(1) DEFAULT NULL,
                                `markno` varchar(50) DEFAULT NULL,
                                `returnflag` varchar(1) DEFAULT NULL COMMENT '0-普通调拨单，1-反向调拨单'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='调拨单主表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_requisitioncode`
--

CREATE TABLE `tb_requisitioncode` (
                                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `year` varchar(5) DEFAULT NULL,
                                    `code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='调拨单号表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_requisition_detail`
--

CREATE TABLE `tb_requisition_detail` (
                                       `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                       `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `requisition_id` int(10) UNSIGNED NOT NULL,
                                       `stock_id` int(10) UNSIGNED DEFAULT NULL,
                                       `memo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='调拨单明细';

-- --------------------------------------------------------

--
-- 表的结构 `tb_requisition_detail_group`
--

CREATE TABLE `tb_requisition_detail_group` (
                                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_create_date` datetime NOT NULL,
                                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                             `sys_modify_date` datetime NOT NULL,
                                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                             `sys_delete_date` datetime DEFAULT NULL,
                                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                             `requisition_id` int(10) UNSIGNED NOT NULL,
                                             `product_id` int(10) UNSIGNED DEFAULT NULL,
                                             `size_id` int(10) UNSIGNED DEFAULT NULL,
                                             `count` int(11) DEFAULT NULL,
                                             `memo` varchar(100) DEFAULT NULL,
                                             `ctnno` varchar(50) DEFAULT NULL,
                                             `outcount` int(11) DEFAULT NULL,
                                             `incount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='调拨单明细(数量)';

-- --------------------------------------------------------

--
-- 表的结构 `tb_requisition_express`
--

CREATE TABLE `tb_requisition_express` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `requisitionid` int(10) UNSIGNED DEFAULT NULL,
                                        `expresscompany` varchar(1) DEFAULT NULL COMMENT '0-顺丰 1-德邦 2-京东 3-其他 4-圆通',
                                        `expressno` varchar(50) DEFAULT NULL,
                                        `expressfee` decimal(16,9) DEFAULT NULL,
                                        `memo` text,
                                        `creator` int(10) UNSIGNED DEFAULT NULL,
                                        `departmentid` int(10) UNSIGNED DEFAULT NULL,
                                        `type` varchar(1) DEFAULT NULL COMMENT '0-个人，1-部门，2-事业部，3-公司'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='调拨单快递信息';

-- --------------------------------------------------------

--
-- 表的结构 `tb_rule`
--

CREATE TABLE `tb_rule` (
                         `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                         `rule_name` varchar(50) DEFAULT NULL,
                         `rule_memo` varchar(500) DEFAULT NULL,
                         `companyid` int(10) UNSIGNED DEFAULT NULL,
                         `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用于存放系统的全部信息';

-- --------------------------------------------------------

--
-- 表的结构 `tb_savings_card`
--

CREATE TABLE `tb_savings_card` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `number` varchar(50) DEFAULT NULL,
                                 `password` varchar(10) DEFAULT NULL,
                                 `amount` decimal(16,9) DEFAULT NULL,
                                 `price` decimal(16,9) DEFAULT NULL,
                                 `is_used` varchar(1) DEFAULT NULL COMMENT '0-否 1-是',
                                 `is_actived` varchar(1) DEFAULT NULL COMMENT '0-否 1-是'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='储值卡';

-- --------------------------------------------------------

--
-- 表的结构 `tb_special_requisition`
--

CREATE TABLE `tb_special_requisition` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `no` varchar(10) DEFAULT NULL,
                                        `stuffid` int(10) UNSIGNED DEFAULT NULL,
                                        `check_flag` tinyint(4) DEFAULT NULL COMMENT '0-未生效\r\n            1-已生效\r\n            ',
                                        `check_date` datetime DEFAULT NULL,
                                        `memo` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='其他出入库主表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_special_requisition_detail`
--

CREATE TABLE `tb_special_requisition_detail` (
                                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                               `sys_create_date` datetime NOT NULL,
                                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                               `sys_modify_date` datetime NOT NULL,
                                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                               `sys_delete_date` datetime DEFAULT NULL,
                                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                               `specialid` int(10) UNSIGNED NOT NULL,
                                               `productid` int(10) UNSIGNED DEFAULT NULL,
                                               `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                               `count` int(11) DEFAULT NULL,
                                               `warehouseid` int(10) UNSIGNED DEFAULT NULL,
                                               `type` varchar(1) DEFAULT NULL COMMENT '0-出库 1-入库',
                                               `memo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='其他出入库明细表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_stock`
--

CREATE TABLE `tb_stock` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `declarationid` int(10) UNSIGNED DEFAULT NULL,
                          `productname` varchar(100) DEFAULT NULL,
                          `currencyid` int(10) UNSIGNED DEFAULT NULL,
                          `price` decimal(16,9) DEFAULT NULL,
                          `count` int(11) DEFAULT NULL,
                          `rate` decimal(16,9) DEFAULT NULL,
                          `cprice` decimal(16,9) DEFAULT NULL,
                          `tax` decimal(16,9) DEFAULT NULL,
                          `cost` decimal(16,9) DEFAULT NULL,
                          `kpcount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='账面库存表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_supplier`
--

CREATE TABLE `tb_supplier` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                             `nationality` int(10) UNSIGNED DEFAULT NULL,
                             `nature` varchar(100) DEFAULT NULL,
                             `supplierlevel` int(10) UNSIGNED DEFAULT NULL,
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
                             `settlecompanyid` int(10) UNSIGNED DEFAULT NULL,
                             `memo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

-- --------------------------------------------------------

--
-- 表的结构 `tb_supplier_orderdate`
--

CREATE TABLE `tb_supplier_orderdate` (
                                       `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                       `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                       `supplierid` int(10) UNSIGNED DEFAULT NULL,
                                       `brandid` int(10) UNSIGNED DEFAULT NULL,
                                       `decade` int(10) UNSIGNED DEFAULT NULL,
                                       `type` varchar(1) DEFAULT NULL COMMENT '0-pre ,1-main ,2-fashion show',
                                       `showdate` datetime DEFAULT NULL,
                                       `closedate` datetime DEFAULT NULL,
                                       `memo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订货日期';

-- --------------------------------------------------------

--
-- 表的结构 `tb_user`
--

CREATE TABLE `tb_user` (
                         `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                         `login_name` varchar(50) DEFAULT NULL,
                         `password` varchar(50) DEFAULT NULL,
                         `real_name` varchar(50) DEFAULT NULL,
                         `departmentid` int(10) UNSIGNED DEFAULT NULL,
                         `companyid` int(10) UNSIGNED DEFAULT NULL COMMENT '公司id',
                         `groupid` int(10) UNSIGNED DEFAULT NULL,
                         `storeid` int(10) UNSIGNED DEFAULT NULL,
                         `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                         `countryid` int(10) UNSIGNED DEFAULT NULL,
                         `departmentid2` int(10) UNSIGNED DEFAULT NULL,
                         `address` text,
                         `contactor` text,
                         `leave_date` varchar(100) DEFAULT NULL,
                         `defaultprice` int(10) UNSIGNED DEFAULT NULL,
                         `defaultwarehouse` int(10) UNSIGNED DEFAULT NULL,
                         `defaultsellspot` int(10) UNSIGNED DEFAULT NULL,
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
                         `openid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户表';


-- --------------------------------------------------------

--
-- 表的结构 `tb_verificationcode`
--

CREATE TABLE `tb_verificationcode` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `verificationcode` varchar(50) DEFAULT NULL,
                                     `source` varchar(100) DEFAULT NULL COMMENT '注册，绑定，支付',
                                     `sourceid` int(10) UNSIGNED DEFAULT NULL COMMENT '前端发起动态密码验证，生成一次性guid，验证使用',
                                     `phoneno` varchar(20) DEFAULT NULL COMMENT '手机号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='动态密码验证表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_warehousing`
--

CREATE TABLE `tb_warehousing` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `arrivalid` int(10) UNSIGNED DEFAULT NULL,
                                `entrydate` datetime NOT NULL,
                                `warehouse_id` int(10) UNSIGNED NOT NULL,
                                `season` int(10) UNSIGNED DEFAULT NULL,
                                `seasontype` varchar(1) DEFAULT NULL COMMENT '0-pre ,1-main ,2-fashion show',
                                `op_id` int(10) UNSIGNED NOT NULL,
                                `memo` varchar(500) DEFAULT NULL,
                                `ischecked` varchar(2) DEFAULT NULL,
                                `isamortized` varchar(2) DEFAULT NULL,
                                `entrycode` varchar(100) DEFAULT NULL,
                                `exchangerate` decimal(16,9) DEFAULT NULL,
                                `corderid` int(10) UNSIGNED DEFAULT NULL,
                                `supplierid` int(10) UNSIGNED NOT NULL,
                                `property` varchar(1) DEFAULT NULL COMMENT '0-自采 1-代销'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='入库单主表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_warehousing_detail`
--

CREATE TABLE `tb_warehousing_detail` (
                                       `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                       `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_create_date` datetime NOT NULL,
                                       `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                       `sys_modify_date` datetime NOT NULL,
                                       `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                       `sys_delete_date` datetime DEFAULT NULL,
                                       `sys_delete_flag` tinyint(4) NOT NULL COMMENT '0-未删除 1-已删除',
                                       `detailid` int(10) UNSIGNED DEFAULT NULL,
                                       `warehousing_id` int(10) UNSIGNED NOT NULL,
                                       `product_id` int(10) UNSIGNED NOT NULL,
                                       `size_id` int(10) UNSIGNED NOT NULL,
                                       `amount` int(11) NOT NULL,
                                       `cost` decimal(16,9) NOT NULL,
                                       `memo` varchar(500) DEFAULT NULL,
                                       `cjj` decimal(16,9) DEFAULT NULL,
                                       `yj` decimal(16,9) DEFAULT NULL,
                                       `sellprice` decimal(16,9) DEFAULT NULL,
                                       `finalcost` decimal(16,9) DEFAULT NULL,
                                       `currencyid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='入库单明细表';

-- --------------------------------------------------------

--
-- 表的结构 `tb_warehousing_fee`
--

CREATE TABLE `tb_warehousing_fee` (
                                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `warehousingid` int(10) UNSIGNED DEFAULT NULL,
                                    `feeid` int(10) UNSIGNED DEFAULT NULL,
                                    `currencyid` int(10) UNSIGNED DEFAULT NULL,
                                    `feeprice` decimal(10,2) DEFAULT NULL,
                                    `payment` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='入库表-费用说明';

-- --------------------------------------------------------

--
-- 表的结构 `trans_brand_code`
--

CREATE TABLE `trans_brand_code` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `brandid` int(10) UNSIGNED DEFAULT NULL,
                                  `code` varchar(50) DEFAULT NULL,
                                  `transcode` varchar(50) DEFAULT NULL,
                                  `unit` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品牌对照表';

-- --------------------------------------------------------

--
-- 表的结构 `trans_color_code`
--

CREATE TABLE `trans_color_code` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `colorid` int(10) UNSIGNED DEFAULT NULL,
                                  `code` varchar(50) DEFAULT NULL,
                                  `transcode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='颜色对照表';

-- --------------------------------------------------------

--
-- 表的结构 `trans_group_code`
--

CREATE TABLE `trans_group_code` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `groupid` int(10) UNSIGNED DEFAULT NULL,
                                  `code` varchar(50) DEFAULT NULL,
                                  `transcode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品类对照表';

-- --------------------------------------------------------

--
-- 表的结构 `trans_size_code`
--

CREATE TABLE `trans_size_code` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                 `typeid` int(10) UNSIGNED DEFAULT NULL,
                                 `code` varchar(50) DEFAULT NULL,
                                 `transcode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='尺码对照表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_afterservice`
--

CREATE TABLE `xs_afterservice` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `memberid` int(10) UNSIGNED DEFAULT NULL,
                                 `salesstaff` int(10) UNSIGNED DEFAULT NULL,
                                 `salesdate` datetime DEFAULT NULL,
                                 `sellspotid` int(10) UNSIGNED DEFAULT NULL,
                                 `saleno` varchar(50) DEFAULT NULL,
                                 `cusname` varchar(50) DEFAULT NULL,
                                 `custel` varchar(50) DEFAULT NULL,
                                 `status` varchar(1) DEFAULT NULL COMMENT '0-接收 1-处理中 2-完结'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='售后单';

-- --------------------------------------------------------

--
-- 表的结构 `xs_afterservice_detail`
--

CREATE TABLE `xs_afterservice_detail` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `afterserviceid` int(10) UNSIGNED DEFAULT NULL,
                                        `detailid` int(10) UNSIGNED DEFAULT NULL,
                                        `count` int(11) DEFAULT NULL,
                                        `describtion` varchar(500) DEFAULT NULL,
                                        `dealtype` varchar(1) DEFAULT NULL COMMENT '0-修理1-保养2-调换3-退货',
                                        `fixdate` datetime DEFAULT NULL,
                                        `fixstuff` int(10) UNSIGNED DEFAULT NULL,
                                        `backdate` datetime DEFAULT NULL,
                                        `backstuff` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='售后单明细';

-- --------------------------------------------------------

--
-- 表的结构 `xs_pre_sales`
--

CREATE TABLE `xs_pre_sales` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `memberid` int(10) UNSIGNED DEFAULT NULL,
                              `pricelistid` int(10) UNSIGNED DEFAULT NULL,
                              `salesstaff` int(10) UNSIGNED DEFAULT NULL,
                              `salesdate` datetime DEFAULT NULL,
                              `sellspotid` int(10) UNSIGNED DEFAULT NULL,
                              `companyid` int(10) UNSIGNED DEFAULT NULL,
                              `saleno` varchar(50) DEFAULT NULL,
                              `salestype` varchar(1) DEFAULT NULL COMMENT '0-零售\r\n            1-批发',
                              `warehouseid` int(10) UNSIGNED DEFAULT NULL,
                              `status` varchar(1) DEFAULT NULL COMMENT '0-预售 1-已转销售 2-作废',
                              `islocal` varchar(1) DEFAULT NULL COMMENT '0-跨境电商 1-线下店铺 2-爱莎商城 3-代销',
                              `downpayment` decimal(16,9) DEFAULT NULL,
                              `remainingfund` decimal(16,9) DEFAULT NULL,
                              `actualprice` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预售主表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_pre_salescode`
--

CREATE TABLE `xs_pre_salescode` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `year` varchar(5) DEFAULT NULL,
                                  `code` varchar(10) DEFAULT NULL,
                                  `month` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预售单号表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_pre_salesdetails`
--

CREATE TABLE `xs_pre_salesdetails` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `sales_id` int(10) UNSIGNED NOT NULL,
                                     `product_id` int(10) UNSIGNED DEFAULT NULL,
                                     `size_id` int(10) UNSIGNED DEFAULT NULL,
                                     `count` int(11) DEFAULT NULL,
                                     `dealprice` decimal(16,9) DEFAULT NULL,
                                     `price` decimal(16,9) DEFAULT NULL,
                                     `rate` decimal(16,9) DEFAULT NULL,
                                     `memo` varchar(500) DEFAULT NULL,
                                     `totalsellprice` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='预售单明细(数量)';

-- --------------------------------------------------------

--
-- 表的结构 `xs_pricelist`
--

CREATE TABLE `xs_pricelist` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `begindate` datetime DEFAULT NULL,
                              `enddate` datetime DEFAULT NULL,
                              `name` varchar(20) DEFAULT NULL,
                              `salesport` int(10) UNSIGNED DEFAULT NULL,
                              `memo` varchar(500) DEFAULT NULL,
                              `priceid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='价格单基础资料 主表\r\n';

-- --------------------------------------------------------

--
-- 表的结构 `xs_pricelistdetails`
--

CREATE TABLE `xs_pricelistdetails` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `productid` int(10) UNSIGNED DEFAULT NULL,
                                     `productprice` decimal(10,2) DEFAULT NULL,
                                     `pricelistid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='价格单基础资料 明细从表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_return`
--

CREATE TABLE `xs_return` (
                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                           `actualprice` decimal(16,9) DEFAULT NULL,
                           `sellspotid` int(10) UNSIGNED DEFAULT NULL,
                           `memberid` int(10) UNSIGNED DEFAULT NULL,
                           `returnstaff` int(10) UNSIGNED DEFAULT NULL,
                           `returndate` datetime DEFAULT NULL,
                           `returnno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='退货单';

-- --------------------------------------------------------

--
-- 表的结构 `xs_returncode`
--

CREATE TABLE `xs_returncode` (
                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `year` varchar(5) DEFAULT NULL,
                               `code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='退货单号表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_sales`
--

CREATE TABLE `xs_sales` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `actualprice` decimal(16,9) DEFAULT NULL,
                          `memberid` int(10) UNSIGNED DEFAULT NULL,
                          `pricelistid` int(10) UNSIGNED DEFAULT NULL,
                          `salesstaff` int(10) UNSIGNED DEFAULT NULL,
                          `salesdate` datetime DEFAULT NULL,
                          `salesmode` varchar(2) DEFAULT NULL COMMENT '0-现金\r\n            1-刷卡\r\n            2-支票\r\n            3-储值卡\r\n            4-转账\r\n            5-协议结算\r\n            6-支付宝\r\n            7-微信支付',
                          `sellspotid` int(10) UNSIGNED DEFAULT NULL,
                          `companyid` int(10) UNSIGNED DEFAULT NULL,
                          `saleno` varchar(50) DEFAULT NULL,
                          `salestype` varchar(1) DEFAULT NULL COMMENT '0-未转 1-已转',
                          `warehouseid` int(10) UNSIGNED DEFAULT NULL,
                          `expressno` varchar(50) DEFAULT NULL,
                          `expresspaidtype` varchar(1) DEFAULT NULL COMMENT '0-预付 1-到付 2-第三方付费 3-储值卡 4-转账 5-协议结算',
                          `expressfee` decimal(16,9) DEFAULT NULL,
                          `expressfeepayid` int(10) UNSIGNED DEFAULT NULL,
                          `status` varchar(1) DEFAULT NULL COMMENT '0-预售 1-已售 2-作废',
                          `expresscomoany` varchar(1) DEFAULT NULL COMMENT '0-顺丰 1-德邦 2-京东 3-其他 4-圆通',
                          `address` int(10) UNSIGNED DEFAULT NULL,
                          `islocal` varchar(1) DEFAULT NULL COMMENT '0-跨境电商 1-线下店铺 2-爱莎商城 3-分公司间调拨销售 4-代销 ',
                          `externalno` varchar(50) DEFAULT NULL,
                          `ischeck` varchar(1) DEFAULT NULL,
                          `sheetid` int(10) UNSIGNED DEFAULT NULL,
                          `type` varchar(1) DEFAULT NULL COMMENT '0-普通 1-扫码 ',
                          `pickingtype` varchar(1) DEFAULT NULL COMMENT '0-自提 1-快递 2-门店直发',
                          `sender` int(10) UNSIGNED DEFAULT NULL,
                          `supplierid` int(10) UNSIGNED DEFAULT NULL,
                          `isjf` varchar(1) DEFAULT NULL COMMENT '0-未使用积分抵扣，1-使用积分抵扣',
                          `dksum` decimal(16,9) DEFAULT NULL,
                          `usedscore` bigint(20) DEFAULT NULL,
                          `exhibitionid` int(10) UNSIGNED DEFAULT NULL,
                          `isused` varchar(1) DEFAULT NULL,
                          `invitesum` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售主表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_salescode`
--

CREATE TABLE `xs_salescode` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `year` varchar(5) DEFAULT NULL,
                              `code` varchar(10) DEFAULT NULL,
                              `month` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售单号表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_salesdetails`
--

CREATE TABLE `xs_salesdetails` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `sales_id` int(10) UNSIGNED NOT NULL,
                                 `product_id` int(10) UNSIGNED DEFAULT NULL,
                                 `size_id` int(10) UNSIGNED DEFAULT NULL,
                                 `count` int(11) DEFAULT NULL,
                                 `dealprice` decimal(16,9) DEFAULT NULL,
                                 `price` decimal(16,9) DEFAULT NULL,
                                 `rate` decimal(16,9) DEFAULT NULL,
                                 `memo` varchar(500) DEFAULT NULL,
                                 `returnid` int(10) UNSIGNED DEFAULT NULL,
                                 `totalsellprice` decimal(16,9) DEFAULT NULL,
                                 `saleno` varchar(50) DEFAULT NULL,
                                 `stockid` int(10) UNSIGNED DEFAULT NULL,
                                 `pricememo` varchar(500) DEFAULT NULL,
                                 `exchangerate` decimal(16,9) DEFAULT NULL,
                                 `totalsellpricebwb` decimal(16,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售单明细(数量)';

-- --------------------------------------------------------

--
-- 表的结构 `xs_sales_card`
--

CREATE TABLE `xs_sales_card` (
                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `actualprice` decimal(16,9) DEFAULT NULL,
                               `memberid` int(10) UNSIGNED DEFAULT NULL,
                               `salesstaff` int(10) UNSIGNED DEFAULT NULL,
                               `salesdate` datetime DEFAULT NULL,
                               `sellspotid` int(10) UNSIGNED DEFAULT NULL,
                               `companyid` int(10) UNSIGNED DEFAULT NULL,
                               `saleno` varchar(50) DEFAULT NULL,
                               `ischeck` varchar(1) DEFAULT NULL,
                               `sheetid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售储值卡主表';

-- --------------------------------------------------------

--
-- 表的结构 `xs_sales_cardetails`
--

CREATE TABLE `xs_sales_cardetails` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `sales_id` int(10) UNSIGNED NOT NULL,
                                     `dealprice` decimal(16,9) DEFAULT NULL,
                                     `price` decimal(16,9) DEFAULT NULL,
                                     `rate` decimal(16,9) DEFAULT NULL,
                                     `memo` varchar(500) DEFAULT NULL,
                                     `totalsellprice` decimal(16,9) DEFAULT NULL,
                                     `stockid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='储值卡销售单明细';

-- --------------------------------------------------------

--
-- 表的结构 `xs_sales_pay`
--

CREATE TABLE `xs_sales_pay` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `sales_id` int(10) UNSIGNED NOT NULL,
                              `paidtype` varchar(5) DEFAULT NULL COMMENT '0-现金\r\n            1-刷卡/银联\r\n            2-支票\r\n            3-储值卡\r\n            4-转账\r\n            5-协议结算\r\n            6-支付宝\r\n            7-微信支付\r\n            8-会员余额支付\r\n            9-刷卡手续费\r\n            10-快递费\r\n            11-返点\r\n            12-积分抵扣\r\n            13-代金券\r\n            14-刷卡/visa\r\n            15.joypay',
                              `ischeck` varchar(1) DEFAULT NULL,
                              `isreturn` varchar(1) DEFAULT NULL,
                              `sheetid` int(10) UNSIGNED DEFAULT NULL,
                              `sum` decimal(16,9) DEFAULT NULL,
                              `memo` varchar(500) DEFAULT NULL,
                              `currencyid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售单付款明细';

-- --------------------------------------------------------

--
-- 表的结构 `zl_ac_cashflow_statement`
--

CREATE TABLE `zl_ac_cashflow_statement` (
                                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                          `sys_create_date` datetime NOT NULL,
                                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                          `sys_modify_date` datetime NOT NULL,
                                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                          `parentid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='现金流量表格式';

-- --------------------------------------------------------

--
-- 表的结构 `zl_ac_cashflow_subject`
--

CREATE TABLE `zl_ac_cashflow_subject` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                        `sys_delete_date` datetime DEFAULT NULL,
                                        `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                        `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                        `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                        `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                        `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                        `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                        `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                        `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                        `sorf` varchar(1) DEFAULT NULL COMMENT '0-正，1-负'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='现金流量项目';

-- --------------------------------------------------------

--
-- 表的结构 `zl_ac_km`
--

CREATE TABLE `zl_ac_km` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                          `code` char(1) NOT NULL,
                          `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                          `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                          `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                          `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                          `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                          `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                          `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                          `km_type_id` int(10) UNSIGNED NOT NULL,
                          `up_km_id` int(10) UNSIGNED DEFAULT NULL,
                          `is_havexj` varchar(1) NOT NULL COMMENT '0-没有,1-有',
                          `jord` varchar(1) NOT NULL COMMENT 'j-借方,d-贷方',
                          `companyid` int(10) UNSIGNED NOT NULL,
                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='科目表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_ac_km_type`
--

CREATE TABLE `zl_ac_km_type` (
                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                               `code` varchar(1) NOT NULL,
                               `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                               `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                               `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                               `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                               `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                               `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                               `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='科目类别';

-- --------------------------------------------------------

--
-- 表的结构 `zl_ac_pzh_rule`
--

CREATE TABLE `zl_ac_pzh_rule` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `rulecode` varchar(50) DEFAULT NULL,
                                `kmid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='凭证科目规则';

-- --------------------------------------------------------

--
-- 表的结构 `zl_ac_pzh_type`
--

CREATE TABLE `zl_ac_pzh_type` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `ztid` int(10) UNSIGNED NOT NULL,
                                `code` varchar(4) NOT NULL,
                                `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='现金、银行、转账';

-- --------------------------------------------------------

--
-- 表的结构 `zl_ac_ztb`
--

CREATE TABLE `zl_ac_ztb` (
                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
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
                           `companyid` int(10) UNSIGNED NOT NULL,
                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='帐套表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_ageseason`
--

CREATE TABLE `zl_ageseason` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `name` varchar(100) DEFAULT NULL,
                              `memo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='年代季节';

-- --------------------------------------------------------

--
-- 表的结构 `zl_aliases`
--

CREATE TABLE `zl_aliases` (
                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                            `brandid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

-- --------------------------------------------------------

--
-- 表的结构 `zl_bankinformation`
--

CREATE TABLE `zl_bankinformation` (
                                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                    `supplierid` int(10) UNSIGNED DEFAULT NULL,
                                    `currency` int(10) UNSIGNED DEFAULT NULL,
                                    `account` varchar(50) DEFAULT NULL,
                                    `isused` varchar(1) DEFAULT NULL COMMENT '0-常用，1-禁用',
                                    `memo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='银行信息';

-- --------------------------------------------------------

--
-- 表的结构 `zl_brand`
--

CREATE TABLE `zl_brand` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                          `countryid` int(10) UNSIGNED DEFAULT NULL,
                          `brandgroupid` int(10) UNSIGNED DEFAULT NULL,
                          `imageurl` varchar(100) DEFAULT NULL,
                          `childbrand` int(10) UNSIGNED DEFAULT NULL,
                          `description` varchar(1000) DEFAULT NULL,
                          `imagestream` varchar(200) DEFAULT NULL,
                          `memo` text,
                          `supplier` int(10) UNSIGNED DEFAULT NULL,
                          `officialwebsite` varchar(500) DEFAULT NULL,
                          `isauthorized` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品牌表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_brandgroup`
--

CREATE TABLE `zl_brandgroup` (
                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                               `sys_delete_date` datetime DEFAULT NULL,
                               `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                               `code` varchar(50) DEFAULT NULL,
                               `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                               `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                               `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                               `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                               `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                               `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                               `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品类表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_brandmemo`
--

CREATE TABLE `zl_brandmemo` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `brandid` int(10) UNSIGNED DEFAULT NULL,
                              `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                              `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                              `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                              `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                              `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                              `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                              `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                              `memo` varchar(100) DEFAULT NULL,
                              `pic` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='品牌颜色材质备注';

-- --------------------------------------------------------

--
-- 表的结构 `zl_businesstype`
--

CREATE TABLE `zl_businesstype` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                 `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                 `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                 `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                 `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                 `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                 `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='业务类型';

-- --------------------------------------------------------

--
-- 表的结构 `zl_childproductgroup`
--

CREATE TABLE `zl_childproductgroup` (
                                      `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                      `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                      `productgroupid` int(10) UNSIGNED DEFAULT NULL,
                                      `producttemplateid` int(10) UNSIGNED DEFAULT NULL,
                                      `weight` decimal(16,9) DEFAULT NULL,
                                      `isfj` varchar(1) DEFAULT NULL COMMENT '0-否 1-法检',
                                      `cname4male` int(10) UNSIGNED DEFAULT NULL,
                                      `cname4female` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='子品类';

-- --------------------------------------------------------

--
-- 表的结构 `zl_closedway`
--

CREATE TABLE `zl_closedway` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                              `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='闭合方式';

-- --------------------------------------------------------

--
-- 表的结构 `zl_color`
--

CREATE TABLE `zl_color` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                          `asacolorid` int(10) UNSIGNED DEFAULT NULL,
                          `brandid` int(10) UNSIGNED DEFAULT NULL,
                          `imagestream` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='其他品牌颜色模板';

-- --------------------------------------------------------

--
-- 表的结构 `zl_colortemplate`
--

CREATE TABLE `zl_colortemplate` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                  `colortype` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='asa颜色模板';

-- --------------------------------------------------------

--
-- 表的结构 `zl_companycontacts`
--

CREATE TABLE `zl_companycontacts` (
                                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                    `useid` int(10) UNSIGNED DEFAULT NULL,
                                    `address` varchar(500) DEFAULT NULL,
                                    `zipcode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='联系人\r\n';

-- --------------------------------------------------------

--
-- 表的结构 `zl_costformula`
--

CREATE TABLE `zl_costformula` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `productpriceid` int(10) UNSIGNED DEFAULT NULL,
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
                                `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='成本计算公式';

-- --------------------------------------------------------

--
-- 表的结构 `zl_country`
--

CREATE TABLE `zl_country` (
                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                            `code` varchar(20) NOT NULL,
                            `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                            `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                            `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                            `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                            `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                            `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                            `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `localcurrency` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='国家表';


-- --------------------------------------------------------

--
-- 表的结构 `zl_currency`
--

CREATE TABLE `zl_currency` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                             `userflag` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='币种表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_customs_name`
--

CREATE TABLE `zl_customs_name` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                 `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                 `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                 `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                 `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                 `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                 `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                 `memo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品报关名称\r\n';

-- --------------------------------------------------------

--
-- 表的结构 `zl_decade`
--

CREATE TABLE `zl_decade` (
                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                           `decade` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品年代';

-- --------------------------------------------------------

--
-- 表的结构 `zl_delare_makings`
--

CREATE TABLE `zl_delare_makings` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                   `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                   `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                   `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                   `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                   `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                   `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                   `memo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='申报要素';

-- --------------------------------------------------------

--
-- 表的结构 `zl_exchangerate`
--

CREATE TABLE `zl_exchangerate` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `exchangeratedate` varchar(50) DEFAULT NULL,
                                 `exportcurrency` int(10) UNSIGNED DEFAULT NULL COMMENT '汇出币种',
                                 `importcurrency` int(10) UNSIGNED DEFAULT NULL COMMENT '汇入币种',
                                 `exchangerate` decimal(10,5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='汇率';

-- --------------------------------------------------------

--
-- 表的结构 `zl_executioncategory`
--

CREATE TABLE `zl_executioncategory` (
                                      `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                      `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                      `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='执行标准';

-- --------------------------------------------------------

--
-- 表的结构 `zl_exhibition`
--

CREATE TABLE `zl_exhibition` (
                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                               `status` varchar(1) DEFAULT NULL COMMENT '0-不可用 1-可用'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='展会';

-- --------------------------------------------------------

--
-- 表的结构 `zl_ex_reportstyle`
--

CREATE TABLE `zl_ex_reportstyle` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                   `companyid` int(10) UNSIGNED DEFAULT NULL,
                                   `picid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='快递单样式主表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_ex_reportstyle_detail`
--

CREATE TABLE `zl_ex_reportstyle_detail` (
                                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                          `sys_create_date` datetime NOT NULL,
                                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                          `sys_modify_date` datetime NOT NULL,
                                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                          `sys_delete_date` datetime DEFAULT NULL,
                                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                          `type_id` int(10) UNSIGNED DEFAULT NULL,
                                          `tdfield` varchar(200) DEFAULT NULL,
                                          `tdfieldx` int(11) DEFAULT NULL,
                                          `tdfieldy` int(11) DEFAULT NULL,
                                          `tdfieldwidth` int(11) DEFAULT NULL,
                                          `tdfieldheight` int(11) DEFAULT NULL,
                                          `is_visiable` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='快递单样式明细表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_feenames`
--

CREATE TABLE `zl_feenames` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                             `kmid` int(10) UNSIGNED DEFAULT NULL,
                             `isamortize` tinyint(4) DEFAULT NULL COMMENT '0-不摊销 1-金额摊销 2-件数摊销',
                             `isused` varchar(1) DEFAULT NULL COMMENT '0-不常用 1-常用'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='费用名称';

-- --------------------------------------------------------

--
-- 表的结构 `zl_forbiddenword`
--

CREATE TABLE `zl_forbiddenword` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                  `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='违禁词';

-- --------------------------------------------------------

--
-- 表的结构 `zl_imagetool`
--

CREATE TABLE `zl_imagetool` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                              `quality` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='图片导出方式';

-- --------------------------------------------------------

--
-- 表的结构 `zl_invite_rule`
--

CREATE TABLE `zl_invite_rule` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `bonus` bigint(20) DEFAULT NULL,
                                `memo_cn` text COMMENT '中文备注',
                                `memo_en` text COMMENT '英文备注',
                                `memo_hk` text COMMENT '粤语备注',
                                `memo_fr` text COMMENT '法语备注',
                                `memo_it` text COMMENT '意大利语备注',
                                `memo_sp` text COMMENT '西班牙语备注',
                                `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员邀请规则';

-- --------------------------------------------------------

--
-- 表的结构 `zl_invoice_header`
--

CREATE TABLE `zl_invoice_header` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `supplierid` int(10) UNSIGNED DEFAULT NULL,
                                   `header` varchar(50) DEFAULT NULL,
                                   `memo_cn` text COMMENT '中文备注',
                                   `memo_en` text COMMENT '英文备注',
                                   `memo_hk` text COMMENT '粤语备注',
                                   `memo_fr` text COMMENT '法语备注',
                                   `memo_it` text COMMENT '意大利语备注',
                                   `memo_sp` text COMMENT '西班牙语备注',
                                   `memo_de` text COMMENT '德语备注',
                                   `isdefault` varchar(1) DEFAULT NULL COMMENT '1-默认 0-非默认'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='客户 发票抬头';

-- --------------------------------------------------------

--
-- 表的结构 `zl_language`
--

CREATE TABLE `zl_language` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `name` varchar(50) NOT NULL,
                             `code` varchar(20) NOT NULL,
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='语言表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_material`
--

CREATE TABLE `zl_material` (
                             `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                             `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_create_date` datetime NOT NULL,
                             `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                             `sys_modify_date` datetime NOT NULL,
                             `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                             `sys_delete_date` datetime DEFAULT NULL,
                             `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                             `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                             `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                             `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                             `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                             `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                             `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                             `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                             `code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='材质';

-- --------------------------------------------------------

--
-- 表的结构 `zl_materialnote`
--

CREATE TABLE `zl_materialnote` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `content_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                 `content_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                 `content_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                 `content_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                 `content_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                 `content_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                 `content_de` varchar(100) DEFAULT NULL COMMENT '德语名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='材质备注';

-- --------------------------------------------------------

--
-- 表的结构 `zl_materialstatus`
--

CREATE TABLE `zl_materialstatus` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `code` varchar(20) DEFAULT NULL,
                                   `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                   `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                   `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                   `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                   `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                   `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                   `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='材质状态';

-- --------------------------------------------------------

--
-- 表的结构 `zl_memberlevel`
--

CREATE TABLE `zl_memberlevel` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                `isretail` varchar(1) DEFAULT NULL COMMENT '0-非零售等级，不能升级，1-零售等级，可以升级'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员等级设置';

-- --------------------------------------------------------

--
-- 表的结构 `zl_occasionsstyle`
--

CREATE TABLE `zl_occasionsstyle` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                   `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                   `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                   `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                   `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                   `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                   `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                   `occasionsstylemode` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='场合风格';

-- --------------------------------------------------------

--
-- 表的结构 `zl_pricesource`
--

CREATE TABLE `zl_pricesource` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='价格来源';

-- --------------------------------------------------------

--
-- 表的结构 `zl_productdscrb`
--

CREATE TABLE `zl_productdscrb` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                 `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品描述';

-- --------------------------------------------------------

--
-- 表的结构 `zl_productinnards`
--

CREATE TABLE `zl_productinnards` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                   `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                   `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                   `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                   `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                   `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                   `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='内部结构';

-- --------------------------------------------------------

--
-- 表的结构 `zl_productparts`
--

CREATE TABLE `zl_productparts` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                 `packflag` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='附带配件\r\n';

-- --------------------------------------------------------

--
-- 表的结构 `zl_productprice`
--

CREATE TABLE `zl_productprice` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                 `curreancyid` int(10) UNSIGNED DEFAULT NULL,
                                 `sortnum` varchar(4) DEFAULT NULL,
                                 `isround` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品销售价格 国内外零售价、批发价';

-- --------------------------------------------------------

--
-- 表的结构 `zl_productstyle`
--

CREATE TABLE `zl_productstyle` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `brandgroup` int(10) UNSIGNED DEFAULT NULL,
                                 `childbrand` int(10) UNSIGNED DEFAULT NULL,
                                 `productstyle` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品款号';

-- --------------------------------------------------------

--
-- 表的结构 `zl_producttemplate`
--

CREATE TABLE `zl_producttemplate` (
                                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                    `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                    `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                    `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                    `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                    `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                    `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                    `picture` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品模板-主表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_quotedprice`
--

CREATE TABLE `zl_quotedprice` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                `quoteddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='zl_quotedprice';

-- --------------------------------------------------------

--
-- 表的结构 `zl_reportset`
--

CREATE TABLE `zl_reportset` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                              `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='报表样式设置';

-- --------------------------------------------------------

--
-- 表的结构 `zl_reportset_detail`
--

CREATE TABLE `zl_reportset_detail` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                     `sys_delete_date` datetime DEFAULT NULL,
                                     `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                     `setid` int(10) UNSIGNED DEFAULT NULL,
                                     `code_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                     `code_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                     `code_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                     `code_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                     `code_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                     `code_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                     `code_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                     `index` int(11) DEFAULT NULL,
                                     `width` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='报表样式设置明细';

-- --------------------------------------------------------

--
-- 表的结构 `zl_salesmethods`
--

CREATE TABLE `zl_salesmethods` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                 `brandtype` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售方式';

-- --------------------------------------------------------

--
-- 表的结构 `zl_salesport`
--

CREATE TABLE `zl_salesport` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                              `cusid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口基础资料';

-- --------------------------------------------------------

--
-- 表的结构 `zl_salesport_mission`
--

CREATE TABLE `zl_salesport_mission` (
                                      `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                      `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_create_date` datetime NOT NULL,
                                      `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                      `sys_modify_date` datetime NOT NULL,
                                      `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                      `sys_delete_date` datetime DEFAULT NULL,
                                      `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                      `salespotid` int(10) UNSIGNED DEFAULT NULL,
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
                                      `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='销售端口任务额';

-- --------------------------------------------------------

--
-- 表的结构 `zl_securitycategory`
--

CREATE TABLE `zl_securitycategory` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                     `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_create_date` datetime NOT NULL,
                                     `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                     `sys_modify_date` datetime NOT NULL,
                                     `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                     `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='安全类别维护表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_series`
--

CREATE TABLE `zl_series` (
                           `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                           `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_create_date` datetime NOT NULL,
                           `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                           `sys_modify_date` datetime NOT NULL,
                           `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                           `sys_delete_date` datetime DEFAULT NULL,
                           `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                           `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                           `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                           `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                           `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                           `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                           `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                           `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                           `code_cn` varchar(100) DEFAULT NULL COMMENT '中文代码名称',
                           `code_en` varchar(100) DEFAULT NULL COMMENT '英文代码名称',
                           `code_hk` varchar(100) DEFAULT NULL COMMENT '粤语代码名称',
                           `code_fr` varchar(100) DEFAULT NULL COMMENT '法语代码名称',
                           `code_it` varchar(100) DEFAULT NULL COMMENT '意大利语代码名称',
                           `code_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语代码名称',
                           `code_de` varchar(100) DEFAULT NULL COMMENT '德语代码名称',
                           `brandid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

-- --------------------------------------------------------

--
-- 表的结构 `zl_series2`
--

CREATE TABLE `zl_series2` (
                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `seriesid` int(10) UNSIGNED DEFAULT NULL,
                            `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                            `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                            `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                            `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                            `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                            `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                            `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                            `code_cn` varchar(100) DEFAULT NULL COMMENT '中文代码名称',
                            `code_en` varchar(100) DEFAULT NULL COMMENT '英文代码名称',
                            `code_hk` varchar(100) DEFAULT NULL COMMENT '粤语代码名称',
                            `code_fr` varchar(100) DEFAULT NULL COMMENT '法语代码名称',
                            `code_it` varchar(100) DEFAULT NULL COMMENT '意大利语代码名称',
                            `code_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语代码名称',
                            `code_de` varchar(100) DEFAULT NULL COMMENT '德语代码名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='子系列';

-- --------------------------------------------------------

--
-- 表的结构 `zl_shippingtype`
--

CREATE TABLE `zl_shippingtype` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                 `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='运输方式';

-- --------------------------------------------------------

--
-- 表的结构 `zl_sizecontent`
--

CREATE TABLE `zl_sizecontent` (
                                `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_create_date` datetime NOT NULL,
                                `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                `sys_modify_date` datetime NOT NULL,
                                `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                `sys_delete_date` datetime DEFAULT NULL,
                                `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                `topid` int(10) UNSIGNED DEFAULT NULL,
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
                                `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='尺码明细';

-- --------------------------------------------------------

--
-- 表的结构 `zl_sizetop`
--

CREATE TABLE `zl_sizetop` (
                            `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                            `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_create_date` datetime NOT NULL,
                            `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                            `sys_modify_date` datetime NOT NULL,
                            `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                            `sys_delete_date` datetime DEFAULT NULL,
                            `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                            `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                            `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                            `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                            `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                            `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                            `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                            `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                            `code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='尺码组';

-- --------------------------------------------------------

--
-- 表的结构 `zl_storemove`
--

CREATE TABLE `zl_storemove` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `productid` int(10) UNSIGNED DEFAULT NULL,
                              `storeid` int(10) UNSIGNED DEFAULT NULL,
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
                              `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='??未使用';

-- --------------------------------------------------------

--
-- 表的结构 `zl_style`
--

CREATE TABLE `zl_style` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                          `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_create_date` datetime NOT NULL,
                          `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                          `sys_modify_date` datetime NOT NULL,
                          `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                          `sys_delete_date` datetime DEFAULT NULL,
                          `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                          `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                          `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                          `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                          `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                          `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                          `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                          `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                          `stylemode` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='未使用';

-- --------------------------------------------------------

--
-- 表的结构 `zl_supplierlevel`
--

CREATE TABLE `zl_supplierlevel` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                  `memo_de` varchar(1000) DEFAULT NULL COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='供货商级别';

-- --------------------------------------------------------

--
-- 表的结构 `zl_supplier_type`
--

CREATE TABLE `zl_supplier_type` (
                                  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                  `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_create_date` datetime NOT NULL,
                                  `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                  `sys_modify_date` datetime NOT NULL,
                                  `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                  `sys_delete_date` datetime DEFAULT NULL,
                                  `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                  `supplierid` int(10) UNSIGNED DEFAULT NULL,
                                  `type` varchar(1) DEFAULT NULL COMMENT '0-供货商 1-报关行 2-供应商 3-承运人 4-客户'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='关系单位类型';

-- --------------------------------------------------------

--
-- 表的结构 `zl_sys_selfcompany`
--

CREATE TABLE `zl_sys_selfcompany` (
                                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `supplier_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='分公司列表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_templatelist`
--

CREATE TABLE `zl_templatelist` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `templateid` int(10) UNSIGNED DEFAULT NULL,
                                 `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                 `content_cn` varchar(1000) DEFAULT NULL COMMENT '中文备注',
                                 `content_en` varchar(1000) DEFAULT NULL COMMENT '英文备注',
                                 `content_hk` varchar(1000) DEFAULT NULL COMMENT '粤语备注',
                                 `content_fr` varchar(1000) DEFAULT NULL COMMENT '法语备注',
                                 `content_it` varchar(1000) DEFAULT NULL COMMENT '意大利语备注',
                                 `content_sp` varchar(1000) DEFAULT NULL COMMENT '西班牙语备注',
                                 `content_de` varchar(1000) DEFAULT NULL COMMENT '德语备注',
                                 `productid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品模板-数据表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_templatemanage`
--

CREATE TABLE `zl_templatemanage` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                   `sys_delete_date` datetime DEFAULT NULL,
                                   `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                   `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                                   `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                                   `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                                   `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                                   `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                                   `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                                   `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                                   `tempid` int(10) UNSIGNED DEFAULT NULL,
                                   `sortnum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品模板-从表';

-- --------------------------------------------------------

--
-- 表的结构 `zl_template_descrb`
--

CREATE TABLE `zl_template_descrb` (
                                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_create_date` datetime NOT NULL,
                                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                    `sys_modify_date` datetime NOT NULL,
                                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                    `sys_delete_date` datetime DEFAULT NULL,
                                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                    `tempid` int(10) UNSIGNED DEFAULT NULL,
                                    `sizetopid` int(10) UNSIGNED DEFAULT NULL,
                                    `sizeid` int(10) UNSIGNED DEFAULT NULL,
                                    `baselenth` decimal(10,2) DEFAULT NULL,
                                    `lenth` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品模板-尺码大小描述';

-- --------------------------------------------------------

--
-- 表的结构 `zl_trans_code`
--

CREATE TABLE `zl_trans_code` (
                               `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                               `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_create_date` datetime NOT NULL,
                               `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                               `sys_modify_date` datetime NOT NULL,
                               `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                               `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='接口基础资料';

-- --------------------------------------------------------

--
-- 表的结构 `zl_ulnarinch`
--

CREATE TABLE `zl_ulnarinch` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                              `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                              `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                              `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                              `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                              `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                              `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

-- --------------------------------------------------------

--
-- 表的结构 `zl_unit`
--

CREATE TABLE `zl_unit` (
                         `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                         `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_create_date` datetime NOT NULL,
                         `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                         `sys_modify_date` datetime NOT NULL,
                         `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                         `sys_delete_date` datetime DEFAULT NULL,
                         `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                         `name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
                         `name_en` varchar(100) DEFAULT NULL COMMENT '英文名称',
                         `name_hk` varchar(100) DEFAULT NULL COMMENT '粤语名称',
                         `name_fr` varchar(100) DEFAULT NULL COMMENT '法语名称',
                         `name_it` varchar(100) DEFAULT NULL COMMENT '意大利语名称',
                         `name_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语名称',
                         `name_de` varchar(100) DEFAULT NULL COMMENT '德语名称',
                         `unitgroupid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='未使用';

-- --------------------------------------------------------

--
-- 表的结构 `zl_unitgroup`
--

CREATE TABLE `zl_unitgroup` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                              `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='zl_unitgroup';

-- --------------------------------------------------------

--
-- 表的结构 `zl_warehouse`
--

CREATE TABLE `zl_warehouse` (
                              `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                              `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_create_date` datetime NOT NULL,
                              `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                              `sys_modify_date` datetime NOT NULL,
                              `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                              `sys_delete_date` datetime DEFAULT NULL,
                              `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                              `countryid` int(11) DEFAULT NULL COMMENT '国家ID',
                              `city_cn` varchar(100) DEFAULT NULL COMMENT '中文城市名称',
                              `city_en` varchar(100) DEFAULT NULL COMMENT '英文城市名称',
                              `city_hk` varchar(100) DEFAULT NULL COMMENT '粤语城市名称',
                              `city_fr` varchar(100) DEFAULT NULL COMMENT '法语城市名称',
                              `city_it` varchar(100) DEFAULT NULL COMMENT '意大利语城市名称',
                              `city_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语城市名称',
                              `city_de` varchar(100) DEFAULT NULL COMMENT '德语城市名称',
                              `storename_cn` varchar(100) DEFAULT NULL COMMENT '中文仓库名称',
                              `storename_en` varchar(100) DEFAULT NULL COMMENT '英文仓库名称',
                              `storename_hk` varchar(100) DEFAULT NULL COMMENT '粤语仓库名称',
                              `storename_fr` varchar(100) DEFAULT NULL COMMENT '法语仓库名称',
                              `storename_it` varchar(100) DEFAULT NULL COMMENT '意大利语仓库名称',
                              `storename_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语仓库名称',
                              `storename_de` varchar(100) DEFAULT NULL COMMENT '德语仓库名称',
                              `storeaddress_cn` varchar(100) DEFAULT NULL COMMENT '中文仓库地址',
                              `storeaddress_en` varchar(100) DEFAULT NULL COMMENT '英文仓库地址',
                              `storeaddress_hk` varchar(100) DEFAULT NULL COMMENT '粤语仓库地址',
                              `storeaddress_fr` varchar(100) DEFAULT NULL COMMENT '法语仓库地址',
                              `storeaddress_it` varchar(100) DEFAULT NULL COMMENT '意大利语仓库地址',
                              `storeaddress_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语仓库地址',
                              `storeaddress_de` varchar(100) DEFAULT NULL COMMENT '德语仓库地址',
                              `contact_cn` varchar(100) DEFAULT NULL COMMENT '中文联系人',
                              `contact_en` varchar(100) DEFAULT NULL COMMENT '英文联系人',
                              `contact_hk` varchar(100) DEFAULT NULL COMMENT '粤语联系人',
                              `contact_fr` varchar(100) DEFAULT NULL COMMENT '法语联系人',
                              `contact_it` varchar(100) DEFAULT NULL COMMENT '意大利语联系人',
                              `contact_sp` varchar(100) DEFAULT NULL COMMENT '西班牙语联系人',
                              `contact_de` varchar(100) DEFAULT NULL COMMENT '德语联系人',
                              `toll` varchar(20) DEFAULT NULL,
                              `fax` varchar(20) DEFAULT NULL,
                              `mobile` varchar(20) DEFAULT NULL,
                              `othercontact` varchar(50) DEFAULT NULL,
                              `code` varchar(20) DEFAULT NULL,
                              `defaultstore` varchar(1) DEFAULT NULL,
                              `zipcode` varchar(10) DEFAULT NULL,
                              `is_real` varchar(1) DEFAULT NULL,
                              `maxstock` bigint(20) DEFAULT NULL,
                              `maxsku` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='仓库信息';

-- --------------------------------------------------------

--
-- 表的结构 `zl_washinginstructions`
--

CREATE TABLE `zl_washinginstructions` (
                                        `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                        `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_create_date` datetime NOT NULL,
                                        `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                        `sys_modify_date` datetime NOT NULL,
                                        `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                        `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='洗涤标准';

-- --------------------------------------------------------

--
-- 表的结构 `zl_winterproofing`
--

CREATE TABLE `zl_winterproofing` (
                                   `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                   `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_create_date` datetime NOT NULL,
                                   `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                   `sys_modify_date` datetime NOT NULL,
                                   `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
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
                                   `memo_de` text COMMENT '德语备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='防寒指数';

-- --------------------------------------------------------

--
-- 表的结构 `zl_yearexchange`
--

CREATE TABLE `zl_yearexchange` (
                                 `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                                 `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_create_date` datetime NOT NULL,
                                 `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                                 `sys_modify_date` datetime NOT NULL,
                                 `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                                 `sys_delete_date` datetime DEFAULT NULL,
                                 `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除',
                                 `yeardate` varchar(50) DEFAULT NULL,
                                 `money` decimal(16,9) DEFAULT NULL COMMENT 'import:export',
                                 `begintime` datetime DEFAULT NULL,
                                 `endtime` datetime DEFAULT NULL,
                                 `import` int(10) UNSIGNED DEFAULT NULL,
                                 `export` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

-- --------------------------------------------------------

--
-- 表的结构 `模版`
--

CREATE TABLE `模版` (
                    `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
                    `sys_create_stuff` int(10) UNSIGNED NOT NULL,
                    `sys_create_date` datetime NOT NULL,
                    `sys_modify_stuff` int(10) UNSIGNED NOT NULL,
                    `sys_modify_date` datetime NOT NULL,
                    `sys_delete_stuff` int(10) UNSIGNED DEFAULT NULL,
                    `sys_delete_date` datetime DEFAULT NULL,
                    `sys_delete_flag` tinyint(1) DEFAULT '0' COMMENT '0-未删除 1-已删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='任何表都应该包含的列';

--
-- 转储表的索引
--

--
-- 表的索引 `ac_invoice`
--
ALTER TABLE `ac_invoice`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ac_invoice_fee`
--
ALTER TABLE `ac_invoice_fee`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ac_invoice_fee_detail`
--
ALTER TABLE `ac_invoice_fee_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ac_invoice_prepay`
--
ALTER TABLE `ac_invoice_prepay`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ac_kmyue_wb`
--
ALTER TABLE `ac_kmyue_wb`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ac_pzhb`
--
ALTER TABLE `ac_pzhb`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ac_pzhh`
--
ALTER TABLE `ac_pzhh`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ac_pzhmxb`
--
ALTER TABLE `ac_pzhmxb`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ac_sf_sheet`
--
ALTER TABLE `ac_sf_sheet`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ac_sf_sheet_code`
--
ALTER TABLE `ac_sf_sheet_code`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ac_sf_sheet_refund`
--
ALTER TABLE `ac_sf_sheet_refund`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dd_arrivalnotice`
--
ALTER TABLE `dd_arrivalnotice`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dd_arrivalnotice_detail`
--
ALTER TABLE `dd_arrivalnotice_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dd_confirmorder`
--
ALTER TABLE `dd_confirmorder`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dd_corderdetails`
--
ALTER TABLE `dd_corderdetails`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dd_corder_ctn`
--
ALTER TABLE `dd_corder_ctn`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dd_corder_temp`
--
ALTER TABLE `dd_corder_temp`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dd_fee`
--
ALTER TABLE `dd_fee`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dd_order`
--
ALTER TABLE `dd_order`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dd_ordercode`
--
ALTER TABLE `dd_ordercode`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dd_orderdetails`
--
ALTER TABLE `dd_orderdetails`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dd_quotation`
--
ALTER TABLE `dd_quotation`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dd_quotation_detail`
--
ALTER TABLE `dd_quotation_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_cfashion`
--
ALTER TABLE `if_cfashion`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_exception`
--
ALTER TABLE `if_exception`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_imgorder`
--
ALTER TABLE `if_imgorder`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_jingdong`
--
ALTER TABLE `if_jingdong`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_meilihui`
--
ALTER TABLE `if_meilihui`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_meixi`
--
ALTER TABLE `if_meixi`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_ofashion`
--
ALTER TABLE `if_ofashion`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_shangpin`
--
ALTER TABLE `if_shangpin`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_shangpin_direct`
--
ALTER TABLE `if_shangpin_direct`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_siku`
--
ALTER TABLE `if_siku`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_sxdzb`
--
ALTER TABLE `if_sxdzb`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_zhenpin`
--
ALTER TABLE `if_zhenpin`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `if_zouxiu`
--
ALTER TABLE `if_zouxiu`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_actual_to_productstock`
--
ALTER TABLE `link_actual_to_productstock`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_barcode_to_size`
--
ALTER TABLE `link_barcode_to_size`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_brandgroup_to_supplier`
--
ALTER TABLE `link_brandgroup_to_supplier`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_brand_to_brandgroup`
--
ALTER TABLE `link_brand_to_brandgroup`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_brand_to_discount`
--
ALTER TABLE `link_brand_to_discount`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_brand_to_priced`
--
ALTER TABLE `link_brand_to_priced`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_cdetail_to_ddetail`
--
ALTER TABLE `link_cdetail_to_ddetail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_childbrand_to_execution`
--
ALTER TABLE `link_childbrand_to_execution`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_childbrand_to_innards`
--
ALTER TABLE `link_childbrand_to_innards`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_childbrand_to_material`
--
ALTER TABLE `link_childbrand_to_material`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_childbrand_to_outinnards`
--
ALTER TABLE `link_childbrand_to_outinnards`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_childbrand_to_safety`
--
ALTER TABLE `link_childbrand_to_safety`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_color_to_brand`
--
ALTER TABLE `link_color_to_brand`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_contacts_to_supplier`
--
ALTER TABLE `link_contacts_to_supplier`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_ctn_to_cdetail`
--
ALTER TABLE `link_ctn_to_cdetail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_data_to_file`
--
ALTER TABLE `link_data_to_file`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_department_to_salesport`
--
ALTER TABLE `link_department_to_salesport`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_detail_to_detail`
--
ALTER TABLE `link_detail_to_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_distribute_to_cdetail`
--
ALTER TABLE `link_distribute_to_cdetail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_group_to_navigation`
--
ALTER TABLE `link_group_to_navigation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reference_link_group_to_navigation_to_group` (`groupid`);

--
-- 表的索引 `link_invoice_to_order`
--
ALTER TABLE `link_invoice_to_order`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_invoice_to_requisition`
--
ALTER TABLE `link_invoice_to_requisition`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_invoice_to_warehousing`
--
ALTER TABLE `link_invoice_to_warehousing`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_kp_to_store`
--
ALTER TABLE `link_kp_to_store`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_prep_to_productstock`
--
ALTER TABLE `link_prep_to_productstock`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_pricelist_to_salesport`
--
ALTER TABLE `link_pricelist_to_salesport`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_closedway`
--
ALTER TABLE `link_product_to_closedway`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_decade`
--
ALTER TABLE `link_product_to_decade`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_dscrb`
--
ALTER TABLE `link_product_to_dscrb`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_marketprice`
--
ALTER TABLE `link_product_to_marketprice`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_material`
--
ALTER TABLE `link_product_to_material`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_material2`
--
ALTER TABLE `link_product_to_material2`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_materislstatus`
--
ALTER TABLE `link_product_to_materislstatus`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_occasions`
--
ALTER TABLE `link_product_to_occasions`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_origin`
--
ALTER TABLE `link_product_to_origin`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_outproductinnards`
--
ALTER TABLE `link_product_to_outproductinnards`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_picture`
--
ALTER TABLE `link_product_to_picture`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_picture_ftp`
--
ALTER TABLE `link_product_to_picture_ftp`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_price`
--
ALTER TABLE `link_product_to_price`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_price2`
--
ALTER TABLE `link_product_to_price2`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_price_history`
--
ALTER TABLE `link_product_to_price_history`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_productinnards`
--
ALTER TABLE `link_product_to_productinnards`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_productparts`
--
ALTER TABLE `link_product_to_productparts`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_salesnature`
--
ALTER TABLE `link_product_to_salesnature`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_salesport`
--
ALTER TABLE `link_product_to_salesport`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_salesport_history`
--
ALTER TABLE `link_product_to_salesport_history`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_size`
--
ALTER TABLE `link_product_to_size`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_product_to_washinginstructions`
--
ALTER TABLE `link_product_to_washinginstructions`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_pzh_to_invoice`
--
ALTER TABLE `link_pzh_to_invoice`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_pzh_to_invoicefee`
--
ALTER TABLE `link_pzh_to_invoicefee`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_pzh_to_order`
--
ALTER TABLE `link_pzh_to_order`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_pzh_to_sales`
--
ALTER TABLE `link_pzh_to_sales`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_pzh_to_sales_trans`
--
ALTER TABLE `link_pzh_to_sales_trans`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_pzh_to_warehousing_fee`
--
ALTER TABLE `link_pzh_to_warehousing_fee`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_return_to_productstock`
--
ALTER TABLE `link_return_to_productstock`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_rule_to_operation`
--
ALTER TABLE `link_rule_to_operation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reference_link_rule_to_operationto_rule_id` (`ruleid`);

--
-- 表的索引 `link_salespot_to_childbrand`
--
ALTER TABLE `link_salespot_to_childbrand`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_sales_to_productstock`
--
ALTER TABLE `link_sales_to_productstock`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_sellspot_to_brand`
--
ALTER TABLE `link_sellspot_to_brand`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_special_to_productstock`
--
ALTER TABLE `link_special_to_productstock`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_spot_warehouse`
--
ALTER TABLE `link_spot_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_supplier_to_brand`
--
ALTER TABLE `link_supplier_to_brand`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_user_to_labourcontactor`
--
ALTER TABLE `link_user_to_labourcontactor`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_user_to_price`
--
ALTER TABLE `link_user_to_price`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_user_to_reportset`
--
ALTER TABLE `link_user_to_reportset`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_user_to_salesport`
--
ALTER TABLE `link_user_to_salesport`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_user_to_supplier`
--
ALTER TABLE `link_user_to_supplier`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `link_user_to_warehouse`
--
ALTER TABLE `link_user_to_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sys_config`
--
ALTER TABLE `sys_config`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sys_selfcompany`
--
ALTER TABLE `sys_selfcompany`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_card`
--
ALTER TABLE `tb_card`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_check`
--
ALTER TABLE `tb_check`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_check_detail`
--
ALTER TABLE `tb_check_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_company`
--
ALTER TABLE `tb_company`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_contactlist`
--
ALTER TABLE `tb_contactlist`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_declaration`
--
ALTER TABLE `tb_declaration`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_declaration_detail`
--
ALTER TABLE `tb_declaration_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_department`
--
ALTER TABLE `tb_department`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_discount_card`
--
ALTER TABLE `tb_discount_card`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_distribute`
--
ALTER TABLE `tb_distribute`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_distributecode`
--
ALTER TABLE `tb_distributecode`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_express`
--
ALTER TABLE `tb_express`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_fee`
--
ALTER TABLE `tb_fee`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_feecode`
--
ALTER TABLE `tb_feecode`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_fee_detail`
--
ALTER TABLE `tb_fee_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_group`
--
ALTER TABLE `tb_group`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_inve_actual`
--
ALTER TABLE `tb_inve_actual`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_inve_actual_dtl`
--
ALTER TABLE `tb_inve_actual_dtl`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_inve_prep`
--
ALTER TABLE `tb_inve_prep`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_inve_prep_dtl`
--
ALTER TABLE `tb_inve_prep_dtl`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_kp`
--
ALTER TABLE `tb_kp`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_member_address`
--
ALTER TABLE `tb_member_address`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_member_bank`
--
ALTER TABLE `tb_member_bank`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_member_card`
--
ALTER TABLE `tb_member_card`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_member_card_history`
--
ALTER TABLE `tb_member_card_history`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_member_contactor`
--
ALTER TABLE `tb_member_contactor`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_member_header`
--
ALTER TABLE `tb_member_header`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_member_preference`
--
ALTER TABLE `tb_member_preference`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_member_preference_size`
--
ALTER TABLE `tb_member_preference_size`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_member_preordination`
--
ALTER TABLE `tb_member_preordination`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_permission`
--
ALTER TABLE `tb_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_name` (`name`);

--
-- 表的索引 `tb_permission_group`
--
ALTER TABLE `tb_permission_group`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_permission_module`
--
ALTER TABLE `tb_permission_module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_permission_module_permissionid_module_controller_action` (`permissionid`,`module`,`controller`,`action`);

--
-- 表的索引 `tb_picture`
--
ALTER TABLE `tb_picture`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_pre_requisition`
--
ALTER TABLE `tb_pre_requisition`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_productstock`
--
ALTER TABLE `tb_productstock`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_productstock_snapshot`
--
ALTER TABLE `tb_productstock_snapshot`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_product_price`
--
ALTER TABLE `tb_product_price`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_requisition`
--
ALTER TABLE `tb_requisition`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_requisitioncode`
--
ALTER TABLE `tb_requisitioncode`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_requisition_detail`
--
ALTER TABLE `tb_requisition_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_requisition_detail_group`
--
ALTER TABLE `tb_requisition_detail_group`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_requisition_express`
--
ALTER TABLE `tb_requisition_express`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_rule`
--
ALTER TABLE `tb_rule`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_savings_card`
--
ALTER TABLE `tb_savings_card`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_special_requisition`
--
ALTER TABLE `tb_special_requisition`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_special_requisition_detail`
--
ALTER TABLE `tb_special_requisition_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_stock`
--
ALTER TABLE `tb_stock`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_supplier_orderdate`
--
ALTER TABLE `tb_supplier_orderdate`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY (`departmentid`),
  ADD KEY (`groupid`),
  ADD UNIQUE KEY `tb_user_login_name` (`login_name`);

--
-- 表的索引 `tb_verificationcode`
--
ALTER TABLE `tb_verificationcode`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_warehousing`
--
ALTER TABLE `tb_warehousing`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_warehousing_detail`
--
ALTER TABLE `tb_warehousing_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tb_warehousing_fee`
--
ALTER TABLE `tb_warehousing_fee`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `trans_brand_code`
--
ALTER TABLE `trans_brand_code`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `trans_color_code`
--
ALTER TABLE `trans_color_code`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `trans_group_code`
--
ALTER TABLE `trans_group_code`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `trans_size_code`
--
ALTER TABLE `trans_size_code`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_afterservice`
--
ALTER TABLE `xs_afterservice`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_afterservice_detail`
--
ALTER TABLE `xs_afterservice_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_pre_sales`
--
ALTER TABLE `xs_pre_sales`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_pre_salescode`
--
ALTER TABLE `xs_pre_salescode`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_pre_salesdetails`
--
ALTER TABLE `xs_pre_salesdetails`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_pricelist`
--
ALTER TABLE `xs_pricelist`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_pricelistdetails`
--
ALTER TABLE `xs_pricelistdetails`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_return`
--
ALTER TABLE `xs_return`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_returncode`
--
ALTER TABLE `xs_returncode`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_sales`
--
ALTER TABLE `xs_sales`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_salescode`
--
ALTER TABLE `xs_salescode`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_salesdetails`
--
ALTER TABLE `xs_salesdetails`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_sales_card`
--
ALTER TABLE `xs_sales_card`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_sales_cardetails`
--
ALTER TABLE `xs_sales_cardetails`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xs_sales_pay`
--
ALTER TABLE `xs_sales_pay`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_ac_cashflow_statement`
--
ALTER TABLE `zl_ac_cashflow_statement`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_ac_cashflow_subject`
--
ALTER TABLE `zl_ac_cashflow_subject`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_ac_km`
--
ALTER TABLE `zl_ac_km`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_ac_km_type`
--
ALTER TABLE `zl_ac_km_type`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_ac_pzh_rule`
--
ALTER TABLE `zl_ac_pzh_rule`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_ac_pzh_type`
--
ALTER TABLE `zl_ac_pzh_type`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_ac_ztb`
--
ALTER TABLE `zl_ac_ztb`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_ageseason`
--
ALTER TABLE `zl_ageseason`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_aliases`
--
ALTER TABLE `zl_aliases`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_bankinformation`
--
ALTER TABLE `zl_bankinformation`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_brand`
--
ALTER TABLE `zl_brand`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_brandgroup`
--
ALTER TABLE `zl_brandgroup`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_brandmemo`
--
ALTER TABLE `zl_brandmemo`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_businesstype`
--
ALTER TABLE `zl_businesstype`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_childproductgroup`
--
ALTER TABLE `zl_childproductgroup`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_closedway`
--
ALTER TABLE `zl_closedway`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_color`
--
ALTER TABLE `zl_color`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_colortemplate`
--
ALTER TABLE `zl_colortemplate`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_companycontacts`
--
ALTER TABLE `zl_companycontacts`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_costformula`
--
ALTER TABLE `zl_costformula`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_country`
--
ALTER TABLE `zl_country`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_currency`
--
ALTER TABLE `zl_currency`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_customs_name`
--
ALTER TABLE `zl_customs_name`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_decade`
--
ALTER TABLE `zl_decade`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_delare_makings`
--
ALTER TABLE `zl_delare_makings`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_exchangerate`
--
ALTER TABLE `zl_exchangerate`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_executioncategory`
--
ALTER TABLE `zl_executioncategory`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_exhibition`
--
ALTER TABLE `zl_exhibition`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_ex_reportstyle`
--
ALTER TABLE `zl_ex_reportstyle`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_ex_reportstyle_detail`
--
ALTER TABLE `zl_ex_reportstyle_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_feenames`
--
ALTER TABLE `zl_feenames`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_forbiddenword`
--
ALTER TABLE `zl_forbiddenword`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_imagetool`
--
ALTER TABLE `zl_imagetool`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_invite_rule`
--
ALTER TABLE `zl_invite_rule`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_invoice_header`
--
ALTER TABLE `zl_invoice_header`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_language`
--
ALTER TABLE `zl_language`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `zl_language_name` (`name`),
  ADD UNIQUE KEY `zl_language_code` (`code`);

--
-- 表的索引 `zl_material`
--
ALTER TABLE `zl_material`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_materialnote`
--
ALTER TABLE `zl_materialnote`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_materialstatus`
--
ALTER TABLE `zl_materialstatus`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_memberlevel`
--
ALTER TABLE `zl_memberlevel`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_occasionsstyle`
--
ALTER TABLE `zl_occasionsstyle`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_pricesource`
--
ALTER TABLE `zl_pricesource`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_productdscrb`
--
ALTER TABLE `zl_productdscrb`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_productinnards`
--
ALTER TABLE `zl_productinnards`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_productparts`
--
ALTER TABLE `zl_productparts`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_productprice`
--
ALTER TABLE `zl_productprice`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_productstyle`
--
ALTER TABLE `zl_productstyle`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_producttemplate`
--
ALTER TABLE `zl_producttemplate`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_quotedprice`
--
ALTER TABLE `zl_quotedprice`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_reportset`
--
ALTER TABLE `zl_reportset`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_reportset_detail`
--
ALTER TABLE `zl_reportset_detail`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_salesmethods`
--
ALTER TABLE `zl_salesmethods`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_salesport`
--
ALTER TABLE `zl_salesport`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_salesport_mission`
--
ALTER TABLE `zl_salesport_mission`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_securitycategory`
--
ALTER TABLE `zl_securitycategory`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_series`
--
ALTER TABLE `zl_series`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_series2`
--
ALTER TABLE `zl_series2`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_shippingtype`
--
ALTER TABLE `zl_shippingtype`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_sizecontent`
--
ALTER TABLE `zl_sizecontent`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_sizetop`
--
ALTER TABLE `zl_sizetop`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_storemove`
--
ALTER TABLE `zl_storemove`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_style`
--
ALTER TABLE `zl_style`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_supplierlevel`
--
ALTER TABLE `zl_supplierlevel`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_supplier_type`
--
ALTER TABLE `zl_supplier_type`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_sys_selfcompany`
--
ALTER TABLE `zl_sys_selfcompany`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_templatelist`
--
ALTER TABLE `zl_templatelist`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_templatemanage`
--
ALTER TABLE `zl_templatemanage`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_template_descrb`
--
ALTER TABLE `zl_template_descrb`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_trans_code`
--
ALTER TABLE `zl_trans_code`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_ulnarinch`
--
ALTER TABLE `zl_ulnarinch`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_unit`
--
ALTER TABLE `zl_unit`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_unitgroup`
--
ALTER TABLE `zl_unitgroup`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_warehouse`
--
ALTER TABLE `zl_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_washinginstructions`
--
ALTER TABLE `zl_washinginstructions`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_winterproofing`
--
ALTER TABLE `zl_winterproofing`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zl_yearexchange`
--
ALTER TABLE `zl_yearexchange`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `模版`
--
ALTER TABLE `模版`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ac_invoice`
--
ALTER TABLE `ac_invoice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `ac_invoice_fee`
--
ALTER TABLE `ac_invoice_fee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `ac_invoice_fee_detail`
--
ALTER TABLE `ac_invoice_fee_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `ac_invoice_prepay`
--
ALTER TABLE `ac_invoice_prepay`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `ac_kmyue_wb`
--
ALTER TABLE `ac_kmyue_wb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `ac_pzhb`
--
ALTER TABLE `ac_pzhb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `ac_pzhh`
--
ALTER TABLE `ac_pzhh`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `ac_pzhmxb`
--
ALTER TABLE `ac_pzhmxb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `ac_sf_sheet`
--
ALTER TABLE `ac_sf_sheet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `ac_sf_sheet_code`
--
ALTER TABLE `ac_sf_sheet_code`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `ac_sf_sheet_refund`
--
ALTER TABLE `ac_sf_sheet_refund`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `dd_arrivalnotice`
--
ALTER TABLE `dd_arrivalnotice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `dd_arrivalnotice_detail`
--
ALTER TABLE `dd_arrivalnotice_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `dd_confirmorder`
--
ALTER TABLE `dd_confirmorder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `dd_corderdetails`
--
ALTER TABLE `dd_corderdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `dd_corder_ctn`
--
ALTER TABLE `dd_corder_ctn`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `dd_corder_temp`
--
ALTER TABLE `dd_corder_temp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `dd_fee`
--
ALTER TABLE `dd_fee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `dd_order`
--
ALTER TABLE `dd_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `dd_ordercode`
--
ALTER TABLE `dd_ordercode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `dd_orderdetails`
--
ALTER TABLE `dd_orderdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `dd_quotation`
--
ALTER TABLE `dd_quotation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `dd_quotation_detail`
--
ALTER TABLE `dd_quotation_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_cfashion`
--
ALTER TABLE `if_cfashion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_exception`
--
ALTER TABLE `if_exception`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_imgorder`
--
ALTER TABLE `if_imgorder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_jingdong`
--
ALTER TABLE `if_jingdong`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_meilihui`
--
ALTER TABLE `if_meilihui`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_meixi`
--
ALTER TABLE `if_meixi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_ofashion`
--
ALTER TABLE `if_ofashion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_shangpin`
--
ALTER TABLE `if_shangpin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_shangpin_direct`
--
ALTER TABLE `if_shangpin_direct`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_siku`
--
ALTER TABLE `if_siku`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_sxdzb`
--
ALTER TABLE `if_sxdzb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_zhenpin`
--
ALTER TABLE `if_zhenpin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `if_zouxiu`
--
ALTER TABLE `if_zouxiu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_actual_to_productstock`
--
ALTER TABLE `link_actual_to_productstock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_barcode_to_size`
--
ALTER TABLE `link_barcode_to_size`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_brandgroup_to_supplier`
--
ALTER TABLE `link_brandgroup_to_supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_brand_to_brandgroup`
--
ALTER TABLE `link_brand_to_brandgroup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_brand_to_discount`
--
ALTER TABLE `link_brand_to_discount`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_brand_to_priced`
--
ALTER TABLE `link_brand_to_priced`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_cdetail_to_ddetail`
--
ALTER TABLE `link_cdetail_to_ddetail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_childbrand_to_execution`
--
ALTER TABLE `link_childbrand_to_execution`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_childbrand_to_innards`
--
ALTER TABLE `link_childbrand_to_innards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_childbrand_to_material`
--
ALTER TABLE `link_childbrand_to_material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_childbrand_to_outinnards`
--
ALTER TABLE `link_childbrand_to_outinnards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_childbrand_to_safety`
--
ALTER TABLE `link_childbrand_to_safety`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_color_to_brand`
--
ALTER TABLE `link_color_to_brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_contacts_to_supplier`
--
ALTER TABLE `link_contacts_to_supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_ctn_to_cdetail`
--
ALTER TABLE `link_ctn_to_cdetail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_data_to_file`
--
ALTER TABLE `link_data_to_file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_department_to_salesport`
--
ALTER TABLE `link_department_to_salesport`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_detail_to_detail`
--
ALTER TABLE `link_detail_to_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_distribute_to_cdetail`
--
ALTER TABLE `link_distribute_to_cdetail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_group_to_navigation`
--
ALTER TABLE `link_group_to_navigation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_invoice_to_order`
--
ALTER TABLE `link_invoice_to_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_invoice_to_requisition`
--
ALTER TABLE `link_invoice_to_requisition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_invoice_to_warehousing`
--
ALTER TABLE `link_invoice_to_warehousing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_kp_to_store`
--
ALTER TABLE `link_kp_to_store`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_prep_to_productstock`
--
ALTER TABLE `link_prep_to_productstock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_pricelist_to_salesport`
--
ALTER TABLE `link_pricelist_to_salesport`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_closedway`
--
ALTER TABLE `link_product_to_closedway`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_decade`
--
ALTER TABLE `link_product_to_decade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_dscrb`
--
ALTER TABLE `link_product_to_dscrb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_marketprice`
--
ALTER TABLE `link_product_to_marketprice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_material`
--
ALTER TABLE `link_product_to_material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_material2`
--
ALTER TABLE `link_product_to_material2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_materislstatus`
--
ALTER TABLE `link_product_to_materislstatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_occasions`
--
ALTER TABLE `link_product_to_occasions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_origin`
--
ALTER TABLE `link_product_to_origin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_outproductinnards`
--
ALTER TABLE `link_product_to_outproductinnards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_picture`
--
ALTER TABLE `link_product_to_picture`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_picture_ftp`
--
ALTER TABLE `link_product_to_picture_ftp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_price`
--
ALTER TABLE `link_product_to_price`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_price2`
--
ALTER TABLE `link_product_to_price2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_price_history`
--
ALTER TABLE `link_product_to_price_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_productinnards`
--
ALTER TABLE `link_product_to_productinnards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_productparts`
--
ALTER TABLE `link_product_to_productparts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_salesnature`
--
ALTER TABLE `link_product_to_salesnature`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_salesport`
--
ALTER TABLE `link_product_to_salesport`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_salesport_history`
--
ALTER TABLE `link_product_to_salesport_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_size`
--
ALTER TABLE `link_product_to_size`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_product_to_washinginstructions`
--
ALTER TABLE `link_product_to_washinginstructions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_pzh_to_invoice`
--
ALTER TABLE `link_pzh_to_invoice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_pzh_to_invoicefee`
--
ALTER TABLE `link_pzh_to_invoicefee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_pzh_to_order`
--
ALTER TABLE `link_pzh_to_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_pzh_to_sales`
--
ALTER TABLE `link_pzh_to_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_pzh_to_sales_trans`
--
ALTER TABLE `link_pzh_to_sales_trans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_pzh_to_warehousing_fee`
--
ALTER TABLE `link_pzh_to_warehousing_fee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_return_to_productstock`
--
ALTER TABLE `link_return_to_productstock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_rule_to_operation`
--
ALTER TABLE `link_rule_to_operation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_salespot_to_childbrand`
--
ALTER TABLE `link_salespot_to_childbrand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_sales_to_productstock`
--
ALTER TABLE `link_sales_to_productstock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_sellspot_to_brand`
--
ALTER TABLE `link_sellspot_to_brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_special_to_productstock`
--
ALTER TABLE `link_special_to_productstock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_spot_warehouse`
--
ALTER TABLE `link_spot_warehouse`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_supplier_to_brand`
--
ALTER TABLE `link_supplier_to_brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_user_to_labourcontactor`
--
ALTER TABLE `link_user_to_labourcontactor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_user_to_price`
--
ALTER TABLE `link_user_to_price`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_user_to_reportset`
--
ALTER TABLE `link_user_to_reportset`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_user_to_salesport`
--
ALTER TABLE `link_user_to_salesport`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_user_to_supplier`
--
ALTER TABLE `link_user_to_supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `link_user_to_warehouse`
--
ALTER TABLE `link_user_to_warehouse`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `sys_config`
--
ALTER TABLE `sys_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `sys_selfcompany`
--
ALTER TABLE `sys_selfcompany`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_card`
--
ALTER TABLE `tb_card`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_check`
--
ALTER TABLE `tb_check`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_check_detail`
--
ALTER TABLE `tb_check_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_company`
--
ALTER TABLE `tb_company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `tb_contactlist`
--
ALTER TABLE `tb_contactlist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_declaration`
--
ALTER TABLE `tb_declaration`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_declaration_detail`
--
ALTER TABLE `tb_declaration_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_department`
--
ALTER TABLE `tb_department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `tb_discount_card`
--
ALTER TABLE `tb_discount_card`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_distribute`
--
ALTER TABLE `tb_distribute`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_distributecode`
--
ALTER TABLE `tb_distributecode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_express`
--
ALTER TABLE `tb_express`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_fee`
--
ALTER TABLE `tb_fee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_feecode`
--
ALTER TABLE `tb_feecode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_fee_detail`
--
ALTER TABLE `tb_fee_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_group`
--
ALTER TABLE `tb_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `tb_inve_actual`
--
ALTER TABLE `tb_inve_actual`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_inve_actual_dtl`
--
ALTER TABLE `tb_inve_actual_dtl`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_inve_prep`
--
ALTER TABLE `tb_inve_prep`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_inve_prep_dtl`
--
ALTER TABLE `tb_inve_prep_dtl`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_kp`
--
ALTER TABLE `tb_kp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_member_address`
--
ALTER TABLE `tb_member_address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_member_bank`
--
ALTER TABLE `tb_member_bank`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_member_card`
--
ALTER TABLE `tb_member_card`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_member_card_history`
--
ALTER TABLE `tb_member_card_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_member_contactor`
--
ALTER TABLE `tb_member_contactor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_member_header`
--
ALTER TABLE `tb_member_header`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_member_preference`
--
ALTER TABLE `tb_member_preference`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_member_preference_size`
--
ALTER TABLE `tb_member_preference_size`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_member_preordination`
--
ALTER TABLE `tb_member_preordination`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_permission`
--
ALTER TABLE `tb_permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=86;

--
-- 使用表AUTO_INCREMENT `tb_permission_group`
--
ALTER TABLE `tb_permission_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `tb_permission_module`
--
ALTER TABLE `tb_permission_module`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `tb_picture`
--
ALTER TABLE `tb_picture`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_pre_requisition`
--
ALTER TABLE `tb_pre_requisition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_productstock`
--
ALTER TABLE `tb_productstock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_productstock_snapshot`
--
ALTER TABLE `tb_productstock_snapshot`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_product_price`
--
ALTER TABLE `tb_product_price`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_requisition`
--
ALTER TABLE `tb_requisition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_requisitioncode`
--
ALTER TABLE `tb_requisitioncode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_requisition_detail`
--
ALTER TABLE `tb_requisition_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_requisition_detail_group`
--
ALTER TABLE `tb_requisition_detail_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_requisition_express`
--
ALTER TABLE `tb_requisition_express`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_rule`
--
ALTER TABLE `tb_rule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_savings_card`
--
ALTER TABLE `tb_savings_card`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_special_requisition`
--
ALTER TABLE `tb_special_requisition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_special_requisition_detail`
--
ALTER TABLE `tb_special_requisition_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_stock`
--
ALTER TABLE `tb_stock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `tb_supplier_orderdate`
--
ALTER TABLE `tb_supplier_orderdate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `tb_verificationcode`
--
ALTER TABLE `tb_verificationcode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_warehousing`
--
ALTER TABLE `tb_warehousing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_warehousing_detail`
--
ALTER TABLE `tb_warehousing_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `tb_warehousing_fee`
--
ALTER TABLE `tb_warehousing_fee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `trans_brand_code`
--
ALTER TABLE `trans_brand_code`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `trans_color_code`
--
ALTER TABLE `trans_color_code`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `trans_group_code`
--
ALTER TABLE `trans_group_code`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `trans_size_code`
--
ALTER TABLE `trans_size_code`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_afterservice`
--
ALTER TABLE `xs_afterservice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_afterservice_detail`
--
ALTER TABLE `xs_afterservice_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_pre_sales`
--
ALTER TABLE `xs_pre_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_pre_salescode`
--
ALTER TABLE `xs_pre_salescode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_pre_salesdetails`
--
ALTER TABLE `xs_pre_salesdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_pricelist`
--
ALTER TABLE `xs_pricelist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_pricelistdetails`
--
ALTER TABLE `xs_pricelistdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_return`
--
ALTER TABLE `xs_return`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_returncode`
--
ALTER TABLE `xs_returncode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_sales`
--
ALTER TABLE `xs_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_salescode`
--
ALTER TABLE `xs_salescode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_salesdetails`
--
ALTER TABLE `xs_salesdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_sales_card`
--
ALTER TABLE `xs_sales_card`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_sales_cardetails`
--
ALTER TABLE `xs_sales_cardetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `xs_sales_pay`
--
ALTER TABLE `xs_sales_pay`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_ac_cashflow_statement`
--
ALTER TABLE `zl_ac_cashflow_statement`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_ac_cashflow_subject`
--
ALTER TABLE `zl_ac_cashflow_subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_ac_km`
--
ALTER TABLE `zl_ac_km`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_ac_km_type`
--
ALTER TABLE `zl_ac_km_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_ac_pzh_rule`
--
ALTER TABLE `zl_ac_pzh_rule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_ac_pzh_type`
--
ALTER TABLE `zl_ac_pzh_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_ac_ztb`
--
ALTER TABLE `zl_ac_ztb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_ageseason`
--
ALTER TABLE `zl_ageseason`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_aliases`
--
ALTER TABLE `zl_aliases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_bankinformation`
--
ALTER TABLE `zl_bankinformation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_brand`
--
ALTER TABLE `zl_brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_brandgroup`
--
ALTER TABLE `zl_brandgroup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_brandmemo`
--
ALTER TABLE `zl_brandmemo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_businesstype`
--
ALTER TABLE `zl_businesstype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_childproductgroup`
--
ALTER TABLE `zl_childproductgroup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_closedway`
--
ALTER TABLE `zl_closedway`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_color`
--
ALTER TABLE `zl_color`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_colortemplate`
--
ALTER TABLE `zl_colortemplate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_companycontacts`
--
ALTER TABLE `zl_companycontacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_costformula`
--
ALTER TABLE `zl_costformula`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_country`
--
ALTER TABLE `zl_country`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `zl_currency`
--
ALTER TABLE `zl_currency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_customs_name`
--
ALTER TABLE `zl_customs_name`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_decade`
--
ALTER TABLE `zl_decade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_delare_makings`
--
ALTER TABLE `zl_delare_makings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_exchangerate`
--
ALTER TABLE `zl_exchangerate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_executioncategory`
--
ALTER TABLE `zl_executioncategory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_exhibition`
--
ALTER TABLE `zl_exhibition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_ex_reportstyle`
--
ALTER TABLE `zl_ex_reportstyle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_ex_reportstyle_detail`
--
ALTER TABLE `zl_ex_reportstyle_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_feenames`
--
ALTER TABLE `zl_feenames`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_forbiddenword`
--
ALTER TABLE `zl_forbiddenword`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_imagetool`
--
ALTER TABLE `zl_imagetool`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_invite_rule`
--
ALTER TABLE `zl_invite_rule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_invoice_header`
--
ALTER TABLE `zl_invoice_header`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_language`
--
ALTER TABLE `zl_language`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_material`
--
ALTER TABLE `zl_material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_materialnote`
--
ALTER TABLE `zl_materialnote`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_materialstatus`
--
ALTER TABLE `zl_materialstatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_memberlevel`
--
ALTER TABLE `zl_memberlevel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_occasionsstyle`
--
ALTER TABLE `zl_occasionsstyle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_pricesource`
--
ALTER TABLE `zl_pricesource`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_productdscrb`
--
ALTER TABLE `zl_productdscrb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_productinnards`
--
ALTER TABLE `zl_productinnards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_productparts`
--
ALTER TABLE `zl_productparts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_productprice`
--
ALTER TABLE `zl_productprice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_productstyle`
--
ALTER TABLE `zl_productstyle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_producttemplate`
--
ALTER TABLE `zl_producttemplate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_quotedprice`
--
ALTER TABLE `zl_quotedprice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_reportset`
--
ALTER TABLE `zl_reportset`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_reportset_detail`
--
ALTER TABLE `zl_reportset_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_salesmethods`
--
ALTER TABLE `zl_salesmethods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_salesport`
--
ALTER TABLE `zl_salesport`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_salesport_mission`
--
ALTER TABLE `zl_salesport_mission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_securitycategory`
--
ALTER TABLE `zl_securitycategory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_series`
--
ALTER TABLE `zl_series`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_series2`
--
ALTER TABLE `zl_series2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_shippingtype`
--
ALTER TABLE `zl_shippingtype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_sizecontent`
--
ALTER TABLE `zl_sizecontent`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_sizetop`
--
ALTER TABLE `zl_sizetop`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_storemove`
--
ALTER TABLE `zl_storemove`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_style`
--
ALTER TABLE `zl_style`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_supplierlevel`
--
ALTER TABLE `zl_supplierlevel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_supplier_type`
--
ALTER TABLE `zl_supplier_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_sys_selfcompany`
--
ALTER TABLE `zl_sys_selfcompany`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_templatelist`
--
ALTER TABLE `zl_templatelist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_templatemanage`
--
ALTER TABLE `zl_templatemanage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_template_descrb`
--
ALTER TABLE `zl_template_descrb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_trans_code`
--
ALTER TABLE `zl_trans_code`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_ulnarinch`
--
ALTER TABLE `zl_ulnarinch`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_unit`
--
ALTER TABLE `zl_unit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_unitgroup`
--
ALTER TABLE `zl_unitgroup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_warehouse`
--
ALTER TABLE `zl_warehouse`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_washinginstructions`
--
ALTER TABLE `zl_washinginstructions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_winterproofing`
--
ALTER TABLE `zl_winterproofing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `zl_yearexchange`
--
ALTER TABLE `zl_yearexchange`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 使用表AUTO_INCREMENT `模版`
--
ALTER TABLE `模版`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id';

--
-- 限制导出的表
--

--
-- 限制表 `link_group_to_navigation`
--
ALTER TABLE `link_group_to_navigation`
  ADD CONSTRAINT `fk_reference_link_group_to_navigation_to_group` FOREIGN KEY (`groupid`) REFERENCES `tb_group` (`id`);

--
-- 限制表 `link_rule_to_operation`
--
ALTER TABLE `link_rule_to_operation`
  ADD CONSTRAINT `fk_reference_link_rule_to_operationto_rule_id` FOREIGN KEY (`ruleid`) REFERENCES `tb_rule` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
