webpackJsonp([24],{298:function(e,r,t){"use strict";Object.defineProperty(r,"__esModule",{value:!0});var a=t(334),c=t(375),l=t(0),n=l(a.a,c.a,!1,null,null,null);r.default=n.exports},334:function(e,r,t){"use strict";var a=t(1);r.a={name:"sp-exchangerate",props:{},data:function(){var e=this;return{props:{columns:[{name:"currency_from",label:Object(a.d)("huichuhuobi"),type:"select",source:"currency"},{name:"currency_to",label:Object(a.d)("huiruhuobi"),type:"select",source:"currency",default:Object(a.d)("_currencyid")},{name:"rate",label:Object(a.d)("huilv")},{name:"begin_time",label:Object(a.d)("shengxiaoshijian")}],buttons:[{name:"rate",label:Object(a.d)("lishihuilv"),width:150,disable_change:!0,handler:function(r,t){e.props2.base.currency_from="",e.props2.base.currency_from=t.currency_from,e.props2.base.currency_to=t.currency_to,e.dialogVisible=!0,e.title=t.currency_from__label+"/"+t.currency_to__label}}],controller:"exchangerate",auth:"exchangerate",options:{dialogWidth:"400px",autoreload:!0,autohide:!0},formTitle:function(e){if(e&&e.id>0)return e.currency_from__label+"/"+e.currency_to__label}},props2:{columns:[{name:"begin_time",label:Object(a.d)("shengxiaoshijian")},{name:"end_time",label:Object(a.d)("jiezhishijian")},{name:"rate",label:Object(a.d)("huilv"),width:100}],controller:"exchangerate",auth:"exchangerate",options:{dialogWidth:"400px",autoreload:!0,isaction:!1,actionNameOfLoad:"history"},base:{currency_from:"",currency_to:""}},dialogVisible:!1,title:""}},methods:{}}},375:function(e,r,t){"use strict";var a=function(){var e=this,r=e.$createElement,t=e._self._c||r;return t("div",[t("simple-admin-page",e._b({scopedSlots:e._u([{key:"default",fn:function(r){var a=r.form,c=r.action;return[t("el-form",{staticClass:"user-form",attrs:{model:a,inline:!0,size:"mini"}},[t("el-form-item",[t("el-col",{attrs:{span:8}},[t("simple-select",{ref:"currency_from",attrs:{source:"currency",disabled:"edit"==c},model:{value:a.currency_from,callback:function(r){e.$set(a,"currency_from",r)},expression:"form.currency_from"}})],1),e._v(" "),t("el-col",{staticClass:"line",attrs:{span:1,align:"center"}},[e._v("/")]),e._v(" "),t("el-col",{attrs:{span:8}},[t("simple-select",{ref:"currency_to",attrs:{source:"currency",disabled:"edit"==c},model:{value:a.currency_to,callback:function(r){e.$set(a,"currency_to",r)},expression:"form.currency_to"}})],1),e._v(" "),t("el-col",{staticClass:"line",attrs:{span:1,align:"center"}},[e._v("=")]),e._v(" "),t("el-col",{attrs:{span:6}},[t("el-input",{model:{value:a.rate,callback:function(r){e.$set(a,"rate",r)},expression:"form.rate"}})],1)],1)],1)]}}])},"simple-admin-page",e.props,!1)),e._v(" "),t("el-dialog",{staticClass:"user-form",attrs:{title:e.title,visible:e.dialogVisible,center:!0,width:"501px"},on:{"update:visible":function(r){e.dialogVisible=r}}},[t("simple-admin-tablelist",e._b({ref:"history"},"simple-admin-tablelist",e.props2,!1))],1)],1)},c=[],l={render:a,staticRenderFns:c};r.a=l}});
//# sourceMappingURL=24-1014.js.map