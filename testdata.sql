--
-- 转存表中的数据 `tb_user`
--

INSERT INTO `tb_user` (`id`, `login_name`, `password`, `real_name`, `departmentid`, `companyid`, `groupid`, `storeid`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `sex`, `section`, `date`, `phone`, `mobilephone`, `e_mail`, `email_password`, `comment`, `countryid`, `departmentid2`, `address`, `contactor`, `leave_date`, `defaultprice`, `defaultwarehouse`, `defaultsellspot`, `idno`, `education`, `collegemajor`, `degree`, `graduatedcollege`, `stateofmarriage`, `censusregistration`, `status`, `reason`, `contactorphone`, `costdisplay`, `wechat`, `openid`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', NULL, 1, 1, 1, NULL, 1, '2019-03-12 00:00:00', 1, '2019-03-07 14:43:27', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


--
-- 转存表中的数据 `zl_country`
--

INSERT INTO `zl_country` (`id`, `code`, `name_cn`, `name_en`, `name_hk`, `name_fr`, `name_it`, `name_sp`, `name_de`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `localcurrency`) VALUES
(1, '001', ' 中国', 'China', NULL, NULL, NULL, NULL, NULL, 1, '2019-03-12 00:00:00', 1, '2019-03-07 14:43:27', NULL, NULL, 0, NULL),
(2, '002', '英国', 'England', NULL, NULL, NULL, NULL, NULL, 1, '2019-03-04 00:00:00', 1, '2019-03-11 00:00:00', NULL, NULL, 0, NULL);


--
-- 转存表中的数据 `tb_company`
--

INSERT INTO `tb_company` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `name_cn`, `name_en`, `name_hk`, `name_fr`, `name_it`, `name_sp`, `name_de`, `countryid`, `memo`, `randid`) VALUES
(1, 1, '2019-03-12 00:00:00', 1, '2019-03-07 14:43:27', NULL, NULL, 0, '爱莎尚品', 'ASA', NULL, NULL, NULL, NULL, NULL, 1, NULL, 11111111);



--
-- 转存表中的数据 `tb_department`
--

INSERT INTO `tb_department` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `name`, `memo`, `companyid`, `priceid`, `spotid`, `up_dp_id`, `checkingflag`) VALUES
(1, 1, '2019-03-08 17:09:16', 1, '2019-03-08 17:09:16', NULL, NULL, 0, '销售部', '销售部。。。', 1, NULL, NULL, 0, NULL),
(2, 1, '2019-03-08 17:09:31', 1, '2019-03-08 17:09:31', NULL, NULL, 0, '采购部', '采购部。。。', 1, NULL, NULL, 0, NULL),
(3, 1, '2019-03-08 17:09:40', 1, '2019-03-08 17:09:40', NULL, NULL, 0, '市场部', '市场部。。。', 1, NULL, NULL, 0, NULL),
(4, 1, '2019-03-08 17:10:27', 1, '2019-03-08 17:10:27', NULL, NULL, 0, '市场1部', '市场1部。。。', 1, NULL, NULL, 3, NULL),
(5, 1, '2019-03-08 17:11:03', 1, '2019-03-08 17:11:03', NULL, NULL, 0, '市场1部1组', '市场1部1组。。。', 1, NULL, NULL, 4, NULL),
(6, 1, '2019-03-08 17:11:24', 1, '2019-03-08 17:11:24', NULL, NULL, 0, '市场2部', '市场1部。。。', 1, NULL, NULL, 3, NULL);


--
-- 转存表中的数据 `tb_group`
--

INSERT INTO `tb_group` (`id`, `name`, `memo`, `companyid`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`) VALUES
(1, '超级管理员', '超级管理员，拥有所有的权限，大BOSS', NULL, 1, '2019-03-12 00:00:00', 1, '2019-03-07 14:43:27', NULL, NULL, 0),
(2, '公司内部管理员', '拥有所在公司内部的所有操作权限，但是有些系统权限不能操作，必须指定一个公司。', 1, 1, '2019-03-12 00:00:00', 1, '2019-03-07 14:43:27', NULL, NULL, 0);



--
-- 转存表中的数据 `tb_permission_group`
--

INSERT INTO `tb_permission_group` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `groupid`, `permissionid`, `companyid`) VALUES
(1, 1, '2019-03-11 16:02:32', 1, '2019-03-11 16:02:32', NULL, NULL, 0, 1, 1, 1),
(3, 1, '2019-03-11 16:02:40', 1, '2019-03-11 16:02:40', NULL, NULL, 0, 1, 2, 1),
(5, 1, '2019-03-11 16:02:46', 1, '2019-03-11 16:02:46', NULL, NULL, 0, 1, 3, 1),
(6, 1, '2019-03-11 16:02:52', 1, '2019-03-11 16:02:52', NULL, NULL, 0, 1, 4, 1),
(7, 1, '2019-03-11 16:09:10', 1, '2019-03-11 16:09:10', NULL, NULL, 0, 1, 5, 1),
(9, 1, '2019-03-11 16:11:37', 1, '2019-03-11 16:11:37', NULL, NULL, 0, 1, 6, 1);


--
-- 转存表中的数据 `tb_permission_module`
--

INSERT INTO `tb_permission_module` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `permissionid`, `module`, `controller`, `action`) VALUES
(1, 1, '2019-03-13 11:28:12', 1, '2019-03-13 11:28:12', NULL, NULL, 0, 1, 'home', 'index', 'login'),
(2, 1, '2019-03-13 11:28:18', 1, '2019-03-13 11:28:18', NULL, NULL, 0, 1, 'home', 'index', 'logout'),
(3, 1, '2019-03-13 11:28:49', 1, '2019-03-13 11:28:49', NULL, NULL, 0, 2, 'home', 'user', 'add'),
(4, 1, '2019-03-13 11:29:55', 1, '2019-03-13 11:29:55', NULL, NULL, 0, 2, 'home', 'user', 'edit'),
(5, 1, '2019-03-13 14:05:37', 1, '2019-03-13 14:05:37', NULL, NULL, 0, 3, 'home', 'product', 'add'),
(6, 1, '2019-03-13 14:05:41', 1, '2019-03-13 14:05:41', NULL, NULL, 0, 3, 'home', 'product', 'edit');


--
-- 转存表中的数据 `tb_product`
--

INSERT INTO `tb_product` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `productno`, `productname`, `wordcode_1`, `wordcode_2`, `wordcode_3`, `wordcode_4`, `wordprice`, `wordpricecurrency`, `gender`, `brandid`, `brandgroupid`, `childbrand`, `brandcolor`, `brandcolor2`, `picture2`, `picture`, `closeway`, `ageseason`, `productsize`, `countries`, `security`, `execution`, `material`, `productparst`, `occasion`, `producttemplate`, `materialstatus`, `season`, `oldasacode`, `officialwebsite`, `oldbarcode`, `laststoragedate`, `aliases_1`, `aliases_2`, `aliases`, `series_id`, `series2_id`, `ulnarinch`, `vat`, `tariff`, `basecurrency`, `baseprice`, `entrymonth`, `factoryprice`, `factorypricecurrency`, `realprice`, `retailpricecurrency`, `dutyparagraph`, `orderprice`, `orderpricecurrency`, `retailprice`, `groupid`, `iskj`, `bxzs`, `hbzs`, `rrzs`, `tlzs`, `salemethodid`, `nationalprice`, `taxrate`, `isjh`, `inlenth`, `jdname`, `winterproofing`, `isfj`, `discount`, `ulnarinch_memo`, `sizetopid`, `companyid`, `adduserid`) VALUES
(1, 1, '2019-03-20 10:19:55', 1, '2019-03-20 10:19:55', NULL, NULL, 0, NULL, '测试商品1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(2, 1, '2019-03-20 10:20:02', 1, '2019-03-20 10:20:02', NULL, NULL, 0, NULL, '测试商品2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(3, 1, '2019-03-20 10:20:06', 1, '2019-03-20 10:20:06', NULL, NULL, 0, NULL, '测试商品3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(4, 1, '2019-03-20 10:20:09', 1, '2019-03-20 10:20:09', NULL, NULL, 0, NULL, '测试商品4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(5, 1, '2019-03-20 10:20:14', 1, '2019-03-20 10:20:14', NULL, NULL, 0, NULL, '测试商品5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(6, 1, '2019-03-20 10:20:18', 1, '2019-03-20 10:20:18', NULL, NULL, 0, NULL, '测试商品6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(7, 1, '2019-03-20 10:20:21', 1, '2019-03-20 10:20:21', NULL, NULL, 0, NULL, '测试商品7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(8, 1, '2019-03-20 10:20:28', 1, '2019-03-20 10:20:28', NULL, NULL, 0, NULL, '测试商品8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(9, 1, '2019-03-20 10:20:31', 1, '2019-03-20 10:20:31', NULL, NULL, 0, NULL, '测试商品9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(10, 1, '2019-03-20 10:20:37', 1, '2019-03-20 10:20:37', NULL, NULL, 0, NULL, '测试商品10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);


--
-- 转存表中的数据 `zl_sizetop`
--

INSERT INTO `zl_sizetop` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `name_cn`, `name_en`, `name_hk`, `name_fr`, `name_it`, `name_sp`, `name_de`, `code`) VALUES
(1, 1, '2019-03-20 11:30:27', 1, '2019-03-20 11:30:27', NULL, NULL, 0, '男鞋38-45', NULL, NULL, NULL, NULL, NULL, NULL, 'man-38-45'),
(2, 1, '2019-03-20 11:30:40', 1, '2019-03-20 11:30:40', NULL, NULL, 0, '女鞋38-45', NULL, NULL, NULL, NULL, NULL, NULL, 'woman-38-45');


--
-- 转存表中的数据 `zl_sizecontent`
--

INSERT INTO `zl_sizecontent` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `topid`, `content_cn`, `content_en`, `content_hk`, `content_fr`, `content_it`, `content_sp`, `content_de`, `sortnum`, `memo_cn`, `memo_en`, `memo_hk`, `memo_fr`, `memo_it`, `memo_sp`, `memo_de`) VALUES
(1, 1, '2019-03-20 11:34:15', 1, '2019-03-20 11:34:15', NULL, NULL, 0, 1, '38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38号码男鞋', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, '2019-03-20 11:35:43', 1, '2019-03-20 11:35:43', NULL, NULL, 0, 1, '38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39号码男鞋', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, '2019-03-20 11:36:36', 1, '2019-03-20 11:36:36', NULL, NULL, 0, 1, '40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40号码男鞋', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, '2019-03-20 11:36:50', 1, '2019-03-20 11:36:50', NULL, NULL, 0, 1, '41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41号码男鞋', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, '2019-03-20 11:37:08', 1, '2019-03-20 11:37:08', NULL, NULL, 0, 2, '38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38号码女鞋', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, '2019-03-20 11:37:16', 1, '2019-03-20 11:37:16', NULL, NULL, 0, 2, '39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39号码女鞋', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, '2019-03-20 11:37:28', 1, '2019-03-20 11:37:28', NULL, NULL, 0, 2, '40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '40号码女鞋', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, '2019-03-20 11:37:36', 1, '2019-03-20 11:37:36', NULL, NULL, 0, 2, '41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41号码女鞋', NULL, NULL, NULL, NULL, NULL, NULL);


--
-- 转存表中的数据 `zl_ageseason`
--

INSERT INTO `zl_ageseason` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `name`, `mark`) VALUES
(1, 1, '2019-03-20 18:01:13', 1, '2019-03-20 18:01:13', NULL, NULL, 0, '2000', 'SS'),
(2, 1, '2019-03-20 18:01:19', 1, '2019-03-20 18:01:19', NULL, NULL, 0, '2000', 'FW'),
(3, 1, '2019-03-20 18:01:26', 1, '2019-03-20 18:01:26', NULL, NULL, 0, '2001', 'SS'),
(4, 1, '2019-03-20 18:01:30', 1, '2019-03-20 18:01:30', NULL, NULL, 0, '2001', 'FW'),
(5, 1, '2019-03-20 18:01:36', 1, '2019-03-20 18:01:36', NULL, NULL, 0, '2002', 'SS'),
(6, 1, '2019-03-20 18:01:39', 1, '2019-03-20 18:01:39', NULL, NULL, 0, '2002', 'FW'),
(7, 1, '2019-03-20 18:01:46', 1, '2019-03-20 18:01:46', NULL, NULL, 0, '2003', 'SS'),
(8, 1, '2019-03-20 18:01:50', 1, '2019-03-20 18:01:50', NULL, NULL, 0, '2003', 'FW'),
(9, 1, '2019-03-20 18:01:54', 1, '2019-03-20 18:01:54', NULL, NULL, 0, '2004', 'FW'),
(10, 1, '2019-03-20 18:01:58', 1, '2019-03-20 18:01:58', NULL, NULL, 0, '2004', 'SS'),
(11, 1, '2019-03-20 18:02:07', 1, '2019-03-20 18:02:07', NULL, NULL, 0, '2005', 'SS'),
(12, 1, '2019-03-20 18:02:12', 1, '2019-03-20 18:02:12', NULL, NULL, 0, '2005', 'FW'),
(13, 1, '2019-03-20 18:02:17', 1, '2019-03-20 18:02:17', NULL, NULL, 0, '2006', 'SS'),
(14, 1, '2019-03-20 18:02:20', 1, '2019-03-20 18:02:20', NULL, NULL, 0, '2006', 'FW'),
(15, 1, '2019-03-20 18:02:29', 1, '2019-03-20 18:02:29', NULL, NULL, 0, '2007', 'SS'),
(16, 1, '2019-03-20 18:02:33', 1, '2019-03-20 18:02:33', NULL, NULL, 0, '2007', 'FW'),
(17, 1, '2019-03-20 18:02:41', 1, '2019-03-20 18:02:41', NULL, NULL, 0, '2008', 'SS'),
(18, 1, '2019-03-20 18:02:45', 1, '2019-03-20 18:02:45', NULL, NULL, 0, '2008', 'FW'),
(19, 1, '2019-03-20 18:02:54', 1, '2019-03-20 18:02:54', NULL, NULL, 0, '2009', 'SS'),
(20, 1, '2019-03-20 18:02:57', 1, '2019-03-20 18:02:57', NULL, NULL, 0, '2009', 'FW'),
(21, 1, '2019-03-20 18:03:05', 1, '2019-03-20 18:03:05', NULL, NULL, 0, '2010', 'SS'),
(22, 1, '2019-03-20 18:03:08', 1, '2019-03-20 18:03:08', NULL, NULL, 0, '2010', 'FW'),
(23, 1, '2019-03-20 18:03:15', 1, '2019-03-20 18:03:15', NULL, NULL, 0, '2011', 'SS'),
(24, 1, '2019-03-20 18:03:20', 1, '2019-03-20 18:03:20', NULL, NULL, 0, '2011', 'FW'),
(25, 1, '2019-03-20 18:03:27', 1, '2019-03-20 18:03:27', NULL, NULL, 0, '2012', 'SS'),
(26, 1, '2019-03-20 18:03:30', 1, '2019-03-20 18:03:30', NULL, NULL, 0, '2012', 'FW'),
(27, 1, '2019-03-20 18:03:35', 1, '2019-03-20 18:03:35', NULL, NULL, 0, '2013', 'SS'),
(28, 1, '2019-03-20 18:03:39', 1, '2019-03-20 18:03:39', NULL, NULL, 0, '2013', 'FW'),
(29, 1, '2019-03-20 18:03:46', 1, '2019-03-20 18:03:46', NULL, NULL, 0, '2014', 'SS'),
(30, 1, '2019-03-20 18:03:51', 1, '2019-03-20 18:03:51', NULL, NULL, 0, '2014', 'FW'),
(31, 1, '2019-03-20 18:03:57', 1, '2019-03-20 18:03:57', NULL, NULL, 0, '2015', 'SS'),
(32, 1, '2019-03-20 18:04:00', 1, '2019-03-20 18:04:00', NULL, NULL, 0, '2015', 'FW'),
(33, 1, '2019-03-20 18:04:06', 1, '2019-03-20 18:04:06', NULL, NULL, 0, '2016', 'SS'),
(34, 1, '2019-03-20 18:04:10', 1, '2019-03-20 18:04:10', NULL, NULL, 0, '2016', 'FW'),
(35, 1, '2019-03-20 18:04:15', 1, '2019-03-20 18:04:15', NULL, NULL, 0, '2017', 'SS'),
(36, 1, '2019-03-20 18:04:18', 1, '2019-03-20 18:04:18', NULL, NULL, 0, '2017', 'FW'),
(37, 1, '2019-03-20 18:04:24', 1, '2019-03-20 18:04:24', NULL, NULL, 0, '2018', 'SS'),
(38, 1, '2019-03-20 18:04:28', 1, '2019-03-20 18:04:28', NULL, NULL, 0, '2018', 'FW'),
(39, 1, '2019-03-20 18:04:33', 1, '2019-03-20 18:04:33', NULL, NULL, 0, '2019', 'SS'),
(40, 1, '2019-03-20 18:04:39', 1, '2019-03-20 18:04:39', NULL, NULL, 0, '2019', 'FW'),
(41, 1, '2019-03-20 18:04:44', 1, '2019-03-20 18:04:44', NULL, NULL, 0, '2020', 'SS'),
(42, 1, '2019-03-20 18:04:49', 1, '2019-03-20 18:04:49', NULL, NULL, 0, '2020', 'FW'),
(43, 1, '2019-03-20 18:04:55', 1, '2019-03-20 18:04:55', NULL, NULL, 0, '2021', 'SS'),
(44, 1, '2019-03-20 18:05:00', 1, '2019-03-20 18:05:00', NULL, NULL, 0, '2021', 'FW'),
(45, 1, '2019-03-20 18:05:06', 1, '2019-03-20 18:05:06', NULL, NULL, 0, '2022', 'SS'),
(46, 1, '2019-03-20 18:05:09', 1, '2019-03-20 18:05:09', NULL, NULL, 0, '2022', 'FW');


--
-- 转存表中的数据 `dd_order`
--

INSERT INTO `dd_order` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `bussinesstypeid`, `makedate`, `makestaff`, `supplierid`, `finalsupplierid`, `bookingid`, `agentid`, `purchasedept`, `orderno`, `total`, `currency`, `auditstaff`, `auditdate`, `ordercode`, `worldordercode`, `auditstatus`, `isstatus`, `formtype`, `memo`, `contactor`, `ourcontactor`, `ageseason`, `seasontype`, `invoiceno`, `ddtype`, `morderid`, `exchangerate`, `bussinesstype`, `discount`, `tsl`, `property`, `companyid`, `status`) VALUES
(1, 1, '2019-03-20 19:46:06', 1, '2019-03-20 19:46:06', NULL, NULL, 0, NULL, '', 1, 1, NULL, 0, NULL, NULL, 'D111111201903201946061334', NULL, NULL, 0, NULL, '', '', NULL, NULL, '', '', '', '', 1, 1, '', NULL, NULL, '0.000000000', '1', '0.000000000', NULL, '', 1, NULL);


--
-- 转存表中的数据 `dd_orderdetails`
--

INSERT INTO `dd_orderdetails` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `orderid`, `sizecontentid`, `number`, `productid`, `price`, `actualnumber`, `isstatus`, `cost`, `cbtype`, `zkl`, `tsbl`, `cjj`, `yj`, `sortnum`, `zje`, `add_flag`, `thattimestock`, `companyid`) VALUES
(1, 1, '2019-03-20 19:46:06', 1, '2019-03-20 19:46:06', NULL, NULL, 0, 1, 5, 1, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 1, '2019-03-20 19:46:06', 1, '2019-03-20 19:46:06', NULL, NULL, 0, 1, 4, 2, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 1, '2019-03-20 19:46:06', 1, '2019-03-20 19:46:06', NULL, NULL, 0, 1, 3, 1, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, 1, '2019-03-20 19:46:06', 1, '2019-03-20 19:46:06', NULL, NULL, 0, 1, 2, 2, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(5, 1, '2019-03-20 19:46:06', 1, '2019-03-20 19:46:06', NULL, NULL, 0, 1, 1, 6, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);


--
-- 转存表中的数据 `tb_supplier`
--

INSERT INTO `tb_supplier` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `name`, `englishname`, `address`, `phone`, `zipcode`, `email`, `quotedprice`, `developdate`, `nationality`, `nature`, `supplierlevel`, `companyzipcode`, `maincontacts`, `microblog`, `countrycity`, `code`, `fax`, `calculation`, `legal`, `heading`, `businesslicense`, `headingnumber`, `registered`, `registeredcapital`, `endtime`, `type`, `contractfrom`, `contractto`, `contractrate`, `contractremind`, `settlecompanyid`, `memo`) VALUES
(2, 1, '2019-03-21 17:13:34', 1, '2019-03-21 17:13:34', NULL, NULL, 0, '爱莎商品', 'ASA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);



--
-- 转存表中的数据 `tb_warehouse`
--

INSERT INTO `tb_warehouse` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `countryid`, `companyid`, `city`, `name`, `address`, `contact`, `toll`, `fax`, `mobile`, `othercontact`, `code`, `defaultstore`, `zipcode`, `is_real`, `maxstock`, `maxsku`) VALUES
(1, 1, '2019-03-21 18:23:47', 1, '2019-03-21 18:23:47', NULL, NULL, 0, NULL, 1, NULL, '天津仓库', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, '2019-03-21 18:24:37', 1, '2019-03-21 18:24:37', NULL, NULL, 0, NULL, 1, NULL, '哈尔滨仓库', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, '2019-03-21 18:24:45', 1, '2019-03-21 18:24:45', NULL, NULL, 0, NULL, 1, NULL, '香港仓库', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, '2019-03-21 18:24:52', 1, '2019-03-21 18:24:52', NULL, NULL, 0, NULL, 1, NULL, '意大利仓库', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


