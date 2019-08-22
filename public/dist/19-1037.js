webpackJsonp([19],{313:function(e,i,a){"use strict";Object.defineProperty(i,"__esModule",{value:!0});var l=a(374),n=a(426),s=a(0),t=s(l.a,n.a,!1,null,null,null);i.default=t.exports},374:function(e,i,a){"use strict";var l=a(1);i.a={name:"sp-supplier",components:{},props:{},data:function(){var e=this;return{supplier:{columns:[{name:"nickname",label:Object(l.d)("nicheng"),class:"width2",required:!0},{name:"suppliercode",label:Object(l.d)("bianma"),class:"width2",required:!0},{name:"suppliertype",label:Object(l.d)("leixing"),class:"width2",type:"select",source:"suppliertype",multiple:!0,required:!0},{name:"customtype",label:Object(l.d)("kehuleixing"),class:"width2",type:"select",source:"customtype"},{name:"suppliername",label:Object(l.d)("mingcheng"),class:"width1",required:!0},{name:"address",label:Object(l.d)("dizhi"),class:"width1",is_hide:!0},{name:"englishname",label:Object(l.d)("yingwenmingcheng"),class:"width1",is_hide:!0},{name:"englishaddress",label:Object(l.d)("yingwendizhi"),class:"width1",is_hide:!0},{name:"website",label:Object(l.d)("wangzhi"),class:"width1",is_hide:!0},{name:"countrycity",label:Object(l.d)("guojiachengshi"),class:"width2",type:"select",source:"country"},{name:"zipcode",label:Object(l.d)("youbian"),class:"width2",is_hide:!0},{name:"phone",label:Object(l.d)("dianhua"),class:"width2"},{name:"fax",label:Object(l.d)("chuanzhen"),class:"width2",is_hide:!0},{name:"linkman",label:Object(l.d)("lianxiren"),class:"width2",is_hide:!0},{name:"mobile",label:Object(l.d)("shoujihao"),class:"width2",is_hide:!0},{name:"wechat",label:Object(l.d)("weixin"),class:"width2",is_hide:!0},{name:"email",label:"Email",class:"width1",is_hide:!0}],options:{dialogWidth:"1000px",formSize:"small",inline:!0,isAutoReload:!0},controller:"supplier",formTitle:function(e){if(e)return e.nickname+" "+e.suppliername}},supplierinvoice:{columns:[{name:"name",label:Object(l.d)("mingcheng"),class:"width1",required:!0},{name:"address",label:Object(l.d)("dizhi"),class:"width1",is_hide:!0,required:!0},{name:"tax_number",label:Object(l.d)("shuihao"),class:"width2",required:!0},{name:"telephone",label:Object(l.d)("dianhua"),class:"width2",required:!0},{name:"bank",label:Object(l.d)("kaihuhang"),class:"width2",is_hide:!0,required:!0},{name:"bank_account",label:Object(l.d)("yinhangzhanghao"),class:"width2",is_hide:!0,required:!0}],controller:"supplierinvoice",auth:"supplier",base:{supplierid:""},options:{dialogWidth:"800px",inline:!0},formTitle:function(i){return e._label("kaipiaoxinxi")},initialization:{name:""}},supplierbank:{columns:[{name:"name",label:Object(l.d)("qiye"),class:"width2"},{name:"currency",label:Object(l.d)("bizhong"),class:"width2",type:"select",source:"currency",width:90},{name:"address",label:Object(l.d)("dizhi"),class:"width1",is_hide:!0},{name:"bank_name",label:Object(l.d)("yinhangmingcheng"),class:"width1"},{name:"bank_depart",label:Object(l.d)("fenhangmingcheng"),class:"width1",is_hide:!0},{name:"bank_address",label:Object(l.d)("yinhangdizhi"),class:"width1",is_hide:!0},{name:"account",label:Object(l.d)("yinhangzhanghao"),class:"width2"},{name:"bank_code",label:Object(l.d)("guojima"),class:"width2",is_hide:!0}],controller:"supplierbank",auth:"supplier",base:{supplierid:""},options:{dialogWidth:"800px",inline:!0}},supplieraddress:{columns:[{name:"name",label:Object(l.d)("shouhuoren"),class:"width2",width:120},{name:"phone",label:Object(l.d)("dianhua"),class:"width2",width:120},{name:"address",label:Object(l.d)("shouhuodizhi"),class:"width1",is_hide:!0},{name:"countryid",label:Object(l.d)("guojiadiqu"),type:"select",source:"country",class:"width2"},{name:"zipcode",label:Object(l.d)("youbian"),class:"width2",width:80,is_hide:!0},{name:"province",label:Object(l.d)("shengfen"),class:"width2",width:120},{name:"city",label:Object(l.d)("chengshi"),class:"width2",width:120}],controller:"supplieraddress",auth:"supplier",base:{supplierid:""},options:{dialogWidth:"800px",inline:!0}},supplierlinkman:{columns:[{name:"name",label:Object(l.d)("xingming"),class:"width2",width:140},{name:"mobile",label:Object(l.d)("shoujihao"),class:"width2",width:120},{name:"email",label:Object(l.d)("email"),class:"width2",is_hide:!1},{name:"fax",label:Object(l.d)("chuanzhen"),class:"width2",width:120,is_hide:!0},{name:"address",label:Object(l.d)("dizhi"),class:"width1",is_hide:!0},{name:"gender",label:Object(l.d)("xingbie"),type:"select",source:"gender2",class:"width2",width:80},{name:"zipcode",label:Object(l.d)("youbian"),class:"width2",width:80,is_hide:!0},{name:"department",label:Object(l.d)("bumen"),class:"width2",width:140},{name:"phone",label:Object(l.d)("zuoji"),class:"width2",width:120,is_hide:!0}],controller:"supplierlinkman",auth:"supplier",base:{supplierid:""},options:{dialogWidth:"800px",inline:!0}},dialogVisible:!1,currentTab:"invoice",title:"",activeName:"info",id:0,suppliertype:""}},methods:{onBeforeEdit:function(e){var i=this;i.supplierinvoice.base.supplierid=e.id,i.supplierinvoice.columns[0].default=e.suppliername,i.supplierbank.base.supplierid=e.id,i.supplierbank.columns[0].default=e.suppliername,i.supplieraddress.base.supplierid=e.id,i.supplierlinkman.base.supplierid=e.id,i.supplierlinkman.columns[4].default=e.address,i.id=e.id},onBeforeAdd:function(){var e=this;e.activeName="info",e.id=0},onTabClick:function(){},onChange:function(e,i){var a=this;if("suppliertype"==e.name)l.c.include(i.suppliertype,"2")||(i.customtype="");else if("countrycity"==e.name){var n=a._dataSource("country");n.getRow(i.countrycity).then(function(e){var a=e.row;""==i.phone&&(i.phone=a.area_code+"-")})}},isDisabled:function(e,i){return"customtype"==e.name&&!l.c.include(i.suppliertype,2)},onAfterUpdate:function(){this._dataSource("supplier").clear()}},mounted:function(){var e=this;e.initRules(function(i){var a=e._label;return{sizetopid:i.id({required:!0,message:a("8000"),label:a("chimazu")}),brandgroupid:i.id({required:!0,message:a("8000"),label:a("pinlei")}),childbrand:i.id({required:!0,message:a("8000"),label:a("zipinlei")}),brandid:i.id({required:!0,message:a("8000"),label:a("pinpai")}),brandcolor:i.required({message:a("8000"),label:a("sexi")}),ageseason:i.required({message:a("8000"),label:a("niandai")}),sizecontentids:i.required({message:a("8000"),label:a("chimamingxi")})}})}}},426:function(e,i,a){"use strict";var l=function(){var e=this,i=e.$createElement,a=e._self._c||i;return a("div",[a("simple-admin-page",e._b({ref:"page",on:{"before-edit":e.onBeforeEdit,"before-add":e.onBeforeAdd,"after-update":e.onAfterUpdate},scopedSlots:e._u([{key:"default",fn:function(i){var l=i.form,n=i.columns;return[a("el-tabs",{attrs:{type:"border-card"},on:{"tab-click":e.onTabClick},model:{value:e.activeName,callback:function(i){e.activeName=i},expression:"activeName"}},[a("el-tab-pane",{attrs:{label:e._label("jibenziliao"),name:"info"}},[a("el-form",{ref:"form",staticClass:"user-form",attrs:{model:l,"label-width":"100px",inline:!0,size:"mini"}},e._l(n,function(i){return i.is_edit_hide?e._e():a("el-form-item",{key:i.name,class:i.class?i.class:"width2",attrs:{label:i.label}},[i.type&&"input"!=i.type&&"textarea"!=i.type?e._e():a("el-input",{ref:i.name,refInFor:!0,attrs:{type:i.type?i.type:"text",size:"mini"},nativeOn:{keyup:function(i){return!i.type.indexOf("key")&&e._k(i.keyCode,"enter",13,i.key,"Enter")?null:e.onSubmit(i)}},model:{value:l[i.name],callback:function(a){e.$set(l,i.name,a)},expression:"form[item.name]"}}),e._v(" "),"select"==i.type?a("simple-select",{ref:i.name,refInFor:!0,attrs:{source:i.source,disabled:e.isDisabled(i,l),multiple:i.multiple||!1},on:{change:function(a){return e.onChange(i,l)}},model:{value:l[i.name],callback:function(a){e.$set(l,i.name,a)},expression:"form[item.name]"}}):e._e()],1)}),1)],1),e._v(" "),a("el-tab-pane",{attrs:{label:e._label("kaipiaoxinxi"),name:"invoice",disabled:0==e.id}},[a("simple-admin-page",e._b({},"simple-admin-page",e.supplierinvoice,!1))],1),e._v(" "),a("el-tab-pane",{attrs:{label:e._label("kaihuhang"),name:"bank",disabled:0==e.id}},[a("simple-admin-page",e._b({},"simple-admin-page",e.supplierbank,!1))],1),e._v(" "),a("el-tab-pane",{attrs:{label:e._label("shouhuodizhi"),name:"supplieraddress",disabled:0==e.id}},[a("simple-admin-page",e._b({},"simple-admin-page",e.supplieraddress,!1))],1),e._v(" "),a("el-tab-pane",{attrs:{label:e._label("lianxiren"),name:"supplierlinkman",disabled:0==e.id}},[a("simple-admin-page",e._b({attrs:{isExpand:!0},scopedSlots:e._u([{key:"expand",fn:function(i){var l=i.row;return[a("el-form",{staticClass:"demo-table-expand",attrs:{"label-position":"left"}},[a("el-form-item",{attrs:{label:"姓名"}},[a("span",[e._v(e._s(l.name))])]),e._v(" "),a("el-form-item",{attrs:{label:e._label("email")}},[a("span",[e._v(e._s(l.email))])]),e._v(" "),a("el-form-item",{attrs:{label:e._label("chuanzhen")}},[a("span",[e._v(e._s(l.fax))])]),e._v(" "),a("el-form-item",{attrs:{label:e._label("zuoji")}},[a("span",[e._v(e._s(l.phone))])]),e._v(" "),a("el-form-item",{attrs:{label:e._label("youbian")}},[a("span",[e._v(e._s(l.zipcode))])]),e._v(" "),a("el-form-item",{attrs:{label:e._label("dizhi")}},[a("span",[e._v(e._s(l.address))])]),e._v(" "),a("el-form-item",{attrs:{label:e._label("bumen")}},[a("span",[e._v(e._s(l.department))])])],1)]}}],null,!0)},"simple-admin-page",e.supplierlinkman,!1))],1)],1)]}}])},"simple-admin-page",e.supplier,!1))],1)},n=[],s={render:l,staticRenderFns:n};i.a=s}});
//# sourceMappingURL=19-1037.js.map