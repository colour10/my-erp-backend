webpackJsonp([23],{307:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var l=a(418),i=a(530),r=a(0),s=r(l.a,i.a,!1,null,null,null);t.default=s.exports},339:function(e,t,a){"use strict";t.a={color:{success:"#67C23A",warning:"#E6A23C",danger:"#F56C6C",info:"#909399",font:"#303133"}}},418:function(e,t,a){"use strict";a(339);t.a={name:"sp-bill",data:function(){var e=this,t=e._label;return{form:{date:[e._label("_date"),e._label("_date")],supplierid:"",status:""},props:{columns:[{name:"orderdate",label:t("riqi"),width:120,convert:function(e){if(e.createtime&&e.createtime.length>0)return e.createtime.substr(0,10)}},{name:"billno",label:t("bianhao"),width:120},{name:"out_billno",label:t("waibuduizhangdanhao"),type:"select",source:"supplier"},{name:"supplierid",label:t("shoufufeidanwei"),type:"select",source:"supplier"},{name:"status",label:t("huikuanqingkuang"),type:"select",source:"billstatus",width:120},{name:"currencyid",label:t("bizhong"),type:"select",source:"currency",width:80},{name:"amount",label:t("jine"),width:100}],controller:"bill",actions:[{label:t("shanchu"),type:"danger",handler:function(t){var a=t.row;e._remove("/order/delete",{id:a.id}).then(function(t){t&&e.$refs.tablelist.search(e.searchform)})}}],options:{}}}},methods:{onSearch:function(e){var t=this;t.$refs.tablelist.search(e),t._hideDialog("search")},onclickupdate:function(e,t){this._open("/bill/"+t.id)}},mounted:function(){}}},530:function(e,t,a){"use strict";var l=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-row",[a("el-col",{attrs:{span:24}},[a("as-button",{attrs:{type:"primary",size:"mini",icon:"el-icon-search"},on:{click:function(t){return e._showDialog("search")}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),a("asa-button",{attrs:{enable:e._isAllowed("bill-add")},on:{click:function(t){return e._open("/bill/create")}}},[e._v(e._s(e._label("xinjian")))])],1)],1),e._v(" "),a("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{isedit:!0,isdelete:!1,onclickupdate:e.onclickupdate}},"simple-admin-tablelist",e.props,!1)),e._v(" "),a("sp-dialog",{ref:"search",attrs:{width:"400"}},[a("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"90px",inline:!1,size:"mini"},nativeOn:{submit:function(e){e.preventDefault()}}},[a("el-row",{attrs:{gutter:0}},[a("el-col",{staticStyle:{width:"300px"},attrs:{span:8}},[a("el-form-item",{attrs:{label:e._label("riqi")}},[a("el-date-picker",{attrs:{type:"daterange","range-separator":"~","start-placeholder":"开始日期","end-placeholder":"结束日期","value-format":"yyyy-MM-dd"},model:{value:e.form.date,callback:function(t){e.$set(e.form,"date",t)},expression:"form.date"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("zhuangtai")}},[a("simple-select",{attrs:{source:"billstatus"},model:{value:e.form.status,callback:function(t){e.$set(e.form,"status",t)},expression:"form.status"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("shoufufeidanwei")}},[a("simple-select",{attrs:{source:"supplier",multiple:!0},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1)],1)],1),e._v(" "),a("el-row",{attrs:{gutter:0}},[a("el-col",{attrs:{align:"center"}},[a("as-button",{attrs:{type:"primary","native-type":"submit"},on:{click:function(t){return e.onSearch(e.form)}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),a("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("search")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1)},i=[],r={render:l,staticRenderFns:i};t.a=r}});