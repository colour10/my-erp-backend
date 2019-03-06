/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2019/3/5 9:19:01                             */
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

drop table if exists link_product_to_MaterislStatus;

drop table if exists link_product_to_SalesNature;

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
/* Table: ac_invoice                                            */
/*==============================================================*/
create table ac_invoice
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  InvoiceDate      datetime,
  SupplierID       int UNSIGNED NULL,
  PayCusID         int UNSIGNED NULL,
  Rate             decimal(16,9),
  DepartmentID     int UNSIGNED NULL,
  UserID           int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  Sum              decimal(16,9),
  DSum             decimal(16,9),
  SSum             decimal(16,9),
  InvoiceSum       decimal(16,9),
  ExchangRate      decimal(16,9),
  InvoiceNo        varchar(20),
  Remark           varchar(100),
  CheckStatus      varchar(1) comment '0-未审核，1-已审核',
  CheckID          int UNSIGNED NULL,
  GLStatus         varchar(1),
  primary key (id)
);

alter table ac_invoice comment '货款发票主表';

/*==============================================================*/
/* Table: ac_invoice_fee                                        */
/*==============================================================*/
create table ac_invoice_fee
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  InvoiceDate      datetime,
  SupplierID       int UNSIGNED NULL,
  PayCusID         int UNSIGNED NULL,
  Rate             decimal(16,9),
  DepartmentID     int UNSIGNED NULL,
  UserID           int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  ExchangRate      decimal(16,9),
  InvoiceNo        varchar(20),
  Remark           char(1),
  CheckStatus      varchar(1) comment '0-未审核，1-已审核',
  CheckID          int UNSIGNED NULL,
  GLStatus         varchar(1),
  primary key (id)
);

alter table ac_invoice_fee comment '运费发票主表';

/*==============================================================*/
/* Table: ac_invoice_fee_detail                                 */
/*==============================================================*/
create table ac_invoice_fee_detail
(
  id                int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff  int UNSIGNED NOT NULL,
  sys_create_date   datetime not null,
  sys_modify_stuff  int UNSIGNED NOT NULL,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int UNSIGNED NULL,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  InvoiceID         int UNSIGNED NULL,
  FeeID             int UNSIGNED NULL,
  Number            int,
  FeeSum            decimal(16,9),
  FeeCurrencyid     int UNSIGNED NOT NULL,
  InvoiceCurrencyID varchar(36),
  InvoiceSum        decimal(16,9),
  Remark            varchar(100),
  SFCompany         varchar(36),
  primary key (id)
);

alter table ac_invoice_fee_detail comment '运费发票明细表';

/*==============================================================*/
/* Table: ac_invoice_prepay                                     */
/*==============================================================*/
create table ac_invoice_prepay
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  InvoiceDate      datetime,
  SupplierID       int UNSIGNED NULL,
  PayCusID         int UNSIGNED NULL,
  Rate             decimal(16,9),
  DepartmentID     int UNSIGNED NULL,
  UserID           int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  Sum              decimal(16,9),
  InvoiceSum       decimal(16,9),
  ExchangRate      decimal(16,9),
  InvoiceNo        varchar(20),
  Remark           varchar(100),
  CheckStatus      varchar(1) comment '0-未审核，1-已审核',
  CheckID          int UNSIGNED NULL,
  primary key (id)
);

alter table ac_invoice_prepay comment '订金发票主表';

/*==============================================================*/
/* Table: ac_kmyue_wb                                           */
/*==============================================================*/
create table ac_kmyue_wb
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ztid             int UNSIGNED NULL,
  kmid             int UNSIGNED NULL,
  nf               varchar(4),
  yf               varchar(2),
  CurrencyID       int UNSIGNED NULL,
  hl               decimal(19, 6),
  qche             decimal(19, 6),
  jffshe           decimal(19, 6),
  dffshe           decimal(19, 6),
  qmye             decimal(19, 6),
  qcher            decimal(19, 6),
  jffsher          decimal(19, 6),
  dffsher          decimal(19, 6),
  qmyer            decimal(19, 6),
  cus_id           int UNSIGNED NULL,
  dep_id           int UNSIGNED NULL,
  primary key (id)
);

alter table ac_kmyue_wb comment '科目余额表';

/*==============================================================*/
/* Table: ac_pzhb                                               */
/*==============================================================*/
create table ac_pzhb
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ztid             int UNSIGNED NULL,
  pzh_flow_type    varchar(2) comment 'TH-调汇 JZ-结转 FY-费用 FP-发票
            HK-回款 ZZ-转账 CX-冲销 ZC-正常
            ZJ-折旧',
  pzh_type_id      int UNSIGNED NULL,
  nf               varchar(5),
  yf               varchar(2),
  rq               varchar(2),
  pzh              varchar(50),
  zy               varchar(1000),
  lrrid            int UNSIGNED NULL,
  shr              varchar(36),
  shrq             datetime,
  jzr              varchar(36),
  jzrq             datetime,
  primary key (id)
);

alter table ac_pzhb comment '凭证表';

/*==============================================================*/
/* Table: ac_pzhh                                               */
/*==============================================================*/
create table ac_pzhh
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ztid             int UNSIGNED NULL,
  nf               varchar(5),
  yf               varchar(2),
  rq               varchar(2),
  pzh_type_id      int UNSIGNED NULL,
  pzhxh            int,
  yjbz             varchar(1),
  primary key (id)
);

alter table ac_pzhh comment '凭证号表';

/*==============================================================*/
/* Table: ac_pzhmxb                                             */
/*==============================================================*/
create table ac_pzhmxb
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  pzhid            int UNSIGNED NULL,
  kmid             int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  hl               decimal(19,6),
  jffshe           decimal(19,6),
  jffsher          decimal(19,6),
  dffshe           decimal(19,6),
  dffsher          decimal(19,6),
  zy               varchar(1000),
  sourse           varchar(1) comment 'Y-业务 C-普通 R-回款',
  cus_id           int UNSIGNED NULL,
  dep_id           int UNSIGNED NULL,
  jord             varchar(1),
  primary key (id)
);

alter table ac_pzhmxb comment '凭证明细表';

/*==============================================================*/
/* Table: ac_sf_sheet                                           */
/*==============================================================*/
create table ac_sf_sheet
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SheetNo          varchar(50),
  SorF             varchar(1),
  SFCompany        varchar(36),
  CurrencyID       int UNSIGNED NULL,
  Sum              decimal(16,9),
  Creator          varchar(36),
  Date             datetime,
  Remark           text,
  ExternalNo       varchar(50),
  Header           text,
  OriginalSum      decimal(16,9),
  AdjustSum        decimal(16,9),
  isKP             varchar(1),
  KPID             int UNSIGNED NULL,
  RefundRemark     text,
  IsRefund         varchar(1),
  primary key (id)
);

alter table ac_sf_sheet comment '对账费单';

/*==============================================================*/
/* Table: ac_sf_sheet_code                                      */
/*==============================================================*/
create table ac_sf_sheet_code
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Year             varchar(5),
  Code             varchar(10),
  Month            varchar(5),
  primary key (id)
);

alter table ac_sf_sheet_code comment '对账单号表';

/*==============================================================*/
/* Table: ac_sf_sheet_refund                                    */
/*==============================================================*/
create table ac_sf_sheet_refund
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SheetID          int UNSIGNED NULL,
  RefundDate       datetime,
  RefundBank       varchar(100),
  CurrencyID       int UNSIGNED NULL,
  RefundSum        decimal(10,2),
  InvoiceNo        varchar(100),
  Remark           varchar(1000),
  primary key (id)
);

alter table ac_sf_sheet_refund comment '对账单回款情况';

/*==============================================================*/
/* Table: dd_arrivalnotice                                      */
/*==============================================================*/
create table dd_arrivalnotice
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CorderID         int UNSIGNED NULL,
  OrderNo          varchar(50),
  MakeDate         datetime,
  MakeStaff        varchar(36),
  SupplierID       int UNSIGNED NOT NULL,
  CurrencyID       INT UNSIGNED NULL,
  Total            decimal(16,9),
  IsStatus         varchar(1),
  Remark           varchar(200),
  AuditStaff       varchar(36),
  AuditDate        datetime,
  AuditStatus      varchar(1),
  ExchangeRate     decimal(16,9),
  BrandID          int UNSIGNED NULL,
  FinalSupplierID  int UNSIGNED NULL,
  primary key (id)
);

alter table dd_arrivalnotice comment '到货单';

/*==============================================================*/
/* Table: dd_arrivalnotice_detail                               */
/*==============================================================*/
create table dd_arrivalnotice_detail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ArrivalID        int UNSIGNED NULL,
  DetailID         int UNSIGNED NULL,
  ProductID        int UNSIGNED NULL,
  SizeID           int UNSIGNED NULL,
  Number           int,
  CurrencyID       int UNSIGNED NULL,
  Price            decimal(16,9),
  Cost             decimal(16,9),
  cjj              decimal(16,9),
  yj               decimal(16,9),
  primary key (id)
);

alter table dd_arrivalnotice_detail comment '到货单明细';

/*==============================================================*/
/* Table: dd_confirmorder                                       */
/*==============================================================*/
create table dd_confirmorder
(
  id                 int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff   int UNSIGNED NOT NULL,
  sys_create_date    datetime    not null,
  sys_modify_stuff   int UNSIGNED NOT NULL,
  sys_modify_date    datetime    not null,
  sys_delete_stuff   int UNSIGNED NULL,
  sys_delete_date    datetime,
  sys_delete_flag    tinyint     not null comment '0-未删除 1-已删除',

  OrderNo            varchar(50),
  MakeDate           datetime,
  MakeStaff          varchar(36),
  SupplierID         int UNSIGNED NOT NULL,
  CurrencyID         int UNSIGNED NULL,
  Total              decimal(16,9),
  IsStatus           varchar(1) comment '0-在途未入库，1-已入库，2-已备货未发出',
  Remark             varchar(200),
  BrandID            INT UNSIGNED NULL,
  Season             varchar(36),
  SeasonType         varchar(1) comment '0-Pre ,1-Main ,2-Fashion show',
  AuditStaff         varchar(36),
  AuditDate          datetime,
  AuditStatus        varchar(1),
  ExchangeRate       decimal(16,9),
  FinalSupplierID    INT UNSIGNED NULL,
  FlightNo           varchar(50),
  FlightDate         datetime,
  ArrivalDate        datetime,
  MBLNO              varchar(50),
  HBLNO              varchar(50),
  DispatchPort       varchar(50),
  DeliveryPort       varchar(50),
  TransCompany       varchar(36),
  IsExamination      varchar(1),
  ExaminationResult  varchar(50),
  ClearanceDate      datetime,
  PickingDate        datetime,
  MotorTransportPool varchar(50),
  WarehouseID        INT UNSIGNED NULL,
  Ctns               decimal(16,9),
  Kgs                decimal(16,9),
  Cbm                decimal(16,9),
  IsSJYH             varchar(1),
  SellerID           INT UNSIGNED NOT NULL,
  SJYHResult         varchar(50),
  BuyerID            INT UNSIGNED NOT NULL,
  TransportType      varchar(1) comment '0-BY AIR 1-快递 2-中转',
  PayType            varchar(1) comment '0- T/T',
  Property           varchar(1) comment '0-自采 1-代销',
  PayoutPercentage   varchar(10),
  PickingAddress     text,
  ChargedWeight      decimal(16,9),
  PayDate            datetime,
  aPickingDate       datetime,
  aArrivalDate       datetime,
  InvoiceNo          varchar(50),
  DD_Company         varchar(36) not null,
  primary key (id)
);

alter table dd_confirmorder comment '发货单';

/*==============================================================*/
/* Table: dd_corder_ctn                                         */
/*==============================================================*/
create table dd_corder_ctn
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CorderID         int UNSIGNED NULL,
  CtnNo            varchar(50),
  Length           decimal(16,9),
  Width            decimal(16,9),
  Height           decimal(16,9),
  Weight           decimal(16,9),
  CBM              decimal(16,9),
  Remark           varchar(500),
  primary key (id)
);

alter table dd_corder_ctn comment '发货单装箱信息';

/*==============================================================*/
/* Table: dd_corder_temp                                        */
/*==============================================================*/
create table dd_corder_temp
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CorderID         int UNSIGNED NULL,
  cDetailID        int UNSIGNED NULL,
  DetailID         int UNSIGNED NULL,
  ProductID        int UNSIGNED NULL,
  SizeID           int UNSIGNED NULL,
  aNumber          int,
  TM               varchar(50),
  CurrencyID       int UNSIGNED NULL,
  Price            decimal(16,9),
  primary key (id)
);

alter table dd_corder_temp comment '发货单入库快照';

/*==============================================================*/
/* Table: dd_corderdetails                                      */
/*==============================================================*/
create table dd_corderdetails
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CorderID         int UNSIGNED NULL,
  DetailID         int UNSIGNED NULL,
  ProductID        int UNSIGNED NULL,
  SizeID           int UNSIGNED NULL,
  Number           int,
  CurrencyID       int UNSIGNED NULL,
  Price            decimal(16,9),
  Cost             decimal(16,9),
  ActualNumber     int,
  IsStatus         varchar(1) comment '0-未完成
            1-完成',
  ContainerNo      varchar(500),
  cjj              decimal(16,9),
  yj               decimal(16,9),
  Size             varchar(50),
  Weight           varchar(50),
  primary key (id)
);

alter table dd_corderdetails comment '发货单明细';

/*==============================================================*/
/* Table: dd_fee                                                */
/*==============================================================*/
create table dd_fee
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Dd_ID            int UNSIGNED NULL,
  FeeID            int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  UnitPrice        decimal(10,2),
  Amount           decimal(10,2),
  Sum              decimal(10,2),
  SFCompany        varchar(36),
  SorF             varchar(1) comment 'S-收 F-付',
  ApplyFlag        varchar(1) comment '0-未申请 1-已申请',
  ApplyID          int UNSIGNED NULL,
  GoodsTotal       decimal(10,2),
  Deduct           decimal(10,2),
  ActuallyPaid     decimal(10,2),
  Amortized        tinyint,
  ExchangeRate     decimal(16,9),
  StandarySum      decimal(10,2),
  primary key (id)
);

alter table dd_fee comment '供应链费用';

/*==============================================================*/
/* Table: dd_order                                              */
/*==============================================================*/
create table dd_order
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  BussinesstypeID  int UNSIGNED NULL,
  MakeDate         datetime,
  MakeStaff        varchar(36),
  SupplierID       int UNSIGNED NOT NULL,
  FinalSupplierID  int UNSIGNED NULL,
  BookingID        int UNSIGNED NULL,
  AgentID          int UNSIGNED NULL,
  PurchaseDept     varchar(36),
  BrandID          int UNSIGNED NOT NULL,
  OrderNo          varchar(50),
  Total            decimal(16,9),
  CurrencyID       int UNSIGNED NULL,
  AuditStaff       varchar(36),
  AuditDate        datetime,
  OrderCode        varchar(50),
  WorldOrderCode   varchar(50),
  AuditStatus      varchar(1),
  IsStatus         varchar(1) comment '0-未完结 1-已完结',
  ForM             varchar(2) comment 'F-女款，M-男款,FM男款/女款',
  Remark           varchar(200),
  Contactor        varchar(200),
  OurContactor     varchar(200),
  Season           varchar(36),
  SeasonType       varchar(1) comment '0-Pre ,1-Main ,2-Fashion show',
  InvoiceNo        varchar(50),
  DdType           varchar(1) comment '0-客户订单，1-品牌订单',
  MOrderID         int UNSIGNED NULL,
  ExchangeRate     decimal(16,9),
  Bussinesstype    varchar(1) comment '0-期货 1-现货',
  zkl              decimal(16,9),
  tsl              decimal(16,9),
  Property         varchar(1) comment '0-自采 1-代销',
  primary key (id)
);

alter table dd_order comment '订单主表';

/*==============================================================*/
/* Table: dd_ordercode                                          */
/*==============================================================*/
create table dd_ordercode
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Year             varchar(5),
  Code             varchar(10),
  primary key (id)
);

alter table dd_ordercode comment '订单号表';

/*==============================================================*/
/* Table: dd_orderdetails                                       */
/*==============================================================*/
create table dd_orderdetails
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  OrderID          int UNSIGNED NULL,
  SizeID           int UNSIGNED NULL,
  Number           int,
  ProductID        int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  Price            decimal(16,9),
  ActualNumber     int,
  IsStatus         varchar(1) comment '0-未完成
            1-完成',
  Cost             decimal(16,9),
  CbType           varchar(1),
  Zkl              decimal(16,9),
  Tsbl             decimal(16,9),
  cjj              decimal(16,9),
  yj               decimal(16,9),
  SortNum          int,
  zje              decimal(16,9),
  Add_Flag         varchar(1),
  ThatTimeStock    int,
  primary key (id)
);

alter table dd_orderdetails comment '订单明细';

/*==============================================================*/
/* Table: dd_quotation                                          */
/*==============================================================*/
create table dd_quotation
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SupplierID       int UNSIGNED NULL,
  ForM             varchar(1) comment 'F-女款，M-男款',
  Year_season      varchar(10),
  Rate             decimal(16,9),
  Remark           varchar(1000),
  FileName         varchar(100),
  S_FileName       varchar(100) comment '在服务器上的文件名',
  primary key (id)
);

alter table dd_quotation comment '报价单主表';

/*==============================================================*/
/* Table: dd_quotation_detail                                   */
/*==============================================================*/
create table dd_quotation_detail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  QuotationID      int UNSIGNED NULL,
  ProductID        int UNSIGNED NULL,
  OrderNumber      int,
  Pic1             longblob,
  Pic2             longblob,
  Pic3             longblob,
  Pic4             longblob,
  Price            decimal(16,9),
  Item             varchar(100),
  SizeID           int UNSIGNED NULL,
  Remark           varchar(1000),
  SaveSize         varchar(50),
  primary key (id)
);

alter table dd_quotation_detail comment '报价单明细表';

/*==============================================================*/
/* Table: if_cfashion                                           */
/*==============================================================*/
create table if_cfashion
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CreationTime     datetime,
  ProductID        int UNSIGNED NULL,
  CurrencyUnit     varchar(50),
  Description      text,
  MPrice           decimal(18,0),
  Price            decimal(18,0),
  del              int,
  OperationType    int comment '0-添加 1-修改',
  ReturnState      int,
  ReturnText       text,
  CPrice           decimal(18,0),
  SourceFunction   varchar(50),
  SizeID           int UNSIGNED NULL,
  sku              varchar(50),
  Stockchange      varchar(500),
  ImgList          text,
  primary key (id)
);

alter table if_cfashion comment '迷橙接口数据表';

/*==============================================================*/
/* Table: if_exception                                          */
/*==============================================================*/
create table if_exception
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  OperationType    int comment '0-添加 1-修改',
  ASACode          varchar(50),
  Exception        char(1),
  SizeID           int UNSIGNED NULL,
  primary key (id)
);

alter table if_exception comment '库存变动日志数据表';

/*==============================================================*/
/* Table: if_imgorder                                           */
/*==============================================================*/
create table if_imgorder
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  IfID             INT UNSIGNED NULL comment '0-添加 1-修改',
  NumOrder         int,
  ImgName          char(1),
  Imgsize          varchar(50),
  ImgType          varchar(50) comment '缩略图，详细图',
  primary key (id)
);

alter table if_imgorder comment '上传图片顺序';

/*==============================================================*/
/* Table: if_jingdong                                           */
/*==============================================================*/
create table if_jingdong
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CreationTime     datetime,
  ProductID        int UNSIGNED NULL,
  CurrencyUnit     varchar(50),
  Description      text,
  MPrice           decimal(18,0),
  Price            decimal(18,0),
  del              int,
  OperationType    int comment '0-添加 1-修改',
  ReturnState      int,
  ReturnText       text,
  CPrice           decimal(18,0),
  SourceFunction   varchar(50),
  sku              varchar(50),
  Stockchange      varchar(500),
  ImgList          text,
  ExternalNo       varchar(50),
  SizeID           int UNSIGNED NULL,
  primary key (id)
);

alter table if_jingdong comment '京东接口数据表';

/*==============================================================*/
/* Table: if_meilihui                                           */
/*==============================================================*/
create table if_meilihui
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CreationTime     datetime,
  ProductID        int UNSIGNED NULL,
  CurrencyUnit     varchar(50),
  Description      text,
  MPrice           decimal(18,0),
  Price            decimal(18,0),
  del              int,
  OperationType    int comment '0-添加 1-修改',
  ReturnState      int,
  ReturnText       text,
  CPrice           decimal(18,0),
  SourceFunction   varchar(50),
  SizeID           int UNSIGNED NULL,
  sku              varchar(50),
  Stockchange      varchar(500),
  ImgList          text,
  primary key (id)
);

alter table if_meilihui comment '魅力惠接口数据表';

/*==============================================================*/
/* Table: if_meixi                                              */
/*==============================================================*/
create table if_meixi
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CreationTime     datetime,
  ProductID        int UNSIGNED NULL,
  CurrencyUnit     varchar(50),
  Description      text,
  MPrice           decimal(18,0),
  Price            decimal(18,0),
  del              int,
  OperationType    int comment '0-添加 1-修改',
  ReturnState      int comment '0-未处理
            1-处理成功
            2-异常',
  ReturnText       text,
  CPrice           decimal(18,0),
  SourceFunction   varchar(50),
  sku              varchar(50),
  Stockchange      varchar(500),
  ImgList          text,
  primary key (id)
);

alter table if_meixi comment '美西接口数据表';

/*==============================================================*/
/* Table: if_ofashion                                           */
/*==============================================================*/
create table if_ofashion
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CreationTime     datetime,
  ProductID        int UNSIGNED NULL,
  CurrencyUnit     varchar(50),
  Description      text,
  MPrice           decimal(18,0),
  Price            decimal(18,0),
  del              int,
  OperationType    int comment '0-添加 1-修改',
  ReturnState      int,
  ReturnText       text,
  CPrice           decimal(18,0),
  SourceFunction   varchar(50),
  SizeID           int UNSIGNED NULL,
  sku              varchar(50),
  Stockchange      varchar(500),
  ImgList          text,
  primary key (id)
);

alter table if_ofashion comment '迷橙接口数据表';

/*==============================================================*/
/* Table: if_shangpin                                           */
/*==============================================================*/
create table if_shangpin
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CreationTime     datetime,
  ProductID        int UNSIGNED NULL,
  CurrencyUnit     varchar(50),
  Description      text,
  MPrice           decimal(18,0),
  Price            decimal(18,0),
  del              int,
  OperationType    int comment '0-添加 1-修改',
  ReturnState      int,
  ReturnText       text,
  CPrice           decimal(18,0),
  SourceFunction   varchar(50),
  SizeID           int UNSIGNED NULL,
  sku              varchar(50),
  Stockchange      varchar(500),
  ImgList          text,
  primary key (id)
);

alter table if_shangpin comment '尚品接口数据表';

/*==============================================================*/
/* Table: if_shangpin_direct                                    */
/*==============================================================*/
create table if_shangpin_direct
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CreationTime     datetime,
  ProductID        int UNSIGNED NULL,
  CurrencyUnit     varchar(50),
  Description      text,
  MPrice           decimal(18,0),
  Price            decimal(18,0),
  del              int,
  OperationType    int comment '0-添加 1-修改',
  ReturnState      int,
  ReturnText       text,
  CPrice           decimal(18,0),
  SourceFunction   varchar(50),
  SizeID           int UNSIGNED NULL,
  sku              varchar(50),
  Stockchange      varchar(500),
  ImgList          text,
  CategoryNo       varchar(50),
  primary key (id)
);

alter table if_shangpin_direct comment '尚品直发接口数据表';

/*==============================================================*/
/* Table: if_siku                                               */
/*==============================================================*/
create table if_siku
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CreationTime     datetime,
  ProductID        int UNSIGNED NULL,
  SizeID           int UNSIGNED NULL,
  SalesID          int UNSIGNED NULL,
  OperationType    int comment '0-添加 1-修改',
  ReturnState      int,
  ReturnText       text,
  SourceFunction   varchar(50),
  sku              varchar(50),
  Stockchange      int,
  ImgList          text,
  primary key (id)
);

alter table if_siku comment '美西接口数据表';

/*==============================================================*/
/* Table: if_sxdzb                                              */
/*==============================================================*/
create table if_sxdzb
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  ZpID             bigint,
  primary key (id)
);

alter table if_sxdzb comment '珍品上传商品对照';

/*==============================================================*/
/* Table: if_zhenpin                                            */
/*==============================================================*/
create table if_zhenpin
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CreationTime     datetime,
  ProductID        int UNSIGNED NULL,
  OperationType    int comment '0-添加 1-修改',
  ReturnState      int,
  ReturnText       text,
  SourceFunction   varchar(50),
  sku              varchar(50),
  Stockchange      int,
  ImgList          text,
  CurrencyUnit     varchar(50),
  MPrice           varchar(50),
  Price            varchar(50),
  CPrice           varchar(50),
  Description      text,
  primary key (id)
);

alter table if_zhenpin comment '珍品接口数据表';

/*==============================================================*/
/* Table: if_zouxiu                                             */
/*==============================================================*/
create table if_zouxiu
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CreationTime     datetime,
  ProductID        int UNSIGNED NULL,
  OperationType    int comment '0-添加 1-修改',
  ReturnState      int,
  ReturnText       text,
  MPrice           decimal(18,0),
  Price            decimal(18,0),
  Description      text,
  CurrencyUnit     varchar(50),
  SourceFunction   varchar(50),
  sku              varchar(50),
  Stockchange      int,
  ImgList          text,
  primary key (id)
);

alter table if_zouxiu comment '美西接口数据表';

/*==============================================================*/
/* Table: link_actual_to_productstock                           */
/*==============================================================*/
create table link_actual_to_productstock
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductstockID   int UNSIGNED NULL,
  ActualID         int UNSIGNED NULL,
  primary key (id)
);

alter table link_actual_to_productstock comment '实盘单到库存之间的记录';

/*==============================================================*/
/* Table: link_barcode_to_size                                  */
/*==============================================================*/
create table link_barcode_to_size
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SizeID           int UNSIGNED NULL,
  ProductID        int UNSIGNED NULL,
  BarCode          varchar(50),
  primary key (id)
);

alter table link_barcode_to_size comment '任何表都应该包含的列';

/*==============================================================*/
/* Table: link_brand_to_brandgroup                              */
/*==============================================================*/
create table link_brand_to_brandgroup
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  BrandID          int UNSIGNED NULL,
  GroupID          int UNSIGNED NULL,
  BrandGroupID     int UNSIGNED NULL,
  Note             varchar(50),
  primary key (id)
);

alter table link_brand_to_brandgroup comment '任何表都应该包含的列';

/*==============================================================*/
/* Table: link_brand_to_discount                                */
/*==============================================================*/
create table link_brand_to_discount
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  BrandID          int UNSIGNED NULL,
  Decade           varchar(36),
  GroupID          int UNSIGNED NULL,
  BrandGroupID     int UNSIGNED NULL,
  Discount         decimal(10,2),
  Gender           varchar(1) comment '0-女式 1-男士 2-中性',
  Note             varchar(50),
  primary key (id)
);

alter table link_brand_to_discount comment '品牌出厂价折扣';

/*==============================================================*/
/* Table: link_brand_to_priced                                  */
/*==============================================================*/
create table link_brand_to_priced
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  BrandTypeID      int UNSIGNED NULL,
  Priced           decimal(19,6),
  BrandID          int UNSIGNED NULL,
  PriceID          int UNSIGNED NULL,
  PricedMark       varchar(1) comment '0 - 欧洲零售价
            1 - 欧洲出厂价',
  Symbol           varchar(2),
  IsRounded        varchar(1) comment '0- 0-20 取0 ,21-70 取50,71-99 取100
            1-0-1取0，1-6取5，6-9取10
            2.不取整',
  Decade           varchar(36),
  CurrencyID       int UNSIGNED NULL,
  primary key (id)
);

alter table link_brand_to_priced comment '任何表都应该包含的列';

/*==============================================================*/
/* Table: link_brandgroup_to_supplier                           */
/*==============================================================*/
create table link_brandgroup_to_supplier
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SupplierID       int UNSIGNED NULL,
  BrandGroupID     int UNSIGNED NULL,
  Decade           varchar(36),
  Markup           decimal(10,2),
  CurrencyID       int UNSIGNED NULL,
  Sum              decimal(10,2),
  primary key (id)
);

alter table link_brandgroup_to_supplier comment '供货商品类连接表';

/*==============================================================*/
/* Table: link_cdetail_to_ddetail                               */
/*==============================================================*/
create table link_cdetail_to_ddetail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  cDetailID        int UNSIGNED NULL,
  ddetailID        varchar(36),
  primary key (id)
);

alter table link_cdetail_to_ddetail comment '连接表 发货单明细 to 报关明细';

/*==============================================================*/
/* Table: link_childbrand_to_execution                          */
/*==============================================================*/
create table link_childbrand_to_execution
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ChildBrandID     varchar(36),
  ExecutionID      varchar(36),
  primary key (id)
);

alter table link_childbrand_to_execution comment '任何表都应该包含的列';

/*==============================================================*/
/* Table: link_childbrand_to_innards                            */
/*==============================================================*/
create table link_childbrand_to_innards
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ChildBrandID     varchar(36),
  InnardsID        varchar(36),
  primary key (id)
);

alter table link_childbrand_to_innards comment '连接表 子品类 to 内部结构';

/*==============================================================*/
/* Table: link_childbrand_to_material                           */
/*==============================================================*/
create table link_childbrand_to_material
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ChildBrandID     varchar(36),
  MaterialID       varchar(36),
  HGCode           varchar(50),
  TaxRate          decimal(16,9),
  Sex              varchar(1) comment '0-女式 1-男士(中性也算男士)',
  IsFJ             varchar(1) comment '0-否 1-法检',
  primary key (id)
);

alter table link_childbrand_to_material comment '连接表 子品类 to 材质';

/*==============================================================*/
/* Table: link_childbrand_to_outinnards                         */
/*==============================================================*/
create table link_childbrand_to_outinnards
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ChildBrandID     varchar(36),
  OutInnardsID     varchar(36),
  primary key (id)
);

alter table link_childbrand_to_outinnards comment '连接表 子品类 to 外部结构';

/*==============================================================*/
/* Table: link_childbrand_to_safety                             */
/*==============================================================*/
create table link_childbrand_to_safety
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ChildBrandID     varchar(36),
  SafetyID         varchar(36),
  primary key (id)
);

alter table link_childbrand_to_safety comment '任何表都应该包含的列';

/*==============================================================*/
/* Table: link_color_to_brand                                   */
/*==============================================================*/
create table link_color_to_brand
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ColorID          int UNSIGNED NULL,
  BrandID          int UNSIGNED NULL,
  ColorName        varchar(50),
  ColorCode        varchar(50),
  primary key (id)
);

alter table link_color_to_brand comment '连接表 颜色模板与品牌链接的关系';

/*==============================================================*/
/* Table: link_contacts_to_supplier                             */
/*==============================================================*/
create table link_contacts_to_supplier
(
  id                int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff  int UNSIGNED NOT NULL,
  sys_create_date   datetime not null,
  sys_modify_stuff  int UNSIGNED NOT NULL,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int UNSIGNED NULL,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  supplierid        varchar(36),
  companycontactsid varchar(36),
  primary key (id)
);

alter table link_contacts_to_supplier comment '表暂时未使用';

/*==============================================================*/
/* Table: link_ctn_to_cdetail                                   */
/*==============================================================*/
create table link_ctn_to_cdetail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  cOrderDetailID   varchar(36),
  CtnID            varchar(36),
  Sum              int,
  primary key (id)
);

alter table link_ctn_to_cdetail comment '装箱单 发货单明细 连接表';

/*==============================================================*/
/* Table: link_data_to_file                                     */
/*==============================================================*/
create table link_data_to_file
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  DataID           varchar(36) comment '上传附件的相关数据ID，例如：订单ID等',
  PictureName      varchar(500),
  PicturePath      varchar(500) comment '带文件名，取文件完整路径=FTP+/+路径',
  ServerName       varchar(100),
  FileType         varchar(2) comment '0.-一般文件
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
);

alter table link_data_to_file comment '连接表 数据 to 文件（上传附件）';

/*==============================================================*/
/* Table: link_department_to_salesport                          */
/*==============================================================*/
create table link_department_to_salesport
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  DepartmentID     int UNSIGNED NULL,
  SportID          int UNSIGNED NULL,
  primary key (id)
);

alter table link_department_to_salesport comment '销售端口部门连接表';

/*==============================================================*/
/* Table: link_detail_to_detail                                 */
/*==============================================================*/
create table link_detail_to_detail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  pDetailID        varchar(36),
  cDetailID        int UNSIGNED NULL,
  Sum              int,
  primary key (id)
);

alter table link_detail_to_detail comment '品牌订单 客户订单连接表';

/*==============================================================*/
/* Table: link_distribute_to_cdetail                            */
/*==============================================================*/
create table link_distribute_to_cdetail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  cOrderDetailID   varchar(36),
  DstributeID      varchar(36),
  Sum              int,
  primary key (id)
);

alter table link_distribute_to_cdetail comment '分货单 发货单明细 连接表';

/*==============================================================*/
/* Table: link_group_to_navigation                              */
/*==============================================================*/
create table link_group_to_navigation
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  GroupID          int UNSIGNED NULL,
  navigationid     varchar(36),
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  primary key (id)
);

alter table link_group_to_navigation comment '组导航连接表';

/*==============================================================*/
/* Table: link_invoice_to_order                                 */
/*==============================================================*/
create table link_invoice_to_order
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  InvoiceID        varchar(36),
  OrderID          int UNSIGNED NULL,
  OrderSum         decimal(19,6),
  primary key (id)
);

alter table link_invoice_to_order comment '连接表 运费发票 to 发货单';

/*==============================================================*/
/* Table: link_invoice_to_requisition                           */
/*==============================================================*/
create table link_invoice_to_requisition
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  InvoiceID        varchar(36),
  RequisitionID    int UNSIGNED NULL,
  Type             varchar(1) comment '0-按金额 1-按件数',
  primary key (id)
);

alter table link_invoice_to_requisition comment '连接表 运费发票 to 调拨单';

/*==============================================================*/
/* Table: link_invoice_to_warehousing                           */
/*==============================================================*/
create table link_invoice_to_warehousing
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  InvoiceID        varchar(36),
  WarehousingID    int UNSIGNED NULL,
  Type             varchar(1) comment '0-按金额 1-按件数',
  primary key (id)
);

alter table link_invoice_to_warehousing comment '连接表 运费发票 to 入库单';

/*==============================================================*/
/* Table: link_kp_to_store                                      */
/*==============================================================*/
create table link_kp_to_store
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  KPID             int UNSIGNED NULL,
  ProductstockID   int UNSIGNED NULL,
  primary key (id)
);

alter table link_kp_to_store comment '开票库存链接表';

/*==============================================================*/
/* Table: link_prep_to_productstock                             */
/*==============================================================*/
create table link_prep_to_productstock
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductstockID   int UNSIGNED NULL,
  PrepID           varchar(36),
  primary key (id)
);

alter table link_prep_to_productstock comment '预盘单到库存之间的记录';

/*==============================================================*/
/* Table: link_pricelist_to_salesport                           */
/*==============================================================*/
create table link_pricelist_to_salesport
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  PriceListID      int UNSIGNED NULL,
  SportID          int UNSIGNED NULL,
  primary key (id)
);

alter table link_pricelist_to_salesport comment '连接表 价格单 to 销售端口';

/*==============================================================*/
/* Table: link_product_to_MaterislStatus                        */
/*==============================================================*/
create table link_product_to_MaterislStatus
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  MaterislStatusID varchar(36),
  primary key (id)
);

alter table link_product_to_MaterislStatus comment '连接表 商品表与材质状态';

/*==============================================================*/
/* Table: link_product_to_SalesNature                           */
/*==============================================================*/
create table link_product_to_SalesNature
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  SalesNatureID    varchar(36),
  primary key (id)
);

alter table link_product_to_SalesNature comment '销售性质连接表';

/*==============================================================*/
/* Table: link_product_to_closedway                             */
/*==============================================================*/
create table link_product_to_closedway
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  ClosedWayID      varchar(36),
  primary key (id)
);

alter table link_product_to_closedway comment '连接表 商品 to 闭合方式';

/*==============================================================*/
/* Table: link_product_to_decade                                */
/*==============================================================*/
create table link_product_to_decade
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  DecadeID         int UNSIGNED NOT NULL,
  primary key (id)
);

alter table link_product_to_decade comment '商品表连接 年代季节';

/*==============================================================*/
/* Table: link_product_to_dscrb                                 */
/*==============================================================*/
create table link_product_to_dscrb
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  DscrbID          varchar(36),
  primary key (id)
);

alter table link_product_to_dscrb comment '商品表连接 商品描述';

/*==============================================================*/
/* Table: link_product_to_marketprice                           */
/*==============================================================*/
create table link_product_to_marketprice
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  Price            decimal(16,9),
  PriceResource    char(1),
  HistoryFlag      varchar(1) comment '0-当前记录 1-历史记录',
  Rate             decimal(16,9),
  ApplyPrice       decimal(16,9),
  ApplyStatus      varchar(1) comment '0-已申请
            1-审批通过
            2-驳回',
  PriceResourceID  varchar(36),
  ApplyDate        datetime,
  ReplyDate        datetime,
  PriceID          int UNSIGNED NULL,
  primary key (id)
);

alter table link_product_to_marketprice comment '商品表连接 市场价格';

/*==============================================================*/
/* Table: link_product_to_material                              */
/*==============================================================*/
create table link_product_to_material
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  MaterialID       varchar(36),
  Percentage       varchar(50),
  Note             varchar(36),
  primary key (id)
);

alter table link_product_to_material comment '连接表 商品 to 材质';

/*==============================================================*/
/* Table: link_product_to_material2                             */
/*==============================================================*/
create table link_product_to_material2
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  MaterialID       varchar(36),
  Percentage       varchar(50),
  Note             varchar(36),
  primary key (id)
);

alter table link_product_to_material2 comment '连接表 商品 to 材质2';

/*==============================================================*/
/* Table: link_product_to_occasions                             */
/*==============================================================*/
create table link_product_to_occasions
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  OccasionsID      varchar(36),
  primary key (id)
);

alter table link_product_to_occasions comment '连接表 商品 to 场合风格';

/*==============================================================*/
/* Table: link_product_to_origin                                */
/*==============================================================*/
create table link_product_to_origin
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  OriginID         varchar(36),
  primary key (id)
);

alter table link_product_to_origin comment '商品表连接 产地';

/*==============================================================*/
/* Table: link_product_to_outproductinnards                     */
/*==============================================================*/
create table link_product_to_outproductinnards
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  InnardsID        varchar(36),
  Sum              int,
  primary key (id)
);

alter table link_product_to_outproductinnards comment '连接表 商品 to 外部结构';

/*==============================================================*/
/* Table: link_product_to_picture                               */
/*==============================================================*/
create table link_product_to_picture
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  PictureID        varchar(36),
  pictureType      varchar(500),
  SizeType         int,
  primary key (id)
);

alter table link_product_to_picture comment '图片表';

/*==============================================================*/
/* Table: link_product_to_picture_ftp                           */
/*==============================================================*/
create table link_product_to_picture_ftp
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  PictureName      varchar(500),
  PicturePath      varchar(1000),
  PictureSize      varchar(1) comment '1-750*750
            2-800*800
            3-1200*1200',
  UpLoadFlag       varchar(1) comment '0-无需上传，1-需要上传',
  primary key (id)
);

alter table link_product_to_picture_ftp comment '连接表 商品 to FTp图片';

/*==============================================================*/
/* Table: link_product_to_price                                 */
/*==============================================================*/
create table link_product_to_price
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  PriceID          int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  Price            decimal(10,2),
  ProductID        int UNSIGNED NULL,
  Jsfs             varchar(100),
  BasePrice        decimal(10,2),
  ExchangeRate     decimal(16,9),
  Rate             decimal(10,2),
  Symbol           varchar(1),
  LockStatus       varchar(1) comment '0-未锁定 1-锁定',
  primary key (id)
);

alter table link_product_to_price comment '连接表 商品 商品销售价格(国内外零售价、批发价格)';

/*==============================================================*/
/* Table: link_product_to_price2                                */
/*==============================================================*/
create table link_product_to_price2
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  PriceID          int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  Price            decimal(10,2),
  ProductID        int UNSIGNED NULL,
  Jsfs             varchar(100),
  primary key (id)
);

alter table link_product_to_price2 comment '连接表 商品 商品销售价格(国内外零售价、批发价格)';

/*==============================================================*/
/* Table: link_product_to_price_history                         */
/*==============================================================*/
create table link_product_to_price_history
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  PriceID          int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  Price            decimal(10,2),
  ProductID        int UNSIGNED NULL,
  ActionType       varchar(1) comment '0-添加 1-修改',
  BasePrice        decimal(10,2),
  ExchangeRate     decimal(16,9),
  Rate             decimal(10,2),
  Symbol           varchar(1),
  primary key (id)
);

alter table link_product_to_price_history comment '连接表 商品 商品销售价格(国内外零售价、批发价格) 历史记录';

/*==============================================================*/
/* Table: link_product_to_productinnards                        */
/*==============================================================*/
create table link_product_to_productinnards
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  InnardsID        varchar(36),
  Sum              int,
  primary key (id)
);

alter table link_product_to_productinnards comment '连接表 商品 to 内部结构';

/*==============================================================*/
/* Table: link_product_to_productparts                          */
/*==============================================================*/
create table link_product_to_productparts
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  PartsID          varchar(36),
  primary key (id)
);

alter table link_product_to_productparts comment '连接表 商品 to 附带配件';

/*==============================================================*/
/* Table: link_product_to_salesport                             */
/*==============================================================*/
create table link_product_to_salesport
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  SportID          int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  Price            decimal(16,9),
  Discount         decimal(16,9),
  SellSpotName     varchar(100),
  primary key (id)
);

alter table link_product_to_salesport comment '销售端口商品连接表';

/*==============================================================*/
/* Table: link_product_to_salesport_history                     */
/*==============================================================*/
create table link_product_to_salesport_history
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  SportID          int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  Price            decimal(16,9),
  ActionType       char(10) comment '0-添加
            1-修改',
  Discount         decimal(16,9),
  primary key (id)
);

alter table link_product_to_salesport_history comment '销售端口商品连接 历史记录表';

/*==============================================================*/
/* Table: link_product_to_size                                  */
/*==============================================================*/
create table link_product_to_size
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  SizeID           int UNSIGNED NULL,
  JDCode           varchar(50),
  SpotID           varchar(36) comment '空就是京东',
  primary key (id)
);

alter table link_product_to_size comment '连接表 商品 to 尺码';

/*==============================================================*/
/* Table: link_product_to_washinginstructions                   */
/*==============================================================*/
create table link_product_to_washinginstructions
(
  id                    int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff      int UNSIGNED NOT NULL,
  sys_create_date       datetime not null,
  sys_modify_stuff      int UNSIGNED NOT NULL,
  sys_modify_date       datetime not null,
  sys_delete_stuff      int UNSIGNED NULL,
  sys_delete_date       datetime,
  sys_delete_flag       tinyint  not null comment '0-未删除 1-已删除',

  ProductID             int UNSIGNED NULL,
  WashinginstructionsID int UNSIGNED NULL,
  primary key (id)
);

alter table link_product_to_washinginstructions comment '连接表 商品 to 洗涤标准';

/*==============================================================*/
/* Table: link_pzh_to_invoice                                   */
/*==============================================================*/
create table link_pzh_to_invoice
(
  id                int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff  int UNSIGNED NOT NULL,
  sys_create_date   datetime not null,
  sys_modify_stuff  int UNSIGNED NOT NULL,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int UNSIGNED NULL,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  InvoiceID         int UNSIGNED NULL,
  PzhID             varchar(36),
  InvoiceCurrencyID varchar(36),
  InvoiceSum        decimal(16,9),
  PzhCurrencyID     varchar(36),
  PzhSum            decimal(16,9),
  ExchangeRate      decimal(16,9),
  primary key (id)
);

alter table link_pzh_to_invoice comment '连接表 凭证表 to 普通发票';

/*==============================================================*/
/* Table: link_pzh_to_invoicefee                                */
/*==============================================================*/
create table link_pzh_to_invoicefee
(
  id                int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff  int UNSIGNED NOT NULL,
  sys_create_date   datetime not null,
  sys_modify_stuff  int UNSIGNED NOT NULL,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int UNSIGNED NULL,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  InvoiceID         int UNSIGNED NULL,
  PzhID             varchar(36),
  InvoiceCurrencyID varchar(36),
  InvoiceSum        decimal(16,9),
  PzhCurrencyID     varchar(36),
  PzhSum            decimal(16,9),
  ExchangeRate      decimal(16,9),
  primary key (id)
);

alter table link_pzh_to_invoicefee comment '连接表 凭证表 to 运费发票';

/*==============================================================*/
/* Table: link_pzh_to_order                                     */
/*==============================================================*/
create table link_pzh_to_order
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  OrderID          int UNSIGNED NULL,
  pzhid            int UNSIGNED NULL,
  OrderCurrencyID  varchar(36),
  OrderSum         decimal(16,9),
  PzhCurrencyID    varchar(36),
  PzhSum           decimal(16,9),
  primary key (id)
);

alter table link_pzh_to_order comment '连接表 凭证表 to 订单';

/*==============================================================*/
/* Table: link_pzh_to_sales                                     */
/*==============================================================*/
create table link_pzh_to_sales
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SalesID          int UNSIGNED NULL,
  pzhid            int UNSIGNED NULL,
  SalesCurrencyID  varchar(36),
  SalesSum         decimal(16,9),
  PzhCurrencyID    varchar(36),
  PzhSum           decimal(16,9),
  primary key (id)
);

alter table link_pzh_to_sales comment '连接表 凭证表 to 对账单（回款）';

/*==============================================================*/
/* Table: link_pzh_to_sales_trans                               */
/*==============================================================*/
create table link_pzh_to_sales_trans
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SalesID          int UNSIGNED NULL,
  pzhid            int UNSIGNED NULL,
  SalesCurrencyID  varchar(36),
  SalesSum         decimal(16,9),
  PzhCurrencyID    varchar(36),
  PzhSum           decimal(16,9),
  primary key (id)
);

alter table link_pzh_to_sales_trans comment '连接表 凭证表 to 对账单（转账）';

/*==============================================================*/
/* Table: link_pzh_to_warehousing_fee                           */
/*==============================================================*/
create table link_pzh_to_warehousing_fee
(
  id                       int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff         int UNSIGNED NOT NULL,
  sys_create_date          datetime not null,
  sys_modify_stuff         int UNSIGNED NOT NULL,
  sys_modify_date          datetime not null,
  sys_delete_stuff         int UNSIGNED NULL,
  sys_delete_date          datetime,
  sys_delete_flag          tinyint  not null comment '0-未删除 1-已删除',

  WarehousingFeeID         int UNSIGNED NULL,
  PzhID                    int UNSIGNED NULL,
  WarehousingFeeCurrencyID int UNSIGNED NOT NULL,
  WarehousingFeeSum        decimal(16,9),
  PzhCurrencyID            int UNSIGNED NULL,
  PzhSum                   decimal(16,9),
  primary key (id)
);

alter table link_pzh_to_warehousing_fee comment '连接表 凭证表 to 入库单费用';

/*==============================================================*/
/* Table: link_return_to_productstock                           */
/*==============================================================*/
create table link_return_to_productstock
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductstockID   int UNSIGNED NULL,
  DealPrice        varchar(36),
  GetPoints        int,
  MemberID         int UNSIGNED NULL,
  ReturnID         int UNSIGNED NULL,
  SaleLinkID       int UNSIGNED NULL,
  primary key (id)
);

alter table link_return_to_productstock comment '连接表 退货单 to 库存';

/*==============================================================*/
/* Table: link_rule_to_operation                                */
/*==============================================================*/
create table link_rule_to_operation
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  ruleid           int UNSIGNED NULL,
  operationid      int UNSIGNED NULL,
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  primary key (id)
);

alter table link_rule_to_operation comment '职能功能连接表';

/*==============================================================*/
/* Table: link_sales_to_productstock                            */
/*==============================================================*/
create table link_sales_to_productstock
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductstockID   int UNSIGNED NULL,
  DealPrice        decimal(10,2),
  PriceListID      int UNSIGNED NULL,
  GetPoints        decimal(10,2),
  MemberID         int UNSIGNED NULL,
  SalesID          int UNSIGNED NULL,
  ReturnFlag       varchar(1) comment '0-正常 1-已退货',
  ExpressComoany   varchar(1) comment '0-顺丰 1-德邦 2-京东',
  ExpressNo        varchar(50),
  ExpressFee       decimal(16,9),
  ExpressStatus    varchar(1) comment '0-未发货 1-已发货 2-缺货',
  ExpressUser      varchar(36),
  IsBJ             varchar(1),
  CurrencyID       int UNSIGNED NULL,
  Sum              decimal(16,9),
  PorC             varchar(1) comment '0-预付 1-到付',
  DetailID         int UNSIGNED NULL,
  BGJ              decimal(16,9),
  primary key (id)
);

alter table link_sales_to_productstock comment '销售到库存之间的记录';

/*==============================================================*/
/* Table: link_salespot_to_childbrand                           */
/*==============================================================*/
create table link_salespot_to_childbrand
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SaleSpotID       int UNSIGNED NULL,
  BrandTypeID      int UNSIGNED NULL,
  Rate             decimal(19,6),
  IsRounded        varchar(1) comment '0-不取整 1-取整',
  primary key (id)
);

alter table link_salespot_to_childbrand comment '销售端口 扣点连接表';

/*==============================================================*/
/* Table: link_sellspot_to_brand                                */
/*==============================================================*/
create table link_sellspot_to_brand
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime   not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime   not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint    not null comment '0-未删除 1-已删除',

  sellspotID       int UNSIGNED NOT NULL,
  BrandID          int UNSIGNED NOT NULL,
  level            varchar(1) not null comment 'A
            B
            C
            D',
  primary key (id)
);

alter table link_sellspot_to_brand comment '销售端口品牌连接表';

/*==============================================================*/
/* Table: link_special_to_productstock                          */
/*==============================================================*/
create table link_special_to_productstock
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductstockID   int UNSIGNED NULL,
  SpecialID        int UNSIGNED NOT NULL,
  primary key (id)
);

alter table link_special_to_productstock comment '其他出入库表到库存之间的记录';

/*==============================================================*/
/* Table: link_spot_warehouse                                   */
/*==============================================================*/
create table link_spot_warehouse
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SpotID           int UNSIGNED NULL,
  WarehouseID      int UNSIGNED NULL,
  primary key (id)
);

alter table link_spot_warehouse comment '仓库销售端口连接表';

/*==============================================================*/
/* Table: link_supplier_to_brand                                */
/*==============================================================*/
create table link_supplier_to_brand
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime   not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime   not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint    not null comment '0-未删除 1-已删除',

  SupplierID       int UNSIGNED NOT NULL,
  BrandID          int UNSIGNED NOT NULL,
  level            varchar(1) not null comment 'A
            B
            C
            D',
  Decade           varchar(36),
  Markup           decimal(10,2),
  CurrencyID       int UNSIGNED NULL,
  Sum              decimal(10,2),
  primary key (id)
);

alter table link_supplier_to_brand comment '供货商品牌连接表';

/*==============================================================*/
/* Table: link_user_to_labourcontactor                          */
/*==============================================================*/
create table link_user_to_labourcontactor
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  UserID           int UNSIGNED NULL,
  DateFrom         datetime,
  DataTo           datetime,
  Remark           text,
  primary key (id)
);

alter table link_user_to_labourcontactor comment '员工合同记录';

/*==============================================================*/
/* Table: link_user_to_price                                    */
/*==============================================================*/
create table link_user_to_price
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  UserID           int UNSIGNED NULL,
  PriceID          int UNSIGNED NULL,
  primary key (id)
);

alter table link_user_to_price comment '价格单用户连接表';

/*==============================================================*/
/* Table: link_user_to_reportset                                */
/*==============================================================*/
create table link_user_to_reportset
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  UserID           int UNSIGNED NULL,
  reportID         int UNSIGNED NULL,
  primary key (id)
);

alter table link_user_to_reportset comment '连接表用户与报表样式';

/*==============================================================*/
/* Table: link_user_to_rule                                     */
/*==============================================================*/
create table link_user_to_rule
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  loginid          int UNSIGNED NULL,
  ruleid           int UNSIGNED NULL,
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  primary key (id)
);

alter table link_user_to_rule comment '任何表都应该包含的列';

/*==============================================================*/
/* Table: link_user_to_salesport                                */
/*==============================================================*/
create table link_user_to_salesport
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  UserID           int UNSIGNED NULL,
  SportID          int UNSIGNED NULL,
  primary key (id)
);

alter table link_user_to_salesport comment '销售端口用户连接表';

/*==============================================================*/
/* Table: link_user_to_supplier                                 */
/*==============================================================*/
create table link_user_to_supplier
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  UserID           int UNSIGNED NULL,
  SupplierID       int UNSIGNED NULL,
  primary key (id)
);

alter table link_user_to_supplier comment '连接表用户与结算单位';

/*==============================================================*/
/* Table: link_user_to_warehouse                                */
/*==============================================================*/
create table link_user_to_warehouse
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  UserID           int UNSIGNED NULL,
  WarehouseID      int UNSIGNED NULL,
  primary key (id)
);

alter table link_user_to_warehouse comment '仓库用户连接表';

/*==============================================================*/
/* Table: sys_config                                            */
/*==============================================================*/
create table sys_config
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Code             varchar(100) comment 'FTP-ftp文件服务器ip地址，value值不以/结尾',
  Value            varchar(100),
  Comment          varchar(100),
  primary key (id)
);

alter table sys_config comment '系统参数值备注 Code-文件服务器地址,fileipValue - 文件名';

/*==============================================================*/
/* Table: sys_selfcompany                                       */
/*==============================================================*/
create table sys_selfcompany
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  selfcompanyid    int UNSIGNED NULL,
  primary key (id)
);

alter table sys_selfcompany comment '系统参数值 本公司ID
';

/*==============================================================*/
/* Table: tb_card                                               */
/*==============================================================*/
create table tb_card
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Member_id        int UNSIGNED NULL,
  CardNo           varchar(50),
  PassWord         varchar(50),
  Total            decimal(16,9),
  TelNo            varchar(20),
  Status           varchar(1),
  primary key (id)
);

alter table tb_card comment '消费卡';

/*==============================================================*/
/* Table: tb_check                                              */
/*==============================================================*/
create table tb_check
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  checkNo          varchar(10),
  WarehouseID      int UNSIGNED NULL,
  checker          varchar(36),
  check_flag       tinyint comment '0-生成预盘单
            1-生成实盘单
            2-生成差异单
            3-差异出入库',
  check_date       datetime,
  form_memo        varchar(500),
  primary key (id)
);

alter table tb_check comment '盘点主表';

/*==============================================================*/
/* Table: tb_check_detail                                       */
/*==============================================================*/
create table tb_check_detail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CheckID          int UNSIGNED NULL,
  ProductID        int UNSIGNED NULL,
  SizeID           int UNSIGNED NULL,
  Count            int,
  checkType        varchar(1) comment 'S-实盘 Y-预盘 C-差异',
  form_memo        varchar(500),
  ExcelASACode     varchar(50),
  ExcelSize        varchar(50),
  ExcelCount       varchar(50),
  primary key (id)
);

alter table tb_check_detail comment '盘点明细表';

/*==============================================================*/
/* Table: tb_contactlist                                        */
/*==============================================================*/
create table tb_contactlist
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CorderID         int UNSIGNED NULL,
  addName          varchar(36),
  creationDate     datetime,
  shipper          varchar(50),
  receivingParty   varchar(50),
  brand            varchar(50),
  boxNumber        int,
  number           int,
  weight           decimal(16,9),
  volume           decimal(16,9),
  chargeWeight     decimal(16,9),
  sendOut          varchar(50),
  destination      varchar(50),
  answerID         int UNSIGNED NULL,
  answerDate       datetime,
  dhlWayBlll       varchar(50),
  subBillNo        varchar(500),
  freightPrice     decimal(16,9),
  freightTotal     decimal(16,9),
  notificationTime datetime,
  deliveryTime     datetime,
  arrivalTime      datetime,
  billNo           varchar(50),
  singleType       varchar(1) comment '0-DHL 1-空运',
  Remarks          text,
  FlightNo         varchar(50),
  primary key (id)
);

alter table tb_contactlist comment '发货联系单';

/*==============================================================*/
/* Table: tb_declaration                                        */
/*==============================================================*/
create table tb_declaration
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  No               varchar(50),
  Remark           varchar(1000),
  Date             datetime,
  CorderID         int UNSIGNED NULL,
  PriceRate        decimal(16,9),
  TaxRate          decimal(16,9),
  primary key (id)
);

alter table tb_declaration comment '报关单主表';

/*==============================================================*/
/* Table: tb_declaration_detail                                 */
/*==============================================================*/
create table tb_declaration_detail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  DeclarationID    int UNSIGNED NULL,
  ProductName      varchar(100),
  CurrencyID       int UNSIGNED NULL,
  Price            decimal(16,9),
  Count            int,
  Rate             decimal(16,9),
  CPrice           decimal(16,9),
  Tax              decimal(16,9),
  Cost             decimal(16,9),
  TotalTax         decimal(16,9),
  TotalCost        decimal(16,9),
  primary key (id)
);

alter table tb_declaration_detail comment '报关单明细表';

/*==============================================================*/
/* Table: tb_department                                         */
/*==============================================================*/
create table tb_department
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(100),
  Remark           varchar(1000),
  selfcompanyid    int UNSIGNED NULL,
  Priceid          int UNSIGNED NULL comment '此价格id可以是基础价格id，也可以是销售端口id',
  SpotID           int UNSIGNED NULL,
  up_dp_id         int UNSIGNED NULL,
  CheckingFlag     varchar(1),
  primary key (id)
);

alter table tb_department comment '部门';

/*==============================================================*/
/* Table: tb_discount_card                                      */
/*==============================================================*/
create table tb_discount_card
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Number           varchar(50),
  Amount           decimal(16,9),
  Is_used          varchar(1) comment '0-否 1-是',
  Is_actived       varchar(1) comment '0-否 1-是',
  ActivedID        int UNSIGNED NULL,
  UsedID           int UNSIGNED NULL,
  primary key (id)
);

alter table tb_discount_card comment '优惠卷';

/*==============================================================*/
/* Table: tb_distribute                                         */
/*==============================================================*/
create table tb_distribute
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  DistributeNo     varchar(50),
  Owner            varchar(36),
  Out_id           int UNSIGNED NULL,
  In_id            int UNSIGNED NULL,
  Op_id            int UNSIGNED NULL,
  Op_date          datetime,
  Remark           text,
  primary key (id)
);

alter table tb_distribute comment '分货单主表';

/*==============================================================*/
/* Table: tb_distributecode                                     */
/*==============================================================*/
create table tb_distributecode
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Year             varchar(5),
  Code             varchar(10),
  primary key (id)
);

alter table tb_distributecode comment '分货单号表';

/*==============================================================*/
/* Table: tb_express                                            */
/*==============================================================*/
create table tb_express
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ExpressCompany   varchar(1) comment '0-顺丰 1-德邦 2-京东 3-其他 4-圆通',
  ExpressNo        varchar(50),
  ExpressFee       decimal(16,9),
  Remark           text,
  Creator          int UNSIGNED NOT NULL,
  DepartmentID     int UNSIGNED NULL,
  Type             varchar(1) comment '0-个人，1-部门，2-事业部，3-公司',
  f_person         varchar(50),
  f_telno          varchar(50),
  f_address        varchar(500),
  s_person         varchar(50),
  s_telno          varchar(50),
  s_address        varchar(500),
  primary key (id)
);

alter table tb_express comment '单快递信息';

/*==============================================================*/
/* Table: tb_fee                                                */
/*==============================================================*/
create table tb_fee
(
  id                 int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff   int UNSIGNED NOT NULL,
  sys_create_date    datetime not null,
  sys_modify_stuff   int UNSIGNED NOT NULL,
  sys_modify_date    datetime not null,
  sys_delete_stuff   int UNSIGNED NULL,
  sys_delete_date    datetime,
  sys_delete_flag    tinyint  not null comment '0-未删除 1-已删除',

  ApplyNo            varchar(50),
  ApplyDate          datetime,
  ApplyStaff         varchar(36),
  Staff              varchar(36),
  DepartmemtID       int UNSIGNED NULL,
  DepartmemtID2      int UNSIGNED NULL,
  LeaderCheckStatus  varchar(1) comment '0-未审核 1-审核通过 2-驳回',
  LeaderID           int UNSIGNED NULL,
  LeaderCheckDate    datetime,
  FinanceCheckStatus varchar(1) comment '0-未审核 1-审核通过 2-驳回',
  FinanceID          int UNSIGNED NULL,
  FinanceCheckDate   datetime,
  Remark             varchar(500),
  PzhStatus          varchar(1),
  PzhID              int UNSIGNED NULL,
  ManagerCheckStatus varchar(1) comment '0-未审核 1-审核通过 2-驳回',
  ManagerID          INT UNSIGNED NULL,
  ManagerCheckDate   datetime,
  Type               varchar(1) comment '0-个人，1-部门，2-事业部，3-公司',
  Reason             text,
  SheetID            INT UNSIGNED NULL,
  primary key (id)
);

alter table tb_fee comment '费用申请';

/*==============================================================*/
/* Table: tb_fee_detail                                         */
/*==============================================================*/
create table tb_fee_detail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  TbFeeID          INT UNSIGNED NULL,
  FeeID            int UNSIGNED NULL,
  SFCompanyID      INT UNSIGNED NULL,
  Number           decimal(16,9),
  FeePrice         decimal(16,9),
  Rate             decimal(16,9),
  FeeCurrencyID    INT UNSIGNED NULL,
  FeeSum           decimal(16,9),
  Remark           varchar(500),
  InvoiceNo        varchar(500),
  PayDate          datetime,
  SorF             varchar(1),
  IsCheck          varchar(1) comment '0-未对账，1-已对账',
  IsReturn         varchar(1) comment '0-未入账，1-已入账',
  primary key (id)
);

alter table tb_fee_detail comment '费用申请明细表';

/*==============================================================*/
/* Table: tb_feecode                                            */
/*==============================================================*/
create table tb_feecode
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Year             varchar(5),
  Code             varchar(10),
  Month            varchar(5),
  primary key (id)
);

alter table tb_feecode comment '费用申请号表';

/*==============================================================*/
/* Table: tb_group                                              */
/*==============================================================*/
create table tb_group
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  group_name       varchar(50),
  group_memo       varchar(500),
  selfcompanyid    int UNSIGNED NULL,
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  primary key (id)
);

alter table tb_group comment '组信息';

/*==============================================================*/
/* Table: tb_inve_actual                                        */
/*==============================================================*/
create table tb_inve_actual
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  form_num         varchar(30),
  checker          varchar(36),
  check_flag       tinyint,
  check_date       datetime,
  form_memo        varchar(500),
  primary key (id)
);

alter table tb_inve_actual comment 'tb_inve_actual';

/*==============================================================*/
/* Table: tb_inve_actual_dtl                                    */
/*==============================================================*/
create table tb_inve_actual_dtl
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  curr_quantity    bigint,
  real_quantity    bigint,
  profit_loss      bigint,
  Product_id       int UNSIGNED NULL,
  Size_id          int UNSIGNED NULL,
  inve_actual_id   INT UNSIGNED NULL,
  stock_id         INT UNSIGNED NULL,
  primary key (id)
);

alter table tb_inve_actual_dtl comment 'tb_inve_actual_dtl';

/*==============================================================*/
/* Table: tb_inve_prep                                          */
/*==============================================================*/
create table tb_inve_prep
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  form_num         varchar(30),
  checker          varchar(36),
  check_flag       tinyint,
  check_date       datetime,
  form_memo        varchar(500),
  inve_actual_id   INT UNSIGNED NULL,
  primary key (id)
);

alter table tb_inve_prep comment 'tb_inve_prep';

/*==============================================================*/
/* Table: tb_inve_prep_dtl                                      */
/*==============================================================*/
create table tb_inve_prep_dtl
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Product_id       int UNSIGNED NULL,
  Size_id          int UNSIGNED NULL,
  curr_quantity    bigint,
  inve_prep_id     INT UNSIGNED NULL,
  stock_id         INT UNSIGNED NULL,
  primary key (id)
);

alter table tb_inve_prep_dtl comment 'tb_inve_prep_dtl';

/*==============================================================*/
/* Table: tb_kp                                                 */
/*==============================================================*/
create table tb_kp
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  InvoiceNo        varchar(50),
  KPDate           datetime,
  Sum              decimal(16,9),
  SFCompanyID      INT UNSIGNED NULL,
  Header           text,
  Remark           text,
  primary key (id)
);

alter table tb_kp comment '开票信息';

/*==============================================================*/
/* Table: tb_member                                             */
/*==============================================================*/
create table tb_member
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(50),
  code             varchar(20),
  ForM             varchar(1) comment 'F-Female M-Male',
  Birth            date,
  PhoneNo          varchar(50),
  Email            varchar(50),
  Address          varchar(50),
  ZipCode          varchar(10),
  QQ               varchar(50),
  Wechat           varchar(50),
  Microblog        varchar(50),
  TotalScore       bigint,
  Score            bigint,
  MemberCard       varchar(50),
  MemberLevelID    INT UNSIGNED NULL,
  MemberType       varchar(1) comment '0-个人会员 1-公司会员',
  MemberCardID     INT UNSIGNED NULL,
  CreatorID        INT UNSIGNED NULL,
  SourceID         INT UNSIGNED NULL,
  IDNo             varchar(50),
  TaxNo            varchar(50),
  Contactor        varchar(50),
  AsaWebNo         varchar(50),
  OpenID           varchar(50),
  Password         varchar(10),
  InviteSum        bigint,
  InviteTotal      bigint,
  InvoteUser       varchar(36),
  primary key (id)
);

alter table tb_member comment '会员表';

/*==============================================================*/
/* Table: tb_member_address                                     */
/*==============================================================*/
create table tb_member_address
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Member_id        int UNSIGNED NULL,
  Name             varchar(50),
  IDNo             varchar(50),
  Tel              varchar(50),
  ZipCode          varchar(10),
  Address          varchar(1000),
  Province         varchar(20),
  City             varchar(20),
  Is_default       varchar(1) comment '0-否 1-是',
  primary key (id)
);

alter table tb_member_address comment '会员地址信息';

/*==============================================================*/
/* Table: tb_member_bank                                        */
/*==============================================================*/
create table tb_member_bank
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Member_id        int UNSIGNED NULL,
  Account_name     varchar(1000),
  Account          varchar(1000),
  Currency_id      INT UNSIGNED NULL,
  Bank_name        varchar(1000),
  Bank_address     varchar(1000),
  Is_default       varchar(1) comment '0-否 1-是',
  primary key (id)
);

alter table tb_member_bank comment '会员银行';

/*==============================================================*/
/* Table: tb_member_card                                        */
/*==============================================================*/
create table tb_member_card
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Number           varchar(50),
  Is_used          varchar(1) comment '0-否 1-是',
  primary key (id)
);

alter table tb_member_card comment '会员卡号';

/*==============================================================*/
/* Table: tb_member_card_history                                */
/*==============================================================*/
create table tb_member_card_history
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Member_id        int UNSIGNED NULL,
  Type             varchar(1) comment '0-充值 1-消费 ',
  Sum              decimal(19,6),
  OpDate           datetime,
  TotalSum         decimal(19,6),
  primary key (id)
);

alter table tb_member_card_history comment '储值卡操作记录';

/*==============================================================*/
/* Table: tb_member_contactor                                   */
/*==============================================================*/
create table tb_member_contactor
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Member_id        int UNSIGNED NULL,
  Name             char(10),
  ForM             varchar(1) comment 'F-Female
            M-Male',
  Birth            date,
  Tel              varchar(50),
  PhoneNo          varchar(50),
  Email            varchar(50),
  Address          varchar(50),
  ZipCode          varchar(10),
  QQ               varchar(50),
  Wechat           varchar(50),
  Microblog        varchar(50),
  Remark           varchar(50),
  Is_default       varchar(1) comment '0-否 1-是',
  primary key (id)
);

alter table tb_member_contactor comment '会员（公司）联系人';

/*==============================================================*/
/* Table: tb_member_header                                      */
/*==============================================================*/
create table tb_member_header
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Member_id        int UNSIGNED NULL,
  Chinese_header   varchar(1000),
  English_header   varchar(1000),
  Is_default       varchar(1) comment '0-否 1-是',
  primary key (id)
);

alter table tb_member_header comment '会员发票抬头';

/*==============================================================*/
/* Table: tb_member_preference                                  */
/*==============================================================*/
create table tb_member_preference
(
  id                 int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff   int UNSIGNED NOT NULL,
  sys_create_date    datetime not null,
  sys_modify_stuff   int UNSIGNED NOT NULL,
  sys_modify_date    datetime not null,
  sys_delete_stuff   int UNSIGNED NULL,
  sys_delete_date    datetime,
  sys_delete_flag    tinyint  not null comment '0-未删除 1-已删除',

  Member_id          INT UNSIGNED NULL,
  Brand_id           INT UNSIGNED NULL,
  BrandGroup_id      INT UNSIGNED NULL,
  ChildBrandGroup_id INT UNSIGNED NULL,
  SizeTop_id         INT UNSIGNED NULL,
  primary key (id)
);

alter table tb_member_preference comment '会员偏好';

/*==============================================================*/
/* Table: tb_member_preference_size                             */
/*==============================================================*/
create table tb_member_preference_size
(
  id                  int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff    int UNSIGNED NOT NULL,
  sys_create_date     datetime not null,
  sys_modify_stuff    int UNSIGNED NOT NULL,
  sys_modify_date     datetime not null,
  sys_delete_stuff    int UNSIGNED NULL,
  sys_delete_date     datetime,
  sys_delete_flag     tinyint  not null comment '0-未删除 1-已删除',

  MemberPreference_id INT UNSIGNED NULL,
  SizeContent_id      INT UNSIGNED NULL,
  SizeTop_id          INT UNSIGNED NULL,
  primary key (id)
);

alter table tb_member_preference_size comment '会员偏好尺码表';

/*==============================================================*/
/* Table: tb_member_preordination                               */
/*==============================================================*/
create table tb_member_preordination
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  OrderDate        datetime,
  MemberID         int UNSIGNED NULL,
  ProductID        int UNSIGNED NULL,
  SizeID           int UNSIGNED NULL,
  Remark           text,
  primary key (id)
);

alter table tb_member_preordination comment '预定信息';

/*==============================================================*/
/* Table: tb_picture                                            */
/*==============================================================*/
create table tb_picture
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  PictureName      varchar(20),
  PictureStream    longblob,
  PictureType      char(10),
  PictureGroup     varchar(50),
  primary key (id)
);

alter table tb_picture comment '图片表';

/*==============================================================*/
/* Table: tb_pre_requisition                                    */
/*==============================================================*/
create table tb_pre_requisition
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductStock_id  int UNSIGNED NULL,
  StockID          int UNSIGNED NULL,
  ToStockID        int UNSIGNED NULL,
  OpID             int UNSIGNED NULL,
  primary key (id)
);

alter table tb_pre_requisition comment '预调拨单明细';

/*==============================================================*/
/* Table: tb_product                                            */
/*==============================================================*/
create table tb_product
(
  id                   int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff     int UNSIGNED NOT NULL,
  sys_create_date      datetime not null,
  sys_modify_stuff     int UNSIGNED NOT NULL,
  sys_modify_date      datetime not null,
  sys_delete_stuff     int UNSIGNED NULL,
  sys_delete_date      datetime,
  sys_delete_flag      tinyint  not null comment '0-未删除 1-已删除',

  ASACode              varchar(100),
  ProductName          varchar(50),
  WordCode_1           varchar(50),
  WordCode_2           varchar(50),
  WordCode_3           varchar(50),
  WordCode_4           varchar(50),
  WordPrice            decimal(16,9),
  WordPriceCurrencyID  int UNSIGNED NULL,
  Gender               varchar(10) comment '0-女式 1-男士 2-中性',
  Brand                varchar(36),
  BrandType            varchar(36),
  ChildBrand           varchar(36),
  BrandColor           varchar(36),
  BrandColor2          varchar(36),
  Picture              varchar(36),
  CloseWay             varchar(36),
  Decade               varchar(36),
  ProductSize          varchar(36),
  Origin               varchar(36),
  Security             varchar(36),
  Execution            varchar(36),
  Material             varchar(36),
  ProductParst         varchar(36),
  Occasion             varchar(36),
  ProductTemplate      varchar(36),
  MaterialStatus       varchar(36),
  Spring               tinyint,
  Summer               tinyint,
  Autumn               tinyint,
  Winter               tinyint,
  OldASACode           varchar(50),
  Officialwebsite      varchar(500),
  OldBarCode           varchar(500),
  LastStorageDate      datetime,
  Aliases_1            varchar(50),
  Aliases_2            varchar(50),
  Aliases              varchar(50),
  Series_id            int UNSIGNED NULL,
  Series2_id           int UNSIGNED NULL,
  UlnarInch            varchar(50),
  VAT                  decimal(16,9),
  Tariff               decimal(16,9),
  BaseCurrency         varchar(36),
  BasePrice            decimal(16,9),
  EntryMonth           varchar(5),
  FactoryPrice         decimal(16,9),
  FactoryPriceCurrency varchar(36),
  RealPrice            decimal(16,9),
  RetailPriceCurrency  varchar(36),
  DutyParagraph        varchar(50),
  OrderPrice           decimal(16,9),
  OrderPriceCurrency   varchar(36),
  RetailPrice          decimal(16,9) comment '可以填写的成本，入库时同步修改',
  Groupid              int UNSIGNED NULL comment '同款不同色',
  IsKJ                 varchar(1) comment '0-否 1-是',
  bxzs                 varchar(1) comment '0-修身1-适中2-宽松',
  hbzs                 varchar(1) comment '0-薄1-适中2-厚',
  rrzs                 varchar(1) comment '0-柔软1-适中2-偏硬',
  tlzs                 varchar(1) comment '0-无弹1-适中2-弹力',
  SaleMethodID         varchar(36),
  NationalPrice        decimal(16,9),
  TaxRate              decimal(16,9),
  IsJH                 varchar(1) comment '0-否1-是',
  InLenth              varchar(50),
  JDName               varchar(200),
  WinterProofing       varchar(36),
  IsFJ                 varchar(1) comment '0-否 1-法检',
  Discount             decimal(10,2),
  primary key (id)
);

alter table tb_product comment '商品表';

/*==============================================================*/
/* Table: tb_product_price                                      */
/*==============================================================*/
create table tb_product_price
(
  id                   int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff     int UNSIGNED NOT NULL,
  sys_create_date      datetime not null,
  sys_modify_stuff     int UNSIGNED NOT NULL,
  sys_modify_date      datetime not null,
  sys_delete_stuff     int UNSIGNED NULL,
  sys_delete_date      datetime,
  sys_delete_flag      tinyint  not null comment '0-未删除 1-已删除',

  ProductID            INT UNSIGNED NULL,
  DecadeID             INT UNSIGNED NULL,
  RetailPriceCurrency  varchar(36),
  RealPrice            decimal(16,9),
  FactoryPriceCurrency varchar(36),
  FactoryPrice         decimal(16,9),
  BaseCurrency         varchar(36),
  BasePrice            decimal(16,9),
  NationalPrice        decimal(16,9),
  primary key (id)
);

alter table tb_product_price comment '成交价，参考价，基准零售价，国内零售价 历史记录';

/*==============================================================*/
/* Table: tb_productstock                                       */
/*==============================================================*/
create table tb_productstock
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  SizeID           int UNSIGNED NULL,
  StorageTime      datetime,
  StorageStaff     varchar(36),
  StockID          int UNSIGNED NULL,
  ProductNo        bigint,
  SellTime         datetime,
  SellPrice        decimal(16,9),
  Cost             decimal(16,9),
  SellType         int comment '0-待销
            1-已售出
            2-预售
            3-在途
            4-调拨锁定',
  DealPrice        decimal(16,9),
  QualityStatus    int comment '0-合格品
            1-残次品
            2-库存差异',
  SellStaff        varchar(36),
  Is_print         varchar(1) comment '0-未打印
            1-条形码打印
            2-二维码打印',
  CorderID         int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  Remark           varchar(500),
  CPDate           datetime,
  CP_Op            varchar(36),
  InTime           datetime,
  Property         varchar(1) comment '0-自采 1-代销',
  KPFlag           varchar(1) comment '0-未开票 1-已开票',
  DecadeID         int UNSIGNED NOT NULL,
  primary key (id)
);

alter table tb_productstock comment '库存';

/*==============================================================*/
/* Table: tb_productstock_snapshot                              */
/*==============================================================*/
create table tb_productstock_snapshot
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SnapDate         datetime,
  ProductstockID   int UNSIGNED NULL,
  ProductID        int UNSIGNED NULL,
  SizeID           int UNSIGNED NULL,
  StockID          int UNSIGNED NULL,
  ProductNo        bigint,
  SellTime         datetime,
  SellPrice        decimal(16,9),
  Cost             decimal(16,9),
  SellType         int comment '0-待销
            1-已售出
            2-预定
            3-在途
            4-调拨锁定',
  DealPrice        decimal(16,9),
  QualityStatus    int comment '0-合格品
            1-残次品
            2-库存差异',
  SellStaff        varchar(36),
  CorderID         int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  Remark           varchar(500),
  CPDate           datetime,
  InTime           datetime,
  Property         varchar(1) comment '0-自采 1-代销',
  KPFlag           varchar(1) comment '0-未开票 1-已开票',
  DecadeID         int UNSIGNED NOT NULL,
  primary key (id)
);

alter table tb_productstock_snapshot comment '库存快照表';

/*==============================================================*/
/* Table: tb_requisition                                        */
/*==============================================================*/
create table tb_requisition
(
  id                int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff  int UNSIGNED NOT NULL,
  sys_create_date   datetime    not null,
  sys_modify_stuff  int UNSIGNED NOT NULL,
  sys_modify_date   datetime    not null,
  sys_delete_stuff  int UNSIGNED NULL,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint     not null comment '0-未删除 1-已删除',

  FeeCurrencyid     int UNSIGNED NULL,
  Fee               decimal(16,9),
  Apply_Staff       varchar(36),
  Apply_Date        datetime    not null,
  TurnIn_Staff      varchar(36),
  TurnIn_Date       datetime,
  TurnOut_Staff     varchar(36) not null,
  TurnOut_Date      datetime,
  Out_id            int UNSIGNED NOT NULL,
  In_id             int UNSIGNED NOT NULL,
  Remark            varchar(500),
  AllocationConfirm varchar(1) comment 'NULL-主调拨单才会是这个
            4-出库未完成
            0-入库未完成
            1-出库拒绝
            2-已完成
            3-入库拒绝
            ',
  RequisitionNo     varchar(50),
  Salesid           int UNSIGNED NULL,
  isM               varchar(1) comment '1-主单，0或者空-子单或单对单库调拨单',
  QualityStatus     varchar(1) comment '0-合格品 1-残品',
  IsAmortized       varchar(1),
  ExpressComoany    varchar(1) comment '0-顺丰 1-德邦 2-京东 3-其他',
  Address           char(1),
  MarkNo            varchar(50),
  ReturnFlag        varchar(1) comment '0-普通调拨单，1-反向调拨单',
  primary key (id)
);

alter table tb_requisition comment '调拨单主表';

/*==============================================================*/
/* Table: tb_requisition_detail                                 */
/*==============================================================*/
create table tb_requisition_detail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Requisition_id   int UNSIGNED NOT NULL,
  stock_id         INT UNSIGNED NULL,
  Remark           varchar(500),
  primary key (id)
);

alter table tb_requisition_detail comment '调拨单明细';

/*==============================================================*/
/* Table: tb_requisition_detail_group                           */
/*==============================================================*/
create table tb_requisition_detail_group
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Requisition_id   int UNSIGNED NOT NULL,
  Product_id       int UNSIGNED NULL,
  Size_id          int UNSIGNED NULL,
  Count            int,
  Remark           varchar(100),
  CtnNo            varchar(50),
  OutCount         int,
  InCount          int,
  primary key (id)
);

alter table tb_requisition_detail_group comment '调拨单明细(数量)';

/*==============================================================*/
/* Table: tb_requisition_express                                */
/*==============================================================*/
create table tb_requisition_express
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  RequisitionID    int UNSIGNED NULL,
  ExpressCompany   varchar(1) comment '0-顺丰 1-德邦 2-京东 3-其他 4-圆通',
  ExpressNo        varchar(50),
  ExpressFee       decimal(16,9),
  Remark           text,
  Creator          varchar(36),
  DepartmentID     int UNSIGNED NULL,
  Type             varchar(1) comment '0-个人，1-部门，2-事业部，3-公司',
  primary key (id)
);

alter table tb_requisition_express comment '调拨单快递信息';

/*==============================================================*/
/* Table: tb_requisitioncode                                    */
/*==============================================================*/
create table tb_requisitioncode
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Year             varchar(5),
  Code             varchar(10),
  primary key (id)
);

alter table tb_requisitioncode comment '调拨单号表';

/*==============================================================*/
/* Table: tb_rule                                               */
/*==============================================================*/
create table tb_rule
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  rule_name        varchar(50),
  rule_memo        varchar(500),
  selfcompanyid    int UNSIGNED NULL,
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  primary key (id)
);

alter table tb_rule comment '用于存放系统的全部信息';

/*==============================================================*/
/* Table: tb_savings_card                                       */
/*==============================================================*/
create table tb_savings_card
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Number           varchar(50),
  Password         varchar(10),
  Amount           decimal(16,9),
  Price            decimal(16,9),
  Is_used          varchar(1) comment '0-否 1-是',
  Is_actived       varchar(1) comment '0-否 1-是',
  primary key (id)
);

alter table tb_savings_card comment '储值卡';

/*==============================================================*/
/* Table: tb_special_requisition                                */
/*==============================================================*/
create table tb_special_requisition
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  No               varchar(10),
  StuffID          int UNSIGNED NULL,
  check_flag       tinyint comment '0-未生效
            1-已生效
            ',
  check_date       datetime,
  Remark           varchar(1000),
  primary key (id)
);

alter table tb_special_requisition comment '其他出入库主表';

/*==============================================================*/
/* Table: tb_special_requisition_detail                         */
/*==============================================================*/
create table tb_special_requisition_detail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SpecialID        int UNSIGNED NOT NULL,
  ProductID        int UNSIGNED NULL,
  SizeID           int UNSIGNED NULL,
  Count            int,
  warehouseID      int UNSIGNED NULL,
  Type             varchar(1) comment '0-出库 1-入库',
  Remark           varchar(500),
  primary key (id)
);

alter table tb_special_requisition_detail comment '其他出入库明细表';

/*==============================================================*/
/* Table: tb_stock                                              */
/*==============================================================*/
create table tb_stock
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  DeclarationID    int UNSIGNED NULL,
  ProductName      varchar(100),
  CurrencyID       int UNSIGNED NULL,
  Price            decimal(16,9),
  Count            int,
  Rate             decimal(16,9),
  CPrice           decimal(16,9),
  Tax              decimal(16,9),
  Cost             decimal(16,9),
  KPCount          int,
  primary key (id)
);

alter table tb_stock comment '账面库存表';

/*==============================================================*/
/* Table: tb_supplier                                           */
/*==============================================================*/
create table tb_supplier
(
  id                int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff  int UNSIGNED NOT NULL,
  sys_create_date   datetime not null,
  sys_modify_stuff  int UNSIGNED NOT NULL,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int UNSIGNED NULL,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  SupplierName      varchar(50),
  EnglishName       varchar(50),
  Address           varchar(100),
  Phone             bigint,
  ZipCode           varchar(500),
  Email             varchar(500),
  QuotedPrice       varchar(20),
  DevelopDate       datetime,
  Nationality       varchar(36),
  Nature            varchar(100),
  SupplierLevel     varchar(36),
  CompanyZipCode    varchar(100),
  MainContacts      varchar(50),
  Microblog         varchar(100),
  CountryCity       varchar(50),
  SupplierCode      varchar(50),
  Fax               varchar(50),
  Calculation       varchar(50),
  Legal             varchar(50),
  Heading           varchar(50),
  BusinessLicense   varchar(50),
  HeadingNumber     varchar(50),
  Registered        datetime,
  RegisteredCapital decimal(15),
  EndTime           datetime,
  Type              varchar(1) comment '0-供货商 1-报关行 2-供应商 3-承运人 4-客户 5-品牌商',
  ContractFrom      datetime,
  ContractTo        datetime,
  ContractRate      decimal(16,9),
  ContractRemind    int,
  SettleCompanyID   int UNSIGNED NULL,
  primary key (id)
);

alter table tb_supplier comment '任何表都应该包含的列';

/*==============================================================*/
/* Table: tb_supplier_orderdate                                 */
/*==============================================================*/
create table tb_supplier_orderdate
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SupplierID       int UNSIGNED NULL,
  BrandID          int UNSIGNED NULL,
  Decade           varchar(36),
  Type             varchar(1) comment '0-Pre ,1-Main ,2-Fashion show',
  ShowDate         datetime,
  CloseDate        datetime,
  Remark           text,
  primary key (id)
);

alter table tb_supplier_orderdate comment '订货日期';

/*==============================================================*/
/* Table: tb_user                                               */
/*==============================================================*/
create table tb_user
(
  id                 int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  login_name         varchar(50),
  password           varchar(50),
  real_name          varchar(50),
  departmentid       int UNSIGNED NULL,
  selfcompanyid      int UNSIGNED NULL,
  groupid            int UNSIGNED NULL,
  storeid            int UNSIGNED NULL,
  sys_create_stuff   int UNSIGNED NOT NULL,
  sys_create_date    datetime not null,
  sys_modify_stuff   int UNSIGNED NOT NULL,
  sys_modify_date    datetime not null,
  sys_delete_stuff   int UNSIGNED NULL,
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
  countryid          int UNSIGNED NULL,
  departmentid2      int UNSIGNED NULL,
  address            text,
  contactor          text,
  leave_date         datetime,
  DefaultPrice       varchar(36),
  DefaultWarehouse   varchar(36),
  DefaultSellSpot    varchar(36),
  IDNo               varchar(20),
  Education          varchar(50),
  CollegeMajor       varchar(50),
  Degree             varchar(50),
  GraduatedCollege   varchar(50),
  StateOfMarriage    varchar(50),
  CensusRegistration varchar(50),
  Status             varchar(1) comment '0-在职，1-离职，2-其他',
  Reason             text,
  ContactorPhone     varchar(50),
  CostDisplay        varchar(1),
  WeChat             varchar(50),
  OpenID             varchar(50),
  primary key (id)
);

alter table tb_user comment '用户表';

/*==============================================================*/
/* Table: tb_verificationcode                                   */
/*==============================================================*/
create table tb_verificationcode
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  verificationCode varchar(50),
  source           varchar(100) comment '注册，绑定，支付',
  sourceID         varchar(36) comment '前端发起动态密码验证，生成一次性guid，验证使用',
  phoneNo          varchar(20) comment '手机号',
  primary key (id)
);

alter table tb_verificationcode comment '动态密码验证表';

/*==============================================================*/
/* Table: tb_warehousing                                        */
/*==============================================================*/
create table tb_warehousing
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ArrivalID        int UNSIGNED NULL,
  EntryDate        datetime not null,
  Warehouse_id     int UNSIGNED NOT NULL,
  Season           varchar(36),
  SeasonType       varchar(1) comment '0-Pre ,1-Main ,2-Fashion show',
  Op_id            int UNSIGNED NOT NULL,
  Remark           varchar(500),
  IsChecked        varchar(2),
  IsAmortized      varchar(2),
  EntryCode        varchar(100),
  ExchangeRate     decimal(16,9),
  CorderID         int UNSIGNED NULL,
  SupplierID       int UNSIGNED NOT NULL,
  Property         varchar(1) comment '0-自采 1-代销',
  primary key (id)
);

alter table tb_warehousing comment '入库单主表';

/*==============================================================*/
/* Table: tb_warehousing_detail                                 */
/*==============================================================*/
create table tb_warehousing_detail
(
  id               varchar(36)   not null,
  sys_create_stuff varchar(36)   not null,
  sys_create_date  datetime      not null,
  sys_modify_stuff varchar(36)   not null,
  sys_modify_date  datetime      not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint       not null comment '0-未删除 1-已删除',

  DetailID         int UNSIGNED NULL,
  Warehousing_id   int UNSIGNED NOT NULL,
  Product_id       int UNSIGNED NOT NULL,
  Size_id          int UNSIGNED NOT NULL,
  Amount           int           not null,
  Cost             decimal(16,9) not null,
  Remark           varchar(500),
  cjj              decimal(16,9),
  yj               decimal(16,9),
  SellPrice        decimal(16,9),
  FinalCost        decimal(16,9),
  CurrencyID       int UNSIGNED NULL,
  primary key (id)
);

alter table tb_warehousing_detail comment '入库单明细表';

/*==============================================================*/
/* Table: tb_warehousing_fee                                    */
/*==============================================================*/
create table tb_warehousing_fee
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  WarehousingID    int UNSIGNED NULL,
  FeeID            int UNSIGNED NULL,
  CurrencyID       int UNSIGNED NULL,
  FeePrice         decimal(10,2),
  Payment          varchar(36),
  primary key (id)
);

alter table tb_warehousing_fee comment '入库表-费用说明';

/*==============================================================*/
/* Table: trans_brand_code                                      */
/*==============================================================*/
create table trans_brand_code
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  BrandID          int UNSIGNED NULL,
  Code             varchar(50),
  TransCode        varchar(50),
  Unit             varchar(10),
  primary key (id)
);

alter table trans_brand_code comment '品牌对照表';

/*==============================================================*/
/* Table: trans_color_code                                      */
/*==============================================================*/
create table trans_color_code
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ColorID          int UNSIGNED NULL,
  Code             varchar(50),
  TransCode        varchar(50),
  primary key (id)
);

alter table trans_color_code comment '颜色对照表';

/*==============================================================*/
/* Table: trans_group_code                                      */
/*==============================================================*/
create table trans_group_code
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  GroupID          int UNSIGNED NULL,
  Code             varchar(50),
  TransCode        varchar(50),
  primary key (id)
);

alter table trans_group_code comment '品类对照表';

/*==============================================================*/
/* Table: trans_size_code                                       */
/*==============================================================*/
create table trans_size_code
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SizeID           int UNSIGNED NULL,
  TypeID           int UNSIGNED NULL,
  Code             varchar(50),
  TransCode        varchar(50),
  primary key (id)
);

alter table trans_size_code comment '尺码对照表';

/*==============================================================*/
/* Table: xs_afterservice                                       */
/*==============================================================*/
create table xs_afterservice
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  MemberID         int UNSIGNED NULL,
  SalesStaff       varchar(36),
  SalesDate        datetime,
  SellSpotID       int UNSIGNED NULL,
  SaleNo           varchar(50),
  CusName          varchar(50),
  CusTel           varchar(50),
  Status           varchar(1) comment '0-接收 1-处理中 2-完结',
  primary key (id)
);

alter table xs_afterservice comment '售后单';

/*==============================================================*/
/* Table: xs_afterservice_detail                                */
/*==============================================================*/
create table xs_afterservice_detail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  AfterServiceID   int UNSIGNED NULL,
  DetailID         int UNSIGNED NULL,
  Count            int,
  Describtion      varchar(500),
  DealType         varchar(1) comment '0-修理1-保养2-调换3-退货',
  FixDate          datetime,
  FixStuff         varchar(36),
  BackDate         datetime,
  BackStuff        varchar(36),
  primary key (id)
);

alter table xs_afterservice_detail comment '售后单明细';

/*==============================================================*/
/* Table: xs_pre_sales                                          */
/*==============================================================*/
create table xs_pre_sales
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  MemberID         int UNSIGNED NULL,
  PriceListID      int UNSIGNED NULL,
  SalesStaff       varchar(36),
  SalesDate        datetime,
  SellSpotID       int UNSIGNED NULL,
  CompanyID        int UNSIGNED NULL,
  SaleNo           varchar(50),
  SalesType        varchar(1) comment '0-零售
            1-批发',
  WarehouseID      int UNSIGNED NULL,
  Status           varchar(1) comment '0-预售 1-已转销售 2-作废',
  IsLocal          varchar(1) comment '0-跨境电商 1-线下店铺 2-爱莎商城 3-代销',
  DownPayment      decimal(16,9),
  RemainingFund    decimal(16,9),
  ActualPrice      decimal(16,9),
  primary key (id)
);

alter table xs_pre_sales comment '预售主表';

/*==============================================================*/
/* Table: xs_pre_salescode                                      */
/*==============================================================*/
create table xs_pre_salescode
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Year             varchar(5),
  Code             varchar(10),
  Month            varchar(5),
  primary key (id)
);

alter table xs_pre_salescode comment '预售单号表';

/*==============================================================*/
/* Table: xs_pre_salesdetails                                   */
/*==============================================================*/
create table xs_pre_salesdetails
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Sales_id         int UNSIGNED NOT NULL,
  Product_id       int UNSIGNED NULL,
  Size_id          int UNSIGNED NULL,
  Count            int,
  DealPrice        decimal(16,9),
  Price            decimal(16,9),
  Rate             decimal(16,9),
  Remark           varchar(500),
  TotalSellPrice   decimal(16,9),
  primary key (id)
);

alter table xs_pre_salesdetails comment '预售单明细(数量)';

/*==============================================================*/
/* Table: xs_pricelist                                          */
/*==============================================================*/
create table xs_pricelist
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  BeginDate        datetime,
  EndDate          datetime,
  Name             varchar(20),
  SalesPort        varchar(36),
  Remark           varchar(500),
  PriceID          int UNSIGNED NULL,
  primary key (id)
);

alter table xs_pricelist comment '价格单基础资料 主表
';

/*==============================================================*/
/* Table: xs_pricelistdetails                                   */
/*==============================================================*/
create table xs_pricelistdetails
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  ProductPrice     decimal(10,2),
  PriceListID      int UNSIGNED NULL,
  primary key (id)
);

alter table xs_pricelistdetails comment '价格单基础资料 明细从表';

/*==============================================================*/
/* Table: xs_return                                             */
/*==============================================================*/
create table xs_return
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ActualPrice      decimal(16,9),
  SellSpotID       int UNSIGNED NULL,
  MemberID         int UNSIGNED NULL,
  ReturnStaff      varchar(36),
  ReturnDate       datetime,
  ReturnNo         varchar(50),
  primary key (id)
);

alter table xs_return comment '退货单';

/*==============================================================*/
/* Table: xs_returncode                                         */
/*==============================================================*/
create table xs_returncode
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Year             varchar(5),
  Code             varchar(10),
  primary key (id)
);

alter table xs_returncode comment '退货单号表';

/*==============================================================*/
/* Table: xs_sales                                              */
/*==============================================================*/
create table xs_sales
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ActualPrice      decimal(16,9),
  MemberID         int UNSIGNED NULL,
  PriceListID      int UNSIGNED NULL,
  SalesStaff       varchar(36),
  SalesDate        datetime,
  SalesMode        varchar(2) comment '0-现金
            1-刷卡
            2-支票
            3-储值卡
            4-转账
            5-协议结算
            6-支付宝
            7-微信支付',
  SellSpotID       int UNSIGNED NULL,
  CompanyID        int UNSIGNED NULL,
  SaleNo           varchar(50),
  SalesType        varchar(1) comment '0-未转 1-已转',
  WarehouseID      int UNSIGNED NULL,
  ExpressNo        varchar(50),
  ExpressPaidType  varchar(1) comment '0-预付 1-到付 2-第三方付费 3-储值卡 4-转账 5-协议结算',
  ExpressFee       decimal(16,9),
  ExpressFeePayID  varchar(36),
  Status           varchar(1) comment '0-预售 1-已售 2-作废',
  ExpressComoany   varchar(1) comment '0-顺丰 1-德邦 2-京东 3-其他 4-圆通',
  Address          varchar(36),
  IsLocal          varchar(1) comment '0-跨境电商 1-线下店铺 2-爱莎商城 3-分公司间调拨销售 4-代销 ',
  ExternalNo       varchar(50),
  IsCheck          varchar(1),
  SheetID          int UNSIGNED NULL,
  Type             varchar(1) comment '0-普通 1-扫码 ',
  PickingType      varchar(1) comment '0-自提 1-快递 2-门店直发',
  Sender           varchar(36),
  SupplierID       int UNSIGNED NULL,
  IsJF             varchar(1) comment '0-未使用积分抵扣，1-使用积分抵扣',
  DKSum            decimal(16,9),
  UsedScore        bigint,
  ExhibitionID     int UNSIGNED NULL,
  IsUsed           varchar(1),
  InviteSum        bigint,
  primary key (id)
);

alter table xs_sales comment '销售主表';

/*==============================================================*/
/* Table: xs_sales_card                                         */
/*==============================================================*/
create table xs_sales_card
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ActualPrice      decimal(16,9),
  MemberID         int UNSIGNED NULL,
  SalesStaff       varchar(36),
  SalesDate        datetime,
  SellSpotID       int UNSIGNED NULL,
  CompanyID        int UNSIGNED NULL,
  SaleNo           varchar(50),
  IsCheck          varchar(1),
  SheetID          int UNSIGNED NULL,
  primary key (id)
);

alter table xs_sales_card comment '销售储值卡主表';

/*==============================================================*/
/* Table: xs_sales_cardetails                                   */
/*==============================================================*/
create table xs_sales_cardetails
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Sales_id         int UNSIGNED NOT NULL,
  DealPrice        decimal(16,9),
  Price            decimal(16,9),
  Rate             decimal(16,9),
  Remark           varchar(500),
  TotalSellPrice   decimal(16,9),
  StockID          int UNSIGNED NULL,
  primary key (id)
);

alter table xs_sales_cardetails comment '储值卡销售单明细';

/*==============================================================*/
/* Table: xs_sales_pay                                          */
/*==============================================================*/
create table xs_sales_pay
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Sales_id         int UNSIGNED NOT NULL,
  PaidType         varchar(5) comment '0-现金
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
            14-刷卡/VISA
            15.Joypay',
  IsCheck          varchar(1),
  IsReturn         varchar(1),
  SheetID          int UNSIGNED NULL,
  Sum              decimal(16,9),
  Remark           varchar(500),
  CurrencyID       int UNSIGNED NULL,
  primary key (id)
);

alter table xs_sales_pay comment '销售单付款明细';

/*==============================================================*/
/* Table: xs_salescode                                          */
/*==============================================================*/
create table xs_salescode
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Year             varchar(5),
  Code             varchar(10),
  Month            varchar(5),
  primary key (id)
);

alter table xs_salescode comment '销售单号表';

/*==============================================================*/
/* Table: xs_salesdetails                                       */
/*==============================================================*/
create table xs_salesdetails
(
  id                int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff  int UNSIGNED NOT NULL,
  sys_create_date   datetime not null,
  sys_modify_stuff  int UNSIGNED NOT NULL,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int UNSIGNED NULL,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  Sales_id          int UNSIGNED NOT NULL,
  Product_id        int UNSIGNED NULL,
  Size_id           int UNSIGNED NULL,
  Count             int,
  DealPrice         decimal(16,9),
  Price             decimal(16,9),
  Rate              decimal(16,9),
  Remark            varchar(500),
  ReturnID          int UNSIGNED NULL,
  TotalSellPrice    decimal(16,9),
  SaleNo            varchar(50),
  StockID           int UNSIGNED NULL,
  PriceRemark       varchar(500),
  ExchangeRate      decimal(16,9),
  TotalSellPriceBwb decimal(16,9),
  primary key (id)
);

alter table xs_salesdetails comment '销售单明细(数量)';

/*==============================================================*/
/* Table: zl_ac_cashflow_statement                              */
/*==============================================================*/
create table zl_ac_cashflow_statement
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  subject_name     varchar(50),
  subject_type     int comment '0-正，1-负',
  orderno          int,
  parentid         int UNSIGNED NULL,
  primary key (id)
);

alter table zl_ac_cashflow_statement comment '现金流量表格式';

/*==============================================================*/
/* Table: zl_ac_cashflow_subject                                */
/*==============================================================*/
create table zl_ac_cashflow_subject
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  SorF             varchar(1) comment '0-正，1-负',
  primary key (id)
);

alter table zl_ac_cashflow_subject comment '现金流量项目';

/*==============================================================*/
/* Table: zl_ac_km                                              */
/*==============================================================*/
create table zl_ac_km
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  code             char(1)    not null,
  chinese_name     char(1)    not null,
  english_name     char(1),
  km_type_id       int UNSIGNED NOT NULL,
  up_km_id         int UNSIGNED NULL,
  is_havexj        varchar(1) not null comment '0-没有,1-有',
  jord             varchar(1) not null comment 'J-借方,D-贷方',
  selfcompanyid    int UNSIGNED NOT NULL,
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime   not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime   not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint    not null comment '0-未删除 1-已删除',
  primary key (id)
);

alter table zl_ac_km comment '科目表';

/*==============================================================*/
/* Table: zl_ac_km_type                                         */
/*==============================================================*/
create table zl_ac_km_type
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  code             varchar(1) not null,
  chinese_memo     char(1)    not null,
  english_memo     char(1)    not null,
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime   not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime   not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint    not null comment '0-未删除 1-已删除',

  primary key (id)
);

alter table zl_ac_km_type comment '科目类别';

/*==============================================================*/
/* Table: zl_ac_pzh_rule                                        */
/*==============================================================*/
create table zl_ac_pzh_rule
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  RuleCode         varchar(50),
  kmid             int UNSIGNED NULL,
  primary key (id)
);

alter table zl_ac_pzh_rule comment '凭证科目规则';

/*==============================================================*/
/* Table: zl_ac_pzh_type                                        */
/*==============================================================*/
create table zl_ac_pzh_type
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  ztid             int UNSIGNED NOT NULL,
  code             varchar(4) not null,
  chinese_memo     char(1)    not null,
  english_memo     char(1)    not null,
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime   not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime   not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint    not null comment '0-未删除 1-已删除',

  primary key (id)
);

alter table zl_ac_pzh_type comment '现金、银行、转账';

/*==============================================================*/
/* Table: zl_ac_ztb                                             */
/*==============================================================*/
create table zl_ac_ztb
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  zt_name          varchar(100) not null,
  km_code_rule     varchar(50)  not null,
  star_date        datetime     not null,
  end_date         datetime comment '只有结束了才有值',
  is_end           varchar(1)   not null comment '0-未结束,1-结束',
  is_default       varchar(1)   not null comment '0-不是,1-是',
  pwd              varchar(50),
  selfcompanyid    int UNSIGNED NOT NULL,
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime     not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime     not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint      not null comment '0-未删除 1-已删除',

  primary key (id)
);

alter table zl_ac_ztb comment '帐套表';

/*==============================================================*/
/* Table: zl_ageseason                                          */
/*==============================================================*/
create table zl_ageseason
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SessionMark      varchar(10),
  SessionName      varchar(10),
  primary key (id)
);

alter table zl_ageseason comment '年代季节';

/*==============================================================*/
/* Table: zl_aliases                                            */
/*==============================================================*/
create table zl_aliases
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  Code             varchar(50),
  BrandID          int UNSIGNED NULL,
  primary key (id)
);

alter table zl_aliases comment '任何表都应该包含的列';

/*==============================================================*/
/* Table: zl_bankinformation                                    */
/*==============================================================*/
create table zl_bankinformation
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  BankName         varchar(100),
  BankName2        varchar(100),
  BankAddress      varchar(100),
  BankAccount      varchar(50),
  RemittedAccount  varchar(50),
  SupplierID       int UNSIGNED NULL,
  Currency         varchar(36),
  Account          varchar(50),
  IsUsed           varchar(1) comment '0-常用，1-禁用',
  Remark           varchar(200),
  primary key (id)
);

alter table zl_bankinformation comment '银行信息';

/*==============================================================*/
/* Table: zl_brand                                              */
/*==============================================================*/
create table zl_brand
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Code             varchar(50),
  BrandName        varchar(50),
  BrandEnglishName varchar(50),
  CountryID        int UNSIGNED NULL,
  ChildBrand       varchar(36),
  Description      varchar(1000),
  ImageStream      longblob,
  memo             char(1),
  Supplier         varchar(36),
  Officialwebsite  varchar(500),
  IsAuthorized     varchar(1),
  primary key (id)
);

alter table zl_brand comment '品牌表';

/*==============================================================*/
/* Table: zl_brandgroup                                         */
/*==============================================================*/
create table zl_brandgroup
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Code             varchar(50),
  BrandGroupName   varchar(50),
  EnglishName      char(10),
  primary key (id)
);

alter table zl_brandgroup comment '品类表';

/*==============================================================*/
/* Table: zl_brandremark                                        */
/*==============================================================*/
create table zl_brandremark
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  BrandID          int UNSIGNED NULL,
  Name             varchar(50),
  Remark           varchar(100),
  Pic              longblob,
  primary key (id)
);

alter table zl_brandremark comment '品牌颜色材质备注';

/*==============================================================*/
/* Table: zl_businesstype                                       */
/*==============================================================*/
create table zl_businesstype
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  primary key (id)
);

alter table zl_businesstype comment '业务类型';

/*==============================================================*/
/* Table: zl_childproductgroup                                  */
/*==============================================================*/
create table zl_childproductgroup
(
  id                int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff  int UNSIGNED NOT NULL,
  sys_create_date   datetime not null,
  sys_modify_stuff  int UNSIGNED NOT NULL,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int UNSIGNED NULL,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  ChildName         varchar(50),
  EnglishName       varchar(50),
  ChildCode         varchar(50),
  ProductGroupID    int UNSIGNED NULL,
  ProductTemplateID int UNSIGNED NULL,
  Weight            decimal(16,9),
  IsFJ              varchar(1) comment '0-否 1-法检',
  Cname4male        varchar(36),
  Cname4female      varchar(36),
  primary key (id)
);

alter table zl_childproductgroup comment '子品类';

/*==============================================================*/
/* Table: zl_closedway                                          */
/*==============================================================*/
create table zl_closedway
(
  id                int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff  int UNSIGNED NOT NULL,
  sys_create_date   datetime not null,
  sys_modify_stuff  int UNSIGNED NOT NULL,
  sys_modify_date   datetime not null,
  sys_delete_stuff  int UNSIGNED NULL,
  sys_delete_date   datetime,
  sys_delete_flag   tinyint  not null comment '0-未删除 1-已删除',

  closedWayName     varchar(50),
  closedWayNameNote varchar(100),
  primary key (id)
);

alter table zl_closedway comment '闭合方式';

/*==============================================================*/
/* Table: zl_color                                              */
/*==============================================================*/
create table zl_color
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Code             varchar(10),
  colorName        varchar(50),
  colorMatter      varchar(100),
  ASAColorID       int UNSIGNED NULL,
  BrandID          int UNSIGNED NULL,
  EnglishName      varchar(20),
  ImageStream      longblob,
  primary key (id)
);

alter table zl_color comment '其他品牌颜色模板';

/*==============================================================*/
/* Table: zl_colortemplate                                      */
/*==============================================================*/
create table zl_colortemplate
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Color_Name       varchar(20),
  Code             varchar(4),
  Color_Note       varchar(200),
  EnglishName      varchar(20),
  ColorType        varchar(50),
  primary key (id)
);

alter table zl_colortemplate comment 'ASA颜色模板';

/*==============================================================*/
/* Table: zl_companycontacts                                    */
/*==============================================================*/
create table zl_companycontacts
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  Gender           varchar(10),
  Department       varchar(20),
  Position         varchar(20),
  City             varchar(20),
  Company          varchar(50),
  Phone            varchar(30),
  Landline         varchar(30),
  Fax              varchar(30),
  Email            varchar(20),
  MSN              varchar(20),
  QQ               varchar(20),
  SKYTPE           varchar(20),
  Microblog        varchar(20),
  MicroMessage     varchar(20),
  Note             varchar(1000),
  Branch           varchar(100),
  UseID            int UNSIGNED NULL,
  Address          varchar(500),
  ZipCode          varchar(10),
  primary key (id)
);

alter table zl_companycontacts comment '联系人
';

/*==============================================================*/
/* Table: zl_costformula                                        */
/*==============================================================*/
create table zl_costformula
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductPriceID   int UNSIGNED NULL,
  Symbol_1         char(10),
  Coefficient_1    decimal(10,2),
  Symbol_2         char(10),
  Coefficient_2    decimal(10,2),
  FormulaName      varchar(50),
  primary key (id)
);

alter table zl_costformula comment '成本计算公式';

/*==============================================================*/
/* Table: zl_country                                            */
/*==============================================================*/
create table zl_country
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  code             varchar(20)  not null,
  name             varchar(100) not null,
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime     not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime     not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint      not null comment '0-未删除 1-已删除',

  LocalCurrency    varchar(36),
  primary key (id)
);

alter table zl_country comment '国家表';

/*==============================================================*/
/* Table: zl_currency                                           */
/*==============================================================*/
create table zl_currency
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  CurrencyName     varchar(20),
  CurrencyCode     varchar(10),
  CurrencyMark     bool,
  UserFlag         varchar(1),
  primary key (id)
);

alter table zl_currency comment '币种表';

/*==============================================================*/
/* Table: zl_customs_name                                       */
/*==============================================================*/
create table zl_customs_name
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  Remark           varchar(100),
  primary key (id)
);

alter table zl_customs_name comment '商品报关名称
';

/*==============================================================*/
/* Table: zl_decade                                             */
/*==============================================================*/
create table zl_decade
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Decade           varchar(10),
  primary key (id)
);

alter table zl_decade comment '商品年代';

/*==============================================================*/
/* Table: zl_delare_makings                                     */
/*==============================================================*/
create table zl_delare_makings
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  Remark           varchar(100),
  primary key (id)
);

alter table zl_delare_makings comment '申报要素';

/*==============================================================*/
/* Table: zl_ex_reportstyle                                     */
/*==============================================================*/
create table zl_ex_reportstyle
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  code             varchar(20),
  chinese_name     varchar(100),
  english_name     varchar(100),
  tdBackX          int,
  tdBackY          int,
  tdBackWidth      int,
  tdBackHeight     int,
  memo             varchar(1000),
  selfcompanyid    int UNSIGNED NULL,
  Picid            int UNSIGNED NULL,
  primary key (id)
);

alter table zl_ex_reportstyle comment '快递单样式主表';

/*==============================================================*/
/* Table: zl_ex_reportstyle_detail                              */
/*==============================================================*/
create table zl_ex_reportstyle_detail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  type_id          int UNSIGNED NULL,
  tdfield          varchar(200),
  tdfieldX         int,
  tdfieldY         int,
  tdfieldWidth     int,
  tdfieldHeight    int,
  is_visiable      varchar(1),
  primary key (id)
);

alter table zl_ex_reportstyle_detail comment '快递单样式明细表';

/*==============================================================*/
/* Table: zl_exchangerate                                       */
/*==============================================================*/
create table zl_exchangerate
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ExchangeRateDate varchar(50),
  ExportCurrency   varchar(36) comment '汇出币种',
  ImportCurrency   varchar(36) comment '汇入币种',
  ExchangeRate     decimal(10,5),
  primary key (id)
);

alter table zl_exchangerate comment '汇率';

/*==============================================================*/
/* Table: zl_executioncategory                                  */
/*==============================================================*/
create table zl_executioncategory
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ExecutionName    varchar(100),
  ExecutionMatter  varchar(500),
  Note             varchar(500),
  primary key (id)
);

alter table zl_executioncategory comment '执行标准';

/*==============================================================*/
/* Table: zl_exhibition                                         */
/*==============================================================*/
create table zl_exhibition
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  Remark           varchar(100),
  Status           varchar(1) comment '0-不可用 1-可用',
  primary key (id)
);

alter table zl_exhibition comment '展会';

/*==============================================================*/
/* Table: zl_feenames                                           */
/*==============================================================*/
create table zl_feenames
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Code             varchar(20),
  EnglishName      varchar(50),
  Name             varchar(50),
  kmid             int UNSIGNED NULL,
  IsAmortize       tinyint comment '0-不摊销 1-金额摊销 2-件数摊销',
  IsUsed           varchar(1) comment '0-不常用 1-常用',
  primary key (id)
);

alter table zl_feenames comment '费用名称';

/*==============================================================*/
/* Table: zl_forbiddenword                                      */
/*==============================================================*/
create table zl_forbiddenword
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Word             varchar(50),
  Remark           varchar(100),
  primary key (id)
);

alter table zl_forbiddenword comment '违禁词';

/*==============================================================*/
/* Table: zl_imagetool                                          */
/*==============================================================*/
create table zl_imagetool
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  Type             varchar(1) comment '0-修改尺寸
            1-修改尺寸并添加
            2-裁剪并对齐',
  Width            int,
  Height           int,
  IsNeed           varchar(1),
  Quality          int,
  primary key (id)
);

alter table zl_imagetool comment '图片导出方式';

/*==============================================================*/
/* Table: zl_invite_rule                                        */
/*==============================================================*/
create table zl_invite_rule
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Bonus            bigint,
  Remark           text,
  primary key (id)
);

alter table zl_invite_rule comment '会员邀请规则';

/*==============================================================*/
/* Table: zl_invoice_header                                     */
/*==============================================================*/
create table zl_invoice_header
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SupplierID       int UNSIGNED NULL,
  Header           varchar(50),
  Remark           varchar(200),
  IsDefault        varchar(1) comment '1-默认 0-非默认',
  primary key (id)
);

alter table zl_invoice_header comment '客户 发票抬头';

/*==============================================================*/
/* Table: zl_material                                           */
/*==============================================================*/
create table zl_material
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  MaterialName     varchar(20),
  Code             varchar(20),
  EnglishName      varchar(50),
  primary key (id)
);

alter table zl_material comment '材质
';

/*==============================================================*/
/* Table: zl_materialnote                                       */
/*==============================================================*/
create table zl_materialnote
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Content          varchar(100),
  primary key (id)
);

alter table zl_materialnote comment '材质备注';

/*==============================================================*/
/* Table: zl_materialstatus                                     */
/*==============================================================*/
create table zl_materialstatus
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  EnglishName      varchar(20),
  Code             varchar(20),
  Name             varchar(50),
  primary key (id)
);

alter table zl_materialstatus comment '材质状态';

/*==============================================================*/
/* Table: zl_memberlevel                                        */
/*==============================================================*/
create table zl_memberlevel
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  MemberLevel      varchar(50),
  Discount         decimal(16,9),
  LevelBasicScore  bigint,
  IntegralRule     decimal(16,9) comment '实际成交价格x积分规则=获得积分',
  ExchangeRule     decimal(16,9) comment '积分x对换规则=可兑换金额',
  LevelContent     varchar(50),
  IsRetail         varchar(1) comment '0-非零售等级，不能升级，1-零售等级，可以升级',
  primary key (id)
);

alter table zl_memberlevel comment '会员等级设置';

/*==============================================================*/
/* Table: zl_occasionsstyle                                     */
/*==============================================================*/
create table zl_occasionsstyle
(
  id                 int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff   int UNSIGNED NOT NULL,
  sys_create_date    datetime not null,
  sys_modify_stuff   int UNSIGNED NOT NULL,
  sys_modify_date    datetime not null,
  sys_delete_stuff   int UNSIGNED NULL,
  sys_delete_date    datetime,
  sys_delete_flag    tinyint  not null comment '0-未删除 1-已删除',

  OccasionsStyleName varchar(50),
  OccasionsStyleMode varchar(200),
  primary key (id)
);

alter table zl_occasionsstyle comment '场合风格';

/*==============================================================*/
/* Table: zl_pricesource                                        */
/*==============================================================*/
create table zl_pricesource
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  Remark           varchar(500),
  primary key (id)
);

alter table zl_pricesource comment '价格来源';

/*==============================================================*/
/* Table: zl_productdscrb                                       */
/*==============================================================*/
create table zl_productdscrb
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  Remark           varchar(100),
  primary key (id)
);

alter table zl_productdscrb comment '商品描述';

/*==============================================================*/
/* Table: zl_productinnards                                     */
/*==============================================================*/
create table zl_productinnards
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  PartsName        varchar(50),
  primary key (id)
);

alter table zl_productinnards comment '内部结构';

/*==============================================================*/
/* Table: zl_productparts                                       */
/*==============================================================*/
create table zl_productparts
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  PartsCode        varchar(50),
  PartsName        varchar(50),
  PackFlag         varchar(1),
  primary key (id)
);

alter table zl_productparts comment '附带配件
';

/*==============================================================*/
/* Table: zl_productprice                                       */
/*==============================================================*/
create table zl_productprice
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SaleName         varchar(50),
  IsDefault        varchar(1) comment '0 - 默认
            1 - 不默认',
  CurreancyID      int UNSIGNED NULL,
  SortNum          varchar(4),
  IsRound          varchar(1),
  primary key (id)
);

alter table zl_productprice comment '商品销售价格 国内外零售价、批发价';

/*==============================================================*/
/* Table: zl_productstyle                                       */
/*==============================================================*/
create table zl_productstyle
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  BrandGroup       varchar(36),
  ChildBrand       varchar(36),
  ProductStyle     varchar(10),
  primary key (id)
);

alter table zl_productstyle comment '商品款号';

/*==============================================================*/
/* Table: zl_producttemplate                                    */
/*==============================================================*/
create table zl_producttemplate
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  TemplateName     varchar(50),
  Picture          longblob,
  primary key (id)
);

alter table zl_producttemplate comment '商品模板-主表';

/*==============================================================*/
/* Table: zl_quotedprice                                        */
/*==============================================================*/
create table zl_quotedprice
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  S_ID             varchar(50),
  Currency         varchar(50),
  QuotedPrice      decimal(10,0),
  QuotedDate       datetime,
  primary key (id)
);

alter table zl_quotedprice comment 'zl_quotedprice';

/*==============================================================*/
/* Table: zl_reportset                                          */
/*==============================================================*/
create table zl_reportset
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Code             varchar(50),
  Name             varchar(50),
  Remark           varchar(500),
  primary key (id)
);

alter table zl_reportset comment '报表样式设置';

/*==============================================================*/
/* Table: zl_reportset_detail                                   */
/*==============================================================*/
create table zl_reportset_detail
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SetID            int UNSIGNED NULL,
  Code             varchar(50),
  `Index`          int,
  Width            int,
  primary key (id)
);

alter table zl_reportset_detail comment '报表样式设置明细';

/*==============================================================*/
/* Table: zl_salesmethods                                       */
/*==============================================================*/
create table zl_salesmethods
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SalesMethodsName varchar(50),
  SalesMethodsMode varchar(200),
  BrandType        varchar(36),
  primary key (id)
);

alter table zl_salesmethods comment '销售方式';

/*==============================================================*/
/* Table: zl_salesport                                          */
/*==============================================================*/
create table zl_salesport
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProtName         varchar(20),
  Remark           varchar(500),
  StoreName        varchar(50),
  Isonline         varchar(1) comment '0-否 1-是',
  Address          char(1),
  Tel              varchar(50),
  IsUsed           varchar(1),
  IsKD             varchar(1) comment '0-否 1-是',
  PostRemark       text,
  CusID            int UNSIGNED NULL,
  primary key (id)
);

alter table zl_salesport comment '销售端口基础资料';

/*==============================================================*/
/* Table: zl_salesport_mission                                  */
/*==============================================================*/
create table zl_salesport_mission
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SaleSpotID       int UNSIGNED NULL,
  YearMonth        varchar(10) comment '格式为201801',
  SaleSum          decimal(10,2),
  Profit           decimal(10,2),
  Rate             decimal(10,2),
  Remark           varchar(500),
  primary key (id)
);

alter table zl_salesport_mission comment '销售端口任务额';

/*==============================================================*/
/* Table: zl_series                                             */
/*==============================================================*/
create table zl_series
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  Code             varchar(50),
  BrandID          int UNSIGNED NULL,
  primary key (id)
);

alter table zl_series comment '任何表都应该包含的列';

/*==============================================================*/
/* Table: zl_series2                                            */
/*==============================================================*/
create table zl_series2
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SeriesID         int UNSIGNED NULL,
  Name             varchar(50),
  Code             varchar(50),
  primary key (id)
);

alter table zl_series2 comment '子系列';

/*==============================================================*/
/* Table: zl_shippingtype                                       */
/*==============================================================*/
create table zl_shippingtype
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  code             varchar(10),
  name             varchar(10),
  remark           varchar(50),
  primary key (id)
);

alter table zl_shippingtype comment '运输方式';

/*==============================================================*/
/* Table: zl_sizecontent                                        */
/*==============================================================*/
create table zl_sizecontent
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  TopID            int UNSIGNED NULL,
  Content          varchar(10),
  SortNum          int,
  Remark           varchar(100),
  primary key (id)
);

alter table zl_sizecontent comment '尺码明细';

/*==============================================================*/
/* Table: zl_sizetop                                            */
/*==============================================================*/
create table zl_sizetop
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  Code             varchar(50),
  primary key (id)
);

alter table zl_sizetop comment '尺码组';

/*==============================================================*/
/* Table: zl_storemove                                          */
/*==============================================================*/
create table zl_storemove
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  ProductID        int UNSIGNED NULL,
  StoreId          int UNSIGNED NULL,
  MoveMan          varchar(50),
  MoveDate         datetime,
  MoveState        varchar(50),
  Note             varchar(1000),
  primary key (id)
);

alter table zl_storemove comment '??未使用';

/*==============================================================*/
/* Table: zl_style                                              */
/*==============================================================*/
create table zl_style
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  StyleName        varchar(50),
  StyleMode        varchar(200),
  primary key (id)
);

alter table zl_style comment '未使用';

/*==============================================================*/
/* Table: zl_supplier_type                                      */
/*==============================================================*/
create table zl_supplier_type
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  SupplierID       int UNSIGNED NULL,
  Type             varchar(1) comment '0-供货商 1-报关行 2-供应商 3-承运人 4-客户',
  primary key (id)
);

alter table zl_supplier_type comment '关系单位类型';

/*==============================================================*/
/* Table: zl_supplierlevel                                      */
/*==============================================================*/
create table zl_supplierlevel
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  LevelName        varchar(50),
  LevelNote        varchar(100),
  primary key (id)
);

alter table zl_supplierlevel comment '供货商级别';

/*==============================================================*/
/* Table: zl_sys_selfcompany                                    */
/*==============================================================*/
create table zl_sys_selfcompany
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  supplier_id      int UNSIGNED NULL,
  primary key (id)
);

alter table zl_sys_selfcompany comment '分公司列表';

/*==============================================================*/
/* Table: zl_template_descrb                                    */
/*==============================================================*/
create table zl_template_descrb
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  TempID           int UNSIGNED NULL,
  SizeTopID        int UNSIGNED NULL,
  SizeID           int UNSIGNED NULL,
  BaseLenth        decimal(10,2),
  Lenth            decimal(10,2),
  primary key (id)
);

alter table zl_template_descrb comment '商品模板-尺码大小描述';

/*==============================================================*/
/* Table: zl_templatelist                                       */
/*==============================================================*/
create table zl_templatelist
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  TemplateName     varchar(36),
  SizeName         varchar(36),
  Content          varchar(20),
  ProductID        int UNSIGNED NULL,
  primary key (id)
);

alter table zl_templatelist comment '商品模板-数据表';

/*==============================================================*/
/* Table: zl_templatemanage                                     */
/*==============================================================*/
create table zl_templatemanage
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  TemplateName     varchar(20),
  TempID           int UNSIGNED NULL,
  SortNum          int,
  primary key (id)
);

alter table zl_templatemanage comment '商品模板-从表';

/*==============================================================*/
/* Table: zl_trans_code                                         */
/*==============================================================*/
create table zl_trans_code
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  Code             varchar(50),
  Remark           varchar(500),
  primary key (id)
);

alter table zl_trans_code comment '接口基础资料';

/*==============================================================*/
/* Table: zl_ulnarinch                                          */
/*==============================================================*/
create table zl_ulnarinch
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(50),
  primary key (id)
);

alter table zl_ulnarinch comment '任何表都应该包含的列';

/*==============================================================*/
/* Table: zl_unit                                               */
/*==============================================================*/
create table zl_unit
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  UnitName         varchar(20),
  UnitGroupID      varchar(50),
  primary key (id)
);

alter table zl_unit comment '未使用';

/*==============================================================*/
/* Table: zl_unitgroup                                          */
/*==============================================================*/
create table zl_unitgroup
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  GroupName        varchar(50),
  Crew             varchar(100),
  primary key (id)
);

alter table zl_unitgroup comment 'zl_unitgroup';

/*==============================================================*/
/* Table: zl_warehouse                                          */
/*==============================================================*/
create table zl_warehouse
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Country          varchar(36),
  City             varchar(20),
  StoreName        varchar(50),
  StoreAddress     varchar(100),
  Contact          varchar(20),
  Toll             varchar(20),
  Fax              varchar(20),
  Mobile           varchar(20),
  OtherContact     varchar(50),
  Code             varchar(20),
  DefaultStore     varchar(1),
  ZipCode          varchar(10),
  Is_real          varchar(1),
  MaxStock         bigint,
  MaxSku           bigint,
  primary key (id)
);

alter table zl_warehouse comment '仓库信息';

/*==============================================================*/
/* Table: zl_washinginstructions                                */
/*==============================================================*/
create table zl_washinginstructions
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  name             varchar(10),
  remark           varchar(50),
  image            longblob,
  primary key (id)
);

alter table zl_washinginstructions comment '洗涤标准';

/*==============================================================*/
/* Table: zl_winterproofing                                     */
/*==============================================================*/
create table zl_winterproofing
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  Name             varchar(20),
  Remark           varchar(100),
  primary key (id)
);

alter table zl_winterproofing comment '防寒指数';

/*==============================================================*/
/* Table: zl_yearexchange                                       */
/*==============================================================*/
create table zl_yearexchange
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  YearDate         varchar(50),
  Money            decimal(16,9) comment 'import:export',
  BeginTime        datetime,
  EndTime          datetime,
  Import           varchar(36),
  Export           varchar(36),
  primary key (id)
);

alter table zl_yearexchange comment '任何表都应该包含的列';

/*==============================================================*/
/* Table: 模版                                                    */
/*==============================================================*/
create table 模版
(
  id               int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  sys_create_stuff int UNSIGNED NOT NULL,
  sys_create_date  datetime not null,
  sys_modify_stuff int UNSIGNED NOT NULL,
  sys_modify_date  datetime not null,
  sys_delete_stuff int UNSIGNED NULL,
  sys_delete_date  datetime,
  sys_delete_flag  tinyint  not null comment '0-未删除 1-已删除',

  primary key (id)
);

alter table 模版 comment '任何表都应该包含的列';

alter table link_group_to_navigation
  add constraint FK_Reference_link_group_to_navigation_TO_group foreign key (groupid)
    references tb_group (id);

alter table link_rule_to_operation
  add constraint FK_Reference_link_rule_to_operationTO_rule_ID foreign key (ruleid)
    references tb_rule (id);

alter table link_user_to_rule
  add constraint FK_Reference_link_user_to_rule_To_tb_rule foreign key (ruleid)
    references tb_rule (id);

alter table link_user_to_rule
  add constraint FK_Reference_link_userid foreign key (loginid)
    references tb_user (id);

alter table tb_user
  add constraint FK_Reference_Tb_User_To_Group foreign key (groupid)
    references tb_group (id);

