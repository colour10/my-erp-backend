webpackJsonp([26],{276:function(e,a,l){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var t=l(369),r=l(434),o=l(0),s=o(t.a,r.a,!1,null,null,null);a.default=s.exports},369:function(e,a,l){"use strict";var t=l(74),r=l.n(t),o=l(2);a.a={name:"sp-user",data:function(){var e;return{dialogVisible:!1,form:(e={id:"",login_name:"",real_name:"",password:"",departmentid:"",companyid:"",groupid:"",storeid:"",sex:""},r()(e,"storeid",""),r()(e,"section",""),r()(e,"date",""),r()(e,"phone",""),r()(e,"mobilephone",""),r()(e,"e_mail",""),r()(e,"email_password",""),r()(e,"comment",""),r()(e,"countryid",""),r()(e,"address",""),r()(e,"saleportid",""),r()(e,"priceid",""),r()(e,"warehouseid",""),e),saleport:[],warehouse:[],currentTab:"user",saleport_list:[],saleport_loaded:!1,warehouse_list:[],warehouse_loaded:!1,props:{columns:[{name:"login_name",label:Object(o.d)("dengluming"),is_create:!0,is_update:!0,is_show:!0,is_focus:!0,width:200},{name:"real_name",label:Object(o.d)("xingming"),is_create:!0,is_update:!0,is_show:!0,width:200,is_focus:!0}],controller:"user"},props2:{columns:[{name:"warehouseid",label:Object(o.d)("cangku"),type:"select",source:"warehouse"},{name:"warehouseroleid",label:Object(o.d)("juese"),type:"select",source:"warehouserole"}],controller:"warehouseuser",base:{userid:""}},userprice:{columns:[{name:"priceid",label:Object(o.d)("jiage"),type:"select",source:"price"}],controller:"userprice",base:{userid:""},options:{isSearch:!1}}}},methods:{onQuit:function(){this.dialogVisible=!1},onSubmit:function(){var e=this;e.validate().then(function(){var a=o.f.extend({saleportids:e.saleport.join(",")},e.form);""==e.form.id?e._submit("/user/add",a).then(function(){e.$refs.tablelist.appendRow(o.f.clone(e.form))}):(a.id=e.form.id,e._submit("/user/edit",a).then(function(){o.f.copyTo(e.form,e.row)}))})},onTabClick:function(e){var a=this;a.currentTab=e.name,"saleport"==e.name&&0==a.saleport_loaded?(a.saleport_loaded=!0,a._fetch("/l/saleport",{}).then(function(e){a.saleport_list=e.data})):"warehouse"==e.name&&0==a.warehouse_loaded&&(a.warehouse_loaded=!0,a._fetch("/l/warehouse",{}).then(function(e){a.warehouse_list=e.data}))},showFormToEdit:function(e,a){var l=this;l.rowIndex=e,l.row=a,o.f.copyTo(a,this.form),l.saleport=a.saleportids?a.saleportids.split(","):[],l.props2.base.userid=a.id,l.userprice.base.userid=a.id,l.showDialog()},showDialog:function(){this.dialogVisible=!0},showFormToCreate:function(){var e=this;o.f.empty(e.form),e.clearValidate(50),e.showDialog()}}}},434:function(e,a,l){"use strict";var t=function(){var e=this,a=e.$createElement,l=e._self._c||a;return l("div",[l("el-row",[l("el-col",{attrs:{span:2}},[l("auth",{attrs:{auth:"user"}},[l("as-button",{attrs:{type:"primary"},on:{click:function(a){return e.showFormToCreate()}}},[e._v(e._s(e._label("button-create")))])],1)],1)],1),e._v(" "),l("el-row",{attrs:{gutter:20}},[l("el-col",{attrs:{span:24}},[l("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{onclickupdate:e.showFormToEdit}},"simple-admin-tablelist",e.props,!1))],1)],1),e._v(" "),l("el-dialog",{staticClass:"user-form user-dialog",attrs:{title:e._label("yonghuxinxi"),visible:e.dialogVisible,center:!0,width:"700px"},on:{"update:visible":function(a){e.dialogVisible=a}}},[l("el-tabs",{attrs:{type:"border-card",activeName:"user"},on:{"tab-click":e.onTabClick}},[l("el-tab-pane",{attrs:{label:e._label("user-setting"),name:"user"}},[l("el-form",{ref:"order-form",staticClass:"order-form",staticStyle:{width:"700px"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"small",rules:e.formRules,"inline-message":!1,"show-message":!1}},[l("el-col",{attrs:{span:11}},[l("el-form-item",{attrs:{label:e._label("user-loginname"),prop:"login_name"}},[l("el-input",{model:{value:e.form.login_name,callback:function(a){e.$set(e.form,"login_name",a)},expression:"form.login_name"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("user-realname")}},[l("el-input",{model:{value:e.form.real_name,callback:function(a){e.$set(e.form,"real_name",a)},expression:"form.real_name"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("depart")}},[l("simple-select",{attrs:{source:"department.single"},model:{value:e.form.departmentid,callback:function(a){e.$set(e.form,"departmentid",a)},expression:"form.departmentid"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("country")}},[l("simple-select",{attrs:{source:"country"},model:{value:e.form.countryid,callback:function(a){e.$set(e.form,"countryid",a)},expression:"form.countryid"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("user-join")}},[l("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd",placeholder:e._label("xuanzeriqi")},model:{value:e.form.date,callback:function(a){e.$set(e.form,"date",a)},expression:"form.date"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("telephone")}},[l("el-input",{model:{value:e.form.phone,callback:function(a){e.$set(e.form,"phone",a)},expression:"form.phone"}})],1)],1),e._v(" "),l("el-col",{attrs:{span:12}},[l("el-form-item",{attrs:{label:e._label("password")}},[l("el-input",{model:{value:e.form.password,callback:function(a){e.$set(e.form,"password",a)},expression:"form.password"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("gender")}},[l("el-radio-group",{staticStyle:{width:"200px"},model:{value:e.form.sex,callback:function(a){e.$set(e.form,"sex",a)},expression:"form.sex"}},[l("el-radio",{attrs:{label:"1"}},[e._v(e._s(e._label("man")))]),e._v(" "),l("el-radio",{attrs:{label:"0"}},[e._v(e._s(e._label("woman")))])],1)],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("zu")}},[l("simple-select",{staticStyle:{width:"150"},attrs:{source:"group"},model:{value:e.form.groupid,callback:function(a){e.$set(e.form,"groupid",a)},expression:"form.groupid"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("email")}},[l("el-input",{model:{value:e.form.e_mail,callback:function(a){e.$set(e.form,"e_mail",a)},expression:"form.e_mail"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("user-left")}},[l("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd",placeholder:e._label("xuanzeriqi")},model:{value:e.form.leave_date,callback:function(a){e.$set(e.form,"leave_date",a)},expression:"form.leave_date"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("mobile")}},[l("el-input",{model:{value:e.form.mobilephone,callback:function(a){e.$set(e.form,"mobilephone",a)},expression:"form.mobilephone"}})],1)],1)],1)],1),e._v(" "),l("el-tab-pane",{attrs:{label:e._label("sale-port"),name:"saleport"}},[l("el-checkbox-group",{model:{value:e.saleport,callback:function(a){e.saleport=a},expression:"saleport"}},e._l(e.saleport_list,function(a){return l("el-col",{key:a.id,attrs:{span:6}},[l("el-checkbox",{attrs:{label:a.id}},[e._v(e._s(a.name))])],1)}),1)],1),e._v(" "),l("el-tab-pane",{attrs:{label:e._label("cangku"),name:"warehouse"}},[l("simple-admin-page",e._b({ref:"page2"},"simple-admin-page",e.props2,!1))],1),e._v(" "),l("el-tab-pane",{attrs:{label:e._label("jiage"),name:"userprice"}},[l("simple-admin-page",e._b({ref:"userprice"},"simple-admin-page",e.userprice,!1))],1),e._v(" "),l("el-tab-pane",{attrs:{label:e._label("morenshezhi"),name:"setting"}},[l("el-form",{staticClass:"order-form",staticStyle:{width:"700px"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"small"}},[l("el-form-item",{attrs:{label:e._label("xiaoshouduankou")}},[l("simple-select",{attrs:{source:"usersaleport"},model:{value:e.form.saleportid,callback:function(a){e.$set(e.form,"saleportid",a)},expression:"form.saleportid"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("jiage")}},[l("simple-select",{attrs:{source:"userprice"},model:{value:e.form.priceid,callback:function(a){e.$set(e.form,"priceid",a)},expression:"form.priceid"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("xiaoshoucangku")}},[l("simple-select",{attrs:{source:"userwarehouse"},model:{value:e.form.warehouseid,callback:function(a){e.$set(e.form,"warehouseid",a)},expression:"form.warehouseid"}})],1)],1)],1)],1),e._v(" "),l("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[l("auth",{attrs:{auth:"user"}},[l("as-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e._label("baocun")))])],1),e._v(" "),l("as-button",{attrs:{type:"primary"},on:{click:e.onQuit}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)},r=[],o={render:t,staticRenderFns:r};a.a=o}});