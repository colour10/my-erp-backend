webpackJsonp([25],{307:function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=s(407),a=s(471),o=s(0),n=o(r.a,a.a,!1,null,null,null);t.default=n.exports},360:function(e,t,s){"use strict";t.a={color:{success:"#67C23A",warning:"#E6A23C",danger:"#F56C6C",info:"#909399",font:"#303133"}}},407:function(e,t,s){"use strict";var r=s(360),a=s(2);t.a={name:"sp-order",data:function(){var e=this,t=e._label;return{form:{keyword:"",bookingid:"",ageseason:"",brandids:"",supplierid:"",seasontype:"",bussinesstype:"",property:""},props:{columns:[{name:"orderno",label:t("dingdanbianhao"),width:120},{name:"bookingid",label:t("dinghuokehu"),type:"select",source:"supplier"},{name:"supplierid",label:t("gonghuoshang"),type:"select",source:"supplier"},{name:"ageseason",label:t("niandai"),type:"select",source:"ageseason",width:100},{name:"sum_product",label:t("jianshu"),width:80},{name:"sum_worldcode",label:t("kuanshu"),width:80},{name:"currency",label:t("bizhong"),type:"select",source:"currency",width:80},{name:"total",label:t("jine"),width:100,sortMethod:e.sortMethodAmount},{name:"discount",label:t("zhekoulv"),width:100},{name:"genders",label:t("xingbie")},{name:"brandids",label:t("pinpai")},{name:"bussinesstype",label:t("yewuleixing"),type:"select",source:"bussinesstype",width:120},{name:"status",label:t("zhuangtai"),type:"select",source:"orderstatus",width:90},{name:"orderdate",label:t("dingdanriqi"),width:120,convert:function(e){if(e.maketime&&e.maketime.length>0)return e.maketime.substr(0,10)}}],controller:"ordersimple",actions:[{label:t("xiangqing"),handler:e.toEdit,type:""},{label:t("shanchu"),type:"danger",handler:function(t){var s=t.row;e._remove("/order/delete",{id:s.id}).then(function(t){t&&e.$refs.tablelist.search(e.searchform)})}}],options:{rowStyle:function(e){var t=e.row;e.rowIndex;return{color:"2"==t.status?r.a.color.success:r.a.color.font}}}}}},methods:{sortMethodAmount:function(e,t){return e.total-t.total>=0?1:-1},onSearch:function(e){var t=this;t.$refs.tablelist.search(e),t._hideDialog("search")},toPage:function(e){this._open("/ordersimple/"+e)},toEdit:function(e){var t=e.row;e.vm;this.toPage(t.id)}},mounted:function(){console.log(this._isAllowed("order-delete")),this._setTitle(Object(a.d)("dingdanguanli"))}}},471:function(e,t,s){"use strict";var r=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",[s("el-row",[s("el-col",{attrs:{span:24}},[s("as-button",{attrs:{type:"primary",size:"mini",icon:"el-icon-search"},on:{click:function(t){return e._showDialog("search")}}},[e._v("\n        "+e._s(e._label("chaxun"))+"\n      ")]),e._v(" "),s("asa-button",{attrs:{type:"primary",enable:e._isAllowed("order-add")},on:{click:function(t){return e.toPage(0)}}},[e._v(e._s(e._label("xinjian"))+"\n      ")])],1)],1),e._v(" "),s("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{isedit:!1,isdelete:!1},scopedSlots:e._u([{key:"orderno",fn:function(e){var t=e.row;return[s("sp-order-tip",{attrs:{column:"orderno",order:t}})]}},{key:"genders",fn:function(e){var t=e.row;return[s("sp-select-text",{attrs:{value:t.genders,source:"gender"}})]}},{key:"brandids",fn:function(e){var t=e.row;return[s("sp-select-text",{attrs:{value:t.brandids,source:"brand"}})]}}])},"simple-admin-tablelist",e.props,!1)),e._v(" "),s("sp-dialog",{ref:"search",attrs:{width:"600"}},[s("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"70px",inline:!1,size:"mini"},nativeOn:{submit:function(e){e.preventDefault()}}},[s("el-row",{attrs:{gutter:0}},[s("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[s("el-form-item",{attrs:{label:e._label("dingdanhao")}},[s("el-input",{staticClass:"width2",model:{value:e.form.keyword,callback:function(t){e.$set(e.form,"keyword",t)},expression:"form.keyword"}})],1),e._v(" "),s("el-form-item",{attrs:{label:e._label("dinghuokehu")}},[s("simple-select",{attrs:{source:"supplier_2",multiple:!0},model:{value:e.form.bookingid,callback:function(t){e.$set(e.form,"bookingid",t)},expression:"form.bookingid"}})],1),e._v(" "),s("el-form-item",{attrs:{label:e._label("niandai")}},[s("simple-select",{attrs:{source:"ageseason",multiple:!0},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),s("el-form-item",{attrs:{label:e._label("pinpai")}},[s("simple-select",{attrs:{source:"brand",multiple:!0},model:{value:e.form.brandids,callback:function(t){e.$set(e.form,"brandids",t)},expression:"form.brandids"}})],1)],1),e._v(" "),s("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[s("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[s("simple-select",{attrs:{source:"supplier_3",clearable:!0},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1),e._v(" "),s("el-form-item",{attrs:{label:e._label("jijie")}},[s("simple-select",{attrs:{source:"seasontype"},model:{value:e.form.seasontype,callback:function(t){e.$set(e.form,"seasontype",t)},expression:"form.seasontype"}})],1),e._v(" "),s("el-form-item",{attrs:{label:e._label("yewuleixing"),prop:"bussinesstype"}},[s("simple-select",{attrs:{source:"bussinesstype"},model:{value:e.form.bussinesstype,callback:function(t){e.$set(e.form,"bussinesstype",t)},expression:"form.bussinesstype"}})],1),e._v(" "),s("el-form-item",{attrs:{label:e._label("shuxing"),prop:"property"}},[s("simple-select",{attrs:{source:"orderproperty"},model:{value:e.form.property,callback:function(t){e.$set(e.form,"property",t)},expression:"form.property"}})],1)],1)],1),e._v(" "),s("el-row",{attrs:{gutter:0}},[s("el-col",{attrs:{align:"center"}},[s("as-button",{attrs:{type:"primary","native-type":"submit"},on:{click:function(t){return e.onSearch(e.form)}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),s("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("search")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1)},a=[],o={render:r,staticRenderFns:a};t.a=o}});