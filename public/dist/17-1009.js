webpackJsonp([17],{280:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var l=a(312),o=a(342),n=a(0),r=n(l.a,o.a,!1,null,null,null);t.default=r.exports},312:function(e,t,a){"use strict";var l,o=a(174),n=a.n(o),r=a(26),s=a.n(r),i=a(1),u=a(33),c=a(7),d=a(178),f=(a(5),{columns:[{name:"payment_type",label:Object(i.d)("fukuanleixing"),type:"select",source:"paymenttype"},{name:"currency",label:Object(i.d)("bizhong"),type:"select",source:"currency"},{name:"amount",label:Object(i.d)("jine")},{name:"paymentdate",label:Object(i.d)("fukuanriqi"),type:"date"},{name:"memo",label:Object(i.d)("beizhu")},{name:"makestaff",label:Object(i.d)("tijiaoren"),type:"select",source:"user",is_edit_hide:!0},{name:"status",label:Object(i.d)("yiruzhang"),type:"switch",is_edit_hide:!0}],controller:"salesreceive",auth:"sales",base:{salesid:""},options:{isedit:function(e){return 0==e.status},isdelete:function(e){return 0==e.status}}});t.a={name:"sp-salesdetail",components:{search:d.a},props:{visible:{type:Boolean},data:{type:Object}},data:function(){return{form:{memberid:"",salesstaff:"",externalno:"",warehouseid:"",salesdate:"",ordercode:"",pickingtype:"",expresspaidtype:"",expressno:"",expressfee:"",address:"",saleportid:"",status:0,discount:"",makestaff:"",makedate:"",id:""},tabledata:[],title:"",lang:"",formid:"",base:{warehouseid:""},props:f}},methods:(l={addReceive:function(){var e=this;e.form.id>0&&(f.base.salesid=e.form.id,e.$refs.receive.showFormToCreate())},getDealPrice:function(e){return 0==e.is_match?e.dealprice:e.price*e.number*this.form.discount},onChange:function(e,t){this.form.discount=t.discount},onWarehouseChange:function(e){this.base.warehouseid=e},showProduct:function(){this.$refs.stocksearch.setVisible(!0)},onSelect:function(e){this.tabledata.push({productstock:e,number:1,is_match:!0,dealprice:0,price:0})},saveOrder:function(e){var t=this;if(2!=t.form.status){t.form.status=e;var a={form:t.form};a.list=t.tabledata.map(function(e){return{productstockid:e.productstock.id,id:e.id,dealprice:e.dealprice,number:e.number,price:e.productstock.goods.price,is_match:e.is_match}}),t._submit("/sales/savesale",{params:s()(a)}).then(function(e){var a=e.data;a.form.id&&(i.f.copyTo(a.form,t.form),t.formid=t.form.id,f.base.salesid=t.form.id,t.tabledata=[],a.list.forEach(function(e){t._log(e),t.appendRow(e)})),t.$emit("change",e.data.form)})}},deleteRow:function(e,t){var a=this;a.$delete(a.tabledata,e)},showAttachment:function(){var e=this;e.form.id>0&&e.form.status},zuofei:function(){var e=this;e.canZuofei&&e.$confirm(e._label("zuofei_warning"),e._label("tip"),{confirmButtonText:e._label("ok"),cancelButtonText:e._label("cancel"),type:"warning"}).then(function(){e.saveOrder(2)})},yushou:function(){this.canYushou&&this.saveOrder(0)},tijiao:function(){var e=this;e.canTijiao&&e.$confirm(e._label("tijiao_warning"),e._label("tip"),{confirmButtonText:e._label("ok"),cancelButtonText:e._label("cancel"),type:"warning"}).then(function(){e.saveOrder(1)})}},n()(l,"deleteRow",function(e,t){var a=this;a.$delete(a.tabledata,e)}),n()(l,"appendRow",function(e){var t=this;u.f.get(e.productstock,function(a){t._log("Productstock",a),e.productstock=a,e.is_match=1==parseInt(e.is_match),t.tabledata.push(e)},1)}),l),computed:{isEditable:function(){var e=this.form.status;return 0==e||""==e||!e},canZuofei:function(){return this.form.id>0&&0==this.form.status},canTijiao:function(){var e=this.form;return""==e.id||2!=e.status},canYushou:function(){var e=this.form;return""==e.id||0==e.status}},mounted:function(){var e=this,t=e.$route,a=void 0;0==t.params.id?a=e._label("xinjianxiaoshoudan"):(e.tabledata=[],e._fetch("/sales/loadsale",{id:t.params.id}).then(function(t){Object(c.a)(t.data.form,e.form),t.data.list&&t.data.list.forEach(function(t){e.appendRow(t)}),e._setTitle(e._label("xiaoshoudan")+e.form.id)}),a="loading..."),e._setTitle(a)}}},342:function(e,t,a){"use strict";var l=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"mini"}},[a("el-row",{attrs:{gutter:0}},[a("au-button",{attrs:{auth:"sales",type:e.canYushou?"primary":"info"},on:{click:function(t){return e.yushou()}}},[e._v(e._s(e._label("yushou")))]),e._v(" "),a("au-button",{attrs:{auth:"sales",type:e.canTijiao?"primary":"info"},on:{click:function(t){return e.tijiao()}}},[e._v(e._s(e._label("tijiao")))]),e._v(" "),a("au-button",{attrs:{auth:"sales",type:e.form.id>0&&2!=e.form.status?"primary":"info"},on:{click:function(t){return e.showAttachment()}}},[e._v(e._s(e._label("fujian")))]),e._v(" "),a("au-button",{attrs:{auth:"sales",type:e.canZuofei?"primary":"info"},on:{click:function(t){return e.zuofei()}}},[e._v(e._s(e._label("zuofei")))]),e._v(" "),a("au-button",{attrs:{auth:"sales",type:e.form.id>0?"primary":"info"},on:{click:e.addReceive}},[e._v(e._s(e._label("tianjiashoukuan")))]),e._v(" "),a("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.showProduct()}}},[e._v(e._s(e._label("xuanzeshangpin")))])],1),e._v(" "),a("el-row",{attrs:{gutter:0}},[a("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[a("el-form-item",{attrs:{label:e._label("xiaoshouduankou")}},[a("simple-select",{ref:"saleportid",attrs:{source:"usersaleport",lang:e.lang,disabled:0!=e.form.status},on:{change:e.onChange},model:{value:e.form.saleportid,callback:function(t){e.$set(e.form,"saleportid",t)},expression:"form.saleportid"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("zhekou")}},[a("el-input",{attrs:{disabled:""},model:{value:e.form.discount,callback:function(t){e.$set(e.form,"discount",t)},expression:"form.discount"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("xiaoshoucangku")}},[a("simple-select",{attrs:{source:"userwarehouse",lang:e.lang,disabled:0!=e.form.status},on:{change:e.onWarehouseChange},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("xiaoshouriqi")}},[a("el-date-picker",{attrs:{type:"date","value-format":"yyyy-MM-dd"},model:{value:e.form.salesdate,callback:function(t){e.$set(e.form,"salesdate",t)},expression:"form.salesdate"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("huiyuan")}},[a("simple-select",{attrs:{source:"member",lang:e.lang},model:{value:e.form.memberid,callback:function(t){e.$set(e.form,"memberid",t)},expression:"form.memberid"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[a("el-form-item",{attrs:{label:e._label("xiaoshouren")}},[a("simple-select",{attrs:{source:"user",lang:e.lang},model:{value:e.form.salesstaff,callback:function(t){e.$set(e.form,"salesstaff",t)},expression:"form.salesstaff"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("waitudingdanhao")}},[a("el-input",{model:{value:e.form.externalno,callback:function(t){e.$set(e.form,"externalno",t)},expression:"form.externalno"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("duizhangdanhao")}},[a("el-input",{model:{value:e.form.ordercode,callback:function(t){e.$set(e.form,"ordercode",t)},expression:"form.ordercode"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("zhidanriqi")}},[a("el-input",{attrs:{value:e.form.makedate,placeholder:e._label("zidonghuoqu"),disabled:""}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("zhidanren")}},[a("sp-display-input",{attrs:{value:e.form.makestaff,source:"user"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"300px"},attrs:{span:4}},[a("el-form-item",{attrs:{label:e._label("tihuofangshi")}},[a("simple-select",{attrs:{source:"pickingtype",lang:e.lang},model:{value:e.form.pickingtype,callback:function(t){e.$set(e.form,"pickingtype",t)},expression:"form.pickingtype"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("kuaidifukuanfang")}},[a("simple-select",{attrs:{source:"expresspaidtype",lang:e.lang},model:{value:e.form.expresspaidtype,callback:function(t){e.$set(e.form,"expresspaidtype",t)},expression:"form.expresspaidtype"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("kuaididanhao")}},[a("el-input",{model:{value:e.form.expressno,callback:function(t){e.$set(e.form,"expressno",t)},expression:"form.expressno"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("kuaidifeiyong")}},[a("el-input",{model:{value:e.form.expressfee,callback:function(t){e.$set(e.form,"expressfee",t)},expression:"form.expressfee"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("shouhuodizhi")}},[a("el-input",{model:{value:e.form.address,callback:function(t){e.$set(e.form,"address",t)},expression:"form.address"}})],1)],1)],1)],1),e._v(" "),0==e.form.status?a("el-row",{attrs:{type:"flex",justify:"end"}},[a("el-col",{attrs:{span:24}},[a("search",{attrs:{base:e.base},on:{select:e.onSelect}})],1)],1):e._e(),e._v(" "),a("el-row",[a("el-col",{attrs:{span:24}},[0==e.form.status?a("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,stripe:"",border:""}},[a("el-table-column",{attrs:{prop:"productname",label:e._label("chanpinmingcheng"),align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(t.row.productstock.product.productname)+"\n                    ")]}}],null,!1,2546990449)}),e._v(" "),a("el-table-column",{attrs:{prop:"sizecontent_label",label:e._label("chima"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"warehousename",label:e._label("cangku"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(t.row.productstock.warehouse.name)+"\n                    ")]}}],null,!1,2274592980)}),e._v(" "),a("el-table-column",{attrs:{prop:"warehouse_number",label:e._label("kucunshuliang"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(t.row.productstock.number)+"\n                    ")]}}],null,!1,3940626043)}),e._v(" "),a("el-table-column",{attrs:{prop:"price",label:e._label("danjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(t.row.productstock.goods.price)+"\n                    ")]}}],null,!1,3370394827)}),e._v(" "),a("el-table-column",{attrs:{prop:"price",label:e._label("zongjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(e.form.discount*t.row.productstock.goods.price*t.row.number)+"\n                    ")]}}],null,!1,1343443661)}),e._v(" "),a("el-table-column",{attrs:{prop:"number",label:e._label("shuliang"),width:"200",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("el-input-number",{attrs:{min:1,max:1*t.row.productstock.warehouse.number},model:{value:t.row.number,callback:function(a){e.$set(t.row,"number",a)},expression:"scope.row.number"}})]}}],null,!1,1064282817)}),e._v(" "),a("el-table-column",{attrs:{prop:"number",label:e._label("chengjiaojia"),width:"200",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[t.row.is_match?e._e():a("el-input",{model:{value:t.row.dealprice,callback:function(a){e.$set(t.row,"dealprice",a)},expression:"scope.row.dealprice"}}),e._v(" "),t.row.is_match?a("el-input",{attrs:{value:e.form.discount*t.row.productstock.goods.price*t.row.number,disabled:""}}):e._e()]}}],null,!1,2189512863)}),e._v(" "),a("el-table-column",{attrs:{label:e._label("jiagepipei"),width:"150",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("el-switch",{model:{value:t.row.is_match,callback:function(a){e.$set(t.row,"is_match",a)},expression:"scope.row.is_match"}})]}}],null,!1,1091870395)}),e._v(" "),a("el-table-column",{attrs:{label:e._label("caozuo"),width:"150",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("as-button",{attrs:{size:"mini",type:"danger"},on:{click:function(a){return e.deleteRow(t.$index,t.row)}}},[e._v(e._s(e._label("shanchu")))])]}}],null,!1,3806736578)})],1):e._e(),e._v(" "),0!=e.form.status?a("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,stripe:"",border:""}},[a("el-table-column",{attrs:{prop:"productname",label:e._label("chanpinmingcheng"),align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"sizecontent_label",label:e._label("chima"),width:"100",align:"center"}}),e._v(" "),a("el-table-column",{attrs:{prop:"warehousename",label:e._label("cangku"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(t.row.productstock.warehouse.name)+"\n                    ")]}}],null,!1,2274592980)}),e._v(" "),a("el-table-column",{attrs:{prop:"price",label:e._label("danjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(t.row.price)+"\n                    ")]}}],null,!1,4189293232)}),e._v(" "),a("el-table-column",{attrs:{prop:"number",label:e._label("xiaoshoushuliang"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(t.row.number)+"\n                    ")]}}],null,!1,952877758)}),e._v(" "),a("el-table-column",{attrs:{prop:"discount",label:e._label("zongjia"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(e.form.discount*t.row.price*t.row.number)+"\n                    ")]}}],null,!1,4156685078)}),e._v(" "),a("el-table-column",{attrs:{prop:"dealprice",label:e._label("chengjiaozongjia"),width:"200",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n                        "+e._s(e.getDealPrice(t.row))+"\n                    ")]}}],null,!1,3664245285)})],1):e._e()],1)],1),e._v(" "),a("sp-productstock-search",{ref:"stocksearch",on:{select:e.onSelect}})],1)},o=[],n={render:l,staticRenderFns:o};t.a=n}});
//# sourceMappingURL=17-1009.js.map