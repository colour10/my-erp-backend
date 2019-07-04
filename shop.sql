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
) engine = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='购物车';


/* 支付订单主表 */
DROP TABLE IF EXISTS `tb_shoporder_common`;

CREATE TABLE `tb_shoporder_common`
(
    `id`              int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
    `order_no`        varchar(255)     DEFAULT NULL COMMENT '订单号',
    `member_id`       int(10) UNSIGNED DEFAULT NULL COMMENT '会员id',
    `reciver_name`    varchar(64)      DEFAULT NULL COMMENT '收件人',
    `reciver_phone`   varchar(64)      DEFAULT NULL COMMENT '手机',
    `reciver_address` varchar(255)     DEFAULT NULL COMMENT '地址',
    `reciver_no`      varchar(18)      DEFAULT NULL COMMENT '身份证',
    `total_price`     decimal(9, 2)    DEFAULT NULL COMMENT '商品总计',
    `send_price`      decimal(9, 2)    DEFAULT '0.00' COMMENT '运费',
    `final_price`     decimal(9, 2)    DEFAULT NULL COMMENT '成交价',
    `order_status`    int(1)           DEFAULT '1' COMMENT '订单状态(1未支付；2已支付；未完成；3已完成；4已取消；5退款中；6已退款)',
    `pay_style`       int(1)           DEFAULT '0' COMMENT '支付方式(0未支付；1微信；2支付宝)',
    `create_time`     datetime         DEFAULT NULL COMMENT '创建时间',
    `expire_time`     datetime         DEFAULT NULL COMMENT '库存锁定截止时间，默认为1个小时',
    `pay_time`        datetime         DEFAULT NULL COMMENT '支付时间',
    PRIMARY KEY (`id`),
    KEY `member_id` (`member_id`),
    KEY `order_status` (`order_status`),
    KEY `pay_style` (`pay_style`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='支付订单主表';


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
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='支付订单详情表';

/* `tb_product_search` 更改key为primary key */
ALTER TABLE `tb_product_search`
    DROP INDEX `id`,
    ADD PRIMARY KEY (`id`);

/* `tb_product_search` 增加一个字段brandid */
ALTER TABLE `tb_product_search`
    ADD `brandid` INT UNSIGNED NULL COMMENT '品牌id' AFTER `sizetopid`;

/* 超级管理员表 */
DROP TABLE IF EXISTS `tb_manager`;

CREATE TABLE `tb_manager`
(
    `id`         int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '主键ID',
    `login_name` varchar(100)              DEFAULT NULL COMMENT '登录名',
    `password`   varchar(50)               DEFAULT NULL COMMENT '密码',
    `created_at` timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY `login_name` (`login_name`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='超级管理员表';

/* 添加一个admin管理员 */
INSERT INTO `tb_manager` (login_name, password)
VALUES ('asa', md5('asa'));
