webpackJsonp([6],{274:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=r(344),n=r(398),l=r(0),o=l(a.a,n.a,!1,null,null,null);t.default=o.exports},297:function(e,t,r){"use strict";t.__esModule=!0;var a=r(302),n=function(e){return e&&e.__esModule?e:{default:e}}(a);t.default=function(e){if(Array.isArray(e)){for(var t=0,r=Array(e.length);t<e.length;t++)r[t]=e[t];return r}return(0,n.default)(e)}},302:function(e,t,r){e.exports={default:r(303),__esModule:!0}},303:function(e,t,r){r(28),r(304),e.exports=r(1).Array.from},304:function(e,t,r){"use strict";var a=r(27),n=r(10),l=r(39),o=r(73),s=r(74),i=r(55),c=r(305),u=r(56);n(n.S+n.F*!r(75)(function(e){Array.from(e)}),"Array",{from:function(e){var t,r,n,p,d=l(e),f="function"==typeof this?this:Array,m=arguments.length,h=m>1?arguments[1]:void 0,b=void 0!==h,v=0,_=u(d);if(b&&(h=a(h,m>2?arguments[2]:void 0,2)),void 0==_||f==Array&&s(_))for(t=i(d.length),r=new f(t);t>v;v++)c(r,v,b?h(d[v],v):d[v]);else for(p=_.call(d),r=new f;!(n=p.next()).done;v++)c(r,v,b?o(p,h,[n.value,v],!0):n.value);return r.length=v,r}})},305:function(e,t,r){"use strict";var a=r(11),n=r(29);e.exports=function(e,t,r){t in e?a.f(e,t,n(0,r)):e[t]=r}},314:function(e,t,r){"use strict";var a=r(26),n=r.n(a),l=r(8),o=r.n(l),s=r(36),i=r.n(s),c=r(297),u=r.n(c),p=r(9),d=r.n(p);r(35);t.a={name:"asa-product-modify-price",props:{},data:function(){return{products:[],prices:[]}},methods:{show:function(e){var t=this;return d()(o.a.mark(function r(){var a,n,l,s,c,p,d,f,m;return o.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:if(n=t,0!=e.length){r.next=3;break}return r.abrupt("return");case 3:if(n.products=[],(a=n.products).push.apply(a,u()(e)),n._showDialog("dialog"),0!=n.prices.length){r.next=29;break}return r.next=9,n._dataSource("price").getList();case 9:for(l=r.sent,s=!0,c=!1,p=void 0,r.prev=13,d=i()(l);!(s=(f=d.next()).done);s=!0)m=f.value,n.prices.push({id:m.id,name:m.name,price:"",discount:"",discountCost:""});r.next=21;break;case 17:r.prev=17,r.t0=r.catch(13),c=!0,p=r.t0;case 21:r.prev=21,r.prev=22,!s&&d.return&&d.return();case 24:if(r.prev=24,!c){r.next=27;break}throw p;case 27:return r.finish(24);case 28:return r.finish(21);case 29:case"end":return r.stop()}},r,t,[[13,17,21,29],[22,,24,28]])}))()},save:function(){var e=this,t={products:e.products.join(","),prices:e.prices.filter(function(e){return e.price>0||e.discount>0||e.discountCost>0})};console.log(n()(t)),e._submit("/product/modifyprices",{params:n()(t)})},onKeyUp:function(e,t,r){var a=this;"ArrowRight"===e.key?a.focus(t+1,r):"ArrowLeft"===e.key?a.focus(t-1,r):"ArrowUp"===e.key?a.focus(t,r-1):"ArrowDown"===e.key&&a.focus(t,r+1)},focus:function(e,t){var r=this;if(!(e>3||e<=0||t<0||t>=r.prices.length)){var a=e+"-"+t;r.$refs[a]&&(r.$refs[a].focus(),r.$refs[a].select())}}},computed:{},mounted:function(){}}},325:function(e,t,r){"use strict";var a=r(314),n=r(326),l=r(0),o=l(a.a,n.a,!1,null,null,null);t.a=o.exports},326:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("sp-dialog",{ref:"dialog",attrs:{width:"600"}},[r("el-table",{ref:"tabledetail",staticStyle:{width:"100%"},attrs:{data:e.prices,stripe:"",border:""}},[r("el-table-column",{attrs:{label:e._label("mingcheng"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n        "+e._s(r.name)+"\n      ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("jiage"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row,n=t.$index;return[r("el-input",{ref:"1-"+n,attrs:{size:"mini"},nativeOn:{keyup:function(t){return e.onKeyUp(t,1,n)}},model:{value:a.price,callback:function(t){e.$set(a,"price",t)},expression:"row.price"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("lingshoujiaxishu"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row,n=t.$index;return[r("el-input",{ref:"2-"+n,attrs:{size:"mini"},nativeOn:{keyup:function(t){return e.onKeyUp(t,2,n)}},model:{value:a.discount,callback:function(t){e.$set(a,"discount",t)},expression:"row.discount"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chengbenxishu"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row,n=t.$index;return[r("el-input",{ref:"3-"+n,attrs:{size:"mini"},nativeOn:{keyup:function(t){return e.onKeyUp(t,3,n)}},model:{value:a.discountCost,callback:function(t){e.$set(a,"discountCost",t)},expression:"row.discountCost"}})]}}])})],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{attrs:{align:"center"}},[r("as-button",{attrs:{auth:"product",type:"primary"},on:{click:e.save}},[e._v(e._s(e._label("baocun")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("dialog")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)},n=[],l={render:a,staticRenderFns:n};t.a=l},344:function(e,t,r){"use strict";var a,n=r(8),l=r.n(n),o=r(36),s=r.n(o),i=r(9),c=r.n(i),u=r(174),p=r.n(u),d=r(38),f=r(396),m=r(2),h=r(325);t.a={name:"sp-productstock",components:(a={},p()(a,f.a.name,f.a),p()(a,h.a.name,h.a),a),data:function(){return{selected:[],form:{wordcode:"",brandid:"",brandgroupid:"",childbrand:"",productsize:"",countries:"",brandcolor:"",productparst:"",series:"",ulnarinch:"",gender:"",season:"",ageseason:"",productmemoids:"",saletypeid:"",producttypeid:""},pagination:{pageSizes:m.f.pageSizes,pageSize:10,total:0,current:1},searchresult:[],isLoading:!1,types:["1","2"],properties:["1","2"],defective_levels:["1"],productresult:[],product:""}},methods:{showDetail:function(e){var t=this;return c()(l.a.mark(function r(){var a,n,o,i,c,u,p,f,m,h;return l.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return console.log(e),a=t,a.product=e,r.next=5,a._fetch("/productstock/searchproduct",{productid:e.productid,defective_level:e.defective_level,property:e.property});case 5:n=r.sent,o=n.data,a.productresult=[],i=!0,c=!1,u=void 0,r.prev=11,p=s()(o);case 13:if(i=(f=p.next()).done){r.next=22;break}return m=f.value,r.next=17,d.g.load({data:m,depth:2});case 17:h=r.sent,a.productresult.push(h);case 19:i=!0,r.next=13;break;case 22:r.next=28;break;case 24:r.prev=24,r.t0=r.catch(11),c=!0,u=r.t0;case 28:r.prev=28,r.prev=29,!i&&p.return&&p.return();case 31:if(r.prev=31,!c){r.next=34;break}throw u;case 34:return r.finish(31);case 35:return r.finish(28);case 36:a._showDialog("product-detail",{title:e.product.getName()});case 37:case"end":return r.stop()}},r,t,[[11,24,28,36],[29,,31,35]])}))()},handleSizeChange:function(e){this.pagination.pageSize=e,this.loadList()},handleCurrentChange:function(e){this.pagination.current=e,this.loadList()},onSearch:function(){var e=this;e.pagination.page=1,e.loadList()},loadList:function(){var e=this;if(!e.isLoading){e.isLoading=!0;var t=Object(m.h)({},e.form);t.page=e.pagination.current,t.pageSize=e.pagination.pageSize,t.type=e.typeSum,t.defective_level=e.defective_levels.join(","),t.property=e.properties.join(","),e._fetch("/productstock/search",t).then(function(t){e._hideDialog("search"),e.searchresult=[],console.log(t),t.data.data.forEach(function(r){d.h.get(r,function(r){e.searchresult.push(r),e.searchresult.length==t.data.data.length&&(e.isLoading=!1,Object(m.h)(e.pagination,t.data.pagination))},2)}),0==t.data.data.length&&(e.isLoading=!1)})}},getRowStyle:function(e){var t=e.row,r=t.product;if(r&&r.saletype&&r.saletype.colortemplate)return{color:r.saletype.colortemplate.row.name_en}},onSelectionChange:function(e){this.selected=e},onRowClick:function(e){this.$refs.table.toggleRowSelection(e),console.log(this.$refs.table,"row click")},showFormToModifyPrice:function(){var e=this,t=e.selected.map(function(e){return e.product.id});e.$refs.modifyprice.show(t)},tableRowClassName:function(e){e.row;return e.rowIndex%2==0?"stripe1":""}},computed:{width:function(){return 55*this.searchresult.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)},typeSum:function(){return this.types.reduce(function(e,t){return e+1*t},0)}}}},345:function(e,t,r){"use strict";t.a={name:"sp-productstock-show",props:{columns:{type:Array},stocks:{type:[Array],require:!0},type:{type:Number}},data:function(){var e=this,t={};return e.columns.forEach(function(e){t[e.id]=""}),{form:t}},methods:{update:function(e){var t=this,r=t.form;t.stocks.forEach(function(e){var a=void 0;3==t.type?a=e.number:1==t.type?a=e.number-e.reserve_number:2==t.type&&(a=e.reserve_number),r[e.sizecontentid]=a})}},watch:{type:function(){this.update()}},mounted:function(){this.update()}}},396:function(e,t,r){"use strict";var a=r(345),n=r(397),l=r(0),o=l(a.a,n.a,!1,null,null,null);t.a=o.exports},397:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"sizecontent"},[r("el-row",e._l(e.columns,function(t,a){return r("el-col",{key:t.id,staticStyle:{width:"51px"},attrs:{align:"center",span:1}},[e._v(e._s(t.name))])}),1),e._v(" "),r("el-row",e._l(e.columns,function(t,a){return r("el-input",{key:t.id,staticStyle:{width:"51px"},attrs:{value:e.form[t.id],size:"mini",disabled:""}})}),1)],1)},n=[],l={render:a,staticRenderFns:n};t.a=l},398:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticStyle:{width:"100%"}},[r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._showDialog("search")}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),r("asa-button",{attrs:{type:"primary",enable:e._isAllowed("product")&&e.selected.length>0},on:{click:function(t){return e.showFormToModifyPrice()}}},[e._v(e._s(e._label("xiugaijiage")))]),e._v(" "),r("div",{staticClass:"product"},[r("el-table",{ref:"table",staticStyle:{width:"100%"},attrs:{data:e.searchresult,border:"","row-style":e.getRowStyle,rowClassName:e.tableRowClassName},on:{"row-dblclick":e.showDetail,"selection-change":e.onSelectionChange,"row-click":e.onRowClick}},[r("el-table-column",{attrs:{type:"selection",width:60}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhutu"),align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-product-icon",{attrs:{file:t.product.picture}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",sortable:"",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n          "+e._s(r.product.getName())+"\n        ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",sortable:"",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-product-tip",{attrs:{product:t.product}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("kucunshuliang"),width:e.width,align:"left"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("sp-productstock-show",{attrs:{columns:a.product.sizecontents,stocks:a.stocks,type:e.typeSum}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chuchangjia"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n          "+e._s(r.product.factorypricecurrency_label+" "+r.product.factoryprice)+"\n        ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojilingshoujia"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n          "+e._s(r.product.wordpricecurrency_label+" "+r.product.wordprice)+"\n        ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chengben"),width:"140",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("sp-select-text",{attrs:{value:a.product.costcurrency,source:"currency"}}),e._v("\n          "+e._s(a.product.cost)+"\n        ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shuxing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.property,source:"orderproperty"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("canpin"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.defective_level,source:"defectivelevel"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("xiaoshoushuxing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.saletypeid,source:"saletype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shangpinshuxing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.producttypeid,source:"producttype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zuihouruku"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n          "+e._s(e._left(r.product.laststoragedate,10))+"\n        ")]}}])})],1),e._v(" "),e.searchresult.length<e.pagination.total?r("el-pagination",{attrs:{"current-page":1*e.pagination.current,"page-sizes":e.pagination.pageSizes,"page-size":1*e.pagination.pageSize,layout:"total, sizes, prev, pager, next, jumper",total:1*e.pagination.total},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}}):e._e()],1),e._v(" "),r("sp-dialog",{ref:"search",attrs:{width:900}},[r("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"70px",inline:!1,size:"mini"},nativeOn:{submit:function(e){e.preventDefault()}}},[r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("guojima"),prop:"ageseason"}},[r("el-input",{staticClass:"width2",model:{value:e.form.wordcode,callback:function(t){e.$set(e.form,"wordcode",t)},expression:"form.wordcode"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("niandai"),prop:"ageseason"}},[r("simple-select",{attrs:{source:"ageseason",multiple:!0},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinpai"),prop:"brandid"}},[r("simple-select",{attrs:{source:"brand",multiple:!0},model:{value:e.form.brandid,callback:function(t){e.$set(e.form,"brandid",t)},expression:"form.brandid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinlei"),prop:"brandgroupid"}},[r("simple-select",{attrs:{source:"brandgroup",multiple:!0},model:{value:e.form.brandgroupid,callback:function(t){e.$set(e.form,"brandgroupid",t)},expression:"form.brandgroupid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zipinlei"),prop:"childbrand"}},[r("simple-select",{ref:"childbrand",attrs:{source:"brandgroupchild",parentid:e.form.brandgroupid,multiple:!0},model:{value:e.form.childbrand,callback:function(t){e.$set(e.form,"childbrand",t)},expression:"form.childbrand"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("chandi"),prop:"countries"}},[r("simple-select",{attrs:{source:"country"},model:{value:e.form.countries,callback:function(t){e.$set(e.form,"countries",t)},expression:"form.countries"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shangpinchicun")}},[r("simple-select",{attrs:{source:"ulnarinch",multiple:!0},model:{value:e.form.ulnarinch,callback:function(t){e.$set(e.form,"ulnarinch",t)},expression:"form.ulnarinch"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("shangpinmiaoshu")}},[r("simple-select",{attrs:{source:"productmemo",multiple:!0},model:{value:e.form.productmemoids,callback:function(t){e.$set(e.form,"productmemoids",t)},expression:"form.productmemoids"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shangpinxilie")}},[r("simple-select",{ref:"series",attrs:{source:"series",parentid:e.form.brandid,multiple:!0},model:{value:e.form.series,callback:function(t){e.$set(e.form,"series",t)},expression:"form.series"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xiaoshoushuxing")}},[r("simple-select",{attrs:{source:"saletype",multiple:!0},model:{value:e.form.saletypeid,callback:function(t){e.$set(e.form,"saletypeid",t)},expression:"form.saletypeid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shangpinshuxing")}},[r("simple-select",{attrs:{source:"producttype",multiple:!0},model:{value:e.form.producttypeid,callback:function(t){e.$set(e.form,"producttypeid",t)},expression:"form.producttypeid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xingbie")}},[r("simple-select",{attrs:{source:"gender",multiple:!0},model:{value:e.form.gender,callback:function(t){e.$set(e.form,"gender",t)},expression:"form.gender"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jijie")}},[r("simple-select",{attrs:{source:"season2",multiple:!0},model:{value:e.form.season,callback:function(t){e.$set(e.form,"season",t)},expression:"form.season"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("kucunzhuangtai")}},[r("el-checkbox-group",{model:{value:e.types,callback:function(t){e.types=t},expression:"types"}},[r("el-checkbox",{attrs:{label:"1"}},[e._v(e._s(e._label("daishou")))]),e._v(" "),r("el-checkbox",{attrs:{label:"2"}},[e._v(e._s(e._label("yushou")))])],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shuxing")}},[r("el-checkbox-group",{model:{value:e.properties,callback:function(t){e.properties=t},expression:"properties"}},[r("el-checkbox",{attrs:{label:"1"}},[e._v(e._s(e._label("zicai")))]),e._v(" "),r("el-checkbox",{attrs:{label:"2"}},[e._v(e._s(e._label("daixiao")))])],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhiliang")}},[r("el-checkbox-group",{model:{value:e.defective_levels,callback:function(t){e.defective_levels=t},expression:"defective_levels"}},[r("el-checkbox",{attrs:{label:"1"}},[e._v(e._s(e._label("hege")))]),e._v(" "),r("el-checkbox",{attrs:{label:"2"}},[e._v(e._s(e._label("cancipin")))])],1)],1)],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{attrs:{align:"center"}},[r("as-button",{attrs:{auth:"product",type:"primary","native-type":"submit"},on:{click:e.onSearch}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("search")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1),e._v(" "),r("sp-dialog",{ref:"product-detail",attrs:{width:900}},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.productresult,border:"","row-style":e.getRowStyle,rowClassName:e.tableRowClassName}},[r("el-table-column",{attrs:{label:e._label("cangku"),width:"160",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.warehouseid,source:"warehouse"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",sortable:"",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){t.row;return[r("sp-product-tip",{attrs:{product:e.product.product}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("kucunshuliang"),width:"498",align:"left"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("sp-productstock-show",{attrs:{columns:e.product.product.sizecontents,stocks:a.stocks,type:e.typeSum}})]}}])})],1)],1),e._v(" "),r("asa-product-modify-price",{ref:"modifyprice"})],1)},n=[],l={render:a,staticRenderFns:n};t.a=l}});