webpackJsonp([24],{297:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=r(403),s=r(496),i=r(0),o=i(a.a,s.a,!1,null,null,null);t.default=o.exports},403:function(e,t,r){"use strict";var a=r(5),s=r.n(a),i=r(7),o=r.n(i),l=r(37);t.a={name:"sp-usersetting",data:function(){return{form:{saleportid:"",priceid:"",warehouseid:""}}},methods:{onSubmit:function(){var e=this;e._submit("/user/setting",e.form).then(function(){})}},mounted:function(){var e=this;return o()(s.a.mark(function t(){var r,a;return s.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return r=e,r._setTitle(r._label("gerenshezhi")),t.next=4,l.a.getSetting();case 4:a=t.sent,r.form.saleportid=a.saleportid,r.form.warehouseid=a.warehouseid,r.form.priceid=a.priceid;case 8:case"end":return t.stop()}},t,e)}))()}}},496:function(e,t,r){"use strict";var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("el-tabs",{attrs:{type:"border-card",activeName:"setting"}},[r("el-tab-pane",{attrs:{label:e._label("morenshezhi"),name:"setting"}},[r("el-form",{staticClass:"order-form",staticStyle:{width:"700px"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"small"}},[r("el-form-item",{attrs:{label:e._label("xiaoshouduankou")}},[r("simple-select",{attrs:{source:"usersaleport"},model:{value:e.form.saleportid,callback:function(t){e.$set(e.form,"saleportid",t)},expression:"form.saleportid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jiage")}},[r("simple-select",{attrs:{source:"userprice"},model:{value:e.form.priceid,callback:function(t){e.$set(e.form,"priceid",t)},expression:"form.priceid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xiaoshoucangku")}},[r("simple-select",{attrs:{source:"userwarehouse"},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1)],1),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e._label("baocun")))])],1)],1)},s=[],i={render:a,staticRenderFns:s};t.a=i}});