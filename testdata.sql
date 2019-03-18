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

INSERT INTO `tb_group` (`id`, `group_name`, `group_memo`, `companyid`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`) VALUES
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

