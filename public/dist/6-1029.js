webpackJsonp([6],{292:function(e,t,r){"use strict";function a(e){r(384)}Object.defineProperty(t,"__esModule",{value:!0});var n=r(345),s=r(386),o=r(0),i=a,l=o(n.a,s.a,!1,i,null,null);t.default=l.exports},315:function(e,t,r){"use strict";r.d(t,"a",function(){return s});var a=r(182),n=r.n(a),s=function(e){var t={};return{get:function(r){return t[r]||(t[r]=n.a.cloneDeep(e)),t[r]},result:function(){return t}}}},317:function(e,t){function r(e,t){var r=e[1]||"",n=e[3];if(!n)return r;if(t&&"function"==typeof btoa){var s=a(n);return[r].concat(n.sources.map(function(e){return"/*# sourceURL="+n.sourceRoot+e+" */"})).concat([s]).join("\n")}return[r].join("\n")}function a(e){return"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(e))))+" */"}e.exports=function(e){var t=[];return t.toString=function(){return this.map(function(t){var a=r(t,e);return t[2]?"@media "+t[2]+"{"+a+"}":a}).join("")},t.i=function(e,r){"string"==typeof e&&(e=[[null,e,""]]);for(var a={},n=0;n<this.length;n++){var s=this[n][0];"number"==typeof s&&(a[s]=!0)}for(n=0;n<e.length;n++){var o=e[n];"number"==typeof o[0]&&a[o[0]]||(r&&!o[2]?o[2]=r:r&&(o[2]="("+o[2]+") and ("+r+")"),t.push(o))}},t}},318:function(e,t,r){function a(e){for(var t=0;t<e.length;t++){var r=e[t],a=c[r.id];if(a){a.refs++;for(var n=0;n<a.parts.length;n++)a.parts[n](r.parts[n]);for(;n<r.parts.length;n++)a.parts.push(s(r.parts[n]));a.parts.length>r.parts.length&&(a.parts.length=r.parts.length)}else{for(var o=[],n=0;n<r.parts.length;n++)o.push(s(r.parts[n]));c[r.id]={id:r.id,refs:1,parts:o}}}}function n(){var e=document.createElement("style");return e.type="text/css",d.appendChild(e),e}function s(e){var t,r,a=document.querySelector("style["+v+'~="'+e.id+'"]');if(a){if(m)return b;a.parentNode.removeChild(a)}if(_){var s=p++;a=f||(f=n()),t=o.bind(null,a,s,!1),r=o.bind(null,a,s,!0)}else a=n(),t=i.bind(null,a),r=function(){a.parentNode.removeChild(a)};return t(e),function(a){if(a){if(a.css===e.css&&a.media===e.media&&a.sourceMap===e.sourceMap)return;t(e=a)}else r()}}function o(e,t,r,a){var n=r?"":a.css;if(e.styleSheet)e.styleSheet.cssText=y(t,n);else{var s=document.createTextNode(n),o=e.childNodes;o[t]&&e.removeChild(o[t]),o.length?e.insertBefore(s,o[t]):e.appendChild(s)}}function i(e,t){var r=t.css,a=t.media,n=t.sourceMap;if(a&&e.setAttribute("media",a),h.ssrId&&e.setAttribute(v,t.id),n&&(r+="\n/*# sourceURL="+n.sources[0]+" */",r+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(n))))+" */"),e.styleSheet)e.styleSheet.cssText=r;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(r))}}var l="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!l)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var u=r(319),c={},d=l&&(document.head||document.getElementsByTagName("head")[0]),f=null,p=0,m=!1,b=function(){},h=null,v="data-vue-ssr-id",_="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());e.exports=function(e,t,r,n){m=r,h=n||{};var s=u(e,t);return a(s),function(t){for(var r=[],n=0;n<s.length;n++){var o=s[n],i=c[o.id];i.refs--,r.push(i)}t?(s=u(e,t),a(s)):s=[];for(var n=0;n<r.length;n++){var i=r[n];if(0===i.refs){for(var l=0;l<i.parts.length;l++)i.parts[l]();delete c[i.id]}}}};var y=function(){var e=[];return function(t,r){return e[t]=r,e.filter(Boolean).join("\n")}}()},319:function(e,t){e.exports=function(e,t){for(var r=[],a={},n=0;n<t.length;n++){var s=t[n],o=s[0],i=s[1],l=s[2],u=s[3],c={id:e+":"+n,css:i,media:l,sourceMap:u};a[o]?a[o].parts.push(c):r.push(a[o]={id:o,parts:[c]})}return r}},326:function(e,t,r){"use strict";t.a={inject:["bus"],data:function(){return{mypath:""}},created:function(){var e=this;e.bus.$on("close",function(t){t===e.mypath&&e.$destroy()})},beforeDestroy:function(){this.bus.$off("close")},mounted:function(){this.mypath=this.$route.path}}},345:function(e,t,r){"use strict";var a=r(185),n=r.n(a),s=r(5),o=r.n(s),i=r(26),l=r.n(i),u=r(12),c=r.n(u),d=r(13),f=r.n(d),p=r(1),m=r(35),b=r(7),h=r(36),v=r(326),_=(r(315),function(e){return{loadPrice:function(){var t=this;return f()(c.a.mark(function r(){var a,n,s;return c.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(""!=e.form.priceid){t.next=2;break}return t.abrupt("return");case 2:if(a=e.computeProductPrice,n=[],e.tabledata.forEach(function(t){var r=t.productstock.productid;void 0===a[r]&&(e.productPrices.push({productid:r,priceid:e.form.priceid,price:""}),n.push(r))}),!(n.length>0)){t.next=10;break}return t.next=8,h.a.getPriceByProductIds("",n.join(","));case 8:s=t.sent,s.forEach(function(t){e.productPrices.forEach(function(e){t.productid==e.productid&&t.id==e.priceid&&(e.price=t.price)})});case 10:case"end":return t.stop()}},r,t)}))()}}});t.a={name:"sp-salesupdate",mixins:[v.a],data:function(){return{form:{memberid:"",salesstaff:"",externalno:"",warehouseid:"",salesdate:"",ordercode:"",pickingtype:"",expresspaidtype:"",expressno:"",expressfee:"",address:"",saleportid:"",status:"",priceid:"",makestaff:"",makedate:"",id:""},salesdetail:[],tabledata:[],base:{warehouseid:""},pricename:"",productPrices:[],props:{columns:[{name:"payment_type",label:Object(p.d)("fukuanleixing"),type:"select",source:"paymenttype",width:110},{name:"currency",label:Object(p.d)("bizhong"),type:"select",source:"currency",width:90},{name:"amount",label:Object(p.d)("jine"),width:110},{name:"paymentdate",label:Object(p.d)("fukuanriqi"),type:"date",width:110},{name:"memo",label:Object(p.d)("beizhu"),width:150},{name:"makestaff",label:Object(p.d)("tijiaoren"),type:"select",source:"user",is_edit_hide:!0,width:130},{name:"status",label:Object(p.d)("yiruzhang"),type:"switch",is_edit_hide:!0,width:90}],controller:"salesreceive",auth:"sales",base:{salesid:""},options:{isedit:function(e){return 0==e.status},isdelete:function(e){return 0==e.status}}}}},methods:{onPriceChange:function(e,t){this.pricename=t,_(this).loadPrice()},addReceive:function(){var e=this;e.form.id>0&&(e._showDialog("receive-dialog"),e.props.base.salesid=e.form.id)},onWarehouseChange:function(e){this.base.warehouseid=e},save:function(){var e=this;if(e.confirm()){var t=Object(b.b)({},e.form),r={form:t};r.list=e.tabledata.filter(function(t){var r=e.salesdetail.find(function(e){return e.id==t.id});return r.dealprice!=t.dealprice||r.number!=t.number}).map(function(e){return{id:e.id,dealprice:e.dealprice,number:e.number}}),r.deletelist=e.salesdetail.filter(function(t){return!e.tabledata.find(function(e){return e.id==t.id})}).map(function(e){return e.id}),console.log(l()(r)),e._submit("/sales/save",{params:l()(r)}).then(function(t){e.load()})}},sale:function(){var e=this;e.confirm()&&e._submit("/sales/sale",{id:e.form.id}).then(function(t){e.load()})},cancel:function(){var e=this;e.confirm()&&e._submit("/sales/cancel",{id:e.form.id}).then(function(t){e.load()})},appendRow:function(e){var t=this;return f()(c.a.mark(function r(){var a,n;return c.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return a=t,r.next=3,m.f.load({data:e.productstock,depth:1});case 3:return n=r.sent,e.productstock=n,a.tabledata.push(e),r.abrupt("return",e);case 7:case"end":return r.stop()}},r,t)}))()},load:function(){var e=this;return f()(c.a.mark(function t(){var r,a,n,s,i;return c.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return r=e,a=r.$route,r._setTitle("loading..."),t.next=5,r._fetch("/sales/loadsale",{id:a.params.id});case 5:if(n=t.sent,r.tabledata=[],Object(b.a)(n.data.form,r.form),!n.data.list){t.next=18;break}return r.salesdetail=n.data.list,s=n.data.list.map(function(e){return r.appendRow(Object(b.b)({},e))}),t.next=13,o.a.all(s);case 13:return i=t.sent,_(r).loadPrice(),t.next=17,r._dataSource("price").getLabel(r.form.priceid);case 17:r.pricename=t.sent;case 18:r._setTitle(r._label("xiaoshoudan")+":"+n.data.form.orderno);case 19:case"end":return t.stop()}},t,e)}))()},deleteRow:function(e,t){var r=this;r.$delete(r.tabledata,e)},getSummary:function(e){var t=e.columns,r=e.data,a=this,n=[];return t.forEach(function(e,t){if(0==t)return void(n[t]=a._label("heji"));3==t?n[t]=a.tabledata.reduce(function(e,t){return e+1*t.number},0):7==t&&(n[t]=a.tabledata.reduce(function(e,t){return e+t.dealprice*t.number},0))}),n[1]=r.length,n}},computed:{computeProductPrice:function(){var e=this,t=n()(null);return e.productPrices.forEach(function(r){r.priceid==e.form.priceid&&(t[r.productid]=r.price)}),t}},mounted:function(){this.load()}}},384:function(e,t,r){var a=r(385);"string"==typeof a&&(a=[[e.i,a,""]]),a.locals&&(e.exports=a.locals);r(318)("efb68bc6",a,!0,{})},385:function(e,t,r){t=e.exports=r(317)(!1),t.push([e.i,".number .el-input__inner{padding:0 5px}",""])},386:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini"}},[r("el-row",{attrs:{gutter:0}},["3"!=e.form.status?r("au-button",{attrs:{auth:"sales",type:"primary"},on:{click:e.save}},[e._v(e._s(e._label("baocun")))]):e._e(),e._v(" "),1==e.form.status?r("au-button",{attrs:{auth:"sales",type:"primary"},on:{click:e.sale}},[e._v(e._s(e._label("xiaoshou")))]):e._e(),e._v(" "),"1"==e.form.status?r("au-button",{attrs:{auth:"sales",type:"primary"},on:{click:e.cancel}},[e._v(e._s(e._label("zuofei")))]):e._e(),e._v(" "),e.form.id>0&&3!=e.form.status?r("au-button",{attrs:{auth:"sales",type:"primary"},on:{click:e.addReceive}},[e._v(e._s(e._label("tianjiashoukuan")))]):e._e(),e._v(" "),e.form.status>0?r("el-tag",{attrs:{type:"warning"}},[r("sp-select-text",{attrs:{value:e.form.status,source:"salestatus"}})],1):e._e()],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("xiaoshouduankou")}},[r("simple-select",{ref:"saleportid",attrs:{source:"usersaleport",clearable:!1},model:{value:e.form.saleportid,callback:function(t){e.$set(e.form,"saleportid",t)},expression:"form.saleportid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jiage")}},[r("simple-select",{ref:"priceid",attrs:{source:"userprice",disabled:""},on:{change:e.onPriceChange},model:{value:e.form.priceid,callback:function(t){e.$set(e.form,"priceid",t)},expression:"form.priceid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xiaoshoucangku")}},[r("simple-select",{attrs:{source:"userwarehouse",disabled:""},on:{change:e.onWarehouseChange},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1),e._v(" "),e.form.warehouseid>0?r("el-form-item",{attrs:{label:e._label("xiaoshouriqi")}},[r("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.salesdate,callback:function(t){e.$set(e.form,"salesdate",t)},expression:"form.salesdate"}})],1):e._e(),e._v(" "),e.form.warehouseid>0?r("el-form-item",{attrs:{label:e._label("huiyuan")}},[r("simple-select",{attrs:{source:"member"},model:{value:e.form.memberid,callback:function(t){e.$set(e.form,"memberid",t)},expression:"form.memberid"}})],1):e._e()],1),e._v(" "),e.form.warehouseid>0?r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("xiaoshouren")}},[r("simple-select",{attrs:{source:"user"},model:{value:e.form.salesstaff,callback:function(t){e.$set(e.form,"salesstaff",t)},expression:"form.salesstaff"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("waitudingdanhao")}},[r("el-input",{model:{value:e.form.externalno,callback:function(t){e.$set(e.form,"externalno",t)},expression:"form.externalno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("duizhangdanhao")}},[r("el-input",{model:{value:e.form.ordercode,callback:function(t){e.$set(e.form,"ordercode",t)},expression:"form.ordercode"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanriqi")}},[r("el-input",{attrs:{value:e.form.makedate,placeholder:e._label("zidonghuoqu"),disabled:""}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhidanren")}},[r("sp-display-input",{attrs:{value:e.form.makestaff,source:"user"}})],1)],1):e._e(),e._v(" "),e.form.warehouseid>0?r("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[r("el-form-item",{attrs:{label:e._label("tihuofangshi")}},[r("simple-select",{attrs:{source:"pickingtype"},model:{value:e.form.pickingtype,callback:function(t){e.$set(e.form,"pickingtype",t)},expression:"form.pickingtype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("kuaidifukuanfang")}},[r("simple-select",{attrs:{source:"expresspaidtype"},model:{value:e.form.expresspaidtype,callback:function(t){e.$set(e.form,"expresspaidtype",t)},expression:"form.expresspaidtype"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("kuaididanhao")}},[r("el-input",{model:{value:e.form.expressno,callback:function(t){e.$set(e.form,"expressno",t)},expression:"form.expressno"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("kuaidifeiyong")}},[r("el-input",{model:{value:e.form.expressfee,callback:function(t){e.$set(e.form,"expressfee",t)},expression:"form.expressfee"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shouhuodizhi")}},[r("el-input",{model:{value:e.form.address,callback:function(t){e.$set(e.form,"address",t)},expression:"form.address"}})],1)],1):e._e()],1)],1),e._v(" "),r("el-form",{attrs:{model:e.form,inline:!0,size:"mini"},nativeOn:{submit:function(e){e.preventDefault()}}},[e.form.warehouseid>0?r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,stripe:"",border:"","show-summary":!0,"summary-method":e.getSummary}},[r("el-table-column",{attrs:{label:e._label("guojima"),align:"left",width:"250"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-product-tip",{attrs:{product:t.productstock.product}})]}}],null,!1,3240663051)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chima"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.productstock.sizecontentid,source:"sizecontent"}})]}}],null,!1,35572469)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shangpintiaoma"),align:"center",width:"150"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-product-code",{attrs:{productid:t.productstock.productid,sizecontentid:t.productstock.sizecontentid}})]}}],null,!1,3309624028)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shuliang"),width:"70",align:"left"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("el-input",{staticClass:"number",staticStyle:{width:"100%"},attrs:{size:"mini",disabled:"1"!=e.form.status},model:{value:a.number,callback:function(t){e.$set(a,"number",t)},expression:"row.number"}})]}}],null,!1,2585054359)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chengjiaojia"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("el-input",{staticClass:"number",staticStyle:{width:"100%"},attrs:{size:"mini"},model:{value:a.dealprice,callback:function(t){e.$set(a,"dealprice",t)},expression:"row.dealprice"}})]}}],null,!1,2269190770)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("kucunshuliang"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("span",[e._v(e._s(a.productstock.number))])]}}],null,!1,2900167586)}),e._v(" "),r("el-table-column",{attrs:{label:e.pricename,width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("span",[e._v(e._s(e.computeProductPrice[a.productstock.productid]))])]}}],null,!1,735070482)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zongjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("span",[e._v(e._s(a.dealprice*a.number))])]}}],null,!1,1480306248)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shuxing"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.productstock.property,source:"orderproperty"}})]}}],null,!1,435211830)}),e._v(" "),r("el-table-column",{attrs:{label:e._label("canpin"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.productstock.defective_level,source:"defectivelevel"}})]}}],null,!1,1520283719)}),e._v(" "),1==e.form.status?r("el-table-column",{attrs:{label:e._label("caozuo"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row,n=t.$index;return[a.type?e._e():r("as-button",{attrs:{size:"mini",type:"danger"},on:{click:function(t){return e.deleteRow(n,a)}}},[e._v(e._s(e._label("shanchu")))])]}}],null,!1,2119887568)}):e._e()],1):e._e()],1),e._v(" "),r("sp-dialog",{ref:"receive-dialog",staticClass:"product",attrs:{title:e._label("qingxuanze"),width:1050}},[e.form.id>0?r("simple-admin-page",e._b({ref:"receive",attrs:{"hide-create":!0,"hide-form":!0}},"simple-admin-page",e.props,!1)):e._e()],1)],1)},n=[],s={render:a,staticRenderFns:n};t.a=s}});
//# sourceMappingURL=6-1029.js.map