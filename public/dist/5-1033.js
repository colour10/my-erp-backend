webpackJsonp([5],{290:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=r(342),n=r(379),o=r(0),i=o(a.a,n.a,!1,null,null,null);t.default=i.exports},317:function(e,t,r){"use strict";r.d(t,"a",function(){return o});var a=r(182),n=r.n(a),o=function(e){var t={};return{get:function(r){return t[r]||(t[r]=n.a.cloneDeep(e)),t[r]},result:function(){return t}}}},318:function(e,t,r){"use strict";t.__esModule=!0;var a=r(322),n=function(e){return e&&e.__esModule?e:{default:e}}(a);t.default=function(e){if(Array.isArray(e)){for(var t=0,r=Array(e.length);t<e.length;t++)r[t]=e[t];return r}return(0,n.default)(e)}},322:function(e,t,r){e.exports={default:r(323),__esModule:!0}},323:function(e,t,r){r(27),r(324),e.exports=r(2).Array.from},324:function(e,t,r){"use strict";var a=r(28),n=r(9),o=r(39),i=r(75),l=r(76),s=r(57),c=r(325),u=r(58);n(n.S+n.F*!r(77)(function(e){Array.from(e)}),"Array",{from:function(e){var t,r,n,d,f=o(e),p="function"==typeof this?this:Array,m=arguments.length,b=m>1?arguments[1]:void 0,h=void 0!==b,v=0,_=u(f);if(h&&(b=a(b,m>2?arguments[2]:void 0,2)),void 0==_||p==Array&&l(_))for(t=s(f.length),r=new p(t);t>v;v++)c(r,v,h?b(f[v],v):f[v]);else for(d=_.call(f),r=new p;!(n=d.next()).done;v++)c(r,v,h?i(d,b,[n.value,v],!0):n.value);return r.length=v,r}})},325:function(e,t,r){"use strict";var a=r(10),n=r(29);e.exports=function(e,t,r){t in e?a.f(e,t,n(0,r)):e[t]=r}},326:function(e,t,r){"use strict";var a=r(12),n=r.n(a),o=r(318),i=r.n(o),l=r(13),s=r.n(l);t.a={name:"sp-orderbrand-list",props:{orderid:{},shippingid:{}},data:function(){return{tabledata:[]}},methods:{openit:function(e){this._open("/orderbrand/"+e)},show:function(){var e=this;return s()(n.a.mark(function t(){var r,a,o,l,s,c,u;return n.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(r=e,!r.orderid){t.next=10;break}return t.next=4,r._fetch("/order/orderbrandlist",{id:r.orderid});case 4:o=t.sent,l=o.data,r.tabledata=[],(a=r.tabledata).push.apply(a,i()(l)),t.next=16;break;case 10:return t.next=12,r._fetch("/shipping/orderbrandlist",{id:r.shippingid});case 12:c=t.sent,u=c.data,r.tabledata=[],(s=r.tabledata).push.apply(s,i()(u));case 16:r._showDialog("dialog");case 17:case"end":return t.stop()}},t,e)}))()}}}},331:function(e,t,r){"use strict";var a=r(326),n=r(332),o=r(0),i=o(a.a,n.a,!1,null,null,null);t.a=i.exports},332:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("sp-dialog",{ref:"dialog",staticClass:"product clearpadding",attrs:{width:"1200"}},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,stripe:"",border:""}},[r("el-table-column",{attrs:{label:e._label("gongsidingdanhao"),align:"center",width:"130"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("el-button",{on:{click:function(t){return e.openit(a.id)}}},[e._v(e._s(a.orderno))])]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("gonghuoshang"),align:"center",width:"100"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;e.$index;return[r("sp-select-text",{attrs:{value:t.supplierid,source:"supplier"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("niandaijijie"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.ageseason,source:"ageseason"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("yewuleixing"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.bussinesstype,source:"bussinesstype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("bizhong"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.currency,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zongjine"),width:"80",align:"center",prop:"total_discount_price"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zongjianshu"),width:"80",align:"center",prop:"total_number"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhekoulv"),width:"80",align:"center",prop:"discount"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("tuishuilv"),width:"80",align:"center",prop:"taxrebate"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("edu"),width:"80",align:"center",prop:"quantum"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dingdanriqi"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                "+e._s(r.maketime&&r.maketime.length>0?r.maketime.substr(0,10):"")+"\n            ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("pinpai"),width:"150"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.brandid,source:"brand"}})]}}])})],1)],1)},n=[],o={render:a,staticRenderFns:n};t.a=o},342:function(e,t,r){"use strict";var a=r(318),n=r.n(a),o=r(5),i=r.n(o),l=r(18),s=r.n(l),c=r(55),u=r.n(c),d=r(26),f=r.n(d),p=r(12),m=r.n(p),b=r(13),h=r.n(b),v=r(181),_=r.n(v),y=r(36),g=r(1),w=r(7),k=r(37),x=r(185),$=r(35),S=r(184),z=r(317),j=r(331),C={name:"sp-warehousing",components:_()({},j.a.name,j.a),mixins:[x.a],data:function(){var e=this,t=e._label;return{form:{supplierid:"",finalsupplierid:"",ageseason:"",seasontype:"",property:"",currency:"",bussinesstype:"",warehouseid:"",total:"",exchangerate:"",orderno:"",paydate:"",dd_company:"",apickingdate:"",flightno:"",flightdate:"",mblno:"",hblno:"",dispatchport:"",deliveryport:"",box_number:"",weight:"",volume:"",chargedweight:"",transcompany:"",invoiceno:"",aarrivaldate:"",buyerid:"",sellerid:"",transporttype:"",paytype:"",estimatedate:"",maketime:"",makestaff:"",id:"",status:""},form2:{supplierid:"",keyword:"",keyword1:"",suppliercode1:"",suppliercode:""},tabledata:[],shippingdetails:[],orderbranddetails:[],listdata:[],costs:[],uniqkey:1,visible:!1,pro:!1,orderpayment:{columns:[{name:"feenameid",label:t("feiyongmingcheng"),type:"select",source:"feename",width:110},{name:"currencyid",label:t("bizhong"),type:"select",source:"currency",width:90},{name:"amount",label:t("jine"),width:110},{name:"exchangerate",label:t("huilv"),width:110},{name:"memo",label:t("beizhu"),width:110},{name:"makestaff",label:t("tijiaoren"),type:"select",source:"user",is_edit_hide:!0,width:110}],controller:"shippingfee",auth:"shippingfee",base:{shippingid:""},options:{isedit:function(t){return e.form.status>0&&"3"!=e.form.status},isdelete:function(t){return e.form.status>0&&"3"!=e.form.status},isAdd:function(){return e.form.status>0&&"3"!=e.form.status},isSearch:!1,isAutoReload:!0}}}},methods:{loadDetail:function(){var e=this;D(e).loadDetail(e.$route.params.id)},loadExchangerate:function(e,t){var r=this;return h()(m.a.mark(function a(){var n,o;return m.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return n=r,console.log(e,t),e.exchangerate="",a.next=5,y.a.getExchange(e.currencyid,n.form.currency);case 5:o=a.sent,""==e.exchangerate&&(e.exchangerate=o);case 7:case"end":return a.stop()}},a,r)}))()},showPayment:function(){var e=this;e.orderpayment.base.shippingid=e.form.id,e._showDialog("orderpayment")},onSelectProduct:function(e){D(this).appendRow({productid:e.id,product:e,discount:1,price:"",form:{}})},onNumberChange:function(e){var t=this;e.forEach(function(e){var r=e.number,a=e.key,n=e.sizecontentid,o=t.listdata.find(function(e){return e.key==a&&e.sizecontentid==n});o?o.number=r:t.listdata.push({key:a,number:r,sizecontentid:n})})},search:function(e){var t=this;t.pro=!0,t.$refs.products.search(e)},saveInfo:function(){var e=this;e._submit("/shipping/saveinfo",e.form).then(function(t){D(e).loadDetail(e.$route.params.id)})},confirmShipping:function(e){var t=this;if(confirm(t._label("confirm-ruku"))){var r={form:t.form},a=!0,n=[];t.listdata.forEach(function(e){var r=e.key,o=e.sizecontentid,i=e.number;if(!(i<=0)){var l=t.tabledata.find(function(e){return e.key==r}),s=t.shippingdetails.find(function(e){return e.productid==l.product.id&&e.orderid==l.orderid&&e.sizecontentid==o&&e.orderbrandid==l.orderbrandid});l.price<=0&&(alert(t._label("tip-jiagebunengweikong")),a=!1),n.push({sizecontentid:o,number:i,productid:l.product.id,discount:l.discount,price:l.price,id:s?s.id:0})}}),r.list=n,t._log(f()(r)),t._submit("/shipping/confirm",{params:f()(r)}).then(function(e){D(t).loadDetail(t.$route.params.id)})}},warehousing:function(){var e=this;confirm(e._label("quxiaorukutishi"))&&e._submit("/shipping/warehousing",e.form).then(function(t){D(e).loadDetail(e.$route.params.id)})},cancelWarehousing:function(){var e=this;confirm(e._label("quxiaorukutishi"))&&e._submit("/shipping/cancel",{id:e.form.id}).then(function(t){D(e).loadDetail(e.$route.params.id)})},cancelConfirm:function(){var e=this;confirm(e._label("quxiaorukutishi"))&&e._submit("/shipping/cancelconfirm",{id:e.form.id}).then(function(t){D(e).loadDetail(e.$route.params.id)})},getInit:function(e){var t=[];return this.listdata.forEach(function(r){var a=r.sizecontentid,n=r.number,o=r.key;e==o&&t.push({sizecontentid:a,number:n})}),t},deleteOrder:function(){var e=this;e.form.id&&e._remove("/confirmorder/delete",{id:e.form.id}).then(function(t){e.$emit("change",e.form,"delete")})},onChange:function(e){var t=e.row,r=e.form,a=e.total;t.form=r,t.confirm_total=a},onSelect:function(e){D(this).appendRow({source:e,id:"",price:e.price})},getSummary:function(e){var t=e.columns,r=e.data,a=this,n=[];return t.forEach(function(e,t){if(0==t)return void(n[t]=a._label("heji"));5==t||9==t?n[t]=r.reduce(function(e,t){return e+a.count[t.key]},0):10==t?n[t]=a.total_price:11==t?n[t]=a.shippingdetails.reduce(function(e,t){return e+1*t.number},0):12==t&&(n[t]=a.shippingdetails.reduce(function(e,t){return e+t.number*t.price},0),n[t]=a.f(n[t]))}),n[2]=r.length,n}},computed:{isAddFee:function(){return"3"!=this.form.status},orderdetails:function(){var e=this,t=e.form2.keyword.toUpperCase(),r=e.form2.suppliercode.toUpperCase(),a=D(e).isMatch;return e.tabledata.filter(function(n){return e._log(n,t,r),a(t,n.product.getGoodsCode(""))&&(n.order&&a(r,n.order.booking_label.toUpperCase())||!n.order&&!r)})},width:function(){return 51*this.tabledata.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)+75},count:function(){var e=this,t={};return e.tabledata.forEach(function(e){return t[e.key]=0}),e.listdata.forEach(function(e){var r=e.key,a=e.number;t[r]+=1*a}),t},shippingCount:function(){var e=this,t=e._newbox(),r=!0,a=!1,n=void 0;try{for(var o,i=u()(e.tabledata);!(r=(o=i.next()).done);r=!0){var l=o.value;t[l.key]=0;var c=!0,d=!1,f=void 0;try{for(var p,m=u()(s()(l.form));!(c=(p=m.next()).done);c=!0){var b=p.value;t[l.key]+=1*l.form[b]}}catch(e){d=!0,f=e}finally{try{!c&&m.return&&m.return()}finally{if(d)throw f}}}}catch(e){a=!0,n=e}finally{try{!r&&i.return&&i.return()}finally{if(a)throw n}}return t},total_price:function(){var e=this,t=0;return e.listdata.forEach(function(r){var a=r.key,n=r.number,o=e.tabledata.find(function(e){return e.key==a});t+=o.price*n}),e.f(t)},productStat:function(){var e=this,t=Object(z.a)({factoryprice:0,wordprice:0,currencyid:"",total:0});return e.tabledata.forEach(function(e){var r=e.product,a=t.get(r.id);a.factoryprice=r.factoryprice,a.wordprice=r.wordprice,a.currencyid=r.factorypricecurrency}),e.orderbranddetails.forEach(function(e){var r=t.get(e.productid);r.factoryprice=e.factoryprice,r.wordprice=e.wordprice,r.currencyid=e.currencyid}),t.result()},isDisabled:function(){return"1"!=this.form.status},costPrice:function(){var e=this,t={};return e.tabledata.forEach(function(e){t[e.product.id]=e.price}),e.costs.forEach(function(r){t[r.productid]=e.f(r.amount/r.number)}),t}},watch:{"form2.keyword1":function(e){this.copyKeywordDebounce()},"form2.suppliercode1":function(e){this.copySuppliercodeDebounce()}},mounted:function(){var e=this;e.copyKeywordDebounce=Object(S.b)(function(){e.form2.keyword=e.form2.keyword1},1e3,!1),e.copySuppliercodeDebounce=Object(S.b)(function(){e.form2.suppliercode=e.form2.suppliercode1},1e3,!1),D(e).loadDetail(e.$route.params.id)}},D=function(e){var t,r=(t={isMatch:function(e,t){return!(e.length>0)||t.toUpperCase().indexOf(e)>=0},appendRow:function(t){t.key=g.c.random(10),e.tabledata.unshift(t),e.form.currency=e.productStat[t.product.id].currencyid},convert:function(e){var t=this;return h()(m.a.mark(function r(){var a,n;return m.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return a={},e.forEach(function(e){var t=e.price+"-"+e.productid+"-"+e.orderid;if(a[t])a[t].form[e.sizecontentid]=e.number,a[t].total+=e.number;else{var r={};r[e.sizecontentid]=e.number,a[t]={key:t,productid:e.productid,orderbrandid:e.orderbrandid,orderid:e.orderid,discount:e.discount,total:1*e.number,form:r,price:e.price}}}),n=[],Object(k.a)(a).forEach(function(e){var t=Object($.j)(e);e.orderid>0&&t.push($.b.load({data:e.orderid,depth:1}),"order"),t.push($.e.load({data:e.productid,depth:1}),"product"),n.push(t.all())}),t.next=6,i.a.all(n);case 6:return t.abrupt("return",t.sent);case 7:case"end":return t.stop()}},r,t)}))()}},_()(t,"appendRow",function(t){t.key=e.uniqkey,e.tabledata.push(t),e.uniqkey++}),_()(t,"importList",function(t){var a=this;return h()(m.a.mark(function o(){var i,l,s,c,d,f,p,b,h,v,_,y,g,w,k;return m.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return e.shippingdetails=[],e.tabledata=[],e.listdata=[],(i=e.shippingdetails).push.apply(i,n()(t)),a.next=6,r.convert(t);case 6:for(l=a.sent,s=!0,c=!1,d=void 0,a.prev=10,f=u()(l);!(s=(p=f.next()).done);s=!0)b=p.value,r.appendRow(b);a.next=18;break;case 14:a.prev=14,a.t0=a.catch(10),c=!0,d=a.t0;case 18:a.prev=18,a.prev=19,!s&&f.return&&f.return();case 21:if(a.prev=21,!c){a.next=24;break}throw d;case 24:return a.finish(21);case 25:return a.finish(18);case 26:for(h=function(t){var r=e.tabledata.find(function(e){return e.productid==t.productid&&e.price==t.price&&e.orderid==t.orderid});e.listdata.push({key:r.key,sizecontentid:t.sizecontentid,number:t.warehousingnumber})},v=!0,_=!1,y=void 0,a.prev=30,g=u()(t);!(v=(w=g.next()).done);v=!0)k=w.value,h(k);a.next=38;break;case 34:a.prev=34,a.t1=a.catch(30),_=!0,y=a.t1;case 38:a.prev=38,a.prev=39,!v&&g.return&&g.return();case 41:if(a.prev=41,!_){a.next=44;break}throw y;case 44:return a.finish(41);case 45:return a.finish(38);case 46:case"end":return a.stop()}},o,a,[[10,14,18,26],[19,,21,25],[30,34,38,46],[39,,41,45]])}))()}),_()(t,"loadDetail",function(t){e._setTitle("Loading..."),e._fetch("/shipping/load",{id:t}).then(function(){var t=h()(m.a.mark(function t(a){var n,o,i,l,s,c=a.data;return m.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:n=c.form,o=c.orderbrands,i=c.orderbranddetails,l=c.shippingdetails,s=c.costs,Object(w.a)(n,e.form),r.importList(l),e.orderbranddetails=i,s&&(e.costs=[],Object(k.a)(s).forEach(function(t){e.costs.push(t)})),e._setTitle(e._label("fahuodanruku")+":"+e.form.orderno);case 6:case"end":return t.stop()}},t,this)}));return function(e){return t.apply(this,arguments)}}())}),t);return r};t.a=C},379:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini"}},[r("el-row",{attrs:{gutter:0}},[r("asa-button",{attrs:{enable:e.form.status>0},on:{click:function(t){return e.saveInfo()}}},[e._v(e._s(e._label("baocunxinxi")))]),e._v(" "),r("asa-button",{attrs:{enable:"1"==e.form.status},on:{click:function(t){return e.confirmShipping()}}},[e._v(e._s(e._label("querenruku")))]),e._v(" "),r("asa-button",{attrs:{enable:"1"==e.form.status},on:{click:function(t){e.pro=!0}}},[e._v(e._s(e._label("xuanzeshangpin")))]),e._v(" "),r("asa-button",{attrs:{enable:"2"==e.form.status},on:{click:function(t){return e.cancelConfirm()}}},[e._v(e._s(e._label("quxiaoqueren")))]),e._v(" "),r("asa-button",{attrs:{enable:"2"==e.form.status},on:{click:function(t){return e.warehousing()}}},[e._v(e._s(e._label("feiyongshuqi")))]),e._v(" "),r("asa-button",{attrs:{enable:"3"==e.form.status},on:{click:function(t){return e.cancelWarehousing()}}},[e._v(e._s(e._label("quxiao")))]),e._v(" "),r("asa-button",{attrs:{enable:e.form.status>0},on:{click:function(t){return e.showPayment()}}},[e._v(e._s(e._label("feiyong")))]),e._v(" "),r("asa-button",{attrs:{enable:e.form.id>0},on:{click:function(t){return e.$refs.qiancha.show()}}},[e._v(e._s(e._label("qiancha")))])],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"600px"},attrs:{span:8}},[r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("fahuodanhao")}},[r("el-input",{attrs:{disabled:!0},model:{value:e.form.orderno,callback:function(t){e.$set(e.form,"orderno",t)},expression:"form.orderno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3"},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuodanwei")}},[r("simple-select",{attrs:{source:"supplier_3"},model:{value:e.form.finalsupplierid,callback:function(t){e.$set(e.form,"finalsupplierid",t)},expression:"form.finalsupplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("niandaijijie")}},[r("simple-select",{attrs:{source:"ageseason"},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("niandaileixing")}},[r("simple-select",{attrs:{source:"seasontype"},model:{value:e.form.seasontype,callback:function(t){e.$set(e.form,"seasontype",t)},expression:"form.seasontype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yewuleixing")}},[r("simple-select",{attrs:{source:"bussinesstype"},model:{value:e.form.bussinesstype,callback:function(t){e.$set(e.form,"bussinesstype",t)},expression:"form.bussinesstype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanren")}},[r("sp-display-input",{attrs:{value:e.form.makestaff,source:"user"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("fahuogang")}},[r("el-input",{model:{value:e.form.dispatchport,callback:function(t){e.$set(e.form,"dispatchport",t)},expression:"form.dispatchport"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("daohuogang")}},[r("el-input",{model:{value:e.form.deliveryport,callback:function(t){e.$set(e.form,"deliveryport",t)},expression:"form.deliveryport"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("daohuocangku")}},[r("simple-select",{attrs:{source:"warehouse"},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("haiwaifapiaohao")}},[r("el-input",{model:{value:e.form.invoiceno,callback:function(t){e.$set(e.form,"invoiceno",t)},expression:"form.invoiceno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zongjine")}},[r("sp-float-input",{staticClass:"input-with-select",attrs:{placeholder:"",select_value:e.total_price,disabled:""}},[r("simple-select",{attrs:{source:"currency",clearable:!1,disabled:""},model:{value:e.form.currency,callback:function(t){e.$set(e.form,"currency",t)},expression:"form.currency"}})],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("huilv")}},[r("sp-float-input",{attrs:{disabled:"3"==e.form.status},model:{value:e.form.exchangerate,callback:function(t){e.$set(e.form,"exchangerate",t)},expression:"form.exchangerate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanriqi")}},[r("el-input",{attrs:{value:e.form.maketime,placeholder:e._label("zidonghuoqu"),disabled:""}})],1)],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"600px"},attrs:{span:4}},[r("el-form-item",{staticClass:"twocols",attrs:{label:e._label("beizhu")}},[r("el-input",{staticStyle:{width:"400px"},model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1)],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("fukuanshijian")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.paydate,callback:function(t){e.$set(e.form,"paydate",t)},expression:"form.paydate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhifufangshi")}},[r("simple-select",{attrs:{source:"paytype"},model:{value:e.form.paytype,callback:function(t){e.$set(e.form,"paytype",t)},expression:"form.paytype"}})],1),e._v(" "),r("el-form-item",{staticClass:"mini font12",attrs:{label:e._label("anpaitihuoshijian")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.apickingdate,callback:function(t){e.$set(e.form,"apickingdate",t)},expression:"form.apickingdate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("daokushijian")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.aarrivaldate,callback:function(t){e.$set(e.form,"aarrivaldate",t)},expression:"form.aarrivaldate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xiangshu")}},[r("el-input",{model:{value:e.form.box_number,callback:function(t){e.$set(e.form,"box_number",t)},expression:"form.box_number"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhongliang")}},[r("el-input",{model:{value:e.form.weight,callback:function(t){e.$set(e.form,"weight",t)},expression:"form.weight"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("tiji")}},[r("el-input",{model:{value:e.form.volume,callback:function(t){e.$set(e.form,"volume",t)},expression:"form.volume"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jifeizhongliang")}},[r("el-input",{model:{value:e.form.chargedweight,callback:function(t){e.$set(e.form,"chargedweight",t)},expression:"form.chargedweight"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("kongyunshang")}},[r("simple-select",{attrs:{source:"supplier"},model:{value:e.form.transcompany,callback:function(t){e.$set(e.form,"transcompany",t)},expression:"form.transcompany"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yunshufangshi")}},[r("simple-select",{attrs:{source:"transporttype"},model:{value:e.form.transporttype,callback:function(t){e.$set(e.form,"transporttype",t)},expression:"form.transporttype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("hangbanhao")}},[r("el-input",{model:{value:e.form.flightno,callback:function(t){e.$set(e.form,"flightno",t)},expression:"form.flightno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("hangbanriqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.flightdate,callback:function(t){e.$set(e.form,"flightdate",t)},expression:"form.flightdate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yujidaodariqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.estimatedate,callback:function(t){e.$set(e.form,"estimatedate",t)},expression:"form.estimatedate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhudanhao")}},[r("el-input",{model:{value:e.form.mblno,callback:function(t){e.$set(e.form,"mblno",t)},expression:"form.mblno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zidanhao")}},[r("el-input",{model:{value:e.form.hblno,callback:function(t){e.$set(e.form,"hblno",t)},expression:"form.hblno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("beizhu")}},[r("el-input",{model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1)],1)],1),e._v(" "),r("el-row",[r("el-col",{staticClass:"product",attrs:{span:24}},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.orderdetails,stripe:"",border:"","show-summary":!0,"summary-method":e.getSummary}},[r("el-table-column",{attrs:{align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("img",{staticStyle:{width:"50px",height:"50px"},attrs:{src:e._fileLink(a.product.picture)}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dinghuokehu"),align:"center",width:"150"}},[r("el-table-column",{attrs:{label:e._label("dinghuokehu"),align:"center",width:"150"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[a.order?r("sp-order-tip",{attrs:{column:"booking_label",order:a.order}}):e._e()]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.suppliercode1,callback:function(t){e.$set(e.form2,"suppliercode1",t)},expression:"form2.suppliercode1"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"}},[r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){return[r("sp-product-tip",{attrs:{product:e.row.product}})]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.keyword1,callback:function(t){e.$set(e.form2,"keyword1",t)},expression:"form2.keyword1"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("bizhong"),width:"60",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("sp-select-text",{attrs:{value:e.productStat[a.productid].currencyid,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.productStat[r.product.id].factoryprice)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"number",label:e._label("dinggoushuliang"),align:"center",width:e.width},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;t.$index;return[r("sp-sizecontent-confirm4",{key:a.key,attrs:{columns:a.product.sizecontents,head:a.form,uniq:a.key,data:e.getInit(a.key),disabled:e.isDisabled},on:{change:e.onNumberChange}})]}}])}),e._v(" "),r("el-table-column",{staticClass:"counter",attrs:{prop:"label",label:e._label("zhekoulv"),width:"70",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(r.discount)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chengjiaojia"),width:"100",align:"center",prop:"price"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[a.order?e._e():r("el-input",{attrs:{size:"mini",disabled:e.isDisabled},model:{value:a.price,callback:function(t){e.$set(a,"price",t)},expression:"row.price"}}),e._v(" "),a.order?r("span",[e._v(e._s(a.price))]):e._e()]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chengben"),width:"100",align:"center",prop:"price"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[a.order?r("span",[e._v(e._s(e.costPrice[a.product.id]))]):e._e()]}}])}),e._v(" "),r("el-table-column",{staticClass:"counter",attrs:{label:e._label("rukuheji"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.count[r.key])+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("rukuzongjia"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.f(e.count[r.key]*r.price))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{staticClass:"counter",attrs:{label:e._label("fahuoheji"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.shippingCount[r.key])+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("fahuozongjia"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.f(e.shippingCount[r.key]*r.price))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(r.product.getName())+"\n                    ")]}}])})],1)],1)],1),e._v(" "),r("asa-select-product-dialog",{ref:"products",attrs:{visible:e.pro},on:{"update:visible":function(t){e.pro=t},select:e.onSelectProduct}}),e._v(" "),r("sp-dialog",{ref:"search"},[r("sp-product-search-form",{on:{search:e.search,close:function(t){return e._hideDialog("search")}}})],1),e._v(" "),r("sp-dialog",{ref:"orderpayment",attrs:{width:900}},[r("simple-admin-page",e._b({on:{"after-update":e.loadDetail,"after-delete":e.loadDetail},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.form;return[r("el-form",{ref:"form",staticClass:"user-form",attrs:{model:a,"label-width":"100px",inline:!0,size:"mini"}},[r("el-form-item",{attrs:{label:e._label("feiyongmingcheng")}},[r("simple-select",{staticClass:"width2",attrs:{source:"feename"},model:{value:a.feenameid,callback:function(t){e.$set(a,"feenameid",t)},expression:"form.feenameid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("bizhong")}},[r("simple-select",{staticClass:"width2",attrs:{source:"currency"},on:{change:function(t){return e.loadExchangerate(a,t)}},model:{value:a.currencyid,callback:function(t){e.$set(a,"currencyid",t)},expression:"form.currencyid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jine")}},[r("el-input",{staticClass:"width2",attrs:{size:"mini"},model:{value:a.amount,callback:function(t){e.$set(a,"amount",t)},expression:"form.amount"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("huilv")}},[r("el-input",{staticClass:"width2",attrs:{size:"mini"},model:{value:a.exchangerate,callback:function(t){e.$set(a,"exchangerate",t)},expression:"form.exchangerate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("beizhu")}},[r("el-input",{staticClass:"width2",attrs:{size:"mini"},model:{value:a.memo,callback:function(t){e.$set(a,"memo",t)},expression:"form.memo"}})],1)],1)]}}])},"simple-admin-page",e.orderpayment,!1))],1),e._v(" "),r("sp-orderbrand-list",{ref:"qiancha",attrs:{shippingid:e.form.id}})],1)},n=[],o={render:a,staticRenderFns:n};t.a=o}});
//# sourceMappingURL=5-1033.js.map