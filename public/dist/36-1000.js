webpackJsonp([36],{281:function(e,i,a){"use strict";Object.defineProperty(i,"__esModule",{value:!0});var t=a(375),n=a(451),r=a(0),l=r(t.a,n.a,!1,null,null,null);i.default=l.exports},375:function(e,i,a){"use strict";var t=a(5),n=a.n(t),r=a(10),l=a.n(r),o=a(2),d=a(186);i.a={name:"sp-brandgroup",data:function(){var e=this;return{props:{columns:[{name:"name",label:Object(o.d)("pinleimingcheng"),is_multiple:!0,is_focus:!0},{name:"displayindex",label:Object(o.d)("xuhao"),sortMethod:function(e,i){return e-i}}],buttons:[{name:"code",label:Object(o.d)("zipinlei"),width:150,disable_change:!0,handler:function(i,a){e.props2.base.brandgroupid=a.id,e.dialogVisible=!0,e.dialogTitle=a.name_cn}}],controller:"brandgroup",key_column:"name"},props2:{columns:[{name:"name",label:Object(o.d)("zileimingcheng"),is_multiple:!0,is_focus:!0},{name:"diagram",label:Object(o.d)("shiyitu"),type:"avatar",width:100,sortable:!1},{name:"displayindex",label:Object(o.d)("xuhao"),width:100,sortMethod:function(e,i){return e-i}}],buttons:[{name:"code",label:Object(o.d)("pinleishuxing"),width:100,disable_change:!0,handler:function(i,a){e.props3.base.brandgroupchildid=a.id,e.dialogVisible2=!0,e.dialogTitle2=a.name_cn}}],actions:[{name:"code",label:Object(o.d)("fuzhidao"),width:150,disable_change:!0,enable:e._isAllowed("brandgroupchild"),handler:function(i){var a=i.row;e.dialogVisible3=!0,e.brandgroupchildid=a.id}}],controller:"brandgroupchild",key_column:"name",base:{brandgroupid:""},options:{action_width:250},formTitle:function(e){if(e&&e.id>0)return e.name_en}},props3:{columns:[{name:"propertyid",label:Object(o.d)("pinleishuxing"),type:"select",source:"property"},{name:"displayindex",label:Object(o.d)("paixu"),width:100}],controller:"brandgroupchildproperty",base:{brandgroupchildid:""},options:{action_width:300,isAutoReload:!0,isAutohide:!0}},dialogVisible:!1,dialogVisible2:!1,dialogVisible3:!1,dialogTitle:"",dialogTitle2:"",treeprops:{label:"name",children:"zones"},brandgroupchildid:""}},methods:{showDiagram:function(e){var i=this;console.log(e),d.a.show({url:i._fileLink(e.diagram)})},loadNode:function(e,i){var a=this;return l()(n.a.mark(function t(){var r,l,o;return n.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(r=a,r._log(e),0!==e.level){t.next=9;break}return t.next=5,r._fetch("/brandgroup/loadnode",{brandgroupid:0});case 5:return l=t.sent,t.abrupt("return",i(l.data));case 9:if(1!==e.level){t.next=16;break}return t.next=12,r._fetch("/brandgroup/loadnode",{brandgroupid:e.data.id});case 12:return o=t.sent,t.abrupt("return",i(o.data));case 16:return t.abrupt("return",i([]));case 17:case"end":return t.stop()}},t,a)}))()},onSubmit:function(){var e=this;return l()(n.a.mark(function i(){var a,t,r,l;return n.a.wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return a=e,t=a.$refs.tree,r=t.getCheckedNodes().filter(function(e){return e.isLeaf}).map(function(e){return e.id}),a._log(r),i.next=6,a._submit("/brandgroup/copyproperty",{brandgroupchildid:a.brandgroupchildid,target:r.join(",")});case 6:l=i.sent,a.dialogVisible3=!1,t.setCheckedNodes([]);case 9:case"end":return i.stop()}},i,e)}))()}}}},451:function(e,i,a){"use strict";var t=function(){var e=this,i=e.$createElement,a=e._self._c||i;return a("div",[a("multiple-admin-page",e._b({ref:"page"},"multiple-admin-page",e.props,!1)),e._v(" "),a("el-dialog",{staticClass:"user-form",attrs:{title:e.dialogTitle,visible:e.dialogVisible,center:!0,width:"1000px"},on:{"update:visible":function(i){e.dialogVisible=i}}},[a("multiple-admin-page",e._b({ref:"page2",scopedSlots:e._u([{key:"diagram",fn:function(i){var t=i.row;return[a("el-button",{attrs:{size:"mini"},on:{click:function(i){return e.showDiagram(t)}}},[e._v(e._s(e._label("shiyitu")))])]}}])},"multiple-admin-page",e.props2,!1))],1),e._v(" "),a("el-dialog",{staticClass:"user-form",attrs:{title:e.dialogTitle2,visible:e.dialogVisible2,center:!0},on:{"update:visible":function(i){e.dialogVisible2=i}}},[a("multiple-admin-page",e._b({ref:"page3"},"multiple-admin-page",e.props3,!1))],1),e._v(" "),a("el-dialog",{staticClass:"user-form",attrs:{title:e._label("fuzhishuxing"),visible:e.dialogVisible3,center:!0,width:"400px"},on:{"update:visible":function(i){e.dialogVisible3=i}}},[a("el-tree",{ref:"tree",attrs:{props:e.treeprops,load:e.loadNode,lazy:"","show-checkbox":"","node-key":"key"}}),e._v(" "),a("el-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e._label("tijiao")))])],1)],1)},n=[],r={render:t,staticRenderFns:n};i.a=r}});