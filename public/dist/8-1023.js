webpackJsonp([8],{312:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=r(354),i=r(407),o=r(0),a=o(n.a,i.a,!1,null,null,null);t.default=a.exports},314:function(e,t,r){"use strict";r.d(t,"a",function(){return o});var n=r(182),i=r.n(n),o=function(e){var t={};return{get:function(r){return t[r]||(t[r]=i.a.cloneDeep(e)),t[r]},result:function(){return t}}}},318:function(e,t,r){"use strict";function n(e,t,r){var n=void 0;return function(){var i=this,o=arguments;if(n&&clearTimeout(n),r){var a=!n;n=setTimeout(function(){n=null},t),a&&e.apply(i,o)}else n=setTimeout(function(){e.apply(i,o)},t)}}r.d(t,"b",function(){return i}),r.d(t,"c",function(){return o}),r.d(t,"a",function(){return n});var i=function(){},o=function(){return!0}},319:function(e,t,r){"use strict";t.a={inject:["bus"],data:function(){return{mypath:""}},created:function(){var e=this;e.bus.$on("close",function(t){t===e.mypath&&e.$destroy()})},beforeDestroy:function(){this.bus.$off("close")},mounted:function(){this.mypath=this.$route.path}}},354:function(e,t,r){"use strict";var n=r(6),i=r.n(n),o=r(12),a=r.n(o),l=r(13),u=r.n(l),s=r(26),d=r.n(s),c=r(7),p=r(184),f=r(37),b=r(35),m=r(318),_=r(54),h=r(314),g=r(319),v={name:"sp-orderbrandcreate",mixins:[p.a,g.a],data:function(){var e=this;e._label;return{form:{ageseasonid:"",bookingid:"",brandid:""},form2:{supplierid:"",keyword:"",keyword1:"",suppliercode1:"",suppliercode:""},tabledata:[],details:[],orders:[],selected:[],selected2:[],suppliers:[],listdata:[],orderlist:[],orderbrandDetailList:[],refsMap:{}}},methods:{onDeleteOrder:function(e){var t=this;if(t.orderbrandDetailList.find(function(t){return t.orderid==e}))return void alert(t._label("tip-bunengshanchu"));confirm(t._label("quedingshanchu"))&&(Object(_.d)(t.orderlist,function(t){return t.orderid===e}),Object(_.d)(t.tabledata,function(t){return t.orderid===e}),Object(_.d)(t.orders,function(t){return t.id===e}),Object(_.d)(t.listdata,function(t){return t.row.orderid===e}))},setMap:function(e,t,r){this.refsMap[e]=t+"-"+r},focus:function(e,t,r){var n=this,i=this.refsMap[r];i&&n.$refs[i]&&n.$refs[i].startFocus(t,e)},cellStyle:function(){return"padding-left:0px"},addSupplier:function(){var e=this;e._dataSource("supplier_3").getRows(e.form2.supplierid).then(function(t){var r=t.map(function(e){return e.row});w(e).importSupplier(r),e._hideDialog("add-supplier")})},distribute:function(e){var t=this;t.selected2.forEach(function(r){var n=r.product.id+"-"+r.order.id;t.$refs[n].distributeTo(e)}),t._hideDialog("supplier-dialog")},resetDistribute:function(){var e=this;e.selected2.forEach(function(t){var r=t.product.id+"-"+t.order.id;e.$refs[r].reset()})},onSelect:function(){var e=this;e._fetch("/order/import",e.form).then(function(t){var r=Object(f.a)(e.orders).toObject(function(e){return[e.id,1]}).object(),n=w(e);n.importOrders(t.data.orders.filter(function(e){return!r[e.id]})),n.importDetails(t.data.details.filter(function(e){return!r[e.orderid]})),e.form.ageseasonid="",e.form.bookingid="",e.form.brandid="",e._hideDialog("order-dialog")})},getInit:function(e){var t=[];return this.listdata.forEach(function(r){r.row===e&&r.number>0&&t.push({sizecontentid:r.sizecontentid,supplierid:r.supplierid,number:r.number})}),t},saveOrder:function(){var e=this,t=w(e),r=[];e.listdata.forEach(function(n){if(n.number>0){var i=t.getOrderDetaiId(n.row.productid,n.row.orderid,n.sizecontentid),o=t.getOrderbrandDetailId(n.row.productid,n.row.orderid,n.sizecontentid,n.supplierid);r.push({productid:n.row.productid,factoryprice:e.stat[n.row.productid].factoryprice,wordprice:e.stat[n.row.productid].wordprice,currencyid:e.stat[n.row.productid].currencyid,orderid:n.row.orderid,sizecontentid:n.sizecontentid,supplierid:n.supplierid,number:n.number,discount:n.discount,orderdetailid:i,id:o})}});var n=e.suppliers.filter(function(t){return e.supplierStat[t.supplierid].total_number>0}).map(function(t){var r=e.supplierStat[t.supplierid],n=Object(c.b)({},t);return e._log(r,n),n.total_number=r.total_number,n.total_discount_price=r.total_discount_price,n.total_price=r.total_price,n.brandid=r.brandid,n}),i={list:r,suppliers:n,form:{bussinesstype:e.order.bussinesstype,ageseason:e.order.ageseason,seasontype:e.order.seasontype,currency:e.order.currency}};e._submit("/orderbrand/add",{params:d()(i)}).then(function(t){e._redirect("/orderbrand/"+t.data.join(","))})},onNumberChange:function(e){var t=e.row,r=e.list,n=this;r.forEach(function(e){var r=e.number,i=e.sizecontentid,o=e.supplierid,a=e.discount,l=e.price,u=n.listdata.find(function(e){return e.sizecontentid==i&&e.supplierid==o&&t.product.id==e.row.product.id&&t.orderid==e.row.orderid});u?(u.number=r,u.discount=a,u.price=l,u.priceTotal=n.f(l*r)):n.listdata.push({row:t,number:r,sizecontentid:i,supplierid:o,discount:a,price:l,priceTotal:n.f(l*r)})});var i=n.listdata.shift();i&&n.listdata.unshift(i)},onSelectionChange:function(e){var t=this;this.selected=e,0==t.suppliers.length&&t.$notify.info({title:t._label("tishi"),message:t._label("qxzjghs")})},onRowClick:function(e){this.$refs.table.toggleRowSelection(e)},onSelectionChange2:function(e){this.selected2=e}},computed:{orderdetails:function(){var e=this,t={};if(0==e.suppliers.length)return[];e.selected.forEach(function(e){t[e.id]=1});var r=e.form2.keyword.toUpperCase(),n=e.form2.suppliercode.toUpperCase(),i=w(e).isMatch;return e.tabledata.filter(function(o){if(1==t[o.orderid]){var a=e.listdata.find(function(e){return e.row===o});return!!(o.total>0||a)&&(i(r,o.product.getGoodsCode(""))&&i(n,o.order.booking_label.toUpperCase()))}return!1})},width:function(){return 51*this.orderdetails.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)+191+70+100},order:function(){var e=this.orders;return e.length>0?e[0]:{}},orderstat:function(){var e=this,t={};return e.orders.forEach(function(e){t[e.id]={totalCount:0,brandCount:0,leftCount:0}}),e.orderlist.forEach(function(e){var r=t[e.orderid];r.totalCount+=1*e.number,r.brandCount+=1*e.brand_number,r.leftCount=r.totalCount-r.brandCount}),e.orderbrandDetailList.forEach(function(e){t[e.orderid].leftCount+=1*e.number}),t},ordercurrent:function(){var e=this,t={};return e.orders.forEach(function(e){t[e.id]={totalCount:0}}),e.listdata.forEach(function(e){t[e.row.orderid].totalCount+=1*e.number}),t},stat:function(){var e=this,t=Object(h.a)({factoryprice:0,wordprice:0,currencyid:"",total:0});return e.tabledata.forEach(function(e){var r=t.get(e.product.id);r.factoryprice=e.product.factoryprice,r.currencyid=e.product.factorypricecurrency,r.wordprice=e.product.wordprice}),e.orderlist.forEach(function(e){if(e.factoryprice>0){var r=t.get(e.productid);r.factoryprice=e.factoryprice,r.currencyid=e.currencyid,r.wordprice=e.wordprice}}),e.listdata.forEach(function(e){t.get(e.row.product.id).total+=1*e.number}),t.result()},supplierStat:function(){var e=this,t=Object(_.a)(),r=Object(h.a)({total_discount_price:0,total_number:0,total_price:0,brandid:""});e.listdata.forEach(function(n){var i=r.get(n.supplierid);n.number>0&&(i.total_number+=1*n.number,i.total_price+=n.number*e.stat[n.row.productid].wordprice,i.total_discount_price+=n.priceTotal,t.push(n.supplierid,n.row.product.brandid))});var n=t.getResult();return e.suppliers.forEach(function(e){r.get(e.supplierid).brandid=n[e.supplierid]}),r.result()}},watch:{"form2.keyword1":function(e){this.copyKeywordDebounce()},"form2.suppliercode1":function(e){this.copySuppliercodeDebounce()}},mounted:function(){var e=this;e._setTitle(e._label("shengchengwaibudingdan")),e.copyKeywordDebounce=Object(m.a)(function(){e.form2.keyword=e.form2.keyword1},1e3,!1),e.copySuppliercodeDebounce=Object(m.a)(function(){e.form2.suppliercode=e.form2.suppliercode1},1e3,!1),w(e).loadInfo()}},w=function(e){var t={loadInfo:function(){var r=e.$route.params;"0"!=r.ids&&e._fetch("/orderbrand/load",{ids:r.ids}).then(function(){var r=u()(a.a.mark(function r(n){var i=n.data;return a.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return t.importOrders(i.orders),r.next=3,t.importDetails(i.details);case 3:t.importSupplier(i.suppliers,i.orderbrands),t.importList(i.list),e.$refs.table.toggleAllSelection();case 6:case"end":return r.stop()}},r,this)}));return function(e){return r.apply(this,arguments)}}())},isMatch:function(e,t){return!(e.length>0)||t.toUpperCase().indexOf(e)>=0},convertListToProductList:function(e){var t=this;return u()(a.a.mark(function r(){var n,o;return a.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return n={},e.forEach(function(e){var t=e.productid+"-"+e.orderid,r=e.brand_number;if(n[t])n[t].form[e.sizecontentid]=e.number-r,n[t].total+=e.number-r;else{var i={};i[e.sizecontentid]=e.number-r,n[t]={key:t,productid:e.productid,orderid:e.orderid,discount:e.discount,total:e.number-r,form:i}}}),o=[],Object(f.a)(n).forEach(function(e){var t=Object(b.i)(e);e.orderid>0?t.push(b.b.load({data:e.orderid,depth:1}),"order"):e.order={id:-1},t.push(b.e.load({data:e.productid,depth:1}),"product"),o.push(t.all())}),t.next=6,i.a.all(o);case 6:return t.abrupt("return",t.sent);case 7:case"end":return t.stop()}},r,t)}))()},getOrderDetaiId:function(t,r,n){var i=e.orderlist.find(function(e){return e.productid==t&&e.orderid==r&&e.sizecontentid==n});return i?i.id:0},getOrderbrandDetailId:function(t,r,n,i){var o=e.suppliers.find(function(e){return e.supplierid==i});if(o){var a=e.orderbrandDetailList.find(function(e){return e.productid==t&&e.orderid==r&&e.sizecontentid==n&&e.orderbrandid==o.orderbrandid});return a?a.id:0}return 0},importOrders:function(t){t.forEach(function(t){e.orders.push(t)})},importDetails:function(r){var n=this;return u()(a.a.mark(function i(){var o;return a.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return r.forEach(function(t){e.orderlist.push(t)}),n.next=3,t.convertListToProductList(r);case 3:return o=n.sent,o.forEach(function(t){e.tabledata.push(t)}),n.abrupt("return","");case 6:case"end":return n.stop()}},i,n)}))()},importSupplier:function(t){var r=arguments.length>1&&void 0!==arguments[1]?arguments[1]:[];t.forEach(function(t){if(!e.suppliers.find(function(e){return e.supplierid==t.id})){var r={suppliercode:t.suppliercode,supplierid:t.id,foreignorderno:"",finalsupplierid:"",taxrebate:"",makestaff:"",maketime:"",memo:"",orderno:"",brandid:"",quantum:""};r.discount="",r.total_discount_price=0,r.total_number=0,r.total_price=0,r.orderbrandid="",e.suppliers.push(r)}}),r.forEach(function(t){var r=e.suppliers.find(function(e){return e.supplierid==t.supplierid});r&&(r.discount=t.discount,r.orderbrandid=t.id,r.makestaff=t.makestaff,r.maketime=t.maketime,r.foreignorderno=t.foreignorderno,r.finalsupplierid=t.finalsupplierid,r.taxrebate=t.taxrebate,r.memo=t.memo,r.orderno=t.orderno,r.brandid=t.brandid,r.quantum=t.quantum)})},importList:function(t){e.orderbrandDetailList=t,t.forEach(function(t){var r=e.tabledata.find(function(e){return e.orderid==t.orderid&&e.productid==t.productid}),n=e.suppliers.find(function(e){return e.orderbrandid==t.orderbrandid});r&&n&&e.listdata.push({row:r,number:t.number,sizecontentid:t.sizecontentid,supplierid:n.supplierid,discount:t.discount}),r&&(r.form[t.sizecontentid]+=1*t.number)})}};return t};t.a=v},407:function(e,t,r){"use strict";var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{ref:"order-form",staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",size:"mini","inline-message":!1,"show-message":!1}},[r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"300px"},attrs:{span:6}},["0"==e.$route.params.ids?r("au-button",{attrs:{auth:"order-submit",type:"primary"},on:{click:function(t){return e.saveOrder(1)}}},[e._v(e._s(e._label("baocun")))]):e._e(),e._v(" "),"0"==e.$route.params.ids?r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._showDialog("order-dialog")}}},[e._v(e._s(e._label("daorudingdan")))]):e._e(),e._v(" "),"0"==e.$route.params.ids?r("as-button",{attrs:{type:"primary"},on:{click:function(t){e._showDialog("add-supplier"),e.form2.supplierid=""}}},[e._v(e._s(e._label("zengjiagonghuoshang")))]):e._e()],1),e._v(" "),r("el-col",{attrs:{span:18}},[r("el-tag",{attrs:{type:"warning"}},[r("sp-select-text",{attrs:{value:e.order.ageseason,source:"ageseason"}})],1),e._v(" "),e.order.seasontype>0?r("el-tag",{attrs:{type:"warning"}},[r("sp-select-text",{attrs:{value:e.order.seasontype,source:"seasontype"}})],1):e._e(),e._v(" "),r("el-tag",{attrs:{type:"warning"}},[r("sp-select-text",{attrs:{value:e.order.bussinesstype,source:"bussinesstype"}})],1)],1)],1)],1),e._v(" "),r("el-row",{staticClass:"product clearpadding"},[r("el-table",{ref:"table",staticStyle:{width:"100%"},attrs:{data:e.suppliers,stripe:"",border:"","cell-style":e.cellStyle}},[r("el-table-column",{attrs:{label:e._label("gonghuoshang"),width:"120",align:"center",prop:"suppliercode"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("bizhong"),width:"60",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){t.row;return[r("sp-select-text",{attrs:{value:e.order.currency,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zongjine"),width:"90",align:"center",prop:"total_discount_price"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                    "+e._s(e.f(e.supplierStat[r.supplierid].total_discount_price))+"\n                ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shengyuedu"),width:"90",align:"center",prop:"total_discount_price"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                    "+e._s(e.f(r.quantum-e.supplierStat[r.supplierid].total_discount_price))+"\n                ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zongjianshu"),width:"75",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                    "+e._s(e.supplierStat[r.supplierid].total_number)+"\n                ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("lingshouzongjia"),width:"90",align:"center",prop:"total_price"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                    "+e._s(e.f(e.supplierStat[r.supplierid].total_price))+"\n                ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhekoulv"),width:"75",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:n.discount,callback:function(t){e.$set(n,"discount",t)},expression:"row.discount"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("tuishuilv"),width:"75",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:n.taxrebate,callback:function(t){e.$set(n,"taxrebate",t)},expression:"row.taxrebate"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("edu"),width:"75",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:n.quantum,callback:function(t){e.$set(n,"quantum",t)},expression:"row.quantum"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("fahuoshang"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("simple-select",{attrs:{source:"supplier_3",clearable:!0},model:{value:n.finalsupplierid,callback:function(t){e.$set(n,"finalsupplierid",t)},expression:"row.finalsupplierid"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("beizhu"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:n.memo,callback:function(t){e.$set(n,"memo",t)},expression:"row.memo"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("haiwaidingdanhao"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:n.foreignorderno,callback:function(t){e.$set(n,"foreignorderno",t)},expression:"row.foreignorderno"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("gongsidingdanhao"),width:"80",align:"center",prop:"orderno"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhidanren"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.makestaff,source:"user"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhidanriqi"),width:"90",align:"center",prop:"maketime"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                "+e._s(r.maketime&&r.maketime.length>0?r.maketime.substr(0,10):"")+"\n                ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("pinpai"),width:"200",align:"left"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.brandid,source:"brand"}})]}}])})],1),e._v(" "),r("el-col",{staticClass:"product",staticStyle:{"margin-top":"2px"},attrs:{span:24}},[r("el-table",{ref:"table",staticStyle:{width:"100%"},attrs:{data:e.orders,stripe:"",border:""},on:{"selection-change":e.onSelectionChange,"row-click":e.onRowClick}},[r("el-table-column",{attrs:{type:"selection",width:30,align:"center"}}),e._v(" "),r("el-table-column",{attrs:{prop:"orderno",label:e._label("dingdanbianhao"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-order-tip",{attrs:{column:"orderno",order:t,trigger:"hover"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dinghuokehu"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.bookingid,source:"supplier"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dinghuoshuliang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.orderstat[r.id].totalCount)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("fenpeishuliang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.orderstat[r.id].totalCount-e.orderstat[r.id].leftCount+e.ordercurrent[r.id].totalCount)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("gonghuoshang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.supplierid,source:"supplier"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("niandai"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.ageseason,source:"ageseason"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("bizhong"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.currency,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"total",label:e._label("jine"),width:"90",align:"center"}}),e._v(" "),r("el-table-column",{attrs:{prop:"discount",label:e._label("zhekoulv"),width:"90",align:"center"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("xingbie"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.genders,source:"gender"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("yewuleixing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.bussinesstype,source:"bussinesstype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("pinpai"),width:"150",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.brandids,source:"brand"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dingdanriqi"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(r.maketime&&r.maketime.length>0?r.maketime.substr(0,10):"")+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("caozuo"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return["0"==e.$route.params.ids?r("el-button",{attrs:{type:"danger",round:"",size:"mini"},on:{click:function(t){return t.stopPropagation(),e.onDeleteOrder(n.id)}}},[e._v(e._s(e._label("shanchu")))]):e._e()]}}])})],1),e._v(" "),"0"==e.$route.params.ids?r("el-row",{attrs:{gutter:0}},[r("el-button",{attrs:{type:"warning",round:"",size:"mini"},on:{click:function(t){return e._showDialog("supplier-dialog")}}},[e._v(e._s(e._label("piliangfenpei")))]),e._v(" "),r("el-button",{attrs:{type:"warning",round:"",size:"mini"},on:{click:e.resetDistribute}},[e._v(e._s(e._label("piliangchongzhi")))])],1):e._e(),e._v(" "),r("el-table",{ref:"tabledetail",staticStyle:{width:"100%","margin-top":"2px"},attrs:{data:e.orderdetails,stripe:"",border:""},on:{"selection-change":e.onSelectionChange2}},[r("el-table-column",{attrs:{type:"selection",width:30,align:"center"}}),e._v(" "),r("el-table-column",{attrs:{align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("img",{staticStyle:{width:"50px",height:"50px"},attrs:{src:e._fileLink(t.row.product.picture),AAAA:""}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dinghuokehu"),align:"center",width:"150"}},[r("el-table-column",{attrs:{label:e._label("dinghuokehu"),align:"center",width:"150"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-order-tip",{attrs:{column:"booking_label",order:t.order}})]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.suppliercode1,callback:function(t){e.$set(e.form2,"suppliercode1",t)},expression:"form2.suppliercode1"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"}},[r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){return[r("sp-product-tip",{attrs:{product:e.row.product}})]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.keyword1,callback:function(t){e.$set(e.form2,"keyword1",t)},expression:"form2.keyword1"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("bizhong"),width:"60",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("sp-select-text",{attrs:{value:e.stat[n.product.id].currencyid,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.stat[r.product.id].factoryprice)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"discount",label:e._label("zhekoulv"),width:"80",align:"center"}}),e._v(" "),r("el-table-column",{attrs:{prop:"number",label:e._label("dinggoushuliang"),align:"center",width:e.width},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row,i=t.$index;return[r("sp-sizecontent-confirm2",{key:n.product.id+"-"+n.order.id,ref:n.product.id+"-"+n.order.id,attrs:{columns:n.product.sizecontents,row:n,suppliers:e.suppliers,initData:e.getInit(n),factoryprice:e.stat[n.product.id].factoryprice,setMap:e.setMap(i,n.product.id,n.order.id)},on:{change:e.onNumberChange,up:function(t){return e.focus(t,"up",i-1)},down:function(t){return e.focus(t,"down",i+1)}}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(t.row.product.getName())+"\n                    ")]}}])})],1)],1)],1),e._v(" "),r("sp-dialog",{ref:"order-dialog"},[r("el-form",{staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!1,size:"mini"}},[r("el-row",{attrs:{gutter:0}},[r("el-form-item",{attrs:{label:e._label("niandai")}},[r("simple-select",{attrs:{source:"ageseason"},model:{value:e.form.ageseasonid,callback:function(t){e.$set(e.form,"ageseasonid",t)},expression:"form.ageseasonid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("dinghuokehu")}},[r("simple-select",{attrs:{source:"supplier_2",multiple:!0},model:{value:e.form.bookingid,callback:function(t){e.$set(e.form,"bookingid",t)},expression:"form.bookingid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinpai")}},[r("simple-select",{attrs:{source:"brand"},model:{value:e.form.brandid,callback:function(t){e.$set(e.form,"brandid",t)},expression:"form.brandid"}})],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{attrs:{align:"center"}},[r("as-button",{attrs:{auth:"product",type:"primary"},on:{click:e.onSelect}},[e._v(e._s(e._label("daorudingdan")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("order-dialog")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1),e._v(" "),r("sp-dialog",{ref:"add-supplier"},[r("el-form",{staticStyle:{width:"100%"},attrs:{model:e.form2,"label-width":"85px",inline:!1,size:"mini"}},[r("el-row",{attrs:{gutter:0}},[r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3",multiple:!0},model:{value:e.form2.supplierid,callback:function(t){e.$set(e.form2,"supplierid",t)},expression:"form2.supplierid"}})],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{attrs:{align:"center"}},[r("as-button",{attrs:{auth:"product",type:"primary"},on:{click:e.addSupplier}},[e._v(e._s(e._label("queding")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("add-supplier")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1),e._v(" "),r("sp-dialog",{ref:"supplier-dialog",attrs:{title:e._label("qingxuanze")}},[r("el-row",{attrs:{gutter:0}},e._l(e.suppliers,function(t){return r("el-col",{key:t.id,attrs:{span:5}},[r("as-button",{attrs:{auth:"product",type:"primary"},on:{click:function(r){return e.distribute(t.supplierid)}}},[e._v(e._s(t.suppliercode))])],1)}),1)],1),e._v(" "),r("sp-dialog",{ref:"preview"})],1)},i=[],o={render:n,staticRenderFns:i};t.a=o}});
//# sourceMappingURL=8-1023.js.map