webpackJsonp([23],{301:function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a=s(355),i=s(401),r=s(0),o=r(a.a,i.a,!1,null,null,null);e.default=o.exports},355:function(t,e,s){"use strict";e.a={name:"sp-requisition",data:function(){var t=this._label;return{form:{out_id:"",in_id:"",status:""},props:{columns:[{name:"out_id",label:t("diaochuku"),type:"select",source:"warehouse"},{name:"in_id",label:t("diaoruku"),type:"select",source:"warehouse"},{name:"apply_staff",label:t("shenqingren"),type:"select",source:"user"},{name:"status",label:t("zhuangtai"),type:"select",source:"requisitionstatus"}],controller:"requisition",options:{action_width:90}}}},methods:{showFormToCreate:function(){this._open("/requisition/create")},showFormToEdit:function(t,e){this._open("/requisition/edit/"+e.id)},onSearch:function(){var t=this;t.$refs.tablelist.search(t.form),t._hideDialog("search")}}}},401:function(t,e,s){"use strict";var a=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[s("el-row",[s("el-col",{attrs:{span:6}},[s("as-button",{attrs:{type:"primary"},on:{click:function(e){return t._showDialog("search")}}},[t._v(t._s(t._label("chaxun")))]),t._v(" "),s("auth",{attrs:{auth:"requisition"}},[s("as-button",{attrs:{type:"primary"},on:{click:function(e){return t.showFormToCreate()}}},[t._v(t._s(t._label("xinjian")))])],1)],1)],1),t._v(" "),s("el-row",{attrs:{gutter:20}},[s("el-col",{attrs:{span:24}},[s("simple-admin-tablelist",t._b({ref:"tablelist",attrs:{onclickupdate:t.showFormToEdit,isdelete:!1}},"simple-admin-tablelist",t.props,!1))],1)],1),t._v(" "),s("sp-dialog",{ref:"search",attrs:{width:"300","min-height":150}},[s("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:t.form,"label-width":"70px",inline:!1,size:"mini"},nativeOn:{submit:function(t){t.preventDefault()}}},[s("el-row",{attrs:{gutter:0}},[s("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[s("el-form-item",{attrs:{label:t._label("diaochuku")}},[s("simple-select",{attrs:{source:"warehouse"},model:{value:t.form.out_id,callback:function(e){t.$set(t.form,"out_id",e)},expression:"form.out_id"}})],1),t._v(" "),s("el-form-item",{attrs:{label:t._label("diaoruku")}},[s("simple-select",{attrs:{source:"warehouse"},model:{value:t.form.in_id,callback:function(e){t.$set(t.form,"in_id",e)},expression:"form.in_id"}})],1),t._v(" "),s("el-form-item",{attrs:{label:t._label("zhuangtai")}},[s("simple-select",{attrs:{source:"requisitionstatus"},model:{value:t.form.status,callback:function(e){t.$set(t.form,"status",e)},expression:"form.status"}})],1)],1)],1),t._v(" "),s("el-row",{attrs:{gutter:0}},[s("el-col",{attrs:{align:"center"}},[s("as-button",{attrs:{auth:"product",type:"primary","native-type":"submit"},on:{click:function(e){return t.onSearch(t.form)}}},[t._v(t._s(t._label("chaxun")))]),t._v(" "),s("as-button",{attrs:{type:"primary"},on:{click:function(e){return t._hideDialog("search")}}},[t._v(t._s(t._label("tuichu")))])],1)],1)],1)],1)],1)},i=[],r={render:a,staticRenderFns:i};e.a=r}});
//# sourceMappingURL=23-1032.js.map