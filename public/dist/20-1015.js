webpackJsonp([20],{285:function(e,t,l){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=l(318),a=l(355),s=l(0),o=s(r.a,a.a,!1,null,null,null);t.default=o.exports},318:function(e,t,l){"use strict";var r=l(33);t.a={name:"sp-productstock",data:function(){return{form:{wordcode:"",brandid:"",brandgroupid:"",childbrand:"",productsize:"",countries:"",brandcolor:"",productparst:"",series:"",ulnarinch:"",gender:"",season:"",ageseason:"",productmemoids:"",saletypeid:"",producttypeid:""},searchresult:[]}},methods:{onSearch:function(){var e=this;e._fetch("/productstock/search",e.form).then(function(t){e._hideDialog("search"),e.searchresult=[],t.data.forEach(function(t){r.f.get(t,function(t){e.searchresult.push(t)},2)})})}}}},355:function(e,t,l){"use strict";var r=function(){var e=this,t=e.$createElement,l=e._self._c||t;return l("div",{staticStyle:{width:"100%"}},[l("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._showDialog("search")}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),l("sp-table",{staticStyle:{width:"100%"},attrs:{data:e.searchresult,border:""}},[l("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",sortable:"",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return[e._v("\n                "+e._s(l.product.getName())+"\n            ")]}}])}),e._v(" "),l("el-table-column",{attrs:{label:e._label("guojima"),align:"center",sortable:"",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[l("sp-product-tip",{attrs:{product:t.product}})]}}])}),e._v(" "),l("el-table-column",{attrs:{prop:"sizecontent_label",label:e._label("chima"),width:"100",align:"center",sortable:""}}),e._v(" "),l("el-table-column",{attrs:{sortable:"",label:e._label("cangku"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return[e._v("\n                "+e._s(l.warehouse.name)+"\n            ")]}}])}),e._v(" "),l("el-table-column",{attrs:{label:e._label("kucunshuliang"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return[e._v("\n                "+e._s(l.number)+"\n            ")]}}])}),e._v(" "),l("el-table-column",{attrs:{label:e._label("zaitushuliang"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return[e._v("\n                "+e._s(l.shipping_number)+"\n            ")]}}])}),e._v(" "),l("el-table-column",{attrs:{label:e._label("suodingshuliang"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return[e._v("\n                "+e._s(l.reserve_number)+"\n            ")]}}])})],1),e._v(" "),l("sp-dialog",{ref:"search",attrs:{width:600}},[l("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"70px",inline:!1,size:"mini"},nativeOn:{submit:function(e){e.preventDefault()}}},[l("el-row",{attrs:{gutter:0}},[l("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[l("el-form-item",{attrs:{label:e._label("cangku")}},[l("simple-select",{attrs:{source:"warehouse",placeholder:e._label("cangku"),clearable:!0},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("guojima"),prop:"ageseason"}},[l("el-input",{staticClass:"width2",model:{value:e.form.wordcode,callback:function(t){e.$set(e.form,"wordcode",t)},expression:"form.wordcode"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("niandai"),prop:"ageseason"}},[l("simple-select",{attrs:{source:"ageseason",multiple:!0},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("pinpai"),prop:"brandid"}},[l("simple-select",{attrs:{source:"brand",multiple:!0},model:{value:e.form.brandid,callback:function(t){e.$set(e.form,"brandid",t)},expression:"form.brandid"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("pinlei"),prop:"brandgroupid"}},[l("simple-select",{attrs:{source:"brandgroup",multiple:!0},model:{value:e.form.brandgroupid,callback:function(t){e.$set(e.form,"brandgroupid",t)},expression:"form.brandgroupid"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("zipinlei"),prop:"childbrand"}},[l("simple-select",{ref:"childbrand",attrs:{source:"brandgroupchild",parentid:e.form.brandgroupid,multiple:!0},model:{value:e.form.childbrand,callback:function(t){e.$set(e.form,"childbrand",t)},expression:"form.childbrand"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("chandi"),prop:"countries"}},[l("simple-select",{attrs:{source:"country"},model:{value:e.form.countries,callback:function(t){e.$set(e.form,"countries",t)},expression:"form.countries"}})],1)],1),e._v(" "),l("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[l("el-form-item",{attrs:{label:e._label("shangpinchicun")}},[l("simple-select",{attrs:{source:"ulnarinch",multiple:!0},model:{value:e.form.ulnarinch,callback:function(t){e.$set(e.form,"ulnarinch",t)},expression:"form.ulnarinch"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("shangpinmiaoshu")}},[l("simple-select",{attrs:{source:"productmemo",multiple:!0},model:{value:e.form.productmemoids,callback:function(t){e.$set(e.form,"productmemoids",t)},expression:"form.productmemoids"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("shangpinxilie")}},[l("simple-select",{ref:"series",attrs:{source:"series",parentid:e.form.brandid,multiple:!0},model:{value:e.form.series,callback:function(t){e.$set(e.form,"series",t)},expression:"form.series"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("xiaoshoushuxing")}},[l("simple-select",{attrs:{source:"saletype",multiple:!0},model:{value:e.form.saletypeid,callback:function(t){e.$set(e.form,"saletypeid",t)},expression:"form.saletypeid"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("shangpinshuxing")}},[l("simple-select",{attrs:{source:"producttype",multiple:!0},model:{value:e.form.producttypeid,callback:function(t){e.$set(e.form,"producttypeid",t)},expression:"form.producttypeid"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("xingbie")}},[l("simple-select",{attrs:{source:"gender",multiple:!0},model:{value:e.form.gender,callback:function(t){e.$set(e.form,"gender",t)},expression:"form.gender"}})],1),e._v(" "),l("el-form-item",{attrs:{label:e._label("jijie")}},[l("simple-select",{attrs:{source:"season2",multiple:!0},model:{value:e.form.season,callback:function(t){e.$set(e.form,"season",t)},expression:"form.season"}})],1)],1)],1),e._v(" "),l("el-row",{attrs:{gutter:0}},[l("el-col",{attrs:{align:"center"}},[l("as-button",{attrs:{auth:"product",type:"primary","native-type":"submit"},on:{click:e.onSearch}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),l("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("search")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1)},a=[],s={render:r,staticRenderFns:a};t.a=s}});
//# sourceMappingURL=20-1015.js.map