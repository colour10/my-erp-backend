webpackJsonp([6],{299:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=r(334),o=r(373),i=r(0),a=i(n.a,o.a,!1,null,null,null);t.default=a.exports},301:function(e,t,r){"use strict";var n=r(54);t.a={methods:{formatNumber:function(e){return Object(n.b)(e,3)},f:function(e){return Object(n.b)(e,2)}}}},302:function(e,t,r){"use strict";function n(e,t,r){var n=void 0;return function(){var o=this,i=arguments;if(n&&clearTimeout(n),r){var a=!n;n=setTimeout(function(){n=null},t),a&&e.apply(o,i)}else n=setTimeout(function(){e.apply(o,i)},t)}}r.d(t,"b",function(){return o}),r.d(t,"c",function(){return i}),r.d(t,"a",function(){return n});var o=function(){},i=function(){return!0}},334:function(e,t,r){"use strict";var n=r(6),o=r.n(n),i=r(16),a=r.n(i),l=r(17),u=r.n(l),s=r(26),d=r.n(s),c=r(7),p=r(301),f=r(34),b=r(33),m=r(302),_=r(51),h={name:"sp-orderbrandcreate",mixins:[p.a],data:function(){var e=this;e._label;return{form:{ageseasonid:"",bookingid:"",brandid:""},form2:{supplierid:"",keyword:"",keyword1:"",suppliercode1:"",suppliercode:""},tabledata:[],details:[],orders:[],selected:[],selected2:[],suppliers:[],listdata:[],orderlist:[],orderbrandlist:[]}},methods:{cellStyle:function(){return"padding-left:0px"},addSupplier:function(){var e=this;e._dataSource("supplier_3").getRows(e.form2.supplierid).then(function(t){var r=t.map(function(e){return e.row});g(e).importSupplier(r),e._hideDialog("add-supplier")})},distribute:function(e){var t=this;t.selected2.forEach(function(r){var n=r.product.id+"-"+r.order.id;t.$refs[n].distributeTo(e)}),t._hideDialog("supplier-dialog")},resetDistribute:function(){var e=this;e.selected2.forEach(function(t){var r=t.product.id+"-"+t.order.id;e.$refs[r].reset()})},onSelect:function(){var e=this;e._fetch("/order/import",e.form).then(function(t){var r=Object(f.a)(e.orders).toObject(function(e){return[e.id,1]}).object(),n=g(e);n.importOrders(t.data.orders.filter(function(e){return!r[e.id]})),n.importDetails(t.data.details.filter(function(e){return!r[e.orderid]})),e._hideDialog("order-dialog")})},getInit:function(e){var t=[];return this.listdata.forEach(function(r){r.row===e&&r.number>0&&t.push({sizecontentid:r.sizecontentid,supplierid:r.supplierid,number:r.number})}),t},saveOrder:function(){var e=this,t=g(e),r=[];e.listdata.forEach(function(e){if(e.number>0){var n=t.getOrderDetaiId(e.row.productid,e.row.orderid,e.sizecontentid),o=t.getOrderbrandDetailId(e.row.productid,e.row.orderid,e.sizecontentid,e.supplierid);r.push({productid:e.row.productid,orderid:e.row.orderid,sizecontentid:e.sizecontentid,supplierid:e.supplierid,number:e.number,discount:e.discount,orderdetailid:n,id:o})}});var n=e.suppliers.filter(function(e){return e.total_number>0}),o={list:r,suppliers:n,form:{bussinesstype:e.order.bussinesstype,ageseason:e.order.ageseason,seasontype:e.order.seasontype,currency:e.order.currency}};e._submit("/orderbrand/add",{params:d()(o)}).then(function(e){})},onNumberChange:function(e){var t=e.row,r=e.list,n=this;r.forEach(function(e){var r=e.number,o=e.sizecontentid,i=e.supplierid,a=e.discount,l=n.listdata.find(function(e){return e.sizecontentid==o&&e.supplierid==i&&t.product.id==e.row.product.id&&t.orderid==e.row.orderid});l?(l.number=r,l.discount=a):n.listdata.push({row:t,number:r,sizecontentid:o,supplierid:i,discount:a})}),g(n).stat()},onSelectionChange:function(e){var t=this;this.selected=e,0==t.suppliers.length&&t.$notify.info({title:t._label("tishi"),message:t._label("qxzjghs")})},onRowClick:function(e){this.$refs.table.toggleRowSelection(e)},onSelectionChange2:function(e){this.selected2=e}},computed:{orderdetails:function(){var e=this,t={};if(0==e.suppliers.length)return[];e.selected.forEach(function(e){t[e.id]=1});var r=e.form2.keyword.toUpperCase(),n=e.form2.suppliercode.toUpperCase(),o=g(e).isMatch;return e.details.filter(function(e){return 1==t[e.orderid]}).filter(function(e){return o(r,e.product.getGoodsCode(""))&&o(n,e.order.booking_label.toUpperCase())})},width:function(){return 51*this.orderdetails.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)+191+70},order:function(){var e=this.orders;return e.length>0?e[0]:{}},orderstat:function(){var e=this,t={};return e.orderlist.forEach(function(e){t[e.orderid]||(t[e.orderid]={totalCount:0,brandCount:0,leftCount:0});var r=t[e.orderid];r.totalCount+=1*e.number,r.brandCount+=1*e.brand_number,r.leftCount=r.totalCount-r.brandCount}),e.orderbrandlist.forEach(function(e){t[e.orderid].leftCount+=1*e.number}),t},ordercurrent:function(){var e=this,t={};return e.orders.forEach(function(e){t[e.id]={totalCount:0}}),e.listdata.forEach(function(e){t[e.row.orderid].totalCount+=1*e.number}),t}},watch:{"form2.keyword1":function(e){this.copyKeywordDebounce()},"form2.suppliercode1":function(e){this.copySuppliercodeDebounce()}},mounted:function(){var e=this;e._setTitle(e._label("shengchengwaibudingdan")),e.copyKeywordDebounce=Object(m.a)(function(){e.form2.keyword=e.form2.keyword1},1e3,!1),e.copySuppliercodeDebounce=Object(m.a)(function(){e.form2.suppliercode=e.form2.suppliercode1},1e3,!1);var t=e.$route.params;"0"!=t.ids&&e._fetch("/orderbrand/load",{ids:t.ids}).then(function(){var t=u()(a.a.mark(function t(r){var n,o=r.data;return a.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return n=g(e),n.importOrders(o.orders),t.next=4,n.importDetails(o.details);case 4:n.importSupplier(o.suppliers,o.orderbrands),n.importList(o.list),n.stat(),e.$refs.table.toggleAllSelection();case 8:case"end":return t.stop()}},t,this)}));return function(e){return t.apply(this,arguments)}}())}},g=function(e){var t={isMatch:function(e,t){return!(e.length>0)||t.toUpperCase().indexOf(e)>=0},convertListToProductList:function(e){var t=this;return u()(a.a.mark(function r(){var n,i;return a.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return n={},e.forEach(function(e){var t=e.productid+"-"+e.orderid;if(n[t])n[t].form[e.sizecontentid]=e.number-e.brand_number,n[t].total+=e.number-e.brand_number;else{var r={};r[e.sizecontentid]=e.number-e.brand_number,n[t]={key:t,productid:e.productid,orderid:e.orderid,discount:e.discount,total:1*e.number,form:r}}}),i=[],Object(f.a)(n).forEach(function(e){var t=Object(b.h)(e);e.orderid>0?t.push(b.b.load({data:e.orderid,depth:1}),"order"):e.order={id:-1},t.push(b.e.load({data:e.productid,depth:1}),"product"),i.push(t.all())}),t.next=6,o.a.all(i);case 6:return t.abrupt("return",t.sent);case 7:case"end":return t.stop()}},r,t)}))()},getOrderDetaiId:function(t,r,n){var o=e.orderlist.find(function(e){return e.productid==t&&e.orderid==r&&e.sizecontentid==n});return o?o.id:0},getOrderbrandDetailId:function(t,r,n,o){var i=e.suppliers.find(function(e){return e.supplierid==o});if(console.log("YY",i),i){var a=e.orderbrandlist.find(function(e){return e.productid==t&&e.orderid==r&&e.sizecontentid==n&&e.orderbrandid==i.orderbrandid});return a?a.id:0}return 0},importOrders:function(t){t.forEach(function(t){e.orders.push(t)})},importDetails:function(r){var n=this;return u()(a.a.mark(function o(){var i;return a.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return r.forEach(function(t){e.orderlist.push(t)}),n.next=3,t.convertListToProductList(r);case 3:return i=n.sent,i.forEach(function(t){e.details.push(t)}),n.abrupt("return","");case 6:case"end":return n.stop()}},o,n)}))()},importSupplier:function(t){var r=arguments.length>1&&void 0!==arguments[1]?arguments[1]:[];t.forEach(function(t){if(!e.suppliers.find(function(e){return e.supplierid==t.id})){var r={suppliercode:t.suppliercode,supplierid:t.id,foreignorderno:"",finalsupplierid:"",taxrebate:"",makestaff:"",maketime:"",memo:"",orderno:"",brandid:"",quantum:""};r.discount="",r.total_discount_price=0,r.total_number=0,r.total_price=0,r.orderbrandid="",e.suppliers.push(r)}}),r.forEach(function(t){var r=e.suppliers.find(function(e){return e.supplierid==t.supplierid});r&&(r.discount=t.discount,r.orderbrandid=t.id,r.makestaff=t.makestaff,r.maketime=t.maketime,r.foreignorderno=t.foreignorderno,r.finalsupplierid=t.finalsupplierid,r.taxrebate=t.taxrebate,r.memo=t.memo,r.orderno=t.orderno,r.brandid=t.brandid,r.quantum=t.quantum)})},importList:function(t){e.orderbrandlist=t,t.forEach(function(t){var r=e.details.find(function(e){return e.orderid==t.orderid&&e.productid==t.productid}),n=e.suppliers.find(function(e){return e.orderbrandid==t.orderbrandid});r&&n&&e.listdata.push({row:r,number:t.number,sizecontentid:t.sizecontentid,supplierid:n.supplierid,discount:t.discount}),r&&(r.form[t.sizecontentid]+=1*t.number)})},stat:function(){var t={},r=Object(_.a)();e.listdata.forEach(function(e){var n=t[e.supplierid]||{total_discount_price:0,total_number:0,total_price:0,brandid:""};e.number>0&&(n.total_number+=1*e.number,n.total_price+=e.number*e.row.product.wordprice,n.total_discount_price+=e.number*e.discount*e.row.product.factoryprice,r.push(e.supplierid,e.row.product.brandid),console.log("xx",e.supplierid,e.row.product.brandid),t[e.supplierid]=n)});var n=r.getResult();e.suppliers.forEach(function(e){var r=t[e.supplierid];r?(r.brandid=n[e.supplierid],Object(c.b)(e,r)):Object(c.b)(e,{total_discount_price:0,total_number:0,total_price:0})})}};return t};t.a=h},373:function(e,t,r){"use strict";var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{ref:"order-form",staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",size:"mini","inline-message":!1,"show-message":!1}},[r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"300px"},attrs:{span:6}},[r("au-button",{attrs:{auth:"order-submit",type:"primary"},on:{click:function(t){return e.saveOrder(1)}}},[e._v(e._s(e._label("baocun")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._showDialog("order-dialog")}}},[e._v(e._s(e._label("daorudingdan")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){e._showDialog("add-supplier"),e.form2.supplierid=""}}},[e._v(e._s(e._label("zengjiagonghuoshang")))])],1),e._v(" "),r("el-col",{attrs:{span:18}},[r("el-tag",{attrs:{type:"warning"}},[r("sp-select-text",{attrs:{value:e.order.ageseason,source:"ageseason"}})],1),e._v(" "),r("el-tag",{attrs:{type:"warning"}},[r("sp-select-text",{attrs:{value:e.order.seasontype,source:"seasontype"}})],1),e._v(" "),r("el-tag",{attrs:{type:"warning"}},[r("sp-select-text",{attrs:{value:e.order.bussinesstype,source:"bussinesstype"}})],1)],1)],1)],1),e._v(" "),r("el-row",{staticClass:"product clearpadding"},[r("el-table",{ref:"table",staticStyle:{width:"100%"},attrs:{data:e.suppliers,stripe:"",border:"","cell-style":e.cellStyle}},[r("el-table-column",{attrs:{label:e._label("gonghuoshang"),width:"120",align:"center",prop:"suppliercode"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("bizhong"),width:"60",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){t.row;return[r("sp-select-text",{attrs:{value:e.order.currency,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zongjine"),width:"90",align:"center",prop:"total_discount_price"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                    "+e._s(e.f(r.total_discount_price))+"\n                ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shengyuedu"),width:"90",align:"center",prop:"total_discount_price"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                    "+e._s(e.f(r.quantum-r.total_discount_price))+"\n                ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zongjianshu"),width:"75",align:"center",prop:"total_number"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("lingshouzongjia"),width:"90",align:"center",prop:"total_price"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                    "+e._s(e.f(r.total_price))+"\n                ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhekoulv"),width:"75",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:n.discount,callback:function(t){e.$set(n,"discount",t)},expression:"row.discount"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("tuishuilv"),width:"75",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:n.taxrebate,callback:function(t){e.$set(n,"taxrebate",t)},expression:"row.taxrebate"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("edu"),width:"75",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:n.quantum,callback:function(t){e.$set(n,"quantum",t)},expression:"row.quantum"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("fahuoshang"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("simple-select",{attrs:{source:"supplier_3",clearable:!0},model:{value:n.finalsupplierid,callback:function(t){e.$set(n,"finalsupplierid",t)},expression:"row.finalsupplierid"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("beizhu"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:n.memo,callback:function(t){e.$set(n,"memo",t)},expression:"row.memo"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("haiwaidingdanhao"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:n.foreignorderno,callback:function(t){e.$set(n,"foreignorderno",t)},expression:"row.foreignorderno"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("gongsidingdanhao"),width:"80",align:"center",prop:"orderno"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhidanren"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.makestaff,source:"user"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhidanriqi"),width:"90",align:"center",prop:"maketime"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                "+e._s(r.maketime&&r.maketime.length>0?r.maketime.substr(0,10):"")+"\n                ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("pinpai"),width:"200",align:"left"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.brandid,source:"brand"}})]}}])})],1),e._v(" "),r("el-col",{staticClass:"product",staticStyle:{"margin-top":"2px"},attrs:{span:24}},[r("el-table",{ref:"table",staticStyle:{width:"100%"},attrs:{data:e.orders,stripe:"",border:""},on:{"selection-change":e.onSelectionChange,"row-click":e.onRowClick}},[r("el-table-column",{attrs:{type:"selection",width:30,align:"center"}}),e._v(" "),r("el-table-column",{attrs:{prop:"orderno",label:e._label("dingdanbianhao"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-order-tip",{attrs:{column:"orderno",order:t,trigger:"hover"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dinghuokehu"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.bookingid,source:"supplier"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dinghuoshuliang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.orderstat[r.id].totalCount)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("fenpeishuliang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.orderstat[r.id].totalCount-e.orderstat[r.id].leftCount+e.ordercurrent[r.id].totalCount)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("gonghuoshang"),width:"120",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.supplierid,source:"supplier"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("niandai"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.ageseason,source:"ageseason"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("bizhong"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.currency,source:"currency"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"total",label:e._label("jine"),width:"90",align:"center"}}),e._v(" "),r("el-table-column",{attrs:{prop:"discount",label:e._label("zhekoulv"),width:"90",align:"center"}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("xingbie"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.genders,source:"gender"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("yewuleixing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.bussinesstype,source:"bussinesstype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dingdanriqi"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(r.maketime&&r.maketime.length>0?r.maketime.substr(0,10):"")+"\n                    ")]}}])})],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-button",{attrs:{type:"warning",round:"",size:"mini"},on:{click:function(t){return e._showDialog("supplier-dialog")}}},[e._v(e._s(e._label("piliangfenpei")))]),e._v(" "),r("el-button",{attrs:{type:"warning",round:"",size:"mini"},on:{click:e.resetDistribute}},[e._v(e._s(e._label("piliangchongzhi")))])],1),e._v(" "),r("el-table",{ref:"tabledetail",staticStyle:{width:"100%"},attrs:{data:e.orderdetails,stripe:"",border:""},on:{"selection-change":e.onSelectionChange2}},[r("el-table-column",{attrs:{type:"selection",width:30,align:"center"}}),e._v(" "),r("el-table-column",{attrs:{align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("img",{staticStyle:{width:"50px",height:"50px"},attrs:{src:e._fileLink(t.row.product.picture),AAAA:""}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("dinghuokehu"),align:"center",width:"150"}},[r("el-table-column",{attrs:{label:e._label("dinghuokehu"),align:"center",width:"150"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-order-tip",{attrs:{column:"booking_label",order:t.order}})]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.suppliercode1,callback:function(t){e.$set(e.form2,"suppliercode1",t)},expression:"form2.suppliercode1"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"}},[r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){return[r("sp-product-tip",{attrs:{product:e.row.product}})]}},{key:"header",fn:function(t){t.row;return[r("el-input",{attrs:{size:"mini"},model:{value:e.form2.keyword1,callback:function(t){e.$set(e.form2,"keyword1",t)},expression:"form2.keyword1"}})]}}])})],1),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("bizhong"),width:"60",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(r.product.factorypricecurrency_label)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chuchangjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(r.product.factoryprice)+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chengjiaojia"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.formatNumber(r.product.factoryprice*r.discount))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("zongjia"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n                        "+e._s(e.formatNumber(r.product.factoryprice*r.discount*r.total))+"\n                    ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"discount",label:e._label("zhekoulv"),width:"80",align:"center"}}),e._v(" "),r("el-table-column",{attrs:{prop:"number",label:e._label("dinggoushuliang"),align:"center",width:e.width},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.row;return[r("sp-sizecontent-confirm2",{key:n.product.id+"-"+n.order.id,ref:n.product.id+"-"+n.order.id,attrs:{columns:n.product.sizecontents,row:n,suppliers:e.suppliers,initData:e.getInit(n)},on:{change:e.onNumberChange}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(t.row.product.getName())+"\n                    ")]}}])})],1)],1)],1),e._v(" "),r("sp-dialog",{ref:"order-dialog"},[r("el-form",{staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!1,size:"mini"}},[r("el-row",{attrs:{gutter:0}},[r("el-form-item",{attrs:{label:e._label("niandai")}},[r("simple-select",{attrs:{source:"ageseason"},model:{value:e.form.ageseasonid,callback:function(t){e.$set(e.form,"ageseasonid",t)},expression:"form.ageseasonid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("dinghuokehu")}},[r("simple-select",{attrs:{source:"supplier_2",multiple:!0},model:{value:e.form.bookingid,callback:function(t){e.$set(e.form,"bookingid",t)},expression:"form.bookingid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinpai")}},[r("simple-select",{attrs:{source:"brand"},model:{value:e.form.brandid,callback:function(t){e.$set(e.form,"brandid",t)},expression:"form.brandid"}})],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{attrs:{align:"center"}},[r("as-button",{attrs:{auth:"product",type:"primary"},on:{click:e.onSelect}},[e._v(e._s(e._label("daorudingdan")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("order-dialog")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1),e._v(" "),r("sp-dialog",{ref:"add-supplier"},[r("el-form",{staticStyle:{width:"100%"},attrs:{model:e.form2,"label-width":"85px",inline:!1,size:"mini"}},[r("el-row",{attrs:{gutter:0}},[r("el-form-item",{attrs:{label:e._label("gonghuoshang")}},[r("simple-select",{attrs:{source:"supplier_3",multiple:!0},model:{value:e.form2.supplierid,callback:function(t){e.$set(e.form2,"supplierid",t)},expression:"form2.supplierid"}})],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{attrs:{align:"center"}},[r("as-button",{attrs:{auth:"product",type:"primary"},on:{click:e.addSupplier}},[e._v(e._s(e._label("zengjia")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("add-supplier")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1),e._v(" "),r("sp-dialog",{ref:"supplier-dialog",attrs:{title:e._label("qingxuanze")}},[r("el-row",{attrs:{gutter:0}},e._l(e.suppliers,function(t){return r("el-col",{key:t.id,attrs:{span:5}},[r("as-button",{attrs:{auth:"product",type:"primary"},on:{click:function(r){return e.distribute(t.supplierid)}}},[e._v(e._s(t.suppliercode))])],1)}),1)],1),e._v(" "),r("sp-dialog",{ref:"preview"})],1)},o=[],i={render:n,staticRenderFns:o};t.a=i}});
//# sourceMappingURL=6-1007.js.map