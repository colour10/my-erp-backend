webpackJsonp([19],{307:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=a(347),r=a(396),l=a(0),i=l(n.a,r.a,!1,null,null,null);t.default=i.exports},347:function(e,t,a){"use strict";var n=a(12),r=a.n(n),l=a(13),i=a.n(l),s=a(182),o=a.n(s),c=a(1),u=a(7),p=a(35),m=a(186);t.a={name:"sp-salesreceive",components:o()({},m.a.name,m.a),data:function(){return{columns:[{name:"orderno",label:Object(c.d)("dingdanhao"),type:"label"},{name:"payment_type",label:Object(c.d)("fukuanleixing"),type:"select",source:"paymenttype"},{name:"currency",label:Object(c.d)("bizhong"),type:"select",source:"currency"},{name:"amount",label:Object(c.d)("jine")},{name:"paymentdate",label:Object(c.d)("fukuanriqi"),type:"date"},{name:"memo",label:Object(c.d)("beizhu")},{name:"makestaff",label:Object(c.d)("tijiaoren"),type:"select",source:"user",is_edit_hide:!0},{name:"status",label:Object(c.d)("yiruzhang"),type:"switch",is_edit_hide:!0}],form:{warehouseid:""},searchresult:[],pagination:{pageSizes:c.f.pageSizes,pageSize:15,total:0,current:1}}},methods:{search:function(){var e=this;return i()(r.a.mark(function t(){var a,n;return r.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return a=e,t.next=3,a._fetch("/salesreceive/search",a.form);case 3:n=t.sent,a.searchresult=[],n.data.forEach(function(){var e=i()(r.a.mark(function e(t){var n;return r.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,p.h.load({data:t,depth:1});case 2:n=e.sent,a.searchresult.push(n);case 4:case"end":return e.stop()}},e,this)}));return function(t){return e.apply(this,arguments)}}()),Object(u.b)(a.pagination,n.pagination);case 7:case"end":return t.stop()}},t,e)}))()},confirmPayment:function(e){var t=e.$index,a=e.row,n=this;a.orderno=a.sales.orderno,n.$refs.salesreceive.setInfo(a).setDisabled(["payment_type","amount","currency"],!0)._setting({submitButtonText:Object(c.d)("querenfukuan")}).show(),n.index=t},onConfirm:function(e){var t=this;return i()(r.a.mark(function a(){var n;return r.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:n=t,n._confirm(Object(c.d)("confirm-payment?"),i()(r.a.mark(function a(){var l,i;return r.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,n._submit("/salesreceive/confirm",Object(u.d)(e,["id","paymentdate","memo"]));case 2:l=t.sent,i=Object(u.b)(e,l.data),n.$refs.salesreceive.setInfo(i),n.search();case 6:case"end":return t.stop()}},a,t)})));case 2:case"end":return a.stop()}},a,t)}))()},handleSizeChange:function(e){this.pagination.pageSize=e,this.loadList()},handleCurrentChange:function(e){this.pagination.current=e,this.loadList()}}}},396:function(e,t,a){"use strict";var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticStyle:{width:"100%"}},[a("el-form",{staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini"}},[a("el-form-item",{attrs:{label:e._label("dingda")}},[a("simple-select",{attrs:{source:"warehouse",lang:e._label("lang")},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}}),e._v(" "),a("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.search()}}},[e._v(e._s(e._label("chaxun")))])],1)],1),e._v(" "),a("sp-table",{staticStyle:{width:"100%"},attrs:{data:e.searchresult,border:""}},[a("el-table-column",{attrs:{prop:"orderno",label:e._label("dingdanhao"),align:"center",sortable:""},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                "+e._s(t.row.sales.orderno)+"\n            ")]}}])}),e._v(" "),a("el-table-column",{attrs:{prop:"payment_type_label",label:e._label("fukuanleixing"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"amount",label:e._label("jine"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"currency_label",label:e._label("bizhong"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"paymentdate",label:e._label("fukuanriqi"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"memo",label:e._label("beizhu"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"makestaff_name",label:e._label("tijiaoren"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"maketime",label:e._label("tijiaoshijian"),width:"170",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"confirmstaff_name",label:e._label("tijiaoren"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"confirmtime",label:e._label("tijiaoshijian"),width:"170",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"status_label",sortable:"",label:e._label("yiruzhang"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{label:e._label("caozuo"),align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("auth",{attrs:{auth:"receive-confirm"}},[a("as-button",{attrs:{size:"mini"},on:{click:function(a){return e.confirmPayment(t)}}},[e._v(e._s(e._label("xiangqing")))])],1)]}}])})],1),e._v(" "),e.searchresult.length<e.pagination.total?a("el-pagination",{attrs:{"current-page":1*e.pagination.current,"page-sizes":e.pagination.pageSizes,"page-size":1*e.pagination.pageSize,layout:"total, sizes, prev, pager, next, jumper",total:1*e.pagination.total},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}}):e._e(),e._v(" "),a("simple-form",{ref:"salesreceive",attrs:{name:"salesreceive",columns:e.columns,authname:"receive-confirm",title:e._label("querenfukuan"),isEditable:function(e){return 0==e.status}},on:{submit:e.onConfirm}})],1)},r=[],l={render:n,staticRenderFns:r};t.a=l}});
//# sourceMappingURL=19-1024.js.map