webpackJsonp([19],{290:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var s=a(324),r=a(360),n=a(0),l=n(s.a,r.a,!1,null,null,null);t.default=l.exports},324:function(e,t,a){"use strict";t.a={name:"sp-sales",data:function(){var e=this,t=e._label;return{props:{columns:[{name:"orderno",label:t("xiaoshoudanhao"),width:110},{name:"makestaff",label:t("xiaoshouren"),type:"select",source:"user",width:130},{name:"warehouseid",label:t("xiaoshoucangku"),type:"select",source:"warehouse"},{name:"status",label:t("zhuangtai"),type:"select",source:"salestatus",width:100},{name:"makedate",label:t("xiaoshouriqi"),width:110,convert:function(e){if(e.makedate&&e.makedate.length>0)return e.makedate.substr(0,10)}}],controller:"sales"}}},methods:{showFormToEdit:function(e,t){this.toPage(t.id)},toPage:function(e){this.$router.push("/sales/"+e)},toEdit:function(e,t){this.toPage(t.id)},search:function(){this.$refs.tablelist.search()}}}},360:function(e,t,a){"use strict";var s=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-row",[a("el-col",{attrs:{span:10}},[a("as-button",{attrs:{type:"primary"},on:{click:e.search}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),a("auth",{attrs:{auth:"sales"}},[a("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.$router.push("/sales/create")}}},[e._v(e._s(e._label("xinjian")))])],1)],1)],1),e._v(" "),a("el-row",{attrs:{gutter:20}},[a("el-col",{attrs:{span:24}},[a("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{onclickupdate:e.showFormToEdit,isdelete:!1}},"simple-admin-tablelist",e.props,!1))],1)],1)],1)},r=[],n={render:s,staticRenderFns:r};t.a=n}});
//# sourceMappingURL=19-1023.js.map