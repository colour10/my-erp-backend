webpackJsonp([25],{315:function(e,i,a){"use strict";Object.defineProperty(i,"__esModule",{value:!0});var n=a(374),t=a(428),s=a(0),l=s(n.a,t.a,!1,null,null,null);i.default=l.exports},374:function(e,i,a){"use strict";a(1),a(183);i.a={name:"sp-permission",data:function(){var e=this,i=this._label;return{props:{columns:[{name:"memo",label:i("mingcheng"),is_multiple:!0,is_focus:!0},{name:"pid",label:i("pid")},{name:"name",label:i("bianma")},{name:"display_index",label:i("xuhao")},{name:"is_only_superadmin",label:i("pingtaiquanxian"),type:"switch"}],controller:"permission",key_column:"memo",actions:[{label:i("quanxian"),handler:function(i){var a=i.row;i.vm;e.props2.base.permissionid=a.id,e._showDialog("detail")}}],options:{action_width:250,isAutoReload:!0}},props2:{columns:[{name:"controller",label:i("mingcheng"),is_focus:!0},{name:"action",label:i("bianma")}],controller:"permissionaction",base:{permissionid:""}}}},methods:{}}},428:function(e,i,a){"use strict";var n=function(){var e=this,i=e.$createElement,a=e._self._c||i;return a("div",{staticStyle:{width:"99%"}},[a("multiple-admin-page",e._b({ref:"page",staticClass:"product",on:{"before-edit":e.onBeforeEdit,"before-add":e.onBeforeAdd}},"multiple-admin-page",e.props,!1)),e._v(" "),a("sp-dialog",{ref:"detail",attrs:{width:"800","min-height":150}},[a("simple-admin-page",e._b({},"simple-admin-page",e.props2,!1))],1)],1)},t=[],s={render:n,staticRenderFns:t};i.a=s}});
//# sourceMappingURL=25-1032.js.map