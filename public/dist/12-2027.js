webpackJsonp([12],{327:function(e,t,i){"use strict";function l(e){i(519)}Object.defineProperty(t,"__esModule",{value:!0});var a=i(435),n=i(523),r=i(0),o=l,s=r(a.a,n.a,!1,o,null,null);t.default=s.exports},377:function(e,t,i){var l=i(378);"string"==typeof l&&(l=[[e.i,l,""]]),l.locals&&(e.exports=l.locals);i(56)("3cc9f1f6",l,!0,{})},378:function(e,t,i){t=e.exports=i(55)(!1),t.push([e.i,".el-table--striped .el-table__body tr.el-table__row--striped td,.el-table .el-table__row--striped{background-color:oldlace}",""])},435:function(e,t,i){"use strict";var l=i(12),a=i.n(l),n=i(2),r=i(377),o=(i.n(r),i(521)),s=(i.n(o),i(198)),u=i(142);t.a={name:"product",components:{AsaProduct:u.a,add:s.a},data:function(){return{dialogFormVisible:!1,listLoading:!0,list:[],listQuery:{wordcode:"",ageseason:[],brandid:[],brandgroupid:[],childbrand:[],series:[]},childrenBrand:[],pagination:{pageSizes:n.f.pageSizes,pageSize:10,total:0,current:1},ageseasons:[],brands:[],categories:[],productMemos:[],series:[]}},created:function(){this.getList(),this.getProductRelatedOptions()},methods:{onClick:function(e){this.$refs.product.edit(!0).setInfo(e).then(function(e){return e.show(!1)})},getProductRelatedOptions:function(){var e=this;e._fetch("/product/getProductRelatedOptions",{}).then(function(t){e.ageseasons=t.data.ageseasons,e.brands=t.data.brands,e.categories=t.data.categories,e.productMemos=t.data.productMemos})},handleSort:function(e){this.listQuery.sort=e.prop,this.listQuery.order=e.order,this.getList()},handleDelete:function(e){var t=this;t._remove("/product/delete",{id:e.id}).then(function(){t.reloadList()})},handleResetFilter:function(){this.listQuery={sort:void 0,order:void 0,wordcode:"",ageseason:[],brandid:[],brandgroupid:[],childbrand:[],series:[]}},handleChangeBrand:function(){var e=this;e.series=[],e.listQuery.series=[],e.listQuery.brandid.length>0?e.brands.forEach(function(t){e.listQuery.brandid.indexOf(t.id)>=0&&e.series.push.apply(e.series,t.series)}):e.brands.forEach(function(t){e.series.push.apply(e.series,t.series)})},handleChangeBrandGroup:function(){var e=this;e.listQuery.childbrand=[],e.childrenBrand=[],e.categories.forEach(function(t){e.listQuery.brandgroupid.indexOf(t.id)>=0&&e.childrenBrand.push.apply(e.childrenBrand,t.children)})},handleFilter:function(){this.getList()},handleCreate:function(){this.showDialogForm(),void 0!==this.$refs.productForm&&this.$refs.productForm.resetDialogForm()},handleSizeChange:function(e){this.pagination.pageSize=e,this.getList()},handleCurrentChange:function(e){this.pagination.current=e,this.getList()},showDialogForm:function(){this.dialogFormVisible=!0},hideDialogForm:function(){this.dialogFormVisible=!1},getList:function(){var e=this;e.listLoading=!0;var t=a()({page:e.pagination.current,pageSize:e.pagination.pageSize},e.listQuery);e._fetch("/product/page",t).then(function(t){e.list=t.data,e.pagination=t.pagination,e.listLoading=!1})},reloadList:function(){this.getList()}}}},519:function(e,t,i){var l=i(520);"string"==typeof l&&(l=[[e.i,l,""]]),l.locals&&(e.exports=l.locals);i(56)("550dbc9b",l,!0,{})},520:function(e,t,i){t=e.exports=i(55)(!1),t.push([e.i,".create-product-dialog .el-dialog__header{border-bottom:1px solid #d3d3d3}",""])},521:function(e,t,i){var l=i(522);"string"==typeof l&&(l=[[e.i,l,""]]),l.locals&&(e.exports=l.locals);i(56)("61953436",l,!0,{})},522:function(e,t,i){t=e.exports=i(55)(!1),t.push([e.i,".filter-container .el-button{margin:0}",""])},523:function(e,t,i){"use strict";var l=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",[i("div",{staticClass:"filter-container"},[i("el-form",{ref:"searchForm",attrs:{inline:!0,model:e.listQuery,size:"mini"}},[i("el-form-item",{attrs:{label:e.showLabel("guojima")}},[i("el-input",{staticStyle:{width:"200px"},attrs:{size:"mini"},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.handleFilter(t)}},model:{value:e.listQuery.wordcode,callback:function(t){e.$set(e.listQuery,"wordcode",t)},expression:"listQuery.wordcode"}})],1),e._v(" "),i("el-form-item",{attrs:{label:e.showLabel("niandai")}},[i("el-select",{attrs:{multiple:"",placeholder:""},model:{value:e.listQuery.ageseason,callback:function(t){e.$set(e.listQuery,"ageseason",t)},expression:"listQuery.ageseason"}},e._l(e.ageseasons,function(e){return i("el-option",{key:e.id+e.title,attrs:{label:e.title,value:e.id}})}),1)],1),e._v(" "),i("el-form-item",{attrs:{label:e.showLabel("pinpai")}},[i("el-select",{attrs:{multiple:"",placeholder:""},on:{change:e.handleChangeBrand},model:{value:e.listQuery.brandid,callback:function(t){e.$set(e.listQuery,"brandid",t)},expression:"listQuery.brandid"}},e._l(e.brands,function(e){return i("el-option",{key:e.id+e.title,attrs:{label:e.title,value:e.id}})}),1)],1),e._v(" "),i("el-form-item",{attrs:{label:e.showLabel("pinlei")}},[i("el-select",{attrs:{filterable:"",placeholder:""},on:{change:e.handleChangeBrandGroup},model:{value:e.listQuery.brandgroupid,callback:function(t){e.$set(e.listQuery,"brandgroupid",t)},expression:"listQuery.brandgroupid"}},e._l(e.categories,function(e){return i("el-option",{key:e.id+e.title,attrs:{label:e.title,value:e.id}})}),1)],1),e._v(" "),i("el-form-item",{attrs:{label:e.showLabel("zipinlei")}},[i("el-select",{attrs:{filterable:"",placeholder:""},model:{value:e.listQuery.childbrand,callback:function(t){e.$set(e.listQuery,"childbrand",t)},expression:"listQuery.childbrand"}},e._l(e.childrenBrand,function(e){return i("el-option",{key:e.id+e.title,attrs:{label:e.title,value:e.id}})}),1)],1),e._v(" "),i("el-form-item",{attrs:{label:e.showLabel("shangpinmiaoshu")}},[i("el-select",{attrs:{multiple:"",placeholder:""},model:{value:e.listQuery.productmemoids,callback:function(t){e.$set(e.listQuery,"productmemoids",t)},expression:"listQuery.productmemoids"}},e._l(e.productMemos,function(e){return i("el-option",{key:e.id+e.title,attrs:{label:e.title,value:e.id}})}),1)],1),e._v(" "),i("el-form-item",{attrs:{label:e.showLabel("shangpinxilie")}},[i("el-select",{attrs:{multiple:"",placeholder:""},model:{value:e.listQuery.series,callback:function(t){e.$set(e.listQuery,"series",t)},expression:"listQuery.series"}},e._l(e.series,function(e){return i("el-option",{key:e.id+e.title,attrs:{label:e.title,value:e.id}})}),1)],1),e._v(" "),i("el-form-item",[i("el-button",{staticClass:"filter-item",attrs:{type:"default",size:"mini",icon:"el-icon-refresh-right"},on:{click:e.handleResetFilter}},[e._v("\n          "+e._s(e.showLabel("qingkong"))+"\n        ")])],1),e._v(" "),i("el-form-item",[i("el-button",{staticClass:"filter-item",attrs:{type:"primary",size:"mini",icon:"el-icon-search"},on:{click:e.handleFilter}},[e._v("\n          "+e._s(e.showLabel("search"))+"\n        ")])],1),e._v(" "),i("el-form-item",[i("el-button",{staticClass:"filter-item",staticStyle:{"margin-left":"10px"},attrs:{type:"success",size:"mini",icon:"el-icon-edit"},on:{click:e.handleCreate}},[e._v("\n          "+e._s(e.showLabel("button-create"))+"\n        ")])],1)],1)],1),e._v(" "),i("el-row",{staticClass:"product",attrs:{gutter:20}},[i("el-col",{attrs:{span:24}},[i("el-table",{directives:[{name:"loading",rawName:"v-loading",value:e.listLoading,expression:"listLoading"}],attrs:{data:e.list,border:"",stripe:""},on:{"sort-change":e.handleSort}},[i("el-table-column",{attrs:{label:e.showLabel("caozuo"),align:"center",width:"150","class-name":"small-padding fixed-width"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return[i("el-button",{attrs:{type:"default",size:"mini"},on:{click:function(t){return e.onClick(l)}}},[e._v(e._s(e.showLabel("bianji")))]),e._v(" "),i("el-button",{attrs:{type:"danger",size:"mini"},on:{click:function(t){return e.handleDelete(l)}}},[e._v(e._s(e.showLabel("shanchu")))])]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("zhutu")},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return[i("img",{staticStyle:{"max-width":"50px","max-height":"50px"},attrs:{src:e._fileLink(l.picture)}})]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("futu")},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return[i("img",{staticStyle:{"max-width":"50px","max-height":"50px"},attrs:{src:e._fileLink(l.picture2)}})]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("yanse")},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return e._l(l.colors,function(t){return i("div",{key:t.id,staticClass:"color-group"},[i("div",{staticClass:"box",staticStyle:{"'width":"20px",height:"20px"}},[i("img",{staticStyle:{"max-width":"20px","max-height":"20px"},attrs:{src:e._fileLink(t.picture)},on:{click:function(t){return e.onClick(l)}}})])])})}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("shangpinmingcheng"),width:"250"},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.row;return[e._v("\n            "+e._s(i.name)+"\n          ")]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("niandai"),sortable:"customer",prop:"ageseason"},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.row;return[e._v("\n            "+e._s(i.season)+"\n          ")]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("guojima"),width:"200",sortable:"customer",prop:"wordcode"},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.row;return[e._v("\n            "+e._s(i.worldcode)+"\n          ")]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("shangpinshuxing")},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.row;return[e._v("\n            "+e._s(i.type)+"\n          ")]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("chuchangjia"),width:"100"},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.row;return[e._v("\n            "+e._s(i.fpCurrencyCode)+" "+e._s(i.factoryprice)+"\n          ")]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("beilv")},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.row;return[e._v("\n            "+e._s(i.times)+"\n          ")]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("guojilingshoujia"),width:"100"},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.row;return[e._v("\n            "+e._s(i.wpCurrencyCode)+" "+e._s(i.wordprice)+"\n          ")]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("zhekoulv")},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.row;return[e._v("\n            "+e._s(i.discountRate)+"\n          ")]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("benguolingshoujia"),width:"100"},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.row;return[e._v("\n            "+e._s(i.npCurrencyCode)+" "+e._s(i.nationalprice)+"\n          ")]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("xiaoshoushuxing")},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.row;return[e._v("\n            "+e._s(i.saleType)+"\n          ")]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("lingshoubi")}},[e._v("\n          0\n        ")]),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("xilie")},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.row;return[e._v("\n            "+e._s(i.seriesTitle)+"\n          ")]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("zuihouruku")},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.row;return[e._v("\n            "+e._s(i.laststoragedate)+"\n          ")]}}])})],1)],1)],1),e._v(" "),e.list.length<e.pagination.total?i("el-pagination",{attrs:{"current-page":1*e.pagination.current,"page-sizes":e.pagination.pageSizes,"page-size":1*e.pagination.pageSize,layout:"total, sizes, prev, pager, next, jumper",total:1*e.pagination.total},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}}):e._e(),e._v(" "),i("el-dialog",{attrs:{title:e.showLabel("createProduct"),visible:e.dialogFormVisible,center:!0,width:"1400px","close-on-click-modal":!1,"close-on-press-escape":!1,"custom-class":"create-product-dialog"},on:{"update:visible":function(t){e.dialogFormVisible=t}}},[i("add",{ref:"productForm",on:{hideDialogForm:e.hideDialogForm,reloadList:e.reloadList}})],1),e._v(" "),i("asa-product",{ref:"product",on:{reloadList:e.reloadList}})],1)},a=[],n={render:l,staticRenderFns:a};t.a=n}});