webpackJsonp([24],{297:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var s=r(403),a=r(496),o=r(0),i=o(s.a,a.a,!1,null,null,null);t.default=i.exports},403:function(e,t,r){"use strict";var s=r(5),a=r.n(s),o=r(7),i=r.n(o),l=r(37);t.a={name:"sp-usersetting",data:function(){return{form:{saleportid:"",priceid:"",warehouseid:""}}},methods:{onSubmit:function(){var e=this;e._submit("/user/setting",e.form).then(function(){})}},mounted:function(){var e=this;return i()(a.a.mark(function t(){var r,s;return a.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return r=e,r._setTitle(r._label("gerenshezhi")),t.next=4,l.a.getSetting();case 4:s=t.sent,r.form.saleportid=s.saleportid,r.form.warehouseid=s.warehouseid,r.form.priceid=s.priceid,console.log("this.userprice=start"),console.log(e.userprice),console.log("this.userprice=end");case 11:case"end":return t.stop()}},t,e)}))()}}},496:function(e,t,r){"use strict";var s=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("el-tabs",{attrs:{type:"border-card",activeName:"setting"}},[r("el-tab-pane",{attrs:{label:e._label("morenshezhi"),name:"setting"}},[r("el-form",{staticClass:"order-form",staticStyle:{width:"700px"},attrs:{model:e.form,"label-width":"85px",inline:!0,size:"small"}},[r("el-form-item",{attrs:{label:e._label("xiaoshouduankou")}},[r("simple-select",{attrs:{source:"usersaleport"},model:{value:e.form.saleportid,callback:function(t){e.$set(e.form,"saleportid",t)},expression:"form.saleportid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("jiage")}},[r("simple-select",{attrs:{source:"userprice"},model:{value:e.form.priceid,callback:function(t){e.$set(e.form,"priceid",t)},expression:"form.priceid"}})],1),e._v(" "),r("el-form-item",{attrs:{label:e._label("xiaoshoucangku")}},[r("simple-select",{attrs:{source:"userwarehouse"},model:{value:e.form.warehouseid,callback:function(t){e.$set(e.form,"warehouseid",t)},expression:"form.warehouseid"}})],1)],1),e._v(" "),r("as-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v(e._s(e._label("baocun")))])],1)],1)},a=[],o={render:s,staticRenderFns:a};t.a=o}});