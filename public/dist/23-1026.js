webpackJsonp([23],{301:function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var s=i(355),a=i(401),n=i(0),o=n(s.a,a.a,!1,null,null,null);e.default=o.exports},355:function(t,e,i){"use strict";var s=i(1);e.a={name:"sp-requisition",components:{},props:{},data:function(){return{props:{columns:[{name:"out_id",label:Object(s.d)("diaochuku"),type:"select",source:"warehouse"},{name:"in_id",label:Object(s.d)("diaoruku"),type:"select",source:"warehouse"},{name:"apply_staff",label:Object(s.d)("shenqingren"),type:"select",source:"user"},{name:"status",label:Object(s.d)("zhuangtai"),type:"select",source:"requisitionstatus"}],controller:"requisition"},visibleDialog:!1,info:{},rowIndex:-1,visibleDetailDialog:!1}},methods:{showForm:function(){this.visibleDialog=!0},showFormToCreate:function(){this.$router.push("/requisition/create")},showFormToEdit:function(t,e){this.$router.push("/requisition/edit/"+e.id)},onChange:function(){var t=this;t.visibleDialog=!1,t.$refs.tablelist.loadList()},onRowChange:function(){this.$refs.tablelist.loadList()},isEditable:function(t){var e=t.status;return"1"==e||""==e||!e},onSearch:function(){this.$refs.tablelist.search()}},computed:{},watch:{},mounted:function(){}}},401:function(t,e,i){"use strict";var s=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",[i("el-row",[i("el-col",{attrs:{span:6}},[i("as-button",{attrs:{type:"primary"},on:{click:t.onSearch}},[t._v(t._s(t._label("chaxun")))]),t._v(" "),i("auth",{attrs:{auth:"requisition"}},[i("as-button",{attrs:{type:"primary"},on:{click:function(e){return t.showFormToCreate()}}},[t._v(t._s(t._label("xinjian")))])],1)],1)],1),t._v(" "),i("el-row",{attrs:{gutter:20}},[i("el-col",{attrs:{span:24}},[i("simple-admin-tablelist",t._b({ref:"tablelist",attrs:{onclickupdate:t.showFormToEdit,isdelete:!1}},"simple-admin-tablelist",t.props,!1))],1)],1)],1)},a=[],n={render:s,staticRenderFns:a};e.a=n}});
//# sourceMappingURL=23-1026.js.map