webpackJsonp([24],{304:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=r(358),n=r(406),a=r(0),i=a(o.a,n.a,!1,null,null,null);t.default=i.exports},358:function(e,t,r){"use strict";var o=r(1),n=r(131),a=r(190),i=r(191),c=r(35);t.a={name:"sp-product",components:{product:n.a,productadd:a.a},data:function(){return{form:{},props:{columns:[{name:"picture",label:Object(o.d)("zhutu"),is_image:!0,image_width:50,image_height:50,width:60,className:"picture"},{name:"picture2",label:Object(o.d)("futu"),is_image:!0,image_width:50,image_height:50,width:60,className:"picture"},{name:"productname",label:Object(o.d)("shangpinmingcheng"),width:300,convert:function(e,t,r){return e.getName()}},{name:"ageseason",label:Object(o.d)("niandai"),type:"select",source:"ageseason",width:120},{name:"wordcode_1",label:Object(o.d)("guojima"),width:150,convert:function(e,t,r){return[e.wordcode_1,e.wordcode_2,e.wordcode_3].join(" ")},style:"font-weight:bold"},{name:"producttypeid",label:Object(o.d)("shangpinshuxing"),width:120,type:"select",source:"producttype"},{name:"factoryprice",label:Object(o.d)("chuchangjia"),width:130,convert:function(e){return[e.factorypricecurrency_label,e.factoryprice].join(" ")}},{name:"belv",label:Object(o.d)("beilv"),width:120},{name:"wordprice",label:Object(o.d)("guojilingshoujia"),width:130,convert:function(e){return[e.wordpricecurrency_label,e.wordprice].join(" ")}},{name:"zhekoulv",label:Object(o.d)("lingshoubi"),width:120,convert:function(e){return e.getZKL()}},{name:"nationalprice",label:Object(o.d)("benguolingshoujia"),width:130,convert:function(e){return[e.nationalpricecurrency_label,e.nationalprice].join(" ")}},{name:"saletypeid",label:Object(o.d)("xiaoshoushuxing"),width:120,type:"select",source:"saletype"},{name:"lingshoubi",label:Object(o.d)("lingshoubi"),width:120},{name:"series",label:Object(o.d)("xilie"),width:120},{name:"laststoragedate",label:Object(o.d)("zuihouruku"),width:120}],controller:"product",model:c.e,authname:"product",options:{rowStyle:function(e){var t=e.row;e.rowIndex;if(t&&t.saletype&&t.saletype.colortemplate)return{color:t.saletype.colortemplate.row.name_en}},pagination:{pageSize:15}}}}},beforeCreate:function(){o.a.resources={},o.a.caches={}},methods:{onSearch:function(e){this.form=e,this.search()},search:function(){var e=this;e.$refs.tablelist.search(e.form),e._hideDialog("search")},showFormToEdit:function(e,t){this.$refs.product.setInfo(t).then(function(e){return e.edit(!0).show()})},showFormToCreate:function(){this.$refs.productadd.show()},onPreview:function(e){i.a.show({url:e})}},mounted:function(){this._log("mounted xxx")}}},406:function(e,t,r){"use strict";var o=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-row",[r("el-col",{attrs:{span:2}},[r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._showDialog("search",{width:600})}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),r("auth",{attrs:{auth:"product"}},[r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.showFormToCreate()}}},[e._v(e._s(e._label("button-create")))])],1)],1)],1),e._v(" "),r("el-row",{staticClass:"product",attrs:{gutter:20}},[r("el-col",{attrs:{span:24}},[r("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{onclickupdate:e.showFormToEdit},on:{preview:e.onPreview},scopedSlots:e._u([{key:"belv",fn:function(e){var t=e.row;return[r("sp-product-bl",{attrs:{product:t}})]}},{key:"lingshoubi",fn:function(e){var t=e.row;return[r("sp-product-lsb",{attrs:{product:t}})]}},{key:"productname",fn:function(t){var o=t.row;return[r("el-link",{attrs:{type:"primary"},on:{click:function(t){return e.showFormToEdit(0,o)}}},[e._v(e._s(o.getName()))])]}},{key:"series",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.series,source:"series"}})]}}])},"simple-admin-tablelist",e.props,!1))],1)],1),e._v(" "),r("product",{ref:"product",on:{change:e.search}}),e._v(" "),r("productadd",{ref:"productadd",on:{change:e.search}}),e._v(" "),r("sp-image-preview"),e._v(" "),r("sp-dialog",{ref:"search"},[r("sp-product-search-form",{on:{search:e.onSearch,close:function(t){return e._hideDialog("search")}}})],1)],1)},n=[],a={render:o,staticRenderFns:n};t.a=a}});
//# sourceMappingURL=24-1036.js.map