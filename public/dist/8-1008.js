webpackJsonp([8],{287:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=r(319),o=r(354),a=r(0),c=a(n.a,o.a,!1,null,null,null);t.default=c.exports},319:function(e,t,r){"use strict";var n=r(1),o=r(124),a=r(179),c=r(353),i=r(33);t.a={name:"sp-product",components:{product:o.a,productadd:a.a},data:function(){return{form:{},props:{columns:[{name:"picture",label:Object(n.d)("zhutu"),is_image:!0,image_width:50,image_height:50,width:60,className:"picture"},{name:"picture2",label:Object(n.d)("futu"),is_image:!0,image_width:50,image_height:50,width:60,className:"picture"},{name:"productname",label:Object(n.d)("shangpinmingcheng"),width:300,convert:function(e,t,r){return e.getName()}},{name:"ageseason",label:Object(n.d)("niandai"),type:"select",source:"ageseason",width:120},{name:"wordcode_1",label:Object(n.d)("guojima"),width:150,convert:function(e,t,r){return[e.wordcode_1,e.wordcode_2,e.wordcode_3].join(" ")},style:"font-weight:bold"},{name:"producttypeid",label:Object(n.d)("shangpinshuxing"),width:120,type:"select",source:"producttype"},{name:"factoryprice",label:Object(n.d)("chuchangjia"),width:130,convert:function(e){return[e.factorypricecurrency_label,e.factoryprice].join(" ")}},{name:"belv",label:Object(n.d)("beilv"),width:120},{name:"wordprice",label:Object(n.d)("guojilingshoujia"),width:130,convert:function(e){return[e.wordpricecurrency_label,e.wordprice].join(" ")}},{name:"zhekoulv",label:Object(n.d)("lingshoubi"),width:120,convert:function(e){return e.getZKL()}},{name:"nationalprice",label:Object(n.d)("benguolingshoujia"),width:130,convert:function(e){return[e.nationalpricecurrency_label,e.nationalprice].join(" ")}},{name:"saletypeid",label:Object(n.d)("xiaoshoushuxing"),width:120,type:"select",source:"saletype"},{name:"lingshoubi",label:Object(n.d)("lingshoubi"),width:120},{name:"laststoragedate",label:Object(n.d)("zuihouruku"),width:120}],controller:"product",model:i.e,authname:"product",options:{rowStyle:function(e){var t=e.row;e.rowIndex;if(t&&t.saletype&&t.saletype.colortemplate)return{color:t.saletype.colortemplate.row.name_en}},pagination:{pageSize:15}}}}},beforeCreate:function(){n.a.resources={},n.a.caches={}},methods:{onSearch:function(e){this.form=e,this.search()},search:function(){var e=this;e.$refs.tablelist.search(e.form),e._hideDialog("search")},showFormToEdit:function(e,t){this.$refs.product.setInfo(t).then(function(e){return e.edit(!0).show()})},showFormToCreate:function(){this.$refs.productadd.show()},onPreview:function(e){c.a.show({url:e})}},mounted:function(){this._log("mounted xxx")}}},353:function(e,t,r){"use strict";var n=r(177),o=r.n(n),a=r(180),c=function(e){var t=e||{},r=new o.a({data:t,render:function(e){return e(a.a,{props:t})}}),n=r.$mount();return document.body.appendChild(n.$el),r.$children[0]},i=void 0;t.a={show:function(e){i=i||c(e),i.show(e)}}},354:function(e,t,r){"use strict";var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-row",[r("el-col",{attrs:{span:2}},[r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._showDialog("search",{width:600})}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),r("auth",{attrs:{auth:"product"}},[r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.showFormToCreate()}}},[e._v(e._s(e._label("button-create")))])],1)],1)],1),e._v(" "),r("el-row",{staticClass:"product",attrs:{gutter:20}},[r("el-col",{attrs:{span:24}},[r("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{onclickupdate:e.showFormToEdit},on:{preview:e.onPreview},scopedSlots:e._u([{key:"belv",fn:function(e){var t=e.row;return[r("sp-product-bl",{attrs:{product:t}})]}},{key:"lingshoubi",fn:function(e){var t=e.row;return[r("sp-product-lsb",{attrs:{product:t}})]}},{key:"productname",fn:function(t){var n=t.row;return[r("el-link",{attrs:{type:"primary"},on:{click:function(t){return e.showFormToEdit(0,n)}}},[e._v(e._s(n.getName()))])]}}])},"simple-admin-tablelist",e.props,!1))],1)],1),e._v(" "),r("product",{ref:"product",on:{change:e.search}}),e._v(" "),r("productadd",{ref:"productadd",on:{change:e.search}}),e._v(" "),r("sp-image-preview"),e._v(" "),r("sp-dialog",{ref:"search"},[r("sp-product-search-form",{on:{search:e.onSearch,close:function(t){return e._hideDialog("search")}}})],1)],1)},o=[],a={render:n,staticRenderFns:o};t.a=a}});
//# sourceMappingURL=8-1008.js.map