webpackJsonp([18],{312:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=a(424),i=a(541),o=a(0),r=o(n.a,i.a,!1,null,null,null);t.default=r.exports},346:function(e,t,a){var n=a(347);"string"==typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);a(181)("3cc9f1f6",n,!0,{})},347:function(e,t,a){t=e.exports=a(180)(!1),t.push([e.i,".el-table--striped .el-table__body tr.el-table__row--striped td,.el-table .el-table__row--striped{background-color:oldlace}",""])},424:function(e,t,a){"use strict";var n=a(19),i=a.n(n),o=a(2),r=a(346),l=(a.n(r),{id:void 0,name_cn:"",name_en:"",name_it:"",displayindex:""});t.a={name:"productmemo",data:function(){return{list:[],listQuery:{keyword:void 0,sort:void 0,order:void 0},pagination:{pageSizes:o.f.pageSizes,pageSize:10,total:0,current:1},listLoading:!0,dialogStatus:"",dialogFormVisible:!1,textMap:{update:Object(o.n)("xiugaixinxi"),create:Object(o.n)("tianjiaxinxi")},postForm:i()({},l),rules:{name_cn:[{required:!0,message:Object(o.n)("name","cn")+Object(o.n)("required"),trigger:"blur"}],name_en:[{required:!0,message:Object(o.n)("name","en")+Object(o.n)("required"),trigger:"blur"}],name_it:[{required:!0,message:Object(o.n)("name","it")+Object(o.n)("required"),trigger:"blur"}],displayindex:[{required:!0,message:Object(o.n)("xuhao")+Object(o.n)("required"),trigger:"blur"}]},brandDialogTitle:"",dialogBrandVisible:!1,productmemoBrands:[],brands:[],productmemo_id:0}},created:function(){this.getList(),this.getBrands()},methods:{saveProductmemoBrand:function(){var e=this;if(this.productmemoBrands.length>0){var t={productmemo_id:e.productmemo_id,brands:e.productmemoBrands};e._submit("/productmemo/saveProductmemoBrand",t).then(function(){e.hideDialogBrand()})}else this.hideDialogBrand()},getProductmemoBrand:function(){var e=this,t={productmemo_id:e.productmemo_id};e._fetch("/productmemo/getProductmemoBrandgroupchild",t).then(function(t){e.productmemoBrands=[],t.data.forEach(function(t){e.productmemoBrands.push(t.brandgroupchild_id)})})},getBrands:function(){var e=this;e._fetch("/l/brandgroupchild",{}).then(function(t){e.brands=t.data})},handleBrand:function(e){this.productmemo_id=e.id;var t=Object(o.n)("lang"),a="name_"+t;this.brandDialogTitle=e[a]+" - "+Object(o.n)("zipinlei"),this.showDialogBrand(),this.getProductmemoBrand(),this.$refs.brandTransfer.$children[0]._data.query="",this.$refs.brandTransfer.$children[3]._data.query=""},handleCreate:function(){this.dialogStatus="create",this.resetDialogForm(),this.showDialogForm()},handleUpdate:function(e){i()(this.postForm,e),this.dialogStatus="update",this.showDialogForm()},handleDelete:function(e){this.deleteData(e.id)},handleSort:function(e){this.listQuery.sort=e.prop,this.listQuery.order=e.order,this.getList()},handleFilter:function(){this.pagination.current=1,this.getList()},handleSizeChange:function(e){this.pagination.pageSize=e,this.getList()},handleCurrentChange:function(e){this.pagination.current=e,this.getList()},getList:function(){var e=this;e.listLoading=!0;var t=i()({page:e.pagination.current,pageSize:e.pagination.pageSize},e.listQuery);e._fetch("/productmemo/page",t).then(function(t){e.list=t.data,e.pagination=t.pagination,e.listLoading=!1})},reloadList:function(){this.getList()},createData:function(){var e=this;this.$refs.dataForm.validate(function(t){t&&e._submit("/productmemo/add",e.postForm).then(function(){e.hideDialogForm(),e.reloadList()})})},updateData:function(){var e=this;this.$refs.dataForm.validate(function(t){t&&e._submit("/productmemo/edit",e.postForm).then(function(){e.hideDialogForm(),e.reloadList()})})},deleteData:function(e){var t=this;t._remove("/productmemo/delete",{id:e}).then(function(){t.reloadList()})},resetDialogForm:function(){this.postForm=i()({},l)},showDialogForm:function(){this.dialogFormVisible=!0},hideDialogForm:function(){this.dialogFormVisible=!1},showDialogBrand:function(){this.dialogBrandVisible=!0},hideDialogBrand:function(){this.dialogBrandVisible=!1,this.productmemoBrands=[]}}}},541:function(e,t,a){"use strict";var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("div",{staticClass:"filter-container"},[a("el-input",{staticClass:"filter-item",staticStyle:{width:"200px"},attrs:{size:"mini"},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.handleFilter(t)}},model:{value:e.listQuery.keyword,callback:function(t){e.$set(e.listQuery,"keyword",t)},expression:"listQuery.keyword"}}),e._v(" "),a("el-button",{staticClass:"filter-item",attrs:{type:"primary",size:"mini",icon:"el-icon-search"},on:{click:e.handleFilter}},[e._v("\n            "+e._s(e.showLabel("search"))+"\n        ")]),e._v(" "),a("el-button",{staticClass:"filter-item",staticStyle:{"margin-left":"10px"},attrs:{type:"primary",size:"mini",icon:"el-icon-edit"},on:{click:e.handleCreate}},[e._v("\n            "+e._s(e.showLabel("button-create"))+"\n        ")])],1),e._v(" "),a("el-table",{directives:[{name:"loading",rawName:"v-loading",value:e.listLoading,expression:"listLoading"}],attrs:{data:e.list,border:"",stripe:""},on:{"sort-change":e.handleSort}},[a("el-table-column",{attrs:{label:e.showLabel("caozuo"),align:"center",width:"230","class-name":"small-padding fixed-width"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[a("el-button",{attrs:{type:"default",size:"mini"},on:{click:function(t){return e.handleUpdate(n)}}},[e._v(e._s(e.showLabel("bianji")))]),e._v(" "),a("el-button",{attrs:{type:"danger",size:"mini"},on:{click:function(t){return e.handleDelete(n)}}},[e._v(e._s(e.showLabel("shanchu")))])]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e.showLabel("name","cn"),align:"center",width:"110",sortable:"custom",prop:"name_cn"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[a("span",[e._v(e._s(n.name_cn))])]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e.showLabel("name","en"),align:"center",width:"180",sortable:"custom",prop:"name_en"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[a("span",[e._v(e._s(n.name_en))])]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e.showLabel("name","it"),align:"center",width:"210",sortable:"custom",prop:"name_it"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[a("span",[e._v(e._s(n.name_it))])]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e.showLabel("xuhao"),align:"center",sortable:"custom",prop:"displayindex"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[a("span",[e._v(e._s(n.displayindex))])]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e.showLabel("zipinlei"),align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[a("el-link",{attrs:{type:"primary"},on:{click:function(t){return t.stopPropagation(),e.handleBrand(n)}}},[e._v(e._s(e.showLabel("zipinlei")))])]}}])})],1),e._v(" "),e.list.length<e.pagination.total?a("el-pagination",{attrs:{"current-page":1*e.pagination.current,"page-sizes":e.pagination.pageSizes,"page-size":1*e.pagination.pageSize,layout:"total, sizes, prev, pager, next, jumper",total:1*e.pagination.total},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}}):e._e(),e._v(" "),a("el-dialog",{attrs:{title:e.textMap[e.dialogStatus],visible:e.dialogFormVisible,width:"400px"},on:{"update:visible":function(t){e.dialogFormVisible=t}}},[a("el-form",{ref:"dataForm",staticStyle:{width:"300px","margin-left":"10px"},attrs:{rules:e.rules,model:e.postForm,"label-position":"left","label-width":"80px"}},[a("el-form-item",{attrs:{label:e.showLabel("name","cn"),prop:"name_cn"}},[a("el-input",{model:{value:e.postForm.name_cn,callback:function(t){e.$set(e.postForm,"name_cn",t)},expression:"postForm.name_cn"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e.showLabel("name","en"),prop:"name_en"}},[a("el-input",{model:{value:e.postForm.name_en,callback:function(t){e.$set(e.postForm,"name_en",t)},expression:"postForm.name_en"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e.showLabel("name","it"),prop:"name_it"}},[a("el-input",{model:{value:e.postForm.name_it,callback:function(t){e.$set(e.postForm,"name_it",t)},expression:"postForm.name_it"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e.showLabel("xuhao"),prop:"displayindex"}},[a("el-input",{attrs:{type:"number"},model:{value:e.postForm.displayindex,callback:function(t){e.$set(e.postForm,"displayindex",t)},expression:"postForm.displayindex"}})],1)],1),e._v(" "),a("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[a("el-button",{on:{click:function(t){e.dialogFormVisible=!1}}},[e._v("\n                "+e._s(e.showLabel("quxiao"))+"\n            ")]),e._v(" "),a("el-button",{attrs:{type:"primary"},on:{click:function(t){"create"===e.dialogStatus?e.createData():e.updateData()}}},[e._v("\n                "+e._s(e.showLabel("baocun"))+"\n            ")])],1)],1),e._v(" "),a("el-dialog",{attrs:{title:e.brandDialogTitle,visible:e.dialogBrandVisible,width:"700px"},on:{"update:visible":function(t){e.dialogBrandVisible=t}}},[a("el-transfer",{ref:"brandTransfer",attrs:{filterable:"",data:e.brands,props:{key:"id",label:"name_cn"},titles:["未关联","已关联"]},model:{value:e.productmemoBrands,callback:function(t){e.productmemoBrands=t},expression:"productmemoBrands"}}),e._v(" "),a("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[a("el-button",{on:{click:e.hideDialogBrand}},[e._v("\n                "+e._s(e.showLabel("quxiao"))+"\n            ")]),e._v(" "),a("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.saveProductmemoBrand()}}},[e._v("\n                "+e._s(e.showLabel("baocun"))+"\n            ")])],1)],1)],1)},i=[],o={render:n,staticRenderFns:i};t.a=o}});