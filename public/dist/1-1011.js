webpackJsonp([1],{289:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=a(321),i=a(363),l=a(0),r=l(n.a,i.a,!1,null,null,null);e.default=r.exports},321:function(t,e,a){"use strict";var n=a(1),i=a(359),l=a(361);e.a={name:"sp-requisition",components:{"asa-requisition-dialog":i.a,"asa-requisition-detail-dialog":l.a},props:{},data:function(){return{props:{columns:[{name:"out_id",label:Object(n.d)("diaochuku"),type:"select",source:"warehouse"},{name:"in_id",label:Object(n.d)("diaoruku"),type:"select",source:"warehouse"},{name:"apply_staff",label:Object(n.d)("shenqingren"),type:"select",source:"user"},{name:"status",label:Object(n.d)("zhuangtai"),type:"select",source:"requisitionstatus"}],controller:"requisition"},visibleDialog:!1,info:{},rowIndex:-1,visibleDetailDialog:!1}},methods:{showForm:function(){this.visibleDialog=!0},showFormToCreate:function(){this.$router.push("/requisition/create")},showFormToEdit:function(t,e){this.$router.push("/requisition/edit/"+e.id)},onChange:function(){var t=this;t.visibleDialog=!1,t.$refs.tablelist.loadList()},onRowChange:function(){this.$refs.tablelist.loadList()},isEditable:function(t){var e=t.status;return"1"==e||""==e||!e},onSearch:function(){this.$refs.tablelist.search()}},computed:{},watch:{},mounted:function(){}}},322:function(t,e,a){"use strict";var n=a(26),i=a.n(n),l=a(1),r=a(176),o=a(177),s=a(178),u=(a(5),a(73));Object(u.b)("product"),Object(u.b)("warehouse");e.a={name:"asa-requisition-dialog",components:{"simple-select":r.a,"asa-select-product-dialog":o.a,search:s.a},props:{visible:{type:Boolean},data:{type:Object}},data:function(){return{form:{allin:0,out_id:"",in_id:"",memo:""},tabledata:[],dialogVisible:this.visible,lang:Object(l.d)("lang")}},methods:{onQuit:function(){this.dialogVisible=!1},onSelect:function(t){var e=this;e.tabledata.findIndex(function(e){return e.id==t.id})<0&&(t.select_number=1,t.number=1*t.number,t.in_id="",e.tabledata.unshift(t))},saveOrder:function(t){var e=this;if(confirm(e._label("order_submit_confirm"))){var a={form:e.form};a.list=e.tabledata.map(function(t){return 1==e.form.allin?{out_id:t.warehouseid,productstockid:t.id,number:t.select_number,in_id:e.form.in_id}:{out_id:t.warehouseid,productstockid:t.id,number:t.select_number,in_id:t.in_id}}),e._log(i()(a)),e._submit("/requisition/save",{params:i()(a)}).then(function(t){e.$emit("change")})}}},computed:{},watch:{dialogVisible:function(t){this.$emit("update:visible",t)},visible:function(t){this.dialogVisible=t}},mounted:function(){}}},323:function(t,e,a){"use strict";var n=a(26),i=a.n(n),l=a(1),r=a(176),o=a(177),s=a(5),u=a(73),c=Object(u.b)("product"),d=Object(u.b)("warehouse"),m=Object(u.b)("user");e.a={name:"asa-requisition-detail-dialog",components:{"simple-select":r.a,"asa-select-product-dialog":o.a},props:{visible:{type:Boolean},data:{type:Object}},data:function(){return{form:{apply_username:"",turnout_username:"",turnin_username:"",out_name:"",in_name:"",memo:"",status_name:""},rowdata:{status:"",apply_date:"",turnin_date:"",turnout_date:""},tabledata:[],dialogVisible:this.visible,lang:Object(l.d)("lang")}},methods:{onQuit:function(){this.dialogVisible=!1},getDataSource:function(){return s.b.getDataSource("requisitionstatus",Object(l.d)("lang"))},init:function(t){var e=this,a=this.form;e._log(e.rowdata,t),l.f.copyTo(t,e.rowdata),t.apply_staff&&m(t.apply_staff,function(t){return a.apply_username=t.login_name}),t.turnin_staff&&m(t.turnin_staff,function(t){return a.turnin_username=t.login_name}),t.turnout_staff&&m(t.turnout_staff,function(t){return a.turnout_username=t.login_name}),t.out_id&&d(t.out_id,function(t){return a.out_name=t.name}),t.in_id&&d(t.in_id,function(t){return a.in_name=t.name}),t.status&&e.getDataSource().getRow(t.status,function(t){return a.status_name=t.getLabel()}),t.id&&(e.tabledata=[],e._fetch("/requisition/load",{requisitionid:t.id}).then(function(t){e._log("调拨单列表",t);var a=s.b.getDataSource("sizecontent",Object(l.d)("lang"));t.data.forEach(function(t){t.sizecontentname="",a.getRow(t.sizecontentid,function(e){t.sizecontentname=e.getLabel()}),t.productname="",c(t.productid,function(e){return t.productname=e.productname}),t.number*=1,t.select_number=t.number,e.tabledata.push(t)}),e.$refs.list.$forceUpdate()}))},doAction:function(t){var e=this;if(confirm(e._label("order_submit_confirm"))){var a={id:e.data.id},n={},l=0,r=0;e.tabledata.forEach(function(t){n[t.id]=t.select_number,l+=t.select_number,r+=t.number}),a.total="",0==l?a.total="deny":r==l&&(a.total="allow"),a.list=n,e._log(i()(a)),e._submit("/requisition/"+t,{params:i()(a)}).then(function(t){e.$emit("change",t.data),e.init(t.data)})}},confirmout:function(){this.doAction("confirmout")},confirmin:function(){this.doAction("confirmin")}},computed:{},watch:{dialogVisible:function(t){this.$emit("update:visible",t)},visible:function(t){this.dialogVisible=t},data:function(t){this.init(t)}},mounted:function(){var t=this;t.init(t.data)}}},359:function(t,e,a){"use strict";var n=a(322),i=a(360),l=a(0),r=l(n.a,i.a,!1,null,null,null);e.a=r.exports},360:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("el-dialog",{attrs:{visible:t.dialogVisible,center:!0,fullscreen:!0,modal:!1},on:{"update:visible":function(e){t.dialogVisible=e}}},[a("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:t.form,"label-width":"85px",inline:!0,size:"mini"}},[a("el-row",{attrs:{gutter:0}},[a("el-col",{attrs:{span:6}},[a("el-form-item",{attrs:{label:t._label("tongyidiaoru")}},[a("el-switch",{attrs:{"active-value":"1","inactive-value":"0"},model:{value:t.form.allin,callback:function(e){t.$set(t.form,"allin",e)},expression:"form.allin"}})],1),t._v(" "),a("el-form-item",{attrs:{label:t._label("diaoruku")}},[a("simple-select",{attrs:{source:"warehouse",lang:t.lang,disabled:0==t.form.allin},model:{value:t.form.in_id,callback:function(e){t.$set(t.form,"in_id",e)},expression:"form.in_id"}})],1)],1),t._v(" "),a("el-col",{attrs:{span:6}},[a("el-form-item",{attrs:{label:t._label("beizhu")}},[a("el-input",{model:{value:t.form.memo,callback:function(e){t.$set(t.form,"memo",e)},expression:"form.memo"}})],1)],1),t._v(" "),a("el-col",{attrs:{span:6}}),t._v(" "),a("el-col",{attrs:{span:6}},[a("el-row",{attrs:{type:"flex",justify:"start"}},[a("auth",{attrs:{auth:"requisition"}},[a("as-button",{attrs:{type:"primary"},on:{click:function(e){return t.saveOrder(1)}}},[t._v(t._s(t._label("shenqing")))])],1),t._v(" "),a("as-button",{attrs:{type:"primary"},on:{click:t.onQuit}},[t._v(t._s(t._label("tuichu")))])],1)],1)],1)],1),t._v(" "),a("el-row",{attrs:{type:"flex",justify:"end"}},[a("el-col",{attrs:{span:24}},[a("search",{on:{select:t.onSelect}})],1)],1),t._v(" "),a("el-row",[a("el-col",{attrs:{span:24}},[a("el-table",{staticStyle:{width:"100%"},attrs:{data:t.tabledata,stripe:"",border:""}},[a("el-table-column",{attrs:{prop:"productname",label:t._label("chanpinmingcheng"),align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){return[t._v("\n                            "+t._s(e.row.product.productname)+"\n                        ")]}}])}),t._v(" "),a("el-table-column",{attrs:{prop:"sizecontent_label",label:t._label("chima"),width:"100",align:"center"}}),t._v(" "),a("el-table-column",{attrs:{prop:"warehousename",label:t._label("cangku"),width:"100",align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){return[t._v("\n                            "+t._s(e.row.warehouse.name)+"\n                        ")]}}])}),t._v(" "),a("el-table-column",{attrs:{prop:"number",label:t._label("kucunshuliang"),width:"200",align:"center"}}),t._v(" "),a("el-table-column",{attrs:{prop:"select_number",label:t._label("diaorucangku"),width:"200",align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){return[1!=t.form.allin?a("simple-select",{attrs:{source:"warehouse",lang:t.lang},model:{value:e.row.in_id,callback:function(a){t.$set(e.row,"in_id",a)},expression:"scope.row.in_id"}}):t._e(),t._v(" "),1==t.form.allin?a("simple-select",{attrs:{source:"warehouse",lang:t.lang,disabled:""},model:{value:t.form.in_id,callback:function(e){t.$set(t.form,"in_id",e)},expression:"form.in_id"}}):t._e()]}}])}),t._v(" "),a("el-table-column",{attrs:{prop:"select_number",label:t._label("diaoboshuliang"),width:"200",align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("el-input-number",{attrs:{min:1,max:1*e.row.number},model:{value:e.row.select_number,callback:function(a){t.$set(e.row,"select_number",a)},expression:"scope.row.select_number"}})]}}])}),t._v(" "),a("el-table-column",{attrs:{label:t._label("caozuo"),width:"150",align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("as-button",{attrs:{size:"mini",type:"danger"},on:{click:function(a){return t.deleteRow(e.$index,e.row)}}},[t._v(t._s(t._label("shanchu")))])]}}])})],1)],1)],1)],1)],1)},i=[],l={render:n,staticRenderFns:i};e.a=l},361:function(t,e,a){"use strict";var n=a(323),i=a(362),l=a(0),r=l(n.a,i.a,!1,null,null,null);e.a=r.exports},362:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("el-dialog",{attrs:{visible:t.dialogVisible,center:!0,fullscreen:!0,modal:!1},on:{"update:visible":function(e){t.dialogVisible=e}}},[a("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:t.form,"label-width":"85px",inline:!0,size:"mini"}},[a("el-row",{attrs:{gutter:0}},[a("el-col",{attrs:{span:6}},[a("el-form-item",{attrs:{label:t._label("shenqingren")}},[t._v("\n                        "+t._s(t.form.apply_username)+"\n                    ")]),t._v(" "),a("el-form-item",{attrs:{label:t._label("shenqingriqi")}},[t._v("\n                        "+t._s(t.rowdata.apply_date)+"\n                    ")]),t._v(" "),a("el-form-item",{attrs:{label:t._label("zhuangtai")}},[t._v("\n                        "+t._s(t.form.status_name)+"\n                    ")])],1),t._v(" "),a("el-col",{attrs:{span:6}},[a("el-form-item",{attrs:{label:t._label("chukuqueren")}},[t._v("\n                        "+t._s(t.form.turnout_username)+"\n                    ")]),t._v(" "),a("el-form-item",{attrs:{label:t._label("chukushijian")}},[t._v("\n                        "+t._s(t.rowdata.turnout_date)+"\n                    ")]),t._v(" "),a("el-form-item",{attrs:{label:t._label("diaochucangku")}},[t._v("\n                        "+t._s(t.form.out_name)+"\n                    ")])],1),t._v(" "),a("el-col",{attrs:{span:6}},[a("el-form-item",{attrs:{label:t._label("rukuqueren")}},[t._v("\n                        "+t._s(t.form.turnin_username)+"\n                    ")]),t._v(" "),a("el-form-item",{attrs:{label:t._label("rukushijian")}},[t._v("\n                        "+t._s(t.rowdata.turnin_date)+"\n                    ")]),t._v(" "),a("el-form-item",{attrs:{label:t._label("diaorucangku")}},[t._v("\n                        "+t._s(t.form.in_name)+"\n                    ")])],1),t._v(" "),a("el-col",{attrs:{span:6}},[a("el-row",{attrs:{type:"flex",justify:"start"}},[a("as-button",{attrs:{type:2==t.rowdata.status?"primary":"info"},on:{click:function(e){return t.saveOrder(1)}}},[t._v(t._s(t._label("zuofei")))]),t._v(" "),a("as-button",{attrs:{type:2==t.rowdata.status?"primary":"info"},on:{click:function(e){return t.confirmout()}}},[t._v(t._s(t._label("chukuqueren")))]),t._v(" "),a("as-button",{attrs:{type:3==t.rowdata.status?"primary":"info"},on:{click:function(e){return t.confirmin()}}},[t._v(t._s(t._label("rukuqueren")))])],1),t._v(" "),a("el-row",[a("as-button",{attrs:{type:"primary"},on:{click:t.onQuit}},[t._v(t._s(t._label("tuichu")))])],1)],1)],1)],1),t._v(" "),a("el-row",[a("el-col",{attrs:{span:24}},[a("el-table",{ref:"list",staticStyle:{width:"100%"},attrs:{data:t.tabledata,stripe:"",border:""}},[a("el-table-column",{attrs:{prop:"productname",label:t._label("chanpinmingcheng"),align:"center"}}),t._v(" "),a("el-table-column",{attrs:{prop:"sizecontentname",label:t._label("chima"),width:"100",align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){return[t._v("\n                            "+t._s(e.row.sizecontentname)+"\n                        ")]}}])}),t._v(" "),a("el-table-column",{attrs:{prop:"number",label:t._label("diaoboshuliang"),width:"200",align:"center"}}),t._v(" "),t.rowdata.status>2?a("el-table-column",{key:"1",attrs:{prop:"out_number",label:t._label("chukushuliang"),width:"200",align:"center"}}):t._e(),t._v(" "),5==t.rowdata.status?a("el-table-column",{key:"2",attrs:{prop:"in_number",label:t._label("rukushuliang"),width:"200",align:"center"}}):t._e(),t._v(" "),2==t.rowdata.status?a("el-table-column",{key:"3",attrs:{label:t._label("chukushuliang"),width:"250",align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("el-input-number",{attrs:{min:0,max:1*e.row.number},model:{value:e.row.select_number,callback:function(a){t.$set(e.row,"select_number",a)},expression:"scope.row.select_number"}})]}}],null,!1,3985797177)}):t._e(),t._v(" "),3==t.rowdata.status?a("el-table-column",{key:"4",attrs:{label:t._label("rukushuliang"),width:"250",align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("el-input-number",{attrs:{min:0,max:1*e.row.out_number},model:{value:e.row.select_number,callback:function(a){t.$set(e.row,"select_number",a)},expression:"scope.row.select_number"}})]}}],null,!1,3291619112)}):t._e()],1)],1)],1)],1)],1)},i=[],l={render:n,staticRenderFns:i};e.a=l},363:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("el-row",[a("el-col",{attrs:{span:6}},[a("as-button",{attrs:{type:"primary"},on:{click:t.onSearch}},[t._v(t._s(t._label("chaxun")))]),t._v(" "),a("auth",{attrs:{auth:"requisition"}},[a("as-button",{attrs:{type:"primary"},on:{click:function(e){return t.showFormToCreate()}}},[t._v(t._s(t._label("xinjian")))])],1)],1)],1),t._v(" "),a("el-row",{attrs:{gutter:20}},[a("el-col",{attrs:{span:24}},[a("simple-admin-tablelist",t._b({ref:"tablelist",attrs:{onclickupdate:t.showFormToEdit,isdelete:!1}},"simple-admin-tablelist",t.props,!1))],1)],1)],1)},i=[],l={render:n,staticRenderFns:i};e.a=l}});
//# sourceMappingURL=1-1011.js.map