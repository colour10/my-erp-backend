webpackJsonp([17],{295:function(e,n,t){"use strict";Object.defineProperty(n,"__esModule",{value:!0});var i=t(331),a=t(377),o=t(0),l=o(i.a,a.a,!1,null,null,null);n.default=l.exports},331:function(e,n,t){"use strict";var i=t(1),a={columns:[{name:"name_cn",label:Object(i.d)("jiancheng"),is_focus:!0,sortable:!0},{name:"name_en",label:Object(i.d)("mingcheng"),sortable:!0},{name:"displayindex",label:Object(i.d)("paixu"),sortMethod:function(e,n){return e-n}}],buttons:[{name:"code",label:Object(i.d)("chakanziji"),width:200,disable_change:!0,handler:function(e,n){o.base.topid=n.id,l.dialogVisible=!0,l.title=n.name_cn}}],controller:"sizetop",key_column:"name"},o={columns:[{name:"name",label:Object(i.d)("neirong"),is_focus:!0}],actions:[{label:Object(i.d)("dingbu"),handler:function(e){var n=e.row,t=e.vm;t._fetch("/sizecontent/top",{id:n.id}).then(function(){t.loadList(function(e){return e})})}},{label:Object(i.d)("xiangshang"),handler:function(e){var n=e.row,t=e.vm;t._fetch("/sizecontent/up",{id:n.id}).then(function(){t.loadList(function(e){return e})})}},{label:Object(i.d)("xiangxia"),handler:function(e){var n=e.row,t=e.vm;t._fetch("/sizecontent/down",{id:n.id}).then(function(){t.loadList(function(e){return e})})}},{label:Object(i.d)("dibu"),handler:function(e){var n=e.row,t=e.vm;t._fetch("/sizecontent/bottom",{id:n.id}).then(function(){t.loadList(function(e){return e})})}}],controller:"sizecontent",key_column:"content",base:{topid:""},options:{action_width:450}},l={props:a,props2:o,dialogVisible:!1,title:""};n.a={name:"sp-sizetop",data:function(){return l}}},377:function(e,n,t){"use strict";var i=function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("div",[t("multiple-admin-page",e._b({ref:"page"},"multiple-admin-page",e.props,!1)),e._v(" "),t("el-dialog",{staticClass:"user-form",attrs:{title:e.title,visible:e.dialogVisible,center:!0,width:"80%"},on:{"update:visible":function(n){e.dialogVisible=n}}},[t("simple-admin-page",e._b({ref:"page2"},"simple-admin-page",e.props2,!1))],1)],1)},a=[],o={render:i,staticRenderFns:a};n.a=o}});
//# sourceMappingURL=17-1020.js.map