webpackJsonp([11],{288:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=r(322),n=r(358),o=r(0),i=o(a.a,n.a,!1,null,null,null);t.default=i.exports},314:function(e,t,r){"use strict";r.d(t,"a",function(){return o});var a=r(182),n=r.n(a),o=function(e){var t={};return{get:function(r){return t[r]||(t[r]=n.a.cloneDeep(e)),t[r]},result:function(){return t}}}},318:function(e,t,r){"use strict";function a(e,t,r){var a=void 0;return function(){var n=this,o=arguments;if(a&&clearTimeout(a),r){var i=!a;a=setTimeout(function(){a=null},t),i&&e.apply(n,o)}else a=setTimeout(function(){e.apply(n,o)},t)}}r.d(t,"b",function(){return n}),r.d(t,"c",function(){return o}),r.d(t,"a",function(){return a});var n=function(){},o=function(){return!0}},322:function(e,t,r){"use strict";var a=r(6),n=r.n(a),o=r(12),i=r.n(o),l=r(13),s=r.n(l),u=r(26),c=r.n(u),d=(r(1),r(7)),f=r(37),p=r(184),m=r(35),b=r(318),h=r(314);t.a={name:"sp-shippingdetail",components:{},mixins:[p.a],data:function(){return{form:{supplierid:"",finalsupplierid:"",ageseason:"",seasontype:"",property:"",currency:"",bussinesstype:"",warehouseid:"",total:"",exchangerate:"",orderno:"",paydate:"",apickingdate:"",flightno:"",flightdate:"",mblno:"",hblno:"",dispatchport:"",deliveryport:"",box_number:"",weight:"",volume:"",chargedweight:"",transcompany:"",invoiceno:"",aarrivaldate:"",buyerid:"",sellerid:"",transporttype:"",paytype:"",estimatedate:"",maketime:"",makestaff:"",id:"",status:""},formimport:{supplierid:"",ageseason:""},form2:{supplierid:"",keyword:"",keyword1:"",suppliercode1:"",suppliercode:""},tabledata:[],orderbrands:[],orderbranddetails:[],shippingdetails:[],listdata:[],selected:[],selected2:[],uniqkey:1}},methods:{saveOrder:function(e){var t=this,r=this,a={form:r.form},n=[],o={},l=!0;r.listdata.forEach(function(e){var t=e.key,a=e.sizecontentid,i=e.number;if(l&&!(i<=0)){var s=r.tabledata.find(function(e){return e.key==t});console.log(">>>",s,a);var u=r.orderbranddetails.find(function(e){return e.orderbrandid==s.orderbrandid&&e.sizecontentid==a&&e.productid==s.product.id&&e.orderid==s.order.id}),c=[s.price,s.product.id,s.orderbrandid,a].join("-");o[c]?(l=!1,alert(r._label("chongfushezhi")+":"+s.product.getGoodsCode())):(n.push({orderid:s.order.id,sizecontentid:a,number:i,productid:s.product.id,discount:s.discount,price:s.price,orderdetailid:u.orderdetailid,orderbrandid:s.orderbrandid,orderbranddetailid:u.id,id:""}),o[c]=1)}}),a.list=n,l&&(r._log(c()(a)),r.validate().then(s()(i.a.mark(function e(){var n,o,l;return i.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return r._log(c()(a)),e.next=3,r._submit("/shipping/save",{params:c()(a)});case 3:n=e.sent,o=n.data,l="/shipping/warehousing/"+o.form.id,r._path()!==l?r._redirect(l):Object(d.b)(r.form,o.form);case 7:case"end":return e.stop()}},e,t)}))))},onNumberChange:function(e){var t=this;e.forEach(function(e){var r=e.number,a=e.key,n=e.sizecontentid,o=t.listdata.find(function(e){return e.key==a&&e.sizecontentid==n});o?o.number=r:t.listdata.push({key:a,number:r,sizecontentid:n})})},copyit:function(e){var t=this,r=Object(d.b)({},e);return v(t).appendRow(r),r},getInit:function(e){var t=this,r=[];return t.listdata.forEach(function(t){var a=t.sizecontentid,n=t.key,o=t.number;n==e&&r.push({sizecontentid:a,number:o})}),r},onSelect:function(e){var t=this;t._fetch("/orderbrand/searchorder",t.formimport).then(function(e){var r=e.data;t._log(r);var a=r.orderbrands,n=r.orderbranddetails;if(a){var o=v(t);o.importOrderbrands(a),o.importList(n)}t._hideDialog("order-dialog")})},getSummary:function(e){var t=e.columns,r=e.data,a=this,n=[];return r=a.orderdetails,t.forEach(function(e,t){if(1==t)return void(n[t]=a._label("heji"));7==t?n[t]=r.reduce(function(e,t){var r=a.count[t.key]||0;return a.f(e+t.price*r)},0):9==t&&(n[t]=r.reduce(function(e,t){return e+(a.count[t.key]||0)},0))}),n[2]=r.length,n},onSelectionChange:function(e){this.selected=e},onRowClick:function(e){this.$refs.table.toggleRowSelection(e)},onSelectionChange2:function(e){this.selected2=e}},computed:{orderdetails:function(){var e=this,t={};e.selected.forEach(function(e){t[e.id]=1});var r=e.form2.keyword.toUpperCase(),a=e.form2.suppliercode.toUpperCase(),n=v(e).isMatch;return e.tabledata.filter(function(e){return 1==t[e.orderbrandid]}).filter(function(e){return n(r,e.product.getGoodsCode(""))&&n(a,e.order.booking_label.toUpperCase())})},width:function(){return 51*this.tabledata.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)+75},count:function(){var e=this,t={};return e.listdata.forEach(function(e){var r=e.key,a=e.number;t[r]=t[r]||0,t[r]+=1*a}),t},countbyid:function(){var e=this,t={};return e.listdata.forEach(function(r){var a=r.key,n=r.number,o=e.tabledata.find(function(e){return e.key==a});a=o.orderbrandid,t[a]=t[a]||0,t[a]+=1*n}),t},total_price:function(){var e=this,t=0;return e.listdata.forEach(function(r){var a=r.key,n=r.number,o=e.tabledata.find(function(e){return e.key==a});t+=o.price*n}),t},orderstat:function(){var e=this,t=Object(h.a)({totalCount:0,totalConfirmCount:0,totoaShippingCount:0,brandCount:0,leftCount:0});return e.orderbrands.forEach(function(e){t.get(e.id)}),e.orderbranddetails.forEach(function(e){var r=t.get(e.orderbrandid);r.totalCount+=1*e.number,r.totalConfirmCount+=1*e.confirm_number,r.totoaShippingCount+=1*e.shipping_number,r.leftCount=r.totalConfirmCount-r.totoaShippingCount}),e.shippingdetails.forEach(function(e){t.get(e.orderbrandid).leftCount+=1*e.number}),t.result()},currentstat:function(){var e=this,t={};return e.orderbrands.forEach(function(e){t[e.id]=0}),e.listdata.forEach(function(r){var a=r.key,n=(r.sizecontentid,r.number),o=e.tabledata.find(function(e){return e.key==a});t[o.orderbrandid]+=1*n}),t},productStat:function(){var e=this,t=Object(h.a)({factoryprice:0,wordprice:0,currencyid:"",total:0});return e.orderbranddetails.forEach(function(e){var r=t.get(e.productid);r.factoryprice=e.factoryprice,r.wordprice=e.wordprice,r.currencyid=e.currencyid}),t.result()}},watch:{"form2.keyword1":function(e){this.copyKeywordDebounce()},"form2.suppliercode1":function(e){this.copySuppliercodeDebounce()}},mounted:function(){var e=this,t=e.$route;e._log(t.params),e.copyKeywordDebounce=Object(b.a)(function(){e.form2.keyword=e.form2.keyword1},1e3,!1),e.copySuppliercodeDebounce=Object(b.a)(function(){e.form2.suppliercode=e.form2.suppliercode1},1e3,!1),t.params.id>0?e._fetch("/shipping/load",{id:t.params.id,type:"shipping"}).then(function(){var t=s()(i.a.mark(function t(r){var a,n,o,l,s,u=r.data;return i.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return a=u.form,n=u.orderbrands,o=u.orderbranddetails,l=u.shippingdetails,s=v(e),Object(d.a)(a,e.form),s.importOrderbrands(n),t.next=6,s.importList(o);case 6:s.importShippingList(l),e._setTitle(e._label("fahuodan")+":"+e.form.orderno),e.$refs.table.toggleAllSelection();case 9:case"end":return t.stop()}},t,this)}));return function(e){return t.apply(this,arguments)}}()):e._setTitle(e._label("shengchengfahuodan")),e.initRules(function(t){var r=e._label;return{warehouseid:t.id({required:!0,message:r("8000"),label:r("daohuocangku")})}})}};var v=function(e){var t={isMatch:function(e,t){return!(e.length>0)||t.toUpperCase().indexOf(e)>=0},convert:function(e){var t=this;return s()(i.a.mark(function r(){var a,o;return i.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return a={},e.forEach(function(e){var t=e.productid+"-"+e.orderbrandid;if(a[t])a[t].form[e.sizecontentid]=e.confirm_number-e.shipping_number,a[t].total+=e.confirm_number-e.shipping_number;else{var r={};r[e.sizecontentid]=e.confirm_number-e.shipping_number,a[t]={key:t,productid:e.productid,orderid:e.orderid,discount:e.discount,total:1*e.number,form:r,orderbrandid:e.orderbrandid,price:"",is_auto:!0}}}),o=[],Object(f.a)(a).forEach(function(e){var t=Object(m.i)(e);e.orderid>0?t.push(m.b.load({data:e.orderid,depth:1}),"order"):e.order={id:-1},t.push(m.e.load({data:e.productid,depth:1}),"product"),o.push(t.all())}),t.next=6,n.a.all(o);case 6:return t.abrupt("return",t.sent);case 7:case"end":return t.stop()}},r,t)}))()},appendRow:function(t){t.key=e.uniqkey,e.tabledata.push(t),e.uniqkey++},importList:function(r){var a=this;return s()(i.a.mark(function n(){var o,l;return i.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return o=[],r.forEach(function(t){e.orderbranddetails.find(function(e){return e.id==t.id})||(e.orderbranddetails.push(t),o.push(t)),""==e.form.currency&&t.currencyid>0&&(e.form.currency=t.currencyid)}),a.next=4,t.convert(o);case 4:l=a.sent,l.forEach(function(r){r.price=e.f(e.productStat[r.productid].factoryprice*r.discount),t.appendRow(r)});case 6:case"end":return a.stop()}},n,a)}))()},importOrderbrands:function(t){t.forEach(function(t){e.orderbrands.find(function(e){return e.id==t.id})||(e.orderbrands.push(t),Object(d.c)(e.form,t,function(e){var t=e.target,r=e.key;return e.value&&""==t[r]&&("supplierid"==r||"ageseason"==r||"seasontype"==r||"bussinesstype"==r||"currency"==r)}))})},importShippingList:function(t){var r={},a={};t.forEach(function(t){if(!(t.orderid<=0)){e.shippingdetails.push(t);var n=e.tabledata.find(function(e){return e.orderbrandid==t.orderbrandid&&e.product.id==t.productid&&e.order.id==t.orderid}),o=t.productid+"-"+t.orderbrandid+"-"+t.price;if(a[o])e.listdata.push({key:a[o],sizecontentid:t.sizecontentid,number:t.number});else if(r[t.productid+"-"+t.orderbrandid]){var i=e.copyit(n);i.price=t.price,i.discount=t.discount,e.listdata.push({key:i.key,sizecontentid:t.sizecontentid,number:t.number}),a[o]=i.key}else n.price=t.price,n.discount=t.discount,e.listdata.push({key:n.key,sizecontentid:t.sizecontentid,number:t.number}),a[o]=n.key,r[t.productid+"-"+t.orderbrandid]=1}})}};return t}},358:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{ref:"order-form",staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini",rules:e.formRules,"inline-message":!1,"show-message":!1}},[r("el-row",{attrs:{gutter:0}},["2"!=e.form.status?r("au-button",{attrs:{auth:"confirmorder-submit",type:"primary"},on:{click:function(t){return e.saveOrder(1)}}},[e._v(e._s(e._label("baocun")))]):e._e(),e._v(" "),"2"!=e.form.status?r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._showDialog("order-dialog")}}},[e._v(e._s(e._label("daorudingdan")))]):e._e()],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"600px"},attrs:{span:8}},[r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("fahuodanhao")}},[r("el-input",{attrs:{disabled:!0},model:{value:e.form.orderno,callback:function(t){e.$set(e.form,"orderno",t)},expression:"form.orderno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3"},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuodanwei")}},[r("simple-select",{attrs:{source:"supplier_3"},model:{value:e.form.finalsupplierid,callback:function(t){e.$set(e.form,"finalsupplierid",t)},expression:"form.finalsupplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("niandaijijie")}},[r("simple-select",{attrs:{source:"ageseason"},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("niandaileixing")}},[r("simple-select",{attrs:{source:"seasontype"},model:{value:e.form.seasontype,callback:function(t){e.$set(e.form,"seasontype",t)},expression:"form.seasontype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yewuleixing")}},[r("simple-select",{attrs:{source:"bussinesstype"},model:{value:e.form.bussinesstype,callback:function(t){e.$set(e.form,"bussinesstype",t)},expression:"form.bussinesstype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanren")}},[r("sp-display-input",{attrs:{value:e.form.makestaff,source:"user"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("fahuogang")}},[r("el-input",{model:{value:e.form.dispatchport,callback:function(t){e.$set(e.form,"dispatchport",t)},expression:"form.dispatchport"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("daohuogang")}},[r("el-input",{model:{value:e.form.deliveryport,callback:function(t){e.$set(e.form,"deliveryport",t)},expression:"form.deliveryport"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("daohuocangku"),prop:"warehouseid"}},[r("simple-select",{attrs:{source:"warehouse"},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("haiwaifapiaohao")}},[r("el-input",{model:{value:e.form.invoiceno,callback:function(t){e.$set(e.form,"invoiceno",t)},expression:"form.invoiceno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zongjine")}},[r("sp-float-input",{staticClass:"input-with-select",attrs:{placeholder:"",select_value:e.total_price}},[r("simple-select",{attrs:{source:"currency",clearable:!1},model:{value:e.form.currency,callback:function(t){e.$set(e.form,"currency",t)},expression:"form.currency"}})],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("huilv")}},[r("sp-float-input",{model:{value:e.form.exchangerate,callback:function(t){e.$set(e.form,"exchangerate",t)},expression:"form.exchangerate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanriqi")}},[r("el-input",{attrs:{value:e.form.maketime,placeholder:e._label("zidonghuoqu"),disabled:""}})],1)],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"600px"},attrs:{span:4}},[r("el-form-item",{staticClass:"twocols",attrs:{label:e._label("beizhu")}},[r("el-input",{staticStyle:{width:"400px"},model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1)],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("fukuanshijian")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.paydate,callback:function(t){e.$set(e.form,"paydate",t)},expression:"form.paydate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhifufangshi")}},[r("simple-select",{attrs:{source:"paytype"},model:{value:e.form.paytype,callback:function(t){e.$set(e.form,"paytype",t)},expression:"form.paytype"}})],1),e._v(" "),r("el-form-item",{staticClass:"mini font12",attrs:{label:e._label("anpaitihuoshijian")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.apickingdate,callback:function(t){e.$set(e.form,"apickingdate",t)},expression:"form.apickingdate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("daokushijian")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.aarrivaldate,callback:function(t){e.$set(e.form,"aarrivaldate",t)},expression:"form.aarrivaldate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xiangshu")}},[r("el-input",{model:{value:e.form.box_number,callback:function(t){e.$set(e.form,"box_number",t)},expression:"form.box_number"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhongliang")}},[r("el-input",{model:{value:e.form.weight,callback:function(t){e.$set(e.form,"weight",t)},expression:"form.weight"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("tiji")}},[r("el-input",{model:{value:e.form.volume,callback:function(t){e.$set(e.form,"volume",t)},expression:"form.volume"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jifeizhongliang")}},[r("el-input",{model:{value:e.form.chargedweight,callback:function(t){e.$set(e.form,"chargedweight",t)},expression:"form.chargedweight"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("kongyunshang")}},[r("simple-select",{attrs:{source:"supplier"},model:{value:e.form.transcompany,callback:function(t){e.$set(e.form,"transcompany",t)},expression:"form.transcompany"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yunshufangshi")}},[r("simple-select",{attrs:{source:"transporttype"},model:{value:e.form.transporttype,callback:function(t){e.$set(e.form,"transporttype",t)},expression:"form.transporttype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("hangbanhao")}},[r("el-input",{model:{value:e.form.flightno,callback:function(t){e.$set(e.form,"flightno",t)},expression:"form.flightno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("hangbanriqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.flightdate,callback:function(t){e.$set(e.form,"flightdate",t)},expression:"form.flightdate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yujidaodariqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.estimatedate,callback:function(t){e.$set(e.form,"estimatedate",t)},expression:"form.estimatedate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhudanhao")}},[r("el-input",{model:{value:e.form.mblno,callback:function(t){e.$set(e.form,"mblno",t)},expression:"form.mblno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zidanhao")}},[r("el-input",{model:{value:e.form.hblno,callback:function(t){e.$set(e.form,"hblno",t)},expression:"form.hblno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("beizhu")}},[r("el-input",{model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1)],1)],1),e._v(" "),r("el-row",[r("el-col",{staticClass:"product",staticStyle:{"margin-top":"2px"},attrs:{span:24}},[r("el-table",{ref:"table",staticStyle:{width:"100%"},attrs:{data:e.orderbrands,stripe:"",border:""},on:{"selection-change":e.onSelectionChange,"row-click":e.onRowClick}},[r("el-table-column",{attrs:{type:"selection",width:30,align:"center"}}),e._v(" "),r("el-table-column",{attrs:{prop:"orderno",label:e._label("dingdanbianhao"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-order-tip",{attrs:{column:"orderno",order:t,trigger:"hover"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("gonghuoshang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.supplierid,source:"supplier"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dinghuoshuliang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                           "+e._s(e.orderstat[r.id].totalCount)+"\n                       ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("querenshuliang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                           "+e._s(e.orderstat[r.id].totalConfirmCount)+"\n                       ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shengyushuliang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                           "+e._s(e.orderstat[r.id].leftCount-e.currentstat[r.id])+"\n                       ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("fahuoshuliang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                           "+e._s(e.currentstat[r.id]||0)+"\n                       ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("niandai"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.ageseason,source:"ageseason"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("bizhong"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.currency,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"discount",label:e._label("zhekoulv"),width:"90",align:"center"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("yewuleixing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.bussinesstype,source:"bussinesstype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dingdanriqi"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                           "+e._s(r.maketime&&r.maketime.length>0?r.maketime.substr(0,10):"")+"\n                       ")]}}])})],1),e._v(" "),r("el-row",{attrs:{gutter:0}}),e._v(" "),r("el-row",{staticClass:"product clearpadding",staticStyle:{"margin-top":"3px"},attrs:{gutter:0}},[r("el-table",{ref:"tabledetail",staticStyle:{width:"100%"},attrs:{data:e.orderdetails,stripe:"",border:"","show-summary":!0,"summary-method":e.getSummary},on:{"selection-change":e.onSelectionChange2}},[r("el-table-column",{attrs:{type:"selection",width:30,align:"center"}}),e._v(" "),r("el-table-column",{attrs:{align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("img",{staticStyle:{width:"50px",height:"50px"},attrs:{src:e._fileLink(t.row.product.picture)}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dinghuokehu"),align:"center",width:"150"}},[r("el-table-column",{attrs:{label:e._label("dinghuokehu"),align:"center",width:"150"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-order-tip",{attrs:{column:"booking_label",order:t.order}})]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.suppliercode1,callback:function(t){e.$set(e.form2,"suppliercode1",t)},expression:"form2.suppliercode1"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"}},[r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){return[r("sp-product-tip",{attrs:{product:e.row.product}})]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.keyword1,callback:function(t){e.$set(e.form2,"keyword1",t)},expression:"form2.keyword1"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("bizhong"),width:"60",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("sp-select-text",{attrs:{value:e.productStat[a.productid].currencyid,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                               "+e._s(e.productStat[r.product.id].factoryprice)+"\n                           ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chengjiaojia"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:a.price,callback:function(t){e.$set(a,"price",t)},expression:"row.price"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("zongjia"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                               "+e._s(e.f(r.price*e.count[r.key]||0))+"\n                           ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhekoulv"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:a.discount,callback:function(t){e.$set(a,"discount",t)},expression:"row.discount"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"number",label:e._label("dinggoushuliang"),align:"center",width:e.width},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("sp-sizecontent-confirm4",{key:a.key,ref:a.product.id+"-"+a.order.id,attrs:{columns:a.product.sizecontents,head:a.form,uniq:a.key,data:e.getInit(a.key)},on:{change:e.onNumberChange}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("el-popover",{attrs:{placement:"right",width:"60",trigger:"hover"}},[r("el-button",{attrs:{size:"mini",type:"primary"},on:{click:function(t){return e.copyit(a)}}},[e._v(e._s(e._label("fuzhi")))]),e._v(" "),r("span",{attrs:{slot:"reference"},slot:"reference"},[e._v(e._s(a.product.getName()))])],1)]}}])})],1)],1)],1)],1),e._v(" "),r("sp-dialog",{ref:"order-dialog"},[r("el-form",{staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!1,size:"mini"}},[r("el-row",{attrs:{gutter:0}},[r("el-form-item",{attrs:{label:e._label("niandai")}},[r("simple-select",{attrs:{source:"ageseason"},model:{value:e.formimport.ageseason,callback:function(t){e.$set(e.formimport,"ageseason",t)},expression:"formimport.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3"},model:{value:e.formimport.supplierid,callback:function(t){e.$set(e.formimport,"supplierid",t)},expression:"formimport.supplierid"}})],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{attrs:{align:"center"}},[r("as-button",{attrs:{auth:"product",type:"primary"},on:{click:e.onSelect}},[e._v(e._s(e._label("daorudingdan")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("order-dialog")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1)},n=[],o={render:a,staticRenderFns:n};t.a=o}});
//# sourceMappingURL=11-1021.js.map