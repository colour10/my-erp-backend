webpackJsonp([4],{295:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=n(329),i=n(371),r=n(0),o=r(a.a,i.a,!1,null,null,null);t.default=o.exports},303:function(e,t,n){"use strict";function a(e,t,n){var a=void 0;return function(){var i=this,r=arguments;if(a&&clearTimeout(a),n){var o=!a;a=setTimeout(function(){a=null},t),o&&e.apply(i,r)}else a=setTimeout(function(){e.apply(i,r)},t)}}n.d(t,"b",function(){return i}),n.d(t,"c",function(){return r}),n.d(t,"a",function(){return a});var i=function(){},r=function(){return!0}},329:function(e,t,n){"use strict";var a=n(12),i=n.n(a),r=n(13),o=n.n(r),s=(n(1),n(369)),l=n(303),c=n(123),u=Object(c.c)("companyinvoice");t.a={name:"sp-system",components:{myform:s.a},data:function(){return{currentTab:"info",fture:l.c,props:u}},methods:{onTabClick:function(e){},onSubmit:function(e){this._submit("/company/update",e).then(function(){})},loadInfo:function(){var e=this;return o()(i.a.mark(function t(){var n,a;return i.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return n=e,t.next=3,n._fetch("/company/info",{});case 3:a=t.sent,n._log(a),n.$refs.company.setInfo(a.data),u.base.companyid=a.data.id;case 7:case"end":return t.stop()}},t,e)}))()}},mounted:function(){function e(){return t.apply(this,arguments)}var t=o()(i.a.mark(function e(){var t;return i.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:t=this,t.loadInfo();case 2:case"end":return e.stop()}},e,this)}));return e}()}},330:function(e,t,n){"use strict";var a=n(1),i=n(123),r=n(53),o=n(303);t.a={name:"sp-form",props:{name:{type:String},authname:{},isEditable:{type:Function,default:o.b},disabled:{},inline:{type:Boolean,default:!1},width:{}},components:{},data:function(){for(var e=this,t={},n={},r=Object(i.c)(e.name),o=0;o<r.columns.length;o++){var s=r.columns[o].name;t[s]="",n[s]=""}return{setting:{submitButtonText:Object(a.d)("baocun")},prop:r,options:r.options||{},form:t,disableds:n}},methods:{onSubmit:function(){var e=this;e.$emit("submit",Object(a.h)({},e.form))},setInfo:function(e){var t=this;return a.f.empty(t.form),Object(a.h)(t.form,e),t},isDisabled:function(e){var t=this,n=t.disableds;return"function"==typeof t.isEditable&&0==t.isEditable(t.form)||!!n[e.name]&&!0===n[e.name]},setDisabled:function(e,t){var n=this;return Object(a.h)(n.disableds,Object(r.b)(e,t)),n}},watch:{},computed:{},mounted:function(){}}},369:function(e,t,n){"use strict";var a=n(330),i=n(370),r=n(0),o=r(a.a,i.a,!1,null,null,null);t.a=o.exports},370:function(e,t,n){"use strict";var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{style:{width:e.width}},[n("el-row",[n("el-col",{staticClass:"user-form",attrs:{span:24}},[e._t("default",[n("el-form",{ref:"form",attrs:{model:e.form,"label-width":"100px",inline:e.inline,size:"mini"}},e._l(e.prop.columns,function(t){return t.is_edit_hide?e._e():n("el-form-item",{key:t.name,class:t.class?t.class:"",attrs:{label:t.label}},[t.type&&"input"!=t.type&&"textarea"!=t.type?e._e():n("el-input",{ref:t.name,refInFor:!0,attrs:{type:t.type?t.type:"text",disabled:e.isDisabled(t)},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.onSubmit(t)}},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}}),e._v(" "),"switch"==t.type?n("el-switch",{ref:t.name,refInFor:!0,attrs:{"active-value":"1","inactive-value":"0",disabled:e.isDisabled(t)},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}}):e._e(),e._v(" "),"select"==t.type?n("simple-select",{ref:t.name,refInFor:!0,attrs:{source:t.source,lang:e._label("lang"),disabled:e.isDisabled(t)},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}}):e._e(),e._v(" "),"date"==t.type?n("el-date-picker",{ref:t.name,refInFor:!0,attrs:{type:"date","value-format":"yyyy-MM-dd",placeholder:"",disabled:e.isDisabled(t)},model:{value:e.form[t.name],callback:function(n){e.$set(e.form,t.name,n)},expression:"form[item.name]"}}):e._e(),e._v(" "),"label"==t.type?n("span",[e._v(e._s(e.form[t.name]))]):e._e()],1)}),1)],{form:e.form})],2)],1),e._v(" "),n("el-row",[n("el-col",{staticStyle:{"text-align":"center"},attrs:{span:24}},[n("auth",{attrs:{auth:e.authname}},[e.isEditable(e.form)?n("as-button",{staticStyle:{margin:"auto"},attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e.setting.submitButtonText))]):e._e()],1),e._v(" "),e._t("button")],2)],1)],1)},i=[],r={render:a,staticRenderFns:i};t.a=r},371:function(e,t,n){"use strict";var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticStyle:{width:"1000px"}},[n("el-tabs",{attrs:{type:"border-card"},on:{"tab-click":e.onTabClick},model:{value:e.currentTab,callback:function(t){e.currentTab=t},expression:"currentTab"}},[n("el-tab-pane",{attrs:{label:e._label("jibenziliao"),name:"info"}},[n("myform",{ref:"company",attrs:{name:"company",inline:!0,authname:"company",isEditable:e.fture,width:"800px"},on:{submit:e.onSubmit}})],1),e._v(" "),n("el-tab-pane",{attrs:{label:e._label("kaipiaoxinxi"),name:"companyinvoice"}},[n("simple-admin-page",e._b({ref:"page2"},"simple-admin-page",e.props,!1))],1)],1)],1)},i=[],r={render:a,staticRenderFns:i};t.a=r}});
//# sourceMappingURL=4-1012.js.map