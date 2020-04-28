webpackJsonp([7],{287:function(e,t,r){"use strict";function a(e){r(446)}Object.defineProperty(t,"__esModule",{value:!0});var n=r(377),o=r(454),s=r(0),l=a,i=s(n.a,o.a,!1,l,"data-v-7e37e646",null);t.default=i.exports},377:function(e,t,r){"use strict";var a,n=r(5),o=r.n(n),s=r(20),l=r.n(s),i=r(7),c=r.n(i),u=r(74),p=r.n(u),d=r(38),m=r(448),f=r(2),b=r(450),h=r(452);t.a={name:"sp-productstock",components:(a={},p()(a,m.a.name,m.a),p()(a,b.a.name,b.a),p()(a,h.a.name,h.a),a),data:function(){return{selected:[],form:{wordcode:"",brandid:"",brandgroupid:"",childbrand:"",countries:"",brandcolor:"",productparst:"",series:"",ulnarinch:"",gender:"",season:"",ageseason:"",saletypeid:"",producttypeid:""},pagination:{pageSizes:f.f.pageSizes,pageSize:10,total:0,current:1},searchresult:[],isLoading:!1,types:["1","2","4"],properties:["1","2","3"],defective_levels:["1"],productresult:[],product:"",laststoragedate:"",start_number:"",end_number:""}},methods:{showDetail:function(e){var t=this;return c()(o.a.mark(function r(){var a,n,s,i,c,u,p,m,f,b;return o.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:return console.log(e),a=t,a.product=e,r.next=5,a._fetch("/productstock/searchproduct",{productid:e.productid,defective_level:e.defective_level,property:e.property});case 5:n=r.sent,s=n.data,a.productresult=[],i=!0,c=!1,u=void 0,r.prev=11,p=l()(s);case 13:if(i=(m=p.next()).done){r.next=22;break}return f=m.value,r.next=17,d.f.load({data:f,depth:2});case 17:b=r.sent,a.productresult.push(b);case 19:i=!0,r.next=13;break;case 22:r.next=28;break;case 24:r.prev=24,r.t0=r.catch(11),c=!0,u=r.t0;case 28:r.prev=28,r.prev=29,!i&&p.return&&p.return();case 31:if(r.prev=31,!c){r.next=34;break}throw u;case 34:return r.finish(31);case 35:return r.finish(28);case 36:a._showDialog("product-detail",{title:e.product.getName()});case 37:case"end":return r.stop()}},r,t,[[11,24,28,36],[29,,31,35]])}))()},handleSizeChange:function(e){this.pagination.pageSize=e,this.loadList()},handleCurrentChange:function(e){this.pagination.current=e,this.loadList()},onSearch:function(){var e=this;e.pagination.page=1,e.loadList()},loadList:function(){var e=this;if(!e.isLoading){e.isLoading=!0;var t=Object(f.h)({},e.form);t.page=e.pagination.current,t.pageSize=e.pagination.pageSize,t.type=e.typeSum,t.defective_level=e.defective_levels.join(","),t.property=e.properties.join(","),t.laststoragedate=e.laststoragedate,t.start_number=e.start_number,t.end_number=e.end_number,e._fetch("/productstock/search",t).then(function(t){e._hideDialog("search"),e.searchresult=[],console.log(t),t.data.data.forEach(function(r){d.g.get(r,function(r){e.searchresult.push(r),e.searchresult.length==t.data.data.length&&(e.isLoading=!1,Object(f.h)(e.pagination,t.data.pagination))},2)}),0==t.data.data.length&&(e.isLoading=!1)})}},getRowStyle:function(e){var t=e.row,r=t.product;if(r&&r.saletype&&r.saletype.colortemplate)return{color:r.saletype.colortemplate.row.name_en}},onSelectionChange:function(e){this.selected=e},onRowClick:function(e){this.$refs.table.toggleRowSelection(e),console.log(this.$refs.table,"row click")},showFormToModifyPrice:function(){var e=this,t=e.selected.map(function(e){return e.product.id});e.$refs.modifyprice.show(t)},tableRowClassName:function(e){e.row;return e.rowIndex%2==0?"stripe1":""}},computed:{width:function(){return 55*this.searchresult.reduce(function(e,t){var r=t.product;return Math.max(e,r.sizecontents.length)},1)},typeSum:function(){return this.types.reduce(function(e,t){return e+1*t},0)}}}},378:function(e,t,r){"use strict";t.a={name:"sp-productstock-show",props:{columns:{type:Array},stocks:{type:[Array],require:!0},type:{type:Number}},data:function(){var e=this,t={};return e.columns.forEach(function(e){t[e.id]=""}),{form:t}},methods:{update:function(e){var t=this,r=t.form;t.stocks.forEach(function(e){var a=void 0;a=1==t.type?e.number-e.reserve_number-e.shipping_number-e.sales_number:2==t.type?e.reserve_number:4==t.type?e.shipping_number:3==t.type?e.number-e.shipping_number-e.sales_number:5==t.type?e.number-e.reserve_number-e.sales_number:6==t.type?e.reserve_number+e.shipping_number:e.number,r[e.sizecontentid]=a})}},watch:{type:function(){this.update()}},mounted:function(){this.update()}}},379:function(e,t,r){"use strict";var a=r(31),n=r.n(a),o=r(5),s=r.n(o),l=r(20),i=r.n(l),c=r(77),u=r.n(c),p=r(7),d=r.n(p);r(37);t.a={name:"asa-product-modify-price",props:{},data:function(){return{products:[],prices:[]}},methods:{show:function(e){var t=this;return d()(s.a.mark(function r(){var a,n,o,l,c,p,d,m,f;return s.a.wrap(function(r){for(;;)switch(r.prev=r.next){case 0:if(n=t,0!=e.length){r.next=3;break}return r.abrupt("return");case 3:if(n.products=[],(a=n.products).push.apply(a,u()(e)),n._showDialog("dialog"),0!=n.prices.length){r.next=29;break}return r.next=9,n._dataSource("price").getList();case 9:for(o=r.sent,l=!0,c=!1,p=void 0,r.prev=13,d=i()(o);!(l=(m=d.next()).done);l=!0)f=m.value,n.prices.push({id:f.id,name:f.name,price:"",discount:"",discountCost:""});r.next=21;break;case 17:r.prev=17,r.t0=r.catch(13),c=!0,p=r.t0;case 21:r.prev=21,r.prev=22,!l&&d.return&&d.return();case 24:if(r.prev=24,!c){r.next=27;break}throw p;case 27:return r.finish(24);case 28:return r.finish(21);case 29:case"end":return r.stop()}},r,t,[[13,17,21,29],[22,,24,28]])}))()},save:function(){var e=this,t={products:e.products.join(","),prices:e.prices.filter(function(e){return e.price>0||e.discount>0||e.discountCost>0})};console.log(n()(t)),e._submit("/product/modifyprices",{params:n()(t)})},onKeyUp:function(e,t,r){var a=this;"ArrowRight"===e.key?a.focus(t+1,r):"ArrowLeft"===e.key?a.focus(t-1,r):"ArrowUp"===e.key?a.focus(t,r-1):"ArrowDown"===e.key&&a.focus(t,r+1)},focus:function(e,t){var r=this;if(!(e>3||e<=0||t<0||t>=r.prices.length)){var a=e+"-"+t;r.$refs[a]&&(r.$refs[a].focus(),r.$refs[a].select())}}},computed:{},mounted:function(){}}},380:function(e,t,r){"use strict";var a=r(77),n=r.n(a),o=r(5),s=r.n(o),l=r(20),i=r.n(l),c=r(31),u=r.n(c),p=r(19),d=r.n(p),m=r(7),f=r.n(m),b=r(74),h=r.n(b),_=r(37),v=r(38);t.a={name:"asa-oms-add",components:{},props:{product:{type:Object,default:function(){return{}}}},data:function(){var e=this;e.product;return{form:{Name:"",ShortDescription:"",InternationalCode:"",Manufacturer:"",CountryId:"",CustomsChannelId:"0",WrapId:"43",UnitId:"",HsCode:"",TradeType:"2",VATRate:"0.13",ConsumptionTaxRate:"0.05",Published:"0",Material:"",ProductionCompany:"",HKGCost:"",EURCost:"",CHNCost:"",BDACost:"",Times:""},formoption:h()({VendorId:29,WarehouseId:6,StockQuantity:0,ProductTags:"测试",UploadType:2,OldPrice:0,HKGPrice:"",EURPrice:"",CHNPrice:"",BDAPrice:"",Sku:""},"UploadType","1"),rules:{},detailImgs:[],specItems:[],pictures:[],selected:[],codes:{}}},methods:{submit:function(){var e=this;return f()(s.a.mark(function t(){var r,a;return s.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:r=e,a=r.product,r.doValidate("order-form",r.rules,f()(s.a.mark(function e(){var t,n,o,l,c,p,m,f,b,h,_,v,g,y;return s.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return t=r.form.UnitId,n=r.form.WrapId,o=r.form.CountryId,l=d()({},r.form,r.formoption),l.Spu=a.product_group,e.next=7,a.getBrandgroupchild();case 7:return c=e.sent,l.CategoryId=c.row.omscategoryid,l.SpecCount=r.specItems.length,p=new Date(a.maketime),l.CreatedOnUtc=a.maketime,l.CreatedTimeStamp=p.getTime()/1e3,l.DefaultImg=r._fileLink(a.picture),e.next=16,r._getNameById("country",o,"customsid");case 16:return l.CountryId=e.sent,e.next=19,r._getNameById("country",o,"name_cn");case 19:return l.CountryName=e.sent,e.next=22,r._getNameById("customsunit",t,"code");case 22:return l.UnitId=e.sent,e.next=25,r._getNameById("customsunit",t,"name");case 25:return l.UnitName=e.sent,e.next=28,r._getNameById("customswrap",n,"code");case 28:return l.WrapId=e.sent,e.next=31,r._getNameById("customswrap",n,"name");case 31:return l.WrapName=e.sent,e.next=34,r._getNameById("country",o,"ciqid");case 34:for(l.CiqCountry=e.sent,l.DetailImgs=r.detailImgs.map(function(e,t){return{order:t+1,url:r._fileLink(e.filename)}}),l.DetailImgs=u()(l.DetailImgs),l.ProductImgs=r.specItems.map(function(e,t){return{order:t+1,url:r._fileLink(e.picture)}}),l.ProductImgs=u()(l.ProductImgs),l.SpecItems=[],m=!0,f=!1,b=void 0,e.prev=43,h=i()(r.specItems);!(m=(_=h.next()).done);m=!0)v=_.value,g=[{k:"颜色",v:v.product.brandcolor_label},{k:"尺码",v:v.sizecontent.name}],l.SpecItems.push({Sku:v.product.wordcode+"|"+v.sizecontent.name,Price:0,StockNum:0,HsCode:l.HsCode,CountryId:l.CountryId,CountryName:l.CountryName,UnitId:l.UnitId,UnitName:l.UnitName,WrapId:l.WrapId,WrapName:l.WrapName,VATRate:l.VATRate,ConsumptionTaxRate:l.ConsumptionTaxRate,TradeType:l.TradeType,Published:l.Published,AttrComb:u()(g),CiqCountry:l.CiqCountry,InternationalCode:v.product.wordcode,Gtin:r.codes[v.sizecontent.id]});e.next=51;break;case 47:e.prev=47,e.t0=e.catch(43),f=!0,b=e.t0;case 51:e.prev=51,e.prev=52,!m&&h.return&&h.return();case 54:if(e.prev=54,!f){e.next=57;break}throw b;case 57:return e.finish(54);case 58:return e.finish(51);case 59:return console.log(u()(l)),e.prev=60,e.next=63,r._submit("/oms/update",{params:u()(l)});case 63:y=e.sent,console.log(y),e.next=70;break;case 67:e.prev=67,e.t1=e.catch(60),console.log("===",e.t1);case 70:case"end":return e.stop()}},e,this,[[43,47,51,59],[52,,54,58],[60,67]])})));case 3:case"end":return t.stop()}},t,e)}))()},init:function(){var e=this;return f()(s.a.mark(function t(){var r,a,n,o,l,c,u,p,d,m,f,b,h,g,y,w,x,k,C,I,S,$,z;return s.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(r=e,r.product.sizecontents){t.next=3;break}return t.abrupt("return");case 3:return t.next=5,r.product.getMaterial();case 5:r.form.Material=t.sent,r.product.countries&&(r.form.CountryId=r.product.countries.replace(/,.+$/,"")),r.form.Name=r.product.getName(),r.form.ShortDescription=r.form.Name,r.form.InternationalCode=r.product.wordcode,r.form.Manufacturer=r.product.brand_label,r.form.Spu=r.product.product_group,r.product.ageseason&&(r.form.Times=r.product.ageseason.replace(/,.+$/,"")),r.specItems=[],a=!0,n=!1,o=void 0,t.prev=17,l=i()(r.product.colors);case 19:if(a=(c=l.next()).done){t.next=46;break}return u=c.value,t.next=23,v.d.load({data:u.id,depth:1});case 23:for(p=t.sent,d=!0,m=!1,f=void 0,t.prev=27,b=i()(r.product.sizecontents);!(d=(h=b.next()).done);d=!0)g=h.value,console.log(p.wordcode,u,g),r.specItems.push({picture:p.picture,product:p,sizecontent:g,color:u});t.next=35;break;case 31:t.prev=31,t.t0=t.catch(27),m=!0,f=t.t0;case 35:t.prev=35,t.prev=36,!d&&b.return&&b.return();case 38:if(t.prev=38,!m){t.next=41;break}throw f;case 41:return t.finish(38);case 42:return t.finish(35);case 43:a=!0,t.next=19;break;case 46:t.next=52;break;case 48:t.prev=48,t.t1=t.catch(17),n=!0,o=t.t1;case 52:t.prev=52,t.prev=53,!a&&l.return&&l.return();case 55:if(t.prev=55,!n){t.next=58;break}throw o;case 58:return t.finish(55);case 59:return t.finish(52);case 60:return t.next=62,r._fetch("/product/getomsprices",{productid:r.product.id});case 62:return y=t.sent,w=y.data,console.log(w),r.form.HKGCost=w.hkgcost,r.form.EURCost=w.eurcost,r.form.CHNCost=w.chncost,r.form.BDACost=w.bdacost,t.next=71,_.a.getProductCodeList(r.product.id);case 71:for(x=t.sent,console.log(x),r.codes={},k=!0,C=!1,I=void 0,t.prev=77,S=i()(x);!(k=($=S.next()).done);k=!0)z=$.value,r.codes[z.sizecontentid]=z.goods_code;t.next=85;break;case 81:t.prev=81,t.t2=t.catch(77),C=!0,I=t.t2;case 85:t.prev=85,t.prev=86,!k&&S.return&&S.return();case 88:if(t.prev=88,!C){t.next=91;break}throw I;case 91:return t.finish(88);case 92:return t.finish(85);case 93:case"end":return t.stop()}},t,e,[[17,48,52,60],[27,31,35,43],[36,,38,42],[53,,55,59],[77,81,85,93],[86,,88,92]])}))()},showPicturePick:function(){var e=this;return f()(s.a.mark(function t(){var r,a,o,l,i;return s.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return a=e,o=a.product.colors.map(function(e){return e.id}),t.next=4,a._fetch("/picture/ofproducts",{productids:o.join(",")});case 4:l=t.sent,i=l.data,a.pictures=[],(r=a.pictures).push.apply(r,n()(i)),a._showDialog("pictures");case 9:case"end":return t.stop()}},t,e)}))()},onSelect:function(){var e=this,t=!0,r=!1,a=void 0;try{for(var n,o=i()(e.selected);!(t=(n=o.next()).done);t=!0){var s=n.value;!function(t){console.log(t),e.detailImgs.find(function(e){return e.id==t.id})||e.detailImgs.push(t)}(s)}}catch(e){r=!0,a=e}finally{try{!t&&o.return&&o.return()}finally{if(r)throw a}}e.selected=[],e._hideDialog("pictures")}},watch:{product:function(){this.init()}},mounted:function(){var e=this;return f()(s.a.mark(function t(){var r,a;return s.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:r=e,r.init(),a=r._label,r.setRules(function(e){r.rules.UnitId=e.required({message:a("8000"),label:a("jiliangdanwei")}),r.rules.CountryId=e.required({message:a("8000"),label:a("chandi")}),r.rules.Name=e.required({message:a("8000"),label:a("shangpinmingcheng")}),r.rules.InternationalCode=e.required({message:a("8000"),label:a("guojima")}),r.rules.Manufacturer=e.required({message:a("8000"),label:a("pinpai")}),r.rules.Material=e.required({message:a("8000"),label:a("caizhi")})});case 4:case"end":return t.stop()}},t,e)}))()}}},446:function(e,t,r){var a=r(447);"string"==typeof a&&(a=[[e.i,a,""]]),a.locals&&(e.exports=a.locals);r(181)("d57dfcea",a,!0,{})},447:function(e,t,r){t=e.exports=r(180)(!1),t.push([e.i,".order-form[data-v-7e37e646] .kucun_item .el-input__inner{width:50px}",""])},448:function(e,t,r){"use strict";var a=r(378),n=r(449),o=r(0),s=o(a.a,n.a,!1,null,null,null);t.a=s.exports},449:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"sizecontent"},[r("el-row",e._l(e.columns,function(t,a){return r("el-col",{key:t.id,staticStyle:{width:"51px"},attrs:{align:"center",span:1}},[e._v("\n      "+e._s(t.name)+"\n    ")])}),1),e._v(" "),r("el-row",e._l(e.columns,function(t,a){return r("el-input",{key:t.id,staticStyle:{width:"51px"},attrs:{value:e.form[t.id],size:"mini",disabled:""}})}),1)],1)},n=[],o={render:a,staticRenderFns:n};t.a=o},450:function(e,t,r){"use strict";var a=r(379),n=r(451),o=r(0),s=o(a.a,n.a,!1,null,null,null);t.a=s.exports},451:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("sp-dialog",{ref:"dialog",attrs:{width:"600"}},[r("el-table",{ref:"tabledetail",staticStyle:{width:"100%"},attrs:{data:e.prices,stripe:"",border:""}},[r("el-table-column",{attrs:{label:e._label("mingcheng"),align:"center",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n        "+e._s(r.name)+"\n      ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("jiage"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row,n=t.$index;return[r("el-input",{ref:"1-"+n,attrs:{size:"mini"},nativeOn:{keyup:function(t){return e.onKeyUp(t,1,n)}},model:{value:a.price,callback:function(t){e.$set(a,"price",t)},expression:"row.price"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("lingshoujiaxishu"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row,n=t.$index;return[r("el-input",{ref:"2-"+n,attrs:{size:"mini"},nativeOn:{keyup:function(t){return e.onKeyUp(t,2,n)}},model:{value:a.discount,callback:function(t){e.$set(a,"discount",t)},expression:"row.discount"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"label",label:e._label("chengbenxishu"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row,n=t.$index;return[r("el-input",{ref:"3-"+n,attrs:{size:"mini"},nativeOn:{keyup:function(t){return e.onKeyUp(t,3,n)}},model:{value:a.discountCost,callback:function(t){e.$set(a,"discountCost",t)},expression:"row.discountCost"}})]}}])})],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{attrs:{align:"center"}},[r("as-button",{attrs:{auth:"product",type:"primary"},on:{click:e.save}},[e._v(e._s(e._label("baocun")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("dialog")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)},n=[],o={render:a,staticRenderFns:n};t.a=o},452:function(e,t,r){"use strict";var a=r(380),n=r(453),o=r(0),s=o(a.a,n.a,!1,null,null,null);t.a=s.exports},453:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("el-form",{ref:"order-form",staticClass:"formx2",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"80px",inline:!0,size:"mini",rules:e.rules,"inline-message":!1,"show-message":!1}},[r("el-row",{attrs:{gutter:0}},[r("asa-button",{on:{click:e.submit}},[e._v(e._s(e._label("shangxin")))]),e._v(" "),r("asa-button",{on:{click:e.showPicturePick}},[e._v(e._s(e._label("xiangqingtu")))])],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"750px"},attrs:{span:16}},[r("el-col",{attrs:{span:16}},[r("el-form-item",{staticClass:"twocol",attrs:{label:e._label("shangpinmingcheng"),prop:"Name"}},[r("el-input",{model:{value:e.form.Name,callback:function(t){e.$set(e.form,"Name",t)},expression:"form.Name"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("chandi"),prop:"CountryId"}},[r("simple-select",{attrs:{source:"country",isIgnoreZero:!1,clearable:!1},model:{value:e.form.CountryId,callback:function(t){e.$set(e.form,"CountryId",t)},expression:"form.CountryId"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("guojima"),prop:"InternationalCode"}},[r("el-input",{model:{value:e.form.InternationalCode,callback:function(t){e.$set(e.form,"InternationalCode",t)},expression:"form.InternationalCode"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("niandai")}},[r("simple-select",{attrs:{source:"ageseason",isIgnoreZero:!1,clearable:!1},model:{value:e.form.Times,callback:function(t){e.$set(e.form,"Times",t)},expression:"form.Times"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("haiguanbianma")}},[r("el-input",{model:{value:e.form.HsCode,callback:function(t){e.$set(e.form,"HsCode",t)},expression:"form.HsCode"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("pinpai"),prop:"Manufacturer"}},[r("el-input",{model:{value:e.form.Manufacturer,callback:function(t){e.$set(e.form,"Manufacturer",t)},expression:"form.Manufacturer"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("baoguantongdao")}},[r("el-input",{model:{value:e.form.CustomsChannelId,callback:function(t){e.$set(e.form,"CustomsChannelId",t)},expression:"form.CustomsChannelId"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("caizhi"),prop:"Material"}},[r("el-input",{model:{value:e.form.Material,callback:function(t){e.$set(e.form,"Material",t)},expression:"form.Material"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("maoyileixing")}},[r("simple-select",{attrs:{source:"tradetype",isIgnoreZero:!1,clearable:!1},model:{value:e.form.TradeType,callback:function(t){e.$set(e.form,"TradeType",t)},expression:"form.TradeType"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("zengzhishuilv")}},[r("el-input",{model:{value:e.form.VATRate,callback:function(t){e.$set(e.form,"VATRate",t)},expression:"form.VATRate"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("xiaofeishuilv")}},[r("el-input",{model:{value:e.form.ConsumptionTaxRate,callback:function(t){e.$set(e.form,"ConsumptionTaxRate",t)},expression:"form.ConsumptionTaxRate"}})],1)],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"250px","padding-right":"10px"},attrs:{span:8,align:"right"}},[r("simple-avatar",{attrs:{size:130,disabled:!0},model:{value:e.product.picture,callback:function(t){e.$set(e.product,"picture",t)},expression:"product.picture"}})],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"1000px"},attrs:{span:24}},[r("el-col",{attrs:{span:6}},[r("el-form-item",{attrs:{label:e._label("shifouqiyong")}},[r("simple-select",{attrs:{source:"publishtype",isIgnoreZero:!1,clearable:!1},model:{value:e.form.Published,callback:function(t){e.$set(e.form,"Published",t)},expression:"form.Published"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:6}},[r("el-form-item",{attrs:{label:e._label("jiliangdanwei"),prop:"UnitId"}},[r("simple-select",{attrs:{source:"customsunit",isIgnoreZero:!1,clearable:!1},model:{value:e.form.UnitId,callback:function(t){e.$set(e.form,"UnitId",t)},expression:"form.UnitId"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:12}},[r("el-form-item",{staticClass:"twocol",attrs:{label:e._label("baozhuangleibie"),prop:"WrapId"}},[r("simple-select",{attrs:{source:"customswrap",isIgnoreZero:!1,clearable:!1},model:{value:e.form.WrapId,callback:function(t){e.$set(e.form,"WrapId",t)},expression:"form.WrapId"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:12}},[r("el-form-item",{staticClass:"twocol",attrs:{label:e._label("shangpinjianyao")}},[r("el-input",{model:{value:e.form.ShortDescription,callback:function(t){e.$set(e.form,"ShortDescription",t)},expression:"form.ShortDescription"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:12}},[r("el-form-item",{staticClass:"twocol",attrs:{label:e._label("shengchandanwei")}},[r("el-input",{model:{value:e.form.ProductionCompany,callback:function(t){e.$set(e.form,"ProductionCompany",t)},expression:"form.ProductionCompany"}})],1)],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"1000px"},attrs:{span:24}},[r("el-col",{attrs:{span:6}},[r("el-form-item",{attrs:{label:e._label("xiangganggonghuojia")}},[r("el-input",{model:{value:e.form.HKGCost,callback:function(t){e.$set(e.form,"HKGCost",t)},expression:"form.HKGCost"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:6}},[r("el-form-item",{attrs:{label:e._label("guoneigonghuojia")}},[r("el-input",{model:{value:e.form.CHNCost,callback:function(t){e.$set(e.form,"CHNCost",t)},expression:"form.CHNCost"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:6}},[r("el-form-item",{attrs:{label:e._label("baoshuigonghuojia")}},[r("el-input",{model:{value:e.form.BDACost,callback:function(t){e.$set(e.form,"BDACost",t)},expression:"form.BDACost"}})],1)],1),e._v(" "),r("el-col",{attrs:{span:6}},[r("el-form-item",{attrs:{label:e._label("ouzhougonghuojia")}},[r("el-input",{model:{value:e.form.EURCost,callback:function(t){e.$set(e.form,"EURCost",t)},expression:"form.EURCost"}})],1)],1)],1)],1)],1),e._v(" "),r("el-row",{attrs:{gutter:6}},[r("el-col",{attrs:{span:12}},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.specItems,stripe:"",border:""}},[r("el-table-column",{attrs:{label:e._label("zhutu"),align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-product-icon",{attrs:{file:t.picture}})]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"number",label:e._label("sku"),align:"center",width:"300"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;t.$index;return[e._v("\n            "+e._s(r.product.wordcode+"|"+r.sizecontent.name)+"\n          ")]}}])}),e._v(" "),r("el-table-column",{attrs:{prop:"total",label:e._label("yanse"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n            "+e._s(r.product.brandcolor_label)+"\n          ")]}}])})],1)],1),e._v(" "),r("el-col",{attrs:{span:12}},[r("draggable",{model:{value:e.detailImgs,callback:function(t){e.detailImgs=t},expression:"detailImgs"}},[r("transition-group",e._l(e.detailImgs,function(t){return r("el-col",{key:t.id,attrs:{span:24,align:"center"}},[r("img",{staticStyle:{"max-width":"80px","max-height":"80px"},attrs:{src:e._fileLink(t.filename)}})])}),1)],1)],1)],1),e._v(" "),r("sp-dialog",{ref:"pictures",attrs:{width:800}},[r("el-row",{attrs:{gutter:10}},[r("el-checkbox-group",{model:{value:e.selected,callback:function(t){e.selected=t},expression:"selected"}},e._l(e.pictures,function(t){return r("el-col",{key:t.id,staticStyle:{"margin-bottom":"20px","text-align":"center"},attrs:{span:6}},[r("el-checkbox",{attrs:{label:t}},[r("img",{staticClass:"avatar",staticStyle:{margin:"auto"},attrs:{src:e._fileLink(t.filename)}})])],1)}),1)],1),e._v(" "),r("el-row",{attrs:{gutter:10}},[r("el-col",{attrs:{span:24,align:"center"}},[r("as-button",{attrs:{type:"primary"},on:{click:e.onSelect}},[e._v(e._s(e._label("queding")))]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("pictures")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1)},n=[],o={render:a,staticRenderFns:n};t.a=o},454:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticStyle:{width:"100%"}},[r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._showDialog("search")}}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),r("asa-button",{attrs:{enable:e._isAllowed("product")&&e.selected.length>0},on:{click:function(t){return e.showFormToModifyPrice()}}},[e._v("\n    "+e._s(e._label("xiugaijiage"))+"\n  ")]),e._v(" "),r("asa-button",{attrs:{enable:1==e.selected.length},on:{click:function(t){return e._showDialog("oms-add")}}},[e._v(e._s(e._label("shangxin")))]),e._v(" "),r("div",{staticClass:"product"},[r("el-table",{ref:"table",staticStyle:{width:"100%"},attrs:{data:e.searchresult,border:"","row-style":e.getRowStyle,rowClassName:e.tableRowClassName},on:{"row-dblclick":e.showDetail,"selection-change":e.onSelectionChange,"row-click":e.onRowClick}},[r("el-table-column",{attrs:{type:"selection",width:60}}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zhutu"),align:"center",width:"60"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-product-icon",{attrs:{file:t.product.picture}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chanpinmingcheng"),align:"center",sortable:"",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n          "+e._s(r.product.getName())+"\n        ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",sortable:"",width:"200"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-product-tip",{attrs:{product:t.product}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("kucunshuliang"),width:e.width,align:"left"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("sp-productstock-show",{attrs:{columns:a.product.sizecontents,stocks:a.stocks,type:e.typeSum}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chuchangjia"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n          "+e._s(r.product.factorypricecurrency_label+" "+r.product.factoryprice)+"\n        ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojilingshoujia"),width:"110",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n          "+e._s(r.product.wordpricecurrency_label+" "+r.product.wordprice)+"\n        ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("chengben"),width:"140",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("sp-select-text",{attrs:{value:a.product.costcurrency,source:"currency"}}),e._v("\n          "+e._s(a.product.cost)+"\n        ")]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shuxing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.property,source:"orderproperty"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("canpin"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.defective_level,source:"defectivelevel"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("xiaoshoushuxing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.saletypeid,source:"saletype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("shangpinshuxing"),width:"90",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.producttypeid,source:"producttype"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("zuihouruku"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var r=t.row;return[e._v("\n          "+e._s(e._left(r.product.laststoragedate,10))+"\n        ")]}}])})],1),e._v(" "),e.searchresult.length<e.pagination.total?r("el-pagination",{attrs:{"current-page":1*e.pagination.current,"page-sizes":e.pagination.pageSizes,"page-size":1*e.pagination.pageSize,layout:"total, sizes, prev, pager, next, jumper",total:1*e.pagination.total},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}}):e._e()],1),e._v(" "),r("sp-dialog",{ref:"search",attrs:{width:900}},[r("el-form",{staticClass:"order-form",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"70px",inline:!1,size:"mini"},nativeOn:{submit:function(e){e.preventDefault()}}},[r("el-row",{attrs:{gutter:0}},[r("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("cangku")}},[r("simple-select",{attrs:{source:"warehouse",clearable:!0},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("guojima"),prop:"ageseason"}},[r("el-input",{staticClass:"width2",model:{value:e.form.wordcode,callback:function(t){e.$set(e.form,"wordcode",t)},expression:"form.wordcode"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("niandai"),prop:"ageseason"}},[r("simple-select",{attrs:{source:"ageseason",multiple:!0},model:{value:e.form.ageseason,callback:function(t){e.$set(e.form,"ageseason",t)},expression:"form.ageseason"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinpai"),prop:"brandid"}},[r("simple-select",{attrs:{source:"brand",multiple:!0},model:{value:e.form.brandid,callback:function(t){e.$set(e.form,"brandid",t)},expression:"form.brandid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("pinlei"),prop:"brandgroupid"}},[r("simple-select",{attrs:{source:"brandgroup",multiple:!0},model:{value:e.form.brandgroupid,callback:function(t){e.$set(e.form,"brandgroupid",t)},expression:"form.brandgroupid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zipinlei"),prop:"childbrand"}},[r("simple-select",{ref:"childbrand",attrs:{source:"brandgroupchild",parentid:e.form.brandgroupid,multiple:!0},model:{value:e.form.childbrand,callback:function(t){e.$set(e.form,"childbrand",t)},expression:"form.childbrand"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("chandi"),prop:"countries"}},[r("simple-select",{attrs:{source:"country"},model:{value:e.form.countries,callback:function(t){e.$set(e.form,"countries",t)},expression:"form.countries"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shangpinchicun")}},[r("simple-select",{attrs:{source:"ulnarinch",multiple:!0},model:{value:e.form.ulnarinch,callback:function(t){e.$set(e.form,"ulnarinch",t)},expression:"form.ulnarinch"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("shangpinxilie")}},[r("simple-select",{ref:"series",attrs:{source:"series",parentid:e.form.brandid,multiple:!0},model:{value:e.form.series,callback:function(t){e.$set(e.form,"series",t)},expression:"form.series"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xiaoshoushuxing")}},[r("simple-select",{attrs:{source:"saletype",multiple:!0},model:{value:e.form.saletypeid,callback:function(t){e.$set(e.form,"saletypeid",t)},expression:"form.saletypeid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shangpinshuxing")}},[r("simple-select",{attrs:{source:"producttype",multiple:!0},model:{value:e.form.producttypeid,callback:function(t){e.$set(e.form,"producttypeid",t)},expression:"form.producttypeid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xingbie")}},[r("simple-select",{attrs:{source:"gender",multiple:!0},model:{value:e.form.gender,callback:function(t){e.$set(e.form,"gender",t)},expression:"form.gender"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jijie")}},[r("simple-select",{attrs:{source:"season2",multiple:!0},model:{value:e.form.season,callback:function(t){e.$set(e.form,"season",t)},expression:"form.season"}})],1)],1),e._v(" "),r("el-col",{staticStyle:{width:"270px"},attrs:{span:8}},[r("el-form-item",{attrs:{label:e._label("kucunzhuangtai")}},[r("el-checkbox-group",{model:{value:e.types,callback:function(t){e.types=t},expression:"types"}},[r("el-checkbox",{attrs:{label:"1"}},[e._v(e._s(e._label("daishou")))]),e._v(" "),r("el-checkbox",{attrs:{label:"2"}},[e._v(e._s(e._label("yushou")))]),e._v(" "),r("el-checkbox",{attrs:{label:"4"}},[e._v(e._s(e._label("zaitu")))])],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("shuxing")}},[r("el-checkbox-group",{model:{value:e.properties,callback:function(t){e.properties=t},expression:"properties"}},[r("el-checkbox",{attrs:{label:"1"}},[e._v(e._s(e._label("zicai")))]),e._v(" "),r("el-checkbox",{attrs:{label:"2"}},[e._v(e._s(e._label("daixiao")))])],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zhiliang")}},[r("el-checkbox-group",{model:{value:e.defective_levels,callback:function(t){e.defective_levels=t},expression:"defective_levels"}},[r("el-checkbox",{attrs:{label:"1"}},[e._v(e._s(e._label("hege")))]),e._v(" "),r("el-checkbox",{attrs:{label:"2"}},[e._v(e._s(e._label("cancipin")))])],1)],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("zuihouruku")}},[r("el-date-picker",{attrs:{"value-format":"yyyy-MM-dd HH:mm:ss",type:"daterange","range-separator":"-","start-placeholder":e._label("qishishijian"),"end-placeholder":e._label("jieshushijian")},model:{value:e.laststoragedate,callback:function(t){e.laststoragedate=t},expression:"laststoragedate"}})],1),e._v(" "),r("el-form-item",{staticClass:"kucun_item",attrs:{label:e._label("kucunshuliang")}},[r("el-input",{staticStyle:{width:"50px"},model:{value:e.start_number,callback:function(t){e.start_number=t},expression:"start_number"}}),e._v("\n            -\n            "),r("el-input",{staticStyle:{width:"50px"},model:{value:e.end_number,callback:function(t){e.end_number=t},expression:"end_number"}})],1)],1)],1),e._v(" "),r("el-row",{attrs:{gutter:0}},[r("el-col",{attrs:{align:"center"}},[r("as-button",{attrs:{auth:"product",type:"primary","native-type":"submit"},on:{click:e.onSearch}},[e._v(e._s(e._label("chaxun"))+"\n          ")]),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:function(t){return e._hideDialog("search")}}},[e._v(e._s(e._label("tuichu")))])],1)],1)],1)],1),e._v(" "),r("sp-dialog",{ref:"product-detail",attrs:{width:900}},[r("el-table",{staticStyle:{width:"100%"},attrs:{data:e.productresult,border:"","row-style":e.getRowStyle,rowClassName:e.tableRowClassName}},[r("el-table-column",{attrs:{label:e._label("cangku"),width:"160",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[r("sp-select-text",{attrs:{value:t.warehouseid,source:"warehouse"}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("guojima"),align:"center",sortable:"",width:"200"},scopedSlots:e._u([{key:"default",fn:function(t){t.row;return[r("sp-product-tip",{attrs:{product:e.product.product}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:e._label("kucunshuliang"),width:"498",align:"left"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[r("sp-productstock-show",{attrs:{columns:e.product.product.sizecontents,stocks:a.stocks,type:e.typeSum}})]}}])})],1)],1),e._v(" "),r("sp-dialog",{ref:"oms-add",attrs:{width:1040}},[r("asa-oms-add",{attrs:{product:e.selected.length>0?e.selected[0].product:void 0}})],1),e._v(" "),r("asa-product-modify-price",{ref:"modifyprice"})],1)},n=[],o={render:a,staticRenderFns:n};t.a=o}});