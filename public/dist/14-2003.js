webpackJsonp([14],{323:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=a(406),o=a(503),s=a(0),r=s(n.a,o.a,!1,null,null,null);t.default=r.exports},406:function(e,t,a){"use strict";var n=a(5),o=a.n(n),s=a(12),r=a.n(s),l=a(2),i=a(501),c=a(187),m=a(186),u=Object(m.c)("companyinvoice");t.a={name:"sp-system",components:{myform:i.a},data:function(){return{form:{hkgcost:"",eurcost:"",chncost:"",bdacost:"",oms_saleport:"",oms_warehouseids:""},currentTab:"info",fture:c.d,props:u}},methods:{submit:function(){var e=this;e._submit("/company/update",e.form).then(function(){})},onTabClick:function(e){},onSubmit:function(e){this._submit("/company/update",e).then(function(){})},loadInfo:function(){var e=this;return r()(o.a.mark(function t(){var a,n;return o.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return a=e,t.next=3,a._fetch("/company/info",{});case 3:n=t.sent,Object(l.i)(a.form,n.data),a.$refs.company.setInfo(n.data),u.base.companyid=n.data.id;case 7:case"end":return t.stop()}},t,e)}))()}},mounted:function(){var e=this;return r()(o.a.mark(function t(){var a;return o.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:a=e,a.loadInfo();case 2:case"end":return t.stop()}},t,e)}))()}}},407:function(e,t,a){"use strict";var n=a(2),o=a(186),s=a(74),r=a(187);t.a={name:"sp-form",props:{name:{type:String},authname:{},isEditable:{type:Function,default:r.c},disabled:{},inline:{type:Boolean,default:!1},width:{}},components:{},data:function(){for(var e=this,t={},a={},s=Object(o.c)(e.name),r=0;r<s.columns.length;r++){var l=s.columns[r].name;t[l]="",a[l]=""}return{setting:{submitButtonText:Object(n.d)("baocun")},prop:s,options:s.options||{},form:t,disableds:a}},methods:{onSubmit:function(){var e=this;e.$emit("submit",Object(n.h)({},e.form))},setInfo:function(e){var t=this;return n.f.empty(t.form),Object(n.h)(t.form,e),t},isDisabled:function(e){var t=this,a=t.disableds;return"function"==typeof t.isEditable&&0==t.isEditable(t.form)||!!a[e.name]&&!0===a[e.name]},setDisabled:function(e,t){var a=this;return Object(n.h)(a.disableds,Object(s.b)(e,t)),a}},watch:{},computed:{},mounted:function(){}}},501:function(e,t,a){"use strict";var n=a(407),o=a(502),s=a(0),r=s(n.a,o.a,!1,null,null,null);t.a=r.exports},502:function(e,t,a){"use strict";var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{style:{width:e.width}},[a("el-row",[a("el-col",{staticClass:"user-form",attrs:{span:24}},[e._t("default",[a("el-form",{ref:"form",attrs:{model:e.form,"label-width":"100px",inline:e.inline,size:"mini"}},e._l(e.prop.columns,function(t){return t.is_edit_hide?e._e():a("el-form-item",{key:t.name,class:t.class?t.class:"",attrs:{label:t.label}},[t.type&&"input"!=t.type&&"textarea"!=t.type?e._e():a("el-input",{ref:t.name,refInFor:!0,attrs:{type:t.type?t.type:"text",disabled:e.isDisabled(t)},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.onSubmit(t)}},model:{value:e.form[t.name],callback:function(a){e.$set(e.form,t.name,a)},expression:"form[item.name]"}}),e._v(" "),"switch"==t.type?a("el-switch",{ref:t.name,refInFor:!0,attrs:{"active-value":"1","inactive-value":"0",disabled:e.isDisabled(t)},model:{value:e.form[t.name],callback:function(a){e.$set(e.form,t.name,a)},expression:"form[item.name]"}}):e._e(),e._v(" "),"select"==t.type?a("simple-select",{ref:t.name,refInFor:!0,attrs:{source:t.source,lang:e._label("lang"),disabled:e.isDisabled(t)},model:{value:e.form[t.name],callback:function(a){e.$set(e.form,t.name,a)},expression:"form[item.name]"}}):e._e(),e._v(" "),"date"==t.type?a("el-date-picker",{ref:t.name,refInFor:!0,attrs:{type:"date","value-format":"yyyy-MM-dd",placeholder:"",disabled:e.isDisabled(t)},model:{value:e.form[t.name],callback:function(a){e.$set(e.form,t.name,a)},expression:"form[item.name]"}}):e._e(),e._v(" "),"label"==t.type?a("span",[e._v(e._s(e.form[t.name]))]):e._e()],1)}),1)],{form:e.form})],2)],1),e._v(" "),a("el-row",[a("el-col",{staticStyle:{"text-align":"center"},attrs:{span:24}},[a("auth",{attrs:{auth:e.authname}},[e.isEditable(e.form)?a("as-button",{staticStyle:{margin:"auto"},attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e.setting.submitButtonText))]):e._e()],1),e._v(" "),e._t("button")],2)],1)],1)},o=[],s={render:n,staticRenderFns:o};t.a=s},503:function(e,t,a){"use strict";var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticStyle:{width:"1100px"}},[a("el-tabs",{attrs:{type:"border-card"},on:{"tab-click":e.onTabClick},model:{value:e.currentTab,callback:function(t){e.currentTab=t},expression:"currentTab"}},[a("el-tab-pane",{attrs:{label:e._label("jibenziliao"),name:"info"}},[a("myform",{ref:"company",attrs:{name:"company",inline:!0,authname:"company",isEditable:e.fture,width:"800px"},on:{submit:e.onSubmit}})],1),e._v(" "),a("el-tab-pane",{attrs:{label:e._label("kaipiaoxinxi"),name:"companyinvoice"}},[a("simple-admin-page",e._b({ref:"page2"},"simple-admin-page",e.props,!1))],1),e._v(" "),a("el-tab-pane",{attrs:{label:"OMS Setting",name:"price"}},[a("el-form",{ref:"order-form",staticClass:"formx2",staticStyle:{width:"100%"},attrs:{model:e.form,"label-width":"80px",inline:!0,size:"mini","inline-message":!1,"show-message":!1}},[a("el-row",{attrs:{gutter:0}},[a("el-col",{attrs:{span:6}},[a("el-form-item",{attrs:{label:e._label("xiangganggonghuojia")}},[a("simple-select",{attrs:{source:"price"},model:{value:e.form.hkgcost,callback:function(t){e.$set(e.form,"hkgcost",t)},expression:"form.hkgcost"}})],1)],1),e._v(" "),a("el-col",{attrs:{span:6}},[a("el-form-item",{attrs:{label:e._label("ouzhougonghuojia")}},[a("simple-select",{attrs:{source:"price"},model:{value:e.form.eurcost,callback:function(t){e.$set(e.form,"eurcost",t)},expression:"form.eurcost"}})],1)],1),e._v(" "),a("el-col",{attrs:{span:6}},[a("el-form-item",{attrs:{label:e._label("guoneigonghuojia")}},[a("simple-select",{attrs:{source:"price"},model:{value:e.form.chncost,callback:function(t){e.$set(e.form,"chncost",t)},expression:"form.chncost"}})],1)],1),e._v(" "),a("el-col",{attrs:{span:6}},[a("el-form-item",{attrs:{label:e._label("baoshuigonghuojia")}},[a("simple-select",{attrs:{source:"price"},model:{value:e.form.bdacost,callback:function(t){e.$set(e.form,"bdacost",t)},expression:"form.bdacost"}})],1)],1),e._v(" "),a("el-col",{attrs:{span:6}},[a("el-form-item",{attrs:{label:e._label("xiaoshouduankou")}},[a("simple-select",{attrs:{source:"saleport"},model:{value:e.form.oms_saleport,callback:function(t){e.$set(e.form,"oms_saleport",t)},expression:"form.oms_saleport"}})],1)],1),e._v(" "),a("el-col",{attrs:{span:6}},[a("el-form-item",{attrs:{label:e._label("xiaoshoucangku")}},[a("simple-select",{attrs:{source:"warehouse",multiple:""},model:{value:e.form.oms_warehouseids,callback:function(t){e.$set(e.form,"oms_warehouseids",t)},expression:"form.oms_warehouseids"}})],1)],1)],1),e._v(" "),a("el-row",{attrs:{gutter:0}},[a("el-col",{attrs:{span:24,align:"center"}},[a("asa-button",{on:{click:e.submit}},[e._v(e._s(e._label("baocun")))])],1)],1)],1)],1)],1)],1)},o=[],s={render:n,staticRenderFns:o};t.a=s}});