webpackJsonp([5],{311:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=r(369),n=r(420),i=r(0),o=i(a.a,n.a,!1,null,null,null);t.default=o.exports},315:function(e,t,r){"use strict";r.d(t,"a",function(){return i});var a=r(182),n=r.n(a),i=function(e){var t={};return{get:function(r){return t[r]||(t[r]=n.a.cloneDeep(e)),t[r]},result:function(){return t}}}},316:function(e,t,r){"use strict";t.__esModule=!0;var a=r(321),n=function(e){return e&&e.__esModule?e:{default:e}}(a);t.default=function(e){if(Array.isArray(e)){for(var t=0,r=Array(e.length);t<e.length;t++)r[t]=e[t];return r}return(0,n.default)(e)}},321:function(e,t,r){e.exports={default:r(322),__esModule:!0}},322:function(e,t,r){r(27),r(323),e.exports=r(2).Array.from},323:function(e,t,r){"use strict";var a=r(28),n=r(9),i=r(39),o=r(75),l=r(76),s=r(57),u=r(324),c=r(58);n(n.S+n.F*!r(77)(function(e){Array.from(e)}),"Array",{from:function(e){var t,r,n,d,f=i(e),p="function"==typeof this?this:Array,b=arguments.length,m=b>1?arguments[1]:void 0,h=void 0!==m,v=0,_=c(f);if(h&&(m=a(m,b>2?arguments[2]:void 0,2)),void 0==_||p==Array&&l(_))for(t=s(f.length),r=new p(t);t>v;v++)u(r,v,h?m(f[v],v):f[v]);else for(d=_.call(f),r=new p;!(n=d.next()).done;v++)u(r,v,h?o(d,m,[n.value,v],!0):n.value);return r.length=v,r}})},324:function(e,t,r){"use strict";var a=r(10),n=r(29);e.exports=function(e,t,r){t in e?a.f(e,t,n(0,r)):e[t]=r}},325:function(e,t,r){"use strict";var a=r(12),n=r.n(a),i=r(316),o=r.n(i),l=r(13),s=r.n(l);t.a={name:"sp-orderbrand-list",props:{orderid:{},shippingid:{}},data:function(){return{tabledata:[]}},methods:{openit:function(e){this._open("/orderbrand/"+e)},show:function(){var e=this;return s()(n.a.mark(function t(){var r,a,i,l,s,u,c;return n.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(r=e,!r.orderid){t.next=10;break}return t.next=4,r._fetch("/order/orderbrandlist",{id:r.orderid});case 4:i=t.sent,l=i.data,r.tabledata=[],(a=r.tabledata).push.apply(a,o()(l)),t.next=16;break;case 10:return t.next=12,r._fetch("/shipping/orderbrandlist",{id:r.shippingid});case 12:u=t.sent,c=u.data,r.tabledata=[],(s=r.tabledata).push.apply(s,o()(c));case 16:r._showDialog("dialog");case 17:case"end":return t.stop()}},t,e)}))()}}}},330:function(e,t,r){"use strict";var a=r(325),n=r(331),i=r(0),o=i(a.a,n.a,!1,null,null,null);t.a=o.exports},331:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("sp-dialog",{ref:"dialog",staticClass:"product clearpadding",attrs:{width:"1200"}},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,stripe:"",border:""}},[r("el-table-column",{attrs:{label:e._label("gongsidingdanhao"),align:"center",width:"130"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("el-button",{on:{click:function(t){return e.openit(a.id)}}},[e._v(e._s(a.orderno))])]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("gonghuoshang"),align:"center",width:"100"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;e.$index;return[r("sp-select-text",{attrs:{value:t.supplierid,source:"supplier"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("niandaijijie"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.ageseason,source:"ageseason"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("yewuleixing"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.bussinesstype,source:"bussinesstype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("bizhong"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.currency,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zongjine"),width:"80",align:"center",prop:"total_discount_price"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zongjianshu"),width:"80",align:"center",prop:"total_number"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhekoulv"),width:"80",align:"center",prop:"discount"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("tuishuilv"),width:"80",align:"center",prop:"taxrebate"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("edu"),width:"80",align:"center",prop:"quantum"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dingdanriqi"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                "+e._s(r.maketime&&r.maketime.length>0?r.maketime.substr(0,10):"")+"\n            ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("pinpai"),width:"150"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.brandid,source:"brand"}})]}}])})],1)],1)},n=[],i={render:a,staticRenderFns:n};t.a=i},369:function(e,t,r){"use strict";var a=r(18),n=r.n(a),i=r(55),o=r.n(i),l=r(26),s=r.n(l),u=r(12),c=r.n(u),d=r(13),f=r.n(d),p=r(181),b=r.n(p),m=r(36),h=r(1),v=r(7),_=r(419),g=r(184),y=r(315),w=r(330),k={columns:[{name:"payment_type",label:Object(h.d)("fukuanleixing"),type:"select",source:"paymenttype"},{name:"currency",label:Object(h.d)("bizhong"),type:"select",source:"currency"},{name:"amount",label:Object(h.d)("jine")},{name:"paymentdate",label:Object(h.d)("fukuanriqi"),type:"date"},{name:"memo",label:Object(h.d)("beizhu")},{name:"makestaff",label:Object(h.d)("tijiaoren"),type:"select",source:"user",is_edit_hide:!0},{name:"status",label:Object(h.d)("yiruzhang"),type:"switch",is_edit_hide:!0}],controller:"orderpayment",auth:"order-submit",base:{orderid:""},options:{isedit:function(e){return 0==e.status},isdelete:function(e){return 0==e.status},autoreload:!0}};t.a={name:"sp-orderform",components:b()({},w.a.name,w.a),mixins:[g.a],data:function(){return{form:{bookingid:"",orderdate:"",linkmanid:"",bussinesstype:"",supplierid:"",finalsupplierid:"",ageseason:"",seasontype:"",bookingorderno:"",makedate:"",currency:"",discount:"1",taxrebate:"1",property:"1",makestaff:"",maketime:"",memo:"",orderno:"",status:"",id:""},tabledata:[],listdata:[],details:[],title:"",lang:"",pro:!1,formid:"",props:k,discounts:{}}},methods:{goToOrderbrand:function(){var e=this;return f()(c.a.mark(function t(){var r,a,n;return c.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return r=e,r._log("goToOrderbrand"),t.next=4,m.a.getOrderListToImport({orderid:r.form.id});case 4:a=t.sent,n=a.details,n.length>0?r.$router.push("/orderbrand/0?id="+r.form.id):alert(r._label("tip-001"));case 7:case"end":return t.stop()}},t,e)}))()},addPayment:function(){var e=this;e.canSubmitPayment&&(k.base.orderid=e.form.id,e.$refs.payment.showFormToCreate())},focus:function(e,t){var r=this.$refs[t];r&&r.startFocus(e)},showProduct:function(){this.pro=!0},onSelect:function(e){var t=this;t.appendRow({id:"",product:e,discount:t.form.discount,total:0})},finish:function(){var e=this;e._submit("/order/finish",{id:e.form.id}).then(function(t){e._redirect("/order/"+t.data.form.id)})},saveOrder:function(e){var t=this,r={form:Object(v.b)({},t.form,{status:e})};r.form.genders=t.genders,r.form.total=t.total_price,r.form.brandids=t.brandids;var a=[],n=!0,i=!1,l=void 0;try{for(var u,c=o()(t.tabledata);!(n=(u=c.next()).done);n=!0){var d=u.value,f=!0,p=!1,b=void 0;try{for(var m,h=o()(t.listdata);!(f=(m=h.next()).done);f=!0){var _=m.value;_.productid===d.product.id&&_.number>0&&a.push({productid:d.product.id,discount:d.discount,sizecontentid:_.sizecontentid,number:_.number,id:t.getDetailId(d.product.id,_.sizecontentid)})}}catch(e){p=!0,b=e}finally{try{!f&&h.return&&h.return()}finally{if(p)throw b}}}}catch(e){i=!0,l=e}finally{try{!n&&c.return&&c.return()}finally{if(i)throw l}}r.list=a,t.validate().then(function(){t._submit("/order/saveorder",{params:s()(r)}).then(function(e){var r=e.data;t.$emit("change",r.form),t._redirect("/order/"+e.data.form.id)})})},getDetailId:function(e,t){var r=this.details.find(function(r){return r.productid===e&&r.sizecontentid===t});return r?r.id:0},deleteRow:function(e){var t=this,r=t.tabledata.findIndex(function(t){return t==e});t.$delete(t.tabledata,r)},appendRow:function(e){var t=this;t.tabledata.some(function(t){return t.product.id==e.product.id})||(t.tabledata.unshift(e),t.form.currency=t.currencyid)},getInit:function(e){var t=this,r={},a=!0,n=!1,i=void 0;try{for(var l,s=o()(t.listdata);!(a=(l=s.next()).done);a=!0){var u=l.value;u.productid===e&&(r[u.sizecontentid]=u.number)}}catch(e){n=!0,i=e}finally{try{!a&&s.return&&s.return()}finally{if(n)throw i}}return r},onChange:function(e){var t=this,r=!0,a=!1,n=void 0;try{for(var i,l=o()(e);!(r=(i=l.next()).done);r=!0){var s=i.value;!function(e){var r=t.listdata.find(function(t){var r=t.sizecontentid,a=t.productid;return r==e.sizecontentid&&a==e.uniq});r?r.number=e.number:t.listdata.push({sizecontentid:e.sizecontentid,number:e.number,productid:e.uniq})}(s)}}catch(e){a=!0,n=e}finally{try{!r&&l.return&&l.return()}finally{if(a)throw n}}},onDiscountChange:function(e,t){var r=this,a=!0,n=!1,i=void 0;try{for(var l,s=o()(r.tabledata);!(a=(l=s.next()).done);a=!0){var u=l.value;(u.discount==t||1*u.discount<=0)&&(u.discount=e)}}catch(e){n=!0,i=e}finally{try{!a&&s.return&&s.return()}finally{if(n)throw i}}},getSummary:function(e){var t=e.columns,r=e.data,a=this,n=[];return t.forEach(function(e,t){if(0==t)return void(n[t]=a._label("heji"));6==t?n[t]=a.f(r.reduce(function(e,t){return e+a.stat[t.product.id].factoryprice*a.stat[t.product.id].total},0)):9==t?n[t]=a.f(r.reduce(function(e,t){return e+a.stat[t.product.id].dealPrice*a.stat[t.product.id].total},0)):3==t&&(n[t]=a.listdata.reduce(function(e,t){return e+1*t.number},0))}),n[1]=r.length,n}},computed:{isList:function(){var e=!0,t=!1,r=void 0;try{for(var a,n=o()(this.listdata);!(e=(a=n.next()).done);e=!0){if(a.value.number>0)return!0}}catch(e){t=!0,r=e}finally{try{!e&&n.return&&n.return()}finally{if(t)throw r}}return!1},isEditable:function(){var e=this.form.status;return"1"==e||""==e||!e},width:function(){return 50*this.tabledata.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)+21},canSubmitPayment:function(){return this.form.id>0},total_price:function(){var e=this,t=e.tabledata.reduce(function(t,r){return t+e.stat[r.product.id].total*e.stat[r.product.id].dealPrice},0);return this.f(t)},brands:function(){var e={};return this.tabledata.forEach(function(t){return e[t.product.brand_label]=1}),n()(e).join(",")},brandids:function(){var e={};return this.tabledata.forEach(function(t){return e[t.product.brandid]=1}),n()(e).join(",")},genderlabels:function(){var e={};return this.tabledata.forEach(function(t){t.product.gender_label.length>0&&(e[t.product.gender_label]=1)}),n()(e).join(",")},genders:function(){var e={};return this.tabledata.forEach(function(t){t.product.gender_label.length>0&&(e[t.product.gender]=1)}),n()(e).join(",")},stat:function(){var e=this,t=Object(y.a)({factoryprice:0,currencyid:"",total:0});return e.tabledata.forEach(function(r){var a=t.get(r.product.id);a.factoryprice=r.product.factoryprice,a.dealPrice=0==e.form.taxrebate?0:e.f(a.factoryprice*r.discount/e.form.taxrebate)}),e.details.forEach(function(e){var r=t.get(e.productid);e.factoryprice>0&&(r.factoryprice=e.factoryprice)}),e.listdata.forEach(function(e){var r=e.productid,a=e.number;t.get(r).total+=1*a}),t.result()},currencyid:function(){var e=this;if(e.form.currency>0)return e.form.currency;for(var t=0;t<e.details.length;t++)return e.details[t].currencyid;for(var r=0;r<e.tabledata.length;r++)return e.tabledata[r].product.factorypricecurrency}},mounted:function(){var e=this,t=e.$route,r=void 0;0==t.params.id?r=e._label("xinjiandingdan"):(e._fetch("/order/loadorder",{id:t.params.id}).then(function(){var t=f()(c.a.mark(function t(r){var a,n,i,l,s,u,d;return c.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(Object(v.a)(r.data.form,e.form),e.tabledata=[],!r.data.list){t.next=28;break}for(e.details=r.data.list,a=!0,n=!1,i=void 0,t.prev=7,l=o()(r.data.list);!(a=(s=l.next()).done);a=!0)u=s.value,e.listdata.push({productid:u.productid,sizecontentid:u.sizecontentid,number:u.number});t.next=15;break;case 11:t.prev=11,t.t0=t.catch(7),n=!0,i=t.t0;case 15:t.prev=15,t.prev=16,!a&&l.return&&l.return();case 18:if(t.prev=18,!n){t.next=21;break}throw i;case 21:return t.finish(18);case 22:return t.finish(15);case 23:return t.next=25,Object(_.a)(r.data.list);case 25:d=t.sent,d.forEach(function(t){return e.appendRow(t)}),e.form.currency=e.currencyid;case 28:e._setTitle(e._label("dingdan")+":"+e.form.orderno);case 29:case"end":return t.stop()}},t,this,[[7,11,15,23],[16,,18,22]])}));return function(e){return t.apply(this,arguments)}}()),r="loading..."),e._setTitle(r),e.initRules(function(t){var r=e._label;return{bussinesstype:t.id({required:!0,message:r("8000"),label:r("yewuleixing")}),ageseason:t.id({required:!0,message:r("8000"),label:r("niandai")}),property:t.id({required:!0,message:r("8000"),label:r("shuxing")}),bookingid:t.id({required:!0,message:r("8000"),label:r("dinghuokehu")})}})}}},419:function(e,t,r){"use strict";var a=r(5),n=r.n(a),i=r(35),o=r(37),l=function(e){var t={};e.forEach(function(e){var r=e.orderid+"-"+e.productid;if(t[r])t[r].form[e.sizecontentid]={number:e.number,id:e.id},t[r].confirm_form[e.sizecontentid]={number:0==e.confirm_number?"":e.confirm_number,id:e.id},t[r].left_form[e.sizecontentid]={number:e.confirm_number-e.shipping_number,id:e.id},t[r].shipping_form[e.sizecontentid]={number:"",id:e.id},t[r].total+=1*e.number;else{var a={};a[e.sizecontentid]={number:e.number,id:e.id};var n={};n[e.sizecontentid]={number:0==e.confirm_number?"":e.confirm_number,id:e.id};var i={};i[e.sizecontentid]={number:e.confirm_number-e.shipping_number,id:e.id};var o={};o[e.sizecontentid]={number:"",id:e.id},t[r]={key:r,productid:e.productid,discount:1*e.discount,discountbrand:1*e.discountbrand,total:1*e.number,form:a,confirm_form:n,left_form:i,shipping_form:o,orderid:e.orderid}}});var r=[];return Object(o.a)(t).forEach(function(e){var t=Object(i.j)(e);e.orderid>0?t.push(i.b.load({data:e.orderid,depth:1}),"order"):e.order={id:-1},t.push(i.e.load({data:e.productid,depth:1}),"product"),r.push(t.all())}),n.a.all(r)};t.a=l},420:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{ref:"order-form",staticClass:"formx",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini",rules:e.formRules,"inline-message":!1,"show-message":!1}},[r("el-row",{attrs:{gutter:0}},[r("asa-button",{attrs:{auth:"order-submit",enable:"2"!=e.form.status&&e.isList},on:{click:function(t){return e.saveOrder(1)}}},[e._v(e._s(e._label("baocun")))]),e._v(" "),r("asa-button",{attrs:{auth:"order-submit",enable:e.form.id>0&&"2"!=e.form.status},on:{click:function(t){return e.finish()}}},[e._v(e._s(e._label("wancheng")))]),e._v(" "),r("asa-button",{attrs:{enable:e.isEditable},on:{click:function(t){return e.showProduct()}}},[e._v(e._s(e._label("xuanzeshangpin")))]),e._v(" "),r("asa-button",{attrs:{auth:"order-submit",enable:e.form.id>0},on:{click:e.goToOrderbrand}},[e._v(e._s(e._label("shengchengpinpaidingdan")))]),e._v(" "),r("asa-button",{attrs:{enable:e.form.id>0},on:{click:function(t){return e.$refs.houcha.show()}}},[e._v(e._s(e._label("houcha")))])],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("dinghuokehu"),prop:"bookingid"}},[r("simple-select",{attrs:{source:"supplier_2"},model:{value:e.form.bookingid,callback:function(t){e.$set(e.form,"bookingid",t)},expression:"form.bookingid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("lianxiren")}},[r("simple-select",{attrs:{source:"supplierlinkman",parentid:e.form.bookingid},model:{value:e.form.linkmanid,callback:function(t){e.$set(e.form,"linkmanid",t)},expression:"form.linkmanid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3",clearable:!0},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("fahuoshang")}},[r("simple-select",{attrs:{source:"supplier_3",clearable:!0},model:{value:e.form.finalsupplierid,callback:function(t){e.$set(e.form,"finalsupplierid",t)},expression:"form.finalsupplierid"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("niandai"),prop:"ageseason"}},[r("simple-select",{attrs:{source:"ageseason"},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jijie")}},[r("simple-select",{attrs:{source:"seasontype"},model:{value:e.form.seasontype,callback:function(t){e.$set(e.form,"seasontype",t)},expression:"form.seasontype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yewuleixing"),prop:"bussinesstype"}},[r("simple-select",{attrs:{source:"bussinesstype"},model:{value:e.form.bussinesstype,callback:function(t){e.$set(e.form,"bussinesstype",t)},expression:"form.bussinesstype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shuxing"),prop:"property"}},[r("simple-select",{attrs:{source:"orderproperty"},model:{value:e.form.property,callback:function(t){e.$set(e.form,"property",t)},expression:"form.property"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("jine")}},[r("el-input",{staticClass:"productcurrency",attrs:{disabled:""},model:{value:e.total_price,callback:function(t){e.total_price=t},expression:"total_price"}},[r("simple-select",{attrs:{slot:"prepend",source:"currency",clearable:!1,disabled:""},slot:"prepend",model:{value:e.form.currency,callback:function(t){e.$set(e.form,"currency",t)},expression:"form.currency"}})],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhekoulv")}},[r("sp-float-input",{on:{change:e.onDiscountChange},model:{value:e.form.discount,callback:function(t){e.$set(e.form,"discount",t)},expression:"form.discount"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("tuishuilv")}},[r("sp-float-input",{model:{value:e.form.taxrebate,callback:function(t){e.$set(e.form,"taxrebate",t)},expression:"form.taxrebate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("beizhu")}},[r("el-input",{model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("kehudingdanhao")}},[r("el-input",{model:{value:e.form.bookingorderno,callback:function(t){e.$set(e.form,"bookingorderno",t)},expression:"form.bookingorderno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gongsidingdanhao")}},[r("el-input",{attrs:{placeholder:e._label("zidonghuoqu"),disabled:""},model:{value:e.form.orderno,callback:function(t){e.$set(e.form,"orderno",t)},expression:"form.orderno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanren")}},[r("sp-display-input",{attrs:{value:e.form.makestaff,source:"user",placeholder:e._label("zidonghuoqu")}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("dinghuoriqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.orderdate,callback:function(t){e.$set(e.form,"orderdate",t)},expression:"form.orderdate"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("xingbie")}},[r("el-input",{attrs:{disabled:""},model:{value:e.genderlabels,callback:function(t){e.genderlabels=t},expression:"genderlabels"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinpai")}},[r("el-input",{attrs:{disabled:""},model:{value:e.brands,callback:function(t){e.brands=t},expression:"brands"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanriqi")}},[r("el-input",{attrs:{value:e.form.maketime,placeholder:e._label("zidonghuoqu"),disabled:""}})],1)],1)],1)],1),e._v(" "),r("el-row",[r("el-col",{staticClass:"product",attrs:{span:24}},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,stripe:"",border:"","show-summary":!0,"summary-method":e.getSummary}},[r("el-table-column",{attrs:{align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("img",{staticStyle:{width:"50px",height:"50px"},attrs:{src:e._fileLink(t.row.product.picture)}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"left",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){return[r("sp-product-tip",{attrs:{product:e.row.product}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"number",label:e._label("dinggoushuliang"),align:"center",width:e.width},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row,n=t.$index;return[r("sp-sizecontent-input",{key:a.product.id,ref:n,attrs:{columns:a.product.sizecontents,uniq:a.product.id,disabled:!e.isEditable,init:e.getInit(a.product.id)},on:{change:e.onChange,up:function(t){return e.focus(t,n-1)},down:function(t){return e.focus(t,n+1)}}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"total",label:e._label("zongshu"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.stat[r.product.id].total)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("bizhong"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(r.product.factorypricecurrency_label)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.stat[r.product.id].factoryprice)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjiaheji"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.f(e.stat[r.product.id].factoryprice*e.stat[r.product.id].total))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("zhekoulv"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:a.discount,callback:function(t){e.$set(a,"discount",t)},expression:"row.discount"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chengjiaojia"),width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.f(e.stat[r.product.id].dealPrice))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chengjiaozongjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.f(e.stat[r.product.id].dealPrice*e.stat[r.product.id].total))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"left",width:"300"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(t.row.product.getName())+"\n                    ")]}}])}),e._v(" "),e.isEditable?r("el-table-column",{attrs:{label:e._label("caozuo"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("as-button",{attrs:{size:"mini",type:"danger"},on:{click:function(t){return e.deleteRow(a)}}},[e._v(e._s(e._label("shanchu")))])]}}],null,!1,1952232498)}):e._e()],1)],1)],1),e._v(" "),r("asa-select-product-dialog",{attrs:{visible:e.pro},on:{"update:visible":function(t){e.pro=t},select:e.onSelect}}),e._v(" "),r("sp-orderbrand-list",{ref:"houcha",attrs:{orderid:e.form.id}})],1)},n=[],i={render:a,staticRenderFns:n};t.a=i}});
//# sourceMappingURL=5-1032.js.map