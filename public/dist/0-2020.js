webpackJsonp([0],{332:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=r(413),a=r(531),i=r(0),o=i(n.a,a.a,!1,null,null,null);t.default=o.exports},343:function(e,t,r){"use strict";r.d(t,"a",function(){return i});var n=r(141),a=r.n(n),i=function(e){var t={};return{get:function(r){return t[r]||(t[r]=a.a.cloneDeep(e)),t[r]},result:function(){return t}}}},344:function(e,t,r){"use strict";var n=r(56);t.a={methods:{formatNumber:function(e){return Object(n.b)(e,3)},f:function(e){return Object(n.b)(e,2)}}}},346:function(e,t,r){"use strict";var n=r(5),a=r.n(n),i=r(78),o=r.n(i),l=r(12),s=r.n(l);t.a={name:"sp-orderbrand-list",props:{orderid:{},shippingid:{}},data:function(){return{tabledata:[]}},methods:{openit:function(e){this._open("/orderbrand/"+e)},show:function(){var e=this;return s()(a.a.mark(function t(){var r,n,i,l,s,u,c;return a.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(r=e,!r.orderid){t.next=10;break}return t.next=4,r._fetch("/order/orderbrandlist",{id:r.orderid});case 4:i=t.sent,l=i.data,r.tabledata=[],(n=r.tabledata).push.apply(n,o()(l)),t.next=16;break;case 10:return t.next=12,r._fetch("/shipping/orderbrandlist",{id:r.shippingid});case 12:u=t.sent,c=u.data,r.tabledata=[],(s=r.tabledata).push.apply(s,o()(c));case 16:r._showDialog("dialog");case 17:case"end":return t.stop()}},t,e)}))()}}}},347:function(e,t,r){"use strict";var n=r(73),a=r.n(n),i=r(197);t.a={name:"asa-select-product-dialog",components:a()({},i.a.name,i.a),props:{visible:{type:Boolean},brandids:{type:String,default:""},genders:{type:String,default:""}},data:function(){return{dialogVisible:this.visible}},methods:{onSelect:function(e){var t=this;t.dialogVisible=!1,t.$emit("select",e)},onClose:function(){this.dialogVisible=!1},search:function(e){var t=this;setTimeout(function(){t.$refs.panel.search(e)},100)}},watch:{dialogVisible:function(e){this.$emit("update:visible",e)},visible:function(e){this.dialogVisible=e}}}},356:function(e,t,r){"use strict";var n=r(346),a=r(357),i=r(0),o=i(n.a,a.a,!1,null,null,null);t.a=o.exports},357:function(e,t,r){"use strict";var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("sp-dialog",{ref:"dialog",staticClass:"product clearpadding",attrs:{width:"1200"}},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,stripe:"",border:""}},[r("el-table-column",{attrs:{label:e._label("gongsidingdanhao"),align:"center",width:"130"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-button",{on:{click:function(t){return e.openit(n.id)}}},[e._v(e._s(n.orderno))])]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("gonghuoshang"),align:"center",width:"100"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;e.$index;return[r("sp-select-text",{attrs:{value:t.supplierid,source:"supplier"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("niandaijijie"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.ageseason,source:"ageseason"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("yewuleixing"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.bussinesstype,source:"bussinesstype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("bizhong"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.currency,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zongjine"),width:"80",align:"center",prop:"total_discount_price"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zongjianshu"),width:"80",align:"center",prop:"total_number"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhekoulv"),width:"80",align:"center",prop:"discount"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("tuishuilv"),width:"80",align:"center",prop:"taxrebate"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("edu"),width:"80",align:"center",prop:"quantum"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dingdanriqi"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n        "+e._s(r.maketime&&r.maketime.length>0?r.maketime.substr(0,10):"")+"\n      ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("pinpai"),align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.brandid,source:"brand"}})]}}])})],1)],1)},a=[],i={render:n,staticRenderFns:a};t.a=i},358:function(e,t,r){"use strict";var n=r(347),a=r(359),i=r(0),o=i(n.a,a.a,!1,null,null,null);t.a=o.exports},359:function(e,t,r){"use strict";var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("el-dialog",{attrs:{visible:e.dialogVisible,center:!0,fullscreen:!1,modal:!0,width:"1200px"},on:{"update:visible":function(t){e.dialogVisible=t}}},[r("asa-product-search-panel",{ref:"panel",attrs:{brandids:e.brandids,genders:e.genders},on:{select:e.onSelect,close:e.onClose}})],1)},a=[],i={render:n,staticRenderFns:a};t.a=i},413:function(e,t,r){"use strict";var n,a=r(18),i=r.n(a),o=r(22),l=r.n(o),s=r(24),u=r.n(s),c=r(5),d=r.n(c),f=r(12),p=r.n(f),m=r(73),b=r.n(m),v=r(38),h=r(2),_=r(14),g=r(513),y=r(344),w=r(343),k=r(356),x=r(529),z=r(358),S=r(142),$={columns:[{name:"payment_type",label:Object(h.d)("fukuanleixing"),type:"select",source:"paymenttype"},{name:"currency",label:Object(h.d)("bizhong"),type:"select",source:"currency"},{name:"amount",label:Object(h.d)("jine")},{name:"paymentdate",label:Object(h.d)("fukuanriqi"),type:"date"},{name:"memo",label:Object(h.d)("beizhu")},{name:"makestaff",label:Object(h.d)("tijiaoren"),type:"select",source:"user",is_edit_hide:!0},{name:"status",label:Object(h.d)("yiruzhang"),type:"switch",is_edit_hide:!0}],controller:"orderpayment",auth:"order-submit",base:{orderid:""},options:{isedit:function(e){return 0==e.status},isdelete:function(e){return 0==e.status},autoreload:!0}};t.a={name:"sp-orderform",components:(n={AsaProduct:S.a},b()(n,k.a.name,k.a),b()(n,x.a.name,x.a),b()(n,z.a.name,z.a),n),mixins:[y.a],data:function(){return{form:{bookingid:"",orderdate:"",linkmanid:"",bussinesstype:"",supplierid:"",finalsupplierid:"",ageseason:"",seasontype:"",bookingorderno:"",makedate:"",currency:"",discount:"1",taxrebate:"1",property:"1",makestaff:"",maketime:"",memo:"",orderno:"",status:"",id:"",brandids:"",genders:""},form2:{keyword:""},tabledata:[],listdata:[],details:[],pro:!1,props:$}},methods:{onClick:function(e){this.$refs.product.edit(!0).setInfo(e).then(function(e){return e.show(!1)})},goToOrderbrand:function(){var e=this;return p()(d.a.mark(function t(){var r,n,a;return d.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return r=e,r._log("goToOrderbrand"),t.next=4,v.a.getOrderListToImport({orderid:r.form.id});case 4:n=t.sent,a=n.details,a&&a.length>0?r.$router.push("/orderbrand/0?id="+r.form.id):e.$message({message:r._label("tip-001"),type:"success"});case 7:case"end":return t.stop()}},t,e)}))()},addPayment:function(){var e=this;e.canSubmitPayment&&($.base.orderid=e.form.id,e.$refs.payment.showFormToCreate())},focus:function(e,t){var r=this.$refs[t];r&&r.startFocus(e)},showProduct:function(){this.pro=!0},onSelect:function(e){var t=this;t.appendRow({id:"",product:e,discount:t.form.discount,factoryprice:t.f(e.factoryprice),total:0})},finish:function(){var e=this;e._submit("/order/finish",{id:e.form.id}).then(function(t){e._redirect("/order/"+t.data.form.id)})},saveOrder:function(e){var t=this,r={form:Object(_.c)({},t.form,{status:e})};r.form.total=t.total_price;var n=[],a=!0,i=!1,o=void 0;try{for(var s,c=l()(t.tabledata);!(a=(s=c.next()).done);a=!0){var d=s.value,f=!0,p=!1,m=void 0;try{for(var b,v=l()(t.listdata);!(f=(b=v.next()).done);f=!0){var h=b.value;h.productid===d.product.id&&h.number>0&&n.push({productid:d.product.id,discount:d.discount,sizecontentid:h.sizecontentid,number:h.number,factoryprice:d.factoryprice,id:t.getDetailId(d.product.id,h.sizecontentid)})}}catch(e){p=!0,m=e}finally{try{!f&&v.return&&v.return()}finally{if(p)throw m}}}}catch(e){i=!0,o=e}finally{try{!a&&c.return&&c.return()}finally{if(i)throw o}}r.list=n,t.validate().then(function(){t._submit("/order/saveorder",{params:u()(r)}).then(function(e){e.data;t._redirect("/order/"+e.data.form.id)})})},getDetailId:function(e,t){var r=this.details.find(function(r){return r.productid===e&&r.sizecontentid===t});return r?r.id:0},deleteRow:function(e){var t=this,r=t.tabledata.findIndex(function(t){return t==e});t.$delete(t.tabledata,r)},appendRow:function(e){var t=this;t.tabledata.some(function(t){return t.product.id==e.product.id})||(t.tabledata.unshift(e),t.form.currency=t.currencyid)},getInit:function(e){var t=this,r={},n=!0,a=!1,i=void 0;try{for(var o,s=l()(t.listdata);!(n=(o=s.next()).done);n=!0){var u=o.value;u.productid===e&&(r[u.sizecontentid]=u.number)}}catch(e){a=!0,i=e}finally{try{!n&&s.return&&s.return()}finally{if(a)throw i}}return r},onChange:function(e){var t=this,r=!0,n=!1,a=void 0;try{for(var i,o=l()(e);!(r=(i=o.next()).done);r=!0){var s=i.value;!function(e){var r=t.listdata.find(function(t){var r=t.sizecontentid,n=t.productid;return r==e.sizecontentid&&n==e.uniq});r?r.number=e.number:t.listdata.push({sizecontentid:e.sizecontentid,number:e.number,productid:e.uniq})}(s)}}catch(e){n=!0,a=e}finally{try{!r&&o.return&&o.return()}finally{if(n)throw a}}},onDiscountChange:function(e,t){var r=this,n=!0,a=!1,i=void 0;try{for(var o,s=l()(r.tabledata);!(n=(o=s.next()).done);n=!0){var u=o.value;(u.discount==t||1*u.discount<=0)&&(u.discount=e)}}catch(e){a=!0,i=e}finally{try{!n&&s.return&&s.return()}finally{if(a)throw i}}},getSummary:function(e){var t=e.columns,r=e.data,n=this,a=[];return t.forEach(function(e,t){if(0==t)return void(a[t]=n._label("heji"));6==t?a[t]=n.f(r.reduce(function(e,t){return e+t.factoryprice*n.stat[t.product.id].total},0)):3==t&&(a[t]=n.listdata.reduce(function(e,t){return e+Number(t.number)},0))}),a[1]=r.length,a[9]=n.total_price,a},isMatch:function(e,t){return!(e.length>0)||t.toUpperCase().indexOf(e)>=0}},computed:{isList:function(){var e=!0,t=!1,r=void 0;try{for(var n,a=l()(this.listdata);!(e=(n=a.next()).done);e=!0){if(n.value.number>0)return!0}}catch(e){t=!0,r=e}finally{try{!e&&a.return&&a.return()}finally{if(t)throw r}}return!1},isEditable:function(){var e=this.form.status;return"1"==e||""==e||!e},width:function(){return 50*this.tabledata.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)+21},canSubmitPayment:function(){return this.form.id>0},total_price:function(){var e=this,t=e.tabledata.reduce(function(t,r){return t+e.stat[r.product.id].total*e.stat[r.product.id].dealPrice},0);return this.f(t)},genderlabels:function(){var e={};return this.tabledata.forEach(function(t){t.product.gender_label.length>0&&(e[t.product.gender_label]=1)}),i()(e).join(",")},stat:function(){var e=this,t=Object(w.a)({dealPrice:0,total:0}),r=!0,n=!1,a=void 0;try{for(var i,o=l()(e.tabledata);!(r=(i=o.next()).done);r=!0){var s=i.value;t.get(s.product.id).dealPrice=e.form.taxrebate>0?e.f(s.factoryprice*s.discount/e.form.taxrebate):0}}catch(e){n=!0,a=e}finally{try{!r&&o.return&&o.return()}finally{if(n)throw a}}var u=!0,c=!1,d=void 0;try{for(var f,p=l()(e.listdata);!(u=(f=p.next()).done);u=!0){var m=f.value,b=m.productid,v=m.number;t.get(b).total+=Number(v)}}catch(e){c=!0,d=e}finally{try{!u&&p.return&&p.return()}finally{if(c)throw d}}return t.result()},currencyid:function(){var e=this;if(e.form.currency>0)return e.form.currency;for(var t=0;t<e.details.length;t++)return e.details[t].currencyid;for(var r=0;r<e.tabledata.length;r++)return e.tabledata[r].product.factorypricecurrency},orderdetails:function(){var e=this,t=e.form2.keyword.toUpperCase();return e.tabledata.filter(function(r){return e.isMatch(t,r.product.getGoodsCode(""))})}},mounted:function(){var e=this,t=e.$route,r=void 0;0==t.params.id?r=e._label("xinjiandingdan"):(e._fetch("/order/loadorder",{id:t.params.id}).then(function(){var t=p()(d.a.mark(function t(r){var n,a,i,o,s,u,c;return d.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(Object(_.a)(r.data.form,e.form),e.tabledata=[],!r.data.list){t.next=28;break}for(e.details=r.data.list,n=!0,a=!1,i=void 0,t.prev=7,o=l()(r.data.list);!(n=(s=o.next()).done);n=!0)u=s.value,e.listdata.push({productid:u.productid,sizecontentid:u.sizecontentid,number:u.number});t.next=15;break;case 11:t.prev=11,t.t0=t.catch(7),a=!0,i=t.t0;case 15:t.prev=15,t.prev=16,!n&&o.return&&o.return();case 18:if(t.prev=18,!a){t.next=21;break}throw i;case 21:return t.finish(18);case 22:return t.finish(15);case 23:return t.next=25,Object(g.a)(r.data.list);case 25:c=t.sent,c.forEach(function(t){return e.appendRow(t)}),e.form.currency=e.currencyid;case 28:e._setTitle(e._label("dingdan")+":"+e.form.orderno);case 29:case"end":return t.stop()}},t,this,[[7,11,15,23],[16,,18,22]])}));return function(e){return t.apply(this,arguments)}}()),r="loading..."),e._setTitle(r),e.initRules(function(t){var r=e._label;return{bussinesstype:t.id({required:!0,message:r("8000"),label:r("yewuleixing")}),ageseason:t.id({required:!0,message:r("8000"),label:r("niandai")}),property:t.id({required:!0,message:r("8000"),label:r("shuxing")}),bookingid:t.id({required:!0,message:r("8000"),label:r("dinghuokehu")})}})}}},414:function(e,t,r){var n=r(15);e.exports=function(e,t){if(!n(e)||e._t!==t)throw TypeError("Incompatible receiver, "+t+" required!");return e}},415:function(e,t,r){"use strict";var n=(r(2),r(14)),a=r(79);t.a={name:"sp-sizecontent-input",props:{disabled:{type:Boolean,default:!1},columns:{type:Array},uniq:{require:!0},init:{}},data:function(){var e=this,t={};return e.columns.forEach(function(e){t[e.id]=""}),{form:t,tabledata:[[]]}},methods:{getCellClass:function(){return"counter"},onInputChange:function(e,t){var r=this,n=e.split(/\s+/);if(n.length>1)for(var a=t;a<r.columns.length&&a<t+n.length;a++){var i=r.columns[a].id;r.form[i]=n[a-t]}},onChange:function(e,t){var r=this,n=[];"ArrowRight"===e.key?r.focus(t+1):"ArrowLeft"===e.key?r.focus(t-1):"ArrowUp"===e.key?r.$emit("up",t):"ArrowDown"===e.key?r.$emit("down",t):(Object(a.a)(r.form).forEach(function(e,t){n.push({uniq:r.uniq,sizecontentid:t,number:e})}),r.$emit("change",n))},focus:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0,t=this.$refs[e];t&&t[0]&&t[0].focus()},startFocus:function(e){var t=this;e=e<t.columns.length?e:t.columns.length-1,t.focus(e)},onFocus:function(e){var t=this.$refs[e];t&&t[0]&&t[0].select()}},mounted:function(){Object(n.c)(this.form,this.init)}}},513:function(e,t,r){"use strict";var n=r(22),a=r.n(n),i=r(6),o=r.n(i),l=r(514),s=r.n(l),u=r(54);t.a=function(e){var t=new s.a,r=!0,n=!1,i=void 0;try{for(var l,c=a()(e);!(r=(l=c.next()).done);r=!0){var d=l.value,f=t.get(d.productid)||{productid:d.productid,discount:Number(d.discount),total:0,factoryprice:d.factoryprice};f.total+=Number(d.number),t.set(d.productid,f)}}catch(e){n=!0,i=e}finally{try{!r&&c.return&&c.return()}finally{if(n)throw i}}var p=[],m=!0,b=!1,v=void 0;try{for(var h,_=a()(t.values());!(m=(h=_.next()).done);m=!0){var g=h.value,y=Object(u.i)(g);y.push(u.d.load({data:g.productid,depth:1}),"product"),p.push(y.all())}}catch(e){b=!0,v=e}finally{try{!m&&_.return&&_.return()}finally{if(b)throw v}}return o.a.all(p)}},514:function(e,t,r){e.exports={default:r(515),__esModule:!0}},515:function(e,t,r){r(57),r(26),r(34),r(516),r(522),r(525),r(527),e.exports=r(1).Map},516:function(e,t,r){"use strict";var n=r(517),a=r(414);e.exports=r(518)("Map",function(e){return function(){return e(this,arguments.length>0?arguments[0]:void 0)}},{get:function(e){var t=n.getEntry(a(this,"Map"),e);return t&&t.v},set:function(e,t){return n.def(a(this,"Map"),0===e?0:e,t)}},n,!0)},517:function(e,t,r){"use strict";var n=r(11).f,a=r(55),i=r(82),o=r(25),l=r(81),s=r(80),u=r(58),c=r(84),d=r(85),f=r(10),p=r(83).fastKey,m=r(414),b=f?"_s":"size",v=function(e,t){var r,n=p(t);if("F"!==n)return e._i[n];for(r=e._f;r;r=r.n)if(r.k==t)return r};e.exports={getConstructor:function(e,t,r,u){var c=e(function(e,n){l(e,c,t,"_i"),e._t=t,e._i=a(null),e._f=void 0,e._l=void 0,e[b]=0,void 0!=n&&s(n,r,e[u],e)});return i(c.prototype,{clear:function(){for(var e=m(this,t),r=e._i,n=e._f;n;n=n.n)n.r=!0,n.p&&(n.p=n.p.n=void 0),delete r[n.i];e._f=e._l=void 0,e[b]=0},delete:function(e){var r=m(this,t),n=v(r,e);if(n){var a=n.n,i=n.p;delete r._i[n.i],n.r=!0,i&&(i.n=a),a&&(a.p=i),r._f==n&&(r._f=a),r._l==n&&(r._l=i),r[b]--}return!!n},forEach:function(e){m(this,t);for(var r,n=o(e,arguments.length>1?arguments[1]:void 0,3);r=r?r.n:this._f;)for(n(r.v,r.k,this);r&&r.r;)r=r.p},has:function(e){return!!v(m(this,t),e)}}),f&&n(c.prototype,"size",{get:function(){return m(this,t)[b]}}),c},def:function(e,t,r){var n,a,i=v(e,t);return i?i.v=r:(e._l=i={i:a=p(t,!0),k:t,v:r,p:n=e._l,n:void 0,r:!1},e._f||(e._f=i),n&&(n.n=i),e[b]++,"F"!==a&&(e._i[a]=i)),e},getEntry:v,setStrong:function(e,t,r){u(e,t,function(e,r){this._t=m(e,t),this._k=r,this._l=void 0},function(){for(var e=this,t=e._k,r=e._l;r&&r.r;)r=r.p;return e._t&&(e._l=r=r?r.n:e._t._f)?"keys"==t?c(0,r.k):"values"==t?c(0,r.v):c(0,[r.k,r.v]):(e._t=void 0,c(1))},r?"entries":"values",!r,!0),d(t)}}},518:function(e,t,r){"use strict";var n=r(3),a=r(7),i=r(83),o=r(19),l=r(16),s=r(82),u=r(80),c=r(81),d=r(15),f=r(33),p=r(11).f,m=r(519)(0),b=r(10);e.exports=function(e,t,r,v,h,_){var g=n[e],y=g,w=h?"set":"add",k=y&&y.prototype,x={};return b&&"function"==typeof y&&(_||k.forEach&&!o(function(){(new y).entries().next()}))?(y=t(function(t,r){c(t,y,e,"_c"),t._c=new g,void 0!=r&&u(r,h,t[w],t)}),m("add,clear,delete,forEach,get,has,set,keys,values,entries,toJSON".split(","),function(e){var t="add"==e||"set"==e;e in k&&(!_||"clear"!=e)&&l(y.prototype,e,function(r,n){if(c(this,y,e),!t&&_&&!d(r))return"get"==e&&void 0;var a=this._c[e](0===r?0:r,n);return t?this:a})}),_||p(y.prototype,"size",{get:function(){return this._c.size}})):(y=v.getConstructor(t,e,h,w),s(y.prototype,r),i.NEED=!0),f(y,e),x[e]=y,a(a.G+a.W+a.F,x),_||v.setStrong(y,e,h),y}},519:function(e,t,r){var n=r(25),a=r(59),i=r(28),o=r(39),l=r(520);e.exports=function(e,t){var r=1==e,s=2==e,u=3==e,c=4==e,d=6==e,f=5==e||d,p=t||l;return function(t,l,m){for(var b,v,h=i(t),_=a(h),g=n(l,m,3),y=o(_.length),w=0,k=r?p(t,y):s?p(t,0):void 0;y>w;w++)if((f||w in _)&&(b=_[w],v=g(b,w,h),e))if(r)k[w]=v;else if(v)switch(e){case 3:return!0;case 5:return b;case 6:return w;case 2:k.push(b)}else if(c)return!1;return d?-1:u||c?c:k}}},520:function(e,t,r){var n=r(521);e.exports=function(e,t){return new(n(e))(t)}},521:function(e,t,r){var n=r(15),a=r(86),i=r(4)("species");e.exports=function(e){var t;return a(e)&&(t=e.constructor,"function"!=typeof t||t!==Array&&!a(t.prototype)||(t=void 0),n(t)&&null===(t=t[i])&&(t=void 0)),void 0===t?Array:t}},522:function(e,t,r){var n=r(7);n(n.P+n.R,"Map",{toJSON:r(523)("Map")})},523:function(e,t,r){var n=r(40),a=r(524);e.exports=function(e){return function(){if(n(this)!=e)throw TypeError(e+"#toJSON isn't generic");return a(this)}}},524:function(e,t,r){var n=r(80);e.exports=function(e,t){var r=[];return n(e,!1,r.push,r,t),r}},525:function(e,t,r){r(526)("Map")},526:function(e,t,r){"use strict";var n=r(7);e.exports=function(e){n(n.S,e,{of:function(){for(var e=arguments.length,t=new Array(e);e--;)t[e]=arguments[e];return new this(t)}})}},527:function(e,t,r){r(528)("Map")},528:function(e,t,r){"use strict";var n=r(7),a=r(32),i=r(25),o=r(80);e.exports=function(e){n(n.S,e,{from:function(e){var t,r,n,l,s=arguments[1];return a(this),t=void 0!==s,t&&a(s),void 0==e?new this:(r=[],t?(n=0,l=i(s,arguments[2],2),o(e,!1,function(e){r.push(l(e,n++))})):o(e,!1,r.push,r),new this(r))}})}},529:function(e,t,r){"use strict";var n=r(415),a=r(530),i=r(0),o=i(n.a,a.a,!1,null,null,null);t.a=o.exports},530:function(e,t,r){"use strict";var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"sizecontent"},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,"cell-class-name":e.getCellClass,border:!1}},e._l(e.columns,function(t,n){return r("el-table-column",{key:t.id,attrs:{label:t.name,align:"center",width:"50"},scopedSlots:e._u([{key:"default",fn:function(a){a.$index;return[r("el-input",{ref:n,refInFor:!0,staticStyle:{width:"50px"},attrs:{size:"mini",disabled:e.disabled},on:{focus:function(t){return e.onFocus(n)},input:function(t){return e.onInputChange(t,n)}},nativeOn:{keyup:function(t){return e.onChange(t,n)}},model:{value:e.form[t.id],callback:function(r){e.$set(e.form,t.id,r)},expression:"form[column.id]"}})]}}],null,!0)})}),1)],1)},a=[],i={render:n,staticRenderFns:a};t.a=i},531:function(e,t,r){"use strict";var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{ref:"order-form",staticClass:"formx",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini",rules:e.formRules,"inline-message":!1,"show-message":!1}},[r("el-row",{attrs:{gutter:0}},[r("asa-button",{attrs:{auth:"order-submit",enable:"2"!=e.form.status&&e.isList},on:{click:function(t){return e.saveOrder(1)}}},[e._v("\n        "+e._s(e._label("baocun"))+"\n      ")]),e._v(" "),r("asa-button",{attrs:{auth:"order-submit",enable:e.form.id>0&&"2"!=e.form.status},on:{click:function(t){return e.finish()}}},[e._v("\n        "+e._s(e._label("wancheng"))+"\n      ")]),e._v(" "),r("asa-button",{attrs:{enable:e.isEditable},on:{click:function(t){return e.showProduct()}}},[e._v(e._s(e._label("xuanzeshangpin")))]),e._v(" "),r("asa-button",{attrs:{auth:"order-submit",enable:e.form.id>0},on:{click:e.goToOrderbrand}},[e._v("\n        "+e._s(e._label("shengchengpinpaidingdan"))+"\n      ")]),e._v(" "),r("asa-button",{attrs:{enable:e.form.id>0},on:{click:function(t){return e.$refs.houcha.show()}}},[e._v(e._s(e._label("houcha")))])],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("dinghuokehu"),prop:"bookingid"}},[r("simple-select",{attrs:{source:"supplier_2"},model:{value:e.form.bookingid,callback:function(t){e.$set(e.form,"bookingid",t)},expression:"form.bookingid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("lianxiren")}},[r("simple-select",{attrs:{source:"supplierlinkman",parentid:e.form.bookingid},model:{value:e.form.linkmanid,callback:function(t){e.$set(e.form,"linkmanid",t)},expression:"form.linkmanid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3",clearable:!0},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("fahuoshang")}},[r("simple-select",{attrs:{source:"supplier_3",clearable:!0},model:{value:e.form.finalsupplierid,callback:function(t){e.$set(e.form,"finalsupplierid",t)},expression:"form.finalsupplierid"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("niandai"),prop:"ageseason"}},[r("simple-select",{attrs:{source:"ageseason"},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jijie")}},[r("simple-select",{attrs:{source:"seasontype"},model:{value:e.form.seasontype,callback:function(t){e.$set(e.form,"seasontype",t)},expression:"form.seasontype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yewuleixing"),prop:"bussinesstype"}},[r("simple-select",{attrs:{source:"bussinesstype"},model:{value:e.form.bussinesstype,callback:function(t){e.$set(e.form,"bussinesstype",t)},expression:"form.bussinesstype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shuxing"),prop:"property"}},[r("simple-select",{attrs:{source:"orderproperty"},model:{value:e.form.property,callback:function(t){e.$set(e.form,"property",t)},expression:"form.property"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("jine")}},[r("el-input",{staticClass:"productcurrency",attrs:{disabled:""},model:{value:e.total_price,callback:function(t){e.total_price=t},expression:"total_price"}},[r("simple-select",{attrs:{slot:"prepend",source:"currency",clearable:!1,disabled:""},slot:"prepend",model:{value:e.form.currency,callback:function(t){e.$set(e.form,"currency",t)},expression:"form.currency"}})],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhekoulv")}},[r("sp-float-input",{on:{change:e.onDiscountChange},model:{value:e.form.discount,callback:function(t){e.$set(e.form,"discount",t)},expression:"form.discount"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("tuishuilv")}},[r("sp-float-input",{model:{value:e.form.taxrebate,callback:function(t){e.$set(e.form,"taxrebate",t)},expression:"form.taxrebate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("beizhu")}},[r("el-input",{model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("kehudingdanhao")}},[r("el-input",{model:{value:e.form.bookingorderno,callback:function(t){e.$set(e.form,"bookingorderno",t)},expression:"form.bookingorderno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gongsidingdanhao")}},[r("el-input",{attrs:{placeholder:e._label("zidonghuoqu"),disabled:""},model:{value:e.form.orderno,callback:function(t){e.$set(e.form,"orderno",t)},expression:"form.orderno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanren")}},[r("sp-display-input",{attrs:{value:e.form.makestaff,source:"user",placeholder:e._label("zidonghuoqu")}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("dinghuoriqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.orderdate,callback:function(t){e.$set(e.form,"orderdate",t)},expression:"form.orderdate"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("xingbie")}},[r("simple-select",{attrs:{source:"gender",multiple:!0},model:{value:e.form.genders,callback:function(t){e.$set(e.form,"genders",t)},expression:"form.genders"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinpai")}},[r("simple-select",{attrs:{source:"brand",multiple:!0},model:{value:e.form.brandids,callback:function(t){e.$set(e.form,"brandids",t)},expression:"form.brandids"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanriqi")}},[r("el-input",{attrs:{value:e.form.maketime,placeholder:e._label("zidonghuoqu"),disabled:""}})],1)],1)],1)],1),e._v(" "),r("el-row",[r("el-col",{staticClass:"product",attrs:{span:24}},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.orderdetails,stripe:"",border:"","show-summary":!0,"summary-method":e.getSummary}},[r("el-table-column",{attrs:{align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("img",{staticStyle:{width:"50px",height:"50px"},attrs:{src:e._fileLink(t.row.product.picture)}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"}},[r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("el-link",{attrs:{type:"primary",size:"mini"},on:{click:function(r){return e.onClick(t.row.product)}}},[e._v("\n                "+e._s(t.row.product.getGoodsCode())+"\n              ")])]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.keyword,callback:function(t){e.$set(e.form2,"keyword",t)},expression:"form2.keyword"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{prop:"number",label:e._label("dinggoushuliang"),align:"center",width:e.width},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row,a=t.$index;return[r("sp-sizecontent-input",{key:n.product.id,ref:a,attrs:{columns:n.product.sizecontents,uniq:n.product.id,disabled:!e.isEditable,init:e.getInit(n.product.id)},on:{change:e.onChange,up:function(t){return e.focus(t,a-1)},down:function(t){return e.focus(t,a+1)}}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"total",label:e._label("zongshu"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n            "+e._s(e.stat[r.product.id].total)+"\n          ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("bizhong"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n            "+e._s(r.product.factorypricecurrency_label)+"\n          ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("asa-order-input",{attrs:{size:"mini"},model:{value:n.factoryprice,callback:function(t){e.$set(n,"factoryprice",t)},expression:"row.factoryprice"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjiaheji"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n            "+e._s(e.f(r.factoryprice*e.stat[r.product.id].total))+"\n          ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("zhekoulv"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("asa-order-input",{attrs:{size:"mini"},model:{value:n.discount,callback:function(t){e.$set(n,"discount",t)},expression:"row.discount"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chengjiaojia"),width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n            "+e._s(e.f(e.stat[r.product.id].dealPrice))+"\n          ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chengjiaozongjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n            "+e._s(e.f(e.stat[r.product.id].dealPrice*e.stat[r.product.id].total))+"\n          ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"left",width:"300"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n            "+e._s(t.row.product.getName())+"\n          ")]}}])}),e._v(" "),e.isEditable?r("el-table-column",{attrs:{label:e._label("caozuo"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("as-button",{attrs:{size:"mini",type:"danger"},on:{click:function(t){return e.deleteRow(n)}}},[e._v(e._s(e._label("shanchu")))])]}}],null,!1,1952232498)}):e._e()],1)],1)],1),e._v(" "),r("asa-select-product-dialog",{attrs:{visible:e.pro,brandids:e.form.brandids,genders:e.form.genders},on:{"update:visible":function(t){e.pro=t},select:e.onSelect}}),e._v(" "),r("sp-orderbrand-list",{ref:"houcha",attrs:{orderid:e.form.id}}),e._v(" "),r("asa-product",{ref:"product"})],1)},a=[],i={render:n,staticRenderFns:a};t.a=i}});