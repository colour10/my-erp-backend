webpackJsonp([22],{303:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var l=a(360),r=a(409),n=a(0),u=n(l.a,r.a,!1,null,null,null);e.default=u.exports},360:function(t,e,a){"use strict";var l=a(12),r=a.n(l),n=a(13),u=a.n(n),i=a(26),o=a.n(i),s=a(7),c=a(35);e.a={name:"asa-requisition-detail-dialog",data:function(){return{form:{apply_staff:"",apply_date:"",turnout_staff:"",turnout_date:"",turnin_staff:"",turnin_date:"",out_name:"",in_name:"",status:"",in_id:"",out_id:"",id:""},tabledata:[]}},methods:{doAction:function(t){var e=this;if(e.confirm()){var a={id:e.form.id},l={},r=0,n=0;e.tabledata.forEach(function(t){l[t.id]=t.select_number,r+=t.select_number,n+=t.number}),a.total="",0==r?a.total="deny":n==r&&(a.total="allow"),a.list=l,e._log(o()(a)),e._submit("/requisition/"+t,{params:o()(a)}).then(function(t){e.init(t)})}},confirmout:function(){this.doAction("confirmout")},confirmin:function(){this.doAction("confirmin")},cancel:function(){var t=this;return u()(r.a.mark(function e(){var a;return r.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:a=t,a.tabledata.forEach(function(t){return t.select_number=0}),a.doAction("cancel");case 3:case"end":return e.stop()}},e,t)}))()},init:function(t){var e=this;Object(s.a)(t.data.form,e.form),e.tabledata=[],t.data.list.forEach(function(t){c.f.load({data:t.out_productstockid,depth:2}).then(function(a){e._log(a),t.productstock=a,t.select_number=0,e.tabledata.push(t)})})}},mounted:function(){var t=this,e=t.$route;e.params.id>0?(t._setTitle(t._label("diaobodan")+":"+e.params.id),t._fetch("/requisition/load",{id:e.params.id}).then(function(e){t.init(e)})):t._setTitle(t._label("diaobodan"))}}},409:function(t,e,a){"use strict";var l=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:t.form,"label-width":"85px",inline:!0,size:"mini"}},[a("el-row",{attrs:{type:"flex",justify:"start"}},[a("as-button",{attrs:{type:2==t.form.status?"primary":"info"},on:{click:t.cancel}},[t._v(t._s(t._label("zuofei")))]),t._v(" "),a("as-button",{attrs:{type:2==t.form.status?"primary":"info"},on:{click:t.confirmout}},[t._v(t._s(t._label("chukuqueren")))]),t._v(" "),a("as-button",{attrs:{type:3==t.form.status?"primary":"info"},on:{click:t.confirmin}},[t._v(t._s(t._label("rukuqueren")))])],1),t._v(" "),a("el-row",{attrs:{gutter:0}},[a("el-col",{staticStyle:{width:"300px"},attrs:{span:6}},[a("el-form-item",{attrs:{label:t._label("shenqingren")}},[a("sp-display-input",{attrs:{value:t.form.apply_staff,source:"user"}})],1),t._v(" "),a("el-form-item",{attrs:{label:t._label("shenqingriqi")}},[a("el-input",{attrs:{value:t.form.apply_date,disabled:""}})],1),t._v(" "),a("el-form-item",{attrs:{label:t._label("zhuangtai")}},[a("sp-display-input",{attrs:{value:t.form.status,source:"requisitionstatus"}})],1)],1),t._v(" "),a("el-col",{staticStyle:{width:"300px"},attrs:{span:6}},[a("el-form-item",{attrs:{label:t._label("chukuqueren")}},[a("sp-display-input",{attrs:{value:t.form.turnout_staff,source:"user"}})],1),t._v(" "),a("el-form-item",{attrs:{label:t._label("chukushijian")}},[a("el-input",{attrs:{value:t.form.turnout_date,disabled:""}})],1),t._v(" "),a("el-form-item",{attrs:{label:t._label("diaochucangku")}},[a("sp-display-input",{attrs:{value:t.form.out_id,source:"warehouse"}})],1)],1),t._v(" "),a("el-col",{staticStyle:{width:"300px"},attrs:{span:6}},[a("el-form-item",{attrs:{label:t._label("rukuqueren")}},[a("sp-display-input",{attrs:{value:t.form.turnin_staff,source:"user"}})],1),t._v(" "),a("el-form-item",{attrs:{label:t._label("rukushijian")}},[a("el-input",{attrs:{value:t.form.turnin_date,disabled:""}})],1),t._v(" "),a("el-form-item",{attrs:{label:t._label("diaorucangku")}},[a("sp-display-input",{attrs:{value:t.form.in_id,source:"warehouse"}})],1)],1)],1)],1),t._v(" "),a("el-row",[a("el-col",{attrs:{span:24}},[a("el-table",{ref:"list",staticStyle:{width:"100%"},attrs:{data:t.tabledata,stripe:"",border:""}},[a("el-table-column",{attrs:{prop:"productname",label:t._label("guojima"),align:"center"},scopedSlots:t._u([{key:"default",fn:function(t){var e=t.row;return[a("sp-product-tip",{attrs:{product:e.productstock.product}})]}}])}),t._v(" "),a("el-table-column",{attrs:{prop:"productname",label:t._label("chanpinmingcheng"),align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.row;return[t._v("\n            "+t._s(a.productstock.product.getName())+"\n          ")]}}])}),t._v(" "),a("el-table-column",{attrs:{prop:"sizecontent_label",label:t._label("chima"),width:"80",align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){var a=e.row;return[t._v("\n            "+t._s(a.productstock.sizecontent_label)+"\n          ")]}}])}),t._v(" "),a("el-table-column",{attrs:{prop:"number",label:t._label("diaoboshuliang"),width:"100",align:"center"}}),t._v(" "),t.form.status>2?a("el-table-column",{key:"1",attrs:{prop:"out_number",label:t._label("chukushuliang"),width:"200",align:"center"}}):t._e(),t._v(" "),5==t.form.status?a("el-table-column",{key:"2",attrs:{prop:"in_number",label:t._label("rukushuliang"),width:"200",align:"center"}}):t._e(),t._v(" "),2==t.form.status?a("el-table-column",{key:"3",attrs:{label:t._label("chukushuliang"),width:"250",align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("el-input-number",{attrs:{min:0,max:1*e.row.number},model:{value:e.row.select_number,callback:function(a){t.$set(e.row,"select_number",a)},expression:"scope.row.select_number"}})]}}],null,!1,3985797177)}):t._e(),t._v(" "),3==t.form.status?a("el-table-column",{key:"4",attrs:{label:t._label("rukushuliang"),width:"250",align:"center"},scopedSlots:t._u([{key:"default",fn:function(e){var l=e.row;return[a("el-input-number",{attrs:{min:0,max:1*l.out_number,disabled:0==l.out_number},model:{value:l.select_number,callback:function(e){t.$set(l,"select_number",e)},expression:"row.select_number"}})]}}],null,!1,2506231342)}):t._e()],1)],1)],1)],1)},r=[],n={render:l,staticRenderFns:r};e.a=n}});
//# sourceMappingURL=22-1026.js.map