webpackJsonp([14],{292:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=r(347),n=r(385),o=r(0),i=o(a.a,n.a,!1,null,null,null);t.default=i.exports},320:function(e,t,r){"use strict";r.d(t,"a",function(){return o});var a=r(183),n=r.n(a),o=function(e){var t={};return{get:function(r){return t[r]||(t[r]=n.a.cloneDeep(e)),t[r]},result:function(){return t}}}},347:function(e,t,r){"use strict";var a=r(6),n=r.n(a),o=r(59),i=r.n(o),l=r(38),s=r.n(l),c=r(39),u=r.n(c),d=r(10),f=r.n(d),p=r(11),m=r.n(p),b=r(26),h=r.n(b),v=r(36),y=(r(1),r(7)),g=r(37),_=r(186),k=r(35),w=r(185),x=r(320);t.a={name:"sp-shippingdetail",components:{},mixins:[_.a],data:function(){return{form:{supplierid:"",finalsupplierid:"",ageseason:"",seasontype:"",property:"",currency:"",bussinesstype:"",warehouseid:"",total:"",exchangerate:"",orderno:"",paydate:"",apickingdate:"",flightno:"",flightdate:"",mblno:"",hblno:"",dispatchport:"",deliveryport:"",box_number:"",weight:"",volume:"",chargedweight:"",transcompany:"",invoiceno:"",aarrivaldate:"",buyerid:"",sellerid:"",transporttype:"",paytype:"",estimatedate:"",maketime:"",makestaff:"",id:"",status:""},formimport:{supplierid:"",ageseason:""},form2:{supplierid:"",keyword:"",keyword1:"",suppliercode1:"",suppliercode:""},tabledata:[],orderbrands:[],orderbranddetails:[],shippingdetails:[],listdata:[],selected:[],selected2:[],uniqkey:1}},methods:{changeDetail:function(e,t){var r=this;"discount"==t?e.discount=e.factoryprice>0?r.f(e.price/e.factoryprice):"":"price"==t&&(e.price=r.f(e.factoryprice*e.discount))},saveOrder:function(){var e=this,t=this,r={form:t.form},a=[],n={},o=!0,i=!1,l=void 0;try{for(var c,d=u()(t.listdata);!(o=(c=d.next()).done);o=!0){var p=c.value,b=function(e){var r=e.key,o=e.sizecontentid,i=e.number;if(i<=0)return"continue";var l=t.tabledata.find(function(e){return e.key==r});console.log(">>>",l,o);var s=t.orderbranddetails.find(function(e){return e.orderbrandid==l.orderbrandid&&e.sizecontentid==o&&e.productid==l.product.id&&e.orderid==l.order.id});if(!s)return{v:void 0};var c=[l.price,l.product.id,l.orderbrandid,o].join("-");if(n[c])return{v:alert(t._label("chongfushezhi")+":"+l.product.getGoodsCode())};a.push({orderid:l.order.id,sizecontentid:o,number:i,productid:l.product.id,discount:l.discount,price:l.price,factoryprice:l.factoryprice,orderdetailid:s.orderdetailid,currencyid:s.currencyid,orderbrandid:l.orderbrandid,orderbranddetailid:s.id,id:""}),n[c]=1}(p);switch(b){case"continue":continue;default:if("object"===(void 0===b?"undefined":s()(b)))return b.v}}}catch(e){i=!0,l=e}finally{try{!o&&d.return&&d.return()}finally{if(i)throw l}}r.list=a,t._log(h()(r),r),t.validate().then(m()(f.a.mark(function a(){var n,o,i;return f.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return t._log(h()(r)),e.next=3,t._submit("/shipping/save",{params:h()(r)});case 3:n=e.sent,o=n.data,i="/shipping/warehousing/"+o.form.id,t._path()!==i?t._redirect(i):Object(y.b)(t.form,o.form);case 7:case"end":return e.stop()}},a,e)})))},onNumberChange:function(e){var t=this,r=!0,a=!1,n=void 0;try{for(var o,i=u()(e);!(r=(o=i.next()).done);r=!0){var l=o.value;!function(e){var r=e.number,a=e.key,n=e.sizecontentid,o=t.listdata.find(function(e){return e.key==a&&e.sizecontentid==n});o?o.number=r:t.listdata.push({key:a,number:r,sizecontentid:n})}(l)}}catch(e){a=!0,n=e}finally{try{!r&&i.return&&i.return()}finally{if(a)throw n}}},copyit:function(e){var t=this,r=Object(y.b)({},e);return S(t).appendRow(r),r},getInit:function(e){var t=this,r=[];return t.listdata.forEach(function(t){var a=t.sizecontentid,n=t.key,o=t.number;n==e&&r.push({sizecontentid:a,number:o})}),r},onSelect:function(e){var t=this;return m()(f.a.mark(function e(){var r,a,n,o,i;return f.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return r=t,e.next=3,v.a.getOrderbrandListToImport(r.formimport);case 3:a=e.sent,n=a.orderbrands,o=a.orderbranddetails,n&&(i=S(r),i.importOrderbrands(n),i.importList(o)),r._hideDialog("order-dialog");case 8:case"end":return e.stop()}},e,t)}))()},getSummary:function(e){var t=e.columns,r=e.data,a=this,n=[];return r=a.orderdetails,t.forEach(function(e,t){if(1==t)return void(n[t]=a._label("heji"));7==t?n[t]=r.reduce(function(e,t){var r=a.count[t.key]||0;return a.f(Number(e)+t.price*r)},0):9==t&&(n[t]=r.reduce(function(e,t){var r=a.count[t.key]||0;return Number(e)+Number(r)},0))}),n[2]=r.length,n},onSelectionChange:function(e){this.selected=e},onRowClick:function(e){this.$refs.table.toggleRowSelection(e)},onSelectionChange2:function(e){this.selected2=e}},computed:{canSave:function(){var e=this;return"2"!=e.form.status&&0!=e.listdata.filter(function(e){return e.number>0}).length},orderdetails:function(){var e=this,t={};e.selected.forEach(function(e){t[e.id]=1});var r=e.form2.keyword.toUpperCase(),a=e.form2.suppliercode.toUpperCase(),n=S(e).isMatch;return e.tabledata.filter(function(e){return 1==t[e.orderbrandid]}).filter(function(e){return n(r,e.product.getGoodsCode(""))&&n(a,e.order.booking_label.toUpperCase())})},width:function(){return 51*this.tabledata.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)+75},count:function(){var e=this,t={};return e.listdata.forEach(function(e){var r=e.key,a=e.number;t[r]||(t[r]=0),t[r]+=Number(a)}),t},countbyid:function(){var e=this,t={};return e.listdata.forEach(function(r){var a=r.key,n=r.number,o=e.tabledata.find(function(e){return e.key==a});a=o.orderbrandid,t[a]=t[a]||0,t[a]+=1*n}),t},total_price:function(){var e=this,t=0;return e.listdata.forEach(function(r){var a=r.key,n=r.number,o=e.tabledata.find(function(e){return e.key==a});t+=o.price*n}),t},orderstat:function(){var e=this,t=Object(x.a)({totalCount:0,totalConfirmCount:0,totoaShippingCount:0,brandCount:0,leftCount:0});return e.orderbrands.forEach(function(e){t.get(e.id)}),e.orderbranddetails.forEach(function(e){var r=t.get(e.orderbrandid);r.totalCount+=1*e.number,r.totalConfirmCount+=1*e.confirm_number,r.totoaShippingCount+=1*e.shipping_number,r.leftCount=r.totalConfirmCount-r.totoaShippingCount}),e.shippingdetails.forEach(function(e){t.get(e.orderbrandid).leftCount+=1*e.number}),t.result()},currentstat:function(){var e=this,t={};return e.orderbrands.forEach(function(e){t[e.id]=0}),e.listdata.forEach(function(r){var a=r.key,n=(r.sizecontentid,r.number),o=e.tabledata.find(function(e){return e.key==a});t[o.orderbrandid]+=1*n}),t},productStat:function(){var e=this,t=Object(x.a)({currencyid:""}),r=!0,a=!1,n=void 0;try{for(var o,i=u()(e.orderbranddetails);!(r=(o=i.next()).done);r=!0){var l=o.value;t.get(l.productid).currencyid=l.currencyid}}catch(e){a=!0,n=e}finally{try{!r&&i.return&&i.return()}finally{if(a)throw n}}return t.result()}},watch:{"form2.keyword1":function(e){this.copyKeywordDebounce()},"form2.suppliercode1":function(e){this.copySuppliercodeDebounce()}},mounted:function(){var e=this;return m()(f.a.mark(function t(){var r,a,n,o,l,s,c,d,p,b,h,g,_,k,x;return f.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(r=e,a=r.$route,r._log(a.params),r.copyKeywordDebounce=Object(w.b)(function(){r.form2.keyword=r.form2.keyword1},1e3,!1),r.copySuppliercodeDebounce=Object(w.b)(function(){r.form2.suppliercode=r.form2.suppliercode1},1e3,!1),a.params.id>0?r._fetch("/shipping/load",{id:a.params.id,type:"shipping"}).then(function(){var e=m()(f.a.mark(function e(t){var a,n,o,i,l,s=t.data;return f.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return a=s.form,n=s.orderbrands,o=s.orderbranddetails,i=s.shippingdetails,l=S(r),Object(y.a)(a,r.form),l.importOrderbrands(n),e.next=6,l.importList(o);case 6:l.importShippingList(i),r._setTitle(r._label("fahuodan")+":"+r.form.orderno),r.$refs.table.toggleAllSelection();case 9:case"end":return e.stop()}},e,this)}));return function(t){return e.apply(this,arguments)}}()):r._setTitle(r._label("shengchengfahuodan")),!(r.$route.query.id&&r.$route.query.id>0)){t.next=38;break}return t.next=9,v.a.getOrderbrandListToImport({orderbrandid:r.$route.query.id});case 9:if(n=t.sent,o=n.orderbrands,l=n.orderbranddetails,!(o.length>0)){t.next=38;break}for(s=S(r),s.importOrderbrands(o),s.importList(l),c=i()(r.orderbrands,1),d=c[0],r.$refs.table.toggleRowSelection(d),p=function(e){var t=e.productid+"-"+e.orderid;setTimeout(function(){r.$refs[t].selectAll()},50)},b=!0,h=!1,g=void 0,t.prev=22,_=u()(l);!(b=(k=_.next()).done);b=!0)x=k.value,p(x);t.next=30;break;case 26:t.prev=26,t.t0=t.catch(22),h=!0,g=t.t0;case 30:t.prev=30,t.prev=31,!b&&_.return&&_.return();case 33:if(t.prev=33,!h){t.next=36;break}throw g;case 36:return t.finish(33);case 37:return t.finish(30);case 38:r.initRules(function(e){var t=r._label;return{warehouseid:e.id({required:!0,message:t("8000"),label:t("daohuocangku")})}});case 39:case"end":return t.stop()}},t,e,[[22,26,30,38],[31,,33,37]])}))()}};var S=function(e){var t={isMatch:function(e,t){return!(e.length>0)||t.toUpperCase().indexOf(e)>=0},convert:function(e){var t=this;return m()(f.a.mark(function r(){var a,o,i,l,s,c,d,p,m,b;return f.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:for(a={},o=!0,i=!1,l=void 0,t.prev=4,s=u()(e);!(o=(c=s.next()).done);o=!0)d=c.value,p=d.productid+"-"+d.orderbrandid,a[p]?(a[p].form[d.sizecontentid]=d.confirm_number-d.shipping_number,a[p].total+=d.confirm_number-d.shipping_number):(m={},m[d.sizecontentid]=d.confirm_number-d.shipping_number,a[p]={key:p,productid:d.productid,orderid:d.orderid,discount:d.discount,total:1*d.number,form:m,orderbrandid:d.orderbrandid,factoryprice:d.factoryprice,price:"",is_auto:!0});t.next=12;break;case 8:t.prev=8,t.t0=t.catch(4),i=!0,l=t.t0;case 12:t.prev=12,t.prev=13,!o&&s.return&&s.return();case 15:if(t.prev=15,!i){t.next=18;break}throw l;case 18:return t.finish(15);case 19:return t.finish(12);case 20:return b=[],Object(g.a)(a).forEach(function(e){var t=Object(k.j)(e);e.orderid>0?t.push(k.b.load({data:e.orderid,depth:1}),"order"):e.order={id:-1},t.push(k.e.load({data:e.productid,depth:1}),"product"),b.push(t.all())}),t.next=24,n.a.all(b);case 24:return t.abrupt("return",t.sent);case 25:case"end":return t.stop()}},r,t,[[4,8,12,20],[13,,15,19]])}))()},appendRow:function(t){t.key=e.uniqkey,e.tabledata.push(t),e.uniqkey++},importList:function(r){var a=this;return m()(f.a.mark(function n(){var o,i,l,s,c,d,p,m,b,h,v,y,g,_,k;return f.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:for(o=[],i=function(t){e.orderbranddetails.find(function(e){return e.id==t.id})||(e.orderbranddetails.push(t),o.push(t)),""==e.form.currency&&t.currencyid>0&&(e.form.currency=t.currencyid)},l=!0,s=!1,c=void 0,a.prev=5,d=u()(r);!(l=(p=d.next()).done);l=!0)m=p.value,i(m);a.next=13;break;case 9:a.prev=9,a.t0=a.catch(5),s=!0,c=a.t0;case 13:a.prev=13,a.prev=14,!l&&d.return&&d.return();case 16:if(a.prev=16,!s){a.next=19;break}throw c;case 19:return a.finish(16);case 20:return a.finish(13);case 21:return a.next=23,t.convert(o);case 23:for(b=a.sent,h=!0,v=!1,y=void 0,a.prev=27,g=u()(b);!(h=(_=g.next()).done);h=!0)k=_.value,k.price=e.f(k.factoryprice*k.discount),t.appendRow(k);a.next=35;break;case 31:a.prev=31,a.t1=a.catch(27),v=!0,y=a.t1;case 35:a.prev=35,a.prev=36,!h&&g.return&&g.return();case 38:if(a.prev=38,!v){a.next=41;break}throw y;case 41:return a.finish(38);case 42:return a.finish(35);case 43:case"end":return a.stop()}},n,a,[[5,9,13,21],[14,,16,20],[27,31,35,43],[36,,38,42]])}))()},importOrderbrands:function(t){var r=!0,a=!1,n=void 0;try{for(var o,i=u()(t);!(r=(o=i.next()).done);r=!0){var l=o.value;!function(t){e.orderbrands.find(function(e){return e.id==t.id})||(e.orderbrands.push(t),Object(y.c)(e.form,t,function(e){var t=e.target,r=e.key;return e.value&&""==t[r]&&("supplierid"==r||"ageseason"==r||"seasontype"==r||"bussinesstype"==r||"currency"==r)}))}(l)}}catch(e){a=!0,n=e}finally{try{!r&&i.return&&i.return()}finally{if(a)throw n}}},importShippingList:function(t){var r={},a={};t.forEach(function(t){if(!(t.orderid<=0)){e.shippingdetails.push(t);var n=e.tabledata.find(function(e){return e.orderbrandid==t.orderbrandid&&e.product.id==t.productid&&e.order.id==t.orderid}),o=t.productid+"-"+t.orderbrandid+"-"+t.price;if(a[o])e.listdata.push({key:a[o],sizecontentid:t.sizecontentid,number:t.number});else if(r[t.productid+"-"+t.orderbrandid]){var i=e.copyit(n);i.price=t.price,i.discount=t.discount,e.listdata.push({key:i.key,sizecontentid:t.sizecontentid,number:t.number}),a[o]=i.key}else n.price=t.price,n.discount=t.discount,e.listdata.push({key:n.key,sizecontentid:t.sizecontentid,number:t.number}),a[o]=n.key,r[t.productid+"-"+t.orderbrandid]=1}})}};return t}},385:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{ref:"order-form",staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini",rules:e.formRules,"inline-message":!1,"show-message":!1}},[r("el-row",{attrs:{gutter:0}},[r("asa-button",{attrs:{enable:e.canSave},on:{click:function(t){return e.saveOrder(1)}}},[e._v(e._s(e._label("baocun")))]),e._v(" "),r("asa-button",{attrs:{enable:"2"!=e.form.status},on:{click:function(t){return e._showDialog("order-dialog")}}},[e._v(e._s(e._label("daorudingdan")))])],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"600px"},attrs:{span:8}},[r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("fahuodanhao")}},[r("el-input",{attrs:{disabled:!0},model:{value:e.form.orderno,callback:function(t){e.$set(e.form,"orderno",t)},expression:"form.orderno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3"},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuodanwei")}},[r("simple-select",{attrs:{source:"supplier_3"},model:{value:e.form.finalsupplierid,callback:function(t){e.$set(e.form,"finalsupplierid",t)},expression:"form.finalsupplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("niandaijijie")}},[r("simple-select",{attrs:{source:"ageseason"},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("niandaileixing")}},[r("simple-select",{attrs:{source:"seasontype"},model:{value:e.form.seasontype,callback:function(t){e.$set(e.form,"seasontype",t)},expression:"form.seasontype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yewuleixing")}},[r("simple-select",{attrs:{source:"bussinesstype"},model:{value:e.form.bussinesstype,callback:function(t){e.$set(e.form,"bussinesstype",t)},expression:"form.bussinesstype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanren")}},[r("sp-display-input",{attrs:{value:e.form.makestaff,source:"user"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("fahuogang")}},[r("el-input",{model:{value:e.form.dispatchport,callback:function(t){e.$set(e.form,"dispatchport",t)},expression:"form.dispatchport"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("daohuogang")}},[r("el-input",{model:{value:e.form.deliveryport,callback:function(t){e.$set(e.form,"deliveryport",t)},expression:"form.deliveryport"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("daohuocangku"),prop:"warehouseid"}},[r("simple-select",{attrs:{source:"warehouse"},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("haiwaifapiaohao")}},[r("el-input",{model:{value:e.form.invoiceno,callback:function(t){e.$set(e.form,"invoiceno",t)},expression:"form.invoiceno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zongjine")}},[r("sp-float-input",{staticClass:"input-with-select",attrs:{select_value:e.total_price,disabled:""}},[r("simple-select",{attrs:{source:"currency",clearable:!1,disabled:""},model:{value:e.form.currency,callback:function(t){e.$set(e.form,"currency",t)},expression:"form.currency"}})],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("huilv")}},[r("sp-float-input",{model:{value:e.form.exchangerate,callback:function(t){e.$set(e.form,"exchangerate",t)},expression:"form.exchangerate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanriqi")}},[r("el-input",{attrs:{value:e.form.maketime,placeholder:e._label("zidonghuoqu"),disabled:""}})],1)],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"600px"},attrs:{span:4}},[r("el-form-item",{staticClass:"twocols",attrs:{label:e._label("beizhu")}},[r("el-input",{staticStyle:{width:"400px"},model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1)],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("fukuanshijian")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.paydate,callback:function(t){e.$set(e.form,"paydate",t)},expression:"form.paydate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhifufangshi")}},[r("simple-select",{attrs:{source:"paytype"},model:{value:e.form.paytype,callback:function(t){e.$set(e.form,"paytype",t)},expression:"form.paytype"}})],1),e._v(" "),r("el-form-item",{staticClass:"mini font12",attrs:{label:e._label("anpaitihuoshijian")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.apickingdate,callback:function(t){e.$set(e.form,"apickingdate",t)},expression:"form.apickingdate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("daokushijian")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.aarrivaldate,callback:function(t){e.$set(e.form,"aarrivaldate",t)},expression:"form.aarrivaldate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xiangshu")}},[r("el-input",{model:{value:e.form.box_number,callback:function(t){e.$set(e.form,"box_number",t)},expression:"form.box_number"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhongliang")}},[r("el-input",{model:{value:e.form.weight,callback:function(t){e.$set(e.form,"weight",t)},expression:"form.weight"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("tiji")}},[r("el-input",{model:{value:e.form.volume,callback:function(t){e.$set(e.form,"volume",t)},expression:"form.volume"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jifeizhongliang")}},[r("el-input",{model:{value:e.form.chargedweight,callback:function(t){e.$set(e.form,"chargedweight",t)},expression:"form.chargedweight"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("kongyunshang")}},[r("simple-select",{attrs:{source:"supplier"},model:{value:e.form.transcompany,callback:function(t){e.$set(e.form,"transcompany",t)},expression:"form.transcompany"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yunshufangshi")}},[r("simple-select",{attrs:{source:"transporttype"},model:{value:e.form.transporttype,callback:function(t){e.$set(e.form,"transporttype",t)},expression:"form.transporttype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("hangbanhao")}},[r("el-input",{model:{value:e.form.flightno,callback:function(t){e.$set(e.form,"flightno",t)},expression:"form.flightno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("hangbanriqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.flightdate,callback:function(t){e.$set(e.form,"flightdate",t)},expression:"form.flightdate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yujidaodariqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.estimatedate,callback:function(t){e.$set(e.form,"estimatedate",t)},expression:"form.estimatedate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhudanhao")}},[r("el-input",{model:{value:e.form.mblno,callback:function(t){e.$set(e.form,"mblno",t)},expression:"form.mblno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zidanhao")}},[r("el-input",{model:{value:e.form.hblno,callback:function(t){e.$set(e.form,"hblno",t)},expression:"form.hblno"}})],1)],1)],1)],1),e._v(" "),r("el-row",[r("el-col",{staticClass:"product",staticStyle:{"margin-top":"2px"},attrs:{span:24}},[r("el-table",{ref:"table",staticStyle:{width:"100%"},attrs:{data:e.orderbrands,stripe:"",border:""},on:{"selection-change":e.onSelectionChange,"row-click":e.onRowClick}},[r("el-table-column",{attrs:{type:"selection",width:30,align:"center"}}),e._v(" "),r("el-table-column",{attrs:{prop:"orderno",label:e._label("dingdanbianhao"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-order-tip",{attrs:{column:"orderno",order:t,trigger:"hover"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("gonghuoshang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.supplierid,source:"supplier"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dinghuoshuliang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                           "+e._s(e.orderstat[r.id].totalCount)+"\n                       ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("querenshuliang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                           "+e._s(e.orderstat[r.id].totalConfirmCount)+"\n                       ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shengyushuliang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                           "+e._s(e.orderstat[r.id].leftCount-e.currentstat[r.id])+"\n                       ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("fahuoshuliang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                           "+e._s(e.currentstat[r.id]||0)+"\n                       ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("niandai"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.ageseason,source:"ageseason"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("bizhong"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.currency,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"discount",label:e._label("zhekoulv"),width:"90",align:"center"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("yewuleixing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.bussinesstype,source:"bussinesstype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dingdanriqi"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                           "+e._s(r.maketime&&r.maketime.length>0?r.maketime.substr(0,10):"")+"\n                       ")]}}])})],1),e._v(" "),r("el-row",{attrs:{gutter:0}}),e._v(" "),r("el-row",{staticClass:"product clearpadding",staticStyle:{"margin-top":"3px"},attrs:{gutter:0}},[r("el-table",{ref:"tabledetail",staticStyle:{width:"100%"},attrs:{data:e.orderdetails,stripe:"",border:"","show-summary":!0,"summary-method":e.getSummary},on:{"selection-change":e.onSelectionChange2}},[r("el-table-column",{attrs:{type:"selection",width:30,align:"center"}}),e._v(" "),r("el-table-column",{attrs:{align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("img",{staticStyle:{width:"50px",height:"50px"},attrs:{src:e._fileLink(t.row.product.picture)}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dinghuokehu"),align:"center",width:"150"}},[r("el-table-column",{attrs:{label:e._label("dinghuokehu"),align:"center",width:"150"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-order-tip",{attrs:{column:"booking_label",order:t.order}})]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.suppliercode1,callback:function(t){e.$set(e.form2,"suppliercode1",t)},expression:"form2.suppliercode1"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"}},[r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){return[r("sp-product-tip",{attrs:{product:e.row.product}})]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.keyword1,callback:function(t){e.$set(e.form2,"keyword1",t)},expression:"form2.keyword1"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("bizhong"),width:"60",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("sp-select-text",{attrs:{value:e.productStat[a.productid].currencyid,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("asa-order-input",{attrs:{size:"mini"},on:{change:function(t){return e.changeDetail(a,"price")}},model:{value:a.factoryprice,callback:function(t){e.$set(a,"factoryprice",t)},expression:"row.factoryprice"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chengjiaojia"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("asa-order-input",{attrs:{size:"mini"},on:{change:function(t){return e.changeDetail(a,"discount")}},model:{value:a.price,callback:function(t){e.$set(a,"price",t)},expression:"row.price"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("zongjia"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                               "+e._s(e.f(r.price*e.count[r.key]||0))+"\n                           ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhekoulv"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("asa-order-input",{attrs:{size:"mini"},on:{change:function(t){return e.changeDetail(a,"price")}},model:{value:a.discount,callback:function(t){e.$set(a,"discount",t)},expression:"row.discount"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"number",label:e._label("dinggoushuliang"),align:"center",width:e.width},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("sp-sizecontent-confirm4",{key:a.key,ref:a.product.id+"-"+a.order.id,attrs:{columns:a.product.sizecontents,head:a.form,uniq:a.key,data:e.getInit(a.key)},on:{change:e.onNumberChange}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("el-popover",{attrs:{placement:"right",width:"60",trigger:"hover"}},[r("el-button",{attrs:{size:"mini",type:"primary"},on:{click:function(t){return e.copyit(a)}}},[e._v(e._s(e._label("fuzhi")))]),e._v(" "),r("span",{attrs:{slot:"reference"},slot:"reference"},[e._v(e._s(a.product.getName()))])],1)]}}])})],1)],1)],1)],1),e._v(" "),r("sp-dialog",{ref:"order-dialog",attrs:{"min-height":50}},[r("el-form",{staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!1,size:"mini"}},[r("el-row",{attrs:{gutter:0}},[r("el-form-item",{attrs:{label:e._label("niandai")}},[r("simple-select",{attrs:{source:"ageseason"},model:{value:e.formimport.ageseason,callback:function(t){e.$set(e.formimport,"ageseason",t)},expression:"formimport.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3"},model:{value:e.formimport.supplierid,callback:function(t){e.$set(e.formimport,"supplierid",t)},expression:"formimport.supplierid"}})],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{attrs:{align:"center"}},[r("as-button",{attrs:{auth:"product",type:"primary"},on:{click:e.onSelect}},[e._v(e._s(e._label("daorudingdan")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("order-dialog")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)],1)},n=[],o={render:a,staticRenderFns:n};t.a=o}});
//# sourceMappingURL=14-1037.js.map