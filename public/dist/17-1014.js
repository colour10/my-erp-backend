webpackJsonp([17],{280:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var s=a(313),n=a(343),r=a(0),l=r(s.a,n.a,!1,null,null,null);t.default=l.exports},313:function(e,t,a){"use strict";t.a={name:"sp-sales",data:function(){var e=this,t=e._label;return{props:{columns:[{name:"orderno",label:t("xiaoshoudanhao"),width:110},{name:"makestaff",label:t("xiaoshouren"),type:"select",source:"user",width:130},{name:"warehouseid",label:t("xiaoshoucangku"),type:"select",source:"warehouse"},{name:"status",label:t("zhuangtai"),type:"select",source:"salestatus",width:100},{name:"makedate",label:t("xiaoshouriqi"),width:110,convert:function(e){if(e.makedate&&e.makedate.length>0)return e.makedate.substr(0,10)}}],controller:"sales"}}},methods:{showFormToEdit:function(e,t){this.toPage(t.id)},toPage:function(e){this.$router.push("/sales/"+e)},toEdit:function(e,t){this.toPage(t.id)},search:function(){this.$refs.tablelist.search()}}}},343:function(e,t,a){"use strict";var s=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-row",[a("el-col",{attrs:{span:10}},[a("as-button",{attrs:{type:"primary"},on:{click:e.search}},[e._v(e._s(e._label("chaxun")))]),e._v(" "),a("auth",{attrs:{auth:"sales"}},[a("as-button",{attrs:{type:"primary"},on:{click:function(t){return e.toPage(0)}}},[e._v(e._s(e._label("xinjian")))])],1)],1)],1),e._v(" "),a("el-row",{attrs:{gutter:20}},[a("el-col",{attrs:{span:24}},[a("simple-admin-tablelist",e._b({ref:"tablelist",attrs:{onclickupdate:e.showFormToEdit,isdelete:!1}},"simple-admin-tablelist",e.props,!1))],1)],1)],1)},n=[],r={render:s,staticRenderFns:n};t.a=r}});
//# sourceMappingURL=17-1014.js.map