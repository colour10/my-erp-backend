webpackJsonp([12],{296:function(e,a,i){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var l=i(331),n=i(369),s=i(0),t=s(l.a,n.a,!1,null,null,null);a.default=t.exports},331:function(e,a,i){"use strict";var l=i(1),n=i(5);a.a={name:"sp-supplier",components:{},props:{},data:function(){var e=this;return{supplier:{columns:[{name:"nickname",label:Object(l.d)("nicheng"),class:"width2"},{name:"suppliercode",label:Object(l.d)("bianma"),class:"width2"},{name:"suppliertype",label:Object(l.d)("leixing"),class:"width2",type:"select",source:"suppliertype",multiple:!0},{name:"customtype",label:Object(l.d)("kehuleixing"),class:"width2",type:"select",source:"customtype"},{name:"suppliername",label:Object(l.d)("mingcheng"),class:"width1"},{name:"address",label:Object(l.d)("dizhi"),class:"width1",is_hide:!0},{name:"englishname",label:Object(l.d)("yingwenmingcheng"),class:"width1",is_hide:!0},{name:"englishaddress",label:Object(l.d)("yingwendizhi"),class:"width1",is_hide:!0},{name:"website",label:Object(l.d)("wangzhi"),class:"width1",is_hide:!0},{name:"countrycity",label:Object(l.d)("guojiachengshi"),class:"width2",type:"select",source:"country"},{name:"zipcode",label:Object(l.d)("youbian"),class:"width2",is_hide:!0},{name:"phone",label:Object(l.d)("dianhua"),class:"width2"},{name:"fax",label:Object(l.d)("chuanzhen"),class:"width2",is_hide:!0},{name:"linkman",label:Object(l.d)("lianxiren"),class:"width2",is_hide:!0},{name:"mobile",label:Object(l.d)("shoujihao"),class:"width2",is_hide:!0},{name:"wechat",label:Object(l.d)("weixin"),class:"width2",is_hide:!0},{name:"email",label:"Email",class:"width1",is_hide:!0}],options:{dialogWidth:"1000px",formSize:"small",inline:!0,isAutoReload:!0},controller:"supplier",formTitle:function(e){if(e)return e.nickname+" "+e.suppliername}},supplierinvoice:{columns:[{name:"name",label:Object(l.d)("mingcheng"),class:"width1"},{name:"address",label:Object(l.d)("dizhi"),class:"width1",is_hide:!0},{name:"tax_number",label:Object(l.d)("shuihao"),class:"width2"},{name:"telephone",label:Object(l.d)("dianhua"),class:"width2"},{name:"bank",label:Object(l.d)("kaihuhang"),class:"width2",is_hide:!0},{name:"bank_account",label:Object(l.d)("yinhangzhanghao"),class:"width2",is_hide:!0}],controller:"supplierinvoice",auth:"supplier",base:{supplierid:""},options:{dialogWidth:"800px",inline:!0},formTitle:function(a){return e._label("kaipiaoxinxi")},initialization:{name:""}},supplierbank:{columns:[{name:"name",label:Object(l.d)("qiye"),class:"width2"},{name:"currency",label:Object(l.d)("bizhong"),class:"width2",type:"select",source:"currency",width:90},{name:"address",label:Object(l.d)("dizhi"),class:"width1",is_hide:!0},{name:"bank_name",label:Object(l.d)("yinhangmingcheng"),class:"width1"},{name:"bank_depart",label:Object(l.d)("fenhangmingcheng"),class:"width1",is_hide:!0},{name:"bank_address",label:Object(l.d)("yinhangdizhi"),class:"width1",is_hide:!0},{name:"account",label:Object(l.d)("yinhangzhanghao"),class:"width2"},{name:"bank_code",label:Object(l.d)("guojima"),class:"width2",is_hide:!0}],controller:"supplierbank",auth:"supplier",base:{supplierid:""},options:{dialogWidth:"800px",inline:!0}},supplieraddress:{columns:[{name:"name",label:Object(l.d)("shouhuoren"),class:"width2",width:120},{name:"phone",label:Object(l.d)("dianhua"),class:"width2",width:120},{name:"address",label:Object(l.d)("shouhuodizhi"),class:"width1",is_hide:!0},{name:"countryid",label:Object(l.d)("guojiadiqu"),type:"select",source:"country",class:"width2"},{name:"zipcode",label:Object(l.d)("youbian"),class:"width2",width:80,is_hide:!0},{name:"province",label:Object(l.d)("shengfen"),class:"width2",width:120},{name:"city",label:Object(l.d)("chengshi"),class:"width2",width:120}],controller:"supplieraddress",auth:"supplier",base:{supplierid:""},options:{dialogWidth:"800px",inline:!0}},supplierlinkman:{columns:[{name:"name",label:Object(l.d)("xingming"),class:"width2",width:140},{name:"mobile",label:Object(l.d)("shoujihao"),class:"width2",width:120},{name:"email",label:Object(l.d)("email"),class:"width2",is_hide:!1},{name:"fax",label:Object(l.d)("chuanzhen"),class:"width2",width:120,is_hide:!0},{name:"address",label:Object(l.d)("dizhi"),class:"width1",is_hide:!0},{name:"gender",label:Object(l.d)("xingbie"),type:"select",source:"gender2",class:"width2",width:80},{name:"zipcode",label:Object(l.d)("youbian"),class:"width2",width:80,is_hide:!0},{name:"department",label:Object(l.d)("bumen"),class:"width2",width:140},{name:"phone",label:Object(l.d)("zuoji"),class:"width2",width:120,is_hide:!0}],controller:"supplierlinkman",auth:"supplier",base:{supplierid:""},options:{dialogWidth:"800px",inline:!0}},dialogVisible:!1,currentTab:"invoice",title:"",activeName:"info",id:0,suppliertype:""}},methods:{onBeforeEdit:function(e){var a=this;a.supplierinvoice.base.supplierid=e.id,a.supplierinvoice.columns[0].default=e.suppliername,a.supplierbank.base.supplierid=e.id,a.supplierbank.columns[0].default=e.suppliername,a.supplieraddress.base.supplierid=e.id,a.supplierlinkman.base.supplierid=e.id,a.supplierlinkman.columns[4].default=e.address,a.id=e.id},onBeforeAdd:function(){var e=this;e.activeName="info",e.id=0},onTabClick:function(){},onChange:function(e,a){var i=this;if("suppliertype"==e.name)l.c.include(a.suppliertype,"2")||(a.customtype="");else if("countrycity"==e.name){var s=n.b.getDataSource("country",i._label("lang"));s.getRow(a.countrycity).then(function(e){var i=e.row;""==a.phone&&(a.phone=i.area_code+"-")})}},isDisabled:function(e,a){return"customtype"==e.name&&!l.c.include(a.suppliertype,2)},onAfterUpdate:function(){n.b.getDataSource("supplier",this._label("lang")).clear()}}}},369:function(e,a,i){"use strict";var l=function(){var e=this,a=e.$createElement,i=e._self._c||a;return i("div",[i("simple-admin-page",e._b({ref:"page",on:{"before-edit":e.onBeforeEdit,"before-add":e.onBeforeAdd,"after-update":e.onAfterUpdate},scopedSlots:e._u([{key:"default",fn:function(a){var l=a.form,n=a.columns;return[i("el-tabs",{attrs:{type:"border-card"},on:{"tab-click":e.onTabClick},model:{value:e.activeName,callback:function(a){e.activeName=a},expression:"activeName"}},[i("el-tab-pane",{attrs:{label:e._label("jibenziliao"),name:"info"}},[i("el-form",{ref:"form",staticClass:"user-form",attrs:{model:l,"label-width":"100px",inline:!0,size:"mini"}},e._l(n,function(a){return a.is_edit_hide?e._e():i("el-form-item",{key:a.name,class:a.class?a.class:"width2",attrs:{label:a.label}},[a.type&&"input"!=a.type&&"textarea"!=a.type?e._e():i("el-input",{ref:a.name,refInFor:!0,attrs:{type:a.type?a.type:"text",size:"mini"},nativeOn:{keyup:function(a){return!a.type.indexOf("key")&&e._k(a.keyCode,"enter",13,a.key,"Enter")?null:e.onSubmit(a)}},model:{value:l[a.name],callback:function(i){e.$set(l,a.name,i)},expression:"form[item.name]"}}),e._v(" "),"select"==a.type?i("simple-select",{ref:a.name,refInFor:!0,attrs:{source:a.source,disabled:e.isDisabled(a,l),multiple:a.multiple||!1},on:{change:function(i){return e.onChange(a,l)}},model:{value:l[a.name],callback:function(i){e.$set(l,a.name,i)},expression:"form[item.name]"}}):e._e()],1)}),1)],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("kaipiaoxinxi"),name:"invoice",disabled:0==e.id}},[i("simple-admin-page",e._b({},"simple-admin-page",e.supplierinvoice,!1))],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("kaihuhang"),name:"bank",disabled:0==e.id}},[i("simple-admin-page",e._b({},"simple-admin-page",e.supplierbank,!1))],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("shouhuodizhi"),name:"supplieraddress",disabled:0==e.id}},[i("simple-admin-page",e._b({},"simple-admin-page",e.supplieraddress,!1))],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("lianxiren"),name:"supplierlinkman",disabled:0==e.id}},[i("simple-admin-page",e._b({attrs:{isExpand:!0},scopedSlots:e._u([{key:"expand",fn:function(a){var l=a.row;return[i("el-form",{staticClass:"demo-table-expand",attrs:{"label-position":"left"}},[i("el-form-item",{attrs:{label:"姓名"}},[i("span",[e._v(e._s(l.name))])]),e._v(" "),i("el-form-item",{attrs:{label:e._label("email")}},[i("span",[e._v(e._s(l.email))])]),e._v(" "),i("el-form-item",{attrs:{label:e._label("chuanzhen")}},[i("span",[e._v(e._s(l.fax))])]),e._v(" "),i("el-form-item",{attrs:{label:e._label("zuoji")}},[i("span",[e._v(e._s(l.phone))])]),e._v(" "),i("el-form-item",{attrs:{label:e._label("youbian")}},[i("span",[e._v(e._s(l.zipcode))])]),e._v(" "),i("el-form-item",{attrs:{label:e._label("dizhi")}},[i("span",[e._v(e._s(l.address))])]),e._v(" "),i("el-form-item",{attrs:{label:e._label("bumen")}},[i("span",[e._v(e._s(l.department))])])],1)]}}],null,!0)},"simple-admin-page",e.supplierlinkman,!1))],1)],1)]}}])},"simple-admin-page",e.supplier,!1))],1)},n=[],s={render:l,staticRenderFns:n};a.a=s}});
//# sourceMappingURL=12-1010.js.map