webpackJsonp([11],{307:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=a(364),i=a(413),r=a(0),l=r(n.a,i.a,!1,null,null,null);t.default=l.exports},327:function(e,t,a){"use strict";var n=a(1),i=(a(183),a(56));t.a={name:"simple-form",props:["name","authname","title","isEditable","disabled","columns","width","inline","size"],data:function(){for(var e=this,t={},a={},i=0;i<e.columns.length;i++){var r=e.columns[i].name;t[r]="",a[r]=""}return{setting:{title:"",submitButtonText:Object(n.d)("baocun")},dialogVisible:!1,form:t,disableds:a}},methods:{onQuit:function(){this.dialogVisible=!1},onSubmit:function(){var e=this;e.$emit("submit",Object(n.h)({},e.form))},setInfo:function(e){var t=this;return n.f.empty(t.form),Object(n.h)(t.form,e),t},show:function(){var e=this;e.dialogVisible=!0,setTimeout(function(){for(var t=e.columns,a=0;a<t.length;a++){var n=t[a];if("label"!=n.type&&1!=n.is_edit_hide){var i=e.$refs[n.name][0];if(n.is_focus&&!i.disabled){i.focus();break}}}},50)},isDisabled:function(e){var t=this,a=t.disableds;return"function"==typeof t.isEditable&&0==t.isEditable(t.form)||!!a[e.name]&&!0===a[e.name]},setDisabled:function(e,t){var a=this;return Object(n.h)(a.disableds,Object(i.b)(e,t)),a}},computed:{formTitle:function(){var e=this;return e.setting.title.length>0?e.setting.title:e.title?e.title:""}}}},332:function(e,t,a){"use strict";var n=a(327),i=a(333),r=a(0),l=r(n.a,i.a,!1,null,null,null);t.a=l.exports},333:function(e,t,a){"use strict";var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("el-dialog",{staticClass:"user-form",attrs:{title:e.formTitle,visible:e.dialogVisible,center:!0,width:e.width||"40%",modal:!1},on:{"update:visible":function(t){e.dialogVisible=t}}},[a("el-row",[a("el-col",{attrs:{span:24}},[a("el-form",{ref:"form",attrs:{model:e.form,"label-width":"100px",inline:e.inline||!1,size:e.size||"medium"}},e._l(e.columns,function(t){return t.is_edit_hide?e._e():a("el-form-item",{key:t.name,class:t.class?t.class:"",attrs:{label:t.label}},[t.type&&"input"!=t.type&&"textarea"!=t.type?e._e():a("el-input",{ref:t.name,refInFor:!0,attrs:{type:t.type?t.type:"text",disabled:e.isDisabled(t)},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.onSubmit(t)}},model:{value:e.form[t.name],callback:function(a){e.$set(e.form,t.name,a)},expression:"form[item.name]"}}),e._v(" "),"switch"==t.type?a("el-switch",{ref:t.name,refInFor:!0,attrs:{"active-value":"1","inactive-value":"0",disabled:e.isDisabled(t)},model:{value:e.form[t.name],callback:function(a){e.$set(e.form,t.name,a)},expression:"form[item.name]"}}):e._e(),e._v(" "),"select"==t.type?a("simple-select",{ref:t.name,refInFor:!0,attrs:{source:t.source,lang:e._label("lang"),disabled:e.isDisabled(t)},model:{value:e.form[t.name],callback:function(a){e.$set(e.form,t.name,a)},expression:"form[item.name]"}}):e._e(),e._v(" "),"date"==t.type?a("el-date-picker",{ref:t.name,refInFor:!0,attrs:{type:"date","value-format":"yyyy-MM-dd",placeholder:"",disabled:e.isDisabled(t)},model:{value:e.form[t.name],callback:function(a){e.$set(e.form,t.name,a)},expression:"form[item.name]"}}):e._e(),e._v(" "),"label"==t.type?a("span",[e._v(e._s(e.form[t.name]))]):e._e()],1)}),1)],1)],1),e._v(" "),a("el-row",[a("el-col",{staticStyle:{"text-align":"center"},attrs:{span:24}},[e.isEditable&&e.isEditable(e.form)?a("au-button",{staticStyle:{margin:"auto"},attrs:{auth:e.authname,type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e.setting.submitButtonText))]):e._e(),e._v(" "),a("as-button",{attrs:{type:"primary"},on:{click:e.onQuit}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)},i=[],r={render:n,staticRenderFns:i};t.a=r},364:function(e,t,a){"use strict";var n=a(12),i=a.n(n),r=a(13),l=a.n(r),s=a(181),o=a.n(s),c=a(1),u=a(7),m=a(35),d=a(332);t.a={name:"sp-salesreceive",components:o()({},d.a.name,d.a),data:function(){return{columns:[{name:"orderno",label:Object(c.d)("dingdanhao"),type:"label"},{name:"payment_type",label:Object(c.d)("fukuanleixing"),type:"select",source:"paymenttype"},{name:"currency",label:Object(c.d)("bizhong"),type:"select",source:"currency"},{name:"amount",label:Object(c.d)("jine")},{name:"paymentdate",label:Object(c.d)("fukuanriqi"),type:"date"},{name:"memo",label:Object(c.d)("beizhu")},{name:"makestaff",label:Object(c.d)("tijiaoren"),type:"select",source:"user",is_edit_hide:!0},{name:"status",label:Object(c.d)("yiruzhang"),type:"switch",is_edit_hide:!0}],form:{warehouseid:""},searchresult:[],pagination:{pageSizes:c.f.pageSizes,pageSize:15,total:0,current:1}}},methods:{search:function(){var e=this;return l()(i.a.mark(function t(){var a,n;return i.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return a=e,t.next=3,a._fetch("/salesreceive/search",a.form);case 3:n=t.sent,a.searchresult=[],n.data.forEach(function(){var e=l()(i.a.mark(function e(t){var n;return i.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,m.i.load({data:t,depth:1});case 2:n=e.sent,a.searchresult.push(n);case 4:case"end":return e.stop()}},e,this)}));return function(t){return e.apply(this,arguments)}}()),Object(u.b)(a.pagination,n.pagination);case 7:case"end":return t.stop()}},t,e)}))()},confirmPayment:function(e){var t=e.$index,a=e.row,n=this;a.orderno=a.sales.orderno,n.$refs.salesreceive.setInfo(a).setDisabled(["payment_type","amount","currency"],!0)._setting({submitButtonText:Object(c.d)("querenfukuan")}).show(),n.index=t},onConfirm:function(e){var t=this;return l()(i.a.mark(function a(){var n;return i.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:n=t,n._confirm(Object(c.d)("confirm-payment?"),l()(i.a.mark(function a(){var r,l;return i.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,n._submit("/salesreceive/confirm",Object(u.d)(e,["id","paymentdate","memo"]));case 2:r=t.sent,l=Object(u.b)(e,r.data),n.$refs.salesreceive.setInfo(l),n.search();case 6:case"end":return t.stop()}},a,t)})));case 2:case"end":return a.stop()}},a,t)}))()},handleSizeChange:function(e){this.pagination.pageSize=e,this.loadList()},handleCurrentChange:function(e){this.pagination.current=e,this.loadList()}}}},413:function(e,t,a){"use strict";var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticStyle:{width:"100%"}},[a("el-form",{staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini"}},[a("el-form-item",{attrs:{label:e._label("dingda")}},[a("simple-select",{attrs:{source:"warehouse",lang:e._label("lang")},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}}),e._v(" "),a("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.search()}}},[e._v(e._s(e._label("chaxun")))])],1)],1),e._v(" "),a("sp-table",{staticStyle:{width:"100%"},attrs:{data:e.searchresult,border:""}},[a("el-table-column",{attrs:{prop:"orderno",label:e._label("dingdanhao"),align:"center",sortable:""},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                "+e._s(t.row.sales.orderno)+"\n            ")]}}])}),e._v(" "),a("el-table-column",{attrs:{prop:"payment_type_label",label:e._label("fukuanleixing"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"amount",label:e._label("jine"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"currency_label",label:e._label("bizhong"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"paymentdate",label:e._label("fukuanriqi"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"memo",label:e._label("beizhu"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"makestaff_name",label:e._label("tijiaoren"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"maketime",label:e._label("tijiaoshijian"),width:"170",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"confirmstaff_name",label:e._label("tijiaoren"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"confirmtime",label:e._label("tijiaoshijian"),width:"170",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"status_label",sortable:"",label:e._label("yiruzhang"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{label:e._label("caozuo"),align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("auth",{attrs:{auth:"receive-confirm"}},[a("as-button",{attrs:{size:"mini"},on:{click:function(a){return e.confirmPayment(t)}}},[e._v(e._s(e._label("xiangqing")))])],1)]}}])})],1),e._v(" "),e.searchresult.length<e.pagination.total?a("el-pagination",{attrs:{"current-page":1*e.pagination.current,"page-sizes":e.pagination.pageSizes,"page-size":1*e.pagination.pageSize,layout:"total, sizes, prev, pager, next, jumper",total:1*e.pagination.total},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}}):e._e(),e._v(" "),a("simple-form",{ref:"salesreceive",attrs:{name:"salesreceive",columns:e.columns,authname:"receive-confirm",title:e._label("querenfukuan"),isEditable:function(e){return 0==e.status}},on:{submit:e.onConfirm}})],1)},i=[],r={render:n,staticRenderFns:i};t.a=r}});
//# sourceMappingURL=11-1030.js.map