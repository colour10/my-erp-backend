webpackJsonp([25],{312:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var s=a(370),r=a(421),i=a(0),n=i(s.a,r.a,!1,null,null,null);t.default=n.exports},370:function(e,t,a){"use strict";var s=a(18),r=a.n(s);t.a={name:"sp-orderbrand",data:function(){var e=this,t=e._label;return{form:{orderno:"",brandid:"",supplierid:"",ageseason:"",seasontype:"",bussinesstype:"",memo:""},props:{columns:[{name:"orderno",label:t("gongsidingdanhao"),width:120},{name:"supplierid",label:t("gonghuoshang"),type:"select",source:"supplier",width:90},{name:"ageseason",label:t("niandaijijie"),type:"select",source:"ageseason",width:110},{name:"bussinesstype",label:t("yewuleixing"),type:"select",source:"bussinesstype",width:110},{name:"currency",label:t("bizhong"),type:"select",source:"currency",width:80},{name:"total_discount_price",label:t("zongjine"),width:100},{name:"total_number",label:t("zongjianshu"),width:100},{name:"discount",label:t("zhekoulv"),width:100},{name:"taxrebate",label:t("tuishuilv"),width:100},{name:"quantum",label:t("edu"),width:100},{name:"memo",label:t("beizhu"),width:100,sortable:!1},{name:"status",label:t("zhuangtai"),type:"select",source:"orderbrandstatus",width:90},{name:"makedate",label:t("dingdanriqi"),width:110,convert:function(e){if(e.maketime&&e.maketime.length>0)return e.maketime.substr(0,10)}},{name:"brandid",label:t("品牌"),width:150,sortable:!1}],actions:[{label:t("xiangqing"),handler:e.toCreateConfirm},{label:t("shanchu"),type:"danger",handler:function(t){var a=t.row;e._remove("/orderbrand/delete",{id:a.id}).then(function(t){t&&e.$refs.tablelist.search(e.searchform)})}}],controller:"orderbrand",options:{action_width:160}},pro:!1,info:{},rowIndex:-1}},methods:{onSearch:function(){var e=this;e.$refs.tablelist.search(e.form)},showFormToCreate:function(){this._open("/orderbrand/0")},showFormToEdit:function(){var e=this,t=e.$refs.tablelist.getSelectRows(),a={};t.forEach(function(e){a[e.supplierid]=1}),t.length==r()(a).length?e.$router.push("/orderbrand/"+e.$refs.tablelist.getSelectValues()):e._info(e._label("tip-tongyige"))},toCreateConfirm:function(e){var t=e.row;e.vm;this._open("/orderbrand/confirm/"+t.id)},toShipping:function(e){var t=e.row;e.vm;this._open("/shipping/detail/"+t.id)}}}},421:function(e,t,a){"use strict";var s=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-row",[a("el-col",{attrs:{span:24}},[a("as-button",{attrs:{type:"primary",size:"mini",icon:"el-icon-search"},on:{click:function(t){return e._showDialog("search")}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),a("auth",{attrs:{auth:"order-submit"}},[a("as-button",{attrs:{type:"primary"},on:{click:e.showFormToCreate}},[e._v(e._s(e._label("xinjian")))])],1)],1)],1),e._v(" "),a("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{onclickupdate:e.showFormToEdit,isedit:!1,isdelete:!1,isSelect:!1},scopedSlots:e._u([{key:"brandid",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.brandid,source:"brand"}})]}}])},"simple-admin-tablelist",e.props,!1)),e._v(" "),a("sp-dialog",{ref:"search",attrs:{width:"600"}},[a("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"70px",inline:!1,size:"mini"},nativeOn:{submit:function(e){e.preventDefault()}}},[a("el-row",{attrs:{gutter:0}},[a("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[a("el-form-item",{attrs:{label:e._label("dingdanhao")}},[a("el-input",{staticClass:"width2",model:{value:e.form.orderno,callback:function(t){e.$set(e.form,"orderno",t)},expression:"form.orderno"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[a("simple-select",{attrs:{source:"supplier_3",multiple:!0},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("niandai")}},[a("simple-select",{attrs:{source:"ageseason",multiple:!0},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("pinpai")}},[a("simple-select",{attrs:{source:"brand",multiple:!0},model:{value:e.form.brandid,callback:function(t){e.$set(e.form,"brandid",t)},expression:"form.brandid"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[a("el-form-item",{attrs:{label:e._label("jijie")}},[a("simple-select",{attrs:{source:"seasontype"},model:{value:e.form.seasontype,callback:function(t){e.$set(e.form,"seasontype",t)},expression:"form.seasontype"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("yewuleixing"),prop:"bussinesstype"}},[a("simple-select",{attrs:{source:"bussinesstype"},model:{value:e.form.bussinesstype,callback:function(t){e.$set(e.form,"bussinesstype",t)},expression:"form.bussinesstype"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("beizhu")}},[a("el-input",{staticClass:"width2",model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1)],1),e._v(" "),a("el-row",{attrs:{gutter:0}},[a("el-col",{attrs:{align:"center"}},[a("as-button",{attrs:{auth:"product",type:"primary","native-type":"submit"},on:{click:function(t){return e.onSearch(e.form)}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),a("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("search")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1)},r=[],i={render:s,staticRenderFns:r};t.a=i}});
//# sourceMappingURL=25-1031.js.map