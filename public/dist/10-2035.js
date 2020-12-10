webpackJsonp([10],{324:function(e,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=i(429),n=i(516),l=i(0),o=l(a.a,n.a,!1,null,null,null);t.default=o.exports},429:function(e,t,i){"use strict";var a=i(12),n=i.n(a),l=i(2),o=i(193),r=i(510),s=i(512),d=i(514);t.a={name:"brand",components:{brandform:r.a,worldcode:s.a,size:d.a},data:function(){return{countries:[],dialogStatus:"",dialogTitleMap:{create:Object(l.m)("tianjiaxinxi"),update:Object(l.m)("xiugaixinxi")},brandrate:Object(o.c)("brandrate"),aliases:Object(o.c)("aliases"),series:Object(o.c)("series"),id:0,activeName:"info",dialogFormVisible:!1,listLoading:!1,list:[],pagination:{pageSizes:l.f.pageSizes,pageSize:10,total:0,current:1},listQuery:{name_en:"",countryid:"",sort:"",order:""}}},created:function(){this.getList(),this.getCountries()},methods:{handleTabClick:function(e){var t=this;switch(e.name){case"worldcode":t.$refs.worldcode.getSetting()}},handleSort:function(e){this.listQuery.sort=e.prop,this.listQuery.order=e.order,this.getList()},handleResetFilter:function(){this.listQuery={name_en:"",countryid:""}},getCountries:function(){var e=this;this._fetch("/brand/countries",{}).then(function(t){e.countries=t.data})},handleFilter:function(){this.getList()},handleDelete:function(e){var t=this;t._remove("/brand/delete/",{id:e.id}).then(function(){t.reloadList()})},handleUpdate:function(e){this.id=parseInt(e.id),this.brandrate.base.brandid=e.id,this.aliases.base.brandid=e.id,this.series.base.brandid=e.id,this.dialogStatus="update",this.activeName="info",this.showDialogForm()},handleCreate:function(){this.id=0,this.dialogStatus="create",this.activeName="info",this.showDialogForm()},showDialogForm:function(){this.dialogFormVisible=!0},hideDialogForm:function(){this.dialogFormVisible=!1},getList:function(){var e=this;e.listLoading=!0;var t=n()({page:e.pagination.current,pageSize:e.pagination.pageSize},e.listQuery);e._fetch("/brand/page",t).then(function(t){e.list=t.data,e.pagination=t.pagination,e.listLoading=!1})},reloadList:function(){this.getList()},handleSizeChange:function(e){this.pagination.pageSize=e,this.getList()},handleCurrentChange:function(e){this.pagination.current=e,this.getList()}}}},430:function(e,t,i){"use strict";var a=i(12),n=i.n(a),l=i(2),o={filename:"",name_en:"",countryid:"",memo:"",officialwebsite:""};t.a={name:"brandform",props:{id:{type:Number}},data:function(){return{rules:{name_en:[{required:!0,message:Object(l.m)("pinpaimingcheng")+Object(l.m)("required"),trigger:"blur"}]},countries:[],form:n()({},o)}},methods:{cancel:function(){this.$emit("cancel")},submit:function(){var e=this;this.$refs.form.validate(function(t){t&&(e.id>0?(e.form.id=e.id,e._submit("/brand/edit",e.form).then(function(t){e.cancel(),e.$emit("reloadList")})):e._submit("/brand/add",e.form).then(function(t){e.cancel(),e.$emit("reloadList")}))})},getInfo:function(e){var t=this;this._fetch("/brand/info",{id:e}).then(function(e){t.form.filename=e.data.filename,t.form.name_en=e.data.name_en,t.form.memo=e.data.memo,t.form.officialwebsite=e.data.officialwebsite,t.form.countryid=parseInt(e.data.countryid),t.form.countryid=t.form.countryid>0?t.form.countryid:""})},getCountries:function(){var e=this;this._fetch("/country/list",{}).then(function(t){e.countries=t.data})}},watch:{id:function(e){e>0?this.getInfo(e):this.form=n()({},o)}},mounted:function(){this.getCountries(),this.id&&this.getInfo(this.id)}}},431:function(e,t,i){"use strict";var a=i(2),n=[{value:"noLimited",label:Object(a.m)("noLimited")},{value:"disabled",label:Object(a.m)("disabled")},{value:"=",label:"="},{value:">=",label:">="},{value:"<=",label:"<="}];t.a={name:"worldcode",props:{id:{type:Number}},data:function(){return{actions:n,setting:[{worldcode1:{length:"",action:"noLimited"},worldcode2:{length:"",action:"noLimited"},worldcode3:{length:"",action:"noLimited"}}]}},methods:{getSetting:function(){var e=this;this._fetch("/brand/worldcodeSetting",{id:this.id}).then(function(t){e.setting=[],e.setting.push(t.data)})},submit:function(){var e={id:this.id,setting:this.setting[0]};this._submit("/brand/updateWorldcodeSetting",e)},cancel:function(){this.$emit("cancel")}}}},432:function(e,t,i){"use strict";var a=i(12),n=i.n(a),l=i(2),o={brand_id:"",brandgroup_id:"",brandgroupchild_id:"",gender:"",sizetop_id:""};t.a={name:"size",props:{brandid:{type:Number}},data:function(){return{id:0,list:[],listLoading:!1,rules:{brandgroup_id:[{required:!0,message:Object(l.m)("pinlei")+Object(l.m)("required")}],brandgroupchild_id:[{required:!0,message:Object(l.m)("zipinlei")+Object(l.m)("required")}],gender:[{required:!0,message:Object(l.m)("xingbie")+Object(l.m)("required")}],sizetop_id:[{required:!0,message:Object(l.m)("chimazu")+Object(l.m)("required")}]},sizetops:[],genders:[],brandgroupchildren:[],brandgroups:[],form:n()({},o),dialogTitleMap:{create:Object(l.m)("xinjian")+Object(l.m)("chimazu"),update:Object(l.m)("bianji")+Object(l.m)("chimazu")},dialogStatus:"",dialogFormVisible:!1}},computed:{filtedBrandgroupchildren:function(){0==this.id&&(this.form.brandgroupchild_id="");var e=this;return this.form.brandgroup_id?this.brandgroupchildren.filter(function(t){return t.brandgroup_id==e.form.brandgroup_id}):this.brandgroupchildren}},methods:{getInfo:function(){var e=this;this._fetch("/brand/sizeInfo",{id:this.id}).then(function(t){e.form.brandgroup_id=t.data.brandgroup_id,e.form.brandgroupchild_id=t.data.brandgroupchild_id,e.form.gender=parseInt(t.data.gender),e.form.sizetop_id=t.data.sizetop_id})},handleUpdate:function(e){this.id=e.id,this.dialogStatus="update",this.getInfo(),this.showDialogForm()},getList:function(){this.list=[];var e=this;this.listLoading=!0,this._fetch("/brand/sizes",{brand_id:this.brandid}).then(function(t){e.list=t.data,e.listLoading=!1})},reloadList:function(){this.getList()},submit:function(){var e=this;this.$refs.form.validate(function(t){t&&(e.form.brand_id=e.brandid,e._submit("/brand/addSize",e.form).then(function(t){e.hideDialogForm(),e.reloadList()}))})},cancel:function(){this.hideDialogForm()},resetDialogForm:function(){var e=this;e.form.brandgroup_id="",e.form.brandgroupchild_id="",e.form.gender="",e.form.sizetop_id=""},handleCreate:function(){this.resetDialogForm(),this.id=0,this.dialogStatus="create",this.showDialogForm()},showDialogForm:function(){this.dialogFormVisible=!0},hideDialogForm:function(){this.dialogFormVisible=!1},getBrandgroups:function(){var e=this;this._fetch("/l/brandgroup",{}).then(function(t){var i=Object(l.m)("lang"),a="name_"+i;t.data.forEach(function(t){var i=t[a];e.brandgroups.push({id:t.id,title:i})})})},getBrandgroupchildren:function(){var e=this;this._fetch("/l/brandgroupchild",{}).then(function(t){var i=Object(l.m)("lang"),a="name_"+i;t.data.forEach(function(t){var i=t[a];e.brandgroupchildren.push({id:t.id,title:i,brandgroup_id:t.brandgroupid})})})},getGenders:function(){this.genders=[];var e=this;this._fetch("/common/genders",{}).then(function(t){for(var i=1;i<7;i++)e.genders.push({id:i,title:t.data[i]})})},getSizetops:function(){var e=this;this.sizetops=[],this._fetch("/l/sizetop",{}).then(function(t){t.data.forEach(function(t){e.sizetops.push({id:t.id,title:t.name_cn})})})}},watch:{brandid:function(e){e>0&&this.getList()}},mounted:function(){this.getList(),this.getBrandgroups(),this.getBrandgroupchildren(),this.getGenders(),this.getSizetops()}}},510:function(e,t,i){"use strict";var a=i(430),n=i(511),l=i(0),o=l(a.a,n.a,!1,null,null,null);t.a=o.exports},511:function(e,t,i){"use strict";var a=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("el-form",{ref:"form",staticClass:"user-form",attrs:{model:e.form,"label-width":"100px",size:"mini",rules:e.rules,"show-message":!1}},[i("el-form-item",{staticClass:"width2",attrs:{label:"LOGO"}},[i("simple-avatar",{attrs:{"font-size":"14px",size:35},model:{value:e.form.filename,callback:function(t){e.$set(e.form,"filename",t)},expression:"form.filename"}})],1),e._v(" "),i("el-form-item",{staticClass:"width2",attrs:{label:e.showLabel("pinpaimingcheng"),prop:"name_en"}},[i("el-input",{model:{value:e.form.name_en,callback:function(t){e.$set(e.form,"name_en",t)},expression:"form.name_en"}})],1),e._v(" "),i("el-form-item",{staticClass:"width2",attrs:{label:e.showLabel("guishuguojia")}},[i("el-select",{attrs:{placeholder:""},model:{value:e.form.countryid,callback:function(t){e.$set(e.form,"countryid",t)},expression:"form.countryid"}},e._l(e.countries,function(e){return i("el-option",{key:e.id+e.title,attrs:{label:e.title,value:e.id}})}),1)],1),e._v(" "),i("el-form-item",{staticClass:"width2",attrs:{label:e.showLabel("memo")}},[i("el-input",{attrs:{type:"textarea"},model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1),e._v(" "),i("el-form-item",{staticClass:"width2",attrs:{label:e.showLabel("guanwangdizhi")}},[i("el-input",{model:{value:e.form.officialwebsite,callback:function(t){e.$set(e.form,"officialwebsite",t)},expression:"form.officialwebsite"}})],1),e._v(" "),i("el-row",[i("el-col",{staticStyle:{"text-align":"center"},attrs:{span:24}},[i("el-button",{attrs:{type:"primary",size:"mini"},on:{click:e.submit}},[e._v(e._s(e.showLabel("baocun")))]),e._v(" "),i("el-button",{attrs:{type:"primary",size:"mini"},on:{click:e.cancel}},[e._v(e._s(e.showLabel("quxiao")))])],1)],1)],1)},n=[],l={render:a,staticRenderFns:n};t.a=l},512:function(e,t,i){"use strict";var a=i(431),n=i(513),l=i(0),o=l(a.a,n.a,!1,null,null,null);t.a=o.exports},513:function(e,t,i){"use strict";var a=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",[i("el-table",{attrs:{data:e.setting,border:""}},[i("el-table-column",{attrs:{label:e.showLabel("kuanshi"),align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[i("el-input",{attrs:{size:"mini",type:"number",min:"0"},model:{value:t.row.worldcode1.length,callback:function(i){e.$set(t.row.worldcode1,"length",i)},expression:"scope.row.worldcode1.length"}},[i("el-select",{staticStyle:{width:"100px"},attrs:{slot:"prepend"},slot:"prepend",model:{value:t.row.worldcode1.action,callback:function(i){e.$set(t.row.worldcode1,"action",i)},expression:"scope.row.worldcode1.action"}},e._l(e.actions,function(e){return i("el-option",{key:e.value,attrs:{label:e.label,value:e.value}})}),1)],1)]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("caizhi"),align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[i("el-input",{attrs:{size:"mini",type:"number",min:"0"},model:{value:t.row.worldcode2.length,callback:function(i){e.$set(t.row.worldcode2,"length",i)},expression:"scope.row.worldcode2.length"}},[i("el-select",{staticStyle:{width:"100px"},attrs:{slot:"prepend"},slot:"prepend",model:{value:t.row.worldcode2.action,callback:function(i){e.$set(t.row.worldcode2,"action",i)},expression:"scope.row.worldcode2.action"}},e._l(e.actions,function(e){return i("el-option",{key:e.value,attrs:{label:e.label,value:e.value}})}),1)],1)]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("yanse"),align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[i("el-input",{attrs:{size:"mini",type:"number",min:"0"},model:{value:t.row.worldcode3.length,callback:function(i){e.$set(t.row.worldcode3,"length",i)},expression:"scope.row.worldcode3.length"}},[i("el-select",{staticStyle:{width:"100px"},attrs:{slot:"prepend"},slot:"prepend",model:{value:t.row.worldcode3.action,callback:function(i){e.$set(t.row.worldcode3,"action",i)},expression:"scope.row.worldcode3.action"}},e._l(e.actions,function(e){return i("el-option",{key:e.value,attrs:{label:e.label,value:e.value}})}),1)],1)]}}])})],1),e._v(" "),i("el-row",[i("el-col",{staticStyle:{"text-align":"center"},attrs:{span:24}},[i("el-button",{attrs:{type:"primary",size:"mini"},on:{click:e.submit}},[e._v(e._s(e.showLabel("baocun")))]),e._v(" "),i("el-button",{attrs:{type:"primary",size:"mini"},on:{click:e.cancel}},[e._v(e._s(e.showLabel("quxiao")))])],1)],1)],1)},n=[],l={render:a,staticRenderFns:n};t.a=l},514:function(e,t,i){"use strict";var a=i(432),n=i(515),l=i(0),o=l(a.a,n.a,!1,null,null,null);t.a=o.exports},515:function(e,t,i){"use strict";var a=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",[i("el-button",{attrs:{type:"primary",size:"mini"},on:{click:e.handleCreate}},[e._v(e._s(e.showLabel("button-create")))]),e._v(" "),i("el-table",{directives:[{name:"loading",rawName:"v-loading",value:e.listLoading,expression:"listLoading"}],attrs:{data:e.list,border:"",stripe:""}},[i("el-table-column",{attrs:{label:e.showLabel("caozuo"),align:"center","class-name":"small-padding fixed-width",width:"160"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[i("el-button",{attrs:{type:"default",size:"mini"},on:{click:function(t){return e.handleUpdate(a)}}},[e._v(e._s(e.showLabel("bianji")))]),e._v(" "),i("el-button",{attrs:{type:"danger",size:"mini"},on:{click:function(t){return e.handleDelete(a)}}},[e._v(e._s(e.showLabel("shanchu")))])]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("pinlei"),prop:"brandgroup",width:"100"}}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("zipinlei"),prop:"brandgroupchild",width:"100"}}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("xingbie"),prop:"gender",width:"100"}}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("chimazu"),prop:"sizetop"}})],1),e._v(" "),i("el-dialog",{attrs:{title:e.dialogTitleMap[e.dialogStatus],visible:e.dialogFormVisible,center:!0,modal:!1,"close-on-click-modal":!1,"close-on-press-escape":!1,width:"400px"},on:{"update:visible":function(t){e.dialogFormVisible=t}}},[i("el-form",{ref:"form",attrs:{model:e.form,"label-width":"80px",size:"mini",rules:e.rules,"show-message":!1}},[i("el-form-item",{attrs:{label:e.showLabel("pinlei"),prop:"brandgroup_id"}},[i("el-select",{attrs:{placeholder:""},model:{value:e.form.brandgroup_id,callback:function(t){e.$set(e.form,"brandgroup_id",t)},expression:"form.brandgroup_id"}},e._l(e.brandgroups,function(e){return i("el-option",{key:e.id+e.title,attrs:{label:e.title,value:e.id}})}),1)],1),e._v(" "),i("el-form-item",{attrs:{label:e.showLabel("zipinlei"),prop:"brandgroupchild_id"}},[i("el-select",{attrs:{placeholder:""},model:{value:e.form.brandgroupchild_id,callback:function(t){e.$set(e.form,"brandgroupchild_id",t)},expression:"form.brandgroupchild_id"}},e._l(e.filtedBrandgroupchildren,function(e){return i("el-option",{key:e.id+e.title,attrs:{label:e.title,value:e.id}})}),1)],1),e._v(" "),i("el-form-item",{attrs:{label:e.showLabel("xingbie"),prop:"gender"}},[i("el-select",{attrs:{placeholder:""},model:{value:e.form.gender,callback:function(t){e.$set(e.form,"gender",t)},expression:"form.gender"}},e._l(e.genders,function(e){return i("el-option",{key:e.id+e.title,attrs:{label:e.title,value:e.id}})}),1)],1),e._v(" "),i("el-form-item",{attrs:{label:e.showLabel("chimazu"),prop:"sizetop_id"}},[i("el-select",{attrs:{placeholder:""},model:{value:e.form.sizetop_id,callback:function(t){e.$set(e.form,"sizetop_id",t)},expression:"form.sizetop_id"}},e._l(e.sizetops,function(e){return i("el-option",{key:e.id+e.title,attrs:{label:e.title,value:e.id}})}),1)],1),e._v(" "),i("el-row",[i("el-col",{staticStyle:{"text-align":"center"},attrs:{span:24}},[i("el-button",{attrs:{type:"primary",size:"mini"},on:{click:e.submit}},[e._v(e._s(e.showLabel("baocun")))]),e._v(" "),i("el-button",{attrs:{type:"primary",size:"mini"},on:{click:e.cancel}},[e._v(e._s(e.showLabel("quxiao")))])],1)],1)],1)],1)],1)},n=[],l={render:a,staticRenderFns:n};t.a=l},516:function(e,t,i){"use strict";var a=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",[i("div",{staticClass:"filter-container"},[i("el-form",{attrs:{model:e.listQuery,size:"mini",inline:!0}},[i("el-form-item",{attrs:{label:e.showLabel("pinpaimingcheng")}},[i("el-input",{staticStyle:{width:"200px"},attrs:{size:"mini"},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.handleFilter(t)}},model:{value:e.listQuery.name_en,callback:function(t){e.$set(e.listQuery,"name_en",t)},expression:"listQuery.name_en"}})],1),e._v(" "),i("el-form-item",{attrs:{label:e.showLabel("guishuguojia")}},[i("el-select",{attrs:{multiple:""},model:{value:e.listQuery.countryid,callback:function(t){e.$set(e.listQuery,"countryid",t)},expression:"listQuery.countryid"}},e._l(e.countries,function(e){return i("el-option",{key:e.id+e.title,attrs:{label:e.title,value:e.id}})}),1)],1),e._v(" "),i("el-form-item",[i("el-button",{staticClass:"filter-item",attrs:{type:"default",size:"mini",icon:"el-icon-refresh-right"},on:{click:e.handleResetFilter}},[e._v("\n          "+e._s(e.showLabel("qingkong"))+"\n        ")])],1),e._v(" "),i("el-form-item",[i("el-button",{staticClass:"filter-item",attrs:{type:"primary",size:"mini",icon:"el-icon-search"},on:{click:e.handleFilter}},[e._v("\n          "+e._s(e.showLabel("search"))+"\n        ")])],1),e._v(" "),i("el-form-item",[i("el-button",{staticClass:"filter-item",staticStyle:{"margin-left":"10px"},attrs:{type:"success",size:"mini",icon:"el-icon-edit"},on:{click:e.handleCreate}},[e._v("\n          "+e._s(e.showLabel("button-create"))+"\n        ")])],1)],1)],1),e._v(" "),i("el-table",{directives:[{name:"loading",rawName:"v-loading",value:e.listLoading,expression:"listLoading"}],attrs:{data:e.list,border:"",stripe:""},on:{"sort-change":e.handleSort}},[i("el-table-column",{attrs:{label:e.showLabel("caozuo"),align:"center",width:"230","class-name":"small-padding fixed-width"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[i("el-button",{attrs:{type:"default",size:"mini"},on:{click:function(t){return e.handleUpdate(a)}}},[e._v(e._s(e.showLabel("bianji")))]),e._v(" "),i("el-button",{attrs:{type:"danger",size:"mini"},on:{click:function(t){return e.handleDelete(a)}}},[e._v(e._s(e.showLabel("shanchu")))])]}}])}),e._v(" "),i("el-table-column",{attrs:{label:"LOGO"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[i("img",{staticStyle:{"max-width":"50px","max-height":"50px"},attrs:{src:e._fileLink(a.filename)}})]}}])}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("pinpaimingcheng"),prop:"name_en",sortable:"custom",width:"200"}}),e._v(" "),i("el-table-column",{attrs:{label:e.showLabel("guishuguojia"),prop:"country",width:"200"}})],1),e._v(" "),e.list.length<e.pagination.total?i("el-pagination",{attrs:{"current-page":1*e.pagination.current,"page-sizes":e.pagination.pageSizes,"page-size":1*e.pagination.pageSize,layout:"total, sizes, prev, pager, next, jumper",total:1*e.pagination.total},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}}):e._e(),e._v(" "),i("el-dialog",{attrs:{title:e.dialogTitleMap[e.dialogStatus],visible:e.dialogFormVisible,center:!0,"close-on-click-modal":!1,"close-on-press-escape":!1,modal:!1},on:{"update:visible":function(t){e.dialogFormVisible=t}}},[i("el-tabs",{attrs:{type:"border-card"},on:{"tab-click":e.handleTabClick},model:{value:e.activeName,callback:function(t){e.activeName=t},expression:"activeName"}},[i("el-tab-pane",{attrs:{label:e._label("jibenziliao"),name:"info"}},[i("brandform",{attrs:{id:e.id},on:{cancel:e.hideDialogForm,reloadList:e.reloadList}})],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("bieming"),name:"aliases",disabled:0==e.id}},[i("multiple-admin-page",e._b({},"multiple-admin-page",e.aliases,!1))],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("xilie"),name:"xilie",disabled:0==e.id}},[i("multiple-admin-page",e._b({},"multiple-admin-page",e.series,!1))],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("beilv"),name:"beilv",disabled:0==e.id}},[i("simple-admin-page",e._b({scopedSlots:e._u([{key:"default",fn:function(t){return[i("el-form",{staticClass:"user-form",attrs:{model:t.form,"label-width":"100px",inline:!1,size:"mini"}},[i("el-form-item",{attrs:{label:e._label("pinlei")}},[i("simple-select",{directives:[{name:"show",rawName:"v-show",value:"add"==t.action,expression:"scope.action=='add'"}],staticClass:"width2",attrs:{source:"brandgroup",multiple:!0},model:{value:t.form.brandgroupid,callback:function(i){e.$set(t.form,"brandgroupid",i)},expression:"scope.form.brandgroupid"}}),e._v(" "),i("simple-select",{directives:[{name:"show",rawName:"v-show",value:"edit"==t.action,expression:"scope.action=='edit'"}],staticClass:"width2",attrs:{source:"brandgroup"},model:{value:t.form.brandgroupid,callback:function(i){e.$set(t.form,"brandgroupid",i)},expression:"scope.form.brandgroupid"}})],1),e._v(" "),i("el-form-item",{attrs:{label:e._label("niandaijijie")}},[i("simple-select",{staticClass:"width2",attrs:{source:"ageseason"},model:{value:t.form.ageseasonid,callback:function(i){e.$set(t.form,"ageseasonid",i)},expression:"scope.form.ageseasonid"}})],1),e._v(" "),i("el-form-item",{attrs:{label:e._label("beilv")}},[i("el-input",{staticClass:"width2",attrs:{size:"mini"},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.onSubmit(t)}},model:{value:t.form.rate,callback:function(i){e.$set(t.form,"rate",i)},expression:"scope.form.rate"}})],1)],1)]}}])},"simple-admin-page",e.brandrate,!1))],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("jiageshezhi"),name:"price",disabled:0==e.id}},[i("sp-pricesetting",{attrs:{brandid:e.id}})],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("guojima"),name:"worldcode",disabled:0==e.id}},[i("worldcode",{ref:"worldcode",attrs:{id:e.id},on:{cancel:e.hideDialogForm}})],1),e._v(" "),i("el-tab-pane",{attrs:{label:e.showLabel("chimazu"),name:"size",disabled:0==e.id}},[i("size",{attrs:{brandid:e.id}})],1)],1)],1)],1)},n=[],l={render:a,staticRenderFns:n};t.a=l}});