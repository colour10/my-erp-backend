webpackJsonp([27],{298:function(e,i,t){"use strict";Object.defineProperty(i,"__esModule",{value:!0});var n=t(349),a=t(395),r=t(0),l=r(n.a,a.a,!1,null,null,null);i.default=l.exports},349:function(e,i,t){"use strict";var n=t(12),a=t.n(n),r=t(13),l=t.n(r),o=t(1);i.a={name:"sp-brandgroup",components:{},props:{},data:function(){var e=this;return{props:{columns:[{name:"name",label:Object(o.d)("pinleimingcheng"),is_multiple:!0,is_focus:!0},{name:"displayindex",label:Object(o.d)("xuhao"),sortMethod:function(e,i){return e-i}}],buttons:[{name:"code",label:Object(o.d)("zipinlei"),width:150,disable_change:!0,handler:function(i,t){e.props2.base.brandgroupid=t.id,e.dialogVisible=!0,e.dialogTitle=t.name_cn}}],controller:"brandgroup",key_column:"name"},props2:{columns:[{name:"name",label:Object(o.d)("zileimingcheng"),is_multiple:!0,is_focus:!0},{name:"displayindex",label:Object(o.d)("xuhao"),width:100,sortMethod:function(e,i){return e-i}}],buttons:[{name:"code",label:Object(o.d)("pinleishuxing"),width:100,disable_change:!0,handler:function(i,t){e.props3.base.brandgroupchildid=t.id,e.dialogVisible2=!0,e.dialogTitle2=t.name_cn}}],actions:[{name:"code",label:Object(o.d)("fuzhidao"),width:150,disable_change:!0,handler:function(i){var t=i.row;e.dialogVisible3=!0,e.brandgroupchildid=t.id}}],controller:"brandgroupchild",key_column:"name",base:{brandgroupid:""},options:{action_width:250},formTitle:function(e){if(e&&e.id>0)return e.name_en}},props3:{columns:[{name:"propertyid",label:Object(o.d)("pinleishuxing"),type:"select",source:"property"},{name:"displayindex",label:Object(o.d)("paixu"),width:100}],controller:"brandgroupchildproperty",base:{brandgroupchildid:""},options:{action_width:300,isAutoReload:!0,isAutohide:!0}},dialogVisible:!1,dialogVisible2:!1,dialogVisible3:!1,dialogTitle:"",dialogTitle2:"",treeprops:{label:"name",children:"zones"},brandgroupchildid:""}},methods:{loadNode:function(e,i){var t=this;return l()(a.a.mark(function n(){var r,l,o;return a.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:if(r=t,r._log(e),0!==e.level){n.next=9;break}return n.next=5,r._fetch("/brandgroup/loadnode",{brandgroupid:0});case 5:return l=n.sent,n.abrupt("return",i(l.data));case 9:if(1!==e.level){n.next=16;break}return n.next=12,r._fetch("/brandgroup/loadnode",{brandgroupid:e.data.id});case 12:return o=n.sent,n.abrupt("return",i(o.data));case 16:return n.abrupt("return",i([]));case 17:case"end":return n.stop()}},n,t)}))()},onSubmit:function(){var e=this;return l()(a.a.mark(function i(){var t,n,r,l;return a.a.wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return t=e,n=t.$refs.tree,r=n.getCheckedNodes().filter(function(e){return e.isLeaf}).map(function(e){return e.id}),t._log(r),i.next=6,t._submit("/brandgroup/copyproperty",{brandgroupchildid:t.brandgroupchildid,target:r.join(",")});case 6:l=i.sent,t.dialogVisible3=!1,n.setCheckedNodes([]);case 9:case"end":return i.stop()}},i,e)}))()}}}},395:function(e,i,t){"use strict";var n=function(){var e=this,i=e.$createElement,t=e._self._c||i;return t("div",[t("multiple-admin-page",e._b({ref:"page"},"multiple-admin-page",e.props,!1)),e._v(" "),t("el-dialog",{staticClass:"user-form",attrs:{title:e.dialogTitle,visible:e.dialogVisible,center:!0,width:"900px"},on:{"update:visible":function(i){e.dialogVisible=i}}},[t("multiple-admin-page",e._b({ref:"page2"},"multiple-admin-page",e.props2,!1))],1),e._v(" "),t("el-dialog",{staticClass:"user-form",attrs:{title:e.dialogTitle2,visible:e.dialogVisible2,center:!0},on:{"update:visible":function(i){e.dialogVisible2=i}}},[t("multiple-admin-page",e._b({ref:"page3"},"multiple-admin-page",e.props3,!1))],1),e._v(" "),t("el-dialog",{staticClass:"user-form",attrs:{title:e._label("fuzhishuxing"),visible:e.dialogVisible3,center:!0,width:"400px"},on:{"update:visible":function(i){e.dialogVisible3=i}}},[t("el-tree",{ref:"tree",attrs:{props:e.treeprops,load:e.loadNode,lazy:"","show-checkbox":"","node-key":"key"}}),e._v(" "),t("el-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e._label("tijiao")))])],1)],1)},a=[],r={render:n,staticRenderFns:a};i.a=r}});
//# sourceMappingURL=27-1025.js.map