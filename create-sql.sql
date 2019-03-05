#用户表
drop table if exists `user`;
CREATE TABLE `user`
(
  `id`                     bigint UNSIGNED NOT NULL COMMENT '主键ID',
  `username`               varchar(100) NOT NULL DEFAULT '' COMMENT '登录名',
  `password`               varchar(191) NOT NULL DEFAULT '' COMMENT '登录密码',
  `country_id`             int UNSIGNED DEFAULT NULL COMMENT '国家ID',
  `business_department_id` int UNSIGNED DEFAULT NULL COMMENT '事业部ID，一级部门',
  `department_id`          int UNSIGNED DEFAULT NULL COMMENT '部门ID，所属事业部的下级部门',
  `sex`                    tinyint(1) UNSIGNED DEFAULT '1' COMMENT '性别：男-1 女-2，默认1',
  `entry_time`             timestamp NULL DEFAULT NULL COMMENT '入职时间',
  `quit_time`              timestamp NULL DEFAULT NULL COMMENT '离职时间',
  `quit_reason`            TEXT COMMENT '离职原因',
  `default_pricelist_id`   int UNSIGNED DEFAULT NULL COMMENT '默认价格单ID',
  `default_warehouse_id`   int UNSIGNED DEFAULT NULL COMMENT '默认仓库ID',
  `default_sellsport_id`   int UNSIGNED DEFAULT NULL COMMENT '默认销售端口ID',
  `realname`               varchar(100)          default '' COMMENT '真实姓名',
  `emergency_contact`      varchar(100)          default '' COMMENT '备用联系人',
  `telphone`               varchar(50)           DEFAULT '' COMMENT '电话',
  `mobile`                 varchar(50)           DEFAULT '' COMMENT '手机',
  `email`                  varchar(100)          DEFAULT '' COMMENT '邮箱',
  `email_password`         varchar(100)          DEFAULT '' COMMENT '邮箱密码',
  `address`                TEXT COMMENT '地址',
  `identity_number`        varchar(100)          DEFAULT '' COMMENT '身份证号',
  `graduated_school`       TEXT COMMENT '毕业学校',
  `major`                  varchar(100)          DEFAULT '' COMMENT '专业',
  `education`              varchar(100)          DEFAULT '' COMMENT '学历',
  `degree`                 varchar(100)          DEFAULT '' COMMENT '学位',
  `marital_status`         varchar(50)           DEFAULT '' COMMENT '婚/育状况',
  `domicile`               TEXT COMMENT '户籍所在地',
  `wechat`                 varchar(100)          DEFAULT '' COMMENT '微信号码',
  `remark`                 TEXT COMMENT '备注',
  `is_cost_visible`        tinyint(1) DEFAULT '0' COMMENT '成本是否可见：0-不可见，1-可见，默认0',
  `is_delete`              tinyint               DEFAULT '0' COMMENT '是否软删除：0-否，1-是，默认0',
  `is_delete_user`         bigint UNSIGNED DEFAULT NULL COMMENT '软删除操作人ID',
  `created_at`             timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at`             timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE `user_username` (`username`),
  UNIQUE `user_mobile` (`mobile`),
  UNIQUE `user_email` (`email`),
  UNIQUE `user_identity_number` (`identity_number`),
  UNIQUE `user_wechat` (`wechat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


#国家表
drop table if exists `country`;
create table `country`
(
  `id`             int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name`           varchar(50)  NOT NULL DEFAULT '' COMMENT '中文名称',
  `english_name`   varchar(191) NOT NULL DEFAULT '' COMMENT '英文名称',
  `code`           varchar(100) NOT NULL DEFAULT '' COMMENT '国家代码，一般为3位英文缩写',
  `money_id`       int UNSIGNED DEFAULT NULL COMMENT '货币ID',
  `is_delete`      tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否软删除：0-否，1-是，默认0',
  `is_delete_user` bigint UNSIGNED DEFAULT NULL COMMENT '软删除操作人ID',
  `created_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE `country_name` (`name`),
  UNIQUE `country_english_name` (`english_name`),
  UNIQUE `country_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


#部门表
drop table if exists `department`;
create table `department`
(
  `id`             int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name`           varchar(100) NOT NULL DEFAULT '' COMMENT '部门名称',
  `pid`            varchar(100) NOT NULL DEFAULT '0' COMMENT '上级部门ID，如果是0则是一级部门',
  `remark`         TEXT COMMENT '备注',
  `is_account`     tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否核算部门：0-否，1-是，默认0',
  `is_delete`      tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否软删除：0-否，1-是，默认0',
  `is_delete_user` bigint UNSIGNED DEFAULT NULL COMMENT '软删除操作人ID',
  `created_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE `department_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#价格单表
drop table if exists `pricelist`;
create table `pricelist`
(
  `id`             int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name`           varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `money_id`       int UNSIGNED DEFAULT NULL COMMENT '结算币种',
  `order`          bigint UNSIGNED DEFAULT NULL COMMENT '排序',
  `is_default`     tinyint(1) UNSIGNED DEFAULT '1' COMMENT '是否默认：0-否，1-是，默认1',
  `is_rounded`     tinyint(1) UNSIGNED DEFAULT '3' COMMENT '是否取整：1-十位取整，2-个位取整，3-不取整，默认3',
  `is_delete`      tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否软删除：0-否，1-是，默认0',
  `is_delete_user` bigint UNSIGNED DEFAULT NULL COMMENT '软删除操作人ID',
  `created_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE `pricelist_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#币种表
drop table if exists `money`;
create table `money`
(
  `id`             int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name`           varchar(100) NOT NULL DEFAULT '' COMMENT '币种名称',
  `code`           varchar(20)  NOT NULL DEFAULT '' COMMENT '币种代码，一般是英文标识',
  `mark`           tinyint(1) UNSIGNED DEFAULT '0' COMMENT '本位币标记：0-不是，1-是，默认0',
  `flag`           tinyint(1) UNSIGNED DEFAULT '0' COMMENT '常用标记：0-不是，1-是，默认0',
  `is_delete`      tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否软删除：0-否，1-是，默认0',
  `is_delete_user` bigint UNSIGNED DEFAULT NULL COMMENT '软删除操作人ID',
  `created_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE `money_name` (`name`),
  UNIQUE `money_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#仓库表
drop table if exists `warehouse`;
create table `warehouse`
(
  `id`             int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name`           varchar(100) NOT NULL DEFAULT '' COMMENT '仓库名称',
  `code`           varchar(20)  NOT NULL DEFAULT '' COMMENT '仓库编号',
  `country_id`     int UNSIGNED DEFAULT NULL COMMENT '所属国家ID',
  `city`           varchar(50)  NOT NULL DEFAULT '' COMMENT '城市',
  `zip`            varchar(20)  NOT NULL DEFAULT '' COMMENT '邮编',
  `address`        TEXT COMMENT '仓库地址',
  `linkman`        varchar(100) NOT NULL DEFAULT '' COMMENT '联系人',
  `telphone`       varchar(50)  NOT NULL DEFAULT '' COMMENT '电话',
  `fax`            varchar(50)  NOT NULL DEFAULT '' COMMENT '传真',
  `mobile`         varchar(50)  NOT NULL DEFAULT '' COMMENT '手机',
  `other_contact`  TEXT COMMENT '其他联系方式',
  `is_available`   tinyint(1) UNSIGNED DEFAULT '1' COMMENT '是否可用库存：0-否，1-是，默认1',
  `is_default`     tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否默认仓库：0-否，1-是，默认0',
  `max_inventory`  int UNSIGNED DEFAULT NULL COMMENT '库存上限',
  `max_sum`        int UNSIGNED DEFAULT NULL COMMENT '款数上限',
  `is_delete`      tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否软删除：0-否，1-是，默认0',
  `is_delete_user` bigint UNSIGNED DEFAULT NULL COMMENT '软删除操作人ID',
  `created_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE `warehouse_name` (`name`),
  UNIQUE `warehouse_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


#销售端口表
drop table if exists `sellsport`;
create table `sellsport`
(
  `id`              int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name`            varchar(100) NOT NULL DEFAULT '' COMMENT '端口名称',
  `shop_name`       varchar(100) NOT NULL DEFAULT '' COMMENT '店铺名称',
  `shop_telphone`   varchar(50)  NOT NULL DEFAULT '' COMMENT '店铺电话',
  `supplier_id`     int UNSIGNED DEFAULT NULL COMMENT '关系单位：所属供应商ID',
  `address`         TEXT COMMENT '地址',
  `remark`          TEXT COMMENT '备注说明',
  `is_online`       tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否电商端口：0-否，1-是，默认0',
  `is_available`    tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否可用端口：0-否，1-是，默认0',
  `is_point`        tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否启用扣点：0-否，1-是，默认0',
  `delivery_remark` TEXT COMMENT '发货说明',
  `is_delete`       tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否软删除：0-否，1-是，默认0',
  `is_delete_user`  bigint UNSIGNED DEFAULT NULL COMMENT '软删除操作人ID',
  `created_at`      timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at`      timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE `sellsport_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


#供货商表
drop table if exists `supplier`;
create table `supplier`
(
  `id`                        int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `code`                      VARCHAR(191) NOT NULL DEFAULT '' COMMENT '供货商编码',
  `country_id`                int UNSIGNED DEFAULT NULL COMMENT '供货商所属国家ID',
  `name`                      TEXT COMMENT '中文名称',
  `address`                   TEXT COMMENT '中文地址',
  `english_name`              TEXT COMMENT '英文名称',
  `english_address`           TEXT COMMENT '英文地址',
  `hk_name`                   TEXT COMMENT '粤语名称',
  `hk_address`                TEXT COMMENT '粤语地址',
  `italian_name`              TEXT COMMENT '意大利语名称',
  `italian_address`           TEXT COMMENT '意大利语地址',
  `french_name`               TEXT COMMENT '法语名称',
  `french_address`            TEXT COMMENT '法语地址',
  `current_supplier_id`       int UNSIGNED DEFAULT NULL COMMENT '结算单位，默认同ID保持一致，如果是分公司的话，可能会不一致',
  `linkman`                   varchar(100) NOT NULL DEFAULT '' COMMENT '联系人',
  `telphone`                  varchar(50)  NOT NULL DEFAULT '' COMMENT '电话',
  `fax`                       varchar(50)  NOT NULL DEFAULT '' COMMENT '传真',
  `mobile`                    varchar(50)  NOT NULL DEFAULT '' COMMENT '手机',
  `zip`                       varchar(20)  NOT NULL DEFAULT '' COMMENT '邮编',
  `weburl`                    varchar(191) NOT NULL DEFAULT '' COMMENT '网址',
  `corporation`               varchar(191) NOT NULL DEFAULT '' COMMENT '法人',
  `registered_capital`        varchar(50)  NOT NULL DEFAULT '' COMMENT '注册资本',
  `business_licence`          varchar(100) NOT NULL DEFAULT '' COMMENT '营业执照',
  `duty_number`               varchar(100) NOT NULL DEFAULT '' COMMENT '税号',
  `licence_reg_time`          timestamp NULL DEFAULT NULL COMMENT '执照注册时间',
  `licence_end_time`          timestamp NULL DEFAULT NULL COMMENT '执照终止时间',
  `contract_number`           varchar(100) NOT NULL DEFAULT '' COMMENT '协议合同号',
  `contract_reg_time`         timestamp NULL DEFAULT NULL COMMENT '协议注册时间',
  `contract_end_time`         timestamp NULL DEFAULT NULL COMMENT '协议终止时间',
  `contract_extension_remind` varchar(100) NOT NULL DEFAULT '' COMMENT '协议续签提醒',
  `contract_point`            varchar(100) NOT NULL DEFAULT '' COMMENT '协议扣点',
  `remark`                    TEXT COMMENT '备注',
  `is_supplier`               tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否为供货商：0-否，1-是，默认0',
  `is_logistics_company`      tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否为物流公司：0-否，1-是，默认0',
  `is_vendor`                 tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否为供应商：0-否，1-是，默认0',
  `is_customer`               tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否为客户：0-否，1-是，默认0',
  `is_brand`                  tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否为品牌商：0-否，1-是，默认0',
  `is_other`                  tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否为其他：0-否，1-是，默认0',
  `calculation_formula`       TEXT COMMENT '计算公式',
  `is_delete`                 tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否软删除：0-否，1-是，默认0',
  `is_delete_user`            bigint UNSIGNED DEFAULT NULL COMMENT '软删除操作人ID',
  `created_at`                timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at`                timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  unique `supplier_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#角色表
drop table if exists `role`;
create table `role`
(
  `id`             int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name`           varchar(100) NOT NULL DEFAULT '' COMMENT '角色名称',
  `description`    varchar(100) NOT NULL DEFAULT '' COMMENT '角色描述',
  `is_delete`      tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否软删除：0-否，1-是，默认0',
  `is_delete_user` bigint UNSIGNED DEFAULT NULL COMMENT '软删除操作人ID',
  `created_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE `role_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#权限表
drop table if exists `permission`;
create table `permission`
(
  `id`             int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `pid`            int UNSIGNED NOT NULL DEFAULT '0' COMMENT '所属权限ID，默认0为顶级权限',
  `name`           varchar(100) NOT NULL DEFAULT '' COMMENT '权限名称',
  `description`    varchar(100) NOT NULL DEFAULT '' COMMENT '权限描述',
  `is_delete`      tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否软删除：0-否，1-是，默认0',
  `is_delete_user` bigint UNSIGNED DEFAULT NULL COMMENT '软删除操作人ID',
  `created_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE `permission_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#角色权限多对多表
drop table if exists `permission_role`;
CREATE TABLE `permission_role`
(
  `id`             int UNSIGNED NOT NULL COMMENT '主键ID',
  `role_id`        int UNSIGNED NOT NULL COMMENT '角色ID',
  `permission_id`  int UNSIGNED NOT NULL COMMENT '权限ID',
  `is_delete`      tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否软删除：0-否，1-是，默认0',
  `is_delete_user` bigint UNSIGNED DEFAULT NULL COMMENT '软删除操作人ID',
  `created_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

#角色用户多对多表
drop table if exists `role_user`;
CREATE TABLE `role_user`
(
  `id`             int UNSIGNED NOT NULL COMMENT '主键ID',
  `role_id`        int UNSIGNED NOT NULL COMMENT '角色ID',
  `user_id`        bigint UNSIGNED NOT NULL COMMENT '用户ID',
  `is_delete`      tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否软删除：0-否，1-是，默认0',
  `is_delete_user` bigint UNSIGNED DEFAULT NULL COMMENT '软删除操作人ID',
  `created_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at`     timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


#添加外键约束索引
#用户表
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`business_department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`default_pricelist_id`) REFERENCES `pricelist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_ibfk_5` FOREIGN KEY (`default_warehouse_id`) REFERENCES `warehouse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_ibfk_6` FOREIGN KEY (`default_sellsport_id`) REFERENCES `sellsport` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

#国家表
ALTER TABLE `country`
  ADD CONSTRAINT `country_ibfk_1` foreign key (`money_id`) references `money` (`id`) on delete cascade on update cascade,
  ADD CONSTRAINT `country_ibfk_2` foreign key (`is_delete_user`) references `user` (`id`) on delete cascade on update cascade;

#部门表
ALTER TABLE `department`
	ADD CONSTRAINT `department_ibfk_1` foreign key (`is_delete_user`) references `user` (`id`) on delete cascade on update cascade;

#价格单表
ALTER TABLE `pricelist`
	ADD CONSTRAINT `pricelist_ibfk_1` foreign key (`is_delete_user`) references `user` (`id`) on delete cascade on update cascade;

#币种表
ALTER TABLE `money`
  ADD CONSTRAINT `money_ibfk_1` FOREIGN KEY (`is_delete_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

#仓库表
ALTER TABLE `warehouse`
  ADD CONSTRAINT `warehouse_ibfk_1` foreign key (`country_id`) references `country` (`id`) on delete cascade on update cascade,
  ADD CONSTRAINT `warehouse_ibfk_2` foreign key (`is_delete_user`) references `user` (`id`) on delete cascade on update cascade;

#销售端口表
ALTER TABLE `sellsport`
  ADD CONSTRAINT `sellsport_ibfk_1` foreign key (`supplier_id`) references `country` (`id`) on delete cascade on update cascade,
  ADD CONSTRAINT `sellsport_ibfk_2` foreign key (`is_delete_user`) references `user` (`id`) on delete cascade on update cascade;

#供货商表
ALTER TABLE `supplier`
	ADD CONSTRAINT `supplier_ibfk_1` foreign key (`is_delete_user`) references `user` (`id`) on delete cascade on update cascade;

#角色表
ALTER TABLE `role`
	ADD CONSTRAINT `role_ibfk_1` foreign key (`is_delete_user`) references `user` (`id`) on delete cascade on update cascade;

#权限表
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`is_delete_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

#角色权限多对多表
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_ibfk_3` FOREIGN KEY (`is_delete_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

#角色用户表
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_ibfk_3` FOREIGN KEY (`is_delete_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;