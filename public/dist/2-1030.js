webpackJsonp([2],{291:function(e,t,r){"use strict";function n(e){r(379)}Object.defineProperty(t,"__esModule",{value:!0});var a=r(343),o=r(383),s=r(0),i=n,l=s(a.a,o.a,!1,i,null,null);t.default=l.exports},315:function(e,t,r){"use strict";r.d(t,"a",function(){return o});var n=r(182),a=r.n(n),o=function(e){var t={};return{get:function(r){return t[r]||(t[r]=a.a.cloneDeep(e)),t[r]},result:function(){return t}}}},317:function(e,t){function r(e,t){var r=e[1]||"",a=e[3];if(!a)return r;if(t&&"function"==typeof btoa){var o=n(a);return[r].concat(a.sources.map(function(e){return"/*# sourceURL="+a.sourceRoot+e+" */"})).concat([o]).join("\n")}return[r].join("\n")}function n(e){return"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(e))))+" */"}e.exports=function(e){var t=[];return t.toString=function(){return this.map(function(t){var n=r(t,e);return t[2]?"@media "+t[2]+"{"+n+"}":n}).join("")},t.i=function(e,r){"string"==typeof e&&(e=[[null,e,""]]);for(var n={},a=0;a<this.length;a++){var o=this[a][0];"number"==typeof o&&(n[o]=!0)}for(a=0;a<e.length;a++){var s=e[a];"number"==typeof s[0]&&n[s[0]]||(r&&!s[2]?s[2]=r:r&&(s[2]="("+s[2]+") and ("+r+")"),t.push(s))}},t}},318:function(e,t,r){function n(e){for(var t=0;t<e.length;t++){var r=e[t],n=u[r.id];if(n){n.refs++;for(var a=0;a<n.parts.length;a++)n.parts[a](r.parts[a]);for(;a<r.parts.length;a++)n.parts.push(o(r.parts[a]));n.parts.length>r.parts.length&&(n.parts.length=r.parts.length)}else{for(var s=[],a=0;a<r.parts.length;a++)s.push(o(r.parts[a]));u[r.id]={id:r.id,refs:1,parts:s}}}}function a(){var e=document.createElement("style");return e.type="text/css",d.appendChild(e),e}function o(e){var t,r,n=document.querySelector("style["+v+'~="'+e.id+'"]');if(n){if(m)return h;n.parentNode.removeChild(n)}if(_){var o=p++;n=f||(f=a()),t=s.bind(null,n,o,!1),r=s.bind(null,n,o,!0)}else n=a(),t=i.bind(null,n),r=function(){n.parentNode.removeChild(n)};return t(e),function(n){if(n){if(n.css===e.css&&n.media===e.media&&n.sourceMap===e.sourceMap)return;t(e=n)}else r()}}function s(e,t,r,n){var a=r?"":n.css;if(e.styleSheet)e.styleSheet.cssText=w(t,a);else{var o=document.createTextNode(a),s=e.childNodes;s[t]&&e.removeChild(s[t]),s.length?e.insertBefore(o,s[t]):e.appendChild(o)}}function i(e,t){var r=t.css,n=t.media,a=t.sourceMap;if(n&&e.setAttribute("media",n),b.ssrId&&e.setAttribute(v,t.id),a&&(r+="\n/*# sourceURL="+a.sources[0]+" */",r+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(a))))+" */"),e.styleSheet)e.styleSheet.cssText=r;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(r))}}var l="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!l)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var c=r(319),u={},d=l&&(document.head||document.getElementsByTagName("head")[0]),f=null,p=0,m=!1,h=function(){},b=null,v="data-vue-ssr-id",_="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());e.exports=function(e,t,r,a){m=r,b=a||{};var o=c(e,t);return n(o),function(t){for(var r=[],a=0;a<o.length;a++){var s=o[a],i=u[s.id];i.refs--,r.push(i)}t?(o=c(e,t),n(o)):o=[];for(var a=0;a<r.length;a++){var i=r[a];if(0===i.refs){for(var l=0;l<i.parts.length;l++)i.parts[l]();delete u[i.id]}}}};var w=function(){var e=[];return function(t,r){return e[t]=r,e.filter(Boolean).join("\n")}}()},319:function(e,t){e.exports=function(e,t){for(var r=[],n={},a=0;a<t.length;a++){var o=t[a],s=o[0],i=o[1],l=o[2],c=o[3],u={id:e+":"+a,css:i,media:l,sourceMap:c};n[s]?n[s].parts.push(u):r.push(n[s]={id:s,parts:[u]})}return r}},326:function(e,t,r){"use strict";t.a={inject:["bus"],data:function(){return{mypath:""}},created:function(){var e=this;e.bus.$on("close",function(t){t===e.mypath&&e.$destroy()})},beforeDestroy:function(){this.bus.$off("close")},mounted:function(){this.mypath=this.$route.path}}},343:function(e,t,r){"use strict";var n=r(185),a=r.n(n),o=r(26),s=r.n(o),i=r(181),l=r.n(i),c=r(12),u=r.n(c),d=r(55),f=r.n(d),p=r(13),m=r.n(p),h=r(1),b=r(35),v=r(7),_=r(36),w=r(326),y=r(381),x=r(315),g=function(e){return{loadPrice:function(){var t=this;return m()(u.a.mark(function r(){var n,a,o,s,i,l,c,d,p,m,h,b,v,w,y;return u.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(""!=e.form.priceid){t.next=2;break}return t.abrupt("return");case 2:if(n=e.computeProductPrice,a=[],e.tabledata.forEach(function(t){var r=t.product.id;void 0===n[r]&&(e.productPrices.push({productid:r,priceid:e.form.priceid,price:""}),a.push(r))}),!(a.length>0)){t.next=52;break}return t.next=8,_.a.getPriceByProductIds("",a.join(","));case 8:o=t.sent,s=!0,i=!1,l=void 0,t.prev=12,c=f()(o);case 14:if(s=(d=c.next()).done){t.next=38;break}for(p=d.value,m=!0,h=!1,b=void 0,t.prev=19,v=f()(e.productPrices);!(m=(w=v.next()).done);m=!0)y=w.value,p.productid==y.productid&&p.id==y.priceid&&(y.price=p.price);t.next=27;break;case 23:t.prev=23,t.t0=t.catch(19),h=!0,b=t.t0;case 27:t.prev=27,t.prev=28,!m&&v.return&&v.return();case 30:if(t.prev=30,!h){t.next=33;break}throw b;case 33:return t.finish(30);case 34:return t.finish(27);case 35:s=!0,t.next=14;break;case 38:t.next=44;break;case 40:t.prev=40,t.t1=t.catch(12),i=!0,l=t.t1;case 44:t.prev=44,t.prev=45,!s&&c.return&&c.return();case 47:if(t.prev=47,!i){t.next=50;break}throw l;case 50:return t.finish(47);case 51:return t.finish(44);case 52:case"end":return t.stop()}},r,t,[[12,40,44,52],[19,23,27,35],[28,,30,34],[45,,47,51]])}))()}}};t.a={name:"sp-salescreate",mixins:[w.a],components:l()({},y.a.name,y.a),data:function(){return{search:{wordcode:"",sizecontentid:"",goods_code:"",number:"1"},product:"",options:[],productstocks:[],index:1,form:{memberid:"",salesstaff:"",externalno:"",warehouseid:"",salesdate:"",ordercode:"",pickingtype:"",expresspaidtype:"",expressno:"",expressfee:"",address:"",saleportid:"",status:"0",priceid:"",makestaff:"",makedate:"",id:""},tabledata:[],pricename:"",productPrices:[]}},methods:{onFocus:function(e){this.$refs[e].select()},onClick:function(){var e=this;return m()(u.a.mark(function t(){var r,n,a,o,s;return u.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(r=e,n="wordcode",r.product||!(r.search.goods_code.length>0)){t.next=13;break}return t.next=5,_.a.getProductByCode(r.search.goods_code);case 5:if(!(a=t.sent)){t.next=12;break}return t.next=9,b.e.load({data:a.productid,depth:1});case 9:o=t.sent,r.search.sizecontentid=a.sizecontentid,r.product=o;case 12:n="goods_code";case 13:if(r.product&&r.search.number.match(/^\d+$/)&&""!=r.search.sizecontentid){t.next=15;break}return t.abrupt("return");case 15:return t.next=17,_.a.getProductstock({productid:r.product.id,sizecontentid:r.search.sizecontentid});case 17:return s=t.sent,s.forEach(function(e){r.productstocks.push(e)}),r.tabledata.push({index:r.index,product:r.product,number:r.search.number,sizecontentid:r.search.sizecontentid,property:1,defective_level:1,dealprice:"",warehouselist:[]}),r.index+=1,r.product="",r.options=[],Object(h.g)(r.search),r.search.number="1",t.next=27,g(r).loadPrice();case 27:setTimeout(function(){r.$refs[n].focus()},100);case 28:case"end":return t.stop()}},t,e)}))()},searchProduct:function(e,t){var r=this;return m()(u.a.mark(function e(){var n,a;return u.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:if(n=r,""==n.search.wordcode){e.next=8;break}return e.next=4,_.a.getProductList(n.search.wordcode);case 4:a=e.sent,t(a),e.next=9;break;case 8:t([]);case 9:case"end":return e.stop()}},e,r)}))()},onPriceChange:function(e,t){this.pricename=t,g(this).loadPrice()},onSelect:function(e){var t=this;return m()(u.a.mark(function r(){var n,a;return u.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return n=t,r.next=3,b.e.load({data:e,depth:1});case 3:a=r.sent,n.options=[],a.sizecontents.forEach(function(e){n.options.push(e)}),n.product=a;case 7:case"end":return r.stop()}},r,t)}))()},sale:function(e){var t=this;if(0!=t.tabledata.length){var r=Object(v.b)({},t.form);r.status=e;var n={form:r};n.list=t.tabledata.map(function(e){return{productid:e.product.id,sizecontentid:e.sizecontentid,defective_level:e.defective_level,property:e.property,dealprice:e.dealprice,number:e.number,price:t.computeProductPrice[e.product.id],priceid:t.form.priceid}}),n.requisitions=[];var a=!0,o=!1,i=void 0;try{for(var l,c=f()(t.tabledata);!(a=(l=c.next()).done);a=!0){var u=l.value;if(t.dispatches[u.index]!=u.number)return alert("kucunbuzu");var d=!0,p=!1,m=void 0;try{for(var h,b=f()(u.warehouselist);!(d=(h=b.next()).done);d=!0){var _=h.value;t.form.warehouseid!=_.warehouseid&&n.requisitions.push({productid:u.product.id,sizecontentid:u.sizecontentid,defective_level:u.defective_level,property:u.property,warehouseid:_.warehouseid,number:_.number})}}catch(e){p=!0,m=e}finally{try{!d&&b.return&&b.return()}finally{if(p)throw m}}}}catch(e){o=!0,i=e}finally{try{!a&&c.return&&c.return()}finally{if(o)throw i}}t._log(s()(n)),t.confirm()&&t._submit("/sales/savesale",{params:s()(n)}).then(function(e){t.$emit("change",e.data.form),t._redirect("/sales/"+e.data.form.id)})}},deleteRow:function(e,t){var r=this;r.$delete(r.tabledata,e)}},computed:{tablerows:function(){var e=this,t=[];return e.tabledata.forEach(function(e){t.push(e)}),t.push({type:"foot"}),t},computeProductPrice:function(){var e=this,t=a()(null);return e.productPrices.forEach(function(r){r.priceid==e.form.priceid&&(t[r.productid]=r.price)}),t},stockStat:function(){var e=this,t={};return e.productstocks.forEach(function(e){var r=[e.productid,e.sizecontentid,e.property,e.defective_level,e.warehouseid].join("-");t[r]=e.number-e.reserve_number}),t},stocks:function(){var e=this,t={},r=e.stockStat;return e.tabledata.forEach(function(n){var a=[n.product.id,n.sizecontentid,n.property,n.defective_level,e.form.warehouseid].join("-");t[n.index]=r[a]||0}),t},warehouseStocks:function(){var e=this,t={},r=Object(x.a)([]);return e.productstocks.forEach(function(e){var t=[e.productid,e.sizecontentid,e.property,e.defective_level].join("-");r.get(t).push({warehouseid:e.warehouseid,stock_number:e.number-e.reserve_number})}),e.tabledata.forEach(function(e){var n=[e.product.id,e.sizecontentid,e.property,e.defective_level].join("-");t[e.index]=r.get(n)}),t},dispatches:function(){var e=this,t=e._newbox();return e.tabledata.forEach(function(e){var r=0;e.warehouselist.forEach(function(e){e.number<=e.stock_number&&(r+=1*e.number)}),t[e.index]=r}),t}},mounted:function(){var e=this;return m()(u.a.mark(function t(){var r,n;return u.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return r=e,r._setTitle(r._label("xinjianxiaoshoudan")),t.next=4,_.a.getSetting();case 4:n=t.sent,r.form.saleportid=n.saleportid,r.form.warehouseid=n.warehouseid,r.form.priceid=n.priceid;case 8:case"end":return t.stop()}},t,e)}))()}}},344:function(e,t,r){"use strict";var n=r(55),a=r.n(n),o=r(59),s=r.n(o);t.a={name:"sp-sales-select",props:{stocks:{},list:{},warehouseid:{},number:{},"is-dispatch":{}},data:function(){return{tabledata:[]}},model:{prop:"list",event:"change"},methods:{onFocus:function(e){this.$refs[e].select()},onChange:function(){var e=this,t=e.tabledata.map(function(t){return t.number>t.stock_number&&e._info(e._label("kucunbuzu")),{warehouseid:t.warehouseid,number:t.number,stock_number:t.stock_number}}).filter(function(e){return e.number>0});e.$emit("change",t)},init:function(){var e=this;e.stocks.forEach(function(t){var r=e.list.find(function(e){return e.warehouseid==t.warehouseid});t.number=r?r.number:"",e.tabledata.push(t)});for(var t=0;t<e.tabledata.length;t++)if(e.tabledata[t].warehouseid==e.warehouseid){var r=e.tabledata.splice(t,1),n=s()(r,1),a=n[0];e.tabledata.unshift(a)}e.initLocalNumber(),e.onChange()},initLocalNumber:function(){var e=this,t=!0,r=!1,n=void 0;try{for(var o,s=a()(e.tabledata);!(t=(o=s.next()).done);t=!0){var i=o.value;if(i.warehouseid!=e.warehouseid&&i.number>0)return}}catch(e){r=!0,n=e}finally{try{!t&&s.return&&s.return()}finally{if(r)throw n}}var l=!0,c=!1,u=void 0;try{for(var d,f=a()(e.tabledata);!(l=(d=f.next()).done);l=!0){var p=d.value;if(p.warehouseid==e.warehouseid){p.number=Math.min(p.stock_number,e.number);break}}}catch(e){c=!0,u=e}finally{try{!l&&f.return&&f.return()}finally{if(c)throw u}}}},mounted:function(){this.init()},watch:{number:function(){this.initLocalNumber(),this.onChange()}}}},379:function(e,t,r){var n=r(380);"string"==typeof n&&(n=[[e.i,n,""]]),n.locals&&(e.exports=n.locals);r(318)("9820ba48",n,!0,{})},380:function(e,t,r){t=e.exports=r(317)(!1),t.push([e.i,".number .el-input__inner{padding:0 5px}",""])},381:function(e,t,r){"use strict";var n=r(344),a=r(382),o=r(0),s=o(n.a,a.a,!1,null,null,null);t.a=s.exports},382:function(e,t,r){"use strict";var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-popover",{attrs:{placement:"right",width:"400",trigger:"click"}},[r("el-table",{attrs:{data:e.tabledata}},[r("el-table-column",{attrs:{width:"180",label:e._label("cangku")},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.warehouseid,source:"warehouse"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{width:"110",label:e._label("kucun"),prop:"stock_number"}}),e._v(" "),r("el-table-column",{attrs:{width:"110",label:e._label("shuliang")},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-input",{ref:n.warehouseid,attrs:{size:"mini"},on:{change:e.onChange,focus:function(t){return e.onFocus(n.warehouseid)}},model:{value:n.number,callback:function(t){e.$set(n,"number",t)},expression:"row.number"}})]}}])})],1),e._v(" "),r("el-button",{attrs:{slot:"reference",size:"mini",type:e.isDispatch?"success":"warning"},slot:"reference"},[e._v(e._s(e._label("xuanze")))])],1)],1)},a=[],o={render:n,staticRenderFns:a};t.a=o},383:function(e,t,r){"use strict";var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini"}},[r("el-row",{attrs:{gutter:0}},[r("au-button",{attrs:{auth:"sales",type:0==e.tabledata.length?"info":"primary"},on:{click:function(t){return e.sale(1)}}},[e._v(e._s(e._label("yushou")))]),e._v(" "),r("au-button",{attrs:{auth:"sales",type:0==e.tabledata.length?"info":"primary"},on:{click:function(t){return e.sale(2)}}},[e._v(e._s(e._label("xiaoshou")))])],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("xiaoshouduankou")}},[r("simple-select",{ref:"saleportid",attrs:{source:"usersaleport",clearable:!1},model:{value:e.form.saleportid,callback:function(t){e.$set(e.form,"saleportid",t)},expression:"form.saleportid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jiage")}},[r("simple-select",{ref:"priceid",attrs:{source:"userprice",disabled:0!=e.form.status,clearable:!1},on:{change:e.onPriceChange},model:{value:e.form.priceid,callback:function(t){e.$set(e.form,"priceid",t)},expression:"form.priceid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xiaoshoucangku")}},[r("simple-select",{attrs:{source:"userwarehouse",disabled:0!=e.form.status,clearable:!1},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1),e._v(" "),e.form.warehouseid>0?r("el-form-item",{attrs:{label:e._label("xiaoshouriqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.salesdate,callback:function(t){e.$set(e.form,"salesdate",t)},expression:"form.salesdate"}})],1):e._e(),e._v(" "),e.form.warehouseid>0?r("el-form-item",{attrs:{label:e._label("huiyuan")}},[r("simple-select",{attrs:{source:"member"},model:{value:e.form.memberid,callback:function(t){e.$set(e.form,"memberid",t)},expression:"form.memberid"}})],1):e._e()],1),e._v(" "),e.form.warehouseid>0?r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("xiaoshouren")}},[r("simple-select",{attrs:{source:"user"},model:{value:e.form.salesstaff,callback:function(t){e.$set(e.form,"salesstaff",t)},expression:"form.salesstaff"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("waitudingdanhao")}},[r("el-input",{model:{value:e.form.externalno,callback:function(t){e.$set(e.form,"externalno",t)},expression:"form.externalno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("duizhangdanhao")}},[r("el-input",{model:{value:e.form.ordercode,callback:function(t){e.$set(e.form,"ordercode",t)},expression:"form.ordercode"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanriqi")}},[r("el-input",{attrs:{value:e.form.makedate,placeholder:e._label("zidonghuoqu"),disabled:""}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanren")}},[r("sp-display-input",{attrs:{value:e.form.makestaff,source:"user"}})],1)],1):e._e(),e._v(" "),e.form.warehouseid>0?r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("tihuofangshi")}},[r("simple-select",{attrs:{source:"pickingtype"},model:{value:e.form.pickingtype,callback:function(t){e.$set(e.form,"pickingtype",t)},expression:"form.pickingtype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("kuaidifukuanfang")}},[r("simple-select",{attrs:{source:"expresspaidtype"},model:{value:e.form.expresspaidtype,callback:function(t){e.$set(e.form,"expresspaidtype",t)},expression:"form.expresspaidtype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("kuaididanhao")}},[r("el-input",{model:{value:e.form.expressno,callback:function(t){e.$set(e.form,"expressno",t)},expression:"form.expressno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("kuaidifeiyong")}},[r("el-input",{model:{value:e.form.expressfee,callback:function(t){e.$set(e.form,"expressfee",t)},expression:"form.expressfee"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shouhuodizhi")}},[r("el-input",{model:{value:e.form.address,callback:function(t){e.$set(e.form,"address",t)},expression:"form.address"}})],1)],1):e._e()],1)],1),e._v(" "),r("el-form",{attrs:{model:e.form,inline:!0,size:"mini"},nativeOn:{submit:function(e){e.preventDefault()}}},[e.form.warehouseid>0?r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tablerows,stripe:"",border:""}},[r("el-table-column",{attrs:{label:e._label("guojima"),align:"left",width:"250"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[n.type?e._e():r("sp-product-tip",{attrs:{product:n.product}}),e._v(" "),"foot"==n.type?r("el-autocomplete",{ref:"wordcode",staticStyle:{width:"100%"},attrs:{placeholder:e._label("guojima"),"fetch-suggestions":e.searchProduct,"value-key":"wordcode",size:"mini"},on:{select:e.onSelect},model:{value:e.search.wordcode,callback:function(t){e.$set(e.search,"wordcode",t)},expression:"search.wordcode"}}):e._e()]}}],null,!1,311346372)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chima"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[n.type?e._e():r("sp-select-text",{attrs:{value:n.sizecontentid,source:"sizecontent"}}),e._v(" "),"foot"==n.type?r("el-select",{ref:"select",staticStyle:{width:"150"},attrs:{placeholder:e._label("chima"),size:"mini"},model:{value:e.search.sizecontentid,callback:function(t){e.$set(e.search,"sizecontentid",t)},expression:"search.sizecontentid"}},e._l(e.options,function(e){return r("el-option",{key:e.id+e.name,attrs:{value:e.id,label:e.name}})}),1):e._e()]}}],null,!1,3364720593)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shangpintiaoma"),align:"center",width:"150"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[n.type?e._e():r("sp-product-code",{attrs:{productid:n.product.id,sizecontentid:n.sizecontentid}}),e._v(" "),"foot"==n.type?r("el-input",{ref:"goods_code",attrs:{placeholder:e._label("shangpintiaoma"),size:"mini"},model:{value:e.search.goods_code,callback:function(t){e.$set(e.search,"goods_code",t)},expression:"search.goods_code"}}):e._e()]}}],null,!1,4121935237)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shuliang"),width:"70",align:"left"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[n.type?e._e():r("el-input",{ref:n.index,staticClass:"number",attrs:{size:"mini",disabled:e.form.status>=2},on:{focus:function(t){return e.onFocus(n.index)}},model:{value:n.number,callback:function(t){e.$set(n,"number",t)},expression:"row.number"}}),e._v(" "),"foot"==n.type?r("el-input",{attrs:{placeholder:e._label("shuliang"),size:"mini"},model:{value:e.search.number,callback:function(t){e.$set(e.search,"number",t)},expression:"search.number"}}):e._e()]}}],null,!1,1341464252)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chengjiaojia"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[n.type?e._e():r("el-input",{staticClass:"number",staticStyle:{width:"100%"},attrs:{size:"mini"},model:{value:n.dealprice,callback:function(t){e.$set(n,"dealprice",t)},expression:"row.dealprice"}}),e._v(" "),"foot"==n.type?r("el-button",{staticStyle:{margin:"0px"},attrs:{type:"primary","native-type":"submit",size:"mini"},on:{click:e.onClick}},[e._v(e._s(e._label("zengjia")))]):e._e()]}}],null,!1,3573332018)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("kucunshuliang"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[n.type?e._e():r("span",[e._v(e._s(e.stocks[n.index]))])]}}],null,!1,2310171949)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("xuanze"),width:"70",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[n.type?e._e():r("sp-sales-select",{attrs:{stocks:e.warehouseStocks[n.index],warehouseid:e.form.warehouseid,number:n.number,"is-dispatch":e.dispatches[n.index]==n.number},model:{value:n.warehouselist,callback:function(t){e.$set(n,"warehouselist",t)},expression:"row.warehouselist"}})]}}],null,!1,134795132)}),e._v(" "),r("el-table-column",{attrs:{label:e.pricename,width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[n.type?e._e():r("span",[e._v(e._s(e.computeProductPrice[n.product.id]))])]}}],null,!1,1757317787)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zongjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[n.type?e._e():r("span",[e._v(e._s(n.dealprice*n.number))])]}}],null,!1,3969002282)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shuxing"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[n.type?e._e():r("simple-select",{attrs:{source:"orderproperty"},model:{value:n.property,callback:function(t){e.$set(n,"property",t)},expression:"row.property"}})]}}],null,!1,4262287465)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("canpin"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[n.type?e._e():r("simple-select",{attrs:{source:"defectivelevel"},model:{value:n.defective_level,callback:function(t){e.$set(n,"defective_level",t)},expression:"row.defective_level"}})]}}],null,!1,4153286584)}),e._v(" "),0==e.form.status||1==e.form.status?r("el-table-column",{attrs:{label:e._label("caozuo"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row,a=t.$index;return[n.type?e._e():r("as-button",{attrs:{size:"mini",type:"danger"},on:{click:function(t){return e.deleteRow(a,n)}}},[e._v(e._s(e._label("shanchu")))])]}}],null,!1,2119887568)}):e._e()],1):e._e()],1)],1)},a=[],o={render:n,staticRenderFns:a};t.a=o}});
//# sourceMappingURL=2-1030.js.map