!function(e){function t(a){if(o[a])return o[a].exports;var n=o[a]={i:a,l:!1,exports:{}};return e[a].call(n.exports,n,n.exports,t),n.l=!0,n.exports}var o={};t.m=e,t.c=o,t.d=function(e,o,a){t.o(e,o)||Object.defineProperty(e,o,{configurable:!1,enumerable:!0,get:a})},t.n=function(e){var o=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(o,"a",o),o},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="/dist/",t(t.s=146)}({1:function(e,t,o){"use strict";o.d(t,"d",function(){return d}),o.d(t,"c",function(){return p}),o.d(t,"b",function(){return f}),o.d(t,"a",function(){return h});var a=o(2),n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},i={},l=$ASA.$;i.caches={},i.get=function(e,t){if(i.caches[e])if(0==i.caches[e].loaded){!function o(){console.log("===================",e),i.caches[e]&&1==i.caches[e].loaded?t(i.caches[e].data):setTimeout(o,50)}()}else t(i.caches[e].data);else i.caches[e]={loaded:!1},$ASA.get(e,function(o){i.caches[e].loaded=!0,i.caches[e].data=o,t(o)},"json")},i.getLabel=function(e){return"undefined"!=typeof $ASAL&&$ASAL[e]?$ASAL[e]:""},i.extend=function(e,t){return Object.keys(t).forEach(function(o){e[o]=t[o]}),e},i.logger=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift("old <"+e+">"),console.log.apply(console,t)}};var r={list:{},temp:{},result:{},loading:!1};i.getFetcher=function(e){r.list[e]||(r.list[e]={},r.temp[e]={},r.result[e]={});r.list[e],r.temp[e],r.result[e];return function(t,o){r.result[e][t]?o(r.result[e][t]):(r.loading?r.temp[e][t]=1:r.list[e][t]=1,setTimeout(function a(){if(r.result[e][t])o(r.result[e][t]);else if(r.loading)setTimeout(a,100);else{r.loading=!0;var n={};Object.keys(r.list).forEach(function(e){n[e]=Object.keys(r.list[e])}),$ASA.post("/common/loadname",{params:JSON.stringify(n)},function(a){var n=function(e,t){r.result[t]=R.merge(r.result[t],e),r.list[t]=r.temp[t],r.temp[t]={}};R.forEachObjIndexed(n,a),r.loading=!1,o(r.result[e][t])},"json")}},100))}},i.getLabelFetcher=function(e){var t=i.getFetcher(e);return function(e,o,a){console.log("ids",e);var n=e.split(",").map(function(e){return new Promise(function(o,a){t(e,o)})});Promise.all(n).then(function(e){self.loading=!1,a(e.map(function(e){return e[o]}).join(","))})}};var s=function(e){return{get:function(e,t,o){var a=this;o=o||0,"object"==(void 0===e?"undefined":n(e))?o<=0?t(e):a.init(o,e,t):a.fetch(o,e,t)},fetch:function(t,o,a){var n=this;i.getFetcher(e)(o,function(e){t<=0?a(e):n.init(t,e,a)})},init:function(e,t,o){o(t)}}},u=s("warehouse"),p=l.extend(s("product"),{init:function(e,t,o){var n=[],l=a.a.getDataSource("sizecontent",i.getLabel("lang"));n.push(new Promise(function(e){l.filter({topid:t.sizetopid},e)})),Promise.all(n).then(function(e){t.sizecontents=e[0],o(t)})}}),c=s("goods"),d=l.extend(s("productstock"),{init:function(e,t,o){var n=[];n.push(new Promise(function(o){p.get(t.productid,o,e-1)})),n.push(new Promise(function(o){u.get(t.warehouseid,o,e-1)}));var l=a.a.getDataSource("sizecontent",i.getLabel("lang"));n.push(new Promise(function(e){l.getRow(t.sizecontentid,function(t){e(t)})})),n.push(new Promise(function(o){c.get(t.goodsid,o,e-1)})),Promise.all(n).then(function(e){t.product=e[0],t.warehouse=e[1],t.sizecontent=e[2],t.goods=e[3],o(t)})}}),f=l.extend(s("orderdetails"),{init:function(e,t,o){var n=[];n.push(new Promise(function(o){p.get(t.productid,o,e-1)}));var l=a.a.getDataSource("sizecontent",i.getLabel("lang"));n.push(new Promise(function(e){l.getRow(t.sizecontentid,function(t){e(t)})})),Promise.all(n).then(function(e){t.product=e[0],t.sizecontent=e[1],o(t)})}}),h=l.extend(s("confirmorderdetails"),{init:function(e,t,o){var a=[];a.push(new Promise(function(o){f.get(t.orderdetailsid,o,e-1)})),Promise.all(a).then(function(e){t.orderdetails=e[0],o(t)})}});t.e=i},146:function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=o(2);"undefined"!=typeof window&&(console.log("hello"),void 0===window.ASAP&&(window.ASAP={}),console.log("hello2"),window.ASAP.getLabel=function(e,t,o,n){a.a.getDataSource(e,t).getRowLabels(o,n)}),t.default={}},2:function(e,t,o){"use strict";function a(e,t){var o=this;o.row=e,o.dataSource=t}function n(e,t){var o=this;o.lang=t,o.data=[],o.hashtable={},o.options=e,o.oplabel=e.oplabel||"name",o.opvalue=e.opvalue||"value",o.is_loaded=!1}var i=o(1),l=o(7),r=(i.e.logger("DataSource"),{});a.prototype.getKeyValue=function(){var e=this.dataSource.getValueName();return this.row[e]},a.prototype.getLabelValue=function(){var e=this,t=e.dataSource.getLabelName(),o=e.dataSource.getLang();return e.row[t]||e.row[t+"_"+o]},a.prototype.getLabel=a.prototype.getLabelValue,a.prototype.getValue=a.prototype.getKeyValue,a.prototype.getRow=function(e){return e?this.row[e]:this.row},n.prototype.init=function(){var e=this,t=e.options;t.url?e.loadList():t.hashlist?(Object.keys(t.hashlist).forEach(function(o){var n=new a(t.hashlist[o],e);e.data.push(n),e.hashtable[o]=n}),e.is_loaded=!0):t.hashtable?(Object.keys(t.hashtable).forEach(function(o){var n=new a({name:t.hashtable[o],value:o},e);e.data.push(n),e.hashtable[o]=n}),e.oplabel="name",e.opvalue="value",e.is_loaded=!0):t.datalist&&(t.datalist.forEach(function(t){var o=new a(t,e);e.hashtable[t[e.opvalue]]=o,e.data.push(o)}),e.is_loaded=!0)},n.prototype.loadList=function(){var e=this,t=e.options;t.params;i.e.get(t.url,function(t){t.data.forEach(function(t){var o=new a(t,e);e.hashtable[t[e.opvalue]]=o,e.data.push(o)}),e.is_loaded=!0},"json")},n.prototype.getData=function(e){var t=this;!function o(){t.is_loaded?e(t.data):setTimeout(o,50)}()},n.prototype.filter=function(e,t){this.getData(function(o){var a=Object.keys(e),n=o.filter(function(t){return a.every(function(o){return e[o]==t.getRow(o)})});t(n)})},n.prototype.sub=function(e,t){var o=this;o.getData(function(a){var i=Object.keys(e),l=a.filter(function(t){return i.every(function(o){return e[o]==t.getRow(o)})}),l=l.map(function(e){return e.getRow()}),r=new n({datalist:l,oplabel:o.oplabel,opvalue:o.opvalue},o.lang);r.init(),t(r)})},n.prototype.getLabelName=function(e){return this.oplabel},n.prototype.getValueName=function(e){return this.opvalue},n.prototype.setLang=function(e){this.lang=e},n.prototype.getLang=function(){return this.lang},n.prototype.setLabelName=function(e){this.oplabel=e},n.prototype.getLabelList=function(e,t){this.getData(function(o){var a=R.map(function(e){var t=function(t){return e==t.getValue()};return R.find(t)(o)})(e);a=R.filter(R.identity)(a),t(R.map(R.invoker(0,"getLabel"))(a))})},n.prototype.getRow=function(e,t){var o=this;!function a(){o.is_loaded?t(o.hashtable[e]):setTimeout(a,50)}()},n.prototype.getRowLabel=function(e,t){this.getRow(e,function(e){t(e?e.getLabelValue():"")})},n.prototype.getRowLabels=function(e,t){e="string"==typeof e?e.split(","):e,this.getLabelList(e,function(e){t(e.join(","))})},n.getDataSource=function(e,t){if(e.constructor==n)return e;if(r[e])return r[e].setLang(t),r[e];return"string"==typeof e?function(){if(!l.a[e])throw"资源未定义:"+e;return r[e]=new n(l.a[e],t),r[e].init(),r[e]}():function(){return new n(l.a[e],t)}()},t.a=n},7:function(e,t,o){"use strict";var a={};"undefined"==typeof $ASAL&&($ASAL={}),a["test.hashtable"]={hashtable:{SS:"春夏",FW:"秋冬",XX:"经典"}},a["test.hashlist"]={hashlist:{SS:{tname:"春夏",tvalue:"SS"},FW:{tname:"秋冬",tvalue:"FW"},XX:{tname:"经典",tvalue:"XX"}},oplabel:"tname",opvalue:"tvalue"},a["test.datalist"]={datalist:[{tname:"春夏",tvalue:"SS"},{tname:"秋冬",tvalue:"FW"},{tname:"经典",tvalue:"XX"}],oplabel:"tname",opvalue:"tvalue"},a.brand={url:"/brand/list",oplabel:"name",opvalue:"id"},a.country={url:"/country/list",oplabel:"name",opvalue:"id"},a.colortemplate={url:"/colortemplate/list",oplabel:"name",opvalue:"id"},a.brandgroup={url:"/brandgroup/list",oplabel:"name",opvalue:"id"},a.group={url:"/group/list",oplabel:"group_name",opvalue:"id"},a.user={url:"/user/list",oplabel:"login_name",opvalue:"id"},a["department.single"]={url:"/department/single",oplabel:"label",opvalue:"id"},a.childproductgroup={url:"/childproductgroup/list",oplabel:"name",opvalue:"id"},a.materialstatus={url:"/materialstatus/list",oplabel:"name",opvalue:"id"},a.occasionsstyle={url:"/occasionsstyle/list",oplabel:"name",opvalue:"id"},a.ulnarinch={url:"/ulnarinch/list",oplabel:"name",opvalue:"id"},a.ageseason={url:"/ageseason/list",oplabel:"fullname",opvalue:"id"},a.aliases={url:"/aliases/list",oplabel:"name",opvalue:"id"},a.winterproofing={url:"/winterproofing/list",oplabel:"name",opvalue:"id"},a.sizetop={url:"/sizetop/list",oplabel:"name",opvalue:"id"},a.sizecontent={url:"/sizecontent/list",oplabel:"content",opvalue:"id"},a.member={url:"/member/list",oplabel:"name",opvalue:"id"},a.executioncategory={url:"/executioncategory/list",oplabel:"name",opvalue:"id"},a.securitycategory={url:"/securitycategory/list",oplabel:"name",opvalue:"id"},a.warehouse={url:"/warehouse/list",oplabel:"name",opvalue:"id"},a.supplier={url:"/supplier/list",oplabel:"suppliername",opvalue:"id"},a.saleport={url:"/saleport/list",oplabel:"name",opvalue:"id"},a.userwarehouse={url:"/warehouse/userlist",oplabel:"name",opvalue:"id"},a.gender={hashtable:$ASAL.list_gender},a.gender2={hashtable:$ASAL.list_gender2},a.currency={hashlist:$ASAL.list_currency,oplabel:"name",opvalue:"id"},a.season={hashtable:$ASAL.list_season},a.orderproperty={hashtable:$ASAL.list_orderproperty},a.bussinesstype={hashlist:$ASAL.list_bussinesstype,oplabel:"name",opvalue:"id"},a.sessionmark={hashtable:{SS:"SS",FW:"FW",XX:"XX"}},a.seasontype={hashtable:{0:"Pre",1:"Main",2:"Fashion"}},a.formtype={hashtable:$ASAL.list_formtype},a.languages={hashlist:$ASAL.list_languages,oplabel:"name",opvalue:"code"},a.pickingtype={hashtable:$ASAL.list_pickingtype},a.expresspaidtype={hashtable:$ASAL.list_expresspaidtype},a.transporttype={hashtable:$ASAL.list_transporttype},a.paytype={hashtable:$ASAL.list_paytype},a.salestatus={hashtable:$ASAL.list_salestatus},a.orderstatus={hashtable:$ASAL.list_ordertatus},a.confirmstatusstatus={hashtable:$ASAL.list_confirmstatusstatus},a.requisitiontype={hashtable:$ASAL.list_requisitiontype},a.requisitionstatus={hashtable:$ASAL.list_requisitionstatus},t.a=a}});
//# sourceMappingURL=shop.js.map