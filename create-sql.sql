/*==============================================================*/
/* dbms name:      mysql 5.0                                    */
/* created on:     2019/3/5 9:19:01                             */
/*==============================================================*/


drop table if exists ac_invoice;

drop table if exists ac_invoice_fee;

drop table if exists ac_invoice_fee_detail;

drop table if exists ac_invoice_prepay;

drop table if exists ac_kmyue_wb;

drop table if exists ac_pzhb;

drop table if exists ac_pzhh;

drop table if exists ac_pzhmxb;

drop table if exists ac_sf_sheet;

drop table if exists ac_sf_sheet_code;

drop table if exists ac_sf_sheet_refund;

drop table if exists dd_arrivalnotice;

drop table if exists dd_arrivalnotice_detail;

drop table if exists dd_confirmorder;

drop table if exists dd_corder_ctn;

drop table if exists dd_corder_temp;

drop table if exists dd_corderdetails;

drop table if exists dd_fee;

drop table if exists dd_order;

drop table if exists dd_ordercode;

drop table if exists dd_orderdetails;

drop table if exists dd_quotation;

drop table if exists dd_quotation_detail;

drop table if exists if_cfashion;

drop table if exists if_exception;

drop table if exists if_imgorder;

drop table if exists if_jingdong;

drop table if exists if_meilihui;

drop table if exists if_meixi;

drop table if exists if_ofashion;

drop table if exists if_shangpin;

drop table if exists if_shangpin_direct;

drop table if exists if_siku;

drop table if exists if_sxdzb;

drop table if exists if_zhenpin;

drop table if exists if_zouxiu;

drop table if exists link_actual_to_productstock;

drop table if exists link_barcode_to_size;

drop table if exists link_brand_to_brandgroup;

drop table if exists link_brand_to_discount;

drop table if exists link_brand_to_priced;

drop table if exists link_brandgroup_to_supplier;

drop table if exists link_cdetail_to_ddetail;

drop table if exists link_childbrand_to_execution;

drop table if exists link_childbrand_to_innards;

drop table if exists link_childbrand_to_material;

drop table if exists link_childbrand_to_outinnards;

drop table if exists link_childbrand_to_safety;

drop table if exists link_color_to_brand;

drop table if exists link_contacts_to_supplier;

drop table if exists link_ctn_to_cdetail;

drop table if exists link_data_to_file;

drop table if exists link_department_to_salesport;

drop table if exists link_detail_to_detail;

drop table if exists link_distribute_to_cdetail;

drop table if exists link_group_to_navigation;

drop table if exists link_invoice_to_order;

drop table if exists link_invoice_to_requisition;

drop table if exists link_invoice_to_warehousing;

drop table if exists link_kp_to_store;

drop table if exists link_prep_to_productstock;

drop table if exists link_pricelist_to_salesport;

drop table if exists link_product_to_materislstatus;

drop table if exists link_product_to_salesnature;

drop table if exists link_product_to_closedway;

drop table if exists link_product_to_decade;

drop table if exists link_product_to_dscrb;

drop table if exists link_product_to_marketprice;

drop table if exists link_product_to_material;

drop table if exists link_product_to_material2;

drop table if exists link_product_to_occasions;

drop table if exists link_product_to_origin;

drop table if exists link_product_to_outproductinnards;

drop table if exists link_product_to_picture;

drop table if exists link_product_to_picture_ftp;

drop table if exists link_product_to_price;

drop table if exists link_product_to_price2;

drop table if exists link_product_to_price_history;

drop table if exists link_product_to_productinnards;

drop table if exists link_product_to_productparts;

drop table if exists link_product_to_salesport;

drop table if exists link_product_to_salesport_history;

drop table if exists link_product_to_size;

drop table if exists link_product_to_washinginstructions;

drop table if exists link_pzh_to_invoice;

drop table if exists link_pzh_to_invoicefee;

drop table if exists link_pzh_to_order;

drop table if exists link_pzh_to_sales;

drop table if exists link_pzh_to_sales_trans;

drop table if exists link_pzh_to_warehousing_fee;

drop table if exists link_return_to_productstock;

drop table if exists link_rule_to_operation;

drop table if exists link_sales_to_productstock;

drop table if exists link_salespot_to_childbrand;

drop table if exists link_sellspot_to_brand;

drop table if exists link_special_to_productstock;

drop table if exists link_spot_warehouse;

drop table if exists link_supplier_to_brand;

drop table if exists link_user_to_labourcontactor;

drop table if exists link_user_to_price;

drop table if exists link_user_to_reportset;

drop table if exists link_user_to_rule;

drop table if exists link_user_to_salesport;

drop table if exists link_user_to_supplier;

drop table if exists link_user_to_warehouse;

drop table if exists sys_config;

drop table if exists sys_selfcompany;

drop table if exists tb_card;

drop table if exists tb_check;

drop table if exists tb_check_detail;

drop table if exists tb_contactlist;

drop table if exists tb_declaration;

drop table if exists tb_declaration_detail;

drop table if exists tb_department;

drop table if exists tb_discount_card;

drop table if exists tb_distribute;

drop table if exists tb_distributecode;

drop table if exists tb_express;

drop table if exists tb_fee;

drop table if exists tb_fee_detail;

drop table if exists tb_feecode;

drop table if exists tb_group;

drop table if exists tb_inve_actual;

drop table if exists tb_inve_actual_dtl;

drop table if exists tb_inve_prep;

drop table if exists tb_inve_prep_dtl;

drop table if exists tb_kp;

drop table if exists tb_member;

drop table if exists tb_member_address;

drop table if exists tb_member_bank;

drop table if exists tb_member_card;

drop table if exists tb_member_card_history;

drop table if exists tb_member_contactor;

drop table if exists tb_member_header;

drop table if exists tb_member_preference;

drop table if exists tb_member_preference_size;

drop table if exists tb_member_preordination;

drop table if exists tb_picture;

drop table if exists tb_pre_requisition;

drop table if exists tb_product;

drop table if exists tb_product_price;

drop table if exists tb_productstock;

drop table if exists tb_productstock_snapshot;

drop table if exists tb_requisition;

drop table if exists tb_requisition_detail;

drop table if exists tb_requisition_detail_group;

drop table if exists tb_requisition_express;

drop table if exists tb_requisitioncode;

drop table if exists tb_rule;

drop table if exists tb_savings_card;

drop table if exists tb_special_requisition;

drop table if exists tb_special_requisition_detail;

drop table if exists tb_stock;

drop table if exists tb_supplier;

drop table if exists tb_supplier_orderdate;

drop table if exists tb_user;

drop table if exists tb_verificationcode;

drop table if exists tb_warehousing;

drop table if exists tb_warehousing_detail;

drop table if exists tb_warehousing_fee;

drop table if exists trans_brand_code;

drop table if exists trans_color_code;

drop table if exists trans_group_code;

drop table if exists trans_size_code;

drop table if exists xs_afterservice;

drop table if exists xs_afterservice_detail;

drop table if exists xs_pre_sales;

drop table if exists xs_pre_salescode;

drop table if exists xs_pre_salesdetails;

drop table if exists xs_pricelist;

drop table if exists xs_pricelistdetails;

drop table if exists xs_return;

drop table if exists xs_returncode;

drop table if exists xs_sales;

drop table if exists xs_sales_card;

drop table if exists xs_sales_cardetails;

drop table if exists xs_sales_pay;

drop table if exists xs_salescode;

drop table if exists xs_salesdetails;

drop table if exists zl_ac_cashflow_statement;

drop table if exists zl_ac_cashflow_subject;

drop table if exists zl_ac_km;

drop table if exists zl_ac_km_type;

drop table if exists zl_ac_pzh_rule;

drop table if exists zl_ac_pzh_type;

drop table if exists zl_ac_ztb;

drop table if exists zl_ageseason;

drop table if exists zl_aliases;

drop table if exists zl_bankinformation;

drop table if exists zl_brand;

drop table if exists zl_brandgroup;

drop table if exists zl_brandremark;

drop table if exists zl_businesstype;

drop table if exists zl_childproductgroup;

drop table if exists zl_closedway;

drop table if exists zl_color;

drop table if exists zl_colortemplate;

drop table if exists zl_companycontacts;

drop table if exists zl_costformula;

drop table if exists zl_country;

drop table if exists zl_currency;

drop table if exists zl_customs_name;

drop table if exists zl_decade;

drop table if exists zl_delare_makings;

drop table if exists zl_ex_reportstyle;

drop table if exists zl_ex_reportstyle_detail;

drop table if exists zl_exchangerate;

drop table if exists zl_executioncategory;

drop table if exists zl_exhibition;

drop table if exists zl_feenames;

drop table if exists zl_forbiddenword;

drop table if exists zl_imagetool;

drop table if exists zl_invite_rule;

drop table if exists zl_invoice_header;

drop table if exists zl_material;

drop table if exists zl_materialnote;

drop table if exists zl_materialstatus;

drop table if exists zl_memberlevel;

drop table if exists zl_occasionsstyle;

drop table if exists zl_pricesource;

drop table if exists zl_productdscrb;

drop table if exists zl_productinnards;

drop table if exists zl_productparts;

drop table if exists zl_productprice;

drop table if exists zl_productstyle;

drop table if exists zl_producttemplate;

drop table if exists zl_quotedprice;

drop table if exists zl_reportset;

drop table if exists zl_reportset_detail;

drop table if exists zl_salesmethods;

drop table if exists zl_salesport;

drop table if exists zl_salesport_mission;

drop table if exists zl_series;

drop table if exists zl_series2;

drop table if exists zl_shippingtype;

drop table if exists zl_sizecontent;

drop table if exists zl_sizetop;

drop table if exists zl_storemove;

drop table if exists zl_style;

drop table if exists zl_supplier_type;

drop table if exists zl_supplierlevel;

drop table if exists zl_sys_selfcompany;

drop table if exists zl_template_descrb;

drop table if exists zl_templatelist;

drop table if exists zl_templatemanage;

drop table if exists zl_trans_code;

drop table if exists zl_ulnarinch;

drop table if exists zl_unit;

drop table if exists zl_unitgroup;

drop table if exists zl_warehouse;

drop table if exists zl_washinginstructions;

drop table if exists zl_winterproofing;

drop table if exists zl_yearexchange;

drop table if exists 模版;

/*==============================================================*/
/* table: ac_invoice                                            */
/*==============================================================*/
create table ac_invoice
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  invoicedate      datetime,
  supplierid       int unsigned null,
  paycusid         int unsigned null,
  rate             decimal(16,9),
  departmentid     int unsigned null,
  userid           int unsigned null,
  currencyid       int unsigned null,
  sum              decimal(16,9),
  dsum             decimal(16,9),
  ssum             decimal(16,9),
  invoicesum       decimal(16,9),
  exchangrate      decimal(16,9),
  invoiceno        varchar(20),
  remark           varchar(100),
  checkstatus      varchar(1) comment '0-未审核，1-已审核',
  checkid          int unsigned null,
  glstatus         varchar(1),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table ac_invoice comment '货款发票主表';

/*==============================================================*/
/* table: ac_invoice_fee                                        */
/*==============================================================*/
create table ac_invoice_fee
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  invoicedate      datetime,
  supplierid       int unsigned null,
  paycusid         int unsigned null,
  rate             decimal(16,9),
  departmentid     int unsigned null,
  userid           int unsigned null,
  currencyid       int unsigned null,
  exchangrate      decimal(16,9),
  invoiceno        varchar(20),
  remark           char(1),
  checkstatus      varchar(1) comment '0-未审核，1-已审核',
  checkid          int unsigned null,
  glstatus         varchar(1),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table ac_invoice_fee comment '运费发票主表';

/*==============================================================*/
/* table: ac_invoice_fee_detail                                 */
/*==============================================================*/
create table ac_invoice_fee_detail
(
  id                int unsigned not null auto_increment comment '主键id',
  sys_create_stuff  int unsigned not null,
  sys_create_date   datetime not null,
  sys_modify_stuff  int unsigned not null,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int unsigned null,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  invoiceid         int unsigned null,
  feeid             int unsigned null,
  number            int,
  feesum            decimal(16,9),
  feecurrencyid     int unsigned not null,
  invoicecurrencyid varchar(36),
  invoicesum        decimal(16,9),
  remark            varchar(100),
  sfcompany         varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table ac_invoice_fee_detail comment '运费发票明细表';

/*==============================================================*/
/* table: ac_invoice_prepay                                     */
/*==============================================================*/
create table ac_invoice_prepay
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  invoicedate      datetime,
  supplierid       int unsigned null,
  paycusid         int unsigned null,
  rate             decimal(16,9),
  departmentid     int unsigned null,
  userid           int unsigned null,
  currencyid       int unsigned null,
  sum              decimal(16,9),
  invoicesum       decimal(16,9),
  exchangrate      decimal(16,9),
  invoiceno        varchar(20),
  remark           varchar(100),
  checkstatus      varchar(1) comment '0-未审核，1-已审核',
  checkid          int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table ac_invoice_prepay comment '订金发票主表';

/*==============================================================*/
/* table: ac_kmyue_wb                                           */
/*==============================================================*/
create table ac_kmyue_wb
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ztid             int unsigned null,
  kmid             int unsigned null,
  nf               varchar(4),
  yf               varchar(2),
  currencyid       int unsigned null,
  hl               decimal(19, 6),
  qche             decimal(19, 6),
  jffshe           decimal(19, 6),
  dffshe           decimal(19, 6),
  qmye             decimal(19, 6),
  qcher            decimal(19, 6),
  jffsher          decimal(19, 6),
  dffsher          decimal(19, 6),
  qmyer            decimal(19, 6),
  cus_id           int unsigned null,
  dep_id           int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table ac_kmyue_wb comment '科目余额表';

/*==============================================================*/
/* table: ac_pzhb                                               */
/*==============================================================*/
create table ac_pzhb
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ztid             int unsigned null,
  pzh_flow_type    varchar(2) comment 'th-调汇 jz-结转 fy-费用 fp-发票
            hk-回款 zz-转账 cx-冲销 zc-正常
            zj-折旧',
  pzh_type_id      int unsigned null,
  nf               varchar(5),
  yf               varchar(2),
  rq               varchar(2),
  pzh              varchar(50),
  zy               varchar(1000),
  lrrid            int unsigned null,
  shr              varchar(36),
  shrq             datetime,
  jzr              varchar(36),
  jzrq             datetime,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table ac_pzhb comment '凭证表';

/*==============================================================*/
/* table: ac_pzhh                                               */
/*==============================================================*/
create table ac_pzhh
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ztid             int unsigned null,
  nf               varchar(5),
  yf               varchar(2),
  rq               varchar(2),
  pzh_type_id      int unsigned null,
  pzhxh            int,
  yjbz             varchar(1),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table ac_pzhh comment '凭证号表';

/*==============================================================*/
/* table: ac_pzhmxb                                             */
/*==============================================================*/
create table ac_pzhmxb
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  pzhid            int unsigned null,
  kmid             int unsigned null,
  currencyid       int unsigned null,
  hl               decimal(19,6),
  jffshe           decimal(19,6),
  jffsher          decimal(19,6),
  dffshe           decimal(19,6),
  dffsher          decimal(19,6),
  zy               varchar(1000),
  sourse           varchar(1) comment 'y-业务 c-普通 r-回款',
  cus_id           int unsigned null,
  dep_id           int unsigned null,
  jord             varchar(1),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table ac_pzhmxb comment '凭证明细表';

/*==============================================================*/
/* table: ac_sf_sheet                                           */
/*==============================================================*/
create table ac_sf_sheet
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  sheetno          varchar(50),
  sorf             varchar(1),
  sfcompany        varchar(36),
  currencyid       int unsigned null,
  sum              decimal(16,9),
  creator          varchar(36),
  date             datetime,
  remark           text,
  externalno       varchar(50),
  header           text,
  originalsum      decimal(16,9),
  adjustsum        decimal(16,9),
  iskp             varchar(1),
  kpid             int unsigned null,
  refundremark     text,
  isrefund         varchar(1),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table ac_sf_sheet comment '对账费单';

/*==============================================================*/
/* table: ac_sf_sheet_code                                      */
/*==============================================================*/
create table ac_sf_sheet_code
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  year             varchar(5),
  code             varchar(10),
  month            varchar(5),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table ac_sf_sheet_code comment '对账单号表';

/*==============================================================*/
/* table: ac_sf_sheet_refund                                    */
/*==============================================================*/
create table ac_sf_sheet_refund
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  sheetid          int unsigned null,
  refunddate       datetime,
  refundbank       varchar(100),
  currencyid       int unsigned null,
  refundsum        decimal(10,2),
  invoiceno        varchar(100),
  remark           varchar(1000),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table ac_sf_sheet_refund comment '对账单回款情况';

/*==============================================================*/
/* table: dd_arrivalnotice                                      */
/*==============================================================*/
create table dd_arrivalnotice
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  corderid         int unsigned null,
  orderno          varchar(50),
  makedate         datetime,
  makestaff        varchar(36),
  supplierid       int unsigned not null,
  currencyid       int unsigned null,
  total            decimal(16,9),
  isstatus         varchar(1),
  remark           varchar(200),
  auditstaff       varchar(36),
  auditdate        datetime,
  auditstatus      varchar(1),
  exchangerate     decimal(16,9),
  brandid          int unsigned null,
  finalsupplierid  int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table dd_arrivalnotice comment '到货单';

/*==============================================================*/
/* table: dd_arrivalnotice_detail                               */
/*==============================================================*/
create table dd_arrivalnotice_detail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  arrivalid        int unsigned null,
  detailid         int unsigned null,
  productid        int unsigned null,
  sizeid           int unsigned null,
  number           int,
  currencyid       int unsigned null,
  price            decimal(16,9),
  cost             decimal(16,9),
  cjj              decimal(16,9),
  yj               decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table dd_arrivalnotice_detail comment '到货单明细';

/*==============================================================*/
/* table: dd_confirmorder                                       */
/*==============================================================*/
create table dd_confirmorder
(
  id                 int unsigned not null auto_increment comment '主键id',
  sys_create_stuff   int unsigned not null,
  sys_create_date    datetime    not null,
  sys_modify_stuff   int unsigned not null,
  sys_modify_date    datetime    not null,
  sys_delete_stuff   int unsigned null,
  sys_delete_date    datetime,
  sys_delete_flag    tinyint     not null comment '0-未删除 1-已删除',

  orderno            varchar(50),
  makedate           datetime,
  makestaff          varchar(36),
  supplierid         int unsigned not null,
  currencyid         int unsigned null,
  total              decimal(16,9),
  isstatus           varchar(1) comment '0-在途未入库，1-已入库，2-已备货未发出',
  remark             varchar(200),
  brandid            int unsigned null,
  season             varchar(36),
  seasontype         varchar(1) comment '0-pre ,1-main ,2-fashion show',
  auditstaff         varchar(36),
  auditdate          datetime,
  auditstatus        varchar(1),
  exchangerate       decimal(16,9),
  finalsupplierid    int unsigned null,
  flightno           varchar(50),
  flightdate         datetime,
  arrivaldate        datetime,
  mblno              varchar(50),
  hblno              varchar(50),
  dispatchport       varchar(50),
  deliveryport       varchar(50),
  transcompany       varchar(36),
  isexamination      varchar(1),
  examinationresult  varchar(50),
  clearancedate      datetime,
  pickingdate        datetime,
  motortransportpool varchar(50),
  warehouseid        int unsigned null,
  ctns               decimal(16,9),
  kgs                decimal(16,9),
  cbm                decimal(16,9),
  issjyh             varchar(1),
  sellerid           int unsigned not null,
  sjyhresult         varchar(50),
  buyerid            int unsigned not null,
  transporttype      varchar(1) comment '0-by air 1-快递 2-中转',
  paytype            varchar(1) comment '0- t/t',
  property           varchar(1) comment '0-自采 1-代销',
  payoutpercentage   varchar(10),
  pickingaddress     text,
  chargedweight      decimal(16,9),
  paydate            datetime,
  apickingdate       datetime,
  aarrivaldate       datetime,
  invoiceno          varchar(50),
  dd_company         varchar(36) not null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table dd_confirmorder comment '发货单';

/*==============================================================*/
/* table: dd_corder_ctn                                         */
/*==============================================================*/
create table dd_corder_ctn
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  corderid         int unsigned null,
  ctnno            varchar(50),
  length           decimal(16,9),
  width            decimal(16,9),
  height           decimal(16,9),
  weight           decimal(16,9),
  cbm              decimal(16,9),
  remark           varchar(500),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table dd_corder_ctn comment '发货单装箱信息';

/*==============================================================*/
/* table: dd_corder_temp                                        */
/*==============================================================*/
create table dd_corder_temp
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  corderid         int unsigned null,
  cdetailid        int unsigned null,
  detailid         int unsigned null,
  productid        int unsigned null,
  sizeid           int unsigned null,
  anumber          int,
  tm               varchar(50),
  currencyid       int unsigned null,
  price            decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table dd_corder_temp comment '发货单入库快照';

/*==============================================================*/
/* table: dd_corderdetails                                      */
/*==============================================================*/
create table dd_corderdetails
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  corderid         int unsigned null,
  detailid         int unsigned null,
  productid        int unsigned null,
  sizeid           int unsigned null,
  number           int,
  currencyid       int unsigned null,
  price            decimal(16,9),
  cost             decimal(16,9),
  actualnumber     int,
  isstatus         varchar(1) comment '0-未完成
            1-完成',
  containerno      varchar(500),
  cjj              decimal(16,9),
  yj               decimal(16,9),
  size             varchar(50),
  weight           varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table dd_corderdetails comment '发货单明细';

/*==============================================================*/
/* table: dd_fee                                                */
/*==============================================================*/
create table dd_fee
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  dd_id            int unsigned null,
  feeid            int unsigned null,
  currencyid       int unsigned null,
  unitprice        decimal(10,2),
  amount           decimal(10,2),
  sum              decimal(10,2),
  sfcompany        varchar(36),
  sorf             varchar(1) comment 's-收 f-付',
  applyflag        varchar(1) comment '0-未申请 1-已申请',
  applyid          int unsigned null,
  goodstotal       decimal(10,2),
  deduct           decimal(10,2),
  actuallypaid     decimal(10,2),
  amortized        tinyint,
  exchangerate     decimal(16,9),
  standarysum      decimal(10,2),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table dd_fee comment '供应链费用';

/*==============================================================*/
/* table: dd_order                                              */
/*==============================================================*/
create table dd_order
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  bussinesstypeid  int unsigned null,
  makedate         datetime,
  makestaff        varchar(36),
  supplierid       int unsigned not null,
  finalsupplierid  int unsigned null,
  bookingid        int unsigned null,
  agentid          int unsigned null,
  purchasedept     varchar(36),
  brandid          int unsigned not null,
  orderno          varchar(50),
  total            decimal(16,9),
  currencyid       int unsigned null,
  auditstaff       varchar(36),
  auditdate        datetime,
  ordercode        varchar(50),
  worldordercode   varchar(50),
  auditstatus      varchar(1),
  isstatus         varchar(1) comment '0-未完结 1-已完结',
  form             varchar(2) comment 'f-女款，m-男款,fm男款/女款',
  remark           varchar(200),
  contactor        varchar(200),
  ourcontactor     varchar(200),
  season           varchar(36),
  seasontype       varchar(1) comment '0-pre ,1-main ,2-fashion show',
  invoiceno        varchar(50),
  ddtype           varchar(1) comment '0-客户订单，1-品牌订单',
  morderid         int unsigned null,
  exchangerate     decimal(16,9),
  bussinesstype    varchar(1) comment '0-期货 1-现货',
  zkl              decimal(16,9),
  tsl              decimal(16,9),
  property         varchar(1) comment '0-自采 1-代销',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table dd_order comment '订单主表';

/*==============================================================*/
/* table: dd_ordercode                                          */
/*==============================================================*/
create table dd_ordercode
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  year             varchar(5),
  code             varchar(10),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table dd_ordercode comment '订单号表';

/*==============================================================*/
/* table: dd_orderdetails                                       */
/*==============================================================*/
create table dd_orderdetails
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  orderid          int unsigned null,
  sizeid           int unsigned null,
  number           int,
  productid        int unsigned null,
  currencyid       int unsigned null,
  price            decimal(16,9),
  actualnumber     int,
  isstatus         varchar(1) comment '0-未完成
            1-完成',
  cost             decimal(16,9),
  cbtype           varchar(1),
  zkl              decimal(16,9),
  tsbl             decimal(16,9),
  cjj              decimal(16,9),
  yj               decimal(16,9),
  sortnum          int,
  zje              decimal(16,9),
  add_flag         varchar(1),
  thattimestock    int,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table dd_orderdetails comment '订单明细';

/*==============================================================*/
/* table: dd_quotation                                          */
/*==============================================================*/
create table dd_quotation
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  supplierid       int unsigned null,
  form             varchar(1) comment 'f-女款，m-男款',
  year_season      varchar(10),
  rate             decimal(16,9),
  remark           varchar(1000),
  filename         varchar(100),
  s_filename       varchar(100) comment '在服务器上的文件名',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table dd_quotation comment '报价单主表';

/*==============================================================*/
/* table: dd_quotation_detail                                   */
/*==============================================================*/
create table dd_quotation_detail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  quotationid      int unsigned null,
  productid        int unsigned null,
  ordernumber      int,
  pic1             longblob,
  pic2             longblob,
  pic3             longblob,
  pic4             longblob,
  price            decimal(16,9),
  item             varchar(100),
  sizeid           int unsigned null,
  remark           varchar(1000),
  savesize         varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table dd_quotation_detail comment '报价单明细表';

/*==============================================================*/
/* table: if_cfashion                                           */
/*==============================================================*/
create table if_cfashion
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  creationtime     datetime,
  productid        int unsigned null,
  currencyunit     varchar(50),
  description      text,
  mprice           decimal(18,0),
  price            decimal(18,0),
  del              int,
  operationtype    int comment '0-添加 1-修改',
  returnstate      int,
  returntext       text,
  cprice           decimal(18,0),
  sourcefunction   varchar(50),
  sizeid           int unsigned null,
  sku              varchar(50),
  stockchange      varchar(500),
  imglist          text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_cfashion comment '迷橙接口数据表';

/*==============================================================*/
/* table: if_exception                                          */
/*==============================================================*/
create table if_exception
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  operationtype    int comment '0-添加 1-修改',
  asacode          varchar(50),
  exception        char(1),
  sizeid           int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_exception comment '库存变动日志数据表';

/*==============================================================*/
/* table: if_imgorder                                           */
/*==============================================================*/
create table if_imgorder
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  ifid             int unsigned null comment '0-添加 1-修改',
  numorder         int,
  imgname          char(1),
  imgsize          varchar(50),
  imgtype          varchar(50) comment '缩略图，详细图',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_imgorder comment '上传图片顺序';

/*==============================================================*/
/* table: if_jingdong                                           */
/*==============================================================*/
create table if_jingdong
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  creationtime     datetime,
  productid        int unsigned null,
  currencyunit     varchar(50),
  description      text,
  mprice           decimal(18,0),
  price            decimal(18,0),
  del              int,
  operationtype    int comment '0-添加 1-修改',
  returnstate      int,
  returntext       text,
  cprice           decimal(18,0),
  sourcefunction   varchar(50),
  sku              varchar(50),
  stockchange      varchar(500),
  imglist          text,
  externalno       varchar(50),
  sizeid           int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_jingdong comment '京东接口数据表';

/*==============================================================*/
/* table: if_meilihui                                           */
/*==============================================================*/
create table if_meilihui
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  creationtime     datetime,
  productid        int unsigned null,
  currencyunit     varchar(50),
  description      text,
  mprice           decimal(18,0),
  price            decimal(18,0),
  del              int,
  operationtype    int comment '0-添加 1-修改',
  returnstate      int,
  returntext       text,
  cprice           decimal(18,0),
  sourcefunction   varchar(50),
  sizeid           int unsigned null,
  sku              varchar(50),
  stockchange      varchar(500),
  imglist          text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_meilihui comment '魅力惠接口数据表';

/*==============================================================*/
/* table: if_meixi                                              */
/*==============================================================*/
create table if_meixi
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  creationtime     datetime,
  productid        int unsigned null,
  currencyunit     varchar(50),
  description      text,
  mprice           decimal(18,0),
  price            decimal(18,0),
  del              int,
  operationtype    int comment '0-添加 1-修改',
  returnstate      int comment '0-未处理
            1-处理成功
            2-异常',
  returntext       text,
  cprice           decimal(18,0),
  sourcefunction   varchar(50),
  sku              varchar(50),
  stockchange      varchar(500),
  imglist          text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_meixi comment '美西接口数据表';

/*==============================================================*/
/* table: if_ofashion                                           */
/*==============================================================*/
create table if_ofashion
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  creationtime     datetime,
  productid        int unsigned null,
  currencyunit     varchar(50),
  description      text,
  mprice           decimal(18,0),
  price            decimal(18,0),
  del              int,
  operationtype    int comment '0-添加 1-修改',
  returnstate      int,
  returntext       text,
  cprice           decimal(18,0),
  sourcefunction   varchar(50),
  sizeid           int unsigned null,
  sku              varchar(50),
  stockchange      varchar(500),
  imglist          text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_ofashion comment '迷橙接口数据表';

/*==============================================================*/
/* table: if_shangpin                                           */
/*==============================================================*/
create table if_shangpin
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  creationtime     datetime,
  productid        int unsigned null,
  currencyunit     varchar(50),
  description      text,
  mprice           decimal(18,0),
  price            decimal(18,0),
  del              int,
  operationtype    int comment '0-添加 1-修改',
  returnstate      int,
  returntext       text,
  cprice           decimal(18,0),
  sourcefunction   varchar(50),
  sizeid           int unsigned null,
  sku              varchar(50),
  stockchange      varchar(500),
  imglist          text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_shangpin comment '尚品接口数据表';

/*==============================================================*/
/* table: if_shangpin_direct                                    */
/*==============================================================*/
create table if_shangpin_direct
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  creationtime     datetime,
  productid        int unsigned null,
  currencyunit     varchar(50),
  description      text,
  mprice           decimal(18,0),
  price            decimal(18,0),
  del              int,
  operationtype    int comment '0-添加 1-修改',
  returnstate      int,
  returntext       text,
  cprice           decimal(18,0),
  sourcefunction   varchar(50),
  sizeid           int unsigned null,
  sku              varchar(50),
  stockchange      varchar(500),
  imglist          text,
  categoryno       varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_shangpin_direct comment '尚品直发接口数据表';

/*==============================================================*/
/* table: if_siku                                               */
/*==============================================================*/
create table if_siku
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  creationtime     datetime,
  productid        int unsigned null,
  sizeid           int unsigned null,
  salesid          int unsigned null,
  operationtype    int comment '0-添加 1-修改',
  returnstate      int,
  returntext       text,
  sourcefunction   varchar(50),
  sku              varchar(50),
  stockchange      int,
  imglist          text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_siku comment '美西接口数据表';

/*==============================================================*/
/* table: if_sxdzb                                              */
/*==============================================================*/
create table if_sxdzb
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  zpid             bigint,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_sxdzb comment '珍品上传商品对照';

/*==============================================================*/
/* table: if_zhenpin                                            */
/*==============================================================*/
create table if_zhenpin
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  creationtime     datetime,
  productid        int unsigned null,
  operationtype    int comment '0-添加 1-修改',
  returnstate      int,
  returntext       text,
  sourcefunction   varchar(50),
  sku              varchar(50),
  stockchange      int,
  imglist          text,
  currencyunit     varchar(50),
  mprice           varchar(50),
  price            varchar(50),
  cprice           varchar(50),
  description      text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_zhenpin comment '珍品接口数据表';

/*==============================================================*/
/* table: if_zouxiu                                             */
/*==============================================================*/
create table if_zouxiu
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  creationtime     datetime,
  productid        int unsigned null,
  operationtype    int comment '0-添加 1-修改',
  returnstate      int,
  returntext       text,
  mprice           decimal(18,0),
  price            decimal(18,0),
  description      text,
  currencyunit     varchar(50),
  sourcefunction   varchar(50),
  sku              varchar(50),
  stockchange      int,
  imglist          text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table if_zouxiu comment '美西接口数据表';

/*==============================================================*/
/* table: link_actual_to_productstock                           */
/*==============================================================*/
create table link_actual_to_productstock
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productstockid   int unsigned null,
  actualid         int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_actual_to_productstock comment '实盘单到库存之间的记录';

/*==============================================================*/
/* table: link_barcode_to_size                                  */
/*==============================================================*/
create table link_barcode_to_size
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  sizeid           int unsigned null,
  productid        int unsigned null,
  barcode          varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_barcode_to_size comment '任何表都应该包含的列';

/*==============================================================*/
/* table: link_brand_to_brandgroup                              */
/*==============================================================*/
create table link_brand_to_brandgroup
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  brandid          int unsigned null,
  groupid          int unsigned null,
  brandgroupid     int unsigned null,
  note             varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_brand_to_brandgroup comment '任何表都应该包含的列';

/*==============================================================*/
/* table: link_brand_to_discount                                */
/*==============================================================*/
create table link_brand_to_discount
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  brandid          int unsigned null,
  decade           varchar(36),
  groupid          int unsigned null,
  brandgroupid     int unsigned null,
  discount         decimal(10,2),
  gender           varchar(1) comment '0-女式 1-男士 2-中性',
  note             varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_brand_to_discount comment '品牌出厂价折扣';

/*==============================================================*/
/* table: link_brand_to_priced                                  */
/*==============================================================*/
create table link_brand_to_priced
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  brandtypeid      int unsigned null,
  priced           decimal(19,6),
  brandid          int unsigned null,
  priceid          int unsigned null,
  pricedmark       varchar(1) comment '0 - 欧洲零售价
            1 - 欧洲出厂价',
  symbol           varchar(2),
  isrounded        varchar(1) comment '0- 0-20 取0 ,21-70 取50,71-99 取100
            1-0-1取0，1-6取5，6-9取10
            2.不取整',
  decade           varchar(36),
  currencyid       int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_brand_to_priced comment '任何表都应该包含的列';

/*==============================================================*/
/* table: link_brandgroup_to_supplier                           */
/*==============================================================*/
create table link_brandgroup_to_supplier
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  supplierid       int unsigned null,
  brandgroupid     int unsigned null,
  decade           varchar(36),
  markup           decimal(10,2),
  currencyid       int unsigned null,
  sum              decimal(10,2),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_brandgroup_to_supplier comment '供货商品类连接表';

/*==============================================================*/
/* table: link_cdetail_to_ddetail                               */
/*==============================================================*/
create table link_cdetail_to_ddetail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  cdetailid        int unsigned null,
  ddetailid        varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_cdetail_to_ddetail comment '连接表 发货单明细 to 报关明细';

/*==============================================================*/
/* table: link_childbrand_to_execution                          */
/*==============================================================*/
create table link_childbrand_to_execution
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  childbrandid     varchar(36),
  executionid      varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_childbrand_to_execution comment '任何表都应该包含的列';

/*==============================================================*/
/* table: link_childbrand_to_innards                            */
/*==============================================================*/
create table link_childbrand_to_innards
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  childbrandid     varchar(36),
  innardsid        varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_childbrand_to_innards comment '连接表 子品类 to 内部结构';

/*==============================================================*/
/* table: link_childbrand_to_material                           */
/*==============================================================*/
create table link_childbrand_to_material
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  childbrandid     varchar(36),
  materialid       varchar(36),
  hgcode           varchar(50),
  taxrate          decimal(16,9),
  sex              varchar(1) comment '0-女式 1-男士(中性也算男士)',
  isfj             varchar(1) comment '0-否 1-法检',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_childbrand_to_material comment '连接表 子品类 to 材质';

/*==============================================================*/
/* table: link_childbrand_to_outinnards                         */
/*==============================================================*/
create table link_childbrand_to_outinnards
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  childbrandid     varchar(36),
  outinnardsid     varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_childbrand_to_outinnards comment '连接表 子品类 to 外部结构';

/*==============================================================*/
/* table: link_childbrand_to_safety                             */
/*==============================================================*/
create table link_childbrand_to_safety
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  childbrandid     varchar(36),
  safetyid         varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_childbrand_to_safety comment '任何表都应该包含的列';

/*==============================================================*/
/* table: link_color_to_brand                                   */
/*==============================================================*/
create table link_color_to_brand
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  colorid          int unsigned null,
  brandid          int unsigned null,
  colorname        varchar(50),
  colorcode        varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_color_to_brand comment '连接表 颜色模板与品牌链接的关系';

/*==============================================================*/
/* table: link_contacts_to_supplier                             */
/*==============================================================*/
create table link_contacts_to_supplier
(
  id                int unsigned not null auto_increment comment '主键id',
  sys_create_stuff  int unsigned not null,
  sys_create_date   datetime not null,
  sys_modify_stuff  int unsigned not null,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int unsigned null,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  supplierid        varchar(36),
  companycontactsid varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_contacts_to_supplier comment '表暂时未使用';

/*==============================================================*/
/* table: link_ctn_to_cdetail                                   */
/*==============================================================*/
create table link_ctn_to_cdetail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  corderdetailid   varchar(36),
  ctnid            varchar(36),
  sum              int,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_ctn_to_cdetail comment '装箱单 发货单明细 连接表';

/*==============================================================*/
/* table: link_data_to_file                                     */
/*==============================================================*/
create table link_data_to_file
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  dataid           varchar(36) comment '上传附件的相关数据id，例如：订单id等',
  picturename      varchar(500),
  picturepath      varchar(500) comment '带文件名，取文件完整路径=ftp+/+路径',
  servername       varchar(100),
  filetype         varchar(2) comment '0.-一般文件
            1-商标注册证
            2.品牌方发票
            3.供货商发票
            4.供货商装箱单
            5.运单
            6.付款水单
            7.进口报关单
            8.商检放行单
            9.中国关税单
            10.中国增值税单
            11.品牌检测报告
            12.报关文件
            13.供货商合同
            14.付汇水单',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_data_to_file comment '连接表 数据 to 文件（上传附件）';

/*==============================================================*/
/* table: link_department_to_salesport                          */
/*==============================================================*/
create table link_department_to_salesport
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  departmentid     int unsigned null,
  sportid          int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_department_to_salesport comment '销售端口部门连接表';

/*==============================================================*/
/* table: link_detail_to_detail                                 */
/*==============================================================*/
create table link_detail_to_detail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  pdetailid        varchar(36),
  cdetailid        int unsigned null,
  sum              int,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_detail_to_detail comment '品牌订单 客户订单连接表';

/*==============================================================*/
/* table: link_distribute_to_cdetail                            */
/*==============================================================*/
create table link_distribute_to_cdetail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  corderdetailid   varchar(36),
  dstributeid      varchar(36),
  sum              int,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_distribute_to_cdetail comment '分货单 发货单明细 连接表';

/*==============================================================*/
/* table: link_group_to_navigation                              */
/*==============================================================*/
create table link_group_to_navigation
(
  id               int unsigned not null auto_increment comment '主键id',
  groupid          int unsigned null,
  navigationid     varchar(36),
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_group_to_navigation comment '组导航连接表';

/*==============================================================*/
/* table: link_invoice_to_order                                 */
/*==============================================================*/
create table link_invoice_to_order
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  invoiceid        varchar(36),
  orderid          int unsigned null,
  ordersum         decimal(19,6),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_invoice_to_order comment '连接表 运费发票 to 发货单';

/*==============================================================*/
/* table: link_invoice_to_requisition                           */
/*==============================================================*/
create table link_invoice_to_requisition
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  invoiceid        varchar(36),
  requisitionid    int unsigned null,
  type             varchar(1) comment '0-按金额 1-按件数',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_invoice_to_requisition comment '连接表 运费发票 to 调拨单';

/*==============================================================*/
/* table: link_invoice_to_warehousing                           */
/*==============================================================*/
create table link_invoice_to_warehousing
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  invoiceid        varchar(36),
  warehousingid    int unsigned null,
  type             varchar(1) comment '0-按金额 1-按件数',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_invoice_to_warehousing comment '连接表 运费发票 to 入库单';

/*==============================================================*/
/* table: link_kp_to_store                                      */
/*==============================================================*/
create table link_kp_to_store
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  kpid             int unsigned null,
  productstockid   int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_kp_to_store comment '开票库存链接表';

/*==============================================================*/
/* table: link_prep_to_productstock                             */
/*==============================================================*/
create table link_prep_to_productstock
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productstockid   int unsigned null,
  prepid           varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_prep_to_productstock comment '预盘单到库存之间的记录';

/*==============================================================*/
/* table: link_pricelist_to_salesport                           */
/*==============================================================*/
create table link_pricelist_to_salesport
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  pricelistid      int unsigned null,
  sportid          int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_pricelist_to_salesport comment '连接表 价格单 to 销售端口';

/*==============================================================*/
/* table: link_product_to_materislstatus                        */
/*==============================================================*/
create table link_product_to_materislstatus
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  materislstatusid varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_materislstatus comment '连接表 商品表与材质状态';

/*==============================================================*/
/* table: link_product_to_salesnature                           */
/*==============================================================*/
create table link_product_to_salesnature
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  salesnatureid    varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_salesnature comment '销售性质连接表';

/*==============================================================*/
/* table: link_product_to_closedway                             */
/*==============================================================*/
create table link_product_to_closedway
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  closedwayid      varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_closedway comment '连接表 商品 to 闭合方式';

/*==============================================================*/
/* table: link_product_to_decade                                */
/*==============================================================*/
create table link_product_to_decade
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  decadeid         int unsigned not null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_decade comment '商品表连接 年代季节';

/*==============================================================*/
/* table: link_product_to_dscrb                                 */
/*==============================================================*/
create table link_product_to_dscrb
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  dscrbid          varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_dscrb comment '商品表连接 商品描述';

/*==============================================================*/
/* table: link_product_to_marketprice                           */
/*==============================================================*/
create table link_product_to_marketprice
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  price            decimal(16,9),
  priceresource    char(1),
  historyflag      varchar(1) comment '0-当前记录 1-历史记录',
  rate             decimal(16,9),
  applyprice       decimal(16,9),
  applystatus      varchar(1) comment '0-已申请
            1-审批通过
            2-驳回',
  priceresourceid  varchar(36),
  applydate        datetime,
  replydate        datetime,
  priceid          int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_marketprice comment '商品表连接 市场价格';

/*==============================================================*/
/* table: link_product_to_material                              */
/*==============================================================*/
create table link_product_to_material
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  materialid       varchar(36),
  percentage       varchar(50),
  note             varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_material comment '连接表 商品 to 材质';

/*==============================================================*/
/* table: link_product_to_material2                             */
/*==============================================================*/
create table link_product_to_material2
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  materialid       varchar(36),
  percentage       varchar(50),
  note             varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_material2 comment '连接表 商品 to 材质2';

/*==============================================================*/
/* table: link_product_to_occasions                             */
/*==============================================================*/
create table link_product_to_occasions
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  occasionsid      varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_occasions comment '连接表 商品 to 场合风格';

/*==============================================================*/
/* table: link_product_to_origin                                */
/*==============================================================*/
create table link_product_to_origin
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  originid         varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_origin comment '商品表连接 产地';

/*==============================================================*/
/* table: link_product_to_outproductinnards                     */
/*==============================================================*/
create table link_product_to_outproductinnards
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  innardsid        varchar(36),
  sum              int,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_outproductinnards comment '连接表 商品 to 外部结构';

/*==============================================================*/
/* table: link_product_to_picture                               */
/*==============================================================*/
create table link_product_to_picture
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  pictureid        varchar(36),
  picturetype      varchar(500),
  sizetype         int,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_picture comment '图片表';

/*==============================================================*/
/* table: link_product_to_picture_ftp                           */
/*==============================================================*/
create table link_product_to_picture_ftp
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  picturename      varchar(500),
  picturepath      varchar(1000),
  picturesize      varchar(1) comment '1-750*750
            2-800*800
            3-1200*1200',
  uploadflag       varchar(1) comment '0-无需上传，1-需要上传',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_picture_ftp comment '连接表 商品 to ftp图片';

/*==============================================================*/
/* table: link_product_to_price                                 */
/*==============================================================*/
create table link_product_to_price
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  priceid          int unsigned null,
  currencyid       int unsigned null,
  price            decimal(10,2),
  productid        int unsigned null,
  jsfs             varchar(100),
  baseprice        decimal(10,2),
  exchangerate     decimal(16,9),
  rate             decimal(10,2),
  symbol           varchar(1),
  lockstatus       varchar(1) comment '0-未锁定 1-锁定',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_price comment '连接表 商品 商品销售价格(国内外零售价、批发价格)';

/*==============================================================*/
/* table: link_product_to_price2                                */
/*==============================================================*/
create table link_product_to_price2
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  priceid          int unsigned null,
  currencyid       int unsigned null,
  price            decimal(10,2),
  productid        int unsigned null,
  jsfs             varchar(100),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_price2 comment '连接表 商品 商品销售价格(国内外零售价、批发价格)';

/*==============================================================*/
/* table: link_product_to_price_history                         */
/*==============================================================*/
create table link_product_to_price_history
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  priceid          int unsigned null,
  currencyid       int unsigned null,
  price            decimal(10,2),
  productid        int unsigned null,
  actiontype       varchar(1) comment '0-添加 1-修改',
  baseprice        decimal(10,2),
  exchangerate     decimal(16,9),
  rate             decimal(10,2),
  symbol           varchar(1),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_price_history comment '连接表 商品 商品销售价格(国内外零售价、批发价格) 历史记录';

/*==============================================================*/
/* table: link_product_to_productinnards                        */
/*==============================================================*/
create table link_product_to_productinnards
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  innardsid        varchar(36),
  sum              int,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_productinnards comment '连接表 商品 to 内部结构';

/*==============================================================*/
/* table: link_product_to_productparts                          */
/*==============================================================*/
create table link_product_to_productparts
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  partsid          varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_productparts comment '连接表 商品 to 附带配件';

/*==============================================================*/
/* table: link_product_to_salesport                             */
/*==============================================================*/
create table link_product_to_salesport
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  sportid          int unsigned null,
  currencyid       int unsigned null,
  price            decimal(16,9),
  discount         decimal(16,9),
  sellspotname     varchar(100),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_salesport comment '销售端口商品连接表';

/*==============================================================*/
/* table: link_product_to_salesport_history                     */
/*==============================================================*/
create table link_product_to_salesport_history
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  sportid          int unsigned null,
  currencyid       int unsigned null,
  price            decimal(16,9),
  actiontype       char(10) comment '0-添加
            1-修改',
  discount         decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_salesport_history comment '销售端口商品连接 历史记录表';

/*==============================================================*/
/* table: link_product_to_size                                  */
/*==============================================================*/
create table link_product_to_size
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  sizeid           int unsigned null,
  jdcode           varchar(50),
  spotid           varchar(36) comment '空就是京东',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_size comment '连接表 商品 to 尺码';

/*==============================================================*/
/* table: link_product_to_washinginstructions                   */
/*==============================================================*/
create table link_product_to_washinginstructions
(
  id                    int unsigned not null auto_increment comment '主键id',
  sys_create_stuff      int unsigned not null,
  sys_create_date       datetime not null,
  sys_modify_stuff      int unsigned not null,
  sys_modify_date       datetime not null,
  sys_delete_stuff      int unsigned null,
  sys_delete_date       datetime,
  sys_delete_flag       tinyint  not null comment '0-未删除 1-已删除',

  productid             int unsigned null,
  washinginstructionsid int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_product_to_washinginstructions comment '连接表 商品 to 洗涤标准';

/*==============================================================*/
/* table: link_pzh_to_invoice                                   */
/*==============================================================*/
create table link_pzh_to_invoice
(
  id                int unsigned not null auto_increment comment '主键id',
  sys_create_stuff  int unsigned not null,
  sys_create_date   datetime not null,
  sys_modify_stuff  int unsigned not null,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int unsigned null,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  invoiceid         int unsigned null,
  pzhid             varchar(36),
  invoicecurrencyid varchar(36),
  invoicesum        decimal(16,9),
  pzhcurrencyid     varchar(36),
  pzhsum            decimal(16,9),
  exchangerate      decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_pzh_to_invoice comment '连接表 凭证表 to 普通发票';

/*==============================================================*/
/* table: link_pzh_to_invoicefee                                */
/*==============================================================*/
create table link_pzh_to_invoicefee
(
  id                int unsigned not null auto_increment comment '主键id',
  sys_create_stuff  int unsigned not null,
  sys_create_date   datetime not null,
  sys_modify_stuff  int unsigned not null,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int unsigned null,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  invoiceid         int unsigned null,
  pzhid             varchar(36),
  invoicecurrencyid varchar(36),
  invoicesum        decimal(16,9),
  pzhcurrencyid     varchar(36),
  pzhsum            decimal(16,9),
  exchangerate      decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_pzh_to_invoicefee comment '连接表 凭证表 to 运费发票';

/*==============================================================*/
/* table: link_pzh_to_order                                     */
/*==============================================================*/
create table link_pzh_to_order
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  orderid          int unsigned null,
  pzhid            int unsigned null,
  ordercurrencyid  varchar(36),
  ordersum         decimal(16,9),
  pzhcurrencyid    varchar(36),
  pzhsum           decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_pzh_to_order comment '连接表 凭证表 to 订单';

/*==============================================================*/
/* table: link_pzh_to_sales                                     */
/*==============================================================*/
create table link_pzh_to_sales
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  salesid          int unsigned null,
  pzhid            int unsigned null,
  salescurrencyid  varchar(36),
  salessum         decimal(16,9),
  pzhcurrencyid    varchar(36),
  pzhsum           decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_pzh_to_sales comment '连接表 凭证表 to 对账单（回款）';

/*==============================================================*/
/* table: link_pzh_to_sales_trans                               */
/*==============================================================*/
create table link_pzh_to_sales_trans
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  salesid          int unsigned null,
  pzhid            int unsigned null,
  salescurrencyid  varchar(36),
  salessum         decimal(16,9),
  pzhcurrencyid    varchar(36),
  pzhsum           decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_pzh_to_sales_trans comment '连接表 凭证表 to 对账单（转账）';

/*==============================================================*/
/* table: link_pzh_to_warehousing_fee                           */
/*==============================================================*/
create table link_pzh_to_warehousing_fee
(
  id                       int unsigned not null auto_increment comment '主键id',
  sys_create_stuff         int unsigned not null,
  sys_create_date          datetime not null,
  sys_modify_stuff         int unsigned not null,
  sys_modify_date          datetime not null,
  sys_delete_stuff         int unsigned null,
  sys_delete_date          datetime,
  sys_delete_flag          tinyint  not null comment '0-未删除 1-已删除',

  warehousingfeeid         int unsigned null,
  pzhid                    int unsigned null,
  warehousingfeecurrencyid int unsigned not null,
  warehousingfeesum        decimal(16,9),
  pzhcurrencyid            int unsigned null,
  pzhsum                   decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_pzh_to_warehousing_fee comment '连接表 凭证表 to 入库单费用';

/*==============================================================*/
/* table: link_return_to_productstock                           */
/*==============================================================*/
create table link_return_to_productstock
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productstockid   int unsigned null,
  dealprice        varchar(36),
  getpoints        int,
  memberid         int unsigned null,
  returnid         int unsigned null,
  salelinkid       int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_return_to_productstock comment '连接表 退货单 to 库存';

/*==============================================================*/
/* table: link_rule_to_operation                                */
/*==============================================================*/
create table link_rule_to_operation
(
  id               int unsigned not null auto_increment comment '主键id',
  ruleid           int unsigned null,
  operationid      int unsigned null,
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_rule_to_operation comment '职能功能连接表';

/*==============================================================*/
/* table: link_sales_to_productstock                            */
/*==============================================================*/
create table link_sales_to_productstock
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productstockid   int unsigned null,
  dealprice        decimal(10,2),
  pricelistid      int unsigned null,
  getpoints        decimal(10,2),
  memberid         int unsigned null,
  salesid          int unsigned null,
  returnflag       varchar(1) comment '0-正常 1-已退货',
  expresscomoany   varchar(1) comment '0-顺丰 1-德邦 2-京东',
  expressno        varchar(50),
  expressfee       decimal(16,9),
  expressstatus    varchar(1) comment '0-未发货 1-已发货 2-缺货',
  expressuser      varchar(36),
  isbj             varchar(1),
  currencyid       int unsigned null,
  sum              decimal(16,9),
  porc             varchar(1) comment '0-预付 1-到付',
  detailid         int unsigned null,
  bgj              decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_sales_to_productstock comment '销售到库存之间的记录';

/*==============================================================*/
/* table: link_salespot_to_childbrand                           */
/*==============================================================*/
create table link_salespot_to_childbrand
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  salespotid       int unsigned null,
  brandtypeid      int unsigned null,
  rate             decimal(19,6),
  isrounded        varchar(1) comment '0-不取整 1-取整',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_salespot_to_childbrand comment '销售端口 扣点连接表';

/*==============================================================*/
/* table: link_sellspot_to_brand                                */
/*==============================================================*/
create table link_sellspot_to_brand
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime   not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime   not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint    not null comment '0-未删除 1-已删除',

  sellspotid       int unsigned not null,
  brandid          int unsigned not null,
  level            varchar(1) not null comment 'a
            b
            c
            d',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_sellspot_to_brand comment '销售端口品牌连接表';

/*==============================================================*/
/* table: link_special_to_productstock                          */
/*==============================================================*/
create table link_special_to_productstock
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productstockid   int unsigned null,
  specialid        int unsigned not null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_special_to_productstock comment '其他出入库表到库存之间的记录';

/*==============================================================*/
/* table: link_spot_warehouse                                   */
/*==============================================================*/
create table link_spot_warehouse
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  spotid           int unsigned null,
  warehouseid      int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_spot_warehouse comment '仓库销售端口连接表';

/*==============================================================*/
/* table: link_supplier_to_brand                                */
/*==============================================================*/
create table link_supplier_to_brand
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime   not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime   not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint    not null comment '0-未删除 1-已删除',

  supplierid       int unsigned not null,
  brandid          int unsigned not null,
  level            varchar(1) not null comment 'a
            b
            c
            d',
  decade           varchar(36),
  markup           decimal(10,2),
  currencyid       int unsigned null,
  sum              decimal(10,2),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_supplier_to_brand comment '供货商品牌连接表';

/*==============================================================*/
/* table: link_user_to_labourcontactor                          */
/*==============================================================*/
create table link_user_to_labourcontactor
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  userid           int unsigned null,
  datefrom         datetime,
  datato           datetime,
  remark           text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_user_to_labourcontactor comment '员工合同记录';

/*==============================================================*/
/* table: link_user_to_price                                    */
/*==============================================================*/
create table link_user_to_price
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  userid           int unsigned null,
  priceid          int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_user_to_price comment '价格单用户连接表';

/*==============================================================*/
/* table: link_user_to_reportset                                */
/*==============================================================*/
create table link_user_to_reportset
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  userid           int unsigned null,
  reportid         int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_user_to_reportset comment '连接表用户与报表样式';

/*==============================================================*/
/* table: link_user_to_rule                                     */
/*==============================================================*/
-- create table link_user_to_rule
-- (
--   id               int unsigned not null auto_increment comment '主键id',
--   loginid          int unsigned null,
--   ruleid           int unsigned null,
--   sys_create_stuff int unsigned not null,
--   sys_create_date  datetime not null,
--   sys_modify_stuff int unsigned not null,
--   sys_modify_date  datetime not null,
--   sys_delete_stuff int unsigned null,
--   sys_delete_date  datetime,
--   sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',
--
--   primary key (id)
-- ) engine=innodb default charset=utf8mb4;
--
-- alter table link_user_to_rule comment '用户-组关联表';

/*==============================================================*/
/* table: link_user_to_salesport                                */
/*==============================================================*/
create table link_user_to_salesport
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  userid           int unsigned null,
  sportid          int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_user_to_salesport comment '销售端口用户连接表';

/*==============================================================*/
/* table: link_user_to_supplier                                 */
/*==============================================================*/
create table link_user_to_supplier
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  userid           int unsigned null,
  supplierid       int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_user_to_supplier comment '连接表用户与结算单位';

/*==============================================================*/
/* table: link_user_to_warehouse                                */
/*==============================================================*/
create table link_user_to_warehouse
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  userid           int unsigned null,
  warehouseid      int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table link_user_to_warehouse comment '仓库用户连接表';

/*==============================================================*/
/* table: sys_config                                            */
/*==============================================================*/
create table sys_config
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  code             varchar(100) comment 'ftp-ftp文件服务器ip地址，value值不以/结尾',
  value            varchar(100),
  comment          varchar(100),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table sys_config comment '系统参数值备注 code-文件服务器地址,fileipvalue - 文件名';

/*==============================================================*/
/* table: sys_selfcompany                                       */
/*==============================================================*/
create table sys_selfcompany
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  companyid    int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table sys_selfcompany comment '系统参数值 本公司id
';

/*==============================================================*/
/* table: tb_card                                               */
/*==============================================================*/
create table tb_card
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  member_id        int unsigned null,
  cardno           varchar(50),
  password         varchar(50),
  total            decimal(16,9),
  telno            varchar(20),
  status           varchar(1),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_card comment '消费卡';

/*==============================================================*/
/* table: tb_check                                              */
/*==============================================================*/
create table tb_check
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  checkno          varchar(10),
  warehouseid      int unsigned null,
  checker          varchar(36),
  check_flag       tinyint comment '0-生成预盘单
            1-生成实盘单
            2-生成差异单
            3-差异出入库',
  check_date       datetime,
  form_memo        varchar(500),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_check comment '盘点主表';

/*==============================================================*/
/* table: tb_check_detail                                       */
/*==============================================================*/
create table tb_check_detail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  checkid          int unsigned null,
  productid        int unsigned null,
  sizeid           int unsigned null,
  count            int,
  checktype        varchar(1) comment 's-实盘 y-预盘 c-差异',
  form_memo        varchar(500),
  excelasacode     varchar(50),
  excelsize        varchar(50),
  excelcount       varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_check_detail comment '盘点明细表';

/*==============================================================*/
/* table: tb_contactlist                                        */
/*==============================================================*/
create table tb_contactlist
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  corderid         int unsigned null,
  addname          varchar(36),
  creationdate     datetime,
  shipper          varchar(50),
  receivingparty   varchar(50),
  brand            varchar(50),
  boxnumber        int,
  number           int,
  weight           decimal(16,9),
  volume           decimal(16,9),
  chargeweight     decimal(16,9),
  sendout          varchar(50),
  destination      varchar(50),
  answerid         int unsigned null,
  answerdate       datetime,
  dhlwayblll       varchar(50),
  subbillno        varchar(500),
  freightprice     decimal(16,9),
  freighttotal     decimal(16,9),
  notificationtime datetime,
  deliverytime     datetime,
  arrivaltime      datetime,
  billno           varchar(50),
  singletype       varchar(1) comment '0-dhl 1-空运',
  remarks          text,
  flightno         varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_contactlist comment '发货联系单';

/*==============================================================*/
/* table: tb_declaration                                        */
/*==============================================================*/
create table tb_declaration
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  no               varchar(50),
  remark           varchar(1000),
  date             datetime,
  corderid         int unsigned null,
  pricerate        decimal(16,9),
  taxrate          decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_declaration comment '报关单主表';

/*==============================================================*/
/* table: tb_declaration_detail                                 */
/*==============================================================*/
create table tb_declaration_detail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  declarationid    int unsigned null,
  productname      varchar(100),
  currencyid       int unsigned null,
  price            decimal(16,9),
  count            int,
  rate             decimal(16,9),
  cprice           decimal(16,9),
  tax              decimal(16,9),
  cost             decimal(16,9),
  totaltax         decimal(16,9),
  totalcost        decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_declaration_detail comment '报关单明细表';

/*==============================================================*/
/* table: tb_department                                         */
/*==============================================================*/
create table tb_department
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(100),
  remark           varchar(1000),
  companyid    int unsigned not null comment '公司id',
  priceid          int unsigned null comment '此价格id可以是基础价格id，也可以是销售端口id',
  spotid           int unsigned null,
  up_dp_id         int unsigned default '0' comment '上级部门ID',
  checkingflag     varchar(1),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_department comment '部门表';

/*==============================================================*/
/* table: tb_discount_card                                      */
/*==============================================================*/
create table tb_discount_card
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  number           varchar(50),
  amount           decimal(16,9),
  is_used          varchar(1) comment '0-否 1-是',
  is_actived       varchar(1) comment '0-否 1-是',
  activedid        int unsigned null,
  usedid           int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_discount_card comment '优惠卷';

/*==============================================================*/
/* table: tb_distribute                                         */
/*==============================================================*/
create table tb_distribute
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  distributeno     varchar(50),
  owner            varchar(36),
  out_id           int unsigned null,
  in_id            int unsigned null,
  op_id            int unsigned null,
  op_date          datetime,
  remark           text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_distribute comment '分货单主表';

/*==============================================================*/
/* table: tb_distributecode                                     */
/*==============================================================*/
create table tb_distributecode
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  year             varchar(5),
  code             varchar(10),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_distributecode comment '分货单号表';

/*==============================================================*/
/* table: tb_express                                            */
/*==============================================================*/
create table tb_express
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  expresscompany   varchar(1) comment '0-顺丰 1-德邦 2-京东 3-其他 4-圆通',
  expressno        varchar(50),
  expressfee       decimal(16,9),
  remark           text,
  creator          int unsigned not null,
  departmentid     int unsigned null,
  type             varchar(1) comment '0-个人，1-部门，2-事业部，3-公司',
  f_person         varchar(50),
  f_telno          varchar(50),
  f_address        varchar(500),
  s_person         varchar(50),
  s_telno          varchar(50),
  s_address        varchar(500),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_express comment '单快递信息';

/*==============================================================*/
/* table: tb_fee                                                */
/*==============================================================*/
create table tb_fee
(
  id                 int unsigned not null auto_increment comment '主键id',
  sys_create_stuff   int unsigned not null,
  sys_create_date    datetime not null,
  sys_modify_stuff   int unsigned not null,
  sys_modify_date    datetime not null,
  sys_delete_stuff   int unsigned null,
  sys_delete_date    datetime,
  sys_delete_flag    tinyint  not null comment '0-未删除 1-已删除',

  applyno            varchar(50),
  applydate          datetime,
  applystaff         varchar(36),
  staff              varchar(36),
  departmemtid       int unsigned null,
  departmemtid2      int unsigned null,
  leadercheckstatus  varchar(1) comment '0-未审核 1-审核通过 2-驳回',
  leaderid           int unsigned null,
  leadercheckdate    datetime,
  financecheckstatus varchar(1) comment '0-未审核 1-审核通过 2-驳回',
  financeid          int unsigned null,
  financecheckdate   datetime,
  remark             varchar(500),
  pzhstatus          varchar(1),
  pzhid              int unsigned null,
  managercheckstatus varchar(1) comment '0-未审核 1-审核通过 2-驳回',
  managerid          int unsigned null,
  managercheckdate   datetime,
  type               varchar(1) comment '0-个人，1-部门，2-事业部，3-公司',
  reason             text,
  sheetid            int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_fee comment '费用申请';

/*==============================================================*/
/* table: tb_fee_detail                                         */
/*==============================================================*/
create table tb_fee_detail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  tbfeeid          int unsigned null,
  feeid            int unsigned null,
  sfcompanyid      int unsigned null,
  number           decimal(16,9),
  feeprice         decimal(16,9),
  rate             decimal(16,9),
  feecurrencyid    int unsigned null,
  feesum           decimal(16,9),
  remark           varchar(500),
  invoiceno        varchar(500),
  paydate          datetime,
  sorf             varchar(1),
  ischeck          varchar(1) comment '0-未对账，1-已对账',
  isreturn         varchar(1) comment '0-未入账，1-已入账',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_fee_detail comment '费用申请明细表';

/*==============================================================*/
/* table: tb_feecode                                            */
/*==============================================================*/
create table tb_feecode
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  year             varchar(5),
  code             varchar(10),
  month            varchar(5),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_feecode comment '费用申请号表';

/*==============================================================*/
/* table: tb_group                                              */
/*==============================================================*/
create table tb_group
(
  id               int unsigned not null auto_increment comment '主键id',
  group_name       varchar(50),
  group_memo       varchar(500),
  companyid    int unsigned null,
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_group comment '组信息';

/*==============================================================*/
/* table: tb_inve_actual                                        */
/*==============================================================*/
create table tb_inve_actual
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  form_num         varchar(30),
  checker          varchar(36),
  check_flag       tinyint,
  check_date       datetime,
  form_memo        varchar(500),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_inve_actual comment 'tb_inve_actual';

/*==============================================================*/
/* table: tb_inve_actual_dtl                                    */
/*==============================================================*/
create table tb_inve_actual_dtl
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  curr_quantity    bigint,
  real_quantity    bigint,
  profit_loss      bigint,
  product_id       int unsigned null,
  size_id          int unsigned null,
  inve_actual_id   int unsigned null,
  stock_id         int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_inve_actual_dtl comment 'tb_inve_actual_dtl';

/*==============================================================*/
/* table: tb_inve_prep                                          */
/*==============================================================*/
create table tb_inve_prep
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  form_num         varchar(30),
  checker          varchar(36),
  check_flag       tinyint,
  check_date       datetime,
  form_memo        varchar(500),
  inve_actual_id   int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_inve_prep comment 'tb_inve_prep';

/*==============================================================*/
/* table: tb_inve_prep_dtl                                      */
/*==============================================================*/
create table tb_inve_prep_dtl
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  product_id       int unsigned null,
  size_id          int unsigned null,
  curr_quantity    bigint,
  inve_prep_id     int unsigned null,
  stock_id         int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_inve_prep_dtl comment 'tb_inve_prep_dtl';

/*==============================================================*/
/* table: tb_kp                                                 */
/*==============================================================*/
create table tb_kp
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  invoiceno        varchar(50),
  kpdate           datetime,
  sum              decimal(16,9),
  sfcompanyid      int unsigned null,
  header           text,
  remark           text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_kp comment '开票信息';

/*==============================================================*/
/* table: tb_member                                             */
/*==============================================================*/
create table tb_member
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  code             varchar(20),
  form             varchar(1) comment 'f-female m-male',
  birth            date,
  phoneno          varchar(50),
  email            varchar(50),
  address          varchar(50),
  zipcode          varchar(10),
  qq               varchar(50),
  wechat           varchar(50),
  microblog        varchar(50),
  totalscore       bigint,
  score            bigint,
  membercard       varchar(50),
  memberlevelid    int unsigned null,
  membertype       varchar(1) comment '0-个人会员 1-公司会员',
  membercardid     int unsigned null,
  creatorid        int unsigned null,
  sourceid         int unsigned null,
  idno             varchar(50),
  taxno            varchar(50),
  contactor        varchar(50),
  asawebno         varchar(50),
  openid           varchar(50),
  password         varchar(10),
  invitesum        bigint,
  invitetotal      bigint,
  invoteuser       varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_member comment '会员表';

/*==============================================================*/
/* table: tb_member_address                                     */
/*==============================================================*/
create table tb_member_address
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  member_id        int unsigned null,
  name             varchar(50),
  idno             varchar(50),
  tel              varchar(50),
  zipcode          varchar(10),
  address          varchar(1000),
  province         varchar(20),
  city             varchar(20),
  is_default       varchar(1) comment '0-否 1-是',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_member_address comment '会员地址信息';

/*==============================================================*/
/* table: tb_member_bank                                        */
/*==============================================================*/
create table tb_member_bank
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  member_id        int unsigned null,
  account_name     varchar(1000),
  account          varchar(1000),
  currency_id      int unsigned null,
  bank_name        varchar(1000),
  bank_address     varchar(1000),
  is_default       varchar(1) comment '0-否 1-是',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_member_bank comment '会员银行';

/*==============================================================*/
/* table: tb_member_card                                        */
/*==============================================================*/
create table tb_member_card
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  number           varchar(50),
  is_used          varchar(1) comment '0-否 1-是',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_member_card comment '会员卡号';

/*==============================================================*/
/* table: tb_member_card_history                                */
/*==============================================================*/
create table tb_member_card_history
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  member_id        int unsigned null,
  type             varchar(1) comment '0-充值 1-消费 ',
  sum              decimal(19,6),
  opdate           datetime,
  totalsum         decimal(19,6),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_member_card_history comment '储值卡操作记录';

/*==============================================================*/
/* table: tb_member_contactor                                   */
/*==============================================================*/
create table tb_member_contactor
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  member_id        int unsigned null,
  name             char(10),
  form             varchar(1) comment 'f-female
            m-male',
  birth            date,
  tel              varchar(50),
  phoneno          varchar(50),
  email            varchar(50),
  address          varchar(50),
  zipcode          varchar(10),
  qq               varchar(50),
  wechat           varchar(50),
  microblog        varchar(50),
  remark           varchar(50),
  is_default       varchar(1) comment '0-否 1-是',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_member_contactor comment '会员（公司）联系人';

/*==============================================================*/
/* table: tb_member_header                                      */
/*==============================================================*/
create table tb_member_header
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  member_id        int unsigned null,
  chinese_header   varchar(1000),
  english_header   varchar(1000),
  is_default       varchar(1) comment '0-否 1-是',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_member_header comment '会员发票抬头';

/*==============================================================*/
/* table: tb_member_preference                                  */
/*==============================================================*/
create table tb_member_preference
(
  id                 int unsigned not null auto_increment comment '主键id',
  sys_create_stuff   int unsigned not null,
  sys_create_date    datetime not null,
  sys_modify_stuff   int unsigned not null,
  sys_modify_date    datetime not null,
  sys_delete_stuff   int unsigned null,
  sys_delete_date    datetime,
  sys_delete_flag    tinyint  not null comment '0-未删除 1-已删除',

  member_id          int unsigned null,
  brand_id           int unsigned null,
  brandgroup_id      int unsigned null,
  childbrandgroup_id int unsigned null,
  sizetop_id         int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_member_preference comment '会员偏好';

/*==============================================================*/
/* table: tb_member_preference_size                             */
/*==============================================================*/
create table tb_member_preference_size
(
  id                  int unsigned not null auto_increment comment '主键id',
  sys_create_stuff    int unsigned not null,
  sys_create_date     datetime not null,
  sys_modify_stuff    int unsigned not null,
  sys_modify_date     datetime not null,
  sys_delete_stuff    int unsigned null,
  sys_delete_date     datetime,
  sys_delete_flag     tinyint  not null comment '0-未删除 1-已删除',

  memberpreference_id int unsigned null,
  sizecontent_id      int unsigned null,
  sizetop_id          int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_member_preference_size comment '会员偏好尺码表';

/*==============================================================*/
/* table: tb_member_preordination                               */
/*==============================================================*/
create table tb_member_preordination
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  orderdate        datetime,
  memberid         int unsigned null,
  productid        int unsigned null,
  sizeid           int unsigned null,
  remark           text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_member_preordination comment '预定信息';

/*==============================================================*/
/* table: tb_picture                                            */
/*==============================================================*/
create table tb_picture
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  picturename      varchar(20),
  picturestream    longblob,
  picturetype      char(10),
  picturegroup     varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_picture comment '图片表';

/*==============================================================*/
/* table: tb_pre_requisition                                    */
/*==============================================================*/
create table tb_pre_requisition
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productstock_id  int unsigned null,
  stockid          int unsigned null,
  tostockid        int unsigned null,
  opid             int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_pre_requisition comment '预调拨单明细';

/*==============================================================*/
/* table: tb_product                                            */
/*==============================================================*/
create table tb_product
(
  id                   int unsigned not null auto_increment comment '主键id',
  sys_create_stuff     int unsigned not null,
  sys_create_date      datetime not null,
  sys_modify_stuff     int unsigned not null,
  sys_modify_date      datetime not null,
  sys_delete_stuff     int unsigned null,
  sys_delete_date      datetime,
  sys_delete_flag      tinyint  not null comment '0-未删除 1-已删除',

  asacode              varchar(100),
  productname          varchar(50),
  wordcode_1           varchar(50),
  wordcode_2           varchar(50),
  wordcode_3           varchar(50),
  wordcode_4           varchar(50),
  wordprice            decimal(16,9),
  wordpricecurrencyid  int unsigned null,
  gender               varchar(10) comment '0-女式 1-男士 2-中性',
  brand                varchar(36),
  brandtype            varchar(36),
  childbrand           varchar(36),
  brandcolor           varchar(36),
  brandcolor2          varchar(36),
  picture              varchar(36),
  closeway             varchar(36),
  decade               varchar(36),
  productsize          varchar(36),
  origin               varchar(36),
  security             varchar(36),
  execution            varchar(36),
  material             varchar(36),
  productparst         varchar(36),
  occasion             varchar(36),
  producttemplate      varchar(36),
  materialstatus       varchar(36),
  spring               tinyint,
  summer               tinyint,
  autumn               tinyint,
  winter               tinyint,
  oldasacode           varchar(50),
  officialwebsite      varchar(500),
  oldbarcode           varchar(500),
  laststoragedate      datetime,
  aliases_1            varchar(50),
  aliases_2            varchar(50),
  aliases              varchar(50),
  series_id            int unsigned null,
  series2_id           int unsigned null,
  ulnarinch            varchar(50),
  vat                  decimal(16,9),
  tariff               decimal(16,9),
  basecurrency         varchar(36),
  baseprice            decimal(16,9),
  entrymonth           varchar(5),
  factoryprice         decimal(16,9),
  factorypricecurrency varchar(36),
  realprice            decimal(16,9),
  retailpricecurrency  varchar(36),
  dutyparagraph        varchar(50),
  orderprice           decimal(16,9),
  orderpricecurrency   varchar(36),
  retailprice          decimal(16,9) comment '可以填写的成本，入库时同步修改',
  groupid              int unsigned null comment '同款不同色',
  iskj                 varchar(1) comment '0-否 1-是',
  bxzs                 varchar(1) comment '0-修身1-适中2-宽松',
  hbzs                 varchar(1) comment '0-薄1-适中2-厚',
  rrzs                 varchar(1) comment '0-柔软1-适中2-偏硬',
  tlzs                 varchar(1) comment '0-无弹1-适中2-弹力',
  salemethodid         varchar(36),
  nationalprice        decimal(16,9),
  taxrate              decimal(16,9),
  isjh                 varchar(1) comment '0-否1-是',
  inlenth              varchar(50),
  jdname               varchar(200),
  winterproofing       varchar(36),
  isfj                 varchar(1) comment '0-否 1-法检',
  discount             decimal(10,2),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_product comment '商品表';

/*==============================================================*/
/* table: tb_product_price                                      */
/*==============================================================*/
create table tb_product_price
(
  id                   int unsigned not null auto_increment comment '主键id',
  sys_create_stuff     int unsigned not null,
  sys_create_date      datetime not null,
  sys_modify_stuff     int unsigned not null,
  sys_modify_date      datetime not null,
  sys_delete_stuff     int unsigned null,
  sys_delete_date      datetime,
  sys_delete_flag      tinyint  not null comment '0-未删除 1-已删除',

  productid            int unsigned null,
  decadeid             int unsigned null,
  retailpricecurrency  varchar(36),
  realprice            decimal(16,9),
  factorypricecurrency varchar(36),
  factoryprice         decimal(16,9),
  basecurrency         varchar(36),
  baseprice            decimal(16,9),
  nationalprice        decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_product_price comment '成交价，参考价，基准零售价，国内零售价 历史记录';

/*==============================================================*/
/* table: tb_productstock                                       */
/*==============================================================*/
create table tb_productstock
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  sizeid           int unsigned null,
  storagetime      datetime,
  storagestaff     varchar(36),
  stockid          int unsigned null,
  productno        bigint,
  selltime         datetime,
  sellprice        decimal(16,9),
  cost             decimal(16,9),
  selltype         int comment '0-待销
            1-已售出
            2-预售
            3-在途
            4-调拨锁定',
  dealprice        decimal(16,9),
  qualitystatus    int comment '0-合格品
            1-残次品
            2-库存差异',
  sellstaff        varchar(36),
  is_print         varchar(1) comment '0-未打印
            1-条形码打印
            2-二维码打印',
  corderid         int unsigned null,
  currencyid       int unsigned null,
  remark           varchar(500),
  cpdate           datetime,
  cp_op            varchar(36),
  intime           datetime,
  property         varchar(1) comment '0-自采 1-代销',
  kpflag           varchar(1) comment '0-未开票 1-已开票',
  decadeid         int unsigned not null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_productstock comment '库存';

/*==============================================================*/
/* table: tb_productstock_snapshot                              */
/*==============================================================*/
create table tb_productstock_snapshot
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  snapdate         datetime,
  productstockid   int unsigned null,
  productid        int unsigned null,
  sizeid           int unsigned null,
  stockid          int unsigned null,
  productno        bigint,
  selltime         datetime,
  sellprice        decimal(16,9),
  cost             decimal(16,9),
  selltype         int comment '0-待销
            1-已售出
            2-预定
            3-在途
            4-调拨锁定',
  dealprice        decimal(16,9),
  qualitystatus    int comment '0-合格品
            1-残次品
            2-库存差异',
  sellstaff        varchar(36),
  corderid         int unsigned null,
  currencyid       int unsigned null,
  remark           varchar(500),
  cpdate           datetime,
  intime           datetime,
  property         varchar(1) comment '0-自采 1-代销',
  kpflag           varchar(1) comment '0-未开票 1-已开票',
  decadeid         int unsigned not null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_productstock_snapshot comment '库存快照表';

/*==============================================================*/
/* table: tb_requisition                                        */
/*==============================================================*/
create table tb_requisition
(
  id                int unsigned not null auto_increment comment '主键id',
  sys_create_stuff  int unsigned not null,
  sys_create_date   datetime    not null,
  sys_modify_stuff  int unsigned not null,
  sys_modify_date   datetime    not null,
  sys_delete_stuff  int unsigned null,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint     not null comment '0-未删除 1-已删除',

  feecurrencyid     int unsigned null,
  fee               decimal(16,9),
  apply_staff       varchar(36),
  apply_date        datetime    not null,
  turnin_staff      varchar(36),
  turnin_date       datetime,
  turnout_staff     varchar(36) not null,
  turnout_date      datetime,
  out_id            int unsigned not null,
  in_id             int unsigned not null,
  remark            varchar(500),
  allocationconfirm varchar(1) comment 'null-主调拨单才会是这个
            4-出库未完成
            0-入库未完成
            1-出库拒绝
            2-已完成
            3-入库拒绝
            ',
  requisitionno     varchar(50),
  salesid           int unsigned null,
  ism               varchar(1) comment '1-主单，0或者空-子单或单对单库调拨单',
  qualitystatus     varchar(1) comment '0-合格品 1-残品',
  isamortized       varchar(1),
  expresscomoany    varchar(1) comment '0-顺丰 1-德邦 2-京东 3-其他',
  address           char(1),
  markno            varchar(50),
  returnflag        varchar(1) comment '0-普通调拨单，1-反向调拨单',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_requisition comment '调拨单主表';

/*==============================================================*/
/* table: tb_requisition_detail                                 */
/*==============================================================*/
create table tb_requisition_detail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  requisition_id   int unsigned not null,
  stock_id         int unsigned null,
  remark           varchar(500),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_requisition_detail comment '调拨单明细';

/*==============================================================*/
/* table: tb_requisition_detail_group                           */
/*==============================================================*/
create table tb_requisition_detail_group
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  requisition_id   int unsigned not null,
  product_id       int unsigned null,
  size_id          int unsigned null,
  count            int,
  remark           varchar(100),
  ctnno            varchar(50),
  outcount         int,
  incount          int,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_requisition_detail_group comment '调拨单明细(数量)';

/*==============================================================*/
/* table: tb_requisition_express                                */
/*==============================================================*/
create table tb_requisition_express
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  requisitionid    int unsigned null,
  expresscompany   varchar(1) comment '0-顺丰 1-德邦 2-京东 3-其他 4-圆通',
  expressno        varchar(50),
  expressfee       decimal(16,9),
  remark           text,
  creator          varchar(36),
  departmentid     int unsigned null,
  type             varchar(1) comment '0-个人，1-部门，2-事业部，3-公司',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_requisition_express comment '调拨单快递信息';

/*==============================================================*/
/* table: tb_requisitioncode                                    */
/*==============================================================*/
create table tb_requisitioncode
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  year             varchar(5),
  code             varchar(10),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_requisitioncode comment '调拨单号表';

/*==============================================================*/
/* table: tb_rule                                               */
/*==============================================================*/
create table tb_rule
(
  id               int unsigned not null auto_increment comment '主键id',
  rule_name        varchar(50),
  rule_memo        varchar(500),
  companyid    int unsigned null,
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_rule comment '用于存放系统的全部信息';

/*==============================================================*/
/* table: tb_savings_card                                       */
/*==============================================================*/
create table tb_savings_card
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  number           varchar(50),
  password         varchar(10),
  amount           decimal(16,9),
  price            decimal(16,9),
  is_used          varchar(1) comment '0-否 1-是',
  is_actived       varchar(1) comment '0-否 1-是',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_savings_card comment '储值卡';

/*==============================================================*/
/* table: tb_special_requisition                                */
/*==============================================================*/
create table tb_special_requisition
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  no               varchar(10),
  stuffid          int unsigned null,
  check_flag       tinyint comment '0-未生效
            1-已生效
            ',
  check_date       datetime,
  remark           varchar(1000),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_special_requisition comment '其他出入库主表';

/*==============================================================*/
/* table: tb_special_requisition_detail                         */
/*==============================================================*/
create table tb_special_requisition_detail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  specialid        int unsigned not null,
  productid        int unsigned null,
  sizeid           int unsigned null,
  count            int,
  warehouseid      int unsigned null,
  type             varchar(1) comment '0-出库 1-入库',
  remark           varchar(500),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_special_requisition_detail comment '其他出入库明细表';

/*==============================================================*/
/* table: tb_stock                                              */
/*==============================================================*/
create table tb_stock
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  declarationid    int unsigned null,
  productname      varchar(100),
  currencyid       int unsigned null,
  price            decimal(16,9),
  count            int,
  rate             decimal(16,9),
  cprice           decimal(16,9),
  tax              decimal(16,9),
  cost             decimal(16,9),
  kpcount          int,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_stock comment '账面库存表';

/*==============================================================*/
/* table: tb_supplier                                           */
/*==============================================================*/
create table tb_supplier
(
  id                int unsigned not null auto_increment comment '主键id',
  sys_create_stuff  int unsigned not null,
  sys_create_date   datetime not null,
  sys_modify_stuff  int unsigned not null,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int unsigned null,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  suppliername      varchar(50),
  englishname       varchar(50),
  address           varchar(100),
  phone             bigint,
  zipcode           varchar(500),
  email             varchar(500),
  quotedprice       varchar(20),
  developdate       datetime,
  nationality       varchar(36),
  nature            varchar(100),
  supplierlevel     varchar(36),
  companyzipcode    varchar(100),
  maincontacts      varchar(50),
  microblog         varchar(100),
  countrycity       varchar(50),
  suppliercode      varchar(50),
  fax               varchar(50),
  calculation       varchar(50),
  legal             varchar(50),
  heading           varchar(50),
  businesslicense   varchar(50),
  headingnumber     varchar(50),
  registered        datetime,
  registeredcapital decimal(15),
  endtime           datetime,
  type              varchar(1) comment '0-供货商 1-报关行 2-供应商 3-承运人 4-客户 5-品牌商',
  contractfrom      datetime,
  contractto        datetime,
  contractrate      decimal(16,9),
  contractremind    int,
  settlecompanyid   int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_supplier comment '任何表都应该包含的列';

/*==============================================================*/
/* table: tb_supplier_orderdate                                 */
/*==============================================================*/
create table tb_supplier_orderdate
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  supplierid       int unsigned null,
  brandid          int unsigned null,
  decade           varchar(36),
  type             varchar(1) comment '0-pre ,1-main ,2-fashion show',
  showdate         datetime,
  closedate        datetime,
  remark           text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_supplier_orderdate comment '订货日期';

/*==============================================================*/
/* table: tb_user                                               */
/*==============================================================*/
create table tb_user
(
  id                 int unsigned not null auto_increment comment '主键id',
  login_name         varchar(50),
  password           varchar(50),
  real_name          varchar(50),
  departmentid       int unsigned null,
  companyid          int unsigned null comment '公司id',
  groupid            int unsigned null,
  storeid            int unsigned null,
  sys_create_stuff   int unsigned not null,
  sys_create_date    datetime not null,
  sys_modify_stuff   int unsigned not null,
  sys_modify_date    datetime not null,
  sys_delete_stuff   int unsigned null,
  sys_delete_date    datetime,
  sys_delete_flag    tinyint  not null default '0' comment '0-未删除 1-已删除',
  sex                varchar(50),
  section            varchar(50),
  date               datetime,
  phone              varchar(50),
  mobilephone        varchar(50),
  e_mail             varchar(100),
  email_password     varchar(50) comment '用于自动发送邮件',
  comment            varchar(100),
  countryid          int unsigned null,
  departmentid2      int unsigned null,
  address            text,
  contactor          text,
  leave_date         datetime,
  defaultprice       varchar(36),
  defaultwarehouse   varchar(36),
  defaultsellspot    varchar(36),
  idno               varchar(20),
  education          varchar(50),
  collegemajor       varchar(50),
  degree             varchar(50),
  graduatedcollege   varchar(50),
  stateofmarriage    varchar(50),
  censusregistration varchar(50),
  status             varchar(1) comment '0-在职，1-离职，2-其他',
  reason             text,
  contactorphone     varchar(50),
  costdisplay        varchar(1),
  wechat             varchar(50),
  openid             varchar(50),
  primary key (id),
  unique `tb_user_login_name` (`login_name`)
) engine=innodb default charset=utf8mb4;

alter table tb_user comment '用户表';

/*==============================================================*/
/* table: tb_verificationcode                                   */
/*==============================================================*/
create table tb_verificationcode
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  verificationcode varchar(50),
  source           varchar(100) comment '注册，绑定，支付',
  sourceid         varchar(36) comment '前端发起动态密码验证，生成一次性guid，验证使用',
  phoneno          varchar(20) comment '手机号',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_verificationcode comment '动态密码验证表';

/*==============================================================*/
/* table: tb_warehousing                                        */
/*==============================================================*/
create table tb_warehousing
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  arrivalid        int unsigned null,
  entrydate        datetime not null,
  warehouse_id     int unsigned not null,
  season           varchar(36),
  seasontype       varchar(1) comment '0-pre ,1-main ,2-fashion show',
  op_id            int unsigned not null,
  remark           varchar(500),
  ischecked        varchar(2),
  isamortized      varchar(2),
  entrycode        varchar(100),
  exchangerate     decimal(16,9),
  corderid         int unsigned null,
  supplierid       int unsigned not null,
  property         varchar(1) comment '0-自采 1-代销',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_warehousing comment '入库单主表';

/*==============================================================*/
/* table: tb_warehousing_detail                                 */
/*==============================================================*/
create table tb_warehousing_detail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime      not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime      not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint       not null comment '0-未删除 1-已删除',

  detailid         int unsigned null,
  warehousing_id   int unsigned not null,
  product_id       int unsigned not null,
  size_id          int unsigned not null,
  amount           int           not null,
  cost             decimal(16,9) not null,
  remark           varchar(500),
  cjj              decimal(16,9),
  yj               decimal(16,9),
  sellprice        decimal(16,9),
  finalcost        decimal(16,9),
  currencyid       int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_warehousing_detail comment '入库单明细表';

/*==============================================================*/
/* table: tb_warehousing_fee                                    */
/*==============================================================*/
create table tb_warehousing_fee
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  warehousingid    int unsigned null,
  feeid            int unsigned null,
  currencyid       int unsigned null,
  feeprice         decimal(10,2),
  payment          varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table tb_warehousing_fee comment '入库表-费用说明';

/*==============================================================*/
/* table: trans_brand_code                                      */
/*==============================================================*/
create table trans_brand_code
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  brandid          int unsigned null,
  code             varchar(50),
  transcode        varchar(50),
  unit             varchar(10),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table trans_brand_code comment '品牌对照表';

/*==============================================================*/
/* table: trans_color_code                                      */
/*==============================================================*/
create table trans_color_code
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  colorid          int unsigned null,
  code             varchar(50),
  transcode        varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table trans_color_code comment '颜色对照表';

/*==============================================================*/
/* table: trans_group_code                                      */
/*==============================================================*/
create table trans_group_code
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  groupid          int unsigned null,
  code             varchar(50),
  transcode        varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table trans_group_code comment '品类对照表';

/*==============================================================*/
/* table: trans_size_code                                       */
/*==============================================================*/
create table trans_size_code
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  sizeid           int unsigned null,
  typeid           int unsigned null,
  code             varchar(50),
  transcode        varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table trans_size_code comment '尺码对照表';

/*==============================================================*/
/* table: xs_afterservice                                       */
/*==============================================================*/
create table xs_afterservice
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  memberid         int unsigned null,
  salesstaff       varchar(36),
  salesdate        datetime,
  sellspotid       int unsigned null,
  saleno           varchar(50),
  cusname          varchar(50),
  custel           varchar(50),
  status           varchar(1) comment '0-接收 1-处理中 2-完结',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_afterservice comment '售后单';

/*==============================================================*/
/* table: xs_afterservice_detail                                */
/*==============================================================*/
create table xs_afterservice_detail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  afterserviceid   int unsigned null,
  detailid         int unsigned null,
  count            int,
  describtion      varchar(500),
  dealtype         varchar(1) comment '0-修理1-保养2-调换3-退货',
  fixdate          datetime,
  fixstuff         varchar(36),
  backdate         datetime,
  backstuff        varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_afterservice_detail comment '售后单明细';

/*==============================================================*/
/* table: xs_pre_sales                                          */
/*==============================================================*/
create table xs_pre_sales
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  memberid         int unsigned null,
  pricelistid      int unsigned null,
  salesstaff       varchar(36),
  salesdate        datetime,
  sellspotid       int unsigned null,
  companyid        int unsigned null,
  saleno           varchar(50),
  salestype        varchar(1) comment '0-零售
            1-批发',
  warehouseid      int unsigned null,
  status           varchar(1) comment '0-预售 1-已转销售 2-作废',
  islocal          varchar(1) comment '0-跨境电商 1-线下店铺 2-爱莎商城 3-代销',
  downpayment      decimal(16,9),
  remainingfund    decimal(16,9),
  actualprice      decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_pre_sales comment '预售主表';

/*==============================================================*/
/* table: xs_pre_salescode                                      */
/*==============================================================*/
create table xs_pre_salescode
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  year             varchar(5),
  code             varchar(10),
  month            varchar(5),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_pre_salescode comment '预售单号表';

/*==============================================================*/
/* table: xs_pre_salesdetails                                   */
/*==============================================================*/
create table xs_pre_salesdetails
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  sales_id         int unsigned not null,
  product_id       int unsigned null,
  size_id          int unsigned null,
  count            int,
  dealprice        decimal(16,9),
  price            decimal(16,9),
  rate             decimal(16,9),
  remark           varchar(500),
  totalsellprice   decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_pre_salesdetails comment '预售单明细(数量)';

/*==============================================================*/
/* table: xs_pricelist                                          */
/*==============================================================*/
create table xs_pricelist
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  begindate        datetime,
  enddate          datetime,
  name             varchar(20),
  salesport        varchar(36),
  remark           varchar(500),
  priceid          int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_pricelist comment '价格单基础资料 主表
';

/*==============================================================*/
/* table: xs_pricelistdetails                                   */
/*==============================================================*/
create table xs_pricelistdetails
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  productprice     decimal(10,2),
  pricelistid      int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_pricelistdetails comment '价格单基础资料 明细从表';

/*==============================================================*/
/* table: xs_return                                             */
/*==============================================================*/
create table xs_return
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  actualprice      decimal(16,9),
  sellspotid       int unsigned null,
  memberid         int unsigned null,
  returnstaff      varchar(36),
  returndate       datetime,
  returnno         varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_return comment '退货单';

/*==============================================================*/
/* table: xs_returncode                                         */
/*==============================================================*/
create table xs_returncode
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  year             varchar(5),
  code             varchar(10),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_returncode comment '退货单号表';

/*==============================================================*/
/* table: xs_sales                                              */
/*==============================================================*/
create table xs_sales
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  actualprice      decimal(16,9),
  memberid         int unsigned null,
  pricelistid      int unsigned null,
  salesstaff       varchar(36),
  salesdate        datetime,
  salesmode        varchar(2) comment '0-现金
            1-刷卡
            2-支票
            3-储值卡
            4-转账
            5-协议结算
            6-支付宝
            7-微信支付',
  sellspotid       int unsigned null,
  companyid        int unsigned null,
  saleno           varchar(50),
  salestype        varchar(1) comment '0-未转 1-已转',
  warehouseid      int unsigned null,
  expressno        varchar(50),
  expresspaidtype  varchar(1) comment '0-预付 1-到付 2-第三方付费 3-储值卡 4-转账 5-协议结算',
  expressfee       decimal(16,9),
  expressfeepayid  varchar(36),
  status           varchar(1) comment '0-预售 1-已售 2-作废',
  expresscomoany   varchar(1) comment '0-顺丰 1-德邦 2-京东 3-其他 4-圆通',
  address          varchar(36),
  islocal          varchar(1) comment '0-跨境电商 1-线下店铺 2-爱莎商城 3-分公司间调拨销售 4-代销 ',
  externalno       varchar(50),
  ischeck          varchar(1),
  sheetid          int unsigned null,
  type             varchar(1) comment '0-普通 1-扫码 ',
  pickingtype      varchar(1) comment '0-自提 1-快递 2-门店直发',
  sender           varchar(36),
  supplierid       int unsigned null,
  isjf             varchar(1) comment '0-未使用积分抵扣，1-使用积分抵扣',
  dksum            decimal(16,9),
  usedscore        bigint,
  exhibitionid     int unsigned null,
  isused           varchar(1),
  invitesum        bigint,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_sales comment '销售主表';

/*==============================================================*/
/* table: xs_sales_card                                         */
/*==============================================================*/
create table xs_sales_card
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  actualprice      decimal(16,9),
  memberid         int unsigned null,
  salesstaff       varchar(36),
  salesdate        datetime,
  sellspotid       int unsigned null,
  companyid        int unsigned null,
  saleno           varchar(50),
  ischeck          varchar(1),
  sheetid          int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_sales_card comment '销售储值卡主表';

/*==============================================================*/
/* table: xs_sales_cardetails                                   */
/*==============================================================*/
create table xs_sales_cardetails
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  sales_id         int unsigned not null,
  dealprice        decimal(16,9),
  price            decimal(16,9),
  rate             decimal(16,9),
  remark           varchar(500),
  totalsellprice   decimal(16,9),
  stockid          int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_sales_cardetails comment '储值卡销售单明细';

/*==============================================================*/
/* table: xs_sales_pay                                          */
/*==============================================================*/
create table xs_sales_pay
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  sales_id         int unsigned not null,
  paidtype         varchar(5) comment '0-现金
            1-刷卡/银联
            2-支票
            3-储值卡
            4-转账
            5-协议结算
            6-支付宝
            7-微信支付
            8-会员余额支付
            9-刷卡手续费
            10-快递费
            11-返点
            12-积分抵扣
            13-代金券
            14-刷卡/visa
            15.joypay',
  ischeck          varchar(1),
  isreturn         varchar(1),
  sheetid          int unsigned null,
  sum              decimal(16,9),
  remark           varchar(500),
  currencyid       int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_sales_pay comment '销售单付款明细';

/*==============================================================*/
/* table: xs_salescode                                          */
/*==============================================================*/
create table xs_salescode
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  year             varchar(5),
  code             varchar(10),
  month            varchar(5),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_salescode comment '销售单号表';

/*==============================================================*/
/* table: xs_salesdetails                                       */
/*==============================================================*/
create table xs_salesdetails
(
  id                int unsigned not null auto_increment comment '主键id',
  sys_create_stuff  int unsigned not null,
  sys_create_date   datetime not null,
  sys_modify_stuff  int unsigned not null,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int unsigned null,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  sales_id          int unsigned not null,
  product_id        int unsigned null,
  size_id           int unsigned null,
  count             int,
  dealprice         decimal(16,9),
  price             decimal(16,9),
  rate              decimal(16,9),
  remark            varchar(500),
  returnid          int unsigned null,
  totalsellprice    decimal(16,9),
  saleno            varchar(50),
  stockid           int unsigned null,
  priceremark       varchar(500),
  exchangerate      decimal(16,9),
  totalsellpricebwb decimal(16,9),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table xs_salesdetails comment '销售单明细(数量)';

/*==============================================================*/
/* table: zl_ac_cashflow_statement                              */
/*==============================================================*/
create table zl_ac_cashflow_statement
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  subject_name     varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  subject_type     int comment '0-正，1-负',
  orderno          int,
  parentid         int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_ac_cashflow_statement comment '现金流量表格式';

/*==============================================================*/
/* table: zl_ac_cashflow_subject                                */
/*==============================================================*/
create table zl_ac_cashflow_subject
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  sorf             varchar(1) comment '0-正，1-负',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_ac_cashflow_subject comment '现金流量项目';

/*==============================================================*/
/* table: zl_ac_km                                              */
/*==============================================================*/
create table zl_ac_km
(
  id               int unsigned not null auto_increment comment '主键id',
  code             char(1)    not null,
  chinese_name     char(1)    not null,
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  km_type_id       int unsigned not null,
  up_km_id         int unsigned null,
  is_havexj        varchar(1) not null comment '0-没有,1-有',
  jord             varchar(1) not null comment 'j-借方,d-贷方',
  companyid    int unsigned not null,
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime   not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime   not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint    not null comment '0-未删除 1-已删除',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_ac_km comment '科目表';

/*==============================================================*/
/* table: zl_ac_km_type                                         */
/*==============================================================*/
create table zl_ac_km_type
(
  id               int unsigned not null auto_increment comment '主键id',
  code             varchar(1) not null,
  chinese_memo     char(1)    not null,
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime   not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime   not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint    not null comment '0-未删除 1-已删除',

  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_ac_km_type comment '科目类别';

/*==============================================================*/
/* table: zl_ac_pzh_rule                                        */
/*==============================================================*/
create table zl_ac_pzh_rule
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  rulecode         varchar(50),
  kmid             int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_ac_pzh_rule comment '凭证科目规则';

/*==============================================================*/
/* table: zl_ac_pzh_type                                        */
/*==============================================================*/
create table zl_ac_pzh_type
(
  id               int unsigned not null auto_increment comment '主键id',
  ztid             int unsigned not null,
  code             varchar(4) not null,
  chinese_memo     char(1)    not null,
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime   not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime   not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint    not null comment '0-未删除 1-已删除',

  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_ac_pzh_type comment '现金、银行、转账';

/*==============================================================*/
/* table: zl_ac_ztb                                             */
/*==============================================================*/
create table zl_ac_ztb
(
  id               int unsigned not null auto_increment comment '主键id',
  zt_name          varchar(100) not null,
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  km_code_rule     varchar(50)  not null,
  star_date        datetime     not null,
  end_date         datetime comment '只有结束了才有值',
  is_end           varchar(1)   not null comment '0-未结束,1-结束',
  is_default       varchar(1)   not null comment '0-不是,1-是',
  pwd              varchar(50),
  companyid    int unsigned not null,
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime     not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime     not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint      not null comment '0-未删除 1-已删除',

  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_ac_ztb comment '帐套表';

/*==============================================================*/
/* table: zl_ageseason                                          */
/*==============================================================*/
create table zl_ageseason
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  sessionmark      varchar(10),
  sessionname      varchar(10),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_ageseason comment '年代季节';

/*==============================================================*/
/* table: zl_aliases                                            */
/*==============================================================*/
create table zl_aliases
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  code             varchar(50),
  brandid          int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_aliases comment '任何表都应该包含的列';

/*==============================================================*/
/* table: zl_bankinformation                                    */
/*==============================================================*/
create table zl_bankinformation
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  bankname         varchar(100),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  bankname2        varchar(100),
  bankaddress      varchar(100),
  bankaccount      varchar(50),
  remittedaccount  varchar(50),
  supplierid       int unsigned null,
  currency         varchar(36),
  account          varchar(50),
  isused           varchar(1) comment '0-常用，1-禁用',
  remark           varchar(200),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_bankinformation comment '银行信息';

/*==============================================================*/
/* table: zl_brand                                              */
/*==============================================================*/
create table zl_brand
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  code             varchar(50),
  brandname        varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  countryid        int unsigned null,
  childbrand       varchar(36),
  description      varchar(1000),
  imagestream      longblob,
  memo             text,
  supplier         varchar(36),
  officialwebsite  varchar(500),
  isauthorized     tinyint,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_brand comment '品牌表';

/*==============================================================*/
/* table: zl_brandgroup                                         */
/*==============================================================*/
create table zl_brandgroup
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  code             varchar(50),
  brandgroupname   varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_brandgroup comment '品类表';

/*==============================================================*/
/* table: zl_brandremark                                        */
/*==============================================================*/
create table zl_brandremark
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  brandid          int unsigned null,
  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(100),
  pic              longblob,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_brandremark comment '品牌颜色材质备注';

/*==============================================================*/
/* table: zl_businesstype                                       */
/*==============================================================*/
create table zl_businesstype
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_businesstype comment '业务类型';

/*==============================================================*/
/* table: zl_childproductgroup                                  */
/*==============================================================*/
create table zl_childproductgroup
(
  id                int unsigned not null auto_increment comment '主键id',
  sys_create_stuff  int unsigned not null,
  sys_create_date   datetime not null,
  sys_modify_stuff  int unsigned not null,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int unsigned null,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  childname         varchar(50),
  lang_code         varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  childcode         varchar(50),
  productgroupid    int unsigned null,
  producttemplateid int unsigned null,
  weight            decimal(16,9),
  isfj              varchar(1) comment '0-否 1-法检',
  cname4male        varchar(36),
  cname4female      varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_childproductgroup comment '子品类';

/*==============================================================*/
/* table: zl_closedway                                          */
/*==============================================================*/
create table zl_closedway
(
  id                int unsigned not null auto_increment comment '主键id',
  sys_create_stuff  int unsigned not null,
  sys_create_date   datetime not null,
  sys_modify_stuff  int unsigned not null,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int unsigned null,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  closedwayname     varchar(50),
  lang_code         varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  closedwaynamenote varchar(100),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_closedway comment '闭合方式';

/*==============================================================*/
/* table: zl_color                                              */
/*==============================================================*/
create table zl_color
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  code             varchar(10),
  colorname        varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  colormatter      varchar(100),
  asacolorid       int unsigned null,
  brandid          int unsigned null,
  imagestream      longblob,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_color comment '其他品牌颜色模板';

/*==============================================================*/
/* table: zl_colortemplate                                      */
/*==============================================================*/
create table zl_colortemplate
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  color_name       varchar(20),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  code             varchar(4),
  color_note       varchar(200),
  colortype        varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_colortemplate comment 'asa颜色模板';

/*==============================================================*/
/* table: zl_companycontacts                                    */
/*==============================================================*/
create table zl_companycontacts
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  gender           varchar(10),
  department       varchar(20),
  position         varchar(20),
  city             varchar(20),
  company          varchar(50),
  phone            varchar(30),
  landline         varchar(30),
  fax              varchar(30),
  email            varchar(20),
  msn              varchar(20),
  qq               varchar(20),
  skytpe           varchar(20),
  microblog        varchar(20),
  micromessage     varchar(20),
  note             varchar(1000),
  branch           varchar(100),
  useid            int unsigned null,
  address          varchar(500),
  zipcode          varchar(10),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_companycontacts comment '联系人
';

/*==============================================================*/
/* table: zl_costformula                                        */
/*==============================================================*/
create table zl_costformula
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productpriceid   int unsigned null,
  symbol_1         char(10),
  coefficient_1    decimal(10,2),
  symbol_2         char(10),
  coefficient_2    decimal(10,2),
  formulaname      varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_costformula comment '成本计算公式';

/*==============================================================*/
/* table: zl_country                                            */
/*==============================================================*/
create table zl_country
(
  id               int unsigned not null auto_increment comment '主键id',
  code             varchar(20)  not null,
  name             varchar(100) not null,
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime     not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime     not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint      not null comment '0-未删除 1-已删除',

  localcurrency    varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_country comment '国家表';


/*==============================================================*/
/* table: zl_language                                            */
/*==============================================================*/
create table zl_language
(
  id               int unsigned not null auto_increment comment '主键id',
  name             varchar(50) not null,
  code             varchar(20) not null,
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime    not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime    not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint     not null comment '0-未删除 1-已删除',

  primary key (id),
  unique `zl_language_name` (`name`),
  unique `zl_language_code` (`code`)
) engine=innodb default charset=utf8mb4;

alter table zl_language comment '语言表';


/*==============================================================*/
/* table: zl_currency                                           */
/*==============================================================*/
create table zl_currency
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  currencyname     varchar(20),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  currencycode     varchar(10),
  currencymark     bool,
  userflag         varchar(1),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_currency comment '币种表';

/*==============================================================*/
/* table: zl_customs_name                                       */
/*==============================================================*/
create table zl_customs_name
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(100),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_customs_name comment '商品报关名称
';

/*==============================================================*/
/* table: zl_decade                                             */
/*==============================================================*/
create table zl_decade
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  decade           varchar(10),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_decade comment '商品年代';

/*==============================================================*/
/* table: zl_delare_makings                                     */
/*==============================================================*/
create table zl_delare_makings
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(100),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_delare_makings comment '申报要素';

/*==============================================================*/
/* table: zl_ex_reportstyle                                     */
/*==============================================================*/
create table zl_ex_reportstyle
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  code             varchar(20),
  chinese_name     varchar(100),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  tdbackx          int,
  tdbacky          int,
  tdbackwidth      int,
  tdbackheight     int,
  memo             varchar(1000),
  companyid    int unsigned null,
  picid            int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_ex_reportstyle comment '快递单样式主表';

/*==============================================================*/
/* table: zl_ex_reportstyle_detail                              */
/*==============================================================*/
create table zl_ex_reportstyle_detail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  type_id          int unsigned null,
  tdfield          varchar(200),
  tdfieldx         int,
  tdfieldy         int,
  tdfieldwidth     int,
  tdfieldheight    int,
  is_visiable      varchar(1),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_ex_reportstyle_detail comment '快递单样式明细表';

/*==============================================================*/
/* table: zl_exchangerate                                       */
/*==============================================================*/
create table zl_exchangerate
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  exchangeratedate varchar(50),
  exportcurrency   varchar(36) comment '汇出币种',
  importcurrency   varchar(36) comment '汇入币种',
  exchangerate     decimal(10,5),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_exchangerate comment '汇率';

/*==============================================================*/
/* table: zl_executioncategory                                  */
/*==============================================================*/
create table zl_executioncategory
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  executionname    varchar(100),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  executionmatter  varchar(500),
  note             varchar(500),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_executioncategory comment '执行标准';

/*==============================================================*/
/* table: zl_exhibition                                         */
/*==============================================================*/
create table zl_exhibition
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(100),
  status           varchar(1) comment '0-不可用 1-可用',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_exhibition comment '展会';

/*==============================================================*/
/* table: zl_feenames                                           */
/*==============================================================*/
create table zl_feenames
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  code             varchar(20),
  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  kmid             int unsigned null,
  isamortize       tinyint comment '0-不摊销 1-金额摊销 2-件数摊销',
  isused           varchar(1) comment '0-不常用 1-常用',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_feenames comment '费用名称';

/*==============================================================*/
/* table: zl_forbiddenword                                      */
/*==============================================================*/
create table zl_forbiddenword
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  word             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(100),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_forbiddenword comment '违禁词';

/*==============================================================*/
/* table: zl_imagetool                                          */
/*==============================================================*/
create table zl_imagetool
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  type             varchar(1) comment '0-修改尺寸
            1-修改尺寸并添加
            2-裁剪并对齐',
  width            int,
  height           int,
  isneed           varchar(1),
  quality          int,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_imagetool comment '图片导出方式';

/*==============================================================*/
/* table: zl_invite_rule                                        */
/*==============================================================*/
create table zl_invite_rule
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  bonus            bigint,
  remark           text,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_invite_rule comment '会员邀请规则';

/*==============================================================*/
/* table: zl_invoice_header                                     */
/*==============================================================*/
create table zl_invoice_header
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  supplierid       int unsigned null,
  header           varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(200),
  isdefault        varchar(1) comment '1-默认 0-非默认',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_invoice_header comment '客户 发票抬头';

/*==============================================================*/
/* table: zl_material                                           */
/*==============================================================*/
create table zl_material
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  materialname     varchar(20),
  code             varchar(20),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_material comment '材质
';

/*==============================================================*/
/* table: zl_materialnote                                       */
/*==============================================================*/
create table zl_materialnote
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  content          varchar(100),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_materialnote comment '材质备注';

/*==============================================================*/
/* table: zl_materialstatus                                     */
/*==============================================================*/
create table zl_materialstatus
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  code             varchar(20),
  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_materialstatus comment '材质状态';

/*==============================================================*/
/* table: zl_memberlevel                                        */
/*==============================================================*/
create table zl_memberlevel
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  memberlevel      varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  discount         decimal(16,9),
  levelbasicscore  bigint,
  integralrule     decimal(16,9) comment '实际成交价格x积分规则=获得积分',
  exchangerule     decimal(16,9) comment '积分x对换规则=可兑换金额',
  levelcontent     varchar(50),
  isretail         varchar(1) comment '0-非零售等级，不能升级，1-零售等级，可以升级',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_memberlevel comment '会员等级设置';

/*==============================================================*/
/* table: zl_occasionsstyle                                     */
/*==============================================================*/
create table zl_occasionsstyle
(
  id                 int unsigned not null auto_increment comment '主键id',
  sys_create_stuff   int unsigned not null,
  sys_create_date    datetime not null,
  sys_modify_stuff   int unsigned not null,
  sys_modify_date    datetime not null,
  sys_delete_stuff   int unsigned null,
  sys_delete_date    datetime,
  sys_delete_flag    tinyint  not null comment '0-未删除 1-已删除',

  occasionsstylename varchar(50),
  lang_code          varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  occasionsstylemode varchar(200),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_occasionsstyle comment '场合风格';

/*==============================================================*/
/* table: zl_pricesource                                        */
/*==============================================================*/
create table zl_pricesource
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(500),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_pricesource comment '价格来源';

/*==============================================================*/
/* table: zl_productdscrb                                       */
/*==============================================================*/
create table zl_productdscrb
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(100),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_productdscrb comment '商品描述';

/*==============================================================*/
/* table: zl_productinnards                                     */
/*==============================================================*/
create table zl_productinnards
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  partsname        varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_productinnards comment '内部结构';

/*==============================================================*/
/* table: zl_productparts                                       */
/*==============================================================*/
create table zl_productparts
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  partscode        varchar(50),
  partsname        varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  packflag         varchar(1),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_productparts comment '附带配件
';

/*==============================================================*/
/* table: zl_productprice                                       */
/*==============================================================*/
create table zl_productprice
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  salename         varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  isdefault        varchar(1) comment '0 - 默认
            1 - 不默认',
  curreancyid      int unsigned null,
  sortnum          varchar(4),
  isround          varchar(1),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_productprice comment '商品销售价格 国内外零售价、批发价';

/*==============================================================*/
/* table: zl_productstyle                                       */
/*==============================================================*/
create table zl_productstyle
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  brandgroup       varchar(36),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  childbrand       varchar(36),
  productstyle     varchar(10),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_productstyle comment '商品款号';

/*==============================================================*/
/* table: zl_producttemplate                                    */
/*==============================================================*/
create table zl_producttemplate
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  templatename     varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  picture          longblob,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_producttemplate comment '商品模板-主表';

/*==============================================================*/
/* table: zl_quotedprice                                        */
/*==============================================================*/
create table zl_quotedprice
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  s_id             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  currency         varchar(50),
  quotedprice      decimal(10,0),
  quoteddate       datetime,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_quotedprice comment 'zl_quotedprice';

/*==============================================================*/
/* table: zl_reportset                                          */
/*==============================================================*/
create table zl_reportset
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  code             varchar(50),
  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(500),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_reportset comment '报表样式设置';

/*==============================================================*/
/* table: zl_reportset_detail                                   */
/*==============================================================*/
create table zl_reportset_detail
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  setid            int unsigned null,
  code             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  `index`          int,
  width            int,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_reportset_detail comment '报表样式设置明细';

/*==============================================================*/
/* table: zl_salesmethods                                       */
/*==============================================================*/
create table zl_salesmethods
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  salesmethodsname varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  salesmethodsmode varchar(200),
  brandtype        varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_salesmethods comment '销售方式';

/*==============================================================*/
/* table: zl_salesport                                          */
/*==============================================================*/
create table zl_salesport
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  protname         varchar(20),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(500),
  storename        varchar(50),
  isonline         varchar(1) comment '0-否 1-是',
  address          char(1),
  tel              varchar(50),
  isused           varchar(1),
  iskd             varchar(1) comment '0-否 1-是',
  postremark       text,
  cusid            int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_salesport comment '销售端口基础资料';

/*==============================================================*/
/* table: zl_salesport_mission                                  */
/*==============================================================*/
create table zl_salesport_mission
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  salespotid       int unsigned null,
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  yearmonth        varchar(10) comment '格式为201801',
  salesum          decimal(10,2),
  profit           decimal(10,2),
  rate             decimal(10,2),
  remark           varchar(500),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_salesport_mission comment '销售端口任务额';

/*==============================================================*/
/* table: zl_series                                             */
/*==============================================================*/
create table zl_series
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  code             varchar(50),
  brandid          int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_series comment '任何表都应该包含的列';

/*==============================================================*/
/* table: zl_series2                                            */
/*==============================================================*/
create table zl_series2
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  seriesid         int unsigned null,
  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  code             varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_series2 comment '子系列';

/*==============================================================*/
/* table: zl_shippingtype                                       */
/*==============================================================*/
create table zl_shippingtype
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  code             varchar(10),
  name             varchar(10),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_shippingtype comment '运输方式';

/*==============================================================*/
/* table: zl_sizecontent                                        */
/*==============================================================*/
create table zl_sizecontent
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  topid            int unsigned null,
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  content          varchar(10),
  sortnum          int,
  remark           varchar(100),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_sizecontent comment '尺码明细';

/*==============================================================*/
/* table: zl_sizetop                                            */
/*==============================================================*/
create table zl_sizetop
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  code             varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_sizetop comment '尺码组';

/*==============================================================*/
/* table: zl_storemove                                          */
/*==============================================================*/
create table zl_storemove
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  productid        int unsigned null,
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  storeid          int unsigned null,
  moveman          varchar(50),
  movedate         datetime,
  movestate        varchar(50),
  note             varchar(1000),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_storemove comment '??未使用';

/*==============================================================*/
/* table: zl_style                                              */
/*==============================================================*/
create table zl_style
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  stylename        varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  stylemode        varchar(200),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_style comment '未使用';

/*==============================================================*/
/* table: zl_supplier_type                                      */
/*==============================================================*/
create table zl_supplier_type
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  supplierid       int unsigned null,
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  type             varchar(1) comment '0-供货商 1-报关行 2-供应商 3-承运人 4-客户',
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_supplier_type comment '关系单位类型';

/*==============================================================*/
/* table: zl_supplierlevel                                      */
/*==============================================================*/
create table zl_supplierlevel
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  levelname        varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  levelnote        varchar(100),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_supplierlevel comment '供货商级别';

/*==============================================================*/
/* table: zl_sys_selfcompany                                    */
/*==============================================================*/
create table zl_sys_selfcompany
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  supplier_id      int unsigned null,
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_sys_selfcompany comment '分公司列表';

/*==============================================================*/
/* table: zl_template_descrb                                    */
/*==============================================================*/
create table zl_template_descrb
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  tempid           int unsigned null,
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  sizetopid        int unsigned null,
  sizeid           int unsigned null,
  baselenth        decimal(10,2),
  lenth            decimal(10,2),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_template_descrb comment '商品模板-尺码大小描述';

/*==============================================================*/
/* table: zl_templatelist                                       */
/*==============================================================*/
create table zl_templatelist
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  templatename     varchar(36),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  sizename         varchar(36),
  content          varchar(20),
  productid        int unsigned null,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_templatelist comment '商品模板-数据表';

/*==============================================================*/
/* table: zl_templatemanage                                     */
/*==============================================================*/
create table zl_templatemanage
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  templatename     varchar(20),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  tempid           int unsigned null,
  sortnum          int,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_templatemanage comment '商品模板-从表';

/*==============================================================*/
/* table: zl_trans_code                                         */
/*==============================================================*/
create table zl_trans_code
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  code             varchar(50),
  remark           varchar(500),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_trans_code comment '接口基础资料';

/*==============================================================*/
/* table: zl_ulnarinch                                          */
/*==============================================================*/
create table zl_ulnarinch
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_ulnarinch comment '任何表都应该包含的列';

/*==============================================================*/
/* table: zl_unit                                               */
/*==============================================================*/
create table zl_unit
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  unitname         varchar(20),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  unitgroupid      varchar(50),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_unit comment '未使用';

/*==============================================================*/
/* table: zl_unitgroup                                          */
/*==============================================================*/
create table zl_unitgroup
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  groupname        varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  crew             varchar(100),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_unitgroup comment 'zl_unitgroup';

/*==============================================================*/
/* table: zl_warehouse                                          */
/*==============================================================*/
create table zl_warehouse
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  country          varchar(36),
  city             varchar(20),
  storename        varchar(50),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  storeaddress     varchar(100),
  contact          varchar(20),
  toll             varchar(20),
  fax              varchar(20),
  mobile           varchar(20),
  othercontact     varchar(50),
  code             varchar(20),
  defaultstore     varchar(1),
  zipcode          varchar(10),
  is_real          varchar(1),
  maxstock         bigint,
  maxsku           bigint,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_warehouse comment '仓库信息';

/*==============================================================*/
/* table: zl_washinginstructions                                */
/*==============================================================*/
create table zl_washinginstructions
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(10),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(50),
  image            longblob,
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_washinginstructions comment '洗涤标准';

/*==============================================================*/
/* table: zl_winterproofing                                     */
/*==============================================================*/
create table zl_winterproofing
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(20),
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  remark           varchar(100),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_winterproofing comment '防寒指数';

/*==============================================================*/
/* table: zl_yearexchange                                       */
/*==============================================================*/
create table zl_yearexchange
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  yeardate         varchar(50),
  money            decimal(16,9) comment 'import:export',
  begintime        datetime,
  endtime          datetime,
  import           varchar(36),
  export           varchar(36),
  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table zl_yearexchange comment '任何表都应该包含的列';

/*==============================================================*/
/* table: 模版                                                    */
/*==============================================================*/
create table 模版
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  primary key (id)
) engine=innodb default charset=utf8mb4;

alter table 模版 comment '任何表都应该包含的列';

alter table link_group_to_navigation
  add constraint fk_reference_link_group_to_navigation_to_group foreign key (groupid)
    references tb_group (id);

alter table link_rule_to_operation
  add constraint fk_reference_link_rule_to_operationto_rule_id foreign key (ruleid)
    references tb_rule (id);

-- alter table link_user_to_rule
--   add constraint fk_reference_link_user_to_rule_to_tb_rule foreign key (ruleid)
--     references tb_rule (id);
--
-- alter table link_user_to_rule
--   add constraint fk_reference_link_userid foreign key (loginid)
--     references tb_user (id);

alter table tb_user
  add constraint fk_reference_tb_user_to_group foreign key (groupid)
    references tb_group (id);


#公司表
drop table if exists `tb_company`;
create table `tb_company`
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime     not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime     not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint      not null comment '0-未删除 1-已删除',
  `name`           varchar(191) not null comment '公司名称',
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `languages` varchar(191) NULL,
  `countryid`     int unsigned null comment '国家id',
  `remark`         text comment '备注说明',
  primary key (`id`)
) engine=innodb default charset=utf8mb4;


-- #组表
-- drop table if exists `group`;
-- create table `group`
-- (
--   id               int unsigned not null auto_increment comment '主键id',
--   sys_create_stuff int unsigned not null,
--   sys_create_date  datetime     not null,
--   sys_modify_stuff int unsigned not null,
--   sys_modify_date  datetime     not null,
--   sys_delete_stuff int unsigned null,
--   sys_delete_date  datetime,
--   sys_delete_flag  tinyint      not null comment '0-未删除 1-已删除',
--   `name`           varchar(100) not null default '' comment '组名称',
--   lang_code        varchar(20) null comment '语言编码',
--   `relateid` int null comment '对应主键id',
--   `languages` varchar(191) NULL,
--   `description`    varchar(100) not null default '' comment '组描述',
--   primary key (`id`),
--   unique `group_name` (`name`)
-- ) engine=innodb default charset=utf8mb4;

#权限表
drop table if exists `permission`;
create table `permission`
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime     not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime     not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint      not null comment '0-未删除 1-已删除',
  `pid`            int unsigned not null default '0' comment '所属权限id，默认0为顶级权限',
  `name`           varchar(100) not null default '' comment '权限名称',
  lang_code        varchar(20) null comment '语言编码',
  `relateid` int null comment '对应主键id',
  `is_only_superadmin` tinyint(1) not null default '0' comment '是否为专属超级管理员权限，0-不是 1-是',
  `languages` varchar(191) NULL,
  `description`    varchar(100) not null default '' comment '权限描述',
  primary key (`id`),
  unique `permission_name` (`name`)
) engine=innodb default charset=utf8mb4;

#组权限多对多表
drop table if exists `permission_group`;
create table `permission_group`
(
  id               int unsigned not null auto_increment comment '主键id',
  sys_create_stuff int unsigned not null,
  sys_create_date  datetime not null,
  sys_modify_stuff int unsigned not null,
  sys_modify_date  datetime not null,
  sys_delete_stuff int unsigned null,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',
  `groupid`        int unsigned not null comment '组id',
  `permissionid`  int unsigned not null comment '权限id',
  primary key (`id`)
) engine=innodb default charset=utf8mb4 collate =utf8mb4_unicode_ci;

-- #组用户多对多表
-- drop table if exists `group_user`;
-- create table `group_user`
-- (
--   id               int unsigned not null auto_increment comment '主键id',
--   sys_create_stuff int unsigned not null,
--   sys_create_date  datetime not null,
--   sys_modify_stuff int unsigned not null,
--   sys_modify_date  datetime not null,
--   sys_delete_stuff int unsigned null,
--   sys_delete_date  datetime,
--   sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',
--   `groupid`        int unsigned not null comment '组id',
--   `userid`        bigint unsigned not null comment '用户id',
--   primary key (`id`)
-- ) engine=innodb default charset=utf8mb4;




--
-- 转存表中的数据 `permission`
--

INSERT INTO `permission` (`id`, `sys_create_stuff`, `sys_create_date`, `sys_modify_stuff`, `sys_modify_date`, `sys_delete_stuff`, `sys_delete_date`, `sys_delete_flag`, `pid`, `name`, `lang_code`, `relateid`, `description`) VALUES
(1, 1, '2019-03-08 13:37:45', 1, '2019-03-08 13:37:45', NULL, NULL, 0, 0, 'userControl', NULL, NULL, '用户管理'),
(2, 1, '2019-03-08 13:40:21', 1, '2019-03-08 13:40:21', NULL, NULL, 0, 0, 'databaseControl', NULL, NULL, '基础数据'),
(3, 1, '2019-03-08 13:42:08', 1, '2019-03-08 13:42:08', NULL, NULL, 0, 0, 'productControl', NULL, NULL, '商品管理'),
(4, 1, '2019-03-08 13:43:12', 1, '2019-03-08 13:43:12', NULL, NULL, 0, 0, 'customControl', NULL, NULL, '客户管理'),
(5, 1, '2019-03-08 13:45:10', 1, '2019-03-08 13:45:10', NULL, NULL, 0, 0, 'supplierControl', NULL, NULL, '供应链管理'),
(6, 1, '2019-03-08 13:45:34', 1, '2019-03-08 13:45:34', NULL, NULL, 0, 0, 'stockControl', NULL, NULL, '库存管理'),
(7, 1, '2019-03-08 13:46:13', 1, '2019-03-08 13:46:13', NULL, NULL, 0, 0, 'salesControl', NULL, NULL, '销售管理'),
(8, 1, '2019-03-08 13:46:40', 1, '2019-03-08 13:46:40', NULL, NULL, 0, 0, 'memberControl', NULL, NULL, '会员管理'),
(9, 1, '2019-03-08 13:47:16', 1, '2019-03-08 13:47:16', NULL, NULL, 0, 0, 'costControl', NULL, NULL, '费用管理'),
(10, 1, '2019-03-08 13:48:08', 1, '2019-03-08 13:48:08', NULL, NULL, 0, 0, 'financialControl', NULL, NULL, '财务管理'),
(11, 1, '2019-03-08 13:48:42', 1, '2019-03-08 13:48:42', NULL, NULL, 0, 0, 'systemControl', NULL, NULL, '系统管理'),
(12, 1, '2019-03-08 13:50:11', 1, '2019-03-08 13:50:11', NULL, NULL, 0, 1, 'user', NULL, NULL, '员工信息'),
(13, 1, '2019-03-08 13:51:06', 1, '2019-03-08 13:51:06', NULL, NULL, 0, 1, 'group', NULL, NULL, '组信息'),
(14, 1, '2019-03-08 13:51:24', 1, '2019-03-08 13:51:24', NULL, NULL, 0, 1, 'department', NULL, NULL, '部门信息'),
(15, 1, '2019-03-08 13:52:10', 1, '2019-03-08 13:52:10', NULL, NULL, 0, 2, 'productRelate', NULL, NULL, '商品相关'),
(16, 1, '2019-03-08 13:52:45', 1, '2019-03-08 13:52:45', NULL, NULL, 0, 2, 'priceRelate', NULL, NULL, '价格相关'),
(17, 1, '2019-03-08 13:56:20', 1, '2019-03-08 13:56:20', NULL, NULL, 0, 2, 'otherRelate', NULL, NULL, '其他'),
(18, 1, '2019-03-08 13:57:31', 1, '2019-03-08 13:57:31', NULL, NULL, 0, 3, 'product', NULL, NULL, '商品信息'),
(19, 1, '2019-03-08 13:57:53', 1, '2019-03-08 13:57:53', NULL, NULL, 0, 3, 'picture', NULL, NULL, '图片管理'),
(20, 1, '2019-03-08 14:04:10', 1, '2019-03-08 14:04:10', NULL, NULL, 0, 3, 'pictureupload', NULL, NULL, '图片上传'),
(21, 1, '2019-03-08 14:06:34', 1, '2019-03-08 14:06:34', NULL, NULL, 0, 4, 'supplier', NULL, NULL, '关系单位信息'),
(22, 1, '2019-03-08 14:12:25', 1, '2019-03-08 14:12:25', NULL, NULL, 0, 4, 'quotation', NULL, NULL, '供货商报价'),
(23, 1, '2019-03-08 14:17:08', 1, '2019-03-08 14:17:08', NULL, NULL, 0, 4, 'supplierlevel', NULL, NULL, '供货商级别'),
(24, 1, '2019-03-08 14:20:47', 1, '2019-03-08 14:20:47', NULL, NULL, 0, 5, 'orderRelate', NULL, NULL, '订单管理'),
(25, 1, '2019-03-08 14:27:24', 1, '2019-03-08 14:27:24', NULL, NULL, 0, 5, 'confirmorder', NULL, NULL, '发货单管理'),
(26, 1, '2019-03-08 14:34:21', 1, '2019-03-08 14:34:21', NULL, NULL, 0, 5, 'warehousingRelate', NULL, NULL, '到货入库'),
(27, 1, '2019-03-08 14:35:59', 1, '2019-03-08 14:35:59', NULL, NULL, 0, 6, 'requisitionRelate', NULL, NULL, '调拨相关'),
(28, 1, '2019-03-08 14:48:07', 1, '2019-03-08 14:48:07', NULL, NULL, 0, 6, 'checkRelate', NULL, NULL, '库存盘点'),
(29, 1, '2019-03-08 15:12:48', 1, '2019-03-08 15:12:48', NULL, NULL, 0, 6, 'stocksnapshot', NULL, NULL, '库存余额查询'),
(30, 1, '2019-03-08 15:13:20', 1, '2019-03-08 15:13:20', NULL, NULL, 0, 6, 'productstock', NULL, NULL, '库存查询'),
(31, 1, '2019-03-08 15:14:05', 1, '2019-03-08 15:14:05', NULL, NULL, 0, 6, 'productstockSnapshot', NULL, NULL, '库存快照统计'),
(32, 1, '2019-03-08 15:18:29', 1, '2019-03-08 15:18:29', NULL, NULL, 0, 7, 'sales', NULL, NULL, '商品零售批发'),
(33, 1, '2019-03-08 15:28:36', 1, '2019-03-08 15:28:36', NULL, NULL, 0, 7, 'salesstock', NULL, NULL, '销售端口库存统计'),
(34, 1, '2019-03-08 15:37:15', 1, '2019-03-08 15:37:15', NULL, NULL, 0, 7, 'sfRelate', NULL, NULL, '销售对账'),
(35, 1, '2019-03-08 15:38:04', 1, '2019-03-08 15:38:04', NULL, NULL, 0, 7, 'sale/statistics', NULL, NULL, '销售统计'),
(36, 1, '2019-03-08 15:39:08', 1, '2019-03-08 15:39:08', NULL, NULL, 0, 8, 'member', NULL, NULL, '会员管理'),
(37, 1, '2019-03-08 15:39:37', 1, '2019-03-08 15:39:37', NULL, NULL, 0, 8, 'memberlevel', NULL, NULL, '会员级别'),
(38, 1, '2019-03-08 16:04:26', 1, '2019-03-08 16:04:26', NULL, NULL, 0, 9, 'fee', NULL, NULL, '费用申请'),
(39, 1, '2019-03-08 16:08:03', 1, '2019-03-08 16:08:03', NULL, NULL, 0, 9, 'fee/leader', NULL, NULL, '费用申请主管审批'),
(40, 1, '2019-03-08 16:08:30', 1, '2019-03-08 16:08:30', NULL, NULL, 0, 9, 'fee/finance', NULL, NULL, '费用申请财务审批'),
(41, 1, '2019-03-08 16:10:11', 1, '2019-03-08 16:10:11', NULL, NULL, 0, 9, 'fee/manager', NULL, NULL, '费用申请经理审批'),
(42, 1, '2019-03-08 16:12:20', 1, '2019-03-08 16:12:20', NULL, NULL, 0, 10, 'sfsheet', NULL, NULL, '对账查询'),
(43, 1, '2019-03-08 16:18:42', 1, '2019-03-08 16:18:42', NULL, NULL, 0, 11, 'help', NULL, NULL, '系统帮助'),
(44, 1, '2019-03-08 16:20:49', 1, '2019-03-08 16:20:49', NULL, NULL, 0, 11, 'modifypassword', NULL, NULL, '修改密码'),
(45, 1, '2019-03-08 16:21:09', 1, '2019-03-08 16:21:09', NULL, NULL, 0, 11, 'logout', NULL, NULL, '退出登录'),
(46, 1, '2019-03-08 17:33:06', 1, '2019-03-08 17:33:06', NULL, NULL, 0, 15, 'brand', NULL, NULL, '品牌维护'),
(47, 1, '2019-03-08 17:33:41', 1, '2019-03-08 17:33:41', NULL, NULL, 0, 15, 'brandgroup', NULL, NULL, '品类维护'),
(48, 1, '2019-03-08 17:37:24', 1, '2019-03-08 17:37:24', NULL, NULL, 0, 15, 'ageseason', NULL, NULL, '款式年代'),
(49, 1, '2019-03-08 17:40:43', 1, '2019-03-08 17:40:43', NULL, NULL, 0, 15, 'colortemplate', NULL, NULL, '颜色模板'),
(50, 1, '2019-03-08 17:41:02', 1, '2019-03-08 17:41:02', NULL, NULL, 0, 15, 'sizetop', NULL, NULL, '商品尺码'),
(51, 1, '2019-03-08 17:41:20', 1, '2019-03-08 17:41:20', NULL, NULL, 0, 15, 'material', NULL, NULL, '材质管理'),
(52, 1, '2019-03-08 17:41:39', 1, '2019-03-08 17:41:39', NULL, NULL, 0, 15, 'ulnarinch', NULL, NULL, '商品尺寸'),
(53, 1, '2019-03-08 17:41:58', 1, '2019-03-08 17:41:58', NULL, NULL, 0, 15, 'aliases', NULL, NULL, '商品别名'),
(54, 1, '2019-03-08 17:42:16', 1, '2019-03-08 17:42:16', NULL, NULL, 0, 15, 'productinnards', NULL, NULL, '内部结构'),
(55, 1, '2019-03-08 17:42:35', 1, '2019-03-08 17:42:35', NULL, NULL, 0, 15, 'productparts', NULL, NULL, '附带配件'),
(56, 1, '2019-03-08 17:42:52', 1, '2019-03-08 17:42:52', NULL, NULL, 0, 15, 'occasionsstyle', NULL, NULL, '场合风格'),
(57, 1, '2019-03-08 17:49:10', 1, '2019-03-08 17:49:10', NULL, NULL, 0, 15, 'closedway', NULL, NULL, '闭合方式'),
(58, 1, '2019-03-08 17:50:10', 1, '2019-03-08 17:50:10', NULL, NULL, 0, 15, 'executioncategory', NULL, NULL, '执行标准'),
(59, 1, '2019-03-08 17:50:26', 1, '2019-03-08 17:50:26', NULL, NULL, 0, 15, 'securitycategory', NULL, NULL, '安全类别'),
(60, 1, '2019-03-08 17:50:56', 1, '2019-03-08 17:50:56', NULL, NULL, 0, 15, 'washinginstructions', NULL, NULL, '洗涤说明'),
(61, 1, '2019-03-08 17:51:32', 1, '2019-03-08 17:51:32', NULL, NULL, 0, 15, 'winterproofing', NULL, NULL, '防寒指数'),
(62, 1, '2019-03-08 17:55:31', 1, '2019-03-08 17:55:31', NULL, NULL, 0, 16, 'productprice', NULL, NULL, '商品价格管理'),
(63, 1, '2019-03-08 17:55:52', 1, '2019-03-08 17:55:52', NULL, NULL, 0, 16, 'costformula', NULL, NULL, '成本计算管理'),
(64, 1, '2019-03-08 17:56:56', 1, '2019-03-08 17:56:56', NULL, NULL, 0, 17, 'warehouse', NULL, NULL, '仓库管理'),
(65, 1, '2019-03-08 17:57:20', 1, '2019-03-08 17:57:20', NULL, NULL, 0, 17, 'salesport', NULL, NULL, '销售端口管理'),
(66, 1, '2019-03-08 17:57:40', 1, '2019-03-08 17:57:40', NULL, NULL, 0, 17, 'country', NULL, NULL, '国际及地区信息维护'),
(67, 1, '2019-03-08 17:58:11', 1, '2019-03-08 17:58:11', NULL, NULL, 0, 17, 'feenames', NULL, NULL, '费用名称'),
(68, 1, '2019-03-08 17:58:31', 1, '2019-03-08 17:58:31', NULL, NULL, 0, 17, 'shippingtype', NULL, NULL, '运输方式'),
(69, 1, '2019-03-08 17:58:53', 1, '2019-03-08 17:58:53', NULL, NULL, 0, 17, 'salesmethods', NULL, NULL, '销售性质'),
(70, 1, '2019-03-08 17:59:10', 1, '2019-03-08 17:59:10', NULL, NULL, 0, 17, 'businesstype', NULL, NULL, '业务类型'),
(71, 1, '2019-03-08 17:59:26', 1, '2019-03-08 17:59:26', NULL, NULL, 0, 17, 'reportstyle', NULL, NULL, '快递单样式'),
(72, 1, '2019-03-08 17:59:51', 1, '2019-03-08 17:59:51', NULL, NULL, 0, 17, 'imagetool', NULL, NULL, '图片工具'),
(73, 1, '2019-03-08 18:07:56', 1, '2019-03-08 18:07:56', NULL, NULL, 0, 24, 'order', NULL, NULL, '订单管理'),
(74, 1, '2019-03-08 18:11:11', 1, '2019-03-08 18:11:11', NULL, NULL, 0, 24, 'order/search', NULL, NULL, '订单状态查询'),
(75, 1, '2019-03-08 18:11:32', 1, '2019-03-08 18:11:32', NULL, NULL, 0, 24, 'order/export', NULL, NULL, '订单导出'),
(76, 1, '2019-03-08 18:30:33', 1, '2019-03-08 18:30:33', NULL, NULL, 0, 26, 'warehousing', NULL, NULL, '到货入库'),
(78, 1, '2019-03-08 18:32:22', 1, '2019-03-08 18:32:22', NULL, NULL, 0, 26, 'warehousing/list', NULL, NULL, '入库单查询'),
(79, 1, '2019-03-08 18:37:56', 1, '2019-03-08 18:37:56', NULL, NULL, 0, 27, 'requisition/apply', NULL, NULL, '调拨单查询/申请'),
(80, 1, '2019-03-08 18:46:27', 1, '2019-03-08 18:46:27', NULL, NULL, 0, 27, 'requisition/turnout', NULL, NULL, '调拨出库确认'),
(81, 1, '2019-03-08 18:46:34', 1, '2019-03-08 18:46:34', NULL, NULL, 0, 27, 'requisition/turnin', NULL, NULL, '调拨入库确认'),
(82, 1, '2019-03-08 18:55:25', 1, '2019-03-08 18:55:25', NULL, NULL, 0, 28, 'check', NULL, NULL, '盘点单列表'),
(83, 1, '2019-03-08 18:56:24', 1, '2019-03-08 18:56:24', NULL, NULL, 0, 28, 'check/detail', NULL, NULL, '库存变动查询'),
(84, 1, '2019-03-08 19:01:59', 1, '2019-03-08 19:01:59', NULL, NULL, 0, 34, 'sf/sheet', NULL, NULL, '销售对账页面'),
(85, 1, '2019-03-08 19:02:43', 1, '2019-03-08 19:02:43', NULL, NULL, 0, 34, 'sf/search', NULL, NULL, '对账查询页面');