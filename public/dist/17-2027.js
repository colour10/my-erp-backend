webpackJsonp([17],{350:function(e,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=i(468),n=i(578),l=i(0),o=l(a.a,n.a,!1,null,null,null);t.default=o.exports},468:function(e,t,i){"use strict";var a=i(12),n=i.n(a),l=i(2),o=i(141),r=i.n(o),s=i(576);t.a={name:"material",components:{materialform:s.a},data:function(){return{materialnoteids:[],materialnotes:[],dialogMaterialnoteTitle:"",dialogMaterialnoteVisible:!1,dialogFormVisible:!1,id:0,dialogStatus:"",dialogTitleMap:{create:Object(l.m)("tianjiaxinxi"),update:Object(l.m)("xiugaixinxi")},pagination:{pageSizes:l.f.pageSizes,pageSize:20,total:0,current:1},listQuery:{keyword:"",sort:"",order:""},list:[],listLoading:!1}},created:function(){this.getList()},methods:{saveMaterialnoteids:function(){var e=this,t={id:this.id,materialnoteids:this.materialnoteids};this._submit("/material/saveMaterialnoteids",t).then(function(){e.hideDialogMaterialnote(),e.reloadList()})},getMaterialnotes:function(){if(0===this.materialnotes.length){var e=this;this._fetch("/l/materialnote",{}).then(function(t){var i=Object(l.m)("lang"),a="content_"+i;t.data.forEach(function(t){var i=t.id,n=t[a];e.materialnotes.push({key:i,label:n})})})}},handlMaterialnote:function(e){this.id=e.id;var t=Object(l.m)("lang"),i="name_"+t;this.dialogMaterialnoteTitle=e[i]+" - "+Object(l.m)("caizhibeizhu"),this.showDialogMaterialnote(),this.getMaterialnotes(),this.materialnoteids=r.a.isEmpty(e.materialnoteids)?[]:e.materialnoteids.split(","),void 0!==this.$refs.transfer&&(this.$refs.transfer.$children[0]._data.query="",this.$refs.transfer.$children[3]._data.query="")},showDialogMaterialnote:function(){this.dialogMaterialnoteVisible=!0},hideDialogMaterialnote:function(){this.dialogMaterialnoteVisible=!1},handleDelete:function(e){var t=this;t._remove("/material/delete/",{id:e.id}).then(function(){t.reloadList()})},handleFilter:function(){this.getList()},handleUpdate:function(e){this.id=e.id,this.dialogStatus="update",this.showDialogForm()},hideDialogForm:function(){this.dialogFormVisible=!1},showDialogForm:function(){this.dialogFormVisible=!0},handleCreate:function(){this.id=0,this.dialogStatus="create",this.showDialogForm()},handleSort:function(e){this.listQuery.sort=e.prop,this.listQuery.order=e.order,this.getList()},getList:function(){this.listLoading=!0;var e=this,t=n()({page:e.pagination.current,pageSize:e.pagination.pageSize},e.listQuery);e._fetch("/material/page",t).then(function(t){e.list=t.data,e.pagination=t.pagination,e.listLoading=!1})},reloadList:function(){this.getList()},handleSizeChange:function(e){this.pagination.pageSize=e,this.getList()},handleCurrentChange:function(e){this.pagination.current=e,this.getList()}}}},469:function(e,t,i){"use strict";var a=i(12),n=i.n(a),l=i(2),o={name_cn:"",name_en:"",name_it:"",code:""};t.a={name:"materialform",props:{id:{type:String}},data:function(){return{rules:{name_cn:[{required:!0,message:Object(l.m)("name","cn")+Object(l.m)("required"),trigger:"blur"}],name_en:[{required:!0,message:Object(l.m)("name","en")+Object(l.m)("required"),trigger:"blur"}],name_it:[{required:!0,message:Object(l.m)("name","it")+Object(l.m)("required"),trigger:"blur"}]},form:n()({},o)}},methods:{getInfo:function(e){var t=this;this._fetch("/material/info",{id:e}).then(function(e){t.form.name_cn=e.data.name_cn,t.form.name_en=e.data.name_en,t.form.name_it=e.data.name_it,t.form.code=e.data.code})},submit:function(){var e=this;this.$refs.form.validate(function(t){t&&(e.id>0?(e.form.id=e.id,e._submit("/material/edit",e.form).then(function(t){e.cancel(),e.$emit("reloadList")})):e._submit("/material/add",e.form).then(function(t){e.cancel(),e.$emit("reloadList")}))})},cancel:function(){this.$emit("cancel")}},watch:{id:function(e){e>0?this.getInfo(e):this.form=n()({},o)}},mounted:function(){this.id&&this.getInfo(this.id)}}},576:function(e,t,i){"use strict";var a=i(469),n=i(577),l=i(0),o=l(a.a,n.a,!1,null,null,null);t.a=o.exports},577:function(e,t,i){"use strict";var a=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("el-form",{ref:"form",staticClass:"user-form",attrs:{model:e.form,"label-width":"100px",size:"mini",rules:e.rules,"show-message":!1}},[i("el-form-item",{staticClass:"width2",attrs:{label:e.showLabel("name","cn"),prop:"name_cn"}},[i("el-input",{model:{value:e.form.name_cn,callback:function(t){e.$set(e.form,"name_cn",t)},expression:"form.name_cn"}})],1),e._v(" "),i("el-form-item",{staticClass:"width2",attrs:{label:e.showLabel("name","en"),prop:"name_en"}},[i("el-input",{model:{value:e.form.name_en,callback:function(t){e.$set(e.form,"name_en",t)},expression:"form.name_en"}})],1),e._v(" "),i("el-form-item",{staticClass:"width2",attrs:{label:e.showLabel("name","it"),prop:"name_it"}},[i("el-input",{model:{value:e.form.name_it,callback:function(t){e.$set(e.form,"name_it",t)},expression:"form.name_it"}})],1),e._v(" "),i("el-form-item",{staticClass:"width2",attrs:{label:e.showLabel("code"),prop:"code"}},[i("el-input",{model:{value:e.form.code,callback:function(t){e.$set(e.form,"code",t)},expression:"form.code"}})],1),e._v(" "),i("el-row",[i("el-col",{staticStyle:{"text-align":"center"},attrs:{span:24}},[i("el-button",{attrs:{type:"primary",size:"mini"},on:{click:e.submit}},[e._v(e._s(e.showLabel("baocun")))]),e._v(" "),i("el-button",{attrs:{type:"primary",size:"mini"},on:{click:e.cancel}},[e._v(e._s(e.showLabel("quxiao")))])],1)],1)],1)},n=[],l={render:a,staticRenderFns:n};t.a=l},578:function(e,t,i){"use strict";var a=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",[i("div",{staticClass:"filter-container"},[i("el-form",{attrs:{model:e.listQuery,size:"mini",inline:!0}},[i("el-form-item",[i("el-input",{staticStyle:{width:"200px"},attrs:{size:"mini"},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.handleFilter(t)}},model:{value:e.listQuery.keyword,callback:function(t){e.$set(e.listQuery,"keyword",t)},expression:"listQuery.keyword"}})],1),e._v(" "),i("el-button",{staticClass:"filter-item",attrs:{type:"primary",size:"mini",icon:"el-icon-search"},on:{click:e.handleFilter}},[e._v("\n        "+e._s(e.showLabel("search"))+"\n      ")]),e._v(" "),i("el-button",{staticClass:"filter-item",staticStyle:{"margin-left":"10px"},attrs:{type:"success",size:"mini",icon:"el-icon-edit"},on:{click:e.handleCreate}},[e._v("\n        "+e._s(e.showLabel("button-create"))+"\n      ")])],1)],1),e._v(" "),i("el-table",{directives:[{name:"loading",rawName:"v-loading",value:e.listLoading,expression:"listLoading"}],attrs:{data:e.list,border:"",stripe:""},on:{"sort-change":e.handleSort}},[i("el-table-column",{attrs:{label:e.showLabel("caozuo"),align:"center",width:"230","class-name":"small-padding fixed-width"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[i("el-button",{attrs:{type:"default",size:"mini"},on:{click:function(t){return e.handleUpdate(a)}}},[e._v(e._s(e.showLabel("bianji")))]),e._v(" "),i("el-button",{attrs:{type:"danger",size:"mini"},on:{click:function(t){return e.handleDelete(a)}}},[e._v(e._s(e.showLabel("shanchu")))])]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("name","cn"),align:"center",width:"110",sortable:"custom",prop:"name_cn"}}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("name","en"),align:"center",width:"180",sortable:"custom",prop:"name_en"}}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("name","it"),align:"center",width:"210",sortable:"custom",prop:"name_it"}}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("code"),align:"center",width:"210",sortable:"custom",prop:"code"}}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("caizhibeizhu"),prop:"materialnotes"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[i("el-link",{staticStyle:{"font-size":"12px"},attrs:{type:"primary",underline:!1},on:{click:function(t){return e.handlMaterialnote(a)}}},[e._v("\n          "+e._s(e._label("caizhibeizhu"))+"\n        ")])]}}])})],1),e._v(" "),e.list.length<e.pagination.total?i("el-pagination",{attrs:{"current-page":1*e.pagination.current,"page-sizes":e.pagination.pageSizes,"page-size":1*e.pagination.pageSize,layout:"total, sizes, prev, pager, next, jumper",total:1*e.pagination.total},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}}):e._e(),e._v(" "),i("el-dialog",{attrs:{title:e.dialogTitleMap[e.dialogStatus],visible:e.dialogFormVisible,center:!0,width:"400px",modal:!1},on:{"update:visible":function(t){e.dialogFormVisible=t}}},[i("materialform",{attrs:{id:e.id},on:{cancel:e.hideDialogForm,reloadList:e.reloadList}})],1),e._v(" "),i("el-dialog",{attrs:{title:e.dialogMaterialnoteTitle,visible:e.dialogMaterialnoteVisible,width:"700px"},on:{"update:visible":function(t){e.dialogMaterialnoteVisible=t}}},[i("el-transfer",{ref:"transfer",attrs:{filterable:"",data:e.materialnotes,titles:["未关联","已关联"]},model:{value:e.materialnoteids,callback:function(t){e.materialnoteids=t},expression:"materialnoteids"}}),e._v(" "),i("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[i("el-button",{on:{click:e.hideDialogMaterialnote}},[e._v("\n        "+e._s(e.showLabel("quxiao"))+"\n      ")]),e._v(" "),i("el-button",{attrs:{type:"primary"},on:{click:e.saveMaterialnoteids}},[e._v("\n        "+e._s(e.showLabel("baocun"))+"\n      ")])],1)],1)],1)},n=[],l={render:a,staticRenderFns:n};t.a=l}});