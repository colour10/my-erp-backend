webpackJsonp([9],{309:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=n(366),r=n(418),i=n(0),o=i(a.a,r.a,!1,null,null,null);t.default=o.exports},366:function(e,t,n){"use strict";var a=n(10),r=n.n(a),i=n(11),o=n.n(i),s=(n(1),n(416)),l=n(184),c=n(183),m=Object(c.c)("companyinvoice");t.a={name:"sp-system",components:{myform:s.a},data:function(){return{currentTab:"info",fture:l.d,props:m}},methods:{onTabClick:function(e){},onSubmit:function(e){this._submit("/company/update",e).then(function(){})},loadInfo:function(){var e=this;return o()(r.a.mark(function t(){var n,a;return r.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return n=e,t.next=3,n._fetch("/company/info",{});case 3:a=t.sent,n._log(a),n.$refs.company.setInfo(a.data),m.base.companyid=a.data.id;case 7:case"end":return t.stop()}},t,e)}))()}},mounted:function(){function e(){return t.apply(this,arguments)}var t=o()(r.a.mark(function e(){var t;return r.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:t=this,t.loadInfo();case 2:case"end":return e.stop()}},e,this)}));return e}()}},367:function(e,t,n){"use strict";var a=n(1),r=n(183),i=n(56),o=n(184);t.a={name:"sp-form",props:{name:{type:String},authname:{},isEditable:{type:Function,default:o.c},disabled:{},inline:{type:Boolean,default:!1},width:{}},components:{},data:function(){for(var e=this,t={},n={},i=Object(r.c)(e.name),o=0;o<i.columns.length;o++){var s=i.columns[o].name;t[s]="",n[s]=""}return{setting:{submitButtonText:Object(a.d)("baocun")},prop:i,options:i.options||{},form:t,disableds:n}},methods:{onSubmit:function(){var e=this;e.$emit("submit",Object(a.h)({},e.form))},setInfo:function(e){var t=this;return a.f.empty(t.form),Object(a.h)(t.form,e),t},isDisabled:function(e){var t=this,n=t.disableds;return"function"==typeof t.isEditable&&0==t.isEditable(t.form)||!!n[e.name]&&!0===n[e.name]},setDisabled:function(e,t){var n=this;return Object(a.h)(n.disableds,Object(i.b)(e,t)),n}},watch:{},computed:{},mounted:function(){}}},416:function(e,t,n){"use strict";var a=n(367),r=n(417),i=n(0),o=i(a.a,r.a,!1,null,null,null);t.a=o.exports},417:function(e,t,n){"use strict";var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{style:{width:e.width}},[n("el-row",[n("el-col",{staticClass:"user-form",attrs:{span:24}},[e._t("default",[n("el-form",{ref:"form",attrs:{model:e.form,"label-width":"100px",inline:e.inline,size:"mini"}},e._l(e.prop.columns,function(t){return t.is_edit_hide?e._e():n("el-form-item",{key:t.name,class:t.class?t.class:"",attrs:{label:t.label}},[t.type&&"input"!=t.type&&"textarea"!=t.type?e._e():n("el-input",{ref:t.name,refInFor:!0,attrs:{type:t.type?t.type:"text",disabled:e.isDisabled(t)},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.onSubmit(t)}},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}}),e._v(" "),"switch"==t.type?n("el-switch",{ref:t.name,refInFor:!0,attrs:{"active-value":"1","inactive-value":"0",disabled:e.isDisabled(t)},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}}):e._e(),e._v(" "),"select"==t.type?n("simple-select",{ref:t.name,refInFor:!0,attrs:{source:t.source,lang:e._label("lang"),disabled:e.isDisabled(t)},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}}):e._e(),e._v(" "),"date"==t.type?n("el-date-picker",{ref:t.name,refInFor:!0,attrs:{type:"date","value-format":"yyyy-MM-dd",placeholder:"",disabled:e.isDisabled(t)},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}}):e._e(),e._v(" "),"label"==t.type?n("span",[e._v(e._s(e.form[t.name]))]):e._e()],1)}),1)],{form:e.form})],2)],1),e._v(" "),n("el-row",[n("el-col",{staticStyle:{"text-align":"center"},attrs:{span:24}},[n("auth",{attrs:{auth:e.authname}},[e.isEditable(e.form)?n("as-button",{staticStyle:{margin:"auto"},attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e.setting.submitButtonText))]):e._e()],1),e._v(" "),e._t("button")],2)],1)],1)},r=[],i={render:a,staticRenderFns:r};t.a=i},418:function(e,t,n){"use strict";var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticStyle:{width:"1000px"}},[n("el-tabs",{attrs:{type:"border-card"},on:{"tab-click":e.onTabClick},model:{value:e.currentTab,callback:function(t){e.currentTab=t},expression:"currentTab"}},[n("el-tab-pane",{attrs:{label:e._label("jibenziliao"),name:"info"}},[n("myform",{ref:"company",attrs:{name:"company",inline:!0,authname:"company",isEditable:e.fture,width:"800px"},on:{submit:e.onSubmit}})],1),e._v(" "),n("el-tab-pane",{attrs:{label:e._label("kaipiaoxinxi"),name:"companyinvoice"}},[n("simple-admin-page",e._b({ref:"page2"},"simple-admin-page",e.props,!1))],1)],1)],1)},r=[],i={render:a,staticRenderFns:r};t.a=i}});
//# sourceMappingURL=9-1034.js.map