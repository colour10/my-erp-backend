webpackJsonp([26],{289:function(e,a,i){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var t=i(322),n=i(359),l=i(0),s=l(t.a,n.a,!1,null,null,null);a.default=s.exports},322:function(e,a,i){"use strict";var t=i(1),n=i(123);a.a={name:"sp-brand",data:function(){return{brandrate:Object(n.c)("brandrate"),aliases:Object(n.c)("aliases"),series:Object(n.c)("series"),activeName:"info",props:{columns:[{name:"filename",label:"LOGO",type:"avatar",is_image:!0,image_width:50,image_height:50,width:55,className:"picture"},{name:"name_en",label:Object(t.d)("pinpaimingcheng"),is_multiple:!1,is_focus:!0},{name:"countryid",label:Object(t.d)("guishuguojia"),type:"select",source:"country"},{name:"memo",label:Object(t.d)("memo"),type:"textarea",is_hide:!0},{name:"officialwebsite",label:Object(t.d)("guanwangdizhi"),is_hide:!0}],options:{tableHeight:Object(t.j)(),dialogWidth:"1000px",isShowSubmit:!0},controller:"brand",key_column:"name",base:{brandid:""},formTitle:function(e){if(e&&e.id>0)return e.name_en}},id:0}},methods:{onBeforeEdit:function(e){var a=this;a.brandrate.base.brandid=e.id,a.aliases.base.brandid=e.id,a.series.base.brandid=e.id,a.id=e.id},onBeforeAdd:function(){var e=this;e.activeName="info",e.id=0},onTabClick:function(e){var a=this;a.activeName=e.name,a.props.options.isShowSubmit="info"==e.name}},mounted:function(){}}},359:function(e,a,i){"use strict";var t=function(){var e=this,a=e.$createElement,i=e._self._c||a;return i("div",{staticStyle:{width:"99%"}},[i("multiple-admin-page",e._b({ref:"page",staticClass:"product",on:{"before-edit":e.onBeforeEdit,"before-add":e.onBeforeAdd},scopedSlots:e._u([{key:"default",fn:function(a){var t=a.form,n=a.columns;return[i("el-tabs",{attrs:{type:"border-card"},on:{"tab-click":e.onTabClick},model:{value:e.activeName,callback:function(a){e.activeName=a},expression:"activeName"}},[i("el-tab-pane",{attrs:{label:e._label("jibenziliao"),name:"info"}},[i("el-form",{ref:"form",staticClass:"user-form",attrs:{model:t,"label-width":"100px",inline:!1,size:"mini"}},e._l(n,function(a){return a.is_edit_hide?e._e():i("el-form-item",{key:a.name,class:a.class?a.class:"width2",attrs:{label:a.label}},[a.type&&"input"!=a.type&&"textarea"!=a.type?e._e():i("el-input",{ref:a.name,refInFor:!0,attrs:{type:a.type?a.type:"text",size:"mini"},nativeOn:{keyup:function(a){return!a.type.indexOf("key")&&e._k(a.keyCode,"enter",13,a.key,"Enter")?null:e.onSubmit(a)}},model:{value:t[a.name],callback:function(i){e.$set(t,a.name,i)},expression:"form[item.name]"}}),e._v(" "),"select"==a.type?i("simple-select",{ref:a.name,refInFor:!0,attrs:{source:a.source},model:{value:t[a.name],callback:function(i){e.$set(t,a.name,i)},expression:"form[item.name]"}}):e._e(),e._v(" "),"avatar"==a.type?i("simple-avatar",{ref:a.name,refInFor:!0,attrs:{"font-size":"14px",size:35},model:{value:t[a.name],callback:function(i){e.$set(t,a.name,i)},expression:"form[item.name]"}}):e._e()],1)}),1)],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("bieming"),name:"aliases",disabled:0==e.id}},[i("multiple-admin-page",e._b({},"multiple-admin-page",e.aliases,!1))],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("xilie"),name:"xilie",disabled:0==e.id}},[i("multiple-admin-page",e._b({},"multiple-admin-page",e.series,!1))],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("beilv"),name:"beilv",disabled:0==e.id}},[i("simple-admin-page",e._b({scopedSlots:e._u([{key:"default",fn:function(a){return[i("el-form",{staticClass:"user-form",attrs:{model:a.form,"label-width":"100px",inline:!1,size:"mini"}},[i("el-form-item",{attrs:{label:e._label("pinlei")}},[i("simple-select",{directives:[{name:"show",rawName:"v-show",value:"add"==a.action,expression:"scope.action=='add'"}],staticClass:"width2",attrs:{source:"brandgroup",multiple:!0},model:{value:a.form.brandgroupid,callback:function(i){e.$set(a.form,"brandgroupid",i)},expression:"scope.form.brandgroupid"}}),e._v(" "),i("simple-select",{directives:[{name:"show",rawName:"v-show",value:"edit"==a.action,expression:"scope.action=='edit'"}],staticClass:"width2",attrs:{source:"brandgroup"},model:{value:a.form.brandgroupid,callback:function(i){e.$set(a.form,"brandgroupid",i)},expression:"scope.form.brandgroupid"}})],1),e._v(" "),i("el-form-item",{attrs:{label:e._label("niandaijijie")}},[i("simple-select",{staticClass:"width2",attrs:{source:"ageseason"},model:{value:a.form.ageseasonid,callback:function(i){e.$set(a.form,"ageseasonid",i)},expression:"scope.form.ageseasonid"}})],1),e._v(" "),i("el-form-item",{attrs:{label:e._label("beilv")}},[i("el-input",{staticClass:"width2",attrs:{size:"mini"},nativeOn:{keyup:function(a){return!a.type.indexOf("key")&&e._k(a.keyCode,"enter",13,a.key,"Enter")?null:e.onSubmit(a)}},model:{value:a.form.rate,callback:function(i){e.$set(a.form,"rate",i)},expression:"scope.form.rate"}})],1)],1)]}}],null,!0)},"simple-admin-page",e.brandrate,!1))],1),e._v(" "),i("el-tab-pane",{attrs:{label:e._label("jiageshezhi"),name:"price",disabled:0==e.id}},[i("sp-pricesetting",{attrs:{brandid:e.id}})],1)],1)]}}])},"multiple-admin-page",e.props,!1))],1)},n=[],l={render:t,staticRenderFns:n};a.a=l}});
//# sourceMappingURL=26-1016.js.map