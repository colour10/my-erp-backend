webpackJsonp([10],{302:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=r(339),a=r(383),o=r(0),i=o(n.a,a.a,!1,null,null,null);t.default=i.exports},306:function(e,t,r){"use strict";r.d(t,"a",function(){return o});var n=r(174),a=r.n(n),o=function(e){var t={};return{get:function(r){return t[r]||(t[r]=a.a.cloneDeep(e)),t[r]},result:function(){return t}}}},339:function(e,t,r){"use strict";var n=r(9),a=r.n(n),o=r(10),i=r.n(o),l=r(18),s=r.n(l),u=r(27),c=r.n(u),d=(r(5),r(1)),f=(r(26),r(34),r(7)),m=r(382),p=r(176),b=r(306),h={columns:[{name:"payment_type",label:Object(d.d)("fukuanleixing"),type:"select",source:"paymenttype"},{name:"currency",label:Object(d.d)("bizhong"),type:"select",source:"currency"},{name:"amount",label:Object(d.d)("jine")},{name:"paymentdate",label:Object(d.d)("fukuanriqi"),type:"date"},{name:"memo",label:Object(d.d)("beizhu")},{name:"makestaff",label:Object(d.d)("tijiaoren"),type:"select",source:"user",is_edit_hide:!0},{name:"status",label:Object(d.d)("yiruzhang"),type:"switch",is_edit_hide:!0}],controller:"orderpayment",auth:"order-submit",base:{orderid:""},options:{isedit:function(e){return 0==e.status},isdelete:function(e){return 0==e.status},autoreload:!0}};t.a={name:"sp-orderform",components:{},mixins:[p.a],data:function(){return{form:{bookingid:"",orderdate:"",linkmanid:"",bussinesstype:"",supplierid:"",finalsupplierid:"",ageseason:"",seasontype:"",bookingorderno:"",makedate:"",currency:"",discount:"1",taxrebate:"1",property:"1",makestaff:"",maketime:"",memo:"",orderno:"",status:"",id:""},tabledata:[],listdata:[],details:[],title:"",lang:"",pro:!1,formid:"",props:h,discounts:{}}},methods:{onQuit:function(){this.dialogVisible=!1},addPayment:function(){var e=this;e.canSubmitPayment()&&(h.base.orderid=e.form.id,e.$refs.payment.showFormToCreate())},focus:function(e,t){var r=this.$refs[t];r&&r.startFocus(e)},showProduct:function(){this.pro=!0},onSelect:function(e){var t=this;t.appendRow({id:"",product:e,discount:t.form.discount,total:0})},finish:function(){var e=this;e._submit("/order/finish",{id:e.form.id}).then(function(t){e._redirect("/order/"+t.data.form.id)})},saveOrder:function(e){var t=this,r={form:Object(f.b)({},t.form,{status:e})};r.form.genders=t.genders,r.form.total=t.total_price,r.form.brandids=t.brandids;var n=[];t.tabledata.forEach(function(e){t._log("item",e),t.listdata.forEach(function(r){r.productid===e.product.id&&r.number>0&&n.push({productid:e.product.id,discount:e.discount,sizecontentid:r.sizecontentid,number:r.number,id:t.getDetailId(e.product.id,r.sizecontentid)})})}),r.list=n,t.validate().then(function(){t._submit("/order/saveorder",{params:c()(r)}).then(function(e){t._log(e);var r=e.data;t.$emit("change",r.form),t._redirect("/order/"+e.data.form.id)})})},getDetailId:function(e,t){var r=this.details.find(function(r){return r.productid===e&&r.sizecontentid===t});return r?r.id:0},deleteRow:function(e){var t=this,r=t.tabledata.findIndex(function(t){return t==e});t.$delete(t.tabledata,r)},appendRow:function(e){var t=this;t.tabledata.some(function(t){return t.product.id==e.product.id})||(t.tabledata.unshift(e),t.form.currency=t.currencyid)},getInit:function(e){var t=this,r={};return t.listdata.forEach(function(t){t.productid===e&&(r[t.sizecontentid]=t.number)}),r},onChange:function(e){var t=this;e.forEach(function(e){var r=t.listdata.find(function(t){var r=t.sizecontentid,n=t.productid;return r==e.sizecontentid&&n==e.uniq});r?r.number=e.number:t.listdata.push({sizecontentid:e.sizecontentid,number:e.number,productid:e.uniq})})},onDiscountChange:function(e,t){this.tabledata.forEach(function(r){(r.discount==t||1*r.discount<=0)&&(r.discount=e)})},getSummary:function(e){var t=e.columns,r=e.data,n=this,a=[];return t.forEach(function(e,t){if(0==t)return void(a[t]=n._label("heji"));6==t?a[t]=n.f(r.reduce(function(e,t){return e+n.stat[t.product.id].factoryprice*n.stat[t.product.id].total},0)):9==t?a[t]=n.f(r.reduce(function(e,t){return e+n.stat[t.product.id].dealPrice*n.stat[t.product.id].total},0)):3==t&&(a[t]=n.listdata.reduce(function(e,t){return e+1*t.number},0))}),a[1]=r.length,a}},computed:{buttontype:function(){var e=this.form.status;return"1"!=e&&""!=e&&e?"info":"primary"},isEditable:function(){var e=this.form.status;return"1"==e||""==e||!e},width:function(){return 50*this.tabledata.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)+21},canSubmit:function(){var e=this.form.status;return 2!=e&&3!=e},canSubmitPayment:function(){return this.form.id>0},total_price:function(){var e=this,t=e.tabledata.reduce(function(t,r){return t+e.stat[r.product.id].total*e.stat[r.product.id].dealPrice},0);return this.formatNumber(t)},brands:function(){var e={};return this.tabledata.forEach(function(t){return e[t.product.brand_label]=1}),s()(e).join(",")},brandids:function(){var e={};return this.tabledata.forEach(function(t){return e[t.product.brandid]=1}),s()(e).join(",")},genderlabels:function(){var e={};return this.tabledata.forEach(function(t){t.product.gender_label.length>0&&(e[t.product.gender_label]=1)}),s()(e).join(",")},genders:function(){var e={};return this.tabledata.forEach(function(t){t.product.gender_label.length>0&&(e[t.product.gender]=1)}),s()(e).join(",")},stat:function(){var e=this,t=Object(b.a)({factoryprice:0,currencyid:"",total:0});return e.tabledata.forEach(function(r){var n=t.get(r.product.id);n.factoryprice=r.product.factoryprice,n.dealPrice=0==e.form.taxrebate?0:e.f(n.factoryprice*r.discount/e.form.taxrebate)}),e.details.forEach(function(e){var r=t.get(e.productid);e.factoryprice>0&&(r.factoryprice=e.factoryprice)}),e.listdata.forEach(function(e){var r=e.productid,n=e.number;t.get(r).total+=1*n}),t.result()},currencyid:function(){var e=this;if(e.form.currency>0)return e.form.currency;for(var t=0;t<e.details.length;t++)return e.details[t].currencyid;for(var r=0;r<e.tabledata.length;r++)return e.tabledata[r].product.factorypricecurrency}},mounted:function(){var e=this,t=e.$route,r=void 0;0==t.params.id?r=e._label("xinjiandingdan"):(e.tabledata=[],e._fetch("/order/loadorder",{id:t.params.id}).then(function(){var t=i()(a.a.mark(function t(r){var n;return a.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(Object(f.a)(r.data.form,e.form),!r.data.list){t.next=9;break}return e.details=r.data.list,r.data.list.forEach(function(t){e.listdata.push({productid:t.productid,sizecontentid:t.sizecontentid,number:t.number})}),t.next=6,Object(m.a)(r.data.list);case 6:n=t.sent,n.forEach(function(t){return e.appendRow(t)}),e.form.currency=e.currencyid;case 9:e._setTitle(e._label("dingdan")+":"+e.form.orderno);case 10:case"end":return t.stop()}},t,this)}));return function(e){return t.apply(this,arguments)}}()),r="loading..."),e._setTitle(r),e.initRules(function(t){var r=e._label;return{bussinesstype:t.id({required:!0,message:r("8000"),label:r("yewuleixing")}),ageseason:t.id({required:!0,message:r("8000"),label:r("niandai")}),property:t.id({required:!0,message:r("8000"),label:r("shuxing")}),bookingid:t.id({required:!0,message:r("8000"),label:r("dinghuokehu")})}})}}},382:function(e,t,r){"use strict";var n=r(6),a=r.n(n),o=r(26),i=r(34),l=function(e){var t={};e.forEach(function(e){var r=e.orderid+"-"+e.productid;if(t[r])t[r].form[e.sizecontentid]={number:e.number,id:e.id},t[r].confirm_form[e.sizecontentid]={number:0==e.confirm_number?"":e.confirm_number,id:e.id},t[r].left_form[e.sizecontentid]={number:e.confirm_number-e.shipping_number,id:e.id},t[r].shipping_form[e.sizecontentid]={number:"",id:e.id},t[r].total+=1*e.number;else{var n={};n[e.sizecontentid]={number:e.number,id:e.id};var a={};a[e.sizecontentid]={number:0==e.confirm_number?"":e.confirm_number,id:e.id};var o={};o[e.sizecontentid]={number:e.confirm_number-e.shipping_number,id:e.id};var i={};i[e.sizecontentid]={number:"",id:e.id},t[r]={key:r,productid:e.productid,discount:1*e.discount,discountbrand:1*e.discountbrand,total:1*e.number,form:n,confirm_form:a,left_form:o,shipping_form:i,orderid:e.orderid}}});var r=[];return Object(i.a)(t).forEach(function(e){var t=Object(o.h)(e);e.orderid>0?t.push(o.b.load({data:e.orderid,depth:1}),"order"):e.order={id:-1},t.push(o.e.load({data:e.productid,depth:1}),"product"),r.push(t.all())}),a.a.all(r)};t.a=l},383:function(e,t,r){"use strict";var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{ref:"order-form",staticClass:"formx",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini",rules:e.formRules,"inline-message":!1,"show-message":!1}},[r("el-row",{attrs:{gutter:0}},["2"!=e.form.status?r("au-button",{attrs:{auth:"order-submit",type:"primary"},on:{click:function(t){return e.saveOrder(1)}}},[e._v(e._s(e._label("baocun")))]):e._e(),e._v(" "),"2"!=e.form.status?r("au-button",{attrs:{auth:"order-submit",type:"primary"},on:{click:function(t){return e.finish()}}},[e._v(e._s(e._label("wancheng")))]):e._e(),e._v(" "),r("au-button",{attrs:{auth:"order-submit",type:e.canSubmitPayment?"primary":"info"},on:{click:e.addPayment}},[e._v(e._s(e._label("fujian")))]),e._v(" "),r("au-button",{attrs:{auth:"order-submit",type:e.canSubmitPayment?"primary":"info"},on:{click:e.addPayment}},[e._v(e._s(e._label("feiyong")))]),e._v(" "),e.isEditable?r("as-button",{attrs:{type:e.buttontype},on:{click:function(t){return e.showProduct()}}},[e._v(e._s(e._label("xuanzeshangpin")))]):e._e()],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("dinghuokehu"),prop:"bookingid"}},[r("simple-select",{attrs:{source:"supplier_2"},model:{value:e.form.bookingid,callback:function(t){e.$set(e.form,"bookingid",t)},expression:"form.bookingid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("lianxiren")}},[r("simple-select",{attrs:{source:"supplierlinkman",parentid:e.form.bookingid},model:{value:e.form.linkmanid,callback:function(t){e.$set(e.form,"linkmanid",t)},expression:"form.linkmanid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3",clearable:!0},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("fahuoshang")}},[r("simple-select",{attrs:{source:"supplier_3",clearable:!0},model:{value:e.form.finalsupplierid,callback:function(t){e.$set(e.form,"finalsupplierid",t)},expression:"form.finalsupplierid"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("niandai"),prop:"ageseason"}},[r("simple-select",{attrs:{source:"ageseason"},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jijie")}},[r("simple-select",{attrs:{source:"seasontype"},model:{value:e.form.seasontype,callback:function(t){e.$set(e.form,"seasontype",t)},expression:"form.seasontype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("yewuleixing"),prop:"bussinesstype"}},[r("simple-select",{attrs:{source:"bussinesstype"},model:{value:e.form.bussinesstype,callback:function(t){e.$set(e.form,"bussinesstype",t)},expression:"form.bussinesstype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shuxing"),prop:"property"}},[r("simple-select",{attrs:{source:"orderproperty"},model:{value:e.form.property,callback:function(t){e.$set(e.form,"property",t)},expression:"form.property"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("jine")}},[r("el-input",{staticClass:"productcurrency",attrs:{placeholder:""},model:{value:e.total_price,callback:function(t){e.total_price=t},expression:"total_price"}},[r("simple-select",{attrs:{slot:"prepend",source:"currency",clearable:!1},slot:"prepend",model:{value:e.form.currency,callback:function(t){e.$set(e.form,"currency",t)},expression:"form.currency"}})],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhekoulv")}},[r("sp-float-input",{on:{change:e.onDiscountChange},model:{value:e.form.discount,callback:function(t){e.$set(e.form,"discount",t)},expression:"form.discount"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("tuishuilv")}},[r("sp-float-input",{model:{value:e.form.taxrebate,callback:function(t){e.$set(e.form,"taxrebate",t)},expression:"form.taxrebate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("beizhu")}},[r("el-input",{model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("kehudingdanhao")}},[r("el-input",{model:{value:e.form.bookingorderno,callback:function(t){e.$set(e.form,"bookingorderno",t)},expression:"form.bookingorderno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gongsidingdanhao")}},[r("el-input",{attrs:{placeholder:e._label("zidonghuoqu"),disabled:""},model:{value:e.form.orderno,callback:function(t){e.$set(e.form,"orderno",t)},expression:"form.orderno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanren")}},[r("sp-display-input",{attrs:{value:e.form.makestaff,source:"user",placeholder:e._label("zidonghuoqu")}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("dinghuoriqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.orderdate,callback:function(t){e.$set(e.form,"orderdate",t)},expression:"form.orderdate"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"230px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("xingbie")}},[r("el-input",{attrs:{disabled:""},model:{value:e.genderlabels,callback:function(t){e.genderlabels=t},expression:"genderlabels"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinpai")}},[r("el-input",{attrs:{disabled:""},model:{value:e.brands,callback:function(t){e.brands=t},expression:"brands"}})],1)],1)],1)],1),e._v(" "),r("el-row",[r("el-col",{staticClass:"product",attrs:{span:24}},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,stripe:"",border:"","show-summary":!0,"summary-method":e.getSummary}},[r("el-table-column",{attrs:{align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("img",{staticStyle:{width:"50px",height:"50px"},attrs:{src:e._fileLink(t.row.product.picture)}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"left",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){return[r("sp-product-tip",{attrs:{product:e.row.product}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"number",label:e._label("dinggoushuliang"),align:"center",width:e.width},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row,a=t.$index;return[r("sp-sizecontent-input",{key:n.product.id,ref:a,attrs:{columns:n.product.sizecontents,uniq:n.product.id,disabled:!e.isEditable,init:e.getInit(n.product.id)},on:{change:e.onChange,up:function(t){return e.focus(t,a-1)},down:function(t){return e.focus(t,a+1)}}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"total",label:e._label("zongshu"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.stat[r.product.id].total)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("bizhong"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(r.product.factorypricecurrency_label)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.stat[r.product.id].factoryprice)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjiaheji"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.f(e.stat[r.product.id].factoryprice*e.stat[r.product.id].total))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("zhekoulv"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:n.discount,callback:function(t){e.$set(n,"discount",t)},expression:"row.discount"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chengjiaojia"),width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.f(e.stat[r.product.id].dealPrice))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chengjiaozongjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.f(e.stat[r.product.id].dealPrice*e.stat[r.product.id].total))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"left",width:"300"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(t.row.product.getName())+"\n                    ")]}}])}),e._v(" "),e.isEditable?r("el-table-column",{attrs:{label:e._label("caozuo"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("as-button",{attrs:{size:"mini",type:"danger"},on:{click:function(t){return e.deleteRow(n)}}},[e._v(e._s(e._label("shanchu")))])]}}],null,!1,1952232498)}):e._e()],1)],1)],1),e._v(" "),r("asa-select-product-dialog",{attrs:{visible:e.pro},on:{"update:visible":function(t){e.pro=t},select:e.onSelect}})],1)},a=[],o={render:n,staticRenderFns:a};t.a=o}});
//# sourceMappingURL=10-1017.js.map