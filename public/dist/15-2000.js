webpackJsonp([15],{308:function(e,t,a){"use strict";function l(e){a(533)}Object.defineProperty(t,"__esModule",{value:!0});var r=a(419),n=a(535),o=a(0),s=l,i=o(r.a,n.a,!1,s,null,null);t.default=i.exports},318:function(e,t,a){"use strict";var l=a(55);t.a={methods:{formatNumber:function(e){return Object(l.b)(e,3)},f:function(e){return Object(l.b)(e,2)}}}},419:function(e,t,a){"use strict";var l=a(31),r=a.n(l),n=a(20),o=a.n(n),s=a(5),i=a.n(s),c=a(77),u=a.n(c),d=a(7),m=a.n(d),f=a(37),b=a(13),p=a(318);t.a={name:"sp-billcreate",components:{},mixins:[p.a],data:function(){var e=this;return{form:{amount:0,billtype:"1",out_billno:"",supplierid:"",invoiceid:"",currencyid:"",memo:""},searchform:{date:[e._label("_date"),e._label("_date")],externalno:"",memberids:"",warehouseid:"",saleportid:"",paymentwayid:""},tabledata:[],receives:[],selected:[],invoices:[]}},methods:{removeRow:function(e){var t=this;t.$delete(t.tabledata,e)},onRowClick:function(e){this.$refs.selectTable.toggleRowSelection(e)},onSupplierChange:function(e){var t=this;return m()(i.a.mark(function a(){var l,r,n;return i.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return r=t,r.form.invoiceid="",a.next=4,f.a.getSupplierInvoiceList(e);case 4:n=a.sent,r.invoices=[],(l=r.invoices).push.apply(l,u()(n));case 7:case"end":return a.stop()}},a,t)}))()},select:function(){var e=this;console.log(e.selected);var t=!0,a=!1,l=void 0;try{for(var r,n=o()(e.selected);!(t=(r=n.next()).done);t=!0){var s=r.value;(function(t){if(e.tabledata.find(function(e){return e.id==t.id}))return"continue";e.tabledata.push(t),e.form.currencyid=t.currency})(s)}}catch(e){a=!0,l=e}finally{try{!t&&n.return&&n.return()}finally{if(a)throw l}}e.form.amount=e.totalAmount,e._hideDialog("select-dialog")},onSelectionChange:function(e){this.selected=e},search:function(){var e=this;return m()(i.a.mark(function t(){var a,l,r,n,o;return i.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return l=e,r={begin:l.searchform.date[0],end:l.searchform.date[1],externalno:l.searchform.externalno,warehouseid:l.searchform.warehouseid,memberids:l.searchform.memberids,saleportid:l.searchform.saleportid,paymentwayid:l.searchform.paymentwayid},t.next=4,l._fetch("/salesreceive/searchlist",r);case 4:n=t.sent,o=n.data,l.receives=[],(a=l.receives).push.apply(a,u()(o));case 8:case"end":return t.stop()}},t,e)}))()},saveOrder:function(){var e=this,t={form:Object(b.c)({},e.form)};t.form.amount_origin=e.totalAmount,t.list=e.tabledata.map(function(e){return e.id}),e.validate().then(function(){e._submit("/bill/add",{params:r()(t)}).then(function(t){e._redirect("/bill/"+t.data)})})},deleteRow:function(e){var t=this,a=t.tabledata.findIndex(function(t){return t==e});t.$delete(t.tabledata,a)},getSummary:function(e){var t=e.columns,a=e.data,l=this,r=[];return t.forEach(function(e,t){4==t&&(r[t]=l.f(a.reduce(function(e,t){return e+Number(t.amount)},0)))}),r}},computed:{totalAmount:function(){var e=this;return e.f(e.tabledata.reduce(function(e,t){return e+Number(t.amount)},0))}},mounted:function(){}}},533:function(e,t,a){var l=a(534);"string"==typeof l&&(l=[[e.i,l,""]]),l.locals&&(e.exports=l.locals);a(181)("abfb1352",l,!0,{})},534:function(e,t,a){t=e.exports=a(180)(!1),t.push([e.i,".b-col>>>.b-item{width:100px}",""])},535:function(e,t,a){"use strict";var l=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-form",{ref:"order-form",staticClass:"formx",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"100px",inline:!0,size:"mini",rules:e.formRules,"inline-message":!1,"show-message":!1}},[a("el-row",{attrs:{gutter:0}},[a("asa-button",{attrs:{auth:"order-submit",enable:"2"!=e.form.status},on:{click:function(t){return e.saveOrder(1)}}},[e._v(e._s(e._label("baocun"))+"\n      ")]),e._v(" "),a("asa-button",{on:{click:function(t){return e._showDialog("select-dialog")}}},[e._v(e._s(e._label("xuanzemingxi")))])],1),e._v(" "),a("el-row",{attrs:{gutter:0}},[a("el-col",{staticStyle:{width:"250px"},attrs:{span:4}},[a("el-form-item",{attrs:{label:e._label("duizhangdanhao")}},[a("el-input",{attrs:{disabled:""}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("shoufufei")}},[a("simple-select",{attrs:{source:"billtype"},model:{value:e.form.billtype,callback:function(t){e.$set(e.form,"billtype",t)},expression:"form.billtype"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("bizhong")}},[a("simple-select",{attrs:{source:"currency"},model:{value:e.form.currencyid,callback:function(t){e.$set(e.form,"currencyid",t)},expression:"form.currencyid"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"250px"},attrs:{span:4}},[a("el-form-item",{attrs:{label:e._label("yuanshijine")}},[a("el-input",{attrs:{value:e.totalAmount,disabled:""}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("tiaozhengjine")}},[a("el-input",{attrs:{value:e.form.amount-e.totalAmount,disabled:""}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("duizhangjine")}},[a("el-input",{model:{value:e.form.amount,callback:function(t){e.$set(e.form,"amount",t)},expression:"form.amount"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"500px"},attrs:{span:8}},[a("el-row",[a("el-col",{staticStyle:{width:"250px"},attrs:{span:4}},[a("el-form-item",{attrs:{label:e._label("waibuduizhangdanhao")}},[a("el-input",{model:{value:e.form.out_billno,callback:function(t){e.$set(e.form,"out_billno",t)},expression:"form.out_billno"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("shoufufeidanwei")}},[a("simple-select",{attrs:{source:"supplier"},on:{change:e.onSupplierChange},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"250px"},attrs:{span:4}},[a("el-form-item",{attrs:{label:e._label("zhidanren")}},[a("el-input",{attrs:{placeholder:e._label("zidonghuoqu"),disabled:""}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("zhidanriqi")}},[a("el-input",{attrs:{placeholder:e._label("zidonghuoqu"),disabled:""}})],1)],1)],1),e._v(" "),a("el-row",[a("el-form-item",{staticClass:"twocol",attrs:{label:e._label("fapiaotaitou")}},[a("el-select",{model:{value:e.form.invoiceid,callback:function(t){e.$set(e.form,"invoiceid",t)},expression:"form.invoiceid"}},e._l(e.invoices,function(e){return a("el-option",{key:e.id,attrs:{label:e.name,value:e.id}})}),1)],1)],1)],1),e._v(" "),a("el-col",{staticClass:"b-col",attrs:{span:12}},[a("el-form-item",{staticClass:"b-item",attrs:{label:e._label("beizhu")}},[a("el-input",{attrs:{type:"textarea"},model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1)],1)],1),e._v(" "),a("el-row",[a("el-col",{attrs:{span:24}},[a("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,stripe:"",border:"","show-summary":!0,"summary-method":e.getSummary}},[a("el-table-column",{attrs:{label:e._label("xiaoshouduankou"),align:"center",width:"110"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;e.$index;return[a("sp-select-text",{attrs:{value:t.sales.saleportid,source:"saleport"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("zongshu"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-fetch-text",{attrs:{table:"member",pid:t.sales.memberid,column:"name"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("bizhong"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.currency,source:"currency"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("fukuanfangshi"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.paymentwayid,source:"paymentway"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("jine"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n            "+e._s(a.amount)+"\n          ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("xiaoshouren"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.sales.salesstaff,source:"user"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("xiaoshoudanhao"),width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n            "+e._s(a.sales.orderno)+"\n          ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("waibudingdanhao"),width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n            "+e._s(a.sales.expressno)+"\n          ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("fukuanriqi"),width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n            "+e._s(a.paymentdate)+"\n          ")]}}])}),e._v(" "),a("el-table-column",{attrs:{width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.$index;return[a("el-button",{attrs:{type:"danger",size:"mini"},on:{click:function(t){return e.removeRow(l)}}},[e._v(e._s(e._label("shanchu")))])]}}])})],1)],1)],1),e._v(" "),a("sp-dialog",{ref:"select-dialog",attrs:{"min-height":50,width:1100}},[a("el-form",{staticClass:"formx",staticStyle:{width:"100%"},attrs:{model:e.searchform,"label-width":"85px",inline:!1,size:"mini"}},[a("el-row",{attrs:{gutter:0}},[a("el-col",{staticStyle:{width:"300px"},attrs:{span:8}},[a("el-form-item",{attrs:{label:e._label("xiaoshouriqi")}},[a("el-date-picker",{attrs:{type:"daterange","range-separator":"~","start-placeholder":"开始日期","end-placeholder":"结束日期","value-format":"yyyy-MM-dd"},model:{value:e.searchform.date,callback:function(t){e.$set(e.searchform,"date",t)},expression:"searchform.date"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("huiyuan")}},[a("simple-select",{attrs:{source:"member",multiple:!0},model:{value:e.searchform.memberids,callback:function(t){e.$set(e.searchform,"memberids",t)},expression:"searchform.memberids"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"300px"},attrs:{span:8}},[a("el-form-item",{attrs:{label:e._label("waibudingdanhao")}},[a("el-input",{model:{value:e.searchform.externalno,callback:function(t){e.$set(e.searchform,"externalno",t)},expression:"searchform.externalno"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("xiaoshoucangku")}},[a("simple-select",{attrs:{source:"warehouse"},model:{value:e.searchform.warehouseid,callback:function(t){e.$set(e.searchform,"warehouseid",t)},expression:"searchform.warehouseid"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"300px"},attrs:{span:8}},[a("el-form-item",{attrs:{label:e._label("fukuanfangshi")}},[a("simple-select",{attrs:{source:"paymentway"},model:{value:e.searchform.paymentwayid,callback:function(t){e.$set(e.searchform,"paymentwayid",t)},expression:"searchform.paymentwayid"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("xiaoshouduankou")}},[a("simple-select",{attrs:{source:"saleport"},model:{value:e.searchform.saleportid,callback:function(t){e.$set(e.searchform,"saleportid",t)},expression:"searchform.saleportid"}})],1)],1)],1),e._v(" "),a("el-row",{attrs:{gutter:0}},[a("el-col",{attrs:{align:"center"}},[a("as-button",{attrs:{type:"primary"},on:{click:e.search}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),a("as-button",{attrs:{type:"primary"},on:{click:e.select}},[e._v(e._s(e._label("xuanze")))]),e._v(" "),a("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("select-dialog")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1),e._v(" "),a("el-table",{ref:"selectTable",staticStyle:{width:"100%"},attrs:{data:e.receives,stripe:"",border:"","max-height":"400"},on:{"selection-change":e.onSelectionChange,"row-click":e.onRowClick}},[a("el-table-column",{attrs:{type:"selection",width:30,align:"center"}}),e._v(" "),a("el-table-column",{attrs:{label:e._label("xiaoshouduankou"),align:"center",width:"110"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;e.$index;return[a("sp-select-text",{attrs:{value:t.sales.saleportid,source:"saleport"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("zongshu"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-fetch-text",{attrs:{table:"member",pid:t.sales.memberid,column:"name"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("bizhong"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.currency,source:"currency"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("fukuanfangshi"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.paymentwayid,source:"paymentway"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("jine"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n          "+e._s(a.amount)+"\n        ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("xiaoshouren"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.sales.salesstaff,source:"user"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("xiaoshoudanhao"),width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n          "+e._s(a.sales.orderno)+"\n        ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("waibudingdanhao"),width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n          "+e._s(a.sales.expressno)+"\n        ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("fukuanriqi"),width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n          "+e._s(a.paymentdate)+"\n        ")]}}])})],1)],1)],1)},r=[],n={render:l,staticRenderFns:r};t.a=n}});