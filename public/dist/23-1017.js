webpackJsonp([23],{279:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var s=r(312),a=r(343),l=r(0),o=l(s.a,a.a,!1,null,null,null);t.default=o.exports},312:function(e,t,r){"use strict";t.a={name:"sp-order",data:function(){var e=this,t=e._label;return{form:{keyword:"",bookingid:"",ageseason:"",brandids:"",supplierid:"",seasontype:"",bussinesstype:"",property:""},props:{columns:[{name:"orderno",label:t("dingdanbianhao"),width:120},{name:"bookingid",label:t("dinghuokehu"),type:"select",source:"supplier"},{name:"supplierid",label:t("gonghuoshang"),type:"select",source:"supplier"},{name:"ageseason",label:t("niandai"),type:"select",source:"ageseason",width:100},{name:"currency",label:t("bizhong"),type:"select",source:"currency",width:80},{name:"total",label:t("jine"),width:100},{name:"discount",label:t("zhekoulv"),width:100},{name:"genders",label:t("xingbie")},{name:"brandids",label:t("pinpai")},{name:"bussinesstype",label:t("yewuleixing"),type:"select",source:"bussinesstype",width:120},{name:"orderdate",label:t("dingdanriqi"),width:120,convert:function(e){if(e.maketime&&e.maketime.length>0)return e.maketime.substr(0,10)}}],controller:"order",actions:[{label:t("shanchu"),type:"danger",handler:function(t){var r=t.row;e._remove("/order/delete",{id:r.id}).then(function(t){t&&e.$refs.tablelist.search(e.searchform)})}}]}}},methods:{onSearch:function(e){var t=this;t.$refs.tablelist.search(e),t._hideDialog("search")},toPage:function(e){this.$router.push("/order/"+e)},toEdit:function(e,t){this.toPage(t.id)}}}},343:function(e,t,r){"use strict";var s=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-row",[r("el-col",{attrs:{span:24}},[r("as-button",{attrs:{type:"primary",size:"mini",icon:"el-icon-search"},on:{click:function(t){return e._showDialog("search")}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),r("auth",{attrs:{auth:"order-submit"}},[r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.toPage(0)}}},[e._v(e._s(e._label("xinjian")))])],1)],1)],1),e._v(" "),r("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{onclickupdate:e.toEdit,isdelete:!1},scopedSlots:e._u([{key:"orderno",fn:function(e){var t=e.row;return[r("sp-order-tip",{attrs:{column:"orderno",order:t}})]}},{key:"genders",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.genders,source:"gender"}})]}},{key:"brandids",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.brandids,source:"brand"}})]}}])},"simple-admin-tablelist",e.props,!1)),e._v(" "),r("sp-dialog",{ref:"search",attrs:{width:"600"}},[r("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"70px",inline:!1,size:"mini"},nativeOn:{submit:function(e){e.preventDefault()}}},[r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("dingdanhao")}},[r("el-input",{staticClass:"width2",model:{value:e.form.keyword,callback:function(t){e.$set(e.form,"keyword",t)},expression:"form.keyword"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("dinghuokehu")}},[r("simple-select",{attrs:{source:"supplier_2",multiple:!0},model:{value:e.form.bookingid,callback:function(t){e.$set(e.form,"bookingid",t)},expression:"form.bookingid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("niandai")}},[r("simple-select",{attrs:{source:"ageseason",multiple:!0},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinpai")}},[r("simple-select",{attrs:{source:"brand",multiple:!0},model:{value:e.form.brandids,callback:function(t){e.$set(e.form,"brandids",t)},expression:"form.brandids"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3",clearable:!0},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jijie")}},[r("simple-select",{attrs:{source:"seasontype"},model:{value:e.form.seasontype,callback:function(t){e.$set(e.form,"seasontype",t)},expression:"form.seasontype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yewuleixing"),prop:"bussinesstype"}},[r("simple-select",{attrs:{source:"bussinesstype"},model:{value:e.form.bussinesstype,callback:function(t){e.$set(e.form,"bussinesstype",t)},expression:"form.bussinesstype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shuxing"),prop:"property"}},[r("simple-select",{attrs:{source:"orderproperty"},model:{value:e.form.property,callback:function(t){e.$set(e.form,"property",t)},expression:"form.property"}})],1)],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{attrs:{align:"center"}},[r("as-button",{attrs:{auth:"product",type:"primary","native-type":"submit"},on:{click:function(t){return e.onSearch(e.form)}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("search")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1)},a=[],l={render:s,staticRenderFns:a};t.a=l}});
//# sourceMappingURL=23-1017.js.map