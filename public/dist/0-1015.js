webpackJsonp([0],{302:function(e,t,r){"use strict";function n(e){r(380)}Object.defineProperty(t,"__esModule",{value:!0});var a=r(338),o=r(382),i=r(0),s=n,l=i(a.a,o.a,!1,s,"data-v-3477a0e5",null);t.default=l.exports},303:function(e,t,r){"use strict";r.d(t,"a",function(){return o});var n=r(173),a=r.n(n),o=function(e){var t={};return{get:function(r){return t[r]||(t[r]=a.a.cloneDeep(e)),t[r]},result:function(){return t}}}},305:function(e,t){function r(e,t){var r=e[1]||"",a=e[3];if(!a)return r;if(t&&"function"==typeof btoa){var o=n(a);return[r].concat(a.sources.map(function(e){return"/*# sourceURL="+a.sourceRoot+e+" */"})).concat([o]).join("\n")}return[r].join("\n")}function n(e){return"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(e))))+" */"}e.exports=function(e){var t=[];return t.toString=function(){return this.map(function(t){var n=r(t,e);return t[2]?"@media "+t[2]+"{"+n+"}":n}).join("")},t.i=function(e,r){"string"==typeof e&&(e=[[null,e,""]]);for(var n={},a=0;a<this.length;a++){var o=this[a][0];"number"==typeof o&&(n[o]=!0)}for(a=0;a<e.length;a++){var i=e[a];"number"==typeof i[0]&&n[i[0]]||(r&&!i[2]?i[2]=r:r&&(i[2]="("+i[2]+") and ("+r+")"),t.push(i))}},t}},306:function(e,t,r){function n(e){for(var t=0;t<e.length;t++){var r=e[t],n=c[r.id];if(n){n.refs++;for(var a=0;a<n.parts.length;a++)n.parts[a](r.parts[a]);for(;a<r.parts.length;a++)n.parts.push(o(r.parts[a]));n.parts.length>r.parts.length&&(n.parts.length=r.parts.length)}else{for(var i=[],a=0;a<r.parts.length;a++)i.push(o(r.parts[a]));c[r.id]={id:r.id,refs:1,parts:i}}}}function a(){var e=document.createElement("style");return e.type="text/css",d.appendChild(e),e}function o(e){var t,r,n=document.querySelector("style["+v+'~="'+e.id+'"]');if(n){if(m)return b;n.parentNode.removeChild(n)}if(_){var o=p++;n=f||(f=a()),t=i.bind(null,n,o,!1),r=i.bind(null,n,o,!0)}else n=a(),t=s.bind(null,n),r=function(){n.parentNode.removeChild(n)};return t(e),function(n){if(n){if(n.css===e.css&&n.media===e.media&&n.sourceMap===e.sourceMap)return;t(e=n)}else r()}}function i(e,t,r,n){var a=r?"":n.css;if(e.styleSheet)e.styleSheet.cssText=g(t,a);else{var o=document.createTextNode(a),i=e.childNodes;i[t]&&e.removeChild(i[t]),i.length?e.insertBefore(o,i[t]):e.appendChild(o)}}function s(e,t){var r=t.css,n=t.media,a=t.sourceMap;if(n&&e.setAttribute("media",n),h.ssrId&&e.setAttribute(v,t.id),a&&(r+="\n/*# sourceURL="+a.sources[0]+" */",r+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(a))))+" */"),e.styleSheet)e.styleSheet.cssText=r;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(r))}}var l="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!l)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var u=r(307),c={},d=l&&(document.head||document.getElementsByTagName("head")[0]),f=null,p=0,m=!1,b=function(){},h=null,v="data-vue-ssr-id",_="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());e.exports=function(e,t,r,a){m=r,h=a||{};var o=u(e,t);return n(o),function(t){for(var r=[],a=0;a<o.length;a++){var i=o[a],s=c[i.id];s.refs--,r.push(s)}t?(o=u(e,t),n(o)):o=[];for(var a=0;a<r.length;a++){var s=r[a];if(0===s.refs){for(var l=0;l<s.parts.length;l++)s.parts[l]();delete c[s.id]}}}};var g=function(){var e=[];return function(t,r){return e[t]=r,e.filter(Boolean).join("\n")}}()},307:function(e,t){e.exports=function(e,t){for(var r=[],n={},a=0;a<t.length;a++){var o=t[a],i=o[0],s=o[1],l=o[2],u=o[3],c={id:e+":"+a,css:s,media:l,sourceMap:u};n[i]?n[i].parts.push(c):r.push(n[i]={id:i,parts:[c]})}return r}},338:function(e,t,r){"use strict";var n=r(6),a=r.n(n),o=r(12),i=r.n(o),s=r(13),l=r.n(s),u=r(18),c=r.n(u),d=r(26),f=r.n(d),p=r(175),m=r.n(p),b=r(7),h=r(34),v=r(174),_=r(33),g=r(303);t.a={name:"sp-orderconfirmdetail",mixins:[v.a],data:function(){var e,t=this,r=t._label;return{form:(e={foreignorderno:"",bussinesstype:"",supplierid:"",finalsupplierid:"",ageseason:"",seasontype:"",discount:"",taxrebate:"",makestaff:"",maketime:"",memo:"",orderno:"",brandid:"",total:"",discountbrand:""},m()(e,"bussinesstype",""),m()(e,"status",""),m()(e,"id",""),e),rules:{bussinesstype:{required:!0,message:r("8000")},supplierid:{required:!0,message:r("8000")},ageseason:{required:!0,message:r("8000")},property:{required:!0,message:r("8000")}},tabledata:[],listdata:[],details:[],orderDetailList:[]}},methods:{onSelect:function(e){this.appendRow(e)},focus:function(e,t){var r=this;r.$refs[t]&&r.$refs[t].startFocus(e)},saveOrder:function(){var e=this;if(confirm(e._label("tip-queren"))){var t=y(e),r={form:Object(b.b)({},e.form)},n=[];e.listdata.forEach(function(e){e.number>0&&n.push({id:t.getOrderbrandDetailId(e.productid,e.orderid,e.sizecontentid),number:e.number})}),r.list=n,e._log(r),e._submit("/orderbrand/confirm",{params:f()(r)}).then(function(t){y(e).loadDetail()}).catch(function(){})}},cancel:function(){var e=this;confirm(e._label("tip-quxiaoqueren"))&&e._submit("/orderbrand/cancel",{id:e.form.id}).then(function(t){y(e).loadDetail()}).catch(function(){})},appendRow:function(e){var t=this;t._log("append",e),t.tabledata.unshift(e),t.form.currency=e.product.factorypricecurrency},onChange:function(e){var t=this;e.forEach(function(e){var r=t.listdata.find(function(t){return t.orderid==e.order.id&&t.productid==e.product.id&&t.sizecontentid==e.sizecontentid});r?r.number=e.number:t.listdata.push({sizecontentid:e.sizecontentid,productid:e.product.id,orderid:e.order.id,number:e.number,product:e.product,discount:e.discount})})},getSummary:function(e){var t=e.columns,r=e.data,n=this,a=[];return t.forEach(function(e,t){if(0==t)return void(a[t]=n._label("heji"));6==t?a[t]=n.stat.total_count:9==t&&(a[t]=n.stat.total_discount_price)}),a[1]=r.length,a}},computed:{width:function(){return 50*this.tabledata.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)+191},total_price:function(){var e=this.tabledata.reduce(function(e,t){return e+t.confirm_total*t.price},0);return this.formatNumber(e)},genders:function(){var e={};return this.tabledata.forEach(function(t){t.product.gender_label.length>0&&(e[t.product.gender_label]=1)}),c()(e).join(",")},stat:function(){var e=this,t={total_count:0,total_discount_price:0,group:{}};return e.listdata.forEach(function(r){if(r.number>0){var n=1*r.number;t.total_count+=n,t.total_discount_price=e.f(t.total_discount_price+e.productStat[r.productid].factoryprice*r.discount*n);var a=t.group[r.product.id]||0;t.group[r.product.id]=a+n}}),t},productStat:function(){var e=this,t=Object(g.a)({factoryprice:0,wordprice:0,currencyid:"",total:0});return e.tabledata.forEach(function(e){var r=t.get(e.product.id);r.factoryprice=e.product.factoryprice,r.currencyid=e.product.factorypricecurrency,r.wordprice=e.product.wordprice}),e.orderDetailList.forEach(function(e){if(e.factoryprice>0){var r=t.get(e.productid);r.factoryprice=e.factoryprice,r.currencyid=e.currencyid,r.wordprice=e.wordprice}}),e.listdata.forEach(function(e){var r=t.get(e.productid);e.number>0&&(r.total+=1*e.number)}),t.result()}},mounted:function(){var e=this;y(e).loadDetail(),e._setTitle(e._label("querenwaibudingdan"))}};var y=function e(t){var r={loadDetail:function(){var r=t.$route.params;t._fetch("/orderbrand/load",{ids:r.id}).then(function(){var r=l()(i.a.mark(function r(n){var a,o=n.data;return i.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:o.orderbrands&&o.orderbrands.length>0&&(Object(b.b)(t.form,o.orderbrands[0]),a=e(t),a.importList(o.list),t.orderDetailList=o.details,t._setTitle(t._label("querenwaibudingdan")+":"+t.form.orderno));case 1:case"end":return r.stop()}},r,this)}));return function(e){return r.apply(this,arguments)}}())},convert:function(e){var t=this;return l()(i.a.mark(function r(){var n,o,s,l;return i.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return n={},e.forEach(function(e){var t=e.productid+"-"+e.orderid;if(n[t])n[t].form[e.sizecontentid]=e.number,n[t].confirm_form[e.sizecontentid]=e.confirm_number,n[t].total+=e.number;else{var r={};r[e.sizecontentid]=e.number;var a={};a[e.sizecontentid]=e.confirm_number,n[t]={key:t,productid:e.productid,orderid:e.orderid,discount:e.discount,total:1*e.number,form:r,confirm_form:a}}}),o=[],Object(h.a)(n).forEach(function(e){var t=Object(_.h)(e);e.orderid>0?t.push(_.b.load({data:e.orderid,depth:1}),"order"):e.order={id:-1},t.push(_.e.load({data:e.productid,depth:1}),"product"),o.push(t.all())}),t.next=6,a.a.all(o);case 6:return s=t.sent,l={},s.forEach(function(e){var t=e.productid,r=Object(b.d)(e,["order","form","confirm_form","total"]);l[t]?l[t].orders.push(r):l[t]={productid:e.productid,product:e.product,discount:e.discount,orders:[r]}}),t.abrupt("return",Object(h.a)(l).array());case 10:case"end":return t.stop()}},r,t)}))()},importList:function(e){var n=this;return l()(i.a.mark(function a(){var o;return i.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return t.details=e,n.next=3,r.convert(e);case 3:o=n.sent,t.tabledata=[],o.forEach(function(e){t.tabledata.push(e)}),t.listdata=[],e.forEach(function(e){var r=t.tabledata.find(function(t){return t.productid==e.productid});t.listdata.push({number:e.confirm_number,sizecontentid:e.sizecontentid,productid:e.productid,orderid:e.orderid,product:r.product,discount:e.discount})});case 8:case"end":return n.stop()}},a,n)}))()},getOrderbrandDetailId:function(e,r,n){var a=t.details.find(function(t){return t.productid==e&&t.orderid==r&&t.sizecontentid==n});return a?a.id:0}};return r}},380:function(e,t,r){var n=r(381);"string"==typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);r(306)("34234144",n,!0,{})},381:function(e,t,r){t=e.exports=r(305)(!1),t.push([e.i,"body[data-v-3477a0e5]{color:red;background:blue}",""])},382:function(e,t,r){"use strict";var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"82px",inline:!0,size:"mini"}},[r("el-row",{attrs:{gutter:0}},[2!=e.form.status?r("au-button",{attrs:{auth:"confirmorder-submit",type:"primary"},on:{click:e.saveOrder}},[e._v(e._s(e._label("querenwaibudingdan")))]):e._e(),e._v(" "),2==e.form.status?r("au-button",{attrs:{auth:"confirmorder-submit",type:"danger"},on:{click:e.cancel}},[e._v(e._s(e._label("quxiaoqueren")))]):e._e()],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("niandai"),required:"",prop:"ageseason"}},[r("simple-select",{attrs:{source:"ageseason",disabled:""},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jijie")}},[r("simple-select",{attrs:{source:"seasontype",disabled:""},model:{value:e.form.seasontype,callback:function(t){e.$set(e.form,"seasontype",t)},expression:"form.seasontype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinpai")}},[r("sp-display-input",{attrs:{value:e.form.brandid,source:"brand"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xingbie")}},[r("el-input",{attrs:{disabled:""},model:{value:e.genders,callback:function(t){e.genders=t},expression:"genders"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3",clearable:!0,disabled:""},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("fahuoshang")}},[r("simple-select",{attrs:{source:"supplier_3",clearable:!0,disabled:""},model:{value:e.form.finalsupplierid,callback:function(t){e.$set(e.form,"finalsupplierid",t)},expression:"form.finalsupplierid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("haiwaidingdanhao")}},[r("el-input",{attrs:{disabled:""},model:{value:e.form.foreignorderno,callback:function(t){e.$set(e.form,"foreignorderno",t)},expression:"form.foreignorderno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("gongsidingdanhao")}},[r("el-input",{attrs:{placeholder:e._label("zidonghuoqu"),disabled:""},model:{value:e.form.orderno,callback:function(t){e.$set(e.form,"orderno",t)},expression:"form.orderno"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("jine")}},[r("el-input",{staticClass:"productcurrency",attrs:{value:e.stat.total_discount_price,disabled:""}},[r("simple-select",{attrs:{slot:"prepend",source:"currency",clearable:!1,disabled:""},slot:"prepend",model:{value:e.form.currency,callback:function(t){e.$set(e.form,"currency",t)},expression:"form.currency"}})],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhekoulv")}},[r("el-input",{attrs:{disabled:""},model:{value:e.form.discount,callback:function(t){e.$set(e.form,"discount",t)},expression:"form.discount"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("tuishuilv")}},[r("el-input",{attrs:{disabled:""},model:{value:e.form.taxrebate,callback:function(t){e.$set(e.form,"taxrebate",t)},expression:"form.taxrebate"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("beizhu")}},[r("el-input",{attrs:{disabled:""},model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("yewuleixing")}},[r("simple-select",{attrs:{source:"bussinesstype",disabled:""},model:{value:e.form.bussinesstype,callback:function(t){e.$set(e.form,"bussinesstype",t)},expression:"form.bussinesstype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanren")}},[r("sp-display-input",{attrs:{value:e.form.makestaff,source:"user",placeholder:e._label("zidonghuoqu")}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanriqi")}},[r("el-input",{attrs:{placeholder:e._label("zidonghuoqu"),disabled:""},model:{value:e.form.maketime,callback:function(t){e.$set(e.form,"maketime",t)},expression:"form.maketime"}})],1)],1)],1)],1),e._v(" "),r("el-row",[r("el-col",{staticClass:"inputtable product",attrs:{span:24}},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,stripe:"",border:"","show-summary":!0,"summary-method":e.getSummary}},[r("el-table-column",{attrs:{align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("img",{staticStyle:{width:"50px",height:"50px"},attrs:{src:e._fileLink(n.product.picture)}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"150"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-product-tip",{attrs:{product:t.product}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("bizhong"),width:"60",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("sp-select-text",{attrs:{value:e.productStat[n.productid].currencyid,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.f(e.productStat[r.productid].factoryprice))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{staticClass:"counter",attrs:{prop:"label",label:e._label("zhekoulv"),width:"70",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(r.discount)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chengjiaojia"),width:"70",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.f(r.discount*e.productStat[r.productid].factoryprice))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"confirm_total_price",label:e._label("zongjia"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.f(r.discount*e.productStat[r.productid].factoryprice*e.productStat[r.productid].total))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"number",label:e._label("querenshuliang"),align:"center",width:e.width},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row,a=t.$index;return[r("sp-sizecontent-confirm3",{key:n.product.id,ref:a,attrs:{columns:n.product.sizecontents,row:n,disabled:2==e.form.status},on:{change:e.onChange,up:function(t){return e.focus(t,a-1)},down:function(t){return e.focus(t,a+1)}}})]}}])}),e._v(" "),r("el-table-column",{staticClass:"counter",attrs:{label:e._label("shuliang"),width:"70",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.productStat[r.productid].total)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(r.product.getName())+"\n                    ")]}}])})],1)],1)],1)],1)},a=[],o={render:n,staticRenderFns:a};t.a=o}});
//# sourceMappingURL=0-1015.js.map