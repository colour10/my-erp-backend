webpackJsonp([20],{287:function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=s(339),r=s(375),i=s(0),o=i(a.a,r.a,!1,null,null,null);t.default=o.exports},339:function(e,t,s){"use strict";t.a={name:"sp-shipping",data:function(){var e=this,t=e._label;return{form:{orderno:"",warehouseid:"",supplierid:"",ageseason:"",seasontype:"",bussinesstype:"",status:""},props:{columns:[{name:"orderno",label:t("rukudanhao"),width:120},{name:"warehouseid",label:t("daohuocangku"),type:"select",source:"warehouse",width:150},{name:"supplierid",label:t("gonghuoshang"),type:"select",source:"supplier",width:90},{name:"ageseason",label:t("niandaijijie"),type:"select",source:"ageseason",width:110},{name:"bussinesstype",label:t("yewuleixing"),type:"select",source:"bussinesstype",width:110},{name:"status",label:t("zhuangtai"),type:"select",source:"shippingstatus",width:80},{name:"maketime",label:t("fahuoriqi"),width:110,convert:function(e){if(e.maketime&&e.maketime.length>0)return e.maketime.substr(0,10)}},{name:"warehousingtime",label:t("rukuriqi"),width:110,convert:function(e){if(e.warehousingtime&&e.warehousingtime.length>0)return e.warehousingtime.substr(0,10)}},{name:"makestaff",label:t("zhidanren"),source:"user",type:"select",width:150}],controller:"shipping",actions:[{label:t("ruku"),handler:function(t){var s=t.row;e.$router.push("/shipping/warehousing/"+s.id)}},{label:t("shanchu"),type:"danger",handler:function(t){var s=t.row;e._remove("/shipping/delete",{id:s.id}).then(function(t){t&&e.$refs.tablelist.search(e.searchform)})}}],options:{action_width:200}}}},methods:{onSearch:function(){var e=this;e.$refs.tablelist.search(e.form),e._hideDialog("search")},showFormToCreate:function(){this.$router.push("/shipping/0")},showFormToEdit:function(e,t){this.$router.push("/shipping/"+t.id)}}}},375:function(e,t,s){"use strict";var a=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",[s("el-row",[s("el-col",{attrs:{span:24}},[s("as-button",{attrs:{type:"primary",size:"mini",icon:"el-icon-search"},on:{click:function(t){return e._showDialog("search")}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),s("auth",{attrs:{auth:"confirmorder-submit"}},[s("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.showFormToCreate()}}},[e._v(e._s(e._label("xinjian")))])],1)],1)],1),e._v(" "),s("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{onclickupdate:e.showFormToEdit,isdelete:!1,isedit:!1},scopedSlots:e._u([{key:"orderno",fn:function(t){var a=t.row;return[s("router-link",{attrs:{to:"/shipping/warehousing/"+a.id}},[e._v(e._s(a.orderno))])]}}])},"simple-admin-tablelist",e.props,!1)),e._v(" "),s("sp-dialog",{ref:"search",attrs:{width:"600"}},[s("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"70px",inline:!1,size:"mini"},nativeOn:{submit:function(e){e.preventDefault()}}},[s("el-row",{attrs:{gutter:0}},[s("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[s("el-form-item",{attrs:{label:e._label("dingdanhao")}},[s("el-input",{staticClass:"width2",model:{value:e.form.orderno,callback:function(t){e.$set(e.form,"orderno",t)},expression:"form.orderno"}})],1),e._v(" "),s("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[s("simple-select",{attrs:{source:"supplier_3",multiple:!0},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1),e._v(" "),s("el-form-item",{attrs:{label:e._label("niandai")}},[s("simple-select",{attrs:{source:"ageseason",multiple:!0},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),s("el-form-item",{attrs:{label:e._label("daohuocangku")}},[s("simple-select",{attrs:{source:"warehouse",multiple:!0},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1)],1),e._v(" "),s("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[s("el-form-item",{attrs:{label:e._label("jijie")}},[s("simple-select",{attrs:{source:"seasontype"},model:{value:e.form.seasontype,callback:function(t){e.$set(e.form,"seasontype",t)},expression:"form.seasontype"}})],1),e._v(" "),s("el-form-item",{attrs:{label:e._label("yewuleixing")}},[s("simple-select",{attrs:{source:"bussinesstype"},model:{value:e.form.bussinesstype,callback:function(t){e.$set(e.form,"bussinesstype",t)},expression:"form.bussinesstype"}})],1),e._v(" "),s("el-form-item",{attrs:{label:e._label("zhuangtai")}},[s("simple-select",{attrs:{source:"shippingstatus"},model:{value:e.form.status,callback:function(t){e.$set(e.form,"status",t)},expression:"form.status"}})],1),e._v(" "),s("el-form-item",{attrs:{label:e._label("beizhu")}},[s("el-input",{staticClass:"width2",model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1)],1),e._v(" "),s("el-row",{attrs:{gutter:0}},[s("el-col",{attrs:{align:"center"}},[s("as-button",{attrs:{auth:"product",type:"primary","native-type":"submit"},on:{click:function(t){return e.onSearch(e.form)}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),s("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("search")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1)},r=[],i={render:a,staticRenderFns:r};t.a=i}});
//# sourceMappingURL=20-1027.js.map