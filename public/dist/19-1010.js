webpackJsonp([19],{290:function(e,t,l){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=l(324),a=l(364),r=l(0),i=r(n.a,a.a,!1,null,null,null);t.default=i.exports},324:function(e,t,l){"use strict";var n=l(26),a=l.n(n),r=l(7);t.a={name:"sp-requisitioncreate",data:function(){return{form:{allin:0,out_id:"",in_id:"",memo:""},tabledata:[]}},methods:{showProduct:function(){this.$refs.stocksearch.setVisible(!0)},onSelect:function(e){var t=this;t.tabledata.findIndex(function(t){return t.id==e.id})<0&&(e.select_number=1,e.number=1*e.number,e.in_id="",t.tabledata.unshift(e))},saveOrder:function(e){var t=this;if(confirm(t._label("order_submit_confirm"))){var l={form:t.form};l.list=t.tabledata.map(function(e){return 1==t.form.allin?{out_id:e.warehouseid,productstockid:e.id,number:e.select_number,in_id:t.form.in_id}:{out_id:e.warehouseid,productstockid:e.id,number:e.select_number,in_id:e.in_id}}),t._submit("/requisition/save",{params:a()(l)}).then(function(e){Object(r.b)(t.form,{allin:0,out_id:"",in_id:"",memo:""}),t.tabledata=[]})}}},mounted:function(){var e=this;e._setTitle(e._label("xinjiandiaobodan"))}}},364:function(e,t,l){"use strict";var n=function(){var e=this,t=e.$createElement,l=e._self._c||t;return l("div",[l("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini"}},[l("el-row",{attrs:{gutter:0}},[l("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.saveOrder(1)}}},[e._v(e._s(e._label("shenqing")))]),e._v(" "),l("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.showProduct()}}},[e._v(e._s(e._label("xuanzeshangpin")))])],1),e._v(" "),l("el-row",{attrs:{gutter:0}},[l("el-col",{staticStyle:{width:"150px"},attrs:{span:6}},[l("el-form-item",{attrs:{label:e._label("tongyidiaoru")}},[l("el-switch",{attrs:{"active-value":"1","inactive-value":"0"},model:{value:e.form.allin,callback:function(t){e.$set(e.form,"allin",t)},expression:"form.allin"}})],1)],1),e._v(" "),l("el-col",{staticStyle:{width:"300px"},attrs:{span:6}},[l("el-form-item",{attrs:{label:e._label("diaorucangku")}},[l("simple-select",{attrs:{source:"warehouse",disabled:0==e.form.allin},model:{value:e.form.in_id,callback:function(t){e.$set(e.form,"in_id",t)},expression:"form.in_id"}})],1)],1),e._v(" "),l("el-col",{staticStyle:{width:"300px"},attrs:{span:6}},[l("el-form-item",{attrs:{label:e._label("beizhu")}},[l("el-input",{model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1)],1)],1),e._v(" "),l("el-row",[l("el-col",{attrs:{span:24}},[l("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,stripe:"",border:""}},[l("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"150"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[l("sp-product-tip",{attrs:{product:t.product}})]}}])}),e._v(" "),l("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.row;return[e._v("\n                    "+e._s(l.product.getName())+"\n                ")]}}])}),e._v(" "),l("el-table-column",{attrs:{prop:"sizecontent_label",label:e._label("chima"),width:"100",align:"center"}}),e._v(" "),l("el-table-column",{attrs:{prop:"warehousename",label:e._label("cangku"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(t.row.warehouse.name)+"\n                    ")]}}])}),e._v(" "),l("el-table-column",{attrs:{prop:"number",label:e._label("kucunshuliang"),width:"200",align:"center"}}),e._v(" "),l("el-table-column",{attrs:{prop:"select_number",label:e._label("diaorucangku"),width:"200",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[1!=e.form.allin?l("simple-select",{attrs:{source:"warehouse"},model:{value:t.row.in_id,callback:function(l){e.$set(t.row,"in_id",l)},expression:"scope.row.in_id"}}):e._e(),e._v(" "),1==e.form.allin?l("simple-select",{attrs:{source:"warehouse",disabled:""},model:{value:e.form.in_id,callback:function(t){e.$set(e.form,"in_id",t)},expression:"form.in_id"}}):e._e()]}}])}),e._v(" "),l("el-table-column",{attrs:{prop:"select_number",label:e._label("diaoboshuliang"),width:"200",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[l("el-input-number",{attrs:{min:1,max:1*t.row.number,size:"mini"},model:{value:t.row.select_number,callback:function(l){e.$set(t.row,"select_number",l)},expression:"scope.row.select_number"}})]}}])}),e._v(" "),l("el-table-column",{attrs:{label:e._label("caozuo"),width:"150",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[l("as-button",{attrs:{size:"mini",type:"danger"},on:{click:function(l){return e.deleteRow(t.$index,t.row)}}},[e._v(e._s(e._label("shanchu")))])]}}])})],1)],1)],1),e._v(" "),l("sp-productstock-search",{ref:"stocksearch",on:{select:e.onSelect}})],1)},a=[],r={render:n,staticRenderFns:a};t.a=r}});
//# sourceMappingURL=19-1010.js.map