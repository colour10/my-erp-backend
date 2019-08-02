webpackJsonp([10],{296:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var l=a(346),r=a(393),o=a(0),n=o(l.a,r.a,!1,null,null,null);t.default=n.exports},346:function(e,t,a){"use strict";var l=a(182),r=a.n(l),o=a(35),n=a(391),s=a(1);t.a={name:"sp-productstock",components:r()({},n.a.name,n.a),data:function(){return{form:{wordcode:"",brandid:"",brandgroupid:"",childbrand:"",productsize:"",countries:"",brandcolor:"",productparst:"",series:"",ulnarinch:"",gender:"",season:"",ageseason:"",productmemoids:"",saletypeid:"",producttypeid:""},pagination:{pageSizes:s.f.pageSizes,pageSize:10,total:0,current:1},searchresult:[],isLoading:!1,types:["1","2"],properties:["1","2"],defective_levels:["1"]}},methods:{handleSizeChange:function(e){this.pagination.pageSize=e,this.loadList()},handleCurrentChange:function(e){this.pagination.current=e,this.loadList()},onSearch:function(){var e=this;e.pagination.page=1,e.loadList()},loadList:function(){var e=this;if(!e.isLoading){e.isLoading=!0;var t=Object(s.h)({},e.form);t.page=e.pagination.current,t.pageSize=e.pagination.pageSize,t.type=e.typeSum,t.defective_level=e.defective_levels.join(","),t.property=e.properties.join(","),e._fetch("/productstock/search",t).then(function(t){e._hideDialog("search"),e.searchresult=[],console.log(t),t.data.data.forEach(function(a){o.g.get(a,function(a){e.searchresult.push(a),e.searchresult.length==t.data.data.length&&(e.isLoading=!1,Object(s.h)(e.pagination,t.data.pagination))},2)}),0==t.data.data.length&&(e.isLoading=!1)})}},getRowStyle:function(e){var t=e.row,a=t.product;if(a&&a.saletype&&a.saletype.colortemplate)return{color:a.saletype.colortemplate.row.name_en}}},computed:{width:function(){return 55*this.searchresult.reduce(function(e,t){var a=t.product;return Math.max(e,a.sizecontents.length)},1)},typeSum:function(){return this.types.reduce(function(e,t){return e+1*t},0)}}}},347:function(e,t,a){"use strict";t.a={name:"sp-productstock-show",props:{columns:{type:Array},stocks:{type:[Array],require:!0},type:{type:Number}},data:function(){var e=this,t={};return e.columns.forEach(function(e){t[e.id]=""}),{form:t}},methods:{update:function(e){var t=this,a=t.form;t.stocks.forEach(function(e){var l=void 0;3==t.type?l=e.number:1==t.type?l=e.number-e.reserve_number:2==t.type&&(l=e.reserve_number),a[e.sizecontentid]=l})}},watch:{type:function(){this.update()}},mounted:function(){this.update()}}},391:function(e,t,a){"use strict";var l=a(347),r=a(392),o=a(0),n=o(l.a,r.a,!1,null,null,null);t.a=n.exports},392:function(e,t,a){"use strict";var l=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"sizecontent"},[a("el-row",e._l(e.columns,function(t,l){return a("el-col",{key:t.id,staticStyle:{width:"51px"},attrs:{align:"center",span:1}},[e._v(e._s(t.name))])}),1),e._v(" "),a("el-row",e._l(e.columns,function(t,l){return a("el-input",{key:t.id,staticStyle:{width:"51px"},attrs:{value:e.form[t.id],size:"mini",disabled:""}})}),1)],1)},r=[],o={render:l,staticRenderFns:r};t.a=o},393:function(e,t,a){"use strict";var l=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"product",staticStyle:{width:"100%"}},[a("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._showDialog("search")}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),a("sp-table",{staticStyle:{width:"100%"},attrs:{data:e.searchresult,border:"","row-style":e.getRowStyle}},[a("el-table-column",{attrs:{label:e._label("zhutu"),align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-product-icon",{attrs:{file:t.product.picture}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",sortable:"",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n        "+e._s(a.product.getName())+"\n      ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("guojima"),align:"center",sortable:"",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-product-tip",{attrs:{product:t.product}})]}}])}),e._v(" "),a("el-table-column",{attrs:{sortable:"",label:e._label("cangku"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n        "+e._s(a.warehouse.name)+"\n      ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("kucunshuliang"),width:e.width,align:"left"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return[a("sp-productstock-show",{attrs:{columns:l.product.sizecontents,stocks:l.stocks,type:e.typeSum}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("chuchangjia"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n        "+e._s(a.product.factorypricecurrency_label+" "+a.product.factoryprice)+"\n      ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("guojilingshoujia"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n        "+e._s(a.product.wordpricecurrency_label+" "+a.product.wordprice)+"\n      ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("chengben"),width:"140",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return[a("sp-select-text",{attrs:{value:l.product.costcurrency,source:"currency"}}),e._v("\n        "+e._s(l.product.cost)+"\n      ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("shuxing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.property,source:"orderproperty"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("canpin"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.defective_level,source:"defectivelevel"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("xiaoshoushuxing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.saletypeid,source:"saletype"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("shangpinshuxing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.producttypeid,source:"producttype"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("zuihouruku"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n        "+e._s(e._left(a.product.laststoragedate,10))+"\n      ")]}}])})],1),e._v(" "),e.searchresult.length<e.pagination.total?a("el-pagination",{attrs:{"current-page":1*e.pagination.current,"page-sizes":e.pagination.pageSizes,"page-size":1*e.pagination.pageSize,layout:"total, sizes, prev, pager, next, jumper",total:1*e.pagination.total},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}}):e._e(),e._v(" "),a("sp-dialog",{ref:"search",attrs:{width:900}},[a("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"70px",inline:!1,size:"mini"},nativeOn:{submit:function(e){e.preventDefault()}}},[a("el-row",{attrs:{gutter:0}},[a("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[a("el-form-item",{attrs:{label:e._label("cangku")}},[a("simple-select",{attrs:{source:"warehouse",placeholder:e._label("cangku"),clearable:!0},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("guojima"),prop:"ageseason"}},[a("el-input",{staticClass:"width2",model:{value:e.form.wordcode,callback:function(t){e.$set(e.form,"wordcode",t)},expression:"form.wordcode"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("niandai"),prop:"ageseason"}},[a("simple-select",{attrs:{source:"ageseason",multiple:!0},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("pinpai"),prop:"brandid"}},[a("simple-select",{attrs:{source:"brand",multiple:!0},model:{value:e.form.brandid,callback:function(t){e.$set(e.form,"brandid",t)},expression:"form.brandid"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("pinlei"),prop:"brandgroupid"}},[a("simple-select",{attrs:{source:"brandgroup",multiple:!0},model:{value:e.form.brandgroupid,callback:function(t){e.$set(e.form,"brandgroupid",t)},expression:"form.brandgroupid"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("zipinlei"),prop:"childbrand"}},[a("simple-select",{ref:"childbrand",attrs:{source:"brandgroupchild",parentid:e.form.brandgroupid,multiple:!0},model:{value:e.form.childbrand,callback:function(t){e.$set(e.form,"childbrand",t)},expression:"form.childbrand"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("chandi"),prop:"countries"}},[a("simple-select",{attrs:{source:"country"},model:{value:e.form.countries,callback:function(t){e.$set(e.form,"countries",t)},expression:"form.countries"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[a("el-form-item",{attrs:{label:e._label("shangpinchicun")}},[a("simple-select",{attrs:{source:"ulnarinch",multiple:!0},model:{value:e.form.ulnarinch,callback:function(t){e.$set(e.form,"ulnarinch",t)},expression:"form.ulnarinch"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("shangpinmiaoshu")}},[a("simple-select",{attrs:{source:"productmemo",multiple:!0},model:{value:e.form.productmemoids,callback:function(t){e.$set(e.form,"productmemoids",t)},expression:"form.productmemoids"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("shangpinxilie")}},[a("simple-select",{ref:"series",attrs:{source:"series",parentid:e.form.brandid,multiple:!0},model:{value:e.form.series,callback:function(t){e.$set(e.form,"series",t)},expression:"form.series"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("xiaoshoushuxing")}},[a("simple-select",{attrs:{source:"saletype",multiple:!0},model:{value:e.form.saletypeid,callback:function(t){e.$set(e.form,"saletypeid",t)},expression:"form.saletypeid"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("shangpinshuxing")}},[a("simple-select",{attrs:{source:"producttype",multiple:!0},model:{value:e.form.producttypeid,callback:function(t){e.$set(e.form,"producttypeid",t)},expression:"form.producttypeid"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("xingbie")}},[a("simple-select",{attrs:{source:"gender",multiple:!0},model:{value:e.form.gender,callback:function(t){e.$set(e.form,"gender",t)},expression:"form.gender"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("jijie")}},[a("simple-select",{attrs:{source:"season2",multiple:!0},model:{value:e.form.season,callback:function(t){e.$set(e.form,"season",t)},expression:"form.season"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[a("el-form-item",{attrs:{label:e._label("kucunzhuangtai")}},[a("el-checkbox-group",{model:{value:e.types,callback:function(t){e.types=t},expression:"types"}},[a("el-checkbox",{attrs:{label:"1"}},[e._v(e._s(e._label("daishou")))]),e._v(" "),a("el-checkbox",{attrs:{label:"2"}},[e._v(e._s(e._label("yushou")))])],1)],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("shuxing")}},[a("el-checkbox-group",{model:{value:e.properties,callback:function(t){e.properties=t},expression:"properties"}},[a("el-checkbox",{attrs:{label:"1"}},[e._v(e._s(e._label("zicai")))]),e._v(" "),a("el-checkbox",{attrs:{label:"2"}},[e._v(e._s(e._label("daixiao")))])],1)],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("zhiliang")}},[a("el-checkbox-group",{model:{value:e.defective_levels,callback:function(t){e.defective_levels=t},expression:"defective_levels"}},[a("el-checkbox",{attrs:{label:"1"}},[e._v(e._s(e._label("hege")))]),e._v(" "),a("el-checkbox",{attrs:{label:"2"}},[e._v(e._s(e._label("cancipin")))])],1)],1)],1)],1),e._v(" "),a("el-row",{attrs:{gutter:0}},[a("el-col",{attrs:{align:"center"}},[a("as-button",{attrs:{auth:"product",type:"primary","native-type":"submit"},on:{click:e.onSearch}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),a("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("search")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1)},r=[],o={render:l,staticRenderFns:r};t.a=o}});
//# sourceMappingURL=10-1025.js.map