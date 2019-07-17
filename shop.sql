/* 此sql为附带商城相关表 */
/* 购物车表 */
DROP TABLE IF EXISTS `tb_buycar`;

CREATE TABLE `tb_buycar`
(
    `id`           int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
    `product_id`   int(10) UNSIGNED NOT NULL COMMENT '商品id',
    `product_name` varchar(255)     NOT NULL COMMENT '商品名称',
    `color_id`     varchar(64)               DEFAULT NULL COMMENT '颜色id',
    `color_name`   varchar(64)               DEFAULT NULL COMMENT '颜色名称',
    `size_id`      int(11)          NOT NULL COMMENT '规格id',
    `size_name`    varchar(64)      NOT NULL COMMENT '规格名称',
    `member_id`    int(10) UNSIGNED NOT NULL COMMENT '用户id',
    `number`       int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT '数量',
    `price`        decimal(9, 2)    NOT NULL COMMENT '价格',
    `total_price`  decimal(9, 2)    NOT NULL COMMENT '总价格',
    `picture`      varchar(255)              DEFAULT NULL COMMENT '商品主图',
    `picture2`     varchar(255)              DEFAULT NULL COMMENT '商品附图',
    PRIMARY KEY (`id`),
    KEY `product_id` (`product_id`),
    KEY `member_id` (`member_id`)
) engine = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='购物车';


/* 支付订单主表 */
DROP TABLE IF EXISTS `tb_shoporder_common`;

CREATE TABLE `tb_shoporder_common`
(
    `id`              int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
    `order_no`        varchar(100)              DEFAULT NULL COMMENT '订单号',
    `member_id`       int(10) UNSIGNED          DEFAULT NULL COMMENT '会员id',
    `company_id`      int(10) UNSIGNED          DEFAULT NULL COMMENT '会员所属公司id',
    `reciver_name`    varchar(64)               DEFAULT NULL COMMENT '收件人',
    `reciver_phone`   varchar(64)               DEFAULT NULL COMMENT '手机',
    `reciver_address` varchar(255)              DEFAULT NULL COMMENT '地址',
    `reciver_no`      varchar(18)               DEFAULT NULL COMMENT '身份证',
    `total_price`     decimal(9, 2)             DEFAULT NULL COMMENT '商品总计',
    `send_price`      decimal(9, 2)             DEFAULT '0.00' COMMENT '运费',
    `final_price`     decimal(9, 2)             DEFAULT NULL COMMENT '成交价',
    `payment_method`  varchar(255)              DEFAULT NULL COMMENT '支付方式：wechat-微信支付；alipay-支付宝支付',
    `payment_no`      varchar(100)              DEFAULT NULL COMMENT '支付单号',
    `refund_status`   varchar(255)              DEFAULT 'pending' COMMENT '退款状态：pending-未退款；applied-已申请退款；processing-退款中；success-退款成功；failed-退款失败',
    `refund_no`       varchar(100)              DEFAULT NULL COMMENT '退款单号',
    `closed`          tinyint(1)                DEFAULT 0 COMMENT '订单是否已关闭：0-未关闭；1-已关闭；默认为0-未关闭',
    `ship_status`     varchar(255)              DEFAULT 'pending' COMMENT '物流状态：pending-未发货；delivered-已发货；received-已收货',
    `ship_data`       text COMMENT '物流数据',
    `create_time`     timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `expire_time`     datetime                  DEFAULT NULL COMMENT '库存锁定截止时间，默认为1个小时',
    `pay_time`        datetime                  DEFAULT NULL COMMENT '支付时间',
    `update_time`     timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    `extra`           text COMMENT '其他额外的数据',
    PRIMARY KEY (`id`),
    KEY `order_no` (`order_no`),
    KEY `member_id` (`member_id`),
    KEY `company_id` (`company_id`),
    KEY `payment_no` (`payment_no`),
    KEY `refund_no` (`refund_no`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='支付订单主表';


/* 支付订单详情表 */
DROP TABLE IF EXISTS `tb_shoporder`;

CREATE TABLE `tb_shoporder`
(
    `id`             int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
    `product_id`     int(10) UNSIGNED NOT NULL COMMENT '商品id',
    `order_commonid` int(10) UNSIGNED NOT NULL COMMENT '订单公共表id',
    `product_name`   varchar(255)     NOT NULL COMMENT '商品名称',
    `price`          decimal(9, 2)    NOT NULL COMMENT '价格',
    `number`         int(10) UNSIGNED NOT NULL COMMENT '数量',
    `total_price`    decimal(9, 2)    NOT NULL COMMENT '此商品的总价格',
    `picture`        varchar(255) DEFAULT NULL COMMENT '商品主图',
    `picture2`       varchar(255) DEFAULT NULL COMMENT '商品附图',
    `color_id`       varchar(64)  DEFAULT NULL COMMENT '颜色id',
    `color_name`     varchar(64)  DEFAULT NULL COMMENT '颜色名称',
    `size_id`        int(10) UNSIGNED NOT NULL COMMENT '规格id',
    `size_name`      varchar(64)      NOT NULL COMMENT '规格名称',
    PRIMARY KEY (`id`),
    KEY `product_id` (`product_id`),
    KEY `order_commonid` (`order_commonid`),
    KEY `size_id` (`size_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='支付订单详情表';

/* `tb_product_search` 更改key为primary key */
ALTER TABLE `tb_product_search` DROP INDEX `id`, ADD PRIMARY KEY (`id`);

/* `tb_product_search` 增加一个字段brandid */
ALTER TABLE `tb_product_search` ADD `brandid` INT UNSIGNED NULL COMMENT '品牌id' AFTER `sizetopid`;

/* `tb_product_search` 增加一个字段gender */
ALTER TABLE `tb_product_search` ADD `gender` VARCHAR(100) DEFAULT NULL COMMENT '性别' AFTER `brandid`;

/* `tb_member` 增加一个字段is_lockstock */
ALTER TABLE `tb_member` ADD `is_lockstock` TINYINT(1) DEFAULT 0 COMMENT '是否锁库存' AFTER `companyid`;

/* 超级管理员表 */
DROP TABLE IF EXISTS `tb_manager`;

CREATE TABLE `tb_manager`
(
    `id`         int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '主键ID',
    `login_name` varchar(100)              DEFAULT NULL COMMENT '登录名',
    `password`   varchar(50)               DEFAULT NULL COMMENT '密码',
    `created_at` timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `updated_at` timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    KEY `login_name` (`login_name`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='超级管理员表';

/* 添加一个admin管理员 */
INSERT INTO `tb_manager` (login_name, password) VALUES ('asa', md5('asa'));

/* 删除tb_companyhost表 */
DROP TABLE IF EXISTS `tb_companyhost`;

/* ERP附带商城支付配置表 */
DROP TABLE IF EXISTS `tb_shoppayment`;

CREATE TABLE `tb_shoppayment`
(
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '主键ID',
    `companyid`  INT UNSIGNED NOT NULL COMMENT '所属公司id',
    `config`     TEXT COMMENT '支付配置',
    `created_at` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `updated_at` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    KEY `companyid` (`companyid`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='ERP附带商城支付配置表';
