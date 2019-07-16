webpackJsonp([7],{279:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=r(312),o=r(342),n=r(0),i=n(a.a,o.a,!1,null,null,null);t.default=i.exports},303:function(e,t,r){"use strict";r.d(t,"a",function(){return n});var a=r(173),o=r.n(a),n=function(e){var t={};return{get:function(r){return t[r]||(t[r]=o.a.cloneDeep(e)),t[r]},result:function(){return t}}}},304:function(e,t,r){"use strict";function a(e,t,r){var a=void 0;return function(){var o=this,n=arguments;if(a&&clearTimeout(a),r){var i=!a;a=setTimeout(function(){a=null},t),i&&e.apply(o,n)}else a=setTimeout(function(){e.apply(o,n)},t)}}r.d(t,"b",function(){return o}),r.d(t,"c",function(){return n}),r.d(t,"a",function(){return a});var o=function(){},n=function(){return!0}},312:function(e,t,r){"use strict";var a=r(175),o=r.n(a),n=r(12),i=r.n(n),l=r(6),s=r.n(l),c=r(13),u=r.n(c),d=r(26),f=r.n(d),p=r(1),m=r(7),b=r(34),h=r(174),v=r(33),y=r(304),_=r(303),g={name:"sp-warehousing",components:{},mixins:[h.a],data:function(){var e=this,t=e._label;return{form:{supplierid:"",finalsupplierid:"",ageseason:"",seasontype:"",property:"",currency:"",bussinesstype:"",warehouseid:"",total:"",exchangerate:"",orderno:"",paydate:"",dd_company:"",apickingdate:"",flightno:"",flightdate:"",mblno:"",hblno:"",dispatchport:"",deliveryport:"",box_number:"",weight:"",volume:"",chargedweight:"",transcompany:"",invoiceno:"",aarrivaldate:"",buyerid:"",sellerid:"",transporttype:"",paytype:"",estimatedate:"",maketime:"",makestaff:"",id:"",status:""},form2:{supplierid:"",keyword:"",keyword1:"",suppliercode1:"",suppliercode:""},tabledata:[],shippingdetails:[],orderbranddetails:[],listdata:[],uniqkey:1,visible:!1,pro:!1,orderpayment:{columns:[{name:"feenameid",label:t("feiyongmingcheng"),type:"select",source:"feename",width:110},{name:"currencyid",label:t("bizhong"),type:"select",source:"currency",width:90},{name:"amount",label:t("jine"),width:110},{name:"memo",label:t("beizhu"),width:110},{name:"makestaff",label:t("tijiaoren"),type:"select",source:"user",is_edit_hide:!0,width:110}],controller:"shippingfee",auth:"shippingfee",base:{shippingid:""},options:{isedit:function(t){return"2"==e.form.status},isdelete:function(t){return"2"==e.form.status},isAdd:!1,isSearch:!1,isAutoReload:!0}}}},methods:{showPayment:function(){var e=this;e.orderpayment.base.shippingid=e.form.id,e._showDialog("orderpayment")},showProduct:function(){},onSelectProduct:function(e){k(this).appendRow({productid:e.id,product:e,discount:1,price:"",form:{}})},onNumberChange:function(e){var t=this;e.forEach(function(e){var r=e.number,a=e.key,o=e.sizecontentid,n=t.listdata.find(function(e){return e.key==a&&e.sizecontentid==o});n?n.number=r:t.listdata.push({key:a,number:r,sizecontentid:o})})},search:function(e){var t=this;t.pro=!0,t.$refs.products.search(e)},confirmShipping:function(e){var t=this;if(confirm(t._label("confirm-ruku"))){var r={form:t.form},a=!0,o=[];t.listdata.forEach(function(e){var r=e.key,n=e.sizecontentid,i=e.number;if(!(i<=0)){var l=t.tabledata.find(function(e){return e.key==r}),s=t.shippingdetails.find(function(e){return e.productid==l.product.id&&e.orderid==l.orderid&&e.sizecontentid==n&&e.orderbrandid==l.orderbrandid});l.price<=0&&(alert(t._label("tip-jiagebunengweikong")),a=!1),o.push({sizecontentid:n,number:i,productid:l.product.id,discount:l.discount,price:l.price,id:s?s.id:0})}}),r.list=o,t._log(f()(r)),t._submit("/shipping/confirm",{params:f()(r)}).then(function(e){k(t).loadDetail(t.$route.params.id)})}},warehousing:function(){var e=this;confirm(e._label("quxiaorukutishi"))&&e._submit("/shipping/warehousing",{id:e.form.id}).then(function(t){k(e).loadDetail(e.$route.params.id)})},cancelWarehousing:function(){var e=this;confirm(e._label("quxiaorukutishi"))&&e._submit("/shipping/cancel",{id:e.form.id}).then(function(t){k(e).loadDetail(e.$route.params.id)})},cancelConfirm:function(){var e=this;confirm(e._label("quxiaorukutishi"))&&e._submit("/shipping/cancelconfirm",{id:e.form.id}).then(function(t){k(e).loadDetail(e.$route.params.id)})},getInit:function(e){var t=[];return this.listdata.forEach(function(r){var a=r.sizecontentid,o=r.number,n=r.key;e==n&&t.push({sizecontentid:a,number:o})}),t},deleteOrder:function(){var e=this;e.form.id&&e._remove("/confirmorder/delete",{id:e.form.id}).then(function(t){e.$emit("change",e.form,"delete")})},onChange:function(e){var t=e.row,r=e.form,a=e.total;t.form=r,t.confirm_total=a},onSelect:function(e){k(this).appendRow({source:e,id:"",price:e.price})},getSummary:function(e){var t=e.columns,r=e.data,a=this,o=[];return t.forEach(function(e,t){if(0==t)return void(o[t]=a._label("heji"));5==t||8==t?o[t]=r.reduce(function(e,t){return e+a.count[t.key]},0):9==t&&(o[t]=r.reduce(function(e,t){return a.f(e+a.count[t.key]*t.price)},0))}),o[1]=r.length,o}},computed:{orderdetails:function(){var e=this,t=e.form2.keyword.toUpperCase(),r=e.form2.suppliercode.toUpperCase(),a=k(e).isMatch;return e.tabledata.filter(function(o){return e._log(o,t,r),a(t,o.product.getGoodsCode(""))&&(o.order&&a(r,o.order.booking_label.toUpperCase())||!o.order&&!r)})},width:function(){return 51*this.tabledata.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)+75},count:function(){var e=this,t={};return e.tabledata.forEach(function(e){return t[e.key]=0}),e.listdata.forEach(function(e){var r=e.key,a=e.number;t[r]+=1*a}),t},total_price:function(){var e=this,t=0;return e.listdata.forEach(function(r){var a=r.key,o=r.number,n=e.tabledata.find(function(e){return e.key==a});t+=n.price*o}),t},productStat:function(){var e=this,t=Object(_.a)({factoryprice:0,wordprice:0,currencyid:"",total:0});return e.tabledata.forEach(function(e){var r=e.product,a=t.get(r.id);a.factoryprice=r.factoryprice,a.wordprice=r.wordprice,a.currencyid=r.factorypricecurrency}),e.orderbranddetails.forEach(function(e){var r=t.get(e.productid);r.factoryprice=e.factoryprice,r.wordprice=e.wordprice,r.currencyid=e.currencyid}),t.result()},isDisabled:function(){return"1"!=this.form.status}},watch:{"form2.keyword1":function(e){this.copyKeywordDebounce()},"form2.suppliercode1":function(e){this.copySuppliercodeDebounce()}},mounted:function(){var e=this;e.copyKeywordDebounce=Object(y.a)(function(){e.form2.keyword=e.form2.keyword1},1e3,!1),e.copySuppliercodeDebounce=Object(y.a)(function(){e.form2.suppliercode=e.form2.suppliercode1},1e3,!1),k(e).loadDetail(e.$route.params.id)}},k=function(e){var t,r=(t={isMatch:function(e,t){return!(e.length>0)||t.toUpperCase().indexOf(e)>=0},appendRow:function(t){t.key=p.c.random(10),e.tabledata.unshift(t),e.form.currency=e.productStat[t.product.id].currencyid},convert:function(e){var t=this;return u()(i.a.mark(function r(){var a,o;return i.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return a={},e.forEach(function(e){var t=e.price+"-"+e.productid+"-"+e.orderid;if(a[t])a[t].form[e.sizecontentid]=e.number,a[t].total+=e.number;else{var r={};r[e.sizecontentid]=e.number,a[t]={key:t,productid:e.productid,orderbrandid:e.orderbrandid,orderid:e.orderid,discount:e.discount,total:1*e.number,form:r,price:e.price}}}),o=[],Object(b.a)(a).forEach(function(e){var t=Object(v.h)(e);e.orderid>0&&t.push(v.b.load({data:e.orderid,depth:1}),"order"),t.push(v.e.load({data:e.productid,depth:1}),"product"),o.push(t.all())}),t.next=6,s.a.all(o);case 6:return t.abrupt("return",t.sent);case 7:case"end":return t.stop()}},r,t)}))()}},o()(t,"appendRow",function(t){t.key=e.uniqkey,e.tabledata.push(t),e.uniqkey++}),o()(t,"importList",function(t){var a=this;return u()(i.a.mark(function o(){var n,l;return i.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return e.shippingdetails=[],e.tabledata=[],e.listdata=[],n=[],t.forEach(function(t){e.shippingdetails.push(t)}),a.next=7,r.convert(t);case 7:l=a.sent,l.forEach(function(e){r.appendRow(e)}),t.forEach(function(t){var r=e.tabledata.find(function(e){return e.productid==t.productid&&e.price==t.price&&e.orderid==t.orderid});e.listdata.push({key:r.key,sizecontentid:t.sizecontentid,number:t.warehousingnumber})});case 10:case"end":return a.stop()}},o,a)}))()}),o()(t,"loadDetail",function(t){e._setTitle("Loading..."),e._fetch("/shipping/load",{id:t}).then(function(){var t=u()(i.a.mark(function t(a){var o,n,l,s,c=a.data;return i.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:o=c.form,n=c.orderbrands,l=c.orderbranddetails,s=c.shippingdetails,Object(m.a)(o,e.form),r.importList(s),e.orderbranddetails=l,e._setTitle(e._label("fahuodanruku")+":"+e.form.orderno);case 5:case"end":return t.stop()}},t,this)}));return function(e){return t.apply(this,arguments)}}())}),t);return r};t.a=g},342:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini"}},[r("el-row",{attrs:{gutter:0}},["1"==e.form.status?r("au-button",{attrs:{auth:"confirmorder-submit",type:"danger"},on:{click:function(t){return e.confirmShipping()}}},[e._v(e._s(e._label("queren")))]):e._e(),e._v(" "),"1"==e.form.status?r("as-button",{attrs:{type:"primary"},on:{click:function(t){e.pro=!0}}},[e._v(e._s(e._label("xuanzeshangpin")))]):e._e(),e._v(" "),"2"==e.form.status?r("as-button",{attrs:{type:"danger"},on:{click:function(t){return e.cancelConfirm()}}},[e._v(e._s(e._label("quxiaoqueren")))]):e._e(),e._v(" "),"2"==e.form.status?r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.warehousing()}}},[e._v(e._s(e._label("ruku")))]):e._e(),e._v(" "),"3"==e.form.status?r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.cancelWarehousing()}}},[e._v(e._s(e._label("quxiaoruku")))]):e._e(),e._v(" "),"2"==e.form.status||"3"==e.form.status?r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.showPayment()}}},[e._v(e._s(e._label("feiyong")))]):e._e()],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"600px"},attrs:{span:8}},[r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("fahuodanhao")}},[r("el-input",{attrs:{disabled:!0},model:{value:e.form.orderno,callback:function(t){e.$set(e.form,"orderno",t)},expression:"form.orderno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3"},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuodanwei")}},[r("simple-select",{attrs:{source:"supplier_3"},model:{value:e.form.finalsupplierid,callback:function(t){e.$set(e.form,"finalsupplierid",t)},expression:"form.finalsupplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("niandaijijie")}},[r("simple-select",{attrs:{source:"ageseason"},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("niandaileixing")}},[r("simple-select",{attrs:{source:"seasontype"},model:{value:e.form.seasontype,callback:function(t){e.$set(e.form,"seasontype",t)},expression:"form.seasontype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yewuleixing")}},[r("simple-select",{attrs:{source:"bussinesstype"},model:{value:e.form.bussinesstype,callback:function(t){e.$set(e.form,"bussinesstype",t)},expression:"form.bussinesstype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanren")}},[r("sp-display-input",{attrs:{value:e.form.makestaff,source:"user"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("fahuogang")}},[r("el-input",{model:{value:e.form.dispatchport,callback:function(t){e.$set(e.form,"dispatchport",t)},expression:"form.dispatchport"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("daohuogang")}},[r("el-input",{model:{value:e.form.deliveryport,callback:function(t){e.$set(e.form,"deliveryport",t)},expression:"form.deliveryport"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("daohuocangku")}},[r("simple-select",{attrs:{source:"warehouse"},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("haiwaifapiaohao")}},[r("el-input",{model:{value:e.form.invoiceno,callback:function(t){e.$set(e.form,"invoiceno",t)},expression:"form.invoiceno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zongjine")}},[r("sp-float-input",{staticClass:"input-with-select",attrs:{placeholder:"",select_value:e.total_price}},[r("simple-select",{attrs:{source:"currency",clearable:!1},model:{value:e.form.currency,callback:function(t){e.$set(e.form,"currency",t)},expression:"form.currency"}})],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("huilv")}},[r("sp-float-input",{model:{value:e.form.exchangerate,callback:function(t){e.$set(e.form,"exchangerate",t)},expression:"form.exchangerate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanriqi")}},[r("el-input",{attrs:{value:e.form.maketime,placeholder:e._label("zidonghuoqu"),disabled:""}})],1)],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"600px"},attrs:{span:4}},[r("el-form-item",{staticClass:"twocols",attrs:{label:e._label("beizhu")}},[r("el-input",{staticStyle:{width:"400px"},model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1)],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("fukuanshijian")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.paydate,callback:function(t){e.$set(e.form,"paydate",t)},expression:"form.paydate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhifufangshi")}},[r("simple-select",{attrs:{source:"paytype"},model:{value:e.form.paytype,callback:function(t){e.$set(e.form,"paytype",t)},expression:"form.paytype"}})],1),e._v(" "),r("el-form-item",{staticClass:"mini font12",attrs:{label:e._label("anpaitihuoshijian")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.apickingdate,callback:function(t){e.$set(e.form,"apickingdate",t)},expression:"form.apickingdate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("daokushijian")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.aarrivaldate,callback:function(t){e.$set(e.form,"aarrivaldate",t)},expression:"form.aarrivaldate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xiangshu")}},[r("el-input",{model:{value:e.form.box_number,callback:function(t){e.$set(e.form,"box_number",t)},expression:"form.box_number"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhongliang")}},[r("el-input",{model:{value:e.form.weight,callback:function(t){e.$set(e.form,"weight",t)},expression:"form.weight"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("tiji")}},[r("el-input",{model:{value:e.form.volume,callback:function(t){e.$set(e.form,"volume",t)},expression:"form.volume"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jifeizhongliang")}},[r("el-input",{model:{value:e.form.chargedweight,callback:function(t){e.$set(e.form,"chargedweight",t)},expression:"form.chargedweight"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("kongyunshang")}},[r("simple-select",{attrs:{source:"supplier"},model:{value:e.form.transcompany,callback:function(t){e.$set(e.form,"transcompany",t)},expression:"form.transcompany"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yunshufangshi")}},[r("simple-select",{attrs:{source:"transporttype"},model:{value:e.form.transporttype,callback:function(t){e.$set(e.form,"transporttype",t)},expression:"form.transporttype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("hangbanhao")}},[r("el-input",{model:{value:e.form.flightno,callback:function(t){e.$set(e.form,"flightno",t)},expression:"form.flightno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("hangbanriqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.flightdate,callback:function(t){e.$set(e.form,"flightdate",t)},expression:"form.flightdate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yujidaodariqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.estimatedate,callback:function(t){e.$set(e.form,"estimatedate",t)},expression:"form.estimatedate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhudanhao")}},[r("el-input",{model:{value:e.form.mblno,callback:function(t){e.$set(e.form,"mblno",t)},expression:"form.mblno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zidanhao")}},[r("el-input",{model:{value:e.form.hblno,callback:function(t){e.$set(e.form,"hblno",t)},expression:"form.hblno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("beizhu")}},[r("el-input",{model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1)],1)],1),e._v(" "),r("el-row",[r("el-col",{staticClass:"product",attrs:{span:24}},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.orderdetails,stripe:"",border:"","show-summary":!0,"summary-method":e.getSummary}},[r("el-table-column",{attrs:{align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("img",{staticStyle:{width:"50px",height:"50px"},attrs:{src:e._fileLink(a.product.picture)}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dinghuokehu"),align:"center",width:"150"}},[r("el-table-column",{attrs:{label:e._label("dinghuokehu"),align:"center",width:"150"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[a.order?r("sp-order-tip",{attrs:{column:"booking_label",order:a.order}}):e._e()]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.suppliercode1,callback:function(t){e.$set(e.form2,"suppliercode1",t)},expression:"form2.suppliercode1"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"}},[r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){return[r("sp-product-tip",{attrs:{product:e.row.product}})]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.keyword1,callback:function(t){e.$set(e.form2,"keyword1",t)},expression:"form2.keyword1"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("bizhong"),width:"60",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("sp-select-text",{attrs:{value:e.productStat[a.productid].currencyid,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.productStat[r.product.id].factoryprice)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"number",label:e._label("dinggoushuliang"),align:"center",width:e.width},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;t.$index;return[r("sp-sizecontent-confirm4",{key:a.key,attrs:{columns:a.product.sizecontents,head:a.form,uniq:a.key,data:e.getInit(a.key),disabled:e.isDisabled},on:{change:e.onNumberChange}})]}}])}),e._v(" "),r("el-table-column",{staticClass:"counter",attrs:{prop:"label",label:e._label("zhekoulv"),width:"70",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(r.discount)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("danjia"),width:"100",align:"center",prop:"price"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[a.order?e._e():r("el-input",{attrs:{size:"mini",disabled:e.isDisabled},model:{value:a.price,callback:function(t){e.$set(a,"price",t)},expression:"row.price"}}),e._v(" "),a.order?r("span",[e._v(e._s(a.price))]):e._e()]}}])}),e._v(" "),r("el-table-column",{staticClass:"counter",attrs:{label:e._label("heji"),width:"70",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.count[r.key])+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("zongjia"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.f(e.count[r.key]*r.price))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(r.product.getName())+"\n                    ")]}}])})],1)],1)],1),e._v(" "),r("asa-select-product-dialog",{ref:"products",attrs:{visible:e.pro},on:{"update:visible":function(t){e.pro=t},select:e.onSelectProduct}}),e._v(" "),r("sp-dialog",{ref:"search"},[r("sp-product-search-form",{on:{search:e.search,close:function(t){return e._hideDialog("search")}}})],1),e._v(" "),r("sp-dialog",{ref:"orderpayment",attrs:{width:900}},[r("simple-admin-page",e._b({scopedSlots:e._u([{key:"default",fn:function(e){}}])},"simple-admin-page",e.orderpayment,!1))],1)],1)},o=[],n={render:a,staticRenderFns:o};t.a=n}});
//# sourceMappingURL=7-1014.js.map