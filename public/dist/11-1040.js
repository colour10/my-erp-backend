webpackJsonp([11],{295:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var l=a(374),r=a(451),n=a(0),i=n(l.a,r.a,!1,null,null,null);t.default=i.exports},297:function(e,t,a){"use strict";t.__esModule=!0;var l=a(302),r=function(e){return e&&e.__esModule?e:{default:e}}(l);t.default=function(e){if(Array.isArray(e)){for(var t=0,a=Array(e.length);t<e.length;t++)a[t]=e[t];return a}return(0,r.default)(e)}},302:function(e,t,a){e.exports={default:a(303),__esModule:!0}},303:function(e,t,a){a(28),a(304),e.exports=a(1).Array.from},304:function(e,t,a){"use strict";var l=a(27),r=a(10),n=a(39),i=a(73),o=a(74),s=a(55),u=a(305),c=a(56);r(r.S+r.F*!a(75)(function(e){Array.from(e)}),"Array",{from:function(e){var t,a,r,d,m=n(e),f="function"==typeof this?this:Array,b=arguments.length,p=b>1?arguments[1]:void 0,_=void 0!==p,h=0,v=c(m);if(_&&(p=l(p,b>2?arguments[2]:void 0,2)),void 0==v||f==Array&&o(v))for(t=s(m.length),a=new f(t);t>h;h++)u(a,h,_?p(m[h],h):m[h]);else for(d=v.call(m),a=new f;!(r=d.next()).done;h++)u(a,h,_?i(d,p,[r.value,h],!0):r.value);return a.length=h,a}})},305:function(e,t,a){"use strict";var l=a(11),r=a(29);e.exports=function(e,t,a){t in e?l.f(e,t,r(0,a)):e[t]=a}},306:function(e,t,a){"use strict";var l=a(53);t.a={methods:{formatNumber:function(e){return Object(l.b)(e,3)},f:function(e){return Object(l.b)(e,2)}}}},374:function(e,t,a){"use strict";var l=a(8),r=a.n(l),n=a(297),i=a.n(n),o=a(9),s=a.n(o),u=(a(35),a(17)),c=a(306);t.a={name:"sp-billupdate",components:{},mixins:[c.a],data:function(){var e=this,t=e._label;return{form:{billno:"",amount:0,amount_origin:"",billtype:"",out_billno:"",supplierid:"",invoice:"",currencyid:"",memo:"",createstaff:"",createtime:"",invoiceName:"",status:""},tabledata:[],props:{columns:[{name:"enterdate",label:t("huikuanriqi"),type:"date",width:110,default:t("_date")},{name:"currencyid",label:t("bizhong"),type:"select",source:"currency",width:90,sortable:!1,default:"",disabled:!0},{name:"amount",label:t("jine"),width:110},{name:"invoice",label:t("fapiaobianhao"),width:110,sortable:!1},{name:"bankaccount",label:t("huikuanzhanghu"),sortable:!1,width:150},{name:"memo",label:t("beizhu"),width:150,sortable:!1},{name:"createstaff",label:t("tijiaoren"),type:"select",source:"user",is_edit_hide:!0,width:130}],controller:"billconfirm",auth:"billconfirm",base:{billid:""},options:{isSearch:!1},isDisabled:function(e){return"currencyid"==e.name}}}},methods:{getSummary:function(e){var t=e.columns,a=e.data,l=this,r=[];return t.forEach(function(e,t){5==t&&(r[t]=l.f(a.reduce(function(e,t){return e+Number(t.amount)},0)))}),r},load:function(){var e=this;return s()(r.a.mark(function t(){var a,l,n,o,s,c;return r.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return l=e,n=l.$route.params,t.next=4,l._fetch("/bill/load",{id:n.id});case 4:return o=t.sent,s=o.data,Object(u.b)(l.form,s.form),t.next=9,l._getRow("supplierinvoice",s.form.invoiceid);case 9:c=t.sent,c&&(l.form.invoiceName=c.name),l.tabledata=[],(a=l.tabledata).push.apply(a,i()(s.list));case 13:case"end":return t.stop()}},t,e)}))()}},computed:{totalAmount:function(){var e=this;return e.f(e.tabledata.reduce(function(e,t){return e+Number(t.amount)},0))}},mounted:function(){var e=this;return s()(r.a.mark(function t(){var a;return r.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return a=e,t.next=3,a.load();case 3:a.props.base.billid=a.form.id,a.props.columns[1].default=a.form.currencyid,a._setTitle(a._label("duizhangdan")+":"+a.form.billno);case 6:case"end":return t.stop()}},t,e)}))()}}},451:function(e,t,a){"use strict";var l=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-form",{ref:"order-form",staticClass:"formx",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"100px",inline:!0,size:"mini",rules:e.formRules,"inline-message":!1,"show-message":!1}},[a("el-row",{attrs:{gutter:0}},[a("asa-button",{on:{click:function(t){return e._showDialog("select-dialog")}}},[e._v(e._s(e._label("huikuanqingkuang")))])],1),e._v(" "),a("el-row",{attrs:{gutter:0}},[a("el-col",{staticStyle:{width:"250px"},attrs:{span:4}},[a("el-form-item",{attrs:{label:e._label("duizhangdanhao")}},[a("el-input",{attrs:{value:e.form.billno,disabled:""}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("shoufufei")}},[a("simple-select",{attrs:{source:"billtype",disabled:""},model:{value:e.form.billtype,callback:function(t){e.$set(e.form,"billtype",t)},expression:"form.billtype"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("bizhong")}},[a("simple-select",{attrs:{source:"currency",disabled:""},model:{value:e.form.currencyid,callback:function(t){e.$set(e.form,"currencyid",t)},expression:"form.currencyid"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"250px"},attrs:{span:4}},[a("el-form-item",{attrs:{label:e._label("yuanshijine")}},[a("el-input",{attrs:{value:e.form.amount_origin,disabled:""}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("tiaozhengjine")}},[a("el-input",{attrs:{value:e.form.amount-e.form.amount_origin,disabled:""}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("duizhangjine")}},[a("el-input",{attrs:{disabled:""},model:{value:e.form.amount,callback:function(t){e.$set(e.form,"amount",t)},expression:"form.amount"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"500px"},attrs:{span:8}},[a("el-row",[a("el-col",{staticStyle:{width:"250px"},attrs:{span:4}},[a("el-form-item",{attrs:{label:e._label("waibuduizhangdanhao")}},[a("el-input",{attrs:{disabled:""},model:{value:e.form.out_billno,callback:function(t){e.$set(e.form,"out_billno",t)},expression:"form.out_billno"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("shoufufeidanwei")}},[a("simple-select",{attrs:{source:"supplier",disabled:""},model:{value:e.form.supplierid,callback:function(t){e.$set(e.form,"supplierid",t)},expression:"form.supplierid"}})],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"250px"},attrs:{span:4}},[a("el-form-item",{attrs:{label:e._label("zhidanren")}},[a("sp-display-input",{attrs:{value:e.form.createstaff,source:"user"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("zhidanriqi")}},[a("el-input",{attrs:{value:e.form.createtime,disabled:""}})],1)],1)],1),e._v(" "),a("el-row",[a("el-form-item",{staticClass:"twocol",attrs:{label:e._label("fapiaotaitou")}},[a("el-input",{staticClass:"twocol",attrs:{value:e.form.invoiceName,disabled:""}})],1)],1)],1),e._v(" "),a("el-col",{staticStyle:{width:"250px"},attrs:{span:4}},[a("el-form-item",{attrs:{label:e._label("beizhu"),"label-width":"50px"}},[a("el-input",{attrs:{type:"textarea",disabled:""},model:{value:e.form.memo,callback:function(t){e.$set(e.form,"memo",t)},expression:"form.memo"}})],1),e._v(" "),a("el-form-item",{attrs:{label:e._label("zhuangtai"),"label-width":"50px"}},[a("sp-display-input",{attrs:{value:e.form.status,source:"billstatus"}})],1)],1)],1)],1),e._v(" "),a("el-row",[a("el-col",{staticClass:"product",attrs:{span:24}},[a("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tabledata,stripe:"",border:"","show-summary":!0,"summary-method":e.getSummary}},[a("el-table-column",{attrs:{label:e._label("xiaoshouduankou"),align:"center",width:"110"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;e.$index;return[a("sp-select-text",{attrs:{value:t.sales.saleportid,source:"saleport"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("zongshu"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-fetch-text",{attrs:{table:"member",pid:t.sales.memberid,column:"name"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("bizhong"),width:"80",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.currency,source:"currency"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("fukuanfangshi"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.paymentwayid,source:"paymentway"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("jine"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n            "+e._s(a.amount)+"\n          ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("xiaoshouren"),width:"100",align:"center"},scopedSlots:e._u([{key:"default",fn:function(e){var t=e.row;return[a("sp-select-text",{attrs:{value:t.sales.salesstaff,source:"user"}})]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("xiaoshoudanhao"),width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n            "+e._s(a.sales.orderno)+"\n          ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("waibudingdanhao"),width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n            "+e._s(a.sales.expressno)+"\n          ")]}}])}),e._v(" "),a("el-table-column",{attrs:{label:e._label("fukuanriqi"),width:"130",align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){var a=t.row;return[e._v("\n            "+e._s(a.paymentdate)+"\n          ")]}}])})],1)],1)],1),e._v(" "),a("sp-dialog",{ref:"select-dialog",attrs:{"min-height":50,width:1100},on:{close:e.load}},[e.form.id>0?a("simple-admin-page",e._b({ref:"receive",attrs:{"hide-create":!0,"hide-form":!0}},"simple-admin-page",e.props,!1)):e._e()],1)],1)},r=[],n={render:l,staticRenderFns:r};t.a=n}});