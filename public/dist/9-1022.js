webpackJsonp([9],{296:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var l=r(331),a=r(378),o=r(0),s=o(l.a,a.a,!1,null,null,null);t.default=s.exports},331:function(e,t,r){"use strict";var l=r(183),a=r.n(l),o=r(35),s=r(376);t.a={name:"sp-productstock",components:a()({},s.a.name,s.a),data:function(){return{form:{wordcode:"",brandid:"",brandgroupid:"",childbrand:"",productsize:"",countries:"",brandcolor:"",productparst:"",series:"",ulnarinch:"",gender:"",season:"",ageseason:"",productmemoids:"",saletypeid:"",producttypeid:""},searchresult:[],isLoading:!1}},methods:{onSearch:function(){var e=this;e.isLoading||(e.isLoading=!0,e._fetch("/productstock/search",e.form).then(function(t){e._hideDialog("search"),e.searchresult=[],t.data.forEach(function(r){o.g.get(r,function(r){e.searchresult.push(r),e.searchresult.length==t.data.length&&(e.isLoading=!1)},2)})}))}},computed:{width:function(){return 55*this.searchresult.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)}}}},332:function(e,t,r){"use strict";t.a={name:"sp-productstock-show",props:{columns:{type:Array},stocks:{type:[Array],require:!0}},data:function(){var e=this,t={};return e.stocks.forEach(function(e){t[e.sizecontentid]=e.number}),{form:t,tabledata:[[]]}},methods:{rowClassName:function(e){e.row,e.rowIndex;return""},cellClassName:function(e){e.row,e.column,e.rowIndex,e.columnIndex;return"counter"}}}},376:function(e,t,r){"use strict";var l=r(332),a=r(377),o=r(0),s=o(l.a,a.a,!1,null,null,null);t.a=s.exports},377:function(e,t,r){"use strict";var l=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"sizecontent"},[r("el-row",e._l(e.columns,function(t,l){return r("el-col",{key:t.id,staticStyle:{width:"51px"},attrs:{align:"center",span:1}},[e._v(e._s(t.name))])}),1),e._v(" "),r("el-row",e._l(e.columns,function(t,l){return r("el-input",{key:t.id,staticStyle:{width:"51px"},attrs:{value:e.form[t.id],size:"mini",disabled:""}})}),1)],1)},a=[],o={render:l,staticRenderFns:a};t.a=o},378:function(e,t,r){"use strict";var l=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"product",staticStyle:{width:"100%"}},[r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._showDialog("search")}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),r("sp-table",{staticStyle:{width:"100%"},attrs:{data:e.searchresult,border:""}},[r("el-table-column",{attrs:{label:e._label("zhutu"),align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-product-icon",{attrs:{file:t.product.picture}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",sortable:"",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                "+e._s(r.product.getName())+"\n            ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",sortable:"",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-product-tip",{attrs:{product:t.product}})]}}])}),e._v(" "),r("el-table-column",{attrs:{sortable:"",label:e._label("cangku"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                "+e._s(r.warehouse.name)+"\n            ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("kucunshuliang"),width:e.width,align:"left"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-productstock-show",{attrs:{columns:t.product.sizecontents,stocks:t.stocks}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chuchangjia"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                "+e._s(r.product.factorypricecurrency_label+" "+r.product.factoryprice)+"\n            ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojilingshoujia"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                "+e._s(r.product.wordpricecurrency_label+" "+r.product.wordprice)+"\n            ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chengben"),width:"140",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return[r("sp-select-text",{attrs:{value:l.product.costcurrency,source:"currency"}}),e._v("\n                "+e._s(l.product.cost)+"\n            ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("xiaoshoushuxing"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.saletypeid,source:"saletype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shangpinshuxing"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.producttypeid,source:"producttype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zuihouruku"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                "+e._s(r.product.laststoragedate)+"\n            ")]}}])})],1),e._v(" "),r("sp-dialog",{ref:"search",attrs:{width:600}},[r("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"70px",inline:!1,size:"mini"},nativeOn:{submit:function(e){e.preventDefault()}}},[r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("cangku")}},[r("simple-select",{attrs:{source:"warehouse",placeholder:e._label("cangku"),clearable:!0},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("guojima"),prop:"ageseason"}},[r("el-input",{staticClass:"width2",model:{value:e.form.wordcode,callback:function(t){e.$set(e.form,"wordcode",t)},expression:"form.wordcode"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("niandai"),prop:"ageseason"}},[r("simple-select",{attrs:{source:"ageseason",multiple:!0},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinpai"),prop:"brandid"}},[r("simple-select",{attrs:{source:"brand",multiple:!0},model:{value:e.form.brandid,callback:function(t){e.$set(e.form,"brandid",t)},expression:"form.brandid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinlei"),prop:"brandgroupid"}},[r("simple-select",{attrs:{source:"brandgroup",multiple:!0},model:{value:e.form.brandgroupid,callback:function(t){e.$set(e.form,"brandgroupid",t)},expression:"form.brandgroupid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zipinlei"),prop:"childbrand"}},[r("simple-select",{ref:"childbrand",attrs:{source:"brandgroupchild",parentid:e.form.brandgroupid,multiple:!0},model:{value:e.form.childbrand,callback:function(t){e.$set(e.form,"childbrand",t)},expression:"form.childbrand"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("chandi"),prop:"countries"}},[r("simple-select",{attrs:{source:"country"},model:{value:e.form.countries,callback:function(t){e.$set(e.form,"countries",t)},expression:"form.countries"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("shangpinchicun")}},[r("simple-select",{attrs:{source:"ulnarinch",multiple:!0},model:{value:e.form.ulnarinch,callback:function(t){e.$set(e.form,"ulnarinch",t)},expression:"form.ulnarinch"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shangpinmiaoshu")}},[r("simple-select",{attrs:{source:"productmemo",multiple:!0},model:{value:e.form.productmemoids,callback:function(t){e.$set(e.form,"productmemoids",t)},expression:"form.productmemoids"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shangpinxilie")}},[r("simple-select",{ref:"series",attrs:{source:"series",parentid:e.form.brandid,multiple:!0},model:{value:e.form.series,callback:function(t){e.$set(e.form,"series",t)},expression:"form.series"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xiaoshoushuxing")}},[r("simple-select",{attrs:{source:"saletype",multiple:!0},model:{value:e.form.saletypeid,callback:function(t){e.$set(e.form,"saletypeid",t)},expression:"form.saletypeid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shangpinshuxing")}},[r("simple-select",{attrs:{source:"producttype",multiple:!0},model:{value:e.form.producttypeid,callback:function(t){e.$set(e.form,"producttypeid",t)},expression:"form.producttypeid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xingbie")}},[r("simple-select",{attrs:{source:"gender",multiple:!0},model:{value:e.form.gender,callback:function(t){e.$set(e.form,"gender",t)},expression:"form.gender"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jijie")}},[r("simple-select",{attrs:{source:"season2",multiple:!0},model:{value:e.form.season,callback:function(t){e.$set(e.form,"season",t)},expression:"form.season"}})],1)],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{attrs:{align:"center"}},[r("as-button",{attrs:{auth:"product",type:"primary","native-type":"submit"},on:{click:e.onSearch}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("search")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1)},a=[],o={render:l,staticRenderFns:a};t.a=o}});
//# sourceMappingURL=9-1022.js.map